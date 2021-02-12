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
                action="<?php echo site_url("report/distProcho");?>" >

                <div class="form-header">
                
                    <h4>Districtwise Paddy Procurement Report</h4>
                
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

                        <h4><u>Districtwise Paddy Procurement Between <?php echo date("d-m-Y", strtotime($this->input->post('from_date'))).' To '.date("d-m-Y", strtotime($this->input->post('to_date')));?></u></h4>

                    </div>
                    

                    <br>
                     <!---<div class="col-md-12" >  
                        <div class="col-md-3">
                        <label>Branch name:</label><?php //echo get_district_name($this->input->post("dist")) ?>
                    </div>--->
                    
                   </div>
                    <table style="width: 100%;" id="example">

                        <thead>

                            <tr>
                            
                                <th>Sl No.</th>

                                <th style="width: 25%">District</th>

                                <th>No.of Societies</th>

                                <th>No.of Farmers</th>

                                <th>Total Quantity of Paddy Purchased(MT)</th>

                                <th>Total Amount of Farmer Payment Made(Rs.)</th>

                                <th>Resultant CMR(MT)</th>

                                <th>Total Quantity of Raw Rice Offered(MT)</th>

                                <th>Total Quantity of Par Boiled Rice Offered(MT)</th>

                                <th>Total Quantity of Raw Rice Delivered State Pool(MT)</th>

                                <th>Total Quantity of Raw Rice Delivered Central Pool(MT)</th>

                                <th>Total Quantity of Raw Rice Delivered FCI(MT)</th>

                                <th>Total Quantity of Par Boiled Rice Delivered State Pool(MT)</th>

                                <th>Total Quantity of Par Boiled Rice Delivered Central Pool(MT)</th>

                                <th>Total Quantity of Par Boiled Rice Delivered FCI(MT)</th>

                                <th>CMR Yet To Be Delivered To Godown(MT)</th>

                            </tr>

                        </thead>

                        <tbody>

                            <?php

                                if($procDtls){ 

                                    $i = 1;
                                    $tot_soc = 0;
                                    $tot_registered_farmer = 0;
                                    $tot_proc = 0;
                                    $tot_pay  = 0;
                                    $tot_resultant_cmr = 0; 
                                    $tot_raw_offered_state = 0;
                                    $tot_boiled_offered_state = 0;
                                    $tot_raw_rice_delivered_state = 0; 
                                    $tot_raw_rice_delivered_center = 0;
                                    $tot_raw_rice_delivered_fci = 0;
                                    $tot_boiled_rice_delivered_state = 0;
                                    $tot_boiled_rice_delivered_center = 0;
                                    $tot_boiled_rice_delivered_fci = 0;
                                    $tot_remain = 0;

                                    foreach($procDtls as $proc){

                            ?>

                                <tr>
                                     <td><?php echo $i++; ?></td>

                                     <td><?php echo $proc->branch_name; ?></td>

                                     <td><?php echo $proc->soc_no; 
                                               $tot_soc += $proc->soc_no;
                                         ?>
                                     </td>

                                     <td><?php echo $proc->farm_no; 
                                               $tot_registered_farmer += $proc->farm_no;
                                         ?>
                                     </td>

                                     <td><?php echo $proc->qty * 0.1; 
                                               $tot_proc += $proc->qty * 0.1;
                                         ?>
                                     </td>

                                     <td><?php echo $proc->amt; 
                                               $tot_pay += $proc->amt;
                                          ?>
                                     </td>

                                     <td><?php
                                                foreach($cmr as $cmrDtls){
                                                    if($cmrDtls->branch_id == $proc->branch_id){
                                                         echo $cmrDtls->resultant;
                                                         $tot_resultant_cmr +=$cmrDtls->resultant;
                                                    }
                                                }   
                                         ?> 
                                     </td>
                                  
                                     <td><?php
                                                foreach($offer as $offerDtls){
                                                    if($offerDtls->branch_id == $proc->branch_id){
                                                        if($offerDtls->rice_type == 'R'){
                                                            echo $offerDtls->offered * 0.1;
                                                            $tot_raw_offered_state += $offerDtls->offered * 0.1;
                                                        }else{
                                                            echo 0.00;
                                                        }
                                                    }
                                                }
                                             
                                         ?>
                                     </td>
                                     
                                     <td>
                                        <?php
                                                foreach($offer as $offerDtls){
                                                    if($offerDtls->branch_id == $proc->branch_id){
                                                        if($offerDtls->rice_type == 'P'){
                                                            echo $offerDtls->offered * 0.1;
                                                            $tot_boiled_offered_state += $offerDtls->offered * 0.1;
                                                        }else{
                                                            echo 0.00;
                                                        }
                                                    }
                                                }
                                         ?>
                                     </td>
                                      
                                     <td>
                                        <?php
                                                foreach($delv as $delvDtls){
                                                    if($delvDtls->branch_id == $proc->branch_id){
                                                        if($delvDtls->cmr_type == 'R'){
                                                            echo $delvDtls->sp * 0.1;
                                                            $tot_raw_rice_delivered_state +=$delvDtls->sp * 0.1;
                                                        }else{
                                                            echo 0.00;
                                                        }
                                                    }
                                                }
                                         ?>
                                     </td>
                                     <td>
                                       <?php
                                                foreach($delv as $delvDtls){
                                                    if($delvDtls->branch_id == $proc->branch_id){
                                                        if($delvDtls->cmr_type == 'R'){
                                                            echo $delvDtls->cp * 0.1;
                                                            $tot_raw_rice_delivered_center +=$delvDtls->sp * 0.1;
                                                        }else{
                                                            echo 0.00;
                                                        }
                                                    }
                                                }
                                         ?>
                                     </td>
                                     <td><?php
                                                foreach($delv as $delvDtls){
                                                    if($delvDtls->branch_id == $proc->branch_id){
                                                        if($delvDtls->cmr_type == 'R'){
                                                            echo $delvDtls->fci * 0.1;
                                                            $tot_raw_rice_delivered_fci +=$delvDtls->sp * 0.1;
                                                        }else{
                                                            echo 0.00;
                                                        }
                                                    }
                                                }
                                         ?>
                                     </td>
                                      
                                  
                                     <td><?php
                                                foreach($delv as $delvDtls){
                                                    if($delvDtls->branch_id == $proc->branch_id){
                                                        if($delvDtls->cmr_type == 'P'){
                                                            echo $delvDtls->sp * 0.1;
                                                            $tot_boiled_rice_delivered_state += $delvDtls->sp * 0.1;
                                                        }else{
                                                            echo 0.00;
                                                        }
                                                    }
                                                }
                                         ?>        
                                     </td>
                                     <td><?php
                                                foreach($delv as $delvDtls){
                                                    if($delvDtls->branch_id == $proc->branch_id){
                                                        if($delvDtls->cmr_type == 'P'){
                                                            echo $delvDtls->cp * 0.1;
                                                            $tot_boiled_rice_delivered_center += $delvDtls->cp * 0.1;
                                                        }else{
                                                            echo 0.00;
                                                        }
                                                    }
                                                }
                                         ?>
                                     </td>
                                     <td><?php
                                                foreach($delv as $delvDtls){
                                                    if($delvDtls->branch_id == $proc->branch_id){
                                                        if($delvDtls->cmr_type == 'P'){
                                                            echo $delvDtls->fci * 0.1;
                                                              $tot_boiled_rice_delivered_fci += $delvDtls->fci * 0.1;
                                                        }else{
                                                            echo 0.00;
                                                        }
                                                    }
                                                }
                                         ?>
                                     </td>
                                     <td><?php
                                                foreach($remain as $remDtls){
                                                    if($remDtls->branch_id == $proc->branch_id){
                                                            echo $remDtls->remain * 0.1;
                                                            $tot_remain += $remDtls->remain * 0.1;
                                                    }
                                                }
                                         ?>
                                    </td>
                                </tr>
                               
 
                                <?php 

                                    }  ?>

                                    <tr><td colspan="2" style="text-align:center;font-weight: bold;">Total</td>
                                        <td style="text-align:center;font-weight: bold;"><?=$tot_soc?></td>
                                        <td style="text-align:center;font-weight: bold;"><?=$tot_registered_farmer?></td>
                                        <td style="text-align:center;font-weight: bold;"><?=$tot_proc?></td>
                                        <td style="text-align:center;font-weight: bold;"><?=$tot_pay?></td>
                                        <td style="text-align:center;font-weight: bold;"><?=$tot_resultant_cmr?></td>
                                        <td style="text-align:center;font-weight: bold;"><?=$tot_raw_offered_state?></td>
                                        <td style="text-align:center;font-weight: bold;"><?=$tot_boiled_offered_state?></td>
                                        <td style="text-align:center;font-weight: bold;"><?=$tot_raw_rice_delivered_state?></td>
                                        <td style="text-align:center;font-weight: bold;"><?=$tot_raw_rice_delivered_center?></td>
                                        <td style="text-align:center;font-weight: bold;"><?=$tot_raw_rice_delivered_fci?></td>
                                        <td style="text-align:center;font-weight: bold;"><?=$tot_boiled_rice_delivered_state?></td>
                                        <td style="text-align:center;font-weight: bold;"><?=$tot_boiled_rice_delivered_center?></td>
                                        <td style="text-align:center;font-weight: bold;"><?=$tot_boiled_rice_delivered_fci?></td>
                                        <td style="text-align:center;font-weight: bold;"><?=$tot_remain?></td>
                                     </tr>

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
                    filename: "Districtwise Paddy Procurement Between <?php echo date("d-m-Y", strtotime($this->input->post('from_date'))).' To '.date("d-m-Y", strtotime($this->input->post('to_date')));?>.xls"
                });
            });
        });
    </script>

    <script>
        $(document).ready(function(){
            $("#form").on('submit',function(){

                if($("#from_date").val() > $("#to_date").val()){
                    alert("From date must be less than to date!");
                    return false;
                }
            });
        });
    </script>