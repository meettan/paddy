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
                action="<?php echo site_url("report/weekdlv");?>" >

                <div class="form-header">
                
                    <h4>Weekly Delivery Report</h4>
                
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

                  <label for="dist" class="col-sm-2 col-form-label">District:</label>

              <div class="col-sm-10">

              <select name="dist" id="dist" class="form-control required">
               <option value="">Select</option>  
                      <?php foreach($dists as $dist)  { ?>  
                      <option value="<?php if(isset($dist->district_code)){echo $dist->district_code;}?>"><?php if(isset($dist->district_name)){echo $dist->district_name;}?></option> 
                 <?php } ?>   
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

                        <h2>The West Bengal State Co-operative Marketing Federation Ltd.</h2>

                        <h4>Southend Conclave, 3rd Floor,1582 Rajdanga Main Road,Kolkata - 700 107.</h4>

                        <h4>Weekly Delivery Report Between <?php echo date("d-m-Y", strtotime($this->input->post('from_date'))).' To '.date("d-m-Y", strtotime($this->input->post('to_date')));?></h4>

                    </div>
                    
                    <br>
                     <div class="col-md-12" >  
                        <div class="col-md-3">
                        <label>Branch name:</label><?php echo get_district_name($this->input->post("dist")) ?>
                    </div>
                   </div>
                    <table style="width: 100%;" id="example" >
                        <thead>
                            <tr>
                                <th>Sl No.</th>
                                <th>Delivery Date</th>
                                <th>Delivery In State (MT)</th> 
                                <th>Delivery In FCI (MT)</th>
                            </tr>
                        </thead>

                        <tbody>

                            <?php

                                if($delv){ 

                                    $i = 1;
                                    $tot_state = 0;
                                    $tot_central = 0;  
                                  
                                    foreach($delv as $soc){

                            ?>

                                <tr>
                                     <td><?php echo $i++; ?></td>               <!--sl no-->
                                     <td><?php echo date('d/m/Y',strtotime($soc->delivery_dt)); ?></td>   <!--Delivery Date-->
                                     <td><?php 
                                               echo $soc->state; 
                                               $tot_state += $soc->state;
                                         ?>
                                     </td> 
                                     <td><?php 
                                               echo $soc->central; 
                                               $tot_central += $soc->central;
                                         ?>
                                     </td>
                                </tr>
                               
                                <?php }  ?>
                                <tr><td colspan="2" style="text-align: center;">Total</td>
                                <td><?=$tot_state?></td>
                                <td><?=$tot_central?></td>
                                </tr>

                            <?php        }
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
                    filename: "Weekly Delivery Report Between <?php echo date("d-m-Y", strtotime($this->input->post('from_date'))).' To '.date("d-m-Y", strtotime($this->input->post('to_date')));?>.xls"
                });
            });
        });
    </script>
