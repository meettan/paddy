    <div class="wraper">      

        <div class="col-md-6 container form-wraper">

            <form method="POST" 
                id="form"
                action="<?php echo site_url("paddy/paid/add");?>" >

                <div class="form-header">
                
                    <h4>Paid Entry</h4>
                
                </div>

                <div class="form-group row">

                    <label for="trans_dt" class="col-sm-2 col-form-label">Paid Date:</label>

                    <div class="col-sm-4">

                        <input type="date"
                            class="form-control required"
                            name="trans_dt"
                            id="trans_dt"
                        />

                    </div>

                    <label for="pool_type" class="col-sm-2 col-form-label">Pool Type:</label>

                    <div class="col-sm-4">

                        <select class="form-control required"
                                name="pool_type"
                                id="pool_type"
                            >

                            <option value="">Select</option>

                            <option value="S">State Pool</option>

                            <option value="C">Central Pool</option>

                        </select>    

                    </div>

                </div>

                <div class="form-group row">
                    
                    <label for="bill_nos" class="col-sm-2 col-form-label">Bill No(s):</label>

                    <div class="col-sm-10">

                        <textarea type="text" class="form-control required" name="bill_nos" id="bill_nos"></textarea>
                        <span id="wrongBill1" style="color: red;"></span>
                        <br>
                        <span id="wrongBill2" style="color: red;"></span>
                    </div>

                </div>

                <div class="form-group row">

                    <label for="payble_amt" class="col-sm-2 col-form-label">Payble Amount:</label>

                    <div class="col-sm-4">

                        <input type="text"
                            class="form-control required"
                            name="payble_amt"
                            id="payble_amt"
                            readonly
                        />

                    </div>

                    <label for="paid_amt" class="col-sm-2 col-form-label">Paid Amount:</label>

                    <div class="col-sm-4">

                        <input type="text"
                            class="form-control required"
                            name="paid_amt"
                            id="paid_amt"
                        />

                    </div>

                </div>  

                <div class="form-group row">

                    <label for="bank" class="col-sm-2 col-form-label">Bank:</label>

                    <div class="col-sm-10">

                        <select class="form-control required" name="bank" id="bank" required>

                            <option value="">Select Bank</option>

                            <?php foreach($bank as $b_list) {?>

                                <option value="<?php echo $b_list->acc_code;?>" >
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
                            <option value="C">Cheque</option>
                            <option value="N">NEFT</option>

                        </select>
                        
                    </div>	
                    
                </div>

                <div class="form-group row">

                    <label for="chq_no" class="col-sm-2 col-form-label">Cheque No.:</label>

                    <div class="col-sm-4">

                        <input type="text" class="form-control" name="chq_no" id="chq_no"/>

                    </div>

                    <label for="chq_dt" class="col-sm-2 col-form-label">Cheque Date:</label> 

                    <div class="col-sm-4">

                        <input type="date" class="form-control" name="chq_dt" id="chq_dt"/>

                    </div>

                </div> 

                <div class="form-group row">

                    <div class="col-sm-10">

                        <input type="submit" id="submit" class="btn btn-info" value="Save" />

                    </div>

                </div>

            </form>

        </div>

    </div>

    <script>

        $("#form").validate();

        $( ".sch_cd" ).select2();

    </script>

    <script>

        $(document).ready(function(){

            $('#bill_nos').change(function(){
                $.ajax({ 
                    type: 'GET',
                    url: '<?php echo site_url("paddy/checkbills");?>?pool_type='+$('#pool_type').val()+'&bill_nos='+$(this).val()+'',
                    contentType: 'application/text'
                    
                })
                .done(function(res){
                    var result = JSON.parse(res);
                    
                    let bills = $('#bill_nos').val().split('-');
                    let tempBill = bills[0];
                    for(let i = 1; i <= (bills[1] - bills[0]); i++){
                        tempBill += ','+ (parseInt(bills[0]) + parseInt(i));
                    }

                    var data = tempBill.split(',');
                    
                    var notBills = []; 
                    data.forEach(function(index, val){
                        
                        if(result.indexOf(index) == -1){
                            notBills.push(index);
                        }
                    });

                    if(notBills.length > 0){
                        $('#wrongBill1').html('worng bill no: '+notBills.join(','));
                        $('#submit').attr('type', 'button');

                    }else{
                        $('#wrongBill1').html('');
                        $('#submit').attr('type', 'submit');
                    }
                    
                });

                $.ajax({ 
                    type: 'GET',
                    url: '<?php echo site_url("paddy/paybleChekBills");?>?pool_type='+$('#pool_type').val()+'&bill_nos='+$(this).val()+'',
                    contentType: 'application/text'
                    
                })
                .done(function(res){
                    var result = JSON.parse(res);
                    
                    let bills = $('#bill_nos').val().split('-');
                    let tempBill = bills[0];
                    for(let i = 1; i <= (bills[1] - bills[0]); i++){
                        tempBill += ','+ (parseInt(bills[0]) + parseInt(i));
                    }

                    var data = tempBill.split(',');
                    
                    var notBills = []; 
                    data.forEach(function(index, val){
                        
                        if(result.indexOf(index) == -1){
                            notBills.push(index);
                        }
                    });

                    if(notBills.length > 0){
                        $('#wrongBill2').html('can\'t paid bill no: '+notBills.join(','));
                        $('#submit').attr('type', 'button');

                    }else{
                        $('#wrongBill2').html('');
                        $('#submit').attr('type', 'submit');
                    }
                    
                });
                $.ajax({ 
                    type: 'GET',
                    url: '<?php echo site_url("paddy/payble");?>?pool_type='+$('#pool_type').val()+'&bill_nos='+$(this).val()+'',                    
                    contentType: 'application/text'
                    
                })
                .done(function(data){

                    $('#payble_amt').val(data);

                });

            });

        });

    </script>
