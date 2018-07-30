<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<title>Notifications</title>
	<?php require_once('header.php'); ?>

<style>
  .holder{
    width: 1080px;
    border: 1px solid #C4CDE0;
    border-radius: 2px; 
  /*  margin: 0% 18%;*/
    height: auto;
    overflow: hidden;
  }
  .search-holder{
    margin: 3px;
    background: #ECEFF5;
    border-bottom: 1px solid #C4CDE0;
    height: 50px;
  }
  .title{
    font-size: 16px;
    font-weight: bold;
    width: 70%;
    color: #333333;
    margin-left: 20px;
  }
  .fl{
    float: left;
    line-height: 15px;
  }
  .textbox{
    margin-top: 10px;   
  }
  .textbox input{
    border: 1px solid #C4CDE0;
    outline: medium none;
    padding: 2px;
    width: 190px;
    font-size: 11px;
    height: 22px;
  }
  .developers{
     margin: 20px 25px;
  }
  .developer_holder{
    border-bottom: 1px solid #B2B2B2;
    width: 500px;
    min-height: 100px;
    margin-bottom: 5px;
    margin-top: 10px;
    margin-right: 10px;
  }
  .name{
    margin-left: 10px;
  }
  
  .name{
    /*font-size: 12px;
    font-weight: bold;*/
    color: #3B5998;
    cursor: pointer;
    text-decoration: none;  
  }
   .name:hover{
    text-decoration: underline; 
  }
    
  </style>

<!-- script>
$(document).ready(function(){
    $(".search").keyup(function(){
        var str = $(".search").val();
        $(".developers .developer_holder").each(function(index){
            if($(this).attr("id")){
                if(!$(this).attr("id").match(new RegExp(str, "i"))){
                    $(this).fadeOut("fast");
                }else{
                    $(this).fadeIn("slow");
                }
            }
        });     
    });
});
  var _gaq = _gaq || [];
  _gaq.push(['_setAccount', 'UA-19096935-1']);
  _gaq.push(['_trackPageview']);

  (function() {
    var ga = document.createElement('script'); ga.type = 'text/javascript'; ga.async = true;
    ga.src = ('https:' == document.location.protocol ? 'https://ssl' : 'http://www') + '.google-analytics.com/ga.js';
    var s = document.getElementsByTagName('script')[0]; s.parentNode.insertBefore(ga, s);
  })();
