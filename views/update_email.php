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
                    <label class="control-label"  for="email">Change Email</label>
                    <input type="email" class="form-control" placeholder="Change Email" name="email" id="email" />
                    <span id="check-e"></span>
                </div>

                <div class="form-group">
                    <label class="control-label"  for="password">Password Required</label>
                    <input type="password" class="form-control" placeholder="Password" name="password" id="password" />
                </div>

                <hr />

                <div class="form-group">
                    <button type="submit" class="btn btn-default" name="btn-login" id="btn-login">
                        <span class="glyphicon glyphicon-log-in"></span> &nbsp; Change Email
                    </button>
                </div>

            </form>

        </div>

    </div>
<?php $this->load->view('footer'); ?>