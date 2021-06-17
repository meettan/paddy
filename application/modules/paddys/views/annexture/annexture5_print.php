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

        <div class="wraper"> 

                  <div class="col-lg-12 container contant-wraper">
                    
                    <div id="divToPrint">
    <h3 style="text-align: center">  ANNEXURE-V</h3>
<div class="wrapper_fixed">
  <p>Name of the Agency: <b>BENFED</b> </p>
  <h3 style="text-align: center">    CLAIM FOR MANDI LABOUR CHARGES</h3>
  <p>Name of the Mandi Board: <strong> <?php echo $bill_dtls->mandi_board;?> </strong></p>
  <div class="billDateGroop"><div class="crmBill">Bill No: <strong><?php echo $bill_dtls->ho_bill_number;?></strong></div>                                                    <div class="dateTop">Date: <strong><?php echo date('d/m/Y', strtotime($bill_dtls->ben_bill_dt)); ?>
  </strong>.</div></div>
  <br clear="all">

  <p>Claim towards Mandi Labour Charges to the F&S through <strong>HO</strong>  for  the KMS <strong><?php echo $this->session->userdata['loggedin']['kms_yr']; ?></strong></p>
    
    <div class="tableBottomBorder">
    <table width="100%" border="0" cellspacing="0" cellpadding="0">

                  <?php $sun_rate = 0; 
                        
                  ?>
          <thead>
               <tr>
                   <th scope="col" class="sl5_1">Sl No</th>
                   <th scope="col" class="sl5_2">Particular </th>
                   <th scope="col" class="sl5_3">Rate/ Qtl</th>
                   <th scope="col" class="sl5_4">Ref of Order & Date</th>
                   <th scope="col" class="sl5_5">Quantity of Paddy </th>
                   <th scope="col" class="sl5_6">Do No & Date</th>
                   <th scope="col" class="sl5_7">Total Amount claimed </th>
               </tr>
          </thead>
         <tbody>
            <tr>
                <td style="text-align:center"><strong>(1)</strong></td>
                <td style="text-align:center"><strong>(2)</strong></td>
                <td style="text-align:center"><strong>(3)</strong></td>
                <td style="text-align:center"><strong>(4)</strong></td>
                <td style="text-align:center"><strong>(5)</strong></td>
                <td style="text-align:center"><strong>(6)</strong></td>
                <td style="text-align:center"><strong>(7)</strong></td>

            </tr>
            <tr>
                <td></td>
                <td></td>
                <td></td>
                <td></td>
                 <td></td>
                <td></td>
                <td></td>

            </tr>

              <tr> <td>1</td>
    
                                    <td><?php echo $charges['0']->particulars;?></td>
    
                                    <td><?php echo $charges['0']->rate;
                                                    $sun_rate += $charges['0']->rate;
                                    ?></td>

                                    <td rowspan="8"></td>
                                    
                                    <td rowspan="8" style="text-align:center"><?php echo $bill_dtls->paddy_qty;?></td>

                                    <td rowspan="8"><?php echo $bill_dtls->memo_no;?><br>(<?php if($bill_dtls->pool_type=="C"){echo "Central Pool"; } else{
                                        echo "State Pool";}?>)<br>Dated:-<br><?php echo date('d.m.Y', strtotime($bill_dtls->memo_dt)); ?></td>
                                    <td> <?php echo round(($bill_dtls->paddy_qty)*($charges['0']->rate),2);


                                    ?></td>
                                </tr>
                               <tr> <td>2</td>
    
                                    <td><?php echo $charges['1']->particulars;?></td>
    
                                    <td><?php echo $charges['1']->rate;
                                                     $sun_rate += $charges['1']->rate;

                                    ?></td>

                                 
                                  
                                    <td> <?php echo round(($bill_dtls->paddy_qty)*($charges['1']->rate),2);?></td>
                                </tr>

                             <tr> <td>3</td>
    
                                    <td><?php echo $charges['2']->particulars;?></td>
    
                                    <td><?php echo $charges['2']->rate;
                                                   $sun_rate += $charges['2']->rate;
                                    ?></td>

                                   
                                 
                                   <td> <?php echo round(($bill_dtls->paddy_qty)*($charges['2']->rate),2);?></td>
                                </tr>
                              <tr> <td>4</td>
    
                                    <td><?php echo $charges['3']->particulars;?></td>
    
                                    <td><?php echo $charges['3']->rate;
                                                   $sun_rate += $charges['3']->rate;

                                    ?></td>


                                   <td> <?php echo round(($bill_dtls->paddy_qty)*($charges['3']->rate),2);?></td>
                                </tr>
                            <tr> <td>5</td>
    
                                    <td><?php echo $charges['4']->particulars;?></td>
    
                                    <td><?php echo $charges['4']->rate;
                                                   $sun_rate += $charges['4']->rate;            

                                    ?></td>

                                    

                                  <td> <?php echo round(($bill_dtls->paddy_qty)*($charges['4']->rate),2);?></td>
                                </tr>
                            <tr> <td>6</td>
    
                                    <td><?php echo $charges['5']->particulars;?></td>
    
                                    <td><?php echo $charges['5']->rate;
                                                   $sun_rate += $charges['5']->rate;

                                    ?></td>

                               

                                   <td> <?php echo round(($bill_dtls->paddy_qty)*($charges['5']->rate),2);?></td>
                                </tr>
                                <tr> <td>7</td>
    
                                    <td><?php echo $charges['6']->particulars;?></td>
    
                                    <td><?php echo $charges['6']->rate;
                                                   $sun_rate += $charges['6']->rate;
                                    ?></td>

                               

                                    <td> <?php echo round(($bill_dtls->paddy_qty)*($charges['6']->rate),2);?></td>
                                </tr>
                           <tr> <td>8</td>
    
                                    <td><?php echo $charges['7']->particulars;?></td>
    
                                    <td><?php echo $charges['7']->rate;
                                                   $sun_rate += $charges['7']->rate;

                                    ?></td>

                               

                                   <td> <?php echo round(($bill_dtls->paddy_qty)*($charges['7']->rate),2);?></td>
                                </tr>
         
            <tr>
              <td scope="row">&nbsp;</td>
              <td><strong>Total Amount</strong></td>
              <td><strong><?php echo $sun_rate;?></strong></td>
              <td>&nbsp;</td>
              <td style="text-align:center"><strong><?php echo $bill_dtls->paddy_qty;?></strong></td>
              <td>&nbsp;</td>
              <td ><strong><?php echo round(($bill_dtls->paddy_qty)*$sun_rate,2);
                                      $value = round(($bill_dtls->paddy_qty)*$sun_rate,2);
              ?></strong></td>
            </tr>

    
  </tbody>

