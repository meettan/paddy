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

        $kms_yerr_data = $this->db->query('SELECT * FROM `md_kms_year` 
                                        where sl_no = (select max(sl_no) from md_kms_year)')->row();

             $kms_year  = $kms_yerr_data->kms_yr;
             $kms_id    = $kms_yerr_data->sl_no;

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

                         if ( isset($var_array[11])) {

                    $data[] = array(
                                'kms_id'              => $kms_id,
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
                                'file_no'             => $var_array[17],
                                'update_flag'         => 'N',
                                'created_dt'          => date("Y-m-d h:i:s")
                                );

                   

                        //$this->db->insert('td_reverse_feed',$data);

                        }

                    }

                    $this->db->insert_batch('td_reverse_feed', $data);


            $filePath = $path.$newest_file;
  
            /* Store the path of destination file */
            $destinationFilePath = $_SERVER['DOCUMENT_ROOT'].'/downloads/'.$newest_file;
              
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

           $kms_yerr_data = $this->db->query('SELECT * FROM `md_kms_year` 
                                        where sl_no = (select max(sl_no) from md_kms_year)')->row();

             $kms_year  = $kms_yerr_data->kms_yr;
             $kms_id    = $kms_yerr_data->sl_no;

             $newest_file = null;
             $path        = $_SERVER['DOCUMENT_ROOT'].'/icici/PayReport/';

             $files       = scandir($path,1); 
             $newest_file = $files[1];
             $handle      = file_get_contents($path.$newest_file);

                    $var_array_parent = explode("\n",$handle);

                     unset($var_array_parent[0]);

                    foreach($var_array_parent as $value)
                    {

                       
                    $var_array = explode("|",$value);
              

                   if ( ! isset($var_array[2])) {

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
                            $var_array[18] = null;
                            $var_array[19] = null;
                            $var_array[20] = null;
                            $var_array[21] = null;
                          
                    }

                    $timestamp = strtotime(str_replace('/', '-', $var_array[4]));

                       if( isset($var_array[2])) {

                    $data[] = array(
                                'kms_id'              => $kms_id,
                                'bank_id'             => '3',
                                'forward_trans_id'    => substr($var_array[1], 0, -1),
                                'book_no'             => substr($var_array[1],-1),
                                'corporate_code'      => '',
                                'payment_run_date'    => date('Y-m-d',$timestamp),
                                'product_code'        => "ICICI",
                                'utr_no'              => '',
                                'status_code'         => $var_array[13],
                                'status_description'  => $var_array[15].' '.$var_array[16],
                                'batch_no'            => '',
                                'reg_no'              => '',
                                'value_date'          => date('Y-m-d',$timestamp),
                                'bank_ref_no'         => $var_array[2],
                                'amount'              => $var_array[3],
                                'dr_ac_no'            => $var_array[7],
                                'dr_ifsc_code'        => $var_array[5],
                                'dr_cr_flag'          => "C",
                                'cr_acc_no'           => $var_array[11],
                                'file_no'             => $var_array[17],
                                'update_flag'         => 'N',
                                'created_dt'          => date("Y-m-d h:i:s")
                                );


                    // $bata[] = array(
                    //             'kms_id'              => $kms_id,
                    //             'bank_id'             => '3',
                    //             'forward_trans_id'    => substr($var_array[1], 0, -1),
                    //             'book_no'             => substr($var_array[1],-1),
                               
                    //             'update_flah'         => 'N',
                    //             );
                         }

                    }

                     $this->db->insert_batch('td_reverse_feed', $data);

                    // $this->db->update();


            $filePath = $path.$newest_file;
  
            /* Store the path of destination file */
            $destinationFilePath = $_SERVER['DOCUMENT_ROOT'].'/downloads/icici/'.$newest_file;
              
            /* Move File from images to copyImages folder */

            // if(strlen($newest_file) > 4){

                copy($filePath, $destinationFilePath);

                unlink($filePath);

            // }else{

            //     echo "File Does Not Exit";

            // }
       
    }


    public function update_neft_status(){


        $sql = "UPDATE `td_reverse_feed` SET `update_flag` = 'Y' where update_flag = 'N' ";

        $this->db->query($sql);


       
    }

     //   Code for hdfc reverse file read and store in download folder 18/12/2020  //
    public function read_hdfc_reversefile(){

             $kms_yerr_data = $this->db->query('SELECT * FROM `md_kms_year` 
                                        where sl_no = (select max(sl_no) from md_kms_year)')->row();

             $kms_year  = $kms_yerr_data->kms_yr;
             $kms_id    = $kms_yerr_data->sl_no;

             $newest_file = null;

             $path        = $_SERVER['DOCUMENT_ROOT'].'/hdfc/hdfcreverse/rev1/';

             $files       = scandir($path,1);
            
             $newest_file = $files[0];
		     $year_h      = '';
             $month_h     = '';
			 $date_h      = '';
    
              
             $handle      = file_get_contents($path.$newest_file);

                    $var_array_parent = explode("\n",$handle);

                    // unset($var_array_parent[0]);
                      

                    foreach($var_array_parent as $value)
                    {


                    $var_array = explode(",",$value);

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
                            $var_array[18] = null;
                          
                    }

                    if($var_array[11] == 'E'){

                         $status  = 'SUCCESS';

                    }else{

                         $status  = 'REJECTED';
                    }
                           

                      $datess = explode('/',$var_array[5]);
                      $year_h  = isset($datess[2]) ? $datess[2] : '';
					  $month_h = isset($datess[1]) ? $datess[1] : '';
					  $date_h  = isset($datess[0]) ? $datess[0] : '';
					  
                     if($year_h!='') {      
                     $pay_date = $year_h.'-'.$month_h.'-'.$date_h;
					 }
						
                    $data = array(
                                'kms_id'              => $kms_id,
                                'bank_id'             => '5',
                                'forward_trans_id'    => substr($var_array[6], 0, -1),
                                'book_no'             => substr($var_array[6],-1),
                                'corporate_code'      => '',
                                'payment_run_date'    => $pay_date,
                                'product_code'        => "HDFC",
                                'utr_no'              => $var_array[10],
                                'status_code'         => $status,
                                'status_description'  => $var_array[12],
                                'batch_no'            => '',
                                'reg_no'              => $var_array[1],
                                'value_date'          => $pay_date,
                                'bank_ref_no'         => $var_array[10],
                                'amount'              => $var_array[3],
                                'dr_ac_no'            => "",
                                'dr_ifsc_code'        => $var_array[13],
                                'dr_cr_flag'          => "C",
                                'cr_acc_no'           => $var_array[9],
                                'file_no'             => "",
                                'created_dt'          => date("Y-m-d h:i:s")
                                );

                        if ( isset($var_array[2])) {

                        $this->db->insert('td_reverse_feed',$data);

                        }

                    }


            $filePath = $path.$newest_file;
  
            /* Store the path of destination file */
            $destinationFilePath = $_SERVER['DOCUMENT_ROOT'].'/downloads/HDFC/'.$newest_file;
              
            /* Move File from images to copyImages folder */

            if(strlen($newest_file) > 4){

                copy($filePath, $destinationFilePath);

                unlink($filePath);

            }else{

                echo "File Does Not Exit";

            }
       
    }

     //   Code for hdfc reverse file read and store in download folder 04/03/2020  //
    public function read_hdfc_reversefile_second(){

             $kms_yerr_data = $this->db->query('SELECT * FROM `md_kms_year` 
                                        where sl_no = (select max(sl_no) from md_kms_year)')->row();

             $kms_year  = $kms_yerr_data->kms_yr;
             $kms_id    = $kms_yerr_data->sl_no;

             $newest_file = null;

            $path        = $_SERVER['DOCUMENT_ROOT'].'/hdfc/hdfcreverse/cmsrev2/';
             
            $files       = scandir($path,1);
            
            $newest_file = $files[0];
        
         
             $handle      = file_get_contents($path.$newest_file);

                    $var_array_parent = explode("\n",$handle);
                     unset($var_array_parent[0]);


                    foreach($var_array_parent as $value)
                    {


                    $var_array = explode(",",$value);


                   
                   if ( ! isset($var_array[5])) {

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
                            $var_array[18] = null;
                            $var_array[19] = null;
                            $var_array[20] = null;
                            $var_array[21] = null;
                            $var_array[22] = null;
                            $var_array[23] = null;
                          
                    }


                      if (isset($var_array[5])) {

                      $status  = 'REJECTED';
                 
                      //$datess = explode('/',$var_array[6]);
                         $datess = substr($var_array[6],0,10);
                          
                           $day     = substr($datess,3,2);
                           $month  = substr($datess,0,2);
                           $year     = substr($datess,6,4);
                     
                      $select = array("forward_trans_id","book_no","reg_no");
                      $where  = array("cheque_no" => $var_array[5],'kms_id' => $kms_id);

                     
                      $result = $this->Paddy->f_get_particulars('td_collections',$select,$where,1);
						  
						  //echo $this->db->last_query();die;

                      //echo   $pay_date = substr($datess[2],0,4).'-'.$datess[1].'-'.$datess[0];
                         $pay_date = $year.'-'.$month.'-'.$day;
                  
                    $data = array(
                                'kms_id'              => $kms_id,
                                'bank_id'             => '5',
                                'forward_trans_id'    => $result->forward_trans_id,
                                'book_no'             => $result->book_no,
                                'corporate_code'      => '',
                                'payment_run_date'    => $pay_date,
                                'product_code'        => "HDFC",
                                'utr_no'              => $var_array[5],
                                'status_code'         => $status,
                                'status_description'  => $var_array[17].$var_array[19],
                                'batch_no'            => $var_array[1],
                                'reg_no'              => $result->reg_no,
                                'value_date'          => $pay_date,
                                'bank_ref_no'         => $var_array[4],
                                'amount'              => $var_array[8],
                                'dr_ac_no'            => "",
                                'dr_ifsc_code'        => $var_array[12],
                                'dr_cr_flag'          => "C",
                                'cr_acc_no'           => $var_array[11],
                                'file_no'             => "",
                                'created_dt'          => date("Y-m-d h:i:s")
                                );

                        if ( isset($var_array[5])) {

                            
                        $this->db->insert('td_reverse_feed',$data);

                        }

                    }
                }    

            $filePath = $path.$newest_file;
  
            /* Store the path of destination file */
            $destinationFilePath = $_SERVER['DOCUMENT_ROOT'].'/downloads/HDFC/return/'.$newest_file;
              
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
      
        $context  = stream_context_create($options);
        $result   = file_get_contents($url, false, $context);


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

 //   Society update using Food Api  10/12/2020 //

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
                            'created_by'   =>  "API DATA",
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

    public function procurement_add(){

         $kms_yerr_data = $this->db->query('SELECT * FROM `md_kms_year` 
                                        where sl_no = (select max(sl_no) from md_kms_year)')->row();

             $kms_year  = $kms_yerr_data->kms_yr;
             $kms_id    = $kms_yerr_data->sl_no;
         
            $url = 'https://procurement.wbfood.in/api/Statusupd/Procurementdtls';/*Procurement*/
            $date = date('Y-m-d');

           //$date = '2021-01-21';

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
           

                $trans_id = $this->Paddy->f_get_particulars("td_collections",array("ifnull(MAX(trans_id),0) trans_id"),array('kms_id' => $kms_id), 1);

                $ftrans_id = $this->Paddy->f_get_particulars("td_collections",array("ifnull(MAX(trans_id),0) trans_id"),array('kms_id' => $kms_id), 1);
              
                $trans_id = $trans_id->trans_id + 1;

                $for_trans_id = $ftrans_id->trans_id + 1;
                
                   foreach ($datas as $value) {

                    $district_code   = get_society_branch_id($value->proccentreid);  

                    $raw_date = substr($value->dtofprocurement,0,10);

                    $dates = explode('/',$raw_date);

                    $trans_dt = $dates[2].'-'.$dates[1].'-'.$dates[0];

                    $dist_sort_code  = get_district_short_code($district_code) ;

                $count = $this->db->get_where('td_collections', array('reg_no' => $value->regno,'trans_dt' => $trans_dt))->num_rows();

                if( $count == 0 ){
                        
                    $data = array(

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

                        "farmer_name"         =>  $value->NAME,

                        "quantity"            =>  ($value->qty_kg)/100,

                        "amount"              =>  $value->amt,

                        "cheque_no"           =>  "",

                        "cheque_date"         =>  "",

                        "ifsc_code"           =>  $value->bank_ifsc,

                        "acc_no"              =>  $value->bank_accno,

                        "certificate_1"       =>  "N",

                        "certificate_2"       =>  "N",

                        "certificate_4"       =>  "N",

                        "created_dt"          =>  date('Y-m-d h:i:s')

                     );
                        
                    $this->Paddy->f_insert('td_collections', $data);  

                   }                 
                }  
           
            //For notification storing message
          //  $this->session->set_flashdata('msg', 'Successfully added!');

           // redirect('paddys/transactions/f_paddycollection');

    }

    public function paddy_despatch(){

         $kms_yerr_data = $this->db->query('SELECT * FROM `md_kms_year` 
                                        where sl_no = (select max(sl_no) from md_kms_year)')->row();

            $kms_year  = $kms_yerr_data->kms_yr;
            $kms_id    = $kms_yerr_data->sl_no;
         
            $url = 'https://procurement.wbfood.in/api/Statusupd/Dispatcheddtls'; /*Dispatch*/
            $date = date('Y-m-d');

            //$date  = '2020-11-23';

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
                
                   foreach ($datas as $value) {

                    $district_code   = get_society_branch_id($value->proccentreid);  

                    $dt_despatch = substr($value->dt_despatch,0,10);

                    $api_time    = substr($value->dt_despatch,11,9);

                    $dates = explode('/',$dt_despatch);

                    $trans_dt = $dates[2].'-'.$dates[1].'-'.$dates[0];

                    $api_date_time = $trans_dt.' '.$api_time;

                $count = $this->db->get_where('td_received', array('soc_id' => $value->proccentreid,'mill_id' => $value->ricemillcode,'api_date' => $api_date_time))->num_rows();

                if( $count == 0 ){
                        
                        $data = array(

                            "trans_dt"           =>  $trans_dt,

                            "api_date"           =>  $api_date_time,

                            "kms_year"           =>  $kms_id,

                            "branch_id"          =>  $district_code,

                            "dist"               =>  $district_code,

                            "soc_id"             =>  $value->proccentreid,

                            "mill_id"            =>  $value->ricemillcode,

                            "paddy_qty"          =>  $value->despqty/100,

                            "created_by"         =>  'API DATA',
     
                            "created_dt"         =>  date('Y-m-d h:i:s')

                         );
                        
                    $this->Paddy->f_insert('td_received', $data);  

                   }                 
                }  
           
            //For notification storing message
            $this->session->set_flashdata('msg', 'Successfully added!');

            redirect('paddys/transactions/f_received');

    }
//****  Code is written for test of datainsertion in table and missing data from insertion  06/01/2021  ******///
    public function paddy_despatch_temp(){

         /*$kms_yerr_data = $this->db->query('SELECT * FROM `md_kms_year` 
                                        where sl_no = (select max(sl_no) from md_kms_year)')->row();

            $kms_year  = $kms_yerr_data->kms_yr;
            $kms_id    = $kms_yerr_data->sl_no;*/

           // $delete = $this->Paddy->deletetemp_table();
         
            $url = 'https://procurement.wbfood.in/api/Statusupd/Dispatcheddtls'; /*Dispatch*/
            $date = date('Y-m-d');

            //$date  = '2020-11-23';

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

                
                   foreach ($datas as $value) {

                    //$district_code   = get_society_branch_id($value->proccentreid);  

                    $dt_despatch     = substr($value->dt_despatch,0,10);

                    $api_time        = substr($value->dt_despatch,11,9);

                    $dates           = explode('/',$dt_despatch);

                    $trans_dt        =  $dates[2].'-'.$dates[1].'-'.$dates[0];

                    $api_date_time   = $trans_dt.' '.$api_time;

                // $count = $this->db->get_where('td_received', array('soc_id' => $value->proccentreid,'mill_id' => $value->ricemillcode,'api_date' => $api_date_time))->num_rows();

              //  if( $count == 0 ){
                        
                        $data = array(

                            "trans_dt"           =>  $trans_dt,

                            "api_date"           =>  $api_date_time,

                            "kms_year"           =>  3,

                            "branch_id"          =>  0,

                            "dist"               =>  0,

                            "soc_id"             =>  $value->proccentreid,

                            "mill_id"            =>  $value->ricemillcode,

                            "paddy_qty"          =>  $value->despqty/100,

                            "created_by"         =>  'API DATA',
     
                            "created_dt"         =>  date('Y-m-d h:i:s')

                         );
                        
                    $this->Paddy->f_insert('td_received_temp', $data);  

                //   }                 
                }  
           
            //For notification storing message
           // $this->session->set_flashdata('msg', 'Successfully added!');

           // redirect('paddys/transactions/f_received');

    }
	
	//   Code for hdfc reject file read and store in download folder 18/12/2020  //
     public function read_hdfc_rejectfile(){                    

        $kms_yerr_data = $this->db->query('SELECT * FROM `md_kms_year` 
                                   where sl_no = (select max(sl_no) from md_kms_year)')->row();

        $kms_year  = $kms_yerr_data->kms_yr;
        $kms_id    = $kms_yerr_data->sl_no;

        $newest_file = null;

        $path        = $_SERVER['DOCUMENT_ROOT'].'/hdfcreject/';

        $files       = scandir($path,1);
       
        $newest_file = $files[0];
        $year_h      = '';
        $month_h     = '';
        $date_h      = '';

        echo $newest_file;
         
        $handle      = file_get_contents($path.$newest_file);

               $var_array_parent = explode("\n",$handle);

               // unset($var_array_parent[0]);
                 

               foreach($var_array_parent as $value)
               {


               $var_array = explode(",",$value);

              if ( ! isset($var_array[5])) {

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
               }

               
                    $status  = 'REJECTED';
               
                      

                 $datess = explode('/',$var_array[6]);
                 //$datess = trim($datess);
                 $year_h  = trim(isset($datess[2]) ? $datess[2] : '');
                 $month_h = trim(isset($datess[1]) ? $datess[1] : '');
                 $date_h  = trim(isset($datess[0]) ? $datess[0] : '');
                 
                if($year_h!='') {      
                $pay_date = $year_h.'-'.$month_h.'-'.$date_h;
                }
               
               $data = array(
                           'kms_id'              => $kms_id,
                           'bank_id'             => '5',
                           'forward_trans_id'    => trim(substr($var_array[5], 0, -1)),
                           'book_no'             => trim(substr($var_array[5],-1)),
                           'corporate_code'      => '',
                           'payment_run_date'    => $pay_date,
                           'product_code'        => "HDFC",
                           'utr_no'              => '',
                           'status_code'         => trim($status),
                           'status_description'  => trim($var_array[10]),
                           'batch_no'            => '',
                           'reg_no'              => trim($var_array[1]),
                           'value_date'          => $pay_date,
                           'bank_ref_no'         => '',
                           'amount'              => $var_array[3],
                           'dr_ac_no'            => "",
                           'dr_ifsc_code'        => $var_array[7],
                           'dr_cr_flag'          => "C",
                           'cr_acc_no'           => trim($var_array[2]),
                           'file_no'             => "",
                           'created_dt'          => date("Y-m-d h:i:s")
                           );

                   if ( isset($var_array[2])) {

                   $this->db->insert('td_reverse_feed',$data);

                   }

               }


       $filePath = $path.$newest_file;

       /* Store the path of destination file */
       $destinationFilePath = $_SERVER['DOCUMENT_ROOT'].'/downloads/HDFC/reject/'.$newest_file;

         
       /* Move File from images to copyImages folder */

       if(strlen($newest_file) > 4){

           copy($filePath, $destinationFilePath);

           unlink($filePath);

       }else{

           echo "File Does Not Exit";

       }
  
}

   
}    