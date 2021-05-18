<?php
	
	
	$name = filter_input(INPUT_POST,"hoten",FILTER_SANITIZE_STRING);
	$username = filter_input(INPUT_POST,"taikhoan",FILTER_SANITIZE_STRING);
	$pass = filter_input(INPUT_POST, "matkhau",FILTER_SANITIZE_STRING);
	$email = filter_input(INPUT_POST, "email",FILTER_SANITIZE_STRING);
	$sex = filter_input(INPUT_POST, "gioitinh",FILTER_SANITIZE_STRING);
	$address = filter_input(INPUT_POST, "diachi",FILTER_SANITIZE_STRING);
	$phone = filter_input(INPUT_POST, "dienthoai",FILTER_SANITIZE_STRING);

	$dayBirth = filter_input(INPUT_POST, "ngay",FILTER_SANITIZE_STRING);
	$monthBirth = filter_input(INPUT_POST, "thang",FILTER_SANITIZE_STRING);
	$yearBirth = filter_input(INPUT_POST, "nam",FILTER_SANITIZE_STRING);

	$content = "";

	function checkUsername($username){
		$conn = new mysqli(HOST,USER,"",DB);
		$query = "select * from accounts";
		$result = $conn -> query($query);

		if ($result->num_rows > 0) {

			while($data = $result -> fetch_assoc()){
			
				
				// echo $data["id"]." - ".$data["username"]." - ".$data["password"] ."<br>";
			

				if ($username == $data["username"]){
				
					return false;
				}
			}
			return true;
		
		}
		return true;
	} 


	function checkEmail($email){
		$conn = new mysqli(HOST,USER,"",DB);
		$query = "select * from accounts";
		$result = $conn -> query($query);

		if ($result->num_rows > 0) {

			while($data = $result -> fetch_assoc()){
			
				
				// echo $data["id"]." - ".$data["username"]." - ".$data["password"] ."<br>";
			

				if ($email == $data["email"]){
				
					return false;
				}
			}
			return true;
		
		}
		return true;
	} 


	

	if ($name && $pass && $username && $email && $sex && $address && $phone && $dayBirth && $monthBirth && $yearBirth){
		// console.log("ok");

		if (checkUsername($username)){

			if(checkEmail($email)){

					$conn = new mysqli(HOST,USER,PASS,DB);
					if ($conn -> connect_error === true){
						echo 'the error is: '.$conn -> connect_error; # cancel execute when error take placeee.
					}else{
						$ps = md5($pass);

						$sql = "INSERT INTO accounts(username, password, email)
						VALUES ('$username','$ps','$email')";
							if ($conn->query($sql) === true) {
						
							} else {
							  echo "Error: " . $sql . "<br>" . $conn->error;
							}

							$conn->close();
					}




					$conn1 = new mysqli(HOST,USER,PASS,DB);
					if ($conn1 -> connect_error === true){
						echo 'the error is: '.$conn1 -> connect_error; # cancel execute when error take placeee.
					}else{
						
						$ps = md5($pass);
						$birthday = $dayBirth ."/". $monthBirth . "/". $yearBirth;
						
						$sql1 = "INSERT INTO Persons(name,username,email,sex,address,phone,birthday)
						VALUES ('$name','$username','$email','$sex','$address','$phone','$birthday')";
					
							
							if ($conn1->query($sql1) === true) {
							  // echo "New record created successfully";
							$content = "register successfully !";
							} else {
							  echo "Error: " . $sql1 . "<br>" . $conn1->error;
							}

							// $conn->close();
					}
					if (!file_exists(PATH . $username)) {
 						   mkdir(PATH. $username , 0777, true);
 						   chmod(PATH . $username, 0777);
					}


					// CREATE NEW TABLE 

						// Create connection
						$conn2 = new mysqli(HOST, USER, PASS, "userInfo");
						// Check connection
						if ($conn2->connect_error) {
						  die("Connection failed: " . $conn2->connect_error);
						}

						// sql to create table
						$sql2 = "CREATE TABLE $username (
						id INT(6) UNSIGNED AUTO_INCREMENT PRIMARY KEY,
						fileName VARCHAR(300) NOT NULL,
						filePath VARCHAR(300) NOT NULL
						)";

						if ($conn2->query($sql2) === TRUE) {
						  // echo "Table MyGuests created successfully";
						} else {
						  echo "Error creating table: " . $conn2->error;
						}

						$conn2->close();
					// STOP CREATE NEW TABLE
				}else{
					$content = "email has existed, pliz choose another email!";
				}

		}else{
				$content = "username has existed, pliz choose another username!";	
		}
	   

	
	}
	
 ?>

