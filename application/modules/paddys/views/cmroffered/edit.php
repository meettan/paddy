<div class="wraper">    
<div class="col-md-2 container"> </div> 

<div class="col-md-8 container form-wraper">

    <form method="POST" 
        id="form"
        action="<?php echo site_url("paddys/transactions/f_offered_edit");?>" >

        <div class="form-header">
        
            <h4>CMR offered Edit<!--  <input type="button" class="btn btn-danger" onclick="printDiv('print')" value="Print" style="float:right"> --></h4>
        
        </div>

        <input type="hidden"
                name="trans_no"  value="<?php echo $cmroffered_dtls->trans_no;?>"/>

        <div class="form-group row">

            <label for="block" class="col-sm-2 col-form-label">Block:</label>

            <div class="col-sm-4">

                <select name="block" id="block" class="form-control required" disabled>

                    <option value="">Select</option>    
                          <?php foreach($blocks as $block){ ?>
                    <option value="<?php echo $block->sl_no;?>" <?php if($block->sl_no== $cmroffered_dtls->block_id){ echo "selected";}?>><?php echo $block->block_name;?></option>    
                          <?php } ?>
                </select>

            </div>


            <label for="trans_dt" class="col-sm-2 col-form-label">Transaction Date:</label>

            <div class="col-sm-4">

                <input type="date"
                        class="form-control required"
                        name="trans_dt"
                        id="trans_dt"
                        value="<?php echo $cmroffered_dtls->trans_dt;?>" />
            </div>

        </div>

        <div class="form-group row">

            <label for="soc_name" class="col-sm-2 col-form-label">Society Name:</label>

            <div class="col-sm-10">
                <select type="text"
                    class="form-control required sch_cd"
                    name="soc_name"
                    id="soc_name"     disabled  >

                    <option value="">Select</option>    

                    <option value="">Select Block First</option>    

                </select>    

            </div>

        </div>  

        <div class="form-group row">

            <label for="mill_name" class="col-sm-2 col-form-label">Mill Name:</label>

            <div class="col-sm-10">

                <select type="text"
                    class="form-control required sch_cd"
                    name="mill_name"
                    id="mill_name"  disabled >

                    <option value="">Select</option>    

                </select>

            </div>

        </div>  

        <div class="form-group row">

            <label for="tot_pdy_delivrd" class="col-sm-2 col-form-label">Progressive Paddy Received:</label>

            <div class="col-sm-10">

              <input type="text"
                     class="form-control"
                     name="progressive_paddy_received"
                     id="milled"
                     value="<?php echo $cmroffered_dtls->progressive_paddy_received; ?>" readonly/>

         </div>

        </div>

        <div class="form-group row">

        <label for="rice_type" class="col-sm-2 col-form-label">Rice Type:</label>
            <div class="col-sm-4">

                <select class="form-control required"
                        name="rice_type" disabled  id="rice_type" >
                    
                    <option value="">Select</option>
                    <option value="P" <?php echo ($cmroffered_dtls->rice_type == 'P')? 'selected' : '';?>>Par Bolied</option>
                    <option value="R" <?php echo ($cmroffered_dtls->rice_type == 'R')? 'selected' : '';?>>Raw Rice</option>

                </select>    

            </div>


        <label for="milled" class="col-sm-2 col-form-label">Progressive Resultant Paddy:</label>

      <div class="col-sm-4">

          <input type="text"
                class="form-control" name="milled" id="milled"
                value="<?php echo $cmroffered_dtls->progressive_res_paddy; ?>" readonly/>

            </div>

       </div>

        <div class="form-group row">

                <label for="milled" class="col-sm-2 col-form-label">Paddy Milled:</label>

                <div class="col-sm-10">
                    <input type="text"
                            class="form-control" name="milled"
                            id="milled" readonly
                            value="<?php echo $cmroffered_dtls->milled; ?>" />
                </div>

            </div>

            <div class="form-group row">

                <label for="res_cmr" class="col-sm-2 col-form-label">Resultant CMR:</label>

                <div class="col-sm-4">

                    <input type="text" class="form-control" name="res_cmr" id="res_cmr" readonly="" value="<?php echo $cmroffered_dtls->resultant_cmr; ?>">

                </div>      

                <label for="res_cmr" class="col-sm-2 col-form-label">CMR Offered Now:</label>

                <div class="col-sm-4">

                    <input type="text" class="form-control" name="cmr_offered_now" id="cmr_offered_now" value="<?php echo $cmroffered_dtls->cmr_offered_now; ?>" readonly>

                </div>                

         </div>

        <div class="form-group row">

        </div> 

        <div class="form-group row">

        <label for="res_cmr" class="col-sm-2 col-form-label">Total Progressive CMR OFFERED :</label>
        <div class="col-sm-4">

       <input type="text" class="form-control" name="total_progressive_cmr_offered" id="total_progressive_cmr_offered" readonly="" value="<?php echo $cmroffered_dtls->total_progres_cmr_offered; ?>">
      </div>

            <label for="res_cmr" class="col-sm-2 col-form-label">CMR Yet To Be Offered::</label>
            <div class="col-sm-4">

               <input type="text" class="form-control" name="cmr_yet_to_offered" value="<?php echo $cmroffered_dtls->cmr_yet_to_offered; ?>" id="cmr_yet_to_offered"  readonly/>

            </div>

        </div>    

         <div class="form-group row">

            <div class="col-sm-10">
              
                <input type="submit" id="submit" class="btn btn-info" value="Save"/>
                
                 </div>
            </div> 
 
    </form>

