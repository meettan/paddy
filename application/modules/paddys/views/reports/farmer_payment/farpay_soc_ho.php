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
    <div class="wraper">      

        <div class="col-md-6 container form-wraper">
    
            <form method="POST" 
                id="form"
                action="<?php echo site_url("report/farmerpay");?>" >

                <div class="form-header">
                
                    <h4>Societywise Report on Farmer Payment</h4>
                
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

                  <label for="dist" class="col-sm-2 col-form-label">District:</label>

              <div class="col-sm-10">

              <select name="dist" id="dist" class="form-control required">
               <option value="">Select</option>  
                      <?php foreach($dists as $dist)  { ?>  
                      <option value="<?php if(isset($dist->district_code)){echo $dist->district_code;}?>"><?php if(isset($dist->district_name)){echo $dist->district_name;}?></option> 
                 <?php } ?>   
               </select>
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

                    <div class="printHeaderNew">

                        <div class="col-sm-3 float-left logoCustom"><img src="<?php echo base_url("/benfed.png");?>"/></div>

                        <div class="col-sm-9 float-left logoTextSecRight">

                            <h2>The West Bengal State Co-operative Marketing Federation Ltd.<span>Southend Conclave, 3rd Floor,1582 Rajdanga Main Road,Kolkata - 700 107.</span></h2>

                            <h3>Societywise Report on Farmer Payment <?php echo date("d-m-Y", strtotime($this->input->post('from_date'))).' To '.date("d-m-Y", strtotime($this->input->post('to_date')));?></h3>
                        </div>

                    </div>
                    
                    <br>
                     <div class="col-md-12" >  
                        <div class="col-md-3">
                        <label>Branch name: </label> <?php echo get_district_name($this->input->post("dist")) ?>
                    </div>
                   </div>
                    <table style="width: 100%;" id="example" >
                        <thead>
                            <tr>
                                <th>Sl No.</th>
                                <th>Block name</th>
                                <th>Name of Cooperative Society which procured paddy</th>
                                <th>Number of seller farmers</th>
                                <th>Quantity of paddy procured (MT)</th>
                                <th>Price of paddy procured at Minimum Support Price (Rupees)</th>
                                <th>Total amount paid to farmers (Rupees)</th>
                                <th>Total amount of neft cleared (Rupees)</th>
                                <th>No.of Farmers Received Amount</th>
                                <th>Number of neft reissued</th>
                                <th>Amount for which neft was reissued(Rupees)</th>
                                <!--<th>Number of cheques reissued next</th>
                                <th>Amount for which cheque was reissued next (Rupees)</th>-->
                                <th>Amount of neft yet to be cleared (Rupees)</th>
                                <th>No.of farmers yet to receive</th>
                            </tr>
                        </thead>

                        <tbody>

                            <?php

                                if($socDtls){ 

                                    $i = 1;
                                    $tot_qty_paddy_purchased = 0;
                                    $tot_benifited_farmer = 0;  $tot_amount = 0; $benifited_farmer = 0;
                                    $amt  = 0.00;
                                    $amount_cls = 0.00;
                                    $amount_cl = 0;
                                    $chequ_reissue = 0;
                                    $chequ_reis_amt =0;
                                    $tot_remain = 0;
                                    $tot_farm_recvd = 0;
                                    $farm_recvd = 0;
                                    $tot_unpaid =0;

                                    foreach($socDtls as $soc){

                            ?>

                                <tr>
                                     <td><?php echo $i++; ?></td>               <!--sl no-->
                                     <td><?php echo $soc->block_name; ?></td>   <!--block name-->
                                     <td><?php echo $soc->soc_name; ?></td>     <!--society name-->
                                       <td><?php          
                                                                                 //no.of farmer
                                                foreach($collc as $colcDtls){
                                                    //$benifited_farmer = 0;
                                                    if($colcDtls->soc_id == $soc->society_code){
                                                         echo $colcDtls->farm_ben;
                                                         $benifited_farmer      = $colcDtls->farm_ben;
                                                         $tot_benifited_farmer += $colcDtls->farm_ben;
                                                    }
                                                }   
                                         ?>
                                     </td>
                                     <td><?php                                  //paddy quantity
                                                foreach($collc as $colcDtls){
                                                    if($colcDtls->soc_id == $soc->society_code){
                                                         echo $colcDtls->quantity * 0.1;
                                                         $tot_qty_paddy_purchased += $colcDtls->quantity * 0.1;
                                                    }
                                                }
                                         ?>
                                     </td>

                                     <td><?php                                                      //paddy price
                                               echo get_paddy_price($this->session->userdata['loggedin']['kms_id']); 
                                         ?>
                                     </td>
                                     <td>
                                        <?php                                   //total amt paid
                                                foreach($collc as $colcDtls){
                                                    if($colcDtls->soc_id == $soc->society_code){
                                                         echo $colcDtls->amount;
                                                         $tot_amount += $colcDtls->amount;
                                                         $amt = $colcDtls->amount;
                                                    }
                                                }   
                                         ?>
                                     </td>

                                     <td>
                                         
                                         <?php
                                                foreach($coll as $cos){                 //total amt chq cleared
                                                    if($cos->soc_id == $soc->society_code){
                                                         echo $cos->amount_clr;
                                                         $amount_cl += $cos->amount_clr; 
                                                         $amount_cls = $cos->amount_clr;                                                                                    
                                                         }                                              
                                                }   
                                         ?>
                                     </td>

                                     <td>
                                         
                                         <?php                                //no. of farmer received
                                                foreach($coll as $cos){
                                                    //$farm_recvd = 0;
                                                    if($cos->soc_id == $soc->society_code){
                                                         echo $cos->farm_rcvd;
                                                         $farm_recvd      = $cos->farm_rcvd;
                                                         $tot_farm_recvd += $farm_recvd;
                                                    }                   
                                                }   
                                         ?>
                                     </td>



                                     <td>
                                         
                                         <?php                                      //no. of chq reissue
                                                foreach($reissues as $reiss){
                                                    if($reiss->soc_id == $soc->society_code){
                                                         echo $reiss->reissue_no;
                                                         $chequ_reissue += $reiss->reissue_no; 
                                                         }                                              
                                                }   
                                         ?>
                                     </td>

                                     <td>
                                         
                                         <?php
                                                foreach($reissues as $reiss){                   //amt of chq reissue
                                                    if($reiss->soc_id == $soc->society_code){
                                                         echo $reiss->amt_ressiue;
                                                         $chequ_reis_amt += $reiss->amt_ressiue; 
                                                         }                                              
                                                }   
                                         ?>
                                     </td>
                                  
                                     <!--<td> </td> -->                        <!--no. chq reissue 2nd-->

                                     <!--<td></td>-->                     <!--amt of chq reissue 2nd-->

                                     <td><?php echo ($amt-$amount_cls)?></td>               <!--total uncleared chq-->

                                     <td>
                                         <?php
                                                foreach($unpaid as $unpaidfarm){                   //amt of unpaid
                                                    if($unpaidfarm->soc_id == $soc->society_code){
                                                         echo $unpaidfarm->unpaid_farm_rcvd;
                                                         $tot_unpaid += $unpaidfarm->unpaid_farm_rcvd;
                                                         }                                              
                                                }   
                                         ?>
                                     </td>              <!--yet to receive-->
                                    
                                </tr>
                               
 
                                <?php 
                                 $amt  = 0.00;
                                    $amount_cls = 0.00;
                                    }  ?>
                                    <tr><td colspan="3" style="text-align:center;font-weight: bold;">Total</td>
                                     	<td style="text-align:center;font-weight: bold;"><?=$tot_benifited_farmer?></td>
                                     	<td style="text-align:center;font-weight: bold;"><?=$tot_qty_paddy_purchased?></td>
                                     	<td style="text-align:center;font-weight: bold;"></td>
                                     	<td style="text-align:center;font-weight: bold;"><?=$tot_amount?></td>
                                     	<td style="text-align:center;font-weight: bold;"><?=$amount_cl?></td>
                                        <td style="text-align:center;font-weight: bold;"><?=$tot_farm_recvd?></td> 
                                     	<td style="text-align:center;font-weight: bold;"><?=$chequ_reissue?></td>
                                        <td style="text-align:center;font-weight: bold;"><?=$chequ_reis_amt?></td>
                                        <td style="text-align:center;font-weight: bold;"><?php echo $tot_amount - $amount_cl ?> </td>
                                        <td style="text-align:center;font-weight: bold;"><?php echo $tot_unpaid; ?> </td>
                                     </tr>

                         <?php        }
                                else{

                                    echo "<tr><td colspan='14' style='text-align:center;'>No Data Found</td></tr>";

                                }   

                            ?>

                        </tbody>

                    </table>

                </div>   
                
                <div class= "nextPrvBtn">

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
                    filename: "District Report on Farmer Payment Between <?php echo date("d-m-Y", strtotime($this->input->post('from_date'))).' To '.date("d-m-Y", strtotime($this->input->post('to_date')));?>.xls"
                });
            });
        });
    </script>
