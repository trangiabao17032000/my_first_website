<?php
  session_start();
  require_once "account.php";
  // echo $_SESSION["username"];


  $hoten  = "";
  $email = "";
  $ngaysinh = "";
  $diachi =  "";
  $dienthoai = "";
  $gioitinh = "";
  
  if (isset($_SESSION["username"]) && $_SESSION["username"] != "" ){
     


      $conn = new mysqli(HOST,USER,PASS,DB);
      if ($conn -> connect_error === true){
        echo 'the error is: '.$conn -> connect_error; # cancel execute when error take placeee.
      }else{

        $sql = "select * from Persons";
        $result = $conn -> query($sql);
        
        if($result -> num_rows > 0 ){

          while($data = $result -> fetch_assoc()){
             if($data['username'] == $_SESSION["username"]){
                $hoten  = $data['name'];
                $email = $data['email'];
                $ngaysinh = $data['birthday'];
                $diachi =  $data['address'];
                $dienthoai = $data['phone'];
                $gioitinh = $data['sex'];
                break;
             }
        
        
           }
        }  
       }
  }

  if (isset($_GET['page']) && $_GET['page'] == "change" ){
      if (isset($_SESSION["username"]) && $_SESSION["username"] != "" ){
        if (isset($_POST['email']) && isset($_POST['hoten'])  && isset($_POST['ngaysinh'])  && isset($_POST['gioitinh'])  && isset($_POST['diachi'])  && isset($_POST['dienthoai']) ){
            $conn1 = new mysqli(HOST, USER, PASS, DB);
            // Check connection
            if ($conn1->connect_error === true) {
              echo 'the error is: '.$conn -> connect_error;
            }
            $username = $_SESSION["username"];

            $emailPost     = $_POST['email'];
            $hotenPost     = $_POST['hoten'];
            $ngaysinhPost  = $_POST['ngaysinh'];
            $gioitinhPost  = $_POST['gioitinh'];
            $diachiPost    = $_POST['diachi'];
            $dienthoaiPost = $_POST['dienthoai'];

            $sql1 = "UPDATE accounts SET email = '$emailPost' WHERE username= '$username' ";
            $sql2 = "UPDATE Persons SET email = '$emailPost', name = '$hotenPost', sex = '$gioitinhPost', address = '$diachiPost', phone = '$dienthoaiPost', birthday ='$ngaysinhPost'  WHERE username= '$username' ";

            if ($conn1->query($sql1) === TRUE) {
              $content = "Đã cập nhật password rồi nha";
            } else {
              $content = "Error updating record: " . $conn->error;
            }
             if ($conn1->query($sql2) === TRUE) {
              $content = "Đã cập nhật password rồi nha";
            } else {
              $content = "Error updating record: " . $conn->error;
            }
            header("Location: http://localhost:8888/userInfo.php?page=change");

            $conn1->close();
      } 
    }
  }

 
 ?>

<!DOCTYPE html>
<html lang="vi">
<head>
  <title>Đăng Nhập | Đăng ký</title>
<script src="https://apis.google.com/js/platform.js" async defer></script>
<meta name="google-signin-client_id" content="600445604444-dric9lv8c05n6653ntm5bpdhqv6tng0k.apps.googleusercontent.com" >
<meta name="viewport" content="width=device-width, initial-scale=1" />
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<link href="./userinfo.css" rel="stylesheet" type="text/css" media="all" />
<!-- <link rel="stylesheet" type="text/css" href="./response.css"> -->
<link rel="stylesheet" type="text/css" href="./css/font-awesome.min.css" />
<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>

