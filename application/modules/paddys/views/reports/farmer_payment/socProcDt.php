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
                action="<?php echo site_url("report/socProc");?>" >

                <div class="form-header">
                
                    <h4>Societywise Paddy Procurement Report</h4>
                
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
                               value="<?php echo $sys_date;?>"
                            />

                    </div>

                </div>
                 <div class="form-group row">

                  <label for="block" class="col-sm-2 col-form-label">Block:</label>

              <div class="col-sm-10">

              <select name="block" id="block" class="form-control required">
               <option value="">Select</option>  
                      <?php foreach($blocks as $bloc)  { ?>  
                      <option value="<?php if(isset($bloc->blockcode)){echo $bloc->blockcode;}?>"><?php if(isset($bloc->block_name)){echo $bloc->block_name;}?></option> 
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

        foreach($socDtls as $socs);
        
    ?>

        <div class="wraper"> 

            <div class="col-lg-12 container contant-wraper">
                
                <div id="divToPrint">

                    <div style="text-align:center;">

                        <h2>The West Bengal State Co-operative Marketing Federation Ltd.</h2>

                        <h4>Southend Conclave, 3rd Floor,1582 Rajdanga Main Road,Kolkata - 700 107.</h4>

                        <h4>Block and Societywise Paddy Procurement Between <?php echo date("d-m-Y", strtotime($this->input->post('from_date'))).' To '.date("d-m-Y", strtotime($this->input->post('to_date')));?></h4>

                    </div>
                    

                    <br>
                     <div class="col-md-12" >  
                        <div class="col-md-3">
                        <label>Branch name:</label><?php if(isset($this->session->userdata['loggedin']['branch_name'])){ echo $this->session->userdata['loggedin']['branch_name'];}?>
                    </div>
                    <div class="col-md-3">
                        <label>Block name:</label><span>  <?php echo $socs->block_name; ?></span>
                        </div>
                   </div>
                    <table style="width: 100%;" id="example" >

                        <thead>

                            <tr>
                            
                                <th>Sl No.</th>

                                <th style="width: 25%">Name of Society</th>

                                <th>Name of the Block</th>

                                <th>Total Quantity of Paddy Purchased(MT)</th>

                                <th>Total No. of Farmers Registered</th>

                                <th>Total No. of Farmers Benefited</th>

                                <th>Total No. of Camps Held</th>

                                <th>Total Amount of Farmer Payment Made(Rs.)</th>

                                <th>Resultant CMR(MT)</th>

                                <th>Total Quantity of Raw Rice Offered State(MT)</th>

                                <th>Total Quantity of Raw Rice Offered FCI(MT)</th>

                                <th>Total Quantity of Par Boiled Rice Offered State(MT)</th>

                                <th>Total Quantity of Par Boiled Rice Offered FCI(MT)</th>

                                <th>Total Quantity of Raw Rice Delivered State Pool(MT)</th>

                                <th>Total Quantity of Raw Rice Delivered Central Pool(MT)</th>

                                <th>Total Quantity of Raw Rice Delivered FCI(MT)</th>

                                <th>Total Quantity of Par Boiled Rice Delivered State Pool(MT)</th>

                                <th>Total Quantity of Par Boiled Rice Delivered Central Pool(MT)</th>

                                <th>Total Quantity of Par Boiled Rice Delivered FCI(MT)</th>

                                <th>Paddy Procurred Not Delivered To Rice Mill(MT)</th>

                            </tr>

                        </thead>

                        <tbody>

                            <?php

                                if($socDtls){ 

                                    $i = 1;
                                    $tot_qty_paddy_purchased = 0;$tot_registered_farmer = 0;
                                    $tot_benifited_farmer = 0; $tot_camp = 0; $tot_amount = 0;
                                    $tot_resultant_cmr = 0; $tot_raw_offered_state = 0; 
                                    $tot_raw_offered_fci = 0;
                                    $tot_boiled_offered_state = 0; $tot_boiled_offered_fci = 0;
                                    $tot_raw_rice_delivered_state = 0; $tot_raw_rice_delivered_center = 0; 
                                    $tot_raw_rice_delivered_fci = 0;
                                    $tot_boiled_rice_delivered_state = 0; $tot_boiled_rice_delivered_center = 0; 
                                    $tot_boiled_rice_delivered_fci = 0;
                                    $tot_remain = 0;

                                    foreach($socDtls as $soc){

                            ?>

                                <tr>
                                     <td><?php echo $i++; ?></td>
                                     <td><?php echo $soc->soc_name; ?></td>
                                     <td><?php echo $soc->block_name; ?></td>
                                     <td><?php
                                                foreach($collc as $colcDtls){
                                                    if($colcDtls->soc_id == $soc->society_code){
                                                         echo $colcDtls->quantity * 0.1;
                                                         $tot_qty_paddy_purchased += $colcDtls->quantity * 0.1;
                                                    }
                                                }
                                         ?>
                                     </td>
                                     <td><?php
                                                foreach($reg as $regfarm){
                                                    if($regfarm->soc_id == $soc->society_code){
                                                         echo $regfarm->reg_farm;
                                                         $tot_registered_farmer += $regfarm->reg_farm;
                                                    }
                                                }   
                                         ?>
                                     </td>
                                     <td><?php
                                                foreach($collc as $colcDtls){
                                                    if($colcDtls->soc_id == $soc->society_code){
                                                         echo $colcDtls->farm_ben;
                                                         $tot_benifited_farmer += $colcDtls->farm_ben;
                                                    }
                                                }   
                                         ?>
                                     </td>
                                     <td><?php
                                                foreach($collc as $colcDtls){
                                                    if($colcDtls->soc_id == $soc->society_code){
                                                         echo $colcDtls->camp;
                                                         $tot_camp +=$colcDtls->camp;
                                                    }
                                                }   
                                         ?>
                                     </td>
                                     <td><?php
                                                foreach($collc as $colcDtls){
                                                    if($colcDtls->soc_id == $soc->society_code){
                                                         echo $colcDtls->amount;
                                                         $tot_amount += $colcDtls->amount;
                                                    }
                                                }   
                                         ?>
                                     </td>
                                     <td><?php
                                                foreach($cmr as $cmrDtls){
                                                    if($cmrDtls->soc_id == $soc->society_code){
                                                         echo $cmrDtls->resultant;
                                                         $tot_resultant_cmr +=$cmrDtls->resultant;
                                                    }
                                                }   
                                         ?> 
                                     </td>
                                  
                                     <td><?php
                                                foreach($offer as $offerDtls){
                                                    if($offerDtls->soc_id == $soc->society_code){
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
                                     <td><?php echo 0.00;?></td>
                                     <td>
                                        <?php
                                                foreach($offer as $offerDtls){
                                                    if($offerDtls->soc_id == $soc->society_code){
                                                        if($offerDtls->rice_type == 'P'){
                                                            echo $offerDtls->offered * 0.1;
                                                            $tot_boiled_offered_state += $offerDtls->offered * 0.1;
                                                           // $tot_raw_offered_fci += $offerDtls->offered * 0.1;
                                                        }else{
                                                            echo 0.00;
                                                        }
                                                    }
                                                }
                                         ?>
                                     </td>
                                     <td><?php echo 0.00;?></td>
                                     <td>
                                        <?php
                                                foreach($delv as $delvDtls){
                                                    if($delvDtls->soc_id == $soc->society_code){
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
                                                    if($delvDtls->soc_id == $soc->society_code){
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
                                                    if($delvDtls->soc_id == $soc->society_code){
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
                                                    if($delvDtls->soc_id == $soc->society_code){
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
                                                    if($delvDtls->soc_id == $soc->society_code){
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
                                                    if($delvDtls->soc_id == $soc->society_code){
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
                                                    if($remDtls->soc_id == $soc->society_code){
                                                            echo $remDtls->remain * 0.1;
                                                            $tot_remain += $remDtls->remain * 0.1;
                                                    }
                                                }
                                         ?>
                                    </td>
                                </tr>
                               
 
                                <?php 

                                    }  ?>
                                     <tr><td colspan="3" style="text-align: center;">Total</td>
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
                    filename: "<?php echo $socs->block_name; ?> Block Societywise Paddy Procurement Between <?php echo date("d-m-Y", strtotime($this->input->post('from_date'))).' To '.date("d-m-Y", strtotime($this->input->post('to_date')));?>.xls"
                });
            });
        });
    </script>