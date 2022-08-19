<?php
defined('BASEPATH') OR exit('No direct script access allowed');
class Transactions extends MX_Controller {

    protected $sysdate;
    protected $kms_year;

    public function __construct(){

        $this->sysdate  = $_SESSION['sys_date'];

        parent::__construct();

        $this->load->library('form_validation');
        //For Individual Functions
        $this->load->model('Paddy');
        $this->load->helper('paddyrate');

        //For User's Authentication
        if(!isset($this->session->userdata['loggedin']['user_id'])){
            
            redirect('User_Login/login');

        }

         $data       = $this->Paddy->f_get_particulars_in('md_parameters', array(16, 17), array(""));

         $this->kms_year   = substr($data[0]->param_value, 0,4).'-'.substr($data[1]->param_value, 2,2);
    }
    /*********************For Work Order Screen******************/
    
    //  ****  Start Code Fror Work Order List from the table td_work_order    **** ///
    public function f_workorder() {                                                                                                           

        $select     =   array(

            "t.trans_dt","t.pre_order_no", "t.order_no","t.soc_id","t.block","t.approval_status","t.created_by","t.approved_by",

            "t.mill_id", "t.paddy_qty", "s.soc_name","m.mill_name","t.branch_id","t.kms_year"

        );
        $where      =   array(

            "t.soc_id = s.sl_no"    => NULL,

            "t.mill_id = m.sl_no"    => NULL,

            "t.branch_id" => $this->session->userdata['loggedin']['branch_id'],

            "t.kms_year"=>$this->session->userdata['loggedin']['kms_id']

        );
     
        $workorder['work_orders'] = $this->Paddy->f_get_particulars("td_work_order t, md_society s,md_mill m",$select,$where, 0);
        
        $this->load->view('post_login/main');

        $this->load->view("workorder/dashboard",$workorder);

        $this->load->view('search/search');

        $this->load->view('post_login/footer');
        
    }

    //  ****  End Code Fror Work Order List from the table td_work_order    **** ///


    //  ****  Ajax Code To Get Society  **** ///

    public function f_get_society(){

         $block_id=$this->input->post("block_id");

         $society_lists= $this->Paddy->f_get_particulars("md_society", NULL,array("branch_id" => $this->session->userdata['loggedin']['branch_id'],"block" => $block_id), 0);
            
            $data["html"] ='<option value="">Select Society</option>';

            foreach($society_lists as $society_list){

            $data["html"] .= '<option value="'.$society_list->sl_no.'">'.$society_list->soc_name.'</option>';

                    }
                
        echo json_encode($data);
    }

    //  ****  Ajax Code To Get connected mill society  **** ///

    public function f_connected_mill_society(){

        $soc_id = $this->input->post("soc_id");

        $mill_lists= $this->Paddy->f_get_connected_mills($soc_id);

        $data['html'] = "<option value=''>Select Mill</option>";

              foreach($mill_lists as $mill_list){

                $data['html'] .= "<option value=".$mill_list->sl_no.">".$mill_list->mill_name."</option>";

                         }         

       echo json_encode($data);
    }


    //  ****  Ajax Code To Get mill target  **** //

    public function f_get_mill_target(){

        $soc_id = $this->input->post("soc_id");

        $mill_id = $this->input->post("mill_id");
        
        $target= $this->Paddy->f_get_particulars("md_soc_mill","target",array("branch_id" => $this->session->userdata['loggedin']['branch_id'],"soc_id"=>$soc_id,"mill_id" => $mill_id,"kms_id" => $this->session->userdata['loggedin']['kms_id']), 1);
        
        $data["target"]=$target->target;

        $data["order"] = $this->Paddy->f_get_order_placed($soc_id,$mill_id)->paddy_qty;
       
       echo json_encode($data);


    }

    //New Workorder Add in the table td_work_order

    public function f_workorder_add() {


           if($_SERVER['REQUEST_METHOD'] == "POST"){


                    $dist_sort_code    = $this->session->userdata['loggedin']['dist_sort_code'];
                    $kms_year_sort_code=substr($this->session->userdata['loggedin']['kms_yr'],2);
                    $kms_id=$this->session->userdata['loggedin']['kms_id'];
                    $branch_id = $this->session->userdata['loggedin']['branch_id'];


                    $order_no = $this->Paddy->get_order_no($kms_id,$branch_id);

                $data_array = array(

                    "pre_order_no" =>  'SCMF/'.$dist_sort_code.'/'.$kms_year_sort_code.'/Wo/',

                    "order_no"     =>  $order_no->order_no,

                    "block"        =>  $this->input->post('block'),

                    "branch_id"    =>  $this->session->userdata['loggedin']['branch_id'],

                    "trans_dt"     =>  $this->input->post('trans_dt'),
    
                    "kms_year"     =>  $this->session->userdata['loggedin']['kms_id'],
    
                    "soc_id"       =>  $this->input->post('soc_name'),

                    "mill_id"      =>  $this->input->post('mill_id'),
    
                    "paddy_qty"    =>  $this->input->post('paddy_qty'),
    
                    "created_by"   =>  $this->session->userdata['loggedin']['user_id'],
    
                    "created_dt"   =>  date('Y-m-d h:i:s')
    
                );
                
                $this->Paddy->f_insert('td_work_order', $data_array);
    
                //For notification storing message
                $this->session->set_flashdata('msg', 'Successfully added!');
    
                redirect('paddys/transactions/f_workorder');
    
            }
            else{

                 //Block List
           $workorder['blocks'] = $this->Paddy->f_get_particulars("md_block", NULL,array("branch_id" => $this->session->userdata['loggedin']['branch_id']), 0);

           $this->load->view('post_login/main');

           $this->load->view("workorder/add", $workorder);

           $this->load->view('post_login/footer');

          }
            
    }

    //Societies for a block selected by user 

    public function f_socmills() {

        $data   =   $this->Paddy->f_get_particulars("md_mill m, md_soc_mill s", array("m.mill_name"), array("m.sl_no = s.mill_id" => null, "s.soc_id" => $this->input->get('soc_id')), 0);

        echo json_encode($data);

    }
    // Get mill connected to mill

    public function f_soc_mills() {

        $soc_id = $this->input->post("soc_id");        

        $data= $this->Paddy->f_get_connected_mills($soc_id);

        echo json_encode($data);

    }

    //Workorder edit in the table td_work_order

    public function f_workorder_edit() {

        if($_SERVER['REQUEST_METHOD'] == "POST") {

            $data_array = array(

                "trans_dt"      =>  $this->input->post('trans_dt'),

                "modified_by"   =>  $this->session->userdata['loggedin']['user_name'],

                "modified_dt"   =>  date('Y-m-d h:i:s')

            );

            $where  =   array(

                "order_no"    =>  explode("/", $this->input->post('order_no'))[0],

                "branch_id"   =>  explode("/", $this->input->post('order_no'))[1],

                "kms_year"    =>  explode("/", $this->input->post('order_no'))[2]
                
            );
             
            $this->Paddy->f_edit('td_work_order', $data_array, $where);

            //For notification storing message
            $this->session->set_flashdata('msg', 'Successfully edited!');

            redirect('paddys/transactions/f_workorder');

        }
        else {
         
            $where  =   array(

                "branch_id"  => $this->session->userdata['loggedin']['branch_id'],

                "kms_year"   => $this->session->userdata['loggedin']['kms_id'],
     
                "order_no"   => explode("/",$_GET["order_no"])["0"],

                "branch_id"  => explode("/",$_GET["order_no"])["1"],

                "kms_year"  => explode("/",$_GET["order_no"])["2"]
            );
           
    
            $workorder['blocks'] = $this->Paddy->f_get_particulars("md_block", NULL,array("branch_id" => $this->session->userdata['loggedin']['branch_id']), 0);

            $workorder['society_dtls'] = $this->Paddy->f_get_particulars("md_society", NULL,array("branch_id" => $this->session->userdata['loggedin']['branch_id']), 0);

            $workorder['mill_dtls'] = $this->Paddy->f_get_particulars("md_mill", NULL,NULL, 0);

            $workorder['workorder_dtls']= $this->Paddy->f_get_particulars("td_work_order", NULL, $where, 1);
            
            $this->load->view('post_login/main');

            $this->load->view("workorder/edit", $workorder);

            $this->load->view('post_login/footer');

           }
        
    }


    //  *** Code For Approve Work order ***  /// 
    public function f_workorder_approved() {


        $data_array = array(

            "approval_status" => "A",

            "approved_by"   =>  $this->session->userdata['loggedin']['user_name'],

            "approved_dt"   =>  date('Y-m-d')

        );

           
            $where  =   array(
     
                "order_no"   => explode("/",$_GET["order_no"])["0"],

                "branch_id"  => explode("/",$_GET["order_no"])["1"],

                "kms_year"  => explode("/",$_GET["order_no"])["2"]
            );
          

            $this->Paddy->f_edit('td_work_order', $data_array, $where);

            //For notification storing message
            $this->session->set_flashdata('msg', 'Successfully Approved!');

            redirect('paddys/transactions/f_workorder');
        
    }

    //  *** Code For Workorder print ***  ///

    public function f_workorder_print() {

        if($_SERVER['REQUEST_METHOD'] == "POST") {

            redirect('paddys/transactions/f_workorder');

        }
        else {

            $select     =   array(

                "t.*","s.soc_name soc_name","m.mill_name mill_name","p.per_qui_rate per_qui_rate"
    
            );
            $where  =   array(

                "t.soc_id = s.sl_no"    => NULL,

                "t.mill_id = m.sl_no"    => NULL,

                "t.kms_year = p.kms_yr"    => NULL,

                "t.branch_id"  => $this->session->userdata['loggedin']['branch_id'],

                "t.kms_year"   => $this->session->userdata['loggedin']['kms_id'],
     
                "t.order_no"     =>  $_GET["order_no"]
            );

            $workorder['workorder_dtls']= $this->Paddy->f_get_particulars("td_work_order t,md_society s,md_mill m,md_paddy_rate p", $select, $where, 1);

            $this->load->view('post_login/main');

            if($this->session->userdata['loggedin']['kms_id'] == 2 ){

                $this->load->view("workorder/print_data_2019", $workorder);

            }else{
                $this->load->view("workorder/print_data", $workorder);
            }

            $this->load->view('post_login/footer');

           }
        
    }

    //  *** Code For Workorder Delete ***  ///
    
    public function f_workorder_delete() {

        $where = array(
            
            "order_no"    =>  $this->input->get('sl_no'),

            "branch_id"   =>  $this->session->userdata['loggedin']['branch_id'],

            "kms_year"    =>  $this->session->userdata['loggedin']['kms_id']

        );
        $this->Paddy->f_delete('td_work_order', $where);

        $this->session->set_flashdata('msg', 'Successfully Deleted!');

        redirect("paddys/transactions/f_workorder");
    }

    /*********************For Paddy Collection Screen********************/
    #List of Procurement of Paddy, Society wise from table td_collections    
    public function f_paddycollection() {

        $paddycollection['paddycollection_dtls']   = $this->Paddy->f_get_collection($this->session->userdata['loggedin']['branch_id'],$this->session->userdata['loggedin']['kms_id']);        
        
        $this->load->view('post_login/main');

        $this->load->view("paddycollection/dashboard", $paddycollection);
        
        $this->load->view('search/search');

        $this->load->view('post_login/footer');
        
    }

    //  *** Code For Paddy coll upload ***  ///

    public function f_paddycollupload(){

	if($_SERVER['REQUEST_METHOD'] == "POST") {
          
            $soc_id         = $this->input->post('soc_name');
            
            $mill_id        = $this->input->post('mill_id');
            
            $bank_sl_no     = $this->input->post('bank_sl_no');
           
            $trans_dt       = $this->input->post('trans_dt');

            $kms_id         = $this->session->userdata['loggedin']['kms_id'];  

            $kms_year       = $this->session->userdata['loggedin']['kms_yr'];

            $dist_sort_code = $this->session->userdata['loggedin']['dist_sort_code'];

            $district_code  = $this->session->userdata['loggedin']['branch_id'];

            $branch_cd      = $this->session->userdata['loggedin']['branch_id'];

            $trans_type     = "N";

            $bulk_trns_id = $this->Paddy->f_get_particulars("td_collections",array("MAX(bulk_trans_id) bulk_trans_id"),array('branch_id' => $this->session->userdata['loggedin']['branch_id'],'kms_id' => $kms_id), 1);
              
            $bulk_trns_id = $bulk_trns_id->bulk_trans_id+1;
         
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
            if($trans_type == "C"){
            //For Cheque Details uploadation
            if(!empty($_FILES['f_procurement_detail']['name']) && in_array($_FILES['f_procurement_detail']['type'],$csvMimes)){
					   
                $csvFile = fopen($_FILES['f_procurement_detail']['tmp_name'], 'r');

                              
                    while(($line = fgetcsv($csvFile)) !== FALSE){
                        
                    $data[] = array(

                    'dist_cd'      => $this->session->userdata['loggedin']['branch_id'],
                    'trans_id'     =>  $line[0],
                    'bulk_trans_id'=>  $bulk_trns_id,
                    'soc_id'       =>  $soc_id,
                    'mill_id'      =>  $mill_id,
                    'trans_dt'     =>  $trans_dt,
                    "bank_id"      =>  $bank_sl_no,
                    "ben_name"     =>  $line[1],
                    "qty"          =>  $line[2],
					"amt"          =>  $line[3],
					"chq_no"       =>  $line[4],
					"chq_dt"       =>  $line[5],
                    "trans_type"   =>  "C"

                     );                  
                }  
                    
                    unset($data[0]);
                    $data = array_values($data);
                    
                fclose($csvFile);

                $this->Paddy->f_insert_multiple('td_import_collection', $data);
            }
        }else{


            if(!empty($_FILES['f_procurement_detail']['name']) && in_array($_FILES['f_procurement_detail']['type'],$csvMimes)){
                       
                $csvFile  = fopen($_FILES['f_procurement_detail']['tmp_name'], 'r');

                $trans_id = $this->Paddy->f_get_particulars("td_collections",array("ifnull(MAX(trans_id),0) trans_id"),array('kms_id' => $kms_id), 1);

                $ftrans_id = $this->Paddy->f_get_particulars("td_collections",array("ifnull(MAX(trans_id),0) trans_id"),array('kms_id' => $kms_id), 1);
              
                $trans_id = $trans_id->trans_id;

                $for_trans_id = $ftrans_id->trans_id;

                    
                    while(($line = fgetcsv($csvFile)) !== FALSE){
                        
                    // $data[] = array(

                    //     "kms_id"              =>  $this->session->userdata['loggedin']['kms_id'],

                    //     "camp_no"             =>  "1",

                    //     "branch_id"           =>  $this->session->userdata['loggedin']['branch_id'],

                    //     "block_id"            =>  $this->input->post('block'),

                    //     "soc_id"              =>  $this->input->post('soc_name'),

                    //     "mill_id"             =>  $this->input->post('mill_id'),

                    //     "muster_roll_no"      =>  "1",
 
                    //     "trans_dt"            =>  $trans_dt,

                    //     "trans_id"            =>  $trans_id++,

                    //     'forward_trans_id'    =>  $branch_cd.str_pad($for_trans_id++,8,"0",STR_PAD_LEFT),

                    //     "bulk_trans_id"       => $bulk_trns_id,

                    //     'forward_bulk_trans_id' =>  $dist_sort_code.'_'.substr($kms_year,2).'_'.$bulk_trns_id,

                    //     "bank_sl_no"          => $bank_sl_no,

                    //     "trans_type"          =>  "N",

                    //     "reg_no"              =>  $line[1],

                    //     "quantity"            =>  $line[2],

                    //     "amount"              =>  $line[3],

                    //     "cheque_no"           =>  "",

                    //     "cheque_date"         =>  "",

                    //     "ifsc_code"           =>  $line[4],

                    //     "acc_no"              =>  $line[5],

                    //     "certificate_1"       =>  "Y",

                    //     "certificate_2"       =>  "Y",

                    //     "certificate_4"       =>  "Y",

                    //     "created_by"          =>  $this->session->userdata['loggedin']['user_name'],

                    //     "created_dt"          =>  date('Y-m-d h:i:s')

                    //  );

                        $data[] = array(

                        "kms_id"              =>  $this->session->userdata['loggedin']['kms_id'],

                        "camp_no"             =>  "1",

                        "branch_id"           =>  $this->session->userdata['loggedin']['branch_id'],

                        "block_id"            =>  $this->input->post('block'),

                        "soc_id"              =>  $this->input->post('soc_name'),

                        "mill_id"             =>  '',

                        "muster_roll_no"      =>  "1",
 
                        "trans_dt"            =>  $trans_dt,

                        "trans_id"            =>  $trans_id++,

                        'forward_trans_id'    =>  $district_code.str_pad($for_trans_id++,8,"0",STR_PAD_LEFT),

                        "bulk_trans_id"       => "",

                        'forward_bulk_trans_id' =>  "",

                        "bank_sl_no"          => "",

                        "trans_type"          =>  "N",

                        "reg_no"              =>  $line[1],

                        "farmer_name"         =>  $line[2],

                        "quantity"            =>  $line[3]/100,

                        "amount"              =>  $line[4],

                        "cheque_no"           =>  "",

                        "cheque_date"         =>  "",

                        "ifsc_code"           =>  $line[5],

                        "acc_no"              =>  $line[6],

                        "certificate_1"       =>  "N",

                        "certificate_2"       =>  "N",

                        "certificate_4"       =>  "N",

                        "created_dt"          =>  date('Y-m-d h:i:s')

                     );
                                    
                }  
                    
                    unset($data[0]);

                    $data = array_values($data);

                   fclose($csvFile);

                $this->Paddy->f_insert_multiple('td_collections', $data);
            }

        }

            //For notification storing message
            $this->session->set_flashdata('msg', 'Successfully added!');

            redirect('paddys/transactions/f_paddycollection');

        }
        else {

            $where      =   array(

                "branch_id" => $this->session->userdata['loggedin']['branch_id']
            );

            $wheres     =   array(

                "status" => "1"
            );

            //Block List
            $paddycollection['blocks']  =   $this->Paddy->f_get_particulars("md_block",NULL,$where, 0);
	
            $paddycollection['banks']  =   $this->Paddy->f_get_particulars("md_paddy_bank",NULL,$wheres, 0);

            $this->load->view('post_login/main');
            $this->load->view("paddycollection/add_fle", $paddycollection);
            $this->load->view('post_login/footer');

        }    

    }
    

    /// **** Code For Return Cheque List    ****   ///
   public function f_return_cheque() {
       

        $paddycollection['paddycollection_dtls']   = $this->Paddy->f_get_return_cheque($this->session->userdata['loggedin']['branch_id'],$this->session->userdata['loggedin']['kms_id']);        
        
        $this->load->view('post_login/main');

        $this->load->view("return_cheque/dashboard", $paddycollection);
        
        $this->load->view('search/search');

        $this->load->view('post_login/footer');
        
    }


    public function f_returnchequeho() {
       

        $returncheque['returncheque_dtls']  = $this->Paddy->f_getreturncheque($this->session->userdata['loggedin']['kms_id']);        
        
        $this->load->view('post_login/main');

        $this->load->view("return_cheque/dashboardho", $returncheque);
        
        $this->load->view('search/search');

        $this->load->view('post_login/footer');
        
    }

    public function f_paddycollection_checker(){

        $paddycollection['paddycollection_dtls'] = $this->Paddy->f_get_collection_checker($this->session->userdata['loggedin']['branch_id'],$this->session->userdata['loggedin']['kms_id']);  

        
        $this->load->view('post_login/main');

        $this->load->view("paddycollection/dashboard_checker", $paddycollection);
        
        $this->load->view('search/search');

        $this->load->view('post_login/footer');

    }

    public function f_paddycoll_chec_forwarded(){

    $paddycoll['paddycollection_dtls'] = $this->Paddy->f_forwarded_coll_checker($this->session->userdata['loggedin']['branch_id'],$this->session->userdata['loggedin']['kms_id']);  

        
        $this->load->view('post_login/main');

        $this->load->view("paddycollection/dashboard_checker_fwd", $paddycoll);
        
        $this->load->view('search/search');

        $this->load->view('post_login/footer');

    }

    public function f_paddycollection_dwn(){

        if($_SERVER['REQUEST_METHOD']=='POST'){

            $branch_id  = $this->session->userdata['loggedin']['branch_id'];

            $kms_id     = $this->session->userdata['loggedin']['kms_id'];

            $bnk_id  = $this->input->post('bnk'); 

            $trans_type  = $this->input->post('trans_type');   

            if($this->session->userdata['loggedin']['ho_flag'] == "Y" ) {  

            $paddycoll['paddycollection_dtls'] = $this->Paddy->f_get_collection_dwn($kms_id,$bnk_id,$trans_type);
            }else{

            $paddycoll['paddycollection_dtls'] = $this->Paddy->f_get_coll_branch_dwn($kms_id,$bnk_id,$branch_id);
            }
         
            $this->load->view('post_login/main');
            $this->load->view("paddycollection/dashboard_ho",$paddycoll);
            $this->load->view('post_login/footer');

        }else{

            $paddycollection['branches']    =   $this->Paddy->f_get_particulars("md_branch", NULL, NULL, 0);
            $this->load->view('post_login/main');
            $this->load->view("paddycollection/dashboard_ho", $paddycollection);
            $this->load->view('search/search');
            $this->load->view('post_login/footer');

        }

    }

    ///  *****  Get NEFT STATUS     **********  ///

