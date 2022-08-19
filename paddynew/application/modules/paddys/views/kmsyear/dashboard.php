    <div class="wraper">      
        
        <div class="row">
            
            <div class="col-lg-9 col-sm-12">

                <h1><strong>KMS Year</strong></h1>

            </div>

        </div>

        <div class="col-lg-6 container contant-wraper">    
            
            <h3>

                <span class="confirm-div" style="float:right; color:green;"></span>

            </h3>
            
            <table class="table table-bordered table-hover">

                <thead>

                    <tr>
                    
                        <th>KMS Year</th>
                        <th>Option</th>

                    </tr>

                </thead>

                <tbody> 

                    <tr>

                        <td><?php echo $kms; ?></td>
                        <td>
                        
                            <a href="kmsyear/edit" 
                                data-toggle="tooltip"
                                data-placement="bottom" 
                                title="Edit"
                            >

                                <i class="fa fa-edit fa-2x" style="color: #007bff"></i>
                                
                            </a>
                            
                        </td>

                    </tr>     
                    
                </tbody>

                <tfoot>

                    <tr>
                    
                        <th>KMS Year</th>
                        <th>Option</th>

                    </tr>
                
                </tfoot>

            </table>
            
        </div>

    </div>

<script>

    $(document).ready( function (){

        $('.delete').click(function () {

            var id = $(this).attr('id');

            var result = confirm("Do you really want to delete this record?");

            if(result) {

                window.location = "<?php echo site_url('paddy/workorder/delete?sl_no="+id+"');?>";

            }
            
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
