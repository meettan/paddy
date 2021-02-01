<div class="wraper">      

    <div class="col-md-12 container form-wraper" style="margin-left: 0px;">

          <?php

          if($bill_dtls->ho_flag == 1) { ?> 

        <form method="POST" 
            id="form" action="<?php echo site_url("payment/requisition_firstapproved");?>" >

        <?php } ?>

            <div class="form-header">
            
                <h4>Fund Requisition </h4>
            
            </div>

            <input type="hidden" name="req_no" value="<?php echo $bill_dtls->req_no; ?>">
          
            <div class="form-group row">

                <label for="block" class="col-sm-1 col-form-label">Block:</label>

                <div class="col-sm-5">

                    <select name="block" id="block" class="form-control required" disabled>

                          <option value="">Select</option>
                          <?php

                            foreach($blocks as $blocks){

                        ?> 

                        <option value="<?php echo $blocks->sl_no;?>" <?php if($blocks->sl_no==$bill_dtls->block_id){echo "selected";}?>><?php echo $blocks->block_name;?></option>   

                        <?php

                            }

                        ?>  

                    </select>

                    </select>

                </div>

                <label for="req_dt" class="col-sm-1 col-form-label">Transaction Date:</label>

                <div class="col-sm-5">

                    <input type="date"
                            class="form-control" readonly
                            name="req_dt"
                            id="req_dt"
                            value="<?php echo $bill_dtls->req_dt; ?>"
                        />

                </div>

            </div>

            <div class="form-group row">

                <label for="soc_name" class="col-sm-1 col-form-label">Society Name:</label>

                <div class="col-sm-5">

                    <select type="text"
                        class="form-control"
                        name="soc_name" disabled
                        id="soc_name"
                        >

                        <option value="">Select</option>    

                        <option value="">Select Block First</option>    

                    </select>    

                </div>

                <label for="mill_name" class="col-sm-1 col-form-label">Mill Name:</label>

                <div class="col-sm-5">

                    <select type="text"
                        class="form-control"
                        name="mill_name" disabled
                        id="mill_name"
                    >

                        <option value="">Select</option>    

                        <option value="">Select District First</option>    

                    </select>

                </div>

            </div>  

            <div class="form-group row">

                <label for="soc_name" class="col-sm-1 col-form-label">Wqsc/CS No:</label>

                <div class="col-sm-5">

                    <input type="text"
                            class="form-control required" readonly
                            name="wqsc"
                            id="wqsc"
                            value="<?php echo $bill_dtls->wqsc; ?>"
                        />

                </div>

                <label for="totPaddy" class="col-sm-1 col-form-label">Total Paddy:</label>

                <div class="col-sm-5">

                    <input type="text"
                            class="form-control required"
                            name="totPaddy" readonly
                            id="totPaddy"
                            value="<?php echo $bill_dtls->tot_paddy; ?>"
                        />

                </div>

             </div>  

             <div class="form-group row">


                <label for="memo_no" class="col-sm-1 col-form-label">RRO No:</label>

                <div class="col-sm-5">

                    <input type="text" class="form-control" readonly="" name="memo_no" id="memo_no"
                    id="memo_no" value="<?php if(isset($bill_dtls->memo_no)){ echo $bill_dtls->memo_no ;} ?>" />

                </div>

              

                <label for="memo_dt" class="col-sm-1 col-form-label">RRO Date:</label>

                <div class="col-sm-5">

                        <input type="date" class="form-control" readonly="" name="memo_dt" id="memo_dt" value="<?php if(isset($bill_dtls->memo_dt)){ echo $bill_dtls->memo_dt ;} ?>">

                </div>

               
            </div>
            
            <div class="form-group row">

                <label for="totCmr" class="col-sm-1 col-form-label">Total CMR:</label>

                <div class="col-sm-5">
                            
                 <input type="text" name="demo" value="<?php echo $bill_dtls->tot_cmr; ?>" class="form-control" readonly>

                </div>


               

            </div>

            <div class="form-group row">


                 <label for="goodown_name" class="col-sm-1 col-form-label">Goodown name:</label>

                <div class="col-sm-5">

                    <input type="text" class="form-control" readonly="" name="goodown_name" id="goodown_name" value="<?php if(isset($bill_dtls->goodown_name)){ echo $bill_dtls->goodown_name ;} ?>">

                </div>
              

                <label for="goodown_dist" class="col-sm-1 col-form-label">Goodown District:</label>

                <div class="col-sm-5">

                        <input type="text" class="form-control" readonly="" name="goodown_dist" id="goodown_dist" value="<?php if(isset($bill_dtls->district_name)){ echo $bill_dtls->district_name ;} ?>">

                </div>

               
            </div>
           

            <div class="form-group row">

                 <label for="soc_mill_dis" class="col-sm-1 col-form-label">Soc Mill Distance:</label>

                    <div class="col-sm-5">
                    <input type="text" readonly="" class="form-control" name="soc_mill_dis" id="soc_mill_dis" value="">
                    </div>

                   <label for="rm_gd_dist" class="col-sm-1 col-form-label">Goodown Distance:</label>

                    <div class="col-sm-5">
                               <input type="text" class="form-control" readonly="" name="rm_gd_dist" id="rm_gd_dist" value="<?php if(isset($bill_dtls->rm_gd_dist)){ echo $bill_dtls->rm_gd_dist ;} ?>" >
                    </div>
                        
            </div>

             <div id="wqsc_dtls">
                   
                       
                
                  
            </div>

            <div class="form-header">
            
                <h4>Bill Details</h4>
            
            </div>
            
            <table class="table">

                <thead>

                    <tr>
                        
                        <th width="25%">Particulars</th>
                        <th>Rate/Qtls <br>Paddy</th>
                        <th>Total Amount <br> (Rs)</th>
                        <th>TDS Amount <br>(Less) <br> @2.00%</th>
                        <th>CGST <br> (Add) <br> @2.5%</th>
                        <th>SGST <br> (Add) <br> @2.5%</th>
                        <th>Claimed Amount(Rs)</th>
                        <th>Payable Amount(Rs)</th>
                    <!--     <th><button type="button" class="btn btn-success addAnotherRow"><i class="fa fa-plus"></i></button></th> -->

                    </tr>

                </thead>

                <tbody id="intro1" class="tables">
                    
                    
                    <?php  $sum = 0;
                        $flag = false;
                           //unset($bill_master[4]);
                        foreach($charges as $c_list){
                    ?>
                        <tr>
                            <td><select class="form-control particulars" name="particulars[]" disabled>

                                    <option value="">Select</option>
                                     <option value="0" <?php if($c_list->account_type == "0"){echo "selected";} ?> >Transportation Charges of Paddy</option>
                                    <?php
                                        foreach($bill_master as $b_list){

                                            ?>

                                            <option value="<?php echo $b_list->sl_no; ?>" 
                                                    <?php echo ($b_list->sl_no == $c_list->account_type)? 'selected':''; ?>
                                            ><?php echo $b_list->param_name; ?></option>

                                            <?php
                                        }
                                    ?>
                                </select>
                            
                            </td>
                             <td>
                            <?php if($c_list->account_type == "0"){

                                    $where = array(
                                            "soc_id"   => $payment_dtls->soc_id,
                                            "mill_id"  => $payment_dtls->mill_id,
                                            "kms_id"   => $this->session->userdata['loggedin']['kms_id']
                                            );
                                   $wheres = array(
                                            "kms_id"   => $this->session->userdata['loggedin']['kms_id']
                                            );
                            $socmill  =   $this->Paddy->f_get_particulars("md_soc_mill","distance",$where, 1);
                            $rates    =   $this->Paddy->f_get_particulars("md_transport_charges",NULL,$wheres, 0);
                           
                            $rate_1   =   $rates[0]->amount;
                            $rate_2   =   $rates[1]->amount;
                            $rate_3   =   $rates[1]->amount;
                            $socmill->distance;
                            if($socmill->distance <= 25){
                                    $rate = $rate_1;
                            }else if($socmill->distance <= 50){
                                     $rate = $rate_1.','.$rate_2;
                            }else{
                                   $rate = $rate_1.','.$rate_2.','.$rate_3;
                            }


                             ?>
                                   <input type="text" 
                                       class="no-border rate_per_qtls" 
                                       name="rate_per_qtls[]" 
                                       value="<?php echo $rate; ?>" style="width:99px;"
                                       readonly> 
                                   

                        <?php     }else{  ?>
                        <input type="text" 
                                       class="no-border rate_per_qtls" 
                                       name="rate_per_qtls[]" 
                                       value="<?php echo $c_list->per_unit_rate; ?>"
                                       readonly
                                       >
                          
                        <?php } ?>
                          </td>
                            <td><input type="text" 
                                       class="form-control amounts required"
                                       value="<?php echo $c_list->total_amt; ?>"  readonly
                                       name="amounts[]"
                                       >
                            </td>
                            <td><input type="text" 
                                       class="form-control tds_amount" 
                                       value="<?php echo $c_list->tds_amt; ?>" readonly
                                       name="tds_amount[]"
                                       >
                            </td>
                            <td><input type="text" 
                                       class="form-control cgst"
                                       value="<?php echo $c_list->cgst_amt; ?>"  readonly
                                       name="cgst[]"
                                       >
                                       
                            </td>
                            <td><input type="text" 
                                       class="form-control sgst" 
                                       name="sgst[]" 
                                       value="<?php echo $c_list->sgst_amt; ?>" readonly
                                       >
                            </td>
                            <td><input type="text" 
                                       class="form-control claim_amt" readonly
                                       name="claim_amt[]"
                                       value="<?php echo $c_list->claim_amt; 
                                               // $sum +=$c_list->payble_amt; 
                                               ?>">

                            </td>
                            <td><input type="text" 
                                       class="form-control paybel" 
                                       name="paybel[]" readonly
                                       value="<?php echo $c_list->payble_amt; 
                                                $sum +=$c_list->payble_amt; 
                                               ?>">

                            </td>
                            <td>
                                <?php
                                    if($flag){
                                        ?>
                                        
                                      <!--   <button type="button" class="btn btn-danger removeRow"><i class="fa fa-remove"></i></button> -->

                                        <?php
                                    }
                                ?>
                            </td>
                        </tr>
                    <?php
                        $flag = true;
                        }
                    ?>
                </tbody> 

                <tfoot>
                    <tr>
                    
                        <td colspan="7" style="text-align: right;">Total Amount:</td>
                        <td colspan="2"><?php echo $sum ?></td>

                    </tr>

                


                </tfoot>
            </table>

             <?php if($bill_dtls->approve1 == "0" OR $bill_dtls->approve1 == "2" ) { ?> 


            <div class="form-group row">

                <label for="soc_name" class="col-sm-2 col-form-label">Remarks:</label>

                <div class="col-sm-10">
                        <textarea class="form-control" name="remark1"><?php if(isset($bill_dtls->remark1)){ echo $bill_dtls->remark1;}?></textarea>

                </div>

               

          </div>  


          <div class="form-group row">

                <label for="soc_name" class="col-sm-2 col-form-label">Please Procced:</label>

                <div class="col-sm-3">

                    <select type="text" class="form-control" name="approve_status" id="approve_status" required>

                        <option value="">Select</option>    

                         
                        <option value="1" <?php if(isset($bill_dtls->approve1)){ if($bill_dtls->approve1 =="1") {echo "Selected";}}?>>Recommend</option> 
                        <option value="2" <?php if(isset($bill_dtls->approve1)){ if($bill_dtls->approve1 =="2") {echo "Selected";}}?>>Hold</option>   

                    </select>    

                </div>

               

            </div>  

        
            <div class="form-group row">

                <div class="col-sm-5">

                    <input type="submit" class="btn btn-info" value="Submit" />

                </div>

            </div>
        <?php } ?>

        </form>

    </div>

