<?php
	require_once "account.php";
	// print_r($_SERVER['SCRIPT_URI']);
	session_start();
	if (isset($_SESSION['username']) && $_SESSION['username'] == ""){
		header("Location: http://localhost:8888");
		die();
	}
	if (isset($_GET["logout"]) && $_GET["logout"]== true){
		$_SESSION['username'] = "";
		$_SESSION['password'] = "";
		setcookie("login", "", time() - 3600);
		// echo "soemthig";
		header("Location: http://localhost:8888");
	
	}
	if (isset($_GET["send"]) && $_GET["send"]== true){
		$_SESSION['MAILADMIN'] = "tienle676@gmail.com";
		// echo $_POST['msg'] . "this is msg";
		require_once "responseEmail.php";

	}
?>

<!DOCTYPE html>
<html>
<head>
	<title>Stored Stuff</title>

	<meta charset="utf-8">
	<meta name="viewport" content="width=device-width, initial-scale=1">

	<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.5.0/css/bootstrap.min.css">
	<link rel="stylesheet" type="text/css" href="giaodien.css">
	<link rel="stylesheet" type="text/css" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
	<meta name="google-signin-client_id" content="600445604444-dric9lv8c05n6653ntm5bpdhqv6tng0k.apps.googleusercontent.com">

	<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
	<script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.16.0/umd/popper.min.js"></script>
	<script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.5.0/js/bootstrap.min.js"></script>

	<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css">
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.2.1/jquery.min.js"></script>
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/js/bootstrap.min.js"></script>
     <link rel="stylesheet" type="text/css" href="./response.css">
    <style type="text/css">

    </style>

</head>
<?php
    function remove_dir($dir = null) {
        if (is_dir($dir)) {
        $objects = scandir($dir);
            foreach ($objects as $object) {
                if ($object != "." && $object != "..") {
                    if (filetype($dir."/".$object) == "dir") remove_dir($dir."/".$object);
                    else unlink($dir."/".$object);
                }
            }
        rmdir($dir);
        }elseif($dir != null && file_exists($dir)){
            unlink($dir);
        }
    }
    if (isset($_SESSION['username']) && $_SESSION['username'] == ""){
    	$root = $_SERVER['DOCUMENT_ROOT'].'/userInfo/';
    }else {
    	$root = $_SERVER['DOCUMENT_ROOT'].'/userInfo/'.$_SESSION['username']; 
    }
    
    $_SESSION['root']=$root;
    // echo $root; 

    $dirname =filter_input(INPUT_GET,'dir',FILTER_SANITIZE_STRING);
    $deletelink =filter_input(INPUT_GET,'del',FILTER_SANITIZE_STRING);
    // đổi tên file
    $savename =filter_input(INPUT_POST,'savename',FILTER_SANITIZE_STRING);
    $newname =filter_input(INPUT_POST,'newname',FILTER_SANITIZE_STRING);
    $rename =filter_input(INPUT_POST,'re',FILTER_SANITIZE_STRING);
    // echo $rename."<br>";
    // echo pathinfo($rename,PATHINFO_EXTENSION);

    $create =filter_input(INPUT_POST,'create',FILTER_SANITIZE_STRING);
    $folderName =filter_input(INPUT_POST,'folderName',FILTER_SANITIZE_STRING);
    
    if($create && $folderName && !file_exists($folderName)){
        mkdir($_SESSION["dir_path"].'/'.$folderName,0777, true);
        chmod(PATH . $folderName, 0777);
    }elseif($deletelink){
        remove_dir($deletelink);
        require_once "deleteFile.php";
    }

    if($newname && $savename && $rename){
        $a =$_SESSION["dir_path"] . "/" .$rename;
        $extnew = pathinfo($a,PATHINFO_EXTENSION);
        
        if(!$extnew){
        	$b = $_SESSION["dir_path"] . "/" . $newname ;
        	
        }else{
        	$b = $_SESSION["dir_path"] . "/" . $newname .".". $extnew;
        	
        }
        // echo $a."<br>";
        // echo $b."<br>";
        rename($a,$b);

    }
    if($dirname){
        $dir_path = $root . "/" . $dirname;

    }else{
        $dir_path = $root;
    }
    $_SESSION['dir_path']=$dir_path;
    // echo $root;

    $files = scandir($dir_path); 
?>
<body>
	
	<script>
		$(document).ready(function(){
			$(".switch-button").click(function(){
				$(".row").toggleClass("list-row");
				$(".item").toggleClass("list-item");
				$(".hide-detail").toggleClass("detail");
				$(".item-detail-hide").toggleClass("item-detail");
				$(".unliner").toggleClass("liner");
				$(this).toggleClass("no-gridbtn");
			});
			$(".rename").click(function () {
				// console.log("baode");
				let id = $(this).data('id');
				$('#rename-form-id').val(id);
	            $('#myModal').modal({
	                backdrop: 'static',
	                keyboard: false
	            });
	        });
		});

		function showResult(str){
			if(str.length == 0){
				document.getElementById("hint-file").innerHTML="";
				return;
			}else{
				var xmlhttp = new XMLHttpRequest();
				xmlhttp.onreadystatechange = function(){
					if(this.readyState ==4 && this.status ==200){
						document.getElementById("hint-file").innerHTML = this.responseText;
					}
				};
				xmlhttp.open("GET", "search.php?q="+str,true);
				xmlhttp.send();
			}
		}
	</script>
