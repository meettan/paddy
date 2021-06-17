<style>
table {
    border-collapse: collapse;
}

table, td, th {
    border: 1px solid #dddddd;

    padding: 6px;

    font-size: 14px;
}

th {

    text-align: center;

}

tr:hover {background-color: #f5f5f5;}

</style>

<script>
  function printDiv() {

        var divToPrint = document.getElementById('divToPrint');

        var WindowObject = window.open('', 'Print-Window');
        WindowObject.document.open();
        WindowObject.document.writeln('<!DOCTYPE html>');
        WindowObject.document.writeln('<html><head><title></title><style type="text/css">');


        WindowObject.document.writeln('@media print { .center { text-align: center;}' +
            '                                         .inline { display: inline; }' +
            '                                         .underline { text-decoration: underline; }' +
            '                                         .left { margin-left: 315px;} ' +
            '                                         .right { margin-right: 375px; display: inline; }' +
            '                                          table { border-collapse: collapse; font-size: 12px;}' +
            '                                          th, td { border: 1px solid black; border-collapse: collapse; padding: 6px;}' +
            '                                           th, td { }' +
            '                                         .border { border: 1px solid black; } ' +
            '                                         .bottom { bottom: 5px; width: 100%; position: fixed ' +
            '                                       ' +
            '                                   } } </style>');
        WindowObject.document.writeln('</head><body onload="window.print()">');
        WindowObject.document.writeln(divToPrint.innerHTML);
        WindowObject.document.writeln('</body></html>');
        WindowObject.document.close();
        setTimeout(function () {
            WindowObject.close();
        }, 10);

  }
</script>


<?php

    if($_SERVER['REQUEST_METHOD'] == 'GET') {

?>        
    <div class="wraper">      

        <div class="col-md-8 container form-wraper">
    
            <form method="POST" 
                id="form"
                action="<?php echo site_url("add_new/societydetail");?>" >

                <div class="form-header">
                
                    <h4>Society Detail</h4>
                
                </div>

                <div class="form-group row">

                    <label for="from_date" class="col-sm-3 col-form-label">Society Code:</label>

                    <div class="col-sm-9">

                        <input type="text"
                               name="society_code" class="form-control required" value=""/>

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

            <div class="col-lg-12 container contant-wraper">
                
                <div id="divToPrint">

                    <div style="text-align:center;">
  
                        <h2>Society Detail</h2>

                     
                    </div>

                    <br>  
                    <div class="col-lg-12">
                        <label>Society Code. :</label><?php echo $this->input->post('society_code'); ?></div>
   <br>  
                    <table style="width: 100%;">

                        <thead>

                            <tr>
                            

                                <th style="width: 15%">Name </th>

                                <th>Incharge Name</th>

                              
                                <th>District</th>

                                 <th>Block</th>

                                <th>Ph Number</th>

                                <th>Pan No</th>
                               <th>Aggrement No</th>
                                

                              

                            </tr>

                        </thead>

                        <tbody>

                            <?php

                                if($societydtl){ 

                                  $i = 1;

                                  $tot_qty_paddy_received = 0;

                                

                                  //  foreach($millDtls as $mill){

                            ?>

                                <tr>
                                  
                                    <td style="text-align:center;"><?php echo $societydtl->soc_name; ?></td>
                                   <td style="text-align:center;"><?php echo $societydtl->inchargename; ?></td>
                                   
                                    <td style="text-align:center;"><?php echo $societydtl->district_name;?></td>
                                    <td style="text-align:center;"><?php echo $societydtl->block_name; ?></td>
                                    <td style="text-align:center;"><?php echo $societydtl->ph_no; ?></td>  
                                    <td style="text-align:center;"><?php echo $societydtl->pan_no; ?></td> 
                                    <td style="text-align:center;"><?php echo $societydtl->agreementno ; ?></td>
                                    
                                 
                                </tr>

 
                                <?php        
                                   // }  ?>
                                      
                         <?php       }
                                else{

                                    echo "<tr><td colspan='14' style='text-align:center;'>No Data Found</td></tr>";

                                }   

                            ?>

                        </tbody>

                    </table>

                    <!--  <div style="text-align:center;">

                        <h2>Procurement Detail</h2>

                     
                    </div>

                    <br>  
                    <table style="width: 100%;">

                        <thead>

                            <tr>
                               <th> Sl No</th>

                                <th>Transaction Date</th>

                                <th>Quantity</th>

                                <th>Amount</th>

                                <th>Cheque No</th>

                                <th>Cheque Date</th>

                                <th>Cheque Status</th>                              

                            </tr>

                        </thead>

                        <tbody>

                            <?php

                                if($procurementdtls){ 

                                  $i = 0;
                                  $tot_qty = 0 ; 
                                  $tot_amount = 0 ; 

                                  foreach($procurementdtls as $procurementdtl)

                                { 
                                
                            ?>

                                <tr>
                                  <td style="text-align:center;"><?php echo ++$i; ?></td> 
                                   <td style="text-align:center;">
                                    <?php echo date("d-m-Y", strtotime($procurementdtl->trans_dt)); ?></td> 
                                   <td style="text-align:center;"><?php echo $procurementdtl->quantity;

                                                                    $tot_qty += $procurementdtl->quantity; 

                                   ?></td> 
                                   <td style="text-align:center;"><?php echo $procurementdtl->amount;
                                                                $tot_amount += $procurementdtl->amount; 

                                     ?></td>
                                   <td style="text-align:center;"><?php echo $procurementdtl->cheque_no; ?></td>
                                   <td style="text-align:center;">
                                    <?php echo date("d-m-Y", strtotime($procurementdtl->cheque_date)); ?>
                                  </td>
                                   <td style="text-align:center;">
                                    <?php  if($procurementdtl->chq_status =="U"){

                                   echo  "Uncleared";

                                   }elseif($procurementdtl->chq_status =="C"){
                                    echo  "Cleared";

                                   }else{

                                     echo  "Return";

                                   }?></td>
                                     
                                </tr>

                                       
                            <?php
                            }
                            echo "<tr><td colspan='2' style='text-align:center;'> Total</td><td style='text-align:center;'>".$tot_qty."</td><td style='text-align:center;'>".$tot_amount."</td>


                            </tr>";


                                 }
                                 
                                else{

                                    echo "<tr><td colspan='14' style='text-align:center;'>No Data Found</td></tr>";

                                }   

                            ?>

                        </tbody>

                    </table>

                </div>  -->

                <br>    
                
                <div style="text-align: center;">

                    <button class="btn btn-primary" type="button" onclick="printDiv();">Print</button>

                </div>

            </div>
            
        </div>
        
    <?php

    }

    ?> 