<div class="wraper">      

      <div class="col-lg-12 container contant-wraper">    
        <div class="form-header">
     
            <h4>NEFT Reissue</h4>
      
            </div>

            <form method="POST" 
                id="form"  enctype="multipart/form-data"
                action="<?php echo site_url("paddys/transactions/reissue_nefts");?>">

                <div class="form-group row">

                <input type="hidden" value="<?php echo $_GET["soc_id"]?>" name="editdata">

                    <label for="block" class="col-sm-1 col-form-label">Block:</label>

                    <div class="col-sm-2">
                      <?php  foreach($farmer_dtls as $farme);
                      
                      if(isset($farme->block_name)){ echo $farme->block_name; }?>  
                    </div>

                    <label for="soc_name" class="col-sm-1 col-form-label">Society Name:</label>

                    <div class="col-sm-2">
                    <?php if(isset($farme->soc_name)){ echo $farme->soc_name; }?>  

                    </div>
                      <label for="block" class="col-sm-1 col-form-label">Mill:</label>

                        <div class="col-sm-2">
                    <?php echo get_mill_name($farme->mill_id);?>  

                    </div>
                    <label for="soc_name" class="col-sm-1 col-form-label">Procurement Date:</label>
                    <div class="col-sm-2">
                    <input type="date" name="trans_dtss" id="trans_dt" class="form-control" value="<?php if(isset($farme->trans_dt)){echo $farme->trans_dt;}?>"  readonly/>
                    <input type="hidden" value="<?=$farme->trans_dt?>" name="trans_dt">
                    </div>
                </div>
                 <div class="form-group row">
                  <div class="col-sm-2"><b>File Number :  </b></div>
                <div class="col-sm-2"><?php if(isset($farme->forward_bulk_trans_id)){ echo $farme->forward_bulk_trans_id; }?> </div>
                <input type="hidden" name ="bulk_trans_id" value="<?php if(isset($farme->bulk_trans_id)){ echo $farme->bulk_trans_id; }?>">
                 <input type="hidden" name ="forward_bulk_trans_id" value="<?php if(isset($farme->forward_bulk_trans_id)){ echo $farme->forward_bulk_trans_id; }?>">
            <div class="col-sm-2"><b>Bank Name :</b> </div>
             <div class="col-sm-3">


                    <select name="bank_sl_no" id="bank_sl_no" class="form-control" required>
                    <option value="">Select</option>    
                    <?php

                             foreach($banks as $bank){

                            ?>
                         <option value="<?php echo $bank->sl_no;?>" <?php if(isset($farme->bank_sl_no) && $farme->bank_sl_no == $bank->sl_no){ echo "selected"; } ?>> <?php echo $bank->bank_name; ?></option>
                           <?php

                                 }

                                    ?>  
                  </select>
              
                   <?php   //if($farme->bank_sl_no == 1){ echo "Yes Bank"; }
                  //       elseif($farme->bank_sl_no == 2){ echo "Bandhan Bank";}
                  //       elseif($farme->bank_sl_no == 3){ echo "Icici Bank";}
                  //       elseif($farme->bank_sl_no == 4){ echo "Axis Bank";}
                  //       else { echo "HDFC Bank"; }
                  ?> 
                </div>

                     <div class="col-sm-2"><b>Transaction :</b><?php if($farme->trans_type=="N"){ echo "NEFT"; }else{ echo "Cheque"; }?>  </div>
                 </div>            

            <table class="table table-bordered table-hover" id="farmers">
            <thead><tr><th>Sl. No.</th><th>Name</th><th>Registration No.</th><th>Quantity(Quintal)</th><th>Amount</th>
                <?php if($farme->trans_type=="N"){ ?>
                  <th>IFSC Code</th><th>Account </th><th>Status </th>
             
             <?php }else{ ?>
                  <th>Cheque No</th><th>Cheque Date</th>
             <?php } ?>
              </tr></thead><tbody id="farme"> 
         
            <tbody> 
            <?php 
                $count = 0;
                $paddy_qty = 0;
                $amount = 0;
            foreach($farmer_dtls as $farmer_dtl) { ?>
            <tr><td><?=++$count;?></td>
              <td><?=$farmer_dtl->farmer_name?></td>
              <td><?=$farmer_dtl->reg_no?><input type="hidden" value="<?=$farmer_dtl->reg_no?>" name="reg_no[]"></td>
              <td>
                  <input type="text" name="quantity[]" value="<?=$farmer_dtl->quantity?>" class="form-control quantity" readonly>
                <?php $paddy_qty += $farmer_dtl->quantity;?> <span class="qerror"></span></td>
              <td><input type="text" name="amount[]" value="<?=$farmer_dtl->amount?>" class="form-control amount" readonly> <?php $amount += $farmer_dtl->amount;?></td>

   <?php if($farme->trans_type=="N"){ ?>

   <td><input type="text" name="ifsc_code[]" value="<?=$farmer_dtl->ifsc_code?>" class="form-control ifsc_code"><span class="error"></span></td>
              <td><input type="text" class="form-control acc_no" name="acc_no[]" value="<?=$farmer_dtl->acc_no?>"><span class="cd_error"></span></td>

              <td> <button type="button" class="payment_detail btn btn-info" data-toggle="modal" data-target="#myModal"  value="<?=$farmer_dtl->forward_trans_id?>">View </button></td>

    <?php  }  ?>               
              
         
            </tr>
            
            <?php } ?>
             <tr><td colspan="3" style=
              "text-align:center">Total Procured Paddy</td><td id="total"><?=$paddy_qty;?></td>
              <td id="totals"><?=$amount;?></td>
              <td colspan="3"></td></tr>
            </tbody>
            </table>
            <div class="form-group row">

            <div class="col-sm-10">
           <?php if($farmer_dtl->chq_status == "R") { ?> 
                <input type="submit" id="submit" class="btn btn-info" value="Save"/>
                <?php } ?>
               
                 </div>
            </div>
  </form>

             <div class="form-group row">
          <div class="col-sm-6"></div>
          <div class="col-sm-5">
              
            </div>
        </div>
        </div>

        <div class="modal fade" id="myModal" role="dialog">
    <div class="modal-dialog modal-lg">
    
      <!-- Modal content-->
      <div class="modal-content">


        <div class="modal-header">
          <button type="button" class="close" data-dismiss="modal">&times;</button>
          <h4 class="modal-title">Payment Status</h4>
        </div>
        <center>
        <div class="modal-body">
          <img src="<?=base_url();?>assets/images/Flowinggradient.gif" >
        </div>
      </center>
        <div class="modal-footer">
          <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
        </div>
      </div>
      
    </div>
  </div>
      


    </div>

    <script src="https://ajax.googleapis.com/ajax/libs/jquery/2.1.1/jquery.min.js"></script>
   

