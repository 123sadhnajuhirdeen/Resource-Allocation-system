
<!--script type="text/javascript" src="<?php echo base_url(); ?>js/bootstrap.js"></script -->
<script src="<?php echo base_url(); ?>js/bootstrap.min.js"></script>




<style>

.myimg{
  position: relative;
 /* z-index: -4;*/
}

.textt{
  z-index:100;
  position:absolute;
}



/*img:hover {
display : block;

}*/


.pic{ 

opacity: 1; filter: 
alpha(opacity=100); 
} 

.pic:hover { 

opacity: 0.3; 
filter: 
alpha(opacity=30);
} 






</style>
<?php require_once('header.php');

?>
<div class="main">
  <div class="mtop">
  <div class="mbar">
      	<!--a href="#">Home <span class="badge">42</span></a-->
      <?php
        if($this->session->userdata('UserType') !== 'Employee') { 
          //if( $this->session->userdata('UserType') === 'Higher Management' ){
          echo '<button class="btn btn-default" style="margin:8px; margin-right: -9px; "  type="button" onClick="location.href = \'../home_page\';" >Home</button>
        	<button class="btn btn-default"  style="margin-left:9px; "  type="button" onClick="location.href = \'../employeePool\';">Employee Pool </button>
        	<button class="btn btn-default" type="button" onClick="location.href = \'../viewEmployees\';">Employees </button>
                
                <button class="btn btn-info" style=" "   type="button" onClick="location.href = \'../common_notification_page\';">Notifications <span class="badge">';
                print_r($num);
                echo '</span></button>
                <button  style="float: right; margin: 8px;" class="btn btn-default" type="button" onClick="location.href = \'../logout\';" ><img src="'.base_url().'images/powerbtn.png" width="12" height="15" /> Logout</button>

                <button style="float: right; margin: 8px; margin-right:-4px;" class="userPicture btn btn-default" type="button" onClick="location.href = \'../empHomepage/'.$this->session->userdata('UserId').'\';"><img src="'.base_url().'images/ProfilePictures/'.$this->session->userdata('UserId').'.jpg?'.time().'" alt="profilePicture" width="22" height="22" style="float:left;">'.$this->session->userdata('UserName').'</button>
                <button style="float: right; margin: 8px; margin-right: -4px; " class="btn btn-default" onClick="location.href = \'../resetPassword\';" type="button">Change Password</button>
                         ';

          //}

          /*elseif( $this->session->userdata('UserType') === 'Line Manager'){
               echo '<button class="btn btn-success" style="margin:8px; margin-right: -8px; "  type="button" onClick="location.href = \'../home_page\';" >Home</button>
          <button class="btn btn-default"  style="margin-left:9px; "  type="button" onClick="location.href = \'../employeePool\';">Employee Pool </button>
          <button class="btn btn-default" type="button" onClick="location.href = \'../viewEmployees\';">Employees </button>
                
                <button class="btn btn-info" style=" "   type="button" onClick="location.href = \'../requestHandling2\';">Notifications <span class="badge">4</span></button>
                <button  style="float: right; margin: 8px;" class="btn btn-default" type="button" onClick="location.href = \'../logout\';" ><img src="'.base_url().'images/powerbtn.png" width="16" height="18" /> Logout</button>
                <button style="float: right; margin: 8px; margin-right:-6px;" class="userPicture btn btn-default" type="button" onClick="location.href = \'../empHomepage/'.$this->session->userdata('UserId').'\';"><img src="'.base_url().'images/ProfilePictures/'.$this->session->userdata('UserId').'.jpg" alt="profilePicture" width="22" height="22" style="float:left;">'.$this->session->userdata('UserName').'</button>
                <button style="float: right; margin: 8px; margin-right: -6px; " class="btn btn-default" onClick="location.href = \'../resetPassword\';" type="button">Change Password</button>
                         ';

          }*/
        }
          else{
            echo '
                <button class="btn btn-success" style="margin:8px; margin-right: 0px; "  type="button" onClick="location.href = \'../home_page\';" >Home</button>
                <button class="btn btn-info" style="margin-left:0px; "   type="button" onClick="location.href = \'../common_notification_page\';">Notifications <span class="badge">';
            
                print_r($num);

                echo '</span></button>
                <button  style="float: right; margin: 8px;" class="btn btn-default" type="button" onClick="location.href = \'../logout\';" ><img src="'.base_url().'images/powerbtn.png" width="16" height="18" /> Logout</button>
                <button style="float: right; margin: 8px; margin-right: -6px; " class="btn btn-default" type="button" onClick="location.href = \'../resetPassword\';" >Change Password</button>
                ';
                ?>
                
                
                
                <?php
            
        }
        
        ?>

      
 
  </div>
    <div class="propic" style="position:relative;">
          
    	   <img class="proimg pic" id="proimg pic" src="<?php echo base_url(); ?>images/ProfilePictures/<?php echo $userInfo->UserId; ?>.jpg?<?php echo time(); ?>" alt="Profile Picture" width="209px" height="209px" style=" height: 209px; width: 209px;" />
        
          <div style="position: absolute; bottom: 0; left: 0.5em; color: #fff;">
                             
                            
                             <!--button onClick="location.href = 'upload_image';">Edit</button -->
                             <?php
                             if($this->session->userdata('UserId') == $userInfo->UserId){ 
                                  echo '<a onClick="location.href = \'#text\'" id="button">
                                  <img src="';
                                  echo base_url();
                                  echo 'images/camera.png" style="border:10px; margin-bottom:8px;">
                                  </a>';
                              }

                              else{
                                
                              }
                              ?>
                             
                              <!--a onClick="location.href = '../uploaddd_image';" id="button">Edit</a -->
                             <!--button onClick="location.href = 'image'">Edit</button -->
                            <div class="lightbox" id="text">
                                  <div class="box">
                                      <a class="close" href="#">X</a>
                                      <p class="title">Upload images!</p>
                                      
                                      <form id="form" action="../uploaddd_image" method="post" enctype="multipart/form-data">

                                          
                                          <input type="file" id="file" name="uploadfile" value="Upload File" onchange="javascript:document.getElementById('form').submit();"><br>
                                          
                                          <!--input type="submit" value="Upload File" name="submit" -->
                                          
                                      </form>


                                  </div>
                            </div>

                            <?php

                                      
                                        //$uploadOk=0;
                                         
                                        
                                         /* $target_dir = "images/ProfilePictures/".$this->session->userdata('UserId').".jpg";
                                          
                                         // echo $width.'/n'; 
                                          //echo $height;
                                        if (isset($_POST['submit'])) {

                                            

                                              $tmpp = $_FILES["uploadfile"]["tmp_name"];
                                             
                                              
                                              if (move_uploaded_file($tmpp, $target_dir)) {
                                                    echo "<script type='text/javascript'>alert('submitted successfully!')</script>";
                                              }
                                              else
                                              {
                                                  echo "<script type='text/javascript'>alert('failed!')</script>";
                                              }

                                              echo '<meta http-equiv="refresh" content="0">';
                                        }*/
                                          //header("Refresh:10");

                                          //echo '<meta http-equiv="refresh" content="0">';
                                        ?>
                            


          </div>                   
                            
        
         <!-- button class="myimg" >Edit</button -->

         
    </div>
    <div class="personalDetails panel panel-success" >
      <div class="panel-heading ">
      	<h3 class="panel-title" align="center">Personal Details</h3>
      </div>
       
      <div class="panel-body">
   	  	<div class="udata"><strong>Name</strong><span class="colan">:</span></div>
                <div class="uinfo"><?php echo $userInfo->Fname." ".$userInfo->Lname; ?></div>
      </div>
      <div class="panel-body">
   	  	<div class="udata"><strong>Designation</strong><span class="colan">:</span></div>
    	<div class="uinfo">
            <?php echo $userInfo->Designation." Tier ".$userInfo->Tier; ?>
        </div>
      </div>
      <!--div class="panel-body">
   	  	<div class="udata"><strong>Address</strong><span class="colan">:</span></div>
    	<div class="uinfo">
            <?php // echo $userInfo->Address; ?>
        </div>
      </div>
      <div class="panel-body">
   	  	<div class="udata"><strong>Mobile No</strong><span class="colan">:</span></div>
    	<div class="uinfo">
            <?php  //echo $userInfo->MobileNo; ?>
        </div>
      </div-->
    </div>
    <div class="ProjectDetails panel panel-success">
    	<div class="panel-heading ">
      		<h3 class="panel-title" align="center">Team & Project(s) Details</h3>
     	</div>
      <div class="panel-body">
   	  	<div class="udata"><strong>Team</strong><span class="colan">:</span></div>
    	<div class="uinfo">
        <?php
        
                  
        if($allocation){
            echo $allocation['TeamName'].' '.$allocation['StartDate'].' to '.$allocation['EndDate'];
        }else{
            echo '***Not Allocated to Team***';
        }
        ?>
        </div>
      </div>

      <div class="panel-body">
            <div class="udata"><strong>Remaining</strong><span class="colan">:</span></div>
            <div class="uinfo">
            <?php
                if($allocation){
                echo $allocation['Remaining'];         
                }else{
                    echo '***Not Allocated Yet***';
                }
            ?>
        
            </div>
                
   	  	<div class="udata"><strong>Allocation</strong><span class="colan">:</span></div>
      </div>
      
        <div style="width: 420px; height: 80px; overflow-y: auto;" class="panel-body">
   
                <table  width="350" border="1" style=" font-size: 12px; top: 5px; left: 15px; position: relative; border-radius: 5px;">

                
                <?php
                            if($allocation){
                                echo '  <tr>
                                            <td>Project</td>
                                            <td>Role</td>
                                            <td>Contribution</td>                    
                                        </tr>';
                                foreach ($allocation['Projects'] as $row){
                                echo '  <tr>
                                            <td  style="padding:2px;">'.$row->ProjectName.'</td>
                                            <td>'.$row->Role.'</td>
                                            <td>'.$row->Contribution.'%</td>
                                        </tr>';
                            }
                            }else{
                                echo '&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;***Not Allocated to projects***';
                            }
                ?>
            </table>  
        </div>
      </div>

  	<!--div class="mbottom"-->
     <div class="skillDetails panel panel-success" >
      <div class="panel-heading ">
          <h3 class="panel-title" align="center">Skills</h3>
        </div>     
      <div class="panel-body">
            <h4>
                    <?php
                    //print_r($skills);
                    foreach ($skills as $row)
                    {
                        echo '<div class=" label01"><span class=" label label-primary">';
                        echo $row->Skill;
                        if($this->session->userdata('UserId')===$userInfo->UserId){
                            echo '<a style="color: white;" href="../delete_skill/'.$row->SkillId.'">&#10006;</a>';
                       }
                        echo '</span></div>';
                    }
                    
                    ?>
                 
            </h4>
          </div>
         
         <?php
         if($this->session->userdata('UserId') === $userInfo->UserId){
             echo '
                    <div style=" padding: 5px; left: 10px; height: 45px; width: 185px; position: relative; background-color: #ccffcc; " >
                                  <br>
                                  <form  action="../add_skill" method="post" style="top:-15px; position: relative;">
                                      <input style="width: 130px; float: left" type="text" name="Skill" required placeholder="Add Skill"></input>
                                      <input style=" left: 10px; height: 25px; padding: 2px; float: left; position: relative; " class="btn btn-info"  type="submit" value="Add"></input>          
                                  </form>
                    </div>
                  ';
         }
         ?>
          
                        
      
      
    </div>
    <div class="expDetails panel panel-success">
    	<div class="panel-heading ">
      		<h3 class="panel-title" align="center">Experience</h3>
     	</div>
        <!--div class="panel-body" style="height:15px; width:100%;"></div-->
        <div class="panel-body" style=" overflow-y: auto; height: 230px;">
          <?php
                 //  print_r($cexperiance);
                          if(!$experiance && !$cexperiance){
                              echo '<br><h3 class="panel-title" align="center">***No experience***</h3>';
                              
                          }  
                              
                          if ($cexperiance) {
    
    
                foreach ($cexperiance as $row2)
                    {
                        echo '<div class=" alert alert-info" ><strong>';
                        echo $row2->TeamName.' -';
                        echo ' </strong> ';
                        echo $row2->ProjectName.', '.$row2->Contribution.'% ';
                        echo ' as ' ;
                        echo $row2->Role.' ';
                        
                        echo $row2->Time;
                        echo '</div>';
                        
                        
                    } 
                    }
                            
                foreach ($experiance as $row)
                    {
                        echo '<div class=" alert alert-info" ><strong>';
                        echo $row->TeamName.' -';
                        echo ' </strong> ';
                        echo $row->ProjectName.', '.$row->Contribution.'% ';
                        echo ' as ' ;
                        echo $row->Role.' ';
                        
                        echo $row->Time;
                        echo '</div>';
                        
                        
                    }
                          
          ?>
          
   	  	
      </div>
    </div>
    
    
    <!--/div-->
    <?php require_once('accept.php'); ?> 
    <?php require_once('footer.php'); ?>  
  </div>
  


</div>



</body>


<script type="text/javascript">
document.getElementById("file").onchange = function() {
    document.getElementById("form").submit();
  
};


</script>


</html>
