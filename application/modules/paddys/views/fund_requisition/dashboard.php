    <div class="wraper">      
        
        <div class="row">
            
            <div class="col-lg-9 col-sm-12">

                <h1><strong>Fund Requisition</strong></h1>

            </div>

        </div>

        <div class="col-lg-12 container contant-wraper" style="font-size: 10px;">    

            <h3>

                <small><a href="<?php echo site_url("payment/requisition_add");?>" class="btn btn-primary" style="width: 100px;">Add</a></small>
                <span class="confirm-div" style="float:right; color:green;"></span>
                <div class="input-group" style="margin-left:75%;">
                    <span class="input-group-addon"><i class="fa fa-search"></i></span>
                    <input type="text" class="form-control" placeholder="Search..." id="search" style="z-index: 0;">
                </div>
            </h3>

            <table class="table table-bordered table-hover">

                <thead>

                    <tr>
                        <th>Sl No.</th>
                        <th>Requisition No.</th>
                        <th>Wqsc/CS No.</th>
                        <th>Date</th>
                        <th>Society Name</th>
                        <th>Mill Name</th>
                        <th>Total Paddy</th>
                        <th>Total CMR</th>
                        <th>Transfer</th>
                        <th>Marketing</th>
                        <th>Accounts</th>
                        <th>Admin</th>
                        <th>Fund Allocation</th>
                        <th>Option</th>


                    </tr>

                </thead>

                <tbody> 

                    <?php 
                    $i = 0;
                    if($payment_dtls) {

                        foreach($payment_dtls as $p_dtls) {

                    ?>

                            <tr>
                                <td><?php echo ++$i; ?></td>
                                <td><?php echo $p_dtls->req_no; ?></td>
                                <td><?php echo $p_dtls->wqsc; ?></td>
                                <td><?php echo date('d/m/Y', strtotime($p_dtls->req_dt)); ?></td>
                                <td><?php echo $p_dtls->soc_name; ?> </td>
                                <td><?php echo $p_dtls->mill_name?></td>
                                <td><?php echo $p_dtls->tot_paddy?></td>
                                <td><?php echo $p_dtls->tot_cmr?></td>
                                <td>
                                    <?php if($p_dtls->ho_flag == 0) { ?> 
                                   
                                        <button class="btn btn-primary forward" id="<?php echo $p_dtls->req_no; ?>">Forward</button>
                                      <?php 
                                    }else {

                                       if($p_dtls->sanc_no == NULL){

                                            echo "Forwarded";

                                            }else{

                                                if($p_dtls->fund_flag==1){

                                                     echo '<span style="color:green">Sancation No</span></br>';
                                                     echo '<span style="color:orange"><b>'.$p_dtls->sanc_no.'</b></span>';
                                                }else{

                                                    echo "Forwarded ";
                                                }

                                               

                                            }                                  
                                        }
                                    ?>   

                                </td>
                                <td><?php if($p_dtls->approve1 == "0") {

                                            echo '<span style="color:blue">Pending</span>';

                                     } elseif($p_dtls->approve1 == "1"){ 

                                            echo '<span style="color:Green">Recommend</span>';

                                     } else{  

                                            echo '<span style="color:red">Hold</span>';

                                           } ?>
                                </td>
                                <td><?php if($p_dtls->approve2 == "0") {

                                            echo '<span style="color:blue">Pending</span>';

                                     } elseif($p_dtls->approve2 == "1"){ 

                                            echo '<span style="color:Green">Recommend</span>';

                                     } else{ echo '<span style="color:red">Hold</span>';} ?>
                                         
                                </td>
                                <td><?php if($p_dtls->approve3 == "0") {

                                            echo '<span style="color:blue">Pending</span>';

                                     } elseif($p_dtls->approve3 == "1"){ 

                                            echo '<span style="color:Green">Approved</span>';

                                     } else{ echo '<span style="color:red">Hold</span>';} ?>
                                         
                                </td>
                                <td>
                                    <?php if($p_dtls->fund_flag == "1") {

                                            echo '<span style="color:orange">YES</span>';

                                     }  else{ echo '<span style="color:red">NO</span>';} ?>

                                </td>
                                <td>
                                
                                    <a href="<?php echo base_url();?>index.php/payment/requisition_edit?req_no=<?php echo $p_dtls->req_no; ?>" 
                                        data-toggle="tooltip"
                                        data-placement="bottom" 
                                        title="Edit">
                                        <i class="fa fa-edit fa-2x" style="color: #007bff"></i>
                                        
                                    </a>

                                    &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
                                     <?php if($p_dtls->ho_flag == 0) { ?> 
                                    <button type="button"
                                        class="delete"
                                        id="<?php echo $p_dtls->req_no; ?>"
                                        data-toggle="tooltip"
                                        data-placement="bottom" 
                                        title="Delete">

                                        <i class="fa fa-trash-o fa-2x" style="color: #bd2130"></i>

                                    </button>
                                <?php } ?>
                                    
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
                        <th>Sl No.</th>
                        <th>Requisition No.</th>
                        <th>Wqsc/CS No.</th>
                        <th>Date</th>
                        <th>Society Name</th>
                        <th>Mill Name</th>
                        <th>Total Paddy</th>
                        <th>Total CMR</th>
                        <th>Transfer</th>
                        <th>Marketing</th>
                        <th>Accounts</th>
                        <th>Admin</th>
                        <th>Fund Allocation</th>
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

                window.location = "<?php echo site_url('payment/requisition_forward?req_no="+id+"');?>";

            }
            
        });

        $('.delete').click(function () {

            var id = $(this).attr('id');

            var result = confirm("Do you really want to delete this record?");

            if(result) {

                window.location = "<?php echo site_url('payment/requisition_delete?sl_no="+id+"');?>";

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
