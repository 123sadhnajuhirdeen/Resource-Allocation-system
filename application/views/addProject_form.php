
    <link href='http://fonts.googleapis.com/css?family=Open+Sans:400,300,700' rel='stylesheet' type='text/css'>
    <link rel="stylesheet" href="<?php echo base_url(); ?>css/add_project_toggle_form_base.css" />
    <link rel="stylesheet" href="<?php echo base_url(); ?>css/add_project_toggle_form_style.css" />
    
    <script src="<?php echo base_url(); ?>js/jquery-1.9.1.min.js"></script>
    <script src="<?php echo base_url(); ?>js/jquery.easing.1.3.js"></script>
    
    <script>
        $(document).ready(function() {
            $('#login p').click(function() {
                $('#login-form').slideToggle(300);
                $(this).toggleClass('close');
            });
        }); // end ready

        
    </script>

       
            <nav id="nav-container" class="clearfix">
                <nav id="login">
                    <p style="color:#F60;">Add project</p>
                    <div id="login-form" style="width: 400px;">
                        <form action="higher_Addproject" method="post">
                            <table>
                            <tr>
                                <td>
                                <label for="project_name">Project Name:</label>
                                <input type="projectname" name="ProjectName" id="ProjectName" />
                                </td>

                                <td></td>
                                <td>
                                <label for="team_name">Team Name</label>
                                <?php
                                echo ' <input list="teamDetails" name="team" placeholder="Select Team" required multiple>
                                      <datalist id="teamDetails">';
                                //echo '<select>';
                                      print_r($teamDetails);
                                        foreach ($teamDetails as $row) {
                                          
                                        //print_r($row1->TeamName);
                                    
                                        echo '<option value="'.$row->TeamName.'">';
                                       // echo ' <option value="'.$row->TeamId.'">'.$row->TeamName.'</option>';

                                        }
                                        //echo '</select>';
                                        echo '</datalist></input>';

                                echo '</td>
                            </tr>
                            <tr>    
                            </tr>
                            </table>
                            <input class="btn btn-default" type="submit" value="Add">';
                        
                                
                                ?>
                                  
                        
                                
                            
                            
                            
                        </form>
                    </div>
                </nav>
            </nav>
            
            
 