</div>
   


</div>

<script>

$("#form").validate();

$( ".sch_cd" ).select2();

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

<script>

$(document).ready(function(){

    var global_block= '<?php echo $cmroffered_dtls->block_id ?>';
   
      
        function socGroup(block) { 

             //For Block wise Society
             $.get( 

                '<?php echo site_url("paddy/societies");?>',

                { 

                    block: block

                }

                ).done(function(data){

                var string = '<option value="">Select</option>',
                    selected = '';

                $.each(JSON.parse(data), function( index, value ) {

                    if(value.sl_no == '<?php echo $cmroffered_dtls->soc_id ?>'){
                        
                        selected = 'selected';

                    }else{

                        selected = '';

                    }

                    string += '<option value="' + value.sl_no + '"'+ selected +'>' + value.soc_name + '</option>'

                });

                $('#soc_name').html(string);

            });

        }

    <?php     if(isset($cmroffered_dtls->soc_id)){   ?>
    // start of doc ready.
   // $("#soc_name").change(function(e){
    
      var soc_id = <?php echo $cmroffered_dtls->soc_id; ?>; // anchors do have text not values.
      console.log(soc_id);
      $.ajax({
        url: '<?=base_url();?>index.php/paddys/transactions/f_soc_mills',
        data: {'soc_id': soc_id}, // change this to send js object
        type: "post",
      //  dataType: 'json',
        success: function(data){
           
           var string = '<option value="">Select</option>',
                    selected = '';

                $.each(JSON.parse(data), function( index, value ) {

                    if(value.sl_no == '<?php echo $cmroffered_dtls->mill_id ?>'){
                        
                        selected = 'selected';
                    }else{

                        selected = '';
                    }

                    string += '<option value="' + value.sl_no + '"'+ selected +'>' + value.mill_name + '</option>'

                });

                $('#mill_name').html(string);
          
           }
      });

     <?php } ?>
    socGroup( '<?php echo $cmroffered_dtls->block_id ?>');

    $('#dist').change(function(){

        millGroup($(this).val());

        socGroup('');

    });

    $('#block').change(function(){
        
        socGroup($(this).val());

    });

});
</script>

<script>

    $(document).ready(function(){

        $('#mill_name').change(function(){
            
            //Progressive Paddy Procurement
            $.get('<?php echo site_url("paddy/delivered"); ?>',

                {

                    soc_id:  $('#soc_name').val(),

                    mill_id: $(this).val()

                }
            
            )
            .done(function(data){
                
                $('#tot_pdy_delivrd').val(data);

                if(data == '0.000'){

                    $('#submit').attr('type', 'button');

                }
                else{
    
                    $('#submit').attr('type', 'submit');

                }
                
            });

        });

    });

</script>

<script>

    $(document).ready(function(){

        $('#rice_type').change(function(){
            
            //Progressive Paddy Procurement
            $.get('<?php echo site_url("paddy/ricetype"); ?>',

                {

                    type: $(this).val()

                }
            )
            .done(function(data){
                
            // $('#res_cmr').val((($('#milled').val() * parseInt(data)) / 100).toFixed(3));
               $('#res_cmr').val((($('#milled').val() * parseInt(data)) / 100));

                if(data == '0.000'){

                        $('#submit').attr('type', 'button');
                    }
                    else{

                        $('#submit').attr('type', 'submit');

                    }
                
            });

        });


        $('.offer_type').change(function(){
            
            let total = 0;

            $("#tot_cmr_offered").val('');
  
            $('.offer_type').each(function(){
                
                total += +$(this).val();
                
            });

            if(total <= $('#res_cmr').val()){

                $("#tot_cmr_offered").val(total);

                $('#submit').attr('type', 'submit');

            }
            else{

                $('#submit').attr('type', 'button');
            }

        });

    });

</script>