<?php
/*
if(isset($_FILES['file']) && (isset($_POST['done']) )) {
$uploadOk = 1;  
$filename = time().'_'.$_FILES['file']['name'];
$arr_file_types = ['image/png', 'image/gif', 'image/jpg', 'image/jpeg'];

// Check if file is a valid image
$check = getimagesize($_FILES['file']['tmp_name']);
if ($check === false) {
    echo "<script>alert('File is not an image.');</script>";
    $uploadOk = 0;
}

// Check if file already exists
if (file_exists($filename)) {
    echo "<script>alert('Sorry, file already exists.');</script>";
    $uploadOk = 0;
}


// Check file size
if ($_FILES['file']['size'] > 500000) {
    echo "<script>alert('Sorry, your file is too large.');</script>";
    $uploadOk = 0;
}

if (!(in_array($_FILES['file']['type'], $arr_file_types))) {
    echo "<script>alert('Sorry, only JPG, JPEG, PNG & GIF files are allowed.');</script>";
    $uploadOk = 0;
    return;
}
  
if (!file_exists('uploads')) {
    mkdir('uploads', 0777);
}
  
if ($uploadOk == 1) {
{
   
    move_uploaded_file($_FILES['file']['tmp_name'], 'uploads/'.$filename)
      echo "<script>window.location.href='bus_page_1.php';</script>";
        echo "<script>alert('The file ". " has been uploaded.');</script>";
        // Insert into database
    
}
  
}

}  */

session_start();

if(isset($_FILES['file'])){
    
$arr_file_types = ['image/png', 'image/gif', 'image/jpg', 'image/jpeg'];
  
if (!(in_array($_FILES['file']['type'], $arr_file_types))) {
    echo "false";
    return;
}
  
if (!file_exists('uploads')) {
    mkdir('uploads', 0777);
}
  
$filename = time().'_'.$_FILES['file']['name'];
$_SESSION["screenshot"] = htmlspecialchars("$filename");
  
move_uploaded_file($_FILES['file']['tmp_name'], 'uploads/'.$filename);
  
echo 'uploads/'.$filename;
die;

}

?>


