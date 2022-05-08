<?php
session_start();
$pageName = "Login";


$Errorusername = "";
$Errorpassword = "";
$validMessage = "";

if (isset($_POST['submit'])) {

    $usernameForm = $_POST['username'];
    $passwordForm = $_POST['password'];


    include('includes/dbconn.php');
    $sql = "select * from stoneRidgeUsers where username = '$usernameForm' and userPassword = PASSWORD('$passwordForm')";

    $result = $conn->query($sql);

    if ($result->num_rows > 0) {




        $validMessage = "<p class = 'validText'>You have logeed in</p>";
        $_SESSION['loggedin'] = true;
        $_SESSION['username'] = $username;
        $_SESSION['name'] = $row['firstName'] . " " . $row['lastName'];

        header("Location: book.php");
        die();
    } else {

        $validMessage = "<p class = 'invalidText'>You have entered the incorrect password or username</p>";
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



                                <form action="login.php" method="post">

                                    <div class="form-group">
                                        <label for="username">Username</label>
                                        <input type="text" id="username" name="username" class="form-control <?php if (!empty($Errorusername)) {
                                                                                                                    echo "errStyle";
                                                                                                                } ?>" placeholder="Enter username">

                                        <span class="errText"><?php echo $Errorusername; ?></span>
                                    </div>



                                    <div class="form-group">
                                        <label for="password">Password</label>
                                        <input type="password" id="password" value="" name="password" class="form-control <?php if (!empty($Errorpassword)) {
                                                                                                                                echo "errStyle";
                                                                                                                            } ?>" placeholder="Password" autofill="off">
                                        <span class="errText"><?php echo $Errorpassword; ?></span>
                                    </div>

                                    <button type="submit" name="submit" class="btn btn-primary">Submit</button>
                                </form>

                            </div>



                        </div>
                    </div>
                </div>


            </div>
        </div>
    </div>


</body>

<?php include('includes/footer.php'); ?>