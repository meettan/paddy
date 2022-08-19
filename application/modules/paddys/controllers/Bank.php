<?php
defined('BASEPATH') OR exit('No direct script access allowed');
class Bank extends MX_Controller {

    protected $sysdate;
    protected $kms_year;

    public function __construct(){

        parent::__construct();

        $this->load->library('form_validation');
        //For Individual Functions
        $this->load->model('Paddy');
        $this->load->helper('paddyrate');

        //For User's Authentication
        if(!isset($this->session->userdata['bankloggedin']['user_id'])){
            
            redirect('User_Login/bank');

        }

         $data       = $this->Paddy->f_get_particulars_in('md_parameters', array(16, 17), array(""));

         $this->kms_year   = substr($data[0]->param_value, 0,4).'-'.substr($data[1]->param_value, 2,2);
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
            "uploaded_by"                    => $this->session->userdata['bankloggedin']['user_name'],
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
            $this->session->set_flashdata('msg', $j.'Record Successfully added!');
          
             redirect('paddys/bank/f_neft_upload');

        }
        else {
           
            //District List
            $cheque_upload['dist']    =   $this->Paddy->f_get_particulars("md_district", NULL, NULL, 0);

            $this->load->view('post_login/bank_main');

            $this->load->view("neft_reconcil/add_upload_bank", $cheque_upload);

            $this->load->view('post_login/footer');
        }
        
    }

 
 
}
