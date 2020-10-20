<div class="wraper">      

<div class="col-md-6 container form-wraper">

    <form method="POST" 
        id="form"
        action="<?php echo site_url("paddy/transaction/edit");?>" >

        <div class="form-header">
        
            <h4>Transaction Edit</h4>
        
        </div>

        <input type="hidden"
                name="trans_cd"
                value="<?php echo $transaction_dtls->trans_cd ;?>"
            />

        <div class="form-group row">

            <label for="dist" class="col-sm-2 col-form-label">District:</label>

            <div class="col-sm-4">

                <select name="dist" id="dist" class="form-control required">

                    <option value="">Select</option>

                    <?php

                        foreach($dist as $dlist){

                    ?>

                        <option value="<?php echo $dlist->district_code;?>"
                        <?php echo ($dlist->district_code == $transaction_dtls->dist)?'selected':'';?>
                        ><?php echo $dlist->district_name;?></option>

                    <?php

                        }

                    ?>     

                </select>

            </div>

            <label for="block" class="col-sm-2 col-form-label">Block:</label>

            <div class="col-sm-4">

                <select name="block" id="block" class="form-control required">

                    <option value="">Select</option>    

                    <option value="">Select District First</option>    

                </select>

            </div>

        </div>    

        <div class="form-group row">

            <label for="soc_name" class="col-sm-2 col-form-label">Society Name:</label>

            <div class="col-sm-10">

                <select type="text"
                    class="form-control sch_cd"
                    name="soc_name"
                    id="soc_name"
                >

                    <option value="">Select</option>    

                    <option value="">Select Block First</option>    

                </select>    

            </div>

        </div>  

        <div class="form-group row">

            <label for="mill_name" class="col-sm-2 col-form-label">Mill Name:</label>

            <div class="col-sm-10">

                <select type="text"
                    class="form-control sch_cd"
                    name="mill_name"
                    id="mill_name"
                >

                    <option value="">Select</option>    

                    <option value="">Select District First</option>    

                </select>

            </div>

        </div>  

        <div class="form-group row">

            <label for="trans_dt" class="col-sm-2 col-form-label">Transaction Date:</label>

            <div class="col-sm-10">

                <input type="date"
                        class="form-control"
                        name="trans_dt"
                        id="trans_dt"
                        value="<?php echo $transaction_dtls->trans_dt ;?>"
                    />

            </div>

        </div>  

        <div class="form-group row">

            <label for="camp_no" class="col-sm-2 col-form-label">Camp No.:</label>

            <div class="col-sm-4">

                <input type="number"
                        class="form-control"
                        name="camp_no"
                        id="camp_no"
                        value="<?php echo $transaction_dtls->camp_no ;?>"
                    />

            </div>

            <label for="farmer_no" class="col-sm-2 col-form-label">Farmer No.:</label>

            <div class="col-sm-4">

                <input type="number"
                        class="form-control"
                        name="farmer_no"
                        id="farmer_no"
                        value="<?php echo $transaction_dtls->farmer_no ;?>"
                    />

            </div>

        </div>  

        <div class="form-group row">

            <label for="progressive" class="col-sm-2 col-form-label">Quantity of Paddy Procurement:</label>

            <div class="col-sm-4">

                <input type="number"
                        class="form-control"
                        name="progressive"
                        id="progressive"
                        value="<?php echo $transaction_dtls->progressive ;?>"
                    />

            </div>

            <label for="delivared_to_mill" class="col-sm-2 col-form-label">Paddy Deliver to Rice Mill:</label>

            <div class="col-sm-4">

                <input type="number"
                        class="form-control"
                        name="delivared_to_mill"
                        id="delivared_to_mill"
                        value="<?php echo $transaction_dtls->delivared_to_mill ;?>"
                    />

            </div>

        </div>  

        <div class="form-group row">

            <label for="resultant_cmr" class="col-sm-2 col-form-label">Resultant CMR:</label>

            <div class="col-sm-4">

                <input type="number"
                        class="form-control"
                        name="resultant_cmr"
                        id="resultant_cmr"
                        value="<?php echo $transaction_dtls->resultant_cmr ;?>"
                    />

            </div>

            <label for="cmr_offered" class="col-sm-2 col-form-label">CMR Offered:</label>

            <div class="col-sm-4">

                <input type="number"
                        class="form-control"
                        name="cmr_offered"
                        id="cmr_offered"
                        value="<?php echo $transaction_dtls->cmr_offered ;?>"
                    />

            </div>

        </div>

        <div class="form-group row">

            <label for="do_isseue" class="col-sm-2 col-form-label">D.O Issued from D.C. F&S:</label>

            <div class="col-sm-4">

                <input type="number"
                        class="form-control"
                        name="do_isseue"
                        id="do_isseue"
                        value="<?php echo $transaction_dtls->do_isseue ;?>"
                    />

            </div>

            <label for="cmr_delivered" class="col-sm-2 col-form-label">CMR Offered:</label>

            <div class="col-sm-4">

                <input type="number"
                        class="form-control"
                        name="cmr_delivered"
                        id="cmr_delivered"
                        value="<?php echo $transaction_dtls->cmr_delivered ;?>"
                    />

            </div>

        </div>  

        <div class="form-group row">

            <label for="delivery_yet" class="col-sm-2 col-form-label">Yet to be deliverd against D.O.:</label>

            <div class="col-sm-4">

                <input type="text"
                        class="form-control"
                        id="delivery_yet"
                        readonly
                    />

            </div>

            <label for="delivery_due" class="col-sm-2 col-form-label">Due Delivery:</label>

            <div class="col-sm-4">

                <input type="text"
                        class="form-control"
                        id="delivery_due"
                        readonly
                    />

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

