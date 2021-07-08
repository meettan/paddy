<div class="wraper">      

    <div class="col-md-12 container form-wraper" style="margin-left: 0px;">

        <form method="POST" id="form"
            action="<?php echo site_url("payment/requisition_add");?>" >

            <div class="form-header">
            
                <h4>Fund Requisition Entry</h4>
            <span class="confirm-div" style="float:right; color:green;"></span>
            </div>

            <div class="form-group row">

                <label for="req_dt" class="col-sm-1 col-form-label">Transaction Date:</label>

                <div class="col-sm-3">

                    <input type="date"
                            class="form-control required"
                            name="req_dt"
                            id="req_dt"
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

                    <input type=hidden name = mill_type id=mill_type />

                </div>


                <label for="wqsc" class="col-sm-1 col-form-label">Wqsc/CS No:</label>

                <div class="col-sm-3">

                    <select type="text"
                        class="form-control"
                        name="wqsc" id="wqsc"> 
                        <option value="">Select Wqsc</option>    


                    </select>

                </div>

                <label for="totPaddy" class="col-sm-1 col-form-label">Total Paddy in WQSC:</label>

                <div class="col-sm-3">

                    <input type="text"
                            class="form-control" readonly
                            name="totPaddy"
                            id="totPaddy"/>
                </div>

            </div>  
            
            <div class="form-group row">

                 <label for="memo_no" class="col-sm-1 col-form-label">RRO No:</label>

                <div class="col-sm-3">

                    <input type="text"
                            class="form-control" readonly
                            name="memo_no"
                            id="memo_no"/>

                </div>

              

                <label for="memo_dt" class="col-sm-1 col-form-label">RRO Date:</label>

                <div class="col-sm-3">

                        <input type="date"
                               class="form-control" readonly
                               name="memo_dt"
                               id="memo_dt"/>

                </div>
                 <label for="totCmr" class="col-sm-1 col-form-label">Total CMR in WQSC:</label>

                <div class="col-sm-3">

                    <input type="text"
                            class="form-control" value=""
                            name="totCmr" readonly
                            id="totCmr"/>

                </div>

               
            </div>

            <div class="form-group row">
              

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

                  <label for="goodown_name" class="col-sm-1 col-form-label">Goodown name:</label>

                <div class="col-sm-3">

                    <input type="text"
                            class="form-control" readonly
                            name="goodown_name"
                            id="goodown_name"/>

                </div>
              

                <label for="goodown_dist" class="col-sm-1 col-form-label">Goodown District:</label>

                <div class="col-sm-3">

                        <input type="text"
                            class="form-control" readonly
                            name="goodown_dist"
                            id="goodown_dist"/>

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

                <label for="inter_district:" class="col-sm-1 col-form-label">Inter District:</label>

                <div class="col-sm-3">

                               <input type="text"
                            class="form-control" readonly
                            name="inter_district"
                            id="inter_district"/>
                </div>


                <label for="soc_mill_dis" class="col-sm-1 col-form-label">Soc Mill Distance:</label>

                    <div class="col-sm-3">
                               <input type="text" readonly
                            class="form-control" 
                            name="soc_mill_dis"
                            id="soc_mill_dis"/>
                    </div>
                        
            </div>
            <div class="form-group row">


                   <label for="rm_gd_dist" class="col-sm-1 col-form-label">Goodown Distance:</label>

                    <div class="col-sm-3">
                               <input type="text"
                            class="form-control" readonly
                            name="rm_gd_dist"
                            id="rm_gd_dist"/>
                    </div>

                  
                    <input type="hidden" class="qty_paddy" name="qty_paddy" >
                    <input type="hidden" class="qty_cmr" name="qty_cmr" >
            </div>
            
           
            <div id="wqsc_dtls">
                       
                  
            </div>
       

            <div class="form-header">
            
                <h4>Bill Details</h4>
            
            </div>
            <div>
                <span style="color:red;text-align:center">TDS Rates for Proprietary ownership of Mill : 1% , Other than Proprietary ownership : 2% , Society : 5%, CGST : 2.50% & SGST : 2.50%</span>
            </div>
            
            <table class="table">

                <thead>

                    <tr>
                        <th width="25%">Particulars</th>
                        <th>Rate/Qtls <br>Paddy</th>
                        <th>Total Amount <br> (Rs)</th>
                        <th>TDS Amount <br>(Less) </th>
                        <th>CGST <br> (Add) </th>
                        <th>SGST <br> (Add) </th>
                        <th>Claimed Amount(Rs)</th>
                        <th>Net Payable(Rs)</th>
                        <th><button type="button" class="btn btn-success addAnotherRow"><i class="fa fa-plus"></i></button></th>

                    </tr>

                </thead>

                <tbody id="intro1" class="tables">
                    
                    <tr>
                        <td><select class="form-control particulars" name="particulars[]" required>

                                <option value="">Select</option>
                                <?php
                            
                                    foreach($bill_master as $b_list){
                                   
                                        ?>

                                        <option value="<?php echo $b_list->sl_no; ?>"><?php echo $b_list->param_name; ?></option>

                                        <?php
                                    }
                                ?>
                            </select>
                        
                        </td>

                        <td><input type="text" class="no-border rate_per_qtls" name="rate_per_qtls[]" style="width:99px;" required readonly></td>
                        <td><input type="text" class="form-control amounts" name="amounts[]" required></td>
                        <td><input type="text" class="form-control tds_amount" name="tds_amount[]" readonly></td>
                        <td><input type="text" class="form-control cgst" name="cgst[]" readonly></td>
                        <td><input type="text" class="form-control sgst" name="sgst[]" readonly></td>
                         <td><input type="text" class="form-control claim_amt" name="claim_amt[]" ></td>
                        <td><input type="text" class="form-control paybel" name="paybel[]" readonly></td>
                        <td><button type="button" class="btn btn-danger removeRow"><i class="fa fa-remove"></i></button></td>
                    </tr>

                </tbody> 

                <tfoot>
                 

                    <tr>
                        <td></td>
                        <td></td>
                        <td><input type="text" class="form-control gross_amt" style="text-align: right;font-size:12px" readonly></td>
                        <td><input type="text" class="form-control tds_amt"   style="text-align: right;font-size:12px" readonly></td>  
                        <td><input type="text" class="form-control cgst_amt"  style="text-align: right;font-size:12px" readonly></td>
                        <td><input type="text" class="form-control sgst_amt"  style="text-align: right;font-size:12px" readonly></td>          
                        <td style="text-align: right;font-size:12px">Net Payable:</td>
                        <td><input type="text" class="form-control payble_amount"style="text-align: right;font-size:12px" readonly></td>
                    </tr>

                </tfoot>
            </table>


            <div class="form-group row">

                <div class="col-sm-10">

                    <input type="submit" class="btn btn-info" value="Save"  id="submit" />

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
                
                //For Society wise Mill
                $.post( 
                    '<?php echo site_url("paddys/payment/wqsc_list");?>',

                    { 

                        soc_id : $("#soc_name").val(),
                        mill_id: $(this).val()

                    }

                ).done(function(data){

                    var string = '<option value="">Select</option>';

                    $.each(JSON.parse(data), function( index, value ) {

                        string += '<option value="' + value.id + '">' + value.wqsc_no + '</option>'

                    });

                    $('#wqsc').html(string);

                });

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

                $.post(
                    '<?php echo site_url("paddys/payment/mill_type"); ?>',
                    {
                        mill_id : $(this).val()
                    }
                ).done(function(data){
                    var mill_type = JSON.parse(data);

                    $('#mill_type').val(mill_type.guide_lines_id);

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
                if(temp.rice_type == "P"){
                     $('#rice_type').val(temp.rice_type);
                     $('#rice_types').val("Par Boiled Rice");
                }else{
                     $('#rice_type').val(temp.rice_type);
                     $('#rice_types').val("Raw Rice");
                }
                if(temp.pool == "C"){
                     $('#pool').val(temp.pool);
                     $('#pools').val("Central Pool");
                }else if(temp.pool == "S"){
                     $('#pool').val(temp.pool);
                     $('#pools').val("State Pool");
                }else{
                    $('#pool').val(temp.pool);
                    $('#pools').val("FCI");
                }
               // $('select[name^="pool_type"] option[value="'+temp.pool+'"]').attr("selected","selected");
                
            });

           
            $.post('<?php echo site_url("paddys/payment/wqsc_dtls"); ?>',
            
                {
                    soc_id:  $('#soc_name').val(),

                    mill_id: $('#mill_name').val(),

                    wqsc:    $(this).val()
                }

            )
            .done(function(data){

                  var string = '<div class="form-header"><h4>WQSC Details</h4></div><table class="table" ><thead><tr><th>WQSC No.</th><th>Date</th><th>No of gunny.</th><th>Quantity(In Qtl)</th><th>Moisture Extra</th><th>Deduction Price for Moisture</th><th>Price</th><th>Avg. wt empty Gunny(in Gram)</th><th>Gunny Cut</th></tr></thead><tbody>';

                        var gunny_sum    = 0;
                        var quantity_sum = 0;
                        var dedu_sum     = 0;
                        var price_sum    = 0;
                        var gunny_cut    = 0;

                    $.each(JSON.parse(data), function( index, value ) {

                        string += '<tr><td>' + value.sub_wqsc + '</td><td>' + value.trans_dt + '</td><td>' + value.no_gunny + '</td><td>' + value.quantity + '</td><td>' + value.moisture_extra + '</td><td>' + value.moisture_ext_amt + '</td><td>' + value.tot_price + '</td><td>' + value.avg_wt_empty_gunny + '</td><td>' + value.gunny_cut + '</td></tr>'

                        gunny_sum    += parseFloat(value.no_gunny); 
                        quantity_sum += parseFloat(value.quantity); 
                        dedu_sum     += parseFloat(value.moisture_ext_amt); 
                        price_sum    += parseFloat(value.tot_price); 
                        gunny_cut    += parseFloat(value.gunny_cut); 

                    });
                        string +='<tr><td colspan="2">Total</td><td> <input type="text" class="form-control" id="gunnt_total" value="'+gunny_sum+'" readonly></td><td> <input type="text" class="form-control" id="cmr_total" value="'+quantity_sum+'" readonly></td><td></td><td> <input type="text" class="form-control" id="tot_deduction" value="'+dedu_sum+'" readonly></td><td> <input type="text" class="form-control" id="tot_rice" value="'+price_sum+'" readonly></td> <td></td><td><input type="text" class="form-control" id="gunny_cut" value="'+gunny_cut+'" readonly></td></tr></tbody></table>';

                    $('#wqsc_dtls').html(string);

                
            });
        });


    });

    $('#wqsc').change(function(){

         //$('#totCmr').val("10.00");

         //console.log($(this).val());
            
            //Total Paddy Received
            $.post('<?php echo site_url("paddys/payment/tot_paddy_onwqsc"); ?>',
            
                {
                   
                    wqsc:    $(this).val()
                }

            )
            .done(function(data){

                let temp = JSON.parse(data);
                
                $('#totPaddy').val(temp.tot);
                
                $('.qty_paddy').val(temp.tot);
                $('#totCmr').val(temp.quat);
                $('.qty_cmr').val(temp.quat);

                
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

                                 
                  $.post('<?php echo site_url("paddys/payment/get_less_particulars_requision"); ?>',{

                 //   riceType: $('#rice_type').val(),
                    sl_no: data

                }).done(function(data){


                      var string = '<option value="">Select</option>';

                $.each(JSON.parse(data), function( index, value ) {

                    string += '<option value="' + value.sl_no + '">' + value.param_name + '</option>'

                });

          

            let row = '<tr>' +
                        '<td><select class="form-control particulars" name="particulars[]" required> '+string+
                            '</select> ' +
                        '</td> ' +
                        '<td><input type="text" class="no-border rate_per_qtls" name="rate_per_qtls[]" readonly style="width:99px;"></td>' +
                        '<td><input type="text" class="form-control amounts" name="amounts[]"></td>' +
                        '<td><input type="text" class="form-control tds_amount" name="tds_amount[]" readonly></td>' +
                        '<td><input type="text" class="form-control cgst" name="cgst[]" readonly></td>' +
                        '<td><input type="text" class="form-control sgst" name="sgst[]" readonly></td>' +
                        '<td><input type="text" class="form-control claim_amt" name="claim_amt[]"></td>'+
                        '<td><input type="text" class="form-control paybel" name="paybel[]" readonly></td>' +
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
            $('.gross_amt').val(sumValuesOf('amounts').toFixed(2));
            $('.tds_amt').val(sumValuesOf('tds_amount').toFixed(2));
            $('.cgst_amt').val(sumValuesOf('cgst').toFixed(2));
            $('.sgst_amt').val(sumValuesOf('sgst').toFixed(2));


            var  val       = $(this).val();
            var  mill_type = $("#mill_type").val();

                if(val == 3 || val == 4 || val == 5){


              //   $.get('<?php //echo site_url("paddys/payment/transport_rate"); ?>',{
                 $.get('<?php echo site_url("paddy/billMasterDetails"); ?>',{
                 //   riceType: $('#rice_type').val(),
                    sl_no: $(this).val(),
                    riceType: $('#rice_type').val(),
                    effectdt: $('#req_dt').val(),


                }).done(function(data){

                    let values      = JSON.parse(data);
                    var rate_1      = values.val;
                    var rate_2      = values.val;
                    var rate_3      = values.val;
                    var distance_1  = 0;
                    var distance_2  = 0;
                    var distance_3  = 0;
                    var tds         = 0;
                    if(mill_type    == 'P'){
                       tds         = values.prop_tds;
                    }else{
                        tds         = values.tds;
                    }
                    var cgst        = 0.00;
                    var payable_amt = 0.00;
                    var tot_amt     = 0.00;
                    var tot_pady    = parseFloat($('#totPaddy').val());

                    var tot_distance = $('#soc_mill_dis').val();


                      if(val == 3){

                         $('.rate_per_qtls:eq('+indexNo+')').val(rate_1);

                         var tot_amt = parseFloat(rate_1 * tot_pady);

                         console.log(rate_1);
                         console.log(tot_pady);

                         $('.amounts:eq('+indexNo+')').val(tot_amt.toFixed(2));

                         tds = ((tds*tot_amt)/100).toFixed(2);

                          $('.tds_amount:eq('+indexNo+')').val(tds);
                          $('.cgst:eq('+indexNo+')').val(cgst.toFixed(2));
                          $('.sgst:eq('+indexNo+')').val(cgst.toFixed(2));

                          var payable_amt = parseFloat(tot_amt-tds+cgst+cgst);

                          $('.paybel:eq('+indexNo+')').val(payable_amt.toFixed(2));
                          $('.payble_amount').val(sumValuesOf('paybel').toFixed());
                          $('.gross_amt').val(sumValuesOf('amounts').toFixed(2));
                          $('.tds_amt').val(sumValuesOf('tds_amount').toFixed(2));
                          $('.cgst_amt').val(sumValuesOf('cgst').toFixed(2));
                          $('.sgst_amt').val(sumValuesOf('sgst').toFixed(2));

                    }else if(val == 4){

                        if(tot_distance > 25){

                            tot_amt    =0;
                            distance_1 = 25;
                           if(tot_distance <= 50){
                            distance_2 = tot_distance - distance_1;
                        }else{

                            distance_2 = 25;
                        }
                    
                        var payment_2  = parseFloat(distance_2*rate_2*tot_pady);
                           
                            $('.rate_per_qtls:eq('+indexNo+')').val(rate_2);

                            $('.amounts:eq('+indexNo+')').val((payment_2).toFixed(2));

                            tot_amt =  payment_2;

                            tds = ((tds*tot_amt)/100).toFixed(2);

                          $('.tds_amount:eq('+indexNo+')').val(tds);
                          $('.cgst:eq('+indexNo+')').val(cgst.toFixed(2));
                          $('.sgst:eq('+indexNo+')').val(cgst.toFixed(2));

                          var payable_amt = parseFloat(tot_amt-tds+cgst+cgst);
                          
                          $('.paybel:eq('+indexNo+')').val(payable_amt.toFixed(2));
                          $('.payble_amount').val(sumValuesOf('paybel').toFixed());
                          $('.gross_amt').val(sumValuesOf('amounts').toFixed(2));
                          $('.tds_amt').val(sumValuesOf('tds_amount').toFixed(2));
                          $('.cgst_amt').val(sumValuesOf('cgst').toFixed(2));
                          $('.sgst_amt').val(sumValuesOf('sgst').toFixed(2));

                        }else{
                        
                                alert("Invalid Selection");
                                $('.amounts:eq('+indexNo+')').prop('readonly', true);
                                $('.claim_amt:eq('+indexNo+')').prop('readonly', true);
                                $('.paybel:eq('+indexNo+')').prop('readonly', true);

                        }  


                    }else if(val == 5 ){
                            

                          if(tot_distance > 50){
                      
                            distance_3 = tot_distance -50;
                            var payment_3  = parseFloat(distance_3*rate_3*tot_pady);   

                            $('.rate_per_qtls:eq('+indexNo+')').val(rate_3);

                            $('.amounts:eq('+indexNo+')').val((payment_3).toFixed(2));  

                               tot_amt = payment_3;

                               tds = ((tds*tot_amt)/100).toFixed(2);

                           $('.tds_amount:eq('+indexNo+')').val(tds);
                           $('.cgst:eq('+indexNo+')').val(cgst.toFixed(2));
                           $('.sgst:eq('+indexNo+')').val(cgst.toFixed(2));

                           var payable_amt = parseFloat(tot_amt-tds+cgst+cgst);
                          
                           $('.paybel:eq('+indexNo+')').val(payable_amt.toFixed(2));
                           $('.payble_amount').val(sumValuesOf('paybel').toFixed());
                           $('.gross_amt').val(sumValuesOf('amounts').toFixed(2));
                           $('.tds_amt').val(sumValuesOf('tds_amount').toFixed(2));
                           $('.cgst_amt').val(sumValuesOf('cgst').toFixed(2));
                           $('.sgst_amt').val(sumValuesOf('sgst').toFixed(2));  

                       }else{
                                 alert("You Selected Particular Above Distance");

                                  $('.amounts:eq('+indexNo+')').prop('readonly', true);
                                  $('.claim_amt:eq('+indexNo+')').prop('readonly', true);
                                  $('.paybel:eq('+indexNo+')').prop('readonly', true);

                           }


                        }
                    

                  });


            }else{


                $.get('<?php echo site_url("paddy/billMasterDetails"); ?>',{

                    riceType: $('#rice_type').val(),
                    effectdt: $('#req_dt').val(),
                    sl_no: $(this).val()

                }).done(function(data){

                    let values = JSON.parse(data);

                    let action = values.action;
                    
                    $('.rate_per_qtls:eq('+indexNo+')').val(values.val);

                    if(action == 'P'){

                        var tds_rt  = 0 ;           /////////

                        if(mill_type    == 'P'){
                            tds_rt  = parseFloat(values.prop_tds);
                            
                        }else{
                            tds_rt  = parseFloat(values.tds);
                           
                        }

                        var cgst_rt = parseFloat(values.cgst);

                        var tot_amt = parseFloat(values.val) * parseFloat($('#totPaddy').val());

                        $('.amounts:eq('+indexNo+')').val(tot_amt.toFixed(2));
                        var tds = (tot_amt*tds_rt)/100;
                         $('.tds_amount:eq('+indexNo+')').val(tds.toFixed(2));
                         var cgst = (tot_amt*cgst_rt)/100;
                         $('.cgst:eq('+indexNo+')').val(cgst.toFixed(2));
                         $('.sgst:eq('+indexNo+')').val(cgst.toFixed(2));
                         var payable_amt = parseFloat(tot_amt-tds+cgst+cgst);
                         $('.paybel:eq('+indexNo+')').val(payable_amt.toFixed(2));

                         $('.payble_amount').val(sumValuesOf('paybel').toFixed());
                         $('.gross_amt').val(sumValuesOf('amounts').toFixed(2));
                         $('.tds_amt').val(sumValuesOf('tds_amount').toFixed(2));
                         $('.cgst_amt').val(sumValuesOf('cgst').toFixed(2));
                         $('.sgst_amt').val(sumValuesOf('sgst').toFixed(2));

                    }else if(action == 'C'){

                        var tds_rt  = 0 ;           /////////

                        if(mill_type    == 'P'){
                            tds_rt  = parseFloat(values.prop_tds);
                        }else{
                            tds_rt  = parseFloat(values.tds);
                        }

                        var cgst_rt = parseFloat(values.cgst);

                        var tot_amt = parseFloat(values.val) * parseFloat($('#totCmr').val());

                        $('.amounts:eq('+indexNo+')').val(tot_amt.toFixed(2));


                         var tds = (tot_amt*tds_rt)/100;
                         $('.tds_amount:eq('+indexNo+')').val(tds.toFixed(2));
                         var cgst = (tot_amt*cgst_rt)/100;
                         $('.cgst:eq('+indexNo+')').val(cgst.toFixed(2));
                         $('.sgst:eq('+indexNo+')').val(cgst.toFixed(2));
                         var payable_amt = parseFloat(tot_amt-tds+cgst+cgst);
                         $('.paybel:eq('+indexNo+')').val(payable_amt.toFixed(2));

                         $('.payble_amount').val(sumValuesOf('paybel').toFixed());
                         $('.gross_amt').val(sumValuesOf('amounts').toFixed(2));
                         $('.tds_amt').val(sumValuesOf('tds_amount').toFixed(2));
                         $('.cgst_amt').val(sumValuesOf('cgst').toFixed(2));
                         $('.sgst_amt').val(sumValuesOf('sgst').toFixed(2));

                    }

                });

            }


        });

    //  ***  Code START For Tds calculation On Inter District Charges  Developed On 08/01/2021   ****  ///

        $('#intro1').on('change', '.amounts', function(){


            console.log("ddddd");

            let indexNo = $('.amounts').index(this);
            var amount  = $(this).val();
         
            $('.tds_amount:eq('+indexNo+')').val("");
            $('.cgst:eq('+indexNo+')').val("");
            $('.sgst:eq('+indexNo+')').val("");
            $('.claim_amt:eq('+indexNo+')').val("");
            $('.paybel:eq('+indexNo+')').val("");
            $('.payble_amount').val(sumValuesOf('paybel').toFixed());
            $('.gross_amt').val(sumValuesOf('amounts').toFixed(2));
            $('.tds_amt').val(sumValuesOf('tds_amount').toFixed(2));
            $('.cgst_amt').val(sumValuesOf('cgst').toFixed(2));
            $('.sgst_amt').val(sumValuesOf('sgst').toFixed(2));      

            var  val    =  $('.particulars:eq('+indexNo+')').val();

            var  mill_type = $("#mill_type").val();


            if(val == 6){

                 $.get('<?php echo site_url("paddy/billMasterDetails"); ?>',{
                 //   riceType: $('#rice_type').val(),
                    sl_no   : val,
                    riceType: $('#rice_type').val(),
                    effectdt: $('#req_dt').val()

                }).done(function(data){

                    let values      = JSON.parse(data);

                    //var tds         = values.tds;

                    var tds  = 0 ;           /////////

                    if(mill_type    == 'P'){
                        tds  = parseFloat(values.prop_tds);
                    }else{
                        tds  = parseFloat(values.tds);
                    }
                
                    var payable_amt = 0.00;
                    var cgst        = 0.00;
    
                        tds = ((tds*amount)/100).toFixed(2);

                        $('.tds_amount:eq('+indexNo+')').val(tds);
                        $('.cgst:eq('+indexNo+')').val(cgst.toFixed(2));
                        $('.sgst:eq('+indexNo+')').val(cgst.toFixed(2));

                        var payable_amt = parseFloat(amount-tds);

                        $('.paybel:eq('+indexNo+')').val(payable_amt.toFixed(2));
                        $('.payble_amount').val(sumValuesOf('paybel').toFixed());
                        $('.gross_amt').val(sumValuesOf('amounts').toFixed(2));
                        $('.tds_amt').val(sumValuesOf('tds_amount').toFixed(2));
                        $('.cgst_amt').val(sumValuesOf('cgst').toFixed(2));
                        $('.sgst_amt').val(sumValuesOf('sgst').toFixed(2));

                });

            }

        });

    //  ***  Code END  For Tds calculation On Inter District Charges Developed On 08/01/2021   ****  ///

        $('.less_butta').change(function(){

            $('.payble_amount').val((sumValuesOf('paybel') - $(this).val()).toFixed());

        });

         $('.less_gunny').change(function(){

            var payble_amount =  parseFloat($('.payble_amount').val());

            $('.payble_amount').val( parseFloat(payble_amount - $(this).val()).toFixed() );

        });


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

              var sgsts  = parseFloat($(this).closest('tr').find(".sgst").val());

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
             var total = parseFloat(amount) - parseFloat(tds) +parseFloat(cgst) + parseFloat(sgst);

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
            $('.gross_amt').val(sumValuesOf('amounts').toFixed(2));
            $('.tds_amt').val(sumValuesOf('tds_amount').toFixed(2));
            $('.cgst_amt').val(sumValuesOf('cgst').toFixed(2));
            $('.sgst_amt').val(sumValuesOf('sgst').toFixed(2)); 
            $('.less_butta').change();
            
        });
      

    });

  $(document).ready(function() {

    $('.confirm-div').hide();

    <?php if($this->session->flashdata('msg')){ ?>

    $('.confirm-div').html('<?php echo $this->session->flashdata('msg'); ?>').show();

     <?php } ?>

    });
// $(document).ready(function(){

          $('#intro1').on('change', '.particulars', function(){

                   //var sl_no = $(this).find('td:eq(0) .particulars').val();
                   let indexNo = $('.particulars').index(this);

                   $.get('<?php echo site_url("paddys/payment/check_parti"); ?>',{

                 //   riceType: $('#rice_type').val(),
                    sl_no: $(this).val(),
                    //sl_no: sl_no,
                    wqsc : $('#wqsc').val()

                   }).done(function(data){

                    let values = JSON.parse(data);

                    if(values.cnt > 0){

                        alert("Requisition for this head has already been done");
                        $('.particulars:eq('+indexNo+')').css("background-color", "red");
                        $('.particulars:eq('+indexNo+')').prop( "disabled", true );
                     
                    }
                                   
                });

        })      
     
                  
     // });
           
  

</script>