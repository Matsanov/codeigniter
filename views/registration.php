<?php
$this->load->view('header');
?>

<?php echo validation_errors(); ?>

<div class="col-md-6">
<form class="form-horizontal" action="" method="post">
    <fieldset>
        <div id="legend">
            <legend class="">Register</legend>
        </div>
        <div class="control-group">
            <!-- Username -->
            <label class="control-label"  for="username">Username</label>
            <div class="controls">
                <input type="text" id="username" name="username" value="<?php echo set_value('username'); ?>" placeholder="" class="input-xlarge">
                <p class="help-block">Username can contain any letters or numbers, without spaces</p>
            </div>
        </div>

        <div class="control-group">
            <!-- E-mail -->
            <label class="control-label" for="email">E-mail</label>
            <div class="controls">
                <input type="text" id="email" name="email" value="<?php echo set_value('email'); ?>" placeholder="" class="input-xlarge">
                <p class="help-block">Please provide your E-mail</p>
            </div>
        </div>

        <div class="control-group">
            <!-- Password-->
            <label class="control-label" for="password">Password</label>
            <div class="controls">
                <input type="password" id="password" name="password" value="<?php echo set_value('password'); ?>" placeholder="" class="input-xlarge">
                <p class="help-block">Password should be at least 4 characters</p>
            </div>
        </div>

        <div class="control-group">
            <!-- Password -->
            <label class="control-label"  for="password">Password (Confirm)</label>
            <div class="controls">
                <input type="password" id="password_confirm" name="passwordRepeat" value="<?php echo set_value('passwordRepeat'); ?>" placeholder="" class="input-xlarge">
                <p class="help-block">Please confirm password</p>
            </div>
        </div>

        <div class="control-group">
            <!-- Button -->
            <div class="controls">
                <input type="submit" class="btn" name="submit" />
            </div>
        </div>
    </fieldset>
</form>
    </div>
<div class="col-md-6 text-center">
    <legend>Info</legend>
     <p>Lorem ipsum</p>
</div>
</div>

<?php
$this->load->view('footer');
?>