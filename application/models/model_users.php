<?php

class Model_users extends CI_Model{ 
    public function can_log_in(){
      

       
      
        $this->db->where('Email', $this->input->post('email'));

        $this->db->where('password', md5($this->input->post('password')) );
        $query = $this->db->get('user');
       
        if($query->num_rows()==1){
            $this->load->library('session');
            
            // If there is a user, then create session data
            $row = $query->row();
            $row1 = $this->get_user_info($row->UserId);
            $data = array(
                    'UserId' => $row->UserId,
                    'Email' => $row->Email,
                    'UserType' => $row->UserType,
                    'UserName'=> $row1->Fname,
                    'isLoggedIn'=> '1'
     
                    );
            $this->session->set_userdata($data);
            return TRUE;
        }  else {
            return FALSE;
        }
    }

    public function get_teamId($tname){
            $this->db->where('TeamName',$tname);
            $query = $this->db->get('team');
            $re = $query->row();
            return $re->TeamId;

    }    
    public function get_user_info($uid){        
            $this->db->where('UserId',$uid);
            $query = $this->db->get('userinfo');
            return $query->row();
            //return $row->Fname;            
    }
    public function get_user_type($uid){        
            $this->db->where('UserId',$uid);
            $query = $this->db->get('user');
            $row= $query->row();
            return $row->UserType;            
    }
    public function get_team_name($tid){        
            $this->db->where('TeamId',$tid);
            $query = $this->db->get('team');
            $row=$query->row();
            return $row->TeamName;            
    }
    public function get_project_name($Pid){        
            $this->db->where('PId',$Pid);
            $query = $this->db->get('projects');
            $row=$query->row();
            return $row->ProjectName;            
    }
    public function get_project_info($uid){        
            $this->db->where('UserId',$uid);
            $query = $this->db->get('projectallocation');
            $result=$query->result();
            foreach ($result as $row) {
                $row->ProjectName=  $this->get_project_name($row->PId);                
            }
            return $result;
            
        
    }
    public function get_skills($uid){        
            $this->db->where('UserId',$uid);
            $query = $this->db->get('skills');            
            return $query->result();        
    }
    public function get_experiance($uid){        
            $this->db->where('UserId',$uid);
            $query = $this->db->get('experiance'); 
            $result=$query->result(); 
            foreach ($result as $row){
                $row->TeamName=$this->get_team_name($row->TeamId);
                $row->ProjectName=  $this->get_project_name($row->PId);
                $days=$row->TimePeriod;
                $Time='';
                if($days>=30){
                    $Time=intval($days/30).' Month(s)';
                    $days=$days%30;
                }
                if($days>=7){
                    $Time=$Time.' '.intval($days/7).' Week(s)';
                    $days=$days%7;
                }
                $Time=$Time.' '.$days.' Day(s)';
                $row->Time=$Time;
            }
            return  $result;      
    }
    public function get_current_experiance($uid){        
        $this->load->library('session');
        if($this->in_pool($uid)!=1 && $this->get_user_type($uid)==='Employee'){
            $this->db->where('UserId',$uid);
            $query = $this->db->get('employeeallocation'); 
            $result=$query->row();
         
                 $this->load->helper('date');
                 $date1=date_create($result->StartDate);
                 $date2=date_create(\date("Y-m-d"));
                 if($date1<$date2){
                 $diff= date_diff($date1, $date2);
                    if($diff->y>0){
                        $remaining= $diff->y.' year(s) '.$diff->m.' month(s) '.intval($diff->d/7).' Week(s) '.($diff->d%7).' day(s)';
                    }else{
                        $remaining= $diff->m.' month(s) '.intval($diff->d/7).' Week(s) '.($diff->d%7).' day(s)';
                    }
                 }else{
                        $remaining= '***No Remaining Time***';  
                 }
                 
                 $this->db->where('UserId',$uid);
                 $query2 = $this->db->get('projectallocation');
                 $experiance=$query2->result();
                 foreach ($experiance as $value) {
                     $value->TeamName=  $this->get_team_name($value->TeamId); 
                     $value->Time=$remaining;
                     $value->ProjectName=  $this->get_project_name($value->PId);
                 }
           // $experiance->remaining=$remaining;
                        
            return $experiance;
        }  
    }

    public function get_user_name($uid){        
            $this->db->where('UserId',$uid);
            $query = $this->db->get('userinfo');
            $row=$query->row();
            return $row->Fname;               
    }
    public function get_project_details($uid){   
        $this->load->library('session'); 
        
        
        $this->load->helper('date'); 
      //  if($this->session->userdata('UserType')==='Employee'){
            
        
            $this->db->where('UserId',$uid);
            $query = $this->db->get('employeeallocation');
           if($row = $query->row()){
                 $date1=date_create($row->EndDate);
                 $date2=date_create(\date("Y-m-d"));
                 if($date1>$date2){
                 $diff= date_diff($date2, $date1);
                
                    if($diff->y>0){
                        $remaining= $diff->y.' year(s) '.$diff->m.' month(s) '.intval($diff->d/7).' Week(s) '.($diff->d%7).' day(s)';
                    }else{
                         $remaining= $diff->m.' month(s) '.intval($diff->d/7).' Week(s) '.($diff->d%7).' day(s)';
                    }
                 }else{
                 $remaining= '***No Remaining Time***';  
                 }
          


                    $data = array(
                            'Projects' => $this->get_project_info($row->UserId),
                            'TeamName' => $this->get_team_name($row->TeamId),
                            'StartDate' => $row->StartDate,
                            'EndDate'=> $row->EndDate,
                            'Remaining'=>$remaining

                            );
                            return $data;
           }
        
    }

