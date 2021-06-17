    <div class="wraper">      
        
        <div class="row">
            
            <div class="col-lg-9 col-sm-12">

                <h1><strong>Districts</strong></h1>

            </div>

        </div>

        <div class="col-lg-12 container contant-wraper">    

            <h3>

                <small><a href="<?php echo site_url("paddys/add_new/f_district_add");?>" class="btn btn-primary" style="width: 100px;">Add</a></small>
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
                        <th>Code</th>
                        <th>Name</th>
                        <th>Sort code</th>
                        <th>Option</th>

                    </tr>

                </thead>

                <tbody> 

                    <?php 
                    
                    if($dist) {
                        $i = 1;
                        foreach($dist as $list) {

                    ?>

                            <tr>

                                <td><?php echo $i++; ?></td>
                                <td><?php echo $list->district_code; ?></td>
                                <td><?php echo $list->district_name; ?></td>
                                <td><?php echo $list->dist_sort_code; ?></td>
                                <td>
                                
                                    <a href="f_district_edit?slno=<?php echo $list->district_code; ?>" 
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
                    
                        <th>Sl. No.</th>
                        <th>Code</th>
                        <th>Name</th>
                        <th>Sort code</th>
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

                window.location = "<?php echo site_url('paddy/workorder/delete?sl_no="+id+"');?>";

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
