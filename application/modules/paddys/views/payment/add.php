<div class="wraper">      

    <div class="col-md-12 container form-wraper" style="margin-left: 0px;">

        <form method="POST" 
            id="form"
            action="<?php echo site_url("payment/payment_add");?>" >

            <div class="form-header">
            
                <h4>Millers Payment Entry</h4>
            <span class="confirm-div" style="float:right; color:green;"></span>
            </div>

            <div class="form-group row">

                <label for="trans_dt" class="col-sm-1 col-form-label">Payment Date:</label>

                <div class="col-sm-3">

                    <input type="date"
                            class="form-control required"
                            name="trans_dt"
                            id="trans_dt"
                            value="<?php echo date('Y-m-d');?>"/>

                </div>

                <label for="block" class="col-sm-1 col-form-label">Block:</label>

                <div class="col-sm-3">

                    <select name="block" id="block" class="form-control required">

                        <option value="">Select</option>
                          <?php

                            foreach($blocks as $blocks){

                        ?> 

                        <option value="<?php echo $blocks->sl_no;?>"><?php echo $blocks->block_name;?></option>   

                        <?php

                            }

                        ?>  

                    </select>

                </div>
                

                <label for="soc_name" class="col-sm-1 col-form-label">Society Name:</label>

                <div class="col-sm-3">

                    <select type="text"
                        class="form-control"
                        name="soc_name"
                        id="soc_name">

                        <option value="">Select</option>    

                        <option value="">Select Block First</option>    

                    </select>    

                </div>

            </div>

            <div class="form-group row">

                <label for="mill_name" class="col-sm-1 col-form-label">Mill Name:</label>

                <div class="col-sm-3">

                    <select type="text"
                        class="form-control" required 
                        name="mill_name"
                        id="mill_name">

                        <option value="">Select</option>    

                        <option value="">Select District First</option>    

                    </select>

                </div>

                <label for="sanc_no" class="col-sm-1 col-form-label">Sanacation No:</label>
                <input type="hidden" name="sanc_nos" id="sanc_nos" >
                <div class="col-sm-3">

                    <select type="text" class="form-control" name="sanc_no" id="sanc_no"> 
                        <option value="">Select Sanacation</option>    


                    </select>

                </div>


                <label for="wqsc" class="col-sm-1 col-form-label">Wqsc:</label>

                <div class="col-sm-3">


                      <input type="text"
                            class="form-control" readonly
                            name="wqsc"
                            id="wqsc"/>

                  <!--   <select type="text"
                        class="form-control"
                        name="wqsc" id="wqsc"> 
                        <option value="">Select Wqsc</option>    


                    </select> -->

                </div>


            </div>  
            
             <div class="form-group row">

        <!-- 
                <label for="memo_no" class="col-sm-1 col-form-label">Memo No:</label>

                <div class="col-sm-3">

                    <input type="text"
                            class="form-control" readonly
                            name="memo_no"
                            id="memo_no"/>

                </div>

              

                <label for="memo_dt" class="col-sm-1 col-form-label">Memo Date:</label>

                <div class="col-sm-3">

                        <input type="date"
                               class="form-control" readonly
                               name="memo_dt"
                               id="memo_dt"/>

                </div> -->

                <label for="totPaddy" class="col-sm-1 col-form-label">Total Paddy:</label>

                <div class="col-sm-3">

                    <input type="text"
                            class="form-control" readonly
                            name="totPaddy"
                            id="totPaddy"/>

                </div>
                <label for="totCmr" class="col-sm-1 col-form-label">Total CMR:</label>

                <div class="col-sm-3">

                    <input type="text"
                            class="form-control required" readonly
                            name="totCmr"
                            id="totCmr"/>

                </div>

                <label for="rice_type" class="col-sm-1 col-form-label">Rice Type:</label>

                <div class="col-sm-3">

                      <input type="hidden"
                            class="form-control" readonly
                            name="rice_type"
                            id="rice_type"/>
                      <input type="text"
                            class="form-control" readonly
                            name="rice_types"
                            id="rice_types"/>    
 
                </div>

               
            </div>

         
            <div class="form-group row">

                 <label for="pool_type" class="col-sm-1 col-form-label">Pool Type:</label>

                <div class="col-sm-3">

                      <input type="hidden"
                            class="form-control" readonly
                            name="pool_type"
                            id="pool"/>
                      <input type="text"
                            class="form-control" readonly
                            name="pool_types"
                            id="pools"/>    

                </div>

          
                <label for="mandi_board" class="col-sm-1 col-form-label">Mandi Board Name:</label>

                <div class="col-sm-3">
                           <input type="text"
                        class="form-control" name="mandi_board" id="mandi_board" required/>
                </div>

                <label for="mandi_board" class="col-sm-1 col-form-label">Mandi Board Address:</label>

                <div class="col-sm-3">
                           <input type="text"
                        class="form-control" name="mandi_board_addr" id="mandi_board_addr" required/>
                </div>

                        
            </div>

            
            <div class="form-group row">
                
                   <label for="mandi_board" class="col-sm-1 col-form-label">Transport Agency Name:</label>

                    <div class="col-sm-3">
                               <input type="text"
                            class="form-control" name="transport_agency_name" id="transport_agency_name" required/>
                    </div>

                    <label for="mandi_board" class="col-sm-1 col-form-label">Transport Agency Address:</label>

                    <div class="col-sm-3">
                               <input type="text"
                            class="form-control" name="transport_agency_addr" id="transport_agency_addr" required/>
                    </div>
                        
            </div>

            
            <div class="form-header">
            
                <h4>Bills</h4>
            
            </div>
            
            <table class="table">

                <thead>

                    <tr>
                        
                        <th>Millers <br> Bill No.</th>
                        <th>Date</th>
                        <th>Branch Ref No.</th>
                        <th>Date</th>
                        <th>Quantity of Paddy <br>(Qtls)</th>
                        <th>Quantity of CMR<br>(Qtls)</th>
                       <!--  <th>Total Butta</th> -->

                    </tr>

                </thead>

                <tbody id="intro" class="tables">
                    <tr>
                        <td><input type="text" class="form-control mill_bill_no" name="mill_bill_no" required></td>
                        <td><input type="date" class="form-control mill_bill_date" name="mill_bill_date" required></td>
                        <td><input type="number" class="form-control benfed_bill_no" name="benfed_bill_no" required></td>
                        <td><input type="date" class="form-control confed_bill_date" name="benfed_bill_date" required></td>
                        <td><input type="text" class="form-control qty_paddy" name="qty_paddy" readonly></td>
                        <td><input type="text" class="form-control qty_cmr" name="qty_cmr" readonly></td>
                       
                    </tr>
                </tbody> 

              
            </table>

            <div class="form-header">
            
                <h4>Bill Details</h4>
            
            </div>

            <div id="bill_dtls"> 
                               
            </div>
            
               <!--  <thead>

                    <tr>
                        <th width="25%">Particulars</th>
                        <th>Rate/Qtls <br>Paddy</th>
                        <th>Total Amount <br> (Rs)</th>
                        <th>TDS Amount <br>(Less) <br> @2.00%</th>
                        <th>CGST <br> (Add) <br> @2.5%</th>
                        <th>SGST <br> (Add) <br> @2.5%</th>
                        <th>Claimed Amount(Rs)</th>
                        <th>Payable Amount(Rs)</th>
                        <th><button type="button" class="btn btn-success addAnotherRow"><i class="fa fa-plus"></i></button></th>

                    </tr>

                </thead> -->

              <!--   <tbody id="intro1" class="tables">
                    
                    <tr>
                        <td><select class="form-control particulars required" name="particulars[]">

                                <option value="">Select</option>
                                <?php
                            
                                  //  foreach($bill_master as $b_list){
                                   
                                        ?>

                                        <option value="<?php //echo $b_list->sl_no; ?>"><?php //echo $b_list->param_name; ?></option>

                                        <?php
                                //    }
                                ?>
                            </select>
                        
                        </td>

                        <td><input type="text" class="no-border rate_per_qtls" name="rate_per_qtls[]" style="width:99px;"  readonly></td>
                        <td><input type="text" class="form-control amounts" name="amounts[]" required></td>
                        <td><input type="text" class="form-control tds_amount" name="tds_amount[]" readonly></td>
                        <td><input type="text" class="form-control cgst" name="cgst[]" readonly></td>
                        <td><input type="text" class="form-control sgst" name="sgst[]" readonly></td>
                         <td><input type="text" class="form-control claim_amt" name="claim_amt[]" ></td>
                        <td><input type="text" class="form-control paybel" name="paybel[]"></td>
                        <td><button type="button" class="btn btn-danger removeRow"><i class="fa fa-remove"></i></button></td>
                    </tr>

                </tbody> 
 -->
            <table class="table">
                <tfoot>
                  

                    <tr>
                        <td colspan="1" style="text-align:left;color:green" class="col-sm-3">Requisition Ammount:</td>
                         <td colspan="1" class="col-sm-2" ><b id="requisition_amt"></b></td>
                         <td colspan="5" style="text-align: right;" class="col-sm-5">Less Butta:</td>
                        <td><input type="text" name="qty_butta"  class="col-sm-2 form-control less_butta"></td>
                    </tr>

                    <tr>
                        <td  style="text-align:left;color:green" class="col-sm-3">Sanctioned Ammount:</td>
                         <td class="col-sm-2" ><b id="allocated_amt"></b></td>
                        <td colspan="5" style="text-align: right;">Less Gunny Cut:</td>
                        <td><input type="text" class="form-control less_gunny" name="gunny_cut" value="0.00"></td>
                    </tr>

                    <tr>
                    
                        <td colspan="7" style="text-align: right;">Payble Amount:</td>
                        <td><input type="text" class="form-control payble_amount" readonly required id="total"></td>

                    </tr>

                </tfoot>
            </table>

            <div class="form-header">
            
                <h4>Payment</h4>
            
            </div>
            
            <table class="table">

                <thead>

                    <tr>
                        
                        <th width="33%">Payment Mode.</th>
                        <th width="33%">Bank</th>
                        <th>Reference No</th>
                     
                    </tr>

                </thead>

                <tbody id="bank" class="tables">
                    <tr>
                        <td> 
                        <select class="form-control" required
                            name="pay_mode" id="pay_mode">

                        <option value="">Select</option>
                        <option value="C">Cheque</option>
                        <option value="R">RTGS</option>
                        <option value="N">NEFT</option>

                        </select>
                       </td>
                        <td>

                        <select name="bank_id" id="bank_id" class="form-control" required>
                        <option value="">Select</option>    
                        <?php foreach($banks as $bank) { ?>
                        <option value="<?php if(isset($bank->sl_no)){ echo $bank->sl_no; }?>">
                          <?php if(isset($bank->bank_id) && $bank->bank_id=="1")
                                       { echo 'Yes Bank';}
                                elseif($bank->bank_id=="2"){
                                     echo 'Bandhan Bank';  
                                        }
                                 elseif($bank->bank_id=="3"){
                                    echo 'Icici Bank';  
                                 }
                                  elseif($bank->bank_id=="4"){
                                    echo 'Axis Bank';  
                                 }
                                 else{
                                    echo 'Hdfc Bank';
                                 }                                         
                                       ?></option>    
                          <?php } ?>
                          </select>
                         
                        </td>
                        <td><input type="text" class="form-control ref_no" name="ref_no" ></td>
                      
                       
                    </tr>
                </tbody> 

              
            </table>

            <div class="form-group row">

                <div class="col-sm-10">

                    <input type="submit" class="btn btn-info" value="Save" />

                </div>

            </div>

        </form>

    </div>

    <div class="modal fade" id="viewModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
      <div class="modal-dialog" role="document">
        <div class="modal-content">
          <div class="modal-header">
            <h4>Supporting Documents</h4>
            <button class="close" type="button" data-dismiss="modal" aria-label="Close">
              <span aria-hidden="true">×</span>
            </button>
          </div>
          <div class="modal-body" id="doc-view">
           
          </div>
        </div>
      </div>
    </div>

