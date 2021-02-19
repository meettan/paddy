<div class="wraper">      

    <div class="col-md-12 container form-wraper" style="margin-left: 0px;">

        <form method="POST" id="form"
            action="<?php echo site_url("payment/commission/add");?>" >

            <div class="form-header">

                <h4>Commission Entry </h4>
            
            </div>

            <div class="form-group row">

                <label for="dist" class="col-sm-1 col-form-label">Payment Date:</label>

                 <div class="col-sm-3">

                    <input type="date"
                            class="form-control" required
                            name="trans_dt"
                            id="trans_dt"
                            value="<?php echo date('Y-m-d');?>" />

                </div>


                <label for="block" class="col-sm-1 col-form-label">Block:</label>

                <div class="col-sm-3">

                    <select name="block" id="block" class="form-control" required>

                        <option value="">Select</option>    
                        <?php

                            foreach($blocks as $block){

                        ?>
                        <option value="<?php echo $block->blockcode;?>"><?php echo $block->block_name;?></option>    
                         <?php

                            }

                        ?>     

                    </select>

                </div>

                <label for="soc_name" class="col-sm-1 col-form-label">Society Name:</label>

                <div class="col-sm-3">

                    <select type="text"
                        class="form-control sch_cd" required
                        name="soc_name"
                        id="soc_name">

                        <option value="">Select</option>    

                        <option value="">Select Block First</option>    

                    </select>    

                </div>
                
            </div>
           
            <div class="form-group row">

                <label for="soc_name" class="col-sm-1 col-form-label">Rice Mill:</label>
              
                <div class="col-sm-3">

                    <select type="text" class="form-control" name="mill_id" id="mill_id" required>  

                            <option value="">Select</option>    

                    </select>    

                </div>

               

                <label for="totPaddy" class="col-sm-1 col-form-label">Agreement No.:</label>

                <div class="col-sm-3">

                    <input type="text"
                            class="form-control" required
                            name="aggrement_no"
                            id="aggrement_no" readonly/>

                </div>

                <label for="sanc_no" class="col-sm-1 col-form-label">Sanction No:</label>
                <input type="hidden" name="sanc_nos" id="sanc_nos" >
                <div class="col-sm-3">

                    <select type="text" class="form-control" name="sanc_no" id="sanc_no"> 
                        <option value="">Select Sanction</option>    


                    </select>

                </div>
               
            </div>


            <div class="form-group row">

                <label for="wqsc" class="col-sm-1 col-form-label">Wqsc:</label>

                <div class="col-sm-3">

                     <input type="text"
                              class="form-control" readonly
                              name = "wqsc"
                              id = "wqsc" /> 

                    <!-- <select type="text"
                        class="form-control"
                        name="wqsc" id="wqsc"> 
                        <option value="">Select Wqsc</option>    


                    </select> -->

                </div>
              
                <label for="pool_type" class="col-sm-1 col-form-label">Received Paddy:</label>

                <div class="col-sm-3">

                       <input type="text"
                              class="form-control" readonly
                              name = "tot_rceived"
                              id = "tot_rceived" /> 

                </div>

                <label for="rice_type" class="col-sm-1 col-form-label">Rice Type:</label>

                <div class="col-sm-3">

                    <input type="hidden" name="rice_type" id="rice_type">
                    <select class="form-control" disabled
                            name="rice_types" id="rice_types">

                        <option value="">Select</option>

                        <option value="P">Boiled Rice</option>

                        <option value="R">Raw Rice</option>

                    </select>    

                </div>

               

            </div>


            <!-- <div id="wqsc_dtls">
                
                       
                
                  
            </div> -->

            <div class="form-group row">

                <label for="pool_type" class="col-sm-1 col-form-label">Pool Type:</label>

                <div class="col-sm-3">
                    <input type="hidden" name="pool_type" id="pool_type">
                    <select class="form-control" disabled
                            name="pool_types" id="pool_types">

                        <option value="">Select</option>

                        <option value="S">State Pool</option>

                        <option value="C">Central Pool</option>

                    </select>    

                </div>
                



                 <label for="pool_type" class="col-sm-1 col-form-label">Branch ref. no:</label>

                <div class="col-sm-3">

                       <input type="text"
                              class="form-control" required
                              name="branch_ref_no"
                              id="branch_ref_no"
                              /> 
                </div>
            	
                <label for="soc_bill_no" class="col-sm-1 col-form-label">Soc Bill No.:</label>

                <div class="col-sm-3">

                    <input type="text"
                            class="form-control" required
                            name="soc_bill_no"
                            id="soc_bill_no"
                        />

                </div>

               
            

            </div>

             <div class="form-group row">

                 <label for="soc_bill_date" class="col-sm-1 col-form-label">Soc Bill Date:</label>

                <div class="col-sm-3">

                       <input type="date"
                              class="form-control" required
                              name="soc_bill_date"
                              id="soc_bill_date" value="<?php echo date('Y-m-d');?>"
                        /> 

                </div>

             	
