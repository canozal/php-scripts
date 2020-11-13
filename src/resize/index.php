<?php



 function resize_image($file, $max_resolution){
    if (file_exists($file)){

        $original_image = imagecreatefromjpeg($file);

        //resolution
        $original_width = imagesx($original_image);
        $original_height = imagesy($original_image);

        $ratio = $max_resolution / $original_width;
        $new_width = $max_resolution;
        $new_height = $original_height * $ratio;

        // if that didn't work
        if ($new_height > $max_resolution) {
            $ratio = $max_resolution / $original_height;
            $new_height = $max_resolution;
            $new_width = $original_width * $ratio;
        }

        if ($original_image) {
            $new_image = imagecreatetruecolor($new_width, $new_height);
            imagecopyresampled($new_image, $original_image, 0, 0, 0, 0, $new_width, $new_height, $original_width, $original_height);

            imagejpeg($new_image, $file, 90);
        }

    }
 }




if ($_SERVER['REQUEST_METHOD'] == "POST"){

    if (isset($_FILES['image'])){

        move_uploaded_file($_FILES['image']['tmp_name'], $_FILES['image']['name']);

        $file = $_FILES['image']['name'];

        resize_image($file, "500");

        echo "<img src='$file' />";
    }

}




?>


<!doctype html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport"
          content="width=device-width, user-scalable=no, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Document</title>
</head>
<body>

<form method="post" enctype="multipart/form-data">
    <input type="file" name="image"> <br>
    <input type="submit" value="post">
</form>

</body>
</html>