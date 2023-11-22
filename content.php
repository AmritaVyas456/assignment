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
	            if (isset($_GET['error']))
              {
                echo "<span style='color:red;font-size:20px;'>Login name or password is not valid.</span>";                              
              }
  ?>
                