<!-- 
                <label for="totPaddy" class="col-sm-1 col-form-label">Billed Paddy:</label>

                <div class="col-sm-3">

                    <input type="text" class="form-control" required  name="qty" id="qty"/>

                </div> -->

               

            </div>

            <div id="bill_dtls">
                
                       
                
                  
            </div>

            <div class="form-group row">

                <label for="paid_amt" class="col-sm-1 col-form-label">Paid Amount<br>(Rounded off):</label>

                <div class="col-sm-3">

                    <input type="text"
                            class="form-control" readonly 
                            name="paid_amt"
                            id="paid_amt" />

                </div>

                <label for="totPaddy" class="col-sm-1 col-form-label">Payment Mode:</label>

                <div class="col-sm-3">

                     <select class="form-control" name="pay_mode" id="pay_mode" required >

                        <option value="">Select</option>
                        <option value="CHEQUE">Cheque</option>
                        <option value="RTGS">RTGS</option>
                        <option value="NEFT">NEFT</option>

                    </select>  

                </div>



                <label for="bank_id" class="col-sm-1 col-form-label">Bank Name:</label>

                <div class="col-sm-3">

                    <select name="bank_id" id="bank_id" class="form-control" required>

                       <option value="">Select</option>   

                       <?php foreach($banks as $bank) { ?>

                       <option value="<?php if(isset($bank->sl_no)){ echo $bank->sl_no; }?>">

                       <?php if(isset($bank->bank_id) && $bank->bank_id=="1")
                               { echo 'Yes Bank';}
                        elseif($bank->bank_id=="2"){ echo 'Bandhan Bank';  }

                        elseif($bank->bank_id=="3"){ echo 'Icici Bank';  }

                        elseif($bank->bank_id=="4"){ echo 'Axis Bank';  }

                        else{ echo 'Hdfc Bank';  } ?>
                            
                        </option>    

                        <?php } ?>

                  </select>

                </div>

            </div>

            <div class="form-group row">

                  <label for="totPaddy" class="col-sm-1 col-form-label">Reference No:</label>

                <div class="col-sm-3">

                    <input type="text"
                            class="form-control" name="ref_no" id="ref_no" />

                </div>


                

                 <label for="totPaddy" class="col-sm-1 col-form-label">Remarks:</label>

                <div class="col-sm-7">

                    <textarea name="remarks" id="remarks" class="form-control"></textarea>
                    
                </div>

            </div>


            <div class="form-group row">

                <div class="col-sm-10">

                    <input type="submit" class="btn btn-info" value="Save" />

                </div>

            </div>

        </form>

    </div>

    <div class="modal fade" id="viewModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
      <div class="modal-dialog" role="document">
        <div class="modal-content">
          <div class="modal-header">
            <h4>Supporting Documents</h4>
            <button class="close" type="button" data-dismiss="modal" aria-label="Close">
              <span aria-hidden="true">×</span>
            </button>
          </div>
          <div class="modal-body" id="doc-view">
           
          </div>
        </div>
      </div>
    </div>
</div>

