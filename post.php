<div>		
       <table width="92%" border="0" align="center">
			<tr>
				<td> 
						<?php

							$post = new post();

							if( $_POST['postSubmit'] )
							{
								
								$post->insertPost($_POST);

								
								//echo $showAllPosts;
							

							}
					?>

				</td>
			</tr>
            <tr>
                <td>
                    <?php if (isset($_GET['error']))
                       {
                               echo "<span style='color:red;font-size:20px;'>Login name or password is not valid.</span>";                              
                            //echo 
                        }

                    ?>
                </td>
            </tr>
		</table>	

</div>
