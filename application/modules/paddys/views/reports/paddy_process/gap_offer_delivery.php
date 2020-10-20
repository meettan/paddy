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
                action="<?php echo site_url("report/gap_offer_delivery");?>" >

                <div class="form-header">
                
                    <h4>GAP IN OFFER & DELIVERY OF CMR AGAINST CUMULATIVE PADDY PROCURED</h4>
                
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

                        <h4>Gap In Offer & Delivery OF CMR Against Cumulative Paddy Procured Between <?php echo date("d-m-Y", strtotime($this->input->post('from_date'))).' To '.date("d-m-Y", strtotime($this->input->post('to_date')));?></h4>

                    </div>
                    

                    <br>
                     
                    <table style="width: 100%;" id="example" >

                        <thead>

                            <tr>
                            
                                <th>Sl No.</th>

                                <th style="width: 25%">BRANCH</th>
                                <th>Quantity of PADDY PROCURED (MT)</th>
                                <th>State Pool(Progressive Quantity of CMR delivered (MT))</th>
                                <th>Central Pool State A/C(Progressive Quantity of CMR delivered (MT))</th>
                                <th>Central Pool FCI A/C(Progressive Quantity of CMR delivered (MT))</th>

                                <th>Approx. Resultant CMR (MT)

</th>

                                <th>Offer (MT)</th>

                                <th>Gap In Offer Against resultant (MT)</th>

                                <th>Offer Gap % Against Total Resultant CMR</th>

                                <th>Gap in delivery Against resultant (MT)</th>

                                <th>DELIVERY GAP % Against Total RESULTANT CMR</th>

                                <th>Gap in delivery Against offer (MT)</th>

                                <th>DELIVERY GAP % AGAINST OFFER OF CMR</th>

                                

                            </tr>

                        </thead>

                        <tbody>

                            <?php

                                if($dist){ 

                                    $i = 1;
                                    $tot_delivery = 0;
                                    $tot_resultant = 0; 
                                    $tot_offered = 0;
                                    $sp = 0;
                                    $cp = 0;
                                    $fci = 0;
                                    $result =0;
                                    $results = 0;
                                  
                                    foreach($dist as $dis){

                            ?>

                                <tr>
                                     <td><?php echo $i++; ?></td>       <!--sl no-->
                                     <td><?php echo $dis->district_name; ?></td> <!--dist. name-->
                                     <td><?php                                      //Qty in MT
                                                foreach($collc as $colcDtls){
                                                    if($colcDtls->branch_id == $dis->district_code){
                                                         echo $colcDtls->quantity*0.1;
                                                       
                                                    }
                                                }   
                                         ?></td>
                                     <td><?php                                      //SP CMR delivery          
                                                foreach($delv as $del){
                                                    if($del->branch_id == $dis->district_code){
                                                         echo $del->sp * 0.1;
                                                         $sp = $del->sp;
                                                    }
                                                }
                                         ?>
                                     </td>
                                     <td><?php                                      //CP CMR delivery 
                                                foreach($delv as $del){
                                                    if($del->branch_id == $dis->district_code){
                                                         echo $del->cp * 0.1;
                                                        $cp = $del->cp;
                                                    }
                                                }
                                         ?>
                                     </td>
                                     <td><?php                                     //FCI CMR delivery
                                              foreach($delv as $del){
                                                  if($del->branch_id == $dis->district_code){
                                                     echo $del->fci * 0.1;


                                                
                                                  }
                                                }
                                         ?>
                                     </td>
                                     <td><?php                                      //resultant CMR                               
                                                foreach($cmrs as $cmr){
                                                    if($cmr->branch_id == $dis->district_code){
                                                         echo ($cmr->resultant) * 0.1;
                                                        $tot_resultant = $cmr->resultant* 0.1; 
                                                    }
                                                }
                                         ?>
                                     </td>
                                     <td><?php                                     //CMR offered
                                                foreach($cmrs as $cmr){
                                                    if($cmr->branch_id == $dis->district_code){
                                                         echo ($cmr->offered) * 0.1;
                                                        $tot_offered = $cmr->offered* 0.1;
                                                    }
                                                }
                                         ?>
                                     </td>
                                     <td> <?php                                 //Gap in offer against resultant
                                                echo round($tot_resultant- $tot_offered,4);
                                         ?> 
                                     </td>
                                  
                                     <td> <?php                                 //Gap in percentage
                                                if ($tot_resultant ==0){
                                                    echo 0;
                                                }else{     
                                                    $tot_gap = $tot_resultant - $tot_offered; 
                                                    echo round($tot_gap/$tot_resultant,4) * 100;             
                                                }
                                         ?>
                                     </td>
                                     <td>
                                        <?php
                                                foreach($delv as $del){        //Gap in delivery against CMR
                                                    if($del->branch_id == $dis->district_code){
                                                         $cp = $del->cp;
                                                         $sp = $del->sp;
                                                         $fci = $del->fci;
                                                       $tot_delivery =($cp+$sp
                                                            +$fci)*0.1 ;

                                                       echo round($tot_resultant-$tot_delivery,4);
                                                    }
                                                }
                                         ?>

                                  </td>
                                     <td>
                                         <?php
                                                foreach($delv as $del){         //percentage Gap in delivery against CMR
                                                    if($del->branch_id == $dis->district_code){
                                                         $cp = $del->cp;
                                                         $sp = $del->sp;
                                                         $fci = $del->fci;
                                                       $tot_delivery =($cp+$sp
                                                            +$fci)*0.1 ;
                                                        $result=  $tot_resultant-$tot_delivery;

                                                        echo round($result/$tot_resultant,4) * 100;
                                                    }
                                                }
                                         ?>

                                     </td>
                                     <td>
                                      <?php
                                                foreach($delv as $del){        //gap delivery against offer              
                                                    if($del->branch_id == $dis->district_code){
                                                         $cp = $del->cp;
                                                         $sp = $del->sp;
                                                         $fci = $del->fci;
                                                       $tot_delivery =($cp+$sp
                                                            +$fci)*0.1 ;

                                                       echo $tot_offered-$tot_delivery;
                                                    }
                                                }
                                         ?>
                                             
                                    </td>
                                     <td>
                                       <?php
                                                foreach($delv as $del){
                                                    if($del->branch_id == $dis->district_code){
                                                         $cp = $del->cp;
                                                         $sp = $del->sp;
                                                         $fci = $del->fci;
                                                       $tot_delivery =($cp+$sp
                                                            +$fci)*0.1 ;
                                                  $results=  $tot_offered-$tot_delivery;

                                               echo  round(($results/$tot_offered),4)*100;
                                            // (($tot_resultant-$tot_delivery)/$tot_resultant)*100);


                                                    }
                                                }
                                         ?>
                                     </td>
                                   
                                  
                                 
                                     
                                </tr>
                               
 
                                <?php 
                                 $tot_delivery = 0;
                                    $tot_resultant = 0; 
                                    $tot_offered = 0;
                                    $sp = 0;
                                    $cp = 0;
                                    $fci = 0;
                                    $result =0;
                                    $results = 0;
                                    }  ?>
                                     <!-- <tr><td colspan="3" style="text-align: center;">Total</td>
                                     	<td><?=$tot_qty_paddy_purchased?></td>
                                     	<td><?=$tot_registered_farmer?></td>
                                     	<td><?=$tot_benifited_farmer?></td>
                                     	<td><?=$tot_camp?></td>
                                     	<td><?=$tot_amount?></td>
                                     	<td><?=$tot_resultant_cmr?></td>
                                        <td><?=$tot_raw_offered_state?></td>
                                        <td></td>
                                        <td><?=$tot_boiled_offered_state?></td>
                                        <td></td>
                                        <td><?=$tot_raw_rice_delivered_state?></td>
                                        <td><?=$tot_raw_rice_delivered_center?></td>
                                        <td><?=$tot_raw_rice_delivered_fci?></td>
                                        <td><?=$tot_boiled_rice_delivered_state?></td>
                                        <td><?=$tot_boiled_rice_delivered_center?></td>
                                        <td><?=$tot_boiled_rice_delivered_fci?></td>
                                        <td><?=$tot_remain?></td>

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
                    filename: "Gap In Offer & Delivery OF CMR Against Cumulative Paddy Procured Between <?php echo date("d-m-Y", strtotime($this->input->post('from_date'))).' To '.date("d-m-Y", strtotime($this->input->post('to_date')));?>.xls"
                });
            });
        });
    </script>