</head>
<body>
  <a id = "x" onclick="hide()" href="http://localhost:8888/giaodien.php" style="text-decoration: none;color: black; font-size: 30px;margin-left:1200px;">X</a>
  
      <!-- <button class ="nutbutton" style ="position:absolute; top:0; left:0;" onclick="hide()" > ></button> -->


    <div  class="container" id="container" >
        <div class="form-container sign-up-container">
              <form action="?page=change" method="post">
                    <h1 style="position: relative;left: 4px;">Thông tin tài khoản</h1>
                    <label style="position: relative;left: -41%;" for="hoten">Họ và tên:</label>
                    <input id = "fullname" style =" font-size: 19px" type="text" placeholder="Họ và tên" name="hoten" size="40" value= '<?= $hoten; ?>' /><span id="loihoten"></span>
                    
                   <label style="position: relative;left: -41%;" for="hoten">Thư điện tử:</label>
                   <input id = "e" style =" font-size: 19px" type="email" disabled placeholder="Thư điện tử" name="email" size="40" value= <?= $email; ?> /><span id="loiemail"></span>
                   <label style="position: relative;left: -41%;" for="hoten">Ngày sinh:</label>
                   <input style =" font-size: 19px" type="text" placeholder="Ngày sinh" name="ngaysinh" id="ngaysinh" size="40" value= <?= $ngaysinh; ?> /><span id="loingaysinh"></span>
                   <label style="position: relative;left: -41%;" for="hoten">Giới tính:</label>
                   <input style =" font-size: 19px" type="text" placeholder="Giới tính" name="gioitinh" id="gioitinh" size="40" value=<?= $gioitinh; ?> /><span id="loigioitinh"></span>
                  <label style="position: relative;left: -41%;" for="hoten">Địa chỉ:</label>
                  <input style =" font-size: 19px" type="text" placeholder="Địa chỉ" name="diachi" id="diachi" size="40" value= '<?= $diachi; ?>' /><span id="loidiachi"></span >
                  <label style="position: relative;left: -41%;" for="hoten">Số điện thoại:</label>
                  <input style =" font-size: 19px" type="text" placeholder="Số điện thoại" name="dienthoai" id="dienthoai" size="40" value=<?= $dienthoai; ?> /> <span id="loidienthoai"></span>


                  
                  <button class ="nutbutton" id="nutdangnhap" onclick="return KiemTraDK()"  type="submit"   style="position: relative;top: 8px;">Thay đổi</button>
              </form>
        </div>
        <div style="background-color: white;height: 120%;width: 50%; margin-top: -5%;">
          <div class="logo">
            <img id = "imgAccount" src="https://www.w3schools.com/bootstrap4/img_avatar1.png">
          </div>
          <div id = "nameAccount" style="margin-top: 25%;text-align: center; left: -10%;position: relative;"> <?= $hoten; ?>  </div>
          <div id = "emailAccount" style="margin-top: 2%;text-align: center; left: -10%;position: relative;"> <?= $email; ?> </div>



          
        </div>
        
     

      
    </div>
 


<!-- 
    <button class="open-button" onclick="openForm()">Ý kiến</button>

<div class="chat-popup" id="myForm">
   <form action="?send=true" class="form-container" style=" max-width: 300px;padding: 10px;background-color: white;" method = "post">
    <h1>Phản hồi</h1>

    <label for="msg"><b>Message</b></label>
    <textarea  placeholder="Type message.." name="msg" required></textarea>

    <button type="submit" class="btn">Gửi</button>
    <button type="button" class="btn cancel" onclick="closeForm()">Đóng</button>
  </form>
</div>
 -->
  



  </script>

    <script type="text/javascript">
 
    if (localStorage.getItem("accountName") != null){
         document.getElementById("nameAccount").innerHTML = localStorage.getItem("accountName");
         document.getElementById("imgAccount").src = localStorage.getItem("accountImage");
         document.getElementById("emailAccount").innerHTML = localStorage.getItem("accountEmail");
         document.getElementById("e").value = localStorage.getItem("accountEmail");
         document.getElementById("fullname").value = localStorage.getItem("accountName");

         document.getElementById("nutdangnhap").style.display = "none";

    }
   
  
    
    function hide(){
      if(document.getElementById("container").style.display == "none"){
        document.getElementById("container").style.display = "block";
        document.getElementById("x").style.display = "block";
      }else{
        document.getElementById("container").style.display = "none";
        document.getElementById("x").style.display = "none";
      }
    }


      function KiemTraDK(){

          var hoten=document.getElementById('fullname').value;
          var email=document.getElementById('e').value;
          var diachi=document.getElementById('diachi').value;
          var dienthoai=document.getElementById('dienthoai').value;
          var ngaysinh=document.getElementById('ngaysinh').value;
          var gioitinh=document.getElementById('gioitinh').value;

          var loi1=0,loi2=0,loi3=0,loi4=0,loi5=0,loi6=0;
      
          if(hoten==""){
            document.getElementById('loihoten').innerHTML="Vui lòng nhập họ và tên !";loi1=1;
          }else{
            document.getElementById('loihoten').innerHTML="";loi1=0;
          }
          if(email==""){
            document.getElementById('loiemail').innerHTML="Vui lòng nhập thư điện tử !";loi2=1;
          }else{
            document.getElementById('loiemail').innerHTML="";loi2=0
          }
          if(ngaysinh==""){
            document.getElementById('loingaysinh').innerHTML="Vui lòng nhập đầy đủ ngày/tháng/năm !";loi3=1;
          }else{
            document.getElementById('loingaysinh').innerHTML="";loi3=0;
          }
          if(gioitinh==""){
            document.getElementById('loigioitinh').innerHTML="Vui lòng nhập giới tính";loi4=1;
          }else{
            document.getElementById('loigioitinh').innerHTML="";loi4=0;
          }
          if(diachi==""){
            document.getElementById('loidiachi').innerHTML="Vui lòng nhập địa chỉ !";loi5=1;
          }else{
            document.getElementById('loidiachi').innerHTML="";loi5=0;
          }
          if(dienthoai==""){
            document.getElementById('loidienthoai').innerHTML="Vui lòng nhập số điện thoại !";loi6=1;
          }else{
            document.getElementById('loidienthoai').innerHTML="";loi6=0;
          }
      
         
          
          if(loi1==0&&loi2==0&loi3==0&&loi4==0&&loi5==0&&loi6==0){
        
            return true;
          }else{
            
             return false;
          }
    }
   
    

    

    
    </script>
</body>

</html>
