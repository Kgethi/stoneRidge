<?php 
session_start();
session_destroy();
header('Location:index.php');
$pageName = "Logout";

include('includes/head.php');
?>

<body>
    <div class="container-fluid p-0">


        <div class="row no-gutters">

            <div class="col-lg-3">

                <?php include('includes/header.php'); ?>

            </div>

            <div class="col-lg-9">
                <div class="container">

                    <div class="row">

                        <div class="col-lg-12">

                            <h1><?php echo $pageName ?></h1>
                        </div>
                    </div>
                </div>

            </div>
        </div>
    </div>

</body>

<?php include('includes/footer.php');?>