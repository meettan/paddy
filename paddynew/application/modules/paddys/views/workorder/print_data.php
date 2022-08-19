    <div class="wraper">      
    <input type="button" class="btn btn-danger" onclick="printDiv('print_emp')" value="Print" style="float:right">

    <div class="col-md-12 container form-wraper" style="height:1600px;" id="print_emp">
        
    <div style="width: 100%; height: 842px; padding-top:142px;">
		<table width="100%" border="0" cellspacing="0" cellpadding="0">
		<tbody>
		<tr>
		<td style="text-align: left; padding: 10px 10px 25px 10px; font-family: arial; font-size: 15px;">
			<table width="100%" border="0" cellspacing="0" cellpadding="0">
  <tbody>
    <tr>
      <td width="80%" valign="top"><p style="margin: 0; padding: 0; line-height: 18px;">Ref. No. <strong style="text-transform: uppercase;"><?=$workorder_dtls->pre_order_no;?><?=$workorder_dtls->order_no;?></strong></p></td>
      <td valign="top"><p style="margin: 0; padding: 0; line-height: 18px;">Date: <strong><?php echo date('d/m/Y',strtotime($workorder_dtls->trans_dt)); ?></strong></p></td>
    </tr>
    <tr>
      <td width="30%" valign="top" style="padding-top: 22px;"><p style="margin: 0; padding: 0; line-height: 20px;">To	<br>
								   	
	The Chairman/Special/Manager,<br>

<strong><?php echo $workorder_dtls->soc_name;?></strong></p></td>
      <td valign="top">&nbsp;</td>
    </tr>
  </tbody>
</table>
</td>
		</tr>
		<tr>
		<td style="text-align: center; padding: 10px; font-family: arial; font-size: 15px; border-bottom:#eee8e8 solid 1px; border-top:#eee8e8 solid 1px; background: #eee;">
			<p style="margin: 0; padding: 0; line-height: 22px; font-size: 17px;"><strong>Subject:</strong> Work Order in respect of Procurement of Paddy for the KMS: <?php if(isset($this->session->userdata['loggedin']['kms_yr'])){ echo $this->session->userdata['loggedin']['kms_yr'];}?> through BENFED, <strong><?php if(isset($this->session->userdata['loggedin']['branch_name'])){ echo $this->session->userdata['loggedin']['branch_name'];}?></strong></p></td>
		</tr>
		<tr>
		<td style="text-align: left; padding: 10px 10px 10px 10px; font-family: arial; font-size: 15px;"><p style="font-size: 15px; line-height: 20px; 
			margin: 0 0 20px 0; padding: 0;">Madam/ Dear Sir, <br><br>

