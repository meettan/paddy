    <div class="wraper">      

        <div class="col-md-6 container form-wraper">   

            <form method="POST"  id="form"  enctype="multipart/form-data"
                action="<?php echo site_url("paddys/add_new/notice_edit");?>" >

                <div class="form-header">
                
                    <h4>Notice Edit</h4>
                
                </div>

                <input type="hidden"  name = "sl_no" id = "sl_no" value="<?php echo $notice->id;?>"/>


                    <div class="form-group row">

                    <label for="dist" class="col-sm-2 col-form-label">Notice Number:</label>

                    <div class="col-sm-10">

                        <input name="number" id="dist_code" 
                        value="<?php echo $notice->number; ?>" class="form-control" >

                    </div>

                    </div>
                <div class="form-group row">

                    <label for="dist" class="col-sm-2 col-form-label">Date:</label>

                    <div class="col-sm-10">

                        <input type="date" name="notice_date" id="dist" 
                        value="<?php echo $notice->notice_date; ?>" class="form-control">

                    </div>

                </div> 

                <div class="form-group row">

                    <label for="dist" class="col-sm-2 col-form-label">PDF File:</label>

                    <div class="col-sm-10">
						<input  type="file" name="userfile" id="userfile" class="form-control " />
                        <input type="hidden" name="image" value="<?php echo $notice->file; ?>" class="form-control" />
						<a href="<?=base_url()?>uploads/notice/<?php if(isset($notice->file)){ echo $notice->file; }  ?>">PDF</a>
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
