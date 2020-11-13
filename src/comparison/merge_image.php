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






function merge_image($background ,$file, $xPosition, $where)
{


    $dest = $background;
    $src_file = $file;


    $dest = imagecreatefromstring(file_get_contents($dest));
    $src = imagecreatefromstring(file_get_contents($src_file['tmp_name']));



    list($width, $height) = getimagesize($src_file['tmp_name']);



    if ($where == 'left'){
        $imgy = (586 - $height) / 2;
        $imgx = $xPosition;
    } else if ($where == 'right') {
        $imgy = (586 - $height) / 2;
        $imgx = 866 - ($xPosition + $width);
    }




    imagecopymerge_alpha($dest, $src, $imgx, $imgy, 0, 0, $width, $height, 100); //have to play with these numbers for it to work for you, etc.


    $uniq_id = uniqid('', true);

    header('Content-Type: image/png');
    imagepng($dest, 'uploads/' . $uniq_id . "." . "png");



    return $uniq_id . '.png';


}