</div>

<script>

   // $("#form").validate();

   // $( ".sch_cd" ).select2();

</script>

<script>

    $(document).ready(function(){

        var global_dist = '<?php echo $bill_dtls->branch_id ?>',
            global_block= '<?php echo $bill_dtls->block_id ?>';


              $.post('<?php echo site_url("paddys/payment/wqsc_dtls"); ?>',
            
                {
                    soc_id:  '<?php echo $bill_dtls->soc_id; ?>',

                    mill_id: '<?php echo $bill_dtls->mill_id; ?>',

                    wqsc:    '<?php echo $bill_dtls->wqsc_no; ?>'
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

        function millGroup(dist) {

                //For District wise Mill
                $.get( 

                    '<?php echo site_url("paddy/mills");?>',

                    { 

                        dist: dist

                    }

                    ).done(function(data){

                    var string = '<option value="">Select</option>',
                        selected = '';

                    $.each(JSON.parse(data), function( index, value ) {

                        if(value.sl_no == '<?php echo $bill_dtls->mill_id ?>'){
                            
                            selected = 'selected';

                        }else{

                            selected = '';

                        }

                        string += '<option value="' + value.sl_no + '"'+ selected +'>' + value.mill_name + '</option>'

                    });

                    $('#mill_name').html(string);

                });
                
            

            } 

            function socGroup(block) { 

                //For Block wise Society
                $.get( 

                    '<?php echo site_url("paddy/societies");?>',

                    { 

                        block: block

                    }

                    ).done(function(data){

                    var string = '<option value="">Select</option>',
                        selected = '';

                    $.each(JSON.parse(data), function( index, value ) {

                        if(value.sl_no == '<?php echo $bill_dtls->soc_id; ?>'){
                            
                            selected = 'selected';

                        }else{

                            selected = '';

                        }

                        string += '<option value="' + value.sl_no + '"'+ selected +'>' + value.soc_name + '</option>'

                    });

                    $('#soc_name').html(string);

                });

            }

        millGroup('<?php echo $bill_dtls->branch_id ?>');

        socGroup( '<?php echo $bill_dtls->block_id ?>');

        $('#dist').change(function(){

            millGroup($(this).val());

            socGroup('');

        });

        $('#block').change(function(){
            
            socGroup($(this).val());

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

      

        $('.tot_paddy').val(sumValuesOf('qty_paddy'));
        $('.tot_cmr').val(sumValuesOf('qty_cmr'));
        $('.tot_butta').val(sumValuesOf('qty_butta'));
       // $('.less_butta').val(sumValuesOf('qty_butta'));

        //Millers Payment Details
        $('#intro1').on('change', '.particulars', function(){

            let indexNo = $('.particulars').index(this);

            $.get('<?php echo site_url("paddy/billMasterDetails"); ?>',{

                riceType: $('#rice_type').val(),
                sl_no: $(this).val()

            }).done(function(data){

                let values = JSON.parse(data);
                let action = values.action;
                
                $('.rate_per_qtls:eq('+indexNo+')').val(values.val);

                if(action == 'P'){

                    $('.amounts:eq('+indexNo+')').val(parseFloat(values.val) * parseFloat($('#totPaddy').val()));

                }else if(action == 'C'){

                    $('.amounts:eq('+indexNo+')').val(parseFloat(values.val) * parseFloat($('#totCmr').val()));

                }

            });

        });

        $('.less_butta').change(function(){

            var gunnycut  =  parseFloat($('.gunny_cut').val());

            $('.tot').val((sumValuesOf('paybel') - $(this).val()-gunnycut).toFixed());

        });

         $('.gunny_cut').change(function(){

            var less_butta  =  parseFloat($('.less_butta').val());
          

            $('.tot').val((sumValuesOf('paybel') - $(this).val()-less_butta).toFixed());

        });


        $('#intro1').on('change', '.paybel', function(){

            var less_butta  =  parseFloat($('.less_butta').val());
            var gunnycut  =  parseFloat($('.gunny_cut').val());

            $('.tot').val((sumValuesOf('paybel')-gunnycut-gunnycut).toFixed());
          
      

        });

        $('.tot_payble').val(sumValuesOf('paybel'));
        $('.payble_amount').val(sumValuesOf('paybel'));
      //  $('.less_butta').change();

        // $("#intro").on('click', '.removeRow',function(){
            
        //     $(this).parent().parent().remove();

        //     $('.tot_paddy').val(sumValuesOf('qty_paddy'));
        //     $('.tot_cmr').val(sumValuesOf('qty_cmr'));
        //     $('.tot_butta').val(sumValuesOf('qty_butta'));
            
        // });

        // $("#intro1").on('click', '.removeRow',function(){
            
        //     $(this).parent().parent().remove();

        //     $('.tot_payble').val(sumValuesOf('paybel'));
        //     $('.payble_amount').val(sumValuesOf('paybel'));
        //     $('.less_butta').change();
            
        // });
    });

  // $('#wqsc').change(function(){

        $( document ).ready(function() {
            
            //Progressive Paddy Procurement
            $.post('<?php echo site_url("paddys/payment/wqsc_qty"); ?>',
            
                {
                    soc_id:  '<?php echo $bill_dtls->soc_id; ?>',

                    mill_id: '<?php echo $bill_dtls->mill_id ?>',

                    wqsc:    '<?php echo $bill_dtls->wqsc_no; ?>'
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
                if(temp.rice_type = "P"){
                     $('#rice_type').val(temp.rice_type);
                     $('#rice_types').val("Par Boiled Rice");
                }else{
                     $('#rice_type').val(temp.rice_type);
                     $('#rice_types').val("Raw Rice");
                }
                if(temp.pool = "C"){
                     $('#pool').val(temp.pool);
                     $('#pools').val("Central Pool");
                }else if(temp.pool = "S"){
                     $('#pool').val(temp.pool);
                     $('#pools').val("State Pool");
                }else{
                    $('#pool').val(temp.pool);
                    $('#pools').val("FCI");
                }
               // $('select[name^="pool_type"] option[value="'+temp.pool+'"]').attr("selected","selected");
                
            });

              $.post( 
                    '<?php echo site_url("paddys/payment/soc_mill_distance");?>',

                    { 

                        soc_id : '<?php echo $bill_dtls->soc_id; ?>',
                        mill_id: '<?php echo $bill_dtls->mill_id ?>'

                    }

                ).done(function(data){

                    var string = JSON.parse(data);

                    $('#soc_mill_dis').val(string.distance);

                });
        });


</script>