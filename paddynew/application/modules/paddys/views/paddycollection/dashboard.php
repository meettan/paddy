<div class="wraper">   

        <div class="row">
            <div class="col-lg-9 col-sm-12">
                <h1><strong>Paddy Procurement</strong></h1>
            </div>

        </div>

        <div class="col-lg-12 container contant-wraper">    

            <h3 style="margin-bottom:30px">

       <!--<small><a href="<?php //echo site_url("paddys/transactions/f_paddycollection_add");?>" class="btn btn-primary" style="width: 100px;">Add</a></small>-->
            <small><a href="<?php echo site_url("paddys/transactions/f_paddycollupload");?>" class="btn btn-primary" style="width: 100px;">Upload</a></small>
                <span class="confirm-div" style="float:right; color:green;"></span>
               <!--  <div class="input-group" style="margin-left:75%;">
                <span class="input-group-addon"><i class="fa fa-search"></i></span>
                <input type="text" class="form-control" placeholder="Search..." id="search" style="z-index: 0;">
                </div> -->
            </h3>

            <table class="table table-bordered table-hover" id="myTable">

                <thead>

                    <tr>
                        <th width="25px">Sl. No</th>
                        <th>Society</th>
                     <!--   <th>File Number</th>
                         <th>Bank</th> -->
                        <th>Procurement Dt</th>        
                        <th>Quantity</th>
                        <th width="50px">Amount</th>
                      <!--   <th>Uploaded By</th> -->
                        <th>Option</th>
                     <!--   <th>Forward </th>
                        <th>Forwarded By</th> -->
                        <th>Delete</th>
                    </tr>

                </thead>
                <tbody> 

                <?php 
                   if(isset($paddycollection_dtls)){

                   $count=0;
                   foreach($paddycollection_dtls as $padl_dtl)
                        {
                       ?>
                        <tr>

                          <td ><?php echo ++$count; ?></td>
                          <td ><?php echo $padl_dtl->soc_name; ?></td>
                        
                      <!--     <td><?php //echo $padl_dtl->bank_name; ?></td> -->
                          <td ><?php echo date('d/m/Y',strtotime($padl_dtl->trans_dt)); ?></td>
                          <td ><?php echo $padl_dtl->tot_qty; ?></td>
                          <td ><?php echo $padl_dtl->tot_amt; ?></td>
                 <!--          <td ><?php //echo $padl_dtl->created_by; ?></td> -->
                          <td style="text-align: ;">
                    <?php $data = $this->db->get_where('td_work_order', array('soc_id' => $padl_dtl->soc_id,'kms_year' =>$this->session->userdata['loggedin']['kms_id']))->num_rows();
                            if($data != '0'){
                            ?>
                          <a href="<?php echo base_url()?>index.php/paddys/transactions/f_cheque_add?soc_id=<?=$padl_dtl->soc_id;?>/<?=$padl_dtl->trans_dt;?>/<?=$padl_dtl->bulk_trans_id;?>/<?=$padl_dtl->chq_status;?>" data-toggle="tooltip"
                              data-placement="bottom"  title="Edit">
                              <i class="fa fa-edit fa-2x" style="color: #007bff"></i></a>
                            <?php } ?>
                          </td>
                        <!--  <td > <b>
                            <?php if($padl_dtl->status == 0 && $padl_dtl->chq_status == 'U') { 
                          
                                     echo "Data Uploaded"; ?> 
                              
                                <?php }elseif($padl_dtl->status == 1 && $padl_dtl->chq_status == 'U'){

                                  echo '<span style="color:#b20000">Forwarded</span>';
                                  
                                }elseif($padl_dtl->status == 1 && $padl_dtl->chq_status == 'C'){

                                  echo "Cleared";

                                }elseif($padl_dtl->status == 1 && $padl_dtl->chq_status == 'S'){

                                  echo '<span style="color:#185c27">SUCCESS</span>';

                                }elseif($padl_dtl->status == 1 && $padl_dtl->chq_status == 'P'){

                                  echo '<span style="color:#185c27">PROCESSED</span>';

                                }elseif($padl_dtl->status == 1 && $padl_dtl->chq_status == 'A'){

                                  echo '<span style="color:#185c27">PAID</span>';

                                }
                                elseif($padl_dtl->status == 1 && $padl_dtl->chq_status == 'R'){

                                  echo '<span style="color:#f11421">Returned</span>';

                                }elseif($padl_dtl->status == 0 && $padl_dtl->chq_status == 'R'){

                                  echo '<span style="color:#f11421">Returned</span>';

                                }elseif($padl_dtl->status == 1 && $padl_dtl->chq_status == 'I'){

                                  echo "Cheque Returned";
                                }elseif($padl_dtl->status == 0 && $padl_dtl->chq_status == 'L'){
                                    echo '<span style="color:#185c27">Awaiting Liquidation</span>';
                                }elseif($padl_dtl->status == 0 && $padl_dtl->chq_status == 'Z'){
                                    echo '<span style="color:#185c27">Authorization Pending</span>';
                                }
                                else{
                                    echo '<span style="color:#185c27">Unknown</span>';
                                }  
                                 ?>  
                                 </b>  
                                </td> 
                                <td><?php //echo $padl_dtl->forwarded_by; ?></td> -->
                                 <td>
                                    <?php if($padl_dtl->status == 0 && $padl_dtl->chq_status == 'U') { ?>

                   <button type="button" class="delete" id="<?=$padl_dtl->soc_id;?>/<?=$padl_dtl->trans_dt;?>/<?=$padl_dtl->bulk_trans_id;?>" data-toggle="tooltip" data-placement="bottom" title="Delete">         
                     
                                    <i class="fa fa-trash fa-2x" style="color: #007bff"></i>
                                </button>
                        <?php  } ?> </td>
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
                        <th>Procurement Dt</th> 
                        <th>Quantity</th>
                        <th width="50px">Amount</th>
                        <th>Option</th>
                        <th>Delete</th>
                    </tr>
                
                </tfoot>

            </table>
            
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

                window.location = "<?php echo site_url('paddys/transactions/f_paddyproc_delete?soc_id="+id+"');?>";

            }
            
        });

    });

</script>

<script>




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
