<?php


function imagecopymerge_alpha($dst_im, $src_im, $dst_x, $dst_y, $src_x, $src_y, $src_w, $src_h, $pct){
    // creating a cut resource
    $cut = imagecreatetruecolor($src_w, $src_h);

    // copying relevant section from background to the cut resource
    imagecopy($cut, $dst_im, 0, 0, $dst_x, $dst_y, $src_w, $src_h);

    // copying relevant section from watermark to the cut resource
    imagecopy($cut, $src_im, 0, 0, $src_x, $src_y, $src_w, $src_h);

    // insert cut resource to destination image
    imagecopymerge($dst_im, $cut, $dst_x, $dst_y, 0, 0, $src_w, $src_h, $pct);
}


function merge_image($file)
{

    $dest = '1152x807.png';
    $src = $file['name'];

    $dest = imagecreatefromstring(file_get_contents($dest));
    $src = imagecreatefromstring(file_get_contents($file['tmp_name']));


    list($width, $height) = getimagesize($file['tmp_name']);

    $imgy = (807 - $height) / 2;
    $imgx = (1152 - $width) / 2;


    imagecopymerge_alpha($dest, $src, $imgx, $imgy, 0, 0, $width, $height, 100); //have to play with these numbers for it to work for you, etc.


    header('Content-Type: image/png');
    imagepng($dest, 'uploads/' . uniqid('', true) . "." . "png");
    imagepng($dest);


}


if ($_SERVER['REQUEST_METHOD'] == "POST") {

    if (isset($_FILES['image'])) {

        $file = $_FILES['image'];

        merge_image($file);

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