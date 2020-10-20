    <div class="wraper">      

        <div class="col-md-6 container form-wraper">

            <form method="POST" id="form"
                action="<?php echo site_url("paddys/add_new/f_block_add");?>" >

                <div class="form-header">
                
                    <h4>Block Entry</h4>
                
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

                    <label for="name" class="col-sm-2 col-form-label">Block Name:</label>

                    <div class="col-sm-10">

                        <input type="text"
                            class="form-control"
                            name="name"
                            id="name"
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

</script>

<script>

    $(document).ready(function(){

        $('#emp_no').change(function(){

            $('#category').val($(this).find(':selected').attr('catg'));

        });

    });
    
</script>