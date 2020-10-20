    <div class="wraper">      
    <input type="button" class="btn btn-danger" onclick="printDiv('print_emp')" value="Print" style="float:right">

    <div class="col-md-12 container form-wraper" style="" id="print_emp">
	<div class="form-group row">
  
</div>

	<div class="form-group row">
    <div class="col-sm-1">Block :</div>
	

	<div class="col-sm-2">
	  <?php  foreach($farmer_dtls as $farme);
	  
	  if(isset($farme->block_name)){ echo $farme->block_name; }?>  
		

	</div>
    <div class="col-sm-1">Society :</div>
	

	<div class="col-sm-4">
	<?php
	  if(isset($farme->soc_name)){ echo $farme->soc_name; }?>  

	</div>
	<div class="col-sm-2">Transaction Date:</div>
	<div class="col-sm-2"><?php echo date('d-m-Y', strtotime($farme->trans_dt)); ?></div>
  
    
</div>
        
	<table class="table table-bordered table-hover" id="farmers">
            <thead><tr><th>Sl. No.</th><th>Name</th><th>Registration No.</th><th>Quantity(Quintal)</th><th>Amount</th><th>Cheque No</th><th>Cheque Date</th></tr></thead><tbody id="farme"> 
         
            <tbody> 
            <?php 
                $count=0;
            foreach($farmer_dtls as $farmer_dtl) { ?>
            <tr><td ><?=++$count;?></td><td><?=get_farmer_name($this->session->userdata['loggedin']['kms_id'],$farmer_dtl->reg_no)?></td><td><?=$farmer_dtl->reg_no?><input type="hidden" value="<?=$farmer_dtl->reg_no?>" name="reg_no[]"></td><td><?=$farmer_dtl->quantity?> </td><td><?=$farmer_dtl->amount?></td><td><?=$farmer_dtl->cheque_no?></td><td><?=$farmer_dtl->cheque_date?></td></tr>
            
            <?php } ?>
            
            </tbody>
            </table>
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
