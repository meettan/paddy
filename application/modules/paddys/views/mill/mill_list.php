<div class="wraper">      
        
        <div class="row">
            
            <div class="col-lg-9 col-sm-12">

                <h1><strong>Mill</strong></h1>

            </div>

        </div>

        <div class="col-lg-12 container contant-wraper">
    
            <h3>
          
               <!--  <a href="<?php //echo site_url("paddys/add_new/f_mill_upload");?>" class="btn btn-primary" style="width: 100px;">Upload</a> -->
                <span class="confirm-div" style="float:right; color:green;"></span>
                <div class="input-group" style="margin-left:75%;">
                    <span class="input-group-addon"><i class="fa fa-search"></i></span>
                    <input type="text" class="form-control" placeholder="Search..." id="search" style="z-index: 0;">
                </div>         
            </h3>
            <?php   if($mill_dtls && $this->session->userdata['loggedin']['ho_flag']=="N") {   ?>
            <table class="table table-bordered table-hover">
                <thead>

                    <tr>
                    
                        <th>Sl No.</th>
						<th>Block</th>
                        <th>Name</th>
                        <th>Mill Code</th>
                        
                       
                        
                        <th>Option</th>

                    </tr>

                </thead>

                <tbody> 

                    <?php 
                    
															$i = 0;
                        foreach($mill_dtls as $list) {

                            foreach($dist as $d_list) {

                                if($d_list->district_code == $list->dist) {

                    ?>

                            <tr>

                                <td><?php echo ++$i; ?></td>
								<td><?php echo get_block_name($list->block); ?></td>
                                <td><?php echo $list->mill_name; ?></td>
                                <td><?php echo $list->mill_code; ?></td>
                               
                             
                                <td>
                                
                                    <a href="<?php echo site_url("paddys/add_new/f_mill_edit");?>?sl_no=<?php echo $list->sl_no; ?>" 
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
                            
                        }     ?>
                        </tbody>

                <tfoot>

                    <tr>
                    
                        <th>Sl No.</th>
						<th>Block</th>
                        <th>Name</th>
                        <th>Mill Code</th>
                       
                        
                        <th>Option</th>

                    </tr>
                
                </tfoot>

            </table>

                <?php    }

                    elseif($this->session->userdata['loggedin']['ho_flag']=="Y") {     ?>



                         <table class="table table-bordered table-hover">
                <thead>

                    <tr>
                    
                        <th>Sl No.</th>
                        <th>District Name</th>
                        <th>No of Mill</th>
                       
                      
                    </tr>

                </thead>

                <tbody> 
                    <?php 
                               $j = 0;
                      foreach($dist as $d_list)  { ?>

                            <tr>

                                <td><?php echo ++$j; ?></td>
                                <td><?php echo $d_list->district_name; ?></td>
                                <td><?php 
                                         foreach($tots_rows as $tots_row)  { 
                                        if($d_list->district_code == $tots_row->branch_id){

                                                echo $tots_row->cnt;

                                        }

                                } ?></td>
                               
                            </tr>

                        <?php  } ?>

                          <tr><td colspan="2" style='text-align: center;color: green;'>Total</td><td><?=$tot_row->cnt?></td></tr>
                             </tbody> 
                         </table>
                <?php        

                    }
                    else {

                        echo "<tr><td colspan='10' style='text-align: center;'>No data Found</td></tr>";

                    }
                    ?>
                
                
            
        </div>

    </div>

<script>

    $(document).ready( function (){

        $('.delete').click(function () {

            var id = $(this).attr('id');
                
            var result = confirm("Do you really want to delete this record?");

            if(result) {

                window.location = "<?php echo site_url('paddy/mill/delete?sl_no="+id+"');?>";

            }
            
        });

    });

</script>

<script>
   
    $(document).ready(function() {

    $('.confirm-div').hide();

        <?php if($this->session->flashdata('msg')){ ?>

            $('.confirm-div').html('<?php echo $this->session->flashdata('msg'); ?>').show();

        <?php } ?>

    });

    
</script>
