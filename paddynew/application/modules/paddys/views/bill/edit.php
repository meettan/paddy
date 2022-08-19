<div class="wraper">      

    <div class="row">
        
        <form method="POST" 
          id="form"
          action="<?php echo site_url("paddy/bill/edit");?>" >

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

                                <option value="<?php echo $dlist->district_code;?>"
                                <?php echo ($dlist->district_code == $bill_dtls->dist)?'selected':'';?>
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

                    <label for="bill_no" class="col-sm-2 col-form-label">Bill No.:</label>

                    <div class="col-sm-10">

                        <input type="text"
                                class="form-control"
                                name="bill_no"
                                id="bill_no"
                                value="<?php echo $bill_dtls->bill_no; ?>"
                                readonly
                            />

                    </div>

                </div>  

                <div class="form-group row">

                    <label for="pool_type" class="col-sm-2 col-form-label">Pool Type:</label>

                    <div class="col-sm-4">

                        <select class="form-control"
                                name="pool_type"
                                id="pool_type"
                            >

                            <option>Select</option>

                            <option value="S" <?php echo ($bill_dtls->pool_type == 'S')?'selected':''; ?>>State Pool</option>

                            <option value="C" <?php echo ($bill_dtls->pool_type == 'C')?'selected':''; ?>>Central Pool</option>

                            <option value="F" <?php echo ($bill_dtls->pool_type == 'F')?'selected':''; ?>>FCI</option> 

                        </select>    

                    </div>

                    <label for="rice_type" class="col-sm-2 col-form-label">Rice Type:</label>

                    <div class="col-sm-4">

                        <select class="form-control"
                                name="rice_type"
                                id="rice_type"
                            >

                            <option>Select</option>

                            <option value="P" <?php echo ($bill_dtls->rice_type == 'P')?'selected':''; ?>>Par Boiled Rice</option>

                            <option value="R" <?php echo ($bill_dtls->rice_type == 'R')?'selected':''; ?>>Raw Rice</option>

                        </select>    

                    </div>

                </div>     

                <div class="form-group row">  

                    <label for="date" class="col-sm-2 col-form-label">Date:</label>

                    <div class="col-sm-4">

                        <input type="date"
                            class="form-control"
                            name="date"
                            id="date"
                            value="<?php echo $bill_dtls->bill_dt; ?>"
                            />

                    </div>

                    <label for="kms_yr" class="col-sm-2 col-form-label">KMS Year:</label>

                    <div class="col-sm-4">

                        <input class="form-control"
                                name="kms_yr"
                                id="kms_yr"
                                value="<?php echo $bill_dtls->kms_yr; ?>"
                                readonly
                            >

                    </div>

                </div> 

                <div class="form-group row">  

                    <label for="paddy_qty" class="col-sm-2 col-form-label">Quantity of Paddy:</label>

                    <div class="col-sm-4">

                        <input type="text"
                                class="form-control"
                                name="paddy_qty"
                                id="paddy_qty"
                                value="<?php echo $bill_dtls->paddy_qty; ?>"
                            />

                    </div>

                    <label for="trns_distance_paddy" class="col-sm-2 col-form-label">Transport Distance for Paddy:</label>
                
                    <div class="col-sm-4 radio">
                        
                        <input type="text"
                            class="form-control"
                            name="trns_distance_paddy"
                            id="trns_distance_paddy"
                            value="<?php echo $bill_dtls->transport_dist; ?>"
                            />

                    </div>

                </div> 

                <div class="form-group row">
                    
                    <label for="trns_distance_rice" class="col-sm-2 col-form-label">Transport Distance for Rice:</label>
                    
                    <div class="col-sm-4 radio">
                        
                        <input type="text"
                            class="form-control"
                            name="trns_distance_rice"
                            id="trns_distance_rice"
                            value="<?php echo $bill_dtls->transport_dist1; ?>"
                            />
                    </div>

                    <label for="inter_dist_transprt" class="col-sm-2 col-form-label">Inter District Transportation Charges:</label>
                        
                        <div class="col-sm-4 radio">
                            
                            <input type="text"
                                class="form-control"
                                name="inter_dist_transprt"
                                value="<?php echo $bill_dtls->inter_dist_transprt; ?>"
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
                                value="<?php echo $bill_dtls->butta_cut; ?>"
                            />

                    </div>

                    <label for="gunny_cut" class="col-sm-2 col-form-label">Gunny Cut:</label>

                    <div class="col-sm-4">

                        <input type="text"
                                class="form-control"
                                name="gunny_cut"
                                id="gunny_cut"
                                value="<?php echo $bill_dtls->gunny_cut; ?>"
                            />

                    </div>

                </div> 

                <div class="form-group row">

                    <div class="col-sm-10">

                        <input type="submit" class="btn btn-info" value="Save" />

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

                            <th><input type="checkbox" class="form-check-input" checked id="all-check"> All</th>
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
                                    
                                    <td><input type="checkbox" class="form-check-input checkbox" name="status[]" <?php echo ($d_list->status == 1)? 'checked':''; ?>></td>
                                    <td><input type="hidden" class="sl_no" name="sl_no[]" value='{"sl_no":"<?php echo $d_list->sl_no; ?>", "value":"<?php echo $d_list->status; ?>"}'><?php echo $d_list->sl_no; ?></td>
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
                        
                            <th>Submitted</th>
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

        var global_dist = '<?php echo $bill_dtls->dist ?>',
            global_block= '<?php echo $bill_dtls->block ?>';

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

                        if(value.sl_no == '<?php echo $bill_dtls->block ?>'){
                            
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

                        if(value.sl_no == '<?php echo $bill_dtls->mill_id ?>'){
                            
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

                        if(value.sl_no == '<?php echo $bill_dtls->soc_id ?>'){
                            
                            selected = 'selected';

                        }else{

                            selected = '';

                        }

                        string += '<option value="' + value.sl_no + '"'+ selected +'>' + value.soc_name + '</option>'

                    });

                    $('#soc_name').html(string);

                });

            }

        millGroup('<?php echo $bill_dtls->dist ?>');

        socGroup( '<?php echo $bill_dtls->block ?>');

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
                    if($(this).prop("checked") == false){
                        $(this).click();
                    }
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

        $('#form').submit(function(e){
            
            if($('#all-check').prop('checked')==false){
                
                alert('Please Submit Relevant Documents')
                e.preventDefault();

            }


        })
    });
</script>