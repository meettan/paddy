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

                <label for="mill_type" class="col-sm-2 col-form-label">Mill Type:</label>

                    <div class="col-sm-4">

                        <select class= "form-control" name = "mill_type" id= "mill_type" required>
                            <option value="">Select</option>
                            <option value="P" <?php echo ($mill_dtls->guide_lines_id == 'O')? 'selected' : '';?>>Others</option> 
                            <option value="P" <?php echo ($mill_dtls->guide_lines_id == 'P')? 'selected' : '';?>>Proprietary</option>
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

                      <!--   <input type = "text"
                            class= "form-control"
                            name = "bnk_name"
                            id   = "bnk_name"
                            value="<?php //echo $mill_dtls->bank_name;?>"
                        /> -->

                           <select class= "form-control" name = "bnk_name" id= "bnk_name" required>
                            <option value="">Select a Bank</option>
                                <?php foreach($bank_dtls as $bank){?>
                                <option value="<?php if(isset($bank->sl_no)) { echo $bank->sl_no; }  ?>"
                                    <?php   if($mill_dtls->bank_name == $bank->sl_no) { echo "selected" ;} ?>

                                 ><?php if(isset($bank->bank_name)) { echo $bank->bank_name; }?></option>
                            <?php }?>

                        </select>

                    </div>

                </div>


                <div class="form-group row">


                    <label for="acc_no" class="col-sm-2 col-form-label">Acc No.:</label>

                    <div class="col-sm-4">

                        <input type = "number"
                            class= "form-control"
                            name = "acc_no"
                            id   = "acc_no"
                            value="<?php echo $mill_dtls->acc_no;?>"
                        />

                    </div>
					
					 <label for="ifsc" class="col-sm-2 col-form-label">IFS Code:</label>

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

    //  *** Code Start For Validaton of IFS is Alpha numeric  on 07/05/2021  //

        $('#form').submit(function(event){
           
                var ifsc = $('#ifsc').val();
               
                if (ifsc.match(/[^a-zA-Z0-9 ]/g)) {

                    alert("IFS Code Must Be Alpha Numeric");

                    event.preventDefault();

                }else{

                    // if (!ifsc.match(/[a-z]/)) {

                    //      alert("IFS Code did not Contain Letter!");
                    //      event.preventDefault();
                    //  }else
                      if(!ifsc.match(/[0-9]/)){

                        alert("IFS Code did not Contain Numeric Value!");
                         event.preventDefault();
                       }else{

                        $('#submit').attr('type', 'submit');
                       }

                    
                }

                    
        });

    //  *** Code End For Validaton of IFS is Alpha numeric  on 07/05/2021  // 


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
