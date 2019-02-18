<?php 
include "app/auth/authentication.php";
include "includes/header.php";
?>

    <div class="header">
        <h2>Login To Our Library</h2>
    </div>

    <div class="container" id="content">

    <?php  if (count($errors) > 0) : ?>
        <div class="error">
            <?php foreach ($errors as $error) : ?>
            <p><?php echo $error; ?></p>
            <?php endforeach ?>
        </div>
    <?php  endif ?>

        <div class="form-head">
            <h2>Login</h2>
        </div>
        <form action="login.php" method="post">
            <div class="input-group">
                <label for="username">Enter Username: </label>
                <input class="input form-control" value="<?php echo $username; ?>" type="text" name="username">
            </div>
            <div class="input-group">
                <label for="password">Enter Password: </label>
                <input class="input form-control" type="password" name="password">
            </div>

            <input class="btn btn-primary" type="submit" name="submit" value="Login">

            <p>Not yet a member? <a href="register.php">Sign Up</a></p>
        </form>
    </div>

    <?php include "includes/footer.php"; ?>