    public function get_project_details2(){   
        $this->load->library('session');

        if($this->session->userdata('UserType')==='Higher Management'){
                
               // $this->db->select('PId, TeamId_0, ProjectName, StartDate, EndDate');
                //$this->db->select('TeamId_0');
                $query = $this->db->get('team');
                $result = $query->result();
                //print_r($result);
                foreach ($result as $row){
                $row->proj = $this->get_projects($row->TeamId);
                $num_of_Dev=0;
                $num_of_QA=0; 
                            $row->TeamName = $this->get_team_name($row->TeamId);
                            $row->TeamId = $row->TeamId;
                            $this->db->where('TeamId', $row->TeamId);
                            $query1 = $this->db->get('employeeallocation');
                            $result1 = $query1->result();

                            /*****************************************/
                           
                            // coming
                            //print_r($result1); 
                            foreach ($result1 as $row1) {
                               // foreach ($userinfo as $value) {
                                   
                                    $this->db->where('UserId',$row1->UserId);
                                    $query2 = $this->db->get('userinfo');
                                    //print_r($query2);
                                    $userinfo = $query2->result();
                                    

                                    //$value = $query2->row()
                                    foreach ($userinfo as $value) {

                                        //if( $row1->UserId === $value->UserId){
                                        if($value->Type === 'Dev' ){
                                                $num_of_Dev++;
                                            }

                                            elseif ($value->Type === 'QA') {
                                                $num_of_QA++;
                                            }

                                    }

                            
                            }

                            


                           
                        
                            $row->num_of_Dev=$num_of_Dev;
                            $row->num_of_QA=$num_of_QA;
                            $row->total = $num_of_Dev + $num_of_QA; 

                
            }
            return $result;
        }
    }

    public function send_email_lock($useremail,$RfromName,$RtoName,$RTname,$CTname,$fromdate,$todate,$comment){
            $config = Array(        
            'protocol' => 'smtp',
            //'smtp_host' => 'ssl://smtp.googlemail.com',
			'smtp_host' => 'ssl://gator3078.hostgator.com',
			 'smtp_port' => 465,            
             'smtp_user' => 'sithy@simct.com',
            'smtp_pass' => '6+t3U0mxQoT~',
           // 'smtp_timeout' => '1',
            'mailtype'  => 'html', 
            'charset'   => 'iso-8859-1'
        );
 
        $this->load->library('email', $config);
        $this->email->set_newline("\r\n");

        $this->email->from('sithy@simct.com', 'SimCentric Resource Allocation System');

        $this->db->where('Email',$useremail);
        $query = $this->db->get('user');


        
        if( $query->num_rows() > 0){
            
            $mes = '
                    <html>
                    <body style="background-color: #16d5f7; border: 1px ; border-radius: 5px;" >
                        <table width="75%" border="0" align="center">
                                <tr>
                                    <h2 align="center"><font color="black">Locking Notification.</font></h2>
                                </tr>
                                <tr>
                                    <p><font color="black">The following request has been made by ['.$RfromName.']
                                    to ['.$RTname.'] team.</font></p>
                                </tr>
                        </table>            
                                
                                    
                    <table width="75%" border="1" align="center" cellspacing="0">
                        <tr>
                            <td width="60">
                              Current Team
                            </td>
                            <td width="60">
                               '.$CTname.' 
                            </td>
                        </tr>
                        <tr>
                            <td width="60">
                              Requested Employee
                            </td>
                            <td width="60">
                               '.$RtoName.' 
                            </td>
                        </tr>

                        <tr>
                            <td width="60">
                              Requested Team
                            </td>
                            <td width="60">
                                 '.$RTname.' 
                            </td>
                        </tr>

                        <tr>
                            <td width="60">
                              Requested Time Period
                            </td>
                            <td width="60">
                               from: '.$fromdate.'<br> to: '.$todate.'
                            </td>
                        </tr>

                        <tr>
                            <td width="60">
                              Comment
                            </td>
                            <td width="60">
                               '.$comment.'
                            </td>
                        </tr>

                    </table>
                
                    <table width="75%" border="0" align="center">
                    <tr>
                    <p>
                    </tr>
                    <tr>
                        <a href="http://localhost/new_branch/index.php/main/common_notification_page">Click here to proceed</a>
                    </tr>
                    
                    <tr>
                    <p>
                    </tr>

                    <p>

                    <p>
                    </table>
                    </body>
                
                        
                    
                    
                    </html>
                    ';


            $this->email->to($useremail); 
            $this->email->subject('Locking Request');
            $this->email->message($mes); 
            //$this->email->attach('C:/wamp/www/new_branch/images/simct-logo.png'); 
        
            $result = $this->email->send(); 
            if($this->email->send()){
               echo 'An Email has sent. Check your Email account.';
            }

           /* else{
               echo $this->email->print_debugger(); 
            }*/



        


        }

    }
    public function upload_image(){
           //$this->load->library('upload');
            //$uploadfile = $_POST['uploadfile'];
            $this->load->library('session');
            $target_dir = "images/ProfilePictures/".$this->session->userdata('UserId').".jpg";
            //#$target_dir = $target_dir . basename( $_FILES["uploadFile"]["name"]);
            $uploadOk=1;

            if (move_uploaded_file($_FILES["uploadfile"]["tmp_name"], $target_dir)) {
               //echo "The file ". basename( $_FILES["uploadfile"]["name"]). " has been uploaded.";
            } else {
               //echo "Sorry, there was an error uploading your file.";
            }
                    

    }


