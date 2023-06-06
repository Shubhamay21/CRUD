<?php
include("db_conn.php");
include('action.php');
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <style>
        img{
            width: 30px;
        }
        </style>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
    <link rel="stylesheet" href="css/bootstrap.css">
    <link rel="stylesheet" href="css/style.css">
    <script src="https://code.jquery.com/jquery-3.6.4.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/sweetalert/2.1.2/sweetalert.min.js"></script>

</head>
<body>
    <div class="container mt-5">
    <h1 class="alert-info text-center mb-5 p-3">CRUD In PHP</h1>
        <div class="row">    
                    <form class="col-sm-5" enctype="multipart/form-data" id="myform" action="" method="POST">
                        <h3 class="alert-warning text-center p-2">Add/Update</h3>
                        <div class="form-group">
                            <label for="nameid">Name</label>
                            <input type="text" class="form-control" id="nameid" name="name" placeholder="Name" required/>
                        </div>    
                        <div class="form-group">
                            <label for="emailid">Email</label>
                            <input type="email" class="form-control" id="emailid" name="email" aria-describedby="emailHelp" placeholder="Enter email" required/>
                        </div>
                        <div class="form-group mb-3">
                            <label for="passwordid">Password</label>
                            <input type="password" class="form-control" name="password" id="passwordid" placeholder="Password" required>
                        </div> 
                        <div class="form-group mb-3">
                            <label for="images">Images</label>
                            <input type="file" class="form-control"  name="uploadfile" value="" required/>
                        </div>
                                      
                        <button type="submit" id="btnadd" name="btnadd" class="btn btn-primary mb-5">Submit</button>
                    </form>
                    <div class="col-sm-7 text-center">
                    <h3 class="alert-warning p-2">Information</h3>
                        <table class="table" id="dtable">
                            
                        <?php
                                $query ="SELECT * FROM student_table";
                                $result = mysqli_query($conn,$query);
                             
                                echo '<tr>
                                    <th>Sr.No</th>
                                    <th>Name</th>
                                    <th>Email</th>
                                    <th>Password</th>
                                    <th>Images</th>
                                    <th>Edit</th>
                                    <th>Delete</th>
                                    </tr>';

                                $i=1;
                          
                        
                                while($data = mysqli_fetch_assoc($result))
                                {            
                                    echo '<tr>
                                     <td>'.$i.'</td>
                                     <td>'.$data['name'].'</td>
                                     <td>'.$data['email'].'</td>
                                     <td>'.$data['password'].'</td>'
                                       ?>
                                       <td><img src="./image/<?php echo $data['images'];?>"></td>
                                       <?php 
                                    echo '<td><a href="edit.php?edit_id='.$data['id'].'">edit</a></td>
                                      <td>
                                      <input type="hidden" class="del_id" value="'.$data['id'].'">
                                      <a href="javascript:void(0)" class="del_btn" >delete</a></td>
                                    </tr>';   
                                    $i++;
                                }
                                ?>
                        </table>
                    </div>      
        </div>
     </div>    
     
     
     
<script type="text/javascript">  
 $(document).ready(function(){
    $(".del_btn").click(function(e){
    e.preventDefault();
    var delete_id = $(this).closest("tr").find('.del_id').val();
    // console.log(delete_id);
   
  
   swal({
        title: "Are you sure you want to delete?",
        icon: "warning",
        buttons: true,
        dangerMode: true,
        })
        .then((willDelete) => {
        if (willDelete) {

            $.ajax({
                type:"POST",
                url:"index.php",
                data:{
                    "del_btn_set": 1,
                    "del_id": delete_id,
                },
                success: function(response)
                {
                    swal("Data Deleted successfully!",{
                        icon: "success",
                        })
                        .then(($result) => {
                            location.reload();
                        });

                }
            });
           
        } 
        });

    });
 });
</script>

</body>
<script src="js/bootstrap.js"></script>
<script src="js/jquery.js"></script>
</html>
