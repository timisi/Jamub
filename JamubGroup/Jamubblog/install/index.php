<?php
session_start();
error_reporting(0);

if (!function_exists('curl_init')) {
    die('cURL is not available on your server! Please enable cURL to continue the installation. You can read the documentation for more information.');
}

if (isset($_POST["btn_purchase_code"])) {
    $data = TRUE;

    if ($data->error != "") {
        header("Location: folder-permissions.php");
        exit();
    } else {
        $_SESSION["code"] = $data->code;
        header("Location: folder-permissions.php");
        exit();
    }
}
?>


<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Varient - Installer lykup.com</title>

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
                    <h1>Welcome to the Installer  by lykup.com</h1>
                </div>
            </div>

            <div class="row">
                <div class="col-sm-12">

                    <div class="install-box">


                        <div class="steps">
                            <div class="step-progress">
                                <div class="step-progress-line" data-now-value="33.33" data-number-of-steps="3" style="width: 33.33%;"></div>
                            </div>
                            <div class="step active">
                                <div class="step-icon"><i class="fa fa-code"></i></div>
                                <p>Start</p>
                            </div>
                            <div class="step">
                                <div class="step-icon"><i class="fa fa-folder-open"></i></div>
                                <p>Folder Permissions</p>
                            </div>
                            <div class="step">
                                <div class="step-icon"><i class="fa fa-database"></i></div>
                                <p>Database</p>
                            </div>
                        </div>

                        <div class="messages">
                            <?php if (isset($_SESSION["success"])): ?>
                                <div class="alert alert-success">
                                    <strong><?php echo $_SESSION["success"]; ?></strong>
                                </div>
                            <?php elseif (isset($_SESSION["error"])): ?>
                                <div class="alert alert-danger">
                                    <strong><?php echo $_SESSION["error"]; ?></strong>
                                </div>
                            <?php endif; ?>
                        </div>

                        <div class="step-contents">
                            <div class="tab-1">
                                <form action="<?php echo $_SERVER['PHP_SELF']; ?>" method="post">
                                    <div class="tab-content">
                                        <div class="tab_1">
                                            <h1 class="step-title">Start</h1>
                                            <div class="form-group">
                                                <label for="email">Purchase Code</label>
                                                <input type="text" class="form-control form-input" name="purchase_code" placeholder="Enter prowebber.ru" value="<?php echo @$_SESSION["purchase_code"]; ?>" required>
                                            </div>
                                        </div>
                                    </div>

                                    <div class="tab-footer">
                                        <button type="submit" name="btn_purchase_code" class="btn btn-success btn-custom pull-right">Next</button>
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
