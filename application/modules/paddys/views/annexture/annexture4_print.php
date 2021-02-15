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
   <h2>  ANNEXURE-IV </h2>
   <p>Name of the Agency:<b> BENFED</b></p>
   <h2> CLAIM FOR MARKET FEE </h2>
   <div class="billDateGroop"><div class="crmBill">CMR Bill No: <strong><?php if(isset($bill_dtls->ho_bill_number)){echo $bill_dtls->ho_bill_number;}?></strong></div>                                            <div class="dateTop">Date: <strong><?php echo date('d/m/Y', strtotime($bill_dtls->trans_dt)); ?></strong>.</div></div>
   <br clear="all">

   <p>Claim  towards Market Fee to F&S Deptt. through the <strong>HO</strong> for  the KMS <strong><?php echo $this->session->userdata['loggedin']['kms_yr'];?></strong></p>
  
   <div class="tableBottomBorder">
   <table width="100%" border="0" cellspacing="0" cellpadding="0" class="table tableCus">
   <thead>
    <tr>
      <th scope="col" class="sl5_1">Sl No</th>
      <th scope="col" class="sl5_2">Name of the Mandi   with  Address</th>
      <th scope="col" class="sl5_3">MSP of Paddy</th>
      <th scope="col" class="sl5_4">Rate of Market Fee</th>
    <th scope="col" class="sl5_5">Total Amount claimed</th>

    </tr>
   </thead>
   <tbody>
    <tr>
      <td scope="row"><strong>1</strong></td>
      <td><strong><?php if(isset($bill_dtls->mandi_board)){echo $bill_dtls->mandi_board;}?><br><?php if(isset($bill_dtls->mandi_board_addr)){echo $bill_dtls->mandi_board_addr;}?></strong></td>
      <td><strong><?php if(isset($bill_dtls->per_qui_rate)){echo $bill_dtls->per_qui_rate;}?></strong></td>
      <td><strong><?php if(isset($bill_dtls->per_qui_rate)){echo $bill_dtls->per_unit;}?></strong></td>
    <td><strong><?php if(isset($bill_dtls->per_qui_rate)){echo round($bill_dtls->per_unit*$bill_dtls->tot_paddy,2);}?></strong></td>

    </tr>
    <tr>
      <td scope="row">&nbsp;</td>
      <td>&nbsp;</td>
      <td>&nbsp;</td>
      <td>&nbsp;</td>
      <td>&nbsp;</td>
    </tr>
    <tr>
      <td scope="row">&nbsp;</td>
      <td>&nbsp;</td>
      <td>&nbsp;</td>
      <td style="text-align: right"><strong> Rounded of Total: </strong></td>
      <td><strong> <?php $amount = round($bill_dtls->per_unit*$bill_dtls->tot_paddy);
   
    $amount = moneyFormatIndia($amount);   echo $amount;

      ?></strong></td>
    </tr>

    
   </tbody>
  </table>
    
    
  </div>

  <p align="justify" >Amount Rounded off: <strong>&#2352; <?php echo $amount;?></strong></p>
  <p align="justify" >    Rupees in Words: <strong> <?php echo getIndianCurrency(round($bill_dtls->per_unit*$bill_dtls->tot_paddy));?></strong></p>
  <h3 >Certified that </h3>
  <ul>
    <li>The sum of <strong>&#2352; <?php echo round($bill_dtls->per_unit*$bill_dtls->tot_paddy); ?> </strong>claimed in the bill has not been drawn previously </li>
    <li>The details as well as calculations as shown in the Bill have been checked with original documents and found correct </li>
    <li>Any amount found paid in excess at any subsequent date may be adjusted from future Claim. </li>
    <li>Proper noting have been kept to avoid double payment</li>
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