<style>
.loader {
  border: 16px solid #f3f3f3;
  border-radius: 50%;
  border-top: 16px solid #3498db;
  width: 80px;
  height: 80px;
  -webkit-animation: spin 2s linear infinite; /* Safari */
  animation: spin 2s linear infinite;
}
/* Safari */
@-webkit-keyframes spin {
  0% { -webkit-transform: rotate(0deg); }
  100% { -webkit-transform: rotate(360deg); }
}

@keyframes spin {
  0% { transform: rotate(0deg); }
  100% { transform: rotate(360deg); }
}
</style>
 
 <div class="wraperPaddyPro">      

        <div class="col-lg-12">    
        
        <div class="form-header form_header_cus">
         <!--  <a href="<?=base_url()?>sample.csv" download="sample.csv" style="float:right" class="btn btn-success">
           Download Sample</a> -->

          <a href="<?=base_url()?>sample_neft.csv" download="sample_neft.csv" style="float:right" class="btn btn-danger">
           Download Sample For NEFT</a>
       
          <h4>Note :Before Uploading File Please Download Sample And Convert your File Like Sample File.</h4>
             
         
        </div>
            <form method="POST" 
                id="form"  enctype="multipart/form-data"
                action="<?php echo site_url("paddys/transactions/f_paddycollupload");?>">

                <div class="form-group form_group_cus">
					<div class="col-sm-2">
                  <label for="block" class="col-form-label">Block:</label>
                      <select name="block" id="block" class="form-control required">
                            <option value="">Select</option>    
                            <?php foreach($blocks as $block) { ?>
                            <option value="<?php if(isset($block->blockcode)){ echo $block->blockcode; }?>"><?php if(isset($block->block_name)){ echo $block->block_name; }?></option>    
                            <?php } ?>
                        </select>

                    </div>
                    
                    <div class="col-sm-3">
          
                <label for="soc_name" class="col-form-label">Society Name:</label>

                        <select type="text"
                                class="form-control required sch_cd" name="soc_name"
                                id="soc_name">
                            <option value="">Select</option>    
                        </select>    

                    </div>
                    <div class="col-sm-3">
          
                <label for="rice_mill" class="col-form-label">Rice Mill:</label>

                 <select type="text" class="form-control" name="mill_id" id="mill_id" required>    
                            <option value="">Select</option>    
                        </select>    

                    </div>
               
					
					  <div class="col-sm-2">
                    <label for="soc_name" class="col-form-label">Procurement Date:</label>
                    
                  <input type="date" name="trans_dt" id="trans_dt" class="form-control" value="<?php echo date('Y-m-d');?>" required/>
                    

            </div>

					
             <div class="col-sm-2">
					   <label for="soc_name" class="col-form-label">Bank:</label>
                    <select name="bank_sl_no" id="bank_sl_no" class="form-control" required>
                <option value="">Select</option>    
                <?php foreach($banks as $bank) { ?>
                <option value="<?php if(isset($bank->sl_no)){ echo $bank->sl_no; }?>">
                  <?php if(isset($bank->bank_id) && $bank->bank_id=="1"){

                                    echo $bank->bank_name;

                                  }elseif($bank->bank_id=="2"){

                                   echo $bank->bank_name; 

                                  }elseif($bank->bank_id=="3"){

                                      echo $bank->bank_name;  
                                  }elseif($bank->bank_id=="4"){

                                      echo $bank->bank_name;

                                  }else{

                                      echo $bank->bank_name;
                                   }                                         
                               ?></option>    
                  <?php } ?>
                  </select>
                </div>

					
					<div class="alertMsg">
               
             
				  </div>

          </div>


			<!-- 	<div class="form-group">
             <div class="row">
             <div class="col-md-2">
             <label for="soc_name" class="col-form-label">Transation Type:</label>
                  <select name="trans_type" id="trans_type" class="form-control" required>
                    <option value="">Select</option>    
                    <option value="C">CHEQUE</option> 
                    <option value="N">NEFT</option>   
                 
                  </select>
               </div>
             </div>
        </div> -->
            
                <div class="form-group">

                <label for="f_payment_cheque" class="col-sm-2 col-form-label">Paddy Procurement Detail:</label>

                <div class="col-sm-4">

                    <input type="file" name="f_procurement_detail" class="form-control">

                </div>

                </div>
            <div class="form-group">

            <div class="col-sm-12">

                <input type="submit" id="submit" class="btn btn-info" value="Save"/>

                 </div>
            </div>
        </div>
        </form>

     <div class="col-lg-12 container contant-wraper" id="print_emp" style="display:none;">  
     <div class="form-header">
                
                <h4>Paddy Procurement Entry</h4>
                
                </div>
                <div class="form-group row"><label for="block" class="col-sm-1 col-form-label">Block:</label><div class="col-sm-2" id="block_n"></div><label for="soc_name" class="col-sm-1 col-form-label">Society:</label><div class="col-sm-5" id=soc_n></div><label for="soc_name" class="col-sm-1 col-form-label">Date:</label><div class="col-sm-2"><?php echo date('Y-m-d'); ?></div></div>
                <div id="farmerss">
                </div>
     </div>

    </div>
    

    <script>

	function printDiv(divName) {
        var divToPrint = document.getElementById(divName);
		var stylesheet = '<?=base_url();?>assets/css/bootstrap.min.css';
        var popupWin = window.open('', '', 'width=1240,height=800');
        popupWin.document.open();
		console.log(stylesheet);
        popupWin.document.write('<html><body onload="window.print()">'+
            '<link rel="stylesheet" href="' + stylesheet + '">'+ divToPrint.innerHTML + '</html>');
        popupWin.document.close();
    }

    //Search by name

    $("#search").on("keyup", function() {
    var value = $(this).val().toUpperCase();
          
    $("#farmers tr").each(function(index) {
      

        if (index !== 0) {
            

            $row = $(this);

            var name = $(this).find("td").eq(1).html(); 
            var ret = name.split(" ");
            var str1 = ret[0];

            if ( str1 == value || name == value) {
              
              
               $(this).closest('tr').css("background-color", "#a1bacf"); 
               $(this).find('td:eq(12) .search_name').focus();
            }
            else {
                $(this).closest('tr').css("background-color", ""); 
               // $row.show();
            }
           }
               });
            });
 
