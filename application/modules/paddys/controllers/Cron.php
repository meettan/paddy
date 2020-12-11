<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Cron extends MX_Controller {

    public function __construct(){

        parent::__construct();

        $this->load->library('form_validation');
        //$this->load->library('lib/openpgp');
        $this->load->model('Paddy');
        $this->load->helper('paddyrate');
        $this->load->helper('file');
      
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

  // **************************** Code For Reading Axis Bank Files For Developed By Lokesh On 18/11/2020"  *************************** //

    public function read_axis_reversefile(){

             $newest_file = null;
             $path        = $_SERVER['DOCUMENT_ROOT'].'/AxisInvoice/h2hReversefeedIn/';
             $files       = scandir($path,1);
             $newest_file = $files[0];
              
             $handle      = file_get_contents($path.$newest_file);

                    $var_array_parent = explode("\n",$handle);

                    foreach($var_array_parent as $value)
                    {

                    $var_array = explode("^",$value);
              

                   if ( ! isset($var_array[11])) {

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
                            $var_array[16] = null;
                            $var_array[17] = null;
                          
                    }

                    $data = array(
                                'bank_id'             => '4',
                                'forward_trans_id'    => substr($var_array[0], 0, -1),
                                'book_no'             => substr($var_array[0],-1),
                                'corporate_code'      => $var_array[1],
                                'payment_run_date'    => $var_array[2],
                                'product_code'        => $var_array[3],
                                'utr_no'              => $var_array[4],
                                'status_code'         => $var_array[6],
                                'status_description'  => $var_array[7],
                                'batch_no'            => $var_array[8],
                                'reg_no'              => $var_array[9],
                                'value_date'          => $var_array[10],
                                'bank_ref_no'         => $var_array[11],
                                'amount'              => $var_array[12],
                                'dr_ac_no'            => $var_array[13],
                                'dr_ifsc_code'        => $var_array[14],
                                'dr_cr_flag'          => $var_array[15],
                                'cr_acc_no'           => $var_array[16],
                                'file_no'             => $var_array[17]
                                );

                        if ( isset($var_array[11])) {

                        $this->db->insert('td_reverse_feed',$data);

                        }

                    }


            $filePath = $path.$newest_file;
  
            /* Store the path of destination file */
            $destinationFilePath = 'downloads/'.$newest_file;
              
            /* Move File from images to copyImages folder */

            if(strlen($newest_file) > 4){

                copy($filePath, $destinationFilePath);

                unlink($filePath);

            }else{

                echo "File Does Not Exit";

            }
       
    }

    //   Code for icici reverse file read and store in download folder   11/12/2020  //
    public function read_icici_reversefile(){

             $newest_file = null;
             $path        = $_SERVER['DOCUMENT_ROOT'].'/AxisInvoice/h2hReversefeedIn/';
             $files       = scandir($path,1);
             $newest_file = $files[0];
              
             $handle      = file_get_contents($path.$newest_file);

                    $var_array_parent = explode("\n",$handle);

                    foreach($var_array_parent as $value)
                    {

                    $var_array = explode("^",$value);
              

                   if ( ! isset($var_array[11])) {

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
                            $var_array[16] = null;
                            $var_array[17] = null;
                          
                    }

                    $data = array(
                                'bank_id'             => '4',
                                'forward_trans_id'    => substr($var_array[0], 0, -1),
                                'book_no'             => substr($var_array[0],-1),
                                'corporate_code'      => $var_array[1],
                                'payment_run_date'    => $var_array[2],
                                'product_code'        => $var_array[3],
                                'utr_no'              => $var_array[4],
                                'status_code'         => $var_array[6],
                                'status_description'  => $var_array[7],
                                'batch_no'            => $var_array[8],
                                'reg_no'              => $var_array[9],
                                'value_date'          => $var_array[10],
                                'bank_ref_no'         => $var_array[11],
                                'amount'              => $var_array[12],
                                'dr_ac_no'            => $var_array[13],
                                'dr_ifsc_code'        => $var_array[14],
                                'dr_cr_flag'          => $var_array[15],
                                'cr_acc_no'           => $var_array[16],
                                'file_no'             => $var_array[17]
                                );

                        if ( isset($var_array[11])) {

                        $this->db->insert('td_reverse_feed',$data);

                        }

                    }


            $filePath = $path.$newest_file;
  
            /* Store the path of destination file */
            $destinationFilePath = 'downloads/icici'.$newest_file;
              
            /* Move File from images to copyImages folder */

            if(strlen($newest_file) > 4){

                copy($filePath, $destinationFilePath);

                unlink($filePath);

            }else{

                echo "File Does Not Exit";

            }
       
    }

    public function farmer_update(){

        $date = date('Y-m-d',strtotime("-1 days"));
        $url = 'https://procurement.wbfood.in/api/Statusupd/Framerregdtls';/*Farmer*/
        $j=0;
        
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

       

        $data   = json_decode($result);

        foreach ($data as $value) {

                    $dates = explode('/',$value->regdt);

                    $reg_date = $dates[2].'-'.$dates[1].'-'.$dates[0];

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

                    $query = $this->db->get_where('td_farmer_reg', array('reg_no ='=> $value->regno));
            
                        if ($query->num_rows() == 0)
                            {   
                               $id = $this->Paddy->f_insert('td_farmer_reg', $data);  
                                if(isset($id)){
                                    $j++;
                                }  
                           }

            }

    }

     public function procurement_add(){

         $kms_yerr_data = $this->db->query('SELECT * FROM `md_kms_year` 
                                        where sl_no = (select max(sl_no) from md_kms_year)')->row();

             $kms_year  = $kms_yerr_data->kms_yr;
             $kms_id    = $kms_yerr_data->sl_no;
         
            $url = 'https://procurement.wbfood.in/api/Statusupd/Procurementdtls';/*Procurement*/
            $date = '2020-11-23';

            $date1 = date("d/m/Y", strtotime($date));
    
            $data_auth = array('authcode' => 'ahtr*125#','dt_from' => $date1);

            $options = array(
                'http' => array(
                    'header' => "Content-type: application/x-www-form-urlencoded\r\n",
                    'method' => 'POST',
                    'content' => http_build_query($data_auth)
                )
            );
  

            $context = stream_context_create($options);
            $result  = file_get_contents($url, false, $context);
            $datas   = json_decode($result);
            $trans_type     = "N";

            $district_code   = get_society_branch_id($datas['0']->proccentreid);  

             foreach ($datas as $value);

      

                $trans_id = $this->Paddy->f_get_particulars("temp_td_collection",array("ifnull(MAX(trans_id),1) trans_id"),array('kms_id' => $kms_id), 1);

                $ftrans_id = $this->Paddy->f_get_particulars("temp_td_collection",array("ifnull(MAX(trans_id),1) trans_id"),array('kms_id' => $kms_id), 1);
              
                $trans_id = $trans_id->trans_id;

                $for_trans_id = $ftrans_id->trans_id;
                
                    
                   foreach ($datas as $value) {

                    $raw_date = substr($value->dtofprocurement,0,10);

                    $dates = explode('/',$raw_date);

                    $trans_dt = $dates[2].'-'.$dates[1].'-'.$dates[0];

                    $dist_sort_code  = get_district_short_code($district_code) ;
                        
                    $data[] = array(

                        "kms_id"              =>  $kms_id,

                        "camp_no"             =>  "1",

                        "branch_id"           =>  $district_code,

                        "block_id"            =>  get_society_block_id($value->proccentreid),

                        "soc_id"              =>  $value->proccentreid,

                        "mill_id"             =>  '',

                        "muster_roll_no"      =>  "1",
 
                        "trans_dt"            =>  $trans_dt,

                        "trans_id"            =>  $trans_id++,

                        'forward_trans_id'    =>  $district_code.str_pad($for_trans_id++,8,"0",STR_PAD_LEFT),

                        "bulk_trans_id"       => "",

                        'forward_bulk_trans_id' =>  "",

                        "bank_sl_no"          => "",

                        "trans_type"          =>  "N",

                        "reg_no"              =>  $value->regno,

                        "farmer_name"         =>  $value->name,

                        "quantity"            =>  ($value->qty_kg)/100,

                        "amount"              =>  $value->amt,

                        "cheque_no"           =>  "",

                        "cheque_date"         =>  "",

                        "ifsc_code"           =>  $value->bank_ifsc,

                        "acc_no"              =>  $value->bank_accno,

                        "certificate_1"       =>  "Y",

                        "certificate_2"       =>  "Y",

                        "certificate_4"       =>  "Y",

                        "created_dt"          =>  date('Y-m-d h:i:s')

                     );
                                    
                }  
                    
                $data = array_values($data);

            
                $this->Paddy->f_insert_multiple('temp_td_collection', $data);
           
            //For notification storing message
            $this->session->set_flashdata('msg', 'Successfully added!');

            redirect('paddys/transactions/f_paddycollection');

    }

   
}    