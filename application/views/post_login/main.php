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
        <link rel="stylesheet" href="<?php echo base_url("/assets/css/anexture.css");?>">
        
       
    <link href="https://maxcdn.bootstrapcdn.com/bootstrap/3.2.0/css/bootstrap.min.css" rel="stylesheet">
      <link href="<?php echo base_url("/assets/css/bootstrap-toggle.css");?>" rel="stylesheet">
      <link href="<?php echo base_url("/assets/css/jquery.dataTables.css");?>" rel="stylesheet">
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.3.1/jquery.min.js"></script>
   
    <!-- <script type="text/javascript" src="https://ajax.googleapis.com/ajax/libs/jquery/2.2.4/jquery.min.js"></script> -->
 <script type="text/javascript" src="<?php echo base_url("/assets/js/jquery.dataTables.js")?>"></script>
     <script type="text/javascript" src="<?php echo base_url("/assets/js/validation.js")?>"></script>
        <script type="text/javascript" src="<?php echo base_url("/assets/js/select2.js")?>"></script>
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

    <link rel="stylesheet" type="text/css" href="<?php echo base_url("/assets/css_table/apps.css"); ?>">
    <link rel="stylesheet" type="text/css" href="<?php echo base_url("/assets/css_table/apps_inner.css"); ?>">
    <link rel="stylesheet" type="text/css" href="<?php echo base_url("/assets/css_table/res.css"); ?>">

    </head>  
    <body id="page-top" style="background-color: #eff3f6;">
        <header class="header_class">
