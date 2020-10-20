    <div class="wraper">      
        
        <div class="row">
            
            <div class="col-lg-9 col-sm-12">

                <h1><strong>Payment Received</strong></h1>

            </div>

        </div>

        <div class="col-lg-12 container contant-wraper">    

            <h3>

                <small><a href="<?php echo site_url("paddy/paymentreceived/add");?>" class="btn btn-primary" style="width: 100px;">Add</a></small>
                <span class="confirm-div" style="float:right; color:green;"></span>
                <div class="input-group" style="margin-left:75%;">
                    <span class="input-group-addon"><i class="fa fa-search"></i></span>
                    <input type="text" class="form-control" placeholder="Search..." id="search" style="z-index: 0;">
                </div>
            </h3>

            <table class="table table-bordered table-hover">

                <thead>

                    <tr>
                    
                        <th>Received No.</th>
                        <th>Received Date</th>
                        <th>Receivable Amount</th>
                        <th>Received Amount.</th>
                        <th>Option</th>

                    </tr>

                </thead>

                <tbody> 

                    <?php 
                    
                    if($received) {

                        foreach($received as $list){
                    ?>

                            <tr>
                                <td><?php echo $list->received_no; ?></td>
                                <td><?php echo date('d-m-Y', strtotime($list->received_date)); ?></td>
                                <td><?php echo $list->receivable_amt; ?></td>
                                <td><?php echo $list->tot_amt; ?></td>
                                <td>
                                    
                                    <a href="<?php echo site_url("paddy/paymentreceived/edit")."?received_no=$list->received_no"?>"
                                        data-toggle="tooltip"
                                        data-placement="bottom" 
                                        title="Edit"
                                    >

                                        <i class="fa fa-edit fa-2x" style="color: #007bff"></i>
                                        
                                    </a>
                                    
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
                        
                        <th>Received No.</th>
                        <th>Received Date.</th>
                        <th>Receivable Amount</th>
                        <th>Received Amount</th>
                        <th>Option</th>

                    </tr>
                
                </tfoot>

            </table>
            
        </div>

    </div>

<script>

    $(document).ready( function (){

        $('.delete').click(function () {

            var id = $(this).attr('id'),
                t_no = $(this).attr('tno');

            var result = confirm("Do you really want to delete this record?");

            if(result) {

                window.location = "<?php echo site_url('paddy/received/delete?payment_bill_no="+id+"&trans_no="+t_no+"');?>";

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
