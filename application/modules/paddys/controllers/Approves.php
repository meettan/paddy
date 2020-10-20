<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Approves extends MX_Controller {

    public function __construct(){

        parent::__construct();

        $this->load->model('Paddy');
        
        //For User's Authentication
        if(!isset($this->session->userdata('loggedin')->user_id)){
            
            redirect('User_Login/login');

        }
        
    }


    /**********************For Transaction Approve Screen**********************/

    public function f_approve_transaction() {

        if($this->input->get('trans_cd')){
            
            //From Trans table
            $select     =   array(

                "trans_cd", "soc_id", 
                "farmer_no", "progressive"

            );

            $data_frm_trans =  $this->Paddy->f_get_particulars("td_transaction", $select, array("trans_cd" => $this->input->get('trans_cd')), 1);

            //From TM Prod table
            unset($select);
            $select         =  array(

                "farmer_bal", "paddy_bal", 
                
                "MAX(trans_dt) trans_dt", "MAX(trans_cd) trans_cd"

            );

            $where          =   array(
                
                "soc_id= '".$data_frm_trans->soc_id."' GROUP BY farmer_bal,paddy_bal" => NULL
                
            );

            $data_frm_prod  =  $this->Paddy->f_get_particulars("tm_prod_bal", $select, $where, 1);

           
            if($data_frm_prod){

                $data_array =   array(

                    "trans_dt"  => date('Y-m-d'),

                    "trans_cd"  => $data_frm_trans->trans_cd,

                    "soc_id"    => $data_frm_trans->soc_id,

                    "flag"      => 'I',

                    "farmer_bal"=> $data_frm_trans->farmer_no + $data_frm_prod->farmer_bal,

                    "paddy_bal"=> $data_frm_trans->progressive + $data_frm_prod->paddy_bal

                );

            }
            else{

                $data_array =   array(

                    "trans_dt"  => date('Y-m-d'),

                    "trans_cd"  => $data_frm_trans->trans_cd,

                    "soc_id"    => $data_frm_trans->soc_id,

                    "flag"      => 'I',

                    "farmer_bal"=> $data_frm_trans->farmer_no,

                    "paddy_bal"=> $data_frm_trans->progressive

                );

            }

            $this->Paddy->f_insert("tm_prod_bal", $data_array);

            unset($data_array);
            $data_array     =   array(
                    
                "approval_status"       => 'A',
                
                "approved_by"           =>  $this->session->userdata('loggedin')->user_name,

                "approved_dt"           =>  date('Y-m-d')
        
            );

            $this->Paddy->f_edit("td_transaction", $data_array, array( "trans_cd" => $this->input->get('trans_cd')));

            redirect('paddy/approve/transaction');

        }

        //Unapprove List of Salary
        $select =   array(

            "trans_dt", "trans_cd", "soc_id", 

            "mill_id", "dist", "camp_no"

        );
        
        $where  =   array(

            "approval_status"       =>  'U'

        );

        $approve['unapprove_dtls']     =  (array) $this->Paddy->f_get_particulars("td_transaction", $select, $where, 0);
        

        //Society List
        $approve['soc']                =   $this->Paddy->f_get_particulars("md_society", array("sl_no", "soc_name"), NULL, 0);
                
        //Mill List
        $approve['mill']               =   $this->Paddy->f_get_particulars("md_mill", array("sl_no", "mill_name"), NULL, 0);
        
        //District List
        $approve['dist']               =   $this->Paddy->f_get_particulars("md_district", NULL, NULL, 0);
       
        $this->load->view('post_login/main');

        $this->load->view("approve/dashboard_trans", $approve);
        
        $this->load->view('post_login/footer');

    }

    /**********************For Payment Approve Screen**********************/

    public function f_approve_payment() {

        if($this->input->get('trans_cd')){

            //Pre Approve Details of current payment
            $select     =   array(

                "trans_cd", "soc_id", 

                "far_no", "paddy_qty"

            );

            $data_frm_trans =  $this->Paddy->f_get_particulars("td_payment", $select, array("trans_cd" => $this->input->get('trans_cd')), 1);

            //From TM Prod table
            unset($select);
            $select         =  array(

                "farmer_bal", "paddy_bal", 
                
                "MAX(trans_dt) trans_dt", "MAX(trans_cd) trans_cd"

            );

            $where          =   array(
                
                "soc_id= '".$data_frm_trans->soc_id."' GROUP BY farmer_bal,paddy_bal ORDER BY trans_cd DESC LIMIT 1" => NULL
                
            );

            $data_frm_prod  =  $this->Paddy->f_get_particulars("tm_prod_bal", $select, $where, 1);

           
            if($data_frm_prod){

                $data_array =   array(

                    "trans_dt"  => date('Y-m-d'),

                    "trans_cd"  => $data_frm_trans->trans_cd,

                    "soc_id"    => $data_frm_trans->soc_id,

                    "flag"      => 'O',

                    "farmer_bal"=> $data_frm_prod->farmer_bal - $data_frm_trans->far_no,

                    "paddy_bal" => $data_frm_prod->paddy_bal - $data_frm_trans->paddy_qty

                );

            }
            else{

                $data_array =   array(

                    "trans_dt"  => date('Y-m-d'),

                    "trans_cd"  => $data_frm_trans->trans_cd,

                    "soc_id"    => $data_frm_trans->soc_id,

                    "flag"      => 'O',

                    "farmer_bal"=> $data_frm_trans->far_no,

                    "paddy_bal"=> $data_frm_trans->paddy_qty

                );

            }

            $this->Paddy->f_insert("tm_prod_bal", $data_array);

            unset($data_array);

            $data_array     =   array(
                    
                "approval_status"       => 'A',
                
                "approved_by"           =>  $this->session->userdata('loggedin')->user_name,

                "approved_dt"           =>  date('Y-m-d')

        
            );

            $this->Paddy->f_edit("td_payment", $data_array, array( "trans_cd" => $this->input->get('trans_cd')));

            redirect('paddy/approve/payment');

        }

        //Unapprove List of Salary
        $select =   array(

            "trans_dt", "trans_cd", "soc_id", 

            "dist", "far_no", "far_amt",
            
            "paddy_qty", "paddy_amt", "bank"

        );
        
        $where  =   array(

            "approval_status"       =>  'U'

        );

        $approve['unapprove_dtls']     =  (array) $this->Paddy->f_get_particulars("td_payment", $select, $where, 0);
        

        //Society List
        $approve['soc']                =   $this->Paddy->f_get_particulars("md_society", array("sl_no", "soc_name"), NULL, 0);
                
        //Mill List
        $approve['mill']               =   $this->Paddy->f_get_particulars("md_mill", array("sl_no", "mill_name"), NULL, 0);
        
        //District List
        $approve['dist']               =   $this->Paddy->f_get_particulars("md_district", NULL, NULL, 0);
       
        $this->load->view('post_login/main');

        $this->load->view("approve/dashboard_pay", $approve);
        
        $this->load->view('post_login/footer');

    }

}