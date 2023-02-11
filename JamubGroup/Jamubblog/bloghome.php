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

    <?php if(isset($_REQUEST['info'])){ ?>
        <?php if($_REQUEST['info'] == "added") { ?>
            <div class="alert alert-success" role="alert"> 
            Post has been added successfully
</div>
<?php } ?>
<?php } ?>

    <div class="text-center">
<a href="createblog.php" class="btn btn-outline-dark">+ Create a new post</a> </div>
</div>

<!-- Bootstrap JS -->
    <script src="https://code.jquery.com/jquery-3.5.1.slim.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/popper.js@1.16.1/dist/umd/popper.min.js"></script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>
</body>
</html>