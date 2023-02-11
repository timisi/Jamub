<?php
$conn =mysqli_connect("localhost", "root", "", "users");
if(!$conn){
    echo "<h3 class='container bg-dark text-center p-3 text-warning rounded-lg mt-5'>
    Not able to establish Database Connection</h3>";
}

$sql = "SELECT * FROM data";
$query = mysqli_query($conn, $sql);

if(isset($_REQUEST["new_post"])){
    $title = $_REQUEST["title"];
    $content = $_REQUEST["content"];
    $img = $_REQUEST["img"];
    
    $sql = "INSERT INTO data (title, content, img) VALUES ('$title', '$content', $img)"; 
    mysqli_query($conn, $sql);

    header("Location: createblog.php?info=added");
    exit();
}

?>