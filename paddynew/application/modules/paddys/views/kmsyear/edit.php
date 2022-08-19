    <div class="wraper">      

        <div class="col-md-6 container form-wraper">   

            <form method="POST" 
                action="<?php echo site_url("paddy/kmsyear/edit");?>" >

                <div class="form-header">
                
                    <h4>KMS Year Edit</h4>
                
                </div>

                <div class="form-group row">

                    <label for="from" class="col-sm-2 col-form-label">Starts From:</label>

                    <div class="col-sm-4">

                        <input type="date" name="from" id="from" value="<?php echo $from; ?>" class="form-control required">

                    </div>

                    <label for="to" class="col-sm-2 col-form-label">Ends To:</label>

                    <div class="col-sm-4">

                        <input type="date" name="to" id="to" value="<?php echo $to; ?>" class="form-control required">

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
