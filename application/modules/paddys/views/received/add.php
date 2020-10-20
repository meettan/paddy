    <div class="wraper">      

        <div class="col-md-6 container form-wraper">

            <form method="POST" 
                id="form"
                action="<?php echo site_url("paddy/paymentreceived/add");?>" >

                <div class="form-header">
                
                    <h4>Payment Received Entry</h4>
                
                </div>

                <div class="form-group row">

                    <label for="trans_dt" class="col-sm-2 col-form-label">Received Date:</label>

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
                
                    <label for="payment_type" class="col-sm-2 col-form-label">Payment Type:</label>

                    <div class="col-sm-4">
                        
                        <select name="payment_type" class="form-control required">

                            <option value="">Select</option>

                            <option value="A">Advance</option> 

                            <option value="F">Final</option> 

                        </select>

                    </div>

                    <label for="payment_for" class="col-sm-2 col-form-label">Payment For:</label>

                    <div class="col-sm-4">

                        <select name="payment_for" class="form-control required">

                            <option value="">Select</option>
                            <option value="F&S">F & S </option>

                            <?php

                                foreach($dist as $dlist){

                            ?>

                                <option value="<?php echo $dlist->district_code;?>"><?php echo 'FCI '.$dlist->district_name;?></option>

                            <?php

                                }

                            ?>     

                        </select>
                    </div>
                </div>
                
                <div class="form-group row">
                    
                    <label for="bill_nos" class="col-sm-2 col-form-label">Bill No(s):</label>

                    <div class="col-sm-10">

                        <textarea type="text" class="form-control" name="bill_nos" id="bill_nos"></textarea>
                        <span id="wrongBill1" style="color: red;"></span>
                        <!-- <br>
                        <span id="wrongBill2" style="color: red;"></span> -->
                        <br>
                        <span id="wrongBill3" style="color: red;"></span>
                    </div>

                </div>

                <div class="form-group row">

                    <label for="receivable_amt" class="col-sm-2 col-form-label">Receivable Amount:</label>

                    <div class="col-sm-4">

                        <input type="text"
                            class="form-control"
                            name="receivable_amt"
                            id="receivable_amt"
                            readonly
                        />

                    </div>

                    <label for="received_amt" class="col-sm-2 col-form-label">Received Amount:</label>

                    <div class="col-sm-4">

                        <input type="text"
                            class="form-control required"
                            name="received_amt"
                            id="received_amt"
                        />

                    </div>

                </div>  

                <div class="form-group row">

                    <div class="col-sm-10">

                        <input type="submit" id="received" class="btn btn-info" value="Save" />

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
                    for(let i = 1; i <= bills[1] - bills[0]; i++){
                        tempBill += ','+(parseInt(bills[0])+ parseInt(i));
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
                        $('#received').attr('type', 'button');

                    }else{
                        $('#wrongBill1').html('');
                        $('#received').attr('type', 'submit');
                    }
                    
                });

                $.ajax({ 
                    type: 'GET',
                    url: '<?php echo site_url("paddy/receivable");?>?pool_type='+$('#pool_type').val()+'&bill_nos='+$(this).val()+'',
                    contentType: 'application/text'
                    
                })
                .done(function(data){
                    
                    $('#receivable_amt').val(data);

                });

                $.ajax({ 
                    type: 'GET',
                    url: '<?php echo site_url("paddy/received/billexsists");?>?pool_type='+$('#pool_type').val()+'&bill_nos='+$(this).val()+'',
                    contentType: 'application/text'
                    
                })
                .done(function(res){

                    var result = JSON.parse(res),
                        data1 = [],
                        data2 = [];
                    
                   
                    let bills = $('#bill_nos').val().split('-');
                    let tempBill = bills[0];
                    for(let i = 1; i <= (bills[1] - bills[0]); i++){
                        tempBill += ','+ (parseInt(bills[0]) + parseInt(i));
                    }
                    
                    let vals = tempBill.split(',');
                    
                    vals.forEach(function(index, val){
                        
                        if(result.submit.indexOf(index) == -1){
                            
                            data2.push(index);
                        }
                    });

                    if(data2.length > 0){
                        
                        $('#wrongBill3').html(' bill no: '+data2.join(',')+' not submitted yet');
                        $('#received').attr('type', 'button');

                    }else{
                        $('#wrongBill3').html('');
                        $('#received').attr('type', 'submit');
                    }

                });

            });

        });

    </script>
