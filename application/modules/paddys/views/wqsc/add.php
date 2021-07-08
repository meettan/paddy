<div class="wraper">      
    <div class="col-md-12 container form-wraper" >

        <form method="POST"  id="form"   action="<?php echo site_url("paddys/transactions/f_wqsc_add");?>" >

            <div class="form-header">
            
                <h4>WQSC </h4>
            
            </div>

            <div class="form-group row">

            <label for="tot_do_isseued" class="col-sm-2 col-form-label">CS No:</label>

                    <div class="col-sm-4">

                        <input type="text"
                                class="form-control" required
                                name="wqsc_no" id="wqsc_no" value="" />
                    </div>

               <label for="wqsc_date" class="col-sm-2 col-form-label">Wqsc Date:</label>

               <div class="col-sm-4">
                     <input type="date" class="form-control" name="wqsc_date"  id="wqsc_date" required
                     value="<?php echo date("Y-m-d");?>"/>
                </div>

            </div>

            <div class="form-group row">
                <label for="block" class="col-sm-2 col-form-label">Rice Mill Wise QC no:</label>

                <div class="col-sm-4">

                      <input type="text" class="form-control" name="rice_mill_qc_no"  id="rice_mill_qc_no" value=""/>
                </div>

                 <label for="block" class="col-sm-2 col-form-label">Block:</label>

                <div class="col-sm-4">

                    <select name="block" id="block" class="form-control" required>

                        <option value="">Select</option>  
                        <?php foreach($blocks as $block) { ?>  

                        <option value="<?php if(isset($block->sl_no)) { echo $block->sl_no ;}?>"><?php if(isset($block->block_name)) { echo $block->block_name ;}?></option>    

                        <?php } ?>
                    </select>

                </div>

            

            </div>

            <div class="form-group row">
               
                <label for="Society" class="col-sm-2 col-form-label">Society Name:</label>

                <div class="col-sm-4">

                    <select type="text" class="form-control" name="soc_name" id="soc_name" required>

                        <option value="">Select</option>    
                        <option value="">Select Block First</option>    

                    </select>
                </div>

                <label for="mill_name" class="col-sm-2 col-form-label">Mill Name:</label>

                <div class="col-sm-4">

                    <select type="text" class="form-control" name="mill_name" id="mill_name" required>

                        <option value="">Select</option>    
                        <option value="">Select Society First</option>    

                    </select>
                </div>

            </div>  
            <div class="form-group row">

                    <label for="mill_name" class="col-sm-2 col-form-label">Memo Number(Do Number):</label>

                <div class="col-sm-4">

                     <select type="text" class="form-control" name="memo_no" id="memo_no" required>

                        <option value="">Select</option>    
                        <option value="">Select Society First</option>    

                    </select>
           
                </div>

                    <label for="mill_name" class="col-sm-2 col-form-label">Pool:</label>

                <div class="col-sm-4">

                <select type="text" class="form-control" name="pool" id="pool" required>

                    <option value="">Select Pool</option>    
                    <option value="C" >CENTRAL</option> 
                    <option value="S">STATE</option> 
                    <option value="F">FCI</option>     

                </select>
             </div>

            </div>  

                 <div class="form-group row">

             <label for="mill_name" class="col-sm-2 col-form-label">Goodown Name:</label>

                <div class="col-sm-4">

                <input type="text" class="form-control" name="goodown_name"  id="goodown_name" value=""/>
                </div>

       

                  <label for="dist" class="col-sm-2 col-form-label">Goodown District:</label>

                    <div class="col-sm-4">

                        <select name="goodown_dist" id="goodown_dist" class="form-control" required>
                            <option value="">Select</option>
                            <?php
                                foreach($dist as $dlist){
                            ?>
                                <option value="<?php echo $dlist->district_code;?>"><?php echo $dlist->district_name;?></option>
                            <?php
                                }
                            ?>     
                        </select>
                    </div>
               
            </div> 
             <div class="form-group row">

                <label for="" class="col-sm-2 col-form-label">Memo Date</label>

                    <div class="col-sm-4">
                        <input type="hidden" name="memo_dt" id="memo_dt"/>
                        <input type="text"
                                class="form-control"
                                name="viewonly" id="memo_dts" value="" readonly />
                    </div>

                  <label for="" class="col-sm-2 col-form-label">Variety of Rice:</label> 

                    <div class="col-sm-4">

                        <input type="hidden"
                                class="form-control"
                                name="rice_type"
                                id="rice_type" value="" readonly />
                                <input type="text"
                                class="form-control"
                                name="ricetypes"
                                id="ricetypes" value="" readonly />
                    </div>
             </div> 

            <div class="form-group row">

                    <label for="tot_do_isseued" class="col-sm-2 col-form-label">Quantity of CMR for Society-Mill:</label>

                    <div class="col-sm-4">

                    <input type="text"
                            class="form-control" readonly
                            name="quantity_cmr"
                            id="quantity_cmr"  />
                    </div>

                    <label for="tot_do_isseued" class="col-sm-2 col-form-label">Rice Bag Type:</label>

                    <div class="col-sm-4">


                      <input type="radio" id="radio_1" name="bag_type" value="1" checked>
                        <label for="male" style="margin-right: 10px;">Gunny</label>
                        <input type="radio" id="radio_2" name="bag_type" value="2">
                        <label for="female">SDPE/PP</label>

                    <!-- <input type="text"
                            class="form-control" readonly
                            name="rate_per_quintal"
                            id="rate_per_quintal"  /> -->
                    </div>

             </div>

            <div class="form-group row">

                    <label for="tot_do_isseued" class="col-sm-2 col-form-label">Corrosponding Value Of Paddy:</label>

                    <div class="col-sm-4">

                    <input type="text"
                            class="form-control" readonly
                            name="curr_paddy_cmr"
                            id="curr_paddy_cmr" />
                    </div>

                    <label for="tot_do_isseued" class="col-sm-2 col-form-label">Rate Per Quintal:</label>

                    <div class="col-sm-4">

                    <input type="text"
                            class="form-control" readonly
                            name="rate_per_quintal"
                            id="rate_per_quintal"  />
                    </div>

                
            </div>
           
            <div class="form-group row">
                 <label for="dist" class="col-sm-2 col-form-label">Remarks:</label>

                <div class="col-sm-10">
                <textarea class="form-control" name="remarks"></textarea>
                
                </div>
            </div>
             <table class="table">

                <thead>

                    <tr>
                        
                        <th width="15%">Wqsc No</th>
                       <!--  <th style="width:7%">Date</th> -->
                        <th width="7%">No of gunny</th>
                        <th>Quantity(in Qtl.)</th>
                      
                        <th>Moisture Extra</th>
                        <th>Deduction Price for Moisture</th>
                        <th>Price</th>
                        <th>Avg. Wt empty Gunny(in Gram)</th>
                        <th>Gunny Cut</th>
                        <th><button type="button" class="btn btn-success addAnotherRow"><i class="fa fa-plus"></i></button></th>

                    </tr>

                </thead>

                <tbody id="intro1" class="tables">
                    
                    <tr>
                        <td><input type="text" class="form-control sub_wqsc" style="width:200px" name="sub_wqsc[]" required></td>
                      <!--   <td><input type="date" class="form-control trans_dt"  name="trans_dt[]" required value="<?php //echo date("Y-m-d");?>"></td> -->
                        <td><input type="text" class="form-control no_gunny" name="no_gunny[]" value=0 required></td>
                        <td><input type="text" class="form-control quantity" name="quantity[]" value=0 required></td>
                        <td><input type="text" class="form-control moisture_extra" name="moisture_extra[]" value=0 required></td>
                        <td><input type="text" class="form-control moisture_ext_amt" name="moisture_ext_amt[]" value=0 required></td>
                        <td><input type="text" class="form-control tot_price" style="width:135px" name="tot_price[]" value=0 required></td>
                        <td><input type="text" class="form-control avg_wt_empty_gunny" name="avg_wt_empty_gunny[]" value=0></td>
                        <td><input type="text" class="form-control gunny_cut" name="gunny_cut[]" value=0></td>
                        <td><button type="button" class="btn btn-danger removeRow"><i class="fa fa-remove"></i></button></td>
                    </tr>


                </tbody> 
                <tfooter>
                     <tr>
                        <td colspan="1">Total</td>
                        <td> <input type="text" class="form-control" id="gunnt_total" readonly></td> 
                        <td> <input type="text" class="form-control" id="cmr_total" readonly></td> 
                        
                        <td></td>
                        <td> <input type="text" class="form-control" id="tot_deduction" readonly></td> 
                        <td> <input type="text" class="form-control" id="tot_rice" readonly></td> 
                        <td></td>
                        <td></td>
                      
                    </tr>
                </tfooter>
               
            </table>
                

            <div class="form-group row">

                <div class="col-sm-10">

                    <input type="submit" id="submit" class="btn btn-info" value="Save" />

                </div>

            </div>

        </form>

    </div>

