    <div class="wraper"> 
     <div class="col-md-3 container">     
     </div>
        <div class="col-md-6 container form-wraper">

            <form method="POST" id="form" action="<?php echo site_url("paddys/transactions/f_reissuechq_add");?>">

                <div class="form-header">
                
                    <h4>Farmer Detail</h4>
            
                </div>
                <div class="form-group row">
                
                 
                   
            <!--  <label for="trans_dt" class="col-sm-2 col-form-label"></label> -->
                      <label for="trans_dt" class="col-sm-2 col-form-label">Transaction Date:</label>

                    <div class="col-sm-4">
               <input type="hidden" class="form-control" name="oldchq_date" id="oldchq_date" value="<?//=$cheque_dtl->cheque_date;?>"  />        
            <input type="text" class="form-control" name="old_chq_date" id="old_chq_date" value="<?//=date('d/m/Y',strtotime($cheque_dtl->cheque_date));?>" readonly />
                     </div>    
                </div>
                
               <!--  <div class="form-group row">
                    <label for="soc_name" class="col-sm-2 col-form-label">Name:</label>
                    <div class="col-sm-10"><input type="text" class="form-control" name="farm_name" id="farm_name" value="<?//=$cheque_dtl->farm_name;?>" readonly /></div>
                    
                </div>  -->
                <div class="form-group row">
                    <label for="soc_name" class="col-sm-2 col-form-label">Registration No:</label>
                    <div class="col-sm-10"><input type="text" class="form-control" name="reg_no" id="reg_no" value="<?//=$cheque_dtl->reg_no;?>" readonly /></div>
                    
                </div> 
                <div class="form-group row">
                    <label for="soc_name" class="col-sm-2 col-form-label">Account No:</label>
                    <div class="col-sm-4">
                         <input type="text"
                     class="form-control" name="account_no" id="account_no"  value=""  />
                      
                    </div>
                    <label for="soc_name" class="col-sm-2 col-form-label">Ifsc code:</label>
                    <div class="col-sm-4">
                      <input type="text"
                     class="form-control" name="ifsc_code" id="ifsc_code" value="" />
                      
                    </div>
                </div>
                  <div class="form-group row">
                    <label for="soc_name" class="col-sm-2 col-form-label">Procurement Center:</label>
                    <div class="col-sm-10"><input type="text" class="form-control" name="proc_cn" id="proc_cn" value="<?//=$cheque_dtl->soc_name;?>" readonly /></div>
                    
                </div> 
                <div class="form-group row">
                    <label for="soc_name" class="col-sm-2 col-form-label">Qty:</label>
                    <div class="col-sm-4">
                         <input type="text"
                     class="form-control" name="qty" id="qty"  value="<?//=$cheque_dtl->tot_qty;?>" readonly />
                      
                    </div>
                    <label for="soc_name" class="col-sm-2 col-form-label">Amt:</label>
                    <div class="col-sm-4">
                      <input type="text"
                     class="form-control" name="amt" id="amt" value="<?//=$cheque_dtl->tot_amt;?>" readonly/>
                      
                    </div>
                </div> 
             
                <div class="form-group row">

                  <label for="paddy_qty" class="col-sm-2 col-form-label">Bank:</label>
                      <div class="col-sm-4">
                     <select name="bnk" id="bnk" class="form-control required" required>
                            <option value="">Select</option>  
                          <!--   <option value="1">Yes Bank</option> -->
                            <option value="2">Bandhan Bank</option>
                            <option value="3">ICICI Bank</option>
                            <option value="4">Axis Bank</option> 
                            <option value="5">Hdfc Bank</option>       
                        </select>
                    </div>
                   <label for="paddy_qty" class="col-sm-2 col-form-label">Transaction Type:</label>
                     <div class="col-sm-4">
                      NEFT
                   <input type="hidden" class="form-control" name="issue_dt" id="issue_dt" value="<?php echo date('Y-m-d');?>" /> 
                  <input type="hidden" class="form-control" name="trans_type" id="trans_type" value="N"  /> 
                     </div>
                     
                   </div>  

                <div class="form-group row">

                    <div class="col-sm-10">

                        <input type="submit" class="btn btn-info" value="Save"  id="submit"/>

                    </div>

                </div>

            </form>

        </div>

    </div>

<script>

    // $("#form").validate();

    // $( ".sch_cd" ).select2();

</script>




<script>
    $('#proceed').click(function(){

            //Progressive Paddy Procurement
            $.post('<?php echo site_url("paddys/transactions/get_sig_cheque"); ?>',

                {
                    old_chq_no: $("#old_chq_no").val(),
                   
                }

            )
            .done(function(data){

              var value = (JSON.parse(data));
              
               var date    =  (value.cheque_date).split('-');
         
               var newDate = date["2"]+ '/' + date["1"] + '/' + date["0"];
              
              // if(value.chq_status=="U"){

                $('#qty').val(value.tot_qty);
                $('#trans_dt').val(value.trans_dt); 
                $('#amt').val(value.tot_amt); 
                $('#reg_no').val(value.reg_no); 
                $('#old_chq_date').val(newDate); 
                $('#farm_name').val(value.farm_name); 
                $('#old_chq_bnk').val(value.bank_id); 
                $('#proc_cn').val(value.soc_name); 
               // $('#account_no').val(value.account_no); 
                //$('#ifsc_code').val(value.ifsc_code);
                 $('#submit').attr('type', 'submit');

               

              // }else if(value.chq_status=="C"){
                 
              //     alert("Cheque already cleared");
              //   $('#submit').attr('type', 'button');
                

              // }else{
              //      alert("Cheque already issued");
              //   $('#submit').attr('type', 'button');

              // }
                
               
                

            });

        });


  

  $("#trans_dt").change(function(){

          var trans_dt = $('#trans_dt').val();
         
 var d = new Date();

 var month = d.getMonth()+1;
 var day = d.getDate();

 var output = d.getFullYear() + '-' +
    (month<10 ? '0' : '') + month + '-' +
    (day<10 ? '0' : '') + day;

    console.log(trans_dt,output);

          if(new Date(output) < new Date(trans_dt))
          {
          alert("Transaction  Date Can Not Be Greater Than Current Date");
          $('#submit').attr('type', 'buttom');
          return false;
          }else{
             $('#submit').attr('type', 'submit');
          }
})

 $('#form').submit(function(event){
           
                var trans_dt = $('#trans_dt').val();
         
var d = new Date();

 var month = d.getMonth()+1;
 var day = d.getDate();

 var output = d.getFullYear() + '-' +
    (month<10 ? '0' : '') + month + '-' +
    (day<10 ? '0' : '') + day;

                    if(new Date(output) < new Date(trans_dt)){

                      alert("Transaction  Date Can Not Be Greater Than Current Date");
                      event.preventDefault();
                    }
                     else 
                        {
                    //  alert("Transaction Date Can Not Be Less Than order Date");

                       $('#submit').attr('type', 'submit');
                       
                      }
            });
</script>
