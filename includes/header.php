<!DOCTYPE html>
<html lang="en">




<header>

    <nav class="navbar navbar-expand-lg navbar-light bg-dark">
        <div class="mb-4">

            <a class="navbar-brand" href="index.php">Euria Country Estate</a>
        </div>

        <small>Welcome home.</small>
        <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarNavAltMarkup"
            aria-controls="navbarNavAltMarkup" aria-expanded="false" aria-label="Toggle navigation">
            <span class="navbar-toggler-icon"></span>
        </button>
        <div class="collapse navbar-collapse" id="navbarNavAltMarkup">
            <div class="navbar-nav">
                <a class="nav-item nav-link active" href="index.php" id="Home">Home</a>
                <?php if(isset($_SESSION['loggedin']) && $_SESSION['loggedin'] == true) {

echo '<a class="nav-item nav-link" href="logout.php" id ="Logout">Logout</a> <a class="nav-item nav-link" href="book.php" id ="Book">Book session</a>';
               }
               
               else{

                echo '<a class="nav-item nav-link" href="login.php" id ="Login">Login</a> <a class="nav-item nav-link" href="register.php" id = "Register">Register</a>';
               }?>



            </div>
        </div>
    </nav>
</header>