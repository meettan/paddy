<div class="wraper">      
        
    <div class="row">
        
        <div class="col-lg-9 col-sm-12">

            <h1><strong>Transaction Approve</strong></h1>

        </div>

    </div>

    <div class="col-lg-12 container contant-wraper">    

        <h3>
        
            <span class="confirm-div" style="float:right; color:green;"></span>

        </h3>

        <table class="table table-bordered table-hover">

            <thead>

                <tr>
                
                    <th>Date</th>
                    <th>Society</th>
                    <th>Mill</th>
                    <th>District</th>
                    <th>Camp No.</th>
                    <th>Option</th>

                </tr>

            </thead>

            <tbody> 

                <?php 
                
                if($unapprove_dtls) {

                    foreach($unapprove_dtls as $u_dtls) {

                ?>

                        <tr>

                            <td><?php echo date('d-m-Y', strtotime($u_dtls->trans_dt)); ?></td>

                            <td><?php 

                                foreach($soc as $s_list) {

                                    if($s_list->sl_no == $u_dtls->soc_id){

                                        echo $s_list->soc_name;

                                    }

                                }
                                ?>
                            </td>

                            <td><?php 

                                foreach($mill as $m_list) {

                                    if($m_list->sl_no == $u_dtls->mill_id){

                                        echo $m_list->mill_name;

                                    }

                                }
                                ?>

                            </td>

                            <td><?php 

                                foreach($dist as $d_list) {

                                    if($d_list->district_code == $u_dtls->dist){

                                        echo $d_list->district_name;

                                    }

                                }
                                ?>

                            </td>

                            <td><?php echo $u_dtls->camp_no;?></td>

                            <td>
                            
                                <button class="btn btn-success"
                                        id="<?php echo $u_dtls->trans_cd; ?>"
                                        style="width: 100px;">Approve</button>
                                
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
                
                    <th>Date</th>
                    <th>Society</th>
                    <th>Mill</th>
                    <th>District</th>
                    <th>Camp No.</th>
                    <th>Option</th>

                </tr>
            
            </tfoot>

        </table>
        
    </div>

</div>

<script>

    $(document).ready( function (){

        $('button').click(function () {

            var approval = false,
                id       = $(this).attr('id');

            approval     = confirm("Are you sure?");

            if(approval){

                window.location = "<?php echo site_url('paddy/approve/transaction?trans_cd="+id+"');?>";
            }
            
        });

    });

</script>


