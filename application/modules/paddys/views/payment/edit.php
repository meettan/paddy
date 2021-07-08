<div class="wraper">      

    <div class="col-md-12 container form-wraper" style="margin-left: 0px;">

          <?php

          if($bill_dtls->ho_status == 0) { ?> 

        <form method="POST" 
            id="form" action="<?php echo site_url("payment/payment_edit");?>" >

        <?php } ?>

            <div class="form-header">
            
                <h4>Millers Payment Edit</h4>
            
            </div>

            <input type="hidden" name="pmt_bill_no" value="<?php echo $bill_dtls->pmt_bill_no; ?>">
            <input type="hidden" name="kms_id" value="<?php echo $bill_dtls->kms_id; ?>">
            <input type="hidden" name="dist" value="<?php echo $bill_dtls->dist; ?>">
            <div class="form-group row">

                <label for="trans_dt" class="col-sm-1 col-form-label">Transaction Date:</label>

                <div class="col-sm-3">

                    <input type="date"
                            class="form-control required"
                            name="trans_dt"
                            id="trans_dt"
                            value="<?php echo $bill_dtls->trans_dt; ?>"
                        />

                </div>

                <label for="block" class="col-sm-1 col-form-label">Block:</label>

                <div class="col-sm-3">

                    <select name="block" id="block" class="form-control required" disabled>

                          <option value="">Select</option>
                          <?php

                            foreach($blocks as $blocks){

                        ?> 

                        <option value="<?php echo $blocks->sl_no;?>" <?php if($blocks->sl_no==$bill_dtls->block){echo "selected";}?>><?php echo $blocks->block_name;?></option>   

                        <?php

                            }

                        ?>  

                    </select>

                </div>

                <label for="soc_name" class="col-sm-1 col-form-label">Society Name:</label>

                <div class="col-sm-3">

                    <select type="text"
                        class="form-control"
                        name="soc_name" disabled
                        id="soc_name"
                        >

                        <option value="">Select</option>    

                        <option value="">Select Block First</option>    

                    </select>    

                </div>

               

            </div>

            <div class="form-group row">

               

                <label for="mill_name" class="col-sm-1 col-form-label">Mill Name:</label>

                <div class="col-sm-3">

                    <select type="text"
                        class="form-control"
                        name="mill_name" disabled
                        id="mill_name"
                    >

                        <option value="">Select</option>    

                        <option value="">Select District First</option>    

                    </select>

                </div>


                <label for="totPaddy" class="col-sm-1 col-form-label">Sanc No:</label>

                <div class="col-sm-3">

                    <input type="text"
                            class="form-control required"
                            name="totPaddy" readonly
                            id="totPaddy"
                            value="<?php echo $bill_dtls->sanc_no; ?>"
                        />

                </div>


                <label for="soc_name" class="col-sm-1 col-form-label">Wqsc:</label>

                <div class="col-sm-3">

                    <input type="text"
                            class="form-control required" readonly
                            name="wqsc"
                            id="wqsc"
                            value="<?php echo $bill_dtls->wqsc; ?>"
                        />

                </div>

            </div>  

            <div class="form-group row">

                <label for="totPaddy" class="col-sm-1 col-form-label">Total Paddy:</label>

                <div class="col-sm-3">

                    <input type="text"
                            class="form-control required"
                            name="totPaddy" readonly
                            id="totPaddy"
                            value="<?php echo $bill_dtls->tot_paddy; ?>"
                        />

                </div>


                <label for="totCmr" class="col-sm-1 col-form-label">Total CMR:</label>

                <div class="col-sm-3">
                            
                 <input type="text" name="demo" value="<?php echo $bill_dtls->tot_cmr; ?>" class="form-control" readonly>

                </div>

                <label for="rice_type" class="col-sm-1 col-form-label">Rice Type:</label>

                <div class="col-sm-3">

                    <select class="form-control required" disabled
                            name="rice_type"
                            id="rice_type"
                        >

                        <option>Select</option>

                        <option value="P" <?php echo ($bill_dtls->rice_type == 'P')?'selected':''; ?>>Par Boiled Rice</option>

                        <option value="R" <?php echo ($bill_dtls->rice_type == 'R')?'selected':''; ?>>Raw Rice</option>

                    </select>    

                </div>


             </div>  

             <!-- <div class="form-group row">


                 <label for="memo_no" class="col-sm-1 col-form-label">Memo No:</label>

                <div class="col-sm-3">

                    <input type="text" class="form-control" readonly="" name="memo_no" id="memo_no">

                </div>

              

                <label for="memo_dt" class="col-sm-1 col-form-label">Memo Date:</label>

                <div class="col-sm-5">

                        <input type="date" class="form-control" readonly="" name="memo_dt" id="memo_dt">

                </div>

               
            </div> -->
      
          <!--   <div class="form-group row">


                 <label for="goodown_name" class="col-sm-1 col-form-label">Goodown name:</label>

                <div class="col-sm-5">

                    <input type="text" class="form-control" readonly="" name="goodown_name" id="goodown_name">

                </div>
              

                <label for="goodown_dist" class="col-sm-1 col-form-label">Goodown District:</label>

                <div class="col-sm-5">

                        <input type="text" class="form-control" readonly="" name="goodown_dist" id="goodown_dist">

                </div>

               
            </div> -->


            <div class="form-group row">

                <label for="pool_type" class="col-sm-1 col-form-label">Pool Type:</label>

                <div class="col-sm-3">

                    <select class="form-control required"
                            name="pool_type" disabled
                            id="pool_type"
                        >

                        <option>Select</option>

                        <option value="S" <?php echo ($bill_dtls->pool_type == 'S')?'selected':''; ?>>State Pool</option>

                        <option value="C" <?php echo ($bill_dtls->pool_type == 'C')?'selected':''; ?>>Central Pool</option>

                    </select>    

                </div>


                   <label for="mandi_board" class="col-sm-1 col-form-label">Mandi Board:</label>

                    <div class="col-sm-3">
                               <input type="text"
                            class="form-control" name="mandi_board" id="mandi_board"  value="<?php echo $bill_dtls->mandi_board; ?>" required/>
                    </div>

                    <label for="mandi_board" class="col-sm-1 col-form-label">Mandi Board Address:</label>

                    <div class="col-sm-3">
                               <input type="text"
                            class="form-control" name="mandi_board_addr" id="mandi_board_addr" value="<?php echo $bill_dtls->mandi_board_addr; ?>" required/>
                    </div>

              <!--   <label for="inter_district:" class="col-sm-1 col-form-label">Inter District:</label>

                <div class="col-sm-5">

                               <input type="text" class="form-control" readonly="" name="inter_district" id="inter_district">
                </div> -->

            </div>

          <!--   <div class="form-group row">

                 <label for="soc_mill_dis" class="col-sm-1 col-form-label">Soc Mill Distance:</label>

                    <div class="col-sm-5">
                               <input type="text" readonly="" class="form-control" name="soc_mill_dis" id="soc_mill_dis">
                    </div>

                   <label for="rm_gd_dist" class="col-sm-1 col-form-label">Goodown Distance:</label>

                    <div class="col-sm-5">
                               <input type="text" class="form-control" readonly="" name="rm_gd_dist" id="rm_gd_dist">
                    </div>
                        
            </div> -->
            <div class="form-group row">
                
                   <label for="mandi_board" class="col-sm-1 col-form-label">Transport Agency Name:</label>

                    <div class="col-sm-3">
                               <input type="text"
                            class="form-control" name="transport_agency_name" id="transport_agency_name" value="<?php echo $bill_dtls->transport_agency_name; ?>" required/>
                    </div>

                    <label for="mandi_board" class="col-sm-1 col-form-label">Transport Agency Address:</label>

                    <div class="col-sm-3">
                               <input type="text"
                            class="form-control" name="transport_agency_addr" id="transport_agency_addr" value="<?php echo $bill_dtls->transport_agency_addr; ?>" required/>
                    </div>
                        
            </div>
         <!--     <div id="wqsc_dtls">
                
                   
                       
                
                  
            </div> -->

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
                     <!--    <th>Total Butta</th> -->
                       <!--  <th><button type="button" class="btn btn-success addAnother"><i class="fa fa-plus"></i></button></th> -->

                    </tr>

                </thead>

                <tbody id="intro" class="tables">

                   

                        <tr>
                            <td><input type="text" 
                                    class="form-control mill_bill_no required" 
                                    name="mill_bill_no"
                                    value="<?php echo $bill_dtls->mill_bill_no; ?>"
                                    >
                                    
                            </td>
                            <td><input type="date" 
                                    class="form-control mill_bill_date required" 
                                    name="mill_bill_date"
                                    value="<?php echo $bill_dtls->mill_bill_dt; ?>"
                                    >
                            </td>
                            <td><input type="text" 
                                    class="form-control ben_bill_no" 
                                    name="ben_bill_no[]" 
                                    value="<?php echo $bill_dtls->ben_bill_no; ?>"
                                    >
                                    
                            </td>
                            <td><input type="date" 
                                    class="form-control ben_bill_dt required" 
                                    name="ben_bill_dt"
                                    value="<?php echo $bill_dtls->ben_bill_dt; ?>"
                                    >
                            </td>
                            <td><input type="text" 
                                    class="form-control qty_paddy required" 
                                    name="qty_paddy[]" readonly
                                    value="<?php echo $bill_dtls->paddy_qty; ?>"
                                    >
                                    
                            </td>
                            <td>
                                    <input type="text" 
                                    class="form-control"  readonly
                                    name="qty_cmr[]" 
                                    value="<?php echo $bill_dtls->paddy_cmr; ?>"
                                    >
                            </td>
                         <!--    <td><input type="text" 
                                    class="form-control qty_butta required" 
                                    name="qty_butta[]" 
                                    value="<?php //echo $b_dtls->paddy_butta; ?>"
                                    >
                                    
                            </td> -->
                            <td>
                               
                            </td>
                        </tr>
            
                </tbody> 

                <tfoot>
                    
               

                </tfoot>
            </table>

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
                        <th>Net Amount(Rs)</th>
                    <!--     <th><button type="button" class="btn btn-success addAnotherRow"><i class="fa fa-plus"></i></button></th> -->

                    </tr>

                </thead>

                <tbody id="intro1" class="tables">
                    
                    
                    <?php  
                            $gross_amt       = 0;
                            $tds_amt         = 0;
                            $cgst_amt        = 0;
                            $sgst_amt        = 0;
                            $sum             = 0;
                            $allocate_amount = 0;
                            $flag            = false;

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
                                       value="<?php echo $c_list->per_unit; ?>"
                                       readonly
                                       >
                          
                        <?php } ?>
                          </td>
                            <td><input type="text" 
                                       class="form-control amounts required"
                                       value="<?php echo $c_list->total_amt; $gross_amt +=$c_list->total_amt;?>"  readonly
                                       name="amounts[]"
                                       >
                            </td>
                            <td><input type="text" 
                                       class="form-control tds_amount" 
                                       value="<?php echo $c_list->tds_amt; $tds_amt +=$c_list->tds_amt; ?>" readonly
                                       name="tds_amount[]"
                                       >
                            </td>
                            <td><input type="text" 
                                       class="form-control cgst"
                                       value="<?php echo $c_list->cgst_amt; $cgst_amt +=$c_list->cgst_amt; ?>"  readonly
                                       name="cgst[]"
                                       >
                                       
                            </td>
                            <td><input type="text" 
                                       class="form-control sgst" 
                                       name="sgst[]" 
                                       value="<?php echo $c_list->sgst_amt; $sgst_amt +=$c_list->sgst_amt; ?>" readonly
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
                    
                    <tr>
                        <td></td>
                        <td></td>
                        <td style="text-align: right;"><b><?php echo $gross_amt; ?></b></td>
                        <td style="text-align: right;"><b><?php echo $tds_amt; ?></b></td>
                        <td style="text-align: right;"><b><?php echo $cgst_amt; ?></b></td>
                        <td style="text-align: right;"><b><?php echo $sgst_amt; ?></b></td>

                        <!--<td  colspan="3"  style="text-align: right;color:green"><b>Allocate Amount:</b></td>
                        <td  style="text-align: right;" ><b id="allocate_amount"><?php echo round($allocate_amount); ?></b></td>-->
                        <td style="text-align: right;"><b>Net Amount:</b></td>
                        <td style="text-align: right;"><b><?php echo round($sum); ?></b></td>
                        <td></td>    
                    </tr>

                    </tr>

                    <tr>
                    
                        <td colspan="7" style="text-align: right;">Less Butta:</td>
                        <td><input type="text" name="paddy_butta"  value='<?php echo $bill_dtls->paddy_butta; ?>' class="form-control less_butta"/></td>

                    </tr>

                    <tr>
                    
                        <td colspan="7" style="text-align: right;">Gunny Cut:</td>
                        <td><input type="text" name="gunny_cut"  value="<?php echo $bill_dtls->gunny_cut; ?>" class="form-control gunny_cut"/></td>

                    </tr>

                    <tr>
                    
                        <td colspan="7" style="text-align: right;"><b>Net Payble:</b></td>
                        <td>    <?php $tot = $sum-($bill_dtls->paddy_butta)-($bill_dtls->gunny_cut);?>
 
                                <b><input type="text" class="form-control tot"  value="<?php echo round($tot); ?>" readonly ></b>

                            </td>

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
                        <td>  <select class="form-control" 
                            name="pay_mode" id="pay_mode">

                        <option value="">Select</option>

                        <option value="C" <?php if($bill_dtls->pay_mode=="C"){ echo "selected";}   ?>>Cheque</option>
                        <option value="R"  <?php if($bill_dtls->pay_mode=="R"){ echo "selected";}   ?>>RTGS</option>
                        <option value="N"  <?php if($bill_dtls->pay_mode=="N"){ echo "selected";}   ?>>NEFT</option>

                    </select></td>
                        <td>

                               <select name="bank_id" id="bank_id" class="form-control" required>
                <option value="">Select</option>    
                <option value="1" <?php if($bill_dtls->bank_id == 1){ echo "selected"; } ?> >Yes Bank/Kasba</option>  
              <option value="2" <?php if($bill_dtls->bank_id == 2){ echo "selected"; } ?>>Bandhan Bank/Kasba</option>  
              <option value="3" <?php if($bill_dtls->bank_id == 3){ echo "selected"; } ?>>Icici Bank/Kasba</option>  
              <option value="4" <?php if($bill_dtls->bank_id == 4){ echo "selected"; } ?>>Axis Bank/Kasba</option>  
              <option value="5" <?php if($bill_dtls->bank_id == 5){ echo "selected"; } ?>>HDFC Bank/Kasba</option>  
                  </select>

