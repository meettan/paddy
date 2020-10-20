    <div class="wraper">      

        <div class="col-md-6 container form-wraper">   

            <form method="POST" 
                action="<?php echo site_url("paddy/billdocuments/edit");?>" >

                <div class="form-header">
                
                    <h4>Document Edit</h4>
                
                </div>

                <input type="hidden"
                        name = "sl_no"
                        id   = "sl_no"
                        value="<?php echo $this->input->get('sl_no');?>"
                    />

                <div class="form-group row">

                    <label for="document" class="col-sm-2 col-form-label">Documents:</label>

                    <div class="col-sm-10">

                        <textarea class="form-control" name="document"><?php echo $docs->documents; ?></textarea>

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