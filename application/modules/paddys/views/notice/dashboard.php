    <div class="wraper">      
        
        <div class="row">
            
            <div class="col-lg-9 col-sm-12">

                <h1><strong>Notice</strong></h1>

            </div>

        </div>

        <div class="col-lg-12 container contant-wraper">    

            <h3>

                <small><a href="<?php echo site_url("paddys/add_new/notice_add");?>" class="btn btn-primary" style="width: 100px;">Add</a></small>
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
                        <th>Number</th>
                        <th>Date</th>
                        <th>PDF</th>
                        <th>Option</th>

                    </tr>

                </thead>

                <tbody> 

                    <?php 
                    
                    if($notice) {
                        $i = 1;
                        foreach($notice as $n) {

                    ?>

                            <tr>

                                <td><?php echo $i++; ?></td>
                                <td><?php if(isset($n->number)){ echo $n->number; }  ?></td>
                                <td><?php echo date('d/m/Y',strtotime($n->notice_date)); ?></td>
                                <td><a href="<?=base_url()?>uploads/notice/<?php if(isset($n->file)){ echo $n->file; }  ?>">PDF</a></td>
                                <td>
                                
                                    <a href="notice_edit?slno=<?php if(isset($n->id)){ echo $n->id; }  ?>" 
                                        data-toggle="tooltip"
                                        data-placement="bottom" 
                                        title="Edit"
                                    >

                                        <i class="fa fa-edit fa-2x" style="color: #007bff"></i>
                                        
                                    </a>
                                    <button type="button" class="delete" id="<?php if(isset($n->id)){ echo $n->id; }  ?>" data-toggle="tooltip" data-placement="bottom" title="Delete">

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

                window.location = "<?php echo site_url('paddys/add_new/notice_delete?sl_no="+id+"');?>";

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
