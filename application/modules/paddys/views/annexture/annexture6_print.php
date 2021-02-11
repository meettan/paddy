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

                      <div class="wrapper_fixed">
                        <h3 style="text-align: center">  ANNEXURE-VI</h3>
  <p>Name of the Agency: <b>Benfed</b> </p>
  <p>Name of the Miller:<?php echo $millname->mill_name;?>  </p>


  <p>Claim towards Transport Charges for the KMS <strong><?php echo $this->session->userdata['loggedin']['kms_yr'];?></strong></p>
  
  <div class="">
  <table class="table tableCus" width="100%" border="0" cellspacing="0" cellpadding="0">
  
  
  <thead>
    <tr>
      <th scope="col" class="sl55_1" rowspan="2">Sl No</th>
      <th scope="col" class="sl55_2" rowspan="2">Name of the Transport Agency with Address </th>
      <th scope="col" class="sl55_3" colspan="4">Claim For Paddy</th>
      <th scope="col" class="sl55_4" colspan="4"><span class="sl55_3">Claim For </span>RCMR</th>
      <th scope="col" class="sl55_5">Total Amount claimed </th>
    </tr>
    <tr>
      <th scope="col" class="sl55_3">Distance from Procurement Centre to Rice Mill[Km]</th>
      <th scope="col" class="sl55_4">Quantity of Paddy[Qtl]</th>
      <th scope="col" class="sl55_5">Rate[Rs/ Qtl]</th>
      <th scope="col" class="sl55_2">Amount claimed for transportation of Paddy [Rs]</th>
      <th scope="col" class="sl55_1">Distance from Rice Mill to Godown[km]</th>
      <th scope="col" class="sl55_3">Quantity of RCMR[Qtl</th>
      <th scope="col" class="sl55_4">Rate[Rs/Qtl]</th>
      <th scope="col" class="sl55_5">Amount for RCMR claimed[Rs]</th>
      <th scope="col" class="sl55_1">Sl No</th>
     
    </tr>
     <tr>
      <th scope="col" class="sl55_1">1</th>
      <th scope="col" class="sl55_2">2</th>
      <th scope="col" class="sl55_3">3</th>
      <th scope="col" class="sl55_4">4</th>
      <th scope="col" class="sl55_5">5</th>
      <th scope="col" class="sl55_1">6</th>
      <th scope="col" class="sl55_2">7</th>
      <th scope="col" class="sl55_3">8</th>
      <th scope="col" class="sl55_4">9</th>
      <th scope="col" class="sl55_5">10</th>
      <th scope="col" class="sl55_1">11</th>
     
    </tr>
     <tr>
      <th scope="col" class="sl55_1"></th>
      <th scope="col" class="sl55_2"></th>
      <th scope="col" class="sl55_3"></th>
      <th scope="col" class="sl55_4"></th>
      <th scope="col" class="sl55_5"></th>
      <th scope="col" class="sl55_1"></th>
      <th scope="col" class="sl55_2"></th>
      <th scope="col" class="sl55_3"></th>
      <th scope="col" class="sl55_4"></th>
      <th scope="col" class="sl55_5"></th>
      <th scope="col" class="sl55_1"></th>
     
    </tr>

    </thead>
    <tbody>

      <tr><?php $distance->distance;
                $sum = 0;

      ?>
      <td scope="col" class="sl55_1">1</td>
      <td scope="col" class="sl55_2">0-25 Kms</td>
      <td scope="col" class="sl55_3"></td>
      <td scope="col" class="sl55_4"><?php  echo $bill_dtls->paddy_qty;?></td>
      <td scope="col" class="sl55_5"><?php echo $rate['3']->boiled_val?></td>
      <td scope="col" class="sl55_1"><?php echo round(($rate['3']->boiled_val*$bill_dtls->paddy_qty),2);
                                                $sum = round(($rate['3']->boiled_val*$bill_dtls->paddy_qty),2);

      ?></td>
      <td scope="col" class="sl55_2"></td>
      <td scope="col" class="sl55_3"></td>
      <td scope="col" class="sl55_4"></td>
      <td scope="col" class="sl55_5"></td>
      <td scope="col" class="sl55_1"></td>
     
    </tr>

     <tr>
      <td scope="col" class="sl55_1">2</td>
      <td scope="col" class="sl55_2"> >25-50 Kms</td>
      <td scope="col" class="sl55_3"></td>
      <td scope="col" class="sl55_4"><?php echo $bill_dtls->paddy_qty;?></td>
      <td scope="col" class="sl55_5"><?php echo $rate['4']->boiled_val?></td>
      <td scope="col" class="sl55_1"><?php if($distance->distance > 25){
                                            echo round(($rate['4']->boiled_val*$bill_dtls->paddy_qty),2);
                                            $sum += round(($rate['4']->boiled_val*$bill_dtls->paddy_qty),2);
                                          }else{
                                            echo "";
                                          }?>                                     
      </td>
      <td scope="col" class="sl55_2"></td>
      <td scope="col" class="sl55_3"></td>
      <td scope="col" class="sl55_4"></td>
      <td scope="col" class="sl55_5"></td>
      <td scope="col" class="sl55_1"></td>
     
    </tr>

     <tr>
      <td scope="col" class="sl55_1">3</td>
      <td scope="col" class="sl55_2">>50-100 Kms</td>
      <td scope="col" class="sl55_3"></td>
      <td scope="col" class="sl55_4"><?php echo $bill_dtls->paddy_qty;?></td>
      <td scope="col" class="sl55_5"><?php echo $rate['5']->boiled_val?></td>
      <td scope="col" class="sl55_1"><?php  if($distance->distance > 50){
                                            echo round(($rate['5']->boiled_val*$bill_dtls->paddy_qty),2);
                                            $sum += round(($rate['5']->boiled_val*$bill_dtls->paddy_qty),2);
                                          }else{
                                             echo "";
                                          }
                                          ?></td>
      <td scope="col" class="sl55_2"></td>
      <td scope="col" class="sl55_3"></td>
      <td scope="col" class="sl55_4"></td>
      <td scope="col" class="sl55_5"></td>
      <td scope="col" class="sl55_1"></td>
     
    </tr>
    </tbody>

   
</table>
    
    
  </div>

  <p align="justify" >Amount Rounded off: <strong> &#2352; <?php 
                   
                                     $amount = moneyFormatIndia(round($sum)); 
                                     echo $amount; ?></strong><br>
  Rupees in Words: <strong> <?php    echo getIndianCurrency(round($sum));?></strong></p>
  <p >Certified that the claimed amount has been the least transportation cost, based on distance covered   through the shortest route(s).</p>
  <h3 >Certified that </h3>
  <ul>
    <li>The sum of Rupees <?php echo $amount; ?> claimed in the bill has not been drawn previously </li>
    <li>The details as well as calculations as shown in the Bill have been checked with original documents and found correct </li>
    <li>Any amount found paid in excess at any subsequent date may be adjusted from future Claim. </li>
    <li>Proper noting have been kept to avoid double payment </li>
  </ul>
  <ul>
  </ul>
  <p>&nbsp;</p>
  <p><strong>Signature of the Claimant with seal</strong></p>
</div>
    </div>

                    <div style="text-align: center;">
    
                        <button class="btn btn-primary" type="button" onclick="printDiv();">Print</button>
    
                    </div>

                </div>

            
        </div>