<!-- Navbar đầu trang -->
	<nav class="navbar navbar-expand-sm bg-danger navbar-dark">
		<ul class="navbar-nav">
			<li class="nav-item active">
				<a class="nav-link icon" href="giaodien.php" style="font-size: 20px;">MIMEO</a>
			</li>
		</ul>
		<div class="header">
			<!-- Form search -->
			<form class="form-inline" action="">
				<input class="form-control mr-sm-2" type="text" placeholder="Search" id="search-form" name="search" onkeyup="showResult(this.value)">
				<!-- <button class="btn btn-danger btn-search" type="submit">Search</button> -->
				<div id ="hint-file"></div>
			</form>
		</div>


	
<!-- 
		ĐÂY LÀ CODE CỦA TIẾN  -->
		<div class="dropdown" stye="display: relative;">
   			 <button type="button" style="position: relative;left: 350px;" class="btn btn-primary dropdown-toggle" data-toggle="dropdown">
     			 Cài đặt
   			 </button>
			<div class="dropdown-menu" style="margin-left: 250px;">
		      <a class="dropdown-item" href="http://localhost:8888/userinfo.php" >Thông tin tài khoản</a>
		      <a id="logout" class="dropdown-item" href="?logout=true">Đăng xuất</a>
		      <a  id ="logoutGoogle" class="dropdolwn-item" href="#" onclick="signOut();">Sign out google here</a>		    
		    </div>
 		 </div>
<!--   CODE CỦA TIẾN KẾT THÚC TẠI ĐÂY -->
	</nav>
	<div class="column-left">
		<div class="feature">
			<button type="button"  class="btn btn-danger" data-toggle="collapse" data-target="#uploadFile">+ Upload</button>
			<button type="button"  class="btn btn-danger" data-toggle="collapse" data-target="#createFolder">+ Create</button>
		</div>
		<div>
			<hr class="liner">
			<div class="collapse mt-4" id="createFolder" >
				<form  method="post" >
		        	<input type="text" name="folderName" >
		        	<input type="submit" class="btn btn-success" value="New folder" name="create">
		    	</form>
			</div>

			<div class="collapse mt-4" id="uploadFile" >
				<form  action="upload.php" method="post" enctype="multipart/form-data">
			        <div ><input class="skt" type="file" name="file[]" multiple></div>
			        <div class="kt"><input type="submit" class="btn btn-success" value="Upload" name="submit" ></div>
			    </form>
			</div>
		</div>
	</div>


	<div class="column-right">
		<div>
			<div>
				<h3 class="title-store">Kho lưu trữ của tôi</h3>
			</div>
			<!-- php cho nút back -->
			<?php
                $back='#';
                if (!empty($_SERVER['HTTP_REFERER'])){
                    $back = $_SERVER['HTTP_REFERER'];
                }
            ?>
			<div class="action">
				<!-- <input type="button" class="btn btn-primary back" value="Back" onclick="window.location.href='<?=$back?>'" /> -->
				<p class="switch-button gridbtn"></p>
			</div>
		</div>

		<hr class="liner-header">
		<div class="item-contain">
			<div class="item-header">
				<div class="hide-detail">Name</div>
				<div class="hide-detail">Size</div>
				<div class="hide-detail">Last Modified</div>
			</div>
			<br>
		<?php 
	        foreach ($files as $file ) {
	            # code...
	            if(substr($file,0,1) === "."){
	                continue;
	            }
	            $path = $dir_path . '/' .$file;
	            $isDir = is_dir($path);
	            $ext = strtolower(pathinfo($path,PATHINFO_EXTENSION));
	            $time = date("d/m/yy",filemtime($path));    
	            $size = "_";
	            $deletelink= '?del='.$path;

	            $rename = $file;
	            // echo $rename;
	            $dirlink = str_replace($root,'', $path);
	            $dirlink = substr($dirlink,1);
	            if(!$isDir){
	                $dirlink ="download.php?f=".$file;
	            }else{
	                $dirlink = '?dir='.$dirlink;

	            }

	            if(!$isDir){
	                $size = filesize($path) ;
	                if($size > 1000000){
	                    $size = round($size /1000000,1). " MB";
	                }elseif ($size >1000) {
	                    $size = round($size /1000,1) . " KB";
	                }else{
	                    $size =$size . " Bytes";
	                }
	            }
	            if($isDir){
					$ext = 'Folder';
					$icon = '../image/folder.png';
				}elseif ($ext=='jpg' || $ext=='gif' || $ext=='jpeg' || $ext=='tiff' || $ext=='bmp') {
					# code...
					$icon = '../image/ficture.png';
				}elseif ($ext == 'c' || $ext == 'py' || $ext == 'java' || $ext == 'js' || $ext == 'css' || $ext == 'php'  ) {
					# code...
					$icon = '../image/code.png';
				}elseif ($ext == 'mp4') {
					# code...
					$icon = '../image/video.png';
				}elseif ($ext == 'mp3') {
					# code...
					$icon = '../image/music.png';
				}elseif ($ext == 'doc' || $ext == 'docx' ) {
					# code...
					$icon = '../image/word.png';
				}elseif ($ext == 'pdf') {
					# code...
					$icon = '../image/pdf.png';
				}elseif ($ext == 'ppt' || $ext == 'pptx') {
					# code...
					$icon = '../image/pp.png';
				}elseif ($ext == 'xls' || $ext == 'xlsx') {
					# code...
					$icon = '../image/excel.png';
				}elseif ($ext == 'zip' || $ext == 'rar') {
					# code...
					$icon = '../image/excel.png';
				}elseif ($ext == 'txt' || $ext == 'sql') {
					# code...
					$icon = '../image/text.png';
				}else{
					# code...
					$icon = '../image/file.png';
				}
			?>
				<hr class="unliner">
				<div class=" row" >
					<?php
						// echo $dirlink;
					?>
					<a class=" item" href="<?= $dirlink ?>">
						<img src="<?=$icon?>">
						<div class="item-info">
							<div class="item-name"><b>Name:</b> <br><?=$file?></div>
							<div class="item-size"><b>Size:</b> <?=$size?></div>
							<div class="item-type"><b>Type:</b> <?=$ext?></div>
						</div>
					</a>
					<div class="item-detail-hide detail-name"><a href="<?= $dirlink ?>"><?=$file?></a></div>
					<div class="item-detail-hide"><?=$size?></div>
					<div class="item-detail-hide"><?=$time?></div>
					<div class="item-detail-hide dropdown item-action">
						<button type="button" class="btn btn-primary dropdown-toggle" data-toggle="dropdown"></button>
						<div class="dropdown-menu">
							<button class="dropdown-item rename" data-id="<?=$rename?>" data-toggle="modal" data-target="#myModal"><i class="fa fa-pen"></i> Rename</button>
							<a class="dropdown-item" href="#"><i class="fa fa-share-alt"></i> Share</a>
					<?php
						if(!$isDir){
					?>
							<a class="dropdown-item" href="download.php?f=<?=$file?>"><i class="fa fa-download"></i> Download</a>
					<?php
					}
					?>
							<a class="dropdown-item" href="<?=$deletelink?>"><i class="fa fa-trash"></i> Delete</a>
						</div>				
					</div>
				</div>
				<?php
				}
	        ?>
		</div>
