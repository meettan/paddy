<style>
table {
    border-collapse: collapse;
}

table, td, th {
    border: 1px solid #dddddd;

    padding: 6px;

    font-size: 12px;
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
                action="<?php echo site_url("paddy/socindvidual/report");?>" >

                <div class="form-header">
                
                    <h4>Individual Society Report</h4>
                
                </div>

                <div class="form-group row">

                    <label for="soc_id" class="col-sm-2 col-form-label">Society:</label>

                    <div class="col-sm-10">

                        <select name="soc_id"
                                class="form-control required"
                                id="soc_id"
                                
                          >

                            <option>Select</option>

                          <?php foreach ($soc_names as $s_name) {

                              ?>

                                <option value="<?php echo $s_name->sl_no; ?>"><?php echo $s_name->soc_name; ?></option>

                          <?php

                                }

                          ?>

                          </select>

                    </div>

                </div>

                <div class="form-group row">

                    <label for="from_date" class="control-lebel col-sm-2 col-form-label">From Date:</label>

                    <div class="col-sm-10">

                        <input type="date"
                            name="from_date"
                            class="form-control required"
                            id="from_date"
                            value="<?php echo $sys_date;?>"
                        />  

                    </div>

                </div>

                <div class="form-group row">

                    <label for="to_date" class="control-lebel col-sm-2 col-form-label">To Date:</label>

                    <div class="col-sm-10">

                        <input type="date"
                            name="to_date"
                            class="form-control required"
                            id="to_date"
                            value="<?php echo $sys_date;?>"
                        />  

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

                        <h3>WEST BENGAL STATE CONSUMERS' CO-OPERATIVE FEDERATION LTD.</h3>

                        <h3>P-1, Hide Lane, Akbar Mansion, 3rd Floor, Kolkata-700073</h3>

                        <h3>Society Report For The Period of  <?php echo date('d-m-Y', strtotime($this->input->post('from_date'))). ' to '. date('d-m-Y', strtotime($this->input->post('to_date'))); ?></h3>

                        <h3>Society Name: 
                        
                            <?php 

                                foreach($soc_names as $s_name){

                                    if($s_name->sl_no == $this->input->post('soc_id')){
                                        
                                        echo $s_name->soc_name;

                                    }

                                }

                            ?>

                        </h3>

                    </div>
                    

                    <br>  

                    <table style="width: 100%;">

                        <thead>

                            <tr>
                            
                                <th>Sl No.</th>

                                <th style="width: 15%">Date</th>

                                <th>District</th>

                                <th>Block</th>

                                <th style="width: 25%">Name of Rice Mill</th>

                                <th>Total No. of Camp</th>

                                <th>Total No. of Farmer</th>
                                
                                <th>Progressive of Paddy  Procurement<br>(M.T)</th>

                                <th style="width: 10%">Total quantity of Paddy deliverd to Rice Mill as per Receipt<br>(M.T)</th>

                                <th>Resultant CMR<br>(M.T)</th>

                                <th>CMR Offerd<br>(M.T)</th>

                                <th>D.O Issseue from D.C. F&S<br>(M.T)</th>

                                <th>Quantity of CMR deliverd<br>(M.T)</th>

                                <th>Yet to deliverd<br>(M.T)</th>

                                <th>Total Due deliverd<br>(M.T)</th>

                            </tr>

                        </thead>

                        <tbody> 

                            <?php 

                            if($socdata) {
                                

                                $i  =   1;

                                //Variable for grand total
                                $grnd_camp = $grnd_farmer = $grnd_progressive = $grnd_delivared = 

                                $grnd_resultant = $grnd_cmr_off = $grnd_do_iss = $grnd_cmr_del = 

                                $grnd_yet_del = $grnd_due = 0;
                                    
                                foreach($socdata as $d_list) {

                            ?>
                                <tr>

                                   <td><?php echo $i++; ?></td>

                                   <td><?php echo date('d-m-Y', strtotime($d_list->trans_dt)) ; ?></td>

                                   <td><?php foreach($dist as $dst_list){

                                                if($dst_list->district_code == $d_list->dist) {
                                                    
                                                    echo $dst_list->district_name;

                                                }

                                            } 
                                                
                                        ?>
                                        
                                    </td>

                                    <td><?php foreach($block as $dst_list){

                                                if($dst_list->sl_no == $d_list->block) {
                                                    
                                                    echo $dst_list->block_name;

                                                }

                                            } 
                                                
                                        ?>
                                                
                                    </td>
                                   
                                   <td><?php foreach($mill as $mill_list){

                                                if($mill_list->sl_no == $d_list->mill_id) {
                                                    
                                                    echo $mill_list->mill_name;

                                                }

                                            }

                                        ?>
                                                
                                    </td>
                                   
                                   <td style="text-align: right;"><?php $grnd_camp += $d_list->camp_no; echo $d_list->camp_no; ?></td>
                                   
                                   <td style="text-align: right;"><?php $grnd_farmer += $d_list->farmer_no; echo $d_list->farmer_no; ?></td>
                                   
                                   <td style="text-align: right;"><?php $grnd_progressive += $d_list->progressive; echo $d_list->progressive; ?></td>
                                   
                                   <td style="text-align: right;"><?php $grnd_delivared += $d_list->delivared_to_mill; echo $d_list->delivared_to_mill; ?></td>
                                   
                                   <td style="text-align: right;"><?php $grnd_resultant += $d_list->resultant_cmr; echo $d_list->resultant_cmr; ?></td>
                                   
                                   <td style="text-align: right;"><?php $grnd_cmr_off += $d_list->cmr_offered; echo $d_list->cmr_offered; ?></td>
                                   
                                   <td style="text-align: right;"><?php $grnd_do_iss += $d_list->do_isseue; echo $d_list->do_isseue; ?></td>
                                   
                                   <td style="text-align: right;"><?php $grnd_cmr_del += $d_list->cmr_delivered; echo $d_list->cmr_delivered; ?></td>
                                   
                                   <td style="text-align: right;"><?php $grnd_yet_del += $d_list->do_isseue - $d_list->cmr_delivered; echo $d_list->do_isseue - $d_list->cmr_delivered; ?></td>
                                   
                                   <td style="text-align: right;"><?php $grnd_due += $d_list->resultant_cmr - $d_list->cmr_delivered; echo $d_list->resultant_cmr - $d_list->cmr_delivered; ?></td>

                                </tr>
                        <?php        

                                }

                        ?>

                                <tr style="text-align: right; background-color:#f5f5f5;">    

                                    <td colspan='5'>Total: </td>

                                    <td><?php echo $grnd_camp ;?> </td>

                                    <td><?php echo $grnd_farmer ;?> </td>

                                    <td><?php echo $grnd_progressive ;?> </td>
                                    
                                    <td><?php echo $grnd_delivared ;?> </td>
                                    
                                    <td><?php echo $grnd_resultant ;?> </td>
                                    
                                    <td><?php echo $grnd_cmr_off ;?> </td>

                                    <td><?php echo $grnd_do_iss ;?> </td>

                                    <td><?php echo $grnd_cmr_del ;?> </td>
                                    
                                    <td><?php echo $grnd_yet_del ;?> </td>
                                    
                                    <td><?php echo $grnd_due ;?> </td>

                                </tr>

                        <?php

                            }

                            else {

                                echo "<tr><td colspan='14' style='text-align:center;'>No Data Found</td></tr>";
                            }

                            ?>
                        
                        </tbody>

                    </table>

                    <div  class="bottom">
                        
                        <p style="display: inline;">Prepared By</p>

                        <p style="display: inline; margin-left: 8%;">Establishment, Sr. Asstt.</p>

                        <p style="display: inline; margin-left: 8%;">Assistant Manager-II</p>

                        <p style="display: inline; margin-left: 8%;">Chief Executive officer</p>

                    </div>

                </div>   
                
                <div style="text-align: center;">

                    <button class="btn btn-primary" type="button" onclick="printDiv();">Print</button>

                </div>

            </div>
            
        </div>
        
    <?php

    }

    ?> 

<script>

    $("#form").validate();

</script>