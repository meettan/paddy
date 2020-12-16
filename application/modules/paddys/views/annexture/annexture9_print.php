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
   <h3 style="text-align: center">  ANNEXURE-IX</h3>
  <p>Name of the Agency: </p>
  <h2>    CLAIM FOR USAGE CHARGE FOR GUNNY BAGS FOR PADDY  </h2>
  <div class="tableBottomBorder">
  <table width="100%" border="0" cellspacing="0" cellpadding="0">
  <tbody>
    <tr>
      <td>
    <table class="table tableCus">
  <thead>
    <tr>
      <th scope="col" class="sl55_1"><strong>Date</strong></th>
      <th scope="col" class="sl55_5"><strong>Opening stock for  Gunny for Paddy</strong></th>
    
    <th scope="col" class="sl55_5"><strong> </strong><strong>New</strong><strong> </strong><br>
        <strong>Purchase</strong>     <strong> </strong></th>
    <th scope="col" class="sl55_5"><strong>Invoice</strong><strong> </strong><br>
        <strong>Details</strong></th>
    <th scope="col" class="sl55_5"><strong>Total Gunny for Paddy</strong><strong> </strong>
      <strong>[3+4]</strong></th>
    
    <th scope="col" class="sl55_5"><strong>Qty of Paddy</strong></th>
    
    <th scope="col" class="sl55_3" style="padding: 0;"><table width="100%" border="0" cellspacing="0" cellpadding="0">
      <tbody>
        <tr>
          <td class="sl4_1" style="border-top: none; border-left: none;"><strong>Gunny for Paddy used</strong></td>
          <td class="sl4_1" style="border-top: none;"><strong>Closing stock of Gunny For Paddy</strong></td>
          </tr>
        </tbody>
      </table></th>
    <th scope="col" class="sl55_5"><strong>Remarks</strong></th>
    </tr>
    <tr>
      <td style="padding: 0;">&nbsp;</td>
      <td>&nbsp;</td>
    
    <td>&nbsp;</td>
    <td>&nbsp;</td>
    <td>&nbsp;</td>
    <td>&nbsp;</td>
    
    <td style="padding: 0;"><table width="100%" border="0" cellspacing="0" cellpadding="0">
      <tbody>
        <tr>
          <td class="sl4_1" style="border-top: none; border-left: none;">Once used</td>
          <td class="sl4_1" style="border-top: none;">New</td>
          <td class="sl4_1" style="border-top: none;">Once used</td>
          <td class="sl4_1" style="border-top: none; border-right: none;">New</td>
          </tr>
        </tbody>
      </table></td>
    <td>&nbsp;</td>
    </tr>
    <tr>
      <td>1</td>
      <td style="padding: 0;"><table width="100%" border="0" cellspacing="0" cellpadding="0">
        <tbody>
          <tr>
            <td class="sl4_1" style="border-top: none; border-left: none;">2</td>
            <td class="sl4_1" style="border-top: none; border-right: none; ">3</td>
            </tr>
          </tbody>
        </table></td>
      <td>4</td>
      <td>5</td>
      <td>6</td>
      <td>7</td>
      <td style="padding: 0;"><table width="100%" border="0" cellspacing="0" cellpadding="0">
        <tbody>
          <tr>
            <td class="sl4_1" style="border-top: none; border-left: none;">8</td>
            <td class="sl4_1" style="border-top: none;">9</td>
            <td class="sl4_1" style="border-top: none;">10</td>
            <td class="sl4_1" style="border-top: none; border-right: none;">11</td>
            </tr>
          </tbody>
        </table></td>
      <td>12</td>
    </tr>
    <tr>
      <td>1</td>
      <td style="padding: 0;"><table width="100%" border="0" cellspacing="0" cellpadding="0">
        <tbody>
          <tr>
            <td class="sl4_1" style="border-top: none; border-left: none;">2</td>
            <td class="sl4_1" style="border-top: none; border-right: none; ">3</td>
            </tr>
        </tbody>
      </table></td>
      <td>4</td>
      <td>5</td>
      <td>6</td>
      <td>7</td>
      <td style="padding: 0;"><table width="100%" border="0" cellspacing="0" cellpadding="0">
        <tbody>
          <tr>
            <td class="sl4_1" style="border-top: none; border-left: none;">8</td>
            <td class="sl4_1" style="border-top: none;">9</td>
            <td class="sl4_1" style="border-top: none;">10</td>
            <td class="sl4_1" style="border-top: none; border-right: none;">11</td>
          </tr>
        </tbody>
      </table></td>
      <td>12</td>
    </tr>
    <tr>
      <td>&nbsp;</td>
      <td style="padding: 0;"><table width="100%" border="0" cellspacing="0" cellpadding="0">
        <tbody>
          <tr>
            <td class="sl4_1" style="border-top: none; border-left: none;">&nbsp;</td>
            <td class="sl4_1" style="border-top: none; border-right: none; ">&nbsp;</td>
            </tr>
        </tbody>
      </table></td>
      <td>&nbsp;</td>
      <td>&nbsp;</td>
      <td>&nbsp;</td>
      <td>&nbsp;</td>
      <td style="padding: 0;"><table width="100%" border="0" cellspacing="0" cellpadding="0">
        <tbody>
          <tr>
            <td class="sl4_1" style="border-top: none; border-left: none;">&nbsp;</td>
            <td class="sl4_1" style="border-top: none;">&nbsp;</td>
            <td class="sl4_1" style="border-top: none;">&nbsp;</td>
            <td class="sl4_1" style="border-top: none; border-right: none;">&nbsp;</td>
          </tr>
        </tbody>
      </table></td>
      <td>&nbsp;</td>
    </tr>
    <tr>
      <td>&nbsp;</td>
      <td style="padding: 0;"><table width="100%" border="0" cellspacing="0" cellpadding="0">
        <tbody>
          <tr>
            <td class="sl4_1" style="border-top: none; border-left: none;">&nbsp;</td>
            <td class="sl4_1" style="border-top: none; border-right: none; ">&nbsp;</td>
            </tr>
        </tbody>
      </table></td>
      <td>&nbsp;</td>
      <td>&nbsp;</td>
      <td>&nbsp;</td>
      <td>&nbsp;</td>
      <td style="padding: 0;"><table width="100%" border="0" cellspacing="0" cellpadding="0">
        <tbody>
          <tr>
            <td class="sl4_1" style="border-top: none; border-left: none;">&nbsp;</td>
            <td class="sl4_1" style="border-top: none;">&nbsp;</td>
            <td class="sl4_1" style="border-top: none;">&nbsp;</td>
            <td class="sl4_1" style="border-top: none; border-right: none;">&nbsp;</td>
          </tr>
        </tbody>
      </table></td>
      <td>&nbsp;</td>
    </tr>
    <tr>
      <td>&nbsp;</td>
      <td style="padding: 0;"><table width="100%" border="0" cellspacing="0" cellpadding="0">
        <tbody>
          <tr>
            <td class="sl4_1" style="border-top: none; border-left: none;">&nbsp;</td>
            <td class="sl4_1" style="border-top: none; border-right: none; ">&nbsp;</td>
            </tr>
        </tbody>
      </table></td>
      <td>&nbsp;</td>
      <td>&nbsp;</td>
      <td>&nbsp;</td>
      <td>&nbsp;</td>
      <td style="padding: 0;"><table width="100%" border="0" cellspacing="0" cellpadding="0">
        <tbody>
          <tr>
            <td class="sl4_1" style="border-top: none; border-left: none;">&nbsp;</td>
            <td class="sl4_1" style="border-top: none;">&nbsp;</td>
            <td class="sl4_1" style="border-top: none;">&nbsp;</td>
            <td class="sl4_1" style="border-top: none; border-right: none;">&nbsp;</td>
          </tr>
        </tbody>
      </table></td>
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
     <p>&nbsp;</p>
     <p><strong>Signature of the Claimant with seal</strong></p>
     </div>

          </div>
                    <div style="text-align: center;">
    
                        <button class="btn btn-primary" type="button" onclick="printDiv();">Print</button>
    
                    </div>

                </div>

            
  </div>