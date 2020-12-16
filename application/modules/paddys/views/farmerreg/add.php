    <div class="wraper">      

        <div class="col-md-10 container form-wraper">

            <form method="POST" 
                id="form"
                action="<?php echo site_url("paddys/add_new/f_farmreg_add");?>" >

                <div class="form-header">
                
                    <h4>Society's Farmers</h4>
                
                </div>

                <div class="form-group row">

                    <label for="block" class="col-sm-2 col-form-label">Block:</label>

                    <div class="col-sm-3">

                        <select name="block" id="block" class="form-control required">

                            <option value="">Select</option>    

                                <?php  foreach($blocks as $block){   ?>

                                <option value="<?php echo $block->blockcode;?>"><?php echo $block->block_name;?></option>

                                <?php  }   ?>   

                        </select>

                    </div>
                    <label for="soc_name" class="col-sm-2 col-form-label">Society Name:</label>

                    <div class="col-sm-5">

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

                    

                </div> 

                <div class="form-group row">

                    <label for="farm_name" class="col-sm-2 col-form-label">Farmer Name:</label>

                    <div class="col-sm-10">

                        <input type="text"
                            class="form-control required"
                            name="farm_name"
                            id="farm_name"
                        />

                    </div>

                    </div> 
                                    <div class="form-group row">

                <label for="father_name" class="col-sm-2 col-form-label">Father's Name:</label>

                <div class="col-sm-10">

                    <input type="text"
                        class="form-control required"
                        name="father_name"
                        id="father_name"/>

                </div>

                </div>

                <div class="form-group row">

                <label for="land_holding" class="col-sm-2 col-form-label">Land Holding:</label>

                <div class="col-sm-4">

                    <input type="text"
                        class="form-control required"
                        name="land_holding"
                        id="land_holding"
                    />

                </div>

                <label for="farmer_type" class="col-sm-2 col-form-label">Farmer Type:</label>

                <div class="col-sm-4">

                  <select type = "text"  class= "form-control" name = "farmer_type" id= "farmer_type">

                    <option value="Krishak Bandhu Beneficiary (K)">Krishak Bandhu Beneficiary (K)</option>
                    <option value="Land Holder (L)">Land Holder (L)</option>
                    <option value="Share Cropper (C)">Share Cropper (C)</option>

                </select>

                </div>

                </div>  
 
                <div class="form-group row">

                    <label for="trans_dt" class="col-sm-2 col-form-label">Registration Date:</label>

                    <div class="col-sm-4">

                        <input type="date"
                            class="form-control required"
                            name="reg_dt"
                            id="reg_dt"
                        />

                    </div>

                    <label for="reg_no" class="col-sm-2 col-form-label">Registration No:</label>

                    <div class="col-sm-4">

                        <input type="text"
                            class="form-control required"
                            name="reg_no"
                            id="reg_no"
                        />

                    </div>

                </div>  

                    <div class="form-group row">

                        <label for="addhar_no" class="col-sm-2 col-form-label">Addhar No:</label>

                        <div class="col-sm-4">

                            <input type="number"
                                class="form-control required"
                                name="addhar_no"
                                id="addhar_no"
                            />

                        </div>

                        <label for="pan_no" class="col-sm-2 col-form-label">PAN:</label>

                        <div class="col-sm-4">

                            <input type="text"
                                class="form-control required"
                                name="pan_no"
                                id="pan_no"
                            />

                        </div>

                        </div> 

                
                        <div class="form-group row">

                    <label for="epic_no" class="col-sm-2 col-form-label">Epic No:</label>

                    <div class="col-sm-10">

                        <input type="text"
                            class="form-control required"
                            name="epic_no"
                            id="epic_no"
                        />

                    </div>

                    </div>     
                    <div class="form-group row">

                    <label for="address" class="col-sm-2 col-form-label">Address:</label>

                    <div class="col-sm-10">

                    <textarea type="text" class="form-control required" name="address" id="address" aria-required="true"></textarea>

                    </div>

                    </div>   

                    <div class="form-group row">

                    <label for="pin_no" class="col-sm-2 col-form-label">Pin No:</label>

                    <div class="col-sm-4">

                        <input type="number"
                            class="form-control required"
                            name="pin_no"
                            id="pin_no"
                        />

                    </div>

                    </div>   
                    
                    <div class="form-group row">

                    <label for="mobile_number" class="col-sm-2 col-form-label">Mobile No:</label>

                    <div class="col-sm-4">

                        <input type="number"
                            class="form-control required"
                            name="mobile_number"
                            id="mobile_number"
                        />

                    </div>

                    <label for="email" class="col-sm-2 col-form-label">Email:</label>

                    <div class="col-sm-4">

                        <input type="text"
                            class="form-control required"
                            name="email"
                            id="email"
                        />

                    </div>

                    </div>  
                    <div class="form-group row">

                    <label for="account_no" class="col-sm-2 col-form-label">Account No:</label>

                    <div class="col-sm-4">

                        <input type="number"
                            class="form-control required"
                            name="account_no"
                            id="account_no"
                        />

                    </div>

                    <label for="ifsc_code" class="col-sm-2 col-form-label">IFSC:</label>

                    <div class="col-sm-4">

                        <input type="text"
                            class="form-control required"
                            name="ifsc_code"
                            id="ifsc_code"
                        />
                    </div>

                    </div> 

                    <div class="form-group row">

                    <label for="address" class="col-sm-2 col-form-label">Remarks:</label>

                    <div class="col-sm-10">

                    <textarea type="text" class="form-control required" name="remarks" id="remarks" aria-required="true"></textarea>

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

</script>

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