    public function f_neft_status(){

          if($_SERVER['REQUEST_METHOD']=='POST'){

            $branch_id  = $this->session->userdata['loggedin']['branch_id'];

            $kms_id     = $this->session->userdata['loggedin']['kms_id'];

            $br_id  = $this->input->post('branch'); 

            $bnk_id  = $this->input->post('bnk');

            $trans_type  = $this->input->post('trans_type');   

            $neft['paddy_dtls']  = $this->Paddy->getneft($br_id,$this->session->userdata['loggedin']['kms_id']);

            $this->load->view('post_login/main');
            $this->load->view("paddycollection/dashboard_neft",$neft);
            $this->load->view('post_login/footer');

        }else{

            $neft['branches']   =  $this->Paddy->f_get_particulars("md_branch", NULL, NULL, 0);
            $this->load->view('post_login/main');
            $this->load->view("paddycollection/dashboard_neft", $neft);
            $this->load->view('search/search');
            $this->load->view('post_login/footer');

        }



    }

    public function f_paddycollreissue_dwn(){

        if($_SERVER['REQUEST_METHOD']=='POST'){

            $branch_id  = $this->session->userdata['loggedin']['branch_id'];

            $kms_id     = $this->session->userdata['loggedin']['kms_id'];

            $bnk_id  = $this->input->post('bnk'); 

            $trans_type  = $this->input->post('trans_type');   

            $paddycoll['paddycollection_dtls'] = $this->Paddy->f_get_collreissue_dwn($kms_id,$bnk_id,$trans_type);

            $this->load->view('post_login/main');
            $this->load->view("paddycollection/dashbreissue_ho",$paddycoll);
            $this->load->view('post_login/footer');

        }else{

            $paddycollection['branches']    =   $this->Paddy->f_get_particulars("md_branch", NULL, NULL, 0);
            $this->load->view('post_login/main');
            $this->load->view("paddycollection/dashbreissue_ho", $paddycollection);
            $this->load->view('search/search');
            $this->load->view('post_login/footer');

        }

    }

    public function f_singlecheque_dwn(){


        if($_SERVER['REQUEST_METHOD']=='POST'){

            $kms_id     = $this->session->userdata['loggedin']['kms_id'];

            $cheque_no  = $this->input->post('cheque_no');   

            $chequedetails['cheque_dtls']  =  $this->Paddy->f_get_cheque($cheque_no,$kms_id);

         
            $this->load->view('post_login/main');

            $this->load->view("reports/cheque_detail/singlechequedetail.php",$chequedetails);

            $this->load->view('post_login/footer');


        }else{
          
            $this->load->view('post_login/main');

            $this->load->view("reports/cheque_detail/singlechequedetail.php");

            $this->load->view('post_login/footer');
        }

    }

    //For Farmer Details Modal

    public function f_getFarmerDetails(){

        $data['farmer_dtls'] =   $this->Paddy->f_get_particulars('td_collections', NULL, array('soc_id' => $this->input->get('soc_id')), 0);
        
        if(empty($data['farmer_dtls'])){
            $data['farmer_dtls'] =   $this->Paddy->f_get_particulars('td_collections', NULL, array('soc_id' => $this->input->get('soc_id')), 0);
            $this->load->view('paddycollection/farmer_dtls', $data);
        }
        else{
            $this->load->view('paddycollection/farmer_dtls', $data);
        }

    }
    public function f_getFarmerDetails1(){
         $data=explode (",", $this->input->get('soc_id'));
         $soc_id = $data["0"];
         $bulk_trans_id = $data["1"];
         $trans_dt = $data["2"];
       

        $data['farmer_dtls'] =   $this->Paddy->f_get_particulars('td_collections', NULL, array('soc_id' => $soc_id,'bulk_trans_id' => $bulk_trans_id,'trans_dt'=>$trans_dt), 0);
        
        if(empty($data['farmer_dtls'])){
            $data['farmer_dtls'] =   $this->Paddy->f_get_particulars('td_collections', NULL, array('soc_id' => $this->input->get('soc_id'),'bulk_trans_id' => $bulk_trans_id,'trans_dt'=>$trans_dt), 0);
            $this->load->view('paddycollection/farmer_dtls', $data);
        }
        else{
            $this->load->view('paddycollection/farmer_dtls', $data);
        }

    }

    public function f_get_society_name(){

        $soc_id = explode(",",$this->input->post("soc_id"))["0"];
        
        $society_name= $this->Paddy->f_get_particulars("md_society",NULL,array("sl_no" =>$soc_id), 1);
        
        $data["society_name"]=$society_name->soc_name;

       echo json_encode($data);
   }

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
        // Get Full Target Of Society
    public function f_get_full_society_target(){

        $soc_id = $this->input->post("soc_id");
        
        $target= $this->Paddy->f_get_particulars("md_soc_mill","SUM(target) as total",array("branch_id" => $this->session->userdata['loggedin']['branch_id'],"soc_id"=>$soc_id,"kms_id" => $this->session->userdata['loggedin']['kms_id']), 1);
        
        $data["target"]=$target->total;
       
        echo json_encode($data);

    }
     //New Paddy Collection Add in table td_collections
    public function f_paddycollection_add() {

        if($_SERVER['REQUEST_METHOD'] == "POST") {
         
           if(null !== $this->input->post('certificate_1')){
               $certificate_1=$this->input->post('certificate_1');
           }else{
            $certificate_1="N";
           }
           if(null !== $this->input->post('certificate_2')){
            $certificate_2=$this->input->post('certificate_2');
        }else{
         $certificate_2="N";
        }
        if(null !== $this->input->post('certificate_4')){
            $certificate_4=$this->input->post('certificate_4');
        }else{
         $certificate_4="N";
        }
          
            $soc_id      = $this->input->post('soc_name');
            $reg_no      = $this->input->post('reg_no');
            $bank_sl_no  = $this->input->post('bank_sl_no');
            $quantity    = $this->input->post('quantity');
            $count       = count($this->input->post('quantity'));
            $trans_dt    = $this->input->post('trans_dt');
            $cheque_no   = $this->input->post('cheque_no');
            $cheque_date = $this->input->post('cheque_date');

            $kms_id   = $this->session->userdata['loggedin']['kms_id'];
           

            $max_camp_no = $this->Paddy->f_get_particulars("td_collections",array("MAX(camp_no) camp_no"),array('branch_id' => $this->session->userdata['loggedin']['branch_id'],'trans_dt' => $trans_dt,'kms_id' => $kms_id), 1);
            
            if($max_camp_no->camp_no=="")
             {
                $camp_no  = 1;
             }elseif($max_camp_no->camp_no!=""){

                $max_camp_no = $this->Paddy->f_get_particulars("td_collections",array("MAX(camp_no) camp_no"),array('branch_id' => $this->session->userdata['loggedin']['branch_id'],'trans_dt' => $trans_dt,'kms_id' => $kms_id), 1);
                $camp_no = ($max_camp_no)? ($max_camp_no->camp_no) :($max_camp_no->camp_no+1);
             }

            $bulk_trns_id = $this->Paddy->f_get_particulars("td_collections",array("MAX(bulk_trans_id) bulk_trans_id"),array('branch_id' => $this->session->userdata['loggedin']['branch_id'],'trans_dt' => $trans_dt,'kms_id' => $kms_id), 1);
              
            $bulk_trns_id = ($bulk_trns_id)? ($bulk_trns_id->bulk_trans_id+1) : 1;
         
           for($i=0; $i<$count; $i++){

            $max_trans_no = $this->Paddy->f_get_particulars("td_collections", array("MAX(trans_id) trans_id"),array('trans_dt' => $trans_dt), 1);
        
            $trans_id      = ($max_trans_no)? ($max_trans_no->trans_id + 1) : 1; 

             $data = array(

                "kms_id"     =>  $this->session->userdata['loggedin']['kms_id'],

                "camp_no"    =>  $camp_no,

                "branch_id"  =>  $this->session->userdata['loggedin']['branch_id'],

                "block_id"   =>  $this->input->post('block'),

                "soc_id"     =>  $this->input->post('soc_name'),

                "mill_id"     =>  $this->input->post('mill_id'),

                "muster_roll_no" =>  $this->input->post('muster_roll_no'),

                "trans_dt"     =>  $trans_dt,

                "trans_id"    =>  $trans_id,

                "bulk_trans_id" => $bulk_trns_id,

                "bank_sl_no" => $bank_sl_no,

                "reg_no"     =>  $reg_no[$i],

                "quantity"   =>  $quantity[$i],

                "amount"    =>  round(((is_numeric($quantity[$i]))? ($quantity[$i]) : NULL) 
                                 *(get_paddy_price($this->session->userdata['loggedin']['kms_id']))),

                "cheque_no"    =>  $cheque_no[$i],

                "cheque_date"  =>  $cheque_date[$i],

                "certificate_1" =>$certificate_1,

                "certificate_2" =>$certificate_2,

                "certificate_4" =>$certificate_4,

                "created_by" =>  $this->session->userdata['loggedin']['user_name'],

                "created_dt" =>  date('Y-m-d h:i:s')

            );

        $paddy_procured = $this->Paddy->f_get_farmer_paddy_procured($reg_no[$i],$this->session->userdata['loggedin']['kms_id']);
            
            
              $tot=$paddy_procured+((is_numeric($quantity[$i]))? ($quantity[$i]) : NULL);
          
                 //   if($tot > 0 && $tot <= 45 && $record == 0 ) {
                        
                          if($tot > 0 && $tot <= 45) {

                       $this->Paddy->f_insert('td_collections', $data);
                        
                    }
             $tot=0;      
            }    
            //For notification storing message
            $this->session->set_flashdata('msg', 'Successfully added!');

            redirect('paddys/transactions/f_paddycollection');

        }
        else {

            $where      =   array(

                "branch_id" => $this->session->userdata['loggedin']['branch_id']
            );
       
            //Block List
            $paddycollection['blocks']  =   $this->Paddy->f_get_particulars("md_block",NULL,$where, 0);
            $paddycollection['banks']  =   $this->Paddy->f_get_particulars("md_paddy_bank",NULL,NULL, 0);

            $this->load->view('post_login/main');
            $this->load->view("paddycollection/add", $paddycollection);
            $this->load->view('post_login/footer');

        }
        
    }
    public function get_cheque_details(){

         $cheque_no  = $_GET['cheque_no'];
        // $bank_sl_no = $_GET['bank_sl_no'];
         $kms_id   = $this->session->userdata['loggedin']['kms_id'];
         $row['number'] = $this->db->get_where('td_collections', array('cheque_no =' => $cheque_no,'kms_id =' =>$kms_id))->num_rows();
       
        echo json_encode($row);
    }


    /// Code Developed After Integration of Food Api on 14/12/2020   ///
    public function f_cheque_add() {

        if($_SERVER['REQUEST_METHOD'] == "POST") {
              
            $editdata = explode ("/",$this->input->post('editdata'));
            $soc_id = $editdata["0"];
            $trans_dt = $editdata["1"];
            $bulk_trans_id = $editdata["2"];
            $chq_status    = $editdata["3"];


            $reg_no           = $this->input->post('reg_no'); 
            $forward_trans_id = $this->input->post('forward_trans_id'); 
            $edittran_dt      = $this->input->post('trans_dt');
            $quantity         = $this->input->post('quantity');
            $count            = count($this->input->post('quantity'));
            $amount           = $this->input->post('amount');
            $cheque_no        = $this->input->post('cheque_no');
            $cheque_date      = $this->input->post('cheque_date');
            $ifsc_code        = $this->input->post('ifsc_code');
            $acc_no           = $this->input->post('acc_no');
            $kms_year         = $this->session->userdata['loggedin']['kms_yr'];
            $kms_id           = $this->session->userdata['loggedin']['kms_id'];
            $dist_sort_code   = $this->session->userdata['loggedin']['dist_sort_code'];

            if($this->input->post('bulk_trans_id') == 0 ){

            $bulk_trns_id = $this->Paddy->f_get_particulars("td_collections",array("MAX(bulk_trans_id) bulk_trans_id"),array('branch_id' => $this->session->userdata['loggedin']['branch_id'],'kms_id' => $kms_id), 1);
              
            $bulk_trns_id = $bulk_trns_id->bulk_trans_id+1;

            }else{

            $bulk_trns_id = $this->input->post('bulk_trans_id');

            }

            // if( $this->input->post('bank_sl_no') == '5'){

            // $hdfc_sl_no = $this->Paddy->f_get_particulars("td_collections",array("ifnull(MAX(hdfc_sl_no),0) hdfc_sl_no"),array('trans_dt' => $trans_dt), 1);

            // $hdfc_sl_no = $hdfc_sl_no->hdfc_sl_no+1;

        
            // }

            // if($hdfc_sl_no > 0){

            //     $hdfc_sl = $hdfc_sl_no;

            // }else{

            //     $hdfc_sl = NULL;
                   
            // }
         
           $i=0;
              
          // foreach($cheque_no as $cheque){
           for($i=0; $i<$count; $i++){
            
                $data_array = array(

                "certificate_1"          => $this->input->post('certificate_1'),
                "certificate_2"          => $this->input->post('certificate_2'),
                "certificate_4"          => $this->input->post('certificate_4'),
                "bank_sl_no"             => $this->input->post('bank_sl_no'),
                "ifsc_code"              => $ifsc_code[$i],
                "acc_no"                 => $acc_no[$i],
                "bulk_trans_id"          => $bulk_trns_id,
                "forward_bulk_trans_id"  => $dist_sort_code.'_'.substr($kms_year,2).'_'.$bulk_trns_id
           
                );

             
                $where = array(

                    "reg_no"           => $reg_no[$i],

                    "forward_trans_id" => $forward_trans_id[$i],

                    "soc_id"           => $soc_id,

                    "trans_dt"         => $trans_dt

                );

                $this->Paddy->f_edit('td_collections', $data_array, $where);
                 
            }   
           
            //For notification storing message
            $this->session->set_flashdata('msg', 'Successfully added!');

            redirect('paddys/transactions/f_paddycollection');
        }
        else {

            $data=explode ("/", $this->input->get('soc_id'));
            $soc_id = $data["0"];
            $trans_dt = $data["1"];
            $bulk_trans_id = $data["2"];
            $chq_status = $data["3"];


            $select     =   array(

                  "t.*", "s.soc_name soc_name", "b.block_name block_name"
            );

            $where      =   array(

                "t.soc_id = s.sl_no"    => NULL,

                "t.block_id = b.blockcode"    => NULL,
                
               // "t.bank_sl_no = c.bank_id"    => NULL,

                "t.soc_id"        =>$soc_id,

                "t.bulk_trans_id" =>$bulk_trans_id,

                "t.trans_dt"      =>$trans_dt,

                "t.chq_status" =>$chq_status
 
            );
         
   
           $paddycollection['farmer_dtls'] =   $this->Paddy->f_get_particulars('td_collections t,md_society s,md_block b',$select,$where, 0);
       
           $wheres      =   array(
            "branch_id" => $this->session->userdata['loggedin']['branch_id']
             );

            $whereb     =   array(

                "status" => "1"
            );
    
            $paddycollection['banks']  =   $this->Paddy->f_get_particulars("md_paddy_bank",NULL,$whereb, 0);

            $paddycollection['mills'] = $this->Paddy->f_get_particulars("md_mill", NULL,array("branch_id" => $this->session->userdata['loggedin']['branch_id']), 0);

            //Block List
            $paddycollection['blocks']  =   $this->Paddy->f_get_particulars("md_block",NULL,$wheres, 0);

            $this->load->view('post_login/main');

            $this->load->view("paddycollection/add_cheque_data", $paddycollection);

            $this->load->view('post_login/footer');

        }
        
    }

    //********** Start Code For Farmer Payment Detail    21/12/2020    ///

     public function f_farmer_payment(){

     

                $forward_trans_id  = $this->input->post("forward_trans_id");

                $kms_id            = $this->session->userdata['loggedin']['kms_id'];
 
         
        
        $datas= $this->Paddy->get_payment_detail($kms_id,$forward_trans_id);
       
       echo json_encode($datas);

    } 

    //********** End Code For Farmer Payment Detail    21/12/2020    ///

    public function f_cheque_add_bkup() {

        if($_SERVER['REQUEST_METHOD'] == "POST") {
              
            $editdata = explode ("/",$this->input->post('editdata'));
            $soc_id = $editdata["0"];
            $trans_dt = $editdata["1"];
            $bulk_trans_id = $editdata["2"];
            $chq_status    = $editdata["3"];

            $trans_type = $this->Paddy->get_transaction_type($soc_id,$trans_dt,$bulk_trans_id,$chq_status);

            $reg_no      = $this->input->post('reg_no');     
            $edittran_dt = $this->input->post('trans_dt');
            $quantity    = $this->input->post('quantity');
            $count       = count($this->input->post('quantity'));
            $amount      = $this->input->post('amount');
            $cheque_no   = $this->input->post('cheque_no');
            $cheque_date = $this->input->post('cheque_date');
            $ifsc_code   = $this->input->post('ifsc_code');
            $acc_no      = $this->input->post('acc_no');
            
            $i=0;
              
          // foreach($cheque_no as $cheque){
           for($i=0; $i<$count; $i++){

            if($trans_type == "C"){

                $data_array = array(

                "quantity"      => $quantity[$i],
                "amount"        => $amount[$i],
                "cheque_no"     =>  $cheque_no[$i],
                "cheque_date"   =>  $cheque_date[$i],
                "trans_dt"      =>  $edittran_dt,

                 );

            }else{

                $data_array = array(

                "quantity"      => $quantity[$i],
                "amount"        => $amount[$i],
                "ifsc_code"     =>  $ifsc_code[$i],
                "acc_no"        =>  $acc_no[$i],
                "trans_dt"      =>  $edittran_dt

                 );

            }

             
            $where = array(

                "reg_no" => $reg_no[$i],

                "soc_id" => $soc_id,

                "trans_dt" => $trans_dt,

                "bulk_trans_id" =>$bulk_trans_id

            );

                    $this->Paddy->f_edit('td_collections', $data_array, $where);
                  //  $i++;
            }   
           
            //For notification storing message
            $this->session->set_flashdata('msg', 'Successfully added!');

            redirect('paddys/transactions/f_paddycollection');
        }
        else {

            $data          = explode ("/", $this->input->get('soc_id'));
            $soc_id        = $data["0"];
            $trans_dt      = $data["1"];
            $bulk_trans_id = $data["2"];
            $chq_status    = $data["3"];


            $select     =   array(

                  "t.*", "s.soc_name soc_name", "b.block_name block_name","c.bank_name bank_name"
            );

            $where      =   array(

                "t.soc_id = s.sl_no"    => NULL,

                "t.block_id = b.blockcode"    => NULL,
                
                "t.bank_sl_no = c.bank_id"    => NULL,

                "t.soc_id"        =>$soc_id,

                "t.bulk_trans_id" =>$bulk_trans_id,

                "t.trans_dt"      =>$trans_dt,

                "t.chq_status" =>$chq_status
 
            );
         
   
           $paddycollection['farmer_dtls'] =   $this->Paddy->f_get_particulars('td_collections t,md_society s,md_block b,md_paddy_bank c',$select,$where, 0);
       
           $wheres      =   array(
            "branch_id" => $this->session->userdata['loggedin']['branch_id']
             );

            //Block List
            $paddycollection['blocks']  =   $this->Paddy->f_get_particulars("md_block",NULL,$wheres, 0);

            $this->load->view('post_login/main');

            $this->load->view("paddycollection/add_cheque_data", $paddycollection);

            $this->load->view('post_login/footer');

        }
        
    }


    public function f_return_cheque_edit() {

        if($_SERVER['REQUEST_METHOD'] == "POST") {

              
            $editdata = explode ("/",$this->input->post('editdata'));
            $soc_id = $editdata["0"];
            $trans_dt = $editdata["1"];
            $bulk_trans_id = $editdata["2"];

            $reg_no=$this->input->post('reg_no');

            $cheque_no=$this->input->post('cheque_no');
            $cheque_date=$this->input->post('cheque_date');
            $i=0;
              
           foreach($cheque_no as $cheque){

             $data_array = array(

                "cheque_no"     =>  $cheque_no[$i],

                "cheque_date"   =>  $cheque_date[$i],
                
                "chq_status"   =>  'U'

             );
           
            $where = array(

                "reg_no" => $reg_no[$i],

                "soc_id" => $soc_id,

                "trans_dt" => $trans_dt,

                "bulk_trans_id" =>$bulk_trans_id

            );
                   if(!empty($cheque_no[$i])) {
                    $this->Paddy->f_edit('td_collections', $data_array, $where);
                   }

                    $i++;
            }   
        
           
            //For notification storing message
            $this->session->set_flashdata('msg', 'Successfully added!');

            redirect('paddys/transactions/f_return_cheque');
        }
        else {

            $data=explode ("/", $this->input->get('soc_id'));
            $soc_id = $data["0"];
            $trans_dt = $data["1"];
            $bulk_trans_id = $data["2"];

            $select     =   array(

                "t.*", "s.soc_name soc_name", "b.block_name block_name",
            );

            $where      =   array(

                "t.soc_id = s.sl_no"    => NULL,

                "t.block_id = b.blockcode"    => NULL,

                "t.soc_id"        =>$soc_id,

                "t.bulk_trans_id" =>$bulk_trans_id,

                "t.trans_dt"      =>$trans_dt,
                
                "t.chq_status"    =>'R'

            );
         
   
           $paddycollection['farmer_dtls'] =   $this->Paddy->f_get_particulars('td_collections t,md_society s,md_block b',$select,$where, 0);
       
           $wheres      =   array(
            "branch_id" => $this->session->userdata['loggedin']['branch_id']
             );

            //Block List
            $paddycollection['blocks']  =   $this->Paddy->f_get_particulars("md_block",NULL,$wheres, 0);

            $this->load->view('post_login/main');

            $this->load->view("return_cheque/add_cheque_data", $paddycollection);

            $this->load->view('post_login/footer');

        }
        
    }
    public function f_paddyproc_delete(){

            $data=explode ("/", $this->input->get('soc_id'));
            $soc_id = $data["0"];
            $trans_dt = $data["1"];
            $bulk_trans_id = $data["2"];

            $where      =   array(

                "soc_id"        => $soc_id,

                "trans_dt"      => $trans_dt,

                "bulk_trans_id" => $bulk_trans_id

            );


            $data = $this->Paddy->f_delete("td_collections", $where);

            redirect('paddys/transactions/f_paddycollection');

    }