    public function send_email($useremail){

        $config = Array(        
            'protocol' => 'smtp',
            //'smtp_host' => 'ssl://smtp.googlemail.com',
			'smtp_host' => 'ssl://gator3078.hostgator.com',			
            'smtp_port' => 465,
            'smtp_user' => 'sithy@simct.com',
            'smtp_pass' => '6+t3U0mxQoT~',
           // 'smtp_timeout' => '1',
            'mailtype'  => 'html', 
            'charset'   => 'iso-8859-1'
        );
 
        $this->load->library('email', $config);
        $this->email->set_newline("\r\n");

        $this->email->from('sithy@simct.com', 'SimCentric Resource Allocation System');

        $this->db->where('Email',$useremail);
        $query = $this->db->get('user');

        if( $query->num_rows() > 0){
            $code = rand(1,10000);
            $mes = '<html>
                    <body style="background-color: #16d5f7; border: 1px ; border-radius: 5px;" >

                            <table width="75%" border="0" align="center">
                                    <tr>
                                        <h2 align="center"><font color="black">Reset Your Password.</font></h2>
                                    </tr>
                                    <tr>
                                        <p>You have requested to reset your Password for Resource Allocation System.<br>
                                        This is <u><font color="blue">'.$code.'</u></font> the code for Reset Password</p>
                                    </tr>
                            </table>            
                    
                            <table width="75%" border="0" align="center">
                                <tr>
                                <a href="http://localhost/new_branch/index.php/main/login">Click here to proceed</a>
                                </tr>
                                <p>
                                <p>
                            </table>


                    </body>
                    </html>
                    ';
                    


            $this->email->to($useremail); 
            $this->email->subject('Reset Password Request');
            $this->email->message($mes);  
            $data = array(
                'password' => md5($code), 

            );


            $this->db->update('user', $data, array( 'Email' => $useremail ) );
           // $this->email->send(); 
            if($this->email->send()){
                            
               $data['message'] = "An Email has sent. Check your Email account.";
               $this->load->view('login_page',$data);  
               
            }
            /*
            else{
               echo $this->email->print_debugger(); 
            }*/

        


        }

        else{

            
			$data['message'] = "Email address does not exist!!";
            $this->load->view('login_page',$data);        } 
        
       
            
    }


    public function count_notificiaton(){
        $this->load->library('session');           
        $userType=$this->session->userdata('UserType');
        if ($userType === 'Higher Management'){
            //$this->db->where('UserId',  $this->session->userdata('UserId'));
            $query = $this->db->get('requests');
            $re = $query->result();
            $count = 0;            
            foreach ($re as $key) {
                $count++;
            }
            return $count;


        }

        elseif ($userType === 'Line Manager') {
             $this->db->where('Rto',  $this->session->userdata('UserId'));
             $query = $this->db->get('notifications');
            //$re = $query->num_rows();
             $re = $query->result();
            $count = 0;            
            foreach ($re as $key) {
                $count++;
            }
            return $count;



        
      
        }
        
        elseif ($userType === 'Employee') {
            $this->db->where('Rto',  $this->session->userdata('UserId'));
            $query = $this->db->get('notifications');
            $re = $query->result();
            
            $count = 0;
                    
            
            foreach ($re as $key) {
                $count++;
            }

            

            return $count;
        }
        

    }
    public function get_projects($tid){
       
        
        $this->db->where('TeamId_0',$tid);
        //echo $this->input->post('TeamId');
        $query = $this->db->get('projects');
        $pro = $query->result();

                foreach ($pro as $row) {
                    $row->TeamId = $tid;
                    $row->ProjectName = $row->ProjectName;
                    $row->StartDate = $row->StartDate;
                    $row->EndDate = $row->EndDate;

                                    $this->db->where('PId', $row->PId);
                                    $query1 = $this->db->get('projectallocation');
                                    $result1 = $query1->result();

                                    /*****************************************/
                               
                                    $num_of_Dev=0;
                                    $num_of_QA=0;  
                                    foreach ($result1 as $row1) {
                                       // foreach ($userinfo as $value) {
                                       // if()  
                                            $this->db->where('UserId',$row1->UserId);
                                            $query2 = $this->db->get('userinfo');
                                            //print_r($query2);
                                            $userinfo = $query2->result();
                                            

                                            //$value = $query2->row()
                                            foreach ($userinfo as $value) {

                                                //if( $row1->UserId === $value->UserId){
                                                if($value->Type === 'Dev' ){
                                                        $num_of_Dev++;
                                                    }

                                                    elseif ($value->Type === 'QA') {
                                                        $num_of_QA++;
                                                    }

                                            }
                                    }
                        $row->num_of_Dev=$num_of_Dev;
                        $row->num_of_QA=$num_of_QA;
                        $row->total = $num_of_Dev + $num_of_QA;


                }

        return $pro;
    }
    
    public function get_employee_pool(){
           
            $query = $this->db->get('employeepool');
            $result= $query->result(); 
            
            foreach ($result as $row){                
                $row1 = $this->get_user_info($row->UserId);
                $row->Button=  $this->check_in_request($row->UserId,'pool');
                $row->Type=$row1->Type;
                $row->UserName=$row1->Fname." ".$row1->Lname;
                $row->Designation=$row1->Designation;
                $row->Skills=  $this->get_skills($row->UserId);
            }
            return $result;
    }
    public function check_in_request($Uid,$PoolType){
        
            $this->db->where('Rto',$Uid);
            $query = $this->db->get('requests');
            if ($query->num_rows() === 0){
                    if($PoolType==='pool'){
                        return '<button class="btn btn-info getbtn"  type="button"   onClick="location.href = \'#text'.$Uid.'\';">Get</button>';
                    }elseif ($PoolType==='expire') {
                        return '<button class="btn btn-info getbtn"   type="button"   onClick="location.href = \'#textx'.$Uid.'\';">Lock</button>';
                    }
                
                    
                }  else {
                    $row=$query->row();
                    $teamname=  $this->get_team_name($row->TeamId);
                    
                    if($PoolType==='pool'){
                        return '&nbsp;&nbsp;Requested by '.$teamname;
                    }elseif ($PoolType==='expire') {
                        return '&nbsp;&nbsp;Locked by '.$teamname;
                    }
           }

    }


