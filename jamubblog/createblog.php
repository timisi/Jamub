<?php

    include "logic.php"
    ?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    
    <!-- Bootstrap CSS -->
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">
    <title>Jamub Blog</title>
</head>
<body>

    <div class="container mt-5">
        <form method="GET">
            <input type="text" name="title" placeholder="Blog Title" class="form-control bg-dark text-white my-3 text-center">
            <textarea name="content" placeholder="Blog Content" class="form-control bg-dark text-white my-3"></textarea>
            <input type="file" name="img" accept="image/*"><p><img id="output" width="200"/></p>
            <button class="btn btn-dark"> Add Post</button>
        </form>
    </div>
    <!-- Bootstrap JS -->
    <script src="https://code.jquery.com/jquery-3.5.1.slim.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/popper.js@1.16.1/dist/umd/popper.min.js"></script> 
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script> 
</body>
</html>