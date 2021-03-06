    <div class="wraper">      
        
        <div class="row">

            <div class="col-lg-9 col-sm-12">

                <h1><strong>Employees Advance/Bonus</strong></h1>

            </div>

        </div>

        <div class="col-lg-12 container contant-wraper">     

                <h3>

                    <small><a href="<?php echo site_url("payroll/bonus/add");?>" class="btn btn-primary" style="width: 100px;">Add</a></small>
                    <span class="confirm-div" style="float:right; color:green;"></span>
                    
                </h3>

                <table class="table table-bordered table-hover">

                    <thead>

                        <tr>
                        
                            <th>Emplyee Code</th>
                            <th>Emplyee Name</th>
                            <th>Bonus Date</th>
                            <th>Bonus Type</th>
                            <th>Amount</th>
                            <th>Option</th>

                        </tr>

                    </thead>

                    <tbody> 

                        <?php 
                        
                        if($bonus_dtls) {

                            
                                foreach($bonus_dtls as $b_dtls) {

                        ?>

                                <tr>

                                    <td><?php echo $b_dtls->emp_no; ?></td>
                                    <td><?php echo $b_dtls->emp_name; ?></td>
                                    <td><?php echo date("d-m-Y", strtotime($b_dtls->trans_dt)); ?></td>
                                    <td><?php echo ($b_dtls->bonus_flag == 'A')?'Advance':'Bonus'; ?></td>
                                    <td style="text-align:right;"><?php echo $b_dtls->amount; ?></td>
                                    
                                    <td>
                                    
                                        <a href="bonus/edit?emp_no=<?php echo $b_dtls->emp_no; ?>&month=<?php echo $b_dtls->trans_dt; ?>" 
                                            data-toggle="tooltip"
                                            data-placement="bottom" 
                                            title="Edit"
                                        >

                                            <i class="fa fa-edit fa-2x" style="color: #007bff"></i>
                                            
                                        </a>

                                        &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;

                                        <button 
                                            type="button"
                                            class="delete"
                                            id="<?php echo $b_dtls->emp_no; ?>"
                                            date="<?php echo $b_dtls->trans_dt; ?>"
                                            data-toggle="tooltip"
                                            data-placement="bottom" 
                                            title="Delete"
                                            
                                        >

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
                        
                            <th>Emplyee Code</th>
                            <th>Emplyee Name</th>
                            <th>Bonus Date</th>
                            <th>Bonus Type</th>
                            <th>Amount</th>
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
                date = $(this).attr('date');

            var result = confirm("Do you really want to delete this record?");

            if(result) {

                window.location = "<?php echo site_url('payroll/bonus/delete?empcd="+id+"&saldate="+date+"');?>";

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
