    <?php require_once('header.php'); ?>

<style>

.posi{
position: fixed;
    /*top: 30px;*/
    right: 5px;

}

</style>

</head> 
<body>
    <div class="main">
        <div class="mtop">
            <div class="mbar">
            <button class="btn btn-default" style="margin:8px; margin-right: 0px; "  type="button" onClick="location.href = 'home_page';" >Home</button>
            <button class="btn btn-default"  type="button" onClick="location.href = 'employeePool';">Employee Pool </button>
            <button class="btn btn-default" type="button" onClick="location.href = 'viewEmployees';">Employees </button>
            <button class="btn btn-success"  type="button" >Notifications <span class="badge"><?php print_r($num); ?>      </span></button>
            <div class="lobtn">
            <button class="btn btn-default" type="button" onClick="location.href = 'resetPassword';">Change Password</button>
                <button class="userPicture btn btn-default" type="button" onClick="location.href = 'empHomepage/<?php echo $this->session->userdata('UserId'); ?>';"><img src="<?php echo base_url(); ?>images/ProfilePictures/<?php echo $this->session->userdata('UserId'); ?>.jpg?<?php echo time(); ?>" alt="profilePicture" width="22" height="22" style="float:left;"><?php echo $this->session->userdata('UserName'); ?></button>
            <button class="btn btn-default" type="button" onClick="location.href = 'logout';" ><img src="<?php echo base_url(); ?>images/powerbtn.png" width="12" height="15" /> Logout</button> </div>
                
                <!-- here notifications are coming -->
        </div>  <!-- end of mbar -->
        
            <div class="panel panel-success" style="position:relative; width:1100px">
                <div class="panel-heading" >
                <h3 class="panel-title">Notifications </h3>
                </div>
                <div class="panel-body">
                            <?php  
                                      
                                        foreach ($noti as $row) {
                                            
                                             echo '<div class="alert alert-info" role="alert" >';

                                            echo '<strong> <a href="empHomepage/'.$row->Nemp.'">';
                                            echo $row->Nempname.'';
                                            echo '</a>';
                                            echo ' is ';
                                            //echo '<a href="url">';
                                            if( $row->Message === 'Accepted'){

                                              echo '<font color="green">';
                                            }

                                            else{
                                              echo '<font color="red">';
                                            }
                                            echo $row->Message.'';

                                            echo '</font>';
                                            echo ' By ';
                                             echo '';
                                            echo $row->Nfrom.'';
                                            echo '.</strong>';
                                           // echo $row->NoteDate->d.'';
                                          //  echo ' days ago.';
                                            //echo $row->NoteDate->days.'';
                                            //print_r($row->NoteDate);
                                            echo '<strong><form action="unview_notification" method="post">
                                                      <input type="hidden" name="NoteId" value="'.$row->NoteId.'"></input>';
                                            echo '<button style="float:right; position:relative; top:-18px" class="close" type="submit" >X</button>';
                                            echo '</form></strong>';
                                            echo '</div>';
                                            //echo '<button type="button" class="close" aria-label="Close"><span aria-hidden="true">&times;</span></button>   href="unview_notification"';

                                        }
                                            
                                                    
                                            
                                                          ?>
                </div>
           </div>      
             
        <?php require_once('footer.php');?> 
    </div>
</body>
</html>