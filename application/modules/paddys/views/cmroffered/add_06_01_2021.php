<div class="wraper">      

    <div class="col-md-6 container form-wraper" style="margin-left: 5px;">

        <form method="POST" 
            id="form"
            action="<?php echo site_url("paddys/transactions/f_offered_add");?>" >

            <div class="form-header">
            
                <h4>CMR Offer Entry</h4>
            
            </div>

            <div class="form-group row">

                <label for="block" class="col-sm-2 col-form-label">Block:</label>

                <div class="col-sm-4">

                    <select name="block" id="block" class="form-control required">

                        <option value="">Select Block First</option>    
                         <?php foreach($blocks as $block){?>
                        <option value="<?php if(isset($block->sl_no)){ echo $block->sl_no;}?>"><?php if(isset($block->block_name)){ echo $block->block_name;}?></option>    
                         <?php } ?>
                    </select>
                </div>

                <label for="trans_dt" class="col-sm-2 col-form-label">Offer Date:</label>

                <div class="col-sm-4">
                    <input type="date"
                            class="form-control required"
                            name="trans_dt"
                            id="trans_dt"
                            value="<?php echo date('Y-m-d');?>"/>
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
                        name="mill_name" id="mill_name">

                        <option value="">Select</option>    

                        <option value="">Select Society First</option>    


                    </select>

                </div>

            </div>  

            <div class="form-group row">

                <label for="tot_pdy_delivrd" class="col-sm-2 col-form-label">Progressive Paddy Received:</label>

                <div class="col-sm-4">

                    <input type="text"
                            class="form-control"
                            name="progressive_paddy_received"
                            id="tot_pdy_delivrd"  value="" readonly />

                </div>

                <label for="tot_pdy_delivrd" class="col-sm-2 col-form-label">Received Upto Date:</label>

                <div class="col-sm-4">

                    <input type="text"
                            class="form-control"
                            name="received_date"
                            id="received_date"  value="" readonly />

                </div>

            </div>

            <div class="form-group row"> 

            <label for="rice_type" class="col-sm-2 col-form-label">Rice Type:</label>

                <div class="col-sm-4">

                    <select class="form-control required"
                            name="rice_type"
                            id="rice_type" >
                        <option value="">Select</option>
                        <option value="P">Par Bolied</option>
                        <option value="R">Raw Rice</option>

                    </select>    

                </div>

                <label for="tot_pdy_delivrd" class="col-sm-2 col-form-label">Progressive Resultant Rice:</label>

               <div class="col-sm-4">

              <input type="text"
                     class="form-control"
                     name="progressive_res_paddy"
                     id="progressive_res_paddy"  value="" readonly />

                       </div>

            </div>

            <div class="form-group row">

                <label for="milled" class="col-sm-2 col-form-label">Paddy Milled:</label>

                <div class="col-sm-10">

                    <input type="text"
                            class="form-control"
                            name="milled" required
                            id="milled"/>
                </div>

            </div>

            <div class="form-group row">

                

            </div> 

            <div class="form-group row">

                

                <label for="res_cmr" class="col-sm-2 col-form-label">Resultant CMR:</label>

                <div class="col-sm-4">

                    <input type="text"
                        class="form-control"
                        name="res_cmr"
                        id="res_cmr" readonly />

                </div>      


                 <label for="res_cmr" class="col-sm-2 col-form-label">CMR Offered Now:</label>

                <div class="col-sm-4">

                    <input type="text"
                        class="form-control"
                        name="cmr_offered_now"
                        id="cmr_offered_now"  />

                </div>                

            </div>     
            <div class="form-group row">

                                    

                    <label for="res_cmr" class="col-sm-2 col-form-label">Total Progressive CMR OFFERED:</label>

                    <div class="col-sm-4">

                        <input type="text"
                            class="form-control"
                            name="total_progressive_cmr_offered"
                            id="total_progressive_cmr_offered" readonly  value="0.000"/>

                    </div>      


                    <label for="res_cmr" class="col-sm-2 col-form-label">CMR Yet To Be Offered:</label>

                    <div class="col-sm-4">

                        <input type="text"
                            class="form-control"
                            name="cmr_yet_to_offered"
                            id="cmr_yet_to_offered"  readonly/>

                    </div>                

                    </div> 
            

            <div class="form-group row">

                <div class="col-sm-10">

                    <input type="submit" id="submit" class="btn btn-info" value="Save" />

                </div>

            </div>

        </form>

    </div>
    <div class="col-md-5 container form-wraper" style="margin-left: 10px; width: 48%;">
                    
                    <div class="form-header">
                        
                        <h4>Previous&amp;CMR offered</h4>
                    
                    </div>

                    <table class="table table-bordered table-hover">

                        <thead>

                            <tr>
                               
                                <th>Date.</th>
                                <th>Miiled</th>
                                <th>Type(P = Per Boiled,R = Raw Rice)</th>
                                <th>CMR Offered</th>

                            </tr>

                        </thead>

                        <tbody id="entered_data"> 


                                         
                        </tbody>
                        <tfoot>

                            <tr>
                            
                                <th>Date.</th>
                                <th>Miiled</th>
                                <th>Type</th>
                                <th>CMR Offered</th>

                            </tr>
                        
                        </tfoot>

                    </table>

                </div>

