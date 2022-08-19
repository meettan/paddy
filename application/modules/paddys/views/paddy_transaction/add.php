    <div class="wraper">      
    <div class="col-md-3 container">
    </div>
        <div class="col-md-6 container form-wraper">

            <form method="POST" enctype="multipart/form-data" id="form" 
                action="<?php echo site_url("paddys/add_new/f_fartrans_upload");?>" >

                <div class="form-header">
                
                    <h4>Procured Entry</h4>
                
                </div>
                <div class="form-group row">

                <label for="f_paddy_transaction" class="col-sm-3 col-form-label">Transaction Detail:</label>

                <div class="col-sm-9">

                    <input type="file" name="f_paddy_transaction" class="form-control">

                </div>

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

    $( ".sch_cd" ).select2();

</script>

<script>

$(document).ready(function(){

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

        function calFunc() {

            var do_isseue   = $('#do_isseue').val(),
                cmr_dlvrd   = $('#cmr_delivered').val(),
                resultant   = $('#resultant_cmr').val();

            $('#delivery_yet').val(do_isseue - cmr_dlvrd); 

            $('#delivery_due').val(resultant - cmr_dlvrd); 

        }

        $('#cmr_delivered').change(function(){

             calFunc();

        });

        $('#do_isseue').change(function(){

            calFunc();

        });

    });

</script>