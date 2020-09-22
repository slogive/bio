<?php require("php/data.php") ?>
<?php require("php/connect-signin.php") ?>

<!DOCTYPE html>
<html>
    <head><?php echo $metadata ?></head>
    <body>
        <div class="Site-Container">
            <div class="Login-Container">
                <form class="Login-Form" action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]); ?>" method="POST">

                    <div class="Form-Container-Logo"></div>

                    <input id="user" type="text" placeholder="Username" name="username" value="<?php if(isset($_POST['username'])) echo $_POST['username']; ?>" require>
                    <span class="Login-Form-Error"><?php echo $username_error ?></span>
                    <span class="Login-Form-Error"><?php echo $email_error_failure ?></span>

                    <input id="email" type="email" placeholder="Email" name="email" value="<?php if(isset($_POST['email'])) echo $_POST['email']; ?>" require>
                    <span class="Login-Form-Error"><?php echo $email_error ?></span>
                    <span class="Login-Form-Error"><?php echo $email_error_failure ?></span>

                    <input id="pass" type="password" placeholder="Password" name="pass" value="<?php if(isset($_POST['pass'])) echo $_POST['pass']; ?>" require>
                    <span class="Login-Form-Error"><?php echo $pass_error ?></span>
                    <span class="Login-Form-Error"><?php echo $pass_error_failure ?></span>

                    <!--<input id="passconfirm" type="password" placeholder="Confirm Password">-->

                    <input type="submit" value="Sign in">

                </form>
            </div>
        </div>
    </body>
</html>