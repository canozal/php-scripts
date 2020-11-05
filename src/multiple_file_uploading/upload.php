<?php

if (!empty($_FILES['files']['name'][0])) {

    $files = $_FILES['files'];

    $uploaded = array();
    $failed = array();

    $allowed = array('txt', 'jpg', 'png', 'jpeg');

    foreach ($files['name'] as $postion => $file_name) {

        $file_tmp = $files['tmp_name'][$postion];
        $file_size = $files['size'][$postion];
        $file_error = $files['error'][$postion];

        $file_array = explode('.', $file_name);
        $file_ext = strtolower(end($file_array));


        if (in_array($file_ext, $allowed)){

            if ($file_error === 0){

                if ($file_size <= 2097152){

                    $file_name_new =  $file_array. uniqid('', true) . '.' . $file_ext;
                    $file_destination = 'uploads/' . $file_name_new;

                    if (move_uploaded_file($file_tmp, $file_destination)){
                        $uploaded[$postion] = $file_destination;
                    } else {
                        $failed[$postion] = "[{$file_name} failed to uploads]";
                    }

                } else {
                    $failed[$postion] = "[{$file_name}] is too large.";
                }

            } else {
                $failed[$postion] = "[{$file_name}] errored with code {$file_error}";
            }

        } else {
            $failed[$postion] = "[{$file_name}] file extension '{$file_ext}' is not allowed";
        }

    }

    if (!empty($uploaded)){
        print_r($uploaded);
    }

    if (!empty($failed)){
        print_r($failed);
    }
}