<?php

header("Access-Control-Allow-Origin: *");
header("Access-Control-Allow-Methods: PUT, GET, POST");
header("Access-Control-Allow-Headers: Origin, X-Requested-With, Content-Type, Accept");
header("Content-type: application/json");

if($_FILES){
    // Image upload code
    $file = $_FILES['file'];
    $fileName = $_FILES['file']['name'];
    $fileTmpName = $_FILES['file']['tmp_name'];
    $fileSize = $_FILES['file']['size'];
    $fileError = $_FILES['file']['error'];
    $fileType = $_FILES['file']['type'];

    $fileExt = explode('.', $fileName);
    $fileActualExt = strtolower(end($fileExt));

    $allowed = array('jpg', 'JPG', 'jpeg', 'JPEG', 'png', 'PNG', 'gif', 'GIF');
    if (in_array($fileActualExt, $allowed)) {
        if ($fileError === 0) {
            if ($fileSize < 15 * 1024 * 1024) {
                $fileNameNew = uniqid('', true) . "." . $fileActualExt;
                $fileDestination = 'upload/' . $fileNameNew;
                move_uploaded_file($fileTmpName, $fileDestination);
                
                echo '{
                    "status": "success",
                    "response": "'.$fileDestination.'"
                }';

            } else {
                echo '{
                    "status": "failed",
                    "response": "Your file is too big!"
                }';
            }
        } else {
            echo '{
                "status": "failed",
                "response": "There is an error uploading your file!",
                "error": "'.$fileError.'"
            }';
        }
    } else {
        echo '{
            "status": "failed",
            "response": "File type error!"
        }';
    }
    // Image upload code end
} else {
    echo '{
        "status": "failed",
        "response": "Error in getting file"
    }';
}
?>