</div>

<script>

    $(document).ready(function(){


        $('#milled').keyup(function(){

                var milled=  parseFloat($('#milled').val());

                var tot_pdy_delivrd=parseFloat($('#tot_pdy_delivrd').val());

                console.log(milled,tot_pdy_delivrd);

                if(milled  > tot_pdy_delivrd ){

                    alert("Milled Quantity Cannot Cross Paddy Received");
                    $('#submit').attr('type', 'button');
                    $('#milled').focus(); 
                }

                })


        var i = 0;

        $('#dist').change(function(){

            //For District wise Block
            $.get( 

                '<?php echo site_url("paddy/blocks");?>',

                { 

                    dist: $(this).val()

                }

            ).done(function(data){

                var string = '<option value="">Select</option>';

                $.each(JSON.parse(data), function( index, value ) {

                    string += '<option value="' + value.sl_no + '">' + value.block_name + '</option>'

                });

                $('#block').html(string);

            });
            
            //For District wise Mill
            $.get( 

                '<?php echo site_url("paddy/mills");?>',

                { 

                    dist: $(this).val()

                }

                ).done(function(data){

                var string = '<option value="">Select</option>';

                $.each(JSON.parse(data), function( index, value ) {

                    string += '<option value="' + value.sl_no + '">' + value.mill_name + '</option>'

                });

                $('#mill_name').html(string);

            });

        });

    });

    $("#soc_name").change(function(e){
    
      var soc_id = $(this).val(); // anchors do have text not values.
     
      $.ajax({
        url: '<?php echo base_url();?>index.php/paddys/transactions/f_connected_mill_society',
        data: {'soc_id': soc_id}, // change this to send js object
        type: "post",
        dataType: 'json',
        success: function(data){

           //console.log(data);
           $("#mill_name").find('option').remove();
           $('#mill_name').append(data.html);
          
        }
      });
   });

</script>

