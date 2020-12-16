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
  <h2><img src="<?php echo base_url();?>benfed.png" alt=""/></h2>
   <h3 style="text-align: center">  ANNEXURE-VIII</h3>
  <p>Name of the Agency: </p>
   <h2>    CLAIM FOR USAGE CHARGE FOR GUNNY BAGS FOR PADDY </h2>
  <div class="billDateGroop">
    <div class="crmBill"> Bill No. <strong>.........</strong></div>                                           
    <div class="dateTop">Date: <strong>.........</strong>.</div></div>
  <br>

  <p>Name of the Miller:  </p>


  <p>Claim towards Cost of Usage charges for Gunny Bags for Paddy to the F&S for the KMS ..... </p>
  
  <div class="tableBottomBorder">
  <table width="100%" border="0" cellspacing="0" cellpadding="0">
  <tbody>
    <tr>
      <td>
    <table class="table tableCus">
  <thead>
    <tr>
      <th scope="col" class="sl55_3">WQSC</th>
      <th scope="col" class="sl55_5">Quantity of Paddy</th>
    
    <th scope="col" class="sl55_5"><strong> </strong>No of gunny Bags used for paddy      <strong> </strong></th>
    <th scope="col" class="sl55_5">DO No & Date </th>
    <th scope="col" class="sl55_5">Rate Of gunny Usage for Paddy</th>
    
    <th scope="col" class="sl55_5">Gunny Usage claimed for Paddy</th>
    
    <th scope="col" class="sl55_5">Gunny Cut</th>
    <th scope="col" class="sl55_5">CGST <br>
        @2.5% on Milling charge</th>
    <th scope="col" class="sl55_5">SGST <br>
        @2.5% on Milling charge</th>
    <th scope="col" class="sl55_5">Gunny Usage Claimed</th>
    </tr>
    <tr>
      <td style="padding: 0;"><table width="100%" border="0" cellspacing="0" cellpadding="0">
        <tbody>
          <tr>
            <td class="sl4_1" style="border-top: none; border-left: none;">Variety of Rice</td>
            <td class="sl4_1" style="border-top: none;">WQSC
              No</td>
            <td class="sl4_1" style="border-top: none;">Quantity of CMR</td>
            </tr>
          </tbody>
      </table></td>
      <td>9</td>
    
    <td>10</td>
    <td>11</td>
    <td>12</td>
    <td>13</td>
    
    <td>10</td>
    <td>11</td>
    <td>12</td>
    <td>13</td>
    </tr>
    <tr>
      <td style="padding: 0;"><table width="100%" border="0" cellspacing="0" cellpadding="0">
        <tbody>
          <tr>
            <td class="sl4_1" style="border-top: none; border-left: none;">&nbsp;</td>
            <td class="sl4_1" style="border-top: none;">&nbsp;</td>
            <td class="sl4_1" style="border-top: none;">Qtl</td>
          </tr>
        </tbody>
      </table></td>
      <td>Qtl</td>
      <td>Pcs</td>
      <td>&nbsp;</td>
      <td>Rs.</td>
      <td>Rs.</td>
      <td>Rs.</td>
      <td>Rs.</td>
      <td>Rs.</td>
      <td>Rs.</td>
    </tr>
    <tr>
      <td style="padding: 0;"><table width="100%" border="0" cellspacing="0" cellpadding="0">
        <tbody>
          <tr>
            <td class="sl4_1" style="border-top: none; border-left: none;">1</td>
            <td class="sl4_1" style="border-top: none;">2</td>
            <td class="sl4_1" style="border-top: none;">3</td>
          </tr>
        </tbody>
      </table></td>
      <td>4</td>
      <td>5</td>
      <td>6</td>
      <td>7</td>
      <td>8</td>
      <td>9</td>
      <td>10</td>
      <td>11</td>
      <td>12</td>
    </tr>
    <tr>
      <td style="padding: 0;">&nbsp;</td>
      <td>&nbsp;</td>
      <td>&nbsp;</td>
      <td>&nbsp;</td>
      <td>&nbsp;</td>
      <td>&nbsp;</td>
      <td>&nbsp;</td>
      <td>&nbsp;</td>
      <td>&nbsp;</td>
      <td>&nbsp;</td>
    </tr>
    <tr>
      <td style="padding: 0;">&nbsp;</td>
      <td>&nbsp;</td>
      <td>&nbsp;</td>
      <td>&nbsp;</td>
      <td>&nbsp;</td>
      <td>&nbsp;</td>
      <td>&nbsp;</td>
      <td>&nbsp;</td>
      <td>&nbsp;</td>
      <td>&nbsp;</td>
    </tr>
  </thead>
  <tbody>

    
  </tbody>
</table>
    </td>
    </tr>
  </tbody>
</table>
    
    
  </div>

  
  <h3 >Certified that </h3>
  <ul>
    <li>Voucher to this effect is submitted with the claim. </li>
    <li>        The quantity of Paddy derived from WQSC confirms with the total quantity of paddy as per Muster Roll   </li>
    <li>        Certified that the claimed amount on account of GST has actually been paid and reported to the appropriate GST authority </li>
    <li>        Certified that only once used gunny  Bags have been utilized for the purpose of paddy packaging </li>
    <li>        Certified that all  the gunny bag have provided by the concerned rice miller at the time of purchase and  has not been obtained from the farmers
    </li>
  </ul>
  <h3 >Certified that </h3>
  <ul>
    <li>The sum of Rupees<strong> ......................</strong> claimed in the bill has not been drawn previously </li>
    <li>The details as well as calculations as shown in the Bill have been checked with original documents and found correct </li>
    <li>Any amount found paid in excess at any subsequent date may be adjusted from future Claim. </li>
    <li>Proper noting have been kept to avoid double payment </li>
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