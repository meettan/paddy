<style>
table {
    border-collapse: collapse;
}

table, td, th {
    border: 1px solid #dddddd;

    padding: 6px 5px;

    font-size: 14px;

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
                action="<?php echo site_url("report/neftRet");?>" >

                <div class="form-header">
                
                    <h4>List of Returned NEFT</h4>
                
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
                
                  <?php   if($this->session->userdata['loggedin']['ho_flag'] == "Y" ) {  ?>

                  <div class="form-group row">

                <label for="block" class="col-sm-2 col-form-label">District:</label>

               <div class="col-sm-10">

               <select name="dist" id="dist" class="form-control" required>
               <option value="">Select</option>  
                      <?php foreach($dists as $dist)  { ?>  
                      <option value="<?php if(isset($dist->district_code)){echo $dist->district_code;}?>"><?php if(isset($dist->district_name)){echo $dist->district_name;}?></option> 
                 <?php } ?>   
               </select>
                </div>
                </div>
          <?php   }  ?>

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

      //foreach($neftDtls as $neft);
        
    ?>

        <div class="wraper"> 

            <div class="col-lg-12 container contant-wraper">
                
                <div id="divToPrint">

                    <div class="printHeaderNew">
                        <div class="col-sm-3 float-left logoCustom"><img src="<?php echo base_url("/benfed.png");?>"/></div>
                        <div class="col-sm-9 float-left logoTextSecRight">
                            <h2>The West Bengal State Co-operative Marketing Federation Ltd.<span>Southend Conclave, 3rd Floor,1582 Rajdanga Main Road,Kolkata - 700 107.</span></h2>
                            <h3>Districtwise List of Return NEFT Between <?php echo date("d-m-Y", strtotime($this->input->post('from_date'))).' To '.date("d-m-Y", strtotime($this->input->post('to_date')));?></h3>
                        </div>
                    </div>

                    <br>  

                    <div class="col-md-12" >  
                        <div class="col-md-3">
                        <label>Branch name:</label>  <?php   if($this->session->userdata['loggedin']['ho_flag'] == "Y" ) {

                                    echo get_district_name($this->input->post('dist'));

                             }else{

                               if(isset($this->session->userdata['loggedin']['branch_name'])){ echo $this->session->userdata['loggedin']['branch_name'];}
                            }
                         ?>
                    </div>

                   </div>

                    <table style="width: 100%;" id="example">

                        <thead>

                            <tr>
                            
                                <th>Sl No.</th>

                                <th>Procurement Date</th>

                                <th>Payment Date</th>

                                <th>Society</th>

                                <th>Registration No.</th>

                                <th>Beneficiary Name</th>

                                <th>IFS Code</th>
                                
                                <th>A/C No.</th>
                                
                                <th>Amount</th>
                                
                                <th>Remarks</th>
            
                            </tr>

                        </thead>

                        <tbody>

                            <?php

                                if($neftDtls){ 

                                  $i = 1;
                                  $tot_amt = 0;

                                    foreach($neftDtls as $neft){

                            ?>

                                <tr>
                                     <td><?php echo $i++; ?></td>
                                     <td><?php echo date('d/m/Y',strtotime($neft->procurement_dt)); ?></td>
                                     <td><?php echo date('d/m/Y',strtotime($neft->payment_dt)); ?></td>
                                     <td><?php echo $neft->soc_name; ?></td>
                                     <td><?php echo $neft->reg_no; ?></td>
                                     <td><?php echo $neft->benf_name; ?></td>
                                     <td><?php echo $neft->ifsc; ?></td>
                                     <td><?php echo $neft->benf_ac_no; ?></td>
                                     <td><?php 
                                                echo $neft->amount; 

                                                $tot_amt += $neft->amount;
                                         ?>
                                     </td>
                                     <td><?php echo $neft->return_remarks; ?></td>
                                </tr>

 
                                <?php        
                                    } 
                                ?>

                                <tr>
                                    <td colspan="2" style="text-align:center;font-weight: bold;">Total</td>
                                    <td></td> 
                                    <td></td>
                                    <td></td>
                                    <td></td>
                                    <td></td>
                                    <td></td>
                                    <td style="text-align:center;font-weight: bold;"><?=$tot_amt?></td>
                                    <td></td>
                                </tr>
                                    
                                <?php }else{
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
                    filename: "Districtwise List of Return NEFT Between <?php echo date("d-m-Y", strtotime($this->input->post('from_date'))).' To '.date("d-m-Y", strtotime($this->input->post('to_date')));?>.xls"
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