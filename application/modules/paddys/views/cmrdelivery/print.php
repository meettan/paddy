<script>

  function printDiv(divName) {
        var divToPrint = document.getElementById(divName);
        var stylesheet = '<?=base_url();?>assets/css/bootstrap.min.css';
        var popupWin = window.open('', '', 'width=1240,height=800');
        popupWin.document.open();
        console.log(stylesheet);
        popupWin.document.write('<html><body onload="window.print()">'+
            '<link rel="stylesheet" href="' + stylesheet + '">'+ divToPrint.innerHTML + '</html>');
        popupWin.document.close();
    }
  // function printDiv() {

  //       var divToPrint = document.getElementById('divToPrint');

  //       var WindowObject = window.open('', 'Print-Window');
  //       WindowObject.document.open();
  //       WindowObject.document.writeln('<!DOCTYPE html>');
  //       WindowObject.document.writeln('<html><head><title></title><style type="text/css">');


  //       WindowObject.document.writeln('@media print { .center { text-align: center;}' +
  //           '                                         .inline { display: inline; }' +
  //           '                                         .underline { text-decoration: underline; }' +
  //           '                                         .left { margin-left: 315px;} ' +
  //           '                                         .right { margin-right: 375px; display: inline; }' +
  //           '                                          table { border-collapse: collapse; font-size: 12px;}' +
  //           '                                          th, td { border: 1px solid black; border-collapse: collapse; padding: 6px;}' +
  //           '                                           th, td { }' +
  //           '                                         .border { border: 1px solid black; } ' +
  //           '                                         .bottom { bottom: 5px; width: 100%; position: fixed ' +
  //           '                                       ' +
  //           '                                   } } </style>');
  //       WindowObject.document.writeln('</head><body onload="window.print()">');
  //       WindowObject.document.writeln(divToPrint.innerHTML);
  //       WindowObject.document.writeln('</body></html>');
  //       WindowObject.document.close();
  //       setTimeout(function () {
  //           WindowObject.close();
  //       }, 10);

  // }
</script>




        <div class="wraper"> 

            <div class="col-lg-12 container contant-wraper">
                
                <div id="print">
