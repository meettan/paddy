    <div class="wraper">      

        <div class="col-md-6 container form-wraper">   

            <form method="POST" 
                action="<?php echo site_url("paddy/paymentreceived/edit");?>" >

                <div class="form-header">
                
                    <h4>Received Edit</h4>
                
                </div>

                <input type="hidden"
                       name = "received_no"
                       id   = "received_no"
                       value="<?php echo $received_dtls->received_no; ?>"
                    />
                
                <div class="form-group row">
                    
                    <label for="trans_dt" class="col-sm-2 col-form-label">Received Date:</label>

                    <div class="col-sm-4">

                        <input type="date"
                            class="form-control required"
                            name="trans_dt"
                            id="trans_dt"
                            required
                            value="<?php echo $received_dtls->received_date; ?>"
                        />

                    </div>

                    <label for="pool_type" class="col-sm-2 col-form-label">Pool Type:</label>

                    <div class="col-sm-4">

                        <input class="form-control"
                                name="pool_type"
                                id="pool_type"
                                value="<?php echo ($received_dtls->pool_type)? 'State Pool':'Central Pool'; ?>"
                                readonly
                            >

                    </div>

                </div>

                <div class="form-group row">
                
                    <label for="payment_type" class="col-sm-2 col-form-label">Payment Type:</label>

                    <div class="col-sm-4">
                        
                        <select name="payment_type" class="form-control required">

                            <option value="">Select</option>

                            <option value="A" <?php echo ($received_dtls->payment_type == 'A')? 'selected' : ''; ?>>Advance</option> 

                            <option value="F" <?php echo ($received_dtls->payment_type == 'F')? 'selected' : ''; ?>>Final</option> 

                        </select>

                    </div>

                    <label for="payment_for" class="col-sm-2 col-form-label">Payment For:</label>

                    <div class="col-sm-4">

                        <select name="payment_for" class="form-control required">

                            <option value="">Select</option>
                            <option value="F&S" <?php echo ($received_dtls->payment_for == 'F&S')? 'selected' : ''; ?>>F & S </option>

                            <?php

                                foreach($dist as $dlist){

                            ?>

                                <option value="<?php echo $dlist->district_code;?>" <?php echo ($received_dtls->payment_for == $dlist->district_code)? 'selected' : ''; ?>><?php echo 'FCI '.$dlist->district_name;?></option>

                            <?php

                                }

                            ?>     

                        </select>
                    </div>
                </div>

                <div class="form-group row">
                    
                    <label for="bill_nos" class="col-sm-2 col-form-label">Bill No(s):</label>

                    <div class="col-sm-10">

                        <textarea type="text" class="form-control required" name="bill_nos" id="bill_nos" readonly><?php echo implode(',', $bills); ?></textarea>

                    </div>

                </div>

                <div class="form-group row">
                    
                    <label for="receivable_amt" class="col-sm-2 col-form-label">Receivable Amount:</label>

                    <div class="col-sm-4">

                        <input type="text"
                            class="form-control"
                            name="receivable_amt"
                            id="receivable_amt"
                            value="<?php echo $received_dtls->receivable_amt;?>"
                            readonly
                        />

                    </div>

                    <label for="received_amt" class="col-sm-2 col-form-label">Received Amount:</label>

                    <div class="col-sm-4">

                        <input type="text"
                            class="form-control required"
                            name="received_amt"
                            id="received_amt"
                            value="<?php echo $received_dtls->tot_amt;?>"
                            readonly
                        />
                        
                    </div>

                </div>  

                <div class="form-group row">

                    <div class="col-sm-10">

                        <button type="received" class="btn btn-info">Save</button>

                    </div>

                </div>

            </form>

        </div>

    </div>    

<script>

    $("#form").validate();

    $( ".sch_cd" ).select2();

</script>
