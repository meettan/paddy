    <div class="wraper">      

        <div class="col-md-9 container form-wraper">

            <form method="POST" 
                id="form"  action="<?php echo site_url("paddys/transactions/f_received_add");?>" >

                <div class="form-header">
                
                    <h4>Received Entry</h4>
                
                </div>

                <div class="form-group row">
                   

                    <label for="block" class="col-sm-2 col-form-label">Block:</label>

                    <div class="col-sm-5">

                        <select name="block" id="block_id" class="form-control " required>

                            <option value="">Select</option>    
                           <?php  foreach($blocks as $block) {  ?>
                            <option value="<?php if(isset($block->sl_no)){ echo $block->sl_no;}?>"><?php if(isset($block->block_name)){ echo $block->block_name;}?></option>    
                           <?php } ?>
                        </select>
                    </div>

                    <label for="trans_dt" class="col-sm-2 col-form-label">Received Date:</label>

                   <div class="col-sm-3">

                     <input type="date" class="form-control" name="trans_dt" required
                                id="trans_dt"
                                value="<?php echo date('Y-m-d');?>"/>
                    </div>

                </div>

                <div class="form-group row">

                    <label for="soc_name" class="col-sm-2 col-form-label">Society Name:</label>

                    <div class="col-sm-5">

                        <select type="text"
                            class="form-control  sch_cd" required
                            name="soc_name"
                            id="soc_name">

                            <option value="">Select Block First</option>    

                        </select>    

                    </div>

                    <label for="soc_name" class="col-sm-2 col-form-label">Progressive Paddy Received:</label>
                    <div class="col-sm-3">

                        <input type="text"
                            class="form-control" name="progressive" required
                            id="progressive"
                            readonly />

                        </div> 
                </div>  

                <div class="form-group row">

                    <label for="mill_name" class="col-sm-2 col-form-label">Mill Name:</label>

                    <div class="col-sm-5">

                        <select type="text"
                            class="form-control  sch_cd" required
                            name="mill_name"
                            id="mill_id">
                            <option value="">Select</option>    
                        </select>
                    </div>

                     <label for="trans_dt" class="col-sm-2 col-form-label">Procured Date:</label>

                        <div class="col-sm-3">
                            <input type="text" class="form-control" id="proc_date" readonly />
                        </div>                

                </div>  

                <div class="form-group row">

                    <label for="paddy_qty" class="col-sm-2 col-form-label">Paddy Received:</label>

                    <div class="col-sm-3">

                        <input type="text" class="form-control" name="paddy_qty"  id="paddy_qty" required  min="0" />

                    </div>
                    <label for="trans_dt" class="col-sm-2 col-form-label"></label>
                    <label for="trans_dt" class="col-sm-2 col-form-label">Already Received:</label>

                        <div class="col-sm-3">
                            <input type="text" class="form-control" id="already_delivered" readonly />
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

    // $("#form").validate();

$('#block_id').change(function(){

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

</script>


<script>

$("#soc_name").change(function(e){
    
      var soc_id = $(this).val(); // anchors do have text not values.
   
      $.ajax({
        url: '<?php echo base_url();?>index.php/paddys/transactions/f_connected_mill_society',
        data: {'soc_id': soc_id}, // change this to send js object
        type: "post",
        dataType: 'json',
        success: function(data){
            
          $("#mill_id").find('option').remove().end().append(data.html);
           //$('#mill_id').append(data.html);
          
        }
      });
   });

</script>

<script>

    $(document).ready(function(){

        $('#soc_name').change(function(){
            
            //Progressive Paddy Procurement
            $.get('<?php echo site_url("paddys/transactions/f_progressive"); ?>',

                {
                    soc_id: $(this).val()
                }
            
            )
            .done(function(data){
                
                $('#progressive').val(parseFloat(data));

                if(data == '0.000'){

                    $('#submit').attr('type', 'button');

                }
                else{
    
                    $('#submit').attr('type', 'submit');

                }
                
            });

        });
        $('#mill_id').change(function(){
            //Progressive Paddy Procurement
            $.get('<?php echo site_url("paddys/transactions/f_alreadyDelivered"); ?>',

                {
                    mill_id: $("#mill_id").val(),

                    soc_id: $("#soc_name").val()
                   
                }

            )
            .done(function(data){

            var result = JSON.parse(data);
                        
              
                $('#already_delivered').val(result.sum);

              
                
                if(parseFloat(data) > parseFloat($('#progressive').val())){
                    
                    $('#submit').attr('type', 'button');

                }
                else{

                    $('#submit').attr('type', 'submit');

                }

            });

        });

          $('#mill_id').change(function(){
            //Progressive Paddy Procurement
            $.get('<?php echo site_url("paddys/transactions/f_proc_date"); ?>',

                {
                    mill_id: $("#mill_id").val(),

                    soc_id: $("#soc_name").val()
                   
                }

            )
            .done(function(data){

            var result = JSON.parse(data);
                     
                  var data = (result.trans_dt).split('-');
                $('#proc_date').val(data["2"]+ '/' + data["1"]+'/'+data["0"]);

              
                
                // if(parseFloat(data) > parseFloat($('#progressive').val())){
                    
                //     $('#submit').attr('type', 'button');

                // }
                // else{

                //     $('#submit').attr('type', 'submit');

                // }

            });

        });

        $('#paddy_qty').change(function(){
            
            if((parseFloat($(this).val()) + parseFloat($('#already_delivered').val())) > parseFloat($('#progressive').val())){

                alert("Paddy Quantity Cannot Be Greater Than Quantity Received By Society.");
                $('#submit').attr('type', 'button');

               }
                else{
                $('#submit').attr('type', 'submit');
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
          alert("Recieve  Date Can Not Be Greater Than Current Date");
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

                      alert("Recieve  Date Can Not Be Greater Than Current Date");
                      event.preventDefault();
                    }
                     else 
                        {
                    //  alert("Transaction Date Can Not Be Less Than order Date");

                       $('#submit').attr('type', 'submit');
                       
                      }
            });

 $('#form').submit(function(event){
           
                 var trans_dt = $('#trans_dt').val();

                 var date = ($('#proc_date').val()).split('/');

                  //var order_daten  =  order_date.split('/');
         
            var order_date = date["2"]+ '-' + date["1"] + '-' + date["0"];
            
           // console.log(trans_dt);
            
        //    console.log(order_date);
                 
        
                     if(new Date(trans_dt) < new Date(order_date)){

                         alert("Recieve Date Can Not Be Less Than Procured Date");
                                      
                         event.preventDefault();
                    }
                     else 
                        {

                       $('#submit').attr('type', 'submit');
                       
                       // event.preventDefault();
                      }

            });

</script>