<html>
    
<link href="<?php echo base_url(); ?>css/bootstrap.css" rel="stylesheet" type="text/css" />
<style>
    .message {
        display: none;
        float: left;
        color: #ff0033;
	}
	





.lightbox .title {
	margin:0;
	padding:0 0 10px 0px;
	border-bottom:1px #ccc solid;
	font-size:22px;
	}

.lightbox .content {
	display:block;
	padding:10px 0 0 0px;
	font-size:18px;
	line-height:22px;
	}

.lightbox .close {
	float:right;
	display:block;
	text-decoration:none;
	font-family:Gotham, "Helvetica Neue", Helvetica, Arial, sans-serif;
	font-size:22px;
	color:#858585;
	}
        table, th, td {
    border: 5px solid white;
   
} 
.addbtn2 {
	
        width: 50px;
	height:25px; 
	float:right;
	padding:2px; 
	margin-right:0px;
	font-size:12px; 
}
    
    
</style>
<body>
    <div  class="lightbox" style=" padding: 10px;">
                   <div class="box" style="width:780px; height: 200px;">
                       <a class="close"  onclick="parent.$.colorbox.close(); return false;">X</a>
                           <p class="title">Add to project</p><br>
                          <h4>    <?php echo $user->Fname.' '.$user->Lname; ?> </h4>
                               <div class="content">
                                   <h5>
                                       <form action="../add_to_project" method="post" onSubmit="window.setTimeout(function(){parent.$.fn.colorbox.close(); parent.location.reload();}, 150);">

                                           <table style="width:100%; font-size: 13px;">
                                           <tr>
                                           <td>
                                           Project:
                                           </td>
                                           <td >
                                               <input list="projects" name="project" autocomplete="off" placeholder="Select Project" required>
                                               <datalist id="projects">
                                                   <?php
                                                      //  print_r($projects);
                                                        foreach ($projects as $row2) {
                                                            echo '<option value="'.$row2->ProjectName.'">';

                                                        }
                                                        ?>

                                                        </datalist></input>
                                               </td>
                                               <td>
                                                   Role:
                                               </td>
                                               <td>
                                                   <input type="text" name="Role" style="width:300px;" required></input>

                                               </td>
                                               </tr>
                                               <tr>
                                               <?php
                                                    if($this->session->userdata('UserType') === 'Line Manager'){       
                                                         echo  '
                                               <td>
                                                           Contribution:
                                               </td>
                                               <td>                                                                        
                                                           <input type="text" class="contribution" autocomplete="off" name="contribution" style="width:40px;" required >&nbsp;%</input>
                                               </td>
                                               <td>
                                                           ';
                                                    }  ?> 
                                                        
                                                           <input type="hidden" name="UserId" value="<?php echo $user->UserId;?>"></input> 
                                                           Total Contribution:

                                               </td>

                                               <td>
                                                        <input id="totalcontribution" style="width:40px; float:left;" type="text" name="todate" disabled><div id="Message" class="message">&nbsp;Must be less than or equal to 100</div>

                                               </td>
                                               </tr>
                                               <?php
                                                    if($this->session->userdata('UserType') === 'Line Manager'){ 
                                                         foreach ($empprojects as $row2) {
                                                             echo '<tr><td>'; 
                                                             echo $row2->ProjectName.':</td><td><input autocomplete="off" class="contribution" style="width:40px;" type="text" name="'.$row2->ProjectAllocId.'"  required value="'.$row2->Contribution;
                                                             echo '">&nbsp;%</td>';
                                                         }
                                                    }
                                                    ?>

                                                <td></td>
                                                <td>
                                                           <input id="submit_button" class="btn btn-info addbtn2"  onclick=""   type="submit" value="add">
                                                           <input id="totalcontribution" class="btn btn-info addbtn2" style="display: none;"   type="submit" value="add" disabled>

                                               </td></tr>
                                             </table>
                                       </form>
                                   </h5>
                               </div>
                       </div>
                   </div>
</body>
</html>
        <!-- script for get total contribution -->
 <script src="https://ajax.googleapis.com/ajax/libs/jquery/1.7.1/jquery.min.js "></script>
 
<script>
// we used jQuery 'keyup' to trigger the computation as the user type
$('.contribution').keyup(function () {
 
    // initialize the sum (total price) to zero
    var sum = 0;
     
    // we use jQuery each() to loop through all the textbox with 'price' class
    // and compute the sum for each loop
    $('.contribution').each(function() {
        sum += Number($(this).val());
    });
     
    // set the computed value to 'totalPrice' textbox
    $('#totalcontribution').val(sum);
    if(sum<=100){
        $('#submit_button').show();
        $('#Message').hide();
    }else{
        $('#submit_button').hide();
        $('#Message').show();
    }
    
     
});
</script>
<script>
    window.onunload = refreshParent;
    function refreshParent() {
        window.opener.location.reload();
    }
</script>
