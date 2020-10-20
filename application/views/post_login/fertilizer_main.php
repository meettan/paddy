<!DOCTYPE html>
<html>
    <head><meta http-equiv="Content-Type" content="text/html; charset=utf-8">
        
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <link rel="icon" href="<?php echo base_url("/benfed.png"); ?>"> 
        <title>BENFED</title>       
        <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css">
        <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
        <link rel="stylesheet" href="<?php echo base_url("/assets/css/sb-admin.css");?>">
        <link rel="stylesheet" href="<?php echo base_url("/assets/css/select2.css");?>">
        <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.3.1/jquery.min.js"></script>
        <script type="text/javascript" src="<?php echo base_url("/assets/js/validation.js")?>"></script>
        <script type="text/javascript" src="<?php echo base_url("/assets/js/select2.js")?>"></script>
         <script type="text/javascript" src="<?php echo base_url("/assets/js/select2.min.js")?>"></script>
     <link href="https://maxcdn.bootstrapcdn.com/bootstrap/3.2.0/css/bootstrap.min.css" rel="stylesheet">

    <link href="<?php echo base_url("/assets/css/bootstrap-toggle.css");?>" rel="stylesheet">
   <!--  <script type="text/javascript" src="https://ajax.googleapis.com/ajax/libs/jquery/2.2.4/jquery.min.js"></script> -->
     <script type="text/javascript" src="<?php echo base_url("/assets/js/table2excel.js")?>"></script>
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.2.0/js/bootstrap.min.js"></script>
    <script src="<?php echo base_url("/assets/js/bootstrap-toggle.js")?>" ></script> 
    <style>
        .hr {
            display: block;
            margin-top: 0.5em;
            margin-bottom: 0.5em;
            margin-left: auto;
            margin-right: auto;
            border-style: inset;
            border-width: 1px;
        }
        .transparent_tag {

            background: transparent; 
            border: none;

        }
        .no-border {
            border: 0;
            box-shadow: none;
            width: 75px;
        }
    </style>
    <link href="https://fonts.googleapis.com/css?family=Roboto:100,100i,300,300i,400,400i,500,500i,700,700i,900,900i&display=swap" rel="stylesheet"> 
    <link href="<?php echo base_url("/assets/css/apps.css");?>" rel="stylesheet">
    </head>  
    <body id="page-top" style="background-color: #eff3f6;">
        <header class="header_class">
<ul class="header_top">
<li><strong>Branch Name: </strong><?php if(isset($this->session->userdata['loggedin']['branch_name'])){ echo $this->session->userdata['loggedin']['branch_name'];}?></li>
<li><strong>Financial Year: </strong><?php if(isset($this->session->userdata['loggedin']['kms_yr'])){ echo $this->session->userdata['loggedin']['kms_yr'];}?></li>
<li><strong>User: </strong><?php if(isset($this->session->userdata['loggedin']['user_name'])){ echo $this->session->userdata['loggedin']['user_name'];}?></li>
<li class="date"><strong>Date: </strong> <?php echo date("d-m-Y");?></li>
</ul>
</header>
    
        <nav class="navbar navbar-inverse bg-primary">
            
                <div class="col-sm-2 logo_sec_main">
                    <div class="logo_sec">
                    <img src="<?php echo base_url("/benfed.png");?>" />
                    </div>
                </div>
