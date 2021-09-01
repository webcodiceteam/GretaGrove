<?php  





include 'config.php';

?>

<!DOCTYPE html>

<html lang="en">



<head>

    <title>Greta Grove</title>

    <meta charset="utf-8" />

    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no" />

    <link href="https://fonts.googleapis.com/css?family=Karla:400,700&display=swap" rel="stylesheet" />

    <link rel="stylesheet" href="https://cdn.materialdesignicons.com/4.8.95/css/materialdesignicons.min.css" />

    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.4.1/css/bootstrap.min.css" />

    <link rel="stylesheet" href="assets/css/login.css" />

    <style>

    .my_main_con {
        min-height:80vh;
    }

    li.nav-item {

        margin: 18px;

    }



    @media (max-width: 700px) {

        .img-fluid {

            height: 56px !important;

            padding-top: 10px !important;

            width: 241px !important;

            padding-left: 0px !important;

        }



        .btn-dark {

            display: none;

        }



        .navlinks {

            display: block !important;

            color: black !important;

        }



        li.nav-item {

            margin: 1px !important;

        }



        .footer {

            font-size: 14px !important;

        }



        ul.navbar-nav {

            text-align: left !important;

        }

    }

    </style>

</head>



<body>

    <nav class="navbar navbar-expand-lg navbar-light" style="background-color:RGB(200 200 200);">

        <a href="welcome.php">
            <img src="assets/images/logo2.png" style="padding-left: 39px; padding-top: 10px; color:#2b2a28" class="img-fluid" />
        </a>
        <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarNavDropdown"

            aria-controls="navbarNavDropdown" aria-expanded="false" aria-label="Toggle navigation">

            <span class="navbar-toggler-icon"></span>

        </button>

        <div class="collapse navbar-collapse" id="navbarNavDropdown">

            <ul class="navbar-nav text-center ml-5">

                <!-- <li class="nav-item active" style="margin-left:10rem;">

                    <a class="nav-link" href="welcome.php">Home <span class="sr-only">(current)</span></a>

                </li> -->

                <!-- <li class="nav-item active">

                    <a class="nav-link" href="#">About<span class="sr-only">(current)</span></a>

                </li>

                <li class="nav-item active">

                    <a class="nav-link" href="#">Gellary<span class="sr-only">(current)</span></a>

                </li>

                <li class="nav-item active">

                    <a class="nav-link" href="#">Contact Us<span class="sr-only">(current)</span></a>

                </li> -->

                <li class="navlinks" style="display:none;">

                    <a class="nav-link" href="logout.php">Logout<span class="sr-only">(current)</span></a>

                </li>

            </ul>

            <?php if(!isset( $_SESSION["id"])) { ?>

            <button type="button" class="btn btn-dark ml-auto mr-5"

                style="width:160px; height:54px;font-size: 25px;">Login</button>
            <?php }else{ ?>

            <button type="button" class="btn btn-dark ml-auto" style="width:160px; height:54px;font-size: 25px;"><a

                    href="logout.php" style="color:#fff;">Logout</a></button>
<?php } ?>
        </div>



    </nav>