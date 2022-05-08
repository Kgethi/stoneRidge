<?php 
session_start();
$pageName = "Register";

//cleaning data
function cleanInput($data){

    $data = trim($data);
    $data = stripslashes($data);
    $data = htmlspecialchars($data);
    return $data;
}


include('includes/dbconn.php');


//declaring form error variables
$ErrorfirstName = "";
$Errorsurname = "";
$Errorusername = "";
$Erroremail = "";
$ErrorcontactNumber = "";
$ErrorstandNumber = "";
$Errorpassword = "";



$validMessage = "";
//form validation
if(isset($_POST['submit'])){

    //declaring variables
    $firstName = cleanInput($_POST['firstName']);
    $surname = cleanInput($_POST['surname']);
    $username = cleanInput($_POST['username']);
    $email = cleanInput($_POST['email']);
    $contactNumber = cleanInput($_POST['contactNumber']);
    $standNumber = cleanInput($_POST['standNumber']);
    $password = cleanInput($_POST['password']);
    $validMessage = "";

$selectUsername = "SELECT * FROM stoneridgeusers WHERE username = '".$username."' ";
$resultUsername = $conn->query($selectUsername);

$selectEmail = "SELECT * FROM stoneridgeusers WHERE email = '".$email."' ";
$resultEmail = $conn->query($selectEmail);


if((empty($firstName) || is_numeric($firstName)) || (empty($surname) || is_numeric($surname)) || (empty($username) || is_numeric($username) || mysqli_num_rows($resultUsername) === 1) || (!filter_var($email, FILTER_VALIDATE_EMAIL) || mysqli_num_rows($resultEmail) === 1) || (empty($contactNumber) || !is_numeric($contactNumber)) || (empty($standNumber) || !is_numeric($standNumber)) || (strlen($password) <= 8 || !preg_match("#[0-9]+#",$password) || !preg_match("#[A-Z]+#",$password) || !preg_match("#[a-z]+#",$password))){
    $validMessage = "<p class = 'invalidText'>Registration invalid.</p>";


    

    


    if(empty($firstName)){
        $ErrorfirstName = "Enter first name";
    }
    else if(is_numeric($firstName)){
        $ErrorfirstName = "First name cannot be numeric";
    }
    


    if(empty($surname)){
        $Errorsurname = "Enter surname";
    }
    else if(is_numeric($surname)){
        $Errorsurname = "Surname cannot be numeric";
    }




    if(empty($username)){
        $Errorusername = "Enter username";
    }
    else if(is_numeric($username)){
        $Errorusername = "Username cannot be numeric";
    }

    else if(mysqli_num_rows($resultUsername) === 1){

        $Errorusername = "This username has been taken";
    }




    if (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
        $Erroremail = "Invalid email format";
      }
    else if(mysqli_num_rows($resultEmail) === 1){

        $Erroremail = "This email address has already been used";
    }




      if(empty($contactNumber)){
        $ErrorcontactNumber = "Enter contact number";
    }
    else if(!is_numeric($contactNumber)){
        $ErrorcontactNumber = "Contact number must be numeric";
    }



    
    if(empty($standNumber)){
        $ErrorstandNumber = "Enter stand number";
    }    
    if(!is_numeric($standNumber)){
        $ErrorstandNumber = "Stand number must be numeric";
    }






    if (strlen($password) <= 8) {
        $Errorpassword = "Your Password Must Contain At Least 8 Characters!";
    }
    elseif(!preg_match("#[0-9]+#",$password)) {
        $Errorpassword = "Your Password Must Contain At Least 1 Number!";
    }
    elseif(!preg_match("#[A-Z]+#",$password)) {
        $Errorpassword = "Your Password Must Contain At Least 1 Capital Letter!";
    }
    elseif(!preg_match("#[a-z]+#",$password)) {
        $Errorpassword = "Your Password Must Contain At Least 1 Lowercase Letter!";
    }


}
else{

$validMessage = "<p class = 'validText'>You have been successfully registered.</p>";
    


    $sql = "INSERT INTO stoneRidgeUsers (ID, firstName, lastName, username, email, contactNumber, standNumber, userPassword) VALUES (NULL,'$firstName','$surname','$username','$email','$contactNumber','$standNumber',PASSWORD('$password'))";

    if( $conn->query($sql) ){

        header("Location: book.php");
        die();
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



                                <form action="register.php" method="post">
                                    <div class="form-group">
                                        <label for="firstName">First name</label>
                                        <input type="text" id="firstName"  value = "<?php echo $firstName?>" name="firstName" class="form-control <?php if(!empty($ErrorfirstName)){
                                    echo "errStyle";
                                    }?>" placeholder="Enter first name">

                                        <span class="errText"><?php echo $ErrorfirstName; ?></span>
                                    </div>



                                    <div class="form-group">
                                        <label for="surname">Surname</label>
                                        <input type="text" id="surname" name="surname"  value = "<?php echo $surname?>"  class="form-control <?php if(!empty($Errorsurname)){
                                    echo "errStyle";
                                    }?>" placeholder="Enter surname">

                                        <span class="errText"><?php echo $Errorsurname; ?></span>
                                    </div>

                                    <div class="form-group">
                                        <label for="username">Username</label>
                                        <input type="text" id="username" name="username"  value = "<?php echo $username?>"  class="form-control <?php if(!empty($Errorusername)){
                                    echo "errStyle";
                                    }?>" placeholder="Enter username">

                                        <span class="errText"><?php echo $Errorusername; ?></span>
                                    </div>

                                    <div class="form-group">
                                        <label for="email">Email address</label>
                                        <input type="email" id="email" name="email"  value = "<?php echo $email?>"  aria-describedby="emailHelp" class="form-control <?php if(!empty($Erroremail)){
                                    echo "errStyle";
                                    }?>" placeholder="Enter email">

                                        <span class="errText"><?php echo $Erroremail; ?></span>
                                    </div>

                                    <div class="form-group">
                                        <label for="contactNumber">Contact number</label>
                                        <input type="text" id="contactNumber" name="contactNumber"  value = "<?php echo $contactNumber?>"  class="form-control <?php if(!empty($ErrorcontactNumber)){
                                    echo "errStyle";
                                    }?>" placeholder="Enter contact number">

                                        <span class="errText"><?php echo $ErrorcontactNumber; ?></span>
                                    </div>

                                    <div class="form-group">
                                        <label for="standNumber">Stand number</label>
                                        <input type="text" id="standNumber" name="standNumber" value = "<?php echo $standNumber?>" class="form-control <?php if(!empty($ErrorstandNumber)){
                                    echo "errStyle";
                                    }?>" placeholder="Enter stand number">

                                        <span class="errText"><?php echo $ErrorstandNumber; ?></span>
                                    </div>

                                    <div class="form-group">
                                        <label for="password">Password</label>
                                        <input type="password" id="password" value="" name="password" class="form-control <?php if(!empty($Errorpassword)){
                                    echo "errStyle";
                                    }?>" placeholder="Password" autofill="off">
                                        <span class="errText"><?php echo $Errorpassword; ?></span>
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