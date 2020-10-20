    <div class="wraper">      
    <input type="button" class="btn btn-danger" onclick="printDiv('print_emp')" value="Print" style="float:right">

    <div class="col-md-12 container form-wraper" style="height:1400px;" id="print_emp">
        
    <div style="width: 100%; height: 842px; padding-top:180px;">
		<table width="100%" border="0" cellspacing="0" cellpadding="0">
		<tbody>
		<tr>
		<td style="text-align: left; padding: 10px 10px 25px 10px; font-family: arial; font-size: 15px;">
			<table width="100%" border="0" cellspacing="0" cellpadding="0">
  <tbody>
    <tr>
      <td width="80%" valign="top"><p style="margin: 0; padding: 0; line-height: 18px;">Ref. No. <strong><?=$workorder_dtls->pre_order_no;?><?=$workorder_dtls->order_no;?></strong></p></td>
      <td valign="top"><p style="margin: 0; padding: 0; line-height: 18px;">Date: <strong><?php echo date('d/m/Y',strtotime($workorder_dtls->trans_dt)); ?></strong></p></td>
    </tr>
    <tr>
      <td width="30%" valign="top" style="padding-top: 25px;"><p style="margin: 0; padding: 0; line-height: 20px;">To	<br>
								   	
The Chairman/Secretary/Manager,<br>

<strong><?php echo $workorder_dtls->soc_name;?></strong></p></td>
      <td valign="top">&nbsp;</td>
    </tr>
  </tbody>
</table>
</td>
		</tr>
		<tr>
		<td style="text-align: center; padding: 10px; font-family: arial; font-size: 15px; border-bottom:#eee8e8 solid 1px; border-top:#eee8e8 solid 1px; background: #eee;">
			<p style="margin: 0; padding: 0; line-height: 22px; font-size: 17px;"><strong>Subject:</strong> Work Order in respect of Procurement of Paddy for the KMS: 2019-20 through BENFED, <strong><?php if(isset($this->session->userdata['loggedin']['branch_name'])){ echo $this->session->userdata['loggedin']['branch_name'];}?></strong></p></td>
		</tr>
		<tr>
		<td style="text-align: left; padding: 10px 10px 10px 10px; font-family: arial; font-size: 15px;"><p style="font-size: 15px; line-height: 20px; 
			margin: 0 0 20px 0; padding: 0;">Madam/ Dear Sir, <br><br>

		  In reference of the Notification and instructions of the Food & Supplies Department, Government of West Bengal and tripartite agreement executed by your Cooperative Society, you are requested to procure paddy under the Decentralized Procurement operation of the Government under KMS: 2019-20. FAQ paddy is to be procured at MSP <em>i.e. </em>Rs. <strong>1815/quintal</strong> from your members and general farmers for an approximate quantity of <strong><?php echo $workorder_dtls->paddy_qty;?></strong> Quintal by organization of camps and paddy thus procured is to be delivered to authorized representative of <strong><?php echo $workorder_dtls->mill_name;?></strong> at the purchase camp.</p>
		  <p style="font-size: 15px; line-height: 20px; font-size:15px; margin:0 0 15px 0; padding: 0;"><strong>The following terms and condition should strictly be adhered to in respect of paddy procurement:- </strong></p>
		  <ol style="margin: 0; padding: 0 0 0 15px;">
		    <li style="padding: 0 0 10px 0; margin: 0; font-size: 15px;">Society has to register farmers and enter procurement related information by using procurement software, which can be download from <a href="https://download.wbfood.in" ><u>https://download.wbfood.in</u></a><strong> </strong><strong> </strong></li>
		    <li style="padding: 0 0 10px 0; margin: 0; font-size: 15px;">As advised by the Food & Supplies department, Govt. of West Bengal, Society can procure maximum <strong>45 quintal paddy from each farmer</strong> in KMS: <?php if(isset($this->session->userdata['loggedin']['kms_yr'])){ echo $this->session->userdata['loggedin']['kms_yr'];}?>. </li>
		    <li style="padding: 0 0 10px 0; margin: 0; font-size: 15px;">The entire procurement operation would be guided by the instructions of the Government and provisions of the tripartite agreement executed. </li>
		    <li style="padding: 0 0 10px 0; margin: 0; font-size: 15px;">Muster Roll is to be prepared and signed and submitted to BENFED for payment. </li>
		    <li style="padding: 0 0 10px 0; margin: 0; font-size: 15px;">Society has to issue Registration Certificate after farmer registration and Procurement receipt to the beneficiary immediately after procurement of Paddy. </li>
		    <li style="padding: 0 0 10px 0; margin: 0; font-size: 15px;">The Society would sign the &#8216;Mandate for payment of cheque&#8217; along with other signatories. </li>
		    <li style="padding: 0 0 10px 0; margin: 0; font-size: 15px;">Paddy thus procured should be delivered to Rice Mill through issuance of proper Paddy Challan and a certified on <strong>proof of received Paddy</strong> duly signed by the appropriate authority is required to submit to BENFED. </li>
		    <li style="padding: 0 0 10px 0; margin: 0; font-size: 15px;">Participating Society must inform at least a week before organization of the procurement camp to the concerned Block Development Officer, Block Inspector of Co-operative Societies, Inspector (F&S), BENFED district office and other concerned parties in respect of procurement of Paddy, and society must maintain a register for farmer&#8217;s Identification card, photocopy of Bank passbook duly certified by A/c holder, and land documents, Annexure I & II whichever is applicable. <strong>Proper advertising of the procurement Camp would be done by the Societies.</strong></li>
	      </ol>
		  <p style="line-height: 20px; margin: 0; padding: 0;">If you do not agree with above mentioned terms and condition, along with the quote for procurement of Paddy in your favor, please inform in writing to the undersigned within a week from the date of issue of the work order, so that quota allotted in your favour can be diverted of other interested Co-Operative Societies. Treat the matter as extremely urgent and do the needful. Receipt of the work order is acknowledged.</p></td>
		</tr>
		</tr>
		<tr>
		<td style="text-align: left; padding: 59px 10px 5px 10px; font-family: arial; font-size: 15px; "><table width="100%" border="0" cellspacing="0" cellpadding="0">
		  <tbody>
		    <tr>
		      <td width="80%" valign="bottom"><p style="margin: 0; padding: 0; line-height: 20px; font-size: 15px;">
			  Ref. No. <strong><?=$workorder_dtls->pre_order_no;?><?=$workorder_dtls->order_no;?></strong><br></p></td>


		      <td valign="top"><p style="margin: 0; padding: 0; font-size: 15px; line-height: 20px;">District Manager <br>
		       BENFED, <strong><?php if(isset($this->session->userdata['loggedin']['branch_name'])){ echo $this->session->userdata['loggedin']['branch_name'];}?></strong> Branch. <br>
		      