</div>

<script>

   // $("#form").validate();

    $( ".sch_cd" ).select2();

</script>

<script>


    $(document).ready(function(){

        var i = 0;     

       $('#soc_name').change(function(){
                
                //For Society wise Mill
                $.post( 
                    '<?php echo site_url("paddys/transactions/f_soc_mills");?>',

                    { 

                        soc_id: $(this).val()

                    }

                ).done(function(data){

                    var string = '<option value="">Select</option>';

                    $.each(JSON.parse(data), function( index, value ) {

                        string += '<option value="' + value.sl_no + '">' + value.mill_name + '</option>'

                    });

                    $('#mill_name').html(string);

                });

            });

        $('#mill_name').change(function(){

              //For Wqsc List
                $.post( 
                    '<?php echo site_url("paddys/payment/sanc_no_list");?>',

                    { 

                        soc_id   : $("#soc_name").val(),
                        block_id : $("#block").val(),
                        mill_id  : $(this).val()

                    }

                ).done(function(data){

                    var string = '<option value="">Select</option>';

                    $.each(JSON.parse(data), function( index, value ) {

                        string += '<option value="' + value.req_no + '">' + value.sanc_no + '</option>'

                    });

                    $('#sanc_no').html(string);

                });

        });

        $('#mill_name').change(function(){


                 $.post( 
                    '<?php echo site_url("paddys/payment/soc_mill_distance");?>',

                    { 

                        soc_id : $("#soc_name").val(),
                        mill_id: $(this).val()

                    }

                ).done(function(data){

                    var string = JSON.parse(data);

                    $('#soc_mill_dis').val(string.distance);

                });

            });


        $('#sanc_no').change(function(){

               var requisition_amt = 0;
               var price_sancation = 0;
               

            $.post('<?php echo site_url("paddys/payment/sanc_no_dtls_for_mill"); ?>',
            
                {
                    req_no:   $(this).val()
            
                }

            )
            .done(function(data){

                var string = '<table class="table" ><thead><tr><th>Particulars.</th><th>Rate/Qtls Paddy</th><th>Total Amount(Rs)</th><th>TDS Amount (Less)</th><th>Recalculate TDS</th><th>CGST (Add)@2.5%</th><th>SGST(Add)@2.5%</th><th>Claimed Amount(Rs)</th><th>Net Amount(Rs) </th></tr></thead><tbody id="intro">';
                    
                var price_sum       = 0;
                var gross_amt       = 0;
                var tds_amt         = 0;
                var cgst_amt        = 0;
                var sgst_amt        = 0;

                $.each(JSON.parse(data), function( index, value ) {


                    price_sancation += parseFloat(value.payble_amt);

                    if(value.payment_flag == "1"){

                         string += '<tr><td>' + value.param_name + '<input type="hidden" class="form-control sl_no" readonly name="particulars[]" value="' + value.sl_no +'"/></td><td>' + value.per_unit_rate + '<input type="hidden" class="form-control" readonly name="rate_per_qtls[]" value="' + value.per_unit_rate +'"/></td><td>' + value.total_amt + '<input type="hidden" class="form-control amounts" readonly name="amounts[]" value="' + value.total_amt +'"/></td><td><span class="tds">' + value.tds_amt + '</span><input type="hidden" class="form-control tds_amount" readonly name="tds_amount[]" value="' + value.tds_amt +'"/></td><td>';
                          if(value.tds_amt > 0){
                         string +='<button class="calculate" type="button" value="' + value.sl_no +'">Calculate</button>';
                            }
                          string += '</td><td>' + value.cgst_amt + '<input type="hidden" class="form-control cgst" readonly name="cgst[]" value="' + value.cgst_amt +'"/></td><td>' + value.sgst_amt + '<input type="hidden" class="form-control sgst" readonly name="sgst[]" value="' + value.sgst_amt +'"/></td><td>' + value.claim_amt + '<input type="hidden" class="form-control" readonly name="claim_amt[]" value="' + value.claim_amt +'"/></td><td><span class="pay">' + value.payble_amt + '</span><input type="hidden" class="form-control paybel" readonly name="paybel[]" value="' + value.payble_amt +'"/></td></tr>';

                    price_sum    += parseFloat(value.payble_amt); 

                    gross_amt    += parseFloat(value.total_amt);

                    tds_amt      += parseFloat(value.tds_amt);

                    cgst_amt     += parseFloat(value.cgst_amt);

                    sgst_amt     += parseFloat(value.sgst_amt);

                    }
                     
                });
                        /*string +='<tr><td colspan="7">Payable Amt</td><td> <input type="text" class="form-control" id="tot_rice" value="'+price_sum.toFixed()+'" readonly></td> <td></td></tr></tbody></table>';*/

                        string +='<tr><td><b>Total:</b></td><td></td><td id=gross_amt><b>'+gross_amt.toFixed(2)+'</b></td><td id=tds_amt><b>'+tds_amt.toFixed(2)+'</b></td><td></td><td id=cgst_amt><b>'+cgst_amt.toFixed(2)+'</b></td><td id=sgst_amt><b>'+sgst_amt.toFixed(2)+'</b></td><td></td><td id=net_amt><b>'+price_sum.toFixed()+'</b></td></tr></tbody></table>';

                    $('#bill_dtls').html(string);
                    $('.payble_amount').val(  (price_sum.toFixed()) );
                   // $('#allocated_amt').html(price_sancation);
                
            });


            $.post('<?php echo site_url("paddys/payment/tot_requisition_amt"); ?>',
            
                {
                    req_no:   $(this).val()
            
                }

            )
            .done(function(data){

                 requisition_amt = JSON.parse(data);

                 var requisition  = Number((requisition_amt.payble_amt)).toFixed(0);
                 $('#requisition_amt').html(requisition);

                
            });

            $.post('<?php echo site_url("paddys/payment/tot_allocated_amt"); ?>',
            
                {
                    req_no:   $(this).val()
            
                }

            )
            .done(function(data){

                 allocated_amt = JSON.parse(data);
                 $('#allocated_amt').html(Number(allocated_amt.payble_amt).toFixed(0));

                
            });

     
    });


    $('#sanc_no').change(function(){


            $.post('<?php echo site_url("paddys/payment/wqsc_dtls_on_sanc"); ?>',
            
                {
                    req_no:   $(this).val()
            
                }

            )
            .done(function(data){

                var datas = JSON.parse(data);

                $('#sanc_nos').val(datas.sanc_no);
                $('#wqsc').val(datas.wqsc_no);
               
                // $('select[name^="pool_types"] option[value="'+datas.pool+'"]').attr("selected","selected");
                // $('select[name^="rice_types"] option[value="'+datas.rice_type+'"]').attr("selected","selected");
                if(datas.rice_type = "P"){
                     $('#rice_type').val(datas.rice_type);
                     $('#rice_types').val("Par Boiled Rice");
                }else{
                     $('#rice_type').val(datas.rice_type);
                     $('#rice_types').val("Raw Rice");
                }
                if(datas.pool = "C"){
                     $('#pool').val(datas.pool);
                     $('#pools').val("Central Pool");
                }else if(datas.pool = "S"){
                     $('#pool').val(datas.pool);
                     $('#pools').val("State Pool");
                }else{
                    $('#pool').val(datas.pool);
                    $('#pools').val("FCI");
                }
                   
            });

            $.post('<?php echo site_url("paddys/payment/paddy_qty_on_sanc"); ?>',
            
                {
                    req_no:   $(this).val()
            
                }

            )
            .done(function(data){

                var datas = JSON.parse(data);

                $('#totPaddy').val(datas.paddy_qty);

                $('#totCmr').val(datas.totCmr);

                $('.qty_paddy').val(datas.paddy_qty);

                $('.qty_cmr').val(datas.totCmr);
                   
            });
     
    });    


        $('#wqsc').change(function(){
            
            //Progressive Paddy Procurement
            $.post('<?php echo site_url("paddys/payment/wqsc_qty"); ?>',
            
                {
                    soc_id:  $('#soc_name').val(),

                    mill_id: $('#mill_name').val(),

                    wqsc:    $(this).val()
                }

            )
            .done(function(data){

                let temp = JSON.parse(data);
                $('#totCmr').val(temp.quantity);
                $('.qty_cmr').val(temp.quantity);
                
                $('#memo_no').val(temp.memo_no);
                $('#memo_dt').val(temp.memo_dt);
                $('#goodown_name').val(temp.goodown_name);
                $('#goodown_dist').val(temp.district_name);
                $('#rm_gd_dist').val(temp.rm_gd_dist);

                if(temp.inter_dist == "N"){
                 $('#inter_district').val("No");
                }
                else{
                     $('#inter_district').val("Yes");
                    }

               // $('select[name^="rice_type"] option[value="'+temp.rice_type+'"]').attr("selected","selected");
                
               // $('select[name^="pool_type"] option[value="'+temp.pool+'"]').attr("selected","selected");
                
            });

             //Progressive Paddy Procurement
            $.post('<?php echo site_url("paddys/payment/cmr_qtys"); ?>',
            
                {
                    soc_id:  $('#soc_name').val(),

                    mill_id: $('#mill_name').val(),

                    wqsc:    $(this).val()
                }

            )
            .done(function(data){

                let temp = JSON.parse(data);
                
                $('#totCmr').val(temp.quantity);
                $('.qty_cmr').val(temp.quantity);
                
            });
         
         
        });

        $('#wqsc').change(function(){
            
            //Total Paddy Received
            $.post('<?php echo site_url("paddys/payment/tot_paddy_received"); ?>',
            
                {
                    soc_id:  $('#soc_name').val(),

                    mill_id: $('#mill_name').val(),

                    wqsc:    $(this).val()
                }

            )
            .done(function(data){

                let temp = JSON.parse(data);
                
                $('#totPaddy').val(temp.tot);
                
                $('.qty_paddy').val(temp.tot);
            });
        });



    });