    public function get_user_id(){

        $this->load->library('session'); 
        $da = $this->session->userdata('UserId');

        return $da;
    }
    public function get_team_employees(){
            $this->load->library('session');           
            $userType=$this->session->userdata('UserType');
             if ($userType === 'Line Manager') {        
                $this->db->where('UserId',  $this->session->userdata('UserId'));
                $query = $this->db->get('managerallocation');
                $row=$query->row();
                $parentTeam=$row->TeamId;        
                $this->searchx('employeeallocation');
                $this->db->where('TeamId',$parentTeam);
                $query2 = $this->db->get('employeeallocation');
                $result=$query2->result();
                foreach ($result as $row) {
                    //echo $row->UserId; 
                $row->In_Pool=$this->in_pool($row->UserId);
                $this->db->where('UserId',$row->UserId);
                $query3 = $this->db->get('projectallocation');
                $result3=$query3->result();
                foreach ($result3 as $row3) {
                    $row3->ProjectName=  $this->get_project_name($row3->PId);
                    
                }
                
                    $row->Projects=$result3;
                    
                }
                
                
             }elseif ($userType === 'Higher Management') {
               
                $this->searchx('user');
                 $this->db->where('UserType','Employee') ;
                $query2 = $this->db->get('user');
                $result=$query2->result();
                foreach ($result as $row) {
                    //echo $row->UserId;       
                $this->db->where('UserId',$row->UserId);
                $query3 = $this->db->get('projectallocation');
                $result3=$query3->result();
                    foreach ($result3 as $row3) {
                        $row3->ProjectName=  $this->get_project_name($row3->PId);
                    
                    }
                
                    $row->Projects=$result3;
                    $row->In_Pool=$this->in_pool($row->UserId);
                    
                }
                
             }           
             
            foreach ($result as $row){                
                $row1 = $this->get_user_info($row->UserId);
                $row->UserName=$row1->Fname." ".$row1->Lname;
                $row->Designation=$row1->Designation;
                $row->Type=$row1->Type;
                $row->Skills=  $this->get_skills($row->UserId);
                }
                return   $result; 
                 
        
        
    }
        public function get_all_employees(){            
            $this->load->library('session');
             $userType=$this->session->userdata('UserType');
             if ($userType === 'Line Manager') {        
                $this->db->where('UserId',  $this->session->userdata('UserId'));
                $query = $this->db->get('managerallocation');
                $row=$query->row();
                $parentTeam=$row->TeamId;   
                $this->searchx('user');
             //   $this->db->where('UserType','Employee');
                $query2 = $this->db->get('user');
                $result=$query2->result();
                foreach ($result as $row) {
                    //echo $row->UserId; 
                $row->In_Pool=$this->in_pool($row->UserId);
                $this->db->where('UserId',$row->UserId);
                $query3 = $this->db->get('projectallocation');
                $result3=$query3->result();
                foreach ($result3 as $row3) {
                    $row3->ProjectName=  $this->get_project_name($row3->PId);
                    
                }
                
                    $row->Projects=$result3;
                    
                }
                    foreach ($result as $key => $row) {
                        $this->db->where('UserId',$row->UserId);
                        $this->db->where('TeamId',$parentTeam);
                        $query2 = $this->db->get('projectallocation');
                        if ($query2->num_rows() > 0){
                            unset($result[$key]);
                        }else{
                        }
                }
              
             }elseif ($userType === 'Higher Management') {
                $this->searchx('user');
                $this->db->where('UserType !=','Employee') ;
                $query2 = $this->db->get('user');
                $result=$query2->result();
                foreach ($result as $row) {
                    //echo $row->UserId;       
                $this->db->where('UserId',$row->UserId);
                $query3 = $this->db->get('projectallocation');
                $result3=$query3->result();
                    foreach ($result3 as $row3) {
                        $row3->ProjectName=  $this->get_project_name($row3->PId);
                    
                    }
                
                    $row->Projects=$result3;
                    $row->In_Pool=$this->in_pool($row->UserId);
                    
                }
                
            
             }
        foreach ($result as $row){
            
                            $row1 = $this->get_user_info($row->UserId);
                            $row->UserName=$row1->Fname." ".$row1->Lname;
                            $row->Designation=$row1->Designation;
                            $row->Type=$row1->Type;
                            $row->Skills=  $this->get_skills($row->UserId);
        }
          return   $result; 
        }    
    public function change_contribution($UserId){
        
                $this->db->where('UserId',$UserId);
                $query3 = $this->db->get('projectallocation');
                $result3=$query3->result();
                foreach ($result3 as $row3) {
                    $row3->ProjectName=  $this->get_project_name($row3->PId);
                    
                }
                return $result3;
    }


    public function add_to_pool(){
        $data = array(
           'UserId' => $this->input->post('UserId'),
          // 'StartDate' => $this->input->post('from') ,
         //  'EndDate' => $this->input->post('to')
        );
        $this->add_experiance($this->input->post('UserId'));
        $this->db->where('UserId', $this->input->post('UserId'));
        $this->db->delete('employeeallocation');
        
        $this->db->where('UserId', $this->input->post('UserId'));
        $this->db->delete('projectallocation');       

        if($this->db->insert('employeepool', $data)){
            return TRUE;
        }  else {
            return FALSE;
        }
    }
    public function get_linemanager_projects(){
            
            $this->load->library('session');           
            $userType=$this->session->userdata('UserType');
             if ($userType === 'Line Manager') {
                $parentTeam=  $this->get_linemanager_parent_team();    
                $this->db->where('TeamId_0',$parentTeam);
                $query2 = $this->db->get('projects');
                return $query2->result();
                 
             }elseif ($userType === 'Higher Management') {
            
                $query2 = $this->db->get('projects');
                return $query2->result();
        }       
    }
    public function get_employees_project($UserId){
                $parentTeam=  $this->get_linemanager_parent_team();    
                $this->db->where('TeamId_0',$parentTeam);
                $query1 = $this->db->get('projects');
                $result=$query1->result();
                foreach ($result as $key => $row) {
                    $this->db->where('UserId',$UserId);
                    $this->db->where('PId',$row->PId);
                    $query2 = $this->db->get('projectallocation');
                    if ($query2->num_rows() > 0){
                        unset($result[$key]);
                    }
                }
                return $result;
    }

