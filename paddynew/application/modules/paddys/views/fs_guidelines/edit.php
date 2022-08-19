    <div class="wraper">      

        <div class="col-md-6 container form-wraper">   

            <form method="POST" 
                action="<?php echo site_url("paddys/add_new/f_fs_guidelines_edit");?>" >

                <div class="form-header">
                
                    <h4>Guidelines Edit</h4>
                
                </div>

                <input type="hidden"
                       name = "sl_no"
                       id   = "sl_no"
                       value="<?php echo $guidlines_dtl->sl_no;?>"
                    />

                <div class="form-group row">

                    <label for="dist" class="col-sm-2 col-form-label">Effective Date:</label>

                    <div class="col-sm-10">

                        <input type="date" name="effective_date" id="effective_date" 
                        value="<?php echo $guidlines_dtl->effective_date;?>" class="form-control " required>

                    </div>

                </div>     


                <div class="form-group row">

                    <label for="dist" class="col-sm-2 col-form-label">Guidlines:</label>

                    <div class="col-sm-10">

                        <input name="guide_lines" id="guide_lines" value="<?php echo $guidlines_dtl->guide_lines; ?>" class="form-control required">

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