<div style="text-align: center; max-width: 800px; margin: 0 auto; font-family: Arial;">
    <table width="100%" border="0" cellspacing="0" cellpadding="0">
  <tbody>
    <tr>
      <td align="center" valign="top" style="padding: 25px 0 15px 0;"><p style="margin: 0 0 15px 0; padding: 0;"><strong>Annexure-XXIX-A, </strong><strong><?Php echo $this->session->userdata['loggedin']['kms_yr'];?></strong></p>
        <p style="font-size: 22px; margin: 0 0 15px 0; padding: 0;"><strong>(OFFER FOR DELIVERY OF CMR) </strong></p></td>
    </tr>
    <tr>
      <td align="left" valign="top" style="padding:0 0 25px 0; font-size: 14px;"><p style="line-height: 25px; margin: 0 0 15px 0; padding: 0;">To</p>
         <div style="line-height: 25px; margin: 0 0 15px 0; padding: 0;">
          The District Controller, <br>
          Food and Supplies,<br>
          <div style="border-radius: 0; border-bottom: #333 solid 2px; padding:0 5px; display: inline-block; width: 150px;"><?php if(isset($this->session->userdata['loggedin']['branch_name'])){ echo $this->session->userdata['loggedin']['branch_name'];}?></div>
        </div>
        <p style="line-height: 21px; text-align: center; font-size:16px; margin: 0 0 10px 0; padding: 0;"><strong>(Through Sub-Inspector/Inspector ,F&amp;S)</strong></p>
        <p style="line-height: 21px; font-size:14px; margin:0 0 10px 0; padding: 0;">Sir, </p>
       <!--  <p style="line-height: 21px; font-size:14px; margin: 0 0 15px 0; padding: 0;"> -->
       <div style="line-height: 21px; font-size:14px; margin: 0 0 15px 0; padding: 0;">
          I,
         <div style="border-radius: 0; border-bottom: #333 solid 2px; padding:0 5px; display: inline-block; width: 300px;"><?php if(isset($this->session->userdata['loggedin']['br_manager'])){ echo $this->session->userdata['loggedin']['br_manager'];}?></div> 
   <!--  <div style="border-radius: 0; border-bottom: #333 solid 2px; padding:0 5px; display: inline-block; width: 150px;"></div> -->
          , the authorised officer of</div>
        <div style="line-height: 21px; font-size:14px; margin: 0 0 15px 0; padding: 0;">
    <div style="border-radius: 0; border-bottom: #333 solid 2px; padding:0 5px; display: inline-block; width: 150px;">Benfed</div> 
          , CMR agency state as follows:</div>

      <div style="line-height: 21px; font-size:14px; margin: 0 0 17px 0;"> 1) That a quantity of 
         
    <div style="border-radius: 0; border-bottom: #333 solid 2px; padding:0 5px; display: inline-block; width: 150px;"><?php echo ($cmrdelivery_dtls->progressive_paddy_received )*0.1; ?></div>
       MT of common variety of paddy have been purchased by </div>

       <div style="line-height: 21px; font-size:14px; margin: 0 0 22px 0;  ">
         <label style="display: block; padding-bottom: ;"> the CMR agency through PACS(<?php echo $cmrdelivery_dtls->soc_name;?>) from the farmers at MSP by making </label>
          <label style="display: block; padding-bottom: 10px;"> payment to the farmers through <?php if($cmrdelivery_dtls->trans_dt >= "2020-04-01"){ echo "NEFT"; }else{ echo "A/C payee cheques"; }?>  during the KMS <?Php echo $this->session->userdata['loggedin']['kms_yr'];?></label>
          <div style="line-height: 21px; font-size:14px; margin: 0 0 15px 0; padding: 0 0 0 0;"> 
       
          and delivered 
          
        <div style="border-radius: 0; border-bottom: #333 solid 2px; padding:0 5px; display: inline-block; width: 150px;"><?php echo ($cmrdelivery_dtls->progressive_paddy_received)*0.1; ?></div>
          MT paddy to
         
        <div style="border-radius: 0; border-bottom: #333 solid 2px; padding:0 5px; display: inline-block; width: 380px;"><?php echo $cmrdelivery_dtls->mill_name;?></div>
          ,</div>
     <div style="line-height: 21px; font-size:14px; margin:0; padding: 0 0 0 0;">   upto  
    <div style="border-radius: 0; border-bottom: #333 solid 2px; padding:0 5px; display: inline-block; width: 150px;"><?php echo date('d/m/Y',strtotime($cmrdelivery_dtls->trans_dt)); ?></div>
          for custom milling of paddy.</div></div>


           <div style="line-height: 21px; font-size:14px; padding: 0 0 22px 0;">
      <label style="display: block; padding-bottom: 10px;">2) That the aforesaid rice mill has milled 
          <div style="border-radius: 0; border-bottom: #333 solid 2px; padding:0 5px; display: inline-block; width: 150px;"><?php echo ($cmrdelivery_dtls->milled)*0.1; ?></div>
          MT paddy(cumulative) out of <div style="border-radius: 0; border-bottom: #333 solid 2px; padding:0 5px; display: inline-block; width: 150px;"><?php echo ($cmrdelivery_dtls->progressive_paddy_received)*0.1; ?></div></label> 
          <label style="display: block; padding-bottom: 10px;">
          MT delivered paddy upto 
          <div style="border-radius: 0; border-bottom: #333 solid 2px; padding:0 5px; display: inline-block; width: 150px;"><?php echo date('d/m/Y',strtotime($cmrdelivery_dtls->trans_dt)); ?></div>
          and produced
          <div style="border-radius: 0; border-bottom: #333 solid 2px; padding:0 5px; display: inline-block; width: 150px;"><?php echo ($cmrdelivery_dtls->cmr_offered_now)*0.1; ?></div>
          MT common </label>
          <label style="display: block; padding-bottom: 10px;">parboiled/ raw rice as CMR. Out of that 
          <div style="border-radius: 0; border-bottom: #333 solid 2px; padding:0 5px; display: inline-block; width: 150px;"><?php echo ($cmrdelivery_dtls->cmr_offered_now)*0.1; ?></div>
MT common parboiled / raw rice 
          produced by the mill,</label> 
          <div style="border-radius: 0; border-bottom: #333 solid 2px; padding:0 5px; display: inline-block; width: 150px;"><?php echo ($tot_delivery->tot_delivery)*0.1; ?></div>
MT has already been delivered and
<div style="border-radius: 0; border-bottom: #333 solid 2px; padding:0 5px; display: inline-block; width: 150px;"><?php echo round(((($cmrdelivery_dtls->cmr_offered_now)-($tot_delivery->tot_delivery))*0.1),4); ?></div>
MT is left 
          to be delivered.</div>

        <div style="line-height: 21px; font-size:14px; margin: 0 0 2px 0; padding: 0 0 19px 0;">3) That the rice mill is maintaining books of accounts related to custom milling of paddy on 
          behalf of agency properly.</div>


             <div style="line-height: 21px; font-size:14px; margin: 0 0 2px 0; padding: 0 0 19px 0;">4) That the aforesaid quantum of CMR i.e. 
          <div style="border-radius: 0; border-bottom: #333 solid 2px; padding:0 5px; display: inline-block; width: 150px;"><?php echo round(((($cmrdelivery_dtls->cmr_offered_now)-($tot_delivery->tot_delivery))*0.1),4); ?></div>
