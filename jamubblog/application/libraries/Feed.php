<?php

/**
 * RSS for PHP - small and easy-to-use library for consuming an RSS Feed
 *
 * @author     David Grudl
 * @copyright  Copyright (c) 2008 David Grudl
 * @license    New BSD License
 * @link       http://phpfashion.com/
 * @version    1.0
 */
class Feed
{
    /** @var SimpleXMLElement */
    protected $xml;


    /**
     * Loads RSS channel.
     * @param  string  RSS feed URL
     * @param  string  optional user name
     * @param  string  optional password
     * @return Feed
     */
    public static function loadRss($url, $user = NULL, $pass = NULL)
    {
        $xml = new SimpleXMLElement(self::httpRequest($url, $user, $pass), LIBXML_NOWARNING | LIBXML_NOERROR);
        if (!$xml->channel) {
            exit();
        }

        self::adjustNamespaces($xml->channel);

        foreach ($xml->channel->item as $item) {
            // converts namespaces to dotted tags
            self::adjustNamespaces($item);

            // generate 'timestamp' tag
            if (isset($item->{'dc:date'})) {
                $item->timestamp = strtotime($item->{'dc:date'});
            } elseif (isset($item->pubDate)) {
                $item->timestamp = strtotime($item->pubDate);
            }
        }

        $feed = new self;
        $feed->xml = $xml->channel;
        return $feed;
    }


    /**
     * Loads Atom channel.
     * @param  string  Atom feed URL
     * @param  string  optional user name
     * @param  string  optional password
     * @return Feed
     */
    public static function loadAtom($url, $user = NULL, $pass = NULL)
    {
        $xml = new SimpleXMLElement(self::httpRequest($url, $user, $pass), LIBXML_NOWARNING | LIBXML_NOERROR);
        if (!in_array('http://www.w3.org/2005/Atom', $xml->getDocNamespaces(), TRUE)) {

            $ci =& get_instance();
            $ci->session->set_flashdata('error', "Invalid channel");
            redirect($ci->agent->referrer());
        }

        // generate 'timestamp' tag
        foreach ($xml->entry as $entry) {
            $entry->timestamp = strtotime($entry->updated);
        }

        $feed = new self;
        $feed->xml = $xml;
        return $feed;
    }


    /**
     * Returns property value. Do not call directly.
     * @param  string  tag name
     * @return SimpleXMLElement
     */
    public function __get($name)
    {
        return $this->xml->{$name};
    }


    /**
     * Sets value of a property. Do not call directly.
     * @param  string  property name
     * @param  mixed   property value
     * @return void
     */
    public function __set($name, $value)
    {
    }


    /**
     * Converts a SimpleXMLElement into an array.
     * @param  SimpleXMLElement
     * @return array
     */
    public function toArray(SimpleXMLElement $xml = NULL)
    {
        if ($xml === NULL) {
            $xml = $this->xml;
        }

        if (!$xml->children()) {
            return (string)$xml;
        }

        $arr = array();
        foreach ($xml->children() as $tag => $child) {
            if (count($xml->$tag) === 1) {
                $arr[$tag] = $this->toArray($child);
            } else {
                $arr[$tag][] = $this->toArray($child);
            }
        }

        return $arr;
    }


    /**
     * Process HTTP request.
     * @param  string  URL
     * @param  string  user name
     * @param  string  password
     * @return string
     */
    protected static function httpRequest($url, $user, $pass)
    {
        if ($user === NULL && $pass === NULL && ini_get('allow_url_fopen')) {
            $result = @file_get_contents($url);

            if (empty($result)) {
                $ci =& get_instance();
                $ci->session->set_flashdata('error', trans("invalid_url"));
                redirect($ci->agent->referrer());
            }

        } else {
            if (!extension_loaded('curl')) {

                $ci =& get_instance();
                $ci->session->set_flashdata('error', "PHP extension CURL is not loaded.");
                redirect($ci->agent->referrer());

            }

            $curl = curl_init();
            curl_setopt($curl, CURLOPT_URL, $url);
            if ($user !== NULL || $pass !== NULL) {
                curl_setopt($curl, CURLOPT_USERPWD, "$user:$pass");
            }
            curl_setopt($curl, CURLOPT_HEADER, FALSE);
            curl_setopt($curl, CURLOPT_TIMEOUT, 20);
            curl_setopt($curl, CURLOPT_RETURNTRANSFER, TRUE); // no echo, just return result
            $result = curl_exec($curl);
        }

        return $result;
    }


    /**
     * Generates better accessible namespaced tags.
     * @param  SimpleXMLElement
     * @return void
     */
    private static function adjustNamespaces($el)
    {
        foreach ($el->getNamespaces(TRUE) as $prefix => $ns) {
            $children = $el->children($ns);
            foreach ($children as $tag => $content) {
                $el->{$prefix . ':' . $tag} = $content;
            }
        }
    }

}
