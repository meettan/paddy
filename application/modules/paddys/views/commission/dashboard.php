<div class="wraper">      
        
        <div class="row">
            <div class="col-lg-9 col-sm-12">

                <h1><strong>Society Commission</strong></h1>

            </div>

        </div>
        <div class="col-lg-12 container contant-wraper">    

            <h3>

                <small><a href="<?php echo site_url("payment/commission/add");?>" class="btn btn-primary" style="width: 100px;">Add</a></small>
                <span class="confirm-div" style="float:right; color:green;"></span>
                
                <div class="input-group" style="margin-left:75%;">
                    <span class="input-group-addon"><i class="fa fa-search"></i></span>
                    <input type="text" class="form-control" placeholder="Search..." id="search" style="z-index: 0;">
                </div>
            </h3>

            <table class="table table-bordered table-hover">

                <thead>

                    <tr>
                        
                        <th>Payment No.</th>
                        <th>Date</th>
                         <th>Bill No</th>
                        <th>Society Name</th>
                       <!--  <th>Transfer</th> -->
                        <th>Option</th>

                    </tr>

                </thead>

                <tbody> 

                    <?php 
                    
                    if($commission_dtls) {

                        foreach($commission_dtls as $p_dtls) {

                    ?>

                            <tr>

                                <td><?php echo $p_dtls->trans_cd; ?></td>
                                <td><?php echo date('d-m-Y', strtotime($p_dtls->trans_dt)); ?></td> 
                                <td><?php echo $p_dtls->ho_bill_no; ?> </td>                             
                                <td><?php echo $p_dtls->soc_name; ?> </td>
                              <!--   <td>
                                    <?php if($p_dtls->approved_status == 'U') { ?> 
                                   
                                        <button class="btn btn-primary forward" id="<?php //echo $p_dtls->trans_cd; ?>/<?php //echo $p_dtls->branch_id;?>/<?php //echo $p_dtls->kms_id;?>/<?php //echo $p_dtls->branch_ref_no;?>">Forward</button>
                                      <?php 
                                  }else {

                                     // echo "Forwarded";
                                  
                                    }
                                     ?>   
                                </td> -->
                                
                                <td>
                                
                                    <a href="commission/edit?trans_cd=<?php echo $p_dtls->trans_cd; ?>/<?php echo $p_dtls->branch_id;?>/<?php echo $p_dtls->kms_id;?>"
                                        data-toggle="tooltip"
                                        data-placement="bottom" 
                                        title="Edit">
                                        <i class="fa fa-edit fa-2x" style="color: #007bff"></i>
                                    </a>

                                      <?php if($p_dtls->approved_status == 'U') { ?> 
                                     <button type="button" class="delete"
                                        id="<?php echo $p_dtls->trans_cd; ?>/<?php echo $p_dtls->branch_id;?>/<?php echo $p_dtls->kms_id;?>"
                                        data-toggle="tooltip" data-placement="bottom" title="Delete">

                                        <i class="fa fa-trash-o fa-2x" style="color: #bd2130"></i>

                                    </button>

                                   <?php  } ?>   
                                </td>

                            </tr>

                    <?php
                            
                            }

                        }

                        else {

                            echo "<tr><td colspan='10' style='text-align: center;'>No data Found</td></tr>";

                        }
                    ?>
                
                </tbody>

                <tfoot>

                    <tr>
                    
                        <th>Payment No.</th>
                        <th>Date</th>
                        <th>Bill No</th>
                        <th>Society Name</th>
                       <!--  <th>Transfer</th> -->
                        <th>Option</th>

                    </tr>
                
                </tfoot>

            </table>
            
        </div>

    </div>

<script>

    $(document).ready( function (){


           $('.forward').click(function () {

            var id = $(this).attr('id');

            var result = confirm("Do you really want to Forward this record?");

            if(result) {

                window.location = "<?php echo site_url('payment/commision_forward?pmt_bill_no="+id+"');?>";

            }
            
        });


        $('.delete').click(function () {

            var id = $(this).attr('id');

            var result = confirm("Do you really want to delete this record?");

            if(result) {

                window.location = "<?php echo site_url('payment/commission/delete?sl_no="+id+"');?>";

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
