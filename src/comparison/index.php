<?php
include 'resize_image.php';
include 'merge_image.php';


$phone1 = resize_image('phone1.png', 369);
$phone2 = resize_image('phone2.png', 369);



$uniq_id = merge_image('866x586.png', ['tmp_name' => 'uploads/' . $phone1], 38, 'left'); // soldan 38

$uniq_id2 = merge_image('uploads/' . $uniq_id, ['tmp_name' => 'uploads/' . $phone2], 38, 'right'); // sağdan 38


if (file_exists('uploads/' . $phone1)) {
    unlink('uploads/' . $phone1);
} else {
    // File not found.
}

if (file_exists('uploads/' . $phone2)) {
    unlink('uploads/' . $phone2);
} else {
    // File not found.
}

if (file_exists('uploads/' . $uniq_id)) {
    unlink('uploads/' . $uniq_id);
} else {
    // File not found.
}









