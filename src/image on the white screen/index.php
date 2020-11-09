<?php
include 'resize_image.php';
include 'merge_image.php';



if ($_SERVER['REQUEST_METHOD'] == "POST") {

    if (isset($_FILES['image'])) {


        $file = $_FILES['image'];

        // There should be no extra space on the sides of the product image otherwise text width and height looks bad.
        list($width, $height) = getimagesize($file['tmp_name']); // get the width of product.

        $uniq_id = merge_image('1152x807.png', $file); // merge product to white screen



        // -------------------

        $text = resize_image('bumubumu.png', $width - 15); // resize text according to product width

        merge_image('uploads/' . $uniq_id, ['tmp_name' => $text]); // merge text to prepared background

        if (file_exists('uploads/' . $uniq_id)) {
            unlink('uploads/' . $uniq_id);
        } else {
            // File not found.
        }

        if (file_exists($text)) {
            unlink($text);
        } else {
            // File not found.
        }

        header("Location: index.php?success");
        die();

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
    <link rel="stylesheet" href="style.css">
</head>
<body>


<form method="post" enctype="multipart/form-data">
    <input type="file" name="image">
    <input type="submit" value="post">
</form>

</body>
</html>