</script>

<script>

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

    });

</script>

<script>
    $(document).ready(function(){


            var arlene1 = [];


        $('.addAnotherRow').click(function(){


        
                var  data = [];

                 $('#intro1 tr').each(function() {
                 var particulars = $(this).find('td:eq(0) .particulars').val();
                         data.push(particulars);
             })

                       

              
          
                  $.post('<?php echo site_url("paddys/payment/get_lessselected_particulars"); ?>',{

                 //   riceType: $('#rice_type').val(),
                    sl_no: data

                }).done(function(data){


                      var string = '<option value="">Select</option>';

                $.each(JSON.parse(data), function( index, value ) {

                    string += '<option value="' + value.sl_no + '">' + value.param_name + '</option>'

                });

          

            let row = '<tr>' +
                        '<td><select class="form-control particulars" name="particulars[]"> '+string+
                            '</select> ' +
                        '</td> ' +
                        '<td><input type="text" class="no-border rate_per_qtls" name="rate_per_qtls[]" readonly style="width:99px;"></td>' +
                        '<td><input type="text" class="form-control amounts" name="amounts[]"></td>' +
                        '<td><input type="text" class="form-control tds_amount" name="tds_amount[]" readonly></td>' +
                        '<td><input type="text" class="form-control cgst" name="cgst[]" readonly></td>' +
                        '<td><input type="text" class="form-control sgst" name="sgst[]" readonly></td>' +
                        '<td><input type="text" class="form-control claim_amt" name="claim_amt[]"></td>'+
                        '<td><input type="text" class="form-control paybel" name="paybel[]"></td>' +
                        '<td><button type="button" class="btn btn-danger removeRow"><i class="fa fa-remove"></i></button></td>' +
                    '</tr>';

            $('#intro1').append(row);

        })

        });

    });

