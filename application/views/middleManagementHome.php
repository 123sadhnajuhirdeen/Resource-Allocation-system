
  <?php require_once('header.php'); ?>


<div class="main">

  <div class="mtop">
  
   <div class="mbar">
  		<!--Nav Bar Start -->
                
        	<button class="btn btn-success" style="margin:8px; margin-right: 0px; "  type="button" onClick="location.href = 'Home_page';" >Home</button>
        	<button class="btn btn-default"  type="button" onClick="location.href = 'employeePool';">Employee Pool </button>
        	<button class="btn btn-default" type="button" onClick="location.href = 'viewEmployees';">Employees </button>
        	<button class="btn btn-info"  type="button" onClick="location.href = 'common_notification_page';">Notifications <span class="badge"><?php print_r($num); ?>      </span></button>
    		<div class="lobtn">
    		<button class="btn btn-default" type="button" onClick="location.href = 'resetPassword';">Change Password</button>
                <button class="userPicture btn btn-default" type="button" onClick="location.href = 'empHomepage/<?php echo $this->session->userdata('UserId'); ?>';"><img src="<?php echo base_url(); ?>images/ProfilePictures/<?php echo $this->session->userdata('UserId'); ?>.jpg?<?php echo time(); ?>" alt="profilePicture" width="22" height="22" style="float:left;"><?php echo $this->session->userdata('UserName'); ?></button>
        	<button class="btn btn-default" type="button" onClick="location.href = 'logout';" ><img src="<?php echo base_url(); ?>images/powerbtn.png" width="12" height="15" /> Logout</button>
        
  		<!--Nav Bar End -->
        
    </div>
  </div>
    
    
    
     
    <div class=" panel panel-success" style="width:540px; float:left; position:relative; min-height:500px;">
    	<div class="panel-heading ">
      		<h3 class="panel-title" align="center">Employee Distribution</h3>
     	</div>
        <!--div class="panel-body" style="height:15px; width:100%;"></div-->
      <div class="panel-body">
      
      <!-- Chart Start-->
	<?php 
//print_r($empprojects);
            //echo $empprojects->Total;
            require('middleManagementchart.php');
           
        ?>
      <!-- Chart End-->
   
      </div>
    </div>
        <div class=" panel panel-success" style="width:540px; float:left; left:20px; position:relative; min-height:500px;">
    	<div class="panel-heading ">
      		<h3 class="panel-title" align="center">Time Elapsed</h3>
     	</div>
      <div class="panel-body" style="margin:10px; margin-top:0px;">

    
      
      <!-- Chart Start-->
  
      <?php
     // print_r($projects);
  foreach ($projects as $row){
      
    echo '
        <a data-toggle="collapse" data-parent="#accordion" href="#collapse'.$row->PId.'"><strong>'.$row->ProjectName.'</strong></a>
            <br>'.$row->StartDate.' to '.$row->EndDate.'
      <div class="progress">
                <div  style="width:'.$row->elapsed2.'%;" aria-valuemax="100" aria-valuemin="0"  role="progressbar" class="progress-bar animations"></div>
      </div>
          
          <div id="collapse'.$row->PId.'" class="panel-collapse collapse out">
            <div class="panel-body">';
    //print_r($row->Employees);
    foreach ($row->Employees as $row2){
        foreach ($row2->Allocation as $row3){
            echo '<a href="empHomepage/'.$row3->UserId.'">'.$row3->Fname.'</a> '.$row3->StartDate.' to '.$row3->EndDate.'<br>
                <div class="progress" style="width=200px;">
                    <div  style="width:'.$row3->elapsed.'%;" aria-valuemax="100" aria-valuemin="0"  role="progressbar" class="progress-bar progress-bar-success animations"></div>
                </div>
            ';
        }
       // ;
        
    }
   
    echo '
            </div>
          </div>             
            

';
  }
              
              ?>
     
      <!-- Chart End-->
      </div>
    </div>
    <?php require_once('footer.php'); ?>      
   
  </div>
  


</div>




</body>
</html>
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/1.11.1/jquery.min.js"></script>
    <script src="http://maxcdn.bootstrapcdn.com/bootstrap/3.2.0/js/bootstrap.min.js"></script>