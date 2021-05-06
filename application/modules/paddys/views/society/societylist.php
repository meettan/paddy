<div class="wraper">      
        
        <div class="row">
            
            <div class="col-lg-9 col-sm-12">

                <h1><strong>Society </strong></h1>

            </div>
        </div>

        <div class="col-lg-12 container contant-wraper">
    
            <h3>
                <span class="confirm-div" style="float:right; color:green;"></span>
                <div class="input-group" style="margin-left:75%;">
                    <span class="input-group-addon"><i class="fa fa-search"></i></span>
                    <input type="text" class="form-control" placeholder="Search..." id="search" style="z-index: 0;">
                </div>
            </h3>
           <?php   if($this->session->userdata['loggedin']['ho_flag']=="N") { ?>
            <table class="table table-bordered table-hover">

                <thead>

                    <tr>
                        <th>Sl No.</th>
						<th>Block</th>
                        <th>Name</th>
                        <th>Code</th>
                        <th>InchargeName</th>
                        <th>Phone No.</th>
                        <th>Option</th>
                    </tr>
                </thead>

                <tbody> 

                    <?php 
                    
                    if(isset($society_dtls)) {
						
						$i = 0;

                        foreach($society_dtls as $list) {


               
                        ?>

                            <tr>
                                <td><?php echo ++$i;?></td>
								
								
                                <td><?php echo get_block_name($list->block); ?></td>
                                <td><?php echo $list->soc_name; ?></td> 
                                <td><?php echo $list->society_code; ?></td> 
                                <td><?php echo $list->inchargename; ?></td> 
                               
                                <td><?php echo $list->ph_no; ?></td>
                               
                                <td>
                                    <a href="<?php echo site_url("paddys/add_new/f_society_edit");?>?sl_no=<?php echo $list->sl_no; ?>" 
                                        data-toggle="tooltip"  data-placement="bottom"  title="Edit">
                                        <i class="fa fa-edit fa-2x" style="color: #007bff"></i>
                                        
                                     </a>
                                    
                                </td>

                            </tr>

                    <?php     }
					
                             }    
                         
                         
                      ?>

                       </tbody>

                 <tfoot>

                    <tr>
                        <th>Sl No.</th>
						<th>Block</th>
                        <th>Name</th>
                        <th>Code</th>
                        <th>InchargeName</th>
                        <th>Phone No.</th>
                        <th>Option</th>
                    </tr>
                
                </tfoot>

            </table>


                 <?php  }   if($this->session->userdata['loggedin']['ho_flag']=="Y") { 

                         ?>
            <table class="table table-bordered table-hover">

                <thead>

                    <tr>
                        <th>Sl No.</th>
                        <th>District Name</th>
                        <th>No. of Societies</th>
                     
                    </tr>
                </thead>

                <tbody> 

                    <?php 
                    
                    if(isset($dist)) {
                              $j = 0;
                        foreach($dist as $dis) {

               
                        ?>

                            <tr>

                                <td><?php echo ++$j; ?></td>
                                <td><?php echo $dis->district_name; ?></td> 
                                <td><?php 
                                foreach($tots_rows as $tots_row) {
                                           if($dis->district_code == $tots_row->branch_id)
                                echo $tots_row->cnt; 
                                     }

                                ?></td> 
                                
                               
                            </tr>

                    <?php   


                                                     
                        }

                       echo "<tr><td colspan='2' style='text-align: center;color: green;'>Total  Record Available</td><td>$tot_row->cnt</td></tr>";

                      }  
                      ?>

                       </tbody>

                 </table>

                 <?php  }   ?>
            
        </div>

    </div>

<script>

    $(document).ready( function (){

        $('.delete').click(function () {

            var id = $(this).attr('id');
                
            var result = confirm("Do you really want to delete this record?");

            if(result) {

                window.location = "<?php echo site_url('paddy/society/delete?sl_no="+id+"');?>";

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
