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
            '                                          table { border-collapse: collapse; font-size: 10px;}' +
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

    function getIndianCurrency($number)
        {
            $decimal = round($number - ($no = floor($number)), 2) * 100;
            $hundred = null;
            $digits_length = strlen($no);
            $i = 0;
            $str = array();
            $words = array(0 => '', 1 => 'One', 2 => 'Two',
                3 => 'Three', 4 => 'Four', 5 => 'Five', 6 => 'Six',
                7 => 'Seven', 8 => 'Eight', 9 => 'Nine',
                10 => 'Ten', 11 => 'Eleven', 12 => 'Twelve',
                13 => 'Thirteen', 14 => 'Fourteen', 15 => 'Fifteen',
                16 => 'Sixteen', 17 => 'Seventeen', 18 => 'Eighteen',
                19 => 'Nineteen', 20 => 'Twenty', 30 => 'Thirty',
                40 => 'Forty', 50 => 'Fifty', 60 => 'Sixty',
                70 => 'Seventy', 80 => 'Eighty', 90 => 'Ninety');
            $digits = array('', 'Hundred','Thousand','Lakh', 'Crore');
            while( $i < $digits_length ) {
                $divider = ($i == 2) ? 10 : 100;
                $number = floor($no % $divider);
                $no = floor($no / $divider);
                $i += $divider == 10 ? 1 : 2;
                if ($number) {
                    $plural = (($counter = count($str)) && $number > 9) ? 's' : null;
                    $hundred = ($counter == 1 && $str[0]) ? ' and ' : null;
                    $str [] = ($number < 21) ? $words[$number].' '. $digits[$counter]. $plural.' '.$hundred:$words[floor($number / 10) * 10].' '.$words[$number % 10]. ' '.$digits[$counter].$plural.' '.$hundred;
                } else $str[] = null;
            }
            $Rupees = implode('', array_reverse($str));
            $paise = ($decimal) ? "and " . ($words[$decimal / 10] . " " . $words[$decimal % 10]) . ' Paise' : '';
            return ($Rupees ? $Rupees . 'Rupees ' : '') . $paise .' Only.';
        }

?> 