    //  ***** Procurement Data  Delete      ******  //////////////

    public function f_pad_sig_delete(){

        $data = explode("/", $this->input->get('soc_id'));
        echo $this->input->get('soc_id');
        $soc_id = $data["0"];
        $trans_dt = $data["1"];
        $bulk_trans_id = $data["2"];
        $trans_id = $data["3"];
        $status = $data["4"];

        $where      =   array(

            "soc_id"        => $soc_id,

            "trans_dt"      => $trans_dt,

            "bulk_trans_id" => $bulk_trans_id,

            "trans_id"      => $trans_id

        );

       $data = $this->Paddy->f_delete("td_collections", $where);

       redirect('paddys/transactions/f_cheque_add?soc_id='.$soc_id.'/'.$trans_dt.'/'.$bulk_trans_id.'/'.$status);

    }

   //  Developed on 16/12/2020 after Food Api integration to delete Single Value // 

     public function f_proc_sig_delete(){

        $data     = explode("/", $this->input->get('soc_id'));
        $soc_id   = $data["0"];
        $trans_dt = $data["1"];
        $trans_id = $data["2"];
        $bulk_trans_id = $data["3"];
        $status   = $data["4"];

       
        $where      =   array(

            "soc_id"        => $soc_id,

            "trans_dt"      => $trans_dt,

            "trans_id"      => $trans_id

        );

       $data = $this->Paddy->f_delete("td_collections", $where);

       redirect('paddys/transactions/f_cheque_add?soc_id='.$soc_id.'/'.$trans_dt.'/'.$bulk_trans_id.'/'.$status);

    }

    public function f_checker_update() {

        if($_SERVER['REQUEST_METHOD'] == "POST") {

            if(null !== $this->input->post('certificate_3')){
                $certificate_3=$this->input->post('certificate_3');
            }else{
             $certificate_3="N";
            }

            if(null !== $this->input->post('certificate_5')){
                $certificate_5=$this->input->post('certificate_5');
            }else{
             $certificate_5="N";
            }
              
            $editdata = explode ("/",$this->input->post('editdata'));
            $soc_id = $editdata["0"];
            $trans_dt = $editdata["1"];
          

            $reg_no=$this->input->post('reg_no');
            $cheque_no=$this->input->post('cheque_no');
            $cheque_date=$this->input->post('cheque_date');
           $i=0;
              
           foreach($cheque_no as $cheque){

             $data_array = array(

                "cheque_no"     =>  $cheque_no[$i],

                "cheque_date"   =>  $cheque_date[$i],

             );
           
            $where = array(

                "reg_no"      => $reg_no[$i],

                "soc_id"      => $soc_id,

                "trans_dt"    => $trans_dt,

                "ho_status!=" => 1

            );

                    $this->Paddy->f_edit('td_collections', $data_array, $where);
                    $i++;
            }  
              
          
            $this->Paddy->f_checker_update($certificate_3,$certificate_5,$trans_dt,$soc_id);
           
            //For notification storing message
            $this->session->set_flashdata('msg', 'Successfully added!');

            redirect('paddys/transactions/f_paddycollection_checker');
        }
        else {

            $data = explode ("/", $this->input->get('soc_id'));
            $soc_id = $data["0"];
            $trans_dt = $data["1"];
           // $status = $data["2"];

            $select     =   array(

                "t.*", "s.soc_name soc_name", "b.block_name block_name",
            );

            $where      =   array(

                "t.soc_id = s.sl_no"    => NULL,

                "t.block_id = b.blockcode"    => NULL,

                "t.soc_id"        =>$soc_id,

                "t.ho_status!=" =>   1,

                "t.trans_dt"      =>$trans_dt,

             

            );
         
   
           $paddycollection['farmer_dtls'] =   $this->Paddy->f_get_particulars('td_collections t,md_society s,md_block b',$select,$where, 0);

           $wheres      =   array(
            "branch_id" => $this->session->userdata['loggedin']['branch_id']
             );

            //Block List
            $paddycollection['blocks']  =   $this->Paddy->f_get_particulars("md_block",NULL,$wheres, 0);

            $this->load->view('post_login/main');

            $this->load->view("paddycollection/update_checker", $paddycollection);

            $this->load->view('post_login/footer');

        }
        
    }

    public function f_paddycollection_print() {

            $data=explode ("/", $this->input->get('soc_id'));
            $soc_id = $data["0"];
            $trans_dt = $data["1"];
            

            $select     =   array(

                "t.*", "s.soc_name soc_name", "b.block_name block_name",
            );

            $where      =   array(

                "t.soc_id = s.sl_no"    => NULL,

                "t.block_id = b.blockcode"    => NULL,

                "t.soc_id"        =>$soc_id,

                "t.trans_dt"      =>$trans_dt,

            );
         
           $paddycollection['farmer_dtls'] =   $this->Paddy->f_get_particulars('td_collections t,md_society s,md_block b',$select,$where, 0);
        
           $wheres      =   array(
            "branch_id" => $this->session->userdata['loggedin']['branch_id']
             );

            //Block List
            $paddycollection['blocks']  =   $this->Paddy->f_get_particulars("md_block",NULL,$wheres, 0);

            $this->load->view('post_login/main');

            $this->load->view("paddycollection/print_data", $paddycollection);

            $this->load->view('post_login/footer');
    
    }

    public function f_masterroll_print() {

        $data=explode ("/", $this->input->get('soc_id'));
        $soc_id = $data["0"];
        $trans_dt = $data["1"];
        $bulk_trans_id = $data["2"];

        $select     =   array(

            "t.*", "s.soc_name soc_name", "b.block_name block_name",
            "f.address address","f.pin_no pin_no","f.epic_no epic_no"
        );

        $where      =   array(

            "t.soc_id = s.sl_no"    => NULL,

            "t.block_id = b.blockcode"    => NULL,

            "t.reg_no = f.reg_no"    => NULL,

            "t.soc_id"        =>$soc_id,

            "t.bulk_trans_id" =>$bulk_trans_id,

            "t.trans_dt"      =>$trans_dt,

        );
     
       $paddycollection['farmer_dtls'] =   $this->Paddy->f_get_particulars('td_collections t,md_society s,md_block b,td_farmer_reg f',$select,$where, 0);
     

        $this->load->view('post_login/main');

        $this->load->view("paddycollection/print_master_roll", $paddycollection);

        $this->load->view('post_login/footer');
    }
    
    
    public function f_paddyreissuec_forward() {

        $data=explode ("/", $this->input->get('soc_id'));
        $soc_id = $data["0"];
        $trans_dt = $data["1"];
        $bulk_trans_id = $data["2"];
        $valid=0;
        $data  = $this->Paddy->f_ifsccode($trans_dt,$bulk_trans_id,$soc_id);

        $datas = $this->Paddy->f_transcheck($trans_dt,$bulk_trans_id,$soc_id);
        foreach( $data as $value ) {
                  
                 if(strlen($value->ifsc_code)=="11"){
                    $valid = $valid+0;
                 }else{
                    $valid = $valid+1;
                 }
        }

        if($datas == '0'){


           if($valid=='0' ){
            $this->Paddy->f_forward_reissue_paddycollection($trans_dt,$bulk_trans_id,$soc_id);
            echo "<script>
                alert('Procurement data forwarded successfully');
                window.location.href='f_reissuchq';
                </script>";

           }else{

            echo "<script>
                alert('Procurement data Not forwarded Some Problem In IFSC CODE');
                window.location.href='f_reissuchq';
                </script>";
             }

        }else{
               echo "<script>
                alert('Procurement data Not forwarded Some Problem In File Uploading');
                window.location.href='f_reissuchq';
                </script>";
        }

   
    }
    public function f_paddycol_ho_forward() {

        $data=explode ("/", $this->input->get('soc_id'));
        $soc_id = $data["0"];
        $trans_dt = $data["1"];
       
        $this->Paddy->f_forwardho_paddycollection($trans_dt,$soc_id);
    
                echo "<script>
                    alert('Procurement data forwarded Head office successfully');
                    window.location.href='f_paddycollection_checker';
                    </script>";
       
    }


    ///  ******* Code For getting Detail    ******   ///////

