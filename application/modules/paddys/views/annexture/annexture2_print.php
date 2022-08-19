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
  
  
  <table width="100%" border="0" cellspacing="0" cellpadding="0" class="table tableCus">
    <thead>
      <tr>
      <th colspan="5"> Claim Towards the cost of  Parboiled CMR(<?php if($bill_dtls->pool_type == 'C') { echo "CP";}else{
        echo "SP"; }?>)  Delivered to Food & Supplies Department For the KMS:<?php echo $this->session->userdata['loggedin']['kms_yr'];?></th>
      <?php $paddy_rate = 0 ;?>
    
      </tr>
       <tr>
      <th colspan="5">For the Value of  <?=$bill_dtls->tot_cmr?> Quintals    <?php if($bill_dtls->pool_type == 'C') { echo "CP";}else{
        echo "SP"; }?>   CMR delivery to if <?php if($bill_dtls->pool_type == 'C') { echo "Central Pool ";}else{
        echo "State Pool"; }?>,  <?php echo get_district_name($bill_dtls->dist); ?> by BENFED <?php echo get_district_name($bill_dtls->dist); ?> Branch under KMS:<?php echo $this->session->userdata['loggedin']['kms_yr'];?> CS No: <?=$bill_dtls->wqsc?></th>
     
      <?php  $mandi_labour_rate         = 0.00;
             $transportation_charge_cmr = 0.00;
             $gunny_charge_paddy        = 0.00;
             $transport_charge_paddy    = 0.00;
             $milling_charge            = 0.00;
             $subtotal                  = 0.00;

      foreach($particulas as $pa){

                    if($pa->account_type == 2){

                      $mandi_labour_rate = $pa->per_unit;
                    }elseif($pa->account_type == 11){

                       $transportation_charge_cmr = $pa->per_unit;
                    }elseif($pa->account_type == 12){

                        $gunny_charge_paddy = $pa->per_unit;
                    }elseif($pa->account_type == 3){

                      $transport_charge_paddy = $pa->per_unit;

                    }elseif($pa->account_type == 9){

                      $milling_charge  = $pa->per_unit;

                    }
                  
          }
      
        ?>
      </tr>
      <tr>
      <th>Sl No</th>
      <th>Particulars</th>
      <th>Quantity(Quiantals)</th>
      <th>Rate/ Quiantals(Rs)</th>
      <th>Total Amount(Rs)</th>
      
      </tr>
     </thead>
      <tbody>
      
    <tr>
      <td>1</td>
      <td>MSP</td>
      <td rowspan="10" style="text-align: center; "><?=$bill_dtls->tot_paddy;?></td>
      <td><?php echo get_paddy_price($this->session->userdata['loggedin']['kms_id']);
                $paddy_rate = get_paddy_price($this->session->userdata['loggedin']['kms_id']);
      ?></td>
      <td><?php echo round(($paddy_rate*$bill_dtls->tot_paddy),2); ?></td>
    </tr>
     <tr>
      <td>2</td>
      <td>Market Fee</td>
      
      <td>0.00</td>
      <td>0.00</td>
    </tr>
     <tr>
      <td>3</td>
      <td>Mandi Labour Charge</td>
     
      <td><?php echo $mandil_abour_rate->per_unit; ?></td>
      <td><?php echo round(($mandil_abour_rate->per_unit*$bill_dtls->tot_paddy),2); ?></td>
    </tr>
     <tr>
      <td>4</td>
      <td>Transport Charges For Paddy</td>
      <td><?php echo $transport_charge_paddy; ?></td>
      
      <td><?php echo round(($transport_charge_paddy*$bill_dtls->tot_paddy),2); ?></td>
    </tr>
     <tr>
      <td>5</td>
      <td>Additional Transport Charges for Paddy</td>
      <td></td>
      <td></td>
    </tr>
     <tr>
      <td>6</td>
      <td>Interest Charges</td>
      <td>0.00</td>
    
      <td>0.00</td>
    </tr>
     <tr>
      <td>7</td>
      <td>Draige</td>
      <td>0.00</td>
    
      <td>0.00</td>
    </tr>
     <tr>
      <td>8</td>
      <td>Commission to Society</td>
      <td><?php if(isset($comission_rate->rate)){ echo $comission_rate->rate;}?></td>
    
      <td><?php   $comisssion =0.00;


      if(isset($comission_rate->rate)){ echo ($comission_rate->rate*$bill_dtls->tot_paddy);
                          $comisssion =$comission_rate->rate*$bill_dtls->tot_paddy;
      }?></td>
    </tr>
     <tr>
      <td>9</td>
      <td>MIlling Charges Inclusive for GST</td>
      <td><?=$milling_charge?></td>
     
      <td><?php echo $milling_rate->total_amt+$milling_rate->cgst_amt+$milling_rate->sgst_amt;?></td>
    </tr>
   <tr>
      <td>10</td>
      <td>Administrative Charges</td>
      <td></td>
      
      <td></td>
    </tr>
    <tr>
      <td>11</td>
      <td colspan="3">Cost of paddy Milled </td>
    <td><?php echo round(($paddy_rate*$bill_dtls->tot_paddy+$mandil_abour_rate->per_unit*$bill_dtls->tot_paddy+$transport_charge_paddy*$bill_dtls->tot_paddy+$comisssion+$milling_rate->total_amt+$milling_rate->cgst_amt+$milling_rate->sgst_amt),2);
          $subtotal = round(($paddy_rate*$bill_dtls->tot_paddy+$mandil_abour_rate->per_unit*$bill_dtls->tot_paddy+$transport_charge_paddy*$bill_dtls->tot_paddy+$comisssion+$milling_rate->total_amt+$milling_rate->cgst_amt+$milling_rate->sgst_amt),2);

     ?></td>
    </tr>
    <tr>
      <td>12</td>
      <td colspan="4">Out Turn Ratio   <span style="float:right">68%</span></td>
     
    </tr>
     <tr>
      <td>13</td>
      <td>Sub Total of Common Parboiled Rice</td>
      <td></td>
      <td></td>
      <td></td>
    </tr>
     <tr>
      <td>14</td>
      <td>Gunny Usages Charges For Used Gunny Bags for Paddy Inclusive GST</td>
      <td rowspan="2"><?php echo $bill_dtls->tot_cmr;?></td>
      <td><?=$gunny_charge_paddy;?></td>
      <td><?php echo round($bill_dtls->tot_cmr*$gunny_charge_paddy,2);?></td>
    </tr>
     <tr>
      <td>15</td>
      <td>Transport Charge For CMR DELIVERY</td>
      <td><?=$transportation_charge_cmr?></td>
     
      <td><?php echo round($bill_dtls->tot_cmr*$transportation_charge_cmr,2);?></td>
    </tr>
     <tr>
      <td>16</td>
      <td>Acuitision Cost</td>
      <td></td>
      <td></td>
      <td></td>
    </tr>
     <tr>
      <td>17</td>
      <td>Less: BUtta Cut</td>
      <td></td>
      <td></td>
      <td><?php echo $bill_dtls->paddy_butta;?></td>
    </tr>
     <tr>
      <td>18</td>
      <td>Less: Gunny Cut</td>
      <td></td>
      <td></td>
      <td><?php echo $bill_dtls->gunny_cut;?></td>
    </tr>
     <tr>
      <td>19</td>
      <td>Total Claim</td>
      <td></td>
      <td></td>
      <td><?php echo round($subtotal+ $bill_dtls->tot_cmr*$gunny_charge_paddy+$bill_dtls->tot_cmr*$transportation_charge_cmr,2);
                 $value = $subtotal+ $bill_dtls->tot_cmr*$gunny_charge_paddy+$bill_dtls->tot_cmr*$transportation_charge_cmr;
      ?></td>
    </tr>
     <tr>
      <td>20</td>
      <td>Amount Rounded off:</td>
      <td></td>
      <td></td>
      <td><?php  echo $amount = round($subtotal+ $bill_dtls->tot_cmr*$gunny_charge_paddy+$bill_dtls->tot_cmr*$transportation_charge_cmr);

 //   echo round(abs($amount - $value),2); ?></td>
    </tr>
    <?php 
           $sum = 0;

 ?>
   
    
   </tbody>  
