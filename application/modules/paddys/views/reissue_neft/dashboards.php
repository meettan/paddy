<div class="wraper">     
        <div class="row">            
            <div class="col-lg-9 col-sm-12">
                <h1><strong>Returned NEFT</strong></h1>

            </div>
        </div>

        <div class="col-lg-12 container contant-wraper">    
            <h3 style="margin-bottom:30px">

               <!--  <small><a href="<?php echo site_url("paddys/transactions/f_paddycollection_add");?>" class="btn btn-primary" style="width: 100px;">Add</a></small>
                 <small><a href="<?php echo site_url("paddys/transactions/f_paddycollupload");?>" class="btn btn-primary" style="width: 100px;">Upload</a></small> -->
                <span class="confirm-div" style="float:right; color:green;"></span>
             
            </h3>

            <table class="table table-bordered table-hover" id="myTable">
                <thead>
                    <tr>
                        <th width="25px">Sl. No</th>
                        <th>Society</th>
                        <th>File Name</th>
                        <th>Procurement Dt</th>        
                        <th>Quantity</th>
                        <th width="50px">Amount</th>
                        <th>Option</th> 
                        <th>Status</th>  
                        <th>Forwarded By</th> 
                        <th>Updated By/Dt</th> 
                        <th>Forward</th>
                    </tr>
                </thead>
                <tbody> 

                <?php 
                   if(isset($paddycollection_dtls)){

                   $count=0;
                   foreach($paddycollection_dtls as $padl_dtl){

                       ?>
                        <tr>

                          <td ><?php echo ++$count; ?></td>
                            <td ><?php echo get_society_name($padl_dtl->soc_id); ?></td>
                            <td ><?php echo $padl_dtl->forward_bulk_trans_id; ?> 
                            <!-- <?php  if($padl_dtl->bank_id == 1){
                                               echo "Yes Bank"; 
                                         }elseif($padl_dtl->bank_id == 2){
                                               echo "Bandhan Bank";  
                                         }elseif($padl_dtl->bank_id == 3){
                                               echo "Icici Bank";  
                                         }
                                     elseif($padl_dtl->bank_id == 4){
                                               echo "Axis Bank";  
                                         }
                                         else {
                                            echo "Hdfc Bank";  
                                         } 
                                 ?> -->
                            </td>
                            <td ><?php echo date('d/m/Y',strtotime($padl_dtl->trans_dt)); ?></td>
                            <td ><?php echo $padl_dtl->tot_qty; ?></td>
                            <td ><?php echo $padl_dtl->tot_amt; ?></td>
                            <td style="text-align: ;">
                     
                        <a href="<?php echo base_url()?>index.php/paddys/transactions/reissue_nefts?soc_id=<?=$padl_dtl->soc_id;?>/<?=$padl_dtl->trans_dt;?>/<?=$padl_dtl->bulk_trans_id;?>" data-toggle="tooltip"
                                    data-placement="bottom"  title="Edit">
                                    <i class="fa fa-edit fa-2x" style="color: #007bff"></i>
                                </a>
                     </td>
                     <td><?php if( $padl_dtl->chq_status == 'R'){

                                  echo '<span style="color:#f11421">Returned</span>';

                                }?>
                                       
                     </td>
                      <td><?php echo $padl_dtl->forwarded_by; ?></td>
                      <td><?php echo $padl_dtl->modified_by; ?><?php if(isset($padl_dtl->modified_dt)){echo '/'.$padl_dtl->modified_dt; } ?></td>
                      <td> 
                       <?php //if($padl_dtl->chq_status == "R" &&  $padl_dtl->modified_by != NULL ) { ?>
                         <?php if($padl_dtl->chq_status == "R" &&  $padl_dtl->status == 0 ) { ?>
                 <a href="<?php echo site_url("paddys/bankintegration/f_paddycol_return_forward");?>?soc_id=<?=$padl_dtl->soc_id;?>&trans_dt=<?=$padl_dtl->trans_dt;?>&forward_bulk_trans_id=<?=base64_encode($padl_dtl->forward_bulk_trans_id);?>&bulk_trans_id=<?=$padl_dtl->bulk_trans_id;?>"><button class="btn btn-primary" id="">Forward</button></a>
                 <?php  } ?> 
             </td>
                  <!--    <td> 
                      <?php if($padl_dtl->status == 0) { ?> 
                     <a href="<?php //echo site_url("paddys/transactions/f_neft_forwards");?>?soc_id=<?=$padl_dtl->soc_id;?>/<?=$padl_dtl->trans_dt;?>/<?=$padl_dtl->bulk_trans_id;?>"><button class="btn btn-primary" id="">Forward</button></a></td>

                       <?php }else{
                           
                            //echo "Forwarded";
                                  
                               }
                             ?> -->
     
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
                    
                    <th width="25px">Sl. No.</th>
                        <th>Society</th>
                        <th>File Name</th>
                        <th>Procurement Dt</th> 
                        <th>Quantity</th>
                        <th width="50px">Amount</th>
                        <th>Option</th>
                        <th>Status</th>  
                        <th>Forwarded By</th> 
                        <th>Updated By</th> 
                        <th>Updated Dt</th> 
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

                window.location = "<?php echo site_url('paddys/transactions/f_paddyproc_delete?soc_id="+id+"');?>";

            }
            
        });

    });

$('.view').click(function(){
     // e.preventDefault();  // stops the jump when an anchor clicked.
     var soc_id = $(this).attr('id');

      $.ajax({
        url: '<?php echo base_url();?>index.php/paddys/transactions/f_get_society_name',
        data: {'soc_id': soc_id}, // Send Society ID
        type: "post",
        dataType: 'json',
        success: function(data){
           //document.write(data); just do not use document.write
           console.log(data); 
          // $("#mill_id").find('option').remove();
           var society_name=(data.society_name);
           
          $('#soc_name').html(society_name);
          
            
        }
      });
      });

   
    $(document).ready(function() {

    $('.confirm-div').hide();

        <?php if($this->session->flashdata('msg')){ ?>

            $('.confirm-div').html('<?php echo $this->session->flashdata('msg'); ?>').show();

        <?php } ?>

        $('.btn').click(function(){
            
            $.get('<?php echo site_url("paddys/transactions/f_getFarmerDetails1"); ?>',
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

 
   $(document).ready(function() {
    $('#myTable').DataTable();
} );

</script>
