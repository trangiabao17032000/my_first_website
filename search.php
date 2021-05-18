<?php
    session_start();
	$root = $_SESSION['root'];
       
    $dirname =filter_input(INPUT_GET,'dir',FILTER_SANITIZE_STRING);
    $deletelink =filter_input(INPUT_GET,'del',FILTER_SANITIZE_STRING);
    // đổi tên fiel
    $savename =filter_input(INPUT_POST,'savename',FILTER_SANITIZE_STRING);
    $newname =filter_input(INPUT_POST,'newname',FILTER_SANITIZE_STRING);

    $rename =filter_input(INPUT_GET,'re',FILTER_SANITIZE_STRING);
    // echo $rename."<br>";
    // echo pathinfo($rename,PATHINFO_EXTENSION);
    $create =filter_input(INPUT_POST,'create',FILTER_SANITIZE_STRING);
    $folderName =filter_input(INPUT_POST,'folderName',FILTER_SANITIZE_STRING);
    
    if($create && $folderName && !file_exists($folderName)){
        mkdir($folderName);
    }elseif($deletelink){
        remove_dir($deletelink);
    }

    if($newname && $savename && $rename){
        $a =$root . "/" .$rename ;
        $extnew = pathinfo($a,PATHINFO_EXTENSION);
        // echo $a."bao<br>";
        $b = $root . "/" . $newname .".". $extnew;
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


	$q= $_REQUEST["q"];
	$q= strtolower($q);
	foreach($files as $name){
        $path = $dir_path . '/' .$name;
        $isDir = is_dir($path);
		$hint = trim($q);
		if (strstr($name,$hint) != "") {
            if($isDir){
                echo "<a href=\"giaodien.php?dir=".$name ."\">". $name."</a><br/>";
            }else{
                echo "<a href=download.php?f=\"".$name ."\">". $name."</a><br/>";
            }
		}
	}
?>