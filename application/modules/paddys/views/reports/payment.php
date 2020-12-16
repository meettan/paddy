<style>
table {
    border-collapse: collapse;
    width: 100%;
}

table, td, th {
    border: 1px solid #dddddd;

    padding: 6px;

    font-size: 12px;

    text-align: right;
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
            '                                          table { border-collapse: collapse; font-size: 12px; width: 100%;}' +
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
                action="<?php echo site_url("paddy/payment/report");?>" >

                <div class="form-header">
                
                    <h4>Society Payment Report</h4>
                
                </div>

                <div class="form-group row">

                    <label for="pmt_bill_no" class="control-lebel col-sm-2 col-form-label">Bill No:</label>

                    <div class="col-sm-10">

                        <input type="text"
                            name="pmt_bill_no"
                            class="form-control required"
                            id="pmt_bill_no"
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
        function getIndianCurrency($number){

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
            return ($Rupees ? $Rupees . 'Rupees ' : '') . $paise .' Only';
        }
    ?>

        <div class="wraper"> 

            <div class="col-lg-12 container contant-wraper">
                
                <div id="divToPrint">

                    <div style="text-align:center;">

                        <h2>WEST BENGAL STATE CONSUMERS' CO-OPERATIVE FEDERATION LTD.</h2>

                    </div>
                    
                    <hr> 

                    <?php if(!$payment_dtls) {

                            echo "No Data Found";
                            exit();

                          }
                    ?>

                    <p style="text-align: justify;">In Connection with the Procurement during <strong>KMS-<?php echo $payment_dtls->kms_year; ?></strong> on Central Pool / State Pool Our
                       tagged Rice Mill <u><?php echo $payment_dtls->mill_name; ?></u> has submitted <u><?php echo count($bill_dtls); ?></u> bills which delivered 
                       the following quantity of CMR on behalf of <u><?php echo $payment_dtls->soc_name; ?></u>
                       for payment against supply of <u><?php echo $payment_dtls->tot_cmr; ?></u> Qtls after milling <u><?php echo $payment_dtls->tot_paddy; ?></u> Qtls
                       Paddy to D.C F&S <u><?php echo $payment_dtls->district_name; ?></u> district against which CONFED-WB has submitted sale bill with F&S
                       department for payment as per cost sheet plus GST extra our milling & gunny charges.
                    </p>

                    <h3><u>Details of bills are given Below:</u></h3>

                    <table>

                        <thead>

                            <tr>
                    
                                <th>Miller's Bill No</th>

                                <th>Date</th>

                                <th>Confed Bill No</th>

                                <th>Date</th>

                                <th>Quantity of paddy (Qtls)</th>

                                <th>Quantity of CMR (Qtls)</th>

                                <th>Total Butta</th>

                            </tr>

                        </thead>

                        <tbody> 

                            <?php 

                            if($bill_dtls) {

                                $tot_paddy = $tot_cmr = $tot_butta = 0;
                                
                                foreach($bill_dtls as $b_dtls){

                            ?>
                                    <tr>

                                        <td><?php echo $b_dtls->mill_bill_no; ?></td>
                                        <td><?php echo $b_dtls->mill_bill_dt; ?></td>
                                        <td><?php echo $b_dtls->con_bill_no; ?></td>
                                        <td><?php echo $b_dtls->con_bill_dt; ?></td>
                                        <td><?php echo $b_dtls->paddy_qty; ?></td>
                                        <td><?php echo $b_dtls->paddy_cmr; ?></td>
                                        <td><?php echo $b_dtls->paddy_butta; ?></td>
                                        
                                    </tr>
                                    
                            <?php    

                                    $tot_paddy += $b_dtls->paddy_qty;
                                    $tot_cmr   += $b_dtls->paddy_cmr;
                                    $tot_butta += $b_dtls->paddy_butta;
                                      
                                }

                            }

                            else {

                                echo "<tr><td colspan='14' style='text-align:center;'>No Data Found</td></tr>";
                            }

                            ?>  
                        
                        </tbody>

                        <tfoot>
                    
                            <tr>
                            
                                <td colspan="4" style="text-align: right;">Total:</td>
                                <td><?php echo $tot_paddy; ?></td>
                                <td><?php echo $tot_cmr; ?></td>
                                <td><?php echo $tot_butta; ?></td>

                            </tr>

                            <tr>
                            
                                <td colspan="5" style="text-align: right;">Extra Delivery:</td>
                                <td><?php echo $payment_dtls->extra_delivery; ?></td>
                                <td></td>
                            </tr>

                        </tfoot>

                    </table>
                    
                    <br>
                    <p>
                        Total Quantity of Paddy: <?php echo $payment_dtls->tot_paddy; ?>
                    </p>

                    <p>
                        Total Quantity of CMR: <?php echo $payment_dtls->tot_cmr; ?>
                    </p>

                    <table>

                        <thead>

                            <tr>
                                
                                <th width="25%">Particulars</th>
                                <th>Rate/Qtls <br>Paddy</th>
                                <th>Total Amount <br> (Rs)</th>
                                <th>TDS Amount <br>(Less) <br> @2.00%</th>
                                <th>CGST <br> (Add) <br> @2.5%</th>
                                <th>SGST <br> (Add) <br> @2.5%</th>
                                <th>Payable Amount(Rs)</th>
                                
                            </tr>

                        </thead>

                        <tbody>
                            
                        <?php
                            
                            $tot_payble = 0;

                            foreach($charges as $c_list){
                        ?>
                                <tr>
                                    <td style="text-align:center;"><?php echo $c_list->param_name; ?></td>
                                    <td><?php echo $c_list->per_unit; ?></td>
                                    <td><?php echo $c_list->total_amt; ?></td>
                                    <td><?php echo $c_list->tds_amt; ?></td>
                                    <td><?php echo $c_list->cgst_amt; ?></td>
                                    <td><?php echo $c_list->sgst_amt; ?></td>
                                    <td><?php echo $c_list->payble_amt; ?></td>
                                    
                                </tr>

                        <?php
                                $tot_payble += $c_list->payble_amt;
                            }
                        ?>
                        </tbody>

                        <tfoot>
                            <tr>
                            
                                <td colspan="6" style="text-align: right;">Total Amount:</td>
                                <td colspan="2"><?php echo $tot_payble; ?></td>

                            </tr>

                            <tr>
                            
                                <td colspan="6" style="text-align: right;">Less Butta:</td>
                                <td><?php echo $tot_butta; ?></td>

                            </tr>

                            <tr>
                            
                                <td colspan="6" style="text-align: right;">Payble Amount:</td>
                                <td><?php echo $tot_payble - $tot_butta; ?></td>

                            </tr>

                        </tfoot>

                    </table>
                    
                    
                    <div  class="bottom">
                        
                        <p>Rs <u><?php echo $tot_payble - $tot_butta; ?></u> ( <?php echo getIndianCurrency($tot_payble - $tot_butta);?> ) only
                        may be realesed from Bandhan Bank, A/C- ____________________________ in favour of
                        <u><?php echo $payment_dtls->mill_name; ?></u> througn RTGS/NEFT.
                        </p>
                        <br><p>Put up to C.E.O through A.R.C.S & A.M. II(A/cs) for Necessary order pls.</p>

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