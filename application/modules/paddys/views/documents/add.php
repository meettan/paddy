    <div class="wraper">      

        <div class="col-md-6 container form-wraper">

            <form method="POST" 
                id="form"
                action="<?php echo site_url("paddy/billdocuments/add");?>" >

                <div class="form-header">
                
                    <h4>Document Name Entry</h4>
                
                </div>

                <div class="form-group row">

                    <label for="document" class="col-sm-2 col-form-label">Documents:</label>

                    <div class="col-sm-10">

                        <input class="form-control required" name="sl_no" />

                    </div>

                </div> 

                <div class="form-group row">

                    <label for="document" class="col-sm-2 col-form-label">Documents:</label>

                    <div class="col-sm-10">

                        <textarea class="form-control required" name="document"></textarea>

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