    public function request_to_getemp(){
        $this->load->library('session');
       // echo  $this->session->userdata('UserId');
        $proId = $this->get_project_full_info($this->input->post('project'));
        $data = array(
            'TeamId'=>  $this->get_linemanager_parent_team(),
            'Rfrom' => $this->session->userdata('UserId'),
            'Rto'=>$this->input->post('UserId') ,
            'ProjectId'=>$proId->PId,
            'StartDate' => $this->input->post('from'),
            'EndDate' => $this->input->post('to'),
            'RequestDate'=>  \date("Y-m-d"),
            'Comment'=> $this->input->post('comment'),
            'Role'=>$this->input->post('Role')
        );
        $this->db->insert('requests', $data);
        //print_r($data);
    }

    public function request_to_getemp1(){
        $this->load->library('session');
        
        $proId = $this->get_project_full_info($this->input->post('project'));
        $data = array(
            'TeamId'=>  $this->get_linemanager_parent_team(),
            'Rfrom' => $this->session->userdata('UserId'),
            'Rto'=>$this->input->post('UserId') ,
            'ProjectId'=>$proId->PId,
            'StartDate' => $this->input->post('from'),
            'EndDate' => $this->input->post('to'),
            'RequestDate'=>  \date("Y-m-d"),
            'Comment'=> $this->input->post('comment'),
            'Role'=>$this->input->post('Role')
        );
        $this->db->insert('requests', $data);

       //$this->db->select('Email');
    
        $q =  $this->db->get('user');
        $result = $q->result();

        foreach ($result as $row) {
            if( $row->UserType === 'Higher Management'){

                $re = $this->get_user_info($this->session->userdata('UserId'));
                $re2 = $this->get_user_info($this->input->post('UserId'));
                $this->db->where('TeamId',$this->get_linemanager_parent_team());
                $qq = $this->db->get('team');
                $ree = $qq->row();
                $RTname = $ree->TeamName;

                $this->db->where('UserId',$this->input->post('UserId'));
                $query = $this->db->get('employeeallocation');
                $resultt = $query->row();

                $this->db->where('TeamId',$resultt->TeamId);
                $qqq = $this->db->get('team');
                $res = $qqq->row();
                $CTname = $res->TeamName;
                
                $RfromName = $re->Fname." ".$re->Lname;
                $RtoName = $re2->Fname." ".$re2->Lname;
                $this->send_email_lock($row->Email,$RfromName, $RtoName, $RTname,$CTname, $this->input->post('from'),$this->input->post('to'),$this->input->post('comment'));        
            }
        }
        
        //print_r($data);

    }


    public function get_linemanager_parent_team(){
        $this->load->library('session'); 
        $userType=$this->session->userdata('UserType');
        if ($userType === 'Line Manager' ){
        $this->db->where('UserId',  $this->session->userdata('UserId'));
        $query = $this->db->get('managerallocation');
        $row=$query->row();
        return $row->TeamId; 
        }elseif ($userType === 'Higher Management' ){
            return $this->session->userdata('Team');;
        }
        
    }
    public function get_all_projects_of_team(){
        $this->load->library('session');
        $parentTeam=  $this->get_linemanager_parent_team();        
        $this->db->where('TeamId_0',  $parentTeam);
        $query = $this->db->get('projects');
        return $query->result();        
    }
    public function get_number_of_employees(){
        $projects= $this->get_all_projects_of_team();
        $total=0;
        foreach ($projects as $value) {
            
            $num_of_Dev=0;
            $num_of_QA=0;        
            $this->db->where('PId',$value->PId);
            $query = $this->db->get('projectallocation');
            $allocation= $query->result();
            foreach ($allocation as $value1){
                $row=  $this->get_user_info($value1->UserId);
                
                if($row->Type === 'Dev'){
                    $num_of_Dev++;
                }elseif ($row->Type === 'QA') {
                    $num_of_QA++;
                }
                
                
            }
            $value->num_of_Dev=$num_of_Dev;
            $value->num_of_QA=$num_of_QA;
            $value->total=$num_of_Dev+$num_of_QA;
            $total_emp=$num_of_Dev+$num_of_QA;
            if($total_emp !==0){
                $total=1;
            }
           
        }
        if($total===1){
        return $projects;
        }  else {
            return NULL;    
        }
    }


    public function change_password(){
        $this->load->library('session');
       // $this->load->library('encrypt');
        $encurpass = md5($this->input->post('curpassword'));
        $ennewpass1 = md5($this->input->post('newpassword1'));
        $ennewpass2 = md5($this->input->post('newpassword2'));

        /*$this->db->where('UserId', $this->session->userdata('UserId'));
        $query = $this->db->get('user');
        $result = $query->row();*/

           // if( $encurpass === $result->password ){

            //    if( $ennewpass1 === $ennewpass2 ){
                        $data = array(

                            'password' => $ennewpass1,

                        );   

                        if($this->db->update('user', $data, array( 'UserId' => $this->session->userdata('UserId')) ) ){
                                return True;

                        }
                        else{

                            return False;
                        }

             //   }
           // }          

    }


