
<?php require_once('header.php'); ?>


<script src="https://ajax.googleapis.com/ajax/libs/jquery/1.11.1/jquery.min.js"></script>
<script src="http://maxcdn.bootstrapcdn.com/bootstrap/3.2.0/js/bootstrap.min.js"></script>

<style>
th {
  text-align: center;

}

td{
    text-align: right;
    width: 120px;
}

.table1_td{
   text-align: right; 
}

</style>

<div class="main">
	<div class="mtop">
    	<div class="mbar">
        	<button class="btn btn-success" style="margin:8px; margin-right: 0px; "  type="button" onClick="location.href = 'home_page';">Home</button>
        	<button class="btn btn-default"  type="button" onClick="location.href = 'employeePool';">Employee Pool </button>
        	<button class="btn btn-default" type="button" onClick="location.href = 'viewEmployees';">Employees </button>
            <button class="btn btn-default" type="button" onClick="location.href = '#';">Reports </button>
        	<button class="btn btn-info"  type="button" onClick="location.href = 'common_notification_page';">Notifications <span class="badge">
            <?php print_r($num); ?>   
            </span></button>
    		
            <div class="lobtn">
    		<button class="btn btn-default" type="button" onClick="location.href = 'resetPassword';">Change Password</button>
                <button class="userPicture btn btn-default" type="button" onClick="location.href = 'empHomepage/<?php echo $this->session->userdata('UserId'); ?>';"><img src="<?php echo base_url(); ?>images/ProfilePictures/<?php echo $this->session->userdata('UserId'); ?>.jpg?<?php echo time(); ?>" alt="profilePicture" width="22" height="22" style="float:left;"><?php echo $this->session->userdata('UserName'); ?></button>
        	<button class="btn btn-default" type="button" onClick="location.href = 'logout';" ><img src="<?php echo base_url(); ?>images/powerbtn.png" width="12" height="15" /> Logout</button>
       </div>
	</div>
    
    <!-- div class="blank" -->
    <!--  Added current project table-->
    <div class="panel panel-success" style="position:relative; width:1100px;">

		<div class="panel-heading" >

		<h3 class="panel-title" align="center">Teams Details</h3>
		</div>
		<div class="panel-body">
        	<div class="col-md-3">
                <table class="table table-bordered">
                    <thead>
                        <tr> 
                            
                            <th>Team Name</th>
                            <th>Programmers</th>
                            <th>Testers</th>
                            <th>Total</th>
                            
                            
                        </tr>
                    </thead>
                    <tbody>

                        <?php 
                        //print_r($teamDetails);
                        $count = 0;

                        foreach ($teamDetails as $rows) {
                           
                    //print_r($teamDetails);       
                                echo '<tr>
                                    <td>';
                               
                                    echo  '<button style="float:left; height:20px; width:100%; padding:0px; margin:0px;" type="button" class="btn btn-info" data-toggle="collapse" data-target="#demo';
                                    echo $rows->TeamName.'';
                                    echo '">';
                                    echo $rows->TeamName.'';
                                   
                                    echo '</button>
                                    

                                    <br><div id="demo';
                                    echo $rows->TeamName.'';
                                    echo '" class="collapse out">';
                                    echo '<div class="jumbotron" style="width:800px;">';
                                                
                                                echo  '<h3 class="blog-post-title" align="center">';

                                                echo $rows->TeamName.'';
                                                echo ' Team Project Details</h3><br><table class="table table-bordered" >';
                                              //print_r($rows->proj);
                                                echo '<thead>
                                                            <th>Project Name</th>
                                                            <th>Start Date</th>
                                                            <th>End Date</th>
                                                            <th>Programmers</th>
                                                            <th>Testers</th>
                                                            <th>Total</th>
                                                        </thead>';
                                                foreach ($rows->proj as $key) {
                                                    
                                                    echo '<tbody><tr><h4><td style="text-align:left;">';
                                                    
                                                   // echo '</td><td>';
                                                    echo $key->ProjectName.'';
                                                    echo '</td>';
                                                    /*********************************/

                                                    echo '<td style="text-align:center;">';
                                                    echo $key->StartDate.'';
                                                    echo '</td>';

                                                    /*********************************/

                                                    echo '<td style="text-align:center;">';
                                                    echo $key->EndDate.'';
                                                    echo '</td>';
                                                    echo '<td>';
                                                    echo $key->num_of_Dev.'';
                                                    echo '</td>';
                                                    echo '<td>';
                                                    echo $key->num_of_QA.'';
                                                    echo '</td>';
                                                    echo '<td>';
                                                    echo $key->total.'';
                                                    echo '</td>';
                                                    
                                                    echo '</h4></tr>';
                                                   // $count++;

                                                  
                                                    
                                                }

                                                echo '</tbody></table>';
                                                
                                                 echo '<a href="mm_home/'.$rows->TeamId.'">View '.$rows->TeamName.'»</a>';
                                                //echo require('addProject_form.php');
                                    echo '</div>'; ?>
                                    <?php //require('addProject_form.php'); ?>
                                    <?php
                                    echo '</div>';
                                   
                                    echo '</form>';

                                    
                                
                                
                                

                                echo '</td>
                                    <td>';
                                
                                echo $rows->num_of_Dev.' ';
                                echo '</td><td>';

                                echo $rows->num_of_QA.' ';
                                echo '</td><td>';
                                echo $rows->total.'';

                                echo '</td></tr>';


                                
                        }

                       
                        ?>
                        
                    </tbody>
                </table>
                <?php //require('addProject_form.php'); ?>
                
                
            </div>
            
        
        
        </div>
	<!--/div -->
    <!-- end of panel -->
    
    <!-- start of panel -->
    
    <!-- start of panel -->
    <div class="panel panel-success" style="position:relative;  margin-top:25px; width:540px; float:left;  height:410px; ">
		<div class="panel-heading">
			<h3 class="panel-title" align="center">Employee Distribution </h3>
		</div>
		<div class="panel-body" style="width: 550px;">
        		<?php require('projectDistributionChart.php');?>
        </div>
    </div>
    <!-- end of panel -->
    <div class="panel panel-success" style="position:relative;  margin-top:25px;width:539px; float:left; left:21px;  height:410px; ">
        <div class="panel-heading">
            <h3 class="panel-title" align="center">Add Projects </h3>
        </div>
        <div class="panel-body" style="width: 550px;">
                <!--- -->
                <div class="container">
                    <!--h2>Project From</h2 -->
                        <form class="form-horizontal" action="higher_Addproject" method="post" >

                            
                        <div class="form-group">
                            <label class="col-sm-5 control-label" style="float:left;">Project Name:<br></label>
                            <div class="col-sm-3">
                                <br><input style="width: 423px;" name="ProjectName" class="form-control" id="projectname" placeholder="Enter Project Name">
                            </div>
                        </div>
                        <div class="form-group">
                            <label class="col-sm-5 control-label" style="float:left;">Team Name:<br></label>
                            <?php
                                echo ' <div class="col-sm-5"><br><input style="width: 423px;" list="teamDetails" name="team" class="form-control" placeholder="Select Team " required multiple>
                                      <datalist id="teamDetails">';                     
                                        foreach ($teamDetails as $row) {
                                        echo '<option value="'.$row->TeamName.'">';

                                        }
                                        
                                        echo '</datalist></input></div>';
                                        ?>
                            
                        </div>
                        <div class="form-group" style="float:left;">
                            <label class="col-sm-5 control-label" style="float:left;">Start Date:</label>
                            <div class="col-sm-5">
                                <input id="meeting_1" type="date" name="startdate" value=""/>
                                <!-- input class="form-control" name="startdate" id="startdate" placeholder="Start Date" -->
                            </div>
                        </div>
                        </div>
                        <div class="form-group" style="float:left;">
                            <label class="col-sm-5 control-label" style="float:left;">End Date:</label>
                            <div class="col-sm-5">
                                <input id="meeting" type="date" name="enddate" value=""/>
                                <!-- input class="form-control" name="enddate" id="enddate" placeholder="End Date" -->
                            </div>
                        </div>
                        <button type="submit" class="btn btn-default" style="margin-top: 60px; margin-left:100px;">Add</button>
                        </form>
                </div>

                <!-- -->
        </div>
    </div>    
    <?php require_once('footer.php');?>      
    </div>
</div>


