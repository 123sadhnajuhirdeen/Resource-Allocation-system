
  <script type="text/javascript" async src="<?php echo base_url(); ?>js/ga.js"></script>
  <script src="<?php echo base_url(); ?>js/jquery-1.7.1.min.js"></script>
  <link rel="stylesheet" type="text/css" href="<?php echo base_url(); ?>css/windowstyle.css"/>
 
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
  .addbtn {
	/*bottom:0px; */
	height:20px; 
	float:right;
	padding:2px; 
	margin-right:10px;
	font-size:10px; 
}
  .addbtn2 {
	/*bottom:0px; */
        width: 50px;
	height:25px; 
	float:right;
	padding:2px; 
	margin-right:10px;
	font-size:12px; 
}
  </style>

   <div class="holder">
     <div class="search-holder">
	   <div class="title fl" style="top:-10px; position:relative; width: 250px;"><h3>Employees</h3>
           
           </div>
         

         <div style=" position: relative; left: 350px; top: 10px; float: left;">
                     <input type="radio" name="choose" id="Dev" checked="checked"/> Dev 
                    <input type="radio" name="choose" id="QA"/> QA
                    <input type="radio" name="choose" id="All"/>All                   
                    
	   </div>
         <div class="textbox fl" style=" left:  400px; position: relative;">
                    
                    <input type="text" name="search" class="search se" value="" style="height:30px; font-size:14px; "  placeholder="Search Employees" autocomplete="off">
	   </div>
	 </div>
	 <div class="developers" id="Dev_block">
     
        
                <?php
                 foreach ($employees as $row) {
                      if($row->Type==='Dev'){
                     echo '<div class="developer_holder fl" id="'.$row->UserName.'" style="display: block;">
        	<div class="photo fl"><img src="';
                     echo base_url();
                     echo 'images/ProfilePictures/';
                     echo $row->UserId.'.jpg" width="80" height="80"></div>
            <div class="name fl"><a href="">
                	<b>'.$row->UserName.'</b></a>';
                         if($this->session->userdata('UserType') === 'Line Manager') {  

echo '<button class="btn btn-info addbtn"  type="button" onClick="location.href = \'#text'.$row->UserId.'\';" >Add to Pool</button>';
echo '<button class="btn btn-info addbtn"  type="button" onClick="location.href = \'#text2'.$row->UserId.'\';" >Add to Project</button>';
   }                 
                        echo '<br>'.$row->Designation.'<div class=" label02" style="top:4px;"><span class=" label label-danger" >'.$row->Type.'</span></div><br><h5 style="width:400px;">';

// print_r($row->Skills);
                    foreach ($row->Skills as $skill){
                         echo '<div class=" label02 fl"><span class=" label label-primary">'.$skill->Skill.'</span></div>';
                         
                         echo '
                             <div class="lightbox" id="text'.$row->UserId.'">
                                <div class="box">
                                    <a class="close" href="#">X</a>
                                        <p class="title">Add to Pool</p><br>
                                            '.$row->UserName.'
                                            <div class="content">
                                                <h5>
                                                    <form action="add_to_pool" method="post">
                                                        from:&nbsp; 
                                                        <input type="date" name="from" required></input>
                                                        &nbsp; To: &nbsp; 
                                                        <input type="date" name="to" required></input>
                                                        <input type="hidden" name="UserId" value="'.$row->UserId.'"></input>                                               
                                                        <input class="btn btn-info addbtn2"  type="submit" value="add"></input>           
                                                    </form>
                                                </h5>
                                            </div>
                                     </div>
                                </div>'; 
                         echo '
                             <div class="lightbox" id="text2'.$row->UserId.'">
                                <div class="box">
                                    <a class="close" href="#">X</a>
                                        <p class="title">Add to Project</p><br>
                                            '.$row->UserName.'
                                            <div class="content">
                                                <h5>
                                                    <form action="add_to_project" method="post">
                                                        Project
                                                        <input list="projects" name="project" placeholder="Select Project" required>
                                                            <datalist id="projects">';
                                                                     print_r($projects);
                                                                     foreach ($projects as $row2) {
                                                                         echo '<option value="'.$row2->ProjectName.'">';

                                                                     }

                                                                      echo '</datalist></input>Contribution
                                                                        <input type="text" name="contribution" style="width:40px;" required>%</input>
                                                                        <input type="hidden" name="UserId" value="'.$row->UserId.'"></input>                                               
                                                                        <input class="btn btn-info addbtn2"  type="submit" value="add"></input>           
                                                    </form>
                                                </h5>
                                            </div>
                                    </div>
                                </div>';
                         
                         
                    }                   
                                          
                     echo '</h5> </div></div>';
                 } 
                 
                 }
                
                
                ?>
         </div>
             
             
             	 <div class="developers" id="QA_block">
     
        
                <?php
                 foreach ($employees as $row) {
                      if($row->Type==='QA'){
                     echo '<div class="developer_holder fl" id="'.$row->UserName.'" style="display: block;">
        	<div class="photo fl"><img src="';
                     echo base_url();
                     echo 'images/ProfilePictures/';
                     echo $row->UserId.'.jpg" width="80" height="80"></div>
            <div class="name fl"><a href="">
                	<b>'.$row->UserName.'</b></a>';
                         if($this->session->userdata('UserType') === 'Line Manager') {  

echo '<button class="btn btn-info addbtn"  type="button" onClick="location.href = \'#text'.$row->UserId.'\';" >Add to Pool</button>';
echo '<button class="btn btn-info addbtn"  type="button" onClick="location.href = \'#text2'.$row->UserId.'\';" >Add to Project</button>';
   }                 
                        echo '<br>'.$row->Designation.'<div class=" label02" style="top:4px;"><span class=" label label-danger" >'.$row->Type.'</span></div><br><h5 style="width:400px;">';

// print_r($row->Skills);
                    foreach ($row->Skills as $skill){
                         echo '<div class=" label02 fl"><span class=" label label-primary">'.$skill->Skill.'</span></div>';
                         
                         echo '
                             <div class="lightbox" id="text'.$row->UserId.'">
                                <div class="box">
                                    <a class="close" href="#">X</a>
                                        <p class="title">Add to Pool</p><br>
                                            '.$row->UserName.'
                                            <div class="content">
                                            <h5>
                                            <form action="add_to_pool" method="post">
                                                from:&nbsp; 
                                                <input type="date" name="from" required></input>
                                                &nbsp; To: &nbsp; 
                                                <input type="date" name="to" required></input>
                                                <input type="hidden" name="UserId" value="'.$row->UserId.'"></input>                                               
                                                <input class="btn btn-info addbtn2"  type="submit" value="add"></input>           
                                            </form>
                                            </h5>
                                            </div>
                                </div>
                                </div>';
                         echo '
                             <div class="lightbox" id="text2'.$row->UserId.'">
                                <div class="box">
                                    <a class="close" href="#">X</a>
                                        <p class="title">Add to Project</p><br>
                                            '.$row->UserName.'
                                            <div class="content">
                                                <h5>
                                                    <form action="add_to_project" method="post">
                                                        Project
                                                        <input list="projects" name="project" placeholder="Select Project" required>
                                                            <datalist id="projects">';
                                                                     print_r($projects);
                                                                     foreach ($projects as $row2) {
                                                                         echo '<option value="'.$row2->ProjectName.'">';

                                                                     }

                                                                      echo '</datalist></input>Contribution
                                                                        <input type="text" name="contribution" style="width:40px;" required>%</input>
                                                                        <input type="hidden" name="UserId" value="'.$row->UserId.'"></input>                                               
                                                                        <input class="btn btn-info addbtn2"  type="submit" value="add"></input>           
                                                    </form>
                                                </h5>
                                            </div>
                                    </div>
                                </div>';
                         
                         
                    }                   
                                          
                     echo '</h5> </div></div>';
                 } 
                 
                 }
                
                
                ?>
             
             
     
      
     
        <!--div class="developer_holder fl" id="Tharindu Madhushanka" style="display: block;">
        	<div class="photo fl"><img src="images/ProfilePictures/126.jpg" width="80" height="80"></div>
            <div class="name fl"><a href="employeeHome.php">
                	<b>Tharindu Madhushanka</b></a>  Free 01/12/2014 - 01/02/2015<br>
                    Intern at Fires<br>                    
      		<h5 style="width:400px;">
            	<div class=" label02 fl"><span class=" label label-primary">Java</span></div>
            	<div class=" label02 fl"><span class=" label label-primary">C++</span></div>
            	<div class=" label02 fl"><span class=" label label-primary">PHP</span></div>
            	<div class=" label02 fl"><span class=" label label-primary">MySQL</span></div>
            	<div class=" label02 fl"><span class=" label label-primary">HTML</span></div>
            	<div class=" label02 fl"><span class=" label label-primary">JavaScript</span></div>
            	<div class=" label02 fl"><span class=" label label-primary">Python</span></div>
            	<div class=" label02 fl"><span class=" label label-primary">Android</span></div>
            	<div class=" label02 fl"><span class=" label label-primary">C++</span></div>
            	<div class=" label02 fl"><span class=" label label-primary">C#</span></div>
            	<div class=" label02 fl"><span class=" label label-primary">JavaScript</span></div>
            	<div class=" label02 fl"><span class=" label label-primary">Python</span></div>
            	<div class=" label02 fl"><span class=" label label-primary">Android</span></div>
            	<div class=" label02 fl"><span class=" label label-primary">C++</span></div>
            	<div class=" label02 fl"><span class=" label label-primary">C#</span></div>
            	<div class=" label02 fl"><span class=" label label-primary">JavaScript</span></div>
            	<div class=" label02 fl"><span class=" label label-primary">Python</span></div>
            	<div class=" label02 fl"><span class=" label label-primary">Android</span></div>
            	<div class=" label02 fl"><span class=" label label-primary">C++</span></div>
            	<div class=" label02 fl"><span class=" label label-primary">C#</span></div>
             </h5>       
               
            </div>
        </div-->
        
     
        <!--div class="developer_holder fl" id="Tharindu Madhushanka" style="display: block;">
        	<div class="photo fl"><img src="images/ProfilePictures/126.jpg" width="80" height="80"></div>
            <div class="name fl"><a href="employeeHome.php">
                	<b>Tharindu Madhushanka</b></a>  Free 01/12/2014 - 01/02/2015<br>
                    Intern at Fires<br>                    
      		<h5 style="width:400px;">
            	<div class=" label02 fl"><span class=" label label-primary">Java</span></div>
            	<div class=" label02 fl"><span class=" label label-primary">C++</span></div>
            	<div class=" label02 fl"><span class=" label label-primary">PHP</span></div>
            	<div class=" label02 fl"><span class=" label label-primary">MySQL</span></div>
            	<div class=" label02 fl"><span class=" label label-primary">HTML</span></div>
            	<div class=" label02 fl"><span class=" label label-primary">JavaScript</span></div>
            	<div class=" label02 fl"><span class=" label label-primary">Python</span></div>
            	<div class=" label02 fl"><span class=" label label-primary">Android</span></div>
            	<div class=" label02 fl"><span class=" label label-primary">C++</span></div>
            	<div class=" label02 fl"><span class=" label label-primary">C#</span></div>
            	<div class=" label02 fl"><span class=" label label-primary">JavaScript</span></div>
            	<div class=" label02 fl"><span class=" label label-primary">Python</span></div>
            	<div class=" label02 fl"><span class=" label label-primary">Android</span></div>
            	<div class=" label02 fl"><span class=" label label-primary">C++</span></div>
            	<div class=" label02 fl"><span class=" label label-primary">C#</span></div>
            	<div class=" label02 fl"><span class=" label label-primary">JavaScript</span></div>
            	<div class=" label02 fl"><span class=" label label-primary">Python</span></div>
            	<div class=" label02 fl"><span class=" label label-primary">Android</span></div>
            	<div class=" label02 fl"><span class=" label label-primary">C++</span></div>
            	<div class=" label02 fl"><span class=" label label-primary">C#</span></div>
             </h5>       
               
            </div>
        </div-->
        
     
        <!--div class="developer_holder fl" id="Tharindu Madhushanka" style="display: block;">
        	<div class="photo fl"><img src="images/ProfilePictures/126.jpg" width="80" height="80"></div>
            <div class="name fl"><a href="employeeHome.php">
                	<b>Tharindu Madhushanka</b></a>  Free 01/12/2014 - 01/02/2015<br>
                    Intern at Fires<br>                    
      		<h5 style="width:400px;">
            	<div class=" label02 fl"><span class=" label label-primary">Java</span></div>
            	<div class=" label02 fl"><span class=" label label-primary">C++</span></div>
            	<div class=" label02 fl"><span class=" label label-primary">PHP</span></div>
            	<div class=" label02 fl"><span class=" label label-primary">MySQL</span></div>
            	<div class=" label02 fl"><span class=" label label-primary">HTML</span></div>
            	<div class=" label02 fl"><span class=" label label-primary">JavaScript</span></div>
            	<div class=" label02 fl"><span class=" label label-primary">Python</span></div>
            	<div class=" label02 fl"><span class=" label label-primary">Android</span></div>
            	<div class=" label02 fl"><span class=" label label-primary">C++</span></div>
            	<div class=" label02 fl"><span class=" label label-primary">C#</span></div>
            	<div class=" label02 fl"><span class=" label label-primary">JavaScript</span></div>
            	<div class=" label02 fl"><span class=" label label-primary">Python</span></div>
            	<div class=" label02 fl"><span class=" label label-primary">Android</span></div>
            	<div class=" label02 fl"><span class=" label label-primary">C++</span></div>
            	<div class=" label02 fl"><span class=" label label-primary">C#</span></div>
            	<div class=" label02 fl"><span class=" label label-primary">JavaScript</span></div>
            	<div class=" label02 fl"><span class=" label label-primary">Python</span></div>
            	<div class=" label02 fl"><span class=" label label-primary">Android</span></div>
            	<div class=" label02 fl"><span class=" label label-primary">C++</span></div>
            	<div class=" label02 fl"><span class=" label label-primary">C#</span></div>
             </h5>       
               
            </div>
        </div-->
        
        
        </div>
   </div>
  
  
  <script type="text/javascript" src="http://ajax.googleapis.com/
ajax/libs/jquery/1.4.2/jquery.min.js"></script>
<script type="text/javascript">
$(document).ready(function()
{

$('#QA').click(function()
{

$('#Dev_block').hide();
$('#QA_block').show();
});

$('#Dev').click(function()
{

$('#QA_block').hide();
$('#Dev_block').show();
});

$('#All').click(function()
{

$('#QA_block').show();
$('#Dev_block').show();
});

});
</script> 
 

<script>
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
</script>