    <div class="wraper">      

        <div class="col-md-6 container form-wraper">

            <form method="POST" id="form"
                action="<?php echo site_url("paddys/add_new/f_block_add");?>" >

                <div class="form-header">
                
                    <h4>Block Entry</h4>
                    <span class="confirm-div" style="float:right; color:green;"></span>
                </div>

                <div class="form-group row">

                    <label for="dist" class="col-sm-2 col-form-label">District:</label>

                    <div class="col-sm-10">
                    <input type="hidden"
                            class="form-control"
                            name="dist" value="<?php echo $dist->district_code;?>"
                            id="di_name" 
                        />
                    <input type="text"
                            class="form-control"
                            name="district_name" value="<?php echo $dist->district_name;?>"
                            id="district_name" readonly
                        />

                    </div>

                </div> 
                <div class="form-group row">

                    <label for="name" class="col-sm-2 col-form-label">Block Code:</label>

                        <div class="col-sm-10">

                            <input type="text"
                                class="form-control"
                                name="blockcode"
                                id="blockcode"/>

                        </div>

                </div>  

                <div class="form-group row">

                <label for="name" class="col-sm-2 col-form-label">Block Name:</label>

                <div class="col-sm-10">

                    <input type="text"
                        class="form-control"
                        name="name"
                        id="name"/>
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
        $(document).ready(function() {

        $('.confirm-div').hide();

        <?php if($this->session->flashdata('msg')){ ?>

        $('.confirm-div').html('<?php echo $this->session->flashdata('msg'); ?>').show();

        });

        <?php } ?>

    $("#form").validate();

</script>

<script>

    $(document).ready(function(){

        $('#emp_no').change(function(){

            $('#category').val($(this).find(':selected').attr('catg'));

        });

    });
    
</script>