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

    
    <div class="wraper">      

        <div class="col-md-6 container form-wraper">
    
           <!--  <form method="POST" id="form" action="<?php echo site_url("report/chequestatus");?>" > -->

                 <form method="POST" id="form" action="<?php echo site_url("report/chequestatus_excel");?>" >

                <div class="form-header">
                
                    <h4>Branchwise Cheque Report</h4>
                
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
             <?php if($this->session->userdata['loggedin']['ho_flag']=="Y") { ?>

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

              <?php }else{ ?>

                <input type="hidden" name="branch_id" class="form-control"
                               value="<?php echo $this->session->userdata['loggedin']['branch_id'];?>" />

                        <select name="br_id" id="bra_id" class="form-control required" disabled>
                    <option value="">Select</option>
                    <?php
                        foreach($branches as $branch){
                    ?>
                        <option value="<?php echo $branch->id;?>"  <?php if($branch->id == $this->session->userdata['loggedin']['branch_id']) echo "selected"; ?>><?php echo $branch->branch_name;?></option>
                    <?php

                        }
                    ?>     
                   </select>

                     <?php } ?>

                </div>
              </div>
              <div class="form-group row"> 

                    <label for="f_payment_cheque" class="col-sm-2 col-form-label">Bank:</label>
                    <div class="col-sm-10">
                   <select name="bnk" id="bnk" class="form-control" required>
                            <option value="">Select</option>  
                            <option value="1">Yes Bank</option>
                            <option value="2">Bandhan Bank</option>
                            <option value="3">ICICI Bank</option>
                            <option value="4">Axis Bank</option> 
                            <option value="5">Hdfc Bank</option>       
                        </select>
                </div>
              </div>


                <div class="form-group row">

                    <div class="col-sm-10">

                        <input type="submit" class="btn btn-info" value="Download" />

                    </div>

                </div>

            </form>    

        </div>

    </div>       
        
   
    <script type="text/javascript">
        $(function () {
            $("#btnExport").click(function () {
                $("#example").table2excel({
                    filename: "Cheque status for <?php echo get_district_name($this->input->post("branch_id")) ?> branch for paddy procurement between Block Societywise Paddy Procurement Between <?php echo date("d-m-Y", strtotime($this->input->post('from_date'))).' To '.date("d-m-Y", strtotime($this->input->post('to_date')));?>.xls"
                });
            });
        });
    </script>