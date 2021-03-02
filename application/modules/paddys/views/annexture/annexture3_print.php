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
    <h2>  ANNEXURE-III </h2>
  <p>Name of the Agency: <b>BENFED</b> </p>
    <!--   SYNOPSIS OF BILL -->
  <div class="billDateGroop"><div class="crmBill">CMR Bill No: <strong><?php if(isset($bill_dtls->ho_bill_no)){echo $bill_dtls->ho_bill_no;}?></strong></div>                                            <div class="dateTop">Date: <strong><?php echo date('d/m/Y', strtotime($bill_dtls->trans_dtp)); ?></strong>.</div></div>
  <br clear="all">

  <p>Claim towards MSP to F&S Deptt. through the <strong> HO </strong> for  the KMS  <strong><?php echo $this->session->userdata['loggedin']['kms_yr'];?></strong></p>
  
  <div class="">
  <table width="100%" border="0" cellspacing="0" cellpadding="0" class="table tableCus">
  <thead>
    <tr>
      <th scope="col" class="sl5_1">Sl No</th>
      <th scope="col" class="sl5_2">Type of Rice</th>
      <th scope="col" class="sl5_3">Quantity</th>
      <th scope="col" class="sl5_4">Rate/ Qtl</th>
  <th scope="col" class="sl5_5">Total Amount</th>

    </tr>
  </thead>
  <tbody>
    <tr>
      <td scope="row"><strong>1</strong></td>
      <td><strong>2</strong></td>
      <td><strong>3</strong></td>
      <td><strong>4</strong></td>
  <td><strong>5</strong></td>

    </tr>
    <tr>
      <td scope="row">&nbsp;</td>
      <td> <?php if($bill_dtls->rice_type == "R"){ echo "Raw Rice";}else{ echo "Parboiled Rice"; }?>
      </td>
      <td><?php if(isset($bill_dtls->tot_paddy)){echo $bill_dtls->tot_paddy;}?></td>
      <td><?php if(isset($bill_dtls->per_qui_rate)){echo $bill_dtls->per_qui_rate;}?></td>
      <!-- <td><?php //if(isset($bill_dtls->rate)){echo $bill_dtls->rate;}?></td> -->
      <td><?php if(isset($bill_dtls->rate)){echo round(($bill_dtls->per_qui_rate*$bill_dtls->tot_paddy),2);}
                                            $value = round(($bill_dtls->per_qui_rate*$bill_dtls->tot_paddy),2);
      ?></td>
    </tr>
    <tr>
      <td scope="row">&nbsp;</td>
      <td>Raw Rice</td>
      <td>&nbsp;</td>
      <td>&nbsp;</td>
      <td>&nbsp;</td>
    </tr>

    
  </tbody>
</table>
    
    
  </div>

  <p align="justify">Amount Rounded off: <strong style="">&#2352;  <?php 

      $sum = $bill_dtls->per_qui_rate*$bill_dtls->tot_paddy;echo (round($sum));
  // if(isset($bill_dtls->per_qui_rate)){ 

  //   $amount = round($bill_dtls->per_qui_rate*$bill_dtls->tot_paddy);

  //   echo round(abs($amount - $value),2);
                     
    // echo $amount = moneyFormatIndia( $amount );
    ?></strong></p>
  <p align="justify">Rupees in Words: <strong>  <?php echo getIndianCurrency(round($sum));?></strong></p>
  <p>&nbsp;</p>

  <p>&nbsp;</p>
    <p style="float: right;"><strong>Signature of the Claimant with seal</strong></p>
     <p>&nbsp;</p>
      <p>&nbsp;</p>
    <h3> Required Supporting Documents:</h3>
    <p align="justify">1. Money Receipt from Rice Mill 2. MSP Certificate [Original] 3. Photocopy of Muster Roll,  4.Certificate on proff of Receipt of Paddy [Original]</p>
    
   
   
    <p>&nbsp;</p>
    <p>&nbsp;</p>
    <p align="justify"><strong>N.B Claim will summarily be rejected for payment for want of above noted requisite documents.</strong></p>
 </div>

    
                   </div>

            
                    <div style="text-align: center;">
    
                        <button class="btn btn-primary" type="button" onclick="printDiv();">Print</button>
    
                    </div>
                </div>
      </div>