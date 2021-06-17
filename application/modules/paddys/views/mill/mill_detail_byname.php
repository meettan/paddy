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


      
    <div class="wraper">      

        <div class="col-md-12 container contant-wraper">
    
          
                <div class="form-header">
                
                    <h4>Mill Name</h4>
                
                </div>

                <div class="form-group row">

                    <label for="from_date" class="col-sm-2 col-form-label">Mill Name:</label>

                    <div class="col-sm-8">

          <input type="text" id="mill_name"
                            name="mill_name" class="form-control required" value=""/>
                    </div>
                     <div class="col-sm-1">
                        <button class="btn btn-primary" id="ssearch" type="button" >Seaech</button>
                       </div>
                </div>

             <div style="text-align:center;">
  
                        <h2>Mill Detail</h2>

                </div>
                  <table style="width: 100%;">

                        <thead>
                            <tr>
                                <th style="width: 15%">Name </th>
                               
                                <th>District</th>
                                 <th>Block</th>
                                 <th>Ph Number</th>
                                <th>Pan No</th>
                             

                            </tr>
                        </thead>
                        <tbody id="society_detail">
                               
                     
                        </tbody>
                          <tfoot>

                   <tr>
                                <th style="width: 15%">Name </th>
                               
                                <th>District</th>
                                 <th>Block</th>
                                 <th>Ph Number</th>
                                <th>Pan No</th>
                              

                            </tr>
                </tfoot>
                       
                    </table>  
                    <br>
        </div>

    </div>  

    <script>
     

        var i = 0;

        $('#ssearch').click(function(){

              var mill_name = $.trim($('#mill_name').val());
            if(mill_name.length == 0){

                alert("Please Enter at least one suggested Word");

            }else{

            $.post( 

                '<?php echo site_url("add_new/milldetailbyname");?>',

                { 

                    mill_name: $('#mill_name').val()

                }

            ).done(function(data){

                var string = '<tr>';

                $.each(JSON.parse(data), function( index, value ) {

                    string += '<td style="text-align:center;"> '+ value.mill_name + '</td><td style="text-align:center;"> '+ value.district_name + '</td><td style="text-align:center;"> '+ value.block_name + '</td><td style="text-align:center;"> '+ value.ph_no + '</td><td style="text-align:center;"> '+ value.pan_no + '</td></tr>'

                });

                $('#society_detail').html(string);

            });

          }

        });

       

   
    </script>        