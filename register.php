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
    <title>Resigter</title>
</head>

<body>
    <div class="container" style="width:50% ;margin-top:2em;">
        <h3>Register your account</h3>
        <form action="process.php" method="POST" style="width:50%" class="form-outline">
            <label for="username">Username</label>
            <input type="text" name="username" class="form-control">
            <label for="password">Password</label>
            <input type="password" name="password" class="form-control">
            <label for="fullname">Fullname</label>
            <input type="text" name="fullname" class="form-control">
            <label for="">Email</label>
            <input type="email" name="email" class="form-control">
            <label for="birthday">Date of birth</label>
            <input type="date" name="birthday" class="form-control">
            <label for="gender">Gender</label>
            <select name="gender" class="form-control" style="width:30%">
                <option value="male">Male</option>
                <option value="female">Female</option>
                <option value="other">Other</option>
            </select>
            <button class="btn btn-primary" style="margin:10px 0 10px 0">Register</button>
        </form>
        <span>Have an account? <a href="index.php">Login</a></span>
    </div>
</body>

</html>