$("#form").validate();

$( ".sch_cd" ).select2();
</script>

<script>

$(document).ready(function(){

    var global_dist = '<?php echo $transaction_dtls->dist ?>',
        global_block= '<?php echo $transaction_dtls->block ?>';

    function millGroup(dist) {

        //District Wise Block
        $.get( 

            '<?php echo site_url("paddy/blocks");?>',

            { 

                dist: dist

            }

            ).done(function(data){

                var string = '<option value="">Select</option>',
                    selected= '';

                $.each(JSON.parse(data), function( index, value ) {

                    if(value.sl_no == '<?php echo $transaction_dtls->block ?>'){
                        
                        selected = 'selected';

                    }else{

                        selected = '';

                    }

                    string += '<option value="' + value.sl_no + '"'+ selected +'>' + value.block_name + '</option>'

                });

                $('#block').html(string);

            });    


            //For District wise Mill
            $.get( 

                '<?php echo site_url("paddy/mills");?>',

                { 

                    dist: dist

                }

                ).done(function(data){

                var string = '<option value="">Select</option>',
                    selected = '';

                $.each(JSON.parse(data), function( index, value ) {

                    if(value.sl_no == '<?php echo $transaction_dtls->mill_id ?>'){
                        
                        selected = 'selected';

                    }else{

                        selected = '';

                    }

                    string += '<option value="' + value.sl_no + '"'+ selected +'>' + value.mill_name + '</option>'

                });

                $('#mill_name').html(string);

            });
            
           

        } 

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

                    if(value.sl_no == '<?php echo $transaction_dtls->soc_id ?>'){
                        
                        selected = 'selected';

                    }else{

                        selected = '';

                    }

                    string += '<option value="' + value.sl_no + '"'+ selected +'>' + value.soc_name + '</option>'

                });

                $('#soc_name').html(string);

            });

        }

    millGroup('<?php echo $transaction_dtls->dist ?>');

    socGroup( '<?php echo $transaction_dtls->block ?>');

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

    calFunc();

    function calFunc() {

        var do_isseue   = $('#do_isseue').val(),
            cmr_dlvrd   = $('#cmr_delivered').val(),
            resultant   = $('#resultant_cmr').val();

        $('#delivery_yet').val(do_isseue - cmr_dlvrd); 

        $('#delivery_due').val(resultant - cmr_dlvrd); 

    }

    $('#cmr_delivered').change(function(){

         calFunc();

    });

    $('#do_isseue').change(function(){

        calFunc();

    });

});

</script>