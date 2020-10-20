    <div class="wraper">      

        <div class="col-md-6 container form-wraper">

            <form method="POST" id="form"
                action="<?php echo site_url("add_new/soccom/add");?>">

                <div class="form-header">
                
                    <h4>Society Commission  Entry</h4>
                    <span class="confirm-div" style="float:right; color:green;"></span>
                </div>

                <div class="form-group row">
               
               <label for="name" class="col-sm-2 col-form-label">Effective Date:</label>

               <div class="col-sm-4">
                   <input type="date"  class="form-control" name="effective_dt" id="effective_dt" required/>

               </div>

               <label for="name" class="col-sm-2 col-form-label">Rice Type Date:</label>

               <div class="col-sm-4">

                   <select name="rice_type" class="form-control" required>
                                <option value="">Select</option>
                                <option value="P">Boiled Rice</option>
                                <option value="R">Raw Rice</option>
                     </select>
                 </div>
              
                </div>

                <div class="form-group row">
                
                    <label for="name" class="col-sm-2 col-form-label">Commission Rate:</label>
                    
                    <div class="col-sm-8"><input type="text" class="form-control" name="rate" id="rate"/></div>

                    <label for="name" class="col-sm-2 col-form-label">Per Quintal</label>

                </div> 

                <div class="form-group row">

                    <div class="col-sm-10">

                        <input type="submit" class="btn btn-info" value="Save"/>

                    </div>

                </div>

            </form>

        </div>

    </div>

<script>

    $("#form").validate();

</script>

<script>

    $(document).ready(function(){

        $('#emp_no').change(function(){

            $('#category').val($(this).find(':selected').attr('catg'));

        });

    });
    
</script>
<script>
   
   $(document).ready(function() {

   $('.confirm-div').hide();

   <?php if($this->session->flashdata('msg')){ ?>

   $('.confirm-div').html('<?php echo $this->session->flashdata('msg'); ?>').show();

   });

   <?php } ?>
</script>