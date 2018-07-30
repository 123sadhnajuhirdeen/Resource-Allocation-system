
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
    .getbtn {
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
	   <div class="title fl" style="top:-10px; position:relative; width: 250px;"><h3>Developers / QA</h3>
           
           </div>
         

         <div style=" position: relative; left: 150px; top: 10px; float: left;">
                     <input type="radio" name="choose1" id="Dev" checked="checked"/> Dev 
                    <input type="radio" name="choose1" id="QA"/> QA
                    <input type="radio" name="choose1" id="All"/>All                   
                    
	   </div>
         <div style=" position: relative; left: 200px; top: 10px; float: left;">
                     <input type="radio" name="choose2" id="Expire" checked="checked"/> Expire 
                    <input type="radio" name="choose2" id="Pool"/> Pool
                    <input type="radio" name="choose2" id="All2"/>All                   
                    
	   </div>
         <div class="textbox fl" style=" left:  400px; position: relative;">
                    
                    <input type="text" name="search" class="search se" value="" style="height:30px; font-size:14px; "  placeholder="Search Employees" autocomplete="off">
	   </div>
	 </div>
       
       <div id="Pool_block">
	 <div class="developers" id="Dev_block">
              
            

                <?php
                 //print_r($projects);
                 foreach ($pool as $row) {
                     if($row->Type==='Dev'){
                     //print_r($row);
                     echo '<div class="developer_holder fl" id="'.$row->UserName.'" style="display: block;">
        	<div class="photo fl"><img src="';
                     echo base_url();
                     echo 'images/ProfilePictures/';
                     echo $row->UserId.'.jpg" width="80" height="80"></div>
            <div class="name fl"><a href="">
                	<b>'.$row->UserName.'</b></a> 

                
                Free '.$row->StartDate.' - '.$row->EndDate.'<br>'.$row->Designation.'<div class=" label02" style="top:4px;"><span class=" label label-danger" >'.$row->Type.'</span></div><br>
                    
                    <h5 style="width:400px;">';
                    // print_r($row->Skills);
                    foreach ($row->Skills as $skill){
                         echo '<div class=" label02 fl"><span class=" label label-primary">'.$skill->Skill.'</span></div>';
                         
                         
                    }                   
                                          
                     echo '</h5>';
                     if($this->session->userdata('UserType') === 'Line Manager') { 
                     echo $row->Button;
                     }    
                    echo '</div></div>';
                     echo '
<div class="lightbox" id="text'.$row->UserId.'">
  <div class="box">
	<a class="close" href="#">X</a>
    <p class="title">Get from Pool</p>
    '.$row->UserName.'
    <div class="content">
        <form action="request_to_get" method="post">
            <h5>
            from:&nbsp; 
            <input type="date" name="from" required></input>
            &nbsp; to: &nbsp; 
            <input type="date" name="to" required></input><br><br>
            <input type="hidden" name="UserId" value="'.$row->UserId.'"/>
            <input class="btn btn-info addbtn2" type="submit" value="get"/>     
            <h5>
        </form>
  		
  	</div>
  </div>
                     </div>';}
                 }                
                
                 ?></div>
       	 <div class="developers" id="QA_block" style="display:none">
                    
                    <?php
                 //print_r($projects);
                 foreach ($pool as $row) {
                     if($row->Type==='QA'){
                     //print_r($row);
                     echo '<div class="developer_holder fl" id="'.$row->UserName.'" style="display: block;">
        	<div class="photo fl"><img src="';
                     echo base_url();
                     echo 'images/ProfilePictures/';
                     echo $row->UserId.'.jpg" width="80" height="80"></div>
            <div class="name fl"><a href="">
                	<b>'.$row->UserName.'</b></a> 

                
                Free '.$row->StartDate.' - '.$row->EndDate.'<br>'.$row->Designation.'<div class=" label02" style="top:4px;"><span class=" label label-danger" >'.$row->Type.'</span></div><br>
                    
                    <h5 style="width:400px;">';
                    // print_r($row->Skills);
                    foreach ($row->Skills as $skill){
                         echo '<div class=" label02 fl"><span class=" label label-primary">'.$skill->Skill.'</span></div>';
                         
                         
                    }                   
                                          
                     echo '</h5>';
                     if($this->session->userdata('UserType') === 'Line Manager') { 
                     echo $row->Button;
                     }    
                    echo '</div></div>';
                     echo '
<div class="lightbox" id="text'.$row->UserId.'">
  <div class="box">
	<a class="close" href="#">X</a>
    <p class="title">Get from Pool</p>
    '.$row->UserName.'
    <div class="content">
        <form action="request_to_get" method="post">
            <h5>
                    from:&nbsp; 
                <input type="date" name="from" required></input>
                    &nbsp; to: &nbsp; 
                <input type="date" name="to" required></input><br><br>
                <input type="hidden" name="UserId" value="'.$row->UserId.'"/>
                <input class="btn btn-info addbtn2" type="submit" value="get"/>     
            </h5>
        </form>
  		
  	</div>
  </div>
                     </div>';}
                 }                
                
                ?>
                    
     
         </div>          
        </div>
       
       
       <div id="Expire_block">
	 <div class="developers" id="Dev_block">
              
            

                <?php
                 //print_r($projects);
                 foreach ($Expire as $row) {
                     if($row->Type==='Dev'){
                     //print_r($row);
                     echo '<div class="developer_holder fl" id="'.$row->UserName.'" style="display: block;">
        	<div class="photo fl"><img src="';
                     echo base_url();
                     echo 'images/ProfilePictures/';
                     echo $row->UserId.'.jpg" width="80" height="80"></div>
            <div class="name fl"><a href="">
                	<b>'.$row->UserName.'</b></a> 

                
                Expire in '.$row->EndDate.'<br>'.$row->Designation.'<div class=" label02" style="top:4px;"><span class=" label label-danger" >'.$row->Type.'</span></div><br>
                    
                    <h5 style="width:400px;">';
                    // print_r($row->Skills);
                    foreach ($row->Skills as $skill){
                         echo '<div class=" label02 fl"><span class=" label label-primary">'.$skill->Skill.'</span></div>';
                         
                         
                    }                   
                                          
                     echo '</h5>';
                     if($this->session->userdata('UserType') === 'Line Manager') { 
                 //    echo $row->Button;
                     }    
                    echo '</div></div>';
                     echo '
<div class="lightbox" id="text'.$row->UserId.'">
  <div class="box">
	<a class="close" href="#">X</a>
    <p class="title">Get from Pool</p>
    '.$row->UserName.'
    <div class="content">
        <form action="request_to_get" method="post">
            <h5>
            from:&nbsp; 
            <input type="date" name="from" required></input>
            &nbsp; to: &nbsp; 
            <input type="date" name="to" required></input><br><br>
            <input type="hidden" name="UserId" value="'.$row->UserId.'"/>
            <input class="btn btn-info addbtn2" type="submit" value="get"/>     
            <h5>
        </form>
  		
  	</div>
  </div>
                     </div>';}
                 }                
                
                 ?></div>
           
       	 <div class="developers" id="QA_block" style="display:none">
                    
                    <?php
                 //print_r($projects);
                 foreach ($Expire as $row) {
                     if($row->Type==='QA'){
                     //print_r($row);
                     echo '<div class="developer_holder fl" id="'.$row->UserName.'" style="display: block;">
        	<div class="photo fl"><img src="';
                     echo base_url();
                     echo 'images/ProfilePictures/';
                     echo $row->UserId.'.jpg" width="80" height="80"></div>
            <div class="name fl"><a href="">
                	<b>'.$row->UserName.'</b></a> 

                
                Expire in  '.$row->EndDate.'<br>'.$row->Designation.'<div class=" label02" style="top:4px;"><span class=" label label-danger" >'.$row->Type.'</span></div><br>
                    
                    <h5 style="width:400px;">';
                    // print_r($row->Skills);
                    foreach ($row->Skills as $skill){
                         echo '<div class=" label02 fl"><span class=" label label-primary">'.$skill->Skill.'</span></div>';
                         
                         
                    }                   
                                          
                     echo '</h5>';
                     if($this->session->userdata('UserType') === 'Line Manager') { 
                   //  echo $row->Button;
                     }    
                    echo '</div></div>';
                     echo '
<div class="lightbox" id="text'.$row->UserId.'">
  <div class="box">
	<a class="close" href="#">X</a>
    <p class="title">Get from Pool</p>
    '.$row->UserName.'
    <div class="content">
        <form action="request_to_get" method="post">
            <h5>
                    from:&nbsp; 
                <input type="date" name="from" required></input>
                    &nbsp; to: &nbsp; 
                <input type="date" name="to" required></input><br><br>
                <input type="hidden" name="UserId" value="'.$row->UserId.'"/>
                <input class="btn btn-info addbtn2" type="submit" value="get"/>     
            </h5>
        </form>
  		
  	</div>
  </div>
                     </div>';}
                 }                
                
                ?>
                    
         </div>
         </div>          
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

$('#Pool').click(function()
{

$('#Pool_block').show();
$('#Expire_block').hide();
});

$('#Expire').click(function()
{

$('#Expire_block').show();
$('#Pool_block').hide();
});

$('#All2').click(function()
{

$('#Pool_block').show();
$('#Expire_block').show();
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