<div class="wraper">      
<div class="col-md-2"></div>
    <div class="col-md-8 container form-wraper">

        <form method="POST" 
            id="form" onsubmit="return ValidationEvent()"
            action="<?php echo site_url("paddys/transactions/f_delivery_add");?>" >

            <div class="form-header">
            
                <h4>CMR Delivery Entry </h4>
            
            </div>

            <div class="form-group row">

                <label for="block" class="col-sm-2 col-form-label">Block:</label>

                <div class="col-sm-4">

                    <select name="block" id="block" class="form-control required">

                        <option value="">Select</option>  
                        <?php foreach($blocks as $block) { ?>  

                        <option value="<?php if(isset($block->sl_no)) { echo $block->sl_no ;}?>"><?php if(isset($block->block_name)) { echo $block->block_name ;}?></option>    

                        <?php } ?>
                    </select>

                </div>

                <label for="trans_dt" class="col-sm-2 col-form-label">Transaction Date:</label>

                    <div class="col-sm-4">

                        <input type="date"
                                class="form-control required"
                                name="trans_dt"
                                id="trans_dt"
                                value="<?php echo date('Y-m-d');?>"
                            />

                    </div>

            </div>

            <div class="form-group row">

                <label for="soc_name" class="col-sm-2 col-form-label">Society Name:</label>

                <div class="col-sm-10">

                    <select type="text"
                        class="form-control" required
                        name="soc_name"
                        id="soc_name">

                        <option value="">Select</option>    

                        <option value="">Select Block First</option>    

                    </select>    

                </div>

            </div>  

            <div class="form-group row">

                <label for="mill_name" class="col-sm-2 col-form-label">Mill Name:</label>

                <div class="col-sm-10">

                    <select type="text"
                        class="form-control"  required
                        name="mill_name"
                        id="mill_name">

                        <option value="">Select</option>    

                        <option value="">Select Society First</option>    


                    </select>

                </div>

            </div>  

            <div class="form-group row">

                <label for="mill_name" class="col-sm-2 col-form-label">Do Number:</label>

                <div class="col-sm-10">

                    <select type="text"
                        class="form-control"  required
                        name="do_number"
                        id="do_number">

                        <option value="">Select</option>    
                        <option value="">Select Mill </option>    


                    </select>

                </div>

                </div>  

            <div class="form-group row">

            <label for="tot_do_isseued" class="col-sm-2 col-form-label">CMR TYPE:</label>

                <div class="col-sm-4">

                     <input type="hidden"
                            class="form-control"
                            name="rice_types"
                            id="rice_types" value=""
                            readonly
                        />

                    <input type="text"
                            class="form-control"
                            name="rice_type"
                            id="rice_type" value=""
                            readonly
                        />

                </div>

                <label for="tot_do_isseued" class="col-sm-2 col-form-label">Total DO Issued:</label>

                <div class="col-sm-4">

                    <input type="text"
                            class="form-control"
                            name="tot_do_isseued"
                            id="tot_do_isseued"
                            readonly
                        />

                </div>

            </div>

            <div class="form-group row">

                <label for="state_pool_isseued" class="col-sm-2 col-form-label">State Pool:</label>

                <div class="col-sm-2">

                    <input type="text"
                        class="form-control"
                        name="state_pool_isseued"
                        id="state_pool_isseued"
                        readonly
                    />   

                </div>

                <label for="central_pool_isseued" class="col-sm-2 col-form-label">Central Pool:</label>

                <div class="col-sm-2">

                    <input type="text"
                        class="form-control"
                        name="central_pool_isseued"
                        id="central_pool_isseued"
                        readonly
                    />

                </div>   

                <label for="fci_isseued" class="col-sm-2 col-form-label">FCI:</label>

                <div class="col-sm-2">

                    <input type="text"
                        class="form-control"
                        name="fci_isseued"
                        id="fci_isseued"
                        readonly
                    />

                </div>                 

            </div>

            <div class="form-header">
            
                <h4>CMR Delivery</h4>
            
            </div>

            <div class="form-group row">


            <label for="dist" class="col-sm-2 col-form-label">District:</label>

            <div class="col-sm-4">

                <select name="dist" id="dist" class="form-control required">
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

            <label for="dist" class="col-sm-2 col-form-label">Deliver Date:</label>

            <div class="col-sm-4">

                    <input type="date"
                            class="form-control required"
                            name="delivery_dt"
                            id="delivery_dt"
                            value="<?php echo date('Y-m-d');?>"
                        />

                    </div>

            </div>

            <div class="form-group row">

                    <label for="goodown_name" class="col-sm-2 col-form-label">Godown:</label>

                    <div class="col-sm-10">

                        <input type="text"
                            class="form-control"
                            name="goodown_name"
                            id="goodown_name"
                            style="text-align:"
                        />

                    </div> 
            </div>

            <div class="form-group row">

                    <label for="inter_dist" class="col-sm-2 col-form-label">Inter District:</label>

                    <div class="col-sm-4">

                          <select name="inter_dist" class="form-control ">
                            <option value="Y" >Yes</option>
                            <option value="N" >No</option>
                        </select>
                   <!--       <input type="text"
                        class="form-control "
                        name="inter_dist" value="" readonly 
                        id="inter_dist"/>   --> 

                    </div> 
                    <label for="rm_gd_dist" class="col-sm-2 col-form-label">Mill Godown Distance:</label>

                    <div class="col-sm-4">

                        <input type="text"
                            class="form-control"
                            name="rm_gd_dist"
                            id="rm_gd_dist"
                            style="text-align:"
                        />

                    </div> 
            </div>
            <div class="form-group row">

                <label for="tot_cmr_delivery" class="col-sm-2 col-form-label">Qty Delivered:</label>

                <div class="col-sm-4">

                    <input type="text"
                        class="form-control"
                        name="tot_cmr_delivery"
                        id="tot_cmr_delivery"
                        style="text-align: center"
                    />

                </div>

                <label for="pro_cmr_delivery" class="col-sm-2 col-form-label">Prograssive CMR Delivered:</label>

                <div class="col-sm-4">

                        <input type="text"
                            class="form-control"
                            name="pro_cmr_delivery"
                            id="pro_cmr_delivery" readonly
                            style="text-align: center"
                        />

                </div>
               
            </div>   
            <div class="form-group row">
                <label for="state_pool" class="col-sm-2 col-form-label">State Pool:</label>

                <div class="col-sm-2">

                    <input type="text"
                        class="form-control delivery_type"
                        name="state_pool" id="state_pool"/>   

                </div>

                <label for="central_pool" class="col-sm-2 col-form-label">Central Pool:</label>

                <div class="col-sm-2">

                    <input type="text"
                        class="form-control delivery_type"
                        name="central_pool"
                        id="central_pool"
                    />

                </div>   

                <label for="fci" class="col-sm-2 col-form-label">FCI:</label>

                <div class="col-sm-2">

                    <input type="text"
                        class="form-control delivery_type"
                        name="fci"
                        id="fci"/>

                </div>                 

            </div>

            
            <div class="form-group row">


                <label for="tot_cmr_delivery" class="col-sm-5 col-form-label">CMR yet To be delivered(Current Do Number):</label>

                <div class="col-sm-7">

                    <input type="text"
                        class="form-control"
                        name="cmr_yet_to_be_delivery_as_do_number"
                        id="cmr_yet_to_be_delivery_as_do_number"
                        style="text-align: center"
                        readonly
                    />

                </div>                    

                </div> 

            <div class="form-group row">

                <div class="col-sm-10">

                    <input type="submit" id="submit" class="btn btn-info" value="Save" />

                </div>

            </div>

        </form>

    </div>

