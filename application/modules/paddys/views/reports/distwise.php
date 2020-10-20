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
                action="<?php echo site_url("paddy/distwise/report");?>" >

                <div class="form-header">
                
                    <h4>District Wise Paddy Report</h4>
                
                </div>

                <div class="form-group row">

                    <label for="trans_dt" class="col-sm-2 col-form-label">Transaction Date:</label>

                    <div class="col-sm-10">

                        <input type="date"
                                name="trans_dt"
                                class="form-control required"
                                id="trans_dt"
                                value="<?php echo $sys_date;?>"
                                readonly
                        />

                    </div>

                </div>

                <div class="form-group row">

                    <label for="sal_month" class="control-lebel col-sm-2 col-form-label">Select Month:</label>

                        <div class="col-sm-10">

                            <select
                                class="form-control required"
                                name="month"
                                id="month"
                            >

                                <option value="">Select Month</option>

                                <?php foreach($month_list as $m_list) {?>

                                    <option value="<?php echo $m_list->month_name ?>" ><?php echo $m_list->month_name; ?></option>

                                <?php
                                }
                                ?>

                            </select>   

                        </div>

                </div>

                <div class="form-group row">

                    <label for="year" class="col-sm-2 col-form-label">Input Year:</label>

                    <div class="col-sm-10">

                        <input type="text"
                            class="form-control"
                            name="year"
                            id="year"
                            value="<?php echo date('Y');?>"
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

                        <h3>Monthly District Wise Report For the Month of <?php echo $this->input->post('month');?></h3>

                    </div>
                    

                    <br>  

                    <table style="width: 100%;">

                        <thead>

                            <tr>
                            
                                <th>Sl No.</th>

                                <th>District</th>

                                <th style="width: 25%">Name of Society</th>

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

                            if($dist_grp_cnt) {
                                

                                $i  =   0;

                                $grnd_camp = $grnd_farmer = $grnd_progressive = $grnd_delivared = 

                                $grnd_resultant = $grnd_cmr_off = $grnd_do_iss = $grnd_cmr_del = 

                                $grnd_yet_del = $grnd_due = 0;
                                    
                                foreach($dist_grp_cnt as $d_list) {

                                    $tot_camp = $tot_farmer = $tot_progressive = $tot_delivared = 
                                    
                                    $tot_resultant = $tot_cmr_off = $tot_do_iss = $tot_cmr_del = 
                                    
                                    $tot_yet_del = $tot_due = 0;

                            ?>
                                <tr>

                                    <td rowspan="<?php echo $d_list->count + 1;?>"><?php echo $i+1; ?></td>

                                    <td rowspan="<?php echo $d_list->count + 1;?>"><?php foreach($dist as $dst_list){

                                                                                            if($dst_list->district_code == $d_list->dist) {
                                                                                                
                                                                                                echo $dst_list->district_name;

                                                                                            }
                                                                                         } ?>
                                    </td>

                                    <?php 

                                    foreach ($soc_names as $s_name) {

                                        if($s_name->dist == $d_list->dist) {

                                            $k = 0;

                                            foreach($distwise_dtls as $dis_list){
                                                
                                                for($j = 0; $j < count($dis_list); $j++){

                                                if($dis_list[$j]->soc_id == $s_name->soc_id) {

                                                    if($j == 0) {

                                    ?>

                                                        <td rowspan="<?php echo count($distwise_dtls[$k]);?>" class="span6"><?php foreach($soc as $soc_list){

                                                                                                                                    if($soc_list->sl_no != $dis_list[$j]->soc_id) {
                                                                                                                                            
                                                                                                                                        continue;

                                                                                                                                    }
                                                                                                                                    else {


                                                                                                                                    }

                                                                                                                                  }

                                                                                                                            ?>
                                                        </td>
                                                        
                                                        <td><?php foreach($mill as $mill_list){

                                                                    if($mill_list->sl_no == $dis_list[$j]->mill_id) {
                                                                        
                                                                        echo $mill_list->mill_name;

                                                                    }

                                                                  }
                                                                   
                                                            ?>
                                                        
                                                        </td>

                                                        <td style="text-align: right;"> <?php $tot_camp += $dis_list[$j]->camp_no; echo $dis_list[$j]->camp_no; ?></td>

                                                        <td style="text-align: right;"> <?php $tot_farmer += $dis_list[$j]->farmer_no; echo $dis_list[$j]->farmer_no; ?></td>

                                                        <td style="text-align: right;"> <?php $tot_progressive += $dis_list[$j]->progressive; echo $dis_list[$j]->progressive; ?></td>

                                                        <td style="text-align: right;"> <?php $tot_delivared += $dis_list[$j]->delivared_to_mill; echo $dis_list[$j]->delivared_to_mill; ?></td>

                                                        <td style="text-align: right;"> <?php $tot_resultant += $dis_list[$j]->resultant_cmr; echo $dis_list[$j]->resultant_cmr; ?></td>

                                                        <td style="text-align: right;"> <?php $tot_cmr_off += $dis_list[$j]->cmr_offered; echo $dis_list[$j]->cmr_offered; ?></td>

                                                        <td style="text-align: right;"> <?php $tot_do_iss += $dis_list[$j]->do_isseue; echo $dis_list[$j]->do_isseue; ?></td>

                                                        <td style="text-align: right;"> <?php $tot_cmr_del += $dis_list[$j]->cmr_delivered; echo $dis_list[$j]->cmr_delivered; ?></td>

                                                        <td style="text-align: right;"> <?php $tot_yet_del += $dis_list[$j]->do_isseue - $dis_list[$j]->cmr_delivered; echo $dis_list[$j]->do_isseue - $dis_list[$j]->cmr_delivered; ?></td>

                                                        <td style="text-align: right;"> <?php $tot_due += $dis_list[$j]->resultant_cmr - $dis_list[$j]->cmr_delivered; echo $dis_list[$j]->resultant_cmr - $dis_list[$j]->cmr_delivered; ?></td>



                                    </tr>
                                    
                                    <?php
                                                    }

                                                    else {

                                    ?>

                                                <tr>

                                                    <td><?php foreach($mill as $mill_list){

                                                                if($mill_list->sl_no != $dis_list[$j]->mill_id) {
                                                                    
                                                                    continue;

                                                                }
                                                                else {

                                                                    echo $mill_list->mill_name;

                                                                }

                                                                }

                                                        ?>
                                                                
                                                    </td>

                                                    <td style="text-align: right;"> <?php $tot_camp += $dis_list[$j]->camp_no; echo $dis_list[$j]->camp_no; ?></td>

                                                    <td style="text-align: right;"> <?php $tot_farmer += $dis_list[$j]->farmer_no; echo $dis_list[$j]->farmer_no; ?></td>

                                                    <td style="text-align: right;"> <?php $tot_progressive += $dis_list[$j]->progressive; echo $dis_list[$j]->progressive; ?></td>

                                                    <td style="text-align: right;"> <?php $tot_delivared += $dis_list[$j]->delivared_to_mill; echo $dis_list[$j]->delivared_to_mill; ?></td>

                                                    <td style="text-align: right;"> <?php $tot_resultant += $dis_list[$j]->resultant_cmr; echo $dis_list[$j]->resultant_cmr; ?></td>

                                                    <td style="text-align: right;"> <?php $tot_cmr_off += $dis_list[$j]->cmr_offered; echo $dis_list[$j]->cmr_offered; ?></td>

                                                    <td style="text-align: right;"> <?php $tot_do_iss += $dis_list[$j]->do_isseue; echo $dis_list[$j]->do_isseue; ?></td>

                                                    <td style="text-align: right;"> <?php $tot_cmr_del += $dis_list[$j]->cmr_delivered; echo $dis_list[$j]->cmr_delivered; ?></td>

                                                    <td style="text-align: right;"> <?php $tot_yet_del += $dis_list[$j]->do_isseue - $dis_list[$j]->cmr_delivered; echo $dis_list[$j]->do_isseue - $dis_list[$j]->cmr_delivered; ?></td>

                                                    <td style="text-align: right;"> <?php $tot_due += $dis_list[$j]->resultant_cmr - $dis_list[$j]->cmr_delivered; echo $dis_list[$j]->resultant_cmr - $dis_list[$j]->cmr_delivered; ?></td>

                                                </tr>

                                    <?php
                                                    }

                                                }

                                                }

                                                $k++;

                                            }

                                            

                                        }

                                    }    

                                    
                                    $i++;
                            ?>
                                        
                                    <tr style="background-color:#f5f5f5;">

                                        <td colspan="2" style="text-align: right;">Total:</td>

                                        <td style="text-align: right;"><?php $grnd_camp += $tot_camp; echo $tot_camp;?></td>

                                        <td style="text-align: right;"><?php $grnd_farmer += $tot_farmer; echo $tot_farmer;?></td>

                                        <td style="text-align: right;"><?php $grnd_progressive += $tot_progressive; echo $tot_progressive;?></td>

                                        <td style="text-align: right;"><?php $grnd_delivared += $tot_delivared; echo $tot_delivared;?></td>

                                        <td style="text-align: right;"><?php $grnd_resultant += $tot_resultant; echo $tot_resultant;?></td>

                                        <td style="text-align: right;"><?php $grnd_cmr_off += $tot_cmr_off; echo $tot_cmr_off;?></td>

                                        <td style="text-align: right;"><?php $grnd_do_iss += $tot_do_iss; echo $tot_do_iss;?></td>

                                        <td style="text-align: right;"><?php $grnd_cmr_del += $tot_cmr_del; echo $tot_cmr_del;?></td>

                                        <td style="text-align: right;"><?php $grnd_yet_del += $tot_yet_del; echo $tot_yet_del;?></td>

                                        <td style="text-align: right;"><?php $grnd_due += $tot_due; echo $tot_due;?></td>
                                        

                                    </tr>

                            <?php

                                    }

                            ?>

                                <tr style="background-color:#e1e1e1;">

                                    <td colspan="4" style="text-align: right;">Sub Total:</td>

                                    <td style="text-align: right;"><?php echo $grnd_camp;?></td>

                                    <td style="text-align: right;"><?php echo $grnd_farmer;?></td>

                                    <td style="text-align: right;"><?php echo $grnd_progressive;?></td>

                                    <td style="text-align: right;"><?php echo $grnd_delivared;?></td>

                                    <td style="text-align: right;"><?php echo $grnd_resultant;?></td>

                                    <td style="text-align: right;"><?php echo $grnd_cmr_off;?></td>

                                    <td style="text-align: right;"><?php echo $grnd_do_iss;?></td>

                                    <td style="text-align: right;"><?php echo $grnd_cmr_del;?></td>

                                    <td style="text-align: right;"><?php echo $grnd_yet_del;?></td>

                                    <td style="text-align: right;"><?php echo $grnd_due;?></td>


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