<?php

    if($_SERVER['REQUEST_METHOD'] == 'GET') {

?>        
    <div class="wraper">      

        <div class="col-md-6 container form-wraper">
    
            <form method="POST" 
                id="form"
                action="<?php echo site_url("paddy/billdetails/report");?>" >

                <div class="form-header">
                
                    <h4>Bill Details Report</h4>
                
                </div>

                <div class="form-group row">

                    <label for="pool_type" class="col-sm-2 col-form-label">Pool Type:</label>

                    <div class="col-sm-10">

                        <select class="form-control required"
                                name="pool_type"
                                id="pool_type"
                            >

                            <option value="">Select</option>

                            <option value="S">State Pool</option>

                            <option value="C">Central Pool</option>
                            
                            <option value="F">FCI</option>

                        </select>    

                    </div>

                </div>

                <div class="form-group row">

                    <label for="from_dt" class="col-sm-2 col-form-label">From Date:</label>

                    <div class="col-sm-10">

                        <input type="date"
                            class="form-control required"
                            name="from_dt"
                            value="<?php echo $_SESSION['sys_date'];?>"
                            />

                    </div>

                </div>

                <div class="form-group row">

                    <label for="to_dt" class="col-sm-2 col-form-label">To Date:</label>

                    <div class="col-sm-10">

                        <input type="date"
                            class="form-control required"
                            name="to_dt"
                            value="<?php echo $_SESSION['sys_date'];?>"
                            />

                    </div>

                </div>

                <div class="form-group row">

                    <div class="col-sm-10">

                        <input type="submit" class="btn btn-info" value="Proceed" />

                    </div>

                </div>

                <!-- <div class="form-group row">

                    <div class="col-sm-10">

                        <a href="">
                            <button class="btn btn-primary" type="button"><i class="fa fa-download"></i>Download Excle</button>                                
                        </a>  

                    </div>

                </div> -->

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
    
                            <h3>Bill Details For The KMS: <?php echo $kms->kms_year; ?> For The Period Of <?php echo date('d-m-Y', strtotime($this->input->post('from_dt'))). ' to '. date('d-m-Y', strtotime($this->input->post('to_dt'))); ?></h3>
    
                            <h3><?php if($this->input->post('pool_type') == 'S'){
                                        echo 'State Pool';
                                      }
                                      else if($this->input->post('pool_type') == 'C'){ 
                                        echo 'Central Pool';
                                      }
                                      else if($this->input->post('pool_type') == 'F'){
                                        echo 'FCI';
                                      }
                                ?>
                            </h3>
                        </div>
    
                        <br>  
    
                        <table style="width: 100%;">
    
                            <thead>
    
                                <tr>
                                
                                    <th>Bill No.</th>
    
                                    <th style="width: 15%">Date</th>
    
                                    <th>District</th>

                                    <th style="width: 25%">Mill Name</th>
                                    
                                    <th style="width: 25%">Society Name</th>

                                    <th>Quantity of Paddy</th>

                                    <th>Quantity of Rice</th>
    
                                    <th>MSP Value</th>
    
                                    <th>Market Fee</th>
                                    
                                    <th>Mandy Labour Charges</th>
    
                                    <th style="width: 10%">Transportation<br><small>chg. 1st 25KM</small></th>
    
                                    <th style="width: 10%">Transportation<br><small>chg. Next 25KM</small></th>
    
                                    <th style="width: 10%">Transportation<br><small>chg. Above 50KM</small></th>
    
                                    <th style="width: 10%">Inter District Transport</small></th>
                                    
                                    <th style="width: 10%">Transportation<br><small>chg. Of CMR</small></th>
    
                                    <th>Driage</th>
    
                                    <th>Commision to Society</th>
    
                                    <th>Milling charges</th>

                                    <th>CGST</th>
                                    
                                    <th>SGST</th>

                                    <th>Administrative charges</th>

                                    <th>GUNNY Useage Charge</th>

                                    <th>CGST</th>
                                    
                                    <th>SGST</th>

                                    <th>Total value</th>

                                    <th>Butta Cut</th>

                                    <th>Final Value</th>
    
                                </tr>
    
                            </thead>
    
                            <tbody> 
    
                                <?php 
    
                                if($bill_dtls) {
                                    $grand_tot = 0;    
                                    foreach($bill_dtls as $b_list) {
                                        $tot = 0;
                                ?>
                                    <tr>
    
                                       <td><?php echo $b_list->bill_no; ?></td>
    
                                       <td><?php echo date('d-m-Y', strtotime($b_list->bill_dt)) ; ?></td>
    
                                       <td>
                                            <?php foreach($dist as $dst_list){
    
                                                    if($dst_list->district_code == $b_list->dist) {
                                                        
                                                        echo $dst_list->district_name;
    
                                                    }
    
                                                } 
                                                    
                                            ?>
                                            
                                        </td>
                                       
                                       <td><?php foreach($mill as $mill_list){
    
                                                    if($mill_list->sl_no == $b_list->mill_id) {
                                                        
                                                        echo $mill_list->mill_name;
    
                                                    }
    
                                                }
    
                                            ?>
                                                    
                                        </td>

                                        <td><?php foreach($soc as $soc_list){
    
                                                    if($soc_list->sl_no == $b_list->soc_id) {
                                                        
                                                        echo $soc_list->soc_name;

                                                    }

                                                }

                                                ?>
                                                    
                                        </td>
                                       
                                       <td style="text-align: right;"><?php echo $b_list->paddy_qty; ?></td>
                                       
                                       <td style="text-align: right;"><?php echo $b_list->sub_tot_cmr_qty; ?></td>

                                       <td style="text-align: right;"><?php echo $b_list->tot_msp; ?></td>
                                       
                                       <td style="text-align: right;"><?php echo $b_list->market_fee; ?></td>
                                       
                                       <td style="text-align: right;"><?php echo $b_list->mandi_chrg; ?></td>
                                       
                                       <td style="text-align: right;"><?php echo $b_list->transportation1; ?></td>
                                       
                                       <td style="text-align: right;"><?php echo $b_list->transportation2; ?></td>
                                       
                                       <td style="text-align: right;"><?php echo $b_list->transportation3; ?></td>

                                       <td style="text-align: right;"><?php echo $b_list->inter_dist_transprt; ?></td>

                                       <td style="text-align: right;"><?php echo $b_list->transportation_cmr1; ?></td>
                                       
                                       <td style="text-align: right;"><?php echo $b_list->driage; ?></td>
                                       
                                       <td style="text-align: right;"><?php echo $b_list->comm_soc; ?></td>
                                       
                                       <td style="text-align: right;"><?php echo $b_list->comm_mill; ?></td>

                                       <td style="text-align: right;"><?php echo $b_list->cgst_milling; ?></td>

                                       <td style="text-align: right;"><?php echo $b_list->sgst_milling; ?></td>
                                       
                                       <td style="text-align: right;"><?php echo $b_list->admin_chrg; ?></td>

                                       <td style="text-align: right;"><?php echo $b_list->gunny_usege; ?></td>
                                       
                                       <td style="text-align: right;"><?php echo $b_list->cgst_gunny; ?></td>
                                       
                                       <td style="text-align: right;"><?php echo $b_list->sgst_gunny; ?></td>
                                       
                                       <td style="text-align: right;"><?php $grand_tot += $tot = $b_list->tot_msp +
                                                                                 $b_list->market_fee + 
                                                                                 $b_list->mandi_chrg + 
                                                                                 $b_list->transportation1 + 
                                                                                 $b_list->transportation2 + 
                                                                                 $b_list->transportation3 + 
                                                                                 $b_list->inter_dist_transprt +
                                                                                 $b_list->transportation_cmr1 + 
                                                                                 $b_list->driage +
                                                                                 $b_list->comm_soc + 
                                                                                 $b_list->comm_mill + 
                                                                                 $b_list->cgst_milling + 
                                                                                 $b_list->sgst_milling + 
                                                                                 $b_list->admin_chrg +
                                                                                 $b_list->gunny_usege +
                                                                                 $b_list->cgst_gunny +
                                                                                 $b_list->sgst_gunny; echo $tot; ?></td>

                                       <td style="text-align: right;"><?php echo $b_list->butta_cut; ?></td>
                                       
                                       <td style="text-align: right;"><?php echo ($tot - $b_list->butta_cut); ?></td>
              
    
                                    </tr>
                            <?php        
    
                                    }
    
    
                                }
    
                                else {
    
                                    echo "<tr><td colspan='28' style='text-align:center;'>No Data Found</td></tr>";
                                }
    
                                ?>

                                <tr>
                                    
                                    <td colspan="5">Total:</td>

                                    <td style="text-align: right;"><?php echo $tot_bill_dtls->paddy_qty; ?></td>
                                       
                                    <td style="text-align: right;"><?php echo $tot_bill_dtls->sub_tot_cmr_qty; ?></td>

                                    <td style="text-align: right;"><?php echo $tot_bill_dtls->tot_msp; ?></td>
                                    
                                    <td style="text-align: right;"><?php echo $tot_bill_dtls->market_fee; ?></td>
                                    
                                    <td style="text-align: right;"><?php echo $tot_bill_dtls->mandi_chrg; ?></td>
                                    
                                    <td style="text-align: right;"><?php echo $tot_bill_dtls->transportation1; ?></td>
                                    
                                    <td style="text-align: right;"><?php echo $tot_bill_dtls->transportation2; ?></td>
                                    
                                    <td style="text-align: right;"><?php echo $tot_bill_dtls->transportation3; ?></td>

                                    <td style="text-align: right;"><?php echo $tot_bill_dtls->inter_dist_transprt; ?></td>

                                    <td style="text-align: right;"><?php echo $tot_bill_dtls->transportation_cmr1; ?></td>
                                    
                                    <td style="text-align: right;"><?php echo $tot_bill_dtls->driage; ?></td>
                                    
                                    <td style="text-align: right;"><?php echo $tot_bill_dtls->comm_soc; ?></td>
                                    
                                    <td style="text-align: right;"><?php echo $tot_bill_dtls->comm_mill; ?></td>

                                    <td style="text-align: right;"><?php echo $tot_bill_dtls->cgst_milling; ?></td>

                                    <td style="text-align: right;"><?php echo $tot_bill_dtls->sgst_milling; ?></td>
                                    
                                    <td style="text-align: right;"><?php echo $tot_bill_dtls->admin_chrg; ?></td>

                                    <td style="text-align: right;"><?php echo $tot_bill_dtls->gunny_usege; ?></td>
                                    
                                    <td style="text-align: right;"><?php echo $tot_bill_dtls->cgst_gunny; ?></td>
                                    
                                    <td style="text-align: right;"><?php echo $tot_bill_dtls->sgst_gunny; ?></td>
                                    
                                    <td style="text-align: right;"><?php echo $grand_tot; ?></td>

                                    <td style="text-align: right;"><?php echo $tot_bill_dtls->butta_cut; ?></td>
                                    
                                    <td style="text-align: right;"><?php echo $grand_tot - $tot_bill_dtls->butta_cut; ?></td>

                                </tr>
                            
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

                    <div style="text-align: center;">
                        <a class="btn btn-success" href="<?php echo site_url('paddy/downloadExcel'); ?>" id="downloadExcel"><i class="fa fa-download"></i>Download Excle</a>                                  
                    </div>

                </div>

                
                
            </div>
            
        <?php
    
        }
    
        ?> 
