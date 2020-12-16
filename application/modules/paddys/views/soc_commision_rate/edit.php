    <div class="wraper">      

        <div class="col-md-6 container form-wraper">   

            <form method="POST" action="<?php echo site_url("add_new/soccom/edit");?>" >

                <div class="form-header">
                
                    <h4>Rice Rate Edit</h4>
                
                </div>

                <input type="hidden" name="id" id="id"  value="<?php echo $rate_dtls->id;?>"/>

                <div class="form-group row">
               
               <label for="name" class="col-sm-2 col-form-label">Rice Type Date:</label>

               <div class="col-sm-4">

                   <select name="rice_type" class="form-control required">
                        <option value="">Select</option>
                        <option value="P" <?php if(isset($rate_dtls->rice_type) && ($rate_dtls->rice_type=="P")){ echo "selected" ;} ?>>Boiled Rice</option>
                        <option value="R" <?php if(isset($rate_dtls->rice_type) && ($rate_dtls->rice_type=="R")){ echo "selected" ;} ?>>Raw Rice</option>
                     </select>
                    </div>

                  <label for="name" class="col-sm-2 col-form-label">Effective Date:</label>

                <div class="col-sm-4">

                    <input type="date" readonly class="form-control" value="<?php echo $rate_dtls->effective_dt;?>" required
                            name="effective_dt" id="effective_dt"/>
                </div>

                </div>


                <div class="form-group row">

                    <label for="name" class="col-sm-2 col-form-label">Rice Rate:</label>

                    <div class="col-sm-8">

                        <input type="text"  class= "form-control required"
                            name = "rate"
                            id   = "rate"
                            value="<?php echo $rate_dtls->rate;?>" />

                    </div>

                    <label for="name" class="col-sm-2 col-form-label">Per Quintal</label>

                </div> 

                <div class="form-group row">

                    <div class="col-sm-10">

                        <button type="submit" class="btn btn-info">Save</button>

                    </div>

                </div>

            </form>

        </div>

    </div>    