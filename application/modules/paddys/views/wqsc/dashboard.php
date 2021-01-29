              <div class="wraper">      
        
        <div class="row">
            
            <div class="col-lg-9 col-sm-12">

                <h1><strong>WQSC  </strong></h1>

            </div>

        </div>

        <div class="col-lg-12 container contant-wraper">    

            <h3>

                <small><a href="<?php echo site_url("paddys/transactions/f_wqsc_add");?>" class="btn btn-primary" style="width: 100px;">Add</a></small>
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
                        <th>Wqsc/CS No</th>
                        <th>Mill Name</th>
                        <th>Memo Number</th>
                        <th>Memo Date</th>
                        <th>Quantity</th>
                        <th>Created By</th>
                       <!--  <th>Modified By</th> -->
                        <th>Option</th>

                    </tr>

                </thead>
                
                <tbody> 

                    <?php 
                    
                    if($wqsc_dtls) {

                        $i = 1;

                     foreach($wqsc_dtls as $wqsc_dtl) {


                    ?>

                            <tr>

                                <td><?php echo $i++; ?></td>
                                <td><?php echo $wqsc_dtl->wqsc_no; ?></td>
                                <td><?php echo $wqsc_dtl->mill_name; ?></td>
                                <td><?php echo $wqsc_dtl->memo_no; ?></td>
                                <td> <?php echo $wqsc_dtl->memo_dt; ?></td>
                                <td> <?php echo $wqsc_dtl->quantity; ?></td>
                                <td><?php echo $wqsc_dtl->created_by; ?></td>
                                <!-- <td> <?php //echo $wqsc_dtl->modified_by; ?></td> -->
                                <td>

                                <a href="wqsc_edit?trans_no=<?php echo $wqsc_dtl->id; ?>&wqsc_no=<?php echo $wqsc_dtl->wqsc_no; ?>" data-toggle="tooltip" data-placement="bottom" class="btn btn-primary view">
                                <i class="fa fa-eye">View/Edit</i>
                                </a>
                                &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
                                <button type="button" class="delete"
                                        id="<?php echo $wqsc_dtl->id; ?>/<?php echo $wqsc_dtl->wqsc_no; ?>"
                                        data-toggle="tooltip" data-placement="bottom" title="Delete">
                                        <i class="fa fa-trash-o fa-2x" style="color: #bd2130"></i>

                                    </button>
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
                    
                        <th>Sl. No.</th>
                        <th>Wqsc/CS No</th>
                        <th>Mill Name</th>
                        <th>Memo Number</th>
                        <th>Memo Date</th>
                        <th>Quantity</th>
                        <th>Created By</th>
                      <!--   <th>Modified By</th> -->
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

                window.location = "<?php echo site_url('paddys/transactions/f_wqsc_delete?sl_no="+id+"');?>";
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
