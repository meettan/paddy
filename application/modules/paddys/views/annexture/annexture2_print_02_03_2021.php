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
                          <h2> ANNEXURE-II</h2>
                     
  <p>Name of the Agency: <b>BENEFED</b></p>
  <h2>    SYNOPSIS OF BILL</h2>
  <div class="billDateGroop"><div class="crmBill">CMR Bill No <strong><?php if(isset($bill_dtls->ho_bill_number)){echo $bill_dtls->ho_bill_number;}?></strong></div>      <div class="dateTop">Date: <strong><?php if(isset($bill_dtls->trans_dt)){echo date("d/m/Y",strtotime($bill_dtls->trans_dt));}?></strong>.</div></div>
  <br clear="all">

  <p>    Claim towards the cost of Par Boiled /Common Raw [FAQ] delivered to the <strong>HO</strong>  for  the KMS <strong><?php echo $this->session->userdata['loggedin']['kms_yr'];?></strong> </p>
  
  <div class="">
  <table width="100%" border="0" cellspacing="0" cellpadding="0" class="table tableCus">
    <thead>
      <tr>
      <th scope="col" class="sl_1">Sl No</th>
      <th scope="col" class="sl_2">Particulars</th>
      <th scope="col" class="sl_3">Quantity</th>
      <th scope="col" class="sl_4">Rate/ Qtl</th>
       <th scope="col" class="sl_5">Total Amount</th>
      <th scope="col" class="sl_6">Qty</th>
      <th scope="col" class="sl_7">Rate/ Qtl</th>
      <th scope="col" class="sl_8">Total Amt</th>
      </tr>
     </thead>
      <tbody>
   
          <tr>
            <td scope="col" class="sl_11">(1)</td>
            <td scope="col" class="sl_22">(2)</td>
            <td scope="col" class="sl_33">(3)</td>
            <td scope="col" class="sl_44">(4)</td>
            <td scope="col" class="sl_55">(5)</td>
            <td scope="col" class="sl_66">(6)</td>
            <td scope="col" class="sl_55">(7)</td>
            <td scope="col" class="sl_66">(8)</td>
          </tr>
      
    <tr>
      <td class="sl_1"></td>
      <td class="sl_2"></td>
      <td class="sl_3" colspan="2">Par-Boiled  Rice</td>
      <td class="sl_4"></td>
      <td class="sl_5" colspan="2">Raw Rice</td>
      <td class="sl_6" ></td>
   
    </tr>
 
    <?php 
           $sum = 0;

    foreach($particulas as $part){?>
     <tr>
      <td scope="row">1</td>
      <td><?php if(isset($part->param_name)){echo $part->param_name;}?></td>
      <td><?php if($part->param_name == "P"){echo $bill_dtls->tot_cmr;}else{ echo $bill_dtls->tot_paddy;} ?></td>
      <td><?php if(isset($part->per_unit)){echo $part->per_unit;}?></td>
      <td><?php if(isset($part->total_amt)){echo $part->payble_amt;
                                $sum+= $part->payble_amt;

      }?></td>
      <td></td>
      <td></td>
      <td></td>
    </tr>
  <?php } ?>
   
    
   </tbody>
    

</table>
    
    
  </div>
  <h2 align="right" >STATE / CENTRAL POOL </h2>
  <p align="justify" >Amount Rounded off:<strong>&#2352;  <?php 
                                         
                                        $amount = moneyFormatIndia(round($sum)); 
                                      echo $amount; ?> </strong> </p>
    <p align="justify" >Rupees in Words:<strong> <?php echo getIndianCurrency(round($sum));?></strong> </p>
  <p>&nbsp;</p>
</div>
    </div>

                    <div style="text-align: center;">
    
                        <button class="btn btn-primary" type="button" onclick="printDiv();">Print</button>
    
                    </div>

              

            
        </div>
    </div>