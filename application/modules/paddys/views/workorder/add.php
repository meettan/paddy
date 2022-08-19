    <div class="wraper">      
        <div class="col-md-3"></div>
        <div class="col-md-6 container form-wraper">

            <form method="POST" id="form" action="<?php echo site_url("paddys/transactions/f_workorder_add");?>">

                <div class="form-header">
                
                    <h4>Workorder Entry</h4>
                
                </div>

                <div class="form-group row">
                
                    <label for="block" class="col-sm-2 col-form-label">Block:</label>
                    <div class="col-sm-4">

                        <select name="block" id="block_id" class="form-control required">
                            <option value="">Select</option>   
                            <?php foreach($blocks as $block) {?> 
                            <option value="<?php if(isset($block->blockcode)){ echo $block->blockcode;}?>"><?php if(isset($block->block_name)){ echo $block->block_name;}?></option>  
                            <?php } ?>  
                        </select>
                    </div>
                        <label for="trans_dt" class="col-sm-2 col-form-label">Date:</label>

                    <div class="col-sm-4">
                       <input type="date"  class="form-control required"  name="trans_dt"  id="trans_dt" value="<?php echo date('Y-m-d');?>" required/>

                     </div>
                </div>
                <div class="form-group row">
                    <label for="soc_name" class="col-sm-2 col-form-label">Society Name:</label>
                    <div class="col-sm-10">
                        <select type="text" class="form-control required sch_cd" name="soc_name" id="soc_name">   
                        </select>    
                    </div>
                </div> 
                <div class="form-group row">
                    <label for="soc_name" class="col-sm-2 col-form-label">Mill Name:</label>
                    <div class="col-sm-10">
                        <select type="text" class="form-control required sch_cd" name="mill_id" id="mill_id">    
                        </select>    
                    </div>
                </div> 
                <div class="form-group row">
                    <label for="paddy_qty" class="col-sm-2 col-form-label">Total Target(Qnt):</label>
                    <div class="col-sm-4">
                        <input type="text" 
                         class="form-control" name="total_target" id="target_id" value="" readonly/>
                    </div>
                    <label for="paddy_qty" class="col-sm-2 col-form-label">Order Placed(Qnt):</label>
                     <div class="col-sm-4">
                       <input type="text" class="form-control" name="order_placed" id="order_placed" value="0.00" readonly/>
                     </div>
                     </div>  
                <div class="form-group row">
                   <label for="paddy_qty" class="col-sm-2 col-form-label">Remaining Qty(Qnt):</label>
                     <div class="col-sm-4">
                       <input type="text" class="form-control" name="remain_qty" id="remain_qty" value="0.00" readonly/>
                     </div>
                     <label for="paddy_qty" class="col-sm-2 col-form-label">Paddy Qty(Qnt):</label>
                      <div class="col-sm-4">
                     <input type="text" class="form-control required" name="paddy_qty" id="paddy_qty" value=""/>
                    </div>
                   </div>  

                <div class="form-group row">

                    <div class="col-sm-10">

                        <input type="submit" class="btn btn-info" value="Save" />

                    </div>

                </div>

            </form>

        </div>

    </div>

<script>

    // $("#form").validate();

    // $( ".sch_cd" ).select2();

</script>

<script>
 // start of doc ready.
   $("#block_id").change(function(e){
     // e.preventDefault();  // stops the jump when an anchor clicked.
      var block_id = $(this).val(); // anchors do have text not values.
      console.log(block_id);
      $.ajax({
        url: '<?php echo base_url();?>index.php/paddys/transactions/f_get_society',
        data: {'block_id': block_id}, // change this to send js object
        type: "post",
        dataType: 'json',
        success: function(data){
           //document.write(data); just do not use document.write
           //console.log(data);
           $("#soc_name").find('option').remove();
           $('#soc_name').append(data.html);
        }
      });
   });
 // end of doc ready 
</script>

<script>
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
           //document.write(data); just do not use document.write
           //console.log(data);
           $("#mill_id").find('option').remove();
           $('#mill_id').append(data.html);
          
        }
      });
   });
 // end of doc ready 
</script>
<script>
 // start of doc ready.
   $("#mill_id").change(function(e){
     // e.preventDefault();  // stops the jump when an anchor clicked.
     var soc_id = $("#soc_name").val(); // anchors do have text not values.
      var mill_id = $(this).val(); // anchors do have text not values.
     
      console.log(mill_id);
      $.ajax({
        url: '<?php echo base_url();?>index.php/paddys/transactions/f_get_mill_target',
        data: {'soc_id': soc_id,'mill_id': mill_id}, // change this to send js object
        type: "post",
        dataType: 'json',
        success: function(data){
           //document.write(data); just do not use document.write
           console.log(data); 
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
   });
 // end of doc ready 
</script>
<script>
  $("#form").submit(function(e){
      //e.preventDefault();  // stops the jump when an anchor clicked.
     
     var remain_qty = parseFloat($("#remain_qty").val()); // anchors do have text not values.
     var paddy_qty = parseFloat($("#paddy_qty").val()); // anchors do have text not values.

      if (paddy_qty <= remain_qty) {

        return true;
        
      }else{
        alert("Paddy quantity Cannot be greater than remaining quantity");
        return false;
        
      }
      
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
