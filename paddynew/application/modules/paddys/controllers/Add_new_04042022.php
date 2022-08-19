<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Add_new extends MX_Controller {

    protected $sysdate;
    protected $kms_year;

    public function __construct(){

    $this->sysdate  = $_SESSION['sys_date'];

        parent::__construct();

        //For Individual Functions
        $this->load->model('Paddy');
        $this->load->model('PaddyBank');
        $this->load->library('form_validation');

        //For User's Authentication
        if(!isset($this->session->userdata['loggedin']['user_id'])){
            
            redirect('User_Login/login');

        }

        $data       = $this->Paddy->f_get_particulars_in('md_parameters', array(16, 17), array(""));

        $this->kms_year   = substr($data[0]->param_value, 0,4).'-'.substr($data[1]->param_value, 2,2);
        
        // require_once (BASEPATH."/third_party/Classes/PHPExcel/PHPExcel.php");
        // require_once (BASEPATH."/third_party/Classes/PHPExcel/IOFactory.php");

        // $this->load->library('phpExcel'); // For excel 
    }

    /*********************For KMS Year Screen********************/
    #FS Guidelines is Food corporation Guidelines

    //Fetching the FS List
    public function f_fs_guidelines() {
        
        //Guidelines List
        $fs_guidelines['guidelines']   =   $this->Paddy->f_get_particulars("md_fs_guide_lines", NULL, NULL, 0);

        $this->load->view('post_login/main');

        $this->load->view("fs_guidelines/dashboard", $fs_guidelines);

        $this->load->view('search/search');

        $this->load->view('post_login/footer');
        
    }

    //Add new Guidelines in the md_fs_guide_lines table
    public function f_fs_guidelines_add() {

        if($_SERVER['REQUEST_METHOD'] == "POST") {

            $data_array = array(

                "guide_lines"    =>  $this->input->post('guide_lines'),
                "effective_date" =>  $this->input->post('effective_date'),
                "created_by"    =>  $this->session->userdata['loggedin']['user_name']

            );

            $this->Paddy->f_insert('md_fs_guide_lines', $data_array);

            //For notification storing message
            $this->session->set_flashdata('msg', 'Successfully added!');

            redirect('paddys/add_new/f_fs_guidelines');


        }
        else {

            //Fs Guidelines List

            $fs_guidelines['guidelines']   =   $this->Paddy->f_get_particulars("md_fs_guide_lines", NULL, NULL, 0);
            $this->load->view('post_login/main');
            $this->load->view("fs_guidelines/add", $fs_guidelines);
            $this->load->view('post_login/footer');

        }
        
    }

    //Edit Guidelines 's  in the ms_Guidelines table
    public function f_fs_guidelines_edit() {

        if($_SERVER['REQUEST_METHOD'] == "POST") {

            $data_array = array(

                "guide_lines" =>  $this->input->post('guide_lines'),
                "effective_date" =>  $this->input->post('effective_date'),
                "modified_by" =>  $this->session->userdata['loggedin']['user_name'],
                "modified_dt" =>  date('Y-m-d h:i:s')

            );

            $where  =   array(

                "sl_no"     =>  $this->input->post('sl_no')

            );

            $this->Paddy->f_edit('md_fs_guide_lines', $data_array, $where);

            //For notification storing message
            $this->session->set_flashdata('msg', 'Successfully edited!');

            redirect('paddys/add_new/f_fs_guidelines');


        }
        else {

            //Guidelines List
            $guidlines['guidlines_dtl']   =   $this->Paddy->f_get_particulars("md_fs_guide_lines", NULL, array("sl_no" => $this->input->get('slno')), 1);

            $this->load->view('post_login/main');

            $this->load->view("fs_guidelines/edit", $guidlines);

            $this->load->view('post_login/footer');

        }
        
    }
  
  
    /*********************For District Screen********************/

    //Fetching the Districts List
    public function f_district() {
        
        //District List
        $district['dist']   =   $this->Paddy->f_get_particulars("md_district", NULL, NULL, 0);

        $this->load->view('post_login/main');

        $this->load->view("district/dashboard", $district);

        $this->load->view('search/search');

        $this->load->view('post_login/footer');
        
    }

    //Add new District in the md_district table
    public function f_district_add() {

        if($_SERVER['REQUEST_METHOD'] == "POST") {

            $data_array = array(

                "district_code"    =>  $this->input->post('district_code'),

                "district_name"    =>  $this->input->post('dist'),
                
                "dist_sort_code"    =>  $this->input->post('dist_sort_code')

            );

            $query = $this->db->get_where('md_district', array('district_code =' => $this->input->post('district_code')));
            
            if ($query->num_rows() > 0)
            {   
                $this->session->set_flashdata('msg', 'District Code Already Exist!');
                redirect('paddys/add_new/f_district_add');
            }
            else 
               {
                $this->Paddy->f_insert('md_district', $data_array);

                $this->session->set_flashdata('msg', 'Successfully added!');
                redirect('paddys/add_new/f_district');
                }

        }
        else {

            //District List
            $district['dist']          =   $this->Paddy->f_get_particulars("md_district", NULL, NULL, 0);

            $this->load->view('post_login/main');

            $this->load->view("district/add", $district);

            $this->load->view('post_login/footer');

        }
        
    }

    //Edit District's name in the md_district table
    public function f_district_edit() {

        if($_SERVER['REQUEST_METHOD'] == "POST") {

            $data_array = array(

                "dist_sort_code" =>  $this->input->post('dist_sort_code')

            );

            $where  =   array(

                "district_code"     =>  $this->input->post('sl_no')

            );

            $this->Paddy->f_edit('md_district', $data_array, $where);

            //For notification storing message
            $this->session->set_flashdata('msg', 'Successfully edited!');

            redirect('paddys/add_new/f_district');


        }
        else {

            //District List
            $district['district_dtls']   =   $this->Paddy->f_get_particulars("md_district", NULL, array("district_code" => $this->input->get('slno')), 1);

            $this->load->view('post_login/main');

            $this->load->view("district/edit", $district);

            $this->load->view('post_login/footer');

        }
        
    }

    /*********************For Particular Screen********************/
    //Fetching the Particular List
    public function particulars() {
        
        //District List
        $district['dist']   =   $this->Paddy->f_get_particulars("md_comm_params", NULL, NULL, 0);

        $this->load->view('post_login/main');

        $this->load->view("particulars/dashboard", $district);

        $this->load->view('search/search');

        $this->load->view('post_login/footer');
        
    }

    //Edit Particular's name in the md_comm_params table
    public function particulars_edit() {

        if($_SERVER['REQUEST_METHOD'] == "POST") {

            $data_array = array(

                "boiled_val"   =>  $this->input->post('boiled_val'),

                "raw_val"      =>  $this->input->post('raw_val'),

                "tds"          =>  $this->input->post('tds'),

                "cgst"         =>  $this->input->post('cgst'),

                "sgst"         =>  $this->input->post('sgst'),

            );

            $where  =   array(

                "sl_no"     =>  $this->input->post('sl_no')

            );

            $this->Paddy->f_edit('md_comm_params', $data_array, $where);

            //For notification storing message
            $this->session->set_flashdata('msg', 'Successfully edited!');

            redirect('paddys/add_new/particulars');


        }
        else {

            //District List
            $data['district_dtls']  =  $this->Paddy->f_get_particulars("md_comm_params", NULL, array("sl_no" => $this->input->get('sl_no')), 1);

            $this->load->view('post_login/main');

            $this->load->view("particulars/edit", $data);

            $this->load->view('post_login/footer');

        }
        
    }

    /*********************For Block Screen********************/
    //Feching Data from table md_block
    public function f_block() {

      
       // $block['dist_dtls']          =   $this->Paddy->f_get_particulars("md_district d,md_branch b", NULL, $where, 1);

        $branch_id=$this->session->userdata['loggedin']['branch_id'];
     
        $block['block_dtls']     = $this->Paddy->f_get_particulars("md_block", NULL,array("branch_id" => $branch_id), 0);        
    
          
        
        $this->load->view('post_login/main');

        $this->load->view("block/dashboard", $block);
        
        $this->load->view('search/search');

        $this->load->view('post_login/footer');
        
    }

    //New Block Entry
    public function f_block_add() {

        if($_SERVER['REQUEST_METHOD'] == "POST") {

            $data_array = array(

                "dist"          =>  $this->input->post('dist'),

                "branch_id"     =>  $this->session->userdata['loggedin']['branch_id'],

                "blockcode"    =>  $this->input->post('blockcode'),

                "block_name"    =>  $this->input->post('name'),

                "created_by"    =>  $this->session->userdata['loggedin']['user_name'],

                "created_dt"    =>  date('Y-m-d h:i:s')

            );

            $query = $this->db->get_where('md_block', array('dist =' => $this->input->post('dist'),'blockcode =' => $this->input->post('blockcode')));

            if ($query->num_rows() > 0)
            {   
                $this->session->set_flashdata('msg', 'Block Code Already Exist!');
                redirect('paddys/add_new/f_block_add');
            }
            else 
               {
                $this->Paddy->f_insert('md_block', $data_array);

                $this->session->set_flashdata('msg', 'Successfully added!');
                redirect('paddys/add_new/f_block');
                }

        }
        else {

            //District List
            $select     =   array(

                "d.*", "b.*"
    
            );
            $where      =   array(
    
                "d.district_code = b.dist"    => NULL,
                "b.branch_id" => $this->session->userdata['loggedin']['branch_id'],
            );
    
    
            $block['dist']          =   $this->Paddy->f_get_particulars("md_district d,md_block b", NULL, $where, 1);
            
            
            $this->load->view('post_login/main');

            $this->load->view("block/add", $block);
            
            $this->load->view('post_login/footer');

        }
        
    }

      //New Block  Add in table MD_block

      public function f_block_upload() {

        if($_SERVER['REQUEST_METHOD'] == "POST") {

            //For Excel Upload
            $csvMimes = array('text/x-comma-separated-values',
					   'text/comma-separated-values',
					   'application/octet-stream',
					   'application/vnd.ms-excel',
					   'application/x-csv',
					   'text/x-csv',
					   'text/csv',
					   'application/csv',
					   'application/excel',
					   'application/vnd.msexcel',
                       'text/plain');
            
            //For Cheque Details uploadation
            if(!empty($_FILES['f_block_detail']['name']) && in_array($_FILES['f_block_detail']['type'],$csvMimes)){
					   
                $csvFile = fopen($_FILES['f_block_detail']['tmp_name'], 'r');
                    
                    while(($line = fgetcsv($csvFile)) !== FALSE){
                        
                    $data[] = array(

                        'sl_no'        => $line[1],
                        'dist'         =>  $line[0],
                        'branch_id'    =>  $line[0],
                        'blockcode'    =>  $line[1],
                        'block_name'   =>  $line[2],
                        "created_by"   =>  $this->session->userdata['loggedin']['user_name'],
                        "created_dt"   =>  date('Y-m-d')
                                );
                                    
                }  
                    
                    unset($data[0]);
                    $data = array_values($data);
                    
                fclose($csvFile);

                $this->Paddy->f_insert_multiple('md_block', $data);
            }

            //For notification storing message
            $this->session->set_flashdata('msg', 'Successfully added!');

            redirect('paddys/add_new/f_block');

        }
        else {

            $where      =   array(
                "branch_id" =>$this->session->userdata['loggedin']['branch_id']
            );

            //District List
            $block['blocks']  =   $this->Paddy->f_get_particulars("md_block",NULL,$where, 0);

            $this->load->view('post_login/main');

            $this->load->view("block/add_upload", $block);

            $this->load->view('post_login/footer');
        }
        
    }

    //Block Name edit
    public function f_block_edit() {

        if($_SERVER['REQUEST_METHOD'] == "POST") {

            $data_array = array(

                "dist"          =>  $this->input->post('dist'),

                "block_name"    =>  $this->input->post('name'),

                "modified_by"   =>  $this->session->userdata['loggedin']['user_name'],

                "modified_dt"   =>  date('Y-m-d h:i:s')

            );

            $where  =   array(

                "sl_no"     =>  $this->input->post('sl_no')

            );

            $this->Paddy->f_edit('md_block', $data_array, $where);

            //For notification storing message
            $this->session->set_flashdata('msg', 'Successfully edited!');

            redirect('paddys/add_new/f_block');


        }
        else {

            //District List
             //District List
             $select     =   array(

                "d.*", "b.*"
    
            );
            $where      =   array(
    
                "d.district_code = b.districts_catered"    => NULL,
                "b.id" => $this->session->userdata['loggedin']['branch_id'],
            );
    
    
            $block['dist']          =   $this->Paddy->f_get_particulars("md_district d,md_branch b", NULL, $where, 1);

            //Block Details
            $block['block_dtls']    =   $this->Paddy->f_get_particulars("md_block", NULL, array( "sl_no" => $this->input->get('sl_no')), 1);
            
            $this->load->view('post_login/main');

            $this->load->view("block/edit", $block);

            $this->load->view('post_login/footer');

        }
        
    }

    //Block delete
    public function f_block_delete() {

        $where = array(
            
            "sl_no"    =>  $this->input->get('sl_no')
            
        );

        //Retriving the data row for backup
        $select = array (

            "sl_no", "dist", "block_name"
        );

        $data   =   (array) $this->Paddy->f_get_particulars("md_block", $select, $where, 1);


        $audit  =   array(
            
            'deleted_by'    => $this->session->userdata['loggedin']['user_name'],
            
            'deleted_dt'    => date('Y-m-d h:i:s')

        );

        //Inserting Data
        $this->Paddy->f_insert('md_block_deleted', array_merge($data, $audit));
        
        $this->Paddy->f_delete('md_block', $where);
        
        //For notification storing message
        $this->session->set_flashdata('msg', 'Successfully deleted!');

        redirect("paddy/block");

    }


    //Block List for a particular district selected by user
    public function f_blocks() {

        $data   =   $this->Paddy->f_get_particulars("md_block", array("sl_no", "block_name"), array("dist" => $this->input->get('dist')), 0);

        echo json_encode($data);

    }
     // Screen For Village//

    public function f_village() {

      
        // $block['dist_dtls']          =   $this->Paddy->f_get_particulars("md_district d,md_branch b", NULL, $where, 1);
 
         $dist_code=$this->session->userdata['loggedin']['branch_id'];
         $village['vill_dtls']   = $this->Paddy->f_get_particulars("md_village", NULL,array("dist_code" => $dist_code), 0);        
     
         $this->load->view('post_login/main');
 
         $this->load->view("village/dashboard", $village);
         
         $this->load->view('search/search');
 
         $this->load->view('post_login/footer');
         
     }
 
     //New Block Entry
     public function f_village_add() {
 
         if($_SERVER['REQUEST_METHOD'] == "POST") {
 
             $data_array = array(
 
                 "dist"          =>  $this->input->post('dist'),
 
                 "branch_id"     =>  $this->session->userdata['loggedin']['branch_id'],
 
                 "block_name"    =>  $this->input->post('name'),
 
                 "created_by"    =>  $this->session->userdata['loggedin']['user_name'],
 
                 "created_dt"    =>  date('Y-m-d h:i:s')
 
             );
 
             $this->Paddy->f_insert('md_block', $data_array);
 
             //For notification storing message
             $this->session->set_flashdata('msg', 'Successfully added!');
 
             redirect('paddys/add_new/f_block');
 
 
         }
         else {
 
             //District List
             $select     =   array(
 
                 "d.*", "b.*"
     
             );
             $where      =   array(
     
                 "d.district_code = b.districts_catered"    => NULL,
                 "b.id" => $this->session->userdata['loggedin']['branch_id'],
             );
     
     
             $block['dist']          =   $this->Paddy->f_get_particulars("md_district d,md_branch b", NULL, $where, 1);
     
             
             $this->load->view('post_login/main');
 
             $this->load->view("block/add", $block);
             
             $this->load->view('post_login/footer');
 
         }
         
     }
 
       //New Block  Add in table MD_block
 
       public function f_village_upload() {

 
         if($_SERVER['REQUEST_METHOD'] == "POST") {
 
             //For Excel Upload
             $csvMimes = array('text/x-comma-separated-values',
                        'text/comma-separated-values',
                        'application/octet-stream',
                        'application/vnd.ms-excel',
                        'application/x-csv',
                        'text/x-csv',
                        'text/csv',
                        'application/csv',
                        'application/excel',
                        'application/vnd.msexcel',
                        'text/plain');
             
             //For Cheque Details uploadation
             if(!empty($_FILES['f_village_detail']['name']) && in_array($_FILES['f_village_detail']['type'],$csvMimes)){
                        
                 $csvFile = fopen($_FILES['f_village_detail']['tmp_name'], 'r');
                     
                     while(($line = fgetcsv($csvFile)) !== FALSE){
                         
                     $data[] = array(
 
                         'dist_code'    =>  $line[0],
                         'blockcode'    =>  $line[1],
                         'villagecode'  =>  $line[2],
                         'villagename'  =>  $line[3],
                         "created_by"   =>  $this->session->userdata['loggedin']['user_name'],
                         "created_dt"   =>  date('Y-m-d')
                                 );
                                     
                 }  
                     
                     unset($data[0]);
                     $data = array_values($data);
                     
                 fclose($csvFile);
 
                 $this->Paddy->f_insert_multiple('md_village', $data);
             }
 
             //For notification storing message
             $this->session->set_flashdata('msg', 'Successfully added!');
 
             redirect('add_new/village');
 
         }
         else {
 
             $where      =   array(
                 "dist_code" =>$this->session->userdata['loggedin']['branch_id']
             );
 
             //District List
             $village['village']  =   $this->Paddy->f_get_particulars("md_village",NULL,$where, 0);
 
             $this->load->view('post_login/main');
 
             $this->load->view("village/add_upload", $village);
 
             $this->load->view('post_login/footer');
         }
         
     }
    /*********************For MSP Screen******************/
    public function msp(){

         $where      =   array(
                 "kms_yr" =>$this->session->userdata['loggedin']['kms_id']
             );
      
       $msp['msp_dtls']     = $this->Paddy->f_get_particulars("md_paddy_rate", NULL,$where, 0);           
       
       $this->load->view('post_login/main');

       $this->load->view("msp/dashboard", $msp);
       
       $this->load->view('search/search');

       $this->load->view('post_login/footer');


    }
    public function msp_add(){

        if($_SERVER['REQUEST_METHOD'] == "POST") {

            $this->form_validation->set_rules('effective_dt', 'Effective Date', 'required');
            $this->form_validation->set_rules('per_qui_rate', 'Paddy Rate', 'required');

            if ($this->form_validation->run() == FALSE)
            {
                $this->session->set_flashdata('msg', 'You Misssed Required Field!');

                redirect('paddys/add_new/msp');

            }else{

            $data_array = array(

                "kms_yr"   =>  $this->session->userdata['loggedin']['kms_id'],

                "per_qui_rate"    =>  $this->input->post("per_qui_rate"),

                "effective_dt"    =>  $this->input->post("effective_dt"),

                "created_by"    =>  $this->session->userdata['loggedin']['user_name'],

                "created_dt"    =>  date('Y-m-d h:i:s')

            );
            $query = $this->db->get_where('md_paddy_rate', array('kms_yr =' => $this->session->userdata['loggedin']['kms_id'],'effective_dt =' => $this->input->post("effective_dt")));
            
            if ($query->num_rows() > 0)
            {   
                $this->session->set_flashdata('msg', 'Msp Rate Already Exist!');
                redirect('paddys/add_new/msp_add');
            }
            else 
               {
                $this->Paddy->f_insert('md_paddy_rate', $data_array);
                }
            
            //For notification storing message
            $this->session->set_flashdata('msg', 'Successfully added!');

            redirect('paddys/add_new/msp');

            }
        }
        else {
            
            $this->load->view('post_login/main');

            $this->load->view("msp/add");
            
            $this->load->view('post_login/footer');

        }

    }

    //Msp Name edit
    public function msp_edit() {

        if($_SERVER['REQUEST_METHOD'] == "POST") {

            $data_array = array(

                

                "per_qui_rate"    =>  $this->input->post('per_qui_rate'),

                "modified_by"   =>  $this->session->userdata['loggedin']['user_name'],

                "modified_dt"   =>  date('Y-m-d h:i:s')

            );

            $where  =   array(

                "id"     =>  $this->input->post('id')

            );

            $this->Paddy->f_edit('md_paddy_rate', $data_array, $where);

            //For notification storing message
            $this->session->set_flashdata('msg', 'Successfully edited!');

            redirect('paddys/add_new/msp');


        }
        else {
        
           
            $msp['msp_dtls']    =   $this->Paddy->f_get_particulars("md_paddy_rate", NULL, array( "id" => $this->input->get('id')), 1);
            
            $this->load->view('post_login/main');

            $this->load->view("msp/edit", $msp);

            $this->load->view('post_login/footer');

        }
        
    }
    /*********************End For MSP Screen******************/

    /*********************For Society Screen******************/
    #Society List from table md_society
    public function f_society() {

        //Retriving Society Details
        $select     =   array("sl_no","soc_name","society_code","inchargename","ph_no","branch_id","agreementno");

        $society['society_dtls']  = $this->Paddy->f_get_particulars("md_society", $select, NULL, 0);
        
        //District List
        $society['branch_dtls']    = $this->Paddy->f_get_particulars("md_branch", NULL, array('id' => $this->session->userdata['loggedin']['branch_id']), 0);

        $society['tot_row']      =$this->Paddy->f_get_total_without_kms_id("md_society");

        $society['dist']            =   $this->Paddy->f_get_particulars("md_district", NULL, NULL, 0);

        $society['tots_rows']    =   $this->Paddy->f_get_mill_district_wise("md_society");
        
        
        $this->load->view('post_login/main');

        $this->load->view("society/dashboard", $society);

        $this->load->view('search/search');

        $this->load->view('post_login/footer');
        
    }

    public function f_societydetail(){

         if($_SERVER['REQUEST_METHOD'] == "POST") {

            $kms_id     = $this->session->userdata['loggedin']['kms_id'];

            //$branch_id  = $this->session->userdata['loggedin']['branch_id'];

            $society_code = $this->input->post('society_code');

            $society['societydtl']   =  $this->Paddy->get_society_detail_code($society_code,$kms_id);  
            
            $this->load->view('post_login/main');

            $this->load->view("society/society_detail", $society);

            $this->load->view('post_login/footer');

        }
        else {
    
            $society['sys_date']   =   $_SESSION['sys_date'];

            $this->load->view('post_login/main');

            $this->load->view("society/society_detail", $society);

            $this->load->view('post_login/footer');

        }
           
    }
    public function f_societydetailbyname(){

         if($_SERVER['REQUEST_METHOD'] == "POST") {

            $kms_id   = $this->session->userdata['loggedin']['kms_id'];

            $soc_name = $this->input->post('soc_name');

            $society  = $this->Paddy->get_soc_dtls_byname($soc_name,$kms_id);

            echo json_encode($society);

        }
        else {
    
            $society['sys_date']   =   $_SESSION['sys_date'];

            $this->load->view('post_login/main');

            $this->load->view("society/society_detail_by_name", $society);

            $this->load->view('post_login/footer');

        }
           
    }
    public function f_milldetailbyname(){

         if($_SERVER['REQUEST_METHOD'] == "POST") {

            $kms_id   = $this->session->userdata['loggedin']['kms_id'];

            $mill_name = $this->input->post('mill_name');

            $society  = $this->Paddy->get_mill_dtls_byname($mill_name,$kms_id);

            echo json_encode($society);

        }
        else {
    
            $society['sys_date']   =   $_SESSION['sys_date'];

            $this->load->view('post_login/main');

            $this->load->view("mill/mill_detail_byname", $society);

            $this->load->view('post_login/footer');

        }
           
    }


    //New Society add in the table md_society
    public function f_society_add() {

        if($_SERVER['REQUEST_METHOD'] == "POST") {
            
            $data_array = array (

                "society_code"   =>  $this->input->post('society_code'),

                "soc_name"      =>  $this->input->post('name'),

                "inchargename"      =>  $this->input->post('inchargename'),

                "agreementno"      =>  $this->input->post('agreementno'),

                "reg_no"        =>  $this->input->post('reg_no'),

                "reg_date"      =>  $this->input->post('reg_date'),

                "tan"           =>  $this->input->post('tan'),

                "police_station"  =>  $this->input->post('police_station'),

                "post_office"     =>  $this->input->post('post_office'),

                "pin"           => $this->input->post('pin_no'),

                "soc_addr"      =>  $this->input->post('addr'),

                "branch_id"     =>  $this->session->userdata['loggedin']['branch_id'],

                "block"         =>  $this->input->post('block'),

                "dist"          =>  $this->session->userdata['loggedin']['districts_catered'],

                "ph_no"         =>  $this->input->post('ph_no'),

                "email"         =>  $this->input->post('email'),

                "bank_name"     =>  $this->input->post('bnk_name'),

                "branch_name"   =>  $this->input->post('brnch_name'),

                "acc_type"      =>  $this->input->post('acc_type'),

                "acc_no"        =>  $this->input->post('acc_no'),

                "ifsc_code"     =>  $this->input->post('ifsc'),

                "pan_no"        =>  $this->input->post('pan'),

                "gst_no"        =>  $this->input->post('gst_no'),

                "guide_lines_id"  => implode(",",$this->input->post('guide_lines_id')),

                "created_by"    =>  $this->session->userdata['loggedin']['user_name'],

                "created_dt"    =>  date('Y-m-d')

            );

            $id=$this->Paddy->f_insert('md_society', $data_array);

            //$maxId = $this->Paddy->f_get_particulars("md_society", array('sl_no'), array('soc_name' => $this->input->post('name')), 1);
            unset($data_array);                
            
            //For notification storing message
            $this->session->set_flashdata('msg', 'Successfully added!');

            redirect('paddys/add_new/f_society');

        }

        else {

            $where = array(

                "branch_id"        =>  $this->session->userdata['loggedin']['branch_id']

            );
            //Block List
            $society['block']   =   $this->Paddy->f_get_particulars("md_block", NULL,$where, 0);

            
          // Guidelines List
            $society['guidelines']  =   $this->Paddy->f_get_particulars("md_fs_guide_lines", NULL, NULL, 0);

            $this->load->view('post_login/main');

            $this->load->view("society/add", $society); 

            $this->load->view('post_login/footer');

        }

    }
    // Upload Society Data
    public function f_society_upload() {

        if($_SERVER['REQUEST_METHOD'] == "POST") {

            //For Excel Upload
            $csvMimes = array('text/x-comma-separated-values',
					   'text/comma-separated-values',
					   'application/octet-stream',
					   'application/vnd.ms-excel',
					   'application/x-csv',
					   'text/x-csv',
					   'text/csv',
					   'application/csv',
					   'application/excel',
					   'application/vnd.msexcel',
                       'text/plain');
            
            //For Cheque Details uploadation
            if(!empty($_FILES['f_society_detail']['name']) && in_array($_FILES['f_society_detail']['type'],$csvMimes)){
					   
                $csvFile = fopen($_FILES['f_society_detail']['tmp_name'], 'r');
                    $j=0;
                    while(($line = fgetcsv($csvFile)) !== FALSE){
                        
                    $data = array(
                        'sl_no'       =>  $line[2],
                        'dist'         =>  $line[0],
                        'block'        =>  $line[1],
                        'branch_id'    =>  $line[0],
                        'society_code' =>  $line[2],
                        'soc_name'     =>  $line[3],
                        'pan_no'       =>  $line[4],
                        'inchargename' =>  $line[5],
                        'ph_no'        =>  $line[6],
                        'agreementno'  =>  $line[7],
                        'created_by'   =>  $this->session->userdata['loggedin']['user_name'],
                        'created_dt'   =>  date('Y-m-d')
                        
                                );


                            $query = $this->db->get_where('md_society', array('society_code ='=> $line[2]));
        
                            if ($query->num_rows() == 0)
                                {   
                                    $id=$this->Paddy->f_insert('md_society', $data); 
                                    if(isset($id)){
                                        $j++;
                                      }   
                                      
                                }
                                
                }  
                    
                    // unset($data[0]);
                    // $data = array_values($data);
                    
                fclose($csvFile);

              //  $this->Paddy->f_insert_multiple('md_society', $data);
            }

            //For notification storing message
            $this->session->set_flashdata('msg', $j.' Record Successfully added!');

            redirect('paddys/add_new/f_society');

        }
        else {

            $this->load->view('post_login/main');

            $this->load->view("society/add_upload");

            $this->load->view('post_login/footer');
        }
        
    }

    public function f_society_update() {

        $url = 'https://procurement.wbfood.in/api/Statusupd/Proccentre'; /*Society*/
        
        
        $data = array('authcode' => 'ahtr*125#');
        $options = array(
            'http' => array(
                'header' => "Content-type: application/x-www-form-urlencoded\r\n",
                'method' => 'POST',
                'content' => http_build_query($data)
            )
        );

      
        $context = stream_context_create($options);
        $result  = file_get_contents($url, false, $context);

        $data   = json_decode($result);

         $j=0;

        foreach ($data as $value) {

                      $data = array(
                            'sl_no'        =>  $value->pc_code,
                            'dist'         =>  $value->DistCode,
                            'block'        =>  $value->BlockCode,
                            'branch_id'    =>  $value->DistCode,
                            'society_code' =>  $value->pc_code,
                            'soc_name'     =>  $value->CentreName,
                            'pan_no'       =>  $value->CentrePan,
                            'inchargename' =>  $value->CentreInCharge,
                            'ph_no'        =>  $value->mobileno,
                            'agreementno'  =>  $value->AgreementNo,
                            'created_by'   =>  $this->session->userdata['loggedin']['user_name'],
                            'created_dt'   =>  date('Y-m-d')
                                                  
                     );

                    $query = $this->db->get_where('md_society', array('sl_no ='=> $value->pc_code));
        
                        if ($query->num_rows() == 0)
                            {   
                                 $this->Paddy->f_insert('md_society', $data); 
                                   
                                        $j++;
                                     
                            }

            }

            $this->session->set_flashdata('msg', $j.' Records successfully added!');

            redirect('paddys/add_new/f_society');


    }

    //Society details edit in the table md_society
    public function f_society_edit(){

        if($_SERVER['REQUEST_METHOD'] == "POST") {
            
            $data_array = array (

                "bank_name"     =>  $this->input->post('bnk_name'),

                "acc_no"        =>  $this->input->post('acc_no'),

                "ifsc_code"     =>  $this->input->post('ifsc'),

                "modified_by"    =>  $this->session->userdata['loggedin']['user_name'],

                "modified_dt"    =>  date('Y-m-d')

            );

            $where = array(

                "sl_no"        =>  $this->input->post('soc_id')

            );

            $this->Paddy->f_edit('md_society', $data_array, $where);


            // echo $this->db->last_query();

            // die();
         
            
            //For notification storing message
            $this->session->set_flashdata('msg', 'Successfully updated!');

            redirect('paddy/societyl');

        }

        else {

            $where = array(

                "sl_no"    =>  $this->input->get('sl_no')

            );
            $wheres = array(

                "soc_mill_identifiers" => "S",

                "soc_mill_id"    =>  $_GET['sl_no'],

                "branch_id"    =>  $this->session->userdata['loggedin']['branch_id']

            );

            $whereb = array(

                "1 ORDER BY bank_name"    =>  NULL

            );
           
            //District List
            $society['dist']    =   $this->Paddy->f_get_particulars("md_district", NULL, NULL, 0);
            
            //Block List
            $society['block']   =   $this->Paddy->f_get_particulars("md_block", NULL,array("branch_id" => $this->session->userdata['loggedin']['branch_id']), 0);
          
            //Society list of latest month
            $society['society_dtls']    =   $this->Paddy->f_get_particulars("md_society", NULL, $where, 1);

            //Society list of latest month
            $society['bank_dtls']    =   $this->Paddy->f_get_particulars("md_bank_dtls", NULL, $whereb, 0);


            //Guidelines List
            $society['guidelines']    =   $this->Paddy->f_get_particulars("md_fs_guide_lines", NULL, NULL, 0);
         

            $this->load->view('post_login/main');

            $this->load->view("society/edit", $society);

            $this->load->view('post_login/footer');

        }

    }

    //District Wise Blocks And Mills for a particular district selected by user
    public function f_blocksandmills(){

        $data['blocks']   =   $this->Paddy->f_get_particulars("md_block", array("sl_no", "block_name"), array("dist" => $this->input->get('dist')), 0);
        $data['mills']   =   $this->Paddy->f_get_particulars("md_mill", array("sl_no", "mill_name"), array("dist" => $this->input->get('dist')), 0);

        echo json_encode($data);
    }

    //Society Delete
    public function f_society_delete(){

        $where = array(
            
            "sl_no"    =>  $this->input->get('sl_no')
            
        );

        //Retriving the data row for backup
        $select = array (

            "sl_no", "soc_name", "reg_no", "reg_date",

            "soc_addr", "block", "dist", "ph_no", "email", 
            
            "bank_name", "branch_name", "acc_type",

            "acc_no", "ifsc_code", "pan_no", "gst_no"

        );

        $data   =   (array) $this->Paddy->f_get_particulars("md_society", $select, $where, 1);


        $audit  =   array(
            
            'deleted_by'    => $this->session->userdata('loggedin')->user_name,
            
            'deleted_dt'    => date('Y-m-d')

        );

        //Inserting Data
        $this->Paddy->f_insert('md_society_deleted', array_merge($data, $audit));

        $this->Paddy->f_delete('md_society', $where);

        //For notification storing message
        $this->session->set_flashdata('msg', 'Successfully deleted!');

        redirect("paddy/society");
        
    }

    //Societies for a particular block selected by user
    public function f_societies() {

        // $where = array(
        //    "sl_no"    =>  $this->input->get('sl_no')
        //  );

        $data   =   $this->Paddy->f_get_particulars("md_society", array("sl_no", "soc_name"), array( "block" => $this->input->get('block')), 0);

        echo json_encode($data);

    }


    /*********************For Mill Screen******************/
    #Mill List from table md_mill
    public function f_mill() {


            //Retriving mill Details
               $select     =   array(  "sl_no",
               "mill_name","mill_code",
               "reg_no",
                "ph_no",
                 "dist" );

               $where = array(

                "branch_id" => $this->session->userdata['loggedin']['branch_id']
               );

            $mill['mill_dtls']    =   $this->Paddy->f_get_particulars("md_mill", $select,$where, 0);

            //District List
            $mill['dist']         =   $this->Paddy->f_get_particulars("md_district", NULL, NULL, 0);

            $mill['tot_row']      =$this->Paddy->f_get_total_without_kms_id("md_mill");

            $mill['tots_rows']      =$this->Paddy->f_get_mill_district_wise("md_mill");

            $this->load->view('post_login/main');

            $this->load->view("mill/dashboard", $mill);

            $this->load->view('search/search');

            $this->load->view('post_login/footer');

        
    }
	
	    public function f_milll() {


            //Retriving mill Details
               $select     =   array(  "sl_no",
               "mill_name","mill_code","block",
               "reg_no",
                "ph_no",
                 "dist" );

               $where = array(

                "branch_id" => $this->session->userdata['loggedin']['branch_id']
               );

            $mill['mill_dtls']    =   $this->Paddy->f_get_particulars("md_mill", $select,$where, 0);

            //District List
            $mill['dist']         =   $this->Paddy->f_get_particulars("md_district", NULL, NULL, 0);

            $mill['tot_row']      =$this->Paddy->f_get_total_without_kms_id("md_mill");

            $mill['tots_rows']      =$this->Paddy->f_get_mill_district_wise("md_mill");

            $this->load->view('post_login/main');

            $this->load->view("mill/mill_list", $mill);

            $this->load->view('search/search');

            $this->load->view('post_login/footer');

        
    }

    //New Mill add in the table md_mill
    public function f_mill_add() {

        if($_SERVER['REQUEST_METHOD'] == "POST") {
            

            $this->form_validation->set_rules('mill_code', 'Mill Code', 'required');
            $this->form_validation->set_rules('reg_no', 'Registration Number', 'required');
            $this->form_validation->set_rules('block', 'Block ', 'required');
            $this->form_validation->set_rules('gst_no', 'GST Number', 'required');
            $this->form_validation->set_rules('boiler_reg_no', 'Boiler Registration Number', 'required');
            $this->form_validation->set_rules('pan', 'Pan Number', 'required');
            $this->form_validation->set_rules('tan', 'Tan Number', 'required');
            $this->form_validation->set_rules('pin', 'PIN Number', 'required');
            $this->form_validation->set_rules('addr', 'Address', 'required');

            if ($this->form_validation->run() == FALSE)
            {
                $this->session->set_flashdata('msg', 'You Misssed Required Field!');

                redirect('paddys/add_new/f_mill');

            }else{
            
            $data_array = array (

                "mill_code"     =>  $this->input->post('mill_code'),

                "mill_name"     =>  $this->input->post('name'),

                "reg_no"        =>  $this->input->post('reg_no'),

                "reg_date"      =>  $this->input->post('reg_date'),

                "boiler_reg_no" =>  $this->input->post('boiler_reg_no'),

                "tan"           =>  $this->input->post('tan'),

                "police_station" =>  $this->input->post('police_station'),

                "post_office"    =>  $this->input->post('post_office'),

                "pin"            =>  $this->input->post('pin'),

                "mill_addr"     =>  $this->input->post('addr'),

                "branch_id"     =>  $this->session->userdata['loggedin']['branch_id'],

                "block"         =>  $this->input->post('block'),

                "dist"          =>  $this->session->userdata['loggedin']['districts_catered'],

                "ph_no"         =>  $this->input->post('ph_no'),

                "email"         =>  $this->input->post('email'),

                "bank_name"     =>  $this->input->post('bnk_name'),

                "branch_name"   =>  $this->input->post('brnch_name'),

                "acc_type"      =>  $this->input->post('acc_type'),

                "acc_no"        =>  $this->input->post('acc_no'),

                "ifsc_code"     =>  $this->input->post('ifsc'),

                "pan_no"        =>  $this->input->post('pan'),

                "gst_no"        =>  $this->input->post('gst_no'),

                "guide_lines_id"  => implode(",",$this->input->post('guide_lines_id')),

                "created_by"    =>  $this->session->userdata['loggedin']['user_name'],

                "created_dt"    =>  date('Y-m-d')
               );
                
              $this->Paddy->f_insert('md_mill', $data_array);
             
               

            //For notification storing message

            $this->session->set_flashdata('msg', 'Successfully added!');

            redirect('paddys/add_new/f_mill');
            }

        }

        else {
             
            
            //Block List
            $mill['block']   =   $this->Paddy->f_get_particulars("md_block", NULL,array("branch_id" => $this->session->userdata['loggedin']['branch_id']), 0);
            
             // Guidelines List
            $mill['guidelines']         =   $this->Paddy->f_get_particulars("md_fs_guide_lines", NULL, NULL, 0);


            $this->load->view('post_login/main');

            $this->load->view("mill/add", $mill); 

            $this->load->view('post_login/footer');

        }

    }


    public function f_mill_upload() {

        if($_SERVER['REQUEST_METHOD'] == "POST") {

            //For Excel Upload
            $csvMimes = array('text/x-comma-separated-values',
					   'text/comma-separated-values',
					   'application/octet-stream',
					   'application/vnd.ms-excel',
					   'application/x-csv',
					   'text/x-csv',
					   'text/csv',
					   'application/csv',
					   'application/excel',
					   'application/vnd.msexcel',
                       'text/plain');
            
            //For Cheque Details uploadation
            if(!empty($_FILES['f_mill_detail']['name']) && in_array($_FILES['f_mill_detail']['type'],$csvMimes)){
					   
                $csvFile = fopen($_FILES['f_mill_detail']['tmp_name'], 'r');

                    $j=0;
                    
                    while(($line = fgetcsv($csvFile)) !== FALSE){
                        
                            $data = array(
                                'sl_no'        =>  $line[2],
                                'dist'         =>  $line[0],
                                'block'        =>  '0'.$line[1],
                                'mill_code'    =>  $line[2],
                                'mill_name'    =>  $line[3],
                                'branch_id'    =>  $line[0]
                                   );
                                    
                                $query = $this->db->get_where('md_mill', array('mill_code ='=> $line[2]));
            
                                if ($query->num_rows() == 0)
                                    {   
                                        $id=$this->Paddy->f_insert('md_mill', $data);
                                        if(isset($id)){
                                                $j++;
                                        }   
                                    }
                            
                         }
                 
                fclose($csvFile);
              
               }

            //For notification storing message
            $this->session->set_flashdata('msg', $j.' Record Successfully added!');
         

            redirect('paddys/add_new/f_mill');

        }
        else {

            $where      =   array(
                "branch_id" =>$this->session->userdata['loggedin']['branch_id']
            );

            //District List
            $block['blocks']  =   $this->Paddy->f_get_particulars("md_block",NULL,$where, 0);

            $this->load->view('post_login/main');

            $this->load->view("mill/add_upload", $block);

            $this->load->view('post_login/footer');
        }
        
    }
    //   Mill update using Food Api  10/12/2020 //
    public function f_mill_update() {

        $url = 'https://procurement.wbfood.in/api/Statusupd/RiceMill'; /*Mill*/
        
        
        $data = array('authcode' => 'ahtr*125#');
        $options = array(
            'http' => array(
                'header' => "Content-type: application/x-www-form-urlencoded\r\n",
                'method' => 'POST',
                'content' => http_build_query($data)
            )
        );

      
        $context = stream_context_create($options);
        $result  = file_get_contents($url, false, $context);

        $data   = json_decode($result);

         $j=0;

        foreach ($data as $value) {

                       $data = array(
                                'sl_no'        =>  $value->r_mill_cd,
                                'dist'         =>  $value->DistrictCode,
                                'block'        =>  '0'.$value->BlockCode,
                                'mill_code'    =>  $value->r_mill_cd,
                                'mill_name'    =>  $value->RiceMillerName,
                                'branch_id'    =>  $value->DistrictCode
                                   );

                    $query = $this->db->get_where('md_mill', array('mill_code ='=> $value->r_mill_cd));
        
                        if ($query->num_rows() == 0)
                            {   
                                 $this->Paddy->f_insert('md_mill', $data); 
                                   
                                        $j++;
                                     
                            }

            }

            $this->session->set_flashdata('msg', $j.' Records successfully added!');

            redirect('paddys/add_new/f_mill');


    }

    //Mill details edit in the table md_mill
    public function f_mill_edit(){


        if($_SERVER['REQUEST_METHOD'] == "POST") {

            $data_array = array (

                "guide_lines_id"=>  $this->input->post('mill_type'),

                "bank_name"     =>  $this->input->post('bnk_name'),

                "acc_no"        =>  $this->input->post('acc_no'),

                "ifsc_code"     =>  $this->input->post('ifsc'),

                "modified_by"   =>  $this->session->userdata['loggedin']['user_name'],

                "modified_dt"   =>  date('Y-m-d')

            );

            $where = array(

                "sl_no"        =>  $this->input->post('sl_no')

            );
            
            $this->Paddy->f_edit('md_mill', $data_array, $where);

            //For notification storing message
            $this->session->set_flashdata('msg', 'Successfully updated!');

            

            redirect('paddys/add_new/f_milll');

        }

        else {

            
            $where = array(

                "sl_no"    =>  $this->input->get('sl_no')

            );
            
            $wheres = array(

                "branch_id"        =>  $this->session->userdata['loggedin']['branch_id']

            );//Block List
            
           $whereb = array(

                "1 ORDER BY bank_name"    =>  NULL

            );

             
            $mill['block']   =   $this->Paddy->f_get_particulars("md_block", NULL,$wheres, 0);

           
            // Guidelines List
            $mill['guidelines']    = $this->Paddy->f_get_particulars("md_fs_guide_lines", NULL, NULL, 0);

            //Mill list of latest month
            $mill['mill_dtls']    =   $this->Paddy->f_get_particulars("md_mill", NULL, $where, 1);

            //Bank list of latest month
            $mill['bank_dtls']    =   $this->Paddy->f_get_particulars("md_bank_dtls", NULL, $whereb, 0);


            $this->load->view('post_login/main');

            $this->load->view("mill/edit", $mill);

            $this->load->view('post_login/footer');

        }

    }

    //Mill Delete
    public function f_mill_delete(){

        $where = array(
            
            "sl_no"    =>  $this->input->get('sl_no')
            
        );

        //Retriving the data row for backup
        $select = array (

            "sl_no", "mill_name", "reg_no", "reg_date",

            "mill_addr", "dist", "ph_no", "email", 
            
            "bank_name", "branch_name", "acc_type",

            "acc_no", "ifsc_code", "pan_no", "gst_no"

        );

        $data   =   (array) $this->Paddy->f_get_particulars("md_mill", $select, $where, 1);


        $audit  =   array(
            
            'deleted_by'    => $this->session->userdata('loggedin')->user_name,
            
            'deleted_dt'    => date('Y-m-d')

        );

        //Inserting Data
        $this->Paddy->f_insert('md_mill_deleted', array_merge($data, $audit));

        $this->Paddy->f_delete('md_mill', $where);
        
        //For notification storing message
        $this->session->set_flashdata('msg', 'Successfully deleted!');

        redirect("paddy/mill");
        
    }

    //District wise Mill List
    public function f_mills() {

        $data   =   $this->Paddy->f_get_particulars("md_mill", array("sl_no", "mill_name"), array( "dist" => $this->input->get('dist')), 0);

        echo json_encode($data);

    }
     /*********************Start For Mill add With Society Screen********************/
     public function f_society_mill() {

        //Retriving mill Details

        $brn = $this->session->userdata['loggedin']['branch_id'];

        $kms = $this->session->userdata['loggedin']['kms_id'];

        $society_mill['soc_mill_dtls']    =   $this->Paddy->f_get_soc_mil($brn,$kms);

        //Guideline List

        $this->load->view('post_login/main');

        $this->load->view("society_mill/dashboard", $society_mill);

        $this->load->view('search/search');

        $this->load->view('post_login/footer');
        
    }
    public function f_get_agreement(){

        $select = array ("agreementno");

        $where = array(
            
            "sl_no"    =>  $this->input->post('soc_id')
            
        );

        $agreement    =   $this->Paddy->f_get_particulars("md_society", NULL, $where, 1);

       

        $data["target"] = $agreement->agreementno;

        echo json_encode($data);

    }

    public function f_soc_mill_add() {

        if($_SERVER['REQUEST_METHOD'] == "POST") {
            
            $data_array = array (

                "branch_id"    =>  $this->session->userdata['loggedin']['branch_id'],

                "soc_id"       =>  $this->input->post('soc_id'),

                "mill_id"      =>  $this->input->post('mill_id'),

                "dist"         =>  $this->session->userdata['loggedin']['districts_catered'],

                "distance"     =>  $this->input->post('distance'),

                "reg_no"       =>  $this->input->post('reg_no'),

                "target"       =>  $this->input->post('target'),

                "kms_id"       =>  $this->session->userdata['loggedin']['kms_id'],

                "created_by"   =>  $this->session->userdata['loggedin']['user_name'],

                "created_dt"   => date('Y-m-d h:i:s')

            );
                
              $id=$this->Paddy->f_insert('md_soc_mill', $data_array);
             
            //For notification storing message

            $this->session->set_flashdata('msg', 'Successfully added!');

            redirect('paddys/add_new/f_society_mill');

        }

        else {
            
            //Block List
            $society_mill['society'] = $this->Paddy->f_get_particulars("md_society", NULL,array("branch_id" => $this->session->userdata['loggedin']['branch_id']), 0);

            $society_mill['dists']  =   $this->Paddy->f_get_particulars("md_district",NULL,NULL, 0);
     
            // Mill List
            $society_mill['mills'] = $this->Paddy->f_get_particulars("md_mill", NULL,array("branch_id" => $this->session->userdata['loggedin']['branch_id']), 0);

            $this->load->view('post_login/main');

            $this->load->view("society_mill/add", $society_mill); 

            $this->load->view('post_login/footer');

        }

    }

     //Society Mill Edit Screen 
     public function f_society_mill_edit(){

        if($_SERVER['REQUEST_METHOD'] == "POST") {
            
            $data_array = array (

                "soc_id"        =>  $this->input->post('soc_id'),

                "mill_id"       =>  $this->input->post('mill_id'),
                
                "distance"      =>  $this->input->post('distance'),

                "reg_no"        =>  $this->input->post('reg_no'),

                "target"        =>  $this->input->post('target'),

                "modified_by"   =>  $this->session->userdata['loggedin']['user_name'],

                "modified_dt"   =>  date('Y-m-d h:i:s')

            );

           

            $where = array(

                "branch_id"   =>  $this->session->userdata['loggedin']['branch_id'],

                "soc_id"      =>  $this->input->post('societyid'),

                "mill_id"     =>  $this->input->post('millid'),

                "kms_id"      =>  $this->session->userdata['loggedin']['kms_id']

            );
            
            //For notification storing message
            $this->session->set_flashdata('msg', 'Successfully updated!');

            $this->Paddy->f_edit('md_soc_mill', $data_array, $where);

            redirect('paddys/add_new/f_society_mill');

        }
        else{
            $branch_id=$_GET["branch_id"];
            $soc_id=$_GET["soc_id"];
            $mill_id=$_GET["mill_id"];
            $kms_id=$_GET["kms_id"];
      
        $society_mill['soc_mills'] = $this->Paddy->f_get_particulars("md_soc_mill", NULL,array("branch_id" =>$branch_id,"soc_id" =>$soc_id,"mill_id" =>$mill_id,"kms_id" =>$kms_id), 1);
 
        $society_mill['society'] = $this->Paddy->f_get_particulars("md_society", NULL,array("branch_id" => $this->session->userdata['loggedin']['branch_id']), 0);
     
        // Mill List
        $society_mill['mills'] = $this->Paddy->f_get_particulars("md_mill", NULL,array("branch_id" => $this->session->userdata['loggedin']['branch_id']), 0);


            $this->load->view('post_login/main');

            $this->load->view("society_mill/edit", $society_mill); 

            $this->load->view('post_login/footer');
            
        }
    }
    /*********************End For Mill add With Society Screen********************/
    //Societies for a block selected by user 
    public function f_socmills() {

        $data   =   $this->Paddy->f_get_particulars("md_mill m, md_soc_mill s", array("m.mill_name"), array("m.sl_no = s.mill_id" => null, "s.soc_id" => $this->input->get('soc_id')), 0);

        echo json_encode($data);

    }

    /*********************For Farmer Registration Screen********************/
    public function f_farmer(){
     
         //Retriving Farmerreg Details
         $select     =   array(
 
            
             "m.soc_name","t.soc_id","count(`t`.`reg_no` ) cnt"
 
         );
 
         $where      =   array(
             "t.soc_id = m.sl_no " => NULL,
              "t.branch_id" =>$this->session->userdata['loggedin']['branch_id'],
              "t.kms_id" => $this->session->userdata['loggedin']['kms_id'],
              "1 GROUP BY t.soc_id,m.soc_name"=>NULL
              
         );
         $kms_id = $this->session->userdata['loggedin']['kms_id'];
 
        $farmerreg['farmerreg_dtls'] =   $this->Paddy->f_get_particulars("td_farmer_reg t, md_society m", $select, $where, 0);
        $farmerreg['tot_rowss']        =   $this->Paddy->f_get_total_row("td_farmer_reg",$this->session->userdata['loggedin']['kms_id']);
         $farmerreg['dist']          =   $this->Paddy->f_get_particulars("md_district", NULL, NULL, 0);
         $farmerreg['tot_rows']       =   $this->Paddy->f_get_row_districtwise("td_farmer_reg",$kms_id);
        
        $this->load->view('post_login/main');
 
        $this->load->view("farmerreg/dashboard", $farmerreg);
 
        $this->load->view('search/search');
         
        $this->load->view('post_login/footer');


    }


    
    //New Registered Farmer Registered Add in the table td_reg_farmer
    public function f_farmreg_add() {

        if($_SERVER['REQUEST_METHOD'] == "POST") {

            $data_array = array(

                "kms_id"     =>  $this->session->userdata['loggedin']['kms_id'],

                "branch_id"  =>  $this->session->userdata['loggedin']['branch_id'],

                "block"      =>  $this->input->post('block'),

                "soc_id"     =>  $this->input->post('soc_name'),
                
                "farm_name"  =>  $this->input->post('farm_name'),

                "father_name" =>  $this->input->post('father_name'),

                "land_holding" =>  $this->input->post('land_holding'),

                "farmer_type"  =>  $this->input->post('farmer_type'),

                "reg_dt"     =>  $this->input->post('reg_dt'),

                "reg_no"     =>  $this->input->post('reg_no'),

                "addhar_no"  =>  $this->input->post('addhar_no'),

                "pan_no"     =>  $this->input->post('pan_no'),

                "epic_no"    =>  $this->input->post('epic_no'),

                "address"    =>  $this->input->post('address'),

                "pin_no"     =>  $this->input->post('pin_no'),

                "mobile_number" =>  $this->input->post('mobile_number'),

                "email"      =>  $this->input->post('email'),

                "account_no"  =>  $this->input->post('account_no'),

                "ifsc_code"   =>  $this->input->post('ifsc_code'),

                "remarks"   =>  $this->input->post('remarks'),

                "created_by"    =>  $this->session->userdata['loggedin']['user_name'],

                "created_dt"    =>  date('Y-m-d')

            );

            $this->Paddy->f_insert('td_farmer_reg', $data_array);

            //For notification storing message
            $this->session->set_flashdata('msg', 'Successfully added!');

            redirect('paddys/add_new/f_farmer');

        }
        else {

            $where      =   array(
                "branch_id" =>$this->session->userdata['loggedin']['branch_id']
            );

            //District List
            $farmerreg['blocks']  =   $this->Paddy->f_get_particulars("md_block",NULL,$where, 0);

            $this->load->view('post_login/main');

            $this->load->view("farmerreg/add", $farmerreg);

            $this->load->view('post_login/footer');

        }
        
    }

      //New Paddy Collection Add in table td_collections
    public function f_farmreg_upload() {

        if($_SERVER['REQUEST_METHOD'] == "POST") {

            //For Excel Upload
            $csvMimes = array('text/x-comma-separated-values',
					   'text/comma-separated-values',
					   'application/octet-stream',
					   'application/vnd.ms-excel',
					   'application/x-csv',
					   'text/x-csv',
					   'text/csv',
					   'application/csv',
					   'application/excel',
					   'application/vnd.msexcel',
                       'text/plain');
                     
            //For Cheque Details uploadation
            if(!empty($_FILES['f_farmer_detail']['name']) && in_array($_FILES['f_farmer_detail']['type'],$csvMimes)){
					   
                $csvFile = fopen($_FILES['f_farmer_detail']['tmp_name'], 'r');

                    $j=0;

                    while(($line = fgetcsv($csvFile)) !== FALSE){
                        
                    $data = array(

                        "kms_id"       =>  $this->session->userdata['loggedin']['kms_id'],
                        "branch_id"    =>  $line[0],
                        "dist"         =>  $line[0],
                        "block"        =>   $line[1],
                        'soc_id'       =>  $line[2],
                        'reg_dt'       =>  date("y-m-d", strtotime($line[3])),
                        'reg_no'       =>  $line[4],
                        'farm_name'    =>  $line[5],
                        'father_name'  =>  $line[6],
                        'relation'     =>  $line[7],
                        'caste'        =>  $line[8],
                        'address'      =>  $line[9],
                        'epic_no'      =>  $line[10],
                        'account_no'   =>  $line[11],
                        'ifsc_code'    =>  $line[12],
                        'land_holding' =>  $line[13],
                        'land_description' => $line[14],
                        'farmer_type'   => $line[15],
                        "created_by"    =>  $this->session->userdata['loggedin']['user_name'],
                        "created_dt"    =>  date('Y-m-d')
                                );

                     $query = $this->db->get_where('td_farmer_reg', array('reg_no ='=> $line[4]));
            
                        if ($query->num_rows() == 0)
                            {   
                               $id = $this->Paddy->f_insert('td_farmer_reg', $data);  
                                if(isset($id)){
                                    $j++;
                                }  
                        }
                       
                                    
                 }  
                    
                    
                fclose($csvFile);

            }

            //For notification storing message
            $this->session->set_flashdata('msg', $j.' Record Successfully added!');
           

            redirect('paddys/add_new/f_farmer');

        }
        else {

            $where      =   array(
                "branch_id" =>$this->session->userdata['loggedin']['branch_id']
            );

            //District List
            $farmerreg['blocks']  =   $this->Paddy->f_get_particulars("md_block",NULL,$where, 0);

            $this->load->view('post_login/main');

            $this->load->view("farmerreg/add_upload", $farmerreg);

            $this->load->view('post_login/footer');
        }
        
    }

    public function f_farmreg_update() {
        
        //$date = date('Y-m-d');
        $date = '2018-01-01';
        $url = 'https://procurement.wbfood.in/api/Statusupd/Framerregdtls';/*Farmer*/
        $j=0;

        while ($date <= '2020-12-09') {
        
        $date1 = date("d/m/Y", strtotime($date));
        
        $data = array('authcode' => 'ahtr*125#','dt_from' => $date1);

        $options = array(
            'http' => array(
                'header' => "Content-type: application/x-www-form-urlencoded\r\n",
                'method' => 'POST',
                'content' => http_build_query($data)
            )
        );
      
        $context = stream_context_create($options);
        $result  = file_get_contents($url, false, $context);

        //print_r($result);
       
        $data   = json_decode($result);

        foreach ($data as $value) {

               $dates = explode('/',$value->regdt);

               $reg_date = $dates[2].'-'.$dates[1].'-'.$dates[0];

          ///  echo date("Y-m-d", strtotime($value->regdt));die;

                    $data = array(
                        "kms_id"           =>  $this->session->userdata['loggedin']['kms_id'],
                        "branch_id"        =>  $value->districtcode,
                        "dist"             =>  $value->districtcode,
                        "block"            =>  $value->blockcode,
                        'soc_id'           =>  $value->proccentreid,
                        'reg_dt'           =>  $reg_date,
                        'reg_no'           =>  $value->regno,
                        'farm_name'        =>  $value->name,
                        'father_name'      =>  $value->father_mother_spouse_name,
                        'relation'         =>  $value->relation_with_farmer,
                        'caste'            =>  $value->Caste,
                        'address'          =>  $value->address,
                        'epic_no'          =>  $value->epic_no,
                        'villagecode'      =>  $value->villagecode,
                        'account_no'       =>  $value->bank_accno,
                        'ifsc_code'        =>  $value->bank_ifsc,
                        'land_holding'     =>  $value->land_area_hectare,
                        'land_description' =>  $value->land_desc,
                        'farmer_type'      =>  $value->krishakbandhu,
                        "created_by"       =>  $this->session->userdata['loggedin']['user_name'],
                        "created_dt"       =>  date('Y-m-d')
                                                  
                     );

                    $query = $this->db->get_where('temp_farmer_reg', array('reg_no ='=> $value->regno));
            
                        if ($query->num_rows() == 0)
                            {   
                               $id = $this->Paddy->f_insert('temp_farmer_reg', $data);  
                                if(isset($id)){
                                    $j++;
                                }  
                           }

            }

             $date = date("Y-m-d", strtotime($date. "+1 day"));
         }

            //For notification storing message
            $this->session->set_flashdata('msg', $j.' Record Successfully added!');

            redirect('paddys/add_new/f_farmer');
        
    }
    

      //For Farmer Details Modal
    public function f_getFarmerDetails(){

        $data['farmer_dtls'] =   $this->Paddy->f_get_particulars('td_farmer_reg', NULL, array('soc_id' => $this->input->get('soc_id')), 0);
        

        if(empty($data['farmer_dtls'])){
            $data['farmer_dtls'] =   $this->Paddy->f_get_particulars('td_farmer_reg', NULL, array('soc_id' => $this->input->get('soc_id')), 0);
            $this->load->view('farmerreg/farmer_dtls', $data);
        }
        else{
            $this->load->view('farmerreg/farmer_dtls', $data);
        }

    }

    public function f_farmersearch(){


         if($_SERVER['REQUEST_METHOD'] == "POST") {


            $kms_id     = $this->session->userdata['loggedin']['kms_id'];

            //$branch_id  = $this->session->userdata['loggedin']['branch_id'];

            $reg_no = $this->input->post('reg_no');

            $farmer['farmerdetail']     =   $this->Paddy->get_farmer_detail_by_regno($reg_no,$kms_id);
            $farmer['procurementdtls']  =  $this->Paddy->get_farmer_procurement_detail($reg_no,$kms_id);
          
            
            $this->load->view('post_login/main');

            $this->load->view("farmerreg/farmer_detail", $farmer);

            $this->load->view('post_login/footer');


        }
        else {
    
            $farmers['sys_date']   =   $_SESSION['sys_date'];

            $this->load->view('post_login/main');

            $this->load->view("farmerreg/farmer_detail", $farmers);

            $this->load->view('post_login/footer');


        }

           
    }

    public function f_farmersearchbyname(){


         if($_SERVER['REQUEST_METHOD'] == "POST") {


            $kms_id    = $this->session->userdata['loggedin']['kms_id'];
            $farm_name = $this->input->post('farm_name');

            $farmer   = $this->Paddy->get_farmer_detail_by_name($farm_name,$kms_id);
         echo json_encode($farmer);

        }
        else {
    
            $farmers['sys_date']   =   $_SESSION['sys_date'];

            $this->load->view('post_login/main');

            $this->load->view("farmerreg/farmer_detail_byname", $farmers);

            $this->load->view('post_login/footer');


        }

           
    }
    //Edit No of registered Farmer in td_reg_farmer
    public function f_farmerreg_edit() {

        if($_SERVER['REQUEST_METHOD'] == "POST") {

            $data_array = array(

                "trans_dt"      =>  $this->input->post('trans_dt'),

                "dist"          =>  $this->input->post('dist'),

                "soc_id"        =>  $this->input->post('soc_name'),

                "farmer_no"     =>  $this->input->post('farmer_no'),

                "modified_by"   =>  $this->session->userdata('loggedin')->user_name,

                "modified_dt"   =>  date('Y-m-d h:i:s')

            );

            $where  =   array(

                "reg_no"     =>  $this->input->post('reg_no')

            );

            $this->Paddy->f_edit('td_reg_farmer', $data_array, $where);

            //For notification storing message
            $this->session->set_flashdata('msg', 'Successfully edited!');

            redirect('paddy/farmerreg');


        }
        else {

            //District List
            $farmerreg['dist']    =   $this->Paddy->f_get_particulars("md_district", NULL, NULL, 0);

            //Farmerreg Details
            $select     =   array(

                "t.trans_dt", "t.reg_no", "t.dist",
    
                "t.soc_id", "t.farmer_no", "m.block"
    
            );
    
            $where      =   array(
    
                "t.soc_id = m.sl_no"    => NULL,
                
                "t.reg_no" => $this->input->get('reg_no')
                
            );

            $farmerreg['farmerreg_dtls']=   $this->Paddy->f_get_particulars("td_reg_farmer t, md_society m", $select, $where, 1);
            
            $this->load->view('post_login/main');

            $this->load->view("farmerreg/edit", $farmerreg);

            $this->load->view('post_login/footer');

        }
        
    }

    /*********************For Bank Screen********************/

    //Fetching the Districts List
    public function f_paddy_bank() {
        
        //District List
        $bank['bnk']   =   $this->PaddyBank->f_get_bank();

        $this->load->view('post_login/main');

        $this->load->view("bank/dashboard", $bank);

        $this->load->view('search/search');

        $this->load->view('post_login/footer');
        
    }

    //Add new Bank in the md_paddy_bank table
    public function f_bank_add() {

        if($_SERVER['REQUEST_METHOD'] == "POST") {

            $data_array = array(

                "bank_id"       =>  $this->input->post('bnk'),

                "dist_id"       =>  $this->input->post('dist'),
                
                "branch"        =>  $this->input->post('brn'),

                "ifs"           =>  $this->input->post('ifs'),

                "acc_no"        =>  $this->input->post('acc_no'),

                "short_code"    =>  $this->input->post('srt_cd'),

                "micr_code"     =>  $this->input->post('micr'),

                "trans_code"    =>  $this->input->post('trans_cd'),

                "created_by"    =>  $this->session->userdata['loggedin']['user_name'],

                "created_dt"    =>  date('Y-m-d h:i:s')

            );

            $this->Paddy->f_insert('md_paddy_bank', $data_array);

            $this->session->set_flashdata('msg', 'Successfully added!');
            redirect('paddys/add_new/f_paddy_bank');
                

        }
        else {

            //Bank List
            $district['dist']          =   $this->Paddy->f_get_particulars("md_district", NULL, NULL, 0);

            $this->load->view('post_login/main');

            $this->load->view("bank/add", $district);

            $this->load->view('post_login/footer');

        }
        
    }

    //Edit District's name in the md_district table
    public function f_bank_edit() {

        if($_SERVER['REQUEST_METHOD'] == "POST") {

            $data_array = array(

                "branch"        =>  $this->input->post('brn'),

                "ifs"           =>  $this->input->post('ifs'),

                "acc_no"        => $this->input->post('acc_no'),

                "short_code"    => $this->input->post('srt_cd'),

                "micr_code"     => $this->input->post('micr'),

                "trans_code"    => $this->input->post('trans_cd'),

            );

            $where  =   array(

                "sl_no"     =>  $this->input->post('sl_no')

            );

            $this->Paddy->f_edit('md_paddy_bank', $data_array, $where);

            //For notification storing message
            $this->session->set_flashdata('msg', 'Successfully edited!');

            redirect('paddys/add_new/f_paddy_bank');


        }
        else {

            //Bank List
            $bank_sl = $this->input->get('slno');

            $bank['bank_dtls']   =   $this->PaddyBank->f_get_bank_dtls($bank_sl);

            $this->load->view('post_login/main');

            $this->load->view("bank/edit", $bank);

            $this->load->view('post_login/footer');

        }
        
    }


    /*********************For Paddy Collection Screen********************/
    

    //For Status Update of Farmer NEFT
    public function f_updateStatus(){

        $value =  ($this->input->get('value') == 1)? 0:1;

        $this->Paddy->f_edit('td_details_farmer', array("status" => $value), array('trans_id' => $this->input->get('trans_id')));

    }

    //For Status Update of Farmer Cheque
    public function f_updateStatusCheque(){

        $value =  ($this->input->get('value') == 1)? 0:1;

        $this->Paddy->f_edit('td_details_farmer_cheque', array("status" => $value), array('trans_id' => $this->input->get('trans_id')));

    }

    //Farmer Paddy Collection Data From Food
    public function f_farmer_trans(){

        $where      =   array(
           
             "branch_id" =>$this->session->userdata['loggedin']['branch_id'],
             "kms_id" => $this->session->userdata['loggedin']['kms_id']
            
             
        );

      // $paddy_transaction['transaction_dtls']  = $this->Paddy->f_get_particulars("td_paddy_transaction", NULL, $where, 0);
      
       $this->load->view('post_login/main');

       $this->load->view("paddy_transaction/dashboard");

       $this->load->view('search/search');
        
       $this->load->view('post_login/footer');

       }

  
    public function f_fartrans_upload() {


    if($_SERVER['REQUEST_METHOD'] == "POST") {

        //For Excel Upload
        $csvMimes = array('text/x-comma-separated-values',
                   'text/comma-separated-values',
                   'application/octet-stream',
                   'application/vnd.ms-excel',
                   'application/x-csv',
                   'text/x-csv',
                   'text/csv',
                   'application/csv',
                   'application/excel',
                   'application/vnd.msexcel',
                   'text/plain');
        
        //For Cheque Details uploadation
        if(!empty($_FILES['f_paddy_transaction']['name']) && in_array($_FILES['f_paddy_transaction']['type'],$csvMimes)){
                   
            $csvFile = fopen($_FILES['f_paddy_transaction']['tmp_name'], 'r');
                            
                while(($line = fgetcsv($csvFile)) !== FALSE){
                 $j = 0;
                      
                $data = array(

                    "kms_id"         =>  $this->session->userdata['loggedin']['kms_id'],
                    "branch_id"      =>  $this->session->userdata['loggedin']['branch_id'],
                    "centercode"     =>  $line[0],
                    "reg_no"         =>  $line[1],
                    'procurement_dt' =>  $line[2],
                    'quantity'       =>  $line[3],
                    'amount'         =>  $line[4],
                    'chequeno'       =>  $line[5],
                    'chequedate'     =>  $line[6],
                    'transactionid'  =>  $line[7],
                    "created_by"     =>  $this->session->userdata['loggedin']['user_name'],
                    "created_dt"     =>  date('Y-m-d')
                            );
                        
                 $query = $this->db->get_where('td_paddy_transaction', array('transactionid ='=> $line[7]));
        
                    if ($query->num_rows() == 0)
                        {   
                            $id = $this->Paddy->f_insert('td_paddy_transaction', $data);
                            
                            if(isset($id)){
                                                $j++;
                                        }   
                    }
                                
             }  
                
              
            fclose($csvFile);

            //$this->Paddy->f_insert_multiple('td_farmer_reg', $data);
        }

        //For notification storing message
        $this->session->set_flashdata('msg', $j.' Record Successfully added!');

        redirect('paddys/add_new/f_farmer_trans');

    }
    else {
       //  $where      =   array(
           
       //      "branch_id" =>$this->session->userdata['loggedin']['branch_id'],
       //      "kms_id" => $this->session->userdata['loggedin']['kms_id']
       // );

       //$paddy_transaction['transaction_dtls']  = $this->Paddy->f_get_particulars("td_paddy_transaction", NULL, $where, 0);
     
       $this->load->view('post_login/main');

       $this->load->view("paddy_transaction/add");
       
       //$this->load->view("paddy_transaction/add", $paddy_transaction);

       $this->load->view('search/search');
       
       $this->load->view('post_login/footer');

        }
    
    }
    //Paddy Collection edit in table td_collections
    public function f_paddycollection_edit() {

        if($_SERVER['REQUEST_METHOD'] == "POST") {
            
            $data_array = array(

                "trans_dt"      =>  $this->input->post('trans_dt'),

                "dist"          =>  $this->input->post('dist'),

                "soc_id"        =>  $this->input->post('soc_name'),

                "no_of_camp"    =>  $this->input->post('no_of_camp'),
                
                "paddy_qty"     =>  $this->input->post('paddy_qty'),

                "no_of_farmer"  =>  $this->input->post('no_of_farmer'),

                "modified_by"   =>  $this->session->userdata('loggedin')->user_name,

                "modified_dt"   =>  date('Y-m-d h:i:s')

            );

            $where  =   array(

                "coll_no"     =>  $this->input->post('coll_no')

            );

            $this->Paddy->f_edit('td_collections', $data_array, $where);

            //For Excel Upload
            $csvMimes = array('text/x-comma-separated-values',
					   'text/comma-separated-values',
					   'application/octet-stream',
					   'application/vnd.ms-excel',
					   'application/x-csv',
					   'text/x-csv',
					   'text/csv',
					   'application/csv',
					   'application/excel',
					   'application/vnd.msexcel',
					   'text/plain');
            if(!empty($_FILES['f_payment']['name']) && in_array($_FILES['f_payment']['type'],$csvMimes)){
					   
                $csvFile = fopen($_FILES['f_payment']['tmp_name'], 'r');
                    
                    while(($line = fgetcsv($csvFile)) !== FALSE){
                        
                        if($this->input->post('bank_statement')){
                            
                            $data_array = array(
                                "status" => ($line[11] == 'Success')? 1 : 0
                            );
                            $where = array(
                                "acc_no" => $line[5],
                                "amount" => $line[9]
                            );
                            
                            $this->Paddy->f_edit('td_details_farmer', $data_array, $where);

                        }
                        else{

                            $data[] = array(
                                'coll_no'             =>  $this->input->post('coll_no'),
                                'trans_id'            =>  $line[0],
                                'trans_dt'            =>  $this->input->post('trans_dt'),
                                'kms_year'            =>  $this->kms_year,
                                'beneficiary_name'    =>  $line[2],
                                'ifsc'                =>  $line[3],
                                'acc_no'              =>  $line[4],
                                'paddy_qty'           =>  $line[5],
                                'amount'              =>  $line[6]
                            );

                        }
                                    
                    }  

                unset($data[0]);
                $data = array_values($data);    
                
                fclose($csvFile);

                if(isset($data)){
                    //First delete previous datas
                    $this->Paddy->f_delete('td_details_farmer', $where);
                    $this->Paddy->f_delete('td_details_farmer_cheque', $where);
            
                    $this->Paddy->f_insert_multiple('td_details_farmer', $data);
                }
                
            }
            else if(!empty($_FILES['f_payment_cheque']['name']) && in_array($_FILES['f_payment_cheque']['type'],$csvMimes)){
					   
                $csvFile = fopen($_FILES['f_payment_cheque']['tmp_name'], 'r');
                    
                    while(($line = fgetcsv($csvFile)) !== FALSE){
                        
                        $data[] = array(
                                    'coll_no'             =>  $this->input->post('coll_no'),
                                    'trans_id'            =>  $line[1],
                                    'trans_dt'            =>  $this->input->post('trans_dt'),
                                    'kms_year'            =>  $this->kms_year,
                                    'beneficiary_name'    =>  $line[3],
                                    'cheque_no'           =>  $line[7],
                                    'address'             =>  $line[9],
                                    'paddy_qty'           =>  $line[4],
                                    'amount'              =>  $line[5]
                                );
                                    
                    }  
                    
                    unset($data[0]);
                    $data = array_values($data);    
                    
                    fclose($csvFile);

                if(isset($data)){
                    //First delete previous datas
                    $this->Paddy->f_delete('td_details_farmer', $where);
                    $this->Paddy->f_delete('td_details_farmer_cheque', $where);
            
                    $this->Paddy->f_insert_multiple('td_details_farmer_cheque', $data);
                }

            }
            
            //For notification storing message
            $this->session->set_flashdata('msg', 'Successfully edited!');

            redirect('paddy/paddycollection');


        }
        else {

            //District List
            $paddycollection['dist']          =   $this->Paddy->f_get_particulars("md_district", NULL, NULL, 0);

            //Collection Details
            $select     =   array(

                "t.trans_dt", "t.coll_no", "t.dist",

                "t.no_of_camp", "t.no_of_farmer", "t.paddy_qty",
    
                "t.soc_id", "m.block"
    
            );
    
            $where      =   array(
    
                "t.soc_id = m.sl_no"    => NULL,
                
                "t.coll_no" => $this->input->get('coll_no')

            );

            $paddycollection['paddycollection_dtls']=   $this->Paddy->f_get_particulars("td_collections t, md_society m", $select, $where, 1);
            
            $this->load->view('post_login/main');

            $this->load->view("paddycollection/edit", $paddycollection);

            $this->load->view('post_login/footer');

        }
        
    }

    //Paddy Collection Delete from table td_collections
    public function f_paddycollection_delete() {

        $where = array(
            "kms_year"   =>  $this->kms_year,
            "coll_no"    =>  $this->input->get('coll_no')
        );

        //Retriving the data row for backup
        $select = array (

            "trans_dt","kms_year","coll_no","dist","soc_id",
            "no_of_camp","no_of_farmer","paddy_qty"

        );

        $data   =   (array) $this->Paddy->f_get_particulars("td_collections", $select, $where, 1);
        
        $audit  =   array(
            
            'deleted_by'    => $this->session->userdata('loggedin')->user_name,
            
            'deleted_dt'    => date('Y-m-d h:i:s')

        );

        //Inserting Data
        $this->Paddy->f_insert('td_collections_deleted', array_merge($data, $audit));

        //Delete Originals
        $this->Paddy->f_delete('td_collections', $where);
        $this->Paddy->f_delete('td_details_farmer', $where);

        //For notification storing message
        $this->session->set_flashdata('msg', 'Successfully deleted!');

        redirect("paddy/paddycollection");

    }

    //Total Number Of Registered Farmer For a Particular Society from table td_reg_farmer
    public function f_regfarmer(){

        $data = $this->Paddy->f_get_particulars("td_reg_farmer", array("ifnull(sum(farmer_no), 0) sum"), array("soc_id" => $this->input->get('soc_id'), "kms_year" => $this->kms_year), 1);

        echo $data->sum;

    }

    //Sum of Total No Of Farmers Worked for a Particular Society from table td_collections
    public function f_totfarmer(){

        $where      =   array(

            "soc_id"   => $this->input->get('soc_id'),

            "kms_year" => $this->kms_year

        );

        $data = $this->Paddy->f_get_particulars("td_collections", array("ifnull(sum(no_of_farmer), 0) sum"), $where, 1);

        echo $data->sum;

    }
    // Rice rate Screen //
    public function ricerate(){

        $where  = array(

                   "kms_id"   =>  $this->session->userdata['loggedin']['kms_id']
                );

        $ricerate['ricerate_dtls']    = $this->Paddy->f_get_particulars("md_rice_rate",NULL,$where, 0);           
       
        $this->load->view('post_login/main');
 
        $this->load->view("ricerate/dashboard", $ricerate);
        
        $this->load->view('search/search');
 
        $this->load->view('post_login/footer');
    }

    public function ricerate_add(){

        if($_SERVER['REQUEST_METHOD'] == "POST") {

            $this->form_validation->set_rules('effective_dt', 'Effective Date', 'required');
            $this->form_validation->set_rules('rice_type', 'Rice Type', 'required');
            $this->form_validation->set_rules('rate', 'Rice Rate', 'required');

            if ($this->form_validation->run() == FALSE)
            {
                $this->session->set_flashdata('msg', 'You Misssed Required Field!');

                redirect('paddys/add_new/ricerate');

            }else{

            $data_array = array(

                "kms_id"       =>  $this->session->userdata['loggedin']['kms_id'],

                "rice_type"    =>  $this->input->post("rice_type"),

                "rate"         =>  $this->input->post("rate"),

                "ppe_rate"     =>  $this->input->post("ppe_rate"),

                "effective_dt" =>  $this->input->post("effective_dt"),

                "created_by"   =>  $this->session->userdata['loggedin']['user_name'],

                "created_dt"   =>  date('Y-m-d')

            );
            $query = $this->db->get_where('md_rice_rate', array('kms_id =' => $this->session->userdata['loggedin']['kms_id'],'effective_dt =' => $this->input->post("effective_dt")));
            
            if ($query->num_rows() > 0)
            {   
                $this->session->set_flashdata('msg', 'Msp Rate Already Exist!');
                redirect('paddys/add_new/ricerate_add');
            }
            else 
               {
                $this->Paddy->f_insert('md_rice_rate', $data_array);
                }
            
            //For notification storing message
            $this->session->set_flashdata('msg', 'Successfully added!');

            redirect('paddys/add_new/ricerate');

            }
        }
        else {
            
            $this->load->view('post_login/main');

            $this->load->view("ricerate/add");
            
            $this->load->view('post_login/footer');

        }

    }
    public function ricerate_edit() {

        if($_SERVER['REQUEST_METHOD'] == "POST") {

            $data_array = array(

                
                "rice_type"     =>  $this->input->post('rice_type'),

                "rate"          =>  $this->input->post('rate'),

                "ppe_rate"      =>  $this->input->post('ppe_rate'),

                "modified_by"   =>  $this->session->userdata['loggedin']['user_name'],

                "modified_dt"   =>  date('Y-m-d')

            );

            $where  =   array(

                "id"     =>  $this->input->post('id')

            );

            $this->Paddy->f_edit('md_rice_rate', $data_array, $where);

            //For notification storing message
            $this->session->set_flashdata('msg', 'Successfully edited!');

            redirect('paddys/add_new/ricerate');

        }
        else {
           
            $ricerate['rate_dtls']    =   $this->Paddy->f_get_particulars("md_rice_rate", NULL, array( "id" => $this->input->get('id')), 1);
            
            $this->load->view('post_login/main');

            $this->load->view("ricerate/edit", $ricerate);

            $this->load->view('post_login/footer');

        }
        
    }

    // Rice rate Screen //
    public function f_soccomrate(){

        $ricerate['ricerate_dtls']    = $this->Paddy->f_get_particulars("md_soc_commision_rate", NULL,NULL, 0);           
       
        $this->load->view('post_login/main');
 
        $this->load->view("soc_commision_rate/dashboard", $ricerate);
        
        $this->load->view('search/search');
 
        $this->load->view('post_login/footer');
    }

    public function f_soccom_add(){

        if($_SERVER['REQUEST_METHOD'] == "POST") {

            $this->form_validation->set_rules('effective_dt', 'Effective Date', 'required');
            $this->form_validation->set_rules('rice_type', 'Rice Type', 'required');
            $this->form_validation->set_rules('rate', 'Rice Rate', 'required');

            if ($this->form_validation->run() == FALSE)
            {
                $this->session->set_flashdata('msg', 'You Misssed Required Field!');

                redirect('add_new/soccomrate');

            }else{

            $data_array = array(

                "kms_id"   =>  $this->session->userdata['loggedin']['kms_id'],

                "rice_type"    =>  $this->input->post("rice_type"),

                "rate"    =>  $this->input->post("rate"),

                "effective_dt"    =>  $this->input->post("effective_dt"),

                "created_by"    =>  $this->session->userdata['loggedin']['user_name'],

                "created_dt"    =>  date('Y-m-d')

            );
            $query = $this->db->get_where('md_soc_commision_rate', array('kms_id =' => $this->session->userdata['loggedin']['kms_id'],'effective_dt =' => $this->input->post("effective_dt")));
            
            if ($query->num_rows() > 0)
            {   
                $this->session->set_flashdata('msg', 'Commission Rate Already Exist!');
                redirect('add_new/soccomrate');
            }
            else 
               {
                $this->Paddy->f_insert('md_soc_commision_rate', $data_array);
                }
            
            //For notification storing message
            $this->session->set_flashdata('msg', 'Successfully added!');

            redirect('add_new/soccomrate');

            }
        }
        else {
            
            $this->load->view('post_login/main');

            $this->load->view("soc_commision_rate/add");
            
            $this->load->view('post_login/footer');

        }

    }
    public function f_soccom_edit() {

        if($_SERVER['REQUEST_METHOD'] == "POST") {

            $data_array = array(

                
                "rice_type"    =>  $this->input->post('rice_type'),

                "rate"    =>  $this->input->post('rate'),

                "modified_by"   =>  $this->session->userdata['loggedin']['user_name'],

                "modified_dt"   =>  date('Y-m-d')

            );

            $where  =   array(

                "id"     =>  $this->input->post('id')

            );

            $this->Paddy->f_edit('md_soc_commision_rate', $data_array, $where);
            //For notification storing message
            $this->session->set_flashdata('msg', 'Successfully edited!');

            redirect('add_new/soccomrate');

        }
        else {
           
            $ricerate['rate_dtls']    =   $this->Paddy->f_get_particulars("md_soc_commision_rate", NULL, array( "id" => $this->input->get('id')), 1);
            
            $this->load->view('post_login/main');

            $this->load->view("soc_commision_rate/edit", $ricerate);

            $this->load->view('post_login/footer');

        }
        
    }

     //Society Commission delete
    public function f_soccommission_delete() {

        $where = array(
            
            "id"    =>  $this->input->get('sl_no')      
        );
        
        $this->Paddy->f_delete('md_soc_commision_rate', $where);
        
        //For notification storing message
        $this->session->set_flashdata('msg', 'Successfully deleted!');

        redirect("add_new/soccomrate");

     }


    /*********************For Bill Screen********************/
    #List of Bill Master Details from table md_comm_params
    public function bill_master() {

         $where  =   array(

                "kms_id"     =>  $this->session->userdata['loggedin']['kms_id']

            );

        //Retriving Bill Master
        $billmaster['mm_dtls'] =   $this->Paddy->f_get_particulars("md_comm_params", NULL, $where, 0);

        $this->load->view('post_login/main');

        $this->load->view("billmaster/dashboard", $billmaster);

        $this->load->view('post_login/footer');

    }

    //New Bill Master Add in the table md_comm_params
    public function billmaster_add() {

        if($_SERVER['REQUEST_METHOD'] == 'POST'){

            //Max sl_no is having insert
            $max_slno     =    $this->Paddy->f_get_particulars("md_comm_params", array("IFNULL(MAX(sl_no) + 1, 1) sl_no"), NULL, 1);

            $data_array     =   array(

                "sl_no"         =>  $max_slno->sl_no,

                "param_name"    =>  $this->input->post('param_name'),

                "boiled_val"    =>  $this->input->post('boiled'),

                "raw_val"       =>  $this->input->post('raw'),

                "tds"         =>  $this->input->post('tds'),

                "cgst"         =>  $this->input->post('cgst'),

                "sgst"         =>  $this->input->post('sgst'),

                "action"        =>  $this->input->post('action'),

                "kms_id"        =>  $this->session->userdata['loggedin']['kms_id'],

                "created_by"    =>  $this->session->userdata['loggedin']['user_name'],

                "created_dt"    =>  date('Y-m-d h:i:s')

            );

            $this->Paddy->f_insert("md_comm_params", $data_array);

            //For notification storing message
            $this->session->set_flashdata('msg', 'Successfully Added!');
    
            redirect("paddys/add_new/bill_master");

        }
        else {

            $this->load->view('post_login/main');

            $this->load->view("billmaster/add");

            $this->load->view('search/search');

            $this->load->view('post_login/footer');

        }

    }

    //Edit Bill Master Add in the table md_comm_params    
    public function billmaster_edit() {

        if($_SERVER['REQUEST_METHOD'] == 'POST'){

            $data_array     =   array(

                "boiled_val"   =>  $this->input->post('boiled'),

                "raw_val"      =>  $this->input->post('raw'),

                "tds"         =>  $this->input->post('tds'),

                "cgst"         =>  $this->input->post('cgst'),

                "sgst"         =>  $this->input->post('sgst'),
                
                "action"       =>  $this->input->post('action')

            );

            $this->Paddy->f_edit("md_comm_params", $data_array, array("sl_no" => $this->input->post('sl_no')));

            $this->session->set_flashdata('msg', 'Successfully Updated!');
    
            redirect("paddys/add_new/bill_master");

        }
        else {

            //Retriving Bill Master
            $billmaster['mm_dtls'] =   $this->Paddy->f_get_particulars("md_comm_params", NULL, array("sl_no" => $this->input->get('sl_no')), 1);

            $this->load->view('post_login/main');

            $this->load->view("billmaster/edit", $billmaster);

            $this->load->view('post_login/footer');

        }

    }
	
	  /*********************For Bill Screen********************/
    #List of Bill Notice Details from table md_comm_params
    public function notice() {

       //  $where  =   array("kms_id"     =>  $this->session->userdata['loggedin']['kms_id']   );

        //Retriving Bill Master
        $notice['notice'] =   $this->Paddy->f_get_particulars("md_notice", NULL, NULL, 0);

        $this->load->view('post_login/main');

        $this->load->view("notice/dashboard", $notice);

        $this->load->view('post_login/footer');

    }

    //New Notice Add in the table md_notice
    public function notice_add() {

        if($_SERVER['REQUEST_METHOD'] == 'POST'){
			
		  
			   $config['upload_path']          = './uploads/notice/';
               $config['allowed_types']        = 'gif|pdf';
               $config['max_size']             = 10000;
               $config['max_width']            = 8000;
               $config['max_height']           = 8000;
			   $config['file_name']            = time().str_replace(' ', '_', $_FILES['userfile']['name']);
			   $data['image']                  = $config['file_name'];
			   $this->load->library('upload', $config);
			   
                if ( ! $this->upload->do_upload('userfile'))
                {
                   $error = array('error' => $this->upload->display_errors());
                }

            $data_array     =   array(

                "number"         =>  $this->input->post('number'),

                "notice_date"    =>  $this->input->post('notice_date'),

                "file"           =>  $data['image'],

                "created_by"     =>  $this->session->userdata['loggedin']['user_name'],

                "created_dt"     =>  date('Y-m-d h:i:s')

            );

            $this->Paddy->f_insert("md_notice", $data_array);

            //For notification storing message
            $this->session->set_flashdata('msg', 'Successfully Added!');
    
            redirect("paddys/add_new/notice");

        }
        else {

            $this->load->view('post_login/main');

            $this->load->view("notice/add");

            $this->load->view('search/search');

            $this->load->view('post_login/footer');

        }

    }

    //Edit Bill Master Add in the table md_comm_params    
    public function notice_edit() {

        if($_SERVER['REQUEST_METHOD'] == 'POST'){
			
			
			  if($_FILES["userfile"]["name"]!=''){
				  
			   $config['upload_path']          = './uploads/notice/';
               $config['allowed_types']        = 'gif|pdf';
               $config['max_size']             = 10000;
               $config['max_width']            = 8000;
               $config['max_height']           = 8000;
			   $config['file_name'] = time().str_replace(' ', '', $_FILES['userfile']['name']);
			   $data['image'] = $config['file_name'];
			   $this->load->library('upload', $config);
			   $this->upload->initialize($config);
                if ( ! $this->upload->do_upload('userfile'))
                {
                   $error = array('error' => $this->upload->display_errors());
                }
		    }
            else{
	        $data['image'] = $this->input->post('image');
                }

             

            $data_array     =   array(

                "number"          =>  $this->input->post('number'),

                "notice_date"     =>  $this->input->post('notice_date'),

                "file"            =>  $data['image'],

                "modified_by"     =>  $this->session->userdata['loggedin']['user_name'],

                "modified_dt"     =>  date('Y-m-d h:i:s')

            );

            $this->Paddy->f_edit("md_notice", $data_array, array("id" => $this->input->post('sl_no')));

            $this->session->set_flashdata('msg', 'Successfully Updated!');
    
            redirect("paddys/add_new/notice");

        }
        else {

            //Retriving Bill Master
            $notice['notice'] =   $this->Paddy->f_get_particulars("md_notice", NULL, array("id" => $this->input->get('slno')), 1);

            $this->load->view('post_login/main');

            $this->load->view("notice/edit", $notice);

            $this->load->view('post_login/footer');

        }

    }
	
	 //Paddy Collection Delete from table td_collections
    public function notice_delete() {

        $where = array(
		
            "id"    =>  $this->input->get('sl_no')
			
        );
		
        $this->Paddy->f_delete('md_notice', $where);

        //For notification storing message
        $this->session->set_flashdata('msg', 'Successfully deleted!');

        redirect("paddys/add_new/notice");

    }

      
}    