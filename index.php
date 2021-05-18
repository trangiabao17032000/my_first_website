<?php
	session_start();
	require_once "account.php";
	$name = filter_input(INPUT_POST,"username",FILTER_SANITIZE_STRING);
	$pass = filter_input(INPUT_POST, "password",FILTER_SANITIZE_STRING);
	$content = "";
	if (isset($_COOKIE["login"]) && $_COOKIE["login"] == true){
		header("Location: http://localhost:8888/giaodien.php");
	}
	if (isset($_GET["page"]) && $_GET["page"]=="dangnhap"){
	 	require_once "login.php";
			
	}


	if (isset($_GET["page"]) && $_GET["page"]=="dangky"){

		require_once "register.php";
	}

	
	
 ?>

 <!DOCTYPE html>
<html lang="vi">
<head>
	<title>Đăng Nhập | Đăng ký</title>
<script src="https://apis.google.com/js/platform.js" async defer></script>
<meta name="google-signin-client_id" content="600445604444-dric9lv8c05n6653ntm5bpdhqv6tng0k.apps.googleusercontent.com">
<meta name="viewport" content="width=device-width, initial-scale=1" />
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<link href="./login.css" rel="stylesheet" type="text/css" media="all" />
<link rel="stylesheet" type="text/css" href="./css/font-awesome.min.css" />
<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
</head>
<body>
	
    <div class="container" id="container" style="margin-top: 10px;">
        <div class="form-container sign-up-container">
            <form action="?page=dangky" method="post">
                <h1 style="position: relative;left: 4px;">Tạo tài khoản</h1>
                <input type="text" placeholder="Họ và tên" name="hoten" id="ht" size="40" value=""/><span id="loihoten"></span>
                <input type="text" placeholder="Tên tài khoản" name="taikhoan" id="tk" size="40" value=""/><span id="loitk"></span>
				<input type="password" placeholder="Mật khẩu" name="matkhau" id ="mk" size="40" value=""/><span id="loimk"></span>
				<input type="password" placeholder="Nhập lại mật khẩu" name="matkhau" id ="mk2" size="40" value=""/><span id="loimk2"></span>
				<input type="email" placeholder="Thư điện tử" name="email" id="email" size="40" value=""/><span id="loiemail"></span>
				<li class="gioitinh">
						<input type="radio" name="gioitinh" value="nam" check style="width:50px;">Nam
    					<input type="radio" name="gioitinh" value="nu" style="width:50px;">Nữ
    			</li>
    			<li class="ngaysinh">
    					<input type="number" name="ngay" min="1" max="31" placeholder="Ngày sinh" value="" id="ngay">
    					<input type="number" name="thang" min="1" max="12" placeholder="Tháng sinh" value="" id="thang">
    					<input type="number" name="nam" min="1950" max="2015" placeholder="Năm sinh" value="" id="nam">
    					<span>( dd/mm/yyyy )</span>
    					<br/>
						<span id="loingaysinh" style="position: relative;top:-7px;"></span>
    			</li>
    			<input type="text" placeholder="Địa chỉ" name="diachi" id="diachi" size="40" value=""><span id="loidiachi"></span >
    			<input type="text" placeholder="Số điện thoại" name="dienthoai" id="dienthoai" size="40" value=""><span id="loidienthoai"></span>
                <button id="nutdangnhap" onclick=" return KiemTraDK()" type="submit"   style="position: relative;top: 8px;">Đăng ký</button>
            </form>
        </div>
        <div class="form-container sign-in-container">
            <form action="?page=dangnhap" method="post">
                <h1>Đăng nhập</h1>
               	<input type="text" size=30 placeholder="Tài Khoản" id="taikhoan" name = "username"><span id="loitk"></span>
				<input type="password"  size=30 placeholder="Mật Khẩu" id="matkhau" name="password"><span id="loimk"></span>
				<button onclick="return KiemTraDN();" type="submit" style="position: relative;top: 8px;">Đăng Nhập</button>	
                <a href="http://localhost:8888/gmailAuthentication.php">Quên mật khẩu?</a>
                <!-- <div class="g-signin2"  data-onsuccess="onSignIn"></div> -->
            </form>
        </div>
        <div class="overlay-container">
            <div class="overlay">
                <div class="overlay-panel overlay-left">
                    <h1>Chào bạn!</h1>
                    <p>Giữ kết nối để đăng nhập với thông tin cá nhân</p>
                    <button class="ghost" id="signIn">Đăng nhập</button>
                </div>
                <div class="overlay-panel overlay-right">
                    <h1>Chào bạn!</h1>
                    <p>Điền đầy đủ thông tin cá nhân để cùng bắt đầu với chúng tôi</p>
                    <button class="ghost" id="signUp">Đăng ký</button>
                </div>
            </div>

        </div>

      
    </div>

   	
      	<p id = "noteContent" style="color: white">  <?= $content; ?>   </p>

  	<script >
  		$(document).ready(function(){
	    	
		 $("#nutdangnhap").click(function(){

   					$("#noteContent").fadeOut(3000);
   				
		  });
	    	
	   		 
	  
	});
  	</script>

    <script type="text/javascript">

    
    	function onSignIn(googleUser) {
    		// document.location.href='http://localhost:8888/banoi.php';
 		 	var profile = googleUser.getBasicProfile();
 		 	console.log('ID: ' + profile.getId()); // Do not send to your backend! Use an ID token instead.
 		 	// setcookie("accountName",profile.getName(),time() + 3600, "/");
 		 	// setcookie("accountImage",profile.getImageUrl(),time() + 3600, "/");
 		 	// setcookie("accountEmail",profile.getEmail(),time() + 3600, "/");
 		 	localStorage.setItem("accountName", profile.getName());
 		 	localStorage.setItem("accountImage", profile.getImageUrl());
 		 	localStorage.setItem("accountEmail", profile.getEmail());
 		 	document.location.href='http://localhost:8888/giaodien.php';

  			
 			 
		}





        const signUpButton = document.getElementById('signUp');
        const signInButton = document.getElementById('signIn');
        const container = document.getElementById('container');

        signUpButton.addEventListener('click', () => {
            container.classList.add('right-panel-active');
        });

        signInButton.addEventListener('click', () => {
            container.classList.remove('right-panel-active');
        });


       

		function KiemTraDK(){
			var taikhoan=document.getElementById('tk').value;
			var matkhau=document.getElementById('mk').value;
			var matkhau2=document.getElementById('mk2').value;
			var hoten=document.getElementById('ht').value;
			var email=document.getElementById('email').value;
			var diachi=document.getElementById('diachi').value;
			var dienthoai=document.getElementById('dienthoai').value;
			var ngay=document.getElementById('ngay').value;
			var thang=document.getElementById('thang').value;
			var nam=document.getElementById('nam').value;
			var loi1=0,loi2=0,loi3=0,loi4=0,loi5=0,loi6=0,loi7=0;loi8=0,loi9=0,loi10=0,loi11=0;
			if(taikhoan==""){
				document.getElementById('loitk').innerHTML="Vui lòng nhập tên tài khoản !";loi1=1;
			}else{
				document.getElementById('loitk').innerHTML="";loi1=0;
			}
			if(matkhau==""){
				document.getElementById('loimk').innerHTML="Vui lòng nhập mật khẩu !";loi2=1;
			}else{
				document.getElementById('loimk').innerHTML="";loi2=0;
			}
			if(matkhau2==""){
				document.getElementById('loimk2').innerHTML="Vui lòng nhập mật khẩu !";loi3=1;
			}else{
				document.getElementById('loimk2').innerHTML="";loi3=0;
			}
			if(matkhau2!=matkhau){
				document.getElementById('loimk2').innerHTML="Mật khẩu nhập lại không đúng !";loi4=1;
			}else{
				document.getElementById('loimk2').innerHTML="";loi4=0;
			}
			if(hoten==""){
				document.getElementById('loihoten').innerHTML="Vui lòng nhập họ và tên !";loi5=1;
			}else{
				document.getElementById('loihoten').innerHTML="";loi5=0;
			}
			if(email==""){
				document.getElementById('loiemail').innerHTML="Vui lòng nhập thư điện tử !";loi6=1;
			}else{
				document.getElementById('loiemail').innerHTML="";loi6=0
			}
			if(diachi==""){
				document.getElementById('loidiachi').innerHTML="Vui lòng nhập địa chỉ !";loi7=1;
			}else{
				document.getElementById('loidiachi').innerHTML="";loi7=0;
			}
			if(dienthoai==""){
				document.getElementById('loidienthoai').innerHTML="Vui lòng nhập số điện thoại !";loi8=1;
			}else{
				document.getElementById('loidienthoai').innerHTML="";loi8=0;
			}
			if(ngay==""){
				document.getElementById('loingaysinh').innerHTML="Vui lòng nhập đầy đủ ngày, tháng, năm!";loi9=1;
			}else{
				document.getElementById('loingaysinh').innerHTML="";loi9=0;
			}
			if(thang==""){
				document.getElementById('loingaysinh').innerHTML="Vui lòng nhập đầy đủ ngày, tháng, năm!";loi10=1;
			}else{
				document.getElementById('loingaysinh').innerHTML="";loi10=0;
			}
			if(nam==""){
				document.getElementById('loingaysinh').innerHTML="Vui lòng nhập đầy đủ ngày, tháng, năm!";loi11=1;
			}else{
				document.getElementById('loingayinh').innerHTML="";loi11=0;
			}
			if(loi1==0&&loi2==0&loi3==0&&loi4==0&&loi5==0&&loi6==0&loi7==0&&loi8==0&&loi9==0&loi10==0&&loi11==0){
				alert("Chúc mừng bạn đã đăng ký thành công !!!")
				return true;
			}else{
				
				 return false;
			}
		}
    </script>
</body>

</html>>


