<?php
class post
{

	public $strPostTitle;
	public $strPostDescription;
	public $strPostDate;

	// default constructor

	function setTitle( $postTitle ) {
        $this->strPostTitle = $postTitle; 
	}

	function getTitle() {
        return $this->strPostTitle; 
	}

	function setDescription( $postDesc ) {
	  $this->strPostDescription = $postDesc; 
	}

	function getDescription() {
        return $this->strPostDescription; 
	}

	function setDate( $postDate ) {
        $this->strPostDate = $postDate; 
	}

	function getDate() {
        return $this->strPostDate; 
	}

	function logOut() {
        session_unset();
		session_destroy();
		header('Location: index.php');
	}

	function showAllPosts()
	{
		
		$userId = $_SESSION['user_id'];
		$getPostsSQL = "select * from posts WHERE user_id=$userId order by id DESC";
		$objSql = new SqlClass();
		$objSql->setAdvanceErr( true );
		$getUserPosts = $objSql->executeSql( $getPostsSQL );
		$postCount = $objSql->getNumRecord( $getUserPosts );

		$template='<div class="container">
		<h2>User Records</h2>
		<p>Displayed user records:</p> 
		<p class="float-right px-2">
			<a href="create_post.php?logout=1" class="btn btn-info">
			<i class="fa fa-sign-out" aria-hidden="true"></i>
			<span> Log out </span>
			</a>
        </p> 
		<a href="create_post.php"><button type="button" class="btn btn-primary float-right">Add Records</button></a>
		<input type="hidden" name="user_id" id="user_id" size="26" value="'.$userId.'">

        <div class="col-md-4 float-right">
            <div class="input-group">
                <input class="form-control py-2 border-right-0 border" type="search" placeholder="search here....." id="search_text">
                <span class="input-group-append">
                    <div class="input-group-text bg-transparent"><i class="fa fa-search"></i></div>
                </span>
            </div>
        </div>
    
		 
		<table class="table" id="search_table">
		  <thead>
			<tr>
			  <th>Title</th>
			  <th>Description</th>
			  <th>Date</th>
			  <th>Action</th>
			</tr>
		  </thead>';
		 
		
        if( $postCount > 0 ) {
				
				$i=0;			
			while( $rowValue = $objSql->fetchRow( $getUserPosts ) )
			{
	
					$template.='<tbody><tr>';
					$template.='<td> '.$rowValue["title"].'</td>
					<td>'.$rowValue["description"].'</td>
					<td>'.$rowValue["date"].'</td>	
					<td><a href="edit_post.php?postId='.$rowValue['id'].'">Edit |</a>
					<a href="javascript:confirmDelete('.$rowValue["id"].')">Delete</a></td>
					</tr>';
				
			}	
			$template.='<t/tbody></table></div>';

		}	
		else
		{
			
			 echo "No any record found.";
			
		}
		return $template;
	}

	function postForm( $gotError = '' )
	{
		$template='<div class="container-fluid h-100">
		<div class="row justify-content-center align-items-center h-100">
			<div class="col col-sm-6 col-md-6 col-lg-8 col-xl-3">
			  <form action="" method="POST" id="userRecordForm">
					<div class="form-group">
					    <label for="exampleInputEmail1">Post Name</label>
						<input class="form-control form-control-lg" placeholder="Post Title" type="text" name="postTitle" id="postTitle">
					</div>
					<div class="form-group">
					    <label for="exampleInputEmail1">Post Description</label>
						<input class="form-control form-control-lg" placeholder="Post Description"  name="postDesc" id="postDesc" type="text">
					</div>
					<div class="form-group">
					    <label for="exampleInputEmail1">Post Date</label>
						<input class="form-control form-control-lg datepicker" placeholder="Post Date"  name="postDate" id="datepicker" type="text">
					</div>
					<div class="form-group">
					 <input type="submit" class="btn btn-primary btn-lg btn-block" value="Add Post" name="postSubmit">
					</div>
					
				</form>
			</div>
		</div></div>';
		echo $template;
	}

	
	function submitPost() // Lastest php version we can use strict return type here
	{
		    $userId = $_SESSION['user_id'];
            $validRecordInsertSql = "INSERT INTO posts (`title`, `description`, `date`,`user_id`) 
			VALUES('$this->strPostTitle', '$this->strPostDescription', '$this->strPostDate',$userId)";
			$objSql = new SqlClass();
			$objSql->setAdvanceErr( true );
			
			 $userData = $objSql->executeSql( $validRecordInsertSql ); 
			
			//$userCount = $objSql->getNumRecord( $userData );

           if( $userData > 0 )
               {
				header('Location: index.php?successData=1');
			}
                else
				{
                     header('Location: index.php?error=1');
                }
				
    }

