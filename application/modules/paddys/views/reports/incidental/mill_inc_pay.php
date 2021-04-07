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
                action="<?php echo site_url("report/millIncPay");?>" >

                <div class="form-header">
                
                    <h4>Millwise Incidental Payment</h4>
                
                </div>

                <div class="form-group row">

                    <label for="from_date" class="col-sm-2 col-form-label">From Date:</label>

                    <div class="col-sm-10">

                        <input type="date"
                               id="from_date" 
                               name="from_date"
                               class="form-control required"
                               value="<?php echo $sys_date;?>" />

                    </div>

                </div>

                <div class="form-group row">

                    <label for="to_date" class="col-sm-2 col-form-label">To Date:</label>

                    <div class="col-sm-10">

                        <input type="date"
                               id="to_date"
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
                            <h3>Millwise Incidental Payment Between <?php echo date("d-m-Y", strtotime($this->input->post('from_date'))).' To '.date("d-m-Y", strtotime($this->input->post('to_date')));?></h3>
                        </div>
                    </div>
                    

                    <br>
                        <div class="col-md-12" >  
                            <div class="col-md-3">
                                <label>Branch name:</label><?php echo $this->session->userdata['loggedin']['branch_name']; ?>
                            </div>
                        </div>
                    <table style="width: 100%;" id="example">

                        <thead>

                            <tr>
                            
                                <th>Sl No.</th>

                                <th style="width: 25%">Mill</th>

                                <th>Quantity of Paddy(Qnt)</th>

                                <th>Quantity of CMR(Qnt)</th>

                                <th>Milling Charge(Rs)</th>

                                <th>Mandi Labour Charge(Rs)</th>

                                <th>Transportation of Paddy (1-25 KM)(Rs)</th>

                                <th>Transportation of Paddy (>25-50 KM)(Rs)</th>

                                <th>Transportation of Paddy (>50-100 KM)(Rs)</th>

                                <th>Transportaion of CMR(Rs)</th>

                                <th>Interdistrict Transportation of CMR(Rs)</th>

                                <th>Usage Charges for Gunny Bags(Rs)</th>

                                <th>Total Incidental(Rs)</th>

                            </tr>

                        </thead>

                        <tbody>

                            <?php

                                if($procDtls){ 

                                    $i = 1;
                                
                                    $tot_proc = 0;
                                    $tot_cmr  = 0;

                                   
                                    $tot_mill_crg = 0;
                                    $tot_mandi_crg = 0;
                                    $tot_paddy_trans_25  = 0;
                                    $tot_paddy_trans_50  = 0;
                                    $tot_paddy_trans_100 = 0;
                                    $tot_cmr_trans       = 0;
                                    $tot_inter_cmr_trans = 0;
                                    $tot_gunny_use       = 0;
                                    $tot_inc_amt         = 0;

                                    foreach($procDtls as $proc){

                            ?>

                                <tr>
                                     <td><?php echo $i++; ?></td>

                                     <td><?php echo $proc->mill_name; ?></td>

                                     <td><?php echo $proc->qty;                     //Quantity of paddy purchased
                                               $tot_proc += $proc->qty;
                                         ?>
                                     </td>

                                     <td><?php echo $proc->cmr;                     //total CMR
                                               $tot_cmr += $proc->cmr;
                                          ?>
                                     </td>
                                     
                                     <td>
                                        <?php
                                                foreach($mill as $millDtls){          //Milling Charge
                                                    if($millDtls->mill_id == $proc->mill_id){
                                                        if($millDtls->account_type == '9'){
                                                            echo $millDtls->mill_comm;
                                                            $tot_mill_crg += $millDtls->mill_comm;
                                                        }
                                                    }
                                                }
                                         ?>
                                     </td>
                                      
                                     <td>
                                        <?php
                                                foreach($mill as $millDtls){                //Mandi Labour Charge
                                                    if($millDtls->mill_id == $proc->mill_id){
                                                        if($millDtls->account_type == '2'){
                                                            echo $millDtls->mill_comm;
                                                            $tot_mandi_crg +=$millDtls->mill_comm;
                                                        }
                                                    }
                                                }
                                         ?>
                                     </td>
                                     <td>
                                       <?php
                                                foreach($mill as $millDtls){            //Transportation Charge Paddy(1-25)
                                                    if($millDtls->mill_id == $proc->mill_id){
                                                        if($millDtls->account_type == '3'){
                                                            echo $millDtls->mill_comm;
                                                            $tot_paddy_trans_25 +=$millDtls->mill_comm;
                                                        }
                                                    }
                                                }
                                         ?>
                                     </td>
                                     <td><?php
                                                foreach($mill as $millDtls){            //Transportation Charge Paddy(26-50)
                                                    if($millDtls->mill_id == $proc->mill_id){
                                                        if($millDtls->account_type == '4'){
                                                            echo $millDtls->mill_comm;
                                                            $tot_paddy_trans_50 +=$millDtls->mill_comm;
                                                        }
                                                    }
                                                }
                                         ?>
                                     </td>
                                      
                                  
                                     <td><?php
                                                foreach($mill as $millDtls){            //Transportation Charge Paddy(51-100)
                                                    if($millDtls->mill_id == $proc->mill_id){
                                                        if($millDtls->account_type == '5'){
                                                            echo $millDtls->mill_comm;
                                                            $tot_paddy_trans_100 +=$millDtls->mill_comm;
                                                        }
                                                    }
                                                }
                                         ?>        
                                     </td>
                                     <td><?php
                                                foreach($mill as $millDtls){            //Transportation Charge CMR
                                                    if($millDtls->mill_id == $proc->mill_id){
                                                        if($millDtls->account_type == '11'){
                                                            echo $millDtls->mill_comm;
                                                            $tot_cmr_trans +=$millDtls->mill_comm;
                                                        }
                                                    }
                                                }
                                         ?>
                                     </td>
                                     <td><?php
                                                foreach($mill as $millDtls){            //Interdistrict Transportation Charge CMR
                                                    if($millDtls->mill_id == $proc->mill_id){
                                                        if($millDtls->account_type == '6'){
                                                            echo $millDtls->mill_comm;
                                                            $tot_inter_cmr_trans +=$millDtls->mill_comm;
                                                        }
                                                    }
                                                }
                                         ?>
                                     </td>
                                     <td><?php
                                                foreach($mill as $millDtls){            //Total Gunny usage charge
                                                    if($millDtls->mill_id == $proc->mill_id){
                                                        if($millDtls->account_type == '12'){
                                                            echo $millDtls->mill_comm;
                                                            $tot_gunny_use +=$millDtls->mill_comm;
                                                        }
                                                    }
                                                }
                                         ?>
                                    </td>
                                    <td><?php
                                                foreach($tot as $totDtls){            //Total Incidental
                                                    if($totDtls->mill_id == $proc->mill_id){
                                                        echo $totDtls->tot_amt;
                                                             $tot_inc_amt +=$totDtls->tot_amt;
                                                        
                                                    }
                                                }
                                         ?>
                                    </td>
                                </tr>
                               
 
                                <?php 

                                    }  ?>

                                    <tr><td colspan="2" style="text-align:center;font-weight: bold;">Total</td>
                                        <td style="text-align:center;font-weight: bold;"><?=$tot_proc?></td>
                                        <td style="text-align:center;font-weight: bold;"><?=$tot_cmr?></td>
                                        <td style="text-align:center;font-weight: bold;"><?=$tot_mill_crg?></td>
                                        <td style="text-align:center;font-weight: bold;"><?=$tot_mandi_crg?></td>
                                        <td style="text-align:center;font-weight: bold;"><?=$tot_paddy_trans_25?></td>
                                        <td style="text-align:center;font-weight: bold;"><?=$tot_paddy_trans_50?></td>
                                        <td style="text-align:center;font-weight: bold;"><?=$tot_paddy_trans_100?></td>
                                        <td style="text-align:center;font-weight: bold;"><?=$tot_cmr_trans?></td>
                                        <td style="text-align:center;font-weight: bold;"><?=$tot_inter_cmr_trans?></td>
                                        <td style="text-align:center;font-weight: bold;"><?=$tot_gunny_use?></td>
                                        <td style="text-align:center;font-weight: bold;"><?=$tot_inc_amt?></td>
                                     </tr>

                         <?php        }
                                else{

                                    echo "<tr><td colspan='14' style='text-align:center;'>No Data Found</td></tr>";

                                }   

                            ?>

                        </tbody>

                    </table>

                </div>   
                
                <div class="nextPrvBtn">

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
                    filename: "Millwise Incidental Payment Between <?php echo date("d-m-Y", strtotime($this->input->post('from_date'))).' To '.date("d-m-Y", strtotime($this->input->post('to_date')));?>.xls"
                });
            });
        });
    </script>

    <script>
        $(document).ready(function(){
            $("#form").on('submit',function(){

                if($("#from_date").val() > $("#to_date").val()){
                    alert("From date must be less than to date!");
                    return false;
                }
            });
        });
    </script>