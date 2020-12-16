    <div class="wraper">      

        <div class="col-md-6 container form-wraper">

            <form method="POST" 
                id="form"
                action="<?php echo site_url("paddy/submit/add");?>" >

                <div class="form-header">
                
                    <h4>Submit Entry</h4>
                
                </div>

                <div class="form-group row">

                    <label for="trans_dt" class="col-sm-2 col-form-label">Submit Date:</label>

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

                    <label for="submit_amt" class="col-sm-2 col-form-label">Submit Amount:</label>

                    <div class="col-sm-10">

                        <input type="text"
                            class="form-control required"
                            name="submit_amt"
                            id="submit_amt"
                            readonly
                        />

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
                    url: '<?php echo site_url("paddy/billamount");?>?pool_type='+$('#pool_type').val()+'&bill_nos='+$(this).val()+'',
                    contentType: 'application/text'
                    
                })
                .done(function(data){
                    
                    $('#submit_amt').val(data);

                });

                $.ajax({ 
                    type: 'GET',
                    url: '<?php echo site_url("paddy/billexsists");?>?pool_type='+$('#pool_type').val()+'&bill_nos='+$(this).val()+'',
                    contentType: 'application/text'
                    
                })
                .done(function(res){

                    var result = JSON.parse(res),
                        data = [];
                        
                    result.forEach(function(index, val){
                        data.push(index.bill_no);
                    });

                    if(result.length > 0){
                        
                        $('#wrongBill2').html(' bill no: '+data.join(',')+' already submitted');
                        $('#submit').attr('type', 'button');

                    }else{
                        $('#wrongBill2').html('');
                        $('#submit').attr('type', 'submit');
                    }

                });

            });

        });

    </script>
