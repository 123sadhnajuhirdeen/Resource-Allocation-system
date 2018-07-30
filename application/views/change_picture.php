
<html>
<script type="text/javascript" src="<?php echo base_url(); ?>js/bootstrap.js"></script>
<script src="<?php echo base_url(); ?>js/bootstrap.min.js"></script>
<body>
<form method="post" enctype="multipart/form-data">


  Please choose a file: <input type="file" name="uploadFile"><br>
  <input type="submit" onClick="location.href = '#textxyy';" value="Upload File">
</form>

  							<div class="lightbox" id="textxyy">
                                  <div class="box">
                                      <a class="close" href="#">X</a>
                                      <p class="title">New profile picture Uploaded!</p>
                                      
                                      <?php
										$target_dir = "images/ProfilePictures/".$userid.".jpg";
										
										echo getcwd() . "\n";
										//$target_dir.print_r($userid).".jpg";
										//#$target_dir = $target_dir . basename( $_FILES["uploadFile"]["name"]);
										$uploadOk=1;
										//foreach ($userid as $key ) {
												//print_r($userid);
											# code...
													if (move_uploaded_file($_FILES["uploadFile"]["tmp_name"], $target_dir )  ) {
										    			echo "The file ". basename( $_FILES["uploadFile"]["name"]). " has been uploaded.";
														
													} 
													else {
										    			echo "Sorry, there was an error uploading your file.";
													}
										//}
										
										?>

                                  </div>
                            </div> 

  <?php require_once('accept.php'); ?> 

</body>
</html>