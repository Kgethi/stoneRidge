<?php 
session_start();
$pageName = "Home";
$today = date('Y-m-d');
$bookings = "";

include('includes/dbconn.php');

$sql = "SELECT * FROM stoneridgebookings WHERE dateCreated = '".$today."' ORDER BY timeIn";

$result = mysqli_query($conn,$sql);

if(mysqli_num_rows($result) > 0){

    while($row = $result->fetch_assoc()){

        $bookings .= '
        
        <div class="p-4">

                        <div class="row no-gutters">

                            <div class="col-lg-4">

                                <p class=" text-center mb-0">Booked</p>

                            </div>

                            <div class="col-lg-4">

                                <p class=" text-center mb-0">'.$row['timeIn'].' - '.$row['timeOut'].'</p>

                            </div>

                            <div class="col-lg-4">

                                <p class=" text-center mb-0">'.$row['facilityUsed'].'</p>

                            </div>

                        </div>

                    </div>
        ';

    }
}




include('includes/head.php');

?>

<body>



    <div class="container-fluid p-0">


        <div class="row no-gutters">
            <!-- <div class="col-lg-12">
                <lottie-player src="https://assets7.lottiefiles.com/packages/lf20_xYa95s.json" background="transparent"
                    speed="0.5" style="width: 1920px; height: 300px;" loop autoplay></lottie-player>

            </div> -->
            <div class="col-lg-3">

                <?php include('includes/header.php'); ?>

            </div>

            <div class="col-lg-9">

                <div class="container">

                    <div class="row">

                        <div class="col-lg-12">

                            <h1><?php echo $pageName ?></h1>
                        </div>

                        <div class="col-lg-8 offset-lg-2 mb-4">


                            <div class="py-4 rounded bg-light shadow">


                                <h2 class="text-center"><?php echo date("F j"); ?></h2>


                            </div>



                        </div>

                    </div>

                </div>


                <div class="container">

                    <div class="row no-gutters">

                        <div class="col-lg-8 offset-lg-2">
                            <div class="bookings-table">



                                <?php echo $bookings ?>



                            </div>


                        </div>

                    </div>


                </div>

            </div>

        </div>

    </div>

</body>

<?php include('includes/footer.php');?>