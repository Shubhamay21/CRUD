<?php
include("db_conn.php");
if(isset($_POST['btnadd']))
{
    $name = $_POST['name'];
    $email = $_POST['email'];
    $password = $_POST['password'];
    $filename = $_FILES['uploadfile']['name'];
    $tempname = $_FILES["uploadfile"]["tmp_name"];  
    $folder = "image/".$filename;
    $imageFileType=pathinfo($folder,PATHINFO_EXTENSION);
//Allow only JPG, JPEG, PNG & GIF etc formats
    if($imageFileType != "jpg" && $imageFileType != "png" && $imageFileType != "jpeg"
    && $imageFileType != "gif" ) {
    $error[] = 'Sorry, only JPG, JPEG, PNG & GIF files are allowed';   
}
    $sql ="INSERT INTO student_table (name,email,password,images) VALUES ('".$name."','".$email."','".$password."','".$filename."')";
    mysqli_query($conn,$sql);
    if (move_uploaded_file($tempname, $folder)) {

        $msg = "Image uploaded successfully";
    }else{

        $msg = "Failed to upload image";

}
$sql = "SELECT * FROM student_table";
$result = mysqli_query($conn, $sql);
    header("location:index.php");
    exit;
}


if(isset($_GET['del_id']))
{
	$id=$_GET['del_id'];
	
	$sql="delete from student_table where id='".$id."'";
	$result=mysqli_query($conn,$sql);
	
	header('location:index.php');
	
}


if(isset($_POST['del_btn_set']))
{
	$del_id = $_POST['del_id'];
	$sql="delete from student_table where id='".$del_id ."'";
	$result=mysqli_query($conn,$sql);
	
}




?>