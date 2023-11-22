<?php
             $login = new login();
			if( $_POST['loginSubmit'] || $_GET['successData'] || $_POST['searchData'] || (isset($_SESSION['user_id']) && !empty($_SESSION['user_id'])))
				{
								if(!isset($_SESSION['user_id'])){
								$login->setUserName( $_POST['userName'] );
								$login->setUserPassword( $_POST['userPassword'] );
								$login->checkLogin();
								}
								$post = new post();
								$showAllPosts = $post->showAllPosts();
								echo $showAllPosts;
							
				} 
				
               else 
              { 
								$getError = 0 ;
								if ( true == isset( $_GET['error'] ) ) 
								{
									$getError =  $_GET['error'];
								}
								$template = $login->loginForm( $getError );
								echo $template;
							}
	          
  ?>
                
