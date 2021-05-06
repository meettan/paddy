  
    <div class="wraper">      

        <form method="POST"  onsubmit="return validate_form()"
            id="form" action="<?php echo site_url("paddys/add_new/f_society_edit");?>" >
            
            <div class="col-md-6 container form-wraper" style="margin-left: 0px;">

                <div class="form-header">
                
                    <h4>Society Details</h4>
                    
                </div>

                <div class="form-group row">

                    <label for="name" class="col-sm-2 col-form-label">Society Name:</label>

                    <div class="col-sm-10">

                        <input type="hidden" name="soc_id" value="<?php echo $society_dtls->sl_no;?>" />
                        <input
                            class="form-control required"  name="name"  id="name"  readonly
                            value="<?php echo $society_dtls->soc_name; ?>" />

                    </div>

                </div>

                <div class="form-group row">

                    <label for="name" class="col-sm-2 col-form-label">Society Code:</label>

                    <div class="col-sm-10">

                        <input
                            class="form-control required" name="society_code"  readonly
                            value="<?php echo $society_dtls->society_code; ?>"
                            id="society_code"/>
                    </div>

                </div>
				
				<div class="form-group row">

                    <label for="name" class="col-sm-2 col-form-label">Incharge Name:</label>

                    <div class="col-sm-10">

                        <input
                            class="form-control required" name="society_code"  readonly
                            value="<?php echo $society_dtls->inchargename; ?>"
                            id="society_code"/>
                    </div>

                </div>

              

                <div class="form-group row">

                    <label for="ph_no" class="col-sm-2 col-form-label">Ph No.:</label>

                    <div class="col-sm-4">

                        <input type = "text" readonly
                            class= "form-control required"
                            name = "ph_no"
                            id   = "ph_no"
                            value="<?php echo $society_dtls->ph_no; ?>"
                        />

                    </div>

                                    <label for="block" class="col-sm-2 col-form-label">Block:</label>

                            <div class="col-sm-4">

                            <select name="block" id="" class="form-control required" disabled>
                          
               <option value="">Select</option>  
              


                      <?php                       
                      foreach($block as $bloc)  { ?>  
                      <option value="<?php if(isset($bloc->blockcode)){echo $bloc->blockcode;}?>" <?php if($bloc->blockcode== $society_dtls->block){echo "selected";}?> ><?php if(isset($bloc->block_name)){echo $bloc->block_name;}?></option> 
                      <?php } ?>   
               </select>

                            </div>                 


                </div>


           <div class="form-group row">


                <label for="block" class="col-sm-2 col-form-label">PAN No:</label>

                <div class="col-sm-4">

                <input type = "text"  class="form-control"  name = "pan"  id = "pan_no"   value="<?php echo $society_dtls->pan_no;?>" readonly />
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
                            class= "form-control"  name = "bnk_name"   id= "bnk_name"
                            value="<?php echo $society_dtls->bank_name;?>"
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
                            value="<?php echo $society_dtls->acc_no;?>"
                        />

                    </div>
					
					
					 <label for="ifsc" class="col-sm-2 col-form-label">IFS Code.:</label>

                    <div class="col-sm-4">

                        <input type = "text"
                            class= "form-control"
                            name = "ifsc"
                            id   = "ifsc"
                            value="<?php echo $society_dtls->ifsc_code;?>"
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

</script>

<script>
//function validate_form(){
   //         valid = true;

     //       if($('input[type=checkbox]:checked').length == 0)
     //       {
     //           alert ( "ERROR! Please select at least one checkbox" );
     //           valid = false;
     //       }

     //       return valid;
    //        }

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