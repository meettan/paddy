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
                action="<?php echo site_url("report/socyIncPay");?>" >

                <div class="form-header">
                
                    <h4>Societywise Incidental Payment</h4>
                
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
                            <h3>Societywise Incidental Payment Between <?php echo date("d-m-Y", strtotime($this->input->post('from_date'))).' To '.date("d-m-Y", strtotime($this->input->post('to_date')));?></h3>
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

                                <th style="width: 25%">Society</th>

                                <th>Quantity of Paddy(Qnt)</th>

                                <th>Quantity of CMR(Qnt)</th>

                                <th>Gross Amount(Rs)</th>

                                <th>TDS(Rs)</th>

                                <th>Net Amount(Rs)</th>

                            </tr>

                        </thead>

                        <tbody>

                            <?php

                                if($procDtls){ 

                                    $i = 1;
                                 
                                    $tot_proc = 0;
                                    $tot_cmr  = 0;
                                    $tot_soc_comm = 0;
                                    $tot_tds_amt  = 0; 
                                    $tot_paid_amt = 0;
                                  
                                    foreach($procDtls as $proc){

                            ?>

                                <tr>
                                     <td><?php echo $i++; ?></td>

                                     <td><?php echo $proc->soc_name; ?></td>


                                     <td><?php echo $proc->qty;                     //Quantity of paddy purchased
                                               $tot_proc += $proc->qty;
                                         ?>
                                     </td>

                                     <td><?php echo $proc->cmr;                     //total CMR
                                               $tot_cmr += $proc->cmr;
                                          ?>
                                     </td>

                                     <td><?php
                                                foreach($comm as $commDtls){           //Society Commission
                                                    if($commDtls->soc_id == $proc->soc_id){
                                                         echo $commDtls->soc_comm;
                                                         $tot_soc_comm +=$commDtls->soc_comm;
                                                    }
                                                }   
                                         ?> 
                                     </td>
                                     
                                     <td>
                                        <?php
                                               foreach($comm as $commDtls){           //TDS Amount
                                                    if($commDtls->soc_id == $proc->soc_id){
                                                        echo $commDtls->tds_amt;
                                                        $tot_tds_amt +=$commDtls->tds_amt;
                                                    }
                                                }   
                                         ?>
                                     </td>
                                      
                                     <td>
                                        <?php
                                                  foreach($comm as $commDtls){           //Paid Amount
                                                    if($commDtls->soc_id == $proc->soc_id){
                                                        echo $commDtls->paid_amt;
                                                        $tot_paid_amt +=$commDtls->paid_amt;
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
                                        <td style="text-align:center;font-weight: bold;"><?=$tot_soc_comm?></td>
                                        <td style="text-align:center;font-weight: bold;"><?=$tot_tds_amt?></td>
                                        <td style="text-align:center;font-weight: bold;"><?=$tot_paid_amt?></td>
                                 
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
                    filename: "Societywise Incidental Payment Between <?php echo date("d-m-Y", strtotime($this->input->post('from_date'))).' To '.date("d-m-Y", strtotime($this->input->post('to_date')));?>.xls"
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