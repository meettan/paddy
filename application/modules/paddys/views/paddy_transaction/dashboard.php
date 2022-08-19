    <div class="wraper">      
        
        <div class="row">
            
            <div class="col-lg-9 col-sm-12">

                <h1><strong>Paddy Transaction</strong></h1>

            </div>

        </div>

        <div class="col-lg-12 container contant-wraper">    

            <h3>

                <small><a href="<?php echo site_url("paddys/add_new/f_fartrans_upload");?>" class="btn btn-primary" style="width: 100px;">Upload</a></small>
                <span class="confirm-div" style="float:right; color:green;"></span>

            </h3>

          <!--    <table class="table table-bordered table-hover">

                <thead>

                    <tr>
                    
                        <th>Sl. No.</th>
                        <th>Date</th>
                        <th>Society Name</th>
                        <th>Mill Name</th>
                        <th>Camp No.</th>
                        <th>Option</th>

                    </tr>

                </thead>

                <tbody> 

                   <?php 
                    
                    if($transaction_dtls) {

                        
                            foreach($transaction_dtls as $b_dtls) {

                    ?>

                            <tr>

                                <td><?php echo $b_dtls->trans_cd; ?></td>
                                <td><?php echo date('d-m-Y', strtotime($b_dtls->trans_dt)); ?></td>
                                <td><?php 
                                            foreach($soc as $s_list) {

                                                if($s_list->sl_no != $b_dtls->soc_id){
                                                    
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

                                                if($m_list->sl_no != $b_dtls->mill_id){
                                                    
                                                    continue;

                                                }
                                                else{

                                                    echo $m_list->mill_name;

                                                }

                                            }
                                    ?>
                                </td>
                                <td><?php echo $b_dtls->camp_no; ?></td>

                                <td>
                                
                                    <a href="transaction/edit?trans_cd=<?php echo $b_dtls->trans_cd; ?>" 
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
                                        id="<?php echo $b_dtls->trans_cd; ?>"
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
                    
                        <th>Sl. No.</th>
                        <th>Date</th>
                        <th>Society Name</th>
                        <th>Mill Name</th>
                        <th>Camp No.</th>
                        <th>Option</th>

                    </tr>
                
                </tfoot>

            </table>-->
            
        </div>

    </div>

<script>

    $(document).ready( function (){

        $('.delete').click(function () {

            var id = $(this).attr('id');

            var result = confirm("Do you really want to delete this record?");

            if(result) {

                window.location = "<?php echo site_url('paddy/transaction/delete?sl_no="+id+"');?>";

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
