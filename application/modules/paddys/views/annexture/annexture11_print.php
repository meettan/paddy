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
                     <h3 style="text-align: center">  ANNEXURE-X</h3>
                    <p>Name of the Agency: </p>
                    <h2><strong>STOCK FLOW STATEMENT OF CMR</strong><strong> </strong></h2>
                    
                    
                    
                    <div class="tableBottomBorder">
                    <table width="100%" border="0" cellspacing="0" cellpadding="0">
                    <tbody>
                      <tr>
                        <td>
                      <table class="table tableCus">
                    <thead>
                      <tr>
                        <th scope="col" class="sl5_1"><strong>Date</strong></th>
                        <th scope="col" class="sl5_2"><strong>Opening stock for CMR</strong></th>
                        <th scope="col" class="sl5_3"><strong>Procurement during KMS .....</strong></th>
                        <th scope="col" class="sl5_4"><strong>Total qty of CMR</strong></th>
                    <th scope="col" class="sl5_5"><strong>CMR Distributed</strong></th>
                      <th scope="col" class="sl5_6"><strong>Closing Stock of CMR</strong></th>
                      <th scope="col" class="sl5_7"><strong>Remarks</strong></th>

                      </tr>
                    </thead>
                    <tbody>
                      <tr>
                        <td scope="row"><strong>1</strong></td>
                        <td><strong>2</strong></td>
                        <td><strong>3</strong></td>
                        <td><strong>4</strong></td>
                    <td><strong>5</strong></td>
                      
                      <td><strong>6</strong></td>
                    <td><strong>7</strong></td>

                      </tr>
                      <tr>
                        <td scope="row">&nbsp;</td>
                        <td>&nbsp;</td>
                        <td>&nbsp;</td>
                        <td>&nbsp;</td>
                        <td>&nbsp;</td>
                      <td>&nbsp;</td>
                    <td>&nbsp;</td>
                      </tr>
                      <tr>
                        <td scope="row">&nbsp;</td>
                        <td>&nbsp;</td>
                        <td>&nbsp;</td>
                        <td style="text-align: right">&nbsp;</td>
                        <td>&nbsp;</td>
                      <td>&nbsp;</td>
                    <td>&nbsp;</td>
                      </tr>

                      
                    </tbody>
                  </table>
                      </td>
                      </tr>
                    </tbody>
                  </table>
                      
                      
                    </div>

                    <p align="justify" >&nbsp;</p>
                    <p><strong>Signature of the Claimant with seal</strong></p>
              </div>
                      
              </div>

              <div style="text-align: center;">
    
                        <button class="btn btn-primary" type="button" onclick="printDiv();">Print</button>
    
              </div>

      </div>

            
</div>