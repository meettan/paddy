    <div class="wraper">      

        <div class="row">

            <form method="POST" 
                id="form"
                action="<?php echo site_url("paddy/bill/add");?>" >

                <div class="col-md-6 container form-wraper" style="margin-left: 0px;">
                
                    <div class="form-header">
                    
                        <h4>Bill Entry</h4>
                    
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
                                class="form-control required sch_cd"
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
                                class="form-control required sch_cd"
                                name="mill_name"
                                id="mill_name"
                            >

                                <option value="">Select</option>    

                                <option value="">Select District First</option>    


                            </select>

                        </div>

                    </div>
                    
                    <div class="form-group row">

                        <label for="pool_type" class="col-sm-2 col-form-label">Pool Type:</label>

                        <div class="col-sm-4">

                            <select class="form-control required"
                                    name="pool_type"
                                    id="pool_type"
                                >

                                <option value="">Select</option>

                                <option value="S">State Pool</option>

                                <option value="C">Central Pool</option>

                                <option value="F">FCI</option> 

                            </select>    

                        </div>

                        <label for="rice_type" class="col-sm-2 col-form-label">Rice Type:</label>

                        <div class="col-sm-4">

                            <select class="form-control required"
                                    name="rice_type"
                                    id="rice_type"
                                >

                                <option value="">Select</option>

                                <option value="P">Par Boiled Rice</option>

                                <option value="R">Raw Rice</option>

                            </select>    

                        </div>

                    </div>

                    <div class="form-group row">

                        <label for="bill_no" class="col-sm-2 col-form-label">Bill No.:</label>

                        <div class="col-sm-10">

                            <input type="text"
                                    class="form-control required"
                                    name="bill_no"
                                    id="bill_no"
                                />

                        </div>

                    </div>       

                    <div class="form-group row">  

                        <label for="date" class="col-sm-2 col-form-label">Date:</label>

                        <div class="col-sm-4">

                            <input type="date"
                                class="form-control required"
                                name="date"
                                id="date"
                                />

                        </div>

                        <label for="tot_pdy_delivrd" class="col-sm-2 col-form-label">Total Paddy Quantity:</label>

                        <div class="col-sm-4">

                            <input type="text"
                                    class="form-control"
                                    name="tot_pdy_delivrd"
                                    id="tot_pdy_delivrd"
                                    readonly
                                />

                        </div>

                    </div> 

                    <div class="form-group row">  

                        <label for="paddy_qty" class="col-sm-2 col-form-label">Quantity of Paddy:</label>

                        <div class="col-sm-4">

                            <input type="text"
                                class="form-control"
                                name="paddy_qty"
                                id="paddy_qty"
                                />

                        </div>

                        <label for="generated_bill" class="col-sm-2 col-form-label">Total Bill Generated of Paddy:</label>

                        <div class="col-sm-4">

                            <input type="text"
                                    class="form-control"
                                    name="generated_bill"
                                    id="generated_bill"
                                    readonly
                                />

                        </div>

                    </div> 

                    <div class="form-group row">
                            
                        <label for="trns_distance_paddy" class="col-sm-2 col-form-label">Transport Distance for Paddy:</label>
                        
                        <div class="col-sm-4 radio">
                            
                            <input type="text"
                                class="form-control"
                                name="trns_distance_paddy"
                                id="trns_distance_paddy"
                                />

                        </div>

                        <label for="trns_distance_rice" class="col-sm-2 col-form-label">Transport Distance for Rice:</label>
                        
                        <div class="col-sm-4 radio">
                            
                            <input type="text"
                                class="form-control"
                                name="trns_distance_rice"
                                id="trns_distance_rice"
                                />
                        </div>

                    </div>

                    <div class="form-group row">
                            
                        <label for="inter_dist_transprt" class="col-sm-2 col-form-label">Inter District Transportation Charges:</label>
                        
                        <div class="col-sm-4 radio">
                            
                            <input type="text"
                                class="form-control"
                                name="inter_dist_transprt"
                                id="inter_dist_transprt"
                                />

                        </div>

                    </div>

                    <div class="form-group row">  
                        
                        <label for="butta_cut" class="col-sm-2 col-form-label">Butta Cut:</label>

                        <div class="col-sm-4">

                            <input type="text"
                                    class="form-control"
                                    name="butta_cut"
                                    id="butta_cut"
                                />

                        </div>
                        
                        <label for="gunny_cut" class="col-sm-2 col-form-label">Gunny Cut:</label>

                        <div class="col-sm-4">

                            <input type="text"
                                class="form-control"
                                name="gunny_cut"
                                id="gunny_cut"
                                />

                        </div>

                    </div> 

                    <div class="form-group row">

                        <div class="col-sm-10">

                            <input type="submit" id="submit" class="btn btn-info" value="Save" />

                        </div>

                    </div>

                </div>
            
                <div class="col-md-5 container form-wraper" style="margin-left: 10px; width: 48%;">
                    
                    <div class="form-header">
                        
                        <h4>Supporting Documents</h4>
                    
                    </div>

                    <table class="table table-bordered table-hover">

                        <thead>

                            <tr>

                                <th><input type="checkbox" class="form-check-input" id="all-check"> All</th>
                                <th>Sl. No.</th>
                                <th>Documents</th>

                            </tr>

                        </thead>

                        <tbody> 

                            <?php 
                            
                            if($doc_dtls) {

                                foreach($doc_dtls as $d_list) {

                            ?>

                                    <tr>
                                        
                                        <td><input type="checkbox" class="form-check-input checkbox hidden" name="status"></td>
                                        <td><input type="hidden" class="sl_no" name="sl_no[]" value='{"sl_no":"<?php echo $d_list->sl_no; ?>", "value":"0"}'><?php echo $d_list->sl_no; ?></td>
                                        <td><?php echo $d_list->documents; ?></td>
                                        
                                    </tr>

                            <?php            
                                }
                            }

                            else {

                                echo "<tr><td colspan='10' style='text-align: center;'>No data Found</td></tr>";

                            }

                            ?>
                        
                        </tbody>

                        <tfoot>

                            <tr>
                            
                                <th>Documents</th>
                                <th>Sl. No.</th>
                                <th>Documents</th>

                            </tr>
                        
                        </tfoot>

                    </table>

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

            var i = 0;

            $('#dist').change(function(){

                //For District wise Block
                $.get( 

                    '<?php echo site_url("paddy/blocks");?>',

                    { 

                        dist: $(this).val()

                    }

                ).done(function(data){

                    var string = '<option value="">Select</option>';

                    $.each(JSON.parse(data), function( index, value ) {

                        string += '<option value="' + value.sl_no + '">' + value.block_name + '</option>'

                    });

                    $('#block').html(string);

                });
                
                //For District wise Mill
                $.get( 

                    '<?php echo site_url("paddy/mills");?>',

                    { 

                        dist: $(this).val()

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

                    if((data == '0.000') && (data <= $('#paddy_qty').val())){

                        $('#submit').attr('type', 'button');

                    }
                    else{
        
                        $('#submit').attr('type', 'submit');

                    }
                    
                });

                //Already Bill Generated of Paddy
                $.get('<?php echo site_url("paddy/generated"); ?>',

                    {

                        soc_id:  $('#soc_name').val(),

                        mill_id: $(this).val()

                    }
                
                )
                .done(function(data){
                    
                    $('#generated_bill').val(data);

                });

            });

            $('#paddy_qty').change(function(){

                $('#generated_bill').val(parseInt($('#generated_bill').val()) + parseInt($(this).val()));

                if(parseInt($('#generated_bill').val()) > parseInt($('#tot_pdy_delivrd').val())){
                    
                    $('#submit').attr('type', 'button');

                }
                else{

                    $('#submit').attr('type', 'submit');

                }

            });

        });

    </script>

    <script>
        $(document).ready(function(){

            $('.checkbox').click(function(){
                
                let indexNo = $('.checkbox').index(this),
                    
                value   = JSON.parse($('.sl_no:eq('+indexNo+')').val());
                value.value = 1;

                if($(this).prop("checked") == true){
                    $('.sl_no:eq('+indexNo+')').val(JSON.stringify(value))
                }
                else{
                    value.value = 0;
                    $('.sl_no:eq('+indexNo+')').val(JSON.stringify(value))
                }

            });

            $('#all-check').click(function(){

                if($(this).prop("checked") == true){
                    $('.checkbox').each(function(){
                        $('.checkbox').click();
                    });
                }
                else{
                    
                    $('.checkbox').each(function(){
                        
                        let indexNo = $('.checkbox').index(this),
                        value   = JSON.parse($('.sl_no:eq('+indexNo+')').val());

                        value.value = 0;
                        $('.sl_no:eq('+indexNo+')').val(JSON.stringify(value))

                        $(this).prop('checked', false);
                    });
                }

            });
        });
    </script>

    <script>
        $(document).ready(function(){
            $('#pool_type').change(function(){

                $.get('<?php echo site_url("paddy/maxBillNo")?>',
                    {
                        pool_type: $(this).val()
                    }
                )
                .done(function(data){
                    
                    $('#bill_no').val(data);

                });
            });

            $('#form').submit(function(e){
                
                if($('#all-check').prop('checked')==false){
                    
                    alert('Please Submit Relevant Documents')
                    e.preventDefault();

                }


            })
        });
    </script>