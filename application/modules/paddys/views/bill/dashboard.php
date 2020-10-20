    <div class="wraper">      
        
        <div class="row">
            
            <div class="col-lg-9 col-sm-12">

                <h1><strong>Bill</strong></h1>

            </div>

        </div>

        <div class="col-lg-12 container contant-wraper">    

            <h3>

                <small><a href="<?php echo site_url("paddy/bill/add");?>" class="btn btn-primary" style="width: 100px;">Add</a></small>
                <span class="confirm-div" style="float:right; color:green;"></span>
                <div class="input-group" style="margin-left:75%;">
                    <span class="input-group-addon"><i class="fa fa-search"></i></span>
                    <input type="text" class="form-control" placeholder="Search..." id="search" style="z-index: 0;">
                </div>
            </h3>

            <table class="table table-bordered table-hover">

                <thead>

                    <tr>
                    
                        <th>Bill No.</th>
                        <th>Date</th>
                        <th>Pool Type</th>
                        <th>KMS Year</th>
                        <th>Society</th>
                        <th>Mill</th>
                        <th>Option</th>

                    </tr>

                </thead>

                <tbody> 

                    <?php 
                    
                    if($bill_dtls) {

                        $i = 1;

                        foreach($bill_dtls as $b_list) {
                        
                    ?>

                            <tr>

                                <td><?php echo $b_list->bill_no; ?></td>
                                <td><?php echo date('d-m-Y',strtotime($b_list->bill_dt)); ?></td>
                                <td><?php if($b_list->pool_type == 'S'){
                                            echo 'State Pool';
                                          }
                                          else if($b_list->pool_type == 'C'){ 
                                            echo 'Central Pool';
                                          }
                                          else if($b_list->pool_type == 'F'){
                                            echo 'FCI';
                                          }
                                    ?>
                                </td>
                                <td><?php echo $b_list->kms_yr; ?></td>
                                <td><?php 
                                            foreach($soc as $s_list) {

                                                if($s_list->sl_no != $b_list->soc_id){
                                                    
                                                    continue;

                                                }
                                                else{

                                                    echo $s_list->soc_name;

                                                }

                                            }
                                    ?>
                                </td>
                                <td><?php 
                                            foreach($mill as $m_list) {

                                                if($m_list->sl_no != $b_list->mill_id){
                                                    
                                                    continue;

                                                }
                                                else{

                                                    echo $m_list->mill_name;

                                                }

                                            }
                                    ?>
                                </td>

                                <td>
                                
                                    <a href="bill/edit?bill_no=<?php echo $b_list->bill_no."&pool_type=".$b_list->pool_type.""; ?>" 
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
                                        id="<?php echo $b_list->bill_no; ?>"
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
                    
                        <th>Bill No.</th>
                        <th>Date</th>
                        <th>Pool Type</th>
                        <th>KMS Year</th>
                        <th>Society</th>
                        <th>Mill</th>
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

                window.location = "<?php echo site_url('paddy/bill/delete?bill_no="+id+"');?>";

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