    public function accept_request(){
        $this->load->library('session'); 
            
                    $data = array(
                        'UserId' => $this->input->post('UserId'),
                        //'PId' => $this->input->post('PId'),
                        'TeamId' => $this->input->post('TeamId_0'),
                        'StartDate' => $this->input->post('StartDate') ,
                        'endDate' => $this->input->post('EndDate')
         
                    );
                    $this->db->insert('employeeallocation', $data);


                    $data1 = array(
                        'UserId' => $this->input->post('UserId'),
                        'PId' => $this->input->post('PId'),
                        'TeamId' => $this->input->post('TeamId_0'),
                        'Role' => $this->input->post('Role'),
                        'Contribution' => '100'
                        
         
                    );

                    $Rt = $this->input->post('UserId_1');
                    $Rf = $this->session->userdata('UserId');
                    $Nemp = $this->input->post('UserId');
                    $msg = 'Accepted';
                $this->db->where('RequestId', $this->input->post('NoteId'));
                $this->db->delete('requests');


                $this->db->where('UserId', $this->input->post('UserId'));
                $this->db->delete('employeepool');

                $data2 = array(
                    'Nfrom' =>$this->session->userdata('UserId'),
                    'Rto' => $this->input->post('UserId'),
                    'Message' => 'Accepted',
                    'Nemp' => $this->input->post('UserId'),
                    'NoteDate' => \date("Y-m-d")
                     );
                $this->db->insert('notifications', $data2);


                $this->db->insert('projectallocation', $data1);
                $this->update_data($Rt,$Rf,$Nemp,$msg);
                /*if($this->db->insert('projectallocation', $data1)){
                    return TRUE;
                }
                
                else{
                    return FALSE;
                }*/



    }

    public function update_data($Rto,$Rfrom,$Nemp,$msg){
        $data3 = array(
            'Nfrom' => $Rfrom,
            'Rto' => $Rto,
            'Message' => $msg,
            'Nemp' => $Nemp,
            'NoteDate' => \date("Y-m-d")
            );

         $this->db->insert('notifications', $data3);
    }
    public function unview_notification(){
            //$this->load->library('session');
            //$userType=$this->session->userdata('UserType');
             
            //if( $userType === 'Line Manager'){
               $this->db->where('NoteId',$this->input->post('NoteId'));
                $this->db->delete('notifications'); 
            //}

            /*else{
               $this->db->where('Nemp', $this->input->post('UserId'));
                $this->db->delete('notifications'); 
            }*/
            
    }



