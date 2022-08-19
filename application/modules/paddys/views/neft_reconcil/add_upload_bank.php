    <div class="wraper">      

        <div class="col-md-6 container form-wraper">

            <form method="POST" 
                id="form" enctype="multipart/form-data"
                action="<?php echo site_url("paddys/bank/f_neft_upload");?>" >

                <div class="form-header">
                    <h4>NEFT Upload</h4>
                </div>
                    <div class="form-group row"> 
                 <span class="confirm-div" style="float:right; color:green;"></span>
             </div>

                <div class="form-group row"> 

                     <label for="f_payment_cheque" class="col-sm-3 col-form-label">Value Date:</label>
              <div class="col-sm-9">
                   <input type="date" name="value_date" class="form-control">
             </div>
                  </div>
     <div class="form-group row"> 
                <label for="f_payment_cheque" class="col-sm-3 col-form-label">Neft Detail:</label>

                <div class="col-sm-9">

                    <input type="file" name="f_neft_detail" class="form-control">

                </div>

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

    $("#form").validate();

</script>

<script>

    $("#form").validate();

    $( ".sch_cd" ).select2();

</script>
<script>
   
    $(document).ready(function() {

    $('.confirm-div').hide();

    <?php if($this->session->flashdata('msg')){ ?>

    $('.confirm-div').html('<?php echo $this->session->flashdata('msg'); ?>').show();

    });

    <?php } ?>
</script>