</table>
        
        
    </div>

  <p align="justify" >Amount Rounded off: <strong>&#2352; <?php
                                   
                                   echo $amount = round(($bill_dtls->paddy_qty)*$sun_rate); 
                                     //echo round(abs(round(($bill_dtls->paddy_qty)*$sun_rate) - $value),2);

  ?> </strong><br>
  Rupees in Words: <strong><?php echo getIndianCurrency(round(($bill_dtls->paddy_qty)*$sun_rate));?></strong></p>
  <h3 >Certified that </h3>
  <ul>
    <li>The sum of <strong>&#2352; <?php echo $amount; ?></strong> claimed in the bill has not been drawn previously </li>
    <li>The details as well as calculations as shown in the Bill have been checked with original documents and found correct </li>
    <li>Any amount found paid in excess at any subsequent date may be adjusted from future Claim. </li>
    <li>Proper noting have been kept to avoid double payment</li>
  </ul>
  <ul>
  </ul>
  <p>&nbsp;</p>
  <p style="float: right;"><strong>Signature of the Claimant with seal</strong></p>
  <p ><strong>Required Supporting Documents:</strong></p>
  <p align="justify" >1. Work Order,</p>
  <p align="justify" >2. Copy of Agreement,</p>
  <p align="justify" >3. Notification,</p>
  <p align="justify" >4. Voucher [original] and </p>
  <p align="justify" >5. Money Receipt</p>

  <p ><strong>N.B Claim will summarily be rejected for payment for want of above requisite documents</strong></p>
</div>
                  

                </div>
  <div style="text-align: center;">
    
                        <button class="btn btn-primary" type="button" onclick="printDiv();">Print</button>
    
                    </div>
            
        </div>