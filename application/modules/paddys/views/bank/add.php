    <div class="wraper">      

        <div class="col-md-6 container form-wraper">

            <form method="POST" 
                id="form"
                action="<?php echo site_url("paddys/add_new/f_bank_add");?>">

                <div class="form-header">
                
                    <h4>Bank Entry</h4>
                    <span class="confirm-div" style="float:right; color:green;"></span>
                </div>
                <div class="form-group row">
               
                    <label for="bank" class="col-sm-2 col-form-label">Bank:</label>

                    <div class="col-sm-9">

                        <select name="bnk" id="bnk" class="form-control required" required>
                            <option value="">Select</option>  
                            <option value="1">Yes Bank</option>
                            <option value="2">Bandhan Bank</option>
                            <option value="3">ICICI Bank</option>
                            <option value="4">Axis Bank</option> 
                            <option value="5">Hdfc Bank</option>       
                        </select>
                    </div>
                </div>


                <div class="form-group row">

                    <label for="brn" class="col-sm-2 col-form-label">Branch:</label>

                    <div class="col-sm-9">

                        <input name="brn" id="brn" class="form-control"/>

                    </div>

                </div>

                <div class="form-group row">

                    <label for="ifs" class="col-sm-2 col-form-label">IFS Code:</label>

                    <div class="col-sm-9">

                        <input name="ifs" id="ifs" class="form-control"/>

                    </div>

                </div>

                <div class="form-group row">

                    <label for="acc_no" class="col-sm-2 col-form-label">Account No.:</label>

                    <div class="col-sm-4">

                        <input name="acc_no" id="acc_no" class="form-control" required/>

                    </div>

                    <label for="srt_cd" class="col-sm-1 col-form-label">Short Code:</label>

                    <div class="col-sm-4">

                        <input name="srt_cd" id="srt_cd" class="form-control"/>

                    </div>

                </div>

                <div class="form-group row">

                    <label for="micr" class="col-sm-2 col-form-label">MICR Code.:</label>

                    <div class="col-sm-4">

                        <input name="micr" id="micr" class="form-control"/>

                    </div>

                    <label for="trans_cd" class="col-sm-1 col-form-label">Trans Code:</label>

                    <div class="col-sm-4">

                        <input name="trans_cd" id="trans_cd" class="form-control"/>

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
   
   $(document).ready(function() {

   $('.confirm-div').hide();

   <?php if($this->session->flashdata('msg')){ ?>

   $('.confirm-div').html('<?php echo $this->session->flashdata('msg'); ?>').show();

   });

   <?php } ?>


    $("#form").validate();

</script>

<script>

    $("#form").validate();

    $( ".sch_cd" ).select2();

</script>

<script>

$(document).ready(function(){

    var i = 0;

    $('#dist').change(function(){

        //For District wise District
        $.get( 

            '<?php echo site_url("paddy/districts");?>',

            { 

                dist: $(this).val()

            }

        ).done(function(data){

            var string = '<option value="">Select</option>';

            $.each(JSON.parse(data), function( index, value ) {

                string += '<option value="' + value.sl_no + '">' + value.district_name + '</option>'

            });

            $('#district').html(string);

          });

    });

});
</script>

<script>

    $(document).ready(function(){

        var i = 0;

        $('#district').change(function(){

            $.get( 

                '<?php echo site_url("paddy/societies");?>',

                { 

                    district: $(this).val()

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

        $('#soc_name').change(function(){

            $.get( 

            '<?php echo site_url("paddy/socmills");?>',

            { 

                soc_id: $(this).val()

            }

            ).done(function(data){

                var string = '';

                $.each(JSON.parse(data), function( index, value ) {

                string += value.mill_name + ', ';

            });

                $('#mill_name').html(string);

            });

        });

    });

</script>