</table>
    <p align="justify" >Total:<strong> RS.  <?php echo $amount;?></strong> </p>
     <p align="justify" >Rupees in Words:<strong> <?php echo getIndianCurrency(round($amount));?></strong> </p>
  <p>&nbsp;</p>

  <table  width="100%" border="">
    <tr>
        <td width="25%" style="border: 1px solid #FFFFFF;padding: 0.5rem;">Preapred By Dealing Assistant</td>
        <td width="25%" style="border: 1px solid #FFFFFF;padding: 0.5rem;">Assistant Manager(Marketing)/DY Manager(Accounts)</td>
        <td width="25%" style="border: 1px solid #FFFFFF;padding: 0.5rem;">Dy Manager(Marketing)/Assistant Manager/Inspector of Cooperative Societies</td>
        <td width="25%" style="border: 1px solid #FFFFFF;padding: 0.5rem;">Manager(Accounts)</td>

    </tr>
  </table>
  <p>&nbsp;</p>
  <p>&nbsp;</p>
  <table  width="100%" border="">
    <tr>
        <td width="25%" style="border: 1px solid #FFFFFF;padding: 0.5rem;"></td>
        <td width="25%" style="border: 1px solid #FFFFFF;padding: 0.5rem;"></td>
        <td width="25%" style="border: 1px solid #FFFFFF;padding: 0.5rem;">Manager (Marketing)</td>
        <td width="25%" style="border: 1px solid #FFFFFF;padding: 0.5rem;">Chief Audit & Account Officer</td>

    </tr>
  </table>
  </div>
 <!--  <h2 align="right" >STATE / CENTRAL POOL </h2> -->
  
   <p style="float: right;"><strong>Signature of the Claimant with seal</strong></p>
</div>
    </div>

                    <div style="text-align: center;">
    
                        <button class="btn btn-primary" type="button" onclick="printDiv();">Print</button>
    
                    </div>

              

            
        </div>
    </div>