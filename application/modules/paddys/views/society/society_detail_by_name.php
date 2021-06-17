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

        <div class="col-md-12 container contant-wraper">
    
          
                <div class="form-header">
                
                    <h4>Society Name</h4>
                
                </div>

                <div class="form-group row">

                    <label for="from_date" class="col-sm-2 col-form-label">Society Name:</label>

                    <div class="col-sm-8">

          <input type="text" id="soc_name"
                            name="soc_name" class="form-control required" value=""/>
                    </div>
                     <div class="col-sm-1">
                        <button class="btn btn-primary" id="ssearch" type="button" >Seaech</button>
                       </div>
                </div>

             <div style="text-align:center;">
  
                        <h2>Society Detail</h2>

                </div>
                  <table style="width: 100%;">

                        <thead>
                            <tr>
                                <th style="width: 15%">Name </th>
                                <th>Incharge Name</th>
                                <th>District</th>
                                 <th>Block</th>
                                 <th>Ph Number</th>
                                <th>Pan No</th>
                               <th>Aggrement No</th>

                            </tr>
                        </thead>
                        <tbody id="society_detail">
                               
                     
                        </tbody>
                          <tfoot>

                   <tr>
                                <th style="width: 15%">Name </th>
                                <th>Incharge Name</th>
                                <th>District</th>
                                 <th>Block</th>
                                 <th>Ph Number</th>
                                <th>Pan No</th>
                               <th>Aggrement No</th>

                            </tr>
                </tfoot>
                       
                    </table>  
                    <br>
        </div>

    </div>  
    <script>
     

        var i = 0;

        $('#ssearch').click(function(){

              var soc_name = $.trim($('#soc_name').val());
            if(soc_name.length == 0){

                alert("Please Enter at least one suggested Word");

            }else{

            $.post( 

                '<?php echo site_url("add_new/societydetailbyname");?>',

                { 

                    soc_name: $('#soc_name').val()

                }

            ).done(function(data){

                var string = '<tr>';

                $.each(JSON.parse(data), function( index, value ) {

                    string += '<td style="text-align:center;"> '+ value.soc_name + '</td><td style="text-align:center;"> '+ value.inchargename + '</td><td style="text-align:center;"> '+ value.district_name + '</td><td style="text-align:center;"> '+ value.block_name + '</td><td style="text-align:center;"> '+ value.ph_no + '</td><td style="text-align:center;"> '+ value.pan_no + '</td><td style="text-align:center;"> '+ value.agreementno + '</td></tr>'

                });

                $('#society_detail').html(string);

            });

          }

        });

       

   
    </script>        