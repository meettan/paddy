  
<div class="wraper">      
<div class="col-md-3 container"></div>
    <div class="col-md-6 container form-wraper">

        <form method="POST" 
            id="form"
            action="<?php echo site_url("paddys/add_new/billmaster_add");?>" >

            <div class="form-header">
            
                <h4>Bill Master Entry</h4>
            
            </div>

            <div class="form-group row">

                <label for="param_name" class="col-sm-3 col-form-label">Particulas:</label>

                <div class="col-sm-9">

                    <input class="form-control required"
                        name="param_name"
                        id="param_name" />

                </div>

            </div>

            <div class="form-group row">
            
                <label for="boiled" class="col-sm-3 col-form-label">Rate of Par-Boiled Rice:</label>

                <div class="col-sm-9">

                    <input type="number"
                        class="form-control required"
                        name="boiled"
                        id="boiled" />

                </div>

            </div>

            <div class="form-group row">
            
                <label for="raw" class="col-sm-3 col-form-label">Rate of Raw Rice:</label>

                <div class="col-sm-9">

                    <input type = "number"
                        class= "form-control required"
                        name = "raw"
                        id   = "raw"
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
                        <option value="P">Paddy</option>
                        <option value="C">CMR</option>

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