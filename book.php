<?php 
session_start();
$pageName = "Book";
$validMessage ="";

$ErrorfacilityUsed = "";
$ErrortimeIn = "";
$Errorduration = "";


if(isset($_POST['submit'])){

    $facilityUsed = $_POST['facilityUsed'];
    $timeIn = $_POST['timeIn'];
    $duration = $_POST['duration'];

    if((empty($facilityUsed)) || (empty($timeIn)) || (empty($duration))){

        if(empty($facilityUsed)){
        $ErrorfacilityUsed = "Select a facility";
        }

        if(empty($timeIn)){
            $ErrortimeIn = "Select a time";
        }

        if(empty($duration)){
            $Errorduration = "Select a duration";
        }


    }

    else{

        $timeOut = date('H:i',strtotime($duration,strtotime($timeIn)));
        include('includes/dbconn.php');


        $sql = "INSERT INTO stoneridgebookings(ID, dateCreated, userName, facilityUsed, timeIn, timeOut) VALUES (NULL,current_timestamp,'".$_SESSION['name']."','$facilityUsed','$timeIn','$timeOut')";

        if(mysqli_query($conn,$sql)){

            $validMessage = "<p class = 'validText'>Session has been booked.</p>";
        }

        else{

            echo "Error: " .$sql. "<br>" . $conn->error;
        }
      
    }
    
    

}

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

                        <div class="col-lg-8 offset-lg-2">

                            <?php echo $validMessage ?>
                            <div class="p-4 rounded bg-light shadow">



                                <form action="book.php" method="post">

                                    <div class="form-group">
                                        <label for="facilityUsed">Facility</label>

                                        <select name="facilityUsed" id="facilityUsed" class="form-control">
                                            <option value="" hidden selected>Select facility</option>
                                            <option value=" Gym">Gym</option>
                                            <option value="Squash court">Squash court</option>
                                        </select>


                                        <span class="errText"><?php echo $ErrorfacilityUsed; ?></span>
                                    </div>



                                    <div class="form-group">
                                        <label for="timeIn">Time in</label>
                                        <input type="time" id="timeIn" value="" name="timeIn" class="form-control">
                                        <span class="errText"><?php echo $ErrortimeIn; ?></span>
                                    </div>

                                    <div class="form-group">
                                        <label for="duration">Duration</label>
                                        <select name="duration" id="duration" class="form-control">
                                            <option value="" hidden selected>Select duration</option>
                                            <option value="+30 minutes">30 minutes</option>
                                            <option value="+45 minutes">45 minutes</option>
                                            <option value="+1 hour">1 hour</option>
                                            <option value="+1 hour +15 minutes">1 hour 15 minutes</option>
                                            <option value="+1 hour +30 minutes">1 hour 30 minutes</option>
                                        </select>
                                        <span class="errText"><?php echo $Errorduration; ?></span>
                                    </div>

                                    <button type="submit" class="btn btn-primary" name="submit">Submit</button>
                                </form>

                            </div>



                        </div>

                    </div>

                </div>

            </div>
        </div>

    </div>





</body>

<?php include('includes/footer.php');?>