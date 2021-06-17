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
                action="<?php echo site_url("report/socProcho");?>" >

                <div class="form-header">
                
                    <h4>Societywise Paddy Procurement Report</h4>
                
                </div>

                <div class="form-group row">

                    <label for="from_date" class="col-sm-2 col-form-label">From Date:</label>

                    <div class="col-sm-10">

                        <input type="date"
                               name="from_date"
                               id="from_date"
                               class="form-control required"
                               value="<?php echo $sys_date;?>" />

                    </div>

                </div>

                <div class="form-group row">

                    <label for="to_date" class="col-sm-2 col-form-label">To Date:</label>

                    <div class="col-sm-10">

                        <input type="date"
                               name="to_date"
                               id="to_date"
                               class="form-control required"
                               value="<?php echo $sys_date;?>" />

                    </div>

                </div>
                 <div class="form-group row">

                  <label for="dist" class="col-sm-2 col-form-label">District:</label>

              <div class="col-sm-10">

              <select name="dist" id="dist" class="form-control required">
               <option value="0">Select</option>  
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

                            <h3>Societywise Paddy Procurement Between <?php echo date("d-m-Y", strtotime($this->input->post('from_date'))).' To '.date("d-m-Y", strtotime($this->input->post('to_date')));?></h3>
                        </div>

                    </div>
                    

                    <br>
                        <div class="col-md-12" >  
                            <div class="col-md-3">
                                <label>Branch name:</label> <?php echo get_district_name($this->input->post("dist")) ?>
                            </div>
                        </div>

                    <table style="width: 100%;" id="example" >

                        <thead>

                            <tr>
                            
                                <th>Sl No.</th>

                                <th style="width: 25%">Name of Society</th>

                                <th>Name of the Block</th>

                                <th>Total Quantity of Paddy Purchased(MT)</th>

                                <!--<th>Total No. of Farmers Registered</th>--->

                                <th>Total No. of Seller Farmers</th>

                                <th>Total No. of Camps Held</th>

                                <th>Total Amount of Farmer Payment Made(Rs.)</th>

                                <th>Resultant CMR(MT)</th>

                                <th>Total Quantity of Raw Rice Offered(MT)</th>

                                <!--<th>Total Quantity of Raw Rice Offered FCI(MT)</th>-->

                                <th>Total Quantity of Par Boiled Rice Offered(MT)</th>

                                <!--<th>Total Quantity of Par Boiled Rice Offered FCI(MT)</th>-->

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

                                if($socDtls){ 

                                    $i = 1;
                                    $tot_qty_paddy_purchased = 0;$tot_registered_farmer = 0;
                                    $tot_benifited_farmer = 0; $tot_camp = 0; $tot_amount = 0;
                                    $tot_resultant_cmr = 0; $tot_raw_offered_state = 0; $tot_raw_offered_fci = 0;
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
                                     <td><?php echo $soc->soc_name;         //society name ?></td>         
                                     <td><?php echo $soc->block_name;       //block name ?></td>
                                     <td><?php
                                                foreach($collc as $colcDtls){               //total quantity purchased
                                                    if($colcDtls->soc_id == $soc->society_code){
                                                         echo $colcDtls->quantity * 0.1;
                                                         $tot_qty_paddy_purchased += $colcDtls->quantity * 0.1;
                                                    }
                                                }
                                         ?>
                                     </td>
                                     <!--<td><?php
                                               /* foreach($reg as $regfarm){
                                                    if($regfarm->soc_id == $soc->society_code){
                                                         echo $regfarm->reg_farm;
                                                         $tot_registered_farmer += $regfarm->reg_farm;
                                                    }
                                                } */  
                                         ?>
                                     </td>-->
                                     <td><?php
                                                foreach($collc as $colcDtls){                   //no.of seller farmer
                                                    if($colcDtls->soc_id == $soc->society_code){
                                                         echo $colcDtls->farm_ben;
                                                         $tot_benifited_farmer += $colcDtls->farm_ben;
                                                    }
                                                }   
                                         ?>
                                     </td>
                                     <td><?php
                                                foreach($collc as $colcDtls){               //total camps held
                                                    if($colcDtls->soc_id == $soc->society_code){
                                                         echo $colcDtls->camp;
                                                         $tot_camp +=$colcDtls->camp;
                                                    }
                                                }   
                                         ?>
                                     </td>
                                     <td><?php
                                                foreach($collc as $colcDtls){           //total farmer payment made
                                                    if($colcDtls->soc_id == $soc->society_code){
                                                         echo $colcDtls->amount;
                                                         $tot_amount += $colcDtls->amount;
                                                    }
                                                }   
                                         ?>
                                     </td>
                                     <td><?php
                                                foreach($cmr as $cmrDtls){              //resultant CMR
                                                    if($cmrDtls->soc_id == $soc->society_code){
                                                         echo $cmrDtls->resultant * 0.1;
                                                         $tot_resultant_cmr +=$cmrDtls->resultant * 0.1;
                                                    }
                                                }   
                                         ?> 
                                     </td>
                                  
                                     <td><?php
                                                foreach($offer as $offerDtls){          //Raw rice offered
                                                    if($offerDtls->soc_id == $soc->society_code){
                                                        if($offerDtls->rice_type == 'R'){
                                                            echo $offerDtls->offered * 0.1;
                                                            $tot_raw_offered_state += $offerDtls->offered * 0.1;
                                                        }
                                                    }
                                                }
                                             
                                         ?>
                                     </td>
                                     <!--<td><?php //echo 0.00;?></td>-->
                                     <td>
                                        <?php
                                                foreach($offer as $offerDtls){        //Parboiled rice offered              
                                                    if($offerDtls->soc_id == $soc->society_code){
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
                                     <!--<td><?php //echo 0.00;?></td>-->
                                     <td>
                                        <?php
                                                foreach($delv as $delvDtls){            //Raw rice delivery SP
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
                                                foreach($delv as $delvDtls){        //Raw rice delivery CP
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
                                                foreach($delv as $delvDtls){        //Raw rice delivery FCI
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
                                                foreach($delv as $delvDtls){        //parboiled rice delivery SP
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
                                                foreach($delv as $delvDtls){        //parboiled rice delivery CP
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
                                                foreach($delv as $delvDtls){        //parboiled rice delivery FCI
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
                                                foreach($remain as $remDtls){       //Pending for delivery
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
                                     <tr><td colspan="3" style="text-align:center;font-weight: bold;">Total</td>
                                     	<td style="text-align:center;font-weight: bold;"><?=$tot_qty_paddy_purchased?></td>
                                     	<!--<td><?=$tot_registered_farmer?></td>-->
                                     	<td style="text-align:center;font-weight: bold;"><?=$tot_benifited_farmer?></td>
                                     	<td style="text-align:center;font-weight: bold;"><?=$tot_camp?></td>
                                     	<td style="text-align:center;font-weight: bold;"><?=$tot_amount?></td>
                                     	<td style="text-align:center;font-weight: bold;"><?=$tot_resultant_cmr?></td>
                                        <td style="text-align:center;font-weight: bold;"><?=$tot_raw_offered_state?></td>
                                        <!--<td></td>-->
                                        <td style="text-align:center;font-weight: bold;"><?=$tot_boiled_offered_state?></td>
                                        <!--<td style="text-align:center;font-weight: bold;"></td>-->
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
                    filename: "Societywise Paddy Procurement Between <?php echo date("d-m-Y", strtotime($this->input->post('from_date'))).' To '.date("d-m-Y", strtotime($this->input->post('to_date')));?>.xls"
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

                if($("#dist").val()==0){
                    alert("Please select a district!")
                    return false
                }
            });
        });
    </script>
