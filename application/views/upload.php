<html>

<body>
<?php

 $this->load->library('session');

 echo $this->session->userdata('UserId');



$target_dir = "images/ProfilePictures/".$this->session->userdata('UserId').".jpg";
//#$target_dir = $target_dir . basename( $_FILES["uploadFile"]["name"]);
$uploadOk=1;

if (move_uploaded_file($_FILES["uploadFile"]["tmp_name"], $target_dir)) {
    echo "The file ". basename( $_FILES["uploadFile"]["name"]). " has been uploaded.";
} else {
    echo "Sorry, there was an error uploading your file.";
}
?>
</body>
</html>