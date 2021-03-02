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
  <p>Name of the Agency:<b>Benfed</b> </p>
   <h2>    CLAIM FOR USAGE CHARGE FOR GUNNY BAGS FOR PADDY </h2>
  <div class="billDateGroop">
    <div class="crmBill"> Bill No. <strong><?php echo $bill_dtls->ho_bill_number;?></strong></div>                                           
    <div class="dateTop">Date: <strong>
      <?php if(isset($bill_dtls->ben_bill_dt)){ echo date('d-m-Y', strtotime($bill_dtls->ben_bill_dt)) ;}?></strong>.</div></div>
  <br>

  <p>Name of the Miller:<b> <?php echo $millname->mill_name;    //print_r($bill_dtls);?> </b></p>


  <p>Claim towards Cost of Usage charges for Gunny Bags for Paddy to the F&S for the KMS <?php echo $this->session->userdata['loggedin']['kms_yr']; ?> </p>
  
  <div class="tableBottomBorder">
  <table width="100%" border="0" cellspacing="0" cellpadding="0">
    <thead>
      <tr>
        <th colspan="3">WQSC</th>
        <th rowspan="2">Quantity of Paddy</th>
        <th rowspan="2">No of gunny Bags used for paddy</th>
        <th rowspan="3">DO No & Date</th>
        <th rowspan="2">Rate Of gunny Usage for Paddy</th>
        <th rowspan="2">Gunny Usage claimed for Paddy</th>
        <th rowspan="2">Gunny Cut</th>
        <th rowspan="2">CGST <br>
        @2.5% on Milling charge</th>
        <th rowspan="2">SGST <br>
        @2.5% on Milling charge</th>
         <th rowspan="2">Gunny Usage Claimed</th>
      </tr>
      <tr>
        <th rowspan="2">Variety of Rice</th>
        <th rowspan="2">WQSC No</th>
        <th>Quantity of CMR</th>
      </tr>
      <tr>
        <th>Qtl</th>
        <th>Qtl</th>
        <th>Pcs</th>
        <th>Rs.</th>
        <th>Rs.</th>
        <th>Rs.</th>
        <th>Rs.</th>
        <th>Rs.</th>
        <th>Rs.</th>

      </tr>
    </thead>
   
  <tbody> 
    
    <tr>
      <td style="text-align: center">(1)</td>
      <td style="text-align: center">(2)</td>
      <td style="text-align: center">(3)</td>
      <td style="text-align: center">(4)</td>
      <td style="text-align: center">(5)</td>
      <td style="text-align: center">(6)</td>
      <td style="text-align: center">(7)</td>
      <td style="text-align: center">(8)</td>
      <td style="text-align: center">(9)</td>
      <td style="text-align: center">(10)</td>
       <td style="text-align: center">(11)</td>
      <td style="text-align: center">(12)</td>
    </tr>
    <tr>
      <td><?php if(isset($bill_dtls->rice_type)){ if($bill_dtls->rice_type == 'P'){ echo "Par Boiled";}else{ echo "Raw Rice"; } }?></td>
      <td><?php if(isset($bill_dtls->wqsc_no)){ 
         $sql = "SELECT a.kms_id,a.wqsc_no,b.sub_wqsc FROM td_wqsc a,td_wqsc_dtls b where a.id = b.trans_id and  a.wqsc_no ='$bill_dtls->wqsc_no' and  a.kms_id = '".$this->session->userdata['loggedin']['kms_id']."'";

        $row = $this->db->query($sql)->result();
                  foreach($row as $r){

                    echo $r->sub_wqsc.'</br></br>';

                  }

        }?></td>
      <td><?php if(isset($bill_dtls->paddy_cmr)){ echo $bill_dtls->paddy_cmr;}?></td>
      <td><?php if(isset($bill_dtls->paddy_qty)){ echo $bill_dtls->paddy_qty;}?></td>
      <td></td>
      <td><?php echo $bill_dtls->memo_no;?><br>(<?php if($bill_dtls->pool_type=="C"){echo "Central Pool"; } else{
             echo "State Pool";}?>)<br>Dated:-<br><?php echo date('d-m-Y', strtotime($bill_dtls->memo_dt)); ?></td>
      <td><?php if(isset($rate->per_unit)){ echo $rate->per_unit;}?></td>
      <td><?php if(isset($rate->per_unit)){ echo $rate->per_unit*$bill_dtls->paddy_cmr;}?></td>
      <td></td>
      <td><?php if(isset($rate->sgst_amt)){ echo $rate->sgst_amt;}?></td>
      <td><?php if(isset($rate->sgst_amt)){ echo $rate->sgst_amt;}?></td>
      <td><?php if(isset($rate->per_unit)){ echo $rate->per_unit*$bill_dtls->paddy_cmr+$rate->sgst_amt+$rate->sgst_amt;
                                                $total = $rate->per_unit*$bill_dtls->paddy_cmr+$rate->sgst_amt+$rate->sgst_amt;

      }?></td>
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
       <td>&nbsp;</td>
      <td>&nbsp;</td>
    </tr>

  </tbody>
</table>
    
    
  </div>
      <p align="justify" >Amount Rounded off: <strong><?php echo round($total);?> </strong><br>
                    Rupees in Words: <strong><?php echo getIndianCurrency(round($total));?></strong></p>
  
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
    <li>The sum of Rupees<strong> <?php echo round($total);?></strong> claimed in the bill has not been drawn previously </li>
    <li>The details as well as calculations as shown in the Bill have been checked with original documents and found correct </li>
    <li>Any amount found paid in excess at any subsequent date may be adjusted from future Claim. </li>
    <li>Proper noting have been kept to avoid double payment </li>
  </ul>
  
  
     <p>&nbsp;</p>
       <p style="float: right;"><strong>Signature of the Claimant with seal</strong></p>
       <p>&nbsp;</p>
                    <p ><strong>Required Documents:</strong></p>
        1.Voucher[Original], 2. Copy of Money Receipt ,3.Copy of GSTN no of miller,4. Stock flow statement of Paddy, 5. Stock flow statement of CMR , 6. Stock flow statement of gunny,[ In case milller not claimed GST, a certificate to this effect shall be attached]

<p><strong>N.B</strong>  Claim will summarily be rejected for payment for want of above noted requisite documents.</p>
  </div>



    </div>

                    <div style="text-align: center;">
    
                        <button class="btn btn-primary" type="button" onclick="printDiv();">Print</button>
    
                    </div>

                </div>

            
        </div>