</script>

    

<script>

    //List of Society in dropdown will come with respect to block selection

    $(document).ready(function(){

        var i = 0;

        $('#block').change(function(){

            $.get( 

                '<?php echo site_url("paddy/societies");?>',

                { 

                    block: $(this).val()

                }

            ).done(function(data){

                var string = '<option value="">Select</option>';

                $.each(JSON.parse(data), function( index, value ) {

                    string += '<option value="' + value.sl_no + '">' + value.soc_name + '</option>'

                });

                $('#soc_name').html(string);

            });

        });

        $('#soc_name').change(function(){

         var block_name = $("#block option:selected" ).text();
         $('#block_n').html(block_name);

         var society_name = $("#soc_name option:selected" ).text();
         $('#soc_n').html(society_name);
         
        })

    });
    
    //Getting list of farmers on selection of block and society also ckecking if any work order is not approved the data will not be fetched

       
  </script>
  
  
<script>

        
        $('#form').submit(function(event){
           
            $('#farmers tr').each(function() {

                  var valid = 1;

                  var max_limit="45";
                
                 var paddy_qty = $(this).find("td").eq(4).html();  

                 var qty = $(this).find('td:eq(7) .quantity').val();

                 var enter_qty = parseFloat(paddy_qty) + parseFloat(qty);
                    if(enter_qty>max_limit){
                        $(this).find('td:eq(7) .quantity').focus();
                        cheque_amount
                        $('#submit').attr('type', 'buttom');
              
                        event.preventDefault();
                   }
                    else 
                       {
                      $('#submit').attr('type', 'submit');
                      }
            });
     
                  
    });
 // Code For Calculating Total Amount

    $(document).ajaxComplete(function() {
    
     $(".quantity").change(function(){

                var sum = 0;

                var isDisabled = $(this).is('[disabled=disabled]');



               $('.quantity').each(function(){

                   if(isDisabled == false){

                    sum += Number(this.value);

                   }

                });
              $('#tot_paddy').html(sum);
              
            }); 
    })

</script>