<!--                              <?php //if($bill_dtls->bank_id == 1){ echo "Yes Bank/Kasba"; }
                      //  elseif($bill_dtls->bank_id == 2){ echo "Bandhan Bank/Kasba";}
                      //  elseif($bill_dtls->bank_id == 3){ echo "Icici Bank/Kasba";}
                      //  elseif($bill_dtls->bank_id == 4){ echo "Axis Bank/Kasba";}
                      //  elseif($bill_dtls->bank_id == 5) { echo "HDFC Bank/Kasba"; }
                  ?> -->


                         
                        </td>
                        <td><input type="text" class="form-control ref_no" name="ref_no" value="<?php echo $bill_dtls->ref_no; ?>" ></td>
                      
                       
                    </tr>
                </tbody> 

              
            </table>

         <?php if($bill_dtls->ho_status == 0) { ?> 
            <div class="form-group row">

                <div class="col-sm-5">

                    <input type="submit" class="btn btn-info" value="Save" />

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

        var global_dist = '<?php echo $bill_dtls->dist ?>',
            global_block= '<?php echo $bill_dtls->block ?>';


              $.post('<?php echo site_url("paddys/payment/wqsc_dtls"); ?>',
            
                {
                    soc_id:  '<?php echo $bill_dtls->soc_id; ?>',

                    mill_id: '<?php echo $bill_dtls->mill_id; ?>',

                    wqsc:    '<?php echo $bill_dtls->wqsc; ?>'
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

                console.log("fuck");

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

        millGroup('<?php echo $bill_dtls->dist ?>');

        socGroup( '<?php echo $bill_dtls->block ?>');

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

        $('.addAnother').click(function(){

            let row = '<tr>' +
                        '<td><input type="text" class="form-control mill_bill_no" name="mill_bill_no[]"></td>' +
                        '<td><input type="date" class="form-control mill_bill_date" name="mill_bill_date[]"></td>' +
                        '<td><input type="text" class="form-control confed_bill_no" name="confed_bill_no[]"></td>' +
                        '<td><input type="date" class="form-control confed_bill_date" name="confed_bill_date[]"></td>' +
                        '<td><input type="text" class="form-control qty_paddy" name="qty_paddy[]"></td>' +
                        '<td><input type="text" class="form-control qty_cmr" name="qty_cmr[]"></td>' +
                        '<td><input type="text" class="form-control qty_butta" name="qty_butta[]"></td>' +
                        '<td><button type="button" class="btn btn-danger removeRow"><i class="fa fa-remove"></i></button></td>' +
                      '</tr>';
            
            $('#intro').append(row);

        });

        $('.addAnotherRow').click(function(){

            let row = '<tr>' +
                        '<td><select class="form-control particulars" name="particulars[]">  id="ex_ad" ' +

                            '<option value="">Select</option> ' +

                            '<?php
                            foreach($bill_master as $b_list){ ' +

                                '?> ' +

                                    '<option value="<?php echo $b_list->sl_no; ?>"><?php echo $b_list->param_name; ?></option> ' +

                                '<?php } ' +
                            '?> ' +
                            '</select> ' +
                        '</td> ' +
                        '<td><input type="text" class="no-border rate_per_qtls" name="rate_per_qtls[]" readonly></td>' +
                        '<td><input type="text" class="form-control amounts" name="amounts[]"></td>' +
                        '<td><input type="text" class="form-control tds_amount" name="tds_amount[]" readonly></td>' +
                        '<td><input type="text" class="form-control cgst" name="cgst[]" readonly></td>' +
                        '<td><input type="text" class="form-control sgst" name="sgst[]" readonly></td>' +
                        '<td><input type="text" class="form-control paybel" name="paybel[]"></td>' +
                        '<td><button type="button" class="btn btn-danger removeRow"><i class="fa fa-remove"></i></button></td>' +
                    '</tr>';

            $('#intro1').append(row);

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

                    wqsc:    '<?php echo $bill_dtls->wqsc; ?>'
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