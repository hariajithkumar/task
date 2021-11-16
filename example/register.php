<?php
include "./db/dbconfic.php";
$get_users=mysqli_query($con,"SELECT * FROM `ex`");
?>
<!DOCTYPE html>
<html>
<head>
 <link href="//netdna.bootstrapcdn.com/bootstrap/3.1.0/css/bootstrap.min.css" rel="stylesheet" id="bootstrap-css">
  <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
  <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.16.0/umd/popper.min.js"></script>
  <script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>
  
    <title></title>
    <style type="text/css">
     body{
    /*background-color: #525252;*/
}
.centered-form{
    margin-top: 60px;
}

.centered-form .panel{
    background: rgba(255, 255, 255, 0.8);
    box-shadow: rgba(0, 0, 0, 0.3) 20px 20px 20px;
}
    </style>
</head>
<body>

   

<!------ Include the above in your HEAD tag ---------->

<div class="container">
        <div class="row centered-form">
        <div class="col-xs-12 col-sm-8 col-md-4 col-sm-offset-2 col-md-offset-4">
            <div class="panel panel-default">
                <div class="panel-heading">
                        <h3 class="panel-title">student register form </h3>
                        </div>
                        <div class="panel-body">
                        <form method="POST" action="">
                            <div class="row">
                                <div class="col-xs-6 col-sm-6 col-md-6">
                                    <div class="form-group">
                                        <input type="hidden" name="id" id="id">
                            <input type="text" name="first_name" id="first_name" class="form-control input-sm" placeholder="First Name">
                                    </div>
                                </div>
                                <div class="col-xs-6 col-sm-6 col-md-6">
                                    <div class="form-group">
                                        <input type="text" name="last_name" id="last_name" class="form-control input-sm" placeholder="Last Name">
                                    </div>
                                </div>
                            </div>

                            <div class="form-group">
                                <input type="email" name="email" id="email" class="form-control input-sm" placeholder="Email Address">
                         <!--  <?php

$con=mysqli_connect("localhost","root","","facebook");

?>  </div> -->

                            <div class="row">
                                <div class="col-xs-6 col-sm-6 col-md-6">
                                    <div class="form-group">
                                        <input type="text" name="password" id="password" class="form-control input-sm" placeholder="Password">
                                    </div>
                                </div>
                                <div class="col-xs-6 col-sm-6 col-md-6">
                                    <div class="form-group">
                                        <input type="password" name="password_confirmation" id="password_confirmation" class="form-control input-sm" placeholder="Confirm Password">
                                    </div>
                                </div>
                            </div>
                            
                            <button type="button" value="Register" class="btn btn-info btn-block" id="clk">Register</button>
                        
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>

<table style="width:100%" border="1">
  <thead>
    <th>id</th>
    <th>firstname</th> 
    <th>lastname</th> 
    <th>email</th> 
    <th>password</th>
    <th>confirmpassword</th>
    <th colspan="2">action</th>

  </thead>
  <tbody>
<?php
while($row=mysqli_fetch_assoc($get_users)){
    ?>
    <tr>
    <td><?php echo $row['id'];?></td>
    <td><?php echo $row['firstname'];?></td>
    <td><?php echo $row['lastname'];?></td>
    <td><?php echo $row['email'];?></td>
    <td><?php echo $row['password'];?></td>
    <td><?php echo $row['confirmpassword'];?></td>
    <td>
      <a class="edit" id="<?php echo $row['id']?>">edit</a>
    </td>
    <td>
      <a class="delete" id="<?php echo $row['id']?>">delete</a>
    </td>
  </tr>
  <?php
}?>
</tbody>
</table>





</body>

 <script>
    $(document).ready(function() {
    $('#clk').on('click', function() {
    // $("#clk").attr("disabled", "disabled");
     var id=$('#id').val();
     var fname=$('#first_name').val();
     var lname=$('#last_name').val();
     var email=$('#email').val();
     var pass=$('#password').val();
     var conp=$('#password_confirmation').val();
     if(fname!="" && lname!="" && email!="" && pass!="" && conp!=""){
        $.ajax({
            url:"./server/cms.php?action=save",
            type:"POST",
            data:{
                id:id,
                fname:fname,
                lname:lname,
                email:email,
                pass:pass,
                conp:conp,
            },
          success: function(dataResult){
            console.log(dataResult)
                    alert(dataResult);
                    location.reload();

     }
 })
}
})
     $('.edit').on('click', function() {

        var id=$(this).attr('id')
        $.ajax({
            url:"./server/cms.php?action=edit",
            type:"POST",
            data:{
                id:id,
            },
          success: function(response){
            var res=JSON.parse(response)
            $("#id").val(res.id)
             $("#first_name").val(res.firstname)
              $("#last_name").val(res.lastname)
               $("#email").val(res.email)
                $("#password").val(res.password)
                 $("#password_confirmation").val(res.confirmpassword)
          }
     })
    })


     $('.delete').on('click', function() {

        var id=$(this).attr('id')
        $.ajax({
            url:"./server/cms.php?action=delete",
            type:"POST",
            data:{
                id:id,
            },
          success: function(response){
            alert(response)
            location.reload();
          }
     })
    })
})
 </script>
</html>


