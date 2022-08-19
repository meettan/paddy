    <div class="wraper"> 
     
<?php

    if($_SERVER['REQUEST_METHOD'] == 'GET') {

?> 

<div class="col-md-3 container">     
     </div>
        <div class="col-md-6 container form-wraper">

            
                <div class="form-header">  
                    <h4>NEFT Detail</h4>
                </div>
       <form method="POST" id="form" action="<?php echo site_url("paddys/transactions/f_neftdtls");?>">
                <div class="form-group row">
                <div class="col-sm-4">
                  <label for="block" class="col-form-label">Block:</label>
                      <select name="block" id="block" class="form-control required">
                            <option value="">Select</option>    
                            <?php foreach($blocks as $block) { ?>
                            <option value="<?php if(isset($block->blockcode)){ echo $block->blockcode; }?>"><?php if(isset($block->block_name)){ echo $block->block_name; }?></option>    
                            <?php } ?>
                        </select>

                    </div>

                      <div class="col-sm-8">
                <label for="soc_name" class="col-form-label">Society Name:</label>

                        <select type="text"
                                class="form-control required sch_cd" name="soc_name"
                                id="soc_name">
                            <option value="">Select</option>    
                        </select>    

                    </div>

                    <!--  <div class="col-sm-3">
             <label for="soc_name" class="col-form-label">Bank:</label>
                    <select name="bank_sl_no" id="bank_sl_no" class="form-control" required>
                <option value="">Select</option>    
               
                <option value="1">Yes Bank</option> 
                <option value="2">Bandhan Bank</option> 
                <option value="3">Icici Bank</option> 
                <option value="4">Axis Bank</option> 
                <option value="5">Hdfc Bank</option> 
                 
                         
                  </select>
                </div> -->
           
                </div>
                <div class="form-group row">
                    <div class="col-sm-10">
                        <input type="submit" class="btn btn-info" value="Save"  id="submit"/>
                    </div>
                </div>
            </form>
              </div>
   <?php

    }
    
    else if($_SERVER['REQUEST_METHOD'] == 'POST') { 
        
    ?>

<div class="row">            
            <div class="col-lg-9 col-sm-12">
                <h1><strong>NEFT Detail of Failed Transaction</strong></h1>
            </div>
        </div>
      <div class="col-lg-12 container contant-wraper">

    <table class="table table-bordered table-hover" id="myTable">

                <thead>

                    <tr>
                        <th width="25px">Sl. No</th>
                        <th>Society</th>
                        <th>Farmer name</th>
                        <th>Cheque Dt</th>        
                        <th>Quantity</th>
                        <th width="50px">Amount</th>
                        <th width="50px">Bank name</th>
                        <th>Option</th>
                       
                      
                    </tr>
                </thead>
                <tbody> 

                <?php 
                   if(isset($cheque_dtls)){
              $kms_id      = $this->session->userdata['loggedin']['kms_id'];
                   $count=0;
                   foreach($cheque_dtls as $padl_dtl)
                        {
                       ?>
                        <tr>

                          <td><?php echo ++$count; ?></td>
                          <td><?php echo $padl_dtl->soc_name; ?></td>
                   <td><?php echo $padl_dtl->reg_no//=get_farmer_name($this->session->userdata['loggedin']['kms_id'],)?></td>
                        <td ><?php echo date('d/m/Y',strtotime($padl_dtl->trans_dt)); ?></td>
                          <td><?php echo $padl_dtl->tot_qty; ?></td>
                          <td><?php echo $padl_dtl->tot_amt; ?></td>
                            <td ><?php  if($padl_dtl->bank_sl_no == 1){
                                               echo "Yes Bank"; 
                                         }elseif($padl_dtl->bank_sl_no == 2){
                                               echo "Bandhan Bank";  
                                         }elseif($padl_dtl->bank_sl_no == 3){
                                               echo "Icici Bank";  
                                         }
                                     elseif($padl_dtl->bank_sl_no == 4){
                                               echo "Axis Bank";  
                                         }
                                         else {
                                            echo "Hdfc Bank";  
                                         } 
                                 ?>
                            </td>
                           
                          
                            <td style="text-align: ;">
                      
                  <a href="<?php echo base_url()?>index.php/paddys/transactions/f_reissueneft_add?soc_id=<?=$padl_dtl->soc_id;?>/<?=$padl_dtl->trans_dt;?>/<?=$padl_dtl->trans_id;?>/<?=$padl_dtl->bulk_trans_id;?>" data-toggle="tooltip"
                                    data-placement="bottom"  title="Edit">
                                    <i class="fa fa-edit fa-2x" style="color: #007bff"></i>
                                </a>
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
                        <th width="25px">Sl. No</th>
                        <th>Society</th>
                        <th>Farmer name</th>
                        <th>Cheque Dt</th>        
                        <th>Quantity</th>
                        <th width="50px">Amount</th>
                        <th width="50px">Bank name</th>
                        <th>Option</th>
                    </tr>
                
                </tfoot>

            </table>


      </div>

      <?php

    }

    ?> 
      

    </div>


<script>

       $('#block').change(function(){

            $.get( 

                '<?php echo site_url("paddy/societies");?>',

                { 

                    block: $(this).val()

                }

            ).done(function(data){

                var string = '<option value="">Select</option>';

                $.each(JSON.parse(data), function( index, value ) {

                    string += '<option value="' + value.sl_no + '">' + value.soc_name + '</option>'

                });

                $('#soc_name').html(string);

            });

        });
  

  $("#trans_dt").change(function(){

          var trans_dt = $('#trans_dt').val();
         
 var d = new Date();

 var month = d.getMonth()+1;
 var day = d.getDate();

 var output = d.getFullYear() + '-' +
    (month<10 ? '0' : '') + month + '-' +
    (day<10 ? '0' : '') + day;

    console.log(trans_dt,output);

          if(new Date(output) < new Date(trans_dt))
          {
          alert("Transaction  Date Can Not Be Greater Than Current Date");
          $('#submit').attr('type', 'buttom');
          return false;
          }else{
             $('#submit').attr('type', 'submit');
          }
})

 $('#form').submit(function(event){
 var trans_dt = $('#trans_dt').val();
 var d = new Date();
 var month = d.getMonth()+1;
 var day = d.getDate();

 var output = d.getFullYear() + '-' +
    (month<10 ? '0' : '') + month + '-' +
    (day<10 ? '0' : '') + day;

                    if(new Date(output) < new Date(trans_dt)){
                    alert("Transaction  Date Can Not Be Greater Than Current Date");
                    event.preventDefault();
                    }
                     else 
                        {
                    //  alert("Transaction Date Can Not Be Less Than order Date");
                       $('#submit').attr('type', 'submit');
                      }
            });
</script>