	function editpostData( $gotError = '' )
	{
		    $postId = $_GET['postId'];
		    $getPostsSQL = "select * from posts WHERE id=$postId order by id DESC"; 
			$objSql = new SqlClass();
			$objSql->setAdvanceErr( true );
			$getUserPosts = $objSql->executeSql( $getPostsSQL );
			$postCount = $objSql->getNumRecord( $getUserPosts );
			
			
			if( $postCount > 0 ) {
				$result = $objSql->fetchRow( $getUserPosts );
				$postId = $result['id'];
				$postTitle = $result['title'];
				$postDesc = $result['description'];
				$postDate = $result['date'];
				$template='<div class="container-fluid h-100">
				<div class="row justify-content-center align-items-center h-100">
					<div class="col col-sm-6 col-md-6 col-lg-8 col-xl-3">
					  <form action="" method="POST" id="editpostForm">
					       <input type="hidden" name="postId" id="postId"  value="'.$postId.'">
							<div class="form-group">
								<label for="exampleInputEmail1">Post Name</label>
								<input class="form-control form-control-lg" type="text" name="postTitle" id="postTitle" value="'.$postTitle.'">
							</div>
							<div class="form-group">
								<label for="exampleInputEmail1">Post Description</label>
								<input class="form-control form-control-lg" placeholder="Post Description"  name="postDesc" id="postDesc" type="text" value="'.$postDesc.'">
							</div>
							<div class="form-group">
								<label for="exampleInputEmail1">Post Date</label>
								<input class="form-control form-control-lg" placeholder="Post Date"  name="postDate" id="datepickeredit" type="text" value="'.$postDate.'">
							</div>
							<div class="form-group">
							 <input type="submit" class="btn btn-primary btn-lg btn-block" value="Update Post" name="postUpdate">
							</div>
						</form>
					</div>
				</div></div>';
				echo $template;
			}

	} 

	function updatepostData($postData){
		$postId = $postData['postId'];
		$postTitle = $postData['postTitle'];
		$postDesc = $postData['postDesc'];
		$postDate = $postData['postDate'];
		echo $getPostsSQL = "UPDATE  posts 
		SET `title` = '$postTitle', `description` = '$postTitle',`date` = '$postDate'
        WHERE id=$postId";
		$objSql = new SqlClass();
		$objSql->setAdvanceErr( true );
		$updatePosts = $objSql->executeSql( $getPostsSQL );
		//echo $postCount = $objSql->getNumRecord( $getUserPosts ); die;
		if( $updatePosts > 0 ){
			header('Location: index.php?successData=1');
		}
		else{
			echo "dfdfdsfds"; die;
		}
		}

		function deletepostData( $gotError = '' )
	{
		    $postId = $_GET['postId'];
		    $getPostsSQL = "DELETE from posts WHERE id=$postId";
			$objSql = new SqlClass();
			$objSql->setAdvanceErr( true );
			$deletePosts = $objSql->executeSql( $getPostsSQL );
			$postCount = $objSql->getNumRecord( $getUserPosts );
			if( $deletePosts > 0 ){
				header('Location: index.php?successData=1');
			}
			else{
				echo "dfdfdsfds"; die;
			}
	} 

}?>