Date: </p>		        </td>
		      </tr>
			  <tr>
		      <td width="80%" valign="top" style="padding-bottom: 5px;"><p style="margin: 0; padding: 0; line-height: 20px; font-size: 15px;">
			  
			  
			  </td>


		      <td valign="top"><p style="margin: 0; padding: 0; font-size: 15px; line-height: 20px;">	   </td>
		      </tr>
		    </tbody>
		  </table></td>
		</tr>	
		</tr>
		<tr>
		<td style="text-align: left; padding: 10px; font-family: arial; font-size: 15px;">
		  <p style="line-height: 20px; margin: 0; 
			padding: 0 0 8px 0;"><strong>Copy Forwarded for kind information and necessary action to:-</strong></p>
	      <ol style="margin: 0; padding: 0 0 0 15px;">
		      <li style="padding: 0 0 10px 0; margin: 0; font-size: 15px;">The Deputy/ Assistant Registrar of Cooperative Societies, <strong><?php if(isset($this->session->userdata['loggedin']['branch_name'])){ echo $this->session->userdata['loggedin']['branch_name'];}?></strong> Range.&#9; </li>
		      <li style="padding: 0 0 10px 0; margin: 0; font-size: 15px;">The District Controller of Food & Supplies, <strong><?php if(isset($this->session->userdata['loggedin']['branch_name'])){ echo $this->session->userdata['loggedin']['branch_name'];}?></strong> district </li>
	      </ol>
	      <p style="line-height: 20px; font-size: 15px; margin: 0; padding: 0;">Sri/ Smt. ______________________________________,<?php echo $workorder_dtls->mill_name;?>. He/She is requested to supply the required equipment, remain present or send authorized representative at the procurement camp and arrange to receive the paddy procured on the day itself from the camp to your tagged rice mill. Also you are requested to mill paddy as per Government instruction and tripartite agreement so that &#8216;Offer&#8217; and &#8216;Delivery&#8217; of the entire resultant CMR is completed within the stipulated time.</p></td>
		</tr>
		<tr>
		  <td style="text-align: left	; padding: 59px 10px 10px 10px; font-family: arial; font-size: 15px;"><table width="100%" border="0" cellspacing="0" cellpadding="0">
		    <tbody>
		      <tr>
		        <td width="80%" valign="top" style="padding-bottom: 25px;"><p style="margin: 0; padding: 0; line-height: 20px; font-size: 15px;">&nbsp;</p></td>
		        <td valign="top"><p style="margin: 0; padding: 0; font-size: 15px; line-height: 20px;">District Manager<br>
		           BENFED, <strong><?php if(isset($this->session->userdata['loggedin']['branch_name'])){ echo $this->session->userdata['loggedin']['branch_name'];}?></strong> Branch. </p></td>
	          </tr>
	        </tbody>
	      </table>		   </td>
		  </tr>	
		</tbody>
		</table>
	</div>

    </div>
       

    </div>    



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



</script>
