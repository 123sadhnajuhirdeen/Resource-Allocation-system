<?php require_once('header.php');

?>
  	<!-- div align="center" -->
        <div class="main">
            <div class="mtop">
    	
		<div class="blank" >
        		<img src="<?php echo base_url(); ?>Images/login.png" style="position: relative; float: left; top: 30px; left:20%;">
                              
                        <form action='login_validation' class="form-signin" style="position: relative; top: 40px; float: left; left:20%; width: 300px;"role="form" method="post"  >
                          <div align="left">
                              <div class="form_header" style="font-size: 20px;">Login</div>
                              <div style="height: 30px;"><font  style="color:#FF0000; font-size: 10px;"><h5><?php echo validation_errors(); echo  $message; ?></h5></font></div>
                          </div>      
                               <label for="inputEmail" class="sr-only">Email address</label>
                               <input type="email" name="email" id="inputEmail" class="form-control" placeholder="Email address" required autofocus>
                               <label for="inputPassword" class="sr-only">Password</label>
                               <input style="top:5px;" name="password" type="password" id="inputPassword" class="form-control" placeholder="Password" required>
                                   
                          <div align="left">
                                <div class="checkbox">
                                      <label>
                                       <input type="checkbox" value="remember-me"> Remember me
                                      </label>
                                </div>        
                          </div>
                          <!--button class="btn btn-lg btn-primary btn-block" type="submit">Login</button-->
                          <input class="btn btn-lg btn-primary btn-block" type='Submit' value='Login' />
                          <?php

                            echo '<a href="#text" style="">Forgot Your Password</a>
                       	</form>';
                        
                      	 echo '<div class="lightbox" id="text">
       
                            
                                                                 <div class="box">
                                                    <a class="close" href="#">X</a>
                                                    <p class="title">Forgot Your Password!</p><br>
                                                    <div class="content">
                                                        <h5>
                                                        <form action="send_email" method="post">
                                                    
                                                        <table style="width:100%;"> 
                                                            <tr>
                                                                <td>Email Address:</td>
                                                                <td><input type="email" name="email"></td>
                                                            </tr>
                                                            
                                                           
                                                            
                                                        </table><br>
                                                         <input class="btn btn-success" type="submit" value="send Email Notification"></input>
                                                        ';
                                                        
                                                            //echo $row->ToName.' ';
                                                        
                                                        echo '</form></div>';
                                                        
                                                
                                                          
                                                        
                                                   
                                                 echo ' </div>
                                                </div>';
                                                
                                                 ?>

		</div> <!-- end of blank -->
       
               <?php require_once('footer.php');?>
              <?php require_once('accept.php'); ?>    
            </div>
        </div>
  </body>
</html>
