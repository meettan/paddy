 <div class="wraper">      

        <div class="col-lg-12 container contant-wraper">    
        
        <div class="form-header">
     
            <h4>Paddy Procurement Entry</h4>
      
            </div>

            <form method="POST" 
                id="form"  enctype="multipart/form-data"
                action="<?php echo site_url("paddys/transactions/f_checker_update");?>">

                <div class="form-group row">

                <input type="hidden" value="<?php echo $_GET["soc_id"]?>" name="editdata">

                    <label for="block" class="col-sm-1 col-form-label">Block:</label>

                    <div class="col-sm-2">
                      <?php  foreach($farmer_dtls as $farme);
                      
                      if(isset($farme->block_name)){ echo $farme->block_name; }?>  
                      

                    </div>

                    <label for="soc_name" class="col-sm-2 col-form-label">Society Name:</label>

                    <div class="col-sm-4">
                    <?php
                      if(isset($farme->soc_name)){ echo $farme->soc_name; }?>  

                    </div>
                    <label for="soc_name" class="col-sm-1 col-form-label">Transaction Date:</label>
                    <div class="col-sm-2">
                    <input type="date" name="trans_dt" id="trans_dt" class="form-control" value="<?php echo date('Y-m-d'); ?>" disabled/>
                    
                    </div>
                  
                </div>
                <div>
               <?php 

               $bank_id=get_bank_id($farme->bank_sl_no);
               
               if( $bank_id== "1"){?>
               <p> <input type="checkbox" name="certificate_3" value="Y" <?php if($farme->certificate_3=="Y"){ echo "checked"; }?> required>Certified that I have verified that the cheques (stationary) are properly issued by the concerned bank.</p>
                <p> <input type="checkbox" name="certificate_5" value="Y" <?php if($farme->certificate_5=="Y"){ echo "checked"; } ?> required >Recommended and forwarded to the Head Office.</p>
               <?php } else{?>
                <input type="checkbox" name="certificate_3" value="Y" <?php if($farme->certificate_3=="Y"){ echo "checked"; }?> required>Recommended and forwarded to the Head Office / the concerned bank for issuing cheques.</p>
                <?php } ?>
             </div>
            <table class="table table-bordered table-hover" id="farmers">
            <thead><tr><th>Sl. No.</th><th>Name</th><th>Registration No.</th><th>Quantity(Quintal)</th><th>Amount</th><th>Cheque No</th><th>Cheque No</th><th>Max Limit</th></tr></thead><tbody id="farme"> 
         
            <tbody> 
            <?php 
                $count=0;
                $paddy_qty = 0;
            foreach($farmer_dtls as $farmer_dtl) { ?>
            <tr><td ><?=++$count;?></td><td><?=get_farmer_name($this->session->userdata['loggedin']['kms_id'],$farmer_dtl->reg_no)?></td><td><?=$farmer_dtl->reg_no?><input type="hidden" value="<?=$farmer_dtl->reg_no?>" name="reg_no[]"></td><td><?=$farmer_dtl->quantity?>
              <?php $paddy_qty += $farmer_dtl->quantity;?>
             </td><td><?=$farmer_dtl->amount?></td><td><input type="text" name="cheque_no[]" value="<?=$farmer_dtl->cheque_no?>" ></td><td><input type="date" class="form-control" name="cheque_date[]" value="<?=$farmer_dtl->cheque_date?>" ></td><td>45 Quintal</td></tr>
            
            <?php } ?>
           <tr><td colspan="3" style=
              "text-align:center">Total Procured Paddy</td><td><?=$paddy_qty;?></td><td colspan="4"></td></tr>  
            </tbody>
            </table>
            <div class="form-group row">

            <div class="col-sm-10">

                <input type="submit" id="submit" class="btn btn-info" value="Save"/>

                 </div>
            </div>
        </div>
        </form>


    </div>

    <script src="https://ajax.googleapis.com/ajax/libs/jquery/2.1.1/jquery.min.js"></script>
   

<script>

   // $("#form").validate();

  //  $( ".sch_cd" ).select2();

</script>

<script>

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

       
  </script>
<script>

    $(document).ready(function(){

        $('#no_of_farmer').change(function(){

            $.get('<?php echo site_url("paddy/totfarmer"); ?>',

                {

                    soc_id: $('#soc_name').val()

                }
            
            )
            .done(function(data){
                
                $('#totnofarmer').val(parseInt(data) + parseInt($('#no_of_farmer').val()));

            });

        });

    })
        
        $('#form').submit(function(event){
           
            $('#farmers tr').each(function() {

                  var valid = 1;

                  var max_limit="45";
                
                  var paddy_qty = $(this).find("td").eq(3).html();      

                 var qty = $(this).find('td:eq(5) .quantity').val();
                 var enter_qty = parseFloat(paddy_qty) + parseFloat(qty);
                    if(enter_qty>max_limit){
                        $(this).find('td:eq(5) .quantity').focus();
              
                        $('#submit').attr('type', 'buttom');
              
                        event.preventDefault();
                   }
                    else 
                       {
                      $('#submit').attr('type', 'submit');
                      }
            }); 
                  
         });
</script>

<script>
$(document).ajaxComplete(function() {

});
$( document ).ajaxComplete(function() {
    $(".status").change(function(){
      $(this)
          .parents('td')
          .next()
          .find('input')
          .prop('disabled', !$(this).is(":checked"));
          
              
  }); 

});


</script>