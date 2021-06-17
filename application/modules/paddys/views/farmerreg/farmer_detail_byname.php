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

        <div class="col-md-12 container form-wraper">

                <div class="form-header">
                
                    <h4>Farmer Detail</h4>
                
                </div>

                <div class="form-group row">

                    <label for="from_date" class="col-sm-2 col-form-label">Farmer Name:</label>

                    <div class="col-sm-8">

                        <input type="text" id="farm_name"
                               name="farm_name"
                               class="form-control required"
                               value=""/>

                    </div>
                    <div class="col-sm-2">

                        <input type="button" class="btn btn-info" id="ssearch"value="Proceed" />

                    </div>

                </div>


        

                    <div style="text-align:center;">
  
                        <h2>Farmer Detail</h2>
                    </div>

                    <br>  
                  
                    <table style="width: 100%;">

                        <thead>

                            <tr>
                                <th style="width: 10%">Name </th>
                                <th>Father/Mother/Spouse</th>
                                <th>Relation</th>
                                <th>District</th>
                                 <th>Block</th>
                                <th>Epic no</th>
                                <th>Account No</th>
                                <th>Ifsc Code</th>
                                <th>Land Holding</th>
                                <th>Land Description</th>
                                <th>Farmer Type</th>
                            </tr>

                        </thead>

                        <tbody id="farmer_detail">

                            
 
                        </tbody>

                    </table>

                     
 
       </br>

        </div>

    </div>        
<script>
     

        var i = 0;

        $('#ssearch').click(function(){

              var farm_name = $.trim($('#farm_name').val());
            if(farm_name.length == 0){

                alert("Please Enter at least one suggested Word");

            }else{

            $.post( 

                '<?php echo site_url("add_new/farmersearchbyname");?>',

                { 

                    farm_name: $('#farm_name').val()

                }

            ).done(function(data){

                var string = '<tr>';

                $.each(JSON.parse(data), function( index, value ) {

                    string += '<td style="text-align:center;"> '+ value.farm_name + '</td><td style="text-align:center;"> '+ value.father_name + '</td><td style="text-align:center;"> '+ value.relation + '</td><td style="text-align:center;"> '+ value.district_name + '</td><td style="text-align:center;"> '+ value.block_name + '</td><td style="text-align:center;"> '+ value.epic_no + '</td><td style="text-align:center;"> '+ value.account_no + '</td><td style="text-align:center;"> '+ value.ifsc_code + '</td><td style="text-align:center;"> '+ value.land_holding + '</td></td><td style="text-align:center;"> '+ value.land_description + '</td></td><td style="text-align:center;"> '+ value.farmer_type + '</td></tr>'

                });

                $('#farmer_detail').html(string);

            });

          }

        });

       

   
    </script>         
            
       