    public function get_farmer_details(){
        
        $soc_id = $this->input->get("soc_id");
        $branch_id = $this->session->userdata['loggedin']['branch_id'];
        $kms_id  = $this->session->userdata['loggedin']['kms_id'];

        $status = $this->Paddy->get_approve_status($soc_id,$kms_id)->count_status;
        $workorder = $this->Paddy->check_workorder($soc_id,$kms_id)->counts;

        if($workorder!=0){
       
                    if($status == 0){
                                            
                                            
                    $query=$this->db->query("select farm_name,reg_no,sum(qnt)qnt,round(sum(upqnt)/100,2)upqnt
                                                from (
                                                select a.farm_name farm_name, 
                                                 	   a.reg_no reg_no,
                                                       ifnull(sum(b.quantity), 0) qnt,
                                                       0 upqnt
                                                from   td_farmer_reg as a 
                                                left join td_collections as b 
                                                on     a.reg_no = b.reg_no 
                                                where a.soc_id = '".$soc_id."' 
                                                and a.kms_id = '".$kms_id."'
                                                group by a.farm_name, a.reg_no
                                                UNION
                                                select a.farm_name farm_name,
                                                	   a.reg_no reg_no,
                                                       0 qnt,
                                                       ifnull(sum(b.quantity), 0) upqnt
                                                from   td_farmer_reg as a 
                                                left join td_paddy_transaction as b 
                                                on     a.reg_no = b.reg_no 
                                                where a.soc_id = '".$soc_id."' 
                                                and a.kms_id = '".$kms_id."'
                                                group by a.farm_name, a.reg_no)x
                                                group by farm_name,reg_no");
                   
                   $data   =  $query->result_array();
     
                   echo json_encode($data);
                    }else{
                        $data["error"] ="ERROR";
                        echo json_encode($data);
                    }
                }else{
                    $data["error"] ="ERROR";
                    echo json_encode($data);

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


    ///  ****  Code For Getting Paddy Procurement Excell Sheet   ****   ////

    public function f_paddy_procurement_Excel(){

       $soc_id = $this->uri->segment(4);
       $trans_dt = $this->uri->segment(5);
       $bulk_trans_id = $this->uri->segment(6);
       $chq_status = $this->uri->segment(7);
       $this->load->library('excel');
       $object = new PHPExcel();
       $object->setActiveSheetIndex(0);

      $trans_type = $this->Paddy->get_transaction_type($soc_id,$trans_dt,$bulk_trans_id,$chq_status);

      if($trans_type == "C"){
            
            
            $employee_data =  $this->Paddy->f_farmer_detail_cheque($soc_id,$trans_dt,$bulk_trans_id);

            $bank_data     =  $this->Paddy->f_farmer_bank_detail($soc_id,$trans_dt,$bulk_trans_id);

            $debit_bank_data = $this->Paddy->f_debit_bank_detail($bank_data->branch_id,$bank_data->bank_id);
            
            $update        =  $this->Paddy->f_farmer_dwn_flag($soc_id,$trans_dt,$bulk_trans_id);


         if($bank_data->bank_id == "1"){ 
            
               $table_columns = array("Issuance Date", "Account Number","Short Account Number",
                                  "Cheque Number","Payee Name","Amount",
                                  "MICR Code","Transaction Code");
                $column = 0;

                foreach($table_columns as $field)
                {
                $object->getActiveSheet()->setCellValueByColumnAndRow($column, 1, $field);
                $column++;
                }

                $excel_row = 2;

                foreach($employee_data as $row)
                {
                $object->getActiveSheet()->setCellValueByColumnAndRow(0, $excel_row, $row->trans_dt."T00:00:00.0");
                $object->getActiveSheet()->setCellValueByColumnAndRow(1, $excel_row, $row->acc_no);
                $object->getActiveSheet()->setCellValueByColumnAndRow(2, $excel_row, $row->short_code);
                $object->getActiveSheet()->setCellValueByColumnAndRow(3, $excel_row, $row->cheque_no);
                $object->getActiveSheet()->setCellValueByColumnAndRow(4, $excel_row, $row->farm_name);
                $object->getActiveSheet()->setCellValueByColumnAndRow(5, $excel_row, $row->amount);
                $object->getActiveSheet()->setCellValueByColumnAndRow(6, $excel_row, $row->micr_code);
                $object->getActiveSheet()->setCellValueByColumnAndRow(7, $excel_row, $row->trans_code);
                
                $excel_row++;
                }

                $object_writer = PHPExcel_IOFactory::createWriter($object, 'Excel5');
                $filename=$this->session->userdata['loggedin']['dist_sort_code'].'_Yes_Bank_'.$bank_data->soc_name;
                header('Content-Type: application/vnd.ms-excel');
                header('Content-Disposition: attachment;filename="'.$filename.'.xls"');

                $object_writer->save('php://output');
            }elseif($bank_data->bank_id == "2"){

                $table_columns = array("Date of Camp", "Farmer Name","Registration No.",
                "Bank Name","IFSC CODE","A/C NO","PADDY QTY","AMOUNT");
                $column = 0;

                foreach($table_columns as $field)
                {
                $object->getActiveSheet()->setCellValueByColumnAndRow($column, 1, $field);
                $column++;
                }

                $excel_row = 2;

                foreach($employee_data as $row)
                {
                $object->getActiveSheet()->setCellValueByColumnAndRow(0, $excel_row, $row->trans_dt);
                $object->getActiveSheet()->setCellValueByColumnAndRow(1, $excel_row, $row->farm_name);
                $object->getActiveSheet()->setCellValueByColumnAndRow(2, $excel_row, $row->reg_no);
                $object->getActiveSheet()->setCellValueByColumnAndRow(3, $excel_row, "Bandhan Bank");
                $object->getActiveSheet()->setCellValueByColumnAndRow(4, $excel_row, $row->ifs);
                $object->getActiveSheet()->setCellValueByColumnAndRow(5, $excel_row, $row->acc_no);
                $object->getActiveSheet()->setCellValueByColumnAndRow(6, $excel_row, $row->quantity);
                $object->getActiveSheet()->setCellValueByColumnAndRow(7, $excel_row, $row->amount);

                $excel_row++;
                }

                $object_writer = PHPExcel_IOFactory::createWriter($object, 'Excel5');
                $filename=$this->session->userdata['loggedin']['dist_sort_code'].'_Bandhan_Bank_'.$bank_data->soc_name;
                header('Content-Type: application/vnd.ms-excel');
                header('Content-Disposition: attachment;filename="'.$filename.'.xls"');

                $object_writer->save('php://output');
            }
            elseif($bank_data->bank_id == "3"){

                $table_columns = array("Date","Procurement Centre",
                "Name of the Beneficiary","Pay to","Registration No",
                "ACCOUNT NO","IFS CODE","Cheque No","Cheque Date (DD/MM/YYYY)","Quantity"
                ,"Amount in Figure","Amount in Word","Remarks");

                $column = 0;

                foreach($table_columns as $field)
                {
                $object->getActiveSheet()->setCellValueByColumnAndRow($column, 1, $field);
                $column++;
                }

                $excel_row = 2;

                foreach($employee_data as $row)
                {
                $pay = $row->farm_name;
                $payaccount = $row->faccount;

                $pay_to = $pay.' (A/c-'.$payaccount.')';
                $object->getActiveSheet()->setCellValueByColumnAndRow(0, $excel_row, date('d/m/Y',strtotime($row->trans_dt)));
               
                $object->getActiveSheet()->setCellValueByColumnAndRow(1, $excel_row, $row->soc_id);
                $object->getActiveSheet()->setCellValueByColumnAndRow(2, $excel_row, $row->farm_name);
                $object->getActiveSheet()->setCellValueByColumnAndRow(3, $excel_row, $pay_to);
                $object->getActiveSheet()->setCellValueByColumnAndRow(4, $excel_row, $row->reg_no);
                $object->getActiveSheet()->setCellValueByColumnAndRow(5, $excel_row, $row->faccount);
                $object->getActiveSheet()->setCellValueByColumnAndRow(6, $excel_row, $row->fifsc);
                $object->getActiveSheet()->setCellValueByColumnAndRow(7, $excel_row, "");
                $object->getActiveSheet()->setCellValueByColumnAndRow(8, $excel_row, date('d/m/Y',strtotime($row->cheque_dt)));
                $object->getActiveSheet()->setCellValueByColumnAndRow(9, $excel_row, $row->quantity);
                $object->getActiveSheet()->setCellValueByColumnAndRow(10, $excel_row, $row->amount);
                $object->getActiveSheet()->setCellValueByColumnAndRow(11, $excel_row, getIndianCurrency($row->amount));
                $object->getActiveSheet()->setCellValueByColumnAndRow(12, $excel_row, "");

                $excel_row++;
                }

                $object_writer = PHPExcel_IOFactory::createWriter($object, 'Excel5');
                $filename=$this->session->userdata['loggedin']['dist_sort_code'].'_Icici_Bank_'.$bank_data->soc_name;
                header('Content-Type: application/vnd.ms-excel');
                header('Content-Disposition: attachment;filename="'.$filename.'.xls"');

                $object_writer->save('php://output');
            }
            elseif($bank_data->bank_id == "4"){
           

                $table_columns = array("Payment Method Name","Payment Amount",
                "Activation Date","Beneficiary Name","Account No","Debit Account No","CRN No","Remarks","Phone No ","Print Branch","Cheque Date",
                "Code","Procurement Centre","Registration Number","EPIC Number","Quantity"
                ,"Cheque number","Amount in word","IFSC code");

                $column = 0;
 
                foreach($table_columns as $field)
                {
                $object->getActiveSheet()->setCellValueByColumnAndRow($column, 1, $field);
                $column++;
                }
                $excel_row = 2;

                foreach($employee_data as $row)
                {
                $pay = $row->farm_name;
                $payaccount = $row->faccount;

                $pay_to = $pay.' (A/c-'.$payaccount.')';
                $object->getActiveSheet()->setCellValueByColumnAndRow(0, $excel_row, "C");
                $object->getActiveSheet()->setCellValueByColumnAndRow(1, $excel_row, $row->amount);
                $object->getActiveSheet()->setCellValueByColumnAndRow(2, $excel_row, date('d-m-Y',strtotime($row->trans_dt)));
                $object->getActiveSheet()->setCellValueByColumnAndRow(3, $excel_row, $pay);
                $object->getActiveSheet()->setCellValueByColumnAndRow(4, $excel_row, $payaccount); 
                $object->getActiveSheet()->setCellValueByColumnAndRow(5, $excel_row, $debit_bank_data->acc_no);
                $object->getActiveSheet()->setCellValueByColumnAndRow(6, $excel_row, $row->reg_no);
                $object->getActiveSheet()->setCellValueByColumnAndRow(7, $excel_row, "");
                $object->getActiveSheet()->setCellValueByColumnAndRow(8, $excel_row, $row->mobile_number);
                $object->getActiveSheet()->setCellValueByColumnAndRow(9, $excel_row, $debit_bank_data->branch);
                $object->getActiveSheet()->setCellValueByColumnAndRow(10, $excel_row, date('d-m-Y',strtotime($row->cheque_dt)));
                $object->getActiveSheet()->setCellValueByColumnAndRow(11, $excel_row, $debit_bank_data->sol_id);
                $object->getActiveSheet()->setCellValueByColumnAndRow(12, $excel_row, $row->soc_name);
                $object->getActiveSheet()->setCellValueByColumnAndRow(13, $excel_row, "");
                $object->getActiveSheet()->setCellValueByColumnAndRow(14, $excel_row, "");
                $object->getActiveSheet()->setCellValueByColumnAndRow(15, $excel_row, $row->quantity);
                $object->getActiveSheet()->setCellValueByColumnAndRow(16, $excel_row, $row->cheque_no);
                $object->getActiveSheet()->setCellValueByColumnAndRow(17, $excel_row, getIndianCurrency($row->amount));
                $object->getActiveSheet()->setCellValueByColumnAndRow(18, $excel_row, $row->fifsc);

                $excel_row++;
                }

                $object_writer = PHPExcel_IOFactory::createWriter($object, 'Excel5');
                $filename=$this->session->userdata['loggedin']['dist_sort_code'].'_Axis_Bank_'.$bank_data->soc_name;
                header('Content-Type: application/vnd.ms-excel');
                header('Content-Disposition: attachment;filename="'.$filename.'.csv"');

                $object_writer->save('php://output');
            }else{

                $table_columns = array("Date","Procurement Centre",
                "Name of the Beneficiary","Pay to","Registration No",
                "ACCOUNT NO","IFS CODE","Cheque No","Cheque Date (DD/MM/YYYY)","Quantity"
                ,"Amount in Figure","Amount in Word","Remarks");

                $column = 0;

                foreach($table_columns as $field)
                {
                $object->getActiveSheet()->setCellValueByColumnAndRow($column, 1, $field);
                $column++;
                }

                $excel_row = 2;

                foreach($employee_data as $row)
                {
                $pay = $row->farm_name;
                $payaccount = $row->faccount;

                $pay_to = $pay.' (A/c-'.$payaccount.')';
                $object->getActiveSheet()->setCellValueByColumnAndRow(0, $excel_row, date('d/m/Y',strtotime($row->trans_dt)));
               
                $object->getActiveSheet()->setCellValueByColumnAndRow(1, $excel_row, $row->soc_id);
                $object->getActiveSheet()->setCellValueByColumnAndRow(2, $excel_row, $row->farm_name);
                $object->getActiveSheet()->setCellValueByColumnAndRow(3, $excel_row, $pay_to);
                $object->getActiveSheet()->setCellValueByColumnAndRow(4, $excel_row, $row->reg_no);
                $object->getActiveSheet()->setCellValueByColumnAndRow(5, $excel_row, $row->faccount);
                $object->getActiveSheet()->setCellValueByColumnAndRow(6, $excel_row, $row->fifsc);
                $object->getActiveSheet()->setCellValueByColumnAndRow(7, $excel_row, "");
                $object->getActiveSheet()->setCellValueByColumnAndRow(8, $excel_row, date('d/m/Y',strtotime($row->cheque_dt)));
                $object->getActiveSheet()->setCellValueByColumnAndRow(9, $excel_row, $row->quantity);
                $object->getActiveSheet()->setCellValueByColumnAndRow(10, $excel_row, $row->amount);
                $object->getActiveSheet()->setCellValueByColumnAndRow(11, $excel_row, getIndianCurrency($row->amount));
                $object->getActiveSheet()->setCellValueByColumnAndRow(12, $excel_row, "");

                $excel_row++;
                }

                $object_writer = PHPExcel_IOFactory::createWriter($object, 'Excel5');
                $filename=$this->session->userdata['loggedin']['dist_sort_code'].'_HDFC_Bank_'.$bank_data->soc_name;
                header('Content-Type: application/vnd.ms-excel');
                header('Content-Disposition: attachment;filename="'.$filename.'.xls"');

                $object_writer->save('php://output');


            }

        }else{


            $employee_data =  $this->Paddy->f_farmer_detail_cheque($soc_id,$trans_dt,$bulk_trans_id);

            $bank_data     =  $this->Paddy->f_farmer_bank_detail($soc_id,$trans_dt,$bulk_trans_id);

            $debit_bank_data = $this->Paddy->f_debit_bank_detail($bank_data->branch_id,$bank_data->bank_id);
            
            $update        =  $this->Paddy->f_farmer_dwn_flag($soc_id,$trans_dt,$bulk_trans_id);


         if($bank_data->bank_id == "1"){ 
            
               $table_columns = array("Issuance Date", "Account Number","Short Account Number",
                                  "Cheque Number","Payee Name","Amount",
                                  "MICR Code","Transaction Code");
                $column = 0;

                foreach($table_columns as $field)
                {
                $object->getActiveSheet()->setCellValueByColumnAndRow($column, 1, $field);
                $column++;
                }

                $excel_row = 2;

                foreach($employee_data as $row)
                {
                $object->getActiveSheet()->setCellValueByColumnAndRow(0, $excel_row, $row->trans_dt."T00:00:00.0");
                $object->getActiveSheet()->setCellValueByColumnAndRow(1, $excel_row, $row->acc_no);
                $object->getActiveSheet()->setCellValueByColumnAndRow(2, $excel_row, $row->short_code);
                $object->getActiveSheet()->setCellValueByColumnAndRow(3, $excel_row, $row->cheque_no);
                $object->getActiveSheet()->setCellValueByColumnAndRow(4, $excel_row, $row->farm_name);
                $object->getActiveSheet()->setCellValueByColumnAndRow(5, $excel_row, $row->amount);
                $object->getActiveSheet()->setCellValueByColumnAndRow(6, $excel_row, $row->micr_code);
                $object->getActiveSheet()->setCellValueByColumnAndRow(7, $excel_row, $row->trans_code);
                
                $excel_row++;
                }

                $object_writer = PHPExcel_IOFactory::createWriter($object, 'Excel5');
                $filename=$this->session->userdata['loggedin']['dist_sort_code'].'_Yes_Bank_'.$bank_data->soc_name;
                header('Content-Type: application/vnd.ms-excel');
                header('Content-Disposition: attachment;filename="'.$filename.'.xls"');

                $object_writer->save('php://output');
            }elseif($bank_data->bank_id == "2"){

                $table_columns = array("Date of Camp", "Farmer Name","Registration No.",
                "Bank Name","IFSC CODE","A/C NO","PADDY QTY","AMOUNT");
                $column = 0;

                foreach($table_columns as $field)
                {
                $object->getActiveSheet()->setCellValueByColumnAndRow($column, 1, $field);
                $column++;
                }

                $excel_row = 2;

                foreach($employee_data as $row)
                {
                $object->getActiveSheet()->setCellValueByColumnAndRow(0, $excel_row, $row->trans_dt);
                $object->getActiveSheet()->setCellValueByColumnAndRow(1, $excel_row, $row->farm_name);
                $object->getActiveSheet()->setCellValueByColumnAndRow(2, $excel_row, $row->reg_no);
                $object->getActiveSheet()->setCellValueByColumnAndRow(3, $excel_row, "Bandhan Bank");
                $object->getActiveSheet()->setCellValueByColumnAndRow(4, $excel_row, $row->ifs);
                $object->getActiveSheet()->setCellValueByColumnAndRow(5, $excel_row, $row->acc_no);
                $object->getActiveSheet()->setCellValueByColumnAndRow(6, $excel_row, $row->quantity);
                $object->getActiveSheet()->setCellValueByColumnAndRow(7, $excel_row, $row->amount);

                $excel_row++;
                }

                $object_writer = PHPExcel_IOFactory::createWriter($object, 'Excel5');
                $filename=$this->session->userdata['loggedin']['dist_sort_code'].'_Bandhan_Bank_'.$bank_data->soc_name;
                header('Content-Type: application/vnd.ms-excel');
                header('Content-Disposition: attachment;filename="'.$filename.'.xls"');

                $object_writer->save('php://output');

            }
            elseif($bank_data->bank_id == "3"){

                $table_columns = array("Sr. No.","TRAN.ID","AMOUNT","SENDER ACCOUNT TYPE","SENDER ACCOUNT NO",
                "SENDER NAME","SMS EML","Detail","OoR7002 (SENDER NAME)","BENEFICIARY IFSC","BENEFICIARY ACCOUNT TYPE","BENEFICIARY ACCOUNT NO","BENEFICIARY ACCOUNT NAME","SENDER TO RECEIVER INFORMATION");

                $column = 0;

                foreach($table_columns as $field)
                {
                $object->getActiveSheet()->setCellValueByColumnAndRow($column, 1, $field);
                $column++;
                }

                $excel_row = 2;
                $slno=0;
                foreach($employee_data as $row)
                {
                $pay = $row->farm_name;
                $payaccount = "'".$row->faccount;
                $regNo = $row->reg_no.'/'.$row->dist_code.'/'.$row->bulk_id.'/'.$row->trans_dt;

                $pay_to = $pay.' (A/c-'.$payaccount.')';
                 // Commented Date :12/05/2020"
              

                $object->getActiveSheet()->setCellValueByColumnAndRow(0, $excel_row, ++$slno);
                $object->getActiveSheet()->setCellValueByColumnAndRow(1, $excel_row, $row->trans_id);
                $object->getActiveSheet()->setCellValueByColumnAndRow(2, $excel_row, $row->amount);
                $object->getActiveSheet()->setCellValueByColumnAndRow(3, $excel_row, "11");
                $object->getActiveSheet()->setCellValueByColumnAndRow(4, $excel_row, "098301002773");
                $object->getActiveSheet()->setCellValueByColumnAndRow(5, $excel_row, "THE WEST BENGAL STATE CO OPERATIVE MARKETING FEDERATION LTD(BENFED)");
                $object->getActiveSheet()->setCellValueByColumnAndRow(6, $excel_row, "SMS");
                $object->getActiveSheet()->setCellValueByColumnAndRow(7, $excel_row, "9674746908");
                $object->getActiveSheet()->setCellValueByColumnAndRow(8, $excel_row, "THE WEST BENGAL STATE CO OPERATIVE MARKETING FEDERATION LTD(BENFED)");              
                $object->getActiveSheet()->setCellValueByColumnAndRow(9, $excel_row, $row->fifsc);
                $object->getActiveSheet()->setCellValueByColumnAndRow(10, $excel_row, "11");
                $object->getActiveSheet()->setCellValueByColumnAndRow(11, $excel_row, $payaccount);
                $object->getActiveSheet()->setCellValueByColumnAndRow(12, $excel_row, $row->farm_name);
                $object->getActiveSheet()->setCellValueByColumnAndRow(13, $excel_row, $regNo);
              


                $excel_row++;
                }

                $object_writer = PHPExcel_IOFactory::createWriter($object, 'Excel5');
                $filename=$this->session->userdata['loggedin']['dist_sort_code'].'_Icici_Bank_'.$bank_data->soc_name;
                header('Content-Type: application/vnd.ms-excel');
                header('Content-Disposition: attachment;filename="'.$filename.'.xls"');

                $object_writer->save('php://output');
            }
            elseif($bank_data->bank_id == "4"){

                $table_columns = array("Payment Method Name","Payment Amount",
                "Activation Date","Beneficiary Name","Account No","Debit Account No","CRN No","Remarks","Phone No ","Print Branch","Cheque Date",
                "Code","Procurement Centre","Registration Number","EPIC Number","Quantity"
                ,"Cheque number","Amount in word","IFSC code");

                $column = 0;
 
                foreach($table_columns as $field)
                {
                $object->getActiveSheet()->setCellValueByColumnAndRow($column, 1, $field);
                $column++;
                }
                $excel_row = 2;

                foreach($employee_data as $row)
                {
                $pay = $row->farm_name;
                $payaccount = $row->faccount;

                if(isset($debit_bank_data->acc_no)){
                    $debit_acc_no = $debit_bank_data->acc_no;
                }else{
                    $debit_acc_no = "";
                }
                if(isset($debit_bank_data->branch)){
                    $branch = $debit_bank_data->branch;
                }else{
                    $branch = "";
                }
                if(isset($row->epic_no)){
                    $epic_no = $row->epic_no;
                }else{
                    $epic_no = "";
                }
                if(isset($debit_bank_data->sol_id)){
                    $code = $debit_bank_data->sol_id;
                }else{
                    $code = "";
                }

                $pay_to = $pay.' (A/c-'.$payaccount.')';
                $object->getActiveSheet()->setCellValueByColumnAndRow(0, $excel_row, "N");
                $object->getActiveSheet()->setCellValueByColumnAndRow(1, $excel_row, $row->amount);
                $object->getActiveSheet()->setCellValueByColumnAndRow(2, $excel_row, date('d-m-Y',strtotime($row->trans_dt)));
                $object->getActiveSheet()->setCellValueByColumnAndRow(3, $excel_row, $pay);
                $object->getActiveSheet()->setCellValueByColumnAndRow(4, $excel_row, $payaccount); 
                $object->getActiveSheet()->setCellValueByColumnAndRow(5, $excel_row, $debit_acc_no);
                $object->getActiveSheet()->setCellValueByColumnAndRow(6, $excel_row, $row->reg_no);
                $object->getActiveSheet()->setCellValueByColumnAndRow(7, $excel_row, "");
                $object->getActiveSheet()->setCellValueByColumnAndRow(8, $excel_row, $row->mobile_number);
                $object->getActiveSheet()->setCellValueByColumnAndRow(9, $excel_row, $branch);
                $object->getActiveSheet()->setCellValueByColumnAndRow(10, $excel_row, "");
                $object->getActiveSheet()->setCellValueByColumnAndRow(11, $excel_row, $code);
                $object->getActiveSheet()->setCellValueByColumnAndRow(12, $excel_row, $row->soc_name);
                $object->getActiveSheet()->setCellValueByColumnAndRow(13, $excel_row, "");
                $object->getActiveSheet()->setCellValueByColumnAndRow(14, $excel_row, $epic_no);
                $object->getActiveSheet()->setCellValueByColumnAndRow(15, $excel_row, $row->quantity);
                $object->getActiveSheet()->setCellValueByColumnAndRow(16, $excel_row, "");
                $object->getActiveSheet()->setCellValueByColumnAndRow(17, $excel_row, getIndianCurrency($row->amount));
                $object->getActiveSheet()->setCellValueByColumnAndRow(18, $excel_row, $row->fifsc);

                $excel_row++;
                }

                $object_writer = PHPExcel_IOFactory::createWriter($object, 'Excel5');
                $filename=$this->session->userdata['loggedin']['dist_sort_code'].'_Axis_Bank_'.$bank_data->soc_name;
                header('Content-Type: application/vnd.ms-excel');
                header('Content-Disposition: attachment;filename="'.$filename.'.xls"');

                $object_writer->save('php://output');
            }else{

                $table_columns = array("Sr. No.","TRAN.ID","AMOUNT","SENDER ACCOUNT TYPE","SENDER ACCOUNT NO",
                "SENDER NAME","SMS EML","Detail","OoR7002 (SENDER NAME)","BENEFICIARY IFSC","BENEFICIARY ACCOUNT TYPE","BENEFICIARY ACCOUNT NO","BENEFICIARY ACCOUNT NAME","SENDER TO RECEIVER INFORMATION");

                $column = 0;

                foreach($table_columns as $field)
                {
                $object->getActiveSheet()->setCellValueByColumnAndRow($column, 1, $field);
                $column++;
                }

                $excel_row = 2;
                $slno=0;
                foreach($employee_data as $row)
                {
                $pay = $row->farm_name;
                $payaccount = "'".$row->faccount;
                $regNo = $row->reg_no.'/'.$row->dist_code.'/'.$row->bulk_id.'/'.$row->trans_dt;

                $pay_to = $pay.' (A/c-'.$payaccount.')';
              
                $object->getActiveSheet()->setCellValueByColumnAndRow(0, $excel_row, ++$slno);
                $object->getActiveSheet()->setCellValueByColumnAndRow(1, $excel_row, $row->trans_id);
                $object->getActiveSheet()->setCellValueByColumnAndRow(2, $excel_row, $row->amount);
                $object->getActiveSheet()->setCellValueByColumnAndRow(3, $excel_row, "11");
                $object->getActiveSheet()->setCellValueByColumnAndRow(4, $excel_row, "098301002773");
                $object->getActiveSheet()->setCellValueByColumnAndRow(5, $excel_row, "THE WEST BENGAL STATE CO OPERATIVE MARKETING FEDERATION LTD(BENFED)");
                $object->getActiveSheet()->setCellValueByColumnAndRow(6, $excel_row, "SMS");
                $object->getActiveSheet()->setCellValueByColumnAndRow(7, $excel_row, "9674746908");
                $object->getActiveSheet()->setCellValueByColumnAndRow(8, $excel_row, "THE WEST BENGAL STATE CO OPERATIVE MARKETING FEDERATION LTD(BENFED)");              
                $object->getActiveSheet()->setCellValueByColumnAndRow(9, $excel_row, $row->fifsc);
                $object->getActiveSheet()->setCellValueByColumnAndRow(10, $excel_row, "11");
                $object->getActiveSheet()->setCellValueByColumnAndRow(11, $excel_row, $payaccount);
                $object->getActiveSheet()->setCellValueByColumnAndRow(12, $excel_row, $row->farm_name);
                $object->getActiveSheet()->setCellValueByColumnAndRow(13, $excel_row, $regNo);

                $excel_row++;
                }

                $object_writer = PHPExcel_IOFactory::createWriter($object, 'Excel5');
                $filename=$this->session->userdata['loggedin']['dist_sort_code'].'_HDFC_Bank_'.$bank_data->soc_name;
                header('Content-Type: application/vnd.ms-excel');
                header('Content-Disposition: attachment;filename="'.$filename.'.xls"');

                $object_writer->save('php://output');

            }


        }

         
    }


     ///  ****  Code For Getting Paddy Procurement Reissue Payment Excell Sheet   ****   ////

    public function f_procurementreissue_Excel(){
   
       $branch_id = $this->uri->segment(4);
       $bank_id = $this->uri->segment(5);
       $this->load->library('excel');
       $object = new PHPExcel();
       $object->setActiveSheetIndex(0);  

            $employee_data =  $this->Paddy->f_farmer_reissue_cheque($branch_id,$bank_id);
            
            $update        =  $this->Paddy->f_farmerreissue_dwn_flag($branch_id,$bank_id);


         if($bank_id == "1"){ 
            
               $table_columns = array("Issuance Date", "Account Number","Short Account Number",
                                  "Cheque Number","Payee Name","Amount",
                                  "MICR Code","Transaction Code");
                $column = 0;

                foreach($table_columns as $field)
                {
                $object->getActiveSheet()->setCellValueByColumnAndRow($column, 1, $field);
                $column++;
                }

                $excel_row = 2;

                foreach($employee_data as $row)
                {
                $object->getActiveSheet()->setCellValueByColumnAndRow(0, $excel_row, $row->trans_dt."T00:00:00.0");
                $object->getActiveSheet()->setCellValueByColumnAndRow(1, $excel_row, $row->acc_no);
                $object->getActiveSheet()->setCellValueByColumnAndRow(2, $excel_row, $row->short_code);
                $object->getActiveSheet()->setCellValueByColumnAndRow(3, $excel_row, $row->cheque_no);
                $object->getActiveSheet()->setCellValueByColumnAndRow(4, $excel_row, $row->farm_name);
                $object->getActiveSheet()->setCellValueByColumnAndRow(5, $excel_row, $row->amount);
                $object->getActiveSheet()->setCellValueByColumnAndRow(6, $excel_row, $row->micr_code);
                $object->getActiveSheet()->setCellValueByColumnAndRow(7, $excel_row, $row->trans_code);
                
                $excel_row++;
                }

                $object_writer = PHPExcel_IOFactory::createWriter($object, 'Excel5');
                $filename=$this->session->userdata['loggedin']['dist_sort_code'].'_Yes_Bank_'.$bank_data->soc_name;
                header('Content-Type: application/vnd.ms-excel');
                header('Content-Disposition: attachment;filename="'.$filename.'.xls"');

                $object_writer->save('php://output');
            }elseif($bank_id == "2"){

                $table_columns = array("Date of Camp", "Farmer Name","Registration No.",
                "Bank Name","IFSC CODE","A/C NO","PADDY QTY","AMOUNT");
                $column = 0;

                foreach($table_columns as $field)
                {
                $object->getActiveSheet()->setCellValueByColumnAndRow($column, 1, $field);
                $column++;
                }

                $excel_row = 2;

                foreach($employee_data as $row)
                {
                $object->getActiveSheet()->setCellValueByColumnAndRow(0, $excel_row, $row->trans_dt);
                $object->getActiveSheet()->setCellValueByColumnAndRow(1, $excel_row, $row->farm_name);
                $object->getActiveSheet()->setCellValueByColumnAndRow(2, $excel_row, $row->reg_no);
                $object->getActiveSheet()->setCellValueByColumnAndRow(3, $excel_row, "Bandhan Bank");
                $object->getActiveSheet()->setCellValueByColumnAndRow(4, $excel_row, $row->ifs);
                $object->getActiveSheet()->setCellValueByColumnAndRow(5, $excel_row, $row->acc_no);
                $object->getActiveSheet()->setCellValueByColumnAndRow(6, $excel_row, $row->quantity);
                $object->getActiveSheet()->setCellValueByColumnAndRow(7, $excel_row, $row->amount);

                $excel_row++;
                }

                $object_writer = PHPExcel_IOFactory::createWriter($object, 'Excel5');
                $filename=$this->session->userdata['loggedin']['dist_sort_code'].'_Bandhan_Bank_'.$bank_data->soc_name;
                header('Content-Type: application/vnd.ms-excel');
                header('Content-Disposition: attachment;filename="'.$filename.'.xls"');

                $object_writer->save('php://output');

            }
            elseif($bank_id == "3"){
               
                $table_columns = array("Sr. No.","TRAN.ID","AMOUNT","SENDER ACCOUNT TYPE","SENDER ACCOUNT NO",
                "SENDER NAME","SMS EML","Detail","OoR7002 (SENDER NAME)","BENEFICIARY IFSC","BENEFICIARY ACCOUNT TYPE","BENEFICIARY ACCOUNT NO","BENEFICIARY ACCOUNT NAME","SENDER TO RECEIVER INFORMATION");

                $column = 0;

                foreach($table_columns as $field)
                {
                $object->getActiveSheet()->setCellValueByColumnAndRow($column, 1, $field);
                $column++;
                }

                $excel_row = 2;
                $slno=0;
                foreach($employee_data as $row)
                {
                $pay = $row->farm_name;
                $payaccount = "'".$row->faccount;
                $regNo = $row->reg_no.'/'.$row->dist_code.'/'.$row->bulk_id.'/'.$row->trans_dt;

                $pay_to = $pay.' (A/c-'.$payaccount.')';

                $object->getActiveSheet()->setCellValueByColumnAndRow(0, $excel_row, ++$slno);
                $object->getActiveSheet()->setCellValueByColumnAndRow(1, $excel_row, $row->trans_id);
                $object->getActiveSheet()->setCellValueByColumnAndRow(2, $excel_row, $row->amount);
                $object->getActiveSheet()->setCellValueByColumnAndRow(3, $excel_row, "11");
                $object->getActiveSheet()->setCellValueByColumnAndRow(4, $excel_row, "098301002773");
                $object->getActiveSheet()->setCellValueByColumnAndRow(5, $excel_row, "THE WEST BENGAL STATE CO OPERATIVE MARKETING FEDERATION LTD(BENFED)");
                $object->getActiveSheet()->setCellValueByColumnAndRow(6, $excel_row, "SMS");
                $object->getActiveSheet()->setCellValueByColumnAndRow(7, $excel_row, "9674746908");
                $object->getActiveSheet()->setCellValueByColumnAndRow(8, $excel_row, "THE WEST BENGAL STATE CO OPERATIVE MARKETING FEDERATION LTD(BENFED)");              
                $object->getActiveSheet()->setCellValueByColumnAndRow(9, $excel_row, $row->fifsc);
                $object->getActiveSheet()->setCellValueByColumnAndRow(10, $excel_row, "11");
                $object->getActiveSheet()->setCellValueByColumnAndRow(11, $excel_row, $payaccount);
                $object->getActiveSheet()->setCellValueByColumnAndRow(12, $excel_row, $row->farm_name);
                $object->getActiveSheet()->setCellValueByColumnAndRow(13, $excel_row, $regNo);

                $excel_row++;
                }

                $object_writer = PHPExcel_IOFactory::createWriter($object, 'Excel5');
                $filename=$this->session->userdata['loggedin']['dist_sort_code'].'_Icici_Bank';
                header('Content-Type: application/vnd.ms-excel');
                header('Content-Disposition: attachment;filename="'.$filename.'.xls"');

                $object_writer->save('php://output');
            }
             elseif($bank_id == "4"){

                $table_columns = array("Payment Method Name","Payment Amount",
                "Activation Date","Beneficiary Name","Account No","Debit Account No","CRN No","Remarks","Phone No ","Print Branch","Cheque Date",
                "Code","Procurement Centre","Registration Number","EPIC Number","Quantity"
                ,"Cheque number","Amount in word","IFSC code");

                $column = 0;
 
                foreach($table_columns as $field)
                {
                $object->getActiveSheet()->setCellValueByColumnAndRow($column, 1, $field);
                $column++;
                }
                $excel_row = 2;

                foreach($employee_data as $row)
                {
                $pay = $row->farm_name;
                $payaccount = $row->faccount;

                if(isset($debit_bank_data->acc_no)){
                    $debit_acc_no = $debit_bank_data->acc_no;
                }else{
                    $debit_acc_no = "";
                }
                if(isset($debit_bank_data->branch)){
                    $branch = $debit_bank_data->branch;
                }else{
                    $branch = "";
                }
                if(isset($row->epic_no)){
                    $epic_no = $row->epic_no;
                }else{
                    $epic_no = "";
                }
                if(isset($debit_bank_data->sol_id)){
                    $code = $debit_bank_data->sol_id;
                }else{
                    $code = "";
                }

                $pay_to = $pay.' (A/c-'.$payaccount.')';
                $object->getActiveSheet()->setCellValueByColumnAndRow(0, $excel_row, "N");
                $object->getActiveSheet()->setCellValueByColumnAndRow(1, $excel_row, $row->amount);
                $object->getActiveSheet()->setCellValueByColumnAndRow(2, $excel_row, date('d-m-Y',strtotime($row->trans_dt)));
                $object->getActiveSheet()->setCellValueByColumnAndRow(3, $excel_row, $pay);
                $object->getActiveSheet()->setCellValueByColumnAndRow(4, $excel_row, $payaccount); 
                $object->getActiveSheet()->setCellValueByColumnAndRow(5, $excel_row, $debit_acc_no);
                $object->getActiveSheet()->setCellValueByColumnAndRow(6, $excel_row, $row->reg_no);
                $object->getActiveSheet()->setCellValueByColumnAndRow(7, $excel_row, "");
                $object->getActiveSheet()->setCellValueByColumnAndRow(8, $excel_row, $row->mobile_number);
                $object->getActiveSheet()->setCellValueByColumnAndRow(9, $excel_row, $branch);
                $object->getActiveSheet()->setCellValueByColumnAndRow(10, $excel_row, "");
                $object->getActiveSheet()->setCellValueByColumnAndRow(11, $excel_row, $code);
                $object->getActiveSheet()->setCellValueByColumnAndRow(12, $excel_row, $row->soc_name);
                $object->getActiveSheet()->setCellValueByColumnAndRow(13, $excel_row, "");
                $object->getActiveSheet()->setCellValueByColumnAndRow(14, $excel_row, $epic_no);
                $object->getActiveSheet()->setCellValueByColumnAndRow(15, $excel_row, $row->quantity);
                $object->getActiveSheet()->setCellValueByColumnAndRow(16, $excel_row, "");
                $object->getActiveSheet()->setCellValueByColumnAndRow(17, $excel_row, getIndianCurrency($row->amount));
                $object->getActiveSheet()->setCellValueByColumnAndRow(18, $excel_row, $row->fifsc);

                $excel_row++;
                }

                $object_writer = PHPExcel_IOFactory::createWriter($object, 'Excel5');
                $filename=$this->session->userdata['loggedin']['dist_sort_code'].'_Axis_Bank_'.$bank_data->soc_name;
                header('Content-Type: application/vnd.ms-excel');
                header('Content-Disposition: attachment;filename="'.$filename.'.xls"');

                $object_writer->save('php://output');
            }
            else{

                $table_columns = array("Sr. No.","TRAN.ID","AMOUNT","SENDER ACCOUNT TYPE","SENDER ACCOUNT NO",
                "SENDER NAME","SMS EML","Detail","OoR7002 (SENDER NAME)","BENEFICIARY IFSC","BENEFICIARY ACCOUNT TYPE","BENEFICIARY ACCOUNT NO","BENEFICIARY ACCOUNT NAME","SENDER TO RECEIVER INFORMATION");

                $column = 0;

                foreach($table_columns as $field)
                {
                $object->getActiveSheet()->setCellValueByColumnAndRow($column, 1, $field);
                $column++;
                }

                $excel_row = 2;
                $slno=0;
                foreach($employee_data as $row)
                {
                $pay = $row->farm_name;
                $payaccount = "'".$row->faccount;
                $regNo = $row->reg_no.'/'.$row->dist_code.'/'.$row->bulk_id.'/'.$row->trans_dt;

                $pay_to = $pay.' (A/c-'.$payaccount.')';

                $object->getActiveSheet()->setCellValueByColumnAndRow(0, $excel_row, ++$slno);
                $object->getActiveSheet()->setCellValueByColumnAndRow(1, $excel_row, $row->trans_id);
                $object->getActiveSheet()->setCellValueByColumnAndRow(2, $excel_row, $row->amount);
                $object->getActiveSheet()->setCellValueByColumnAndRow(3, $excel_row, "11");
                $object->getActiveSheet()->setCellValueByColumnAndRow(4, $excel_row, "098301002773");
                $object->getActiveSheet()->setCellValueByColumnAndRow(5, $excel_row, "THE WEST BENGAL STATE CO OPERATIVE MARKETING FEDERATION LTD(BENFED)");
                $object->getActiveSheet()->setCellValueByColumnAndRow(6, $excel_row, "SMS");
                $object->getActiveSheet()->setCellValueByColumnAndRow(7, $excel_row, "9674746908");
                $object->getActiveSheet()->setCellValueByColumnAndRow(8, $excel_row, "THE WEST BENGAL STATE CO OPERATIVE MARKETING FEDERATION LTD(BENFED)");              
                $object->getActiveSheet()->setCellValueByColumnAndRow(9, $excel_row, $row->fifsc);
                $object->getActiveSheet()->setCellValueByColumnAndRow(10, $excel_row, "11");
                $object->getActiveSheet()->setCellValueByColumnAndRow(11, $excel_row, $payaccount);
                $object->getActiveSheet()->setCellValueByColumnAndRow(12, $excel_row, $row->farm_name);
                $object->getActiveSheet()->setCellValueByColumnAndRow(13, $excel_row, $regNo);

                $excel_row++;
                }

                $object_writer = PHPExcel_IOFactory::createWriter($object, 'Excel5');
                $filename=$this->session->userdata['loggedin']['dist_sort_code'].'_HDFC_Bank';
                header('Content-Type: application/vnd.ms-excel');
                header('Content-Disposition: attachment;filename="'.$filename.'.xls"');

                $object_writer->save('php://output');

            }

         
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

    //Progressive Paddy Procurement of a Particular Society

    public function f_progressive(){

        $where      =   array(

            "soc_id"   => $this->input->get('soc_id'),

            "kms_id" => $this->session->userdata['loggedin']['kms_id']

        );

        $data = $this->Paddy->f_get_particulars("td_collections", array("ifnull(sum(quantity), 0) sum"), $where, 1);
       
        echo $data->sum;

    }

    //Paddy Quantity, Which are Already Delivered to the Rice Millars

    public function f_alreadyDelivered(){

        $where      =   array(

            "soc_id"   => $this->input->get('soc_id'),

            "mill_id"   => $this->input->get('mill_id'),

            "kms_year" => $this->session->userdata['loggedin']['kms_id']

        );
        

        $data = $this->Paddy->f_get_particulars("td_received", array("ifnull(sum(paddy_qty), 0) sum"), $where, 1);
        
      
         echo json_encode($data);
    }

    public function f_proc_date(){

         $where      =   array(

            "soc_id"   => $this->input->get('soc_id'),

            "mill_id"   => $this->input->get('mill_id'),

            "kms_id" => $this->session->userdata['loggedin']['kms_id']

        );

       
      $datas = $this->Paddy->f_get_particulars("td_collections", array("MIN(trans_dt) as trans_dt"),$where, 1);
      
         echo json_encode($datas);
    }

    //Progressive Work Order for a particular Society

    public function f_totorder(){

        $where      =   array(

            "soc_id"   => $this->input->get('soc_id'),

            "kms_year" => $this->session->userdata['loggedin']['kms_id']

        );

        $data = $this->Paddy->f_get_particulars("td_work_order", array("ifnull(sum(paddy_qty), 0) sum"), $where, 1);

        echo $data->sum;

    }

    ///  ***** Getting total Workorder  ***** ///

    public function f_totorder_soc_mill(){

        $where      =   array(

            "soc_id"   => $this->input->get('soc_id'),
            "mill_id"  => $this->input->get('mill_id'),
            "kms_year" => $this->session->userdata['loggedin']['kms_id']

        );
        $wheres      =   array(

            "soc_id"   => $this->input->get('soc_id'),
            "mill_id"  => $this->input->get('mill_id'),
            "kms_id" => $this->session->userdata['loggedin']['kms_id']

        );

        $datas = $this->Paddy->f_get_particulars("td_work_order", array("ifnull(MIN(trans_dt), 0) sum,ifnull(sum(paddy_qty), 0) sums"), $where, 1);
        
        

        $datap  = $this->Paddy->f_get_particulars("td_collections", array("ifnull(sum(quantity), 0) proc_qty"), $wheres, 1);

        
         $data["sumss"]["sum"]= $datas->sum;
         $data["sumss"]["sums"]= $datas->sums;
         $data["sumss"]["proc_qty"]= $datap->proc_qty;
      

        echo json_encode($data["sumss"]);

    }

    /*********************For Paddy Received Screen********************/
    #Paddy Delivered to the Rice Mill List from td_received
    public function f_received() {
      
       
        //Retriving Paddy Received Details from table td_received
        $select     =   array(

            "t.trans_dt", "t.branch_id","t.trans_no", "t.dist", "paddy_qty",

            "m.soc_name", "md.mill_name", "t.created_by","t.modified_by"

        );

        $where      =   array(

            "t.soc_id = m.sl_no"        => NULL,

            "t.mill_id = md.sl_no"      => NULL,

            "t.branch_id = '".$this->session->userdata['loggedin']['branch_id']."'" => NULL,

            "t.kms_year = '".$this->session->userdata['loggedin']['kms_id']."' ORDER BY t.trans_dt"  => NULL

        );

        $paddyreceived['paddyreceived_dtls']    =   $this->Paddy->f_get_particulars("td_received t, md_society m, md_mill md", $select, $where, 0);
        
       
        $this->load->view('post_login/main');

        $this->load->view("paddyreceived/dashboard", $paddyreceived);

        $this->load->view('search/search');

        $this->load->view('post_login/footer');
        
    }

    //New Paddy Quantity Delivery to the Rice Mill in table td_received
    public function f_received_add() {

        
        if($_SERVER['REQUEST_METHOD'] == "POST") {

            $data_array = array(

                "trans_dt"      =>  $this->input->post('trans_dt'),                

                "kms_year"      =>  $this->session->userdata['loggedin']['kms_id'],

                "branch_id"      =>  $this->session->userdata['loggedin']['branch_id'],

                "dist"          =>  $this->session->userdata['loggedin']['dist_id'],

                "soc_id"        =>  $this->input->post('soc_name'),

                "mill_id"       =>  $this->input->post('mill_name'),

                "paddy_qty"     =>  $this->input->post('paddy_qty'),

                "created_by"    =>  $this->session->userdata['loggedin']['user_name'],

                "created_dt"    =>  date('Y-m-d h:i:s')

            );
          
            $this->Paddy->f_insert('td_received', $data_array);

            //For notification storing message
            $this->session->set_flashdata('msg', 'Successfully added!');

            redirect('paddys/transactions/f_received');

        }
        else {

            $where      =   array(

                "branch_id" => $this->session->userdata['loggedin']['branch_id']
            );

            //Block List
            $paddyreceived['blocks']  =   $this->Paddy->f_get_particulars("md_block",NULL,$where, 0);

            $this->load->view('post_login/main');

            $this->load->view("paddyreceived/add", $paddyreceived);

            $this->load->view('post_login/footer');

        }
        
    }

    //Delivered Paddy Quantity to the Rice Mill Edit in td_received
    public function f_received_edit() {
        

        if($_SERVER['REQUEST_METHOD'] == "POST") {

            $data_array = array(

                //"file_no"      =>  $this->input->post('file_name')

                 "paddy_qty"        =>  $this->input->post('paddy_qty')

            );

            $where  =   array(

                "trans_no"     =>  $this->input->post('trans_no')

            );

            $this->Paddy->f_edit('td_received', $data_array, $where);

            //For notification storing message
            $this->session->set_flashdata('msg', 'Successfully edited!');

            redirect('paddys/transactions/f_received');


        }
        else {

           
            //Received Details
            $select     =   array(

                "t.trans_dt", "t.trans_no", "t.dist", "t.file_no",

                "t.mill_id", "t.paddy_qty",
    
                "t.soc_id", "m.block"
    
            );
    
            $where      =   array(
    
                "t.soc_id = m.sl_no"    => NULL,
                
                "t.trans_no" => $this->input->get('trans_no')

            );

            $paddyreceived['paddyreceived_dtls']=  $this->Paddy->f_get_particulars("td_received t, md_society m", $select, $where, 1);

            $kms_id    = $this->session->userdata['loggedin']['kms_id'];
            $branch_id = $this->session->userdata['loggedin']['branch_id'];

            $soc_id                     =   $this->Paddy->get_soc_id_by_trans_no($this->input->get('trans_no'));
            

            $paddyreceived['file_dtls'] =   $this->Paddy->get_file($kms_id,$branch_id,$soc_id);
            
            $this->load->view('post_login/main');

            $this->load->view("paddyreceived/edit", $paddyreceived);

            $this->load->view('post_login/footer');

        }
        
    }

    //Received delete
    public function f_received_delete() {

        $where = array(
            
            "trans_no"    =>  $this->input->get('sl_no')
            
        );

        $this->Paddy->f_delete('td_received', $where);
       

        $this->session->set_flashdata('msg', 'Successfully Deleted!');

        redirect("paddys/transactions/f_received");

    }

    /*********************For Paddy CMR offered Screen********************/
    #After Milling Mill Offer CMR to the DO 

    public function f_offered() {

        //Retriving CMR offered Details from table td_cmr_offered
        $select     =   array(

            "t.trans_dt", "t.trans_no", "t.milled","t.rice_type","t.cmr_offered_now","t.resultant_cmr","t.created_by","t.modified_by",

            "s.soc_name", "md.mill_name",

        );

        $where      =   array(

            "t.soc_id = s.sl_no"    => NULL,

            "t.mill_id = md.sl_no"  => NULL,

            "t.branch_id"             => $this->session->userdata['loggedin']['branch_id'],

            "kms_year"             => $this->session->userdata['loggedin']['kms_id']

        );

        $cmroffered['cmroffered_dtls']    =   $this->Paddy->f_get_particulars("td_cmr_offered t, md_society s, md_mill md", $select, $where, 0);
        
        $this->load->view('post_login/main');

        $this->load->view("cmroffered/dashboard", $cmroffered);
        
        $this->load->view('search/search');

        $this->load->view('post_login/footer');
        
    }

    //New CMR offere Add for a particular Mill in the table td_cmr_offered

    public function f_offered_add() {

        if($_SERVER['REQUEST_METHOD'] == "POST") {     
            
            $data_array = array(

                "trans_dt"             =>  $this->input->post('trans_dt'),                

                "kms_year"             =>  $this->session->userdata['loggedin']['kms_id'],

                "branch_id"            =>  $this->session->userdata['loggedin']['branch_id'],

                "block_id"             =>  $this->input->post('block'),

                "soc_id"               =>  $this->input->post('soc_name'),

                "mill_id"              =>  $this->input->post('mill_name'),

                "progressive_paddy_received"  =>  $this->input->post('progressive_paddy_received'),

                "rice_type"            =>  $this->input->post('rice_type'),

                "progressive_res_paddy"       =>  $this->input->post('progressive_res_paddy'),

                "milled"               => $this->input->post('milled'),

                "resultant_cmr"        =>  $this->input->post('res_cmr'),

                "cmr_offered_now"      => $this->input->post('cmr_offered_now'),

                "total_progres_cmr_offered" => $this->input->post('total_progressive_cmr_offered'),

                "cmr_yet_to_offered"   => $this->input->post('cmr_yet_to_offered'),

                "created_by"           =>  $this->session->userdata['loggedin']['user_name'],

                "created_dt"           =>  date('Y-m-d h:i:s')

            );

            $this->Paddy->f_insert('td_cmr_offered', $data_array);

            //For notification storing message
            $this->session->set_flashdata('msg', 'Successfully added!');

            redirect('paddys/transactions/f_offered');

            }
           else {

            $where      =   array(

                "branch_id" => $this->session->userdata['loggedin']['branch_id']
            );

            //Block List
            $cmroffered['blocks']  =   $this->Paddy->f_get_particulars("md_block",NULL,$where, 0);

            $this->load->view('post_login/main');

            $this->load->view("cmroffered/add", $cmroffered);

            $this->load->view('post_login/footer');

        }
        
    }

    //Ajax Code For getting added offer 

    public function f_added_offered(){

    	$soc_id = $_GET["soc_id"];
    	$mill_id = $_GET["mill_id"];

        $select     =   array(

            "t.trans_dt", "t.trans_no", "t.milled","t.rice_type","t.resultant_cmr","t.cmr_offered_now",

            "s.soc_name", "md.mill_name",

        );

        $where      =   array(

            "t.soc_id = s.sl_no"   => NULL,

            "t.mill_id = md.sl_no" => NULL,

            "t.branch_id"          => $this->session->userdata['loggedin']['branch_id'],

            "t.soc_id"             => $soc_id,

            "t.mill_id"            => $mill_id,

            "kms_year"             => $this->session->userdata['loggedin']['kms_id']

        );

        $data   =  $this->Paddy->f_get_particulars("td_cmr_offered t, md_society s, md_mill md", $select, $where, 0);

        
        echo json_encode($data);

      }

    //CMR offered edit for a particular Mill in the table td_cmr_offered

    public function f_offered_edit() {

        if($_SERVER['REQUEST_METHOD'] == "POST") {

            $data_array = array(

                "trans_dt"      =>  $this->input->post('trans_dt'),                

                "modified_by"   =>  $this->session->userdata['loggedin']['user_name'],

                "modified_dt"   =>  date('Y-m-d h:i:s')

            );

            $where  =   array(

                "trans_no"     =>  $this->input->post('trans_no')

            );

            $this->Paddy->f_edit('td_cmr_offered', $data_array, $where);
            
            //For notification storing message
            $this->session->set_flashdata('msg', 'Successfully edited!');

            redirect('paddys/transactions/f_offered');

        }
        else {

            //Branch Data
            $where      =   array(

                "branch_id" => $this->session->userdata['loggedin']['branch_id']
            );

            //Block List
            $cmroffered['blocks']  =   $this->Paddy->f_get_particulars("md_block",NULL,$where, 0);

            //CMR offered Details
            $select     =   array("t.*");
    
            $where      =   array(
    
                "t.soc_id = m.sl_no"    => NULL,
                
                "t.trans_no" => $this->input->get('trans_no')

            );

            $cmroffered['cmroffered_dtls']=   $this->Paddy->f_get_particulars("td_cmr_offered t, md_society m", $select, $where, 1);
            
            $this->load->view('post_login/main');

            $this->load->view("cmroffered/edit", $cmroffered);

            $this->load->view('post_login/footer');

        }
        
    }

    //from a Particular Society from table td_received

    public function f_delivered(){

        $where      =   array(

            "mill_id"  => $this->input->get('mill_id'),

            "soc_id"   => $this->input->get('soc_id'),

            "kms_year" => $this->session->userdata['loggedin']['kms_id'],

            "branch_id" => $this->session->userdata['loggedin']['branch_id'],

        );

        $data["receved"] = $this->Paddy->f_get_particulars("td_received", array("ifnull(sum(paddy_qty), 0) sum","Max(trans_dt) as trans_dt"), $where, 1);
        $data["wr_order"] = $this->Paddy->f_get_particulars("td_cmr_offered", array("ifnull(sum(milled), 0) sums"), $where, 1);

        echo json_encode($data);

    }

    //Rice Type: Par Boiled, Raw Rice  //Retrive Rice Type md_parameters 

    public function f_ricetype(){

        $where      =   array(

            "sl_no"  => ($this->input->get('type') == 'P')? 18 : 19,

        );

        $data = $this->Paddy->f_get_particulars("md_parameters", array("param_value"), $where, 1);

        echo $data->param_value;

    }

     //Cmr Offered delete
    public function f_offered_delete() {


        $where = array(
            
            "trans_no"    =>  $this->input->get('sl_no')
            
        );

        $this->Paddy->f_delete('td_cmr_offered', $where);
       

        $this->session->set_flashdata('msg', 'Successfully Deleted!');

        redirect("paddys/transactions/f_offered");

    }

    /*********************For CMR DO Isseue Screen********************/
    #Mill isseus there milled paddy to the DO
   
    public function f_doisseued() {
        
        //District List
        $doisseued['dist']          =   $this->Paddy->f_get_particulars("md_district", NULL, NULL, 0);

        //Retriving CMR doisseued Details
        $select     =   array(

            "t.trans_dt", "t.trans_no", "t.dist","t.do_number","t.created_by","t.modified_by",

            "m.soc_name", "md.mill_name", "t.tot_doisseued"

        );

        $where      =   array(

            "t.soc_id = m.sl_no"        => NULL,

            "t.mill_id = md.sl_no"      => NULL,

            "t.branch_id"               => $this->session->userdata['loggedin']['branch_id'],

            "t.kms_year"                => $this->session->userdata['loggedin']['kms_id']

        );

        $doisseued['doisseued_dtls']    =   $this->Paddy->f_get_particulars("td_do_isseued t, md_society m, md_mill md", $select, $where, 0);      


        $this->load->view('post_login/main');

        $this->load->view("doisseued/dashboard", $doisseued);

        $this->load->view('search/search');

        $this->load->view('post_login/footer');
        
    }

    //New CMR quantity isseued by DO for a particular Mill in the table td_do_isseued
    public function f_doisseued_add() {

        if($_SERVER['REQUEST_METHOD'] == "POST") {

            $data_array = array(

                "trans_dt"      =>  $this->input->post('trans_dt'),                

                "kms_year"      =>  $this->session->userdata['loggedin']['kms_id'],

                "branch_id"     => $this->session->userdata['loggedin']['branch_id'],

                "block_id"      =>  $this->input->post('block'),

                "dist"          =>  $this->input->post('dist'),

                "soc_id"        =>  $this->input->post('soc_name'),

                "mill_id"       =>  $this->input->post('mill_name'),

                "tot_cmr_offered" => $this->input->post('tot_cmr_offered'),

                "do_number"     => $this->input->post('do_number'),

                "goodown_name"  => $this->input->post('goodown_name'),

                "inter_dist"    =>  $this->input->post('inter_dist'),

                "rm_gd_dist"    =>  $this->input->post('rm_gd_dist'),
 
                "rice_type"     => $this->input->post('rice_type'),

                "sp"            =>  $this->input->post('sp'),

                "cp"            =>  $this->input->post('cp'),

                "fci"           =>  $this->input->post('fci'),

                "tot_doisseued"   =>  $this->input->post('tot_do_issue'),

                "do_yet_to_be_issued" =>  $this->input->post('do_yet_to_be_issued'),

                "created_by"    =>  $this->session->userdata['loggedin']['user_name'],

                "created_dt"    =>  date('Y-m-d h:i:s')

            );

            $query = $this->db->get_where('td_do_isseued', array('do_number' => $this->input->post('do_number'),'branch_id' => $this->session->userdata['loggedin']['branch_id'],'kms_year' =>  $this->session->userdata['loggedin']['kms_id']))->num_rows();
            
            if($query > 0){

            $this->session->set_flashdata('alert', 'Do Number Already Exist!');

            redirect('transactions/doisseued');

            }else{

            $this->Paddy->f_insert('td_do_isseued', $data_array);
            $this->session->set_flashdata('msg', 'Successfully added!');
            redirect('transactions/doisseued');

            }

        }
        else {

            $where      =   array(

                "branch_id" => $this->session->userdata['loggedin']['branch_id']
            );

            //Block List
            $doisseued['blocks']  =   $this->Paddy->f_get_particulars("md_block",NULL,$where, 0);

            //District List
            $doisseued['dist']    =   $this->Paddy->f_get_particulars("md_district", NULL, NULL, 0);

            $this->load->view('post_login/main');

            $this->load->view("doisseued/add", $doisseued);

            $this->load->view('post_login/footer');

        }
        
    }

    //Edit CMR quantity isseued by DO for a particular Mill in the table td_do_isseued   

    public function f_doisseued_edit() {

        if($_SERVER['REQUEST_METHOD'] == "POST") {

            $data_array = array(
                
                "trans_dt"      =>  $this->input->post('trans_dt'),                

                "dist"          =>  $this->input->post('dist'),

                "inter_dist"    =>  $this->input->post('inter_dist'),

                "rm_gd_dist"    =>  $this->input->post('rm_gd_dist'),

                "modified_by"   =>  $this->session->userdata['loggedin']['user_name'],

                "modified_dt"   =>  date('Y-m-d h:i:s')

            );

            $where  =   array(

                "trans_no"     =>  $this->input->post('trans_no')

            );

            $this->Paddy->f_edit('td_do_isseued', $data_array, $where);

            //For notification storing message
            $this->session->set_flashdata('msg', 'Successfully edited!');

            redirect('paddys/transactions/f_doisseued');

        }
        else {

            $wheress      =   array(

                "branch_id" => $this->session->userdata['loggedin']['branch_id']
            );

            //Block List
            $doisseued['blocks']  =   $this->Paddy->f_get_particulars("md_block",NULL,$wheress, 0);

            //District List
            $doisseued['dist']          =   $this->Paddy->f_get_particulars("md_district", NULL, NULL, 0);

            //CMR doisseued Details
            $select     =   array("t.*", "m.block",);
    
            $where      =   array(
    
                "t.soc_id = m.sl_no"    => NULL,
                
                "t.trans_no" => $this->input->get('trans_no')

            );

            $doisseued['doisseued_dtls']=   $this->Paddy->f_get_particulars("td_do_isseued t, md_society m", $select, $where, 1);
            
            $this->load->view('post_login/main');

            $this->load->view("doisseued/edit", $doisseued);

            $this->load->view('post_login/footer');

        }
        
    }

    //Total CMR Offered from a particular mill from table td_cmr_offered

    public function f_totoffer(){

        $select     =   array(
            
            "ifnull(sum(cmr_offered_now), 0) tot","MIN(trans_dt) as trans_dt",
            "MIN(rice_type) as rice_type"
        
        );

        $where      =   array(

            "branch_id" => $this->session->userdata['loggedin']['branch_id'],
            
            "mill_id"  => $this->input->get('mill_id'),

            "soc_id"   => $this->input->get('soc_id'),

            "kms_year" => $this->session->userdata['loggedin']['kms_id'],

            "1 GROUP BY mill_id" => NULL
        );

        $data = $this->Paddy->f_get_particulars("td_cmr_offered", $select, $where, 1);

        echo json_encode($data);   

    }

    
    //Total DO Issued from a particular mill from table td_cmr_offered

    public function f_added_doissue(){

        $select     =   array(
            
            "ifnull(sum(tot_doisseued), 0) tot"
        
        );

        $where      =   array(

            "branch_id" => $this->session->userdata['loggedin']['branch_id'],
            
            "mill_id"  => $this->input->get('mill_id'),

            "soc_id"   => $this->input->get('soc_id'),

            "kms_year" => $this->session->userdata['loggedin']['kms_id']

        );

        $data = $this->Paddy->f_get_particulars("td_do_isseued", $select, $where, 1);

        echo json_encode($data);   

    }

    //DOISSUE delete
    public function f_doissue_delete() {


        $where = array(
            
            "trans_no"    =>  $this->input->get('sl_no')
            
        );

        $this->Paddy->f_delete('td_do_isseued', $where);
       

        $this->session->set_flashdata('msg', 'Successfully Deleted!');

        redirect("paddys/transactions/f_doisseued");

    }

    /*********************For Paddy CMR delivery Screen********************/
    #CMR Delivery to the Govt. Godown
    //Retriving List of date wise deliveries for all mill for a particlular KMS Year from the table td_cmr_delivery
    public function f_delivery() {
        
        //District List
        $cmrdelivery['dist']          =   $this->Paddy->f_get_particulars("md_district", NULL, NULL, 0);

        //Retriving CMR delivery Details
        $select     =   array(

            "t.trans_dt", "t.trans_no", "t.dist", "t.do_number","t.created_by", "t.modified_by",

            "m.soc_name", "md.mill_name", "t.tot_delivery","t.delivery_dt"

        );

        $where      =   array(

            "t.soc_id = m.sl_no"        => NULL,

            "t.mill_id = md.sl_no"      => NULL,

            "t.branch_id"               => $this->session->userdata['loggedin']['branch_id'],

            "t.kms_year"                => $this->session->userdata['loggedin']['kms_id']

        );

        $cmrdelivery['cmrdelivery_dtls']    =   $this->Paddy->f_get_particulars("td_cmr_delivery t, md_society m, md_mill md", $select, $where, 0);

        //Counting CMR deliverys District wise
        unset($select);
        unset($where);

        $select     =   array(

            "dist", "COUNT(*) count"

        );

        $where      =   array(

            "1 GROUP BY dist"     => NULL

        );

        $cmrdelivery['dist_dtls']     =   $this->Paddy->f_get_particulars("td_cmr_delivery", $select, $where, 0);        

        $this->load->view('post_login/main');

        $this->load->view("cmrdelivery/dashboard", $cmrdelivery);

        $this->load->view('search/search');

        $this->load->view('post_login/footer');
        
    }
      

    //New CMR quantity delivered to the govt. godown for a particular mill in the table td_cmr_delivery
    public function f_delivery_add() {

        if($_SERVER['REQUEST_METHOD'] == "POST") {

            $data_array = array(

                "trans_dt"      =>  $this->input->post('trans_dt'),                

                "kms_year"      =>  $this->session->userdata['loggedin']['kms_id'],

                "branch_id"     =>  $this->session->userdata['loggedin']['branch_id'],

                "block"         =>  $this->input->post('block'),

                "soc_id"        =>  $this->input->post('soc_name'),

                "mill_id"       =>  $this->input->post('mill_name'),

                "do_number"     =>  $this->input->post('do_number'),

                "cmr_type"     =>  $this->input->post('rice_types'),

                "dist"          =>  $this->input->post('dist'),

                "delivery_dt"   =>  $this->input->post('delivery_dt'),

                "goodown_name"  =>  $this->input->post('goodown_name'),

                "inter_dist"    =>  $this->input->post('inter_dist'),

                "rm_gd_dist"    =>  $this->input->post('rm_gd_dist'),

                "sp"            =>  $this->input->post('state_pool'),

                "cp"            =>  $this->input->post('central_pool'),

                "fci"           =>  $this->input->post('fci'),

                "tot_delivery"  =>  $this->input->post('tot_cmr_delivery'),

                "cmr_yet_to_be_delivery_as_do_number"  =>  $this->input->post('cmr_yet_to_be_delivery_as_do_number'),

                "created_by"    =>  $this->session->userdata['loggedin']['user_name'],

                "created_dt"    =>  date('Y-m-d h:i:s')

            );


            $this->Paddy->f_insert('td_cmr_delivery', $data_array);

            //For notification storing message
            $this->session->set_flashdata('msg', 'Successfully added!');

            redirect('paddys/transactions/f_delivery');

        }
        else {

            $wheress      =   array(

                "branch_id" => $this->session->userdata['loggedin']['branch_id']
            );

            //Block List
            $cmrdelivery['blocks']  =   $this->Paddy->f_get_particulars("md_block",NULL,$wheress, 0);

            //District List
            $cmrdelivery['dist']          =   $this->Paddy->f_get_particulars("md_district", NULL, NULL, 0);

            $this->load->view('post_login/main');

            $this->load->view("cmrdelivery/add", $cmrdelivery);

            $this->load->view('post_login/footer');

        }
        
    }

    public function offer_print(){

            $trans_dt   =   $this->input->get('trans_dt');

            $trans_no   =   $this->input->get('trans_no');

           $cmrdelivery['dist']   =  $this->Paddy->f_get_particulars("md_district", NULL, NULL, 0);

            //CMR delivery Details
            $select     =   array(

                "t.*", "m.soc_name","s.mill_name"
                
            );
    
            $where      =   array(
    
                "t.soc_id = m.sl_no"    => NULL,

                "t.mill_id = s.sl_no"    => NULL,

                "t.trans_dt" => $this->input->get('trans_dt'),
                
                "t.trans_no" => $this->input->get('trans_no')

            );

            $cmrdelivery['cmrdelivery_dtls']=   $this->Paddy->f_get_particulars("td_cmr_offered t, md_society m,md_mill s", $select, $where, 1);

            $select =   array(
                "count(*)delivery"
            );

            $where  =   array(

                "kms_year"      =>   $cmrdelivery['cmrdelivery_dtls']->kms_year,

                "soc_id"        =>  $cmrdelivery['cmrdelivery_dtls']->soc_id,

                "mill_id"       =>  $cmrdelivery['cmrdelivery_dtls']->mill_id,

                "tot_delivery"  =>  $cmrdelivery['cmrdelivery_dtls']->cmr_offered_now,

            );

          
            $cmrdelivery['delivered'] =   $this->Paddy->f_get_particulars("td_cmr_delivery" , $select, $where, 1);

            if($cmrdelivery['delivered']->delivery > 0){

                $select =   array(
                    "tot_delivery"
                );
    
                $where  =   array(
    
                    "kms_year"      =>   $cmrdelivery['cmrdelivery_dtls']->kms_year,
    
                    "soc_id"        =>  $cmrdelivery['cmrdelivery_dtls']->soc_id,
    
                    "mill_id"       =>  $cmrdelivery['cmrdelivery_dtls']->mill_id,
    
                    "tot_delivery"  =>  $cmrdelivery['cmrdelivery_dtls']->cmr_offered_now,
    
                );


                $cmrdelivery['tot_delivery'] =   $this->Paddy->f_get_particulars("td_cmr_delivery" , $select, $where, 1);

            }else{

                $cmrdelivery['tot_delivery'] =   $this->Paddy->f_get_particulars("td_cmr_delivery" , $select, $where, 1);

                $cmrdelivery['tot_delivery']->tot_delivery = 0;
            }
            
            $this->load->view('post_login/main');

            $this->load->view("cmrdelivery/print.php",$cmrdelivery);

            $this->load->view('post_login/footer');
    }

    //Edit CMR quantity delivered to the govt. godown for a particular mill in the table td_cmr_delivery    
    public function f_delivery_edit() {

        if($_SERVER['REQUEST_METHOD'] == "POST") {

            $data_array = array(
                
                "trans_dt"      =>  $this->input->post('trans_dts'),

                "dist"          =>  $this->input->post('dist'),               

                "rm_gd_dist"    =>  $this->input->post('rm_gd_dist'), 

                "inter_dist"    =>  $this->input->post('inter_dist'), 

                "modified_by"   =>  $this->session->userdata['loggedin']['user_name'],

                "modified_dt"   =>  date('Y-m-d h:i:s')

            );
  
            $where  =   array(

                "trans_no"     =>  $this->input->post('trans_no')
            );

            $this->Paddy->f_edit('td_cmr_delivery', $data_array, $where);

           
            //For notification storing message
            $this->session->set_flashdata('msg', 'Successfully edited!');

            redirect('paddys/transactions/f_delivery');


        }
        else {

            //District List
            $cmrdelivery['dist']   =  $this->Paddy->f_get_particulars("md_district", NULL, NULL, 0);

            //CMR delivery Details
            $select     =   array(

                "t.*", "m.block"
                
            );
    
            $where      =   array(
    
                "t.soc_id = m.sl_no"    => NULL,
                
                "t.trans_no" => $this->input->get('trans_no')

            );

            $cmrdelivery['cmrdelivery_dtls']=   $this->Paddy->f_get_particulars("td_cmr_delivery t, md_society m", $select, $where, 1);
            
            $this->load->view('post_login/main');

            $this->load->view("cmrdelivery/edit", $cmrdelivery);

            $this->load->view('post_login/footer');

        }
        
    }

    // Get Do Number For Particular Society and Mills
    public function getdonumber(){

        $select     =   array("do_number");

        $where      =   array(

            "soc_id"    => $this->input->post("soc_id"),

            "mill_id"   => $this->input->post("mill_id"),

            "kms_year"  => $this->session->userdata['loggedin']['kms_id'],
 
            "branch_id" => $this->session->userdata['loggedin']['branch_id']
        );
        

        $data= $this->Paddy->f_get_particulars("td_do_isseued", $select, $where, 0);

        echo json_encode($data);

    }
    
    //Total CMR isseued from a particular mill from table td_do_isseued
    public function f_totisseued(){

        $select     =   array(
            
            "ifnull(sp, 0) sp",
            "ifnull(cp, 0) cp", 
            "ifnull(fci, 0) fci",
            "ifnull(tot_doisseued, 0) tot","rice_type","inter_dist","rm_gd_dist",
            "dist","goodown_name"
        );

        $where      =   array(

            "mill_id"   => $this->input->get('mill_id'),

            "soc_id"    => $this->input->get('soc_id'),

            "do_number"    => $this->input->get('do_number'),

            "kms_year"  => $this->session->userdata['loggedin']['kms_id'],
 
            "branch_id" => $this->session->userdata['loggedin']['branch_id']

        );

        $data = $this->Paddy->f_get_particulars("td_do_isseued", $select, $where, 1);

        echo json_encode($data);   

    }
     //Total CMR Delivered from a particular Do Number
     public function progressive_cmr_delivery(){

        $select     =   array(
            
            "ifnull(sum(tot_delivery), 0) tot"
        
        );

        $where      =   array(

            "kms_year" => $this->session->userdata['loggedin']['kms_id'],

            "branch_id" => $this->session->userdata['loggedin']['branch_id'],
            
            "mill_id"  => $this->input->get('mill_id'),

            "soc_id"   => $this->input->get('soc_id'),

            "do_number" => $this->input->get('do_number'),
            
        );

        $data = $this->Paddy->f_get_particulars("td_cmr_delivery", $select, $where, 1);

        echo json_encode($data);   

    }

     //DOISSUE delete
     public function f_delivery_delete() {


        $where = array(
            
            "trans_no"    =>  $this->input->get('sl_no')
            
        );

        $this->Paddy->f_delete('td_cmr_delivery', $where);
       

        $this->session->set_flashdata('msg', 'Successfully Deleted!');

        redirect("paddys/transactions/f_delivery");

    }

    /*********************For Paddy WQSM Screen********************/
    
    public function f_wqsc() {
        
        //District List
        /*$wqsc['dist']          =   $this->Paddy->f_get_particulars("md_district", NULL, NULL, 0);

       
        $select     =   array(

             "t.*","md.mill_name"
        );

        $where      =   array(

            "t.mill_id = md.sl_no"     => NULL,
            "t.branch_id"              => $this->session->userdata['loggedin']['branch_id'],
            "t.kms_id"                 => $this->session->userdata['loggedin']['kms_id']

        );*/

        $wqsc['wqsc_dtls']    =   $this->Paddy->get_wqsc_dtls($this->session->userdata['loggedin']['branch_id'],$this->session->userdata['loggedin']['kms_id']);
       
        //echo $this->db->last_query();die;


        $this->load->view('post_login/main');

        $this->load->view("wqsc/dashboard", $wqsc);

        $this->load->view('search/search');

        $this->load->view('post_login/footer');
        
    }

    public function f_mills(){

        $where      =   array(

            "block" => $this->input->post('block'),
         );

        $data = $this->Paddy->f_get_particulars("md_mill",NULL, $where, 0);

        echo json_encode($data);  
    }

    public function rice_rate(){

          $type = $this->input->get('rice_type');
       

         if($type == "P"){
               $rice_type = "P";
           }elseif($type == "R"){
                 $rice_type = "R";
           }

         $where      =   array(

            "kms_id" => $this->session->userdata['loggedin']['kms_id'],
            "rice_type" => $rice_type
         );

        $data = $this->Paddy->f_get_particulars("md_rice_rate",NULL, $where, 1);

        echo json_encode($data);  
   
    }


    //New CMR quantity delivered to the govt. godown for a particular mill in the table td_cmr_delivery
    public function f_wqsc_add() {

        if($_SERVER['REQUEST_METHOD'] == "POST") {

        $row = $this->db->get_where('td_wqsc', array('wqsc_no =' => $this->input->post('wqsc_no'),'soc_name =' => $this->input->post('soc_name'),'mill_id =' => $this->input->post('mill_name')))->num_rows();

        if($row == 0){
     
            $data_array = array(           

                "kms_id"          =>  $this->session->userdata['loggedin']['kms_id'],

                "branch_id"       =>  $this->session->userdata['loggedin']['branch_id'],

                "wqsc_no"         =>  $this->input->post('wqsc_no'),

                "wqsc_date"       =>  $this->input->post('wqsc_date'),

                "rice_mill_qc_no"=>  $this->input->post('rice_mill_qc_no'),

                "pool"           =>  $this->input->post('pool'),

                "goodown_name"   =>  $this->input->post('goodown_name'),

                "goodown_dist"   =>  $this->input->post('goodown_dist'),

                "block"          =>  $this->input->post('block'),

                "soc_name"       =>  $this->input->post('soc_name'),

                "mill_id"        =>  $this->input->post('mill_name'),

                "memo_no"        =>  $this->input->post('memo_no'),

                "memo_dt"        =>  $this->input->post('memo_dt'),

                "rice_type"      =>  $this->input->post('rice_type'),

                "remarks"        =>  $this->input->post('remarks'),

                "created_by"    =>  $this->session->userdata['loggedin']['user_name'],

                "created_dt"    =>  date('Y-m-d')

            );
             $where      =   array( "sl_no"  => ($this->input->post('rice_type') == 'P')? 18 : 19);

             $data = $this->Paddy->f_get_particulars("md_parameters", array("param_value"), $where, 1);

             $rate = $data->param_value;

            $this->Paddy->f_insert('td_wqsc', $data_array);
            $lastid = $this->db->insert_id();

                $count = count($this->input->post('sub_wqsc'));

             for($i= 0 ;$i< $count ;$i++)
             {

                    $paddy_qty =  ((100*$this->input->post('quantity')[$i])/$rate);
        

            $data = array(           

                "wqsc_no"          =>  $this->input->post('wqsc_no'),

                "sub_wqsc"         =>  $this->input->post('sub_wqsc')[$i],

                "trans_dt"         =>  $this->input->post('wqsc_date'),

                "trans_id"         =>  $lastid,

                "no_gunny"         =>  $this->input->post('no_gunny')[$i],
              
                "quantity"         =>  $this->input->post('quantity')[$i],

                "paddy_qty"        =>  $paddy_qty,

                "moisture_extra"   =>  $this->input->post('moisture_extra')[$i],

                "moisture_ext_amt" =>  $this->input->post('moisture_ext_amt')[$i],

                "avg_wt_empty_gunny" =>  $this->input->post('avg_wt_empty_gunny')[$i],

                "gunny_cut"        =>  $this->input->post('gunny_cut')[$i],

                "tot_price"        =>  $this->input->post('tot_price')[$i],

            );

            $this->Paddy->f_insert('td_wqsc_dtls', $data);

            $paddy_qty = 0;

            }

            //For notification storing message
            $this->session->set_flashdata('msg', 'Successfully added!');

            redirect('paddys/transactions/f_wqsc');

           }else{

                 //For notification storing message
                $this->session->set_flashdata('msg', 'WQSC/CS No Already Exist!');

                redirect('paddys/transactions/f_wqsc');

           }

        }
        else {

            $wheress      =   array(

                "branch_id" => $this->session->userdata['loggedin']['branch_id']
            );

            //Block List
            $wqsc['blocks']  =   $this->Paddy->f_get_particulars("md_block",NULL,$wheress, 0);

            //District List
            $wqsc['dist']          =   $this->Paddy->f_get_particulars("md_district", NULL, NULL, 0);

            $this->load->view('post_login/main');

            $this->load->view("wqsc/add", $wqsc);

            $this->load->view('post_login/footer');

        }
        
    }

    // *******  Code For wqsc Edit Section    **** //// 

    public function wqsc_edit() {

        if($_SERVER['REQUEST_METHOD'] == "POST") {

            $data_array = array(

                "wqsc_date"         =>  $this->input->post('wqsc_date'),

                "rice_mill_qc_no"   =>  $this->input->post('rice_mill_qc_no'),
            
                "remarks"           =>  $this->input->post('remarks')

            );

            $where  =   array(

                "id"     =>  $this->input->post('trans_no')
            );

            $this->Paddy->f_edit('td_wqsc', $data_array, $where);


            //  $this->Paddy->f_delete('td_wqsc', $whered);
             $count = count($this->input->post('sub_wqsc'));
           

             for($i= 0 ;$i< $count ;$i++)
             {

            $data = array(           

                "trans_dt"         =>  $this->input->post('wqsc_date'),

                "no_gunny"         =>  $this->input->post('no_gunny')[$i],
              
                "quantity"         =>  $this->input->post('quantity')[$i],

                "moisture_extra"   =>  $this->input->post('moisture_extra')[$i],

                "moisture_ext_amt" =>  $this->input->post('moisture_ext_amt')[$i],

                "avg_wt_empty_gunny"=>  $this->input->post('avg_wt_empty_gunny')[$i],

                "gunny_cut"        =>  $this->input->post('gunny_cut')[$i],

                "tot_price"        =>  $this->input->post('tot_price')[$i],

            );


             $wheres  =   array(

                "wqsc_no"     =>  $this->input->post('wqsc_noss'),

                "trans_id"    =>  $this->input->post('trans_no'),

                "sub_wqsc"    =>  $this->input->post('sub_wqsc')[$i],
            );

            $this->Paddy->f_edit('td_wqsc_dtls',$data,$wheres);

            }


            //For notification storing message
            $this->session->set_flashdata('msg', 'Successfully edited!');

            redirect('paddys/transactions/f_wqsc');

        }
        else {

            //District List
            $wqsc['dist']   =  $this->Paddy->f_get_particulars("md_district", NULL, NULL, 0);

            $where      =   array(
                
                "id" => $this->input->get('trans_no')

            );

            $wheredl    =   array(

              //  "wqsc_no"  => $this->input->get('wqsc_no'),
                "trans_id" => $this->input->get('trans_no')

            );

            $wheres      =   array(
                
                "branch_id" => $this->session->userdata['loggedin']['branch_id']

            );
            $wqsc['blocks']      =  $this->Paddy->f_get_particulars("md_block",NULL,$wheres, 0); 
            $wqsc['wqsc_dtls']    =  $this->Paddy->f_get_particulars("td_wqsc",NULL,$where, 1);
           
            $wqsc['wqsc_dtlss']   =  $this->Paddy->f_get_particulars("td_wqsc_dtls",NULL,$wheredl, 0);

           
            $this->load->view('post_login/main');

            $this->load->view("wqsc/edit", $wqsc);

            $this->load->view('post_login/footer');

        }
        
    }

    ///  ***  Code for deleting wqsc   *** ///// 

    public function f_wqsc_delete(){

        $where = array(
            
            "id"    =>  $this->input->get('sl_no')
        );

        $wheres = array(
            
            "trans_id"    =>  $this->input->get('sl_no')
            
        );

        $this->Paddy->f_delete('td_wqsc', $where);
        $this->Paddy->f_delete('td_wqsc_dtls',$wheres);

        $this->session->set_flashdata('msg', 'Successfully Deleted!');

        redirect("paddys/transactions/f_wqsc");


    }


    //// **** Code For total cmr Delivery   ***** //////

    public function total_cmr_delivery(){

        $select     =   array(
            
            "ifnull(t.tot_doisseued, 0) tot","t.trans_dt","t.rice_type","r.rate","goodown_name","dist","sp","cp","fci"
        
        );

        $where      =   array(

            "t.rice_type = r.rice_type"  => NULL,

            "t.kms_year = r.kms_id"  => NULL,

            "t.kms_year" => $this->session->userdata['loggedin']['kms_id'],

            "t.branch_id" => $this->session->userdata['loggedin']['branch_id'],            

            "t.do_number" => $this->input->post('do_number')
            
        );

        $data = $this->Paddy->f_get_particulars("td_do_isseued t,md_rice_rate r", $select, $where, 1);
       
        echo json_encode($data);   

    }

    public function f_yescheque() {
         
        $kms_id = $this->session->userdata['loggedin']['kms_id'];
                 //District List
        $yescheque['dist']     =   $this->Paddy->f_get_particulars("md_district", NULL, NULL, 0);

        $yescheque['cheque_status']     =   $this->Paddy->f_get_total_cheque_uploaded($kms_id);

        $this->load->view('post_login/main');

        $this->load->view("cheque_reconcil/dashboard",$yescheque);

        $this->load->view('search/search');

        $this->load->view('post_login/footer');
        
    }

    public function f_cheque_upload() {

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
            if(!empty($_FILES['f_cheque_detail']['name']) && in_array($_FILES['f_cheque_detail']['type'],$csvMimes)){
                       
                $csvFile = fopen($_FILES['f_cheque_detail']['tmp_name'], 'r');

              

                            $j=0;
                    
                    while(($line = fgetcsv($csvFile)) !== FALSE){
                    
                    $data = array(

                        'dist_id'           =>  $this->input->post('dist_id'),
                        'trans_dt'          =>  date("Y-m-d",strtotime($line[0])),
                        'trans_description' =>  $line[2],
                        'reference_no'      =>  str_pad($line[3],6,"0",STR_PAD_LEFT),
                        'amount'            =>  $line[4],
                        'kms_id'            =>  $this->session->userdata['loggedin']['kms_id'],
                        "created_by"        =>  $this->session->userdata['loggedin']['user_name'],
                        "created_dt"        =>  date('Y-m-d')
                        );
                     
            
                     if(/*$query->num_rows() == 0  &&*/ strlen($line[3]) <= "6" && $line[3] != "0")
                                {   
                                   $id=$this->Paddy->f_insert('td_reconciliation_yes', $data);

                                        if(isset($id)){

                                                $j++;
                                        }   
                                }
                }  
                    
                fclose($csvFile);

            }

             //For notification storing message
            $this->session->set_flashdata('msg', $j.' Record Successfully added!');

            redirect('paddys/transactions/f_yescheque');

        }
        else {
           
            //District List
            $cheque_upload['dist']    =   $this->Paddy->f_get_particulars("md_district", NULL, NULL, 0);

            $this->load->view('post_login/main');

            $this->load->view("cheque_reconcil/add_upload", $cheque_upload);

            $this->load->view('post_login/footer');
        }
        
    }

    public function f_singlecheque(){


        if($_SERVER['REQUEST_METHOD']=='POST'){

            $kms_id     = $this->session->userdata['loggedin']['kms_id'];

            $cheque_no  = $this->input->post('cheque_no');   

            $chequedetails['cheque_dtls']  =  $this->Paddy->f_get_cheque($cheque_no,$kms_id);

         
            $this->load->view('post_login/main');

            $this->load->view("reports/cheque_detail/singlechequedetail.php",$chequedetails);

            $this->load->view('post_login/footer');


        }else{
          
            $this->load->view('post_login/main');

            $this->load->view("reports/cheque_detail/singlechequedetail.php");

            $this->load->view('post_login/footer');
        }

    }
    
    public function get_sig_cheque(){

            $kms_id     = $this->session->userdata['loggedin']['kms_id'];

            $cheque_no  = $this->input->post('old_chq_no');   

            $cheque_dtls  =  $this->Paddy->get_cheque($cheque_no,$kms_id);

          echo json_encode($cheque_dtls);
    }

    //*************** Start Screen For Reissue Cheque  ***************//

    public function f_reissuchq() {
        

        $branch_id  = $this->session->userdata['loggedin']['branch_id'];
        $kms_id     = $this->session->userdata['loggedin']['kms_id'];

        $paddycollection['paddycollection_dtls']   = $this->Paddy->f_get_reissuecollection($this->session->userdata['loggedin']['branch_id'],$this->session->userdata['loggedin']['kms_id']);   

        $this->load->view('post_login/main');

        $this->load->view("reissue_cheque/dashboard", $paddycollection);

        $this->load->view('search/search');

        $this->load->view('post_login/footer');
        
    }

    //New CMR quantity isseued by DO for a particular Mill in the table td_do_isseued
    public function f_reissuechq_add() {

        if($_SERVER['REQUEST_METHOD'] == "POST") {

         $this->form_validation->set_rules('reg_no', 'Registration Number', 'required');

                if ($this->form_validation->run() == FALSE)
                {
                    $this->session->set_flashdata('msg', 'Something Went Wrong!');
                   redirect('paddys/transactions/f_reissuchq');
       
               }else{

               $issue_id = $this->Paddy->f_get_particulars("td_reissue_chq",array("ifnull(MAX(issue_id),0) issue_id"),array('branch_id' => $this->session->userdata['loggedin']['branch_id'],'issue_dt' => $this->input->post('issue_dt')), 1)->issue_id;

              $bulk_s_id = $this->Paddy->f_get_particulars("td_collections",array("MAX(bulk_trans_id) bulk_trans_id"),array('branch_id' => $this->session->userdata['loggedin']['branch_id'],'kms_id' => $this->session->userdata['loggedin']['kms_id']), 1);

               $bulk_trs_id= $bulk_s_id->bulk_trans_id;

              $data_array = array(

                "kms_id"       =>  $this->session->userdata['loggedin']['kms_id'],

                "branch_id"    => $this->session->userdata['loggedin']['branch_id'],

                "issue_dt"     =>  $this->input->post('issue_dt'),

                "issue_id"     =>  $issue_id+1,

                "trans_type"   => "N",

                "old_chq_no"   =>  $this->input->post('old_chq_no'),                

                "old_chq_bnk"  =>  $this->input->post('old_chq_bnk'),

                "proc_date"    =>  $this->input->post('oldchq_date'),

                "reg_no"       =>  $this->input->post('reg_no'),

                "new_chq_no"   =>  $bulk_trs_id+1,

                "bank_id"      =>  $this->input->post('bnk'),

                "qty"          =>  $this->input->post('qty'),

                "amt"          =>  $this->input->post('amt'),

                "created_by"   =>  $this->session->userdata['loggedin']['user_name'],

                "created_dt"   =>  date('Y-m-d')

              );

              $data_arrays = array(

                "trans_type"      =>  "N",
                "bank_sl_no"      =>  $this->input->post('bnk'),
                "bulk_trans_id"   =>  $bulk_trs_id+1,
                "chq_status"      =>  "U",
                "ifsc_code"       =>  $this->input->post('ifsc_code'),
                "acc_no"          =>  $this->input->post('account_no'),
                "book_no"         =>  $this->input->post('book_no')+1,
                "cheque_no"       =>  "NULL",
                "cheque_date"     =>  "NULL",
                "dwn_flag"        =>  "0",
                "status"          =>  "0",
                "ho_status"       =>  "1"
            );

               $where = array(

                "kms_id"       =>  $this->session->userdata['loggedin']['kms_id'],

                "branch_id"    => $this->session->userdata['loggedin']['branch_id'],

                "cheque_no"    =>  $this->input->post('old_chq_no'),                

                "bank_sl_no"   =>  $this->input->post('old_chq_bnk'),

                "trans_id"     =>  $this->input->post('trans_id'),

                "reg_no"       =>  $this->input->post('reg_no')
              );

                $this->Paddy->f_edit('td_collections', $data_arrays, $where);
               

                $this->session->set_flashdata('msg', 'Successfully added!');
                redirect('paddys/transactions/f_reissuchq');

              }

        }
        else {
            $kms_id     = $this->session->userdata['loggedin']['kms_id'];
            $data=explode ("/", $this->input->get('soc_id'));
            $soc_id        = $data["0"];
            $trans_dt      = $data["1"];
            $trans_id      = $data["2"];
            $bulk_trans_id = $data["3"];

             $data["cheque_dtl"]   = $this->Paddy->get_chequedtls($soc_id,$trans_dt,$trans_id,$bulk_trans_id,$kms_id);
           

            $this->load->view('post_login/main');

            $this->load->view("reissue_cheque/edit",$data);

            $this->load->view('post_login/footer');

        }
        
    }

    public function f_get_chequedtls(){

        if($_SERVER['REQUEST_METHOD']=='POST'){

            $kms_id     = $this->session->userdata['loggedin']['kms_id'];
           
            $cheque_no  = $this->input->post('old_chq_no');   

            $data['cheque_dtls']  =  $this->Paddy->get_cheque($cheque_no,$kms_id);

            $this->load->view('post_login/main');
            $this->load->view("reissue_cheque/add",$data);
            $this->load->view('post_login/footer');

        }else{

            $this->load->view('post_login/main');
            $this->load->view("reissue_cheque/add");
            $this->load->view('post_login/footer');
        }
    }
    public function f_cheque_issue_Excel(){

       $issue_dt = $this->uri->segment(4);
       $bank_id = $this->uri->segment(5);
      // $bulk_trans_id = $this->uri->segment(6);
     

        $this->load->library('excel');

            $object = new PHPExcel();
            $object->setActiveSheetIndex(0);
            
            $employee_data   =  $this->Paddy->f_farmdet_new_cheque($issue_dt,$bank_id);

            //$bank_data       =  $this->Paddy->f_farmer_bank_detail($soc_id,$trans_dt,$bulk_trans_id);

            $debit_bank_data = $this->Paddy->f_debit_bank_detail($this->session->userdata['loggedin']['branch_id'],$bank_id);
            
           // $update        =  $this->Paddy->f_farmer_dwn_flag($soc_id,$trans_dt,$bulk_trans_id);


         if($bank_id == "1"){ 
            
               $table_columns = array("Issuance Date", "Account Number","Short Account Number",
                                  "Cheque Number","Payee Name","Amount",
                                  "MICR Code","Transaction Code");
                $column = 0;

                foreach($table_columns as $field)
                {
                $object->getActiveSheet()->setCellValueByColumnAndRow($column, 1, $field);
                $column++;
                }

                $excel_row = 2;

                foreach($employee_data as $row)
                {
                $object->getActiveSheet()->setCellValueByColumnAndRow(0, $excel_row, $row->trans_dt."T00:00:00.0");
                $object->getActiveSheet()->setCellValueByColumnAndRow(1, $excel_row, $row->acc_no);
                $object->getActiveSheet()->setCellValueByColumnAndRow(2, $excel_row, $row->short_code);
                $object->getActiveSheet()->setCellValueByColumnAndRow(3, $excel_row, $row->cheque_no);
                $object->getActiveSheet()->setCellValueByColumnAndRow(4, $excel_row, $row->farm_name);
                $object->getActiveSheet()->setCellValueByColumnAndRow(5, $excel_row, $row->amount);
                $object->getActiveSheet()->setCellValueByColumnAndRow(6, $excel_row, $row->micr_code);
                $object->getActiveSheet()->setCellValueByColumnAndRow(7, $excel_row, $row->trans_code);
                
                $excel_row++;
                }

                $object_writer = PHPExcel_IOFactory::createWriter($object, 'Excel5');
                $filename=$this->session->userdata['loggedin']['dist_sort_code'].'_Yes_Bank';
                header('Content-Type: application/vnd.ms-excel');
                header('Content-Disposition: attachment;filename="'.$filename.'.xls"');

                $object_writer->save('php://output');
            }elseif($bank_id == "2"){

                $table_columns = array("Date of Camp", "Farmer Name","Registration No.",
                "Bank Name","IFSC CODE","A/C NO","PADDY QTY","AMOUNT");
                $column = 0;

                foreach($table_columns as $field)
                {
                $object->getActiveSheet()->setCellValueByColumnAndRow($column, 1, $field);
                $column++;
                }

                $excel_row = 2;

                foreach($employee_data as $row)
                {
                $object->getActiveSheet()->setCellValueByColumnAndRow(0, $excel_row, $row->trans_dt);
                $object->getActiveSheet()->setCellValueByColumnAndRow(1, $excel_row, $row->farm_name);
                $object->getActiveSheet()->setCellValueByColumnAndRow(2, $excel_row, $row->reg_no);
                $object->getActiveSheet()->setCellValueByColumnAndRow(3, $excel_row, "Bandhan Bank");
                $object->getActiveSheet()->setCellValueByColumnAndRow(4, $excel_row, $row->ifs);
                $object->getActiveSheet()->setCellValueByColumnAndRow(5, $excel_row, $row->acc_no);
                $object->getActiveSheet()->setCellValueByColumnAndRow(6, $excel_row, $row->quantity);
                $object->getActiveSheet()->setCellValueByColumnAndRow(7, $excel_row, $row->amount);

                $excel_row++;
                }


                $object_writer = PHPExcel_IOFactory::createWriter($object, 'Excel5');
                $filename=$this->session->userdata['loggedin']['dist_sort_code'].'_Bandhan_Bank';
                header('Content-Type: application/vnd.ms-excel');
                header('Content-Disposition: attachment;filename="'.$filename.'.xls"');

                $object_writer->save('php://output');
            }
            elseif($bank_id == "3"){

                $table_columns = array("Date","Procurement Centre",
                "Name of the Beneficiary","Pay to","Registration No",
                "ACCOUNT NO","IFS CODE","Cheque No","Cheque Date (DD/MM/YYYY)","Quantity"
                ,"Amount in Figure","Amount in Word","Remarks");

                $column = 0;

                foreach($table_columns as $field)
                {
                $object->getActiveSheet()->setCellValueByColumnAndRow($column, 1, $field);
                $column++;
                }

                $excel_row = 2;

                foreach($employee_data as $row)
                {
                $pay = $row->farm_name;
                $payaccount = $row->faccount;

                $pay_to = $pay.' (A/c-'.$payaccount.')';
                $object->getActiveSheet()->setCellValueByColumnAndRow(0, $excel_row, date('d/m/Y',strtotime($row->trans_dt)));
               
                $object->getActiveSheet()->setCellValueByColumnAndRow(1, $excel_row, $row->soc_id);
                $object->getActiveSheet()->setCellValueByColumnAndRow(2, $excel_row, $row->farm_name);
                $object->getActiveSheet()->setCellValueByColumnAndRow(3, $excel_row, $pay_to);
                $object->getActiveSheet()->setCellValueByColumnAndRow(4, $excel_row, $row->reg_no);
                $object->getActiveSheet()->setCellValueByColumnAndRow(5, $excel_row, $row->faccount);
                $object->getActiveSheet()->setCellValueByColumnAndRow(6, $excel_row, $row->fifsc);
                $object->getActiveSheet()->setCellValueByColumnAndRow(7, $excel_row, "");
                $object->getActiveSheet()->setCellValueByColumnAndRow(8, $excel_row, date('d/m/Y',strtotime($row->cheque_dt)));
                $object->getActiveSheet()->setCellValueByColumnAndRow(9, $excel_row, $row->quantity);
                $object->getActiveSheet()->setCellValueByColumnAndRow(10, $excel_row, $row->amount);
                $object->getActiveSheet()->setCellValueByColumnAndRow(11, $excel_row, getIndianCurrency($row->amount));
                $object->getActiveSheet()->setCellValueByColumnAndRow(12, $excel_row, "");

                $excel_row++;
                }

                $object_writer = PHPExcel_IOFactory::createWriter($object, 'Excel5');
                $filename=$this->session->userdata['loggedin']['dist_sort_code'].'_Icici_Bank';
                header('Content-Type: application/vnd.ms-excel');
                header('Content-Disposition: attachment;filename="'.$filename.'.xls"');

                $object_writer->save('php://output');
            }
            else{

                $table_columns = array("Payment Method Name","Payment Amount",
                "Activation Date","Beneficiary Name","Account No","Debit Account No","CRN No","Remarks","Phone No ","Print Branch","Cheque Date",
                "Code","Procurement Centre","Registration","EPIC Number","Quantity"
                ,"Cheque number","Amount in word","IFSC code");

                $column = 0;
 
                foreach($table_columns as $field)
                {
                $object->getActiveSheet()->setCellValueByColumnAndRow($column, 1, $field);
                $column++;
                }
                $excel_row = 2;

                foreach($employee_data as $row)
                {
                $pay = $row->farm_name;
                $payaccount = $row->faccount;

                $pay_to = $pay.' (A/c-'.$payaccount.')';
                $object->getActiveSheet()->setCellValueByColumnAndRow(0, $excel_row, "C");
                $object->getActiveSheet()->setCellValueByColumnAndRow(1, $excel_row, $row->amount);
                $object->getActiveSheet()->setCellValueByColumnAndRow(2, $excel_row, date('d-m-Y',strtotime($row->trans_dt)));
                $object->getActiveSheet()->setCellValueByColumnAndRow(3, $excel_row, $pay);
                $object->getActiveSheet()->setCellValueByColumnAndRow(4, $excel_row, $payaccount); 
                $object->getActiveSheet()->setCellValueByColumnAndRow(5, $excel_row, $debit_bank_data->acc_no);
                $object->getActiveSheet()->setCellValueByColumnAndRow(6, $excel_row, $row->reg_no);
                $object->getActiveSheet()->setCellValueByColumnAndRow(7, $excel_row, "");
                $object->getActiveSheet()->setCellValueByColumnAndRow(8, $excel_row, $row->mobile_number);
                $object->getActiveSheet()->setCellValueByColumnAndRow(9, $excel_row, $debit_bank_data->branch);
                $object->getActiveSheet()->setCellValueByColumnAndRow(10, $excel_row, date('d-m-Y',strtotime($row->cheque_dt)));
                $object->getActiveSheet()->setCellValueByColumnAndRow(11, $excel_row, $debit_bank_data->sol_id);
                $object->getActiveSheet()->setCellValueByColumnAndRow(12, $excel_row, $row->soc_name);
                $object->getActiveSheet()->setCellValueByColumnAndRow(13, $excel_row, "");
                $object->getActiveSheet()->setCellValueByColumnAndRow(14, $excel_row, "");
                $object->getActiveSheet()->setCellValueByColumnAndRow(15, $excel_row, $row->quantity);
                $object->getActiveSheet()->setCellValueByColumnAndRow(16, $excel_row, "");
                $object->getActiveSheet()->setCellValueByColumnAndRow(17, $excel_row, getIndianCurrency($row->amount));
                $object->getActiveSheet()->setCellValueByColumnAndRow(18, $excel_row, $row->fifsc);

                $excel_row++;
                }

                $object_writer = PHPExcel_IOFactory::createWriter($object, 'Excel5');
                $filename=$this->session->userdata['loggedin']['dist_sort_code'].'_Axis_Bank';
                header('Content-Type: application/vnd.ms-excel');
                header('Content-Disposition: attachment;filename="'.$filename.'.csv"');

                $object_writer->save('php://output');
            }        
    }

    public function f_neft_reconcil() {
         
        $kms_id = $this->session->userdata['loggedin']['kms_id'];
                 //District List
        $yescheque['dist']     =   $this->Paddy->f_get_particulars("md_district", NULL, NULL, 0);

        $yescheque['cheque_status']     =   $this->Paddy->f_get_total_cheque_uploaded($kms_id);

        

        $this->load->view('post_login/main');

        $this->load->view("neft_reconcil/dashboard",$yescheque);

        $this->load->view('search/search');

        $this->load->view('post_login/footer');
        
    }

    public function f_neft_upload() {

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
            if(!empty($_FILES['f_neft_detail']['name']) && in_array($_FILES['f_neft_detail']['type'],$csvMimes)){
                       
                $csvFile = fopen($_FILES['f_neft_detail']['tmp_name'], 'r');

                            $j=0;
                    
                    while(($line = fgetcsv($csvFile)) !== FALSE){
                    
            $data = array(

            'sequence_no'                    => $line[1],
            'transaction_ref'                => $line[2],
            'amount'                         => $line[3],
            'value_date'                     => $this->input->post('value_date'),
            'sending_branch_ifsc'            => $line[5],
            'sender_ac_type'                 => $line[6],
            "sender_ac_no"                   => $line[7],
            "sender_ac_name"                 => $line[8],
            'benf_branch'                    => $line[9],
            'benf_ac_type'                   => $line[10],
            'benf_ac_no'                     => $line[11],
            'benf_ac_name'                   => $line[12],
            'txn_status'                     => $line[13],
            'originator_of_remittance'       => $line[14],
            "sender_to_receiver_information" => $line[15],
            "reason"                         => $line[16],
            'remarks'                        => $line[17],
            "uploaded_by"                    => $this->session->userdata['loggedin']['user_name'],
            "uploaded_dt"                    =>  date('Y-m-d')

                  
                                );

            
                            // if(strlen($line[3]) <= "6" && $line[3] != "0")
                            //     {   
                            $id=$this->Paddy->f_insert('td_neft_reconciliation', $data);

                                    if(isset($id)){

                                           $j++;
                                     }   
                                // }
                }  
                    
                fclose($csvFile);

            }

             //For notification storing message
            $this->session->set_flashdata('msg', $j.' Record Successfully added!');

            redirect('paddys/transactions/f_neft_reconcil');

        }
        else {
           
            //District List
            $cheque_upload['dist']    =   $this->Paddy->f_get_particulars("md_district", NULL, NULL, 0);

            $this->load->view('post_login/main');

            $this->load->view("neft_reconcil/add_upload", $cheque_upload);

            $this->load->view('post_login/footer');
        }
        
    }
    // Created Date 27/05/2020 Reissue Neft//

    public function f_neftdtls(){

        if($_SERVER['REQUEST_METHOD']=='POST'){

            $kms_id      = $this->session->userdata['loggedin']['kms_id'];
           
            $soc_name    = $this->input->post('soc_name'); 
            $bank_sl_no  = $this->input->post('bank_sl_no');   

            $data['cheque_dtls']  =  $this->Paddy->get_neft($kms_id,$soc_name);

            $this->load->view('post_login/main');
            $this->load->view("reissue_neft/add",$data);
            $this->load->view('post_login/footer');


        }else{

             $where =  array(
                "branch_id" => $this->session->userdata['loggedin']['branch_id']);
           
            //Block List
            $data['blocks'] = $this->Paddy->f_get_particulars("md_block",NULL,$where, 0);

            $this->load->view('post_login/main');
            $this->load->view("reissue_neft/add",$data);
            $this->load->view('post_login/footer');
        }
    }
    public function f_reissueneft_add() {

        if($_SERVER['REQUEST_METHOD'] == "POST") {

         $this->form_validation->set_rules('reg_no', 'Registration Number', 'required');

            if ($this->form_validation->run() == FALSE)
                {
                    $this->session->set_flashdata('msg', 'Something Went Wrong!');
                   redirect('paddys/transactions/failneft');
       
               }else{

               $issue_id = $this->Paddy->f_get_particulars("td_reissue_chq",array("ifnull(MAX(issue_id),0) issue_id"),array('branch_id' => $this->session->userdata['loggedin']['branch_id'],'issue_dt' => $this->input->post('issue_dt')), 1)->issue_id;

              $bulk_s_id = $this->Paddy->f_get_particulars("td_collections",array("MAX(bulk_trans_id) bulk_trans_id"),array('branch_id' => $this->session->userdata['loggedin']['branch_id'],'kms_id' => $this->session->userdata['loggedin']['kms_id']), 1);

               $bulk_trs_id= $bulk_s_id->bulk_trans_id;

              $data_array = array(

                "kms_id"       =>  $this->session->userdata['loggedin']['kms_id'],

                "branch_id"    => $this->session->userdata['loggedin']['branch_id'],

                "issue_dt"     =>  $this->input->post('issue_dt'),

                "issue_id"     =>  $issue_id+1,

                "trans_type"   => "N",

                "old_chq_no"   =>  $this->input->post('old_chq_no'),                

                "old_chq_bnk"  =>  $this->input->post('old_chq_bnk'),

                "proc_date"    =>  $this->input->post('oldchq_date'),

                "reg_no"       =>  $this->input->post('reg_no'),

                "new_chq_no"   =>  $bulk_trs_id+1,

                "bank_id"      =>  $this->input->post('bnk'),

                "qty"          =>  $this->input->post('qty'),

                "amt"          =>  $this->input->post('amt'),

                "created_by"   =>  $this->session->userdata['loggedin']['user_name'],

                "created_dt"   =>  date('Y-m-d')

              );

              $data_arrays = array(

                "trans_type"      =>  "N",
                "bank_sl_no"      =>  $this->input->post('bnk'),
                "bulk_trans_id"   =>  $bulk_trs_id+1,
                "chq_status"      =>  "U",
                "ifsc_code"       =>  $this->input->post('ifsc_code'),
                "acc_no"          =>  $this->input->post('account_no'),
                "cheque_no"       =>  "NULL",
                "cheque_date"     =>  "NULL",
                "dwn_flag"        =>  "0",
                "status"          =>  "0",
                "ho_status"       =>  "0"
            );

               $where = array(

                "kms_id"       =>  $this->session->userdata['loggedin']['kms_id'],

                "branch_id"    => $this->session->userdata['loggedin']['branch_id'],

                "cheque_no"    =>  $this->input->post('old_chq_no'),                

                "bank_sl_no"   =>  $this->input->post('old_chq_bnk'),

                "trans_id"   =>  $this->input->post('trans_id'),

                "reg_no"        =>  $this->input->post('reg_no')
              );

                $this->Paddy->f_insert('td_reissue_chq', $data_array);

                $this->Paddy->f_edit('td_collections', $data_arrays, $where);

                $this->session->set_flashdata('msg', 'Successfully added!');
                redirect('paddys/transactions/f_paddycollection');

              }

        }
        else {
            $kms_id        = $this->session->userdata['loggedin']['kms_id'];
            $data          =explode("/", $this->input->get('soc_id'));
            $soc_id        = $data["0"];
            $trans_dt      = $data["1"];
            $trans_id      = $data["2"];
            $bulk_trans_id = $data["3"];

            $data["cheque_dtl"]   = $this->Paddy->get_chequedtls($soc_id,$trans_dt,$trans_id,$bulk_trans_id,$kms_id);

            $this->load->view('post_login/main');

            $this->load->view("reissue_neft/edit",$data);

            $this->load->view('post_login/footer');

        }
        
    }

    // Developed on 28/05/2020   //
    public function failneft() {

        $paddycollection['paddycollection_dtls']   = $this->Paddy->f_failneft($this->session->userdata['loggedin']['branch_id'],$this->session->userdata['loggedin']['kms_id']); 
        
        $this->load->view('post_login/main');

        $this->load->view("reissue_neft/dashboard", $paddycollection);
        
        $this->load->view('search/search');

        $this->load->view('post_login/footer');
        
    }
    // Developed on 05/01/2021  By Lokesh kumar Jha //
    public function failnefts() {

        $paddycollection['paddycollection_dtls']   = $this->Paddy->f_failnefts($this->session->userdata['loggedin']['branch_id'],$this->session->userdata['loggedin']['kms_id']); 
        
        $this->load->view('post_login/main');

        $this->load->view("reissue_neft/dashboards", $paddycollection);
        
        $this->load->view('search/search');

        $this->load->view('post_login/footer');
        
    }

    public function reissue_neft() {

        if($_SERVER['REQUEST_METHOD'] == "POST") {
              
            $editdata      = explode ("/",$this->input->post('editdata'));
            $soc_id        = $editdata["0"];
            $trans_dt      = $editdata["1"];
            $bulk_trans_id = $editdata["2"];

            $reg_no      = $this->input->post('reg_no');
            $trans_dt    = $this->input->post('trans_dt');
            $count       = count($this->input->post('reg_no'));
            $ifsc_code   = $this->input->post('ifsc_code');
            $acc_no      = $this->input->post('acc_no');

                   
              $bulk_s_id = $this->Paddy->f_get_particulars("td_collections",array("MAX(bulk_trans_id) bulk_trans_id"),array('branch_id' => $this->session->userdata['loggedin']['branch_id'],'kms_id' => $this->session->userdata['loggedin']['kms_id']), 1);

               $bulk_trs_id= $bulk_s_id->bulk_trans_id;              

            $i=0;  
           for($i=0; $i<$count; $i++){
           

                $data_arrays = array(
             
                "bulk_trans_id"   =>  $bulk_trs_id+1,
                "chq_status"      =>  "R",
                "ifsc_code"       =>  $ifsc_code[$i],
                "acc_no"          =>  $acc_no[$i],
                "dwn_flag"        =>  "0",
                "status"          =>  "0",
                     

                 );
             
            $where = array(

                "reg_no"     => $reg_no[$i],
                "soc_id"     => $soc_id,
                "trans_dt"   => $trans_dt,
                "chq_status" => 'R'

            );

                $this->Paddy->f_edit('td_collections',$data_arrays, $where);

                
            }   
           
           $this->session->set_flashdata('msg', 'Successfully added!');
           redirect('paddys/transactions/failneft');
        }
        else {

            $data=explode ("/", $this->input->get('soc_id'));
            $soc_id = $data["0"];
            $trans_dt = $data["1"];
            $bulk_trans_id = $data["2"];

            $select     =   array(

                  "t.*", "s.soc_name soc_name", "b.block_name block_name"
            );

            $where      =   array(

                "t.soc_id = s.sl_no"    => NULL,

                "t.block_id = b.blockcode"    => NULL,

                "t.soc_id"        =>$soc_id,

                "t.bulk_trans_id" =>$bulk_trans_id,

                "t.trans_dt"      =>$trans_dt,

                "t.chq_status"    =>'R',

            );
         
   
           $paddycollection['farmer_dtls'] =   $this->Paddy->f_get_particulars('td_collections t,md_society s,md_block b',$select,$where, 0);
       
           $wheres      =   array(
            "branch_id" => $this->session->userdata['loggedin']['branch_id']
             );

            //Block List
            $paddycollection['blocks']  =   $this->Paddy->f_get_particulars("md_block",NULL,$wheres, 0);

            $this->load->view('post_login/main');

            $this->load->view("reissue_neft/add_neft_data", $paddycollection);

            $this->load->view('post_login/footer');

        }
        
    }
     public function reissue_nefts() {

        if($_SERVER['REQUEST_METHOD'] == "POST") {
              
            $editdata        = explode ("/",$this->input->post('editdata'));
            $soc_id          = $editdata["0"];
            $trans_dt        = $editdata["1"];
            $bulk_trans_id   = $editdata["2"];


            $reg_no      = $this->input->post('reg_no');
            $trans_dt    = $this->input->post('trans_dt');
            $count       = count($this->input->post('reg_no'));
            $ifsc_code   = $this->input->post('ifsc_code');
            $acc_no      = $this->input->post('acc_no');

                   
              $bulk_s_id = $this->Paddy->f_get_particulars("td_collections",array("MAX(bulk_trans_id) bulk_trans_id"),array('branch_id' => $this->session->userdata['loggedin']['branch_id'],'kms_id' => $this->session->userdata['loggedin']['kms_id']), 1);

               $bulk_trs_id = ($bulk_s_id->bulk_trans_id) + 1; 

              $forward_bulk_trans_id     = $this->input->post('forward_bulk_trans_id');

               $for_temp_id               = explode("_",$forward_bulk_trans_id);

               $new_forward_bulk_trans_id = $for_temp_id[0].'_'.$for_temp_id[1].'_'.$bulk_trs_id;
     

            $i=0;  
           for($i=0; $i<$count; $i++){


              $book_no = $this->db->get_Where('td_collections', array('reg_no'=>$reg_no[$i],'soc_id'=>$soc_id,'trans_dt'=>$trans_dt))->row()->book_no;
              

                $data_arrays = array(

                "bank_sl_no"            =>  $this->input->post('bank_sl_no'),
                "bulk_trans_id"         =>  $bulk_trs_id,
                "forward_bulk_trans_id" =>  $new_forward_bulk_trans_id,
                "chq_status"            =>  "R",
                "ifsc_code"             =>  $ifsc_code[$i],
                "acc_no"                =>  $acc_no[$i],
                "dwn_flag"              =>  "0",
                "status"                =>  "0",
                "book_no"               =>  $book_no + 1,
                "modified_by"           =>  $this->session->userdata['loggedin']['user_name'],
                "modified_dt"           =>   date('Y-m-d')
                );

             
            $where = array(

                "reg_no"     => $reg_no[$i],
                "soc_id"     => $soc_id,
                "trans_dt"   => $trans_dt,
                "chq_status" => 'R'

            );

                $this->Paddy->f_edit('td_collections',$data_arrays, $where);

                
            }   
           
           $this->session->set_flashdata('msg', 'Successfully added!');
           redirect('paddys/transactions/failnefts');
        }
        else {

            $data=explode ("/", $this->input->get('soc_id'));
            $soc_id        = $data["0"];
            $trans_dt      = $data["1"];
            $bulk_trans_id = $data["2"];

            $select     =   array(

                  "t.*", "s.soc_name soc_name", "b.block_name block_name"
            );

            $where      =   array(

                "t.soc_id = s.sl_no"    => NULL,

                "t.block_id = b.blockcode"    => NULL,

                "t.soc_id"        =>$soc_id,

                "t.bulk_trans_id" =>$bulk_trans_id,

                "t.trans_dt"      =>$trans_dt,

                "t.chq_status"    =>'R',

            );
         
   
           $paddycollection['farmer_dtls'] =   $this->Paddy->f_get_particulars('td_collections t,md_society s,md_block b',$select,$where, 0);
       
           $wheres      =   array(
            "branch_id" => $this->session->userdata['loggedin']['branch_id']
             );
            $paddycollection['banks']  =   $this->Paddy->f_get_particulars("md_paddy_bank",NULL,NULL, 0);
            //Block List
            $paddycollection['blocks']  =   $this->Paddy->f_get_particulars("md_block",NULL,$wheres, 0);

            $this->load->view('post_login/main');

            $this->load->view("reissue_neft/add_neft_datas", $paddycollection);

            $this->load->view('post_login/footer');

        }
        
    }
    public function f_neft_forward() {

        $data=explode ("/", $this->input->get('soc_id'));
        $soc_id = $data["0"];
        $trans_dt = $data["1"];
        $bulk_trans_id = $data["2"];
        $valid=0;
        $data  = $this->Paddy->f_ifsccode($trans_dt,$bulk_trans_id,$soc_id);
        $datas = $this->Paddy->f_transcheck($trans_dt,$bulk_trans_id,$soc_id);
       foreach( $data as $value ) {
                  
                 if(strlen($value->ifsc_code)=="11"){
                    $valid = $valid+0;
                 }else{
                    $valid = $valid+1;
                 }
        }

        if($datas == '0'){


           if($valid=='0' ){
            $this->Paddy->f_forward_neft($trans_dt,$bulk_trans_id,$soc_id);
            echo "<script>
                alert('Procurement data forwarded successfully');
                window.location.href='failneft';
                </script>";

           }else{

            echo "<script>
                alert('Procurement data Not forwarded Some Problem In IFSC CODE');
                window.location.href='failneft';
                </script>";
             }

        }else{
               echo "<script>
                alert('Procurement data Not forwarded Some Problem In File Uploading');
                window.location.href='failneft';
                </script>";
        }
     

   
    }

    public function f_neft_forwards() {

        $data=explode ("/", $this->input->get('soc_id'));
        $soc_id = $data["0"];
        $trans_dt = $data["1"];
        $bulk_trans_id = $data["2"];
        $valid=0;
        $data  = $this->Paddy->f_ifsccode($trans_dt,$bulk_trans_id,$soc_id);
        $datas = $this->Paddy->f_transcheck($trans_dt,$bulk_trans_id,$soc_id);
       foreach( $data as $value ) {
                  
                 if(strlen($value->ifsc_code)=="11"){
                    $valid = $valid+0;
                 }else{
                    $valid = $valid+1;
                 }
        }

        if($datas == '0'){


           if($valid=='0' ){
            $this->Paddy->f_forward_nefts($trans_dt,$bulk_trans_id,$soc_id);
            echo "<script>
                alert('Procurement data forwarded successfully');
                window.location.href='failnefts';
                </script>";

           }else{

            echo "<script>
                alert('Procurement data Not forwarded Some Problem In IFSC CODE');
                window.location.href='failnefts';
                </script>";
             }

        }else{
               echo "<script>
                alert('Procurement data Not forwarded Some Problem In File Uploading');
                window.location.href='failnefts';
                </script>";
        }
     

   
    }

}    