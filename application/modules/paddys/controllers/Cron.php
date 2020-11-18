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

   
}    