<script>

    $(document).ajaxComplete(function() {
     // Code For Checking Individual Cheque Amount
     $(".cheque_amount").change(function(){

            var cheque_amount = parseFloat($(this).val());
            var paddy_amount  = parseFloat($(this).parents('tr').find("td").eq(8).html()); 

            if(cheque_amount != paddy_amount){

                $(this).parents('tr').find(".errors").html("Not Matched").css("color", "red"); 
                $(this).closest('tr').find(".cheque_amount").focus();
         
            $('#submit').attr('type', 'buttom');
            }
            else{
            $(this).parents('tr').find(".errors").html("");
            $('#submit').attr('type', 'submit');
            }

            });


        $(".cheque_date").change(function(){

          var trans_dt = $('#trans_dt').val();
          var cheque_date = $(this).val();          

          if(new Date(cheque_date) < new Date(trans_dt))
          {
          $(this).parents('tr').find(".cd_error").html("Cheque Date Can Not Be Less Than Transaction Date").css("color", "red"); 
          $(this).closest('tr').find(".cheque_date").focus();
         // alert("Cheque Date Can Not Be Less Than Transaction Date");
          event.preventDefault();
          $('#submit').attr('type', 'buttom');
          return false;
          }
           else{
                   $(this).parents('tr').find(".cd_error").html(""); 
              }

        });

      })

$('#form').submit(function(event){
           
            $('#farmers tr').each(function() {

                 var trans_dt = $('#trans_dt').val();

                 var cheque_date = $(this).find('td:eq(11) .cheque_date').val();
        
                    if(new Date(cheque_date) < new Date(trans_dt)){

                        alert("Cheque Date Can Not Be Less Than Transaction Date On Focused Row");

                        $(this).find('td:eq(11) .cheque_date').focus();
                        
                        $('#submit').attr('type', 'buttom');
              
                        event.preventDefault();
                   }
                    else 
                       {

                      $('#submit').attr('type', 'submit');

                      }
            });
     
                  
    });
     

  $(document).ajaxComplete(function() {

        $(".quantity").keyup(function(){

                var qty = $(this).closest('tr').find(".quantity").val();
                var paddy_qty=$(this).parents('tr').find("td").eq(4).html(); 

                var max_limit="45";
               
                var enter_qty = parseFloat(paddy_qty) + parseFloat(qty);

                if(enter_qty > parseFloat(max_limit)){
                   
                 
                    $(this).parents('tr').find("td").eq(8).html("Limit Exceed").css("color", "red"); 
              
                    $('[id^=check]').attr("disabled", true);
                    $('#submit').attr('type', 'buttom');
                }
                else{
                
                    var price='<?php echo get_paddy_price($this->session->userdata['loggedin']['kms_id']);?>';

                    $(this).parents('td').next().html(Math.round((parseFloat(qty*price)).toFixed(2))).css("color", "black");

                    $('[id^=check]').attr("disabled", false);
                    $('#submit').attr('type', 'submit');
                    }

                });
       
            });
                          // Code For Individual Cheque Validation //
                    $(document).ajaxComplete(function() {
                    $(".cheque_no").change(function(){

                        var qty = $(this).val();
                        
                    if(qty.toString().length != 6 ){
                        
                        $(this).parents('tr').find(".error").html("Only 6 Digit").css("color", "red"); 
                        $(this).closest('tr').find(".cheque_no").focus();
                    
                        $('#submit').attr('type', 'buttom');
                    }
                    else{
                        $(this).parents('tr').find(".error").html(""); 
                        $('#submit').attr('type', 'submit');
                    }

                       }); 

                    });



        $( document ).ajaxComplete(function() {
            $(".status").change(function(){
              $(this)
                  .parents('td')
                  .next()
                  .find('input')
                  .prop('disabled', !$(this).is(":checked"));
         $(this).closest('tr').find(".reg_no").prop('disabled', !$(this).is(":checked"));
          $(this).closest('tr').find(".quantity").prop('disabled', !$(this).is(":checked"));
                  $(this).closest('tr').find(".cheque_no").prop('disabled', !$(this).is(":checked"));
                  $(this).closest('tr').find(".cheque_date").prop('disabled', !$(this).is(":checked"));
                  $(this).closest('tr').find(".cheque_amount").prop('disabled', !$(this).is(":checked"));
          }); 
        
        });

         $(document).ajaxComplete(function() {

        $(".status").change(function(){

           var isDisabled = $(this).is('[disabled=disabled]');

            var sum = 0 ;
       
        if($(this).prop("checked") == true){

        
        
            }else if($(this). prop("checked") == false){

          $(this).closest('tr').find(".quantity").val("");
          $(this).parents('tr').find("td").eq(8).html("");


             $('.quantity').each(function(){

                   if(isDisabled == false){

                    sum += Number(this.value);

                   }

                 })
             
              $('#tot_paddy').html(sum);

            }
       
        }); 
        
    });


        // Select Bank Content
        $("#bank_sl_no").change(function(){

        var bank_id = $("#bank_sl_no option:selected").text();

        var res = bank_id.split("/", 1);
         
         if(res=="Yes Bank"){
            $("#bank_condition").html('<p> <input type="checkbox" name="certificate_1" value="Y" required>Certified that all the data uploaded into the system are verified by me and the muster roll is generated by the system.</p><p> <input type="checkbox" name="certificate_2" value="Y" required>Certified that I have checked and crossed checked all the cheque numbers and amounts with the corresponding farmer registration number.</p><p> <input type="checkbox" name="certificate_4" value="Y" required>Recommended and forwarded to the District Manager / Branch Accountant.</p>'); 
        
         }else{
            $("#bank_condition").html('<p> <input type="checkbox" name="certificate_1" value="Y" required>Certified that all the data uploaded into the system are verified by me with the muster roll generated by the society and found correct and in order.</p><p> <input type="checkbox" name="certificate_2" value="Y" required>Recommended and forwarded to the District Manager / Branch Accountant.</p>'); 
         }
       
        }); 

