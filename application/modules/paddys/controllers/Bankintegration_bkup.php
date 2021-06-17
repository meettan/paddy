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

    public function f_paddycol_forward() {
        

        $data=explode ("/", $this->input->get('soc_id'));
        $soc_id = $data["0"];
        $trans_dt = $data["1"];
        $bulk_trans_id = $data["2"];
        $valid=0;

        $paddy_data    = $this->Paddy->coll_received($soc_id,$trans_dt,$bulk_trans_id);
        $paddy_forwad  = $this->Paddy->coll_forward($soc_id,$trans_dt,$bulk_trans_id);


        $data_array = array(

                "trans_dt"      =>  $paddy_data->trans_dt,                

                "kms_year"      =>  $this->session->userdata['loggedin']['kms_id'],

                "branch_id"      =>  $this->session->userdata['loggedin']['branch_id'],

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
                    "kms_id"                  =>  $this->session->userdata['loggedin']['kms_id']
                
                     );


                    $var["RECORD"][] = array(
                                            'PAYMENT_DETAILS' => [ array(
                                                        'PAYMENTS'=> array(
                                                                            "API_VERSION"        => "1",
                                                                            "CORP_CODE"          => "DEMOCORP57",
                                                                            "CMPY_CODE"          => "1",
                                                                            "TXN_CRNCY"          => "INR",
                                                                            "TXN_PAYMODE"        => "NEFT",
                                                                            "CUST_UNIQ_REF"      => $row->forward_trans_id.'_'.$row->book_no,
                                                                            "TXN_TYPE"           => "CUST",
                                                                            "TXN_AMOUNT"         => $row->amount,
                                                                            "CORP_ACC_NUM"       => "910020034508608",
                                                                            "CORP_IFSC_CODE"     => "AXIS789087",
                                                                            "ORIG_USERID"        => "DEMOCORP78",
                                                                            "USER_DEPARTMENT"    => "PAYMENT",
                                                                            "TRANSMISSION_DATE"  => date('Y-m-d h:i:s'),
                                                                            "BENE_CODE"          => substr($row->reg_no,16),
                                                                            "VALUE_DATE"         => $row->trans_dt,
                                                                            "RUN_IDENTIFICATION" => $row->forward_bulk_trans_id,
                                                                            "FILE_NAME"          => $row->forward_bulk_trans_id,
                                                                            "BENE_NAME"          => $row->farm_name,
                                                                            "BENE_ACC_NUM"       => $row->acc_no,
                                                                            "BENE_IFSC_CODE"     => $row->ifsc_code,
                                                                            "BENE_AC_TYPE"       => "SB",
                                                                            "BENE_BANK_NAME"     => "",
                                                                            "BASE_CODE"          => "DEMOCORP",
                                                                            "CHEQUE_NUMBER"      => "",
                                                                            "CHEQUE_DATE"        => [],
                                                                            "PAYABLE_LOCATION"   => "1",
                                                                            "PRINT_LOCATION"     => "1",
                                                                            "PRODUCT_CODE"       => "B",
                                                                            "BATCH_ID"           => "1",
                                                                            "BENE_ADDR_1"        => $row->address,
                                                                            "BENE_ADDR_2"        => "",
                                                                            "BENE_ADDR_3"        => "",
                                                                            "BENE_CITY"          => "KOLKATA",
                                                                            "BENE_STATE"         => "WEST BENGAL",
                                                                            "BENE_PINCODE"       => $row->pin_no,
                                                                            "CORP_EMAIL_ADDR"    => "test@axisbank.com",
                                                                            "BENE_EMAIL_ADDR1"   => $row->email,
                                                                            "BENE_EMAIL_ADDR2"   => "",
                                                                            "BENE_MOBILE_NO"     => $row->mobile_number,
                                                                            "ENRICHMENT1"        => "test1",
                                                                            "ENRICHMENT2"        => "test1",
                                                                            "ENRICHMENT3"        => "test1",
                                                                            "ENRICHMENT4"        =>"test1",
                                                                            "ENRICHMENT5"        => "test1",
                                                                            "STATUS_ID"          =>"1"
                                                                        ),

                                                        'INVOICE' =>  array(

                                                                            "INVOICE_NUMBER"=> "",
                                                                            "INVOICE_DATE"=> "",
                                                                            "NET_AMOUNT"=> "",
                                                                            "TAX"=>"",
                                                                            "CASH_DISCOUNT"=>"",
                                                                            "INVOICE_AMOUNT"=> ""
                                                                        )
                                                                )
                                                ]
                                            );

                       

                         

            } 

                       $aPublicKey = "-----BEGIN PGP PUBLIC KEY BLOCK-----
            Version: GnuPG v2.0.22 (GNU/Linux)

            mQMuBF+X4cARCACRqEy+mYDPDd6t9K47JxnGn/AWfowj4NMwIA66eS79UUqgR2pF
            NPqNbEtfswMMQALJECrvxJwrP48iu/Cw+uqHzrMCO+kUQNXN7mDr/wOH/pLoRcyO
            voGlA5DcpPeXCRlOm0cFiTkd0z/md/M4zVl4tNHI+pHhZh7vOF5RQU5oqnxiBd4Y
            D4qVKrkrk2xyQ+qgdd0Ozv3m2dTXmQW+HaN0cyycHc8n4IFEvh+lNReTHUjzoy8r
            en8JMb6EL4LrJzhdWO43R9ZuJJLo5sb5N8hOCaOPp+lFbfeIyxjt23MEhxLfN3Of
            E+BmfTKEApVLsuqxU+J8jRLHc2xUOKmz3awnAQCwKLstJIq3s6N/L9ygt301S4FK
            JcNvvwuz2ElbynO34Qf8Csh4cygEY25jhPe5c7Ohyf/hzOQBZ9l+/9hwL1v8rDOA
            aDiTYCwhr2tvnmjj3KZdAR+ZQqGU5BBct1NGePXJuRZidys5ZgfXbtrmW1V62GgA
            SqdEZTILczv0K94h96/Lpx1kDHgFYNeygTHBwoBg4GsFT36MOxMRwIEu4GKE869z
            r4WzihTsrieAJAeiKOYKoXobMSxHwoI/BfZGRV43N+2ItYEE9f0PHlcRDIWD4ahX
            mEm6CX5zra+Rn37HbmWgfrNmqA0NAbyd8fpX1gd1pWKIEt8kNDlGtRG/1Jj3OR/z
            WDIWJUuBvpD2dUI4uAe1zBzRyQfEniPynzAQskzafwf+NapX+b/ikmA5en/mKk5y
            dX485z2NE6YsKe3hC6Pp8Up0NH9K/S+P5noxbAah4eboQ4PwEzIKxqQxR6elgvcS
            VP6yOuIUc59/NTMLrfW214xSN4SUuGhgWDKHDxPYjtUGzgRciDg5p9CGZXIcYZbs
            25IBvCqaZ7kh1rjNvWsdzKev3Va9tlLX7AxByA3wFBijxp8W7+wqU2atr8BnHRCL
            31FVVlaJE6ZHxGUGky0AxxuF97Mf5mKLNreipFCMVUXicEAyxHOpg5vi+Mz+k5sg
            3euMn1+4FXvo5ZGLPExoIcKvWxVdOfLrS9AU98z5rcJojfs2MxbLs2TISeFXUHB5
            mbQpTG9rZXNoIChUZXN0KSA8bG9rZXNoQHN5bmVyZ2ljc29mdGVrLmNvbT6IewQT
            EQgAIwUCX5fhwAIbIwcLCQgHAwIBBhUIAgkKCwQWAgMBAh4BAheAAAoJEO6m0zo6
            YOgmyGMA+wWAR2kgI6PFh2SsZJOw1nEMHk4urERvsJ4n7XXWh5rtAP4/fa9ciVnD
            CAtVvSJhi4BKDaJru80MwELfB9Xhtx0jsrkCDQRfl+HAEAgAt3/GE17ZfcrxIdXn
            JsTkRoFvsO+ustHrcGyu55vBS9fhgNBkNi74XtNflTh6/gO694GZd4Ylhu+cXIcU
            Liqvjz02wvbczO1cNs7Eu2amDIGBAeYPiwm9vw4ZHMdvRqevdjuwpZGNUKEI+gjj
            HY9rjUOgRP2PWrd90bAaYHH0U8LOb9KoVNDs1GjXC3zybgQLGIXOqEL0kxAkMX57
            a09Od0yMcvEUwCRw9ugo5EI3LDxSI0vA9L2VH5KMn9elZrxwEwIAecle220muqGV
            UTtCmHYmtvioOO7yJCQI+ul0JxRY0+EFcDMiT44NEejtnfnLOzj5D+JTfHgw2T0c
            glimwwADBQgApYhhS1AuH8Lzl2ilKS0oebyqTYoVPaJqCgSmWzNGpWEk7Wu3ghBJ
            iwE1Wy1y8N01mW1KNcIOCJcW5uqOwyqvnSoZec2TYQB0A6MnyMiTaEclid3NSqHn
            aZOCQGwWpd+mkUdXpEKyhwJ0wa7yh+Q62FCYsURJPDoNhEf/4QmB0lgbgPhp8RUa
            +T1Gc4zibd34p1NUUeHU2YnDb6PM0M9TR4EAki+N4IhEwDBpkVqt7P0N/qmNNVHg
            OHPd/CMDO1P+gjpVy4zD9Oihp6N9sDsTs5u07A1IWsI/yZDnNNu3jMHoZQwYaV3Y
            t8FLho/KKSCppZJFrZEYpvxpZbigkZ39q4hhBBgRCAAJBQJfl+HAAhsMAAoJEO6m
            0zo6YOgmOUkA/1R/InJU2W+pNmuMBy0GBanM9946JSSqclO5xE/szJUJAP0bfuOI
            4qlzVizetUxBKHdaGkGJv8RH7x2eyPrfiUu/ug==
            =juvi
            -----END PGP PUBLIC KEY BLOCK-----
            ";


              $gpg = new nicoSWD\GPG\GPG();
              $pubKey = new nicoSWD\GPG\PublicKey($aPublicKey);
        //      //$sign   = new OpenPGP();
        //      $datas  = $gpg->gpgLiteral($var);
           

         $data = $gpg->encrypt($pubKey,json_encode($var));      
          echo $data;
        echo "</br>";    
        die();

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

        foreach($reg_qty as $reqty ) {

                $query = $this->db->get_where('td_farmer_reg', array('reg_no' => $reqty->reg_no))->num_rows();
                  
                 if($query == "0"){
                    $regvalid = $regvalid+1;
                 }else{
                    $regvalid = $regvalid+0;
                 }
                 if($reqty->quantity > "90"){
                    $qtyvalid = $qtyvalid+1;
                 }else{
                    $qtyvalid = $qtyvalid+0;
                 }
        }


           if($regvalid =='0'){


                        if($qtyvalid == '0'){


                            if($valid=='0'){

                                     $this->Paddy->f_forward_paddycollection($trans_dt,$bulk_trans_id,$soc_id);

                                     $this->Paddy->f_insert_multiple('td_collections_forward', $dataf);

                                     $this->Paddy->f_insert('td_received', $data_array);
                                     echo "<script>
                                           alert('Procurement data forwarded successfully');
                                           window.location.href='".base_url()."index.php/paddys/transactions/f_paddycollection';
                                           </script>";
                            }else{

                                    echo "<script>alert('Procurement data Not forwarded Some Problem In IFSC Code');
                                          window.location.href='".base_url()."index.php/paddys/transactions/f_paddycollection';
                                         </script>";

                                }
                               
                    }else{

                            echo "<script>alert('Procurement data Not forwarded Some Problem In Quantity');
                                        window.location.href='".base_url()."index.php/paddys/transactions/f_paddycollection';
                                      </script>";

                    }

           

        }else{

                 echo "<script>
                 alert('Procurement data Not forwarded Some Problem In Farmer Name');
                 window.location.href='".base_url()."index.php/paddys/transactions/f_paddycollection';
                 </script>";
                }
     

   
    }
    



}    
