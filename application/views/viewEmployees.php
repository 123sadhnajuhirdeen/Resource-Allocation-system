
  <?php require_once('header.php'); ?>

<div class="main">

  <div class="mtop">
  
   <div class="mbar">
  		<!--Nav Bar Start -->
                <button class="btn btn-default" style="margin:8px; margin-right: 0px; "  type="button" onClick="location.href = 'home_page';" >Home</button>
        	<button class="btn btn-default"  type="button" onClick="location.href = 'employeePool';">Employee Pool </button>
        	<button class="btn btn-success" type="button" onClick="location.href = 'viewEmployees';">Employees </button>
        	<button class="btn btn-info"  type="button" onClick="location.href = 'common_notification_page';">Notifications <span class="badge"><?php print_r($num); ?>   </span></button>
    		<div class="lobtn">
    		<button class="btn btn-default" type="button" onClick="location.href = 'resetPassword';">Change Password</button>
                <button class="userPicture btn btn-default" type="button" onClick="location.href = 'empHomepage/<?php echo $this->session->userdata('UserId'); ?>';"><img src="<?php echo base_url(); ?>images/ProfilePictures/<?php echo $this->session->userdata('UserId'); ?>.jpg?<?php echo time(); ?>" alt="profilePicture" width="22" height="22" style="float:left;"><?php echo $this->session->userdata('UserName'); ?></button>
        	<button class="btn btn-default" type="button" onClick="location.href = 'logout';" ><img src="<?php echo base_url(); ?>images/powerbtn.png" width="12" height="15" /> Logout</button>
        
  		<!--Nav Bar End -->
        
    </div>
  </div>
    
    
    
     
    <div class=" panel panel-success" style="width:1100px; float:left; position:relative; min-height:450px;">
    	<div class="panel-heading ">
      		<h3 class="panel-title" align="center">Employees</h3>
     	</div>
        <!--div class="panel-body" style="height:15px; width:100%;"></div-->
      <div class="panel-body">
      
      <!-- pool Start-->
      <?php require_once('viewEmployeeSearch.php'); ?>

      <!-- pool End-->
      </div>
    </div>
        
    <?php require_once('footer.php'); ?>      
   
  </div>
  


</div>




</body>
</html>