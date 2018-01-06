<?php
$this->load->view('header');
?>

    <div class="update-form">

        <div class="container col-md-6">

            <h2 class="form-signin-heading text-center">Send email</h2><hr />

            <div class="row" id="alerts">
            </div>
            <form class="form-update" method="post" id="update-form">


                <div id="error">
                    <!-- error will be shown here ! -->
                </div>

                <div class="form-group">
                    <label class="control-label"  for="email">Email</label>
                    <input type="email" class="form-control" placeholder="Email" name="email" id="email" />
                    <span id="check-e"></span>
                </div>

                <div class="form-group">
                    <label class="control-label"  for="subject">Subject</label>
                    <input type="text" class="form-control" placeholder="Subject" name="subject" id="subject" />
                </div>

                <div class="form-group">
                    <label class="control-label">Message</label>
                    <textarea class="form-control" placeholder="Message" name="message" id="message"></textarea>
                </div>

                <hr />

                <div class="form-group">
                    <input type="submit" name="submit" value="Submit" class="btn btn-info"/>
                </div>

            </form>

        </div>

    </div>

<?php
$this->load->view('footer');
?>