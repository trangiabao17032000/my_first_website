<?php
  session_start();
  require_once "account.php";
  $content = "";
  $content1 = "";



  if (isset($_POST["email"]) && $_POST['email'] != ""){
      $conn = new mysqli(HOST,USER,PASS,DB);
      if ($conn -> connect_error === true){
          echo 'the error is: '.$conn -> connect_error; # cancel execute when error take placeee.
      }else{
    
          // echo "mat troi chan li troi qua tim".$name;
          $sql = "select * from accounts";
          $result = $conn -> query($sql);

            if ($result->num_rows > 0) {

              while($data = $result -> fetch_assoc()){
            

                if ($_POST["email"] == $data["email"]){
                  $content = "";
                  $_SESSION["email"] = $_POST["email"];
                  require_once "sendCode.php";
                  header("Location: http://localhost:8888/sendCodePage.php");
                     // cancel loop if valid
               
                  // header("Location: http://localhost:8888/banoi.php/");
                }else{
                  $content = "email chưa đăng ký";  // i put this code here, loop in while is fast and $content alway change its value, so html browser only load the last value
                }
              
              }
           
                 
                
              

            }

          }
          
  }
  



?>

<!DOCTYPE html>
<html lang="en">
<head>
  <title>trang nhập email</title>
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
      <h4 class="card-title">Nhập gmail để xác thực bạn nhé !</h4>
      <div class="form-group">
         <form action = "#"  method="post">
    	  
    		   <input name = "email" placeholder="ví dụ: sunset@gmail.com" type="email" class="form-control">  
  		 
           <button type="submit" class="btn btn-primary">Xác nhận</button>
          </form>
       </div>
    </div>
  </div>
  <p></p>
   <p style = "text-align:center;color: red;font-weight: bold;"><?= $content; ?> </p>
   <p style = "text-align:center;color: red;font-weight: bold;"><?= $content1; ?> </p>
</div>
  <br>

  


</body>
</html>