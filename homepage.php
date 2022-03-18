<?php
include("auth_session.php");
?>
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
    <title>Homepage</title>
</head>

<body>
    <div class="container">
        <div class="row">
            <h2 class="col-md-8">Hi <?php echo $_SESSION['username']; ?> !</h2>
            <div class="col-md-4" style="width:10%">
                <a type="button" class="btn btn-danger" href="logout.php">Logout</a>
            </div>
        </div>
        <div>
            <h3>Upload file here</h3>
            <form action="upload.php" method="post" enctype="multipart/form-data">
                <label for="fileUpload">Select file to upload: </label>
                <input type="file" name="fileUpload" class="btn"><br />
                <button type="submit" name="submit" class="btn btn-primary">Upload</button>
            </form>
        </div>
        <div>
            <h3>Uploaded file</h3>
            <?php
            include 'connectDB.php';

            // Get images from the database
            $query = $conn->query("SELECT * FROM user_files ORDER BY filename DESC");

            if ($query->num_rows > 0) {
                while ($row = $query->fetch_assoc()) {
                    $imageURL = $row["filename"];
            ?>
                    <div class="row">
                        <?php
                        $imageData = base64_encode(file_get_contents($imageURL));
                        echo '<img style="width:200px; height:auto" alt=' . $imageURL . ' src="data:image/jpeg;base64,' . $imageData . '">';
                        ?>
                        <!-- <img src="<?php echo $imageURL; ?>" alt="" style="width:200px; height:auto" /> -->

                        <a href="<?php echo "download.php?path=" . $imageURL ?>">Download</a>
                    </div>
                <?php }
            } else { ?>
                <p>No image(s) found...</p>
            <?php } ?>
        </div>
    </div>


</body>

</html>