    <div class="wraper">      
 
        <div class="col-md-12 container form-wraper" >   

            <form method="POST"  id="form"
                action="<?php echo site_url("paddys/add_new/particulars_edit");?>" >

                <div class="form-header">
                
                    <h4>Parameter Edit</h4>
                
                </div>

                <input type = "hidden"
                       name = "sl_no"
                       id   = "sl_no"
                       value="<?php echo $district_dtls->sl_no;?>"/>


                  
                <div class="form-group row">

                    <label for="param_name" class="col-sm-1 col-form-label">Name:</label>

                    <div class="col-sm-3">

                        <input name="param_name" id="param_name" 
                        value="<?php echo $district_dtls->param_name; ?>" class="form-control" readonly>

                    </div>
                    <label for="cat" class="col-sm-1 col-form-label">Category:</label>
                    <div class="col-sm-3">

                        <input name="cat" id="cat" 
                        value="<?php if($district_dtls->cat == "M"){echo "Mill";}
                        else if($district_dtls->cat == "S"){echo "Society";}else{ echo "Head Office";} ?>" class="form-control" readonly>

                    </div>
                    <label for="action" class="col-sm-1 col-form-label">Action:</label>
                    <div class="col-sm-3">

                        <input name="action" id="action" 
                        value="<?php if($district_dtls->action == "P"){ echo "Paddy"; }
                        else{ echo "Rice";} ?>" class="form-control" readonly>

                    </div>

                   
                </div> 

                <div class="form-group row">

                     <label for="boiled_val" class="col-sm-1 col-form-label">Boiled val:</label>

                    <div class="col-sm-3">

                        <input name="boiled_val" id="boiled_val" 
                        value="<?php echo $district_dtls->boiled_val; ?>" class="form-control required" />
                    </div>

                    <label for="raw_val" class="col-sm-1 col-form-label">Raw val:</label>

                    <div class="col-sm-3">

                        <input name="raw_val" id="raw_val" 
                        value="<?php echo $district_dtls->raw_val; ?>" class="form-control required" />
                    </div>


                    <label for="tds" class="col-sm-1 col-form-label">Tds:</label>

                    <div class="col-sm-3">

                        <input name="tds" id="tds" 
                        value="<?php echo $district_dtls->tds; ?>" class="form-control" >

                    </div>

                  

                </div>
                <div class="form-group row">
                      <label for="cgst" class="col-sm-1 col-form-label">Cgst:</label>

                    <div class="col-sm-3">

                        <input name="cgst" id="cgst" 
                        value="<?php echo $district_dtls->cgst; ?>" class="form-control" />
                    </div>

                    <label for="dist" class="col-sm-1 col-form-label">Sgst:</label>

                    <div class="col-sm-3">

                        <input name="sgst" id="sgst" 
                        value="<?php echo $district_dtls->sgst; ?>" class="form-control" />
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