// start of doc ready.
   $("#soc_name").change(function(e){
       
      var soc_id = $(this).val(); // anchors do have text not values.
      console.log(soc_id);
      $.ajax({
        url: '<?php echo base_url();?>index.php/paddys/transactions/f_connected_mill_society',
        data: {'soc_id': soc_id}, // change this to send js object
        type: "post",
        dataType: 'json',
        success: function(data){
           //document.write(data); just do not use document.write
           //console.log(data);
           $("#mill_id").find('option').remove();
           $('#mill_id').append(data.html);
          
        }
      });
   });

$('#mill_id').change(function(){
            //Progressive Paddy Procurement
            $.get('<?php echo site_url("paddys/transactions/f_totorder_soc_mill"); ?>',

                {
                    mill_id: $("#mill_id").val(),

                    soc_id:  $("#soc_name").val()
                   
                }

            )
            .done(function(data){

            	var value = (JSON.parse(data));

               var date    =  (value.sum).split('-');
         
      // var newDate = date["2"]+ '/' + date["1"] + '/' + date["0"];
       var newDate = date["2"]+ '/' + date["1"] + '/' + date["0"];

                $('#work_order_dt').val(newDate);  

                $('#work_order_qty').val(value.sums); 

                $('#paddy_proc_qty').val(value.proc_qty);          

            });

        });
    $('#form').submit(function(event){
           
                 var trans_dt = $('#trans_dt').val();

                 var date = ($('#work_order_dt').val()).split('/');

                  //var order_daten  =  order_date.split('/');
         
            var order_date = date["2"]+ '-' + date["1"] + '-' + date["0"];
                 
        
                     if(new Date(trans_dt) < new Date(order_date)){

                         alert("Transaction Date Can Not Be Less Than order Date");
                                      
                         event.preventDefault();
                    }
                     else 
                        {

                       $('#submit').attr('type', 'submit');
                       
                       // event.preventDefault();
                      }

            });


        $('#form').submit(function(event){
           
                 var work_order_qty = parseFloat($('#work_order_qty').val());

                 var paddy_proc_qty = parseFloat($('#paddy_proc_qty').val());

                 var tot_paddy      = parseFloat($('#tot_paddy').text());

                 var tot_procured  =  parseFloat(paddy_proc_qty+tot_paddy);

                 console.log(work_order_qty,tot_procured);

                    if(work_order_qty < tot_procured ) {

                         alert("Total Procured Quantity Can Not be greater than Work order Quantity");
                                      
                         event.preventDefault();
                    }
                     else 
                        {
                    //  alert("Transaction Date Can Not Be Less Than order Date");

                       $('#submit').attr('type', 'submit');
                       
                      }
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
    $("#trans_dt").change(function(){

        var trans_dt = $('#trans_dt').val();
        $('.cheque_date').val(trans_dt);
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
