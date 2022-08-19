<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Bankintegration extends MX_Controller {

    protected $sysdate;
    protected $kms_year;

    public function __construct(){

        $this->sysdate  = $_SESSION['sys_date'];

        parent::__construct();

        $this->load->library('form_validation');
        //$this->load->library('lib/openpgp');
        $this->load->model('Paddy');
        $this->load->helper('paddyrate');
        $this->load->helper('file');

        //For User's Authentication
        if(!isset($this->session->userdata['loggedin']['user_id'])){
            
            redirect('User_Login/login');

        }

         $data       = $this->Paddy->f_get_particulars_in('md_parameters', array(16, 17), array(""));

         $this->kms_year   = substr($data[0]->param_value, 0,4).'-'.substr($data[1]->param_value, 2,2);
    }

    public function f_paddycol_forward() {
        

        $soc_id                = $this->input->get('soc_id');
        $trans_dt              = $this->input->get('trans_dt');
        $forward_bulk_trans_id = base64_decode($this->input->get('forward_bulk_trans_id'));
        $bulk_trans_id         = $this->input->get('bulk_trans_id');
        $valid                 = 0;

        $paddy_data            = $this->Paddy->coll_received($soc_id,$trans_dt,$bulk_trans_id);
        $paddy_forwad          = $this->Paddy->coll_forward($soc_id,$trans_dt,$bulk_trans_id);

        $bank_id               = $this->Paddy->bank_detail_for_forward($soc_id,$trans_dt,$bulk_trans_id);

        // if( $bank_id == '5'){

        //      $hdfc_sl_no = $this->Paddy->f_get_particulars("td_collections",array("ifnull(MAX(hdfc_sl_no),0) hdfc_sl_no"),array('trans_dt' => $trans_dt), 1);

        //     $hdfc_sl_no = $hdfc_sl_no->hdfc_sl_no+1;


        //      $data_array = array(

        //             "hdfc_sl_no"  => $hdfc_sl_no
           
        //         );

        //       $where = array(

        //             "bulk_trans_id"           => $bulk_trans_id,

        //             "forward_bulk_trans_id"   => $forward_bulk_trans_id,

        //             "soc_id"                  => $soc_id,

        //             "trans_dt"                => $trans_dt

        //         );

        //      $this->Paddy->f_edit('td_collections', $data_array, $where);

        //   $hdfc_sl = $hdfc_sl_no;

        // }

        $bank_data     = $this->Paddy->f_get_particulars("md_paddy_bank", NULL,array("bank_id" => $bank_id), 1);

        $farmer_data   =  $this->Paddy->f_collection_details_icici($soc_id,$trans_dt,$forward_bulk_trans_id);
                    
        $data_array = array(

                "trans_dt"      =>  $paddy_data->trans_dt,                

                "kms_year"      =>  $this->session->userdata['loggedin']['kms_id'],

                "branch_id"     =>  $this->session->userdata['loggedin']['branch_id'],

                "dist"          =>  $this->session->userdata['loggedin']['dist_id'],

                "soc_id"        =>  $paddy_data->soc_id,       

                "mill_id"       =>  $paddy_data->mill_id,

                "paddy_qty"     =>  $paddy_data->quantity,

                "created_by"    =>  $this->session->userdata['loggedin']['user_name'],

                "created_dt"    =>  date('Y-m-d h:i:s')

            );

            foreach($paddy_forwad as $row){
                        
                                $dataf[] = array(

                                'forward_dt'              =>  date('Y-m-d h:i:s'),
                                'forward_bulk_trans_id'   =>  $row->forward_bulk_trans_id,
                                'forward_trans_id'        =>  $row->forward_trans_id,
                                'ifsc_code'               =>  $row->ifsc_code,
                                'acc_no'                  =>  $row->acc_no,
                                "forward_sl"              =>  $row->book_no,
                                "bank_id"                 =>  $row->bank_sl_no,
                                "kms_id"                  =>  $this->session->userdata['loggedin']['kms_id'],
                                "forwarded_by"            =>  $this->session->userdata['loggedin']['user_name']
                            
                                 );

            }
            

        $data     = $this->Paddy->f_ifsccode($trans_dt,$bulk_trans_id,$soc_id);

        $reg_qty  = $this->Paddy->f_regno_amt($trans_dt,$bulk_trans_id,$soc_id);

        $regvalid = 0;

        $qtyvalid = 0;


       foreach( $data as $value ) {
                  
                 if(strlen($value->ifsc_code)=="11"){
                    $valid = $valid+0;
                 }else{
                    $valid = $valid+1;
                 }
        }

       

        if($qtyvalid == '0'){

                            if($valid=='0'){  

                                    $this->Paddy->f_forward_paddycollection($trans_dt,$bulk_trans_id,$soc_id,$this->session->userdata['loggedin']['user_name'],date('Y-m-d h:i:s'));

                                    $this->Paddy->f_insert_multiple('td_collections_forward', $dataf);

                                   // $this->Paddy->f_insert('td_received', $data_array);

                                    if($bank_id == '3'){                                    //ICICI BANK

                                    $data = '';
                                    $slno = '0';

                                        foreach($farmer_data as $row){

                                            $i = ++$slno;
                                          
                                            $data .= $i.'|'.$row->forward_trans_id.$row->book_no.'|'.$row->amount.'|'.'11'.'|'.$bank_data->acc_no.'|'.'THE WEST BENGAL STATE CO OPERATIVE MARKETING FEDERATION LTD(BENFED)'.'|'.'SMS'.'|'.'9674746908'.'|'.'THE WEST BENGAL STATE CO OPERATIVE MARKETING FEDERATION LTD(BENFED)'.'|'.$row->fifsc.'|'.'11'.'|'.$row->faccount.'|'.$row->farm_name.'|'.$row->bulk_id.'|'.'T'."\r\n";

                                        }
                                          
                                        $data = rtrim($data);   

                                        $datetime = strtotime(date('Y-m-d H:i:s'));
                                        
                                        $datetimes = date('dmY',$datetime);
                                        
                                        $filename = 'BENFED1_BENFED1H2HUPLD_'.$datetimes.'_'.$forward_bulk_trans_id.'.txt';
                                                      
                                       // $path = $_SERVER['DOCUMENT_ROOT'].'/downloads';

                                        if ( ! write_file(FCPATH .$bank_data->folder_path.$filename,$data)) {


                                          // echo 'Unable to write the file';

                                        } else {

                                          //  echo 'File written!';  
                                            
                                          
                                        }

                                    }elseif( $bank_id == '4' ){        //Axis Bank                                          

                                        $data = '';
                                        $trn_type = '';
                                    

                                        foreach($farmer_data as $row){
                                                
                                                    if(substr($row->fifsc,0,3) == 'UTI'){

                                                        $trn_type = "FT";
                                                            
                                                    }else{
                                                            $trn_type = "NE";
                                                    
                                                    }
                                        
                                          
                                            $data .= 'P^'.$trn_type.'^'.$bank_data->corporate_code.'^'.$row->forward_trans_id.$row->book_no.'^'.$bank_data->acc_no.'^'.date('Y-m-d').'^INR^'.$row->amount.'^'.$row->farm_name.'^'.substr($row->reg_no,16).'^'.$row->faccount.'^'.'10'.'^^^^^^^'.$row->fifsc.'^^^^^^^^^^^^^^^^^^^benfedpaddy1920@gmail.com^^^'."\r\n";

                                        }

                                        $data = rtrim($data);
                                    
                                        $datetime = strtotime(date('Y-m-d H:i:s'));
                                        
                                        $datetimes = date('Y_m_d_H_i_s',$datetime);
                                        
                                        $filename = 'TWBSCOMFL_'.$datetimes.'_'.$forward_bulk_trans_id.'.txt';
                                        
                                      if ( ! write_file(FCPATH .$bank_data->folder_path.$filename, $data) == FALSE)
                                    
                                        {
                                         //  echo 'Unable to write the file';
                                        

                                        } else {

                                          //  echo 'File written!';    

                                        }

                                    }elseif( $bank_id == '5' ){   //Hdfc Bank                                          

                                        $data = '';
                                        $trn_type = '';

                                    

                                        foreach($farmer_data as $row){
                                                
                                                    if(substr($row->fifsc,0,6) == 'HDFC00'){

                                                        $trn_type = "I";
                                                            
                                                    }else{
                                                            $trn_type = "N";
                                                    
                                                    }
                                        
                                          
                                        $data .= $trn_type.','.$row->reg_no.','.$row->faccount.','.$row->amount.','.$row->farm_name.',,,,,,,,,'.$row->forward_trans_id.$row->book_no.',,,,,,,,,'.date('d/m/Y').',,'.$row->fifsc.',,,benfedpaddy1920@gmail.com'."\r\n";

                                        }

                                        $data = rtrim($data);
                                    
                                       // $datetime = strtotime($trans_dt);

                                        $datetime = strtotime(date("Y-m-d"));
                                        $datetimes = date('dm',$datetime);

                                        $sl = time();
                                        
                                       // $serial_no = str_pad($hdfc_sl,3,"0",STR_PAD_LEFT);

                                        $serial_no =  substr($sl,7);
                                        
                                       $filename = 'WBSCMFL'.'_'.'908RBI'.'_'.'908RBI'.$datetimes.'.'.$serial_no;

                                      if (! write_file(FCPATH .$bank_data->folder_path.$filename, $data) == FALSE)
                                    
                                        {
                                         //  echo 'Unable to write the file';

                                        } else {

                                           // echo 'File written!';  
                                           
                                        }

                                    }

                                    echo "<script> alert('Procurement data forwarded successfully');
                                     window.location.href='".base_url()."index.php/paddys/transactions/f_paddycollection';
                                           </script>";
                            }else{

                                    echo "<script>alert('Procurement Data Not forwarded Problem In IFSC Code');
                                          window.location.href='".base_url()."index.php/paddys/transactions/f_paddycollection';
                                         </script>";

                                }
                               
                    }else{

                            echo "<script>alert('Procurement Data Not forwarded Problem In Quantity');
                                        window.location.href='".base_url()."index.php/paddys/transactions/f_paddycollection';
                                      </script>";

                    }

   
    }

    public function f_paddycol_return_forward() {
        

        $soc_id                = $this->input->get('soc_id');
        $trans_dt              = $this->input->get('trans_dt');
        $forward_bulk_trans_id = base64_decode($this->input->get('forward_bulk_trans_id'));
        $bulk_trans_id         = $this->input->get('bulk_trans_id');
        $valid                 = 0;

        $paddy_data    = $this->Paddy->coll_received($soc_id,$trans_dt,$bulk_trans_id);

        $paddy_forwad  = $this->Paddy->coll_forward($soc_id,$trans_dt,$bulk_trans_id);


        $bank_id       = $this->Paddy->bank_detail_for_forward($soc_id,$trans_dt,$bulk_trans_id);

        $bank_data     = $this->Paddy->f_get_particulars("md_paddy_bank", NULL,array("bank_id" => $bank_id), 1);

        $farmer_data   =  $this->Paddy->f_collection_details_icici($soc_id,$trans_dt,$forward_bulk_trans_id);
                    
        $data_array = array(

                "trans_dt"      =>  $paddy_data->trans_dt,                

                "kms_year"      =>  $this->session->userdata['loggedin']['kms_id'],

                "branch_id"     =>  $this->session->userdata['loggedin']['branch_id'],

                "dist"          =>  $this->session->userdata['loggedin']['dist_id'],

                "soc_id"        =>  $paddy_data->soc_id,       

                "mill_id"       =>  $paddy_data->mill_id,

                "paddy_qty"     =>  $paddy_data->quantity,

                "created_by"    =>  $this->session->userdata['loggedin']['user_name'],

                "created_dt"    =>  date('Y-m-d h:i:s')

            );

            foreach($paddy_forwad as $row){
                        
                                $dataf[] = array(

                                'forward_dt'              =>  date('Y-m-d h:i:s'),
                                'forward_bulk_trans_id'   =>  $row->forward_bulk_trans_id,
                                'forward_trans_id'        =>  $row->forward_trans_id,
                                'ifsc_code'               =>  $row->ifsc_code,
                                'acc_no'                  =>  $row->acc_no,
                                "forward_sl"              =>  $row->book_no,
                                "bank_id"                 =>  $row->bank_sl_no,
                                "kms_id"                  =>  $this->session->userdata['loggedin']['kms_id'],
                                "forwarded_by"            =>  $this->session->userdata['loggedin']['user_name']
                            
                                 );

            }
            

        $data     = $this->Paddy->f_ifsccode($trans_dt,$bulk_trans_id,$soc_id);

        $reg_qty  = $this->Paddy->f_regno_amt($trans_dt,$bulk_trans_id,$soc_id);

        $regvalid = 0;

        $qtyvalid = 0;


       foreach( $data as $value ) {
                  
                 if(strlen($value->ifsc_code)=="11"){
                    $valid = $valid+0;
                 }else{
                    $valid = $valid+1;
                 }
        }

        if($qtyvalid == '0'){

                            if($valid=='0'){  

                                    $this->Paddy->f_forward_return_paddycollection($trans_dt,$bulk_trans_id,$soc_id,$this->session->userdata['loggedin']['user_name'],date('Y-m-d h:i:s'));

                                    $this->Paddy->f_insert_multiple('td_collections_forward', $dataf);

                                   // $this->Paddy->f_insert('td_received', $data_array);

                                    if($bank_id == '3'){                                    //ICICI BANK

                                    $data = '';
                                    $slno = '0';

                                        foreach($farmer_data as $row){

                                            $i = ++$slno;
                                          
                                            $data .= $i.'|'.$row->forward_trans_id.$row->book_no.'|'.$row->amount.'|'.'11'.'|'.$bank_data->acc_no.'|'.'THE WEST BENGAL STATE CO OPERATIVE MARKETING FEDERATION LTD(BENFED)'.'|'.'SMS'.'|'.'9674746908'.'|'.'THE WEST BENGAL STATE CO OPERATIVE MARKETING FEDERATION LTD(BENFED)'.'|'.$row->fifsc.'|'.'11'.'|'.$row->faccount.'|'.$row->farm_name.'|'.$row->bulk_id.'|'.'T'."\r\n";

                                        }
                                          
                                        $data = rtrim($data);   

                                        $datetime = strtotime(date('Y-m-d H:i:s'));
                                        
                                        $datetimes = date('dmY',$datetime);
                                        
                                        $filename = 'BENFED1_BENFED1H2HUPLD_'.$datetimes.'_'.$forward_bulk_trans_id.'.txt';
                                                      
                                       // $path = $_SERVER['DOCUMENT_ROOT'].'/downloads';

                                        if ( ! write_file(FCPATH .$bank_data->folder_path.$filename,$data)) {


                                          // echo 'Unable to write the file';

                                        } else {

                                           // echo 'File written!';  
                                            
                                          
                                        }

                                    }elseif( $bank_id == '4' ){        //Axis Bank                                          

                                        $data = '';
                                        $trn_type = '';
                                    

                                        foreach($farmer_data as $row){
                                                
                                                    if(substr($row->fifsc,0,3) == 'UTI'){

                                                        $trn_type = "FT";
                                                            
                                                    }else{
                                                            $trn_type = "NE";
                                                    
                                                    }
                                        
                                          
                                            $data .= 'P^'.$trn_type.'^'.$bank_data->corporate_code.'^'.$row->forward_trans_id.$row->book_no.'^'.$bank_data->acc_no.'^'.date('Y-m-d').'^INR^'.$row->amount.'^'.$row->farm_name.'^'.substr($row->reg_no,16).'^'.$row->faccount.'^'.'10'.'^^^^^^^'.$row->fifsc.'^^^^^^^^^^^^^^^^^^^benfedpaddy1920@gmail.com^^^'."\r\n";

                                        }

                                        $data = rtrim($data);
                                    
                                        $datetime = strtotime(date('Y-m-d H:i:s'));
                                        
                                        $datetimes = date('Y_m_d_H_i_s',$datetime);
                                        
                                        $filename = 'TWBSCOMFL_'.$datetimes.'_'.$forward_bulk_trans_id.'.txt';
                                        
                                      if ( ! write_file(FCPATH .$bank_data->folder_path.$filename, $data) == FALSE)
                                    
                                        {
                                           //echo 'Unable to write the file';
                                        

                                        } else {

                                            //echo 'File written!';    

                                        }

                                    }elseif( $bank_id == '5' ){   //Hdfc Bank                                          

                                        $data = '';
                                        $trn_type = '';

                                    

                                        foreach($farmer_data as $row){
                                                
                                                    if(substr($row->fifsc,0,3) == 'HDF'){

                                                        $trn_type = "I";
                                                            
                                                    }else{
                                                            $trn_type = "N";
                                                    
                                                    }
                                        
                                          
                                        $data .= $trn_type.','.$row->reg_no.','.$row->faccount.','.$row->amount.','.$row->farm_name.',,,,,,,,,'.$row->forward_trans_id.$row->book_no.',,,,,,,,,'.date('d/m/Y').',,'.$row->fifsc.',,,benfedpaddy1920@gmail.com'."\r\n";

                                        }

                                        $data = rtrim($data);
                                    
                                        $datetime = strtotime(date('Y-m-d'));
                                        
                                        $datetimes = date('dm',$datetime);

                                        $serial_no = str_pad($bulk_trans_id,3,"0",STR_PAD_LEFT);
                                        
                                        $filename = 'WBSCMFL'.'_'.'908RBI'.'_'.'908RBI'.$datetimes.'.'.$serial_no;
                                        
                                      if ( ! write_file(FCPATH .$bank_data->folder_path.$filename, $data) == FALSE)
                                    
                                        {
                                          // echo 'Unable to write the file';

                                        } else {

                                          //  echo 'File written!';  
                                           
                                        }

                                    }

                                    echo "<script> alert('Procurement data forwarded successfully');
                                     window.location.href='".base_url()."index.php/paddys/transactions/failnefts';
                                           </script>";
                            }else{

                                    echo "<script>alert('Procurement Data Not forwarded Problem In IFSC Code');
                                          window.location.href='".base_url()."index.php/paddys/transactions/failnefts';
                                         </script>";

                                }
                               
                    }else{

                            echo "<script>alert('Procurement Data Not forwarded Problem In Quantity');
                                        window.location.href='".base_url()."index.php/paddys/transactions/failnefts';
                                      </script>";

                    }

   
    }

    // **************************** Code For Reading Files For  Developed By Lokesh On 11/11/2020"  *************************** //

    public function readfile(){

             $path       = $_SERVER['DOCUMENT_ROOT'].'/downloads/';

             $files = scandir($path,1);
             $newest_file = $files[0];
        
            $handle     = file_get_contents($path.$newest_file);
        
                    $var_array_parent = explode("\n",$handle);

                    foreach($var_array_parent as $value)
                    {

                    $var_array = explode("|",$value);
              

                   if ( ! isset($var_array[1])) {

                            $var_array[0]  = null;
                            $var_array[1]  = null;
                            $var_array[2]  = null;
                            $var_array[3]  = null;
                            $var_array[4]  = null;
                            $var_array[5]  = null;
                            $var_array[6]  = null;
                            $var_array[7]  = null;
                            $var_array[8]  = null;
                            $var_array[9]  = null;
                            $var_array[10] = null;
                            $var_array[11] = null;
                            $var_array[12] = null;
                            $var_array[13] = null;
                            $var_array[14] = null;
                            $var_array[15] = null;


                    }

                    $data = array(
                                'r1'   => $var_array[0],
                                'r2'   => $var_array[1],
                                'r3'   => $var_array[2],
                                'r4'   => $var_array[3],
                                'r5'   => $var_array[4],
                                'r6'   => $var_array[5],
                                'r7'   => $var_array[6],
                                'r8'   => $var_array[7],
                                'r9'   => $var_array[8],
                                'r10'  => $var_array[9],
                                'r11'  => $var_array[10],
                                'r12'  => $var_array[11],
                                'r13'  => $var_array[12],
                                'r14'  => $var_array[13],
                                'r15'  => $var_array[14],
                                'r16'  => $var_array[15]
                                );

                        if ( isset($var_array[0])) {

                        $this->db->insert('icici_bank_record',$data);

                        }

                    }


            $filePath = $path.$newest_file;
  
            /* Store the path of destination file */
            $destinationFilePath = 'downloads/'.$newest_file;
              
            /* Move File from images to copyImages folder */

            copy($filePath, $destinationFilePath);

            unlink($filePath);
       
     }

   
}    