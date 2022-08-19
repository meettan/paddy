    <div class="wraper">      

        <div class="col-md-6 container form-wraper">

            <form method="POST" 
                id="form"
                action="<?php echo site_url("paddys/add_new/f_district_add");?>">

                <div class="form-header">
                
                    <h4>District Entry</h4>
                    <span class="confirm-div" style="float:right; color:green;"></span>
                </div>
                <div class="form-group row">

                <label for="dist" class="col-sm-3 col-form-label">District Code:</label>

                <div class="col-sm-9">

                    <input name="district_code" id="district_code" class="form-control required"/>

                </div>

                </div>

                <div class="form-group row">

                    <label for="dist" class="col-sm-3 col-form-label">District Name:</label>

                    <div class="col-sm-9">

                        <input name="dist" id="dist" class="form-control required" />

                    </div>

                </div>
                <div class="form-group row">

                    <label for="dist" class="col-sm-3 col-form-label">District Short Code:</label>

                    <div class="col-sm-9">

                        <input name="dist_sort_code" id="dist_sort_code" class="form-control required"/>

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
