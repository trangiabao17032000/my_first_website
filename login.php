<?php
	// session_start();
	if (isset($name) && !$name){
		$content = "please input your username...";
	}else if ( isset($pass) && !$pass){
		$content = "please input your password...";
	}else if ($name && $pass){
		$conn = new mysqli(HOST,USER,PASS,DB);
		if ($conn -> connect_error === true){
		echo 'the error is: '.$conn -> connect_error; # cancel execute when error take placeee.
		}else{
		
		// echo "mat troi chan li troi qua tim".$name;
		$sql = "select * from accounts";
		$result = $conn -> query($sql);

			if ($result->num_rows > 0) {

				while($data = $result -> fetch_assoc()){
				
					
					// echo $data["id"]." - ".$data["username"]." - ".$data["password"] ."<br>";
					$ps = md5($pass);

					if ($name == $data["username"] && $ps  == $data["password"]){
						// echo "compare";
						$_SESSION["username"] = $name ;
						$_SESSION["password"] = $ps;
						setcookie("login", "true", time() + 3600, "/");
						header("Location: http://localhost:8888/giaodien.php");
					}
				}
				$content = "login failed...";
				

			}

		}
	}
 ?>
