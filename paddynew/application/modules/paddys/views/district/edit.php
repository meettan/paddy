    <div class="wraper">      

        <div class="col-md-6 container form-wraper">   

            <form method="POST"  id="form"
                action="<?php echo site_url("paddys/add_new/f_district_edit");?>" >

                <div class="form-header">
                
                    <h4>District Edit</h4>
                
                </div>

                <input type="hidden"
                       name = "sl_no"
                       id   = "sl_no"
                       value="<?php echo $district_dtls->district_code;?>"
                    />


                    <div class="form-group row">

                    <label for="dist" class="col-sm-2 col-form-label">Code:</label>

                    <div class="col-sm-10">

                        <input name="dist_code" id="dist_code" 
                        value="<?php echo $district_dtls->district_code; ?>" class="form-control" readonly>

                    </div>

                    </div>
                <div class="form-group row">

                    <label for="dist" class="col-sm-2 col-form-label">District:</label>

                    <div class="col-sm-10">

                        <input name="dist" id="dist" 
                        value="<?php echo $district_dtls->district_name; ?>" class="form-control" readonly>

                    </div>

                </div> 

                <div class="form-group row">

                    <label for="dist" class="col-sm-2 col-form-label">District Short Code:</label>

                    <div class="col-sm-10">

                        <input name="dist_sort_code" id="dist_sort_code" 
                        value="<?php echo $district_dtls->dist_sort_code; ?>" 
                        class="form-control required" />
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

</script>
