<?php
include ("includes/db.php");
session_start();
$userId = $_SESSION['user_id'];
$output = '';
if(!empty($_POST['query'])){
$searchKeyword = $_POST['query'];
$getPostsSQL = "select * from posts  WHERE user_id = $userId  AND
(`title` LIKE '".$searchKeyword."%' OR `description` LIKE '".$searchKeyword."%') order by id DESC";
}
else{
$getPostsSQL = "select * from posts  WHERE user_id = $userId order by id DESC"; 

}

$objSql = new SqlClass();
$objSql->setAdvanceErr( true );
$getUserPosts = $objSql->executeSql( $getPostsSQL );
$postCount = $objSql->getNumRecord( $getUserPosts );
if( $postCount > 0 ) 
{
$output.='
	<table class="table h-50" id="search_table">
	<thead>
	  <tr>
		<th>Title</th>
		<th>Description</th>
		<th>Date</th>
		<th>Action</th>
	  </tr>
	</thead>';
$i=0;			
while( $rowValue = $objSql->fetchRow( $getUserPosts ) )
{
$output.='
<tbody><tr>';
$output.='<td> '.$rowValue["title"].'</td>
<td>'.$rowValue["description"].'</td>
<td>'.$rowValue["date"].'</td>	
<td><a href="edit_post.php?postId='.$rowValue['id'].'">Edit |</a>
<a href="javascript:confirmDelete('.$rowValue["id"].')">Delete</a></td>
</tr>';
	
}	
$output.='<tbody></table></div>';

}	
else
{
	$output.='<span>No record found.</span>';
}
echo $output;
?>