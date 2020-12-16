    <div class="wraper">      

        <div class="col-md-6 container form-wraper">   

            <form method="POST" 
                action="<?php echo site_url("paddy/submit/edit");?>" >

                <div class="form-header">
                
                    <h4>Submit Edit</h4>
                
                </div>

                <input type="hidden"
                       name = "submit_no"
                       id   = "submit_no"
                       value="<?php echo $submit_dtls->submit_no; ?>"
                    />
                
                <div class="form-group row">
                    
                    <label for="trans_dt" class="col-sm-2 col-form-label">Submit Date:</label>

                    <div class="col-sm-4">

                        <input type="date"
                            class="form-control required"
                            name="trans_dt"
                            id="trans_dt"
                            required
                            value="<?php echo $submit_dtls->submit_date; ?>"
                        />

                    </div>

                    <label for="pool_type" class="col-sm-2 col-form-label">Pool Type:</label>

                    <div class="col-sm-4">

                        <input class="form-control"
                                name="pool_type"
                                id="pool_type"
                                value="<?php echo ($submit_dtls->pool_type)? 'State Pool':'Central Pool'; ?>"
                                readonly
                            >

                    </div>

                </div>

                <div class="form-group row">
                    
                    <label for="bill_nos" class="col-sm-2 col-form-label">Bill No(s):</label>

                    <div class="col-sm-10">

                        <textarea type="text" class="form-control required" name="bill_nos" id="bill_nos" readonly><?php echo implode(',', $bills); ?></textarea>

                    </div>

                </div>

                <div class="form-group row">

                    <label for="submit_amt" class="col-sm-2 col-form-label">Submit Amount:</label>

                    <div class="col-sm-10">

                        <input type="text"
                            class="form-control required"
                            name="submit_amt"
                            id="submit_amt"
                            value="<?php echo $submit_dtls->tot_amt;?>"
                            readonly
                        />

                    </div>

                </div>  

                <div class="form-group row">

                    <div class="col-sm-10">

                        <button type="submit" class="btn btn-info">Save</button>

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

        var global_dist = '<?php echo $submit_dtls->dist ?>',
            global_block= '<?php echo $submit_dtls->block ?>';

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

                        if(value.sl_no == '<?php echo $submit_dtls->block ?>'){
                            
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

                        if(value.sl_no == '<?php echo $submit_dtls->mill_id ?>'){
                            
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

                        if(value.sl_no == '<?php echo $submit_dtls->soc_id ?>'){
                            
                            selected = 'selected';

                        }else{

                            selected = '';

                        }

                        string += '<option value="' + value.sl_no + '"'+ selected +'>' + value.soc_name + '</option>'

                    });

                    $('#soc_name').html(string);

                });

            }

        millGroup('<?php echo $submit_dtls->dist ?>');

        socGroup( '<?php echo $submit_dtls->block ?>');

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

        function payble(billNo){
            $.get( 

                '<?php echo site_url("paddy/payble");?>',

                { 

                    soc_id: $('#soc_name').val(),

                    mill_id: $('#mill_name').val(),

                    bill_no: billNo
                    
                }

            ).done(function(data){

                $('#payble_amt').val(data);

            });
        }
        
        $('#payment_bill_no').change(function(){

            payble($(this).val());

        });

        payble($('#payment_bill_no').val());

    });

</script>