</div>



<script>


      $(document).ready(function(){

        $('.addAnotherRow').click(function(){

            let row = '<tr>' +
                        '<td><input type="text" class="form-control sub_wqsc"style="width:200px" name="sub_wqsc[]" required></td>' +
                        // '<td><input type="date" class="form-control trans_dt" name="trans_dt[]" value="<?php //echo date("Y-m-d");?>" required></td>' +
                        '<td><input type="text" class="form-control no_gunny" name="no_gunny[]" value=0 required></td>' +
                        '<td><input type="text" class="form-control quantity" name="quantity[]" value=0 required></td>' +
                        '<td><input type="text" class="form-control moisture_extra" name="moisture_extra[]" value="0" required></td>' +
                        '<td><input type="text" class="form-control moisture_ext_amt" name="moisture_ext_amt[]" value=0></td>' +
                        '<td><input type="text" class="form-control tot_price" style="width:135px" name="tot_price[]" value=0></td>'+
                        '<td><input type="text" class="form-control avg_wt_empty_gunny" name="avg_wt_empty_gunny[]" value=0></td>' +
                        '<td><input type="text" class="form-control gunny_cut" name="gunny_cut[]" value=0></td>' +
                        '<td><button type="button" class="btn btn-danger removeRow"><i class="fa fa-remove"></i></button></td>' +
                    '</tr>';

            $('#intro1').append(row);

        });

    });

    $("#intro1").on('click', '.removeRow',function(){

        console.log("data");
            
            $(this).parents('tr').remove();

            // $('.tot_paddy').val(sumValuesOf('qty_paddy'));
            // $('.tot_cmr').val(sumValuesOf('qty_cmr'));
            // $('.tot_butta').val(sumValuesOf('qty_butta'));
            
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

     // start of doc ready.
   $("#soc_name").change(function(e){
   
      var soc_id = $(this).val(); // anchors do have text not values.

    
        $.ajax({

            url: '<?php echo base_url();?>index.php/paddys/transactions/f_connected_mill_society',
            data: {'soc_id': soc_id}, // change this to send js object
            type: "post",
            dataType: 'json',
            success: function(data){
               //document.write(data); just do not use document.write
              
               $("#mill_name").find('option').remove();
               $('#mill_name').append(data.html);
          
            }
        });
   });


   });
