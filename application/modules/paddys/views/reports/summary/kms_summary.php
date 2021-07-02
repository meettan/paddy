<style>
table {
    border-collapse: collapse;
}

table, td, th {
    border: 1px solid #dddddd;

    padding: 6px 5px;

    font-size: 11px;
}

th {

    text-align: center;

}

tr:hover {background-color: #f5f5f5;}

</style>

<script>
  function printDiv() {

        var divToPrint = document.getElementById('divToPrint');

        var WindowObject = window.open('', 'Print-Window');
        WindowObject.document.open();
        WindowObject.document.writeln('<!DOCTYPE html>');
        WindowObject.document.writeln('<html><head><title></title><style type="text/css">');


        WindowObject.document.writeln('@media print { .center { text-align: center;}' +
            '                                         .inline { display: inline; }' +
            '                                         .underline { text-decoration: underline; }' +
            '                                         .left { margin-left: 315px;} ' +
            '                                         .right { margin-right: 375px; display: inline; }' +
            '                                          table { border-collapse: collapse; font-size: 12px;}' +
            '                                          th, td { border: 1px solid black; border-collapse: collapse; padding: 6px;}' +
            '                                           th, td { }' +
            '                                         .border { border: 1px solid black; } ' +
            '                                         .bottom { bottom: 5px; width: 100%; position: fixed ' +
            '                                       ' +
            '                                   } } </style>');
        WindowObject.document.writeln('</head><body onload="window.print()">');
        WindowObject.document.writeln(divToPrint.innerHTML);
        WindowObject.document.writeln('</body></html>');
        WindowObject.document.close();
        setTimeout(function () {
            WindowObject.close();
        }, 10);

  }


       

</script>


<?php

    if($_SERVER['REQUEST_METHOD'] == 'GET') {

?>        
   <!-- <div class="wraper">      

        <div class="col-md-6 container form-wraper">
    
            <form method="POST" 
                id="form"
                action="<?php echo site_url("report/summary");?>" >

                <div class="form-header">
                
                    <h4>Millwise Incidental Payment</h4>
                
                </div>

                <div class="form-group row">

                    <label for="from_date" class="col-sm-2 col-form-label">From Date:</label>

                    <div class="col-sm-10">

                        <input type="date"
                               id="from_date" 
                               name="from_date"
                               class="form-control required"
                               value="<?php echo $sys_date;?>" />

                    </div>

                </div>

                <div class="form-group row">

                    <label for="to_date" class="col-sm-2 col-form-label">To Date:</label>

                    <div class="col-sm-10">

                        <input type="date"
                               id="to_date"
                               name="to_date"
                               class="form-control required"
                               value="<?php echo $sys_date;?>" />

                    </div>

                </div>

                <div class="form-group row">

                    <div class="col-sm-10">

                        <input type="submit" class="btn btn-info" value="Proceed" />

                    </div>

                </div>

            </form> 

        </div>

    </div>    -->    

   

        <div class="wraper"> 

            <div class="col-lg-12 container contant-wraper">
                
                <div id="divToPrint">

                    <div class="printHeaderNew">
                        <div class="col-sm-3 float-left logoCustom"><img src="<?php echo base_url("/benfed.png");?>"/></div>
                        <div class="col-sm-9 float-left logoTextSecRight">
                            <h2>The West Bengal State Co-operative Marketing Federation Ltd.<span>Southend Conclave, 3rd Floor,1582 Rajdanga Main Road,Kolkata - 700 107.</span></h2>
                            <h3>Procurement & Payment Summary For KMS : <?php echo $this->session->userdata['loggedin']['kms_yr'];?></h3>
                        </div>
                    </div>
                    

                    <br>
                        <div class="col-md-12" >  
                            <div class="col-md-3">
                                <label>Branch name:</label><?php echo $this->session->userdata['loggedin']['branch_name']; ?>
                            </div>
                        </div>
                    <table style="width: 100%;" id="example">

                        <thead>

                            <tr>
                            
                                <th>Sl No.</th>

                                <th>Description</th>

                                <th>Value</th>

                            </tr>

                        </thead>

                        <tbody>

                                <tr>
                                     <td> 1 </td>

                                     <td>Total Paddy Procurred</td>

                                     <td><?php if($this->session->userdata['loggedin']['ho_flag']=="Y"){

                                                    echo $tot_paddy_procurement_ho->tot_quantity.' <b>Qnt</b>';
                                                }else{
                                         
                                                    echo $tot_paddy_procurement->tot_quantity.' <b>Qnt</b>'; 
                                                }
                                          ?>
                                     </td>
        
                                </tr>

                                <tr>
                                     <td> 2 </td>

                                     <td>
                                            <?php if($this->session->userdata['loggedin']['kms_id'] == '2'){ 
                                                 
                                                    echo "Total No.of Cheques Issued";
                                                }
                                                else{
                                     
                                                    echo "Total Paddy Despatched";
                                                }
                                            ?>
                                     </td>
                          
                                     <td>
                                            <?php if($this->session->userdata['loggedin']['kms_id'] == '2'){ 

                                                        if($this->session->userdata['loggedin']['ho_flag']=="Y"){

                                                            echo $tot_paddy_procurement_ho->cheque_no;
                                                        }else{

                                                            echo $tot_paddy_procurement->cheque_no;
                                                        }
                                                    }
                                                    else{

                                                        if($this->session->userdata['loggedin']['ho_flag']=="Y"){

                                                            echo $tot_paddy_dispatch_ho->paddy_qty.' <b>Qnt</b>'; 
                                                        }
                                                        else{
                                                            echo $tot_paddy_dispatch->paddy_qty.' <b>Qnt</b>';
                                                        }
                                                    }
                                            ?>
                                     </td>
                     
                                </tr>

                                <tr>
                                     <td> 3 </td>

                                     <td>Total Procurred Amount</td>

                                     <td><?php if($this->session->userdata['loggedin']['ho_flag']=="Y"){
                                                 echo '<b>Rs</B> '.$tot_paddy_procurement_ho->amount;
                                                }else{
                                                  echo '<b>Rs</B> '.$tot_paddy_procurement->amount;  
                                                } 
                                        ?>
                                     </td>
        
                                </tr>

                                <tr>
                                     <td> 4 </td>

                                     <td>Total Paid Amount</td>

                                     <td><?php 
                                            if($this->session->userdata['loggedin']['ho_flag']=="Y"){
                                                echo '<b>Rs</B> '.$tot_cheque_cleared_ho->tot_clr_cheque; 
                                            }else{
                                                echo '<b>Rs</B> '.$tot_cheque_cleared->tot_clr_cheque;
                                            }
                                        ?>
                                     </td>
        
                                </tr>

                                <tr>
                                     <td> 5 </td>

                                     <td>Total CMR Offered</td>

                                     <td><?php 
                                            if($this->session->userdata['loggedin']['ho_flag']=="Y"){
                                                echo $tot_cmr_offered_ho->cmr_offered_now.' <b>Qnt</b>';
                                            }else{
                                                echo $tot_cmr_offered->cmr_offered_now.' <b>Qnt</b>';
                                            }
                                        ?>
                                    </td>
        
                                </tr>

                                <tr>
                                     <td> 6 </td>

                                     <td>Total DO Issued</td>

                                     <td><?php 
                                            if($this->session->userdata['loggedin']['ho_flag']=="Y"){
                                                echo $tot_do_issued_ho->tot_do.' <b>Qnt</b>';
                                            }else{
                                                echo $tot_do_issued->tot_do.' <b>Qnt</b>';
                                            }
                                        ?>
                                    </td>
        
                                </tr>

                                <tr>
                                     <td> 7 </td>

                                     <td>Total CMR Delivered</td>

                                     <td><?php 
                                            if($this->session->userdata['loggedin']['ho_flag']=="Y"){
                                                echo $tot_cmr_delivery_ho->tot_delivery.' <b>Qnt</b>';
                                            }else{
                                                echo $tot_cmr_delivery->tot_delivery.' <b>Qnt</b>';    
                                            }
                                          ?>
                                      </td>
        
                                </tr>

                                <tr>
                                     <td> 8 </td>

                                     <td>Total WQSC Uploaded</td>

                                     <td><?php 
                                            if($this->session->userdata['loggedin']['ho_flag']=="Y"){
                                                echo $tot_wqsc_upload_ho->quantity.' Qnt'; 
                                            }else{
                                                echo $tot_wqsc_upload->quantity.' <b>Qnt</b>';
                                            }
                                         ?>
                                      </td>
        
                                </tr>

                                <tr>
                                     <td> 9 </td>

                                     <td>Total Gross Fund Requisition</td>

                                     <td><?php 
                                            if($this->session->userdata['loggedin']['ho_flag']=="Y"){
                                                echo '<b>Rs</B> '.$tot_req_fwd_ho->total_amt ; 
                                            }else{
                                                echo '<b>Rs</B> '.$tot_req_fwd->total_amt ;    
                                            }
                                        ?>
                                     </td>
        
                                </tr>

                                <tr>
                                     <td> 10 </td>

                                     <td>Total Sanctioned Fund</td>

                                     <td><?php 
                                            if($this->session->userdata['loggedin']['ho_flag']=="Y"){
                                                echo '<b>Rs</B> '.$tot_req_sanc_ho->total_amt;
                                            }else{
                                                echo '<b>Rs</B> '.$tot_req_sanc->total_amt;
                                            }
                                        ?>
                                     </td>
        
                                </tr>

                                <tr>
                                     <td> 11 </td>

                                     <td>Total Mill Payment</td>

                                     <td><?php 
                                            if($this->session->userdata['loggedin']['ho_flag']=="Y"){
                                                echo '<b>Rs</B> '.$tot_mill_payment_ho->payable_amt; 
                                            }else{
                                                echo '<b>Rs</B> '.$tot_mill_payment->payable_amt;
                                            }
                                        ?>
                                     </td>
        
                                </tr>

                                <tr>
                                     <td> 12 </td>

                                     <td>Total Society Payment</td>

                                     <td><?php 
                                            if($this->session->userdata['loggedin']['ho_flag']=="Y"){
                                                echo '<b>Rs</B> '.$tot_socy_payment_ho->paid_amt; 
                                            }else{
                                                echo '<b>Rs</B> '.$tot_socy_payment->paid_amt;
                                            }
                                            ?>
                                     </td>
        
                                </tr>

                        </tbody>

                    </table>

                </div>   
                
                <div class="nextPrvBtn">

                    <button class="btn btn-primary" type="button" onclick="printDiv();">Print</button>
                     <button class="btn btn-primary" type="button" id="btnExport" >Excel</button>

                </div>

            </div>
            
        </div>
        
    <?php

    }

    ?> 

     <script type="text/javascript">
        $(function () {
            $("#btnExport").click(function () {
                $("#example").table2excel({
                    filename: "Procurement & Payment Summary For KMS <?php echo $this->session->userdata['loggedin']['kms_yr'];?>.xls"
                });
            });
        });
    </script>