    <div class="wraper">      

        <div class="col-md-6 container form-wraper">   

            <form method="POST" 
                action="<?php echo site_url("paddys/add_new/f_block_edit");?>" >

                <div class="form-header">
                
                    <h4>Block Edit</h4>
                
                </div>

                <input type="hidden" name="sl_no" id="sl_no"  value="<?php echo $block_dtls->sl_no;?>"/>

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

                        <input type="text"  class= "form-control required"
                            name = "name"
                            id   = "name"
                            value="<?php echo $block_dtls->block_name;?>"
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