</script>

<script>

    $(document).ready(function(){

        function sumValuesOf(className){

            var sum = 0.00;

            $('.'+className+'').each(function(){

                sum += +$(this).val();

            });

            return sum;
        }

        //Billing Details
        $('#intro').on('change', '.benfed_bill_no', function(){

            let indexNo = $('.benfed_bill_no').index(this);

            $.get('<?php echo site_url("paddy/billDetails"); ?>',{

                billNo: $(this).val(),
                pool_type: $('#pool_type').val()

            }).done(function(data){

                data = JSON.parse(data);

                $('.confed_bill_date:eq('+indexNo+')').val(data.bill_dt);
                $('.qty_paddy:eq('+indexNo+')').val(data.paddy_qty * 10);
                $('.qty_cmr:eq('+indexNo+')').val(data.sub_tot_cmr_qty * 10);
                $('.qty_butta:eq('+indexNo+')').val(data.butta_cut);
                $('.view:eq('+indexNo+')').attr('id', data.bill_no);

                $('.tot_paddy').val(sumValuesOf('qty_paddy'));
                $('.tot_cmr').val(sumValuesOf('qty_cmr'));
                $('.tot_butta').val(sumValuesOf('qty_butta'));
                $('.less_butta').val(sumValuesOf('qty_butta'));
                
                $('.extra_delivery').val($('.tot_cmr').val() - $('#totCmr').val());
            });

        });

        //Millers Payment Details
        $('#intro1').on('change', '.particulars', function(){


            let indexNo = $('.particulars').index(this);

            $('.rate_per_qtls:eq('+indexNo+')').val("");
            $('.amounts:eq('+indexNo+')').val("");
            $('.tds_amount:eq('+indexNo+')').val("");
            $('.cgst:eq('+indexNo+')').val("");
            $('.sgst:eq('+indexNo+')').val("");
            $('.claim_amt:eq('+indexNo+')').val("");
            $('.paybel:eq('+indexNo+')').val("");
            $('.payble_amount').val(sumValuesOf('paybel').toFixed());      


            var  val    = $(this).val();

                if(val == 0 ){


                 $.get('<?php echo site_url("paddys/payment/transport_rate"); ?>',{

                 //   riceType: $('#rice_type').val(),
                    sl_no: $(this).val()

                }).done(function(data){

                    let values = JSON.parse(data);
                    var rate_1     = values[0].amount;
                    var rate_2     = values[1].amount;
                    var rate_3     = values[2].amount;
                    var distance_1 = 0;
                    var distance_2 = 0;
                    var distance_3 = 0;
                    var tds        = 0.00;
                    var cgst       = 0.00;
                    var payable_amt= 0.00;
                    var tot_amt    = 0.00;
                    var tot_pady   = parseFloat($('#totPaddy').val());

                    var tot_distance = $('#soc_mill_dis').val();

                    if(tot_distance <= 25){

                         $('.rate_per_qtls:eq('+indexNo+')').val(rate_1);

                         var tot_amt = parseFloat(rate_1 * tot_pady);

                         $('.amounts:eq('+indexNo+')').val(tot_amt.toFixed(2));

                          $('.tds_amount:eq('+indexNo+')').val(tds.toFixed(2));
                          $('.cgst:eq('+indexNo+')').val(cgst.toFixed(2));
                          $('.sgst:eq('+indexNo+')').val(cgst.toFixed(2));

                          var payable_amt = parseFloat(tot_amt+tds+cgst+cgst);

                          $('.paybel:eq('+indexNo+')').val(payable_amt.toFixed(2));
                          $('.payble_amount').val(sumValuesOf('paybel').toFixed());

                    }else if(tot_distance <= 50){
                            distance_1 = 25;
                        var payment_1  = parseFloat(tot_pady*rate_1);
                            distance_2 = tot_distance - distance_1;
                        var payment_2  = parseFloat(distance_2*rate_2*tot_pady);
                           
                            $('.rate_per_qtls:eq('+indexNo+')').val(rate_1+','+rate_2);

                            $('.amounts:eq('+indexNo+')').val((payment_1 + payment_2).toFixed(2));

                            tot_amt = payment_1 + payment_2;

                          $('.tds_amount:eq('+indexNo+')').val(tds.toFixed(2));
                          $('.cgst:eq('+indexNo+')').val(cgst.toFixed(2));
                          $('.sgst:eq('+indexNo+')').val(cgst.toFixed(2));

                          var payable_amt = parseFloat(tot_amt+tds+cgst+cgst);
                          
                          $('.paybel:eq('+indexNo+')').val(payable_amt.toFixed(2));
                          $('.payble_amount').val(sumValuesOf('paybel').toFixed());

                    }else if(tot_distance > 50){

                            distance_1 = 25;
                        var payment_1  = parseFloat(tot_pady*rate_1);
                            distance_2 = 25;
                        var payment_2  = parseFloat(distance_2*rate_2*tot_pady);
                            distance_3 = tot_distance -50;
                        var payment_3  = parseFloat(distance_3*rate_3*tot_pady);   

                            $('.rate_per_qtls:eq('+indexNo+')').val(rate_1+','+rate_2+','+rate_3);

                            $('.amounts:eq('+indexNo+')').val((payment_1 + payment_2 + payment_3).toFixed(2));  

                               tot_amt = payment_1 + payment_2;

                           $('.tds_amount:eq('+indexNo+')').val(tds.toFixed(2));
                           $('.cgst:eq('+indexNo+')').val(cgst.toFixed(2));
                           $('.sgst:eq('+indexNo+')').val(cgst.toFixed(2));

                           var payable_amt = parseFloat(tot_amt+tds+cgst+cgst);
                          
                           $('.paybel:eq('+indexNo+')').val(payable_amt.toFixed(2));
                           $('.payble_amount').val(sumValuesOf('paybel').toFixed());           

                        }
                    

                  });


            }else{


                $.get('<?php echo site_url("paddy/billMasterDetails"); ?>',{

                    riceType: $('#rice_type').val(),
                    sl_no: $(this).val()

                }).done(function(data){

                    let values = JSON.parse(data);
                    let action = values.action;
                    
                    $('.rate_per_qtls:eq('+indexNo+')').val(values.val);

                    if(action == 'P'){

                        var tds_rt  = parseFloat(values.tds);
                        var cgst_rt = parseFloat(values.cgst);

                        var tot_amt = parseFloat(values.val) * parseFloat($('#totPaddy').val());

                        $('.amounts:eq('+indexNo+')').val(tot_amt.toFixed(2));

                        var tds = (tot_amt*tds_rt)/100;

                        $('.tds_amount:eq('+indexNo+')').val(tds.toFixed(2));

                        var cgst = (tot_amt*cgst_rt)/100;

                        $('.cgst:eq('+indexNo+')').val(cgst.toFixed(2));

                        $('.sgst:eq('+indexNo+')').val(cgst.toFixed(2));

                        var payable_amt = parseFloat(tot_amt+tds+cgst+cgst);

                        $('.paybel:eq('+indexNo+')').val(payable_amt.toFixed(2));

                        $('.payble_amount').val(sumValuesOf('paybel').toFixed());

                    }else if(action == 'C'){

                        var tds_rt  = parseFloat(values.tds);
                        var cgst_rt = parseFloat(values.cgst);

                        var tot_amt = parseFloat(values.val) * parseFloat($('#totCmr').val());

                        $('.amounts:eq('+indexNo+')').val(tot_amt.toFixed(2));


                         var tds = (tot_amt*tds_rt)/100;

                         $('.tds_amount:eq('+indexNo+')').val(tds.toFixed(2));

                         var cgst = (tot_amt*cgst_rt)/100;

                         $('.cgst:eq('+indexNo+')').val(cgst.toFixed(2));

                         $('.sgst:eq('+indexNo+')').val(cgst.toFixed(2));

                         var payable_amt = parseFloat(tot_amt+tds+cgst+cgst); 

                         $('.paybel:eq('+indexNo+')').val(payable_amt.toFixed(2));
                         $('.payble_amount').val(sumValuesOf('paybel').toFixed());

                    }

                });

            }


        });

        $('.less_butta').change(function(){

            var totamt =  parseFloat($('#tot_rice').val());

            console.log(totamt);

            $('.payble_amount').val((totamt - $(this).val()).toFixed());

        });

         $('.less_gunny').change(function(){

            var payble_amount =  parseFloat($('#tot_rice').val());

            var less_butt     =  parseFloat($('.less_butta').val());

            $('.payble_amount').val( parseFloat(payble_amount - $(this).val() -less_butt).toFixed() );

        });

        // $('.qty_butta').change(function(){

        //     $('.payble_amount').val(sumValuesOf('paybel') - $(this).val());

        // });

        


         //$('.tds_amount').change(function(){

             $('.table tbody').on('keyup', '.tds_amount', function(){

             var $row = $(this).closest('tr');
             var amount = 0;
             var cgst   = 0;
             var tds    = 0;
             var sgst   = 0;
              
             var amounts = parseFloat($row.find(".amounts").val());
             var tdss    = parseFloat($row.find(".tds_amount").val());
             
             var cgsts   = parseFloat($row.find(".cgst").val());

              var sgsts  = parseFloat($row.find(".sgst").val());

             if($.isNumeric(amounts)){
               amount = parseFloat(amounts);
              }else{
              amount = "0.00";
              }

              if($.isNumeric(tdss)){
               tds = parseFloat(tdss);
              }else{
              tds = "0.00";
              }

             if($.isNumeric(cgsts)){
               cgst = parseFloat(cgsts);
              }else{
              cgst = "0.00";
              }
              
              if($.isNumeric(sgsts)){
               sgst = parseFloat(sgsts);
              }else{
              sgst = "0.00";
              }            
             var total = parseFloat(amount) +parseFloat(tds) +parseFloat(cgst) + parseFloat(sgst);

            $(this).closest('tr').find(".paybel").val(total.toFixed());

        });

        $('.cgst').change(function(){

             var amount = 0;
             var cgst   = 0;
             var tds    = 0;
             var sgst   = 0;

             var amounts = parseFloat($(this).closest('tr').find(".amounts").val());
             var tdss    = parseFloat($(this).closest('tr').find(".tds_amount").val());
             
             var cgsts   = parseFloat($(this).closest('tr').find(".cgst").val());

              var sgsts   = parseFloat($(this).closest('tr').find(".sgst").val());

             if($.isNumeric(amounts)){
               amount = parseFloat(amounts);
              }else{
              amount = "0.00";
              }

              if($.isNumeric(tdss)){
               tds = parseFloat(tdss);
              }else{
              tds = "0.00";
              }

             if($.isNumeric(cgsts)){
               cgst = parseFloat(cgsts);
              }else{
              cgst = "0.00";
              }
              
              if($.isNumeric(sgsts)){
               sgst = parseFloat(sgsts);
              }else{
              sgst = "0.00";
              }            
             var total = parseFloat(amount) +parseFloat(tds) +parseFloat(cgst) + parseFloat(sgst);

            $(this).closest('tr').find(".paybel").val(total.toFixed());

        });
           $('.sgst').change(function(){


             var amount = 0;
             var cgst   = 0;
             var tds    = 0;
             var sgst   = 0;

             var amounts = parseFloat($(this).closest('tr').find(".amounts").val());
             var tdss    = parseFloat($(this).closest('tr').find(".tds_amount").val());
             
             var cgsts   = parseFloat($(this).closest('tr').find(".cgst").val());

              var sgsts   = parseFloat($(this).closest('tr').find(".sgst").val());

             if($.isNumeric(amounts)){
               amount = parseFloat(amounts);
              }else{
              amount = "0.00";
              }

              if($.isNumeric(tdss)){
               tds = parseFloat(tdss);
              }else{
              tds = "0.00";
              }

             if($.isNumeric(cgsts)){
               cgst = parseFloat(cgsts);
              }else{
              cgst = "0.00";
              }
              
              if($.isNumeric(sgsts)){
               sgst = parseFloat(sgsts);
              }else{
              sgst = "0.00";
              }            
             var total = parseFloat(amount) +parseFloat(tds) +parseFloat(cgst) + parseFloat(sgst);

            $(this).closest('tr').find(".paybel").val(total.toFixed());

        });


        $('#intro1').on('change', '.paybel', function(){
            $('.tot_payble').val(sumValuesOf('paybel'));
            $('.payble_amount').val(sumValuesOf('paybel').toFixed());
            $('.less_butta').change();

        });

        $("#intro").on('click', '.removeRow',function(){
            
            $(this).parents('tr').remove();

            $('.tot_paddy').val(sumValuesOf('qty_paddy'));
            $('.tot_cmr').val(sumValuesOf('qty_cmr'));
            $('.tot_butta').val(sumValuesOf('qty_butta'));
            
        });

        $("#intro1").on('click', '.removeRow',function(){
            
            $(this).parents('tr').remove();

            $('.tot_payble').val(sumValuesOf('paybel'));
            $('.payble_amount').val(sumValuesOf('paybel').toFixed());
            $('.less_butta').change();
            
        });

      

    });

  $(document).ready(function() {

        $('.confirm-div').hide();

        <?php if($this->session->flashdata('msg')){ ?>

        $('.confirm-div').html('<?php echo $this->session->flashdata('msg'); ?>').show();

         <?php } ?>

    });


   $(document).ready(function(){
   $(document).ajaxComplete(function() {

         $(".calculate").click(function(){

            let row          = $(this).closest('tr');
            var amt  = $(this).parents('tr').find('td:eq(2) .amounts').val();
			var cgst = $(this).parents('tr').find('td:eq(5) .cgst').val();
			var sgst = $(this).parents('tr').find('td:eq(6) .sgst').val();
            var tds_amt = 0;
            var tds     = 0;
            var sum     = 0;
			var less_tds = 0;
            var string

			var tot_c_s_gst = parseFloat(cgst) + parseFloat(sgst);
			
			var tax_amt  = parseFloat(amt) + parseFloat(tot_c_s_gst);
			
			


           $.get('<?php echo site_url("paddys/payment/f_tdsrate"); ?>',{
                   
                     effectdt: $('#trans_dt').val(),
                    sl_no: $(this).parents('tr').find('td:eq(0) .sl_no').val()

               }).done(function(data){

                    let values  = JSON.parse(data);
                        tds     = values.tds;
                        tds_amt = ((amt*tds)/100).toFixed(2);
                    
                    row.find('td:eq(3) .tds_amount').val(tds_amt);
                    row.find('td:eq(3) .tds').html(tds_amt);
                    row.find('td:eq(8) .paybel').val((tax_amt - tds_amt).toFixed(2));
                    row.find('td:eq(8) .pay').html((tax_amt - tds_amt).toFixed(2));

                      // console.log(tax_amt,tds_amt,cgst,sgst);
                    $("input[class *= 'paybel']").each(function(){
            
                        sum += parseFloat($(this).val());

                    });

                    $('#tot_rice').val(Number(sum).toFixed());
                    $('#total').val(Number(sum).toFixed());
               })

           })
})

})

      // $('#form').submit(function(event){
           
      //           var  gunny_cut  = parseFloat($('#gunny_cut').val());

      //           var  less_gunny = parseFloat($('.less_gunny').val());

            
      //               if(gunny_cut != less_gunny){

      //                 alert("Something Went Wrong Please Check Your Gunny Cut");

      //                 event.preventDefault();
      //               }
      //                else 
      //                   {
      //               //  alert("Transaction Date Can Not Be Less Than order Date");

      //                  $('#submit').attr('type', 'submit');
                       
      //                 }
      //       });

  

</script>