MT is ready for delivery. </div>

       <p style="line-height: 21px; font-size:14px; margin: 0 0 2px 0; padding: 0 0 19px 0;">5) That copies of Muster Roll and M.S.P. certificate are enclosed. </p>
        
        <p style="line-height: 21px; font-size:14px; margin: 0 0 22px 0; padding: 0;">  <em>You are requested to issue delivery order to enable the agency for delivery of aforesaid <br>
        quantity of CMR to State/FCI A/C.</em></p>
         <div style="background: #f6f8f9; padding: 15px; border: #eee solid 1px;"> <h2 style="line-height: 21px; font-size:17px; margin: 0 0 15px 0; padding:0; text-transform: uppercase; text-align: center">Progressive Statement Of Paddy &amp; CMR by Rice Mill</h2>
          <table width="100%" border="1" cellspacing="0" cellpadding="2">
            <tbody>
              <tr>
                <td style="padding: 3px 5px; font-size: 14px; font-weight: 600;">Agency</td>
                <td style="padding: 3px 5px; font-size: 14px; font-weight: 600;">Paddy Received</td>
                <td style="padding: 3px 5px; font-size: 14px; font-weight: 600;">Resultant CMR</td>
                <td style="padding: 3px 5px; font-size: 14px; font-weight: 600;">Progressive Offer</td>
                <td style="padding: 3px 5px; font-size: 14px; font-weight: 600;">CMR Delivered</td>
                <td style="padding: 3px 5px; font-size: 14px; font-weight: 600;">Due CMR</td>
              </tr>
              <tr>
                <td style="padding: 3px 5px; font-size: 13px;"><?php echo $cmrdelivery_dtls->mill_name;?> </td>
                <td><?php echo ($cmrdelivery_dtls->progressive_paddy_received)*0.1; ?> MT</td>
                <td><?php  $datas=0;
                       $where      =   array(
            "sl_no"  => ($cmrdelivery_dtls->rice_type == 'P')? 18 : 19);

        $data = $this->Paddy->f_get_particulars("md_parameters", array("param_value"), $where, 1);
                   $datas=((($cmrdelivery_dtls->progressive_paddy_received)*($data->param_value))/100)*0.1; 
                   echo round($datas,4);
                    ?> MT</td>
                <td><?php echo ($cmrdelivery_dtls->cmr_offered_now)*0.1; ?> MT</td>
                <td><?php echo ($tot_delivery->tot_delivery)*0.1; ?> MT</td>
                <td><?php echo round(((($cmrdelivery_dtls->cmr_offered_now)-($tot_delivery->tot_delivery))*0.1),4); ?> MT</td>
              </tr>
            </tbody>
          </table>
             </div>
          <p style="line-height: 21px; font-size:18px; margin: 0 0 15px 0; padding:0; text-transform: uppercase; text-align: center">&nbsp;</p>
        <p style="line-height: 21px; font-size:14px; margin: 0 0 15px 0; padding: 0;float: right;">
          <strong>Yours faithfully,</strong><br>
          <strong>Authorised Officer of </strong><br>
        <!--   <img src="images/signeture.jpg" width="208" height="39" alt=""/> --><br>
          <strong>BENFED.</strong></p></td>
    </tr>
    <tr>
      <td align="left" valign="top">&nbsp;</td>
    </tr>
    <tr>
      <td align="left" valign="top">&nbsp;</td>
    </tr>
   <!--  <tr>
      <td align="left" valign="top">&nbsp;</td>
    </tr> -->
  </tbody>
</table>

</div>                  
                </div>   
                
                <div style="text-align: center;">

                    <button class="btn btn-primary" type="button" onclick="printDiv('print')">Print</button>
                 <!--    <button class="btn btn-primary" type="button" id="btnExport">Excel</button> -->

                </div>

            </div>
            
        </div>
        
    
     <script type="text/javascript">



    $(document).ready(function(){

        var i = 0;

        $('#block').change(function(){

            $.get( 

                '<?php echo site_url("paddy/societies");?>',

                { 

                    block: $(this).val()

                }

            ).done(function(data){

                var string = '<option value="">Select</option>';

                $.each(JSON.parse(data), function( index, value ) {

                    string += '<option value="' + value.sl_no + '">' + value.soc_name + '</option>'

                });

                $('#soc_name').html(string);

            });

        });

        $('#soc_name').change(function(){

         var block_name = $("#block option:selected" ).text();
         $('#block_n').html(block_name);

         var society_name = $("#soc_name option:selected" ).text();
         $('#soc_n').html(society_name);
         
        })

    });
// start of doc ready.
   $("#soc_name").change(function(e){
     // e.preventDefault();  // stops the jump when an anchor clicked.
      var soc_id = $(this).val(); // anchors do have text not values.
      console.log(soc_id);
      $.ajax({
        url: '<?php echo base_url();?>index.php/paddys/transactions/f_connected_mill_society',
        data: {'soc_id': soc_id}, // change this to send js object
        type: "post",
        dataType: 'json',
        success: function(data){
          
           $("#mill_id").find('option').remove();
           $('#mill_id').append(data.html);
          
        }
      });
   });
        $(function () {
            $("#btnExport").click(function () {
                $("#print").table2excel({
                    filename: "OFFER_For_Delivery_Of_CMR_of_<?php echo get_society_name($this->input->post('soc_name'));?>.xls"
                });
            });
        });
    </script>