</script -->
</head>	
<body>
    <div class="main">
        <div class="mtop">
            <div class="mbar">
        	       <button class="btn btn-default" style="margin:8px; margin-right: 0px; "  type="button" onClick="location.href = 'home_page';" >Home</button>
        	       <button class="btn btn-default"  type="button" onClick="location.href = 'employeePool';">Employee Pool </button>
        	       <button class="btn btn-default" type="button" onClick="location.href = 'viewEmployees';">Employees </button>
        	       <button class="btn btn-success"  type="button" onClick="location.href = 'common_notification_page';">Notifications <span class="badge"><?php print_r($num); ?>   </span></button>
    		    <div class="lobtn">
                <button class="btn btn-default" type="button" onClick="location.href = 'resetPassword';">Change Password</button>
                <button class="userPicture btn btn-default" type="button" onClick="location.href = 'empHomepage/<?php echo $this->session->userdata('UserId'); ?>';"><img src="<?php echo base_url(); ?>images/ProfilePictures/<?php echo $this->session->userdata('UserId'); ?>.jpg?<?php echo time(); ?>" alt="profilePicture" width="22" height="22" style="float:left;"><?php echo $this->session->userdata('UserName'); ?></button>
                <button class="btn btn-default" type="button" onClick="location.href = 'logout';" ><img src="<?php echo base_url(); ?>images/powerbtn.png" width="12" height="15" /> Logout</button>

    		    
            	
                <!-- here notifications are coming -->
        </div>  <!-- end of mbar -->
        
       		<div class="panel panel-success" style="position:relative; margin-top:20px; width:1100px">
				      <div class="panel-heading" >
				      <h3 class="panel-title" align="center">Notifications </h3>
				      </div>
				  <div class="panel-body">
                            <?php

                                       
                                        //$count = 0;
                                        foreach ($notification as $row) {
                                            echo '<div class="alert alert-info" role="alert" >';
                                            echo '<strong> <a href="empHomepage/'.$row->Rto.'">';
                                            echo $row->ToName.' ';
                                          
                                            echo '</a></strong>';
                                            echo 'is requested by <a href="empHomepage/'.$row->Rfrom.'"><strong>';
                                            echo $row->fromname.'';
                                            echo '</strong></a>';
                                            echo ', for <strong>';
                                            echo $row->proname.'</strong> ';
                                            echo ' ';
                                            echo 'project in ';
                                            echo '<strong>';
                                            echo $row->teamname.'</strong> ';

                                            echo ' as <strong>';
                                            echo $row->Role.' ';
                                            echo '</strong><br/> from ';
                                            echo $row->stardate.' ';
                                            echo 'to ';
                                            echo $row->endDate.' ';
                                           // echo '</br>';
                                            echo '"';
                                            echo $row->Comment.' ';
                                             echo '"';
                                            //echo $row->val.' ';
                                            echo '<div style="float:right; width: 300px; position: relative; top:-45px ">';
                                            
                                            
                                           echo 
                                            
                                                    '<span class="relativetime"  style="position: relative;  float:left; top:32px;">'.$row->reqDate.'</span>';
                                                    
                                                            
                                            
                                            
                                                
                                                   /* 
                                                   <span class="relativetime"  style="position: relative;  float:left; top:18px;">'.$row->reqDate.'</span>'; 
                                                   '<form action="accept_request" method="post">
                                                            <span class="relativetime" title="2014-03-22 14:59:53Z">';
                                                            echo $row->reqDate.'</span>
                                                            <input type="hidden" name="UserId" value="'.$row->Rto.'"></input>
                                                            <input type="hidden" name="TeamId_0" value="'.$row->TeamId.'"></input>
                                                            <input type="hidden" name="StartDate" value="'.$row->stardate.'"></input>                                              
                                                            <input type="hidden" name="EndDate" value="'.$row->endDate.'"></input>*/
                                                        //echo '    <input class="btn btn-warning" style="margin-right: 10px;"  type="button" value="Accept"></input>
                                                          //  <input class="btn btn-warning" style="position: relative; float:right;"   type="submit" value="Accept">
                                                        
                                                        echo '<button class="btn btn-warning"  type="button"   style="position: relative; float:right; top:28px;" onClick="location.href = \'#text'.$row->val.$row->Rto.'\';">Accept</button>';        
                                                      echo '<form action="reject_request" method="post">
                                                                <input type="hidden" name="UserId" value="'.$row->Rto.'"></input>
                                                                <input type="hidden" name="UserId_1" value="'.$row->Rfrom.'"></input>
                                                                <input type="hidden" name="TeamId_0" value="'.$row->TeamId.'"></input>
                                                                <input type="hidden" name="StartDate" value="'.$row->stardate.'"></input>                                              
                                                                <input type="hidden" name="EndDate" value="'.$row->endDate.'"></input>
                                                                <input type="hidden" name="EndDate" value="'.$row->endDate.'"></input>
                                                                <input type="hidden" name="Role" value="'.$row->Role.'"></input>
                                                                <input type="hidden" name="RequestId" value="'.$row->RequestId.'"></input>';
                                                                
                                                               // <input class="btn btn-danger" style="position: relative; margin-right: 10px; float:right;" type="submit" value="Reject">                                                                   
                                                          echo '  <input class="btn btn-danger" style="position: relative; margin-right: 10px; float:right; top:28px;" type="submit" value="Reject"></input>
                                                           </form>';
                                                                   
                                                            
                                            
                                            echo '</div>
                                                </div>';
                                                
                                            echo '<div class="lightbox" id="textx'.$row->Rto.'">
  
                                                
                                                  <div class="box">
                                                    <a class="close" href="#">X</a>
                                                    <p class="title">Confirmation</p>
                                                    
                                                   
                                                        <form action="accept_request" method="post">';
                                                          echo $row->ToName.' ';
                                          
                                                          echo '</br>';
                                                          echo $row->teamname.' ';
                                                          echo '</br>
                                                            <input type="hidden" name="UserId" value="'.$row->Rto.'"></input>
                                                            <input type="hidden" name="UserId_1" value="'.$row->Rfrom.'"></input>

                                                            <input type="hidden" name="TeamId_0" value="'.$row->TeamId.'"></input>
                                                            <input type="hidden" name="StartDate" value="'.$row->stardate.'"></input>                                              
                                                            <input type="hidden" name="EndDate" value="'.$row->endDate.'"></input>
                                                            <input type="hidden" name="NoteId" value="'.$row->RId.'"></input>
                                                            <input type="hidden" name="PId" value="'.$row->PId.'"></input>
                                                            <input type="hidden" name="Role" value="'.$row->Role.'"></input>



                                                            <input type="date" name="StartDate" value="'.$row->stardate.'"></input>                                              
                                                            <input type="date" name="EndDate" value="'.$row->endDate.'"></input>
                                                            
                                                          <input type="submit" value="Accept"></input>  
                                                            
                                                        </form>
                                                        
                                                   
                                                  </div>
                                                </div>'; 

                                                echo '<div class="lightbox" id="texty'.$row->Rto.'">

                            
                                                                 <div class="box">
                                                    <a class="close" href="#">X</a>
                                                    <p class="title">Warning!</p>';
                                                        
                                                            echo $row->ToName.' ';
                                                            echo ' is not in the pool.
                                                      
                                                        
                                                
                                                          
                                                        
                                                   
                                                  </div>
                                                </div>'; 




                                            /*echo '<div class="lightbox" id="reject'.$count.'">
  
                                                
                                                  <div class="box">
                                                    <a class="close" href="#">X</a>
                                                    <p class="title">Confirmation</p>
                                                    
                                                    <div class="content">
                                                        <form action="reject_request" method="post">
                                                                <input type="hidden" name="UserId" value="'.$row->Rto.'"></input>
                                                                <input type="hidden" name="TeamId_0" value="'.$row->TeamId.'"></input>
                                                                <input type="hidden" name="StartDate" value="'.$row->stardate.'"></input>                                              
                                                                <input type="hidden" name="EndDate" value="'.$row->endDate.'"></input>


                                                        
                                                
                                                            <input name="EndDate" placeholder="hghg" value="'.$row->endDate.'"></input>

                                                          <input class="btn" type="button" value="reject"></input>  
                                                            
                                                        </form>
                                                        
                                                    </div>
                                                  </div>
                                                </div>'; */
                                            
                                            //$count++;

                                            }
                            ?>
            	</div>
           </div>      
         <?php require_once('accept.php'); ?>    
        <?php require_once('footer.php');?> 
    </div>
</body>
</html>