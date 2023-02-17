<?php
session_start();
error_reporting(0);

$db_config_path = '../application/config/database.php';

require_once('includes/Bcrypt.php');

$cls = new Bcrypt();

if (isset($_POST["btn_install"])) {

    $_SESSION["db_host"] = $_POST['db_host'];
    $_SESSION["db_name"] = $_POST['db_name'];
    $_SESSION["db_user"] = $_POST['db_user'];
    $_SESSION["db_password"] = $_POST['db_password'];


    // Load the classes and create the new objects
    require_once('includes/core_class.php');
    require_once('includes/database_class.php');

    $core = new Core();
    $database = new Database();


    // Validate the post data
    if ($core->validate_post($_POST) == true) {
        // First create the database, then create tables, then write config file
        if ($database->create_database($_POST) == false) {
            $message = $core->show_message('error', "The database could not be created, please check your database credentials!");
        } else if ($database->create_tables($_POST) == false) {
            $message = $core->show_message('error', "The database tables could not be created, please verify your settings.");
        } else if ($core->write_config($_POST) == false) {
            $message = $core->show_message('error', "The database configuration file could not be written, please chmod application/config/database.php file to 777");
        }

        // If no errors, redirect to index
        if (!isset($message)) {
            $redir = ((isset($_SERVER['HTTPS']) && $_SERVER['HTTPS'] == "on") ? "https" : "http");
            $redir .= "://" . $_SERVER['HTTP_HOST'];
            $redir .= str_replace(basename($_SERVER['SCRIPT_NAME']), "", $_SERVER['SCRIPT_NAME']);
            $redir = str_replace('install/', '', $redir);
            header("refresh:10;url=" . $redir);
            $installing = 1;
        }

    } else {
        $message = $core->show_message('error', 'Not all fields have been filled in correctly. The host, username, password, and database name are required.');
    }
}

?>


<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Varient - Installer nulled by prowebber.ru</title>

    <!-- Bootstrap CSS -->
    <link rel="stylesheet" href="../assets/vendor/bootstrap/css/bootstrap.min.css">
    <!-- Font-awesome CSS -->
    <link href="../assets/vendor/font-awesome/css/font-awesome.min.css" rel="stylesheet"/>
    <link rel="stylesheet" href="assets/css/style.css">
</head>
<body>

<div class="container">
    <div class="row">
        <div class="col-md-8 col-sm-12 col-md-offset-2">

            <div class="row">
                <div class="col-sm-12 logo-cnt">
                    <p>
                        <img src="assets/img/logo.png" alt="">
                    </p>
                    <h1>Welcome to the Installer by lykup.com</h1>
                </div>
            </div>

            <div class="row">
                <div class="col-sm-12">

                    <div class="install-box">


                        <div class="steps">
                            <div class="step-progress">
                                <div class="step-progress-line" data-now-value="100" data-number-of-steps="3" style="width: 100%;"></div>
                            </div>
                            <div class="step">
                                <div class="step-icon"><i class="fa fa-code"></i></div>
                                <p>Start</p>
                            </div>
                            <div class="step">
                                <div class="step-icon"><i class="fa fa-folder-open"></i></div>
                                <p>Folder Permissions</p>
                            </div>
                            <div class="step active">
                                <div class="step-icon"><i class="fa fa-database"></i></div>
                                <p>Database</p>
                            </div>
                        </div>

                        <div class="messages">
                            <?php if (isset($message)) { ?>
                                <div class="alert alert-danger">
                                    <strong><?php echo $message; ?></strong>
                                </div>
                            <?php } ?>
                            <?php if (isset($installing)) { ?>
                                <div class="alert alert-success">
                                    <strong>Installing... Please wait!</strong>
                                </div>
                            <?php } ?>
                        </div>

                        <div class="step-contents">
                            <div class="tab-1">
                                <form action="<?php echo $_SERVER['PHP_SELF']; ?>" method="post">
                                    <div class="tab-content">
                                        <div class="tab_1">
                                            <h1 class="step-title">Database</h1>
                                            <div class="form-group">
                                                <label for="email">Host</label>
                                                <input type="text" class="form-control form-input" name="db_host" placeholder="Host"
                                                       value="<?php echo isset($_SESSION["db_host"]) ? $_SESSION["db_host"] : 'localhost'; ?>" required>
                                            </div>
                                            <div class="form-group">
                                                <label for="email">Database Name</label>
                                                <input type="text" class="form-control form-input" name="db_name" placeholder="Database Name" value="<?php echo @$_SESSION["db_name"]; ?>" required>
                                            </div>
                                            <div class="form-group">
                                                <label for="email">Username</label>
                                                <input type="text" class="form-control form-input" name="db_user" placeholder="Username" value="<?php echo @$_SESSION["db_user"]; ?>" required>
                                            </div>
                                            <div class="form-group">
                                                <label for="email">Password</label>
                                                <input type="password" class="form-control form-input" name="db_password" placeholder="Password" value="<?php echo @$_SESSION["db_password"]; ?>">
                                            </div>

                                        </div>
                                    </div>

                                    <div class="buttons">
                                        <a href="folder-permissions.php" class="btn btn-success btn-custom pull-left">Prev</a>
                                        <button type="submit" name="btn_install" class="btn btn-success btn-custom pull-right">Install</button>
                                    </div>
                                </form>
                            </div>
                        </div>


                    </div>
                </div>
            </div>


        </div>


    </div>


</div>

<?php

unset($_SESSION["error"]);
unset($_SESSION["success"]);

?>

</body>
</html>

