<?php


function resize_image($file, $max_resolution){
    if (file_exists($file)){

        $original_image = imagecreatefromstring(file_get_contents($file));


        //resolution
        $original_width = imagesx($original_image);
        $original_height = imagesy($original_image);


        $ratio = $max_resolution / $original_width;
        $new_width = $max_resolution;
        $new_height = $original_height * $ratio;

        // if that didn't work
        /*if ($new_height > $max_resolution) {
            $ratio = $max_resolution / $original_height;
            $new_height = $max_resolution;
            $new_width = $original_width * $ratio;
        }*/

        if ($original_image) {
            $new_image = imagecreatetruecolor($new_width, $new_height);

            imageAlphaBlending($new_image, false);
            imageSaveAlpha($new_image, true);

            imagecopyresampled($new_image, $original_image, 0, 0, 0, 0, $new_width, $new_height, $original_width, $original_height);

            $uniq_id = uniqid('', true);

            header('Content-Type: image/png');
            imagepng($new_image, $uniq_id . "." . "png");

            return $uniq_id . '.png';
        }

    }
}




