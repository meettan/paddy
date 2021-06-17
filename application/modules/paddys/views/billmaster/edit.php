  
<div class="wraper">      

    <div class="col-md-3 container"></div>

    <div class="col-md-6 container form-wraper">

        <form method="POST" 
            id="form"
            action="<?php echo site_url("paddys/add_new/billmaster_edit");?>" >

            <div class="form-header">
            
                <h4>Bill Master Entry</h4>
            
            </div>

            <input type="hidden"
                   name="sl_no"
                   value="<?php echo $mm_dtls->sl_no; ?>"
                />   

            <div class="form-group row">

                <label for="param_name" class="col-sm-3 col-form-label">Particulas:</label>

                <div class="col-sm-9">

                    <input
                        class="form-control required"
                        name="param_name"
                        id="param_name"
                        value="<?php echo $mm_dtls->param_name; ?>"
                        readonly
                    />

                </div>

            </div>

            <div class="form-group row">
            
                <label for="boiled" class="col-sm-3 col-form-label">Rate of Par-Boiled Rice:</label>

                <div class="col-sm-9">

                    <input type = "text"
                        class= "form-control required"
                        name = "boiled"
                        id   = "boiled"
                        value="<?php echo $mm_dtls->boiled_val; ?>"
                    />

                </div>

            </div>

            <div class="form-group row">
            
                <label for="raw" class="col-sm-3 col-form-label">Rate of Raw Rice:</label>

                <div class="col-sm-9">

                    <input type = "text"
                        class= "form-control required"
                        name = "raw"
                        id   = "raw"
                        value="<?php echo $mm_dtls->raw_val; ?>"
                    />

                </div>

            </div>

              <div class="form-group row">
            
                <label for="tds" class="col-sm-3 col-form-label">TDS :</label>

                <div class="col-sm-9">

                    <input type = "number"
                        class= "form-control"
                        name ="tds"
                        id   ="tds"
                        value="<?php echo $mm_dtls->tds; ?>"
                    />

                </div>

            </div>
             <div class="form-group row">
            
                <label for="cgst" class="col-sm-3 col-form-label">CGST rt:</label>

                <div class="col-sm-9">

                    <input type = "number"
                        class= "form-control"
                        name = "cgst"
                        id   = "cgst"
                        value="<?php echo $mm_dtls->cgst; ?>"
                    />

                </div>

            </div>
             <div class="form-group row">
            
                <label for="sgst" class="col-sm-3 col-form-label">SGST rt:</label>

                <div class="col-sm-9">

                    <input type = "number"
                        class= "form-control"
                        name = "sgst"
                        id   = "sgst"
                        value="<?php echo $mm_dtls->sgst; ?>"
                    />

                </div>

            </div>

            <div class="form-group row">
            
                <label for="action" class="col-sm-3 col-form-label">Action On:</label>

                <div class="col-sm-9">

                    <select class= "form-control required"
                            name = "action"
                            id   = "action"
                    >   
                        <option value="">Select</option>
                        <option value="P" <?php echo ($mm_dtls->action == 'P')? 'selected':''; ?>>Paddy</option>
                        <option value="C" <?php echo ($mm_dtls->action == 'C')? 'selected':''; ?>>CMR</option>
                        
                    </select>

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