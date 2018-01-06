<?php
$this->load->view('header');
?>

    <div class="update-form">

        <div class="container col-md-6">

            <h2 class="form-signin-heading text-center">Update your profile</h2><hr />

            <div class="row" id="alerts">
            </div>
            <form class="form-update" method="post" id="update-form">


                <div id="error">
                    <!-- error will be shown here ! -->
                </div>

                <div class="form-group">
                    <label class="control-label"  for="password">Change Password</label>
                    <input type="password" class="form-control" placeholder="New Password" name="password" id="password" />
                    <span id="check-e"></span>
                </div>

                <div class="form-group">
                    <label class="control-label"  for="repeat_password">Repeat Password</label>
                    <input type="password" class="form-control" placeholder="Repeat New Password" name="repeat_password" id="repeat_password" />
                    <span id="check-e"></span>
                </div>

                <div class="form-group">
                    <label class="control-label"  for="old_password">Old Password Required</label>
                    <input type="password" class="form-control" placeholder="Old Password" name="old_password" id="old_password" />
                </div>

                <hr/>

                <div class="form-group">
                    <button type="submit" class="btn btn-default" name="btn-login" id="btn-login">
                        <span class="glyphicon glyphicon-log-in"></span> &nbsp; Change Password
                    </button>
                </div>

            </form>

        </div>

    </div>
<?php $this->load->view('footer'); ?>