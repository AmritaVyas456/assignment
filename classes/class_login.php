<?php
class login
{

	public $strUserName;
	public $strUserPassword;

	// default constructor

	function setUserName( $userName ) {
	
        $this->strUserName = $userName; 
	}

	function getUserName() {
        return $this->strUserName; 
	}

	function setUserPassword( $userPassword ) {
	  $this->strUserPassword = $userPassword; 
	}

	function getUserPassword() {
        return $this->strUserPassword; 
	}

	function loginForm( $gotError = '' )
	{
		$template='<div class="container-fluid h-100">
		<div class="row justify-content-center align-items-center h-100">
			<div class="col col-sm-6 col-md-6 col-lg-4 col-xl-3">
				<form action="" id="loginForm" method="POST">
					<div class="form-group">
						<input class="form-control form-control-lg" placeholder="User Name" type="text" name="userName" id="userName">
					</div>
					<div class="form-group">
						<input class="form-control form-control-lg" placeholder="Password"  name="userPassword" id="userPassword" type="password">
					</div>
					<div class="form-group">
					 <input type="submit" class="btn btn-primary btn-lg btn-block" value="Sign In" name="loginSubmit">
					</div>
				</form>
			</div>
		</div></div>';
		if($gotError){
			$template .='<span style="color:red;font-size:20px;">Login name or password is not valid.</span>';                              
          }
		echo $template;
	}

	function checkLogin() // Lastest php version we can use strict return type here
	{
            $validUserCheckSql = "select * from users where user_name= '".$this->strUserName."' and user_password ='".$this->strUserPassword."'";
			$objSql = new SqlClass();
			$objSql->setAdvanceErr( true );
			$userData = $objSql->executeSql( $validUserCheckSql );
			$userCount = $objSql->getNumRecord( $userData );

           if( $userCount > 0 )
               {
						$userRecord	=	$objSql->fetchRow( $userData );
					    $_SESSION['user_id']		=	$userRecord['id'];
					    $_SESSION['user_name']		=	$userRecord['user_name'];
                 }
                else
				{
                     header('Location: index.php?error=1');
                }
        }

}?>