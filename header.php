<?php 
session_start(); ?>
<html>
<head>
<meta/>
<title> Company assignment </title>
<script LANGUAGE="JavaScript">
    function confirmDelete( postId ) {
	var agree = confirm("Are you sure you want to delete?");
      if ( agree ) {
			 window.location.href = "delete_post.php?postId="+postId;
      }
    }
  </script>
 <script src="js/jquery.min.js"></script>
 <link href="css/style.css" rel="stylesheet" type="text/css" />
 <link rel="stylesheet" href="css/bootstrap.min.css" integrity="sha384-Gn5384xqQ1aoWXA+058RXPxPg6fy4IWvTNh0E263XmFcJlSAwiGgFAW/dAiS6JXm" crossorigin="anonymous">
 <script language="javascript" type="text/javascript" src="ajax/common.js"></script>
 <script language="javascript" type="text/javascript" src="js/validation.js"></script>
 <link rel="stylesheet" href="css/all.min.css">
 <link rel = "stylesheet" href = "css/bootstrap.min.css" integrity = "sha384-Gn5384xqQ1aoWXA+058RXPxPg6fy4IWvTNh0E263XmFcJlSAwiGgFAW/dAiS6JXm" crossorigin = "anonymous">
<script src = "js/bootstrap.min.js" integrity = "sha384-JZR6Spejh4U02d8jOt6vLEHfe/JQGiRRSQQxSfFWpi1MquVdAyjUar5+76PVCmYl" crossorigin = "anonymous">
<script src="js/jquery.google.min.js"></script>
<script language="javascript" type="text/javascript" src="js/jquery.validate.js"></script>
</script>
</head>
<div class="fixed-header text-center">
      	 HEADER
</div>
  
