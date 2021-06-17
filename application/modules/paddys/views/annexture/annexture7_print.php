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
                     <h2>CLAIM FOR MILLING CHARGE</h2>
                    <p>Name of the Rice Mill: <b> <?php echo $millname->mill_name;    //print_r($bill_dtls);?></b>  <br>
                    Address: </p>

                    <p> <strong>Claim towards Transport Charges for the KMS <?php echo $this->session->userdata['loggedin']['kms_yr'];?></strong></p>

                    
                    <div class="">
                                       
                      <table class="table tableCus">
                     <thead>
                      <tr>
                        <th rowspan="2">Challan No</th>
                        <th colspan="4" ><strong>W.Q & S.C .</strong></th>
                        <th colspan="2"><strong>QUANTITY</strong></th>
                        <th ><strong></strong></th>
                        <th rowspan="2"><strong>Rate per Qtl</strong></th>
                      
                        <th rowspan="2"><strong> Amt claimed</strong><strong> </strong></th>
                        <th rowspan="2"><strong>CGST</strong><strong> </strong><br>
                        <strong>@2.5% </strong></th>
                        <th rowspan="2"><strong>SGST</strong><strong> </strong><br>
                        <strong>@2.5% </strong></th>
                        <th rowspan="2"><strong>Total Amount Claimed [Rs]</strong>
                       </th>
                      </tr>
                       <tr>
                         <th>No</th>
                          <th >Date</th>
                           <th >Issuing Authority</th>
                           <th >Godown</th>
                           <th>Bags[No]</th>
                            <th >Qty</th> 
                             <th >Muster Roll No</th>
                            

                      </tr>
                      <tr>
                        <td>(1)</td>
                        <td>(2)</td>
                        <td>(3)</td>
                        <td>(4)</td>
                        <td>(5)</td>
                        <td>(6)</td>
                        <td>(7)</td>
                        <td>(8)</td>
                        <td>(9)</td>
                        <td>(10)</td>
                        <td>(11)</td>
                        <td>(12)</td>
                        <td>(13)</td>
                      </tr>
                    </thead>

                      <tr>
                        <td>&nbsp;</td>
                        <td>
                          <?php if(isset($bill_dtls->wqsc_no)){ 
         $sql = "SELECT a.kms_id,a.wqsc_no,b.sub_wqsc FROM td_wqsc a,td_wqsc_dtls b where a.id = b.trans_id and  a.wqsc_no ='$bill_dtls->wqsc_no' and  a.kms_id = '".$this->session->userdata['loggedin']['kms_id']."' group by a.kms_id,a.wqsc_no,b.sub_wqsc";

        $row = $this->db->query($sql)->result();
                  foreach($row as $r){

                    echo $r->sub_wqsc.'</br></br>';

                  }


        }?>

                        </td>
                        <td> <?php if(isset($bill_dtls->wqsc_no)){ 
         $sql = "SELECT a.kms_id,a.wqsc_no,max(b.trans_dt) as mdate,min(b.trans_dt) as midate FROM td_wqsc a,td_wqsc_dtls b where a.id = b.trans_id and  a.wqsc_no ='$bill_dtls->wqsc_no' and  a.kms_id = '".$this->session->userdata['loggedin']['kms_id']."' group by a.kms_id,a.wqsc_no,b.sub_wqsc, b.trans_dt";

        $row = $this->db->query($sql)->row();
               
        echo date('d-m-Y', strtotime($row->mdate)); ?> '<br>TO<br>'  <?php   echo date('d-m-Y', strtotime($row->midate)); 

        }?></td>
                        <td>District Controller (F& S) U/D</td>
                        <td><?php if(isset($bill_dtls->goodown_name)){ echo $bill_dtls->goodown_name;}?></td>
                        <td>&nbsp;</td>
                        <td><?php if(isset($bill_dtls->paddy_qty)){ echo $bill_dtls->paddy_qty; $qty = $bill_dtls->paddy_qty;

                        }?></td>
                        <td>&nbsp;</td>
                        <td><?php if(isset($rate->per_unit)){ echo $rate->per_unit;}?></td>
                         <td><?php if(isset($rate->per_unit)){echo $clam = $qty*$rate->per_unit;} ?></td>
                        <td><?php print_r($rate->cgst_amt); ?></td>
                        <td><?php if(isset($rate->sgst_amt)){ echo $rate->sgst_amt;}?></td>
                       
                        <td><?php if(isset($clam)){ echo $clam+$rate->cgst_amt+$rate->sgst_amt;
                                                        $total = $clam+$rate->cgst_amt+$rate->sgst_amt;


                        }?></td>
                      </tr>
                         <tr>
                        <td>&nbsp;</td>
                        <td>&nbsp;</td>
                        <td>&nbsp;</td>
                        <td>&nbsp;</td>
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
                        <td>&nbsp;</td>
                        <td>&nbsp;</td>
                        <td>&nbsp;</td>
                        <td>&nbsp;</td>
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
                  
                    </tbody>
                  </table>
                    </div>

                    <p align="justify" >Amount Rounded off: <strong><?php echo round($total); ?> </strong><br>
                    Rupees in Words: <strong><?php echo getIndianCurrency(round($total));?></strong></p>
                    <p >Certified that the claimed amount on account of GST has actually been paid and reported to the appropriate GST authority  </p>
                    <h3 >Certified that </h3>
                    <ul>
                      <li>The sum of Rupees<strong> <?php echo getIndianCurrency(round($total));?></strong> claimed in the bill has not been drawn previously </li>
                      <li>The details as well as calculations as shown in the Bill have been checked with original documents and found correct </li>
                      <li>Any amount found paid in excess at any subsequent date may be adjusted from future Claim. </li>
                      <li>Proper noting have been kept to avoid double payment </li>
                    </ul>
                    <ul>
                    </ul>
                    <p>&nbsp;</p>
                    <p style="float: right;"><strong>Signature of the Claimant with seal</strong></p>
                    <p>&nbsp;</p>
                    <p ><strong>Required supporting Documents:</strong></p>
        1.Work Order, 2. Copy of Agreement ,3.Miller's Bill, 4. System generated authenticated WQSC, 5. Original Analysis Report, 6. Authenticated Milling Certificate 7. Certificate of Non due Delivery of RCMR 8.Copy of GSTN no of miller

<p><strong>N.B</strong>  Claim will summarily be rejected for payment for want of above noted requisite documents.</p>
                  </div>
        </div>

                    <div style="text-align: center;">
    
                        <button class="btn btn-primary" type="button" onclick="printDiv();">Print</button>
    
                    </div>

                </div>

            
        </div>