    <div class="wraper">      

        <div class="col-md-7 container form-wraper">

            <form method="POST" 
                id="form"
                action="<?php echo site_url("paddys/add_new/f_fs_guidelines_add");?>" >

                <div class="form-header">
                
                    <h4>Fs Guidelines Entry</h4>
                
                </div>

                <div class="form-group row">

                        <label for="date" class="col-sm-2 col-form-label">Effective Date:</label>

                        <div class="col-sm-4">

                            <input type="date" name="effective_date" id="effective_date" class="form-control"  
                            value="<?php echo date('Y-m-d');?>" required/>

                        </div>

                </div>

                <div class="form-group row">

                    <label for="dist" class="col-sm-2 col-form-label">Guidelines:</label>

                    <div class="col-sm-10">

                        <input name="guide_lines" id="guide_lines" class="form-control" required/>

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
