    <div class="wraper">      
        
        <div class="row">
            
            <div class="col-lg-9 col-sm-12">

                <h1><strong>Registered Farmers </strong></h1>

            </div>

        </div>

        <div class="col-lg-12 container contant-wraper">    
            <h3>
               <!--  <small><a href="<?php //echo site_url("paddys/add_new/f_farmreg_add");?>" class="btn btn-primary" style="width: 100px;">Add</a></small> -->
              <!--   <small><a href="<?php //echo site_url("paddys/add_new/f_farmreg_update");?>" class="btn btn-primary" style="width: 100px;">Update</a></small> -->
              <!--   <small><a href="<?php //echo site_url("paddys/add_new/f_farmreg_upload");?>" class="btn btn-primary" style="width: 100px;">Upload Data</a></small> -->
                <small><a href="<?php echo site_url("paddys/add_new/f_farmersearch");?>" class="btn btn-primary" style="width: 100px;">Get Farmer</a></small>
                <span class="confirm-div" style="float:right; color:green;"></span>
                
                <div class="input-group" style="margin-left:75%;">
                    <span class="input-group-addon"><i class="fa fa-search"></i></span>
                    <input type="text" class="form-control" placeholder="Search..." id="search" style="z-index: 0;">
                </div>
            </h3>
           <?php  if($farmerreg_dtls && $this->session->userdata['loggedin']['ho_flag']=="N") { ?>
            <table class="table table-bordered table-hover">

                <thead>

                    <tr>
                    
                        <th>Sl. No.</th>
                        <th>Society</th>
                        <th>No of Farmers</th>
                        <th>Option</th>

                    </tr>

                </thead>

                <tbody> 

                    <?php 
                  
                   

                        $i = 1;

                        foreach($farmerreg_dtls as $blk_count) {

                    ?>

                            <tr>

                                <td ><?php echo $i++; ?></td>
                                <td ><?php echo $blk_count->soc_name; ?></td>
                                <td ><?php echo $blk_count->cnt; ?></td>
                                
                                <td style="text-align: center;"><button class="btn btn-primary view" id="<?php echo $blk_count->soc_id; ?>"><i class="fa fa-eye"></i></button></td>         
                               
                            </td>
                                <?php

                        } ?>

                         </tbody>

                <tfoot>

                    <tr>
                    
                        <th>Sl. No.</th>
                        <th>Society</th>
                        <th>No of Farmer</th>
                        <th>Option</th>

                    </tr>
                
                </tfoot>

            </table>

                <?php     }

                    elseif($this->session->userdata['loggedin']['ho_flag']=="Y") {  ?>


                         <table class="table table-bordered table-hover">

                <thead>

                    <tr>
                    
                        <th>Sl. No.</th>
                        <th>District Name</th>
                        <th>No of Farmers</th>
                     

                    </tr>

                </thead>

                <tbody> 

                       

                <?php    
                  $j = 1;    
                 foreach($dist as $dis) { 
                            ?>
                      <tr>
                         <td> <?php echo $j++; ?></td>
                                <td ><?php echo $dis->district_name; ?></td>


                                <td ><?php 
                                      foreach($tot_rows as $tot_row){
                                           if($dis->district_code == $tot_row->branch_id)

                                          echo $tot_row->cnt;
                                      }
                                    ?>
                                 </td>
                                
                                      
                               
                            </td>
                        </tr>

                  <?php       }


                  ?>
                      <tr><td colspan='2' style='text-align: center;color: green;'>Total </td>
                          <td><?=$tot_rowss->cnt?></td>
                      </tr>
                          

                         </tbody>

              

            </table>

              

             <?php   
                 }
                    else{

                        echo "<tr><td colspan='10' style='text-align: center;'>No data Found</td></tr>";

                    }

                    ?>
                
               
            
        </div>


        <div class="modal fade" id="viewModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
            <div class="modal-dialog modal-lg" style="width: 980px;" role="document">
                <div class="modal-content">
                    <div class="modal-header">
                        <u> <h4 id="soc_name" style="text-align:center"></h4></u>
                        <button class="close" type="button" data-dismiss="modal" aria-label="Close">
                            <span aria-hidden="true">×</span>
                        </button>
                    </div>
                    <div class="modal-body" id="doc-view">
                    
                    </div>
                </div>
            </div>
        </div>
            

    </div>

<script>

    $(document).ready( function (){

        $('.delete').click(function () {

            var id = $(this).attr('id');

            var result = confirm("Do you really want to delete this record?");

            if(result) {

                window.location = "<?php echo site_url('paddy/farmerreg/delete?sl_no="+id+"');?>";

            }
            
        });

    });

</script>

<script>
$(document).ready(function() {

    $('.view').click(function(){
        
        $.get('<?php echo site_url("paddys/add_new/f_getFarmerDetails"); ?>',
            {
                soc_id: $(this).attr('id')
            }
        )

        .done(function(data){
            $('#doc-view').html(data);
            $('#viewModal').modal('show');
        });
    })

});

      
</script>

<script>
   
   $(document).ready(function() {

   $('.confirm-div').hide();

       <?php if($this->session->flashdata('msg')){ ?>

           $('.confirm-div').html('<?php echo $this->session->flashdata('msg'); ?>').show();

       <?php } ?>

   });

   
</script>
