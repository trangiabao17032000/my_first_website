<?php
  session_start();
  require_once "account.php";
  $content = "";
  // $_SESSION["email"] = $_POST["email"];
  ;
  if (isset($_SESSION["email"] )){
      if (isset($_GET['page']) && $_GET['page'] == "authentication" ){
          if(isset($_POST['pass1']) && $_POST['pass1'] != "" && isset($_POST['pass2']) && $_POST['pass2'] != ""){
              if($_POST['pass1'] == $_POST['pass2']){
                // setcookie("newpass",$_POST['pass1'],time() +10,"/");
                require_once "updatePassword.php";
                sleep(1.5);
                header("Location: http://localhost:8888/index.php");

              }else{
                $content = "Mật khẩu không trùng khớp bạn ơi";
              }
          }else{
            $content = "Nhập password bạn ơi";
          }
    }
  }
  





 
  
  



?>

<!DOCTYPE html>
<html lang="en">
<head>
  <title>trang làm lại password</title>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.5.0/css/bootstrap.min.css">
  <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
  <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.16.0/umd/popper.min.js"></script>
  <script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.5.0/js/bootstrap.min.js"></script>
</head>
<style type="text/css">
	.center{
		position: fixed;
		top: 12%;
  		left: 37%;
  		width: 25%;
  		height: 80%;
  		/*background-color: green;*/
      /*box-shadow: 10px 10px 5px 5px;*/

	}
	button{
		margin-top: 6%;
		position: relative;
		right: -35%
	}
	.card-title{
		font-size: 100%;
		text-align: center;
	}
  
  .card{
    box-shadow: 5px 5px 5px -2px;
  }
</style>
<body>
 
<div class="container center ">

  <div class="card ">
    <img class="card-img-top" src="https://www.w3schools.com/bootstrap4/img_avatar1.png" alt="Card image" style="width:100%">
    <div class="card-body">
      <h4 class="card-title">Lần sau nhớ mật khẩu bạn nhé !</h4>
      <div class="form-group">
         <form action = "?page=authentication"  method="post">
    	  
    		   Mật khẩu mới<input name = "pass1" placeholder="********" type="password" class="form-control">
           Nhập lại mật khẩu mới<input name = "pass2" placeholder="********" type="password" class="form-control">  
  		 
           <button type="submit" class="btn btn-primary">Xác nhận</button>
          </form>
       </div>
    </div>
  </div>
  <p></p>
   <p style = "text-align:center;color: red;font-weight: bold;"><?= $content; ?> </p>

</div>
  <br>

  


</body>
</html>