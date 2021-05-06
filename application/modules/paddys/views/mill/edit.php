  
    <div class="wraper">      

        <div class="col-md-6 container form-wraper" style="margin-left: 0px;">

            <form method="POST"  id="form" 
               
                action="<?php echo site_url("paddys/add_new/f_mill_edit");?>" >

                <div class="form-header">
                
                    <h4>Mill Details</h4>
                    
                </div>

                <div class="form-group row">

                    <label for="name" class="col-sm-2 col-form-label">Mill Name:</label>

                    <div class="col-sm-10">

                        <input type="hidden" name="sl_no" value="<?php echo $mill_dtls->sl_no;?>" />
                        <input
                            class="form-control "  required
                            name="name"
                            id="name"
                            value="<?php echo $mill_dtls->mill_name; ?>"  readonly
                        />

                    </div>

                </div>

                <div class="form-group row">

                    <label for="name" class="col-sm-2 col-form-label">Mill Code:</label>

                    <div class="col-sm-10">

                        <input
                            class="form-control"  required readonly
                            name="mill_code"
                            id="mill_code"
                            value="<?php echo $mill_dtls->mill_code; ?>"/>
                    </div>

                    </div>



                <div class="form-group row">

                    
                <label for="block" class="col-sm-2 col-form-label">Block:</label>

                <div class="col-sm-4">

                    <select name="block" id="block" class="form-control required" disabled>
                    <option value="">Select</option>  
                    <?php foreach($block as $bloc)  { ?>  
                    <option value="<?php if(isset($bloc->blockcode)){echo $bloc->blockcode;}?>" <?php if($bloc->blockcode==$mill_dtls->block){echo "selected";}?>><?php if(isset($bloc->block_name)){echo $bloc->block_name;}?></option> 
                    <?php } ?>   
                    </select>
                </div>

                </div>  

               

                <hr>
                
                <div class="form-header">

                    <h4>Bank Details</h4>
                
                </div>

                <div class="form-group row">

                    <label for="bnk_name" class="col-sm-2 col-form-label">Bank Name:</label>

                    <div class="col-sm-10">

                        <input type = "text"
                            class= "form-control"
                            name = "bnk_name"
                            id   = "bnk_name"
                            value="<?php echo $mill_dtls->bank_name;?>"
                        />

                    </div>

                </div>


                <div class="form-group row">


                    <label for="acc_no" class="col-sm-2 col-form-label">Acc No.:</label>

                    <div class="col-sm-4">

                        <input type = "text"
                            class= "form-control"
                            name = "acc_no"
                            id   = "acc_no"
                            value="<?php echo $mill_dtls->acc_no;?>"
                        />

                    </div>
					
					 <label for="ifsc" class="col-sm-2 col-form-label">IFS Code.:</label>

                    <div class="col-sm-4">

                        <input type = "text"
                            class= "form-control"
                            name = "ifsc"
                            id   = "ifsc"
                            value="<?php echo $mill_dtls->ifsc_code;?>"
                        />

                    </div>

                </div>

                <div class="form-group row">

                    <div class="col-sm-10">

                        <input type="submit" class="btn btn-info" value="Save" />

                    </div>

                </div>

            

        </div>
            </form>

    </div>

<script>

    $("#form").validate();

   


       // Listen for click on toggle checkbox
     $('#select-all').click(function(event) {   
        if(this.checked) {
        // Iterate each checkbox
          $(':checkbox').each(function() {
            this.checked = true;                        
           });
        } else {
          $(':checkbox').each(function() {
            this.checked = false;                       
           });
        }
       });

</script>
