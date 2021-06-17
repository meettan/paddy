<div class="wraper">      
<div class="col-md-8 container form-wraper" style="margin:0 auto;float:none">

    <form method="POST" 
        id="form"
        action="<?php echo site_url("paddys/transactions/f_doisseued_edit");?>" >

        <div class="form-header">
        
            <h4>DO Issue Edit</h4>
        
        </div>

        <input type="hidden"
                name="trans_no"
                value="<?php echo $doisseued_dtls->trans_no;?>"
            />

        <div class="form-group row">

           

            <label for="block" class="col-sm-2 col-form-label">Block:</label>

            <div class="col-sm-4">

                <select name="block" id="block" class="form-control " disabled>

                    <option value="">Select Block</option>    
                   <?php 

                   foreach($blocks as $block){  ?>
                    <option value="<?php if(isset($block->sl_no)){ echo $block->sl_no ;}?>" <?php if($block->sl_no == $doisseued_dtls->block_id) { echo "selected";} ?> >
                    <?php if(isset($block->block_name)){ echo $block->block_name ;}?></option>    
                      <?php } ?>
                </select>

            </div>

            <label for="trans_dt" class="col-sm-2 col-form-label">Transaction Date:</label>

                <div class="col-sm-4">

                    <input type="date"
                            class="form-control" 
                            name="trans_dt"
                            id="trans_dt"
                            value="<?php echo $doisseued_dtls->trans_dt;?>"
                        />

                </div>


        </div>

        <div class="form-group row">

            <label for="soc_name" class="col-sm-2 col-form-label">Society Name:</label>

            <div class="col-sm-10">

                <select type="text"
                    class="form-control required sch_cd"
                    name="soc_name" disabled
                    id="soc_name">

                    <option value="">Select</option>    

                    <option value="">Select Block First</option>    

                </select>    

            </div>

        </div>  

        <div class="form-group row">

            <label for="mill_name" class="col-sm-2 col-form-label">Mill Name:</label>

            <div class="col-sm-10">

                <select type="text"
                    class="form-control required sch_cd"
                    name="mill_name" disabled
                    id="mill_name">

                    <option value="">Select</option>    

                    <option value="">Select District First</option>    


                </select>

            </div>

        </div>  

        <div class="form-group row">

                <label for="tot_cmr_offered" class="col-sm-2 col-form-label">Total CMR offered:</label>

                <div class="col-sm-10">

                    <input type="text"
                            class="form-control"
                            name="tot_cmr_offered" 
                            id="tot_cmr_offered" value="<?php echo $doisseued_dtls->tot_cmr_offered; ?>"
                            readonly/>

                </div>

            </div>   

            <div class="form-header">
            
                <h4>DO Issued</h4>
            
            </div>

            <div class="form-group row">

                <label for="state_pool" class="col-sm-2 col-form-label">Do Number:</label>

                 <div class="col-sm-4">

                <input type="text" class="form-control" name="do_number"  readonly
                id="do_number" value="<?php echo $doisseued_dtls->do_number; ?>" >   

                        </div>
                
                        <label for="dist" class="col-sm-2 col-form-label">District:</label>

                 <div class="col-sm-4">

                <select name="dist" id="dist" class="form-control required" >

                 <option value="">Select</option>

                 <?php
                      foreach($dist as $dlist){  ?>

                  <option value="<?php echo $dlist->district_code;?>"
                 <?php echo ($dlist->district_code == $doisseued_dtls->dist)?'selected':'';?> >
                 <?php echo $dlist->district_name;?></option>

                   <?php     }   ?>    

                </select>

                </div>
                          
               
              </div>

              <div class="form-group row">

                <label for="state_pool" class="col-sm-2 col-form-label">Godown Name:</label>

                <div class="col-sm-10">

                    <input type="text" class="form-control " 
                    name="goodown_name" id="goodown_name" 
                    value="<?php echo $doisseued_dtls->goodown_name;?>" readonly>   
                </div>

            </div>

            <div class="form-group row">

                    <label for="inter_dist" class="col-sm-2 col-form-label">Inter District:</label>

                    <div class="col-sm-4">

                       <!--    <input type="text"
                        class="form-control"
                        name="inter_dist" value="<?php //echo $doisseued_dtls->inter_dist;?>" readonly
                        id="inter_dist"/> -->

                <select name="inter_dist"  class="form-control">
                    <option value="Y" <?php if($doisseued_dtls->inter_dist == 'Y'){ echo "selected";}?>>YES</option>
                    <option value="N" <?php if($doisseued_dtls->inter_dist == 'N'){ echo "selected";}?>>NO</option>

                </select>   
                        
                          

                    </div> 
                    <label for="rm_gd_dist" class="col-sm-2 col-form-label">Mill Godown Distance:</label>

                    <div class="col-sm-4">

                        <input type="text"
                            class="form-control"
                            name="rm_gd_dist"
                            id="rm_gd_dist" value="<?php echo $doisseued_dtls->rm_gd_dist;?>"
                            style="text-align:"
                        />

                    </div> 
            </div> 
            <div class="form-group row">
                <label for="rice_type" class="col-sm-2 col-form-label">CMR Type:</label>
                        <div class="col-sm-4">

                        <select class="form-control required" name="rice_type" id="rice_type" 
                         aria-required="true" disabled>
                            
                            <option value="">Select</option>
                            <option value="P" <?php if($doisseued_dtls->rice_type=="P") { echo "selected";} ?>>Par Bolied</option>
                            <option value="R" <?php if($doisseued_dtls->rice_type=="R") { echo "selected";} ?>>Raw Rice</option>

                        </select>    

                    </div>  

                    <label for="state_pool" class="col-sm-2 col-form-label">Total Do Issue:</label>

                    <div class="col-sm-4">

                        <input type="text" class="form-control " name="tot_do_issue" id="tot_do_issue"  
                        value="<?php echo $doisseued_dtls->tot_doisseued;?>">   
                        </div>

                </div>

                <div class="form-group row">

                    <label for="state_pool" class="col-sm-2 col-form-label">Progressive Do Issued:</label>

                    <div class="col-sm-10">

                    <input type="text" class="form-control " name="progressive_do_issue" id="progressive_do_issue" readonly="">   

                            </div>
                

                </div>

            <div class="form-group row">

                <label for="state_pool" class="col-sm-2 col-form-label">State Pool:</label>

                <div class="col-sm-2">

                    <input type="text"
                        class="form-control offer_type" 
                        name="state_pool"
                        id="state_pool"
                        value="<?php echo $doisseued_dtls->sp; ?>"
                    />   

                </div>

                <label for="central_pool" class="col-sm-2 col-form-label">Central Poll:</label>

                <div class="col-sm-2">

                    <input type="text"
                        class="form-control offer_type" 
                        name="central_pool"
                        id="central_pool"
                        value="<?php echo $doisseued_dtls->cp; ?>"/>

                </div>   

                <label for="fci" class="col-sm-2 col-form-label">FCI:</label>

                <div class="col-sm-2">

                    <input type="text"
                        class="form-control offer_type" 
                        name="fci"
                        id="fci"
                        value="<?php echo $doisseued_dtls->fci; ?>"/>

                </div>                 

            </div>
 
            <div class="form-group row">

                 
                 <label for="tot_cmr_doisseued" class="col-sm-2 col-form-label">DO Yet To Be Issued:</label>

                <div class="col-sm-10">

                    <input type="text" class="form-control" name="do_yet_to_be_issued" 
                    id="do_yet_to_be_issued" style="text-align: center" 
                    value="<?php echo $doisseued_dtls->do_yet_to_be_issued; ?>" readonly="">

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

        var global_dist = '<?php echo $doisseued_dtls->dist ?>',
            global_block= '<?php echo $doisseued_dtls->block ?>';

        

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

                        if(value.sl_no == '<?php echo $doisseued_dtls->soc_id ?>'){
                            
                            selected = 'selected';

                        }else{

                            selected = '';

                        }

                        string += '<option value="' + value.sl_no + '"'+ selected +'>' + value.soc_name + '</option>'

                    });

                    $('#soc_name').html(string);

                });

            }

            function millGroup(soc_id) {

                    //For District wise Mill
                    $.post( 

                        '<?php echo site_url("paddys/transactions/f_soc_mills");?>',

                        { 

                            soc_id: <?php echo $doisseued_dtls->soc_id ?>

                        }

                        ).done(function(data){

                        var string = '<option value="">Select</option>',
                            selected = '';

                        $.each(JSON.parse(data), function( index, value ) {

                            if(value.sl_no == '<?php echo $doisseued_dtls->mill_id ?>'){
                                
                                selected = 'selected';

                            }else{

                                selected = '';

                            }

                            string += '<option value="' + value.sl_no + '"'+ selected +'>' + value.mill_name + '</option>'

                        });

                        $('#mill_name').html(string);

                    });

                }
       

        socGroup( '<?php echo $doisseued_dtls->block ?>');

        millGroup('<?php echo $doisseued_dtls->soc_id ?>');

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

          <?php if(isset($doisseued_dtls->block)){ ?>

                //Progressive Paddy Procurement
                $.get('<?php echo site_url("paddys/transactions/f_added_doissue"); ?>',

                    {
                        soc_id:  '<?php echo $doisseued_dtls->soc_id; ?>',
                        mill_id: '<?php echo $doisseued_dtls->mill_id; ?>'
                    }
                
                )
                .done(function(data){

                    let temp = JSON.parse(data);

                    var rum = parseFloat(temp.tot);

                    var gum = parseFloat($('#tot_do_issue').val());

                    var tum = parseFloat($('#tot_cmr_offered').val());
                    
                    var sum =  rum + gum;
                    
                    $('#progressive_do_issue').val(rum);

                    $('#do_yet_to_be_issued').val((tum-rum).toFixed(2));
                });
            <?php } ?>


    $(document).ready(function(){

        function prevOffered(soc_id, mill_id){

            //Progressive Paddy Procurement
            $.get('<?php echo site_url("paddy/totoffer"); ?>',

                {

                    soc_id:  soc_id,

                    mill_id: mill_id

                }
            
            )
            .done(function(data){
                
                let temp = JSON.parse(data);

                $('#tot_cmr_offered').val(temp.tot);
                $('#state_pool_offer').val(temp.sp);
                $('#central_pool_offer').val(temp.cp);
                $('#fci_offer').val(temp.fci);

                if(temp.tot == '0.000'){

                    $('#submit').attr('type', 'button');

                }
                else{
    
                    $('#submit').attr('type', 'submit');

                }
                
            });

        }

        prevOffered('<?php echo $doisseued_dtls->soc_id; ?>', '<?php echo $doisseued_dtls->mill_id; ?>');

        $('#mill_name').change(function(){
            
            prevOffered($('#soc_name'), $(this).val());

        });

    });