</div>

<script>

//$("#form").validate();

$( ".sch_cd" ).select2();

$('#form').submit(function(e) {
    //e.preventDefault();
    var tot_cmr_delivery = parseFloat($('#tot_cmr_delivery').val());
    var state_pool = parseFloat($('#state_pool').val());
    var central_pool = parseFloat($('#central_pool').val());
    var fci = parseFloat($('#fci').val());

   
 
    if ((state_pool+central_pool+fci)  > tot_cmr_delivery) {
        alert("Pool Calculation is wrong");
         
        return false;
        e.preventDefault();
    }
    
    
   
  });

</script>

<script>

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
                
                //For Society wise Mill
                $.post( 
                    '<?php echo site_url("paddys/transactions/f_soc_mills");?>',

                    { 

                        soc_id: $(this).val()

                    }

                ).done(function(data){

                    var string = '<option value="">Select</option>';

                    $.each(JSON.parse(data), function( index, value ) {

                        string += '<option value="' + value.sl_no + '">' + value.mill_name + '</option>'

                    });

                    $('#mill_name').html(string);

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

                    $('#do_number').html(string);
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
                    $('#rice_types').val("P");
                }else{
                    $('#rice_type').val("Raw Rice");
                    $('#rice_types').val("R");
                }
                
                $('#tot_do_isseued').val(temp.tot);
                $('#state_pool_isseued').val(temp.sp);
                $('#central_pool_isseued').val(temp.cp);
                $('#fci_isseued').val(temp.fci);
                $('#goodown_name').val(temp.goodown_name);
                $('#tot_cmr_delivery').val(temp.tot);
                $('#pro_cmr_delivery').val(temp.tot);
                $('#state_pool').val(temp.sp);
                $('#central_pool').val(temp.cp);
                $('#fci').val(temp.fci);
                $('#cmr_yet_to_be_delivery_as_do_number').val("0.00000");
                $('#inter_dist').val(temp.inter_dist);
                $('#rm_gd_dist').val(temp.rm_gd_dist);

                var optionValue  = temp.dist;
               $("#dist").val(optionValue).find("option[value=" + optionValue +"]").attr('selected', true);

                if(temp.tot == '0.000'){

                    $('#submit').attr('type', 'button');

                }
                // else{

                //     $('#submit').attr('type', 'submit');

                // }

            });

        });

        $('#tot_cmr_delivery').keyup(function(){

                //Progressive Paddy Procurement
                $.get('<?php echo site_url("paddys/transactions/progressive_cmr_delivery"); ?>',

                    {
                        soc_id:  $('#soc_name').val(),

                        mill_id:  $('#mill_name').val(),

                        do_number: $('#do_number').val()

                    }

                )
                .done(function(data){


                    let temp = JSON.parse(data);

                    var rum = parseFloat(temp.tot);

                    var jum = parseFloat($('#tot_do_isseued').val());

                    var gum = parseFloat($('#tot_cmr_delivery').val());

                    

                    var sum =  rum + gum;
                    
                    $('#pro_cmr_delivery').val(sum);

                    var tum = parseFloat($('#pro_cmr_delivery').val());

                    $('#cmr_yet_to_be_delivery_as_do_number').val((jum-tum).toFixed(5));
                });
                    
                });

        $('.delivery_type').change(function(){
            
            let total = 0;

           // $("#tot_cmr_delivery").val('');
  
            $('.delivery_type').each(function(){
                
                total += +$(this).val();
                
            });

            if(total <= $('#tot_cmr_delivery').val()){

              //  $("#tot_cmr_delivery").val(total);

                $('#submit').attr('type', 'submit');

            }
            else{

                $('#submit').attr('type', 'button');

            }

        });

        

    });
                $(document).ready(function(){

            $('.offer_type').change(function(){
                
                let total = 0;

            // $("#tot_do_issue").val('');

                $('.offer_type').each(function(){
                    
                    total += +$(this).val();
                    
                });

                if(total <= $('#tot_do_issue').val()){

                    $('#submit').attr('type', 'submit');

                }
                else{

                    $('#submit').attr('type', 'button');

                }
            });

            });

            function ValidationEvent() {
                    // Storing Field Values In Variables
                    var tot_do_isseued = parseFloat(document.getElementById("tot_do_isseued").value);
                    var pro_cmr_delivery = parseFloat(document.getElementById("pro_cmr_delivery").value);
                 
                  
                    
                    if (pro_cmr_delivery > tot_do_isseued) {
                        alert("Progressive CMR Delivery Can Not Be Greater than Total Do Issue!");
                        return false;
                    
                    } else {
                      
                        return true;
                      }
                        
                        }

                        $("#dist").change(function(){

        var current_dist = <?php echo $this->session->userdata['loggedin']['branch_id'];?>;
        var dist         = $(this).val();

        if(current_dist == dist)
            {
                 $("#inter_dist").val("N");
            }else{

                     $("#inter_dist").val("Y");
                 }

          

        });
                

</script>