<script>

  $(document).ready(function(){
      $('#myModal').on('hidden.bs.modal', function () {
       location.reload();
      })
    })

  $('.modal').on('hide.bs.modal', function (e) {
    $("element.style").css("padding-right","0");
});

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

    $(document).ready(function(){

var i = 0;

$('.payment_detail').click(function(){

    $.post( 

        '<?php echo site_url("paddys/transactions/f_farmer_payment");?>',

        { 

            forward_trans_id: $(this).val()

        }

    ).done(function(data){

        var string = '<table  class="table"><tr><th>Bank</th><th>Value Date</th><th>Utr No</th><th>Bank Ref No</th><th>Cr A/C No</th><th>Amount</th><th>Status Code</th><th>Status Description</th></tr>';

        $.each(JSON.parse(data), function( index, value ) {

            string += '<tr><td>' + value.bank_name + '</td><td>' + value.value_date + '</td><td>' + value.utr_no + '</td><td>' + value.bank_ref_no + '</td><td>' + value.cr_acc_no + '</td><td>' + value.amount + '</td><td>' + value.status_code + '</td><td>' + value.status_description + '</td></tr>'

        });

      //   var string +='</table>';

        $('.modal-body').html(string);

    });

});

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




        $('.delete').click(function () {

            var id = $(this).attr('id');

            var result = confirm("Do you really want to delete this record?");

            if(result) {

                window.location = "<?php echo site_url('paddys/transactions/f_pad_sig_delete?soc_id="+id+"');?>";

            }
            
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
$(document).on("change", ".quantity", function() {
    var sum = 0;
    var totamt = 0;
    $(".quantity").each(function(){
        sum += +$(this).val();
    });
    $("#total").html(sum.toFixed(2));

     $(".amount").each(function(){
        totamt += +$(this).val();
    });
    $("#totals").html(totamt.toFixed(2));

   
});

// $(document).on("change", ".amount", function() {
  
 
   


// });

$(".quantity").keyup(function(){

                var qty = $(this).closest('tr').find(".quantity").val();
                

                var max_limit="45";
               
                if(parseFloat(qty) > parseFloat(max_limit)){
                   
                    $(this).parents('tr').find(".qerror").html("Limit Exceed").css("color", "red");

                    $('#submit').attr('type', 'buttom');
                }
                else{


                
                    var price='<?php echo get_paddy_price($this->session->userdata['loggedin']['kms_id']);?>';

                       ;
                    $(this).closest('tr').find(".amount").val(Math.round((parseFloat(qty*price)).toFixed(2))).css("color", "black");
                  $(this).parents('tr').find(".qerror").html("");
                    $('[id^=check]').attr("disabled", false);
                    $('#submit').attr('type', 'submit');
                    }

                });

    $(".cheque_no").change(function(){

                    var qty = $(this).val();
                        
                    if(qty.toString().length != 6 ){
                        
                        $(this).parents('tr').find(".error").html("Only 6 Digit").css("color", "red"); 
                        $(this).closest('tr').find(".cheque_no").focus();
                    
                        $('#submit').attr('type', 'buttom');
                    }
                    else{
                        $(this).parents('tr').find(".error").html(""); 
                        $('#submit').attr('type', 'submit');
                    }

                       }); 

    $(".cheque_date").change(function(){

          var trans_dt = $('#trans_dt').val();
          var cheque_date = $(this).val();          

          if(new Date(cheque_date) < new Date(trans_dt))
          {
          $(this).parents('tr').find(".cd_error").html("Cheque Date Can Not Be Less Than Transaction Date").css("color", "red"); 
          $(this).closest('tr').find(".cheque_date").focus();
         // alert("Cheque Date Can Not Be Less Than Transaction Date");
          event.preventDefault();
          $('#submit').attr('type', 'buttom');
          return false;
          }
           else{
                   $(this).parents('tr').find(".cd_error").html(""); 
              }

        });

</script>