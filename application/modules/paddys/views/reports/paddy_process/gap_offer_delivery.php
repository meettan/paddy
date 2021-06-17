<style>
table {
    border-collapse: collapse;
}

table, td, th {
    border: 1px solid #dddddd;

    padding: 6px 5px;

    font-size: 11px;

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
                
                    <h4>Gap In Offer & Delivery</h4>
                
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

                    <div class="printHeaderNew">
                        <div class="col-sm-3 float-left logoCustom"><img src="<?php echo base_url("/benfed.png");?>"/></div>
                        <div class="col-sm-9 float-left logoTextSecRight">
                            <h2>The West Bengal State Co-operative Marketing Federation Ltd.<span>Southend Conclave, 3rd Floor,1582 Rajdanga Main Road,Kolkata - 700 107.</span></h2>
                            <h3>Gap In Offer & Delivery OF CMR Against Cumulative Paddy Procured Between <?php echo date("d-m-Y", strtotime($this->input->post('from_date'))).' To '.date("d-m-Y", strtotime($this->input->post('to_date')));?></h3>
                        </div>
                    </div>

                    <br>
                     
                    <table style="width: 100%;" id="example" >

                        <thead>

                            <tr>
                            
                                <th>Sl No.</th>

                                <th style="width: 25%">District</th>

                                <th>Quantity of Paddy Procured (MT)</th>

                                <th>State Pool(Progressive Quantity of CMR delivered (MT))</th>

                                <th>Central Pool(Progressive Quantity of CMR delivered (MT))</th>

                                <th>FCI(Progressive Quantity of CMR delivered (MT))</th>

                                <th>Approx.Resultant CMR (MT)</th>

                                <th>Offer (MT)</th>

                                <th>Gap In Offer Against resultant (MT)</th>

                                <th>Offer Gap % Against Total Resultant CMR</th>

                                <th>Gap in delivery Against resultant (MT)</th>

                                <th>Delivery Gap % Against Total Resultant CMR</th>

                                <th>Gap in delivery Against offer (MT)</th>

                                <th>Delivery Gap % Against offer Of CMR</th>

                            </tr>

                        </thead>

                        <tbody>

                            <?php

                                if($dist){ 

                                    $i = 1;

                                    $tot_proc       = 0;

                                    $tot_delivery   = 0;

                                    $tot_resultant  = 0; 

                                    $tot_offered    = 0;

                                    $tot_sp         = 0;

                                    $tot_cp         = 0;

                                    $tot_fci        = 0;

                                    $tot_gap_resultant  =   0;

                                    $tot_gap_delivery   =   0;

                                    $tot_gap_offer      =   0;
                                  
                                    foreach($dist as $dis){

                            ?>

                                <tr>
                                     <td><?php echo $i++; ?></td> 

                                     <td><?php                                      //district name
                                              echo $dis->branch_name; 
                                         ?>
                                     </td>

                                     <td><?php                                      //Procurred Qty in MT
                                            echo $dis->qty*0.1;
                                            $tot_proc += $dis->qty * 0.1;           
                                         ?>
                                     </td>
                                     
                                     <td><?php                                      //SP CMR delivery          
                                                foreach($delv as $del){
                                                    if($del->branch_id == $dis->branch_id){
                                                         echo $del->sp * 0.1;
                                                         $tot_sp += $del->sp * 0.1;
                                                    }
                                                }
                                         ?>
                                     </td>

                                     <td><?php                                      //CP CMR delivery 
                                                foreach($delv as $del){
                                                    if($del->branch_id == $dis->branch_id){
                                                         echo $del->cp * 0.1;
                                                         $tot_cp += $del->cp * 0.1;
                                                    }
                                                }
                                         ?>
                                     </td>

                                     <td><?php                                     //FCI CMR delivery
                                                foreach($delv as $del){
                                                    if($del->branch_id == $dis->branch_id){
                                                        echo $del->fci * 0.1;
                                                        $tot_fci +=  $del->fci * 0.1; 
                                                    }
                                                }
                                         ?>
                                     </td>

                                     <td><?php                                      //resultant CMR                               
                                                foreach($cmrs as $cmr){
                                                    if($cmr->branch_id == $dis->branch_id){
                                                         echo ($cmr->resultant) * 0.1;
                                                        $tot_resultant += $cmr->resultant* 0.1; 
                                                    }
                                                }
                                         ?>
                                     </td>

                                     <td><?php                                         //CMR offered
                                                foreach($cmrs as $cmr){
                                                    if($cmr->branch_id == $dis->branch_id){
                                                         echo ($cmr->offered) * 0.1;
                                                        $tot_offered += $cmr->offered* 0.1;
                                                    }
                                                }
                                         ?>
                                     </td>

                                     <td> <?php                                 //Gap in offer against resultant.
                                                foreach($cmrs as $cmr){
                                                    if($cmr->branch_id == $dis->branch_id){
                                                        echo round(($cmr->resultant - $cmr->offered) * 0.1,2);
                                                        $tot_gap_resultant += round(($cmr->resultant - $cmr->offered) * 0.1,2);
                                                    }
                                                }
                                         ?> 
                                     </td>
                                  
                                     <td> <?php                                 //Gap in percentage
                                                foreach($cmrs as $cmr){
                                                    if($cmr->branch_id == $dis->branch_id){

                                                     echo round((($cmr->resultant - $cmr->offered)*0.1)/($cmr->resultant * 0.1) * 100,2);

                                                    }
                                                }
                                         ?>
                                     </td>

                                     <td>
                                        <?php                                   //Gap in delivery against resultant CMR
                                            foreach($delgap as $delvgap){
                                                if($delvgap->branch_id == $dis->branch_id){

                                                    echo round($delvgap->gap_delivery * 0.1,2);

                                                    $tot_gap_delivery += round($delvgap->gap_delivery * 0.1,2);
                                                }
                                            }
                                         ?>
                                     </td>

                                     <td>
                                         <?php                              //percentage Gap in delivery against resultant CMR
                                            foreach($delgap as $delvgap){
                                                if($delvgap->branch_id == $dis->branch_id){

                                                    echo round(($delvgap->gap_delivery *0.1)/($delvgap->resultant * 0.1) * 100,2);

                                                }
                                            }
                                         ?>

                                     </td>

                                     <td>
                                        <?php                                     //Gap in delivery against offer
                                            foreach($delgap as $delvgap){
                                                if($delvgap->branch_id == $dis->branch_id){

                                                    echo round($delvgap->offer_gap * 0.1,2);

                                                    $tot_gap_offer += round($delvgap->offer_gap * 0.1,2);

                                                }
                                            }      
                                        ?>
                                    </td>

                                    <td>
                                       <?php                                    //percentage Gap in offer against delivery 
                                            foreach($delgap as $delvgap){
                                                if($delvgap->branch_id == $dis->branch_id){

                                                    echo round(($delvgap->offer_gap *0.1)/($delvgap->offered_now * 0.1) * 100,2);

                                                }
                                            }      
                                        ?>
                                    </td>
                                   
                                </tr>
                               
 
                                <?php 
                                 
                                    }  ?>
                                     <tr><td colspan="2" style="text-align:center;font-weight: bold;">Total</td>
                                     	<td style="text-align:center;font-weight: bold;"><?=$tot_proc?></td>
                                     	<td style="text-align:center;font-weight: bold;"><?=$tot_sp ?></td>
                                     	<td style="text-align:center;font-weight: bold;"><?=$tot_cp?></td>
                                     	<td style="text-align:center;font-weight: bold;"><?=$tot_fci?></td>
                                     	<td style="text-align:center;font-weight: bold;"><?=$tot_resultant?></td>
                                     	<td style="text-align:center;font-weight: bold;"><?=$tot_offered?></td>
                                        <td style="text-align:center;font-weight: bold;"><?=$tot_gap_resultant?></td>
                                        <td style="text-align:center;font-weight: bold;"></td>
                                        <td style="text-align:center;font-weight: bold;"><?=$tot_gap_delivery?></td>
                                        <td style="text-align:center;font-weight: bold;"></td>
                                        <td style="text-align:center;font-weight: bold;"><?=$tot_gap_offer?></td>
                                        <td style="text-align:center;font-weight: bold;"></td>
                                        

                                     </tr>

                         <?php        }
                                else{

                                    echo "<tr><td colspan='14' style='text-align:center;'>No Data Found</td></tr>";

                                }   

                            ?>

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
                    filename: "Gap In Offer & Delivery OF CMR Against Cumulative Paddy Procured Between <?php echo date("d-m-Y", strtotime($this->input->post('from_date'))).' To '.date("d-m-Y", strtotime($this->input->post('to_date')));?>.xls"
                });
            });
        });
    </script>
