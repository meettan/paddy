<div class="wraper">      

  <div class="col-md-12 container form-wraper" >

        <form method="POST" id="form" action="<?php echo site_url("paddys/transactions/wqsc_edit");?>" >

            <div class="form-header">
            
                <h4>WQSC Edit</h4>
            
            </div>

            <input type="hidden" name="trans_no" value="<?php echo $wqsc_dtls->id;?>"/>
            <input type="hidden" name="wqsc_noss" value="<?php echo $wqsc_dtls->wqsc_no;?>"/>
                    <div class="form-group row">

            <label for="tot_do_isseued" class="col-sm-2 col-form-label">CS No:</label>

                    <div class="col-sm-4">

                        <input type="text"
                               class="form-control"
                               name="wqsc_no" id="wqsc_no" value="<?php echo $wqsc_dtls->wqsc_no;?>" readonly/>
                    </div>

               <label for="wqsc_date" class="col-sm-2 col-form-label">Wqsc Date:</label>

               <div class="col-sm-4">
                     <input type="date" class="form-control" name="wqsc_date"  id="wqsc_date" 
                     value="<?php echo $wqsc_dtls->wqsc_date;?>"/>
                </div>

            </div>
              <div class="form-group row">
                <label for="block" class="col-sm-2 col-form-label">Rice Mill Wise QC no:</label>

                <div class="col-sm-4">
                      <input type="text" class="form-control" name="rice_mill_qc_no"  id="rice_mill_qc_no" value="<?php echo $wqsc_dtls->rice_mill_qc_no;?>"/>
                </div>

                  <label for="block" class="col-sm-2 col-form-label">Block:</label>

                <div class="col-sm-4">

                    <select name="block" id="block" class="form-control required" disabled="">

                        <option value="">Select</option>  
                        <?php foreach($blocks as $block) { ?>  

                        <option value="<?php if(isset($block->sl_no)) { echo $block->sl_no ;}?>" 
                                   <?php   if($block->sl_no  == $wqsc_dtls->block) echo "selected"; ?>

                            ><?php if(isset($block->block_name)) { echo $block->block_name ;}?></option>    

                        <?php } ?>
                    </select>

                </div>
               



            </div>

              <div class="form-group row">

          
                <label for="Society" class="col-sm-2 col-form-label">Society Name:</label>

                <div class="col-sm-4">

                    <select type="text" class="form-control" name="soc_name" id="soc_name" disabled="">

                        <option value="">Select</option>    
                        <option value="">Select Block First</option>    

                    </select>
                </div>


                  <label for="mill_name" class="col-sm-2 col-form-label">Mill Name:</label>

                <div class="col-sm-4">

                    <select type="text" class="form-control" name="mill_name" id="mill_name" disabled="">

                        <option value="">Select</option>    
                        <option value="">Select Society First</option>    

                    </select>
                </div>

            </div>  

            <div class="form-group row">

              

                    <label for="mill_name" class="col-sm-2 col-form-label">Memo Number(Do Number):</label>

                    <div class="col-sm-4">

                   <!--      <input type="text" name ="memo_no" id="memo_no" class="form-control" value="<?php //echo $wqsc_dtls->memo_no;?>" readonly> -->

                        <select type="text" class="form-control" name="memo_no" id="memo_no" disabled="">

                            <option value="">Select</option>    
                            <option value="">Select Society First</option>    

                        </select>
                
                    </div>



                    <label for="mill_name" class="col-sm-2 col-form-label">Pool:</label>

                    <div class="col-sm-4">

                    <select type="text" class="form-control" name="pool" id="pool" disabled="">

                        <option value="">Select Pool</option>    
                        <option value="C"   <?php   if($wqsc_dtls->pool == "C") echo "selected"; ?>>CENTRAL</option> 
                        <option value="S" <?php   if($wqsc_dtls->pool == "S") echo "selected"; ?>>STATE</option> 
                        <option value="F" <?php   if($wqsc_dtls->pool == "F") echo "selected"; ?>>FCI</option>     

                    </select>
                   </div>
            </div>


            <div class="form-group row">
               
                <label for="mill_name" class="col-sm-2 col-form-label">Goodown Name:</label>

                <div class="col-sm-4">

                <input type="text" class="form-control" readonly
                name="goodown_name"  id="goodown_name" value="<?php echo $wqsc_dtls->goodown_name;?>"/>
                </div>

                <label for="dist" class="col-sm-2 col-form-label">Goodown District:</label>

                    <div class="col-sm-4">

                        <select name="goodown_dist" id="goodown_dist" class="form-control required" disabled="">
                            <option value="">Select</option>
                            <?php
                                foreach($dist as $dlist){
                            ?>
                                <option value="<?php echo $dlist->district_code;?>" 
                           <?php   if($dlist->district_code  == $wqsc_dtls->goodown_dist) echo "selected"; ?>      
                                    ><?php echo $dlist->district_name;?></option>
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
                                id="rice_type" value="" />

                        <input type="text"
                                class="form-control"
                                name="rice_types"
                                id="rice_types" value="" readonly />
                    </div>

             </div> 

            <div class="form-group row">

                 <label for="tot_do_isseued" class="col-sm-2 col-form-label">Quantity of CMR:</label>

                <div class="col-sm-4">

                    <input type="text"
                            class="form-control" readonly
                            name="quantity_cmr"
                            id="quantity_cmr"  />
                </div>

                 <label for="tot_do_isseued" class="col-sm-2 col-form-label">Rice Bag Type:</label>

                    <div class="col-sm-4">


                       <input type="radio" id="radio_1" name="bag_type" value="1"  <?php if(isset($wqsc_dtls->bag_type) && $wqsc_dtls->bag_type=='1'){ echo "checked";}?>  >
                        <label for="male" style="margin-right: 10px;">Gunny</label>
                        <input type="radio" id="radio_2" name="bag_type" value="2" <?php if(isset($wqsc_dtls->bag_type) && $wqsc_dtls->bag_type=='2'){ echo "checked";}?>>
                        <label for="female">SDPE/PP</label>

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
                            id="rate_per_quintal" />
                </div>

                 

            </div>

            <div class="form-group row">
                <label for="dist" class="col-sm-2 col-form-label">Remarks:</label>
                <div class="col-sm-10">
                <textarea class="form-control" name="remarks" ><?php echo $wqsc_dtls->remarks;?></textarea>
                
                </div>
            </div>

            <table class="table">

                <thead>

                    <tr>
                        
                        <th width="15%">Wqsc No</th>
                        <th style="width:7%">Date</th>
                        <th width="7%">No of gunny</th>
                        <th>Quantity(in Qtl.)</th>
                        <th>Moisture Extra</th>
                        <th>Deduction Price for Moisture</th>
                        <th>Price</th>
                        <th>Avg. Wt empty Gunny(in Gram)</th>
                        <th>Gunny Cut</th>
                       <!--  <th><button type="button" class="btn btn-success addAnotherRow"><i class="fa fa-plus"></i></button></th> -->

                    </tr>

                </thead>

                <tbody id="intro1" class="tables">
                    <?php $gunny = 0;
                            $qnt = 0;
                         $deduct = 0;
                          $price = 0;

                    foreach($wqsc_dtlss as $wqsc){ ?>
                    
                    <tr>
                        <td><input type="text" class="form-control sub_wqsc" style="width:200px" name="sub_wqsc[]" value="<?php echo $wqsc->sub_wqsc;?>" readonly></td>
                        <td><input type="date" class="form-control trans_dt" name="trans_dt[]" value="<?php echo $wqsc->trans_dt;?>" readonly ></td>
                        <td><input type="text" class="form-control no_gunny" name="no_gunny[]" value="<?php echo $wqsc->no_gunny;
                                                                                                                $gunny+= $wqsc->no_gunny;

                        ?>" required></td>
                        <td><input type="text" class="form-control quantity" name="quantity[]" value="<?php echo $wqsc->quantity;
                                                                                                        $qnt+= $wqsc->quantity;
                        ?>" required></td>
                        <td><input type="text" class="form-control moisture_extra" name="moisture_extra[]" required value="<?php echo $wqsc->moisture_extra;?>"></td>
                        <td><input type="text" class="form-control moisture_ext_amt" name="moisture_ext_amt[]" required value="<?php echo $wqsc->moisture_ext_amt;
                             $deduct+= $wqsc->moisture_ext_amt;
                        ?>"></td>
                        <td><input type="text" class="form-control tot_price" style="width:135px" name="tot_price[]" value="<?php echo $wqsc->tot_price;
                                                                                                             $price+= $wqsc->tot_price;
                        ?>" required></td>
                        <td><input type="text" class="form-control avg_wt_empty_gunny" name="avg_wt_empty_gunny[]" value="<?php echo $wqsc->avg_wt_empty_gunny;?>"></td>
                        <td><input type="text" class="form-control gunny_cut" name="gunny_cut[]" value="<?php echo $wqsc->gunny_cut;?>"></td>
                     <!--    <td><button type="button" class="btn btn-danger removeRow"><i class="fa fa-remove"></i></button></td> -->
                    </tr>
                <?php } ?>
                </tbody> 

                 <tfooter>
                     <tr>
                        <td colspan="2">Total</td>
                        <td> <input type="text" class="form-control" id="gunnt_total" value="<?php echo $gunny ;?>"readonly></td> 
                        <td> <input type="text" class="form-control" id="cmr_total" value="<?php echo $qnt ;?>" readonly></td> 
                        
                        <td></td>
                        <td> <input type="text" class="form-control" id="tot_deduction" value="<?php echo $deduct ;?>" readonly></td> 
                        <td> <input type="text" class="form-control" id="tot_rice" value="<?php echo $price ;?>" readonly></td> 
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

    $("#form").validate();

    $( ".sch_cd" ).select2();

</script>

<script>

    $(document).ready(function(){

        
        var paddy = 0;





        var global_dist = '<?php echo $wqsc_dtls->branch_id ?>',
            global_block= '<?php echo $wqsc_dtls->block ?>';

        

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

                        if(value.sl_no == '<?php echo $wqsc_dtls->soc_name ?>'){
                            
                            selected = 'selected';

                        }else{

                            selected = '';

                        }

                        string += '<option value="' + value.sl_no + '"'+ selected +'>' + value.soc_name + '</option>'

                    });

                    $('#soc_name').html(string);

                });

            }

            function millGroup(soc_id) {

                    //For District wise Mill
                    $.post( 

                        '<?php echo site_url("paddys/transactions/f_soc_mills");?>',

                        { 

                            soc_id: <?php echo $wqsc_dtls->soc_name ?>

                        }

                        ).done(function(data){

                        var string = '<option value="">Select</option>',
                            selected = '';

                        $.each(JSON.parse(data), function( index, value ) {

                            if(value.sl_no == '<?php echo $wqsc_dtls->mill_id ?>'){
                                
                                selected = 'selected';

                            }else{

                                selected = '';

                            }

                            string += '<option value="' + value.sl_no + '"'+ selected +'>' + value.mill_name + '</option>'

                        });

                        $('#mill_name').html(string);

                    });

                }

             //   $('#mill_name').change(function(){\

        function doGroup(soc_id,mill_id) {

            $.post('<?php echo site_url("paddys/transactions/getdonumber"); ?>',
            
                {
                    soc_id:  <?php echo $wqsc_dtls->soc_name ?>,

                    mill_id: <?php echo $wqsc_dtls->mill_id ?>
                }

            )
            .done(function(data){

                var string = '<option value="">Select</option>';

                    $.each(JSON.parse(data), function( index, value ) {


                         if(value.do_number == '<?php echo $wqsc_dtls->memo_no ?>'){
                                
                                selected = 'selected';

                            }else{

                                selected = '';

                            }


                        string += '<option value="' + value.do_number + '"'+ selected +'>' + value.do_number + '</option>'

                    });

                    $('#memo_no').html(string);
            });

        };

        function dodatetype(soc_id,mill_id,do_number) {
       
            
            //Progressive Paddy Procurement
            $.post('<?php echo site_url("paddys/transactions/total_cmr_delivery"); ?>',
            
                {
                    soc_id:  '<?php echo $wqsc_dtls->soc_name ?>',

                    mill_id: '<?php echo $wqsc_dtls->mill_id ?>',

                    do_number: '<?php echo $wqsc_dtls->memo_no ?>'
                }

            )
            .done(function(data){

                let temp = JSON.parse(data);
                   console.log(temp);

                    var dataaa =temp.trans_dt;

                    var curr_date = dataaa.split("-");
     
                    $('#memo_dts').val(curr_date[2]+"/"+curr_date[1]+"/"+curr_date[0]);
                    $('#memo_dt').val(dataaa);

                    if(temp.rice_type == "P"){
                         $('#rice_type').val("P");
                         $('#rice_types').val("Par Boiled Rice");

                         paddy  = ((<?php echo $qnt ;?>*100)/68);

                         $('#curr_paddy_cmr').val(paddy.toFixed(3));

                    }else{

                         $('#rice_type').val("R");
                         $('#rice_types').val("Raw Rice");

                         paddy  = (<?php echo $qnt ;?>*100)/67;

                         $('#curr_paddy_cmr').val(paddy.toFixed(3));
                    }
                    $('#quantity_cmr').val(temp.tot);
                  //  $('#rate_per_quintal').val(temp.rate);

                    $('#tot_price').val(parseFloat(((temp.rate)*(temp.tot)).toFixed(2)));

            });

        };

        socGroup( '<?php echo $wqsc_dtls->block ?>');

        millGroup('<?php echo $wqsc_dtls->soc_name ?>');

        doGroup('<?php echo $wqsc_dtls->soc_name ?>','<?php echo $wqsc_dtls->mill_id ?>');

        dodatetype('<?php echo $wqsc_dtls->soc_name ?>','<?php echo $wqsc_dtls->mill_id ?>','<?php echo $wqsc_dtls->memo_no ?>');

        $('#dist').change(function(){

            millGroup($(this).val());

            socGroup('');

        });

        $('#block').change(function(){
            
            socGroup($(this).val());

        });


         $('#mill_name').change(function(){
            
            doGroup($('#soc_name').val(),$(this).val());

        });

          $('#do_number').change(function(){

             dodatetype($('#soc_name').val(),$('#mill_name').val(),$(this).val());

          })

    });


        
      $('#intro1').on('change', '.quantity', function(){

            let indexNo = $('.quantity').index(this);
            var paddy   = 0;
            var risetype = $('#rice_type').val();
        
            $('.tot_price:eq('+indexNo+')').val("");         
            $('.paybel:eq('+indexNo+')').val("");

                    var val    = $(this).val();
                    var moisture_ext_amt = parseFloat($('.moisture_ext_amt:eq('+indexNo+')').val());
                    var sum = 0;
                    var price = 0;
                 
                    var tot_amt    = 0.00;
                    var rate   = parseFloat($('#rate_per_quintal').val());

                        var tot_amt = parseFloat(rate * val);
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

                        $('#cmr_total').val(sum);
                        $('#curr_paddy_cmr').val(paddy.toFixed(2));

                     $('.tot_price').each(function() {
                            price += parseFloat($(this).val());
                        });

                         $('#tot_rice').val(price);

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

            let indexNo = $('.moisture_ext_amt').index(this);
        
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

                        var price    = 0;

                         $('.tot_price').each(function() {
                            price += parseFloat($(this).val());
                        });

                         $('#tot_rice').val(price);
        });

        $('#intro1').on('change', '.moisture_extra', function(){

                 var price = 0 ;

              // var  indexNo  = $(this).index();
            var indexNo = $('.moisture_extra').index(this);
           
            $('.tot_price:eq('+indexNo+')').val("");         
            $('.paybel:eq('+indexNo+')').val("");

                    var val    = parseFloat($(this).val());
                    var quantity = parseFloat($('.quantity:eq('+indexNo+')').val());
                    var moisture_extra = parseFloat($('.moisture_extra:eq('+indexNo+')').val());
                 
                    var tot_amt    = 0.00;
                    var rate   = parseFloat($('#rate_per_quintal').val());

                        var moisture_amt = parseFloat(rate * moisture_extra);
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

                         $('#tot_rice').val(price);
        });



        $('#form').submit(function(event){
           
                var  quantity_cmr = parseFloat($('#quantity_cmr').val());

                var quantity      = 0;

                  $('.quantity').each(function() {
                            quantity += parseFloat($(this).val());
                        });

                    
                    if(quantity.toFixed() != quantity_cmr.toFixed()){

                      alert("Something Went Wrong Please Check Your Total quantity");

                      event.preventDefault();
                    }
                     else 
                        {
                    //  alert("Transaction Date Can Not Be Less Than order Date");

                       $('#submit').attr('type', 'submit');
                       
                      }
            });

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
    
   <?php if(isset($wqsc_dtls->id)){ ?>



     $.get('<?php echo site_url("paddys/transactions/rice_rate"); ?>',

                    {
                        rice_type: '<?php echo $wqsc_dtls->rice_type; ?>'

                    }

                )
                .done(function(data){

                    let temp = JSON.parse(data);

                     <?php     if($wqsc_dtls->bag_type == '2') { ?> 
             
                        $('#rate_per_quintal').val(temp.ppe_rate);

                      <?php    }else { ?> 

                        $('#rate_per_quintal').val(temp.rate);

                     <?php    } ?> 
                   
                });     



   <?php } ?>


});
</script>