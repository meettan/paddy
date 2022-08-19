<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Reports extends MX_Controller {

    public function __construct(){

        parent::__construct();

        $this->load->model('Paddyrep');
        $this->load->model('Paddy');
        $this->load->model('Login_Process');
        $this->load->helper('paddyrate');
        
        //For User's Authentication
        if(!isset($this->session->userdata['loggedin']['user_id'])){
            
            redirect('User_Login/login');

        }
        
    }

    public function f_socProc(){            

        if($_SERVER['REQUEST_METHOD']=='POST'){

            $kms_id     = $this->session->userdata['loggedin']['kms_id'];

            $branch_id  = $this->session->userdata['loggedin']['branch_id'];

            $block_id    = $this->input->post('block');

            $from_dt    = $this->input->post('from_date');

            $to_dt      = $this->input->post('to_date');

            $socProc['socDtls']    =   $this->Paddyrep->f_get_soc($branch_id,$block_id);

            $socProc['reg']        =   $this->Paddyrep->f_get_reg_farm($branch_id,$from_dt,$to_dt,$block_id);

            $socProc['collc']      =   $this->Paddyrep->f_get_collc($branch_id,$from_dt,$to_dt,$block_id);

            $socProc['cmr']        =   $this->Paddyrep->f_get_cmr($branch_id,$from_dt,$to_dt,$block_id);

            $socProc['offer']      =   $this->Paddyrep->f_get_offer($branch_id,$from_dt,$to_dt,$block_id);

            $socProc['delv']       =   $this->Paddyrep->f_get_delv($branch_id,$from_dt,$to_dt,$block_id);

            $socProc['remain']     =   $this->Paddyrep->f_get_remain($branch_id,$from_dt,$to_dt,$block_id,$kms_id);
            
            
            $this->load->view('post_login/main');

          //  $this->load->view("reports/soc_proc/socProcDt.php", $socProc);
		    $this->load->view("reports/soc_proc/socProcDt.php", $socProc);

            $this->load->view('post_login/footer');


        }else{

            $socProc['sys_date']   =   $_SESSION['sys_date'];

            $where      =   array(

                "branch_id" =>$this->session->userdata['loggedin']['branch_id']
            );

            $socProc['blocks']  =   $this->Paddy->f_get_particulars("md_block",NULL,$where, 0);

            $this->load->view('post_login/main');

            $this->load->view("reports/soc_proc/socProcDt.php", $socProc);

            $this->load->view('post_login/footer');
        }
    }

    public function f_distProcho(){                 /**Districtwise Procurement Summary Report at HO */                   

        if($_SERVER['REQUEST_METHOD']=='POST'){

            $kms_id     = $this->session->userdata['loggedin']['kms_id'];

            //$branch_id  = $this->input->post('dist');

            $from_dt    = $this->input->post('from_date');

            $to_dt      = $this->input->post('to_date');

            $distProc['procDtls']   =   $this->Paddyrep->f_get_dist_proc($from_dt,$to_dt);

            $distProc['cmr']        =   $this->Paddyrep->f_get_cmr_dist($from_dt,$to_dt);

            $distProc['offer']      =   $this->Paddyrep->f_get_offer_dist($from_dt,$to_dt);

            $distProc['delv']       =   $this->Paddyrep->f_get_delv_dist($from_dt,$to_dt,$kms_id);

            $distProc['remain']     =   $this->Paddyrep->f_get_remain_dist($from_dt,$to_dt,$kms_id);

            $this->load->view('post_login/main');

            $this->load->view("reports/dist_proc/distProcDt.php", $distProc);

            $this->load->view('post_login/footer');


        }else{

            $socProc['sys_date']   =   $_SESSION['sys_date'];

            $socProc['dists']  =   $this->Paddy->f_get_particulars("md_district",NULL,NULL, 0);

            $this->load->view('post_login/main');

            $this->load->view("reports/dist_proc/distProcDt.php", $socProc);

            $this->load->view('post_login/footer');
        }
    }

    /*public function f_distPayHo(){                                         

        if($_SERVER['REQUEST_METHOD']=='POST'){

            $kms_id     = $this->session->userdata['loggedin']['kms_id'];

            $from_dt    = $this->input->post('from_date');

            $to_dt      = $this->input->post('to_date');

            $distPay['pay']           =   $this->Paddyrep->f_get_dist_pay($from_dt,$to_dt);

            $distPay['procDtls']      =   $this->Paddyrep->f_get_dist_proc($from_dt,$to_dt);

            $distPay['pendingDtls']   =   $this->Paddyrep->f_get_pending_pay($from_dt,$to_dt);

            $this->load->view('post_login/main');

            $this->load->view("reports/dist_pay/distPayDt.php", $distPay);

            $this->load->view('post_login/footer');


        }else{

            $socProc['sys_date']   =   $_SESSION['sys_date'];

            $socProc['dists']  =   $this->Paddy->f_get_particulars("md_district",NULL,NULL, 0);

            $this->load->view('post_login/main');

            $this->load->view("reports/dist_pay/distPayDt.php", $socProc);

            $this->load->view('post_login/footer');
        }
    }*/

    public function f_socProcho(){                          /**Societywise Procurement Summary Report at HO */ 

        if($_SERVER['REQUEST_METHOD']=='POST'){

            $kms_id     = $this->session->userdata['loggedin']['kms_id'];

            $branch_id  = $this->input->post('dist');

            $from_dt    = $this->input->post('from_date');

            $to_dt      = $this->input->post('to_date');

            $socProc['socDtls']    =   $this->Paddyrep->f_get_soc_ho($branch_id,$kms_id);

            //$socProc['reg']        =   $this->Paddyrep->f_get_reg_farm_ho($branch_id,$from_dt,$to_dt,$kms_id);

            $socProc['collc']      =   $this->Paddyrep->f_get_collc_ho($branch_id,$from_dt,$to_dt);

            $socProc['cmr']        =   $this->Paddyrep->f_get_cmr_ho($branch_id,$from_dt,$to_dt);

            $socProc['offer']      =   $this->Paddyrep->f_get_offer_ho($branch_id,$from_dt,$to_dt);

            $socProc['delv']       =   $this->Paddyrep->f_get_delv_ho($branch_id,$from_dt,$to_dt,$kms_id);

            $socProc['remain']     =   $this->Paddyrep->f_get_remain_ho($branch_id,$from_dt,$to_dt,$kms_id);

            $this->load->view('post_login/main');

            $this->load->view("reports/soc_proc/socProcDt_ho.php", $socProc);

            $this->load->view('post_login/footer');


        }else{

            $socProc['sys_date']   =   $_SESSION['sys_date'];

            $socProc['dists']  =   $this->Paddy->f_get_particulars("md_district",NULL,NULL, 0);

            $this->load->view('post_login/main');

            $this->load->view("reports/soc_proc/socProcDt_ho.php", $socProc);

            $this->load->view('post_login/footer');
        }
    }
    public function f_millProc(){

        if($_SERVER['REQUEST_METHOD']=='POST'){

            $kms_id     = $this->session->userdata['loggedin']['kms_id'];

            $branch_id  = $this->session->userdata['loggedin']['branch_id'];

            $block_id    = $this->input->post('block');

            $from_dt    = $this->input->post('from_date');

            $to_dt      = $this->input->post('to_date');

            $millProc['millDtls']   =   $this->Paddyrep->f_get_mill($branch_id,$block_id);

            $millProc['collc']      =   $this->Paddyrep->f_get_mil_collc($branch_id,$from_dt,$to_dt);

            $millProc['cmr']        =   $this->Paddyrep->f_get_mill_cmr($branch_id,$from_dt,$to_dt);

            $millProc['offer']      =   $this->Paddyrep->f_get_mill_offer($branch_id,$from_dt,$to_dt);
            
            $millProc['do']         =   $this->Paddyrep->f_get_mil_do($branch_id,$from_dt,$to_dt,$kms_id); 

            $millProc['delv']       =   $this->Paddyrep->f_get_mill_delv($branch_id,$from_dt,$to_dt,$kms_id);

            $millProc['remain']     =   $this->Paddyrep->f_get_mill_remain($branch_id,$from_dt,$to_dt,$kms_id);
			
         
            $this->load->view('post_login/main');

            $this->load->view("reports/soc_proc/millProcDt.php", $millProc);

            $this->load->view('post_login/footer');


        }else{

            $socProc['sys_date']   =   $_SESSION['sys_date'];


            $where      =   array(

                "branch_id" =>$this->session->userdata['loggedin']['branch_id']
            );

            $socProc['blocks']  =   $this->Paddy->f_get_particulars("md_block",NULL,$where, 0);

            $this->load->view('post_login/main');

            $this->load->view("reports/soc_proc/millProcDt.php", $socProc);

            $this->load->view('post_login/footer');
        }
    }

    public function f_millProcho(){                         /**Millwise procurement report in HO */

        if($_SERVER['REQUEST_METHOD']=='POST'){

            $kms_id     = $this->session->userdata['loggedin']['kms_id'];

            $branch_id  = $this->input->post('dist');

            $from_dt    = $this->input->post('from_date');

            $to_dt      = $this->input->post('to_date');

            $millProc['millDtls']    =   $this->Paddyrep->f_get_mill_ho($branch_id,$kms_id);

            $millProc['collc']      =   $this->Paddyrep->f_get_mil_collc($branch_id,$from_dt,$to_dt);

            $millProc['cmr']        =   $this->Paddyrep->f_get_mill_cmr($branch_id,$from_dt,$to_dt);

            $millProc['offer']      =   $this->Paddyrep->f_get_mill_offer($branch_id,$from_dt,$to_dt);
            
            //$millProc['do']         =   $this->Paddyrep->f_get_mil_do($branch_id,$from_dt,$to_dt,$kms_id);

            $millProc['delv']       =   $this->Paddyrep->f_get_mill_delv($branch_id,$from_dt,$to_dt,$kms_id);

            $millProc['remain']     =   $this->Paddyrep->f_get_mill_remain($branch_id,$from_dt,$to_dt,$kms_id);

         
            $this->load->view('post_login/main');

            $this->load->view("reports/soc_proc/millProcDt_ho.php", $millProc);

            $this->load->view('post_login/footer');


        }else{

            $socProc['sys_date']   =   $_SESSION['sys_date'];


            $socProc['dists']  =   $this->Paddy->f_get_particulars("md_district",NULL,NULL, 0);

            $this->load->view('post_login/main');

            $this->load->view("reports/soc_proc/millProcDt_ho.php", $socProc);

            $this->load->view('post_login/footer');
        }
    }

    public function f_chequestatus(){


        if($_SERVER['REQUEST_METHOD']=='POST'){

            $kms_id     = $this->session->userdata['loggedin']['kms_id'];

            $branch_id  = $this->input->post('branch_id');

            $from_dt    = $this->input->post('from_date');

            $to_dt      = $this->input->post('to_date');

           
            $chequedetails['chequedetails']  =  $this->Paddyrep->f_get_cheque_detail($branch_id,$from_dt,$to_dt);
           

         
            $this->load->view('post_login/main');

            $this->load->view("reports/cheque_detail/chequedetails_list.php", $chequedetails);

            $this->load->view('post_login/footer');


        }else{

            $chequedetails['sys_date']   =   $_SESSION['sys_date'];

            $chequedetails['branches']    =   $this->Paddy->f_get_particulars("md_branch", NULL, NULL, 0);

            $this->load->view('post_login/main');

            $this->load->view("reports/cheque_detail/chequedetails.php", $chequedetails);

            $this->load->view('post_login/footer');
        }

    }

    public function f_neftstatus(){  

        if($_SERVER['REQUEST_METHOD']=='POST'){

            $kms_id     = $this->session->userdata['loggedin']['kms_id'];

            $branch_id  = $this->input->post('branch_id');

            $from_dt    = $this->input->post('from_date');

            $to_dt      = $this->input->post('to_date');

            $bnk      = $this->input->post('bnk');

            $soc_id      = $this->input->post('soc_name');
           
            $data['nefts']  =  $this->Paddyrep->f_get_neft_detail($branch_id,$bnk,$from_dt,$to_dt,$soc_id,$kms_id);

            $data['socy']   =  $this->Paddyrep->f_get_soc_name_dtls($soc_id);
           
            $this->load->view('post_login/main');

            $this->load->view("reports/neft/neftdetails_list.php", $data);

            $this->load->view('post_login/footer');


        }else{

            $data['sys_date']   =   $_SESSION['sys_date'];

             $where      =   array(

                "branch_id" =>$this->session->userdata['loggedin']['branch_id']
            );

            $data['blocks']  =   $this->Paddy->f_get_particulars("md_block",NULL,$where, 0);

            $data['branches']    =   $this->Paddy->f_get_particulars("md_branch", NULL, NULL, 0);

            $this->load->view('post_login/main');

            $this->load->view("reports/neft/neftdetails.php", $data);

            $this->load->view('post_login/footer');
        }

    }


    public function f_chequestatus_excel(){

        	 $this->load->library('excel');

             $object = new PHPExcel();
             $object->setActiveSheetIndex(0);

             $kms_id    = $this->session->userdata['loggedin']['kms_id'];

            $branch_id  = $this->input->post('branch_id');

            $bnk  = $this->input->post('bnk');

            $from_dt    = $this->input->post('from_date');

            $to_dt      = $this->input->post('to_date');

           
            $employee_data  =  $this->Paddyrep->f_get_cheque_detail($branch_id,$bnk,$from_dt,$to_dt);
            $district_name  =  get_district_name($branch_id);

     
          

                $table_columns = array("Transaction Date","Society Name","Bank","Reg No",
                	"Name as in registration","Qty","Procured amount","Cheque No","Cheque Status","Cleared Date");

                $column = 0;
 
                foreach($table_columns as $field)
                {
                $object->getActiveSheet()->setCellValueByColumnAndRow($column, 1, $field);
                $column++;
                }
                $excel = 2;

                foreach($employee_data as $row)
                {

                	if($row->bank_sl_no =="1"){$bankname="Yes Bank";}
                		elseif($row->bank_sl_no =="2"){$bankname="Bandhan Bank";}
                		  elseif($row->bank_sl_no =="3"){$bankname="ICICI Bank";}
                		    elseif($row->bank_sl_no =="4"){$bankname="Axis Bank";}
                		      else{ $bankname="Hdfc Bank";}

                              if($row->chq_status =="C"){$chqstatus="CLEARED";}
                        elseif($row->chq_status =="U"){$chqstatus="UNCLEARED";}
                          elseif($row->chq_status =="R"){$chqstatus="RETURNED";}
                            else{$chqstatus="SEND FOR CLEARING";}

                       // $farm_name =  get_farmer_name($kms_id,$row->reg_no) ;  
                         $regs_no = $row->reg_no;
                $query = $this->db->get_where('td_farmer_reg', array('kms_id' => $kms_id,'reg_no' => $regs_no))->num_rows();
                if($query == 0){

                    $farm_name = "Not Available";
                 }else{

                    $farm_name = get_farmer_name($kms_id,$regs_no);  
                      
                }
                	
               
                $object->getActiveSheet()->setCellValueByColumnAndRow(0, $excel, date('d/m/Y',strtotime($row->trans_dt)));
                $object->getActiveSheet()->setCellValueByColumnAndRow(1, $excel, $row->soc_name);
                $object->getActiveSheet()->setCellValueByColumnAndRow(2, $excel, $bankname);
                $object->getActiveSheet()->setCellValueByColumnAndRow(3, $excel, $row->reg_no);
                $object->getActiveSheet()->setCellValueByColumnAndRow(4, $excel, $farm_name); 
                $object->getActiveSheet()->setCellValueByColumnAndRow(5, $excel, $row->quantity);
                $object->getActiveSheet()->setCellValueByColumnAndRow(6, $excel, $row->amount);
                $object->getActiveSheet()->setCellValueByColumnAndRow(7, $excel, $row->cheque_no);
                $object->getActiveSheet()->setCellValueByColumnAndRow(8, $excel, $chqstatus);
                $object->getActiveSheet()->setCellValueByColumnAndRow(9, $excel, date('d/m/Y',strtotime($row->chq_clg_dt)));
               

                $excel++;
                }

                $object_writer = PHPExcel_IOFactory::createWriter($object, 'Excel5');
                $filename=$district_name.'Cheque_status';
                header('Content-Type: application/vnd.ms-excel');
                header('Content-Disposition: attachment;filename="'.$filename.'.xls"');

                $object_writer->save('php://output');

             
              

    }

    public function f_returncheque(){


        if($_SERVER['REQUEST_METHOD']=='POST'){

            $kms_id     = $this->session->userdata['loggedin']['kms_id'];

            $branch_id  = $this->input->post('branch_id');

            $from_dt    = $this->input->post('from_date');

            $to_dt      = $this->input->post('to_date');

           
            $chequedetails['returncheque_dtls']  =  $this->Paddyrep->f_get_returncheque($branch_id,$from_dt,$to_dt);
           

         
            $this->load->view('post_login/main');

            $this->load->view("reports/cheque_detail/returncheque.php", $chequedetails);

            $this->load->view('post_login/footer');


        }else{

            $chequedetails['sys_date']   =   $_SESSION['sys_date'];

            $chequedetails['branches']    =   $this->Paddy->f_get_particulars("md_branch", NULL, NULL, 0);

            $this->load->view('post_login/main');

            $this->load->view("reports/cheque_detail/returncheque.php", $chequedetails);

            $this->load->view('post_login/footer');
        }

    }

    public function f_farmerpay(){                      /**SocietyWise Report on farmer payment at HO */

        if($_SERVER['REQUEST_METHOD']=='POST'){

            $kms_id     = $this->session->userdata['loggedin']['kms_id'];

            $branch_id  = $this->input->post('dist');

            $from_dt    = $this->input->post('from_date');

            $to_dt      = $this->input->post('to_date');

            if($kms_id == 2){

                $socProc['socDtls']  =   $this->Paddyrep->f_get_soc_ho($branch_id,$kms_id);

                $socProc['collc']    =   $this->Paddyrep->f_get_collc_ho($branch_id,$from_dt,$to_dt);

                $socProc['coll']    =   $this->Paddyrep->f_getamt_clr($branch_id,$from_dt,$to_dt);

                $socProc['reissues']  =   $this->Paddyrep->f_getamt_reissue($branch_id,$from_dt,$to_dt);
                       
                $this->load->view('post_login/main');

                $this->load->view("reports/farmer_payment/farpay_ho.php", $socProc);

                $this->load->view('post_login/footer');
            }else{
                $socProc['socDtls']  =   $this->Paddyrep->f_get_soc_ho($branch_id,$kms_id);

                $socProc['collc']    =   $this->Paddyrep->f_get_collc_ho($branch_id,$from_dt,$to_dt);

                $socProc['coll']    =   $this->Paddyrep->f_getamt_clr($branch_id,$from_dt,$to_dt);

                $socProc['reissues']  =   $this->Paddyrep->f_getamt_reissue_new($branch_id,$from_dt,$to_dt,$kms_id);

                $socProc['unpaid']    =   $this->Paddyrep->f_getunpaid_farmer($branch_id,$from_dt,$to_dt);

                //echo ($this->db->last_query());die;
                       
                $this->load->view('post_login/main');

                $this->load->view("reports/farmer_payment/farpay_soc_ho.php", $socProc);

                $this->load->view('post_login/footer');
            }


        }else{

            $socProc['sys_date']   =   $_SESSION['sys_date'];

            $kms_id     = $this->session->userdata['loggedin']['kms_id'];

            $socProc['dists']  =   $this->Paddy->f_get_particulars("md_district",NULL,NULL, 0);

            if($kms_id == 2){

                $this->load->view('post_login/main');

                $this->load->view("reports/farmer_payment/farpay_ho.php", $socProc);

                $this->load->view('post_login/footer');
            }else{
                $this->load->view('post_login/main');

                $this->load->view("reports/farmer_payment/farpay_soc_ho.php", $socProc);

                $this->load->view('post_login/footer');
            }
        }
    }


/**Paddy repeat selling */
       public function f_reselling(){

        if($_SERVER['REQUEST_METHOD']=='POST'){

            $kms_id     = $this->session->userdata['loggedin']['kms_id'];

            $branch_id  = $this->input->post('dist');

            $from_dt    = $this->input->post('from_date');

            $to_dt      = $this->input->post('to_date');

            $socProc['reg']         =   $this->Paddyrep->f_getregfarm($kms_id);

            $socProc['collc']       =   $this->Paddyrep->f_getresale($from_dt,$to_dt);

            $socProc['reslno']      =   $this->Paddyrep->f_get_resale_no($from_dt,$to_dt);

            $socProc['dist']        =   $this->Paddyrep->f_get_dist_proc($from_dt,$to_dt);
            
                       
            $this->load->view('post_login/main');

            $this->load->view("reports/farmer_payment/resealing.php", $socProc);

            $this->load->view('post_login/footer');


        }else{

            $socProc['sys_date']   =   $_SESSION['sys_date'];

            $socProc['dists']  =   $this->Paddy->f_get_particulars("md_district",NULL,NULL, 0);

            $this->load->view('post_login/main');

            $this->load->view("reports/farmer_payment/resealing.php", $socProc);

            $this->load->view('post_login/footer');
        }
    }
/**Consolidated report on farmer payment districtwise at HO*/    
    public function f_farmerpaytot(){

        if($_SERVER['REQUEST_METHOD']=='POST'){

            $kms_id     = $this->session->userdata['loggedin']['kms_id'];

            $branch_id  = $this->input->post('dist');

            $from_dt    = $this->input->post('from_date');

            $to_dt      = $this->input->post('to_date');

            $socProc['dist']    = $this->Paddy->f_district_orderby();


            $socProc['collc']   = $this->Paddyrep->f_getresale($from_dt,$to_dt);
           

            $socProc['coll']    =  $this->Paddyrep->f_getdistamt_clr($from_dt,$to_dt);
            $socProc['reissues'] = $this->Paddyrep->f_getdisamt_reissue($from_dt,$to_dt,$kms_id);
            $socProc['unpaid'] = $this->Paddyrep->f_getunpaid_farmer_dist($from_dt,$to_dt);

                       
            $this->load->view('post_login/main');

            $this->load->view("reports/farmer_payment/farpaytot.php", $socProc);

            $this->load->view('post_login/footer');


        }else{

            $socProc['sys_date']   =   $_SESSION['sys_date'];

            $this->load->view('post_login/main');

            $this->load->view("reports/farmer_payment/farpaytot.php", $socProc);

            $this->load->view('post_login/footer');
        }
    }
 /**Gap in Offer & Delivery consolidated */   
    public function f_gap_offer_delivery(){

        if($_SERVER['REQUEST_METHOD']=='POST'){

            $kms_id     = $this->session->userdata['loggedin']['kms_id'];

            $branch_id  = $this->input->post('dist');

            $from_dt    = $this->input->post('from_date');

            $to_dt      = $this->input->post('to_date');

            $socProc['dist']        =  $this->Paddyrep->f_get_dist_proc($from_dt,$to_dt);
             
            //$socProc['collc']   = $this->Paddyrep->f_getresale($from_dt,$to_dt);

            $socProc['delv']        = $this->Paddyrep->f_getdistdelv($from_dt,$to_dt,$kms_id);

            $socProc['delgap']      = $this->Paddyrep->f_delivery_gap($from_dt,$to_dt,$kms_id);

            $socProc['cmrs']        = $this->Paddyrep->f_getdistcmr($from_dt,$to_dt,$kms_id);
         
            $this->load->view('post_login/main');

            $this->load->view("reports/paddy_process/gap_offer_delivery.php", $socProc);

            $this->load->view('post_login/footer');


        }else{

            $socProc['sys_date']   =   $_SESSION['sys_date'];

            $this->load->view('post_login/main');

            $this->load->view("reports/paddy_process/gap_offer_delivery.php", $socProc);

            $this->load->view('post_login/footer');
        }
    }

    /**Consolidated weekly delivery report */
    public function f_weekdlv(){

        if($_SERVER['REQUEST_METHOD']=='POST'){

            $kms_id     = $this->session->userdata['loggedin']['kms_id'];

            $branch_id  = $this->input->post('dist');

            $from_dt    = $this->input->post('from_date');

            $to_dt      = $this->input->post('to_date');

            $socProc['delv']  =   $this->Paddyrep->f_get_datewise_delivery($branch_id,$from_dt,$to_dt);

            //$socProc['reg']      =   $this->Paddyrep->f_get_reg_farm_ho($branch_id,$from_dt,$to_dt);

            //$socProc['collc']    =   $this->Paddyrep->f_get_collc_ho($branch_id,$from_dt,$to_dt);

            //$socProc['coll']    =   $this->Paddyrep->f_getamt_clr($branch_id,$from_dt,$to_dt);

            //$socProc['reissues']  =   $this->Paddyrep->f_getamt_reissue($branch_id,$from_dt,$to_dt);

                       
            $this->load->view('post_login/main');

            $this->load->view("reports/paddy_process/weekly_delivery", $socProc);

            $this->load->view('post_login/footer');


        }else{

            $socProc['sys_date']   =   $_SESSION['sys_date'];

            $socProc['dists']  =   $this->Paddy->f_get_particulars("md_district",NULL,NULL, 0);

            $this->load->view('post_login/main');

            $this->load->view("reports/paddy_process/weekly_delivery", $socProc);

            $this->load->view('post_login/footer');
        }
    }

     public function f_offer_cmrrep(){

        if($_SERVER['REQUEST_METHOD']=='POST'){

            $kms_id     = $this->session->userdata['loggedin']['kms_id'];

            $soc_id    = $this->input->post('soc_name');

            $mill_id      = $this->input->post('mill_id');

            $data['paddy_received']  =   $this->Paddyrep->f_getp_receive($soc_id,$mill_id,$kms_id);
            $data['coll_mxdt']  =   $this->Paddyrep->f_getp_colle($soc_id,$mill_id,$kms_id);
            $data['offerd']  =   $this->Paddyrep->f_getp_offer($soc_id,$mill_id,$kms_id);
            $data['delivery']  =   $this->Paddyrep->f_getp_deliver($soc_id,$mill_id,$kms_id);
            $this->load->view('post_login/main');

            $this->load->view("reports/cmr_offer_report.php", $data);

            $this->load->view('post_login/footer');


        }else{

            $where      =   array(

                "branch_id" =>$this->session->userdata['loggedin']['branch_id']
            );

            $data['blocks']  =   $this->Paddy->f_get_particulars("md_block",NULL,$where, 0);
            

            $this->load->view('post_login/main');

            $this->load->view("reports/cmr_offer_report.php", $data);

            $this->load->view('post_login/footer');
        }
    }
//NEFT Return List
    public function f_neftRet(){

        if($_SERVER['REQUEST_METHOD']=='POST'){

            $kms_id     = $this->session->userdata['loggedin']['kms_id'];

            if($this->session->userdata['loggedin']['ho_flag'] == "Y" ) {

               $branch_id    = $this->input->post('dist');
           
             }else{

                  $branch_id  = $this->session->userdata['loggedin']['branch_id'];

             }

            $from_dt    = $this->input->post('from_date');

            $to_dt      = $this->input->post('to_date');

            if ($kms_id == 2){

                $millProc['neftDtls']   =   $this->Paddyrep->f_get_neft_ret($branch_id,$from_dt,$to_dt);
            }else{

                $millProc['neftDtls']   =   $this->Paddyrep->f_get_ret_neft($branch_id,$from_dt,$to_dt);
            }

            //echo $this->db->last_query();die;
            
         
            $this->load->view('post_login/main');

            $this->load->view("reports/soc_proc/neftRet.php", $millProc);

            $this->load->view('post_login/footer');


        }else{

            $socProc['sys_date']   =   $_SESSION['sys_date'];


            $where      =   array(

                "branch_id" =>$this->session->userdata['loggedin']['branch_id']
            );

            $socProc['dists']  =   $this->Paddy->f_get_particulars("md_district",NULL,NULL, 0);

            $this->load->view('post_login/main');

            $this->load->view("reports/soc_proc/neftRet.php", $socProc);

            $this->load->view('post_login/footer');
        }
    }


    public function f_distIncPay(){                 /**Districtwise Payment of Incidentals Report at HO */                   

        if($_SERVER['REQUEST_METHOD']=='POST'){

            $kms_id     = $this->session->userdata['loggedin']['kms_id'];

            //$branch_id  = $this->input->post('dist');

            $from_dt    = $this->input->post('from_date');

            $to_dt      = $this->input->post('to_date');

            $distProc['procDtls']   =   $this->Paddyrep->f_get_tot_paddy_cmr($from_dt,$to_dt);

            $distProc['comm']       =   $this->Paddyrep->f_get_tot_soc_comm($from_dt,$to_dt);

            $distProc['mill']       =   $this->Paddyrep->f_get_tot_mill_comm($from_dt,$to_dt);

            $distProc['tot']        =   $this->Paddyrep->f_get_tot_incidental($from_dt,$to_dt);

            $distProc['remain']     =   $this->Paddyrep->f_get_remain_dist($from_dt,$to_dt,$kms_id);

            $this->load->view('post_login/main');

            $this->load->view("reports/incidental/dist_inc_pay.php", $distProc);

            $this->load->view('post_login/footer');


        }else{

            $socProc['sys_date']   =   $_SESSION['sys_date'];

            $socProc['dists']  =   $this->Paddy->f_get_particulars("md_district",NULL,NULL, 0);

            $this->load->view('post_login/main');

            $this->load->view("reports/incidental/dist_inc_pay.php", $socProc);

            $this->load->view('post_login/footer');
        }
    }

    public function f_socyIncPay(){                 /**Societywise Payment of Incidentals Report at Branch */                   

        if($_SERVER['REQUEST_METHOD']=='POST'){

            $kms_id     = $this->session->userdata['loggedin']['kms_id'];

            $branch_id  = $this->session->userdata['loggedin']['branch_id'];

            $from_dt    = $this->input->post('from_date');

            $to_dt      = $this->input->post('to_date');

            $socProc['procDtls']   =   $this->Paddyrep->f_get_tot_paddy_cmr_soc($from_dt,$to_dt,$branch_id);

            $socProc['comm']       =   $this->Paddyrep->f_get_comm_soc($from_dt,$to_dt,$branch_id);

            $this->load->view('post_login/main');

            $this->load->view("reports/incidental/soc_inc_pay.php", $socProc);

            $this->load->view('post_login/footer');


        }else{

            $socProc['sys_date']   =   $_SESSION['sys_date'];

            $this->load->view('post_login/main');

            $this->load->view("reports/incidental/soc_inc_pay.php",$socProc);

            $this->load->view('post_login/footer');
        }
    }

    public function f_millIncPay(){                 /**Millwise Payment of Incidentals Report at Branch */                   

        if($_SERVER['REQUEST_METHOD']=='POST'){

            $kms_id     = $this->session->userdata['loggedin']['kms_id'];

            $branch_id  = $this->session->userdata['loggedin']['branch_id'];

            $from_dt    = $this->input->post('from_date');

            $to_dt      = $this->input->post('to_date');

            $socProc['procDtls']   =   $this->Paddyrep->f_get_tot_paddy_cmr_mill($from_dt,$to_dt,$branch_id);

            $socProc['mill']       =   $this->Paddyrep->f_get_mill_comm($from_dt,$to_dt,$branch_id);

            $socProc['tot']        =   $this->Paddyrep->f_get_tot_incidental_brn($from_dt,$to_dt,$branch_id);

            $this->load->view('post_login/main');

            $this->load->view("reports/incidental/mill_inc_pay.php", $socProc);

            $this->load->view('post_login/footer');


        }else{

            $socProc['sys_date']   =   $_SESSION['sys_date'];

            $this->load->view('post_login/main');

            $this->load->view("reports/incidental/mill_inc_pay.php",$socProc);

            $this->load->view('post_login/footer');
        }
    }

    public function f_summary(){

        $kms_id     = $this->session->userdata['loggedin']['kms_id'];

        $branch_id  = $this->session->userdata['loggedin']['branch_id'];

        $dash_data["tot_paddy_procurement"]     = $this->Login_Process->f_get_tot_paddy_procurement($kms_id,$branch_id);

        $dash_data["tot_paddy_procurement_ho"]  = $this->Login_Process->f_get_tot_paddy_procurement_ho($kms_id);

        if($this->session->userdata['loggedin']['ho_flag'] =="N"){

           $where    =   array("kms_year"    => $kms_id,"branch_id" =>$branch_id);

        }else{

            $where   =   array("kms_year"    => $kms_id);
        }

        $dash_data["tot_paddy_dispatch"]= $this->Login_Process->f_tot_paddy_dispatch($where);

        if($kms_id == '2'){  
          $dash_data["tot_cheque_cleared"]= $this->Login_Process->f_get_tot_cheque_cleared($kms_id,$branch_id);
        }else{

            $dash_data["tot_cheque_cleared"]= $this->Login_Process->f_get_tot_amount_cleared($kms_id,$branch_id);
        }

        if($kms_id == '2'){  

        $dash_data["tot_cheque_cleared_ho"]= $this->Login_Process->f_get_tot_cheque_cleared_ho($kms_id);

        }else{

        $dash_data["tot_cheque_cleared_ho"]= $this->Login_Process->f_get_tot_amount_cleared_ho($kms_id);
        }

        $dash_data["tot_cmr_offered"]= $this->Login_Process->f_get_tot_cmr_offered($kms_id,$branch_id);

        $dash_data["tot_cmr_offered_ho"]= $this->Login_Process->f_get_tot_cmr_offered_ho($kms_id,$branch_id);

        $dash_data["tot_do_issued"]= $this->Login_Process->f_get_tot_do_issued($kms_id,$branch_id);

        $dash_data["tot_do_issued_ho"]= $this->Login_Process->f_get_tot_do_issued_ho($kms_id,$branch_id);

        $dash_data["tot_cmr_delivery"]= $this->Login_Process->f_get_tot_cmr_delivery($kms_id,$branch_id);

        $dash_data["tot_cmr_delivery_ho"]= $this->Login_Process->f_get_tot_cmr_delivery_ho($kms_id);

        $dash_data["tot_wqsc_upload"]= $this->Login_Process->f_get_tot_wqsc_upload($kms_id,$branch_id);

        $dash_data["tot_wqsc_upload_ho"]= $this->Login_Process->f_get_tot_wqsc_ho($kms_id);

        $dash_data["tot_mill_payment"]= $this->Login_Process->f_get_tot_mill_payment($kms_id,$branch_id);

        $dash_data["tot_mill_payment_ho"]= $this->Login_Process->f_get_tot_mill_payment_ho($kms_id);

        $dash_data["tot_socy_payment"]= $this->Login_Process->f_get_tot_socy_payment($kms_id,$branch_id);

        $dash_data["tot_socy_payment_ho"]= $this->Login_Process->f_get_tot_socy_payment_ho($kms_id);

        $dash_data["tot_req_fwd"]= $this->Login_Process->f_get_tot_req_fwd($kms_id,$branch_id);

        $dash_data["tot_req_fwd_ho"]= $this->Login_Process->f_get_tot_req_fwd_ho($kms_id);

        $dash_data["tot_req_sanc"]= $this->Login_Process->f_get_tot_req_sanc($kms_id,$branch_id);

        $dash_data["tot_req_sanc_ho"]= $this->Login_Process->f_get_tot_req_sanc_ho($kms_id);

        $this->load->view('post_login/main');

        $this->load->view("reports/summary/kms_summary.php",$dash_data);

        $this->load->view('post_login/footer');
    }

    public function f_paddyDespatch(){                 /**Society Mill Paddy Despatched at Branch */                   

        if($_SERVER['REQUEST_METHOD']=='POST'){

            $kms_id     = $this->session->userdata['loggedin']['kms_id'];

            $branch_id  = $this->session->userdata['loggedin']['branch_id'];

            $from_dt    = $this->input->post('from_date');

            $to_dt      = $this->input->post('to_date');

            $socProc['despatchDtls']   =   $this->Paddyrep->f_get_paddy_despatch($from_dt,$to_dt,$branch_id);

            $this->load->view('post_login/main');

            $this->load->view("reports/despatch/paddy_despatch.php", $socProc);

            $this->load->view('post_login/footer');


        }else{

            $socProc['sys_date']   =   $_SESSION['sys_date'];

            $this->load->view('post_login/main');

            $this->load->view("reports/despatch/paddy_despatch.php",$socProc);

            $this->load->view('post_login/footer');
        }
    }

    public function f_payDtHo(){                          /**Campwise payment date report */ 

        if($_SERVER['REQUEST_METHOD']=='POST'){

            $kms_id     = $this->session->userdata['loggedin']['kms_id'];

            $branch_id  = $this->input->post('dist');

            $from_dt    = $this->input->post('from_date');

            $to_dt      = $this->input->post('to_date');

            $bank       = $this->input->post('bank');

            $paydt['payDtls']    =   $this->Paddyrep->f_get_payment_date($branch_id,$kms_id,$from_dt,$to_dt,$bank);


            $this->load->view('post_login/main');

            $this->load->view("reports/payment_dt/payProcDt_ho.php", $paydt);

            $this->load->view('post_login/footer');


        }else{

            $socProc['sys_date']   =   $_SESSION['sys_date'];

            $socProc['dists']      =   $this->Paddy->f_get_particulars("md_district",NULL,NULL, 0);

            $this->load->view('post_login/main');

            $this->load->view("reports/payment_dt/payProcDt_ho.php", $socProc);

            $this->load->view('post_login/footer');
        }
    }

}

?>