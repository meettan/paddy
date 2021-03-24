    <div class="wraper">      
        
        <div class="row">
            
            <div class="col-lg-9 col-sm-12">

                <h1><strong>Rice Rate</strong></h1>

            </div>

        </div>

        <div class="col-lg-12 container contant-wraper">    

            <h3>

                <small><a href="<?php echo site_url("paddys/add_new/ricerate_add");?>" class="btn btn-primary" style="width: 100px;">Add</a></small>
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
                        <th>Rice Type</th>
                        <th>Rate/Quintal(Gunny Rate)</th>
                        <th>Rate/Quintal(HDPE/PP Rate)</th>
                        <th>Effected Date</th>
                        <th>Created Date</th>
                        <th>Option</th>

                    </tr>

                </thead>

                <tbody> 

                    <?php 
                    
                    if($ricerate_dtls) {

                        $i = 1;

                        foreach($ricerate_dtls as $ricerate_dtl) {
                        
                    ?>
                            <tr>
                                <td ><?php echo $i++; ?></td>
                                <td ><?php echo $ricerate_dtl->rice_type; ?></td>
                                <td ><?php echo $ricerate_dtl->rate; ?></td>
                                <td ><?php echo $ricerate_dtl->ppe_rate; ?></td>
                                <td ><?php echo date('d/m/Y',strtotime($ricerate_dtl->effective_dt)); ?></td>
                                <td ><?php echo date('d/m/Y',strtotime($ricerate_dtl->created_dt)); ?></td>
                                <td > 
                                <a href="<?php echo site_url("paddys/add_new/ricerate_edit");?>?id=<?php echo $ricerate_dtl->id; ?>" 
                                    data-toggle="tooltip"
                                    data-placement="bottom"  title="Edit">

                                    <i class="fa fa-edit fa-2x" style="color: #007bff"></i>
                                    
                                </a>
                                </td>
                    <?php     
                               }
                          }

                    else {

                        echo "<tr><td colspan='10' style='text-align: center;'>No data Found</td>";

                    }

                    ?>
                    </tr>
                </tbody>

                <tfoot>

                    <tr>
                    
                        <th>Sl. No.</th>
                        <th>Rice Type</th>
                        <th>Rate/Quintal(Gunny Rate)</th>
                        <th>Rate/Quintal(PPE Rate)</th>
                        <th>Effected Date</th>
                        <th>Created Date</th>
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
