<div class="wraper">      

    <form method="POST" 
        id="form"
        action="<?php echo site_url("admin/user/edit");?>" >

        <div class="col-md-6 container form-wraper" style="margin-left: 0px;">

            <div class="form-header">
            
                <h4>User Edit</h4>
            
            </div>

            <input type="hidden"
                name="user_id"
                value="<?php echo $user_dtls->user_id;?>"
            />
            
            <div class="form-group row">

                <label for="name" class="col-sm-2 col-form-label">User Name:</label>

                <div class="col-sm-10">

                    <input type="text"
                        class="form-control required"
                        name="name"
                        id="name"
                        value="<?php echo $user_dtls->user_name; ?>"
                        readonly
                    />

                </div>

            </div> 

            <input type="hidden"
                name="user_type"
                id="user_type"
                value="<?php echo $user_dtls->user_type; ?>"
            >

            <div class="form-group row">

                <label for="pass" class="col-sm-2 col-form-label">User Status:</label>

                <div class="col-sm-10">
                   <select name="user_status">
                   <option value="A" <?php if($user_dtls->user_status=="A"){echo "selected";} ?>>Active</option>
                   <option value="I" <?php if($user_dtls->user_status=="I"){echo "selected";} ?>>Inactive</option>
                   </select>
                
                    
                </div>

            </div>

             

            <div class="form-group row">

                <div class="col-sm-10">

                    <input type="submit" class="btn btn-info" value="Save" />

                </div>

            </div>

        </div>

       

    </form>

</div>

<script>

    $("#form").validate();

</script>
