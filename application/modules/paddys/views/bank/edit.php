    <div class="wraper">      

        <div class="col-md-6 container form-wraper">   

            <form method="POST"  id="form"
                action="<?php echo site_url("paddys/add_new/f_bank_edit");?>" >

                <div class="form-header">
                
                    <h4>Edit Bank Details</h4>
                
                </div>

                  <div class="form-group row">

                        <label for="sl_no" class="col-sm-2 col-form-label">Sl.No.:</label>

                        <div class="col-sm-10">

                            <input name="sl_no" id="sl_no" 
                            value="<?php echo $bank_dtls->sl_no; ?>" class="form-control" readonly>

                        </div>

                    </div>



                    <div class="form-group row">

                        <label for="bnk" class="col-sm-2 col-form-label">Bank:</label>

                        <div class="col-sm-10">

                            <input name="bnk" id="bnk" 
                            value="<?php if($bank_dtls->bank_id==1){
                                                echo "Yes Bank";
                                         }elseif($bank_dtls->bank_id==2){
                                                echo "Bandhan Bank";
                                         }elseif($bank_dtls->bank_id==3){
                                                echo "Icici Bank";
                                         }elseif($bank_dtls->bank_id==4){
                                                echo "Axis Bank";
                                         }
                                         else{
                                            echo "HDFC Bank";
                                         }    
                                   ?>" class="form-control" 
                            readonly>

                        </div>

                    </div>


                    <div class="form-group row">

                        <label for="brn" class="col-sm-2 col-form-label">Branch:</label>

                        <div class="col-sm-9">

                            <input name="brn" id="brn" class="form-control"
                            value="<?php echo $bank_dtls->branch; ?>" class="form-control">                    
                        </div>

                    </div>

                    <div class="form-group row">

                    <label for="ifs" class="col-sm-2 col-form-label">IFS Code:</label>

                    <div class="col-sm-9">

                        <input name="ifs" id="ifs" class="form-control"
                        value="<?php echo $bank_dtls->ifs; ?>" class="form-control"> 

                    </div>

                </div>

                <div class="form-group row">

                    <label for="acc_no" class="col-sm-2 col-form-label">Account No.:</label>

                    <div class="col-sm-4">

                        <input name="acc_no" id="acc_no" class="form-control" 
                        value="<?php echo $bank_dtls->acc_no; ?>" class="form-control" required>

                    </div>

                    <label for="srt_cd" class="col-sm-1 col-form-label">Short Code:</label>

                    <div class="col-sm-4">

                        <input name="srt_cd" id="srt_cd" class="form-control"
                        value="<?php echo $bank_dtls->short_code; ?>" class="form-control">

                    </div>

                </div>

                <div class="form-group row">

                    <label for="micr" class="col-sm-2 col-form-label">MICR Code.:</label>

                    <div class="col-sm-4">

                        <input name="micr" id="micr" class="form-control"
                        value="<?php echo $bank_dtls->micr_code; ?>" class="form-control">

                    </div>

                    <label for="trans_cd" class="col-sm-1 col-form-label">Trans Code:</label>

                    <div class="col-sm-4">

                        <input name="trans_cd" id="trans_cd" class="form-control"
                        value="<?php echo $bank_dtls->trans_code; ?>" class="form-control">

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
