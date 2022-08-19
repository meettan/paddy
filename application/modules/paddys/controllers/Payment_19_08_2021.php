<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Payment extends MX_Controller {

    public function __construct(){

        parent::__construct();

        $this->load->model('Paddyrep');
        $this->load->model('Paddy');
        $this->load->helper('paddyrate');
        
        //For User's Authentication
        if(!isset($this->session->userdata['loggedin']['user_id'])){
            
            redirect('User_Login/login');

        }
        
    }

    /*********************For Payment requisition********************/
    public function f_requisition(){

        $select    = array("a.*","b.soc_name","c.mill_name","d.wqsc_no wqsc");
    
        $where      =   array(

                "a.soc_id  = b.society_code"  => NULL,
                "a.mill_id = c.sl_no"  => NULL,
                "a.wqsc_no = d.id"  => NULL,
                "a.kms_id"     => $this->session->userdata['loggedin']['kms_id'],
                "a.branch_id"  => $this->session->userdata['loggedin']['branch_id'],
                "d.kms_id"     => $this->session->userdata['loggedin']['kms_id']
        );

        $data['payment_dtls']    =   $this->Paddy->f_get_particulars("td_fund_requisition a,md_society b,md_mill c,td_wqsc d",$select,$where, 0);

        $this->load->view('post_login/main');

        $this->load->view("fund_requisition/dashboard", $data);

        //$this->load->view('search/search');

        $this->load->view('post_login/footer');
        
    }

    public function f_requisitionho(){

        if($this->session->userdata['loggedin']['user_id']=="bholanathm" || $this->session->userdata['loggedin']['user_id'] =="barund"){

        $select    = array("a.*","b.soc_name","c.mill_name","d.wqsc_no wqsc");
    
        $where     =   array(
                "a.soc_id  = b.society_code"  => NULL,
                "a.mill_id = c.sl_no"  => NULL,
                "a.wqsc_no = d.id"  => NULL,
                "a.kms_id"     => $this->session->userdata['loggedin']['kms_id'],
                "d.kms_id"     => $this->session->userdata['loggedin']['kms_id'],
                "a.ho_flag = '1'order by a.req_dt"   => NULL
        );

        $data['payment_dtls']    =   $this->Paddy->f_get_particulars("td_fund_requisition a,md_society b,md_mill c,td_wqsc d",$select,$where, 0);

        $this->load->view('post_login/main');

        $this->load->view("fund_requisition/dashboardho1", $data);

        //$this->load->view('search/search');

        $this->load->view('post_login/footer');

         }else{

             redirect('User_Login/login');
         } 
        
    }
    public function f_requisitionho2(){

        if($this->session->userdata['loggedin']['user_id']=="anirbanc" && $this->session->userdata['loggedin']['ho_flag'] =="Y"){

        $select    = array("a.*","b.soc_name","c.mill_name","d.wqsc_no wqsc");
    
        $where     =   array(
                "a.soc_id  = b.society_code"  => NULL,
                "a.mill_id = c.sl_no"         => NULL,
                "a.wqsc_no = d.id"  => NULL,
                "a.kms_id"          => $this->session->userdata['loggedin']['kms_id'],
                "d.kms_id"          => $this->session->userdata['loggedin']['kms_id'],
                "a.ho_flag"         => "1",
                "a.approve1         = '1' order by a.req_dt"   => NULL
        );


        $data['payment_dtls']    =   $this->Paddy->f_get_particulars("td_fund_requisition a,md_society b,md_mill c,td_wqsc d",$select,$where, 0);

        $this->load->view('post_login/main');

        $this->load->view("fund_requisition/dashboardho2", $data);

        //$this->load->view('search/search');

        $this->load->view('post_login/footer');

        }else{

            redirect('User_Login/login');
        }  
        
    }
    public function f_requisitionho3(){

        if($this->session->userdata['loggedin']['user_id']=="anupamm" && $this->session->userdata['loggedin']['ho_flag'] =="Y"){

        $select    = array("a.*","b.soc_name","c.mill_name","d.wqsc_no wqsc");
    
        $where     =   array(
                "a.soc_id  = b.society_code"  => NULL,
                "a.mill_id = c.sl_no"  => NULL,
                "a.wqsc_no = d.id"     => NULL,
                "a.kms_id"             => $this->session->userdata['loggedin']['kms_id'],
                "d.kms_id"             => $this->session->userdata['loggedin']['kms_id'],
                "a.ho_flag"            => "1",
                "a.approve1"           => "1",
                "a.approve2   ='1' order by a.req_dt"   => NULL
               
        );


        $data['payment_dtls']    =   $this->Paddy->f_get_particulars("td_fund_requisition a,md_society b,md_mill c,td_wqsc d",$select,$where, 0);

        $this->load->view('post_login/main');

        $this->load->view("fund_requisition/dashboardho3", $data);

        //$this->load->view('search/search');

        $this->load->view('post_login/footer');

        }else{

            redirect('User_Login/login');
        }  
        
    }
    public function f_fundallocation(){

        if($this->session->userdata['loggedin']['user_id']=="anirbanc" && $this->session->userdata['loggedin']['ho_flag'] =="Y"){

        $select    = array("a.*","b.soc_name","c.mill_name","d.wqsc_no wqsc");
    
        $where     =   array(
                "a.soc_id  = b.society_code"  => NULL,
                "a.mill_id = c.sl_no"  => NULL,
                "a.wqsc_no = d.id"  => NULL,
                "a.kms_id"     => $this->session->userdata['loggedin']['kms_id'],
                "d.kms_id"     => $this->session->userdata['loggedin']['kms_id'],
                "a.ho_flag"    => "1",
                "a.approve1"   => "1",
                "a.approve2"   => "1",
                "a.approve3    = '1' order by a.req_dt"   => NULL
            );

        $data['payment_dtls']    =   $this->Paddy->f_get_particulars("td_fund_requisition a,md_society b,md_mill c,td_wqsc d",$select,$where, 0);

        $this->load->view('post_login/main');

        $this->load->view("fund_requisition/dash_fund_alloc", $data);

        //$this->load->view('search/search');

        $this->load->view('post_login/footer');

        }else{

            redirect('User_Login/login');
        } 
        
    }

    public function f_fund_allocation() {

        if($this->session->userdata['loggedin']['user_id']=="anirbanc" && $this->session->userdata['loggedin']['ho_flag'] =="Y"){


       
        if($_SERVER['REQUEST_METHOD'] == "POST") {


             $status     = $this->input->post('status');
             $particular = $this->input->post('particulars');
        


            $where = array(

                'req_no' => $this->input->post('req_no')
            );
                foreach($particular as $parti){

                    if (in_array($parti, $status)) {

                                     // echo "exist</br>";

                            }else{

                                 $data_array = array(
                
                                 "payment_flag"    =>  "0"
                
                                 );

                                $wheres = array(

                                        'req_no'       => $this->input->post('req_no'),
                                        'account_type' => $parti
                                );

                                  $this->Paddy->f_edit('td_fund_requisition_dtls', $data_array,$wheres);
                            }
                }

                $data_arrays = array(
    
                    "fund_flag"      =>  "1",

                    "funded_by"      =>  $this->session->userdata['loggedin']['user_name'],
    
                    "funded_dt"      =>  date('Y-m-d h:i:s')

                );
                
               $this->Paddy->f_edit('td_fund_requisition', $data_arrays,$where);

               $this->session->set_flashdata('msg', 'Successfully Updated!');

               redirect('payment/fundallocation');

        }
        else {

            //Bill Master Details
            $payment['bill_master']     =   $this->Paddy->f_get_particulars("md_comm_params", array('sl_no', 'param_name'), NULL, 0);

            $select = array("a.*","b.wqsc_no wqsc","b.memo_no memo_no","b.memo_dt memo_dt","b.goodown_name goodown_name","b.goodown_dist goodown_dist","c.district_name","d.rm_gd_dist");


            $where  =   array(

                "a.wqsc_no = b.id"  => NULL,
                "b.goodown_dist = c.district_code"  => NULL,
                "b.memo_no      = d.do_number"  => NULL,
                "a.req_no"      => base64_decode($this->input->get('req_no')),
                "b.kms_id"      => $this->session->userdata['loggedin']['kms_id'],
                "d.kms_year"    => $this->session->userdata['loggedin']['kms_id']
              
            );

            $wheres  =   array(
              
                "req_no"   => base64_decode($this->input->get('req_no'))
              
            );

            $payment['bill_dtls']  = $this->Paddy->f_get_particulars("td_fund_requisition a,td_wqsc b,md_district c,td_cmr_delivery d",$select,$where,1);          
         
                     
            $payment['charges']    = $this->Paddy->f_get_particulars("td_fund_requisition_dtls",NULL,$wheres, 0);

            unset($where);
            $where      =   array("branch_id"  => $this->session->userdata['loggedin']['branch_id']);
        
            $payment['blocks']        =   $this->Paddy->f_get_particulars("md_block", NULL,NULL, 0);

            $this->load->view('post_login/main');

            $this->load->view("fund_requisition/editfund_allocation", $payment);

            $this->load->view('post_login/footer');

        }

           }else{

            redirect('User_Login/login');
        } 
        
        
    }

    public function tot_paddy_onwqsc() {

        $select =  array("sum(paddy_qty) as tot","ifnull(sum(quantity), 0) as quat");

        $where = array(
                         "trans_id"     => $this->input->post("wqsc")
                        
                        );

        $data  =   $this->Paddy->f_get_particulars("td_wqsc_dtls",$select,$where, 1);

        echo json_encode($data);

    }
    public function check_parti(){

        $wqsc_no       = $this->input->get("wqsc");
        $account_type  = $this->input->get("sl_no");
          
        $data  =   $this->Paddy->checkparticular($wqsc_no,$account_type);

        echo json_encode($data);


    }

    //New Bill Payment Add
    public function f_requisition_add() {

        if($_SERVER['REQUEST_METHOD'] == "POST") {

            $pmt_bill_no = 0;

            $max_trans_no = $this->Paddy->f_get_particulars("td_fund_requisition",array("MAX(sl_no) sl_no"), array('kms_id' => $this->session->userdata['loggedin']['kms_id'],'branch_id' =>$this->session->userdata['loggedin']['branch_id']), 1);

            if($max_trans_no){

                $sl_no = $max_trans_no->sl_no + 1;

            }
            else {

                $sl_no = 1;

            }

                $data_array = array(

                    "req_dt"                =>  $this->input->post('req_dt'),

                    "sl_no"                 =>  $sl_no,
    
                    "req_no"                =>  'REQ'.'/'.$this->session->userdata['loggedin']['dist_sort_code'].'/'.$this->session->userdata['loggedin']['kms_yr'].'/'.$sl_no,

                    "branch_id"             =>  $this->session->userdata['loggedin']['branch_id'],
    
                    "kms_id"                =>  $this->session->userdata['loggedin']['kms_id'],

                    "block_id"              =>  $this->input->post('block'),

                    "soc_id"                =>  $this->input->post('soc_name'),

                    "mill_id"               =>  $this->input->post('mill_name'),

                    "wqsc_no"               =>  $this->input->post('wqsc'),
                   
                    "tot_paddy"             =>  $this->input->post('totPaddy'),
                    
                    "tot_cmr"               =>  $this->input->post('totCmr'),

                    "created_by"            =>  $this->session->userdata['loggedin']['user_name'],
    
                    "created_dt"            =>  date('Y-m-d h:i:s')
    
                );
                
                
                $this->Paddy->f_insert('td_fund_requisition', $data_array);
           

            for($i = 0; $i < count($this->input->post('particulars')); $i++){

                $data_array = array(

                    "req_no"             =>  'REQ'.'/'.$this->session->userdata['loggedin']['dist_sort_code'].'/'.$this->session->userdata['loggedin']['kms_yr'].'/'.$sl_no,
    
                    "trans_dt"           =>  $this->input->post('req_dt'),
    
                    "account_type"       =>  $this->input->post('particulars')[$i],
    
                    "per_unit_rate"      =>  $this->input->post('rate_per_qtls')[$i],

                    "total_amt"          =>  $this->input->post('amounts')[$i],
    
                    "tds_amt"            =>  $this->input->post('tds_amount')[$i],
    
                    "cgst_amt"           =>  $this->input->post('cgst')[$i],

                    "sgst_amt"           =>  $this->input->post('sgst')[$i],

                    "claim_amt"          =>  $this->input->post('claim_amt')[$i],
    
                    "payble_amt"         =>  $this->input->post('paybel')[$i]
    
                );
                
                $this->Paddy->f_insert('td_fund_requisition_dtls', $data_array);

            }

            //For notification storing message
            $this->session->set_flashdata('msg', 'Successfully added!');
            redirect('payment/requisition');

        }
        else {

          $where      =   array(
                "branch_id"  => $this->session->userdata['loggedin']['branch_id']
            );
          $wheres      =   array(
            
                "cat!="  => "H"
            );
                 
            $payment['blocks']        =   $this->Paddy->f_get_particulars("md_block", NULL,$where, 0);
            
            $payment['bill_master']   =   $this->Paddy->f_get_particulars("md_comm_params",array('sl_no', 'param_name'),$wheres, 0);

            $payment['banks']         =   $this->Paddy->f_get_particulars("md_paddy_bank",NULL,NULL, 0);

            $this->load->view('post_login/main');

            $this->load->view("fund_requisition/add", $payment);

            $this->load->view('post_login/footer');

        }
        
    }

     //Bill Payment delete
    public function f_requisition_delete() {

        $where = array(
            
            "req_no"      =>  $this->input->get('sl_no')
            
        );

        $this->Paddy->f_delete('td_fund_requisition', $where);
        $this->Paddy->f_delete('td_fund_requisition_dtls', $where);

        $this->session->set_flashdata('msg', 'Successfully Deleted!');

        redirect("payment/requisition");

    }

    public function f_requisition_forward() {

            $where = array(
            
            "req_no"    => $this->input->get('req_no')
    
            );


            $data_array = array(
    
                    "ho_flag"    =>  '1'   
    
                );
                
            $this->Paddy->f_edit('td_fund_requisition', $data_array,$where);

            //For notification storing message
            $this->session->set_flashdata('msg', 'Successfully Forwarded!');

            redirect('payment/requisition');

    }

    public function f_requisition_edit() {

        if($_SERVER['REQUEST_METHOD'] == "POST") {


            $where = array(

                'req_no' => $this->input->post('req_no')
            );

            $data_array = array(
    
                "req_dt"          =>  $this->input->post('req_dt')

            );
                
            $this->Paddy->f_edit('td_fund_requisition', $data_array,$where);

            $this->session->set_flashdata('msg', 'Successfully Change Status!');

            redirect('payment/requisition');

        }
        else {

            //Bill Master Details
            $payment['bill_master']     =   $this->Paddy->f_get_particulars("md_comm_params", array('sl_no', 'param_name'), NULL, 0);

            //Retriving Bill Payment Details
            $select = array("a.*","b.wqsc_no wqsc");

            $where  =   array(

                "a.wqsc_no = b.id"  => NULL,
                "req_no"   => $this->input->get('req_no')
              
            );

            $wheres  =   array(

              
                "req_no"       => $this->input->get('req_no')
                // "payment_flag" => "1"
              
            );

            $payment['bill_dtls']   = $this->Paddy->f_get_particulars("td_fund_requisition a,td_wqsc b",$select, $where,1); 

                    // echo $this->db->last_query();
                    // die();          
         
            $payment['charges']     = $this->Paddy->f_get_particulars("td_fund_requisition_dtls",NULL,$wheres, 0);

            unset($where);
            $where      =   array("branch_id"  => $this->session->userdata['loggedin']['branch_id']);
        
            $payment['blocks']        =   $this->Paddy->f_get_particulars("md_block", NULL,$where, 0);

            $this->load->view('post_login/main');

            $this->load->view("fund_requisition/edit", $payment);

            $this->load->view('post_login/footer');

        }
        
    }

      //Bill Payment edit
    public function f_requisition_firstapproved() {

        if($_SERVER['REQUEST_METHOD'] == "POST") {

            $where = array(

                'req_no' => $this->input->post('req_no')
            );

            // $pre   = substr($this->input->post('req_no'),4);
            // $sacno = "SANC/".$pre;
        

                $data_array = array(
    
                    "approve1"        =>  $this->input->post('approve_status'),

                    "remark1"         =>  $this->input->post('remark1'),

                    "approve1_by"     =>  $this->session->userdata['loggedin']['user_name'],
    
                    "approve1_dt"     =>  date('Y-m-d h:i:s')
    
                );
                
               $this->Paddy->f_edit('td_fund_requisition', $data_array,$where);

               $this->session->set_flashdata('msg', 'Successfully Updated!');

               redirect('payment/requisitionho');

        }
        else {

            //Bill Master Details
            $payment['bill_master']     =   $this->Paddy->f_get_particulars("md_comm_params", array('sl_no', 'param_name'), NULL, 0);

            $select = array("a.*","b.wqsc_no wqsc","b.memo_no memo_no","b.memo_dt memo_dt","b.goodown_name goodown_name","b.goodown_dist goodown_dist","c.district_name","d.rm_gd_dist");


            $where  =   array(

                "a.wqsc_no = b.id"  => NULL,
                "b.goodown_dist = c.district_code"  => NULL,
                "b.memo_no      = d.do_number"  => NULL,
                "a.req_no"      => base64_decode($this->input->get('req_no')),
                "b.kms_id"      => $this->session->userdata['loggedin']['kms_id'],
                "d.kms_year"    => $this->session->userdata['loggedin']['kms_id']
              
            );

            $wheres  =   array(
              
                "req_no"   => base64_decode($this->input->get('req_no'))
              
            );

            $payment['bill_dtls']  = $this->Paddy->f_get_particulars("td_fund_requisition a,td_wqsc b,md_district c,td_cmr_delivery d",$select,$where,1);           
        
                     
            $payment['charges']    = $this->Paddy->f_get_particulars("td_fund_requisition_dtls",NULL,$wheres, 0);

            unset($where);
            $where                 =   array("branch_id"  => $this->session->userdata['loggedin']['branch_id']);
        
            $payment['blocks']     =   $this->Paddy->f_get_particulars("md_block", NULL,NULL, 0);

            $this->load->view('post_login/main');

            $this->load->view("fund_requisition/editho1", $payment);

            $this->load->view('post_login/footer');

        }
        
    }
    public function f_requisition_secondapproved() {

        if($_SERVER['REQUEST_METHOD'] == "POST") {

            $where = array(

                'req_no' => $this->input->post('req_no')
            );


                $data_array = array(
    
                    "approve2"        =>  $this->input->post('approve_status'),

                    "remark2"         =>  $this->input->post('remark2'),

                    "approve2_by"     =>  $this->session->userdata['loggedin']['user_name'],
    
                    "approve2_dt"     =>  date('Y-m-d h:i:s')

                );
                
               $this->Paddy->f_edit('td_fund_requisition', $data_array,$where);

               $this->session->set_flashdata('msg', 'Successfully Updated!');

               redirect('payment/requisitionho2');

        }
        else {

            //Bill Master Details
            $payment['bill_master']     =   $this->Paddy->f_get_particulars("md_comm_params", array('sl_no', 'param_name'), NULL, 0);

            $select = array("a.*","b.wqsc_no wqsc","b.memo_no memo_no","b.memo_dt memo_dt","b.goodown_name goodown_name","b.goodown_dist goodown_dist","c.district_name","d.rm_gd_dist");


            $where  =   array(

                "a.wqsc_no = b.id"  => NULL,
                "b.goodown_dist = c.district_code"  => NULL,
                "b.memo_no      = d.do_number"  => NULL,
                "a.req_no"      => base64_decode($this->input->get('req_no')),
                "b.kms_id"      => $this->session->userdata['loggedin']['kms_id'],
                "d.kms_year"    => $this->session->userdata['loggedin']['kms_id']
              
            );

            $wheres  =   array(
              
                "req_no"   => base64_decode($this->input->get('req_no'))
              
            );

            $payment['bill_dtls']  = $this->Paddy->f_get_particulars("td_fund_requisition a,td_wqsc b,md_district c,td_cmr_delivery d",$select,$where,1);          
         
                     
            $payment['charges']    = $this->Paddy->f_get_particulars("td_fund_requisition_dtls",NULL,$wheres, 0);

            unset($where);
            $where      =   array("branch_id"  => $this->session->userdata['loggedin']['branch_id']);
        
            $payment['blocks']        =   $this->Paddy->f_get_particulars("md_block", NULL,NULL, 0);

            $this->load->view('post_login/main');

            $this->load->view("fund_requisition/editho2", $payment);

            $this->load->view('post_login/footer');

        }
        
    }
    public function f_requisition_lastapproved() {

        if($_SERVER['REQUEST_METHOD'] == "POST") {

            $where = array(

                'req_no' => $this->input->post('req_no')
            );

            $pre   = substr($this->input->post('req_no'),4);
            $sacno = "SANC/".$pre;
        
            if($this->input->post('approve_status') == "1"){

                $data_array = array(

                    "approve3"       =>  $this->input->post('approve_status'),

                    "sanc_no"        => $sacno,

                    "approve3_by"    =>  $this->session->userdata['loggedin']['user_name'],
    
                    "approve3_dt"    =>  date('Y-m-d h:i:s')
                );

            }else{

                $data_array = array(

                    "approve3"      =>  $this->input->post('approve_status'),
            
                );


            }
               
                
               $this->Paddy->f_edit('td_fund_requisition', $data_array,$where);

               $this->session->set_flashdata('msg', 'Successfully Updated!');

            redirect('payment/requisitionho3');

        }
        else {

            //Bill Master Details
            $payment['bill_master']     =   $this->Paddy->f_get_particulars("md_comm_params", array('sl_no', 'param_name'), NULL, 0);

            $select = array("a.*","b.wqsc_no wqsc");

            $where  =   array(

                "a.wqsc_no = b.id"  => NULL,
                "req_no"   => base64_decode($this->input->get('req_no'))
              
            );

            $wheres  =   array(
              
                "req_no"   => base64_decode($this->input->get('req_no'))
              
            );

            $payment['bill_dtls']  = $this->Paddy->f_get_particulars("td_fund_requisition a,td_wqsc b",$select,$where,1);           
         
                     
            $payment['charges']    = $this->Paddy->f_get_particulars("td_fund_requisition_dtls",NULL,$wheres, 0);

            unset($where);
            $where      =   array("branch_id"  => $this->session->userdata['loggedin']['branch_id']);
        
            $payment['blocks']        =   $this->Paddy->f_get_particulars("md_block", NULL,NULL, 0);

            $this->load->view('post_login/main');

            $this->load->view("fund_requisition/editho3", $payment);

            $this->load->view('post_login/footer');

        }
        
    }
       //   Code Updated on 12/11/2020  ///
    public function sanc_no_list() {

        $where = array(

            "block_id"   => $this->input->post("block_id"),
            "soc_id"     => $this->input->post("soc_id"),
            "mill_id"    => $this->input->post("mill_id"),
            "kms_id"     => $this->session->userdata['loggedin']['kms_id'],
            "ho_flag"    => 1,
            "fund_flag"  => '1',
            "sanc_no!="  => NULL
 
            );

          $sancs   =   $this->Paddy->f_get_particulars("td_fund_requisition",NULL,$where, 0);

          echo json_encode($sancs);

    }
    // ******* Code For Sanction Detail For Society Commission  on Sancation No Developed on 12/11/2020   ******  ///
    public function sanc_no_dtls() {


        $select   = array("a.*","b.param_name","c.wqsc_no");

        $where = array(

            "a.account_type  = b.sl_no"  => NULL,
            "a.req_no"                   => $this->input->post("req_no"),
            "b.cat"                      => "S"
            );

        $sancs   =   $this->Paddy->f_get_particulars("td_fund_requisition_dtls a,md_comm_params b",NULL,$where, 0);

        echo json_encode($sancs);

    }

    public function sanc_no_dtls_for_mill() {


        $select   = array("a.*","b.param_name","b.sl_no","c.wqsc_no");

        $where = array(

            "a.account_type  = b.sl_no"  => NULL,
            "a.req_no"                   => $this->input->post("req_no"),
            "b.cat"                      => "M",
            "a.account_type !="          => "8"
            );

        $sancs   =   $this->Paddy->f_get_particulars("td_fund_requisition_dtls a,md_comm_params b",NULL,$where, 0);

        echo json_encode($sancs);

    }

    // Code Start Getting Tds Rate On payment Date on 10/05/2020   ///

    public function f_tdsrate(){
        

         $charge_head     = $this->input->get('sl_no');
         $effective_date  = $this->input->get('effectdt');
       
        $tds  = $this->Paddy->get_tsd_rate($charge_head,$effective_date);

        echo json_encode($tds);
    }

    /// Code End  Getting Tds Rate On payment Date    ///

    ///*********  Code Written for Total Requisition Amount on 12/11/2020      *******///

    public function tot_requisition_amt() {

        $select   = array("sum(payble_amt) payble_amt");

        $where = array(

            "req_no"        => $this->input->post("req_no"),

            "account_type != 8" => Null

        );

        $sancs   =   $this->Paddy->f_get_particulars("td_fund_requisition_dtls",$select,$where,1);

        echo json_encode($sancs);

    }

    ///*********  Code Written for Total Allocated Amount on 12/11/2020      *******///

    public function tot_allocated_amt() {

        $select   = array("sum(payble_amt) payble_amt");

        $where = array(

            "req_no"        => $this->input->post("req_no"),
            "payment_flag"  => '1',
            "account_type != 8" => Null
            
        );

        $sancs   =   $this->Paddy->f_get_particulars("td_fund_requisition_dtls",$select,$where,1);

        echo json_encode($sancs);

    }


     public function sanc_no_dt() {


        $select   = array("a.*","b.param_name","c.wqsc_no");

        $where = array(

            "a.account_type  = b.sl_no"  => NULL,
            "a.req_no        = c.req_no" => NULL,
            "c.sanc_no"                  => $this->input->post("sanc_no"),
            "b.cat"                      => "S"
            );

        $sancs   =   $this->Paddy->f_get_particulars("td_fund_requisition_dtls a,md_comm_params b,td_fund_requisition c",NULL,$where, 0);

        echo json_encode($sancs);

    }

    public function wqsc_dtls_on_sanc() {

        $select   = array("a.wqsc_no","a.pool","a.rice_type","b.sanc_no");

        $where = array(

            "a.id  = b.wqsc_no"  => NULL,
            "b.req_no"                => $this->input->post("req_no"),
            "b.kms_id"                => $this->session->userdata['loggedin']['kms_id']
            );

        $sancs   =   $this->Paddy->f_get_particulars("td_wqsc a,td_fund_requisition b",$select,$where, 1);

        echo json_encode($sancs);

    }

    public function paddy_qty_on_sanc() {

        $select   = array("sum(c.paddy_qty) paddy_qty","sum(c.quantity) totCmr");


        $where = array(

            "a.wqsc_no  = b.id"        => NULL,
            "b.id       = c.trans_id"  => NULL,
            // "b.wqsc_date  = c.trans_dt"=> NULL,
            "b.wqsc_no  = c.wqsc_no"   => NULL,
            "a.req_no"                 => $this->input->post("req_no"),
            "a.kms_id"                 => $this->session->userdata['loggedin']['kms_id']

            );
       $sancs   =   $this->Paddy->f_get_particulars("td_fund_requisition a,td_wqsc b,td_wqsc_dtls c",$select,$where, 1);

        echo json_encode($sancs);

    }

    public function paddy_qty_on_sanc_new() {

        $select   = array("sum(c.paddy_qty) paddy_qty","sum(c.quantity) totCmr");


        $where = array(

            "a.wqsc_no  = b.id"        => NULL,
            "b.id       = c.trans_id"  => NULL,
            "b.wqsc_date  = c.trans_dt"=> NULL,
            "b.wqsc_no  = c.wqsc_no"   => NULL,
            "a.sanc_no"                 => $this->input->post("sanc_no"),
            "a.kms_id"                 => $this->session->userdata['loggedin']['kms_id']

            );
       $sancs   =   $this->Paddy->f_get_particulars("td_fund_requisition a,td_wqsc b,td_wqsc_dtls c",$select,$where, 1);

        echo json_encode($sancs);

    }


    public function f_commission(){

          $select  = array("c.*","s.soc_name");

          $where      =   array(

                "c.soc_id = s.society_code"  => NULL,

                "c.kms_id" => $this->session->userdata['loggedin']['kms_id'],
                "c.branch_id"  => $this->session->userdata['loggedin']['branch_id']
            
            );


        $commission['commission_dtls']    =   $this->Paddy->f_get_particulars("td_society_commision c,md_society s", NULL, $where, 0);

        $this->load->view('post_login/main');

        $this->load->view("commission/dashboard",$commission);
    
        $this->load->view('search/search');

        $this->load->view('post_login/footer');
        
    }
    public function f_commission_add() {

        if($_SERVER['REQUEST_METHOD'] == "POST") {

        	$count = $this->db->get_where('td_society_commision', array('sanc_no =' => $this->input->post('sanc_nos')))->num_rows();
           if( $count == 0 ){
            $trans_cd = 0;

            $max_trans_no = $this->Paddy->f_get_particulars("td_society_commision", array("MAX(trans_cd) trans_cd"), array('kms_id' => $this->session->userdata['loggedin']['kms_id'],'branch_id' => $this->session->userdata['loggedin']['branch_id']), 1);

            if($max_trans_no){

                $trans_cd = $max_trans_no->trans_cd + 1;

            }
            else {

                $trans_cd = 1;

            }

            $ho_bill_no = $this->session->userdata['loggedin']['dist_sort_code'].'/'.$this->session->userdata['loggedin']['kms_yr'].'/'.$this->input->post('branch_ref_no').'/'.$trans_cd;

                $data_array = array(

                    "trans_dt"            =>  $this->input->post('trans_dt'),

                    "trans_cd"            =>  $trans_cd,
    
                    "kms_id"              =>  $this->session->userdata['loggedin']['kms_id'],
    
                    "branch_id"           =>  $this->session->userdata['loggedin']['branch_id'],

                    "block_id"            =>  $this->input->post('block'),

                    "soc_id"              =>  $this->input->post('soc_name'),

                    "mill_id"             =>  $this->input->post('mill_id'),

                    "aggrement_no"        =>  $this->input->post('aggrement_no'),

                    "wqsc"                =>  $this->input->post('wqsc'),

                    "sanc_no"             =>  $this->input->post('sanc_nos'),
    
                    "branch_ref_no"       =>  $this->input->post('branch_ref_no'),

                    "soc_bill_no"         =>  $this->input->post('soc_bill_no'),
    
                    "soc_bill_date"       =>  $this->input->post('soc_bill_date'),

                    "pool_type"           =>  $this->input->post('pool_type'),

                    "rice_type"           =>  $this->input->post('rice_type'),

                    "rate"                =>  $this->input->post('rate'),
    
                   // "qty"                 =>  $this->input->post('qty'),

                    "amount_claimed"      =>  $this->input->post('claim_amount'),
    
                    "tot_amt"             =>  $this->input->post('paid_amt'),

                    "tds_amt"             =>  $this->input->post('tds_amt'),

                    "paid_amt"            =>  $this->input->post('paid_amt'),

                    "pay_mode"            =>  $this->input->post('pay_mode'),

                    "bank_id"             =>  $this->input->post('bank_id'),
                      
                    "ref_no"              =>  $this->input->post('ref_no'),

                    'ho_bill_no'          =>  $ho_bill_no,

                    "remarks"             =>  $this->input->post('remarks'),
    
                    "created_by"          =>  $this->session->userdata['loggedin']['user_name'],
    
                    "created_dt"          =>  date('Y-m-d')
    
                );




            $this->Paddy->f_insert('td_society_commision', $data_array);

            //For notification storing message
            $this->session->set_flashdata('msg', 'Successfully added!');

            redirect('payment/commission');

            }else{

            	$this->session->set_flashdata('msg', 'Sorry! Payment Done For This Sanction Number');

                redirect('payment/commission');


            }

        }
        else {

            $where      =   array(

                "branch_id" => $this->session->userdata['loggedin']['branch_id']
            );

            $commission['blocks']       =   $this->Paddy->f_get_particulars("md_block", NULL,$where, 0);
            //Bill Master Details
            $commission['bill_master']  =   $this->Paddy->f_get_particulars("md_comm_params", array('sl_no', 'param_name'), NULL, 0);

            $commission['banks']        =   $this->Paddy->f_get_particulars("md_paddy_bank",NULL,NULL, 0);

            $this->load->view('post_login/main');

            $this->load->view("commission/add", $commission);

            $this->load->view('post_login/footer');

        }
        
    }

    public function f_get_aggrementno(){

          $mill_id = $_GET["mill_id"];
          $soc_id = $_GET["soc_id"];

          $select   =  array("reg_no");
          $selects  =  array("IFNULL(SUM(paddy_qty), 0) paddy_qty");
          $elects   =  array("IFNULL(SUM(qty), 0) qty");

          $where      =   array(

                "kms_id" => $this->session->userdata['loggedin']['kms_id'],
                "mill_id"  => $mill_id,
                "soc_id"   => $soc_id
            );
           $wheres    =   array(

                "kms_year" => $this->session->userdata['loggedin']['kms_id'],
                "mill_id"  => $mill_id,
                "soc_id"   => $soc_id
            );

        $aggrem["reg_no"]  = $this->Paddy->f_get_particulars("md_soc_mill",$select,$where,1);

        $aggrem["paddy_qty"]  = $this->Paddy->f_get_particulars("td_received",$selects,$wheres,1);

        $aggrem["qty"]  = $this->Paddy->f_get_particulars("td_society_commision",$elects,$where,1);
        
        echo json_encode($aggrem);

    }

    public function f_commision_rate(){


        $rice_type = $_GET["rice_type"];

         $select     =   array("rate");

          $where      =   array(

                "kms_id" => $this->session->userdata['loggedin']['kms_id'],
                "rice_type"   => $rice_type
            );

        $rate  = $this->Paddy->f_get_particulars("md_soc_commision_rate",$select,$where,1);
        
        echo json_encode($rate);


    }


    public function f_commission_edit(){

        if($_SERVER['REQUEST_METHOD'] == "POST") {

              //Bill Details
            $data = (explode("/",$this->input->post('trans_cd')));

            $where  =   array(

                "trans_cd"   => $data["0"],
                "branch_id"  => $data["1"],
                "kms_id"     => $data["2"]
            );

                $data_array = array(

                    "trans_dt"            =>  $this->input->post('trans_dt'),

                    "soc_bill_no"         =>  $this->input->post('soc_bill_no'),
    
                    "soc_bill_date"       =>  $this->input->post('soc_bill_date'),

                    "pay_mode"            =>  $this->input->post('pay_mode'),
                      
                    "ref_no"              =>  $this->input->post('ref_no'),

                    "remarks"             =>  $this->input->post('remarks'),
    
                    "modified_by"         =>  $this->session->userdata['loggedin']['user_name'],
    
                    "modified_dt"         =>  date('Y-m-d')
    
                );
                
         
            $this->Paddy->f_edit('td_society_commision',$data_array,$where);

            $this->session->set_flashdata('msg', 'Successfully edited!');

            redirect('payment/commission');
        }
        else {

            //Bill Details
            $data = (explode("/",$this->input->get('trans_cd')));

            $where  =   array(

                "trans_cd"   => $data["0"],
                "branch_id"  => $data["1"],
                "kms_id"     => $data["2"]
            );

            $commission['bill_dtl']    =   $this->Paddy->f_get_particulars("td_society_commision",NULL,$where, 1);

            
            
            $wheres      =   array(

                "branch_id" => $this->session->userdata['loggedin']['branch_id']
            );
            $commission['blocks']    =   $this->Paddy->f_get_particulars("md_block", NULL,$wheres, 0);

              $sel   = array("sum(c.paddy_qty) paddy_qty","sum(c.quantity) totCmr");

            $whe = array(

            "a.wqsc_no  = b.id"        => NULL,
            "b.id       = c.trans_id"  => NULL,
            "b.wqsc_date  = c.trans_dt"=> NULL,
            "b.wqsc_no  = c.wqsc_no"   => NULL,
            "a.sanc_no"                => $commission['bill_dtl']->sanc_no,
            "a.kms_id"                 => $this->session->userdata['loggedin']['kms_id']

            );
           $commission['paddy']  =   $this->Paddy->f_get_particulars("td_fund_requisition a,td_wqsc b,td_wqsc_dtls c",$sel,$whe, 1);
          
            $this->load->view('post_login/main');

            $this->load->view("commission/edit", $commission);

            $this->load->view('post_login/footer');

        }

    }
    public function f_connected_mill(){

        $soc_id = $this->input->get("soc_name");

        $mill_lists= $this->Paddy->f_get_connected_mills($soc_id);
       
        echo json_encode($mill_lists);

    }

    //Commission delete
    public function f_commission_delete() {

        $where = array(
            
            "trans_cd"    => explode("/",$this->input->get('sl_no'))["0"],
            "branch_id"   => explode("/",$this->input->get('sl_no'))["1"],
            "kms_id"      => explode("/",$this->input->get('sl_no'))["2"]
        );
        
        $this->Paddy->f_delete('td_society_commision',$where);

        $this->session->set_flashdata('msg', 'Successfully Deleted!');

        redirect("payment/commission");

    }

     public function f_commision_forward() {



             $bill_no    =  explode("/",$this->input->get('pmt_bill_no'));

            $where = array(
            
            "trans_cd"    => $bill_no[0],
            "branch_id"   => $bill_no[1],
            "kms_id"      => $bill_no[2]

            );

            $bill_num = $this->session->userdata['loggedin']['dist_sort_code'].'/'.$this->session->userdata['loggedin']['kms_yr'].'/'.$bill_no[3].'/'.$bill_no[0];

            $data_array = array(

                    "ho_bill_no"         =>  $bill_num,
    
                    "approved_status"    =>  'A'   
    
                );
                
            $this->Paddy->f_edit('td_society_commision', $data_array,$where);

            //For notification storing message
            $this->session->set_flashdata('msg', 'Successfully Forwarded!');

            redirect('payment/commission');

    }

    /*********************For Millers Bill Payment Screen********************/
    #BENFED Paid Mills based on the bill no
    //New Payment Entry

    public function f_payment(){

        $kms_id    = $this->session->userdata['loggedin']['kms_id'];
        $branch_id = $this->session->userdata['loggedin']['branch_id'];

        $data['payment_dtls']    =   $this->Paddy->f_get_payments($kms_id,$branch_id);

        $this->load->view('post_login/main');

        $this->load->view("payment/dashboard", $data);

        $this->load->view('search/search');

        $this->load->view('post_login/footer'); 
        
    }

    //New Bill Payment Add
    public function f_payment_add() {

        if($_SERVER['REQUEST_METHOD'] == "POST") {

        	//$count = $this->db->get_where();
           $count = $this->db->get_where('td_payment_bill', array('sanc_no =' => $this->input->post('sanc_nos')))->num_rows();

            if($count == 0){

	            $pmt_bill_no = 0;

	            $max_trans_no = $this->Paddy->f_get_particulars("td_payment_bill",array("MAX(pmt_bill_no) pmt_bill_no"), array('kms_id' => $this->session->userdata['loggedin']['kms_id'],'dist' =>$this->session->userdata['loggedin']['branch_id']), 1);

	            if($max_trans_no){

	                $pmt_bill_no = $max_trans_no->pmt_bill_no + 1;

	            }
	            else {

	                $pmt_bill_no = 1;

	            }

           
	            if($this->input->post('benfed_bill_no') > 0){

                     $ho_bill_num = $this->session->userdata['loggedin']['dist_sort_code'].'/'.$this->session->userdata['loggedin']['kms_yr'].'/'.$this->input->post('benfed_bill_no').'/'.$pmt_bill_no;

	                $data_array = array(

	                    "pmt_bill_no"           =>  $pmt_bill_no,
	    
	                    "trans_dt"              =>  $this->input->post('trans_dt'),
	    
	                    "kms_id"                =>  $this->session->userdata['loggedin']['kms_id'],
	    
	                    "soc_id"                =>  $this->input->post('soc_name'),

	                    "mill_id"               =>  $this->input->post('mill_name'),

	                    "wqsc"                  =>  $this->input->post('wqsc'),

	                    "sanc_no"               =>  $this->input->post('sanc_nos'),
	    
	                    "dist"                  =>  $this->session->userdata['loggedin']['branch_id'],

	                    "block"                 =>  $this->input->post('block'),

	                    "tot_paddy"             =>  $this->input->post('totPaddy'),
	                    
	                    "tot_cmr"               =>  $this->input->post('totCmr'),
	    
	                    "ben_bill_no"           =>  $this->input->post('benfed_bill_no'),

	                    "ben_bill_dt"           =>  $this->input->post('benfed_bill_date'),
	    
	                    "mill_bill_no"          =>  $this->input->post('mill_bill_no'),
	    
	                    "mill_bill_dt"          =>  $this->input->post('mill_bill_date'),
	    
	                    "paddy_qty"             =>  $this->input->post('qty_paddy'),
	    
	                    "paddy_cmr"             =>  $this->input->post('qty_cmr'),
	    
	                    "paddy_butta"           =>  $this->input->post('qty_butta'),

	                    "gunny_cut"             =>  $this->input->post('gunny_cut'),

	                    "rice_type"             =>  $this->input->post('rice_type'),
	                    
	                    "pool_type"             =>  $this->input->post('pool_type'),

	                    "mandi_board"           =>  $this->input->post('mandi_board'),

	                    "mandi_board_addr"      =>  $this->input->post('mandi_board_addr'),

	                    "transport_agency_name" =>  $this->input->post('transport_agency_name'),

	                    "transport_agency_addr" =>  $this->input->post('transport_agency_addr'),

	                    "pay_mode"              =>  $this->input->post('pay_mode'),

	                    "bank_id"               =>  $this->input->post('bank_id'),

	                    "ref_no"                =>  $this->input->post('ref_no'),

                        "ho_bill_number"        =>  $ho_bill_num,
	    
	                    "created_by"            =>  $this->session->userdata['loggedin']['user_name'],
	    
	                    "created_dt"            =>  date('Y-m-d h:i:s')
	    
	                );
	                
	                
	                $this->Paddy->f_insert('td_payment_bill', $data_array);

	           

	            for($i = 0; $i < count($this->input->post('particulars')); $i++){

	                $data_array = array(

	                    "pmt_bill_no"           =>  $pmt_bill_no,

	                    "kms_id"                =>  $this->session->userdata['loggedin']['kms_id'],

	                    "dist"                  =>  $this->session->userdata['loggedin']['branch_id'],
	    
	                    "trans_dt"              =>  $this->input->post('trans_dt'),
	    
	                    "account_type"          =>  $this->input->post('particulars')[$i],
	    
	                    "per_unit"              =>  $this->input->post('rate_per_qtls')[$i],

	                    "total_amt"             =>  $this->input->post('amounts')[$i],
	    
	                    "tds_amt"               =>  $this->input->post('tds_amount')[$i],
	    
	                    "cgst_amt"              =>  $this->input->post('cgst')[$i],

	                    "sgst_amt"              =>  $this->input->post('sgst')[$i],

	                    "claim_amt"             =>  $this->input->post('claim_amt')[$i],
	    
	                    "payble_amt"            =>  $this->input->post('paybel')[$i]
	    
	                );
	                
	                
	                $this->Paddy->f_insert('td_payment_bill_dtls', $data_array);

	            }

            //For notification storing message
            $this->session->set_flashdata('msg', 'Successfully added!');
            redirect('payment/payment');

	            }else{
	                //For notification storing message
	            $this->session->set_flashdata('msg', 'Please Check Branch Reference Number Properly');
	            redirect('payment/payment');

	             }
	        }else{


	        	$this->session->set_flashdata('msg', 'Sorry! Payment Done For This Sanction Number');
	            redirect('payment/payment');


	        }     
            
        }
        else {

          $where      =   array(
                "branch_id"  => $this->session->userdata['loggedin']['branch_id']
            );
          $wheres      =   array(
                "cat"  => "M"
            );

            //District List
            $payment['blocks']        =   $this->Paddy->f_get_particulars("md_block", NULL,$where, 0);
            //Bill Master Details
            $payment['bill_master']   =   $this->Paddy->f_get_particulars("md_comm_params", array('sl_no', 'param_name'),$wheres, 0);

            $payment['banks']         =   $this->Paddy->f_get_particulars("md_paddy_bank",NULL,NULL, 0);

            $this->load->view('post_login/main');

            $this->load->view("payment/add", $payment);

            $this->load->view('post_login/footer');

        }
        
    }

    public function get_lessselected_particulars() {

        //Farmer from Transaction
   
         $arr   = $this->input->post('sl_no');

         $data  = implode(",",$arr);

         $sql   = "SELECT sl_no,param_name FROM md_comm_params WHERE sl_no NOT IN ($data) and cat ='M'";
      
         $datas = $this->db->query($sql)->result();

         echo json_encode($datas);

    }
    public function get_less_particulars_requision() {

        //Farmer from Transaction
   
         $arr   = $this->input->post('sl_no');

         $data  = implode(",",$arr);

         $sql   = "SELECT sl_no,param_name FROM md_comm_params WHERE sl_no NOT IN ($data) and cat!= 'H'";
      
         $datas = $this->db->query($sql)->result();

         echo json_encode($datas);

    }

    //Total No  of Farmer Yet to be paid
    public function f_farmer() {

        //Farmer from Transaction
        $farmer_trans   =   $this->Paddy->f_get_particulars("td_transaction", array("IFNULL(SUM(farmer_no), 0) farmer_no"), array("soc_id" => $this->input->get('society')), 1);

        //Farmer from Bill Payment
        $farmer_pey     =   $this->Paddy->f_get_particulars("td_payment", array("IFNULL(SUM(far_no), 0) farmer_no"), array("soc_id" => $this->input->get('society')), 1);
        
        echo $farmer_trans->farmer_no-$farmer_pey->farmer_no;

    }

    //Total No  of Paddy Yet to be paid
    public function f_paddy() {

        //Paddy from Transaction
        $paddy_trans   =   $this->Paddy->f_get_particulars("td_transaction", array("IFNULL(SUM(progressive), 0) progressive"), array("soc_id" => $this->input->get('society')), 1);

        //Paddy from Bill Payment
        $paddy_pey     =   $this->Paddy->f_get_particulars("td_payment", array("IFNULL(SUM(paddy_qty), 0) progressive"), array("soc_id" => $this->input->get('society')), 1);
        
        echo $paddy_trans->progressive-$paddy_pey->progressive;

    }
    public function wqsc_list() {

        $where = array(

            "soc_name" => $this->input->post("soc_id"),
            "mill_id"  => $this->input->post("mill_id"),
            "kms_id"   => $this->session->userdata['loggedin']['kms_id']
 
            );

        $socmill  =   $this->Paddy->f_get_particulars("td_wqsc",NULL,$where, 0);

        echo json_encode($socmill);

    }
    public function soc_mill_distance() {

        $select   =  array("distance");

        $where = array(

            "soc_id" => $this->input->post("soc_id"),
            "mill_id"  => $this->input->post("mill_id"),
            "kms_id"   => $this->session->userdata['loggedin']['kms_id']
 
             );

        $socmill  =   $this->Paddy->f_get_particulars("md_soc_mill",$select,$where, 1);

        echo json_encode($socmill);

    }

    public function mill_type(){

        $select = array("guide_lines_id");

        $where  = array(

            "mill_code" => $this->input->post("mill_id")
        );

        $socmill   =   $this->Paddy->f_get_particulars("md_mill",$select,$where, 1);

      //  echo $this->db->last_query();die;
        echo json_encode($socmill);
    }

    public function wqsc_qty() {

        $select =  array(

                "a.*","b.district_name","c.rm_gd_dist","c.inter_dist"

            );

        $where = array(

            "a.goodown_dist = b.district_code"  => NULL,
            "a.memo_no      = c.do_number"  => NULL,
            "a.soc_name" => $this->input->post("soc_id"),
            "a.mill_id"  => $this->input->post("mill_id"),
            "a.id"       => $this->input->post("wqsc"),
            "c.branch_id"=> $this->session->userdata['loggedin']['branch_id'],
            "c.kms_year" => $this->session->userdata['loggedin']['kms_id'],
            "a.kms_id"   => $this->session->userdata['loggedin']['kms_id']
 
             );

        $socmill  =   $this->Paddy->f_get_particulars("td_wqsc a,md_district b,td_cmr_delivery c",$select,$where, 1);

        echo json_encode($socmill);

    }

    public function wqsc_dtls() {

        $where = array(
        
            "trans_id"  => $this->input->post("wqsc"),
 
             );

        $smrqty  =   $this->Paddy->f_get_particulars("td_wqsc_dtls",NULL,$where,0);

        echo json_encode($smrqty);

    }
    
    public function tot_paddy_received() {

        $select =  array( "sum(paddy_qty) as tot" );

        $where = array(

                        "soc_id"     => $this->input->post("soc_id"),
                        "mill_id"    => $this->input->post("mill_id"),
                        "kms_year"   => $this->session->userdata['loggedin']['kms_id']
                    );

        $data  =   $this->Paddy->f_get_particulars("td_received",$select,$where, 1);

        echo json_encode($data);

    }

     public function transport_rate() {

        $select =  array( "dist_from","distance_to","amount" );

        $where = array( "kms_id"   => $this->session->userdata['loggedin']['kms_id'] );

        $data  =   $this->Paddy->f_get_particulars("md_transport_charges",$select,$where,0);

        echo json_encode($data);

    }

    //Bill Payment edit
    public function f_payment_edit() {

        if($_SERVER['REQUEST_METHOD'] == "POST") {


            $where = array(

                'pmt_bill_no' => $this->input->post('pmt_bill_no'),

                'kms_id'    => $this->input->post('kms_id'),

                'dist'        => $this->input->post('dist')
            );
        

                $data_array = array(
    
                    "trans_dt"              =>  $this->input->post('trans_dt'),    
    
                    "mill_bill_no"          =>  $this->input->post('mill_bill_no'),
    
                    "mill_bill_dt"          =>  $this->input->post('mill_bill_date'),
    
                    "ben_bill_no"           =>  $this->input->post('ben_bill_no'),

                    "ben_bill_dt"           =>  $this->input->post('ben_bill_dt'),

                    "mandi_board"           =>  $this->input->post('mandi_board'),

                    "mandi_board_addr"      =>  $this->input->post('mandi_board_addr'),

                    "transport_agency_name" =>  $this->input->post('transport_agency_name'),

                    "transport_agency_addr" =>  $this->input->post('transport_agency_addr'),

                    "paddy_butta"           =>  $this->input->post('paddy_butta'),

                    "gunny_cut"             =>  $this->input->post('gunny_cut'),

                    "pay_mode"              =>  $this->input->post('pay_mode'),

                    "bank_id"               =>  $this->input->post('bank_id'),

                    "ref_no"                =>  $this->input->post('ref_no'),
    
                    "modified_by"           =>  $this->session->userdata['loggedin']['user_name'],
    
                    "modified_dt"           =>  date('Y-m-d h:i:s')
    
                );
                
                $this->Paddy->f_edit('td_payment_bill', $data_array,$where);

            //For notification storing message
            $this->session->set_flashdata('msg', 'Successfully edited!');

            redirect('payment/payment');

        }
        else {

            //Bill Master Details
            $payment['bill_master']     =   $this->Paddy->f_get_particulars("md_comm_params", array('sl_no', 'param_name'), NULL, 0);

            $bill  = explode('/',$this->input->get('pmt_bill_no'));

            $where  =   array(

                "pmt_bill_no"   => $bill['0'],
                "dist"          => $bill['1'],
                "kms_id"      => $bill['2']
            );

            $payment['bill_dtls']    =   $this->Paddy->f_get_particulars("td_payment_bill",NULL, $where,1);
            
            //Charges for Bill Payment
            unset($select);
            unset($where);
            $select =  array(

                "account_type", "per_unit", "total_amt",
                "tds_amt", "cgst_amt", "sgst_amt","claim_amt",
                "payble_amt"

            );
            $where  =   array(
                "pmt_bill_no"   => $bill['0'],
                "dist"          => $bill['1'],
                "kms_id"        => $bill['2']
            );
            $payment['charges']    =   $this->Paddy->f_get_particulars("td_payment_bill_dtls", $select, $where, 0);

            unset($where);
            $where      =   array("branch_id"  => $this->session->userdata['loggedin']['branch_id']);
        
            $payment['blocks']        =   $this->Paddy->f_get_particulars("md_block", NULL,$where, 0);

            $this->load->view('post_login/main');

            $this->load->view("payment/edit", $payment);

            $this->load->view('post_login/footer');

        }
        
    }

    public function f_payment_forward() {

            $bill_dtls  = explode("/",$this->input->get('pmt_bill_no'));

            $where = array(
            
            "pmt_bill_no"    => $bill_dtls[0],
            "dist"           => $bill_dtls[1],
            "kms_id"         => $bill_dtls[2]
            
            );

           $bill_num = $this->session->userdata['loggedin']['dist_sort_code'].'/'.$this->session->userdata['loggedin']['kms_yr'].'/'.$bill_dtls[3].'/'.$bill_dtls[0];
            $data_array = array(
    
                    "ho_status"      =>  1,

                    "ho_bill_number" => $bill_num   
    
                );
                
            $this->Paddy->f_edit('td_payment_bill', $data_array,$where);

            //For notification storing message
            $this->session->set_flashdata('msg', 'Successfully Forwarded!');

            redirect('payment/payment');

    }

    //Bill Payment delete
    public function f_payment_delete() {

        $bill  = explode("/",$this->input->get('sl_no'));
        $where = array(
            
            "pmt_bill_no"    =>  $bill[0],
            "dist"           =>  $bill[1],
            "kms_id"         =>  $bill[2]
            
        );

        $this->Paddy->f_delete('td_payment_bill', $where);
        $this->Paddy->f_delete('td_payment_bill_dtls', $where);

        $this->session->set_flashdata('msg', 'Successfully Deleted!');

        redirect("payment/payment");

    }
    public function f_annexture2(){

             $select =array( "sum(rate) rate");


            $where  =   array(

                "kms_id"     => $this->session->userdata['loggedin']['kms_id']

                // "dist"       => $this->session->userdata['loggedin']['branch_id']

                // "ho_status"  => 1,
            );
            $wheres  =   array(

                "kms_id"     => $this->session->userdata['loggedin']['kms_id']
            );

            $data['bill_dtls']    =   $this->Paddy->f_get_particulars("td_payment_bill",NULL, $where,0);

            $this->load->view('post_login/main');

            $this->load->view("annexture/annexture2",$data);

            $this->load->view('post_login/footer');
        //  }else {

        //     $data['dist']          =   $this->Paddy->f_get_particulars("md_district", NULL, NULL, 0);

        //     $this->load->view('post_login/main');

        //     $this->load->view("annexture/annexture2",$data);

        //     $this->load->view('post_login/footer');

        // }
    }

    public function f_annexture2_print(){

            //Bill Details
           $data   = explode("/",$this->input->get('pmt_bill_no'));
            //Bill Details
            $select =  array(
             "ho_bill_number","tot_paddy","tot_cmr","trans_dt","gunny_cut","paddy_butta","pool_type","dist","wqsc"
            );

            $where  =   array(

                "pmt_bill_no"  => $data[0],
                "dist"         => $data[1],
                "kms_id"       => $data[2]
            );


            $select_commission = array( "a.*");

            $wherec  =   array(

                 "a.sanc_no      = b.sanc_no"  => NULL,

                "b.kms_id"           => $data[2],

                "b.pmt_bill_no"      => $data[0],

                "b.dist"             => $data[1]
               
            );

            $data['comission_rate']    = $this->Paddy->f_get_particulars("td_society_commision a,td_payment_bill b",$select_commission, $wherec,1);


            $datas['bill_dtls']          =   $this->Paddy->f_get_particulars("td_payment_bill",$select,$where,1);

            //Code For Mandi Labour Charge
            
            $datas['mandil_abour_rate']  =   $this->Paddy->get_param_rate_exist_in_bills($data[0],$data[2],$data[1],2);

             //Code For Commission To Society

            $datas['commission_rate']   =   $this->Paddy->get_param_rate_exist_in_bills($data[0],$data[2],$data[1],8);

            $datas['milling_rate']      =   $this->Paddy->get_param_rate_exist_in_bills($data[0],$data[2],$data[1],9);

    
          // echo $this->db->last_query();

            unset($where);
            $selects =  array(
             "a.*","b.param_name","b.action"
            );
            $where  =   array(

                "a.pmt_bill_no"  => $data[0],
                "a.dist"         => $data[1],
                "a.kms_id"       => $data[2],
                "a.account_type   = b.sl_no"  => NULL
               // "b.kms_id"      => $data[2]

            );
            $datas['particulas']       =   $this->Paddy->f_get_particulars("td_payment_bill_dtls a,md_comm_params b",$selects,$where,0);

            $this->load->view('post_login/main');

            $this->load->view("annexture/annexture2_print",$datas);

            $this->load->view('post_login/footer');
        
    }
    public function f_annexture3(){


         // if($_SERVER['REQUEST_METHOD'] == "POST") {

             $select = array(
                    "a.*","b.per_qui_rate",

             );


            $where  =   array(

                "a.kms_id"           => $this->session->userdata['loggedin']['kms_id'],

               // "a.branch_id"        => $this->input->post('dist'),

                "a.branch_id"        => $this->session->userdata['loggedin']['branch_id'],

                // "a.approved_status"  => 'A',

                "a.kms_id      = b.kms_yr"  => NULL
            );

            $data['bill_dtls']    =   $this->Paddy->f_get_particulars("td_society_commision a,md_paddy_rate b",NULL, $where,0);

            $this->load->view('post_login/main');

            $this->load->view("annexture/annexture3",$data);

            $this->load->view('post_login/footer');
        //  }else {

        //     $data['dist']          =   $this->Paddy->f_get_particulars("md_district", NULL, NULL, 0);

        //     $this->load->view('post_login/main');

        //     $this->load->view("annexture/annexture3",$data);

        //     $this->load->view('post_login/footer');

        // }
    }

    public function f_annexture3_print(){

            $data   = explode("/",$this->input->get('pmt_bill_no'));
            //Bill Details
            $select =  array(
             "a.tot_paddy","b.per_qui_rate","c.ho_bill_no","c.trans_dt trans_dtp","c.qty","c.rice_type","c.rate"
            );

            $where  =   array(

                "c.trans_cd"     => $data[0],
                "c.branch_id"    => $data[1],
                "c.kms_id"       => $data[2],
                "c.kms_id        = b.kms_yr"  => NULL,
                "a.wqsc          = c.wqsc"  => NULL,
                "a.kms_id"       => $data[2]
            );

            $datas['bill_dtls']       =   $this->Paddy->f_get_particulars("td_payment_bill a,md_paddy_rate b,td_society_commision c",$select,$where,1);

            $this->load->view('post_login/main');

            $this->load->view("annexture/annexture3_print",$datas);

            $this->load->view('post_login/footer');
        
    }

    public function f_annexture5(){


          //if($_SERVER['REQUEST_METHOD'] == "POST") {

            $select =array( "sum(rate) rate");


            $where  =   array(

                "kms_id"     => $this->session->userdata['loggedin']['kms_id'],

                "dist"       => $this->session->userdata['loggedin']['branch_id']

                // "ho_status"  => 1,
            );
            $wheres  =   array(

                "kms_id"     => $this->session->userdata['loggedin']['kms_id']
            );

            $data['bill_dtls']    =   $this->Paddy->f_get_particulars("td_payment_bill",NULL, $where,0);

            $data['charges']         =   $this->Paddy->f_get_particulars("md_mandilabour_charge",$select,$wheres,1);

            $this->load->view('post_login/main');

            $this->load->view("annexture/annexture5",$data);

            $this->load->view('post_login/footer');
        //  }else {

        //     $data['dist']          =   $this->Paddy->f_get_particulars("md_district", NULL, NULL, 0);

        //     $this->load->view('post_login/main');

        //     $this->load->view("annexture/annexture5",$data);

        //     $this->load->view('post_login/footer');

        // }
    }

    public function f_annexture5_print(){

            //Bill Details
            $select =  array(
              "a.paddy_qty","a.mandi_board","a.ben_bill_dt","a.ben_bill_no","b.memo_no","b.memo_dt","a.pool_type","a.ho_bill_number"
            );

            $where  =   array(

                "a.pmt_bill_no"   => $this->input->get('pmt_bill_no'),
                "a.kms_id"        => $this->session->userdata['loggedin']['kms_id'],
                "a.dist"          => $this->session->userdata['loggedin']['branch_id'],
                "a.wqsc      = b.wqsc_no"  => NULL,

            );

            $data['bill_dtls']       =   $this->Paddy->f_get_particulars("td_payment_bill a,td_wqsc b",$select,$where,1);


            $data['charges']         =   $this->Paddy->f_get_particulars("md_mandilabour_charge",NULL,NULL,0);

            $this->load->view('post_login/main');

            $this->load->view("annexture/annexture5_print",$data);

            $this->load->view('post_login/footer');
        
    }

    public function f_annexture4(){


       //   if($_SERVER['REQUEST_METHOD'] == "POST") {
            
          
            $select = array("a.trans_dt","a.dist","a.kms_id","a.ho_bill_number","a.pmt_bill_no pmt_bill_no","b.per_unit","a.tot_paddy");    
             
            $where  =   array(
                "a.kms_id"        => $this->session->userdata['loggedin']['kms_id'],
                "a.dist"          => $this->session->userdata['loggedin']['branch_id'],
                // "a.ho_status"     => 1,
                "b.account_type"  => "2",
                "a.trans_dt      = b.trans_dt"  => NULL,
                "a.pmt_bill_no   = b.pmt_bill_no"  => NULL,
                "a.kms_id        = b.kms_id"  => NULL,
                "a.dist          = b.dist"  => NULL
            );             


            $data['bill_dtls']    =   $this->Paddy->f_get_particulars("td_payment_bill a,td_payment_bill_dtls b",$select, $where,0);

            $this->load->view('post_login/main');

            $this->load->view("annexture/annexture4",$data);

            $this->load->view('post_login/footer');
        //  }else {

        //     $data['dist']     =   $this->Paddy->f_get_particulars("md_district", NULL, NULL, 0);

        //     $this->load->view('post_login/main');

        //     $this->load->view("annexture/annexture4",$data);

        //     $this->load->view('post_login/footer');

        // }
    }

    public function f_annexture4_print(){

            $data   = explode("/",$this->input->get('pmt_bill_no'));
            //Bill Details
            $select =  array(
             "a.mandi_board","a.mandi_board_addr","a.ho_bill_number","a.tot_paddy","b.per_qui_rate","c.per_unit","a.trans_dt"
            );

            $where  =   array(

                "a.pmt_bill_no"  => $data[0],
                "a.dist"         => $data[1],
                "a.kms_id"       => $data[2],
                "a.kms_id        = b.kms_yr"  => NULL,
                "c.account_type"  => "2",
                "a.trans_dt      = c.trans_dt"  => NULL,
                "a.pmt_bill_no   = c.pmt_bill_no"  => NULL,
                "a.kms_id        = c.kms_id"  => NULL,
                "a.dist          = c.dist"  => NULL

            );

            $datas['bill_dtls']       =   $this->Paddy->f_get_particulars("td_payment_bill a,md_paddy_rate b,td_payment_bill_dtls c",$select,$where,1);

            $this->load->view('post_login/main');

            $this->load->view("annexture/annexture4_print",$datas);

            $this->load->view('post_login/footer');
        
    }

    public function f_annexture6(){


         /// if($_SERVER['REQUEST_METHOD'] == "POST") {


            $where  =   array(

                "kms_id"   => $this->session->userdata['loggedin']['kms_id'],

                "dist"     => $this->session->userdata['loggedin']['branch_id']

                // "ho_status"  => 1,
            );

            $wheres  =   array(

                "kms_id"   => $this->session->userdata['loggedin']['kms_id']

            );

            $data['bill_dtls']    =   $this->Paddy->f_get_particulars("td_payment_bill",NULL, $where,0);

            $data['rate']        =   $this->Paddy->f_get_particulars("md_transport_charges",NULL,$wheres,0);

            $this->load->view('post_login/main');

            $this->load->view("annexture/annexture6",$data);

            $this->load->view('post_login/footer');
        //  }else {

        //     $data['dist']          =   $this->Paddy->f_get_particulars("md_district", NULL, NULL, 0);

        //     $this->load->view('post_login/main');

        //     $this->load->view("annexture/annexture6",$data);

        //     $this->load->view('post_login/footer');

        // }
    }

    public function f_annexture6_print(){

            //Bill Details
            $select =  array(
              "a.paddy_qty","a.paddy_cmr","a.sanc_no","a.mandi_board","a.ben_bill_dt","a.ben_bill_no","a.transport_agency_name","a.transport_agency_addr","b.memo_no","b.memo_dt","a.pool_type","a.soc_id","a.mill_id"
            );

            $bill_no = explode("/",$this->input->get('pmt_bill_no'))[0];


            $where  =   array(

                "a.pmt_bill_no"   => $bill_no,
                "a.kms_id"       => $this->session->userdata['loggedin']['kms_id'],
                "a.dist"          => $this->session->userdata['loggedin']['branch_id'],
                "a.wqsc      = b.wqsc_no"  => NULL,

            );

            $data['bill_dtls']       =   $this->Paddy->f_get_particulars("td_payment_bill a,td_wqsc b",$select,$where,1);


            $wheres  =   array(

                "soc_id"   => $data['bill_dtls']->soc_id,
                "mill_id"  => $data['bill_dtls']->mill_id

            );
            $wheress  =   array(

                "sl_no"  => $data['bill_dtls']->mill_id

            );

            $data['distance']  =   $this->Paddy->f_get_particulars("md_soc_mill",NULL,$wheres,1);

            $data['millname']  =   $this->Paddy->f_get_particulars("md_mill",NULL,$wheress,1);

            $data['rate']      =   $this->Paddy->get_transport_rate($bill_no,$this->session->userdata['loggedin']['kms_id'],$this->session->userdata['loggedin']['branch_id']);
       
           // $data['rate']       =   $this->Paddy->f_get_particulars("md_comm_params",NULL,NULL,0);

            $this->load->view('post_login/main');

            $this->load->view("annexture/annexture6_print",$data);

            $this->load->view('post_login/footer');
        
    }
    public function f_annexture7(){


          //if($_SERVER['REQUEST_METHOD'] == "POST") {

            $where  =   array(

                "kms_id"   => $this->session->userdata['loggedin']['kms_id'],

                "dist"     => $this->session->userdata['loggedin']['branch_id']

                // "ho_status"  => 1,
            );

            $wheres  =   array(

                "kms_id"   => $this->session->userdata['loggedin']['kms_id']

            );

            $data['bill_dtls']    =   $this->Paddy->f_get_particulars("td_payment_bill",NULL, $where,0);

            $data['rate']        =   $this->Paddy->f_get_particulars("md_transport_charges",NULL,$wheres,0);



            $this->load->view('post_login/main');

            $this->load->view("annexture/annexture7",$data);

            $this->load->view('post_login/footer');
        //  }else {

        //     $data['dist']          =   $this->Paddy->f_get_particulars("md_district", NULL, NULL, 0);

        //     $this->load->view('post_login/main');

        //     $this->load->view("annexture/annexture7",$data);

        //     $this->load->view('post_login/footer');

        // }
    }

    public function f_annexture7_print(){

            //Bill Details
            $select =  array(
              "a.paddy_qty","a.mandi_board","a.ben_bill_dt","a.ben_bill_no","b.memo_no","b.memo_dt","a.pool_type","a.soc_id","a.mill_id","b.wqsc_no","b.goodown_name","b.goodown_dist"
            );
            $data  = explode("/",$this->input->get('pmt_bill_no'));

            $where  =   array(

                "a.pmt_bill_no"   => $data['0'],
                "a.dist"          => $data['1'],
                "a.kms_id"        => $data['2'],
                "a.wqsc      = b.wqsc_no"  => NULL,

            );

            $data['bill_dtls']  =   $this->Paddy->f_get_particulars("td_payment_bill a,td_wqsc b",$select,$where,1);

            $sel = array("per_unit","cgst_amt","sgst_amt");

            $wheres  =   array(

                "pmt_bill_no"   => $data['0'],
                "dist"          => $data['1'],
                "kms_id"        => $data['2'],
                "account_type"  => '9'
           
            );

            $data['rate']       =   $this->Paddy->f_get_particulars("td_payment_bill_dtls",$sel,$wheres,1);

         //   $data['rate']       =   $this->Paddy->f_get_particulars("md_comm_params",NULL,NULL,0);

            $wheress  =   array(

                "sl_no"  => $data['bill_dtls']->mill_id

            );
         //   $data['distance']   =   $this->Paddy->f_get_particulars("md_soc_mill",NULL,$wheres,1);
            $data['millname']   =   $this->Paddy->f_get_particulars("md_mill",NULL,$wheress,1);

            $this->load->view('post_login/main');

            $this->load->view("annexture/annexture7_print",$data);

            $this->load->view('post_login/footer');
        
    }
    public function f_annexture8(){


       //   if($_SERVER['REQUEST_METHOD'] == "POST") {

            $where  =   array(

                "kms_id"   => $this->session->userdata['loggedin']['kms_id'],

                "dist"     => $this->session->userdata['loggedin']['branch_id']

                // "ho_status"  => 1,
            );

            $wheres  =   array(

                "kms_id"   => $this->session->userdata['loggedin']['kms_id']

            );

            $data['bill_dtls']    =   $this->Paddy->f_get_particulars("td_payment_bill",NULL, $where,0);

            $data['rate']        =   $this->Paddy->f_get_particulars("md_transport_charges",NULL,$wheres,0);

            $this->load->view('post_login/main');

            $this->load->view("annexture/annexture8",$data);

            $this->load->view('post_login/footer');
        //  }else {

        //     $data['dist']          =   $this->Paddy->f_get_particulars("md_district", NULL, NULL, 0);

        //     $this->load->view('post_login/main');

        //     $this->load->view("annexture/annexture8",$data);

        //     $this->load->view('post_login/footer');

        // }
    }

    public function f_annexture8_print(){

          //Bill Details
            $select =  array(
              "a.paddy_qty","a.mandi_board","a.paddy_cmr","a.ben_bill_dt","a.rice_type","a.ben_bill_no","b.memo_no","b.memo_dt","a.pool_type","a.soc_id","a.mill_id","b.wqsc_no","b.goodown_name","b.goodown_dist","a.ho_bill_number"
            );
            $data  = explode("/",$this->input->get('pmt_bill_no'));

            $where  =   array(

                "a.pmt_bill_no"   => $data['0'],
                "a.dist"          => $data['1'],
                "a.kms_id"        => $data['2'],
                "a.wqsc      = b.wqsc_no"  => NULL,

            );

            $data['bill_dtls']  =   $this->Paddy->f_get_particulars("td_payment_bill a,td_wqsc b",$select,$where,1);

            $sel = array("per_unit","cgst_amt","sgst_amt");

            $wheres  =   array(

                "pmt_bill_no"   => $data['0'],
                "dist"          => $data['1'],
                "kms_id"        => $data['2'],
                "account_type"  => '12'
           
            );

            $data['rate']       =   $this->Paddy->f_get_particulars("td_payment_bill_dtls",$sel,$wheres,1);

        

            $wheress  =   array(

                "sl_no"  => $data['bill_dtls']->mill_id

            );
         //   $data['distance']   =   $this->Paddy->f_get_particulars("md_soc_mill",NULL,$wheres,1);
            $data['millname']   =   $this->Paddy->f_get_particulars("md_mill",NULL,$wheress,1);

            $this->load->view('post_login/main');

            $this->load->view("annexture/annexture8_print",$data);

            $this->load->view('post_login/footer');
        
    }
    public function f_annexture9(){


       //   if($_SERVER['REQUEST_METHOD'] == "POST") {
            $where  =   array(

                "kms_id"   => $this->session->userdata['loggedin']['kms_id'],

                "dist"     => $this->session->userdata['loggedin']['branch_id']

                // "ho_status"  => 1,
            );

            $wheres  =   array(

                "kms_id"   => $this->session->userdata['loggedin']['kms_id']

            );

            $data['bill_dtls']    =   $this->Paddy->f_get_particulars("td_payment_bill",NULL, $where,0);

            $data['rate']        =   $this->Paddy->f_get_particulars("md_transport_charges",NULL,$wheres,0);

            $this->load->view('post_login/main');

            $this->load->view("annexture/annexture9",$data);

            $this->load->view('post_login/footer');
        //  }else {

        //     $data['dist']          =   $this->Paddy->f_get_particulars("md_district", NULL, NULL, 0);

        //     $this->load->view('post_login/main');

        //     $this->load->view("annexture/annexture9",$data);

        //     $this->load->view('post_login/footer');

        // }
    }

    public function f_annexture9_print(){

            //Bill Details
            $select =  array(
              "a.paddy_qty","a.mandi_board","a.ben_bill_dt","a.ben_bill_no","b.memo_no","b.memo_dt","a.pool_type","a.soc_id","a.mill_id"
            );
            $data  = explode("/",$this->input->get('pmt_bill_no'));

            $where  =   array(

                "a.pmt_bill_no"   => $data['0'],
                "a.dist"          => $data['1'],
                "a.kms_id"        => $data['2'],
                "a.wqsc      = b.wqsc_no"  => NULL,

            );

            $data['bill_dtls']       =   $this->Paddy->f_get_particulars("td_payment_bill a,td_wqsc b",$select,$where,1);
       
            $data['rate']       =   $this->Paddy->f_get_particulars("md_comm_params",NULL,NULL,0);

            $this->load->view('post_login/main');

            $this->load->view("annexture/annexture9_print",$data);

            $this->load->view('post_login/footer');
        
    }
    public function f_annexture10(){


        //  if($_SERVER['REQUEST_METHOD'] == "POST") {

            $where  =   array(

                "kms_id"   => $this->session->userdata['loggedin']['kms_id'],

                "dist"     => $this->session->userdata['loggedin']['branch_id']

                // "ho_status" => 1,
            );

            $wheres  =   array(

                "kms_id"   => $this->session->userdata['loggedin']['kms_id']

            );

            $data['bill_dtls']    =   $this->Paddy->f_get_particulars("td_payment_bill",NULL, $where,0);

            $data['rate']        =   $this->Paddy->f_get_particulars("md_transport_charges",NULL,$wheres,0);

            $this->load->view('post_login/main');

            $this->load->view("annexture/annexture10",$data);

            $this->load->view('post_login/footer');
        //  }else {

        //     $data['dist']          =   $this->Paddy->f_get_particulars("md_district", NULL, NULL, 0);

        //     $this->load->view('post_login/main');

        //     $this->load->view("annexture/annexture10",$data);

        //     $this->load->view('post_login/footer');

        // }
    }

    public function f_annexture10_print(){

            //Bill Details
            $select =  array(
              "a.paddy_qty","a.mandi_board","a.ben_bill_dt","a.ben_bill_no","b.memo_no","b.memo_dt","a.pool_type","a.soc_id","a.mill_id"
            );
            $data  = explode("/",$this->input->get('pmt_bill_no'));

            $where  =   array(

                "a.pmt_bill_no"   => $data['0'],
                "a.dist"          => $data['1'],
                "a.kms_id"        => $data['2'],
                "a.wqsc      = b.wqsc_no"  => NULL,

            );

            $data['bill_dtls']       =   $this->Paddy->f_get_particulars("td_payment_bill a,td_wqsc b",$select,$where,1);
       
            $data['rate']       =   $this->Paddy->f_get_particulars("md_comm_params",NULL,NULL,0);

            $this->load->view('post_login/main');

            $this->load->view("annexture/annexture10_print",$data);

            $this->load->view('post_login/footer');
        
    }
    public function f_annexture11(){

         // if($_SERVER['REQUEST_METHOD'] == "POST") {

            $where  =   array(

                "kms_id"   => $this->session->userdata['loggedin']['kms_id'],

                "dist"     => $this->session->userdata['loggedin']['branch_id']

                // "ho_status"  => 1,
            );

            $wheres  =   array(

                "kms_id"   => $this->session->userdata['loggedin']['kms_id']

            );

            $data['bill_dtls']    =   $this->Paddy->f_get_particulars("td_payment_bill",NULL, $where,0);

            $data['rate']        =   $this->Paddy->f_get_particulars("md_transport_charges",NULL,$wheres,0);

            $this->load->view('post_login/main');

            $this->load->view("annexture/annexture11",$data);

            $this->load->view('post_login/footer');
        //  }else {

        //     $data['dist']          =   $this->Paddy->f_get_particulars("md_district", NULL, NULL, 0);

        //     $this->load->view('post_login/main');

        //     $this->load->view("annexture/annexture11",$data);

        //     $this->load->view('post_login/footer');

        // }
    }

    public function f_annexture11_print(){

            //Bill Details
            $select =  array(
              "a.paddy_qty","a.mandi_board","a.ben_bill_dt","a.ben_bill_no","b.memo_no","b.memo_dt","a.pool_type","a.soc_id","a.mill_id"
            );
            $data  = explode("/",$this->input->get('pmt_bill_no'));

            $where  =   array(

                "a.pmt_bill_no"   => $data['0'],
                "a.dist"          => $data['1'],
                "a.kms_id"        => $data['2'],
                "a.wqsc      = b.wqsc_no"  => NULL,

            );

            $data['bill_dtls']       =   $this->Paddy->f_get_particulars("td_payment_bill a,td_wqsc b",$select,$where,1);
       
            $data['rate']       =   $this->Paddy->f_get_particulars("md_comm_params",NULL,NULL,0);

            $this->load->view('post_login/main');

            $this->load->view("annexture/annexture11_print",$data);

            $this->load->view('post_login/footer');
        
    }

}

?>