    public function reject_request(){
        

               // $this->db->delete('requests', array('Rto' => $id));
                $this->load->library('session'); 

                $this->db->where('RequestId', $this->input->post('RequestId'));                
                $this->db->delete('requests');
                $msg = 'Rejected';
                $data = array(
                    'Nfrom' =>$this->session->userdata('UserId'),
                    'Rto' => $this->input->post('UserId'),
                    'Message' => $msg,
                    'Nemp' => $this->input->post('UserId'),
                    'NoteDate' => \date("Y-m-d")
                     );
                $this->db->insert('notifications', $data);
                $Rt = $this->input->post('UserId_1');
                $Rf = $this->session->userdata('UserId');
                $Nemp = $this->input->post('UserId');
                $this->update_data($Rt,$Rf,$Nemp,$msg);
    }
    /*public function details_of_request($Rto,$Rfrom,$message){

    }*/
    public function get_notification(){
            $this->load->library('session'); 
            $userType=$this->session->userdata('UserType');
             if ($userType === 'Higher Management'  || $userType === 'Line Manager' ) {
                  $query = $this->db->get('requests');
                   $result= $query->result();

                    foreach ($result as $row) {
                        $row1 = $this->get_user_info($row->Rto);
                        $row2 = $this->get_user_info($row->Rfrom);
                        $row->ToName = $row1->Fname." ".$row1->Lname;
                        $row->fromname = $row2->Fname." ".$row2->Lname;
                        $row->proname = $this->get_project_name($row->ProjectId);
                        $row->teamname = $this->get_team_name($row->TeamId);
                        $row->stardate = $row->StartDate;
                        $row->endDate = $row->EndDate;
                        $row->reqDate = $row->RequestDate;
                        $row->RId = $row->RequestId;
                        $row->PId = $row->ProjectId;
                        $row->Comment = $row->Comment;

                        $row->val = $this->in_the_pool($row->Rto);

                   }
                    return $result;
                    


             }

             elseif($userType === 'Employee'){
                $this->db->where('Rto',  $this->session->userdata('UserId'));
                $query = $this->db->get('requests');
                $result = $query->result();
                foreach ($result as $row) {
                        $row1 = $this->get_user_info($row->Rto);
                        $row2 = $this->get_user_info($row->Rfrom);
                        $row->ToName = $row1->Fname." ".$row1->Lname;
                        $row->fromname = $row2->Fname." ".$row2->Lname;
                        $row->proname = $this->get_project_name($row->ProjectId);
                        $row->teamname = $this->get_team_name($row->TeamId);
                        $row->stardate = $row->StartDate;
                        $row->endDate = $row->EndDate;
                        $row->reqDate = $row->RequestDate;
                        $row->RId = $row->RequestId;
                        $row->PId = $row->ProjectId;
                        $row->Comment = $row->Comment;
                   }
                    return $result;

             }


    }
    public function retrieve_nofication(){
        $this->load->library('session');
        $userType=$this->session->userdata('UserType');
            
        
         if ($userType === 'Line Manager') {
                $this->db->where('Rto', $this->session->userdata('UserId'));
                $query = $this->db->get('notifications');                   
                $result= $query->result();
                foreach ($result as $row) {
                                $row1 = $this->get_user_info($row->Nfrom);
                                $row2 = $this->get_user_info($row->Rto);
                                $row3 = $this->get_user_info($row->Nemp);
                   // $row1 = $this->get_user_name($row->Nfrom);
                    //$row2 = $this->get_user_name($row->Rto);
                    $date1=date_create($row->NoteDate);
                    $date2=date_create(\date("Y-m-d"));
                 
                    $diff= date_diff($date2, $date1);


                    $row->Rto = $row->Rto;
                    $row->Nemp = $row->Nemp;
                    $row->Nfrom = $row1->Fname." ".$row1->Lname;
                    $row->Rtoo = $row2->Fname." ".$row2->Lname;
                    $row->Nempname = $row3->Fname." ".$row3->Lname;
                    $row->Message = $row->Message;
                    $row->NoteDate = $diff;
                    $row->NoteId = $row->NoteId;

                }

                return $result;
        }

        elseif ( $userType === 'Employee') {
            $this->db->where('Rto', $this->session->userdata('UserId'));
            $query = $this->db->get('notifications'); 
            $result= $query->result();
            foreach ($result as $row) {
                                $row1 = $this->get_user_info($row->Nfrom);
                                $row2 = $this->get_user_info($row->Rto);

                   // $row1 = $this->get_user_name($row->Nfrom);
                    //$row2 = $this->get_user_name($row->Rto);
                    $row->Rto = $row->Rto;
                    $row->Nfromm = $row1->Fname." ".$row1->Lname;
                    $row->Rtoo = $row2->Fname." ".$row2->Lname;
                    $row->Message = $row->Message;
                    $row->NoteDate = $row->NoteDate; 

                }

                return $result;

        }

    }
    public function in_the_pool($userid){
        $this->db->where('UserId', $userid);
        $query = $this->db->get('employeepool');
        $no = $query->num_rows();

        
        if ( $no > 0) {
       
            return 'x';
        }

        else{
         
            return 'y';
        }
    }
    public function add_to_project(){
        echo 'lofdjopkgd[]flgdflg]l';
        $Projects=$this->change_contribution($this->input->post('UserId'));
        foreach ($Projects as $row){
            $data1 = array(
               'contribution' => $this->input->post($row->ProjectAllocId)

            );

        $this->db->where('ProjectAllocId', $row->ProjectAllocId);
        $this->db->update('projectallocation', $data1); 
        }
        
        
        
        $row=  $this->get_project_full_info($this->input->post('project'));
        
        $data = array(
           'UserId' => $this->input->post('UserId'),
           'PId' => $row->PId,
           'TeamId' => $row->TeamId_0,
           'Contribution'=>  $this->input->post('contribution'),
           'Role'=> $this->input->post('Role')
        );   

        $this->db->insert('projectallocation', $data);
    
    

    }
    public function add_to_project_hm(){
                $this->add_experiance($this->input->post('UserId'));
                $this->db->where('UserId',$this->input->post('UserId') );                
                $this->db->delete('projectallocation');
                $this->db->where('UserId',$this->input->post('UserId') );                
                $this->db->delete('employeeallocation');
                $this->db->where('UserId',$this->input->post('UserId') );                
                $this->db->delete('employeepool');
               
                $row=  $this->get_project_full_info($this->input->post('project'));
                $data = array(
                    'UserId' => $this->input->post('UserId'),
                    //'PId' => $row->PId,
                    'TeamId' => $row->TeamId_0,
                    //'Contribution'=>  $this->input->post('contribution'),
                   // 'Role'=> $this->input->post('Role')
                    'StartDate'=>  \date("Y-m-d"),
                    'EndDate'=>$this->input->post('todate')
                    
                ); 
                $this->db->insert('employeeallocation', $data);
                
                $data2 = array(
                    'UserId' => $this->input->post('UserId'),
                    'PId' => $row->PId,
                    'TeamId' => $row->TeamId_0,
                    'Contribution'=>  '100',
                    'Role'=> $this->input->post('Role')
                    
                );
                $this->db->insert('projectallocation', $data2);
                
                
    }
    public function get_project_full_info($ProjectName){
                
        $this->db->where('ProjectName', $ProjectName);
        $query = $this->db->get('projects');
        return $query->row();
        
    }
    public function about_to_expire_employees(){
        
        $newDate = date('Y-m-d', strtotime('+30 days'));
        //echo $newDate;
        $this->db->where('EndDate <', $newDate);
        $query = $this->db->get('employeeallocation');
        $result=$query->result();
       // print_r($result);
        
            foreach ($result as $row){                
                $row1 = $this->get_user_info($row->UserId);
                $row->Button=  $this->check_in_request($row->UserId,'expire');
                $row->Type=$row1->Type;
                $row->UserName=$row1->Fname." ".$row1->Lname;
                $row->Designation=$row1->Designation;
                $row->Skills=  $this->get_skills($row->UserId);
                $row->TeamName= $this->get_team_name($row->TeamId);
            }
            return $result;
    }
    public function higher_Addproject(){
             
                $data = array(

                    'ProjectName' => $this->input->post('ProjectName'),
                    'StartDate' => $this->input->post('startdate'),
                    'EndDate' => $this->input->post('enddate'),
                    //'Team' => $this->input->post('team')
                      'TeamId_0'   => $this->get_teamId($this->input->post('team'))
     
                );

                if($this->db->insert('projects', $data)){
                    return TRUE;
                }

                else{
                    return FALSE;
                }    
    }
    public function get_team_projects(){
                $this->load->library('session');  
                $this->load->helper('date');
                $userType=$this->session->userdata('UserType');
                if ($userType === 'Line Manager' ){
                    $this->db->where('UserId',  $this->session->userdata('UserId'));
                    $query = $this->db->get('managerallocation');
                    $row=$query->row();
                    $parentTeam=$row->TeamId; 
                }elseif ($userType === 'Higher Management'){
                    $parentTeam=$this->session->userdata('Team');
                }
                $this->db->where('TeamId_0',$parentTeam);
                $query2 = $this->db->get('projects');
                $result=$query2->result();
                foreach ($result as $row){
                    $row->Employees=  $this->get_project_employees($row->PId);
                    $date1=date_create($row->StartDate);
                    $date2=date_create($row->EndDate);
                    $date3=date_create(\date("Y-m-d"));
                    
                    if($date2>$date3){
                        $diff1= date_diff($date1,$date2);
                        $diff2= date_diff($date3, $date1);
                        $diff3=$diff1->y*365.25+$diff1->m*30+$diff1->d;
                        $diff4=$diff2->y*365.25+$diff2->m*30+$diff2->d;
                        
                        $row->elapsed2=$diff4*100/$diff3;
                       
                        //echo intval($diff2->d);
                    }else{
                        $row->elapsed2='100';
                    }
                    
                    
          
                
                }
                
                return $result;
    }
    public function get_project_employees($PId){
                $this->db->where('PId',  $PId);
                $query = $this->db->get('projectallocation');
                $result=$query->result();
                foreach ($result as $row) {
                    $this->db->where('UserId',$row->UserId);
                    $query = $this->db->get('employeeallocation');
                    $result2=  $query->result();
                        foreach ($result2 as $row2){
                            $row2->Fname=  $this->get_user_name($row2->UserId);
                            
                            $date1=date_create($row2->StartDate);
                            $date2=date_create($row2->EndDate);
                            $date3=date_create(\date("Y-m-d"));

                            if($date2>$date3){
                                $diff1= date_diff($date1,$date2);
                                $diff2= date_diff($date3, $date1);
                                $diff3=$diff1->y*365.25+$diff1->m*30+$diff1->d;
                                $diff4=$diff2->y*365.25+$diff2->m*30+$diff2->d;

                                $row2->elapsed=$diff4*100/$diff3;
                       
                                //echo intval($diff2->d);
                            }  else {
                                $row2->elapsed=100;
                            }
                        }
                    $row->Allocation=$result2;
                }
                return $result;
    }
    public function add_experiance_to_db($UserId,$TeamId,$PId,$Role,$Contribution,$TimePeriod){
                $data = array(
                    'UserId' => $UserId,
                    'TeamId' => $TeamId,
                    'PId'=>$PId,
                    'Role'=>$Role,
                    'Contribution'=>$Contribution,
                    'TimePeriod' => $TimePeriod     
                );
                $this->db->insert('experiance', $data);
    }
    public function add_experiance($UserId){
        $this->db->where('UserId',  $UserId);
        $query = $this->db->get('employeeallocation');
        $result=$query->result();
        foreach ($result as $row1) {
            $date1=date_create($row1->StartDate);
            $date2=date_create($row1->EndDate);
            $date3=date_create(\date("Y-m-d"));
            if($date2<=$date3){
                $diff= date_diff($date1,$date2);
            }elseif ($date2>$date3) {
                $diff= date_diff($date1,$date3);                
            }
            $diff_days=$diff->y*365.25+$diff->m*30+$diff->d;
            $this->db->where('UserId',  $UserId);
            $this->db->where('TeamId',  $row1->TeamId);
            $query2 = $this->db->get('projectallocation');
            $result2=$query2->result();
            foreach ($result2 as $row2) {
                $this->add_experiance_to_db($UserId, $row1->TeamId, $row2->PId, $row2->Role, $row2->Contribution, $diff_days);
            }
        }
    }
    public function delete_skill($SkillId){
                $this->db->where('SkillId', $SkillId);                
                $this->db->delete('skills');
                redirect('/index.php/main/empHomepage/'.$this->session->userdata('UserId'), 'refresh');
    }
    public function add_skill(){
        $this->load->library('session'); 
            $userId=$this->session->userdata('UserId');
                $data = array(
                    'UserId' => $userId,
                    'Skill' => $this->input->post('Skill')
                );
                $this->db->insert('skills', $data);
                redirect('/index.php/main/empHomepage/'.$this->session->userdata('UserId'), 'refresh');
    }
    public function in_pool($UserId){
        
                $this->db->where('UserId',  $UserId);
                $query = $this->db->get('employeepool');
                if($query->num_rows() > 0){
                    return '1';
                }  else {
                    return '5';
                }
    }
    public function searchx($table){
        $name=$this->input->post('name');
        $skill=$this->input->post('skill');
        $experiance=$this->input->post('experience');
    

        if($skill!=NULL){
            $this->db->where('Skill',$skill);        
            $this->db->join('skills','skills.UserId='.$table.'.UserId');
}
        if($experiance!=NULL){
            $this->db->where('ProjectName',$experiance);            
            $this->db->join('experiance', 'experiance.UserId='.$table.'.UserId');
            $this->db->join('projects', 'projects.PId=experiance.PId');
        }
        if($name!=NULL){
            $this->db->like('Fname',$name);
            $this->db->or_like('Lname', $name);            
            $this->db->join('userinfo', 'userinfo.uInfoid='.$table.'.UserId');
        }

    }
    public function search(){
        $name=$this->input->post('name');
        $skill=$this->input->post('skill');
        $experiance=$this->input->post('experience');
        $table=  $this->input->post('allocatedto');
        
        
        if($skill!=NULL){
            $this->db->where('Skill',$skill);        
            $this->db->join('skills','skills.UserId='.$table.'.UserId');
        }
        if($experiance!=NULL){
            $this->db->where('ProjectName',$experiance);            
            $this->db->join('experiance', 'experiance.UserId='.$table.'.UserId');
            $this->db->join('projects', 'projects.PId=experiance.PId');
        }
        if($name!=NULL){
            $this->db->where('Fname',$name);
            $this->db->or_where('Lname', $name);            
            $this->db->join('userinfo', 'userinfo.UserId='.$table.'.UserId');
        }
        $this->db->from($table);
       // $this->db->join('experiance',NULL);
      //  $this->db->join('projects',NULL);
        $query = $this->db->get();
        $result=$query->result();
        print_r($result);
    }
}
