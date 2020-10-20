    <div class="wraper">      

        <div class="col-md-6 container form-wraper">

            <form method="POST" 
                id="form"
                action="<?php echo site_url("paddys/add_new/f_soc_mill_add");?>" >

                <div class="form-header">
                
                    <h4>Society Mill Addition</h4>
                
                </div>

                <div class="form-group row">

                    <label for="dist" class="col-sm-4 col-form-label">Society Name:</label>

                    <div class="col-sm-8">

                        <select name="soc_id" class="form-control required" id="soc_id">

                            <option value="">Select</option>

                            <?php

                                foreach($society as $societ){

                            ?>

                                <option value="<?php echo $societ->sl_no;?>"><?php echo $societ->soc_name;?></option>

                            <?php

                                }

                            ?>     

                        </select>

                    </div>

                </div> 
                <div class="form-group row">

                          <label for="dist" class="col-sm-4 col-form-label">Mill Name:</label>

                           <div class="col-sm-8">

                            <select name="mill_id" class="form-control required">

                            <option value="">Select</option>

                           <?php

                             foreach($mills as $mill){

                            ?>
                         <option value="<?php echo $mill->sl_no;?>"><?php echo $mill->mill_name;?></option>
                           <?php

                                 }

                                    ?>     

                                    </select>

                      </div>

                          </div> 
                  
 
                <div class="form-group row">

                    <label for="name" class="col-sm-4 col-form-label">Distance(K.M):</label>

                    <div class="col-sm-8">

                        <input type="text" class="form-control" name="distance" id="name" />

                    </div>

                </div>  
                <div class="form-group row">

                       <label for="name" class="col-sm-4 col-form-label">Tripartite Agreement Number:</label>

                       <div class="col-sm-8">

                                <input type="text" class="form-control" name="reg_no" id="reg_no" />

                        </div>
                </div>  
                <div class="form-group row">

                       <label for="name" class="col-sm-4 col-form-label">Target(Quintal):</label>

                       <div class="col-sm-4">

                                <input type="text" class="form-control" name="target" id="target" />

                        </div>
                        <div class="col-sm-3">

                   <input type="text" class="form-control" name="mt_tone" id="mt_tone"  value="0.00" readonly />
                                                  </div> MT
                  </div> 

                <div class="form-group row">

                    <div class="col-sm-10">

                        <input type="submit" class="btn btn-info" value="Save" />

                    </div>

                </div>

            </form>

        </div>

    </div>

<script>

   // $("#form").validate();

</script>

<script>


$("#soc_id").change(function(e){
   
     var soc_id = $("#soc_id").val(); // anchors do have text not values.

      console.log(soc_id);
      $.ajax({
        url: '<?php echo base_url();?>index.php/paddys/add_new/f_get_agreement',
        data: {'soc_id': soc_id}, // change this to send js object
        type: "post",
        dataType: 'json',
        success: function(data){
           
       
            var target=data.target;
           
          $('#reg_no').val(target);
      
       
        }
      });
   });

    $(document).ready(function(){

        $('#emp_no').change(function(){

            $('#category').val($(this).find(':selected').attr('catg'));

        });

    });

    
 // Code for converting Quintal to Matric tone.

   $("#target").keyup(function(e){
     // e.preventDefault();  // stops the jump when an anchor clicked.
     var target = $("#target").val(); 
     
          mt_format=parseFloat(target*0.1);

          console.log(mt_format);
           
          $('#mt_tone').val(mt_format.toFixed(5));
        
       });
 // end of doc ready 
</script>