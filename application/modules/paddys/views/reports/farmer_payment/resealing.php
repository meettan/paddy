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

                    <div style="text-align:center;">

                        <h2>The West Bengal State Co-operative Marketing Federation Ltd.</h2>

                        <h4>Southend Conclave, 3rd Floor,1582 Rajdanga Main Road,Kolkata - 700 107.</h4>

                        <h4>Consolidated Report on Repeat Selling <?php echo date("d-m-Y", strtotime($this->input->post('from_date'))).' To '.date("d-m-Y", strtotime($this->input->post('to_date')));?></h4>

                    </div>
                    
                    <br>
                    <!--  <div class="col-md-12" >  
                        <div class="col-md-3">
                        <label>Branch name:</label><?php echo get_district_name($this->input->post("dist")) ?>
                    </div>
                   </div> -->
                    <table style="width: 100%;" id="example" >
                        <thead>
                            <tr>
                                <th>Sl No.</th>
                                <th>District</th>
                                <th>Number of Societies which procured paddy</th>
                                <th>Number of farmers registered</th>
                                <th>Number of farmers benefitted (sold paddy)</th>
                                <th>Total Quantity of paddy sold by farmers (MT)</th>
                                <th>Total amount paid to farmers (Rupees)</th>
                                <th>Number of repeat sellers</th>
                                <th>Quantity of paddy sold by repeat farmers (MT)
</th>
                                <th>Amount paid to repeat seller-farmers (Rupees)
</th>
                               
                            </tr>
                        </thead>

                        <tbody>

                            <?php
  $kms_id     = $this->session->userdata['loggedin']['kms_id'];
                               if(isset($dist)) {

                                    $i = 1;
                                    $tot_qty_paddy_purchased = 0;
                                    $tot_benifited_farmer = 0;  $tot_amount = 0;
                                 
                                  
                                    foreach($dist as $dis) {
                            ?>

                                <tr>
                                     <td><?php echo $i++; ?></td>           <!--sl no-->
                                     <td><?php echo $dis->district_name; ?></td> <!-- district -->
                                     <td><?php                                      //no.of society
                                            foreach($collc as $colcDtls){
                                                if($colcDtls->branch_id == $dis->district_code){
                                                     echo $colcDtls->soc_no;
                                                   
                                                }
                                            }   
                                                  
                                         ?></td>
                                     <td>

                                        <?php                                   //no.of farmer registered in the dist.
                                                foreach($reg as $regfarm){                      
                                                    if($regfarm->dist == $dis->district_code){
                                                         echo $regfarm->reg_farm;
                                                        
                                                    }
                                                }   
                                         ?>
                                     </td>
                                     <td><?php                                      //no.of farmer sold paddy
                                                foreach($collc as $colcDtls){
                                                    if($colcDtls->branch_id == $dis->district_code){
                                                         echo $colcDtls->farm_ben;
                                                       
                                                    }
                                                }   
                                         ?>
                                     </td>
                                     <td>
                                        <?php
                                                foreach($collc as $colcDtls){       //total paddy sold
                                                    if($colcDtls->branch_id == $dis->district_code){
                                                         echo $colcDtls->quantity*0.1;
                                                       
                                                    }
                                                }   
                                         ?>
                                     </td>
                                     <td>
                                       <?php
                                                foreach($collc as $colcDtls){           //total amount paid
                                                    if($colcDtls->branch_id == $dis->district_code){
                                                         echo $colcDtls->amount;
                                                       
                                                    }
                                                }   
                                         ?>
                                     </td>

                                     <td>
                                         
                                        <?php
                                                foreach($reslno as $reslnodtls){    //no. of resale case
                                                    if($reslnodtls->branch_id == $dis->district_code){
                                                         echo $reslnodtls->reslno;
                                                        
                                                         }                                              
                                                }   
                                         ?> 
                                       </td>

                                     <td>
                                         
                                         <?php
                                                foreach($reslno as $reslnodtls){
                                                    if($reslnodtls->branch_id == $dis->district_code){
                                                        echo $reslnodtls->qty;
                                                    }                                              
                                                }   
                                         ?>
                                     </td>

                                     <td>
                                         
                                         <?php
                                                foreach($reslno as $reslnodtls){
                                                    if($reslnodtls->branch_id == $dis->district_code){
                                                        echo $reslnodtls->amt;
                                                    }                                              
                                                }   
                                         ?>
                                     </td>
                                  
                                </tr>
                               
 
                                <?php 

                                    }  
                                    

                            }
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
