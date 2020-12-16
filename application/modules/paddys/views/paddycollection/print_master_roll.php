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



        <div class="wraper"> 

            <div class="col-lg-12 container contant-wraper">
                
                <div id="divToPrint">

                <div  style="text-align:center";>
      <h4 >MUSTER ROLL FOR PURCHASE OF PADDY FOR KMS 2019-20</h4>
     </div>
     <?php  foreach($farmer_dtls as $farme);?>
    <div style="width:100%;">
    <span style="display:inline;width:27%;float:left;padding-top:10px;padding-bottom:10px;">NAME OF CMR AGENCY:</span>  
    <span style="display:inline;width:73%;float:left;padding-top:10px;padding-bottom:10px;">The West Bengal State Cooperative Marketing Federation Ltd. (BENFED)</span>
    <br clear="all">
    <span style="display:inline;width:27%;float:left;padding-top:5px;padding-bottom:10px;">NAME OF COOPERATIVE SOCIETY:</span>
    <span style="display:inline;width:55%;float:left;padding-top:5px;padding-bottom:10px;"><?php if(isset($farme->soc_name)){ echo $farme->soc_name; }?></span>
    <span style="display:inline;width:18%;float:left;padding-top:5px;padding-bottom:10px;"><b>Muster Roll No:</b><?php if(isset($farme->muster_roll_no)){ echo $farme->muster_roll_no; }?></span>
<br clear="all">
    <span style="display:inline;width:27%;float:left;padding-top:5px;padding-bottom:10px;">PLACE OF PURCHASE:</span>
    <span style="display:inline;width:55%;float:left;padding-top:5px;padding-bottom:10px;"><?php if(isset($farme->soc_name)){ echo $farme->soc_name; }?>  </span>
    <span style="display:inline;width:18%;float:left;padding-top:5px;padding-bottom:10px;"> <b>Block</b>:<?php if(isset($farme->block_name)){ echo $farme->block_name; }?></span>

    <span style="display:inline;width:27%;float:left;padding-top:5px;padding-bottom:15px;">DATE OF PURCHASE:</span>
    <span style="display:inline;width:73%;float:left;padding-top:5px;padding-bottom:15px;"><?php echo date('d/m/Y',strtotime($farme->trans_dt)); ?></span> 
    <span style="display:inline;width:27%;float:left;padding-top:5px;padding-bottom:15px;">Name of Rice Mill:</span>
    <span style="display:inline;width:73%;float:left;padding-top:5px;padding-bottom:15px;"><?php if(isset($farme->mill_id)){ echo get_mill_name($farme->mill_id); }?></span>     
    
 </div>
        
                    

                    <br>  

                    <table style="width: 100%;">

                        <thead>

                            <tr>
                            
                                <th>Sl No.</th>

                                <th style="width:250px;">Name</th>
            <th style="width:100px;">Address with PIN Code</th>
            <th style="width:300px;">Registration No.</th>
            <th style="width:100px;">EPIC/ Other Photo I.D. Particulars.</th>
            <th style="width:100px;">Quantity of Paddy purchased (Quintal)</th>
            <th style="width:100px;">Total amount paid @ Rs.  1815/- per Quintal</th>
            <th style="width:100px;">Cheque Number</th>
            <th style="width:100px;">Cheque date</th>
            <th style="width:300px;">Signature of Seller-Farmer</th>

                            </tr>

                        </thead>

                        <tbody>

                            <?php

                                if($farmer_dtls){ 

                                    $i = 1;
                                foreach($farmer_dtls as $farmer_dtl) {         
                                      ?>

                                <tr>
                                     <td><?php echo $i++; ?></td>
                                     <td><?=get_farmer_name($this->session->userdata['loggedin']['kms_id'],$farmer_dtl->reg_no)?></td>
                                    <td><?=$farmer_dtl->address?> <?=$farmer_dtl->pin_no?></td>
                                    <td><?=$farmer_dtl->reg_no?></td>
                                    <td><?=$farmer_dtl->epic_no?></td>
                                    <td><?=$farmer_dtl->quantity?> </td>
                                    <td><?=$farmer_dtl->amount?></td>
                                    <td><?=$farmer_dtl->cheque_no?></td>
                                    <td><?php echo date('d/m/Y',strtotime($farmer_dtl->cheque_date)); ?></td>
                                    <td></td>
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

                    <div style="margin-top:30px;">
                        
                        <p style="display: inline;width:25%;float:left;">Signature of Inspector of Co-operative Societies/ Sub-Inspector/Inspector, Food & Supplies dept.</p>

                        <p style="display: inline; width:16%;float:left;margin-left: 8%;">Signature of Representative of CMR Agency (BENFED)</p>

                        <p style="display: inline; width:16%;float:left;margin-left: 8%;">Signature of authorized representative of Rice Mill</p>

                        <p style="display: inline;width:16%;float:left; margin-left: 8%;">Signature of Representative of Cooperative Society</p>

                    </div>

                </div>   
                
                <div style="text-align: center;">

                    <button class="btn btn-primary" type="button" onclick="printDiv();">Print</button>

                </div>

            </div>
            
        </div>
        
   