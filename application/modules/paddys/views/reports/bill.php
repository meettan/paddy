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
            '                                          th, td { border: 1px solid black; border-collapse: collapse; padding: 5px;}' +
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
                action="<?php echo site_url("paddy/bill/report");?>" >

                <div class="form-header">
                
                    <h4>Bill Report</h4>
                
                </div>

                <div class="form-group row">

                    <label for="trans_dt" class="col-sm-2 col-form-label">Trans Date:</label>

                    <div class="col-sm-10">

                        <input type="date"
                            class="form-control"
                            id="trans_dt"
                            value="<?php echo $_SESSION['sys_date'];?>"
                            readonly
                            />

                    </div>

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

                    <label for="bill_no" class="col-sm-2 col-form-label">Bill No.:</label>

                    <div class="col-sm-10">

                        <input type="text"
                               name="bill_no"
                               class="form-control required"
                               id="bill_no"
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

                    <div style="display: inline; margin: 0;">
                    
                        <div style="float:left;  margin-right: 10%; display: inline; margin-bottom: -10px;">

                            <h4>WEST BENGAL STATE MULTIPURPOSE <br> CONSUMERS' CO-OPERATIVE FEDERATION LTD.</h4>   

                        </div>

                        <div style="display: inline; margin-left: 15%; margin-right: 35px;">

                            <img src="<?php echo base_url("/confed.jpg");?>" style="height: 40px;" />

                        </div>

                    </div>

                    <hr style="width: 100%; margin: 0;">

                    <div style="text-align: center; height: 65px; font-size: 12px;">

                        <p>P-1, Hide Lane, Akbar Mansion (3 rd Floor), Kolkata-73, Gram: STAFECON</p>

                        <p>

                            <i class="fa fa-phone" aria-hidden="true"></i> ( 0) 33-2237 7012 /7013,

                            <i class="fa fa-fax" aria-hidden="true"></i> 033-2236 8942

                        </p>

                        <p>Email Id: confedwb.org@gmail.com, Website: www.confedwb.org.in</p>


                    </div>

                    <div style="text-align: center;">

                        <p>ANNEXURE-II</p>

                    </div>

                    <div>
                        
                        <h6 style="display: inline;">Socity Name: <?php echo '<u>'.@$bill_dtls->soc_name.'</u><br> Mill Name: <u>'.@$bill_dtls->mill_name.'</u>'; ?></h6>

                        <div style="display: inline; box-sizing: border-box; border: 2px solid Black; padding: 6px; width: 65px; border-height: 35px; margin-left: 18%; margin-right: 25%;">
                            
                            <strong style="font-size: 16px;">BILL</strong>

                        </div>

                        <b style="margin-left: 5px; display: inline;"><u>
                        
                            <?php if(@$bill_dtls->pool_type == 'C') { 
                                
                                    echo "CENTRAL POOL"; 
                        
                                  }
                                  else if(@$bill_dtls->pool_type == 'S'){

                                    echo "STATE POOL"; 

                                  }

                                  else{

                                    echo "FCI"; 

                                  }
                            
                        ?></u></b>

                    </div>
                    
                    <div>

                        <h4 style="display: inline;">CMR Bill No: <?php echo @$bill_dtls->bill_no; ?></h4>

                        <h4 style="margin-left: 65%; display: inline;">Date: <?php echo date('d-m-Y', strtotime(@$bill_dtls->bill_dt)); ?></h4>

                    </div>

                    <div>

                        <p>Claimed towards the cost of Par Boiled (FAQ) Delivered to the F&S Deptt.
                           For KMS <?php echo @$bill_dtls->kms_yr; ?>
                        </p>
                        
                    </div>

                    <table style="width: 100%;">

                        <thead>

                            <tr>

                                <th style="width: 75%" colspan="5"><?php if(@$bill_dtls->rice_type == "P"){

                                                                        echo "Par-Boiled Rice";
                                                                    }
                                                                    else if(@$bill_dtls->rice_type == "R"){

                                                                        echo "Raw Rice";
                                                                    }
                                                                    else{

                                                                        echo "FCI";
                                                                    }
                                                                    
                                                                    ?>
                                                                    
                                </th>

                            </tr>

                            <tr>

                                <th></th>
                                <th>Particulars</th>
                                <th style="text-align: right;">Qty in qtls</th>
                                <th>Rate/qtl</th>
                                <th>Total Amount</th>

                            </tr>

                        </thead>

                        <tbody> 

                            <?php 
                          
                            if($bill_dtls) {

                                //For Accuisition cost

                                $accuisition_rate = $accuisition_amt = 0;
                                    
                                foreach($bill_master as $b_list) {

                            ?>
                                <tr>

                                   <td><?php echo $b_list->sl_no; ?></td>

                                   <td><?php echo $b_list->param_name; ?></td>

                                   <td style="text-align: right;"><?php 

                                        if($b_list->sl_no == 1){

                                            echo $bill_dtls->paddy_qty;

                                        }
                                        else if($b_list->sl_no == 14){

                                            echo $bill_dtls->out_ratio.'%';

                                        }
                                        else{

                                            echo "";
                                        }

                                        ?>
                                        
                                    </td>

                                   <td style="text-align: right;"><?php echo ($b_list->sl_no == 14)? '' : $b_list->boiled_val ; ?></td>

                                   <td style="text-align: right;"><?php 

                                                                        if($b_list->sl_no == 1){

                                                                            echo $bill_dtls->tot_msp;

                                                                        }
                                                                        else if($b_list->sl_no == 2){

                                                                            echo $bill_dtls->market_fee;

                                                                        }
                                                                        else if($b_list->sl_no == 3){

                                                                            echo $bill_dtls->mandi_chrg;

                                                                        }else if($b_list->sl_no == 4){

                                                                            echo $bill_dtls->transportation1;

                                                                        }else if($b_list->sl_no == 5){

                                                                            echo $bill_dtls->transportation2;

                                                                        }else if($b_list->sl_no == 6){

                                                                            echo $bill_dtls->transportation3;

                                                                        }else if($b_list->sl_no == 7){

                                                                            echo $bill_dtls->inter_dist_transprt;

                                                                        }else if($b_list->sl_no == 8){

                                                                            echo $bill_dtls->driage;

                                                                        }else if($b_list->sl_no == 9){

                                                                            echo $bill_dtls->comm_soc;

                                                                        }else if($b_list->sl_no == 10){

                                                                            echo $bill_dtls->comm_mill;

                                                                        }else if($b_list->sl_no == 11){

                                                                            echo $bill_dtls->cgst_milling;

                                                                        }else if($b_list->sl_no == 12){

                                                                            echo $bill_dtls->sgst_milling;

                                                                        }else if($b_list->sl_no == 13){

                                                                            echo $bill_dtls->admin_chrg;

                                                                        }else if($b_list->sl_no == 14){

                                                                            echo "";

                                                                        }else if($b_list->sl_no == 15){

                                                                            $accuisition_rate += $b_list->boiled_val;

                                                                            $accuisition_amt  += $bill_dtls->transportation_cmr1;

                                                                            echo $bill_dtls->transportation_cmr1;

                                                                        }else if($b_list->sl_no == 16){

                                                                            $accuisition_rate += $b_list->boiled_val;

                                                                            $accuisition_amt  += $bill_dtls->gunny_usege;

                                                                            echo $bill_dtls->gunny_usege;

                                                                        }else if($b_list->sl_no == 17){

                                                                            echo $bill_dtls->cgst_gunny;

                                                                            $accuisition_amt  += $bill_dtls->cgst_gunny;

                                                                        }else if($b_list->sl_no == 18){

                                                                            echo $bill_dtls->sgst_gunny;

                                                                            $accuisition_amt  += $bill_dtls->sgst_gunny;

                                                                        }else{

                                                                            echo "";

                                                                        }
                                                                    
                                                                    ?>
                                   
                                   </td>
                                    
                                </tr>

                        <?php

                                    if($b_list->sl_no == 13){

                                        ?>

                                        <tr>

                                            <td></td>

                                            <td>Cost of 1 qtl of Milled Paddy</td>

                                            <td style="text-align: right;"></td>

                                            <td style="text-align: right;"><?php echo $bill_dtls->tot_milled_paddy; ?></td>

                                            <td style="text-align: right;"><?php $accuisition_amt += $total->tot; echo $total->tot; ?></td>

                                        </tr>
                                        
                                        <?php
                                                                        
                                    }

                                    if($b_list->sl_no == 14){

                                        ?>

                                        <tr>

                                            <td></td>

                                            <td>Sub-Total of CMR/Raw Rice</td>

                                            <td style="text-align: right;"><?php echo $bill_dtls->sub_tot_cmr_qty; ?></td>

                                            <td style="text-align: right;"><?php $accuisition_rate += $bill_dtls->sub_tot_cmr_rate; echo $bill_dtls->sub_tot_cmr_rate; ?></td>

                                            <td style="text-align: right;"></td>

                                        </tr>

                                        <tr>

                                            <td></td>

                                            <td>Cost of New Gunny Bag for CMR</td>

                                            <td colspan="3" style="text-align: center;">CENTRALLY PROCURED & SUPPLIED</td>

                                        </tr>

                                        
                                        <?php
                                                                        
                                    }

                                }

                                ?>

                                <tr>

                                    <td>18</td>

                                    <td>Accuisition Cost</td>

                                    <td></td>

                                    <td style="text-align: right;"><?php echo $accuisition_rate; ?></td>

                                    <td style="text-align: right;"><?php echo $accuisition_amt; ?></td>

                                </tr>

                                <tr>

                                    <td>19</td>

                                    <td>Less: Butta Cut</td>

                                    <td></td>

                                    <td></td>

                                    <td style="text-align: right;"><?php $accuisition_amt -= $bill_dtls->butta_cut; echo $bill_dtls->butta_cut; ?></td>

                                </tr>

                                <tr>

                                    <td>20</td>

                                    <td>Less: Gunny Cut</td>

                                    <td></td>

                                    <td></td>

                                    <td style="text-align: right;"><?php $accuisition_amt -= $bill_dtls->gunny_cut; echo $bill_dtls->gunny_cut; ?></td>

                                </tr>

                                <tr>

                                    <td></td>

                                    <td>Total Cost:</td>

                                    <td></td>

                                    <td></td>

                                    <td style="text-align: right;"><?php echo $accuisition_amt; ?></td>

                                </tr>

                                <?php

                            }

                            else {

                                echo "<tr><td colspan='14' style='text-align:center;'>No Data Found</td></tr>";
                            }

                            ?>
                        
                        </tbody>

                    </table>
                    
                    <div style="font-size: 12px;">
                        <br>
                        <p style="display:inline;">Rupees in Words: <?php echo getIndianCurrency(@$accuisition_amt); ?>
                        <p style="display:inline; float:right;">GSTIN : 19AAAAW1196J1Z3</p>
                    </div>

                    <div  class="bottom">
                        
                        <p style="display: inline;">Prepared By</p>

                        <p style="display: inline; margin-left:65%;">Assistant Manager<br><span style="margin-left: 78%;">CONFED-WB</span></p>

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