    <div class="wraper">      
        <div class="col-md-3"></div>
        <div class="col-md-6 container form-wraper">   

            <form method="POST" action="<?php echo site_url("paddys/add_new/f_society_mill_edit");?>">

                <div class="form-header">
                
                    <h4>Society Mill Tagging Edit</h4>
                
                </div>
                <input type="hidden" name= "societyid" id="sl_no" value="<?php echo $soc_mills->soc_id;?>"/>
                <input type="hidden" name= "millid" id="sl_no" value="<?php echo $soc_mills->mill_id;?>"/>

                    <div class="form-group row">

                            <label for="dist" class="col-sm-4 col-form-label">Society Name:</label>

                            <div class="col-sm-8">

                            <select name="soc_id" class="form-control required">

                                <option value="">Select</option>

                                <?php
                                    foreach($society as $societ){
                                ?>
                                    <option value="<?php echo $societ->sl_no;?>" <?php if($societ->sl_no==$soc_mills->soc_id) {echo "selected" ;}?> ><?php echo $societ->soc_name;?></option>

                                <?php  }       ?>     

                            </select>

                            </div>

                            </div> 
                            <div class="form-group row">

                                <label for="dist" class="col-sm-4 col-form-label">Mill Name:</label>

                                <div class="col-sm-8">

                                <select name="mill_id" class="form-control required">

                                <option value="">Select</option>

                                <?php

                                    foreach($mills as $mill){

                                ?>
                                <option value="<?php echo $mill->sl_no;?>" <?php if($mill->sl_no==$soc_mills->mill_id) {echo "selected" ;}?>><?php echo $mill->mill_name;?></option>
                                <?php

                                        }

                                        ?>     

                                        </select>

                            </div>

                                </div> 


                            <div class="form-group row">

                            <label for="name" class="col-sm-4 col-form-label">Distance(K.M):</label>

                            <div class="col-sm-8">

                            <input type="text" class="form-control" name="distance" id="name" value="<?php if(isset($soc_mills->distance)){ echo "$soc_mills->distance";}?>" />

                            </div>

                            </div>  
                            <div class="form-group row">

                            <label for="name" class="col-sm-4 col-form-label">Tripartite Agreement Number:</label>

                            <div class="col-sm-8">

                                    <input type="text" class="form-control" name="reg_no" id="reg_no" value="<?php if(isset($soc_mills->reg_no)){ echo "$soc_mills->reg_no";}?>" />

                            </div>
                            </div>  
                            <div class="form-group row">

                            <label for="name" class="col-sm-4 col-form-label">Target(Quintal):</label>

                            <div class="col-sm-8">

                                    <input type="text" class="form-control" name="target" id="target" value="<?php if(isset($soc_mills->target)){ echo "$soc_mills->target";}?>" />

                            </div>
                            </div>

                <div class="form-group row">

                    <div class="col-sm-10">

                        <button type="submit" class="btn btn-info">Save</button>

                    </div>

                </div>

            </form>

        </div>

    </div>    