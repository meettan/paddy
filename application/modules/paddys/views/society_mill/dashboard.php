    <div class="wraper">      
        
        <div class="row">
            
            <div class="col-lg-9 col-sm-12">

                <h1><strong>Society Mills Tagging</strong></h1>

            </div>

        </div>

        <div class="col-lg-12 container contant-wraper">    

            <h3>
                <small><a href="<?php echo site_url("paddys/add_new/f_soc_mill_add");?>" class="btn btn-primary" style="width: 100px;">Add</a></small>
                <span class="confirm-div" style="float:right; color:green;"></span>

                <div class="input-group" style="margin-left:75%;">
                    <span class="input-group-addon"><i class="fa fa-search"></i></span>
                    <input type="text" class="form-control" placeholder="Search..." id="search" style="z-index: 0;">
                </div>
                
            </h3>

            <table class="table table-bordered table-hover">

                <thead>

                    <tr>
                    
                        <th>Sl. No.</th>
                        <th>Society</th>
                        <th>Mills</th>
                        <!-- <th>Agreement No.</th> -->
                        <th>Target(Quintal)</th>
                        <th>Created By</th>
                        <th>Modified By</th>
                        <th>Option</th>

                    </tr>

                </thead>

                <tbody> 

                    <?php 
                    
                   if($soc_mill_dtls) {
                              $count=0;
                    foreach($soc_mill_dtls as $soc_mill_dtl) {
                        
                    ?>
                            <tr>
                                <td ><?php echo ++$count; ?></td>
                                <td ><?php echo $soc_mill_dtl->soc_name; ?></td>
                                <td><?php echo $soc_mill_dtl->mill_name; ?></td>
                             <!--    <td><?php //echo $soc_mill_dtl->agreementno; ?></td> -->
                                <td><?php echo $soc_mill_dtl->target; ?></td>
                                <td><?php echo $soc_mill_dtl->created_by; ?></td>
                                <td><?php echo $soc_mill_dtl->modified_by; ?></td>
                                <td>
                                    <a href="<?php echo site_url("paddys/add_new/f_society_mill_edit")?>/?branch_id=<?php echo $soc_mill_dtl->branch_id;?>&soc_id=<?php echo $soc_mill_dtl->soc_id;?>&mill_id=<?php echo $soc_mill_dtl->mill_id;?>&kms_id=<?php echo $soc_mill_dtl->kms_id;?>" 
                                        data-toggle="tooltip"  data-placement="bottom"  title="Edit">
                                                        <i class="fa fa-edit fa-2x" style="color: #007bff"></i>
                                                    </a>
                                                </td>
                                            </tr>                    
                    <?php }   } else{

                             echo "Data Not Found";
                    } 
                    ?>
                
                </tbody>
                <tfoot>
                    <tr>
                        <th>Sl. No.</th>
                        <th>Society</th>
                        <th>Mills</th>
                       <!--  <th>Agreement No.</th> -->
                        <th>Target(Quintal)</th>
                        <th>Created By</th>
                        <th>Modified By</th>
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

                window.location = "<?php echo site_url('paddy/block/delete?sl_no="+id+"');?>";

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
