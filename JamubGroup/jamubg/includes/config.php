<?php

define('DB_HOST','localhost');
define('DB_USER','jamubgroup_appraisal');
define('DB_PASS','appraisal2022');
define('DB_NAME','jamubgroup_appraisal');

$conn = mysqli_connect('localhost','jamubgroup_appraisal','appraisal2022','jamubgroup_appraisal') or die(mysqli_error());

// Establish database connection.
try
{
$dbh = new PDO("mysql:host=".DB_HOST.";dbname=".DB_NAME,DB_USER, DB_PASS,array(PDO::MYSQL_ATTR_INIT_COMMAND => "SET NAMES 'utf8'"));
}
catch (PDOException $e)
{
exit("Error: " . $e->getMessage());
}

?>
