<?php

    if($_SERVER['REQUEST_METHOD'] == 'GET') {

?>        
    <div class="wraper">    


    <div class="row">
            
        </div>  

        <div class="col-lg-12 container contant-wraper">
    
            <form method="POST" id="form" action="<?php echo site_url("paddys/transactions/f_paddycollreissue_dwn");?>" >

                <div class="form-header">
                
                    <h4>Download Reissue Detail</h4>
                
                </div>

                <div class="form-group row">


                     <label for="to_date" class="col-sm-2 col-form-label">Bank:</label>

                    <div class="col-sm-4">
             
                   <select name="bnk" id="bnk" class="form-control required" required>
                            <option value="">Select</option> 

                              <?php 
                    if( $this->session->userdata['loggedin']['ho_flag'] == "Y" ) {  
                        ?> 
                            <option value="1">Yes Bank</option>
                            <option value="2">Bandhan Bank</option>
                            <option value="3">ICICI Bank</option> 
                        <?php } ?>
                            <option value="4">Axis Bank</option>   
                             <option value="5">HDFC Bank</option>         
                        </select>
                       
                    </div>

                </div>
                 <div class="form-group row">


                     <label for="to_date" class="col-sm-2 col-form-label">Transaction Type:</label>

                    <div class="col-sm-4">
             
                   <select name="trans_type" id="trans_type" class="form-control required" required>
                            <option value="C">Cheque</option> 
                            <option value="N">NEFT</option> 
                               
                        </select>
                       
                    </div>

                </div>
              


                <div class="form-group row">

                    <div class="col-sm-10">

                        <input type="submit" class="btn btn-info" value="Proceed" />

                    </div>

                </div>

            </form>    

        </div>

    </div>        

    <?php

    }
    
    else if($_SERVER['REQUEST_METHOD'] == 'POST') { 
        
    ?>




<div class="wraper">      
        
        <div class="row">
            
            <div class="col-lg-9 col-sm-12">

                <h1><strong>Paddy Procurement Reissue By <?php if($this->input->post("trans_type")=="N"){
                    echo "NEFT";}else{ echo "Cheque";} ?></strong></h1>

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

            <table class="table table-bordered table-hover">

                <thead>

                    <tr>
                    
                        <th width="25px">Sl. No</th>
                     
                        <th>Bank</th>
                        <th>Branch</th>        
                        <th>Quantity</th>
                        <th width="50px">Amount</th>
                        <th>Download</th>

                    </tr>

                </thead>

                <tbody> 

                <?php 
                   if(isset($paddycollection_dtls)){

                   $count=0;
                   foreach($paddycollection_dtls as $padl_dtl)
                        {
                       ?>
                        <tr>

                          <td><?php echo ++$count; ?></td>
                       
                          <td><?php  if($padl_dtl->bank_id == 1){
                                               echo "Yes Bank"; 
                                         }elseif($padl_dtl->bank_id == 2){
                                               echo "Bandhan Bank";  
                                         }elseif($padl_dtl->bank_id == 3){
                                               echo "Icici Bank";  
                                         }elseif($padl_dtl->bank_id == 4){
                                               echo "Axis Bank";  
                                         }
                                         else{
                                               echo "HDFC Bank";  
                                         } 
                                 ?>
                            </td>
                            <td ><?php echo get_district_name($padl_dtl->branch_id);

                            //echo date('d/m/Y',strtotime($padl_dtl->trans_dt));?></td>
                            <td ><?php echo $padl_dtl->tot_qty; ?></td>
                            <td ><?php echo $padl_dtl->tot_amt; ?></td>
                            <td style="text-align: ;">
                      
                               
                                    <a href="<?php echo base_url()?>index.php/paddys/transactions/f_procurementreissue_Excel/<?=$padl_dtl->branch_id;?>/<?=$padl_dtl->bank_id;?>" target="_blank" title="Download" id="btn" class="download btn btn-success" ><i class="fa fa-file-text-o fa-lg" aria-hidden="true"></i></a>


                            </td>
                        
                              
                <?php 
                       }
                    }

                    else {

                        echo "<tr><td colspan='10' style='text-align: center;'>No data Found</td>";

                    }

                    ?> 
                    </tr>
                </tbody>

                <tfoot>

                    <tr>
                    
                    <th width="25px">Sl. No.</th>
                   
                    <th>Bank</th>
                    <th>Branch</th> 
                    <th>Quantity</th>
                    <th width="50px">Amount</th>
                    <th>Download</th>
                      
                    </tr>
                
                </tfoot>

            </table>
            
        </div>
        
        <div class="modal fade" id="viewModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
            <div class="modal-dialog modal-lg" style="width: 980px;" role="document">
                <div class="modal-content">
                    <div class="modal-header">
                        <u> <h4 id="soc_name" style="text-align:center"></h4></u>
                        <button class="close" type="button" data-dismiss="modal" aria-label="Close">
                            <span aria-hidden="true">×</span>
                        </button>
                    </div>
                    <div class="modal-body" id="doc-view">
                    
                    </div>
                </div>
            </div>
        </div>
            
    </div>
<?php } ?>

<script>

    $(document).ready( function (){

        $('.delete').click(function () {

            var id = $(this).attr('id');

            var result = confirm("Do you really want to delete this record?");

            if(result) {

                window.location = "<?php echo site_url('paddy/paddycollection/delete?coll_no="+id+"');?>";

            }
            
        });

    });

</script>

<script>



$('.view').click(function(){
     // e.preventDefault();  // stops the jump when an anchor clicked.
     var soc_id = $(this).attr('id');

      $.ajax({
        url: '<?php echo base_url();?>index.php/paddys/transactions/f_get_society_name',
        data: {'soc_id': soc_id}, // Send Society ID
        type: "post",
        dataType: 'json',
        success: function(data){
           //document.write(data); just do not use document.write
           console.log(data); 
          // $("#mill_id").find('option').remove();
           var society_name=(data.society_name);
           
          $('#soc_name').html(society_name);
          
            
        }
      });
      });

   
    $(document).ready(function() {

    $('.confirm-div').hide();

        <?php if($this->session->flashdata('msg')){ ?>

            $('.confirm-div').html('<?php echo $this->session->flashdata('msg'); ?>').show();

        <?php } ?>

        $('.view').click(function(){
            
            $.get('<?php echo site_url("paddys/transactions/f_getFarmerDetails1"); ?>',
                {
                    soc_id: $(this).attr('id')
                }
            )

            .done(function(data){
                $('#doc-view').html(data);
                $('#viewModal').modal('show');
            });
        })

    });
  
 
//   


var $rows = $('table tbody tr');
$('#search').keyup(function() {
    var val = $.trim($(this).val()).replace(/ +/g, ' ').toLowerCase();
    
    $rows.show().filter(function() {
        var text = $(this).text().replace(/\s+/g, ' ').toLowerCase();
        return !~text.indexOf(val);
    }).hide();
});
</script>


