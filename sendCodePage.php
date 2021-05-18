<?php
  
  require_once "account.php";
  $content = "Lưu ý: Mã xác thực tồn tại trong 1 phút";
  $content1 = "Mã xác thực đã được gửi, vui lòng kiểm tra trong email";


  if(isset($_COOKIE['randomNumber'])){
    if(isset($_GET["page"]) && $_GET["page"] == "authentication" ){

       if (isset($_POST["code"]) && $_POST['code'] != "" ){
      
           if ($_COOKIE["randomNumber"] == $_POST['code'] )
                header("Location: http://localhost:8888/updatePasswordPage.php/");
            $content1 = "bạn nhập mã code không đúng!";
          }else{
            $content1 = "bạn chưa nhập mã code !";
           }
   

    }
      
  }else{
    $content1 = "Mã xác thực đã hết hạn, xin vui lòng gửi lại";
  
    header("Location: http://localhost:8888/gmailAuthentication.php");
  }



 
  
  



?>

<!DOCTYPE html>
<html lang="en">
<head>
  <title>trang xác thực mã</title>
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
      <h4 class="card-title">Nhập mã code để xác thực bạn nhé !</h4>
      <div class="form-group">
         <form action = "?page=authentication"  method="post">
    	  
    		   <input name = "code" placeholder="ví dụ: 7777" type="text" class="form-control">  
  		 
           <button type="submit" class="btn btn-primary">Xác thực</button>
          </form>
       </div>
    </div>
  </div>
  <p></p>
   <p style = "text-align:center;color: red;font-weight: bold;"><?= $content; ?> </p>
   <p id ="content1" style = "text-align:center;color: red;font-weight: bold;"><?= $content1; ?> </p>
   <p style = "text-align: center; font-size: 60px; margin-top: 2px;" id="countDown"></p>
   <p id ="insert"></p>
</div>
  <br>



  <script>
    
    var something = document.getElementById('content1').textContent;
    // var n = something.localeCompare("Mã xác thực đã hết hạn, xin vui lòng gửi lại ");
    // document.getElementById('insert').innerHTML = n;                                     //NODE: textContent return value that its value has blank in its last.
    if (something.localeCompare("Mã xác thực đã hết hạn, xin vui lòng gửi lại ") != 0){
        var seconds = 60;

        // Update the count down every 1 second
         var x = setInterval(function() {


        seconds = seconds - 1;
        

       document.getElementById("countDown").innerHTML = seconds + "s ";
        
       // If the count down is over, write some text 
        if (seconds < 0) {
            clearInterval(x);
            document.getElementById("countDown").innerHTML = "";
            window.location.replace("http://localhost:8888/gmailAuthentication.php");
        }
        }, 1000);
    }

    
</script>

  


</body>
</html>