<ul class="header_top">
<li><strong>Branch Name: </strong><?php if(isset($this->session->userdata['loggedin']['branch_name'])){ echo $this->session->userdata['loggedin']['branch_name'];}?></li>
<li><strong>KMS Year: </strong><?php if(isset($this->session->userdata['loggedin']['kms_yr'])){ echo $this->session->userdata['loggedin']['kms_yr'];}?></li>
<li><strong>User: </strong><?php if(isset($this->session->userdata['loggedin']['user_name'])){ echo $this->session->userdata['loggedin']['user_name'];}?></li>
<li><strong>Module: </strong>Paddy Procurement</li>
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
                    <a href="<?php echo site_url("User_Login/main");?>" style="color: white; text-decoration: none;"><i class="fa fa-home"></i> Home</a>
                    </div> 

                    </div>
                    <div class="dropdown">
                        <div class="dropbtn">
                            <i class="fa fa-bar-chart" aria-hidden="true"></i>
                            Master 
                            <i class="fa fa-angle-down"></i>
                        </div>
                        <div class="dropdown-content">
                        <?php if($this->session->userdata['loggedin']['user_type']=="A" && $this->session->userdata['loggedin']['ho_flag']=="Y"){?>
                            <a href="<?php echo site_url('paddys/add_new/f_fs_guidelines');?>">F&S Guidelines</a>
                            <a href="<?php echo site_url('paddys/add_new/f_district');?>">District</a>
                            <a href="<?php echo site_url('paddys/add_new/f_block');?>">Block</a>
                            <a href="<?php echo site_url('paddys/add_new/f_mill');?>">Mill</a>
                            <a href="<?php echo site_url('paddys/add_new/f_society');?>">Society</a>
                            <a href="<?php echo site_url('paddys/add_new/particulars');?>">Parameters</a> 
                            <a href="<?php echo site_url('paddys/add_new/f_paddy_bank');?>">Bank</a>
                            <?php } ?>
                            <?php if( $this->session->userdata['loggedin']['ho_flag']=="N" ){?> 
							<a href="<?php echo site_url('paddy/societyl');?>">Society</a>
							 <a href="<?php echo site_url('paddys/add_new/f_milll');?>">Mill</a>
                            <a href="<?php echo site_url('paddys/add_new/f_society_mill');?>">Society Mill Connection</a> 
							
                            <?php } ?> 
                        <?php if($this->session->userdata['loggedin']['user_type']=="A" && $this->session->userdata['loggedin']['ho_flag']=="Y"){?>   
                            <a href="<?php echo site_url('paddys/add_new/f_farmer');?>">Farmer's Registration</a>
                            <a href="<?php echo site_url('paddys/add_new/msp');?>">MSP</a>
                            <a href="<?php echo site_url('paddys/add_new/ricerate');?>">Rice Rate</a>  
                            <a href="<?php echo site_url('add_new/soccomrate');?>">Society Commision Rate</a> 
                            <a href="<?php echo site_url('paddys/add_new/f_farmer_trans');?>">Transaction Data</a>
                            <a href="<?php echo site_url('paddys/add_new/bill_master');?>">Bill Master</a>
                        <?php } ?>     
                        </div>
                    </div>
                    <div class="dropdown">
                        <div class="dropbtn">
                            <i class="fa fa-group" aria-hidden="true"></i>
                            Transactions
                            <i class="fa fa-angle-down"></i>
                        </div>
                        <div class="dropdown-content">
                        <?php if($this->session->userdata['loggedin']['user_type']=="U" OR $this->session->userdata['loggedin']['user_type']=="M" OR $this->session->userdata['loggedin']['user_type']=="A" && $this->session->userdata['loggedin']['ho_flag'] =="N"){ ?>
                            <a href="<?php echo site_url('paddys/transactions/f_workorder'); ?>">Work Order</a>
                     
                            <a href="<?php echo site_url('paddys/transactions/f_paddycollection'); ?>">Paddy Procurement</a>
                     
                         <!--   <a href="<?php //echo site_url('paddys/trans_neft/f_paddy_neft_coll'); ?>">Paddy Procurement(NEFT)</a> --> 
                            <?php } ?>

                            <?php 
                    if( $this->session->userdata['loggedin']['ho_flag'] == "N" ) {  
                        ?>
             
                       <!--  <a href="<?php echo site_url('paddys/transactions/f_paddycollection_dwn'); ?>">Download Procurement</a> -->
                      <!--   <a href="<?php echo site_url('paddys/transactions/f_return_cheque'); ?>">Return Cheque</a> -->
                   <!-- <a href="<?php //echo site_url('paddys/transactions/f_reissuchq'); ?>">Reissue Cheque</a> --> 
                   <?php   if( $this->session->userdata['loggedin']['kms_id'] == 2 ) {   ?>
                       <a href="<?php echo site_url('paddys/transactions/failneft'); ?>">Reissue NEFT</a>
                      <a href="<?php  echo site_url('paddys/transactions/f_reissuchq'); ?>">Reissue Cheque</a> 
                        <?php }else{ ?> 

                          <a href="<?php echo site_url('paddys/transactions/failnefts'); ?>">Reissue NEFT</a> 
                  <?php  } } ?>
                                 
                    <?php if($this->session->userdata['loggedin']['ho_flag']=="Y" && $this->session->userdata['loggedin']['user_type']=="A" /*OR $this->session->userdata['loggedin']['user_type']=="M"*/) { ?>
			
                        <?php   if( $this->session->userdata['loggedin']['kms_id'] == 2 ) {   ?>     
                            <a href="<?php echo site_url('paddys/transactions/f_paddycollection_dwn'); ?>">Download Procurement</a> 
                            <a href="<?php echo site_url('paddys/transactions/f_paddycollreissue_dwn'); ?>">Download Cheque Reissue</a>
                        <?php } ?>

                        
                        
                            <!--<a href="<?php //echo site_url('paddys/transactions/f_neft_status'); ?>">NEFT Status </a>-->

                      
                          <!-- 
                        <div class="sub-dropdown">
                               <a class="sub-dropbtn">Cheque Reconciliation<i class="fa fa-angle-right" style="float: right;"></i></a> 
                               <div class="sub-dropdown-content">
                                 <a href="<?php //echo site_url('paddys/transactions/f_yescheque');?>">Yes Bank</a>
                                 <a href="<?php //echo site_url('paddys/transactions/f_bandhancheque');?>">Bandhan Bank</a>
                                </div>
                        </div>
 -->
                       <!--  <a href="<?php //echo site_url('paddys/transactions/f_neft_reconcil'); ?>">NEFT Reconciliation</a> -->
                      <!--   <a href="<?php //echo site_url('paddys/transactions/f_singlecheque'); ?>">Cheque Detail</a> -->
                           <?php 
                        
                        if($this->session->userdata['loggedin']['ho_flag'] =="Y"){
                        if($this->session->userdata['loggedin']['user_id']=="bholanathm" || $this->session->userdata['loggedin']['user_id'] =="barund"){
                        ?>
                        <a href="<?php echo site_url('payment/requisitionho'); ?>">Fund Requisition</a>

                        <?php } 
                                    }?>
                        <?php if($this->session->userdata['loggedin']['user_id']=="anirbanc" && $this->session->userdata['loggedin']['ho_flag'] =="Y"){ ?>
                        <a href="<?php echo site_url('payment/requisitionho2'); ?>">Fund Requisition</a>

                        <?php }?>

                        <?php if($this->session->userdata['loggedin']['user_id']=="anupamm" && $this->session->userdata['loggedin']['ho_flag'] =="Y"){ ?>

                        <a href="<?php echo site_url('payment/requisitionho3'); ?>">Fund Requisition</a>

                        <?php }?>
                         <?php if($this->session->userdata['loggedin']['user_id']=="anirbanc" && $this->session->userdata['loggedin']['ho_flag'] =="Y"){ ?>
                         <a href="<?php echo site_url('payment/fundallocation'); ?>">Fund Allocation</a>

                            <?php }?>


                            <?php } ?>
                           <?php if($this->session->userdata['loggedin']['user_type']=="U" OR $this->session->userdata['loggedin']['user_type']=="M" OR $this->session->userdata['loggedin']['user_type']=="A" && $this->session->userdata['loggedin']['ho_flag'] =="N"){ ?>
                            <a href="<?php echo site_url('paddys/transactions/f_received'); ?>">Dispatch Paddy to Rice Mill</a>

                            <a href="<?php echo site_url('paddys/transactions/f_offered');?>">CMR offered</a>

                            <a href="<?php echo site_url('paddys/transactions/f_doisseued');?>">DO Issue</a>

                            <a href="<?php echo site_url('paddys/transactions/f_delivery');?>">CMR Delivery</a>

                            <a href="<?php echo site_url('paddys/transactions/f_wqsc');?>">WQSC</a>

                            <?php } ?>                          
                        </div>

                    </div>

                  
            <?php   if($this->session->userdata['loggedin']['ho_flag'] == "Y" ) {  ?>
			
			  <div class="dropdown">
                        <div class="dropbtn">
                            <i class="fa fa-group" aria-hidden="true"></i>Notice
                            <i class="fa fa-angle-down"></i>
                        </div>
                        <div class="dropdown-content">
                              <?php   if($this->session->userdata['loggedin']['ho_flag'] == "Y" ) {  ?>
                            
							<a href="<?php echo site_url('paddys/add_new/notice'); ?>">Upload Notice</a>

                              <?php } ?>
                        </div>
                    </div>
			
			<?php }else{ ?>
			
			
                    <div class="dropdown">
                        <div class="dropbtn">
                            <i class="fa fa-group" aria-hidden="true"></i>ANNEXURE
                            <i class="fa fa-angle-down"></i>
                        </div>
                        <div class="dropdown-content">
                              <?php   if($this->session->userdata['loggedin']['ho_flag'] == "Y" ) {  ?>
                            
							<a href="<?php echo site_url('paddys/add_new/notice'); ?>">Upload Notice</a>

                              <?php }else{ ?>
                        <!--     <a href="<?php//echo site_url('payment/annexture2'); ?>">ANNEXURE II</a> -->
                            <a href="<?php echo site_url('payment/annexture3'); ?>">ANNEXURE III</a>
                            <!-- <a href="<?php echo site_url('payment/annexture4'); ?>">ANNEXURE IV</a> -->
                            <a href="<?php echo site_url('payment/annexture5'); ?>">ANNEXURE V</a>
                            <a href="<?php echo site_url('payment/annexture6'); ?>">ANNEXURE VI</a>
                            <a href="<?php echo site_url('payment/annexture7'); ?>">ANNEXURE VII</a>
                            <a href="<?php echo site_url('payment/annexture8'); ?>">ANNEXURE VIII</a>
                            <a href="<?php echo site_url('payment/annexture9'); ?>">ANNEXURE IX</a>
                            <a href="<?php echo site_url('payment/annexture10'); ?>">ANNEXURE X</a>
                            <a href="<?php echo site_url('payment/annexture11'); ?>">ANNEXURE XI</a>
                        <?php } ?>
                        </div>
                    </div>
					
			<?php } ?>

                    <?php   if($this->session->userdata['loggedin']['ho_flag'] == "N" ) {  ?>

                    <div class="dropdown">
                        <div class="dropbtn">
                            <i class="fa fa-group" aria-hidden="true"></i>Payment
                            <i class="fa fa-angle-down"></i>
                        </div>
                        <div class="dropdown-content">
                            <a href="<?php echo site_url('payment/requisition'); ?>">Fund Requisition</a>
                            <a href="<?php echo site_url('payment/payment'); ?>">Millers Bill Payment</a>
                            <a href="<?php echo site_url('payment/commission'); ?>">Society Bill</a>
                           
                        </div>
                    </div>

                    <?php } ?>
                   
                    <div class="dropdown">
                        <div class="dropbtn">
                            <i class="fa fa-group" aria-hidden="true"></i>
                            Report
                            <i class="fa fa-angle-down"></i>
                        </div>
                        <div class="dropdown-content">
                         
                         <?php   if($this->session->userdata['loggedin']['ho_flag'] == "N" ) {  
                         ?>
                            <a href="<?php echo site_url('report/socProc'); ?>">Societywise Procurement</a>
                            <a href="<?php echo site_url('report/millProc'); ?>">Millwise Procurement</a>
                            <?php   if( $this->session->userdata['loggedin']['kms_id'] == 2 ) {   ?>
                                <a href="<?php echo site_url('report/neftRet'); ?>">Returned NEFT</a>
                            
                        <?php } } ?>

                         <?php   if($this->session->userdata['loggedin']['ho_flag'] == "Y" ) {  
                         ?>
                            <a href="<?php echo site_url('report/distProcho'); ?>">Districtwise Procurement</a>
                            <?php  // if( $this->session->userdata['loggedin']['kms_id'] > 2 ) {   ?>
                              <!--  <a href="<?php //echo site_url('report/distPayHo'); ?>">Districtwise Farmer Payment Summary</a>-->
                            <?php //} ?>
                            <a href="<?php echo site_url('report/socProcho'); ?>">Societywise Procurement</a>
                            <a href="<?php echo site_url('report/millProcho'); ?>">Millwise Procurement</a>
                            <a href="<?php echo site_url('report/farmerpaytot'); ?>">Districtwise Farmer Payment</a>
                            <a href="<?php echo site_url('report/farmerpay'); ?>">Societywise Farmer Payment</a>
                            
                            <a href="<?php echo site_url('report/neftRet'); ?>">Returned NEFT</a>
                            <a href="<?php echo site_url('report/reselling'); ?>">Paddy Repeat Selling</a>
                            
                            <a href="<?php echo site_url('report/gap_offer_delivery'); ?>">Gap In Offer & Delivery</a>
                            <a href="<?php echo site_url('report/distIncPay'); ?>">Districtwise Payment of Incidentals</a>
                            <!-- <a href="<?php echo site_url('report/returncheque'); ?>">Return Cheque</a> -->
                        <?php } ?>
                        <?php   if( $this->session->userdata['loggedin']['kms_id'] == 2 ) {   ?>
                            <a href="<?php echo site_url('report/chequestatus'); ?>">Cheque Status</a>
                        <?php } ?>
									<a href="<?php echo site_url('payment/annexture2'); ?>">ANNEXURE II</a>
                        <?php   if($this->session->userdata['loggedin']['ho_flag'] != "Y" ) {  ?>

                           <?php if( $this->session->userdata['loggedin']['kms_id'] == 2 ) { ?> 

                                <a href="<?php echo site_url('report/neftstatus'); ?>">Neft Status</a>

                            <?php } ?>

                           <a href="<?php echo site_url('report/offer_cmrrep'); ?>">Offer For Delivery Of Cmr</a>
                           <a href="<?php echo site_url('report/socyIncPay'); ?>">Societywise Payment of Incidentals</a>
                           <a href="<?php echo site_url('report/millIncPay'); ?>">Millwise Payment of Incidentals</a>

                        <?php } ?>

                         <!--   <div class="sub-dropdown">
                                <a class="sub-dropbtn">Annexture <i class="fa fa-angle-right" style="float: right;"></i></a>    
                                <div class="sub-dropdown-content">
                               
                               <?php   if($this->session->userdata['loggedin']['ho_flag'] == "Y" ) {  ?>
                               <a href="<?php echo site_url('payment/annexture2'); ?>">ANNEXURE II</a>

                              <?php }else{ ?>
                                <a href="<?php echo site_url('payment/annexture2'); ?>">ANNEXURE II</a>
                                <a href="<?php echo site_url('payment/annexture3'); ?>">ANNEXURE III</a>
                                <a href="<?php echo site_url('payment/annexture4'); ?>">ANNEXURE IV</a>
                             
                              <?php } ?>
                               
                                </div>
                            </div> -->
                            <!-- <a href="<?php echo site_url('paddy/datewiseprocurement/report'); ?>">Date Wise Procurement</a>
                            <a href="<?php echo site_url('paddy/proctodelivery/report'); ?>">Procurement to Delivery</a>
                            <a href="<?php echo site_url('paddy/payment/report'); ?>">Payment</a> -->
                        </div>
                    </div>
                    <div class="dropdown">
                    <div class="dropbtn">
                            <i class="fa fa-cog fa-spin fa-fw" aria-hidden="true"></i>
                            Setting
                            <i class="fa fa-angle-down"></i>
                        </div>
                        <div class="dropdown-content">
                        <a href="<?php echo site_url("profile") ?>">Change Password</a>
                        <?php  if($this->session->userdata['loggedin']['user_type']!="U"){
                            ?>
                        <a href="<?php echo site_url('admin/user'); ?>">Create User</a>
                        <?php }?>
                        </div>
                    </div>
                    <div class="dropdown">
                        <div class="dropbtn">
                            <a href="<?php echo site_url("User_Login/logout") ?>" style="color: white; text-decoration: none;"><i class="fa fa-sign-out" aria-hidden="true"></i> Logout</a>
                        </div>    
                    </div>    
                </div>
            
        </nav>
        <section>
