<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@4.3.1/dist/css/bootstrap.min.css" integrity="sha384-ggOyR0iXCbMQv3Xipma34MD+dH/1fQ784/j6cY/iJTQUOhcWr7x9JvoRxT2MZw1T" crossorigin="anonymous">
    <script src="https://code.jquery.com/jquery-3.3.1.slim.min.js" integrity="sha384-q8i/X+965DzO0rT7abK41JStQIAqVgRVzpbzo5smXKp4YfRvH+8abtTE1Pi6jizo" crossorigin="anonymous"></script>
    <script src="https://cdn.jsdelivr.net/npm/popper.js@1.14.7/dist/umd/popper.min.js" integrity="sha384-UO2eT0CpHqdSJQ6hJty5KVphtPhzWj9WO1clHTMGa3JDZwrnQq4sF86dIHNDz0W1" crossorigin="anonymous"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@4.3.1/dist/js/bootstrap.min.js" integrity="sha384-JjSmVgyd0p3pXB1rRibZUAYoIIy6OrQ6VrjIEaFf/nJGzIxFDsf4x0xIM+B07jRM" crossorigin="anonymous"></script>
    <title>Resigtration</title>
</head>

<body>
    <div class="container" style="width:50% ;margin-top:2em;">
        <h2>Registration</h2>
        <?php
        require('connectDB.php');
        ini_set('display_errors', 0);
        $error = array();

        // When form submitted, insert values into the database.
        if (isset($_REQUEST['username'])) {
            // removes backslashes
            $username = stripslashes($_REQUEST['username']);
            //escapes special characters in a string
            $username = mysqli_real_escape_string($conn, $username);

            $password = stripslashes($_REQUEST['password']);
            $password = mysqli_real_escape_string($conn, $password);

            $fullname = stripslashes($_REQUEST['fullname']);
            $fullname = mysqli_real_escape_string($conn, $fullname);

            $email = stripslashes($_REQUEST['email']);
            $email = mysqli_real_escape_string($conn, $email);

            $birthday = $_REQUEST['birthday'];

            $gender = $_REQUEST['gender'];

            $checkUser = mysqli_query($conn, "SELECT * FROM user_info WHERE username='$username'");

            if (mysqli_num_rows($checkUser) == 1) {
                $error['usernameExist'] = "Username is available";
                echo "
                    <div>
                    <h3>Username available</h3><br/>
                    <p class='link'>Click here to <a href='registration.php'>registration</a> again.</p>
                    </div>";
            } elseif (!$username || !$password || !$fullname || !$email || !$birthday || !$gender) {
                echo "<div>
                  <h3>Please fill all fields!</h3><br/>
                  </div>";
            } else {

                $query = "INSERT into user_info (username, password, fullname, email, birthday, gender)
                        VALUES ('$username', '" . md5($password) . "', '$fullname', '$email', '$birthday', '$gender')";

                $result   = mysqli_query($conn, $query) or die(mysqli_error($conn));

                if ($result) {
                    echo "<div>
                    <h3>You are registered successfully.</h3><br/>
                    <p class='link'>Click here to <a href='login.php'>Login</a></p>
                    </div>";
                }
            }
        }
        ?>


        <form action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]); ?>" method="POST" style="width:50%" class="form-outline">
            <label for="username">Username</label>
            <input type="text" name="username" class="form-control" value="<?php echo $username; ?>">

            <label for="password">Password</label>
            <input type="password" name="password" class="form-control" value="<?php echo $password; ?>">

            <label for="fullname">Fullname</label>
            <input type="text" name="fullname" class="form-control" value="<?php echo $fullname; ?>">

            <label for="">Email</label>
            <input type="email" name="email" class="form-control" value="<?php echo $email; ?>">

            <label for="birthday">Date of birth</label>
            <input type="date" name="birthday" class="form-control" value="<?php echo $birthday; ?>">

            <label for=" gender">Gender</label>
            <select name="gender" class="form-control" style="width:30%">
                <option value="male">Male</option>
                <option value="female">Female</option>
                <option value="other">Other</option>
            </select>
            <input class="btn btn-primary" style="margin:10px 0 10px 0" name="submit" type="submit" value="Registration" />
        </form>
        <span>Already have an account? <a href="index.php">Login here</a></span>
    </div>

</body>

</html>