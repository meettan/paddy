    <div class="wraper">      
        <div class="col-md-3"></div>
        <div class="col-md-6 container form-wraper">   

            <form method="POST" id="form"
                action="<?php echo site_url("paddys/transactions/f_workorder_edit");?>" >

                <div class="form-header">
                
                    <h4>Workorder Edit</h4>
                
                </div>

                <input type="hidden"
                        name = "order_no"
                        id   = "order_no"
                        value="<?php echo $workorder_dtls->order_no;?>/<?php echo $workorder_dtls->branch_id;?>/<?php echo $workorder_dtls->kms_year;?>"
                    />

                <div class="form-group row">

                    <label for="block" class="col-sm-2 col-form-label">Block:</label>

                    <div class="col-sm-4">

                        <select name="block" id="block" class="form-control required" disabled>
 
                        <option value="">Select</option> 

                        <?php foreach($blocks as $block) {?> 
                       <option value="<?php if(isset($block->blockcode)){ echo $block->blockcode;}?>" <?php if($block->blockcode==$workorder_dtls->block){ echo "selected";}?>><?php if(isset($block->block_name)){ echo $block->block_name;}?></option>  
                        <?php } ?>      

                        </select>

                    </div>
                    <label for="trans_dt" class="col-sm-2 col-form-label">Date:</label>

                     <div class="col-sm-4">

                       <input type="date"  class="form-control required"  
                       name="trans_dt"  id="trans_dt" value="<?php echo $workorder_dtls->trans_dt;?>" />
                      </div>

                </div>    

                <div class="form-group row">

                    <label for="soc_name" class="col-sm-2 col-form-label">Society Name:</label>
                    <div class="col-sm-10">

                        <select name="soc_name" class="form-control" id="soc_name" disabled>

                            <option value="">Select</option>    

                            <?php foreach($society_dtls as $society_dtl) {?> 
                       <option value="<?php if(isset($society_dtl->sl_no)){ echo $society_dtl->sl_no;}?>" <?php if($society_dtl->sl_no==$workorder_dtls->soc_id){ echo "selected";}?>><?php if(isset($society_dtl->soc_name)){ echo $society_dtl->soc_name;}?></option>  
                        <?php } ?>     

                        </select>    

                    </div>

                </div> 

                <div class="form-group row">

                    <label for="mills" class="col-sm-2 col-form-label">Mill Names:</label>

                    <div class="col-sm-10">

                    <select class="form-control sch_cd"
                            name="mill_id" disabled
                            id="mill_id" >

                            <option value="">Select</option>    

                            <?php foreach($mill_dtls as $mill_dtl) {?> 
                       <option value="<?php if(isset($mill_dtl->sl_no)){ echo $mill_dtl->sl_no;}?>" <?php if($mill_dtl->sl_no==$workorder_dtls->mill_id){ echo "selected";}?>><?php if(isset($mill_dtl->mill_name)){ echo $mill_dtl->mill_name;}?></option>  
                        <?php } ?>     

                        </select>    

                    </div>

                </div> 

                <div class="form-group row">
                    <label for="paddy_qty" class="col-sm-2 col-form-label">Total Target(Qnt)</label>
                    <div class="col-sm-4">
                        <input type="text" 
                         class="form-control" name="total_target" id="target_id" value="" readonly/>
                    </div>
                    <label for="paddy_qty" class="col-sm-2 col-form-label">Total Order Placed(Qnt):</label>
                     <div class="col-sm-4">
                       <input type="text" class="form-control" name="order_placed" id="order_placed" value="0.00" readonly/>
                     </div>
                     </div> 

                <div class="form-group row" >

                    <label for="paddy_qty" class="col-sm-2 col-form-label" style="display:none">Remaining Qty(Qnt):</label>
                     <div class="col-sm-4" style="display:none">
                       <input type="text" class="form-control" name="remain_qty" id="remain_qty" value="0.00" readonly/>
                     </div>

                    <label for="paddy_qty" class="col-sm-2 col-form-label" >Paddy Qty(Qnt):</label>

                    <div class="col-sm-4">

                        <input type="text"
                            class="form-control required"
                            name="paddy_qty"  readonly
                            id="paddy_qty"
                            value="<?php echo $workorder_dtls->paddy_qty;?>"/>

                    </div>

                </div>

                <div class="form-group row">

                    <div class="col-sm-6">
                     <?php // if($workorder_dtls->approval_status !="A") {?>
                        <button type="submit" class="btn btn-info">Save</button>
                     <?php //} ?>
                    </div>
                  
                    <a href="<?php echo site_url("paddys/transactions/f_workorder_approved");?>?order_no=<?php echo $workorder_dtls->order_no; ?>/<?php echo $workorder_dtls->branch_id;?>/<?php echo $workorder_dtls->kms_year;?>" 
                            data-toggle="tooltip" data-placement="bottom" title="Approve" >
                            <button type="button" class="delete" title="Approve">Approve  </button> 
                                            </a>

                </div>

            </form>

        </div>

    </div>    

