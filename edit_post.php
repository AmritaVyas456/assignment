<?php session_start(); ?>
<html>
<head>
<meta/>
<title> Company assignment </title>
<link href="css/style.css" rel="stylesheet" type="text/css" />

 <script language="javascript" type="text/javascript" src="js/validation.js"></script>
</head>
<body>
<?php 
include ("includes/db.php");
include ("classes/class_post.php");
require_once("header.php");
$post = new post();
echo $data = $post->editpostData(); 
if( $_POST){
    echo $post->updatepostData($_POST); 
}
require_once("footer.php");

?>
	