</script>


 
 <script>

    $(document).ready(function(){

        //Do number By Society and Mill

        $('#mill_name').change(function(){

            $.post('<?php echo site_url("paddys/transactions/getdonumber"); ?>',
            
                {
                    soc_id:  $('#soc_name').val(),

                    mill_id: $(this).val()
                }

            )
            .done(function(data){

                var string = '<option value="">Select</option>';

                    $.each(JSON.parse(data), function( index, value ) {

                        string += '<option value="' + value.do_number + '">' + value.do_number + '</option>'

                    });

                    $('#memo_no').html(string);
            });


            

        });

        $('#do_number').change(function(){
            
            //Progressive Paddy Procurement
            $.get('<?php echo site_url("paddys/transactions/f_totisseued"); ?>',
            
                {
                    soc_id:  $('#soc_name').val(),

                    mill_id: $('#mill_name').val(),

                    do_number:$(this).val()
                }

            )
            .done(function(data){

                let temp = JSON.parse(data);

                if(temp.rice_type=="P"){
                    $('#rice_type').val("Par Bolied");
                }else{
                    $('#rice_type').val("Raw Rice");
                }
                
                $('#tot_do_isseued').val(temp.tot);
                $('#state_pool_isseued').val(temp.sp);
                $('#central_pool_isseued').val(temp.cp);
                $('#fci_isseued').val(temp.fci);
                

                if(temp.tot == '0.000'){

                    $('#submit').attr('type', 'button');

                }
                else{

                    $('#submit').attr('type', 'submit');

                }

            });

        });

        $('#memo_no').change(function(){

                //Progressive Paddy Procurement
                $('select[name^="goodown_dist"] option:selected').attr("selected",null);
                $.post('<?php echo site_url("paddys/transactions/total_cmr_delivery"); ?>',

                    {
                        do_number:$(this).val()

                    }

                )
                .done(function(data){

                    let temp = JSON.parse(data);
                    var dataaa =temp.trans_dt;

                    var curr_date = dataaa.split("-");
                    var dist      = temp.dist;

     
                    $('#memo_dts').val(curr_date[2]+"/"+curr_date[1]+"/"+curr_date[0]);
                    $('#memo_dt').val(dataaa);

                    if(temp.rice_type == "P"){
                         $('#rice_type').val("P");
                          $('#ricetypes').val("Par Boiled Rice");
                    }else{
                        $('#rice_type').val("R");
                         $('#ricetypes').val("Raw Rice");
                    }
                   
                    $('#quantity_cmr').val(temp.tot);
                    $('#rate_per_quintal').val(temp.rate);
                    $('#goodown_name').val(temp.goodown_name);
                    $('select[name^="goodown_dist"] option[value="'+dist+'"]').attr("selected","selected");
                
                    $('#tot_price').val(parseFloat(((temp.rate)*(temp.tot)).toFixed()));
                
                    if(temp.cp > 0 ){

                        $('select[name^="pool"] option[value="C"]').attr("selected","selected");

                    }else if(temp.sp > 0){

                        $('select[name^="pool"] option[value="S"]').attr("selected","selected");

                    }else{

                         $('select[name^="pool"] option[value="F"]').attr("selected","selected");
                    }
                   
                });
                    
        });

        $('.delivery_type').change(function(){
            
            let total = 0;

            $("#tot_cmr_delivery").val('');
  
            $('.delivery_type').each(function(){
                
                total += +$(this).val();
                
            });

            if(total <= $('#tot_do_isseued').val()){

                $("#tot_cmr_delivery").val(total);

                $('#submit').attr('type', 'submit');

            }
            else{

                $('#submit').attr('type', 'button');

            }

        });

    
    });

   

            //Millers Payment Details
        $('#intro1').on('change', '.quantity', function(){

            let indexNo = $('.quantity').index(this);

            var paddy    = 0;
            var paddyt   = 0;
            var risetype = $('#rice_type').val();
        
            $('.tot_price:eq('+indexNo+')').val("");         
            $('.paybel:eq('+indexNo+')').val("");

                    var val    = $(this).val();
                    var moisture_ext_amt = parseFloat($('.moisture_ext_amt:eq('+indexNo+')').val());
                    var sum = 0;
                    var price = 0;
                 
                    var tot_amt    = 0.00;
                    var rate   = parseFloat($('#rate_per_quintal').val());

                        var tot_amt = parseFloat(rate * val)-moisture_ext_amt;
                        $('.tot_price:eq('+indexNo+')').val(tot_amt.toFixed(2));
                         // $('.paybel:eq('+indexNo+')').val(payable_amt.toFixed(2));
                      
                       $('.quantity').each(function() {
                            sum += parseFloat($(this).val());
                        });
                       if(risetype == "P" ){

                        paddy  = (sum*100)/68;
                       }else{

                        paddy  = (sum*100)/67;
                       }

                        $('#cmr_total').val(sum.toFixed(2));
                        $('#curr_paddy_cmr').val(paddy.toFixed(2));
                        $('.tot_price').each(function() {

                            price += parseFloat($(this).val());

                        });

                         $('#tot_rice').val(price.toFixed(2));

        });
         $('#intro1').on('change', '.no_gunny', function(){

            let indexNo = $('.no_gunny').index(this);
        

                    var sum    = 0;
                 
                      
                       $('.no_gunny').each(function() {
                            sum += parseFloat($(this).val());
                        });

                         $('#gunnt_total').val(sum);

        });


        $('#intro1').on('change', '.moisture_ext_amt', function(){

            let indexNo = $('.quantity').index(this);

            var price  = 0 ;
        
            $('.tot_price:eq('+indexNo+')').val("");         
            $('.paybel:eq('+indexNo+')').val("");

                    var val    = parseFloat($(this).val());
                    var quantity = parseFloat($('.quantity:eq('+indexNo+')').val());
                    var moisture_ext_amt = parseFloat($('.moisture_ext_amt:eq('+indexNo+')').val());
                   
                 
                    var tot_amt    = 0.00;
                    var rate   = parseFloat($('#rate_per_quintal').val());

                        var tot_amt = parseFloat(rate * quantity);
                        var amt     = parseFloat(tot_amt-val);

                        $('.tot_price:eq('+indexNo+')').val(amt.toFixed(2));
                   
                          var sum_deduct    = 0;
                      
                        $('.moisture_ext_amt').each(function() {
                            sum_deduct += parseFloat($(this).val());
                        });

                        $('#tot_deduction').val(sum_deduct);

                         $('.tot_price').each(function() {
                            price += parseFloat($(this).val());
                        });

                         $('#tot_rice').val(price.toFixed(2));
        });

        $('#intro1').on('change', '.moisture_extra', function(){

            let indexNo = $('.quantity').index(this);
            var price   = 0.00;
        
            $('.tot_price:eq('+indexNo+')').val("");         
            $('.paybel:eq('+indexNo+')').val("");

                    var val    = parseFloat($(this).val());
                    var quantity = parseFloat($('.quantity:eq('+indexNo+')').val());
                    var moisture_extra = parseFloat($('.moisture_extra:eq('+indexNo+')').val());
                   
                 
                    var tot_amt = 0.00;
                    var rate   = parseFloat($('#rate_per_quintal').val());

                        var moisture_amt = parseFloat(rate * quantity * moisture_extra);
                       
                        var tot_amt = parseFloat(rate * quantity);
                        var amt     = parseFloat(tot_amt-moisture_amt);
                             $('.tot_price:eq('+indexNo+')').val(amt.toFixed(2));
                        $('.moisture_ext_amt:eq('+indexNo+')').val(moisture_amt.toFixed(2));
                   
                        var sum_deduct    = 0;
                      
                        $('.moisture_ext_amt').each(function() {
                            sum_deduct += parseFloat($(this).val());
                        });

                        $('#tot_deduction').val(sum_deduct);

                        $('.tot_price').each(function() {
                            price += parseFloat($(this).val());
                        });

                         $('#tot_rice').val(price.toFixed(2));
        });

        //  $('#intro1').on('change', '.moisture_ext_amt', function(){

        //     let indexNo = $('.quantity').index(this);
        //     var prices   = 0.00;
        
        //     $('.tot_price:eq('+indexNo+')').val("");         
        //     $('.paybel:eq('+indexNo+')').val("");

        //             var val    = parseFloat($(this).val());
        //             var quantity = parseFloat($('.quantity:eq('+indexNo+')').val());
        //             var moisture_extra = parseFloat($('.moisture_extra:eq('+indexNo+')').val());
                   
                 
        //             var tot_amt = 0.00;
        //             var rate   = parseFloat($('#rate_per_quintal').val());

        //                 var moisture_amt = parseFloat(rate * moisture_extra);
        //                 var tot_amt = parseFloat(rate * quantity);
        //                 var amt     = parseFloat(tot_amt-moisture_amt);
        //                      $('.tot_price:eq('+indexNo+')').val(amt.toFixed(2));
        //                 $('.moisture_ext_amt:eq('+indexNo+')').val(moisture_amt.toFixed(2));
                   
        //                 var sum_deduct    = 0;
                      
        //                 $('.moisture_ext_amt').each(function() {
        //                     sum_deduct += parseFloat($(this).val());
        //                 });

        //                 $('#tot_deduction').val(sum_deduct);

        //                 $('.tot_price').each(function() {

        //                     prices += parseFloat($(this).val());

        //                 });
        //              console.log(prices);
        //                  $('#tot_rice').val(prices.toFixed(2));
        // });


$(document).ready(function () { 

    $("#radio_1, #radio_2").click(function () {


           $.get('<?php echo site_url("paddys/transactions/rice_rate"); ?>',

                    {
                        rice_type: $('#rice_type').val()

                    }

                )
                .done(function(data){

                    let temp = JSON.parse(data);

                      if ($("#radio_2").is(":checked")) {
             
                        $('#rate_per_quintal').val(temp.ppe_rate);

                        }else{

                        $('#rate_per_quintal').val(temp.rate);

                        }
                   
                });          
        
        });

});



</script>