<script>

 //   $("#form").validate();

    //$( ".sch_cd" ).select2();

</script>

<script>

// start of doc ready.

<?php if(isset($workorder_dtls->trans_dt)) { ?>
   // if(isset()){
     // e.preventDefault();  // stops the jump when an anchor clicked.
     var soc_id = <?php echo $workorder_dtls->soc_id;?>; // anchors do have text not values.
      var mill_id = <?php echo $workorder_dtls->mill_id;?>; // anchors do have text not values.
     
      console.log(mill_id);
      $.ajax({
        url: '<?php echo base_url();?>index.php/paddys/transactions/f_get_mill_target',
        data: {'soc_id': soc_id,'mill_id': mill_id}, // change this to send js object
        type: "post",
        dataType: 'json',
        success: function(data){
          
          // $("#mill_id").find('option').remove();
            var target=parseFloat(data.target);
           
          $('#target_id').val(target);
          var order=0.00 ;
              if(data.order==null){
              
                $('#order_placed').val("0.00");
                $('#remain_qty').val(target);
                
              } else{
                $('#order_placed').val(parseFloat(data.order));
                $('#remain_qty').val(target-parseFloat(data.order));
              }
              
     
        }
      });
//   });
    <?php } ?>

</script>

<script>



$("#form").submit(function(e){
    //  e.preventDefault();  // stops the jump when an anchor clicked.
     var remain_qty = parseFloat($("#remain_qty").val()); // anchors do have text not values.
     var paddy_qty = parseFloat($("#paddy_qty").val()); // anchors do have text not values.
    // console.log(soc_id);
    
     var order_placed = parseFloat($("#order_placed").val());
     var previous_order = order_placed-parseFloat(<?=$workorder_dtls->paddy_qty?>);
    
     var paddy_target = parseFloat($("#target_id").val());
     var max_paddy    = paddy_target-previous_order;
    
      if (paddy_qty <= max_paddy) {

        return true;
        
      }else{
        alert("Paddy qty Can not Greater Than Remain qty");
        return false;
        
      }
       // e.preventDefault();  // stops the jump when an anchor clicked.
   });
 
$("#trans_dt").change(function(){

          var trans_dt = $('#trans_dt').val();
         
 var d = new Date();

 var month = d.getMonth()+1;
 var day = d.getDate();

 var output = d.getFullYear() + '-' +
    (month<10 ? '0' : '') + month + '-' +
    (day<10 ? '0' : '') + day;

    console.log(trans_dt,output);

          if(new Date(output) < new Date(trans_dt))
          {
          alert("Transaction  Date Can Not Be Greater Than Current Date");
          $('#submit').attr('type', 'buttom');
          return false;
          }else{
             $('#submit').attr('type', 'submit');
          }
})

 $('#form').submit(function(event){
           
                var trans_dt = $('#trans_dt').val();
         
var d = new Date();

 var month = d.getMonth()+1;
 var day = d.getDate();

 var output = d.getFullYear() + '-' +
    (month<10 ? '0' : '') + month + '-' +
    (day<10 ? '0' : '') + day;

                    if(new Date(output) < new Date(trans_dt)){

                      alert("Transaction  Date Can Not Be Greater Than Current Date");
                      event.preventDefault();
                    }
                     else 
                        {
                    //  alert("Transaction Date Can Not Be Less Than order Date");

                       $('#submit').attr('type', 'submit');
                       
                      }
            });
</script>