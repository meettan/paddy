    <div class="wraper">      

        <div class="col-md-6 container form-wraper">

            <form method="POST" 
                id="form" enctype="multipart/form-data"
                action="<?php echo site_url("paddys/transactions/f_cheque_upload");?>" >

                <div class="form-header">
                    <h4>Cheque Upload</h4>
                </div>

                <div class="form-group row"> 

                     <label for="f_payment_cheque" class="col-sm-2 col-form-label">District:</label>
              <div class="col-sm-10">
                    <select name="dist_id" id="dist" class="form-control" required>
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
                <label for="f_payment_cheque" class="col-sm-2 col-form-label">Cheque Detail:</label>

                <div class="col-sm-10">

                    <input type="file" name="f_cheque_detail" class="form-control">

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
