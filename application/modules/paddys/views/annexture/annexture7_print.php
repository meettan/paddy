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
                    <h3 style="text-align: center">  ANNEXURE-VII</h3>
                    <p>Name of the Agency:<b>Benfed</b>  </p>
                     <h2>CLAIM FOR COMMISSION</h2>
                    <p>Name of the Miller:  <?php echo $millname->mill_name;    //print_r($bill_dtls);?>  <br>
                    Address: </p>


                    <p>Claim towards Transport Charges for the KMS <strong><?php echo $this->session->userdata['loggedin']['kms_yr'];?></strong></p>

                   
                    
                    <div class="tableBottomBorder">
                    <table width="100%" border="0" cellspacing="0" cellpadding="0">
                    <tbody>
                      <tr>
                        <td>
                      <table class="table tableCus">
                     <thead>
                      <tr>
                        <th scope="col" class="sl55_1">Sl No</th>
                        <th scope="col" class="sl55_3"><strong>W.Q & S.C .</strong></th>
                        <th scope="col" class="sl55_4"><strong>QUANTITY</strong></th>
                        <th scope="col" class="sl55_5"><strong>Rate per Qtl</strong></th>
                      
                        <th scope="col" class="sl55_5"><strong> Amt claimed</strong><strong> </strong></th>
                        <th scope="col" class="sl55_5"><strong>CGST</strong><strong> </strong><br>
                        <strong>@2.5% </strong></th>
                        <th scope="col" class="sl55_5"><strong>SGST</strong><strong> </strong><br>
                        <strong>@2.5% </strong></th>
                        <th scope="col" class="sl55_5"><strong>SGST</strong><strong> </strong><br>
                        <strong>@2.5% </strong></th>
                      </tr>
                      <tr>
                        <td scope="row">1</td>
                        <td style="padding: 0;"><table width="100%" border="0" cellspacing="0" cellpadding="0">
                          <tbody>
                            <tr>
                              <td class="sl4_1" style="border-top: none; border-left: none;">2</td>
                              <td class="sl4_1" style="border-top: none;">3</td>
                              <td class="sl4_1" style="border-top: none;">4</td>
                              <td class="sl4_1" style="border-top: none; border-right: none;">5</td>
                              </tr>
                            </tbody>
                          </table></td>
                          <td style="padding: 0;"><table width="100%" border="0" cellspacing="0" cellpadding="0">
                          <tbody>
                            <tr>
                              <td class="sl4_1" style="border-top: none; border-left: none;">6</td>
                              <td class="sl4_1" style="border-top: none;">7</td>
                              <td class="sl4_1" style="border-top: none; border-right: none;">8</td>
                            </tr>
                          </tbody>
                         </table></td>
                        <td>9</td>
                      
                       <td>10</td>
                       <td>11</td>
                       <td>12</td>
                       <td>13</td>
                      </tr>
                       <?php foreach($bill_dtls as $bill_dtl);{


                        ?>
                      <tr>
                        <td scope="row"></td>
                        <td style="padding: 0;"><?//=$bill_dtl->memo_no?></td>
                        <td style="padding: 0;">&nbsp;</td>
                        <td>&nbsp;</td>
                        <td>&nbsp;</td>
                        <td>&nbsp;</td>
                        <td>&nbsp;</td>
                        <td>&nbsp;</td>
                      </tr>
                    <?php } ?>
                      <tr>
                        <td scope="row">&nbsp;</td>
                        <td style="padding: 0;">&nbsp;</td>
                        <td style="padding: 0;">&nbsp;</td>
                        <td>&nbsp;</td>
                        <td>&nbsp;</td>
                        <td>&nbsp;</td>
                        <td>&nbsp;</td>
                        <td>&nbsp;</td>
                      </tr>
                      <tr>
                        <td scope="row">&nbsp;</td>
                        <td style="padding: 0;">&nbsp;</td>
                        <td style="padding: 0;">&nbsp;</td>
                        <td>&nbsp;</td>
                        <td>&nbsp;</td>
                        <td>&nbsp;</td>
                        <td>&nbsp;</td>
                        <td>&nbsp;</td>
                      </tr>
                      <tr>
                        <td scope="row">&nbsp;</td>
                        <td style="padding: 0;">&nbsp;</td>
                        <td style="padding: 0;">&nbsp;</td>
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

                    <p align="justify" >Amount Rounded off: <strong>................................................................................. </strong><br>
                    Rupees in Words: <strong>...................................................................................... </strong></p>
                    <p >Certified that the claimed amount on account of GST has actually been paid and reported to the appropriate GST authority  </p>
                    <h3 >Certified that </h3>
                    <ul>
                      <li>The sum of Rupees<strong> ......................</strong> claimed in the bill has not been drawn previously </li>
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