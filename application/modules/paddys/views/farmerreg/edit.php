    <div class="wraper">      

        <div class="col-md-6 container form-wraper">   

            <form method="POST" 
                action="<?php echo site_url("paddy/farmerreg/edit");?>" >

                <div class="form-header">
                
                    <h4>Farmerreg Edit</h4>
                
                </div>

                <input type="hidden"
                        name = "reg_no"
                        id   = "reg_no"
                        value="<?php echo $farmerreg_dtls->reg_no;?>"
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
                                <?php echo ($dlist->district_code == $farmerreg_dtls->dist)?'selected':'';?>
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

                    <label for="trans_dt" class="col-sm-2 col-form-label">Date:</label>

                    <div class="col-sm-4">

                        <input type="date"
                            class="form-control required"
                            name="trans_dt"
                            id="trans_dt"
                            value="<?php echo $farmerreg_dtls->trans_dt;?>"
                        />

                    </div>

                    <label for="farmer_no" class="col-sm-2 col-form-label">Registered Farmer No:</label>

                    <div class="col-sm-4">

                        <input type="text"
                            class="form-control required"
                            name="farmer_no"
                            id="farmer_no"
                            value="<?php echo $farmerreg_dtls->farmer_no;?>"
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

    var global_dist = '<?php echo $farmerreg_dtls->dist ?>',
        global_block= '<?php echo $farmerreg_dtls->block ?>';

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

                    if(value.sl_no == '<?php echo $farmerreg_dtls->block; ?>'){
                        
                        selected = 'selected';

                    }else{

                        selected = '';

                    }

                    string += '<option value="' + value.sl_no + '"'+ selected +'>' + value.block_name + '</option>'

                });

                $('#block').html(string);

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

                    if(value.sl_no == '<?php echo $farmerreg_dtls->soc_id ?>'){
                        
                        selected = 'selected';

                    }else{

                        selected = '';

                    }

                    string += '<option value="' + value.sl_no + '"'+ selected +'>' + value.soc_name + '</option>'

                });

                $('#soc_name').html(string);

            });

        }

    
    socGroup('<?php echo $farmerreg_dtls->block ?>');
    millGroup('<?php echo $farmerreg_dtls->dist ?>');
    
    $('#block').change(function(){
        
        socGroup($(this).val());

    });

});
</script>