    <div class="wraper">      
        
        <div class="row">
            
            <div class="col-lg-9 col-sm-12">

                <h1><strong>NEFT Reconciliation</strong></h1>

            </div>

        </div>

        <div class="col-lg-12 container contant-wraper">    

            <h3>

              <!--  <small><a href="<?php //echo site_url("paddys/add_new/f_block_add");?>" class="btn btn-primary" style="width: 100px;">Add</a></small> -->
                <small><a href="<?php echo site_url("paddys/transactions/f_neft_upload");?>" class="btn btn-primary" style="width: 100px;">Upload</a></small>
                <span class="confirm-div" style="float:right; color:green;"></span>
                
            </h3>

        <!--  <table class="table table-bordered table-hover">

                <thead>

                    <tr>
                    
                        <th>Sl. No.</th>
                        <th>District Name</th>
                        <th>Total Cheque </th>
                       

                    </tr>

                </thead>

                <tbody> 

                    <?php 
                    
                    if($dist) {

                        $i = 1;

                        foreach($dist as $dis) {

                            


                    ?>

                           <tr>

                                <td><?php echo $i++; ?></td>
                                <td><?php echo $dis->district_name; ?></td>
                                <td><?php
                                              foreach($cheque_status as $cheque_statu){
 
                                 if($dis->district_code == $cheque_statu->dist_id ){

                                           echo $cheque_statu->trans;

                                }

                            }

                            ?></td>

                   <?php     
                        }   }   

                    else {

                        echo "<tr><td colspan='10' style='text-align: center;'>No data Found</td>";

                    }

                    ?>
                    </tr>
                </tbody>

                <tfoot>

                    <tr>
                    
                        <th>Sl. No.</th>
                        <th>District Name</th>
                        <th>Total Cheque</th>
                       
                    </tr>
                
                </tfoot>

            </table>  -->
            
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
