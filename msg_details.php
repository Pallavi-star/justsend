<?php
	//start session
	session_start();
    include_once'conn.php';

    $db=mysqli_connect($servername,$username,$password,$dbname);
	
	if ($db->connect_error) 
	{
		die("Connection failed: ".$db->connect_error);
	}
	
	//fuction for creating ramdom code
	
	$ans="";
	$chars="abcdefghijklmnopqrstuvwxyz@_?!-0123456789";
	$charArray=str_split($chars);
	for($i=0;$i<5;$i++){
		$random_item=array_rand($charArray);
		$ans .="".$charArray[$random_item];
	}
		
	if(isset($_POST['submit'])){
		$name= $_POST['name'];
		$email_id = $_POST['email_id'];
		$subject=$_POST['subject'];
		$msg=$_POST['msg'];
		$image=addslashes(file_get_contents($_FILES['pict_file']['tmp_name']));
		$id=$_POST['id'];
		$random_code=$ans;		
		$_SESSION['random_code']=$random_code;	

		$query = "INSERT INTO message(name, email_id,subject,msg,image,random_code) VALUES ('$name','$email_id','$subject','$msg','$image','$random_code')";
		
		if(mysqli_query($db,$query)){
			$_SESSION['msg']=" Done sucessfully";
			header('location:messagecode.php'); //redirect to index page after inserting
		}else{
			echo $db->error;
		}


		
	}
		
?>