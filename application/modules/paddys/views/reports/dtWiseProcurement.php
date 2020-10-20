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
                action="<?php echo site_url("paddy/datewiseprocurement/report");?>" >

                <div class="form-header">
                
                    <h4>District Wise Paddy Report</h4>
                
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

                        <h3>WEST BENGAL STATE CONSUMERS' CO-OPERATIVE FEDERATION LTD.</h3>

                        <h3>P-1, Hide Lane, Akbar Mansion, 3rd Floor, Kolkata-700073</h3>

                        <h3>District Wise Paddy Procurement Report From <?php echo date("d-m-Y", strtotime($this->input->post('from_date'))).' - '.date("d-m-Y", strtotime($this->input->post('to_date')));?></h3>

                    </div>
                    

                    <br>  

                    <table style="width: 100%;">

                        <thead>

                            <tr>
                            
                                <th>Sl No.</th>

                                <th>District</th>

                                <th style="width: 25%">Name of Society</th>

                                <th>Total Farmers (Registered)</th>

                                <th>Total No Of Camp</th>
                                
                                <th>Total No of Farmers</th>

                                <th>Progressive of Paddy Procurement (QT)</th>

                                <th style="width: 25%">Name of the Rice Mill</th>

                                <th>Total quantity of paddy delivered to Rice Mill as per Receipt (QT)</th>

                                <th>Cost of Paddy Rs. 1750/- per quintal</th>

                            </tr>

                        </thead>

                        <tbody>

                            <?php

                                if($dist_dtls){

                                    //For Sl No.
                                    $i = $k = 1;
                                    
                                    foreach($dist_dtls as $d_list){

                                        $j = 1;
                            ?>

                                        <tr>

                                            <td rowspan="<?php echo $d_list->count; ?>"><?php echo $i++; ?></td>
                                            <td rowspan="<?php echo $d_list->count; ?>"><?php echo $d_list->district_name; ?></td>

                                        
                                            <?php

                                                foreach($soc_dtls as $s_list => $s_val){
                                                    
                                                    if(($s_val->dist == $d_list->dist) && ($j == 1)){
                                                                                                     
                                                        
                                                ?>

                                                        <td rowspan="<?php echo $s_val->count; ?>"><?php echo $s_val->soc_name; ?></td>
                                                        <td rowspan="<?php echo $s_val->count; ?>"><?php echo $s_val->farmer_no; ?></td>
                                                        <td rowspan="<?php echo $s_val->count; ?>"><?php echo $s_val->no_of_camp; ?></td>
                                                        <td rowspan="<?php echo $s_val->count; ?>"><?php echo $s_val->no_of_farmer; ?></td>
                                                        <td rowspan="<?php echo $s_val->count; ?>"><?php echo $s_val->paddy_qty; ?></td>
                                                        <?php
                                                            $k = 1;  
                                                            foreach($mill_dtls as $m_dtls => $m_val){
                                                                                                           
                                                                if(($m_val->soc_id == $s_val->soc_id) && ($k == 1)){
                                                                      
                                                            ?>

                                                                    <td><?php echo $m_val->mill_name; ?></td>
                                                                    <td><?php echo $m_val->count; ?></td>
                                                                    <td><?php echo $m_val->count * 1750; ?></td>
                                                                    
                                                                </tr>
                                                                
                                                            <?php  
                                                                    
                                                                    $k++;

                                                                }
                                                                
                                                                else if($m_val->soc_id == $s_val->soc_id){
                                                                                                                   
                                                            ?>

                                                                <tr>

                                                                    <td><?php echo $m_val->mill_name; ?></td>
                                                                    <td><?php echo $m_val->count; ?></td>
                                                                    <td><?php echo $m_val->count * 1750; ?></td>
                                                                    
                                                                </tr>
                                                                
                                                            <?php  

                                                                    
                                                                }

                                                            }

                                                        $j++;
                                                        
                                                    }
                                                    else if($s_val->dist == $d_list->dist){
                                                                                                      
                                                        
                                                    ?>
                                                    <tr>
                                                        <td rowspan="<?php echo $s_val->count; ?>"><?php echo $s_val->soc_name; ?></td>
                                                        <td rowspan="<?php echo $s_val->count; ?>"><?php echo $s_val->farmer_no; ?></td>
                                                        <td rowspan="<?php echo $s_val->count; ?>"><?php echo $s_val->no_of_camp; ?></td>
                                                        <td rowspan="<?php echo $s_val->count; ?>"><?php echo $s_val->no_of_farmer; ?></td>
                                                        <td rowspan="<?php echo $s_val->count; ?>"><?php echo $s_val->paddy_qty; ?></td>
                                                    
                                                    <?php

                                                        $k = 1; 
                                                        foreach($mill_dtls as $m_dtls => $m_val){
                                                                                              
                                                            if(($m_val->soc_id == $s_val->soc_id) && ($k == 1)){
                                                                
                                                            ?>

                                                                    <td><?php echo $m_val->mill_name; ?></td>
                                                                    <td><?php echo $m_val->count; ?></td>
                                                                    <td><?php echo $m_val->count * 1750; ?></td>
                                                                    
                                                                </tr>
                                                                
                                                            <?php  
                                              
                                                                    $k++;

                                                            }
                                                            else if($m_val->soc_id == $s_val->soc_id){
                                                                                                                        
                                                            ?>

                                                                <tr>

                                                                    <td><?php echo $m_val->mill_name; ?></td>
                                                                    <td><?php echo $m_val->count; ?></td>
                                                                    <td><?php echo $m_val->count * 1750; ?></td>
                                                                    
                                                                </tr>
                                                                
                                                            <?php  
                                                        
                                                            }

                                                        }

                                                    }

                                                }
                                        }
                                        
                                    }
                                    else{

                                        echo "<tr><td colspan='14' style='text-align:center;'>No Data Found</td></tr>";

                                    }   

                            ?>

                        </tbody>

                    </table>

                    <div  class="bottom">
                        
                        <p style="display: inline;">Prepared By</p>

                        <p style="display: inline; margin-left: 8%;">Establishment, Sr. Asstt.</p>

                        <p style="display: inline; margin-left: 8%;">Assistant Manager-II</p>

                        <p style="display: inline; margin-left: 8%;">Chief Executive officer</p>

                    </div>

                </div>   
                
                <div style="text-align: center;">

                    <button class="btn btn-primary" type="button" onclick="printDiv();">Print</button>

                </div>

            </div>
            
        </div>
        
    <?php

    }

    ?> 