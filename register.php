<?php 
include 'app/auth/authentication.php';
include "includes/header.php";
?>

    <div class="header">
        <h2>Registration To Our Library</h2>
    </div>

    <div class="container" id="content">
        <?php  if (count($errors) > 0) : ?>
            <div class="error">
                <?php foreach ($errors as $error) : ?>
                <p><?php echo $error ?></p>
                <?php endforeach ?>
            </div>
        <?php  endif ?>

        <div class="form-head">
            <h2>Registration</h2>
        </div>
        <form action="register.php" method="post">
            <div class="input-group">
                <label for="firstname" required>Enter Firstname: </label>
                <input class="input form-control" value="<?php echo $firstname; ?>" type="text" name="firstname">
            </div>
            <div class="input-group">
                <label for="lastname">Enter Lastname: </label>
                <input class="input form-control" value="<?php echo $lastname; ?>" type="text" name="lastname">
            </div>
            <div class="input-group">
                <label for="username">Enter Username: </label>
                <input class="input form-control" value="<?php echo $username; ?>" type="text" name="username">
            </div>
            <div class="input-group">
                <label for="email">Enter Email: </label>
                <input class="input form-control" value="<?php echo $email; ?>" type="email" name="email">
            </div>
            <div class="input-group">
                <label for="password">Enter Password: </label>
                <input class="input form-control" type="password" name="password">
            </div>
            <div class="input-group">
                <label for="passwordConf">Confirm Password: </label>
                <input class="input form-control" type="password" name="passwordConf">
            </div>

            <input class="btn btn-primary" type="submit" name="submit-reg" value="Sign Up">

            <p>Member already? <a href="login.php">Log In</a></p>
        </form>
    </div>

    <?php include "includes/footer.php"; ?>