<script>

    $(document).ready(function(){

        var i = 0;

        $('#block').change(function(){

            $.get( 

                '<?php echo site_url("paddys/add_new/f_societies");?>',

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

        $('#mill_name').change(function(){

            $.get('<?php echo site_url("paddys/transactions/f_delivered"); ?>',

                {

                    soc_id:  $('#soc_name').val(),

                    mill_id: $(this).val()

                }
            
            )
            .done(function(data){

            	var data = JSON.parse(data);

                var received = parseFloat((data.receved).sum);
                var wr_order = parseFloat((data.wr_order).sums);

                var tot_rcvd = (received - wr_order);

                var tot_rcvd = tot_rcvd.toFixed(3);

                console.log(received,wr_order,tot_rcvd);

                $('#tot_pdy_delivrd').val(tot_rcvd);

                 var userDate = (data.receved).trans_dt;
                 var items = userDate.split('-');
			    
                $('#received_date').val(items["2"] + '/' + items["1"] + '/' + items["0"]);
                
            });

        });

    });

</script>

<script>

    $(document).ready(function(){

        $('#rice_type').change(function(){
            
            //Progressive Paddy Procurement
            $.get('<?php echo site_url("paddys/transactions/f_ricetype"); ?>',

                {

                    type: $(this).val()

                }
            )
            .done(function(data){

                var prog_rslt_rice = (($('#tot_pdy_delivrd').val() * parseInt(data)) / 100);

                var prog_rslt_rice = parseFloat(prog_rslt_rice).toFixed(3);
                
                $('#progressive_res_paddy').val(prog_rslt_rice);

                if(data == '0.00'){

                    $('#submit').attr('type', 'button');

                }
                else{
    
                    $('#submit').attr('type', 'submit');

                }
                
            });

        });

        $('#milled').keyup(function(){
            
            //Progressive Paddy Procurement
            $.get('<?php echo site_url("paddys/transactions/f_ricetype"); ?>',

                {

                    type: $('#rice_type').val()

                }
            )
            .done(function(data){
                
                var resultant_cmr = (($('#milled').val() * parseInt(data)) / 100);

                var resultant_cmr = parseFloat(resultant_cmr).toFixed('3')
   
            $('#res_cmr').val(resultant_cmr);
            
                if(data == '0.00'){

                    $('#submit').attr('type', 'button');

                }
              
                
            });

        });


        $('.offer_type').change(function(){
            
            let total = parseFloat($('#tot_cmr_offered').val());

            $("#tot_cmr_offered").val('');
  
            $('.offer_type').each(function(){
                
                total += + parseFloat(($(this).val())? $(this).val() : 0 );
             //   console.log(total);
            });

            if(total <= $('#res_cmr').val()){

              $("#tot_cmr_offered").val(total);

                $('#submit').attr('type', 'submit');

            }
            else{

                $('#submit').attr('type', 'button');

            }

        });

    });

  </script>
  <script>
	 $(document).ready(function(){

	$('#mill_name').change(function(){

	    //Progressive Paddy Procurement
	    $.get('<?php echo site_url("paddys/transactions/f_added_offered"); ?>',

	        {

	            soc_id:  $('#soc_name').val(),

	            mill_id: $(this).val()

	        }
	    
	    )
	    .done(function(data){

	        var string = '';

	        $.each(JSON.parse(data), function( index, value ) {

	        string += '<tr><td>' + value.trans_dt + '</td><td>' + value.milled + '</td><td>' + value.rice_type + '</td><td>' + value.cmr_offered_now + '</td></tr>'
	                                

	       });

	       $('#entered_data').html(string);
	        
	       });

	     });

	 });



	 $('#cmr_offered_now').keyup(function(){

	     var res_cmr= parseFloat($('#res_cmr').val());
	     var cmr_offered_now= parseFloat($('#cmr_offered_now').val());
	       if(cmr_offered_now  > res_cmr ){

	            alert("Offered CMR cannot be greater than resultant CMR!");
	            $('#submit').attr('type', 'button');
	            $('#cmr_offered_now').focus(); 

	            }else{

	                $('#submit').attr('type', 'submit');
	            }
	       })

	  $(document).ready(function(){

	   $('#cmr_offered_now').keyup(function(){

	    $.get('<?php echo site_url("paddys/transactions/f_added_offered"); ?>',

	        {
	            soc_id:  $('#soc_name').val(),

	            mill_id: $(this).val()

	        }
	    
	    )
	    .done(function(data){

	        var sum = 0;
	        var rum = 0;
	        var gum =  $('#progressive_res_paddy').val();
	        var total = 0;
	       

	        $.each(JSON.parse(data), function( index, value ) {

	            sum +=  parseFloat(value.resultant_cmr) ;
	           
	       });
	      

	         rum = parseFloat($('#cmr_offered_now').val())

	        
	        if(rum != "NULL"){

	            total=gum-(sum + rum);

                total = parseFloat(total).toFixed(3);

                var prog_cmr_off = (sum + rum);

                prog_cmr_off = parseFloat(prog_cmr_off).toFixed(3);

	            $('#total_progressive_cmr_offered').val(prog_cmr_off);
	            $('#cmr_yet_to_offered').val(total);
	           
	        }
	       else{  
	        $('#total_progressive_cmr_offered').val("0.00");    
	       }
	       
	        
	        });

	      });

	    });

      $(document).ready(function(){
        $('#form').on('submit', function(e){

        	var trans_dt = $('#trans_dt').val();
        	var received_date = $('#received_date').val();
     
             var date    =  received_date.split('/');
			   
			 var newDate = date["2"]+ '-' + date["1"] + '-' + date["0"];
        	
           
            var progressive = $('#tot_pdy_delivrd').val();
            if (progressive > 1) {

                //if(new Date(newDate) <= new Date(trans_dt))
				// {
				return true;
			//	}
			//	else{
                //   e.preventDefault();
                //   alert("Transaction Date Can Not Be Lesser Than Received Date");
              //	}

              }else{
                 e.preventDefault();
                  alert("Please Check Progressive Paddy");
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