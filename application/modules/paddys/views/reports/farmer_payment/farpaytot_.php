<style>
table {
    border-collapse: collapse;
}

table, td, th {
    border: 1px solid #dddddd;

    padding: 6px;

    font-size: 14px;
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
    <div class="wraper">      

        <div class="col-md-6 container form-wraper">
    
            <form method="POST" 
                id="form"
                action="<?php echo site_url("report/farmerpaytot");?>" >

                <div class="form-header">
                
                    <h4>Consolidated Report on Farmer Payment</h4>
                
                </div>

                <div class="form-group row">

                    <label for="from_date" class="col-sm-2 col-form-label">From Date:</label>

                    <div class="col-sm-10">

                        <input type="date"
                               name="from_date"
                               class="form-control required"
                               value="<?php echo $sys_date;?>" />

                    </div>

                </div>

                <div class="form-group row">

                    <label for="to_date" class="col-sm-2 col-form-label">To Date:</label>

                    <div class="col-sm-10">

                        <input type="date"
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

    </div>        

    <?php

    }
    
    else if($_SERVER['REQUEST_METHOD'] == 'POST') { 
     
    ?>

        <div class="wraper"> 

            <div class="col-lg-12 container contant-wraper">
                
                <div id="divToPrint">

                    <div style="text-align:center;">

                        <h2>The West Bengal State Co-operative Marketing Federation Ltd.</h2>

                        <h4>Southend Conclave, 3rd Floor,1582 Rajdanga Main Road,Kolkata - 700 107.</h4>

                        <h4>Consolidated Report on Farmer Payment <?php echo date("d-m-Y", strtotime($this->input->post('from_date'))).' To '.date("d-m-Y", strtotime($this->input->post('to_date')));?></h4>

                    </div>
                    
                    <br>
                    
                    <table style="width: 100%;" id="example" >
                        <thead>
                            <tr>
                                <th>Sl No.</th>
                                <th>District</th>
                                <th>Number of Societies which procured paddy</th>
                                <th>Number of seller farmers</th>
                                <th>Quantity of paddy procured (MT)</th>
                                <th>Price of paddy procured at Minimum Support Price (Rupees)</th>
                                <th>Amount paid to farmers (Rupees)</th>
                                <th>Amount of cheque cleared (Rupees)</th>
                                <th>Number of cheques reissued</th>
                                <th>Amount for which cheque was reissued (Rupees)</th>
                                <!--<th>Number of cheques reissued next</th>
                                <th>Amount for which cheque was reissued next (Rupees)</th>-->
                                <th>Amount of cheque yet to be cleared (Rupees)</th>
                            </tr>
                        </thead>

                        <tbody>

                            <?php
                    $kms_id = $this->session->userdata['loggedin']['kms_id'];
                               if(isset($dist)) {

                                    $i = 1;
                                    $tot_qty_paddy_purchased = 0;
                                    $tot_benifited_farmer = 0;  $tot_amount = 0;
                                    $amt=0.00;
                                    $amount_cl = 0.00;
                                    $chequ_reissue = 0;
                                    $chequ_reis_amt =0;
                                    $tot_remain = 0;

                                  foreach($dist as $dis) {

                            ?>

                                <tr>
                                     <td><?php echo $i++; ?></td>
                                     <td><?php echo $dis->district_name; ?></td>                <!--District-->
                                     <td><?php foreach($collc as $colcDtls){
                                                    if($colcDtls->branch_id == $dis->district_code){  //no.of society
                                                        echo $colcDtls->soc_no;
                                                    }
                                                }          
                                            ?>
                                       </td>
                                    <td> <?php                                                   //no. of farmer
                                                foreach($collc as $colcDtls){
                                                    if($colcDtls->branch_id == $dis->district_code){
                                                         echo $colcDtls->farm_ben;
                                                       
                                                    }
                                                }   
                                         ?>
                                     </td>
                                     <td> <?php                                                 //total quantity
                                                foreach($collc as $colcDtls){   
                                                    if($colcDtls->branch_id == $dis->district_code){
                                                         echo $colcDtls->quantity*0.1;
                                                       
                                                    }
                                                }   
                                         ?>
                                     </td>
                                    <td><?php                                                      //msp
                                               echo get_paddy_price($this->session->userdata['loggedin']['kms_id']); 
                                         ?>
                                     </td>
                                     <td>
                                         <?php                                              //total amount
                                                foreach($collc as $colcDtls){
                                                    if($colcDtls->branch_id == $dis->district_code){
                                                         echo $colcDtls->amount;
                                                       $amt = $colcDtls->amount;
                                                    }
                                                }   
                                         ?>
                                     </td>

                                     <td>
                                         
                                      <?php
                                                foreach($coll as $cos){                         //total amount of cleared chq
                                                    if($cos->branch_id == $dis->district_code){
                                                         echo $cos->amount_clr;
                                                         $amount_cl = $cos->amount_clr; 
                                                         }                                              
                                                }   
                                         ?>
                                     </td>

                                     <td>
                                         
                                        <?php
                                                foreach($reissues as $reiss){                   //no. of chq reissue
                                                    if($reiss->branch_id == $dis->district_code){
                                                         echo $reiss->chequ;
                                                         $chequ_reissue += $reiss->chequ; 
                                                         }                                              
                                                }   
                                         ?>
                                     </td>

                                     <td>
                                       
                                         <?php                                                  //amt of chq reissue          
                                                foreach($reissues as $reiss){
                                                    if($reiss->branch_id == $dis->district_code){
                                                         echo $reiss->amounr;
                                                         $chequ_reis_amt += $reiss->amounr; 
                                                         }                                              
                                                }   
                                         ?>
                                            </td>
                                  
                                     <!--<td> </td>

                                     <td></td>-->

                                     <td><?php echo ($amt-$amount_cl)?></td>
                                    
                                </tr>
                               
 
                                <?php 
                                           $amt=0.00;
                                    $amount_cl = 0.00;
                                    }  ?>
                                    <!--  <tr><td colspan="3" style="text-align: center;">Total</td>
                                     	<td><?=$tot_benifited_farmer?></td>
                                     	<td><?=$tot_qty_paddy_purchased?></td>
                                     	<td></td>
                                     	<td><?=$tot_amount?></td>
                                     	<td><?=$amount_cl?></td>
                                     	<td><?=$chequ_reissue?></td>
                                        <td><?=$chequ_reis_amt?></td>
                                        <td></td>
                                        <td></td>
                                        <td></td>

                                     </tr> -->

                         <?php        }
                                else{

                                    echo "<tr><td colspan='14' style='text-align:center;'>No Data Found</td></tr>";

                                }   

                            ?>

                        </tbody>

                    </table>

                </div>   
                
                <div style="text-align: center;">

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
                    filename: "Consolidated Report on Farmer Payment Between <?php echo date("d-m-Y", strtotime($this->input->post('from_date'))).' To '.date("d-m-Y", strtotime($this->input->post('to_date')));?>.xls"
                });
            });
        });
    </script>
