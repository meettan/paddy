    <div class="wraper">      

        <div class="col-md-6 container form-wraper">   

            <form method="POST" 
                action="<?php echo site_url("paddys/add_new/msp_edit");?>" >

                <div class="form-header">
                
                    <h4>Block Edit</h4>
                
                </div>

                <input type="hidden" name="id" id="id"  value="<?php echo $msp_dtls->id;?>"/>

                <div class="form-group row">
               
                    <label for="name" class="col-sm-2 col-form-label">Effective Date:</label>

                    <div class="col-sm-4">

                        <input type="date" readonly
                            class="form-control" value="<?php echo $msp_dtls->effective_dt;?>" required
                            name="effective_dt" id="effective_dt"/>
                    </div>
                   

                </div>

                <div class="form-group row">

                    <label for="name" class="col-sm-2 col-form-label">MSP:</label>

                    <div class="col-sm-8">

                        <input type="text"  class= "form-control required"
                            name = "per_qui_rate"
                            id   = "per_qui_rate"
                            value="<?php echo $msp_dtls->per_qui_rate;?>" />

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