    <div class="wraper"> 
     
<?php

    if($_SERVER['REQUEST_METHOD'] == 'GET') {

?> 

<div class="col-md-3 container">     
     </div>
        <div class="col-md-6 container form-wraper">

            
                <div class="form-header">  
                    <h4>Cheque Detail</h4>
                </div>
<form method="POST" id="form" action="<?php echo site_url("paddys/transactions/f_get_chequedtls");?>">
                <div class="form-group row">
                
                    <label for="block" class="col-sm-2 col-form-label">Cheque No:</label>
                    <div class="col-sm-4">
            <input type="text" class="form-control" name="old_chq_no" id="old_chq_no" value="" />
             <input type="hidden" class="form-control" name="old_chq_bnk" id="old_chq_bnk" value="" />
             
                      
                    </div>
             <label for="trans_dt" class="col-sm-2 col-form-label"></label>
               <div class="col-sm-4">
                <input type="submit" class="btn btn-info" value="Save"  id="submit"/>
                <!--   <input type="button" class="btn btn-info" value="Proceed" id="proceed"> -->
              </div>          
                </div>
               <!--  <div class="form-group row">
                    <div class="col-sm-10">
                        <input type="submit" class="btn btn-info" value="Save"  id="submit"/>
                    </div>
                </div> -->
            </form>
              </div>
   <?php

    }
    
    else if($_SERVER['REQUEST_METHOD'] == 'POST') { 
        
    ?>

<div class="row">            
            <div class="col-lg-9 col-sm-12">
                <h1><strong>Cheque Detail  of Cheque No: <?php echo $this->input->post('old_chq_no');?></strong></h1>
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

                   $count=0;
                   foreach($cheque_dtls as $padl_dtl)
                        {
                       ?>
                        <tr>

                          <td><?php echo ++$count; ?></td>
                          <td><?php echo $padl_dtl->soc_name; ?></td>
                          <td><?php echo $padl_dtl->farm_name; ?></td>
                        <td ><?php echo date('d/m/Y',strtotime($padl_dtl->trans_dt)); ?></td>
                          <td><?php echo $padl_dtl->tot_qty; ?></td>
                          <td><?php echo $padl_dtl->tot_amt; ?></td>
                            <td ><?php  if($padl_dtl->bank_id == 1){
                                               echo "Yes Bank"; 
                                         }elseif($padl_dtl->bank_id == 2){
                                               echo "Bandhan Bank";  
                                         }elseif($padl_dtl->bank_id == 3){
                                               echo "Icici Bank";  
                                         }
                                     elseif($padl_dtl->bank_id == 4){
                                               echo "Axis Bank";  
                                         }
                                         else {
                                            echo "Hdfc Bank";  
                                         } 
                                 ?>
                            </td>
                           
                          
                            <td style="text-align: ;">
                      
                  <a href="<?php echo base_url()?>index.php/paddys/transactions/f_reissuechq_add?soc_id=<?=$padl_dtl->soc_id;?>/<?=$padl_dtl->trans_dt;?>/<?=$padl_dtl->trans_id;?>/<?=$padl_dtl->bulk_trans_id;?>" data-toggle="tooltip"
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
    $('#proceed').click(function(){

            //Progressive Paddy Procurement
            $.post('<?php echo site_url("paddys/transactions/get_sig_cheque"); ?>',

                {
                    old_chq_no: $("#old_chq_no").val(),
                   
                }

            )
            .done(function(data){

              var value = (JSON.parse(data));
              
               var date    =  (value.cheque_date).split('-');
         
               var newDate = date["2"]+ '/' + date["1"] + '/' + date["0"];
              
              // if(value.chq_status=="U"){

                $('#qty').val(value.tot_qty);
                $('#trans_dt').val(value.trans_dt); 
                $('#amt').val(value.tot_amt); 
                $('#reg_no').val(value.reg_no); 
                $('#old_chq_date').val(newDate); 
                $('#farm_name').val(value.farm_name); 
                $('#old_chq_bnk').val(value.bank_id); 
                $('#proc_cn').val(value.soc_name); 
                //$('#book_no').val(value.book_no); 
                //$('#ifsc_code').val(value.ifsc_code);
                 $('#submit').attr('type', 'submit');        
                
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
