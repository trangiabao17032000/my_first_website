<?php
	session_start();
	require_once "account.php";


	if (isset($_POST['submit'])){
		$name = array();
		$tmp_name= array();
		$error = array();
		$ext =array();
		$size =array();
		// print_r($_FILES['file']);
		foreach ($_FILES['file']['name'] as $file ) {
			$name[] =$file; 
		}
		foreach ($_FILES['file']['tmp_name'] as $file ) {
			$tmp_name[] =$file; 
		}

		foreach ($_FILES['file']['error'] as $file ) {
			$error[] =$file; 
		}

		foreach ($_FILES['file']['type'] as $file ) {
			$ext[] = $file; 
		}
		$count=0;
		foreach ($_FILES['file']['size'] as $file ) {
			if($file > 10485760){
				echo "không thể upfile lớn hơn 10 MB";
				header("location:http://localhost:8888/giaodien.php");
			}else{
				$size =round($file/1024,2);
				$count = $size; 
			}
			
		}
	


		for ($i=0; $i <count($name) ; $i++) { 
			if($error[$i]>0){
				echo "lỗi file";
				header("location:http://localhost:8888/giaodien.php");
			}elseif ($count > 52428800) {
				# code...
				echo "tổng lượng MB không được lơn hơn 50MB";
				header("location:http://localhost:8888/giaodien.php");
			}elseif (count($name) > 10) {
				echo "số lượng file up lên 1 lúc phải ít hơn 10";
				header("location:http://localhost:8888/giaodien.php");
			}else{
				$temp = preg_split('/[\/\\\\]+/', $name[$i]);
				$filename = $temp[count($temp)-1];
				$upload_dir = $_SESSION['root'];
				$upload_file = $upload_dir.'/'. $filename;
				echo $upload_file;
				if(file_exists($upload_file)){
					echo "file đã tồn tại";
					header("location:http://localhost:8888/giaodien.php");
				}else{
					
					if(move_uploaded_file($tmp_name[$i],$upload_file)){
						$username = $_SESSION['username'];
						// echo "vao duoc";
						// Create connection
						$conn = new mysqli(HOST, USER, PASS, "userInfo");
						// Check connection
						if ($conn->connect_error) {
						  echo ("Connection failed: " . $conn->connect_error);
						}
						echo "vao duoc";

						$sql = "INSERT INTO $username (fileName, filePath)
						VALUES ('$filename', '$upload_file')";

						if ($conn->query($sql) === TRUE) {
							chmod($upload_file, 0777);
						  	header("location:http://localhost:8888/giaodien.php");
						  	
						} else {
						  echo "Error: " . $sql . "<br>" . $conn->error;
						}

						$conn->close();
					}
				}

			}
		}


	}
?>
