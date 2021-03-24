<div class="wraper">      

    <div class="col-md-8 container form-wraper" style="margin:0 auto;float:none">

        <form method="POST" 
            id="form" onsubmit="return ValidationEvent()"
            action="<?php echo site_url("paddys/transactions/f_doisseued_add");?>" >

            <div class="form-header">
            
                <h4>DO Issue Entry</h4>
            
            </div>

            <div class="form-group row">

                <label for="block" class="col-sm-2 col-form-label">Block:</label>

                <div class="col-sm-4">

                    <select name="block" id="block" class="form-control required">

                        <option value="">Select</option>    
                     <?php foreach($blocks as $block) {?>
                        <option value="<?php if(isset($block->sl_no)){ echo $block->sl_no ;}?>"><?php if(isset($block->block_name)){ echo $block->block_name ;}?></option>    
                              <?php } ?>
                    </select>

                </div>

                <label for="trans_dt" class="col-sm-2 col-form-label">Do Issue:</label>

            <div class="col-sm-4">

              <input type="date"
                    class="form-control required"
                    name="trans_dt" id="trans_dt" value="<?php echo date('Y-m-d');?>"
                    />
           </div>

            </div>

            <div class="form-group row">

                <label for="soc_name" class="col-sm-2 col-form-label">Society Name:</label>

                <div class="col-sm-10">

                    <select type="text"
                        class="form-control required sch_cd"
                        name="soc_name"
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
                        name="mill_name"
                        id="mill_name">

                        <option value="">Select</option>    
                        <option value="">Select Society First</option>    

                    </select>

                </div>

            </div>  

            <div class="form-group row">

                <label for="tot_cmr_offered" class="col-sm-2 col-form-label">Total CMR offered:</label>

                <div class="col-sm-4">

                    <input type="text"
                            class="form-control"
                            name="tot_cmr_offered"
                            id="tot_cmr_offered"
                            readonly />

                </div>
                  <label for="Offered_date" class="col-sm-2 col-form-label">Offered Date:</label>

                <div class="col-sm-4">

                    <input type="text"
                            class="form-control"
                            name="offered_date"
                            id="offered_date"
                            readonly />
                </div>

                </div>

              <div class="form-group row">
                 <label for="rice_type" class="col-sm-2 col-form-label">CMR Type:</label>
                    <div class="col-sm-4">
                 <input type="hidden"
                            class="form-control"
                            name="rice_type" id="rice_type" readonly />

                    <input type="text"
                            class="form-control" name="rice_type_show"
                            id="rice_type_show" readonly />
                </div>  

            </div>

            <div class="form-header">
                <h4>DO Issue</h4>
            </div>

            <div class="form-group row">

                <label for="state_pool" class="col-sm-2 col-form-label">Do Number:</label>

                 <div class="col-sm-4">

                <input type="text" class="form-control" name="do_number" id="do_number" required/>   

                        </div>

                        <label for="dist" class="col-sm-2 col-form-label">District:</label>

                        <div class="col-sm-4">

                        <select name="dist" id="dist" class="form-control required">

                            <option value="">Select</option>

                            <?php

                                foreach($dist as $dlist){

                            ?>

                                <option value="<?php echo $dlist->district_code;?>"><?php echo $dlist->district_name;?></option>

                            <?php

                                }

                            ?>     
                        </select>
                        </div>        
               
              </div> 

              <div class="form-group row">

                <label for="state_pool" class="col-sm-2 col-form-label">Godown Name:</label>

                <div class="col-sm-10">

                    <input type="text"
                        class="form-control "
                        name="goodown_name"
                        id="goodown_name"/>   
                </div>

            </div>

            <div class="form-group row">

                    <label for="inter_dist" class="col-sm-2 col-form-label">Inter District:</label>

                    <div class="col-sm-4">

                          <input type="hidden"
                        class="form-control "
                        name="inter_dist" value="" readonly 
                        id="inter_dist"/>   
                           <input type="text"
                        class="form-control "
                        name="inter_dists" value="" readonly 
                        id="inter_dists"/> 
                          

                    </div> 
                    <label for="rm_gd_dist" class="col-sm-2 col-form-label">Mill Godown Distance:</label>

                    <div class="col-sm-4">

                        <input type="text"
                            class="form-control"
                            name="rm_gd_dist"
                            id="rm_gd_dist"
                            style="text-align:"
                        />

                    </div> 
            </div> 

            <div class="form-group row">

                <label for="state_pool" class="col-sm-2 col-form-label">Total Do Issue:</label>

                <div class="col-sm-4">

                    <input type="text"
                        class="form-control"
                        name="tot_do_issue"
                        id="tot_do_issue"/>   
                    </div>

                     <label for="state_pool" class="col-sm-2 col-form-label">Progressive Do Issue:</label>

                    <div class="col-sm-4">

                    <input type="text"
                        class="form-control "
                        name="progressive_do_issue" id="progressive_do_issue"  readonly/>   

                    </div>
      
              </div>   

            <div class="form-group row">

                <label for="state_pool" class="col-sm-2 col-form-label">State Pool:</label>

                <div class="col-sm-2">

                    <input type="text"
                        class="form-control offer_type"
                        name="sp" value="0.000"
                        id="sp"/>   

                </div>

                <label for="central_pool" class="col-sm-2 col-form-label">Central Pool:</label>

                <div class="col-sm-2">

                    <input type="text"
                        class="form-control offer_type"
                        name="cp" value="0.000"
                        id="cp"/>

                </div>   

                <label for="fci" class="col-sm-2 col-form-label">FCI:</label>

                <div class="col-sm-2">

                    <input type="text"
                        class="form-control offer_type"
                        name="fci" value="0.000"
                        id="fci"
                    />

                </div>                 

            </div>
            <div class="form-group row">

                

                </div>

            <div class="form-group row">

                 

                 <label for="tot_cmr_doisseued" class="col-sm-2 col-form-label">DO Yet To Be Issued:</label>

                <div class="col-sm-10">

                    <input type="text"
                        class="form-control"
                        name="do_yet_to_be_issued"
                        id="do_yet_to_be_issued"
                        style="text-align: center"
                        readonly/>

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

    $(document).ready(function(){

        $("#soc_name").change(function(e){
   
        var soc_id = $(this).val(); // anchors do have text not values.
     
        $.ajax({
        url: '<?php echo base_url();?>index.php/paddys/transactions/f_connected_mill_society',
        data: {'soc_id': soc_id}, // change this to send js object
        type: "post",
        dataType: 'json',
        success: function(data){
         
           $("#mill_name").find('option').remove();
           $('#mill_name').append(data.html);
          
         }
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

            $('#tot_do_issue').change(function(){

                //Progressive Paddy Procurement
                $.get('<?php echo site_url("paddys/transactions/f_added_doissue"); ?>',

                    {
                        soc_id:  $('#soc_name').val(),

                        mill_id:  $('#mill_name').val()

                    }
                
                )
                .done(function(data){

                    let temp = JSON.parse(data);

                    var do_prev         = parseFloat(temp.tot);

                    var do_supplied     = parseFloat($('#tot_do_issue').val());

                    var tot_cmr         = parseFloat($('#tot_cmr_offered').val());

                     $('#progressive_do_issue').val(do_prev + do_supplied);

                   $('#do_yet_to_be_issued').val((tot_cmr-(do_prev + do_supplied)).toFixed(5));


                    if((do_prev + do_supplied)  > tot_cmr){
                        console.log(do_prev + do_supplied);

                        alert("Progressive Do Issue Cannot Be Greater Than Total Cmr Offered");
                        $('#progressive_do_issue').val("");
                        $('#tot_do_issue').val("");
                        $('#do_yet_to_be_issued').val("");

                        $('#submit').attr('type', 'button');

                        }
                        else{

                        $('#submit').attr('type', 'submit');

                        }
                });
                    
             });

         });
        

    $(document).ready(function(){

        $('#mill_name').change(function(){
            
            $.get('<?php echo site_url("paddys/transactions/f_totoffer"); ?>',

                {

                    soc_id:  $('#soc_name').val(),

                    mill_id: $(this).val()

                }
            
            )
            .done(function(data){
                
                let temp = JSON.parse(data);
                $('#tot_cmr_offered').val(temp.tot);

                  $('#do_yet_to_be_issued').val(("0"));

                 var items = (temp.trans_dt).split('-');
                
                $('#offered_date').val(items["2"] + '/' + items["1"] + '/' + items["0"]);
                var rice_type = temp.rice_type;

                if(rice_type == "P"){
                   $('#rice_type').val("P");
                   $('#rice_type_show').val("Par Boiled");
                }else{
                    $('#rice_type').val("R");
                    $('#rice_type_show').val("Raw Rice");
                }

                if(temp.tot == '0.000'){

                    $('#submit').attr('type', 'button');

                }
                else{
    
                    $('#submit').attr('type', 'submit');

                }
                
            });

        });

        $("#mill_name").change(function(){

            $.get('<?php echo site_url("paddys/transactions/f_added_doissue"); ?>',
            
                {
                    soc_id:  $('#soc_name').val(),

                    mill_id: $(this).val()
                }
            
            )

            .done(function(data){

                let temp = JSON.parse(data);

                var doIsud = temp.tot;     
                var totCmr = $('#tot_cmr_offered').val();
                var do_Pending = totCmr - doIsud;
                do_Pending = parseFloat(do_Pending);
                do_Pending = do_Pending.toFixed(3);

                $('#do_yet_to_be_issued').val(do_Pending);

            });

        });

    });

</script>

<script>

    $(document).ready(function(){

        $('.offer_type').change(function(){
            
            var total = parseFloat("0.00");
  
            $('.offer_type').each(function(){
                
                total +=  parseFloat($(this).val());
                
            });
            var tot_do_issue = parseFloat($('#tot_do_issue').val());

            console.log(total);
        
            if(parseFloat(total) > parseFloat(tot_do_issue) ){

                 alert("Pool Calculation is Worng!");

               $('#submit').attr('type', 'button');

            }else{

                $('#submit').attr('type', 'submit');
            }
            
        });

    });


    function ValidationEvent() {

            var total = 0;
            var tot_do_issue =parseFloat($('#tot_do_issue').val());
            var trans_dt = $('#trans_dt').val();
            var date = ($('#offered_date').val()).split('/');

           // console.log(trans_dt);

            var newDate = date["2"]+ '-' + date["1"] + '-' + date["0"];

            
      
            var tot_cmr_offered = parseFloat(document.getElementById("tot_cmr_offered").value);
            var progressive_do_issue = parseFloat(document.getElementById("progressive_do_issue").value);
                 
                $('.offer_type').each(function(){
        
                    total += +$(this).val();
                    
                });
                    
                if(progressive_do_issue > tot_cmr_offered) {
                    alert("Progressive Do Issue Cannot be greater Than Total CMR Offered!");
                    return false;
                
                } else if(new Date(trans_dt) < new Date(newDate) ){
                    
                  alert("Do Issue date cannot be lesser than Offered Date");
                    return false;

                }else if(total != tot_do_issue ){
                      
                   
                    alert("Pool Calculation is Worng!");
                    return false;

                } else {
                   
                    return true;
                  }
                        
    }


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

    $("#dist").change(function(){

        var current_dist = <?php echo $this->session->userdata['loggedin']['branch_id'];?>;
        var dist         = $(this).val();

        if(current_dist == dist)
            {
                 $("#inter_dist").val("N");
                 $("#inter_dists").val("NO");
            }else{

                     $("#inter_dist").val("Y");
                     $("#inter_dists").val("YES");
                 }

          

        });
                
</script>