In reference of the Notification and instructions of the Food & Supplies Department, Government of West Bengal and tripartite agreement executed by your Cooperative Society, you are requested to procure FAQ paddy of common variety under the Decentralized Procurement operation of the Government under KMS: <?php if(isset($this->session->userdata['loggedin']['kms_yr'])){ echo $this->session->userdata['loggedin']['kms_yr'];}?>. FAQ paddy is to be procured at MSP <em>i.e. </em>Rs. <strong><?php if(isset($workorder_dtls->per_qui_rate)){ echo $workorder_dtls->per_qui_rate; }?>/quintal</strong> from your members and general farmers upto the quantity of <strong><?php echo $workorder_dtls->paddy_qty;?></strong> Quintal by organization of camps and paddy thus procured is to be delivered to authorized representative of  <strong><?php echo $workorder_dtls->mill_name;?></strong> at the purchase camp. The MSP would be paid by BENFED to the farmers by NEFT.</p>
		  <p style="font-size: 15px; line-height: 20px; font-size:15px; margin:0 0 15px 0; padding: 0;"><strong>The following terms and condition should strictly be adhered to in respect of paddy procurement:- </strong></p>
		  <ol style="margin: 0; padding: 0 0 0 15px;">
		    <li style="padding: 0 0 10px 0; margin: 0; font-size: 15px;">The entire procurement operation would be guided by the instructions of the Government and provisions of the tripartite agreement executed.<strong> Society must be sure about the paddy sellers being genuine farmers.</strong></li>
		    <li style="padding: 0 0 10px 0; margin: 0; font-size: 15px;">As advised by the Food & Supplies department, Govt. of West Bengal, each farmer can sell a maximum of <strong>45 quintal paddy during the entire KMS including all centers i.e. CPCs, Societies, Farmers Producer Company, Self Help Group.</strong></li>
		    <li style="padding: 0 0 10px 0; margin: 0; font-size: 15px;"><strong>BENFED district office must be informed at least TEN DAYS before the conduct of the camp so that the details of the camp be entered by BENFED</strong> in the procurement portal,<strong> failing which procurement data entry would not be possible by the Society.</strong></li>
		    <li style="padding: 0 0 10px 0; margin: 0; font-size: 15px;"><strong>Intense publicity prior to the conduct</strong> of the procurement camp must be done by means of <strong>display board/ banner (depicting Society name, BENFED’s name, camp date, place, MSP, FAQ)</strong> at the camp site and other prominent places,<strong> mobile miking</strong> etc.</li>
		    <li style="padding: 0 0 10px 0; margin: 0; font-size: 15px;">Society must <strong>inform in writing at least seven days before organization of the procurement camp</strong> to the concerned Block Development Officer, local Police Station, Block Inspector of Co-operative Societies, Inspector (F&S), Gram Panchayat and other concerned parties in respect of procurement of Paddy.</li>
		    <li style="padding: 0 0 10px 0; margin: 0; font-size: 15px;">Society must <strong>maintain a Register</strong> for recording farmer’s name, farmer’s Identification Number (AADHAAR and Electors Photo Identity Card), Registration Number & procurement detail and also <strong>preserve photocopy</strong> of AADHAAR, Electors Photo Identity Card (EPIC), Bank passbook, land documents duly certified by the farmer, originals of Annexure I or II of the Procurement Order, if applicable. </li>
		    <li style="padding: 0 0 10px 0; margin: 0; font-size: 15px;">Society has to take utmost care to enter <strong>only THE CORRECT procurement related information</strong> (AADHAAR and EPIC number, Bank Account number, paddy quantum purchased) in the online ePaddy Procurement Portal by logging into <strong>https://procurement.wbfood.in</strong> by means of the user ID and password provided by the Food & Supplies Department <strong>so that further rectification need not be done.</strong> AADHAAR, EPIC and Bank Passbook <strong>must be verified for entering the correct data Password must be kept as secret and changed at regular interval</strong>through mobile OTP authentication.</li>
		    <li style="padding: 0 0 10px 0; margin: 0; font-size: 15px;">Society has to issue <strong>Registration Certificate after printing</strong> the same, <strong>write paddy procurement details on the reverse side</strong> and <strong>provide Procurement Receipt</strong> to the beneficiary farmers immediately after procurement of Paddy.</li>
		    <li style="padding: 0 0 10px 0; margin: 0; font-size: 15px;">Society has to <strong>record and preserve the result of quality analysis of paddy</strong> procured from the farmers.</li>
            <li style="padding: 0 0 10px 0; margin: 0; font-size: 15px;"><strong>Muster Roll is to be prepared in triplicate and signed, uploaded in the portal on the day of procurement</strong> and hard copies submitted to BENFED district office.</li>
			<li style="padding: 0 0 10px 0; margin: 0; font-size: 15px;">Paddy thus procured should be delivered to Rice Mill through issuance of proper Paddy Challan and a certificate on <strong>proof of received Paddy</strong> duly signed by the appropriate authority is required to submit to BENFED. </li>
			<li style="padding: 0 0 10px 0; margin: 0; font-size: 15px;">In view of the <strong>COVID-19 pandemic situation,</strong> the society would take <strong>necessary precautionary measures at the procurement camps</strong> as per government instructions. These would include giving <strong>awareness message, maintenance of physical distancing,</strong> arrangement of adequate <strong>face mask,</strong> hand sanitizer, <strong>hand wash/ soap</strong> etc. at the site of the camp. </li>
			   
		 </ol>
		  <p style="line-height: 20px; margin: 0; padding: 0;">If you do not agree with above mentioned terms and condition, along with the quote for procurement of Paddy in your favor, please inform in writing to the undersigned within a week from the date of issue of the work order, so that quota allotted in your favour can be reallocated to other interested Co-operative Societies. Treat the matter as extremely urgent and do the needful. Receipt of the work order be acknowledged.</p></td>
		</tr>
		</tr>
		<tr>
		<td style="text-align: left; padding: 35px 10px 5px 10px; font-family: arial; font-size: 15px; "><table width="100%" border="0" cellspacing="0" cellpadding="0">
		  <tbody>
		    <tr>
		      <td width="80%" valign="bottom"><p style="margin: 0; padding: 0; line-height: 20px; font-size: 15px;">
			  Memo. No. <strong style="text-transform: uppercase;"><?=$workorder_dtls->pre_order_no;?><?=$workorder_dtls->order_no;?>(4)</strong><br></p></td>


		      <td valign="top"><p style="margin: 0; padding: 0; font-size: 15px; line-height: 20px;">District Manager <br>
		       BENFED, <strong><?php if(isset($this->session->userdata['loggedin']['branch_name'])){ echo $this->session->userdata['loggedin']['branch_name'];}?></strong> Branch. <br>
		      
Date: <strong><?php echo date('d/m/Y',strtotime($workorder_dtls->trans_dt)); ?></strong></p></td>
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
		       <li style="padding: 0 0 10px 0; margin: 0; font-size: 15px;">The Block Development Officer,<?php echo get_block_name($workorder_dtls->block);?> development block</li>

		        <li style="padding: 0 0 10px 0; margin: 0; font-size: 15px;">Sri/ Smt. ______________________________________,<?php echo $workorder_dtls->mill_name;?>. S/he is requested to supply the required equipment, remain present or send authorized representative at the procurement camp and arrange to receive the paddy procured on the day itself from the camp to the tagged rice mill and extend necessary cooperation to the procuring Cooperative Society such that social distancing and other safety measures may be taken. The paddy received must be accepted online by logging into the ePaddy Procurement portal within 24 hours from the date of occurrence of the camp and physical receipt of paddy. Also s/he is requested to mill paddy as per Government instruction and tripartite agreement so that ‘Offer’ and ‘Delivery’ of the entire resultant CMR is completed within the stipulated time.</li>
	      </ol>
	     <!--  <p style="line-height: 20px; font-size: 15px; margin: 0; padding: 0;">Sri/ Smt. ______________________________________,<?php echo $workorder_dtls->mill_name;?>. He/She is requested to supply the required equipment, remain present or send authorized representative at the procurement camp and arrange to receive the paddy procured on the day itself from the camp to your tagged rice mill. Also you are requested to mill paddy as per Government instruction and tripartite agreement so that &#8216;Offer&#8217; and &#8216;Delivery&#8217; of the entire resultant CMR is completed within the stipulated time.</p> -->




	  </td>
		</tr>
		<tr>
		  <td style="text-align: left	; padding: 35px 10px 10px 10px; font-family: arial; font-size: 15px;"><table width="100%" border="0" cellspacing="0" cellpadding="0">
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
