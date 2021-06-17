<style>
table {
    border-collapse: collapse;
}

table, td, th {
    border: 1px solid #dddddd;

    padding: 6px 5px;

    font-size: 11px;
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

        <div class="col-md-6 container form-wraper">
    
            <form method="POST" 
                id="form"
                action="<?php echo site_url("report/reselling");?>" >

                <div class="form-header">
                
                    <h4>Consolidated Report on Repeat Selling</h4>
                
                </div>

                <div class="form-group row">

                    <label for="from_date" class="col-sm-2 col-form-label">From Date:</label>

                    <div class="col-sm-10">

                        <input type="date"
                               name="from_date"
                               class="form-control required"
                               value="<?php echo $sys_date;?>" />

                    </div>

                </div>

                <div class="form-group row">

                    <label for="to_date" class="col-sm-2 col-form-label">To Date:</label>

                    <div class="col-sm-10">

                        <input type="date"
                               name="to_date"
                               class="form-control required"
                               value="<?php echo $sys_date;?>" />

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

                    <div class="printHeaderNew">
                        <div class="col-sm-3 float-left logoCustom"><img src="<?php echo base_url("/benfed.png");?>"/></div>
                        <div class="col-sm-9 float-left logoTextSecRight">

                            <h2>The West Bengal State Co-operative Marketing Federation Ltd.<span>Southend Conclave, 3rd Floor,1582 Rajdanga Main Road,Kolkata - 700 107.</span></h2>
                            <h3>Consolidated Report on Repeat Selling <?php echo date("d-m-Y", strtotime($this->input->post('from_date'))).' To '.date("d-m-Y", strtotime($this->input->post('to_date')));?></h3>
                        </div>
                    </div>
                    
                    <br>
               
                    <table style="width: 100%;" id="example" >
                        <thead>

                            <tr>
                                <th>Sl No.</th>

                                <th>District</th>

                                <th>No.of Societies </th>
                                
                                <th>No.of Seller Farmers</th>

                                <th>Total Quantity of paddy sold by farmers (MT)</th>

                                <th>Total amount paid to farmers (Rupees)</th>

                                <th>Number of repeat sellers</th>

                                <th>Quantity of paddy sold by repeat farmers (MT)</th>

                                <th>Amount paid to repeat seller-farmers (Rupees)</th>
                               
                            </tr>

                        </thead>

                        <tbody>

                            <?php

                                $kms_id     = $this->session->userdata['loggedin']['kms_id'];

                                if(isset($dist)) {

                                    $i = 1;

                                    $tot_qty_paddy_purchased = 0;

                                    $tot_benifited_farmer    = 0;  
                                    
                                    $tot_amount              = 0;

                                    $tot_reseller            = 0;

                                    $tot_resale_qty          = 0;

                                    $tot_resale_amt          = 0;
                                 
                                  
                                    foreach($dist as $dis) {
                            ?>

                                <tr>
                                     <td><?php echo $i++; //Sl no.?></td>

                                     <td><?php echo $dis->branch_name; //district ?></td>

                                     <td><?php echo $dis->soc_no; //no.of soc?></td>    
                                    
                                     <td><?php                   //no. of seller farmer                  
                                            echo $dis->farm_no;

                                            $tot_benifited_farmer += $dis->farm_no;
                                         ?>
                                     </td>
                                     
                                     <td>
                                        <?php                       //paddy purchased
                                            echo $dis->qty * 0.1;  
                                            
                                            $tot_qty_paddy_purchased += $dis->qty * 0.1; 
                                         ?>
                                     </td>

                                     <td>
                                       <?php                       //Amount paid
                                            echo $dis->amt;

                                            $tot_amount += $dis->amt;
                                               
                                         ?>
                                     </td>

                                     <td>
                                         
                                        <?php
                                                foreach($reslno as $reslnodtls){     //No. of resale farmer
                                                    if($reslnodtls->branch_id == $dis->branch_id){
                                                         echo $reslnodtls->reslno;

                                                         $tot_reseller += $reslnodtls->reslno;
                                                        
                                                    }                                              
                                                }   
                                         ?> 
                                       </td>

                                      <td>
                                         
                                         <?php                                      //qty of resale
                                                foreach($reslno as $reslnodtls){
                                                    if($reslnodtls->branch_id == $dis->branch_id){
                                                        echo $reslnodtls->qty;

                                                        $tot_resale_qty +=  $reslnodtls->qty;
                                                    }                                              
                                                }   
                                         ?>
                                     </td>

                                     <td>
                                         
                                         <?php                                      //resale amount
                                                foreach($reslno as $reslnodtls){
                                                    if($reslnodtls->branch_id == $dis->branch_id){
                                                        echo $reslnodtls->amt;

                                                        $tot_resale_amt  += $reslnodtls->amt;
                                                    }                                              
                                                }   
                                         ?>
                                     </td>
                                  
                                </tr>
                               
 
                                <?php 

                                    }  
                                ?>

                                    <tr><td colspan="2" style="text-align:center;font-weight: bold;">Total</td>
                                        <td></td>
                                        <td style="text-align:center;font-weight: bold;"><?=$tot_benifited_farmer?></td>
                                        <td style="text-align:center;font-weight: bold;"><?=$tot_qty_paddy_purchased?></td>
                                        <td style="text-align:center;font-weight: bold;"><?=$tot_amount?></td>
                                        <td style="text-align:center;font-weight: bold;"><?=$tot_reseller?></td>
                                        <td style="text-align:center;font-weight: bold;"><?=$tot_resale_qty?></td>
                                        <td style="text-align:center;font-weight: bold;"><?=$tot_resale_amt?></td>
                                     </tr>

                            <?php }
                                else{

                                    echo "<tr><td colspan='14' style='text-align:center;'>No Data Found</td></tr>";

                                }   

                            ?>

                        </tbody>

                    </table>

                </div>   
                
                <div style="text-align: center;">

                    <button class="btn btn-primary" type="button" onclick="printDiv();">Print</button>
                     <button class="btn btn-primary" type="button" id="btnExport" >Excel</button>

                </div>

            </div>
            
        </div>
        
    <?php

    }

    ?> 

     <script type="text/javascript">
        $(function () {
            $("#btnExport").click(function () {
                $("#example").table2excel({
                    filename: "Consolidated Report on Repeat Selling Between <?php echo date("d-m-Y", strtotime($this->input->post('from_date'))).' To '.date("d-m-Y", strtotime($this->input->post('to_date')));?>.xls"
                });
            });
        });
    </script>