<!-- Rename dialog -->
<form method="post">
    <div class="modal fade" id="myModal" role="dialog">
        <div class="modal-dialog">
            <!-- Modal content-->
            <div class="modal-content">
                <div class="modal-header">
                	<h4 class="modal-title">Đổi tên thư mục</h4>
                    <button type="button" class="close" data-dismiss="modal">&times;</button>
                    
                </div>
                    <div class="modal-body">
                        <p>Nhập tên mới.</p>
                        <input type="text" name="newname">
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-default" data-dismiss="modal">Đóng</button>
                        <input id="rename-form-id" type="hidden" name="re" value="??">
                        <input  type="submit" id="submit" name="savename" value="Lưu" class="btn btn-success" >
                    </div>
                </form>
            </div>
        </div>
    </div>
</form>
<!-- Rename dialog -->


<!-- CODE TIẾN Ở ĐÂY -->
<button class="open-button-response" onclick="openForm()">Phản hồi</button>

<div class="chat-popup-response" id="myFormResponse">
	<form action="?send=true" class="form-container-response"  method = "post">
		<h1>Phản hồi</h1>

		<label for="msg"><b>Message</b></label>
		<textarea  placeholder="Type message.." name="msg" required></textarea>

		<button type="submit" class="btn-response">Gửi</button>
		<button type="button" class="btn-response cancel-response" onclick="closeForm()">Đóng</button>
	</form>
</div>

<script>
function openForm() {
  document.getElementById("myFormResponse").style.display = "block";
}

function closeForm() {
  document.getElementById("myFormResponse").style.display = "none";
}
</script>


		<script type="text/javascript">
			if (localStorage.getItem("accountName") != null){ // is google
			document.getElementById("logout").style.display = "none";

		}else{
			document.getElementById("logoutGoogle").style.display = "none";
		}

		function signOut() {
	        var auth2 = gapi.auth2.getAuthInstance();
	        auth2.signOut().then(function () {
	        console.log('User signed out.');
	        localStorage.removeItem("accountName");
	        localStorage.removeItem("accountEmail");
	        localStorage.removeItem("accountImage");
	        document.location.href='http://localhost:8888/index.php';
	        //redirecteđ page    kslsdkfjlskdfjklsdjflksdjflkds
	      });
  	  }
  	  function onLoad() {
     	 gapi.load('auth2', function() {
      	  gapi.auth2.init();
      		});
   	 }
		</script>
		<script src="https://apis.google.com/js/platform.js?onload=onLoad" async defer></script>


		<!-- CODE TIẾN KẾT THÚC TẠI ĐÂY -->
</body>
</html>