-- phpMyAdmin SQL Dump
-- version 5.1.1
-- https://www.phpmyadmin.net/
--
-- Host: localhost
-- Generation Time: Feb 17, 2023 at 08:23 AM
-- Server version: 10.5.19-MariaDB
-- PHP Version: 7.2.34

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `jamubgroup_jamubblog`
--

-- --------------------------------------------------------

--
-- Table structure for table `ad_spaces`
--

CREATE TABLE `ad_spaces` (
  `id` int(11) NOT NULL,
  `ad_space` text DEFAULT NULL,
  `ad_code_728` text DEFAULT NULL,
  `ad_code_468` text DEFAULT NULL,
  `ad_code_300` text DEFAULT NULL,
  `ad_code_234` text DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_general_ci;

--
-- Dumping data for table `ad_spaces`
--

INSERT INTO `ad_spaces` (`id`, `ad_space`, `ad_code_728`, `ad_code_468`, `ad_code_300`, `ad_code_234`) VALUES
(1, 'index_top', '', '', '', ''),
(2, 'index_bottom', '', '', '', ''),
(3, 'post_top', '', '', '', ''),
(4, 'post_bottom', '', '', '', ''),
(5, 'category_top', '', '', '', ''),
(6, 'category_bottom', '', '', '', ''),
(7, 'tag_top', '', '', '', ''),
(8, 'tag_bottom', '', '', '', ''),
(9, 'search_top', '', '', '', ''),
(10, 'search_bottom', '', '', '', ''),
(11, 'profile_top', '', '', '', ''),
(12, 'profile_bottom', '', '', '', ''),
(13, 'reading_list_top', '', '', '', ''),
(14, 'reading_list_bottom', '', '', '', ''),
(15, 'sidebar_top', '', '', '', ''),
(16, 'sidebar_bottom', '', '', '', ''),
(17, 'header', '', '', '', ''),
(18, 'posts_top', '', '', '', ''),
(19, 'posts_bottom', '', '', '', '');

-- --------------------------------------------------------

--
-- Table structure for table `audios`
--

CREATE TABLE `audios` (
  `id` int(11) NOT NULL,
  `post_id` int(11) DEFAULT NULL,
  `audio_path` varchar(255) DEFAULT NULL,
  `audio_name` varchar(500) DEFAULT NULL,
  `musician` varchar(500) DEFAULT NULL,
  `download_button` int(11) DEFAULT 1
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_general_ci;

-- --------------------------------------------------------

--
-- Table structure for table `categories`
--

CREATE TABLE `categories` (
  `id` int(11) NOT NULL,
  `name` varchar(255) DEFAULT NULL,
  `name_slug` varchar(255) DEFAULT NULL,
  `parent_id` int(11) DEFAULT 0,
  `description` varchar(500) DEFAULT NULL,
  `keywords` varchar(500) DEFAULT NULL,
  `color` varchar(255) DEFAULT NULL,
  `block_type` varchar(255) DEFAULT NULL,
  `category_order` int(11) DEFAULT 0,
  `show_at_homepage` int(11) DEFAULT 1,
  `show_on_menu` int(11) DEFAULT 1,
  `created_at` timestamp NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_general_ci;

--
-- Dumping data for table `categories`
--

INSERT INTO `categories` (`id`, `name`, `name_slug`, `parent_id`, `description`, `keywords`, `color`, `block_type`, `category_order`, `show_at_homepage`, `show_on_menu`, `created_at`) VALUES
(1, 'Past projects', 'past-projects', 0, 'Our past projects', 'Rail construction', '#e31717', 'block-4', 1, 1, 1, '2023-02-13 14:38:34'),
(2, 'Ongoing Projects', 'ongoing-projects', 0, 'Our ongoing projects', 'projects', '#1da2b8', 'block-2', 3, 1, 1, '2023-02-14 07:43:17');

-- --------------------------------------------------------

--
-- Table structure for table `comments`
--

CREATE TABLE `comments` (
  `id` int(11) NOT NULL,
  `post_id` int(11) DEFAULT NULL,
  `user_id` int(11) DEFAULT NULL,
  `parent_id` int(11) DEFAULT NULL,
  `comment` varchar(5000) DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_general_ci;

-- --------------------------------------------------------

--
-- Table structure for table `comment_likes`
--

CREATE TABLE `comment_likes` (
  `id` int(11) NOT NULL,
  `comment_id` int(11) NOT NULL,
  `user_id` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_general_ci;

-- --------------------------------------------------------

--
-- Table structure for table `contacts`
--

CREATE TABLE `contacts` (
  `id` int(11) NOT NULL,
  `name` varchar(255) DEFAULT NULL,
  `email` varchar(255) DEFAULT NULL,
  `message` varchar(5000) DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_general_ci;

-- --------------------------------------------------------

--
-- Table structure for table `gallery`
--

CREATE TABLE `gallery` (
  `id` int(11) NOT NULL,
  `title` varchar(500) DEFAULT NULL,
  `category_id` int(11) DEFAULT NULL,
  `path_big` varchar(255) DEFAULT NULL,
  `path_small` varchar(255) DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_general_ci;

-- --------------------------------------------------------

--
-- Table structure for table `gallery_categories`
--

CREATE TABLE `gallery_categories` (
  `id` int(11) NOT NULL,
  `name` varchar(255) DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_general_ci;

-- --------------------------------------------------------

--
-- Table structure for table `newsletters`
--

CREATE TABLE `newsletters` (
  `id` int(11) NOT NULL,
  `email` varchar(255) DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_general_ci;

-- --------------------------------------------------------

--
-- Table structure for table `pages`
--

CREATE TABLE `pages` (
  `id` int(11) NOT NULL,
  `title` varchar(500) DEFAULT NULL,
  `slug` varchar(500) DEFAULT NULL,
  `description` varchar(500) DEFAULT NULL,
  `keywords` varchar(500) DEFAULT NULL,
  `is_custom` int(11) DEFAULT 1,
  `page_content` text DEFAULT NULL,
  `page_order` int(11) DEFAULT 1,
  `visibility` int(11) DEFAULT 1,
  `title_active` int(11) DEFAULT 1,
  `breadcrumb_active` int(11) DEFAULT 1,
  `right_column_active` int(11) DEFAULT 1,
  `need_auth` int(11) DEFAULT 0,
  `location` varchar(255) DEFAULT 'top',
  `link` varchar(1000) DEFAULT NULL,
  `parent_id` int(11) DEFAULT 0,
  `page_type` varchar(50) DEFAULT 'page',
  `created_at` timestamp NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_general_ci;

--
-- Dumping data for table `pages`
--

INSERT INTO `pages` (`id`, `title`, `slug`, `description`, `keywords`, `is_custom`, `page_content`, `page_order`, `visibility`, `title_active`, `breadcrumb_active`, `right_column_active`, `need_auth`, `location`, `link`, `parent_id`, `page_type`, `created_at`) VALUES
(1, 'Home', 'index', 'Jamub Blog Index Page', 'index,home', 0, NULL, 1, 1, 1, 1, 0, 0, 'main', NULL, 0, 'page', '2017-11-22 20:05:45'),
(2, 'Register', 'register', 'Jamub Blog Register Page', 'register, auth', 0, NULL, 2, 1, 1, 1, 0, 0, 'none', NULL, 0, 'page', '2017-11-22 20:07:52'),
(3, 'Login', 'login', 'Jamub Blog Login Page', 'login, auth', 0, NULL, 0, 1, 1, 1, 0, 0, 'none', NULL, 0, 'page', '2017-11-22 20:14:41'),
(4, 'Reset Password', 'reset-password', 'Jamub Blog Reset Password Page', 'reset password, auth', 0, NULL, 0, 1, 1, 1, 0, 0, 'none', NULL, 0, 'page', '2017-11-22 20:16:38'),
(5, 'Change Password', 'change-password', 'Jamub Blog Change Password Page', 'change password, auth', 0, NULL, 0, 1, 1, 1, 0, 0, 'none', NULL, 0, 'page', '2017-11-22 20:19:07'),
(6, 'Update Profile', 'profile-update', 'Jamub Blog Update Profile Page', 'update profile, auth', 0, NULL, 0, 1, 1, 1, 0, 0, 'none', NULL, 0, 'page', '2017-11-22 20:20:32'),
(7, 'Contact', 'contact', 'Varient Contact Page', 'varient, contact, page', 0, NULL, 1, 1, 1, 1, 0, 0, 'top', NULL, 0, 'page', '2017-11-22 20:22:18'),
(8, 'Gallery', 'gallery', 'Jamub Blog Gallery Page', 'Jamub Blog, gallery , page', 0, NULL, 2, 1, 1, 1, 0, 0, 'main', NULL, 0, 'page', '2017-11-22 20:33:50'),
(9, 'Posts', 'posts', 'Jamub Blog Posts Page', 'Jamub Blog, posts, articles, page', 0, NULL, 0, 1, 1, 1, 1, 0, 'none', NULL, 0, 'page', '2017-11-22 20:35:36'),
(11, 'RSS Channels', 'rss-channels', 'Jamub Blog RSS Channels Page', 'Jamub Blog, rss channels, rss feeds', 0, '', 0, 1, 1, 1, 0, 0, 'none', NULL, 0, 'page', '2017-11-22 20:44:10'),
(12, 'Reading List', 'reading-list', 'Jamub Blog Reading List Page', 'Jamub Blog, reading list,  read later', 0, NULL, 0, 1, 1, 1, 1, 0, 'none', NULL, 0, 'page', '2017-11-22 20:49:16'),
(13, 'User Agreement', 'user-agreement', 'Jamub Blog User Agreement Page', 'Jamub Blog, user agreement, terms', 0, '', 0, 1, 1, 1, 0, 0, 'none', NULL, 0, 'page', '2017-11-22 20:52:21');

-- --------------------------------------------------------

--
-- Table structure for table `polls`
--

CREATE TABLE `polls` (
  `id` int(11) NOT NULL,
  `question` text DEFAULT NULL,
  `option1` text DEFAULT NULL,
  `option2` text DEFAULT NULL,
  `option3` text DEFAULT NULL,
  `option4` text DEFAULT NULL,
  `option5` text DEFAULT NULL,
  `option6` text DEFAULT NULL,
  `option7` text DEFAULT NULL,
  `option8` text DEFAULT NULL,
  `option9` text DEFAULT NULL,
  `option10` text DEFAULT NULL,
  `status` int(11) DEFAULT 1,
  `vote_permission` varchar(50) DEFAULT 'all',
  `created_at` timestamp NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_general_ci;

-- --------------------------------------------------------

--
-- Table structure for table `poll_votes`
--

CREATE TABLE `poll_votes` (
  `id` int(11) NOT NULL,
  `poll_id` int(11) NOT NULL,
  `user_id` int(11) NOT NULL,
  `vote` varchar(100) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_general_ci;

-- --------------------------------------------------------

--
-- Table structure for table `posts`
--

CREATE TABLE `posts` (
  `id` int(11) NOT NULL,
  `title` varchar(500) DEFAULT NULL,
  `title_slug` varchar(500) DEFAULT NULL,
  `keywords` varchar(500) DEFAULT NULL,
  `summary` varchar(1000) DEFAULT NULL,
  `content` longtext DEFAULT NULL,
  `category_id` int(11) DEFAULT NULL,
  `subcategory_id` int(11) DEFAULT NULL,
  `image_big` varchar(255) DEFAULT NULL,
  `image_default` varchar(255) DEFAULT NULL,
  `image_slider` varchar(255) DEFAULT NULL,
  `image_mid` varchar(255) DEFAULT NULL,
  `image_small` varchar(255) DEFAULT NULL,
  `hit` int(11) DEFAULT 0,
  `optional_url` varchar(1000) DEFAULT NULL,
  `need_auth` int(11) DEFAULT 0,
  `is_slider` int(11) DEFAULT 0,
  `slider_order` int(11) DEFAULT 1,
  `is_featured` int(11) DEFAULT 0,
  `featured_order` int(11) DEFAULT 1,
  `is_recommended` int(11) DEFAULT 0,
  `is_breaking` int(11) DEFAULT 1,
  `visibility` int(11) DEFAULT 1,
  `post_type` varchar(100) DEFAULT 'post',
  `video_path` varchar(255) DEFAULT NULL,
  `video_image_url` text DEFAULT NULL,
  `video_embed_code` text DEFAULT NULL,
  `user_id` int(11) DEFAULT NULL,
  `status` int(11) DEFAULT 1,
  `feed_id` int(11) DEFAULT NULL,
  `post_url` varchar(1000) DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_general_ci;

--
-- Dumping data for table `posts`
--

INSERT INTO `posts` (`id`, `title`, `title_slug`, `keywords`, `summary`, `content`, `category_id`, `subcategory_id`, `image_big`, `image_default`, `image_slider`, `image_mid`, `image_small`, `hit`, `optional_url`, `need_auth`, `is_slider`, `slider_order`, `is_featured`, `featured_order`, `is_recommended`, `is_breaking`, `visibility`, `post_type`, `video_path`, `video_image_url`, `video_embed_code`, `user_id`, `status`, `feed_id`, `post_url`, `created_at`) VALUES
(2, 'Jamub Railway Construction', 'jamub-railway-construction', 'Rail construction', 'Lorem Ipsum is simply dummy text of the printing and typesetting industry. ', '<p><strong>Lorem Ipsum</strong>&nbsp;is simply dummy text of the printing and typesetting industry. Lorem Ipsum has been the industry&#39;s standard dummy text ever since the 1500s, when an unknown printer took a galley of type and scrambled it to make a type specimen book. It has survived not only five centuries, but also the leap into electronic typesetting, remaining essentially unchanged. It was popularised in the 1960s with the release of Letraset sheets containing Lorem Ipsum passages, and more recently with desktop publishing software like Aldus PageMaker including versions of Lorem Ipsum.</p>\r\n\r\n<h2>Why do we use it?</h2>\r\n\r\n<p>It is a long established fact that a reader will be distracted by the readable content of a page when looking at its layout. The point of using Lorem Ipsum is that it has a more-or-less normal distribution of letters, as opposed to using &#39;Content here, content here&#39;, making it look like readable English. Many desktop publishing packages and web page editors now use Lorem Ipsum as their default model text, and a search for &#39;lorem ipsum&#39; will uncover many web sites still in their infancy. Various versions have evolved over the years, sometimes by accident, sometimes on purpose (injected humour and the like).</p>\r\n\r\n<p>&nbsp;</p>\r\n\r\n<h2>Where does it come from?</h2>\r\n\r\n<p>Contrary to popular belief, Lorem Ipsum is not simply random text. It has roots in a piece of classical Latin literature from 45 BC, making it over 2000 years old. Richard McClintock, a Latin professor at Hampden-Sydney College in Virginia, looked up one of the more obscure Latin words, consectetur, from a Lorem Ipsum passage, and going through the cites of the word in classical literature, discovered the undoubtable source. Lorem Ipsum comes from sections 1.10.32 and 1.10.33 of &quot;de Finibus Bonorum et Malorum&quot; (The Extremes of Good and Evil) by Cicero, written in 45 BC. This book is a treatise on the theory of ethics, very popular during the Renaissance. The first line of Lorem Ipsum, &quot;Lorem ipsum dolor sit amet..&quot;, comes from a line in section 1.10.32.</p>\r\n', 2, 0, 'uploads/images/image_1920x_63eb4d2fa8dfa.jpg', 'uploads/images/image_750x_63eb4d2fbc544.jpg', 'uploads/images/image_600x460_63eb4d2fd24ec.jpg', 'uploads/images/image_380x240_63eb4d2ff0dfe.jpg', 'uploads/images/image_140x98_63eb4d300981e.jpg', 3, '', 0, 1, 1, 1, 1, 1, 1, 1, 'post', NULL, NULL, NULL, 2, 1, NULL, NULL, '2023-02-14 07:50:08');

-- --------------------------------------------------------

--
-- Table structure for table `post_images`
--

CREATE TABLE `post_images` (
  `id` int(11) NOT NULL,
  `post_id` int(11) DEFAULT NULL,
  `image_big` varchar(255) DEFAULT NULL,
  `image_default` varchar(255) DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_general_ci;

--
-- Dumping data for table `post_images`
--

INSERT INTO `post_images` (`id`, `post_id`, `image_big`, `image_default`, `created_at`) VALUES
(3, 2, 'uploads/images/image_1920x_63eb4d4f4d3df.jpg', 'uploads/images/image_750x_63eb4d4f88252.jpg', '2023-02-14 08:58:55'),
(4, 2, 'uploads/images/image_1920x_63eb4d7759fa7.jpg', 'uploads/images/image_750x_63eb4d77900b5.jpg', '2023-02-14 08:59:35');

-- --------------------------------------------------------

--
-- Table structure for table `reading_lists`
--

CREATE TABLE `reading_lists` (
  `id` int(11) NOT NULL,
  `post_id` int(11) DEFAULT NULL,
  `user_id` int(11) DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_general_ci;

-- --------------------------------------------------------

--
-- Table structure for table `rss_feeds`
--

CREATE TABLE `rss_feeds` (
  `id` int(11) NOT NULL,
  `feed_name` varchar(500) DEFAULT NULL,
  `feed_url` varchar(1000) DEFAULT NULL,
  `post_limit` int(11) DEFAULT NULL,
  `category_id` int(11) DEFAULT NULL,
  `subcategory_id` int(11) DEFAULT NULL,
  `image_big` varchar(250) DEFAULT NULL,
  `image_default` varchar(250) DEFAULT NULL,
  `image_slider` varchar(250) DEFAULT NULL,
  `image_mid` varchar(250) DEFAULT NULL,
  `image_small` varchar(250) DEFAULT NULL,
  `auto_update` int(11) DEFAULT 1,
  `read_more_button` int(11) DEFAULT 1,
  `read_more_button_text` varchar(255) DEFAULT 'Read More',
  `user_id` int(11) DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_general_ci ROW_FORMAT=COMPACT;

-- --------------------------------------------------------

--
-- Table structure for table `settings`
--

CREATE TABLE `settings` (
  `id` int(11) NOT NULL,
  `site_title` varchar(255) DEFAULT NULL,
  `home_title` varchar(255) DEFAULT 'Home',
  `application_name` varchar(255) DEFAULT NULL,
  `site_color` varchar(100) DEFAULT 'default',
  `site_lang` varchar(100) DEFAULT 'english',
  `show_hits` int(11) DEFAULT 1,
  `show_rss` int(11) DEFAULT 1,
  `show_newsticker` int(11) DEFAULT 1,
  `pagination_per_page` int(11) DEFAULT 10,
  `facebook_url` varchar(500) DEFAULT NULL,
  `twitter_url` varchar(500) DEFAULT NULL,
  `google_url` varchar(500) DEFAULT NULL,
  `instagram_url` varchar(500) DEFAULT NULL,
  `pinterest_url` varchar(500) DEFAULT NULL,
  `linkedin_url` varchar(500) DEFAULT NULL,
  `vk_url` varchar(500) DEFAULT NULL,
  `youtube_url` varchar(500) DEFAULT NULL,
  `optional_url_button_name` varchar(500) DEFAULT 'Click',
  `about_footer` varchar(1000) DEFAULT NULL,
  `google_analytics` text DEFAULT NULL,
  `primary_font` varchar(255) DEFAULT NULL,
  `secondary_font` varchar(255) DEFAULT NULL,
  `tertiary_font` varchar(255) DEFAULT NULL,
  `contact_text` text DEFAULT NULL,
  `contact_address` varchar(500) DEFAULT NULL,
  `contact_email` varchar(255) DEFAULT NULL,
  `contact_phone` varchar(255) DEFAULT NULL,
  `map_api_key` varchar(500) DEFAULT NULL,
  `latitude` varchar(255) DEFAULT NULL,
  `longitude` varchar(255) DEFAULT NULL,
  `mail_protocol` varchar(100) DEFAULT 'smtp',
  `mail_host` varchar(255) DEFAULT NULL,
  `mail_port` varchar(255) DEFAULT '587',
  `mail_username` varchar(255) DEFAULT NULL,
  `mail_password` varchar(255) DEFAULT NULL,
  `mail_title` varchar(255) DEFAULT NULL,
  `facebook_app_id` varchar(500) DEFAULT NULL,
  `facebook_app_secret` varchar(500) DEFAULT NULL,
  `google_app_name` varchar(500) DEFAULT NULL,
  `google_client_id` varchar(500) DEFAULT NULL,
  `google_client_secret` varchar(500) DEFAULT NULL,
  `facebook_comment` text DEFAULT NULL,
  `facebook_comment_active` int(11) DEFAULT 1,
  `show_featured_section` int(11) DEFAULT 1,
  `show_latest_posts` int(11) DEFAULT 1,
  `registration_system` int(11) DEFAULT 1,
  `comment_system` int(11) DEFAULT 1,
  `show_post_author` int(11) DEFAULT 1,
  `show_post_date` int(11) DEFAULT 1,
  `menu_limit` int(11) DEFAULT 8,
  `copyright` varchar(500) DEFAULT NULL,
  `head_code` text DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_general_ci;

--
-- Dumping data for table `settings`
--

INSERT INTO `settings` (`id`, `site_title`, `home_title`, `application_name`, `site_color`, `site_lang`, `show_hits`, `show_rss`, `show_newsticker`, `pagination_per_page`, `facebook_url`, `twitter_url`, `google_url`, `instagram_url`, `pinterest_url`, `linkedin_url`, `vk_url`, `youtube_url`, `optional_url_button_name`, `about_footer`, `google_analytics`, `primary_font`, `secondary_font`, `tertiary_font`, `contact_text`, `contact_address`, `contact_email`, `contact_phone`, `map_api_key`, `latitude`, `longitude`, `mail_protocol`, `mail_host`, `mail_port`, `mail_username`, `mail_password`, `mail_title`, `facebook_app_id`, `facebook_app_secret`, `google_app_name`, `google_client_id`, `google_client_secret`, `facebook_comment`, `facebook_comment_active`, `show_featured_section`, `show_latest_posts`, `registration_system`, `comment_system`, `show_post_author`, `show_post_date`, `menu_limit`, `copyright`, `head_code`, `created_at`) VALUES
(1, 'Jamub Blog', 'Jamub- News Magazine', 'Jamub Blog', 'default', 'english', 1, 1, 1, 16, '', '', '', '', '', '', '', '', 'Click Here To See More', 'Jamub Group', '', 'open_sans', 'roboto', 'verdana', '', '', '', '', '', '', '', 'smtp', '', '587', '', '', 'Jamub Blog', '', '', 'Varient', '', '', '', 1, 1, 1, 0, 1, 1, 1, 8, 'Designed By Jamub  Group ICT @2023', '', '2017-07-06 00:11:07');

-- --------------------------------------------------------

--
-- Table structure for table `tags`
--

CREATE TABLE `tags` (
  `id` int(11) NOT NULL,
  `post_id` int(11) DEFAULT NULL,
  `tag` varchar(255) DEFAULT NULL,
  `tag_slug` varchar(255) DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_general_ci;

--
-- Dumping data for table `tags`
--

INSERT INTO `tags` (`id`, `post_id`, `tag`, `tag_slug`, `created_at`) VALUES
(3, 2, 'Construction', 'construction', '2023-02-14 07:50:08');

-- --------------------------------------------------------

--
-- Table structure for table `users`
--

CREATE TABLE `users` (
  `id` int(11) NOT NULL,
  `username` varchar(255) DEFAULT NULL,
  `slug` varchar(255) DEFAULT NULL,
  `email` varchar(255) DEFAULT 'name@domain.com',
  `password` varchar(255) DEFAULT NULL,
  `role` varchar(100) DEFAULT 'user',
  `user_type` varchar(100) DEFAULT 'registered',
  `google_id` varchar(255) DEFAULT NULL,
  `facebook_id` varchar(255) DEFAULT NULL,
  `avatar` varchar(255) DEFAULT NULL,
  `status` int(11) DEFAULT 1,
  `about_me` varchar(5000) DEFAULT NULL,
  `facebook_url` varchar(500) DEFAULT NULL,
  `twitter_url` varchar(500) DEFAULT NULL,
  `google_url` varchar(500) DEFAULT NULL,
  `instagram_url` varchar(500) DEFAULT NULL,
  `pinterest_url` varchar(500) DEFAULT NULL,
  `linkedin_url` varchar(500) DEFAULT NULL,
  `vk_url` varchar(500) DEFAULT NULL,
  `youtube_url` varchar(500) DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_general_ci;

--
-- Dumping data for table `users`
--

INSERT INTO `users` (`id`, `username`, `slug`, `email`, `password`, `role`, `user_type`, `google_id`, `facebook_id`, `avatar`, `status`, `about_me`, `facebook_url`, `twitter_url`, `google_url`, `instagram_url`, `pinterest_url`, `linkedin_url`, `vk_url`, `youtube_url`, `created_at`) VALUES
(1, 'admin', 'admin', 'admin@gmail.com', '$2a$08$U4cKHtgbNRqFNlL9TPKtQ.ohz3slO5PnkwL9/avxZBsYwY6rsBRQq', 'admin', 'registered', NULL, NULL, NULL, 1, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, '2018-03-06 14:33:21'),
(2, 'stephen onwuka', 'stephen-onwuka-63e3e5e6c4609', 'stephen.onwuka@jamubgroup.com', '$2a$08$CeOUzBOigdRZ5h4DPFya2O8FfJQZvm8BXkMQtzRCiI6cO7DakUbpy', 'admin', 'registered', NULL, NULL, 'uploads/profile/avatar_2_63e3ec6506f3d.jpg', 1, '', '', '', '', '', '', '', '', '', '2023-02-08 18:11:50'),
(3, 'Victor Okebe', 'victor-okebe-63e3eace59b9e', 'victor.okebe@jamubgroup.com', '$2a$08$Fvzi/bKxlTBu6SHvYR0VKeitKsCuabmjWRdYF8X2mjXfxQsadYJeS', 'author', 'registered', NULL, NULL, NULL, 1, '', '', '', '', '', '', '', '', '', '2023-02-08 18:32:46');

-- --------------------------------------------------------

--
-- Table structure for table `visual_settings`
--

CREATE TABLE `visual_settings` (
  `id` int(11) NOT NULL,
  `post_list_style` varchar(100) NOT NULL DEFAULT 'vertical',
  `site_color` varchar(100) NOT NULL DEFAULT 'default',
  `site_block_color` varchar(255) DEFAULT NULL,
  `logo` varchar(255) DEFAULT NULL,
  `logo_footer` varchar(255) DEFAULT NULL,
  `favicon` varchar(255) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_general_ci;

--
-- Dumping data for table `visual_settings`
--

INSERT INTO `visual_settings` (`id`, `post_list_style`, `site_color`, `site_block_color`, `logo`, `logo_footer`, `favicon`) VALUES
(1, 'vertical', 'orange', '#161616', 'uploads/logo/logo_63e5088583a16.png', 'uploads/logo/logo_63e39ef19358a.png', 'uploads/logo/favicon_63e3a0dd136fb.png');

-- --------------------------------------------------------

--
-- Table structure for table `widgets`
--

CREATE TABLE `widgets` (
  `id` int(11) NOT NULL,
  `title` varchar(500) DEFAULT NULL,
  `content` text DEFAULT NULL,
  `type` varchar(100) DEFAULT NULL,
  `widget_order` int(11) DEFAULT 1,
  `visibility` int(11) DEFAULT 1,
  `is_custom` int(11) DEFAULT 1,
  `created_at` timestamp NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_general_ci;

--
-- Dumping data for table `widgets`
--

INSERT INTO `widgets` (`id`, `title`, `content`, `type`, `widget_order`, `visibility`, `is_custom`, `created_at`) VALUES
(1, 'Popular Posts', '', 'popular-posts', 1, 1, 0, '2017-11-22 21:00:15'),
(2, 'Recommended Posts', '', 'recommended-posts', 2, 1, 0, '2017-11-22 21:02:00'),
(3, 'Random Posts', '', 'random-slider-posts', 3, 1, 0, '2017-11-22 21:03:02'),
(4, 'Featured Video', '', 'featured-video', 4, 1, 0, '2017-11-22 21:03:47'),
(5, 'Tags', '', 'tags', 5, 1, 0, '2017-11-22 21:04:29'),
(6, 'Voting Poll', '', 'poll', 6, 1, 0, '2017-11-22 21:05:24');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `ad_spaces`
--
ALTER TABLE `ad_spaces`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `audios`
--
ALTER TABLE `audios`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `categories`
--
ALTER TABLE `categories`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `comments`
--
ALTER TABLE `comments`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `comment_likes`
--
ALTER TABLE `comment_likes`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `contacts`
--
ALTER TABLE `contacts`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `gallery`
--
ALTER TABLE `gallery`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `gallery_categories`
--
ALTER TABLE `gallery_categories`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `newsletters`
--
ALTER TABLE `newsletters`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `pages`
--
ALTER TABLE `pages`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `polls`
--
ALTER TABLE `polls`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `poll_votes`
--
ALTER TABLE `poll_votes`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `posts`
--
ALTER TABLE `posts`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `post_images`
--
ALTER TABLE `post_images`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `reading_lists`
--
ALTER TABLE `reading_lists`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `rss_feeds`
--
ALTER TABLE `rss_feeds`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `settings`
--
ALTER TABLE `settings`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `tags`
--
ALTER TABLE `tags`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `users`
--
ALTER TABLE `users`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `visual_settings`
--
ALTER TABLE `visual_settings`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `widgets`
--
ALTER TABLE `widgets`
  ADD PRIMARY KEY (`id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `ad_spaces`
--
ALTER TABLE `ad_spaces`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=20;

--
-- AUTO_INCREMENT for table `audios`
--
ALTER TABLE `audios`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `categories`
--
ALTER TABLE `categories`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT for table `comments`
--
ALTER TABLE `comments`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `comment_likes`
--
ALTER TABLE `comment_likes`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `contacts`
--
ALTER TABLE `contacts`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `gallery`
--
ALTER TABLE `gallery`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `gallery_categories`
--
ALTER TABLE `gallery_categories`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `newsletters`
--
ALTER TABLE `newsletters`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `pages`
--
ALTER TABLE `pages`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=14;

--
-- AUTO_INCREMENT for table `polls`
--
ALTER TABLE `polls`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `poll_votes`
--
ALTER TABLE `poll_votes`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `posts`
--
ALTER TABLE `posts`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT for table `post_images`
--
ALTER TABLE `post_images`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- AUTO_INCREMENT for table `reading_lists`
--
ALTER TABLE `reading_lists`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `rss_feeds`
--
ALTER TABLE `rss_feeds`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `settings`
--
ALTER TABLE `settings`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT for table `tags`
--
ALTER TABLE `tags`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT for table `users`
--
ALTER TABLE `users`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT for table `visual_settings`
--
ALTER TABLE `visual_settings`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT for table `widgets`
--
ALTER TABLE `widgets`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=7;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
