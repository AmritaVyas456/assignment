<?php session_start(); 
require_once("header.php");?>

	<body>
		<?php

			//include ("classes/class_login.php");
			include ("includes/db.php");
			include ("classes/class_post.php");
            
			$post = new post();
		
          if(!empty($_POST['postSubmit'])){
			if( $_POST['postSubmit'] )
			{
				$post->setTitle( $_POST['postTitle'] );
				$post->setDescription( $_POST['postDesc'] );
				$post->setDate( $_POST['postDate'] );
				$post->submitPost();


			} else { 
				$getError = 0 ;
				if ( true == isset( $_GET['error'] ) ) 
				{
					$getError =  $_GET['error'] ;
				}
				$template = $post->postForm();
				require_once("footer.php");

				echo $template;
			} }

			if(!empty($_POST['postUpdate'])){
				if( $_POST['postUpdate'] )

			{
				
				$post->setTitle( $_POST['postTitle'] );
				$post->setDescription( $_POST['postDesc'] );
				$post->setDate( $_POST['postDate'] );
				$post->submitPost();


			} else { 
				$getError = 0 ;
				if ( true == isset( $_GET['error'] ) ) 
				{
					$getError =  $_GET['error'] ;
				}
				$template = $post->postForm();
				require_once("footer.php");

				echo $template;
			} }

			if ( true == isset( $_GET['logout'] ) ) {
				$template = $post->logOut();
			}

			$template = $post->postForm();
			require_once("footer.php");


		?>
	</body>
</html>
