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
        WindowObject.document.writeln('<html><head><meta http-equiv="Content-Type" content="text/html; charset=utf-8"><title></title><style type="text/css">');


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
    
            <form method="POST" id="form" action="<?php echo site_url("report/returncheque");?>" >

                <div class="form-header">
                
                    <h4>Branchwise Return Cheque</h4>
                
                </div>

                <div class="form-group row">

                    <label for="from_date" class="col-sm-2 col-form-label">From Date:</label>

                    <div class="col-sm-10">

                        <input type="date"
                               name="from_date"
                               class="form-control required"
                               value="<?php echo $sys_date;?>"
                        />

                    </div>

                </div>

                <div class="form-group row">

                    <label for="to_date" class="col-sm-2 col-form-label">To Date:</label>

                    <div class="col-sm-10">

                        <input type="date"
                               name="to_date"
                               class="form-control required"
                               value="<?php echo $sys_date;?>"
                            />

                    </div>

                </div>

                 <div class="form-group row"> 

                    <label for="f_payment_cheque" class="col-sm-2 col-form-label">Branch:</label>
                    <div class="col-sm-10">
                    <select name="branch_id" id="branch_id" class="form-control required">
                    <option value="">Select</option>
                    <?php

                        foreach($branches as $branch){

                    ?>
                        <option value="<?php echo $branch->id;?>"><?php echo $branch->branch_name;?></option>
                    <?php

                        }
                    ?>     
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

            <div class="col-lg-12 container contant-wraper">
                
                <div id="divToPrint">

                    <div style="text-align:center;">

                        <h2>THE WEST BENGAL STATE CO.OP.MARKETING FEDERATION LTD.</h2>
                        <h4>HEAD OFFICE: SOUTHEND CONCLAVE, 3RD FLOOR, 1582 RAJDANGA MAIN ROAD, KOLKATA-700107.</h4>
                        <h4>Cheque Return for paddy procurement between <?php echo date("d-m-Y", strtotime($this->input->post('from_date'))).' To '.date("d-m-Y", strtotime($this->input->post('to_date')));?></h4>
                        <h4> <label>Branch name:</label>  <?php echo get_district_name($this->input->post("branch_id")) ?></h4>

                    </div>
                    <br>  


                     <table class="table table-bordered table-hover" id="example">

                <thead>

                    <tr>
                    
                        <th width="25px">Sl. No</th>
                        <th>Cheque No</th>
                        <th>Date</th>
                        <th>Society</th>
                        <th>Farmer' Name</th>
                        <th>Bank</th>
                        <th>Transaction Dt</th>        
                        <th>Quantity</th>
                        <th width="50px">Amount</th>
                    </tr>

                </thead>

                <tbody> 

                <?php 
                   if(isset($chequedetails)){

                   $count=0;
                   $amount = 0.00;
                   foreach($chequedetails as $padl_dtl)
                        {
                       ?>
                        <tr>
              
                          <td ><?php echo ++$count; ?></td>
                           <td ><?php echo $padl_dtl->chq_no; ?></td>
                            <td ><?php echo date('d/m/Y',strtotime($padl_dtl->trans_dt)) ?></td>
                          
                            <td ><?php echo $padl_dtl->soc_name; ?></td>
                            <td ><?php  $kms_id = $this->session->userdata['loggedin']['kms_id'];
                                  echo get_farmer_name($kms_id,$padl_dtl->reg_no);

                             ?></td>
                            <td ><?php  if($padl_dtl->bank_id == 1){
                                               echo "Yes Bank"; 
                                         }elseif($padl_dtl->bank_id == 2){
                                               echo "Bandhan Bank";  
                                         }else{
                                             echo "Icici Bank";
                                         } 
                                 ?>
                            </td>
                            <td ><?php echo date('d/m/Y',strtotime($padl_dtl->trans_dt)); ?></td>
                            <td ><?php echo $padl_dtl->tot_qty; ?></td>
                            <td ><?php echo $padl_dtl->tot_amt; 
                                            $amount += $padl_dtl->tot_amt;

                            ?></td>
                            
                          
                    
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
                    
                    <td colspan="8" style="text-align:center">Total</td><td><?=$amount?></td>
                        
                        
                    </tr>
                
                </tfoot>

            </table>

                    <!--<div  class="bottom">
                        
                        <p style="display: inline;">Prepared By</p>

                        <p style="display: inline; margin-left: 8%;">Establishment, Sr. Asstt.</p>

                        <p style="display: inline; margin-left: 8%;">Assistant Manager-II</p>

                        <p style="display: inline; margin-left: 8%;">Chief Executive officer</p>

                    </div>-->

                </div>   
                
                <div style="text-align: center;">

                    <button class="btn btn-primary" type="button" onclick="printDiv();">Print</button>
                    <button class="btn btn-primary" type="button" id="btnExport">Excel</button>

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
                    filename: "Return Cheque for <?php echo get_district_name($this->input->post("branch_id")) ?> branch for paddy procurement between Block Societywise Paddy Procurement Between <?php echo date("d-m-Y", strtotime($this->input->post('from_date'))).' To '.date("d-m-Y", strtotime($this->input->post('to_date')));?>.xls"
                });
            });
        });
    </script>