<script>


    $('#mill_id').change(function(){

              //For Wqsc List
                $.post( 
                    '<?php echo site_url("paddys/payment/sanc_no_list");?>',

                    { 

                        soc_id   : $("#soc_name").val(),
                        block_id : $("#block").val(),
                        mill_id  : $(this).val()

                    }

                ).done(function(data){

                    var string = '<option value="">Select</option>';

                    $.each(JSON.parse(data), function( index, value ) {

                        string += '<option value="' + value.req_no + '">' + value.sanc_no + '</option>'

                    });

                    $('#sanc_no').html(string);

                });

    });

    $('#sanc_no').change(function(){

            $.post('<?php echo site_url("paddys/payment/sanc_no_dtls"); ?>',
            
                {
                    req_no:   $(this).val()
            
                }

            )
            .done(function(data){

                var string = '<div class="form-header"><h4>Bill Details</h4></div><table class="table" ><thead><tr><th>Particulars.</th><th>Rate/Qtls Paddy</th><th>Total Amount(Rs)</th><th>TDS Amount (Less)@2.00%</th><th>CGST (Add)@2.5%</th><th>SGST(Add)@2.5%</th><th>Claimed Amount(Rs)</th><th>Payable Amount(Rs) </th></tr></thead><tbody>';
                    
                var price_sum    = 0;

                $.each(JSON.parse(data), function( index, value ) {

                    string += '<tr><td>' + value.param_name + '</td><td><input type="hidden" name="rate" value="'+ value.per_unit_rate +'">' + value.per_unit_rate + '</td><td>' + value.total_amt + '</td><td><input type="hidden" name="tds_amt" value="'+ value.tds_amt +'">' + value.tds_amt + '</td><td>' + value.cgst_amt + '</td><td>' + value.sgst_amt + '</td><td>' + value.claim_amt + '</td><td>' + value.payble_amt + '</td></tr>';

                    price_sum    += parseFloat(value.payble_amt); 
                     
                });
                        string +='<tr><td colspan="7">Total</td><td> <input type="text" class="form-control" id="tot_rice" value="'+price_sum+'" readonly></td> <td></td></tr></tbody></table>';

                    $('#bill_dtls').html(string);
                    $('#paid_amt').val((price_sum.toFixed()));


                
            });



     
    });


    $('#sanc_no').change(function(){


            $.post('<?php echo site_url("paddys/payment/wqsc_dtls_on_sanc"); ?>',
            
                {
                    req_no:   $(this).val()
            
                }

            )
            .done(function(data){

                var datas = JSON.parse(data);

                $('#sanc_nos').val(datas.sanc_no);
                $('#wqsc').val(datas.wqsc_no);
                $('#pool_type').val(datas.pool);
                $('#rice_type').val(datas.rice_type);
                $('select[name^="pool_types"] option[value="'+datas.pool+'"]').attr("selected","selected");
                $('select[name^="rice_types"] option[value="'+datas.rice_type+'"]').attr("selected","selected");
                   
            });

            $.post('<?php echo site_url("paddys/payment/paddy_qty_on_sanc"); ?>',
            
                {
                    req_no:   $(this).val()
            
                }

            )
            .done(function(data){

                var datas = JSON.parse(data);

                $('#tot_rceived').val(datas.paddy_qty);
                   
            });
     
    });     

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

    });

  $("#soc_name").change(function(e){
    
            var soc_id = $(this).val(); // anchors do have text not values.
        
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

    $('#mill_id').change(function(){

            $.get( 

                '<?php echo site_url("payment/get_aggrementno");?>',

                { 

                    mill_id : $(this).val(),
                    soc_id: $('#soc_name').val()

                }

            ).done(function(data){

                let value = JSON.parse(data);
                var  values = value.reg_no;
                var  alues = value.paddy_qty;
                var  lues = value.qty;
                $('#aggrement_no').val(values.reg_no);
 				      //  $('#tot_rceived').val(alues.paddy_qty);
 				        $('#commn_paid').val(lues.qty);
               });

              //For Wqsc List
                $.post( 
                    '<?php echo site_url("paddys/payment/wqsc_list");?>',

                    { 

                        soc_id : $("#soc_name").val(),
                        mill_id: $(this).val()

                    }

                ).done(function(data){

                    var string = '<option value="">Select</option>';

                    $.each(JSON.parse(data), function( index, value ) {

                        string += '<option value="' + value.wqsc_no + '">' + value.wqsc_no + '</option>'

                    });

                    $('#wqsc').html(string);

                });

            });

            $('#wqsc').change(function(){
            
            //Progressive Paddy Procurement
            $.post('<?php echo site_url("paddys/payment/wqsc_qty"); ?>',
            
                {
                    soc_id:  $('#soc_name').val(),

                    mill_id: $('#mill_id').val(),

                    wqsc:    $(this).val()
                }

            )
            .done(function(data){

                let temp = JSON.parse(data);

                $('select[name^="rice_types"] option[value="'+temp.rice_type+'"]').attr("selected","selected");
                $('#rice_type').val(temp.rice_type);

                 $.get( 

                '<?php echo site_url("payment/commision_rate");?>',

                { 

                    rice_type : temp.rice_type,
            
                }).done(function(data){

                let values = JSON.parse(data);

                $('#rate').val("");
                $('#rate').val(values.rate);

                });
              
                $('#pool_type').val(temp.pool);
                $('select[name^="pool_types"] option[value="'+temp.pool+'"]').attr("selected","selected");
                
            });

            $.post('<?php echo site_url("paddys/payment/wqsc_dtls"); ?>',
            
                {
                    soc_id:  $('#soc_name').val(),

                    mill_id: $('#mill_name').val(),

                    wqsc:    $(this).val()
                }

            )
            .done(function(data){

                  var string = '<div class="form-header"><h4>WQSC Details</h4></div><table class="table" ><thead><tr><th>WQSC No.</th><th>Date</th><th>No of gunny.</th><th>Quantity(In Qtl)</th><th>Moisture Extra</th><th>Deduction Price for Moisture</th><th>Price</th><th>Avg. wt empty Gunny(in Gram)</th><th>Gunny Cut</th></tr></thead><tbody>';

                        var gunny_sum    = 0;
                        var quantity_sum = 0;
                        var dedu_sum     = 0;
                        var price_sum    = 0;
                        var gunny_cut    = 0;

                    $.each(JSON.parse(data), function( index, value ) {

                        string += '<tr><td>' + value.sub_wqsc + '</td><td>' + value.trans_dt + '</td><td>' + value.no_gunny + '</td><td>' + value.quantity + '</td><td>' + value.moisture_extra + '</td><td>' + value.moisture_ext_amt + '</td><td>' + value.tot_price + '</td><td>' + value.avg_wt_empty_gunny + '</td><td>' + value.gunny_cut + '</td></tr>'

                        gunny_sum    += parseFloat(value.no_gunny); 
                        quantity_sum += parseFloat(value.quantity); 
                        dedu_sum     += parseFloat(value.moisture_ext_amt); 
                        price_sum    += parseFloat(value.tot_price); 
                        gunny_cut    += parseFloat(value.gunny_cut); 

                    });
                        string +='<tr><td colspan="2">Total</td><td> <input type="text" class="form-control" id="gunnt_total" value="'+gunny_sum+'" readonly></td><td> <input type="text" class="form-control" id="cmr_total" value="'+quantity_sum+'" readonly></td><td></td><td> <input type="text" class="form-control" id="tot_deduction" value="'+dedu_sum+'" readonly></td><td> <input type="text" class="form-control" id="tot_rice" value="'+price_sum+'" readonly></td> <td></td><td><input type="text" class="form-control" id="gunny_cut" value="'+gunny_cut+'" readonly></td></tr></tbody></table>';

                    $('#wqsc_dtls').html(string);
                
            });
        });

    $(document).ready(function(){

        function sumValuesOf(className){

            var sum = 0.00;

            $('.'+className+'').each(function(){

                sum += +$(this).val();

            });

            return sum;
        }

          $('#qty').change(function(){

              var amount = 0;
              var tds = 0;
             var qty = $(this).val();
             var rate = parseFloat($('#rate').val());

             amount = parseFloat(qty*rate);
       
             tds =  parseFloat(((qty*rate)*5)/100).toFixed();

              $('#tds_amt').val(tds);

              $('#amount_claimed').val(amount.toFixed(2));

               var round_amount= Math.round(amount);

              $('#tot_amt').val(round_amount);

              $('#paid_amt').val(round_amount-tds);

          
          })

          $('#qty').keyup(function(){

          	  var total = parseFloat($('#tot_rceived').val());

              var amount = parseFloat($('#commn_paid').val());

              var remain_qty = (total-amount);


          
              var qty = $(this).val();
                   
               if(qty > remain_qty){

                 alert("Can Not Greater Than "+remain_qty+" paddy");

                 $('#qty').val("");
                 $('#amount_claimed').val("");
				 $('#tot_amt').val("");
				 $('#tds_amt').val("");
				 $('#paid_amt').val("");

                 $('#submit').attr('type', 'button');

               }
          
          })

        //Commission Details
        $('#intro1').on('change', '.particulars', function(){

            let indexNo = $('.particulars').index(this);

            $.get('<?php echo site_url("paddy/billMasterDetails"); ?>',{

                riceType: $('#rice_type').val(),
                sl_no: $(this).val()

            }).done(function(data){

                let values = JSON.parse(data);
                let action = values.action;
                
                $('.rate_per_qtls:eq('+indexNo+')').val(values.val);

                if(action == 'P'){

                    $('.amounts:eq('+indexNo+')').val(parseFloat(values.val) * parseFloat($('#totPaddy').val()));

                }else if(action == 'C'){

                    $('.amounts:eq('+indexNo+')').val(parseFloat(values.val) * parseFloat($('#totCmr').val()));

                }

            });

        });
        
    });

    

    $('#form').submit(function(event){
           
                var trans_dt = $('#trans_dt').val();
                var d = new Date();
                var month = d.getMonth()+1;
                var day = d.getDate();

                var output = d.getFullYear() + '-' +(month<10 ? '0' : '') + month + '-' +(day<10 ? '0' : '') + day;

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

    $('#form').submit(function(event){

            var tot_rceived =  parseFloat($('#tot_rceived').val());
            var qty         =  parseFloat($('#qty').val());


                if(qty > tot_rceived){

                      alert("Paddy Billed Can not greater than Paddy Received");
                      event.preventDefault();
                    }
                    else{
        
                       $('#submit').attr('type', 'submit');
                       
                }

    });
   

</script>