</script>

<script>

    $(document).ready(function(){

        $('.offer_type').change(function(){
            
            let total = 0;

            $("#tot_cmr_doisseued").val('');
  
            $('.offer_type').each(function(){
                
                total += +$(this).val();
                
            });

            if(total <= $('#tot_cmr_offered').val()){

                $("#tot_cmr_doisseued").val(total);

                $('#submit').attr('type', 'submit');

            }
            else{

                $('#submit').attr('type', 'button');

            }
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

        var total = 0;           
        var trans_dt = $('#trans_dt').val();
        var tot_do_issue =parseFloat($('#tot_do_issue').val());
        var tot_cmr_offered = parseFloat(document.getElementById("tot_cmr_offered").value);
        var progressive_do_issue = parseFloat(document.getElementById("progressive_do_issue").value);

        $('.offer_type').each(function(){
        
                    total += +$(this).val();
                    
                });
                 
            var d = new Date();
            var month = d.getMonth()+1;
            var day = d.getDate();

         var output = d.getFullYear() + '-' +
            (month<10 ? '0' : '') + month + '-' +
            (day<10 ? '0' : '') + day;

                            if(new Date(output) < new Date(trans_dt)){

                              alert("Transaction  Date Can Not Be Greater Than Current Date");
                              event.preventDefault();
                            } else if(progressive_do_issue > tot_cmr_offered){

                                alert("Progressive Do Issue Cannot be greater Than Total CMR Offered!");
                                return false;

                            }else if(total != tot_do_issue ){
                      
                   
                                alert("Pool Calculation is Worng!");
                                return false;

                            }
                             else 
                                {
                            //  alert("Transaction Date Can Not Be Less Than order Date");

                               $('#submit').attr('type', 'submit');
                       
                      }
            });

         $("#dist").change(function(){

        var current_dist = <?php echo $this->session->userdata['loggedin']['branch_id'];?>;
        var dist         = $(this).val();

        if(current_dist == dist)
            {
                 $("#inter_dist").val("N");
            }else{

                     $("#inter_dist").val("Y");
                 }

          

        });

</script>

<script>
      $(document).ready(function(){


         $("#tot_do_issue").change(function(){

                var soc_id  ='<?php echo $doisseued_dtls->soc_id; ?>';
                var mill_id ='<?php echo $doisseued_dtls->mill_id; ?>';
                var current_tot = '<?php echo $doisseued_dtls->tot_doisseued;?>';

                 $.get('<?php echo site_url("paddys/transactions/f_tot_doissue"); ?>',

                    {
                        soc_id: soc_id,
                        mill_id: mill_id
                    }
                
                )
                .done(function(data){

                    let temp = JSON.parse(data);

                    var rum = parseFloat(temp.tot)-parseFloat(current_tot);

                    var gum = parseFloat($('#tot_do_issue').val());

                    var tum = parseFloat($('#tot_cmr_offered').val());
                    
                    var sum =  rum + gum;
                    
                    $('#progressive_do_issue').val(sum);

                    $('#do_yet_to_be_issued').val((tum-sum).toFixed(2));
                });
            })

      })

</script>