<div class="col-sm-10 navbarSectio">

                    <div class="dropdown">
                    <div class="dropbtn">
                    <a href="<?php echo site_url("Fertilizer_Login/main");?>" style="color: white; text-decoration: none;"><i class="fa fa-home"></i> Home</a>
                    </div> 
                    </div>
                    <?php if($this->session->userdata['loggedin']['user_type']=="A" && $this->session->userdata['loggedin']['ho_flag']=="Y"){?>   
                    <div class="dropdown">
                        <div class="dropbtn">
                            <i class="fa fa-university" aria-hidden="true"></i>
                                Master
                            <i class="fa fa-angle-down"></i>
                        </div>
                        <div class="dropdown-content">
                          
                        <div class="sub-dropdown">
                              <!-- <?php if($this->session->userdata['loggedin']['user_type']=="A" && $this->session->userdata['loggedin']['ho_flag']=="Y"){?>    -->
                                
                                <a href="<?php echo site_url("fertilizer/company");?>">Company</a>
                            <a href="<?php echo site_url("fertilizer/unit");?>">Unit</a>
                            <a href="<?php echo site_url("fertilizer/product");?>">Product</a>
                            <a href="<?php echo site_url("fertilizer/soceity");?>">Society</a>
                    
                            <a href="<?php echo site_url("fertilizer/sale_rate");?>">Sale Rate</a>
                     
                            <!-- <a href="<?php echo site_url("fertilizer/soceity");?>">Soceity</a> -->
                            <!--<a href="<?php //echo site_url("finance/view_bank_master");?>">Bank</a>-->
                         <!-- <?php } ?> -->
                        </div>
                      </div>
                    </div>
                    <?php } ?>
                    <?php if( $this->session->userdata['loggedin']['ho_flag']=="N"){?> 
                    <div class="dropdown">
                        <div class="dropbtn">
                            <i class="fa fa-university" aria-hidden="true"></i>
                                Transaction
                            <i class="fa fa-angle-down"></i>
                        </div>
                        <div class="dropdown-content">
                            <div class="sub-dropdown">
                            <!-- <?php if( $this->session->userdata['loggedin']['ho_flag']!="Y"){?>  -->
                              <!-- <a href="<?php echo site_url("fertilizer/invoice_entry");?>">Invoice Entry</a> -->
                              <a href="<?php echo site_url("fertilizer/stock_entry");?>">Purchase Entry</a>
                          <!-- <?php } ?> -->
                              
                               <!-- <?php if($this->session->userdata['loggedin']['user_type']=="A" && $this->session->userdata['loggedin']['ho_flag']=="Y"){?>  -->
                              <!-- <a href="<?php echo site_url("fertilizer/invoice_entry");?>">Invoice Entry</a> -->
                          <!-- <?php } ?> -->
                              <a href="<?php echo site_url("fertilizer/sale");?>">Sale</a>
                              <a href="<?php echo site_url("fertilizer/cr_note");?>">Cr Note</a>
                              <a href="<?php echo site_url("fertilizer/dr_Note");?>">Dr Note </a>
                              <a href="<?php echo site_url("fertilizer/trfDashboard");?>">Sale Return </a>
                            </div>
                          
                        </div>
                    </div> 
                    <?php } ?>
                      <div class="dropdown">
                        <div class="dropbtn">
                            <i class="fa fa-university" aria-hidden="true"></i>
                                Report
                            <i class="fa fa-angle-down"></i>
                        </div>  
                        <div class="dropdown-content">
                          
                            <div class="sub-dropdown">
                               <a href="<?php echo site_url("fsertilizer/sale_report");?>">Sale Report</a>
                               <a href="<?php echo site_url("fertilizer/sale_reportdis");?>">Sale Report(District Wise)</a>
                                    <!--<a href="<?php echo site_url("fertilizer/f_cash_bk");?>">Purchase Report</a>-->
                                    <!--<a href="#">Bank/Journal Book</a>-->
                                    
                                    <a href="<?php echo site_url("fertilizer/society_report");?>">Society Report</a>
                                    <a href="<?php echo site_url("fertilizer/stock_report");?>">Purchase Stock Report(Product Wise)</a>
                                     <a href="<?php echo site_url("fertilizer/stock_reportcompanywise");?>">Purchase Stock Report(Company Wise)</a>
                                    <a href="<?php echo site_url("fertilizer/f_trial")?>">Return Report</a>  </div>
                        </div>
                    </div>

                    <!-- <div class="dropdown">
                    <div class="dropbtn">
                    <a href="<?php echo site_url("fertilizer/aprvVouDashboard");?>" style="color: white; text-decoration: none;"> Approve</a>
                    </div> 
                    </div> -->

                                      
                
                    <div class="dropdown">
                        <div class="dropbtn">
                            <a href="<?php echo site_url("Fertilizer_Login/logout") ?>" style="color: white; text-decoration: none;"><i class="fa fa-sign-out" aria-hidden="true"></i> Logout</a>
                        </div>    
                    </div>    
                </div>
            
        </nav>
    <section>