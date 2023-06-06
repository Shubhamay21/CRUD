<?php 
include_once('db_conn.php');
$id = $_GET['edit_id'];
$sql = "SELECT * FROM student_table where id='".$id."'";
$result = mysqli_query($conn,$sql);
$data=mysqli_fetch_array($result);
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <style>
        img{
            width: 100px;
        }
        </style>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
    <link rel="stylesheet" href="css/bootstrap.css">
    <link rel="stylesheet" href="css/style.css">
</head>
<body>
<div class="container mt-5">
    <h1 class="alert-info text-center mb-5 p-3">CRUD In PHP</h1>
        <div class="row">    
                    <form class="col-sm-10" enctype="multipart/form-data" method="POST" id="myform">
                        <h3 class="alert-warning text-center p-2">Edit</h3>
                        <div class="form-group">
                            <!-- <input type="hidden" id="postid" value="<?php echo $_GET['edit_id'];?>"> -->
                            <label for="nameid">Name</label>
                            <input type="text" class="form-control" name="name" id="nameid" value="<?php echo $data['name'];?>" />
                        </div>    
                        <div class="form-group">
                            <label for="emailid">Email</label>
                            <input type="email" class="form-control" name="email" id="emailid" value="<?php echo $data['email'];?>" />
                        </div>
                        <div class="form-group mb-3">
                            <label for="passwordid">Password</label>
                            <input type="password" class="form-control"  name="password" id="passwordid" value="<?php echo $data['password'];?>" >
                        </div> 
                     
                        <div class="form-group mb-3">
                            <label for="images">Images 
                            <div> 
                                <td class="mb-7 mt-2"><img src="./image/<?php echo $data['images'];?>" style="margin-bottom:10px;"></td>
                                <span><?php echo $data['images'];?></span>
                            </div>
                            </label>
                            <input type="file" class="form-control" name="uploadfile" value="" />
                        </div>
                        <input type="hidden" name="id" value="<?php echo $id; ?>"/>               
                        <button type="submit" id="btnadd" name="update" class="btn btn-primary mb-5">Submit</button>
                    </form>

</div>

</body>
<script src="js/bootstrap.js"></script>
<script src="js/jquery.js"></script>
</html>

<?php
if (isset($_POST['update'])) {
    $id = $_POST['id'];
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
mysqli_query($conn, "UPDATE student_table SET name='$name', email='$email', password='$password' WHERE id=$id");
if(move_uploaded_file($tempname, $folder)){
    mysqli_query($conn, "UPDATE student_table SET name='$name', email='$email', password='$password',images='$filename' WHERE id=$id");
	    $msg = "Image uploaded successfully";
       header('location: index.php');
    }else{
    mysqli_query($conn, "SELECT name,email,password,images FROM student_table WHERE id=$id");
 	header('location: index.php');
    }
}
?>
