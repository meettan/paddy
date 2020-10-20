    <div class="wraper">      

        <div class="col-md-6 container form-wraper">   

            <form method="POST" 
                action="<?php echo site_url("paddy/paid/edit");?>" >

                <div class="form-header">
                
                    <h4>Paid Edit</h4>
                
                </div>

                <input type="hidden"
                       name = "paid_no"
                       id   = "paid_no"
                       value="<?php echo $paid_dtls->paid_no; ?>"
                    />
                
                <div class="form-group row">
                    
                    <label for="trans_dt" class="col-sm-2 col-form-label">Paid Date:</label>

                    <div class="col-sm-4">

                        <input type="date"
                            class="form-control required"
                            name="trans_dt"
                            id="trans_dt"
                            value="<?php echo $paid_dtls->payment_dt; ?>"
                        />

                    </div>

                    <label for="pool_type" class="col-sm-2 col-form-label">Pool Type:</label>

                    <div class="col-sm-4">

                        <input class="form-control"
                                name="pool_type"
                                id="pool_type"
                                value="<?php echo ($paid_dtls->pool_type)? 'State Pool':'Central Pool'; ?>"
                                readonly
                            >

                    </div>

                </div>

                <div class="form-group row">
                    
                    <label for="bill_nos" class="col-sm-2 col-form-label">Bill No(s):</label>

                    <div class="col-sm-10">

                        <textarea type="text" class="form-control required" name="bill_nos" id="bill_nos" readonly><?php echo implode(',', $bills); ?></textarea>

                    </div>

                </div>

                <div class="form-group row">

                    <label for="payble_amt" class="col-sm-2 col-form-label">Payble Amount:</label>

                    <div class="col-sm-4">

                        <input type="text"
                            class="form-control required"
                            name="payble_amt"
                            id="payble_amt"
                            value="<?php echo $paid_dtls->total_payble; ?>"
                            readonly
                        />

                    </div>

                    <label for="paid_amt" class="col-sm-2 col-form-label">Paid Amount:</label>

                    <div class="col-sm-4">

                        <input type="text"
                            class="form-control required"
                            name="paid_amt"
                            id="paid_amt"
                            value="<?php echo $paid_dtls->amount; ?>"
                            readonly
                        />

                    </div>

                </div>  

                <div class="form-group row">

                    <label for="bank" class="col-sm-2 col-form-label">Bank:</label>

                    <div class="col-sm-10">

                        <select class="form-control required" name="bank" id="bank" required>

                            <option value="">Select Bank</option>

                            <?php foreach($bank as $b_list) {?>

                                <option value="<?php echo $b_list->acc_code;?>" <?php echo ($b_list->acc_code == $paid_dtls->bank)? 'selected':''; ?> >
                                        <?php echo $b_list->bank_name."(".$b_list->ac_no.")"; ?>
                                </option>
                            
                            <?php
                                }
                            ?>

                        </select>

                    </div>
                    
                </div>

                <div class="form-group row">
                    
                    <label for="trans_type" class="col-sm-2 col-form-label">Transaction Type:</label>
                    
                    <div class="col-sm-10">
                            
                        <select class="form-control" name="trans_type" id="trans_type" required>

                            <option value="">Select Transaction</option>
                            <option value="C" <?php echo ($paid_dtls->trans_type == 'C')? 'selected':''; ?>>Cheque</option>
                            <option value="N" <?php echo ($paid_dtls->trans_type == 'N')? 'selected':''; ?>>NEFT</option>

                        </select>
                        
                    </div>	
                    
                </div>

                <div class="form-group row">

                    <label for="chq_no" class="col-sm-2 col-form-label">Cheque No.:</label>

                    <div class="col-sm-4">

                        <input type="text" 
                               class="form-control" 
                               name="chq_no" 
                               id="chq_no"
                               value="<?php echo $paid_dtls->chq_no; ?>"
                               />

                    </div>

                    <label for="chq_dt" class="col-sm-2 col-form-label">Cheque Date:</label> 

                    <div class="col-sm-4">

                        <input type="date" 
                               class="form-control" 
                               name="chq_dt" 
                               id="chq_dt"
                               value="<?php echo $paid_dtls->chq_dt; ?>"
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

<script>

    $("#form").validate();

    $( ".sch_cd" ).select2();

</script>
