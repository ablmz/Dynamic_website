<!doctype html>
<html lang="en">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <meta name="description" content="">
    <meta name="author" content="Mark Otto, Jacob Thornton, and Bootstrap contributors">
    <meta name="generator" content="Jekyll v4.1.1">
    <title>Horizont</title>


    <link rel="stylesheet" href="static/css/style.css">
    <link rel="stylesheet" href="static/css/bootstrap.css">
    <link rel="shortcut icon" href="static/images/logo.png" type="image/x-icon">


    <style>
        .bd-placeholder-img {
            font-size: 1.125rem;
            text-anchor: middle;
            -webkit-user-select: none;
            -moz-user-select: none;
            -ms-user-select: none;
            user-select: none;
        }

        @media (min-width: 768px) {
            .bd-placeholder-img-lg {
                font-size: 3.5rem;
            }
        }
    </style>

</head>
<body>
<header>
    <?php include ("includes/header.php") ?>
</header>

<nav>
    <?php include ("includes/navi.php") ?>
</nav>

<div class="container-fluid">
    <div class="row">
        <nav id="sidebarMenu" class="col-md-3 col-lg-2 d-md-block bg-light sidebar collapse">
            <div class="sidebar-sticky pt-3">
                <?php include("includes/left_side.php") ?>

            </div>
        </nav>

        <main role="main" class="col-md-9 ml-sm-auto col-lg-10 px-md-4">
            <div class="d-flex justify-content-between flex-wrap flex-md-nowrap align-items-center pt-3 pb-2 mb-3 border-bottom">
                <div>
                    <?php include ("includes/right_side.php") ?>
                </div>
            </div>


        </main>

    </div>

</div>
<div class="footer">
    <?php include ("includes/footer.php") ?>
</div>
<script src="static/js/jquery.min.js"></script>
<script src="static/js/bootstrap.min.js"></script>
</body>
</html>
