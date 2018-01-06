<!DOCTYPE html>
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<title>Picture gallery</title>
<!-- Latest compiled and minified CSS -->
<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css" integrity="sha384-BVYiiSIFeK1dGmJRAkycuHAHRg32OmUcww7on3RYdg4Va+PmSTsz/K68vbdEjh4u" crossorigin="anonymous">

<!-- Optional theme -->
<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap-theme.min.css" integrity="sha384-rHyoN1iRsVXV4nD0JutlnGaslCJuC7uwjduW9SVrLvRYooPp2bWYgmgJQIXwl/Sp" crossorigin="anonymous">


</head>

<body>
<div class="container">
    <nav class="navbar navbar-default">
        <div class="container-fluid">
            <div class="navbar-header">
                <button type="button" class="navbar-toggle collapsed" data-toggle="collapse" data-target="#navbar" aria-expanded="false" aria-controls="navbar">
                    <span class="sr-only">Pictures</span>
                    <span class="icon-bar"></span>
                    <span class="icon-bar"></span>
                    <span class="icon-bar"></span>
                </button>
                <a class="navbar-brand" href="<?= base_url(); ?>">Pictures</a>
            </div>
            <div id="navbar" class="navbar-collapse collapse">
                <?php echo $this->session->userdata('username'); ?>
                <ul class="nav navbar-nav">
                    <li role="presentation"><a href="/codeigniter/home">Home</a></li>
                    <?php if(empty($this->session->userdata('user'))): ?>
                    <li role="presentation"><a href="/codeigniter/login">Login</a></li>
                    <li role="presentation"><a href="/codeigniter/register">Register</a></li>
                    <?php endif; ?>
                    <li role="presentation"><a href="/codeigniter/images">Gallery</a></li>
                    <?php if(!empty($this->session->userdata('user'))): ?>
                    <li role="presentation"><a href="/codeigniter/image/user">Your gallery</a></li>
                    <li role="presentation"><a href="/codeigniter/image/upload">Upload Image</a></li>
                    <li role="presentation"><a href="/codeigniter/users">Users</a></li>
                    <li role="presentation"><a href="/codeigniter/update/userProfile">Update profile</a></li>
                    <?php endif; ?>
                </ul>
                <ul class="nav navbar-nav navbar-right">
                    <?php if(!empty($this->session->userdata('user'))): ?>
                        <?php if($this->session->userdata('user')['role_id'] == 2): ?>
                            <li><a href="/codeigniter/admin/dashboard">Admin Panel</a></li>
                        <?php endif; ?>
                            <li><a href="/codeigniter/image/user">Hi <?= $this->session->userdata('user')['username'];?> <span class="sr-only">(current)</span></a></li>
                            <li><a href="/codeigniter/user/logout">Logout</a></li>
                    <?php endif; ?>
                    <!--
                       <li class="dropdown">
                        <a href="#" class="dropdown-toggle" data-toggle="dropdown" role="button" aria-haspopup="true" aria-expanded="false">Dropdown <span class="caret"></span></a>
                        <ul class="dropdown-menu">
                            <li><a href="#">Action</a></li>
                        </ul>
                    </li>
                    -->
                </ul>
            </div><!--/.nav-collapse -->
        </div><!--/.container-fluid -->
    </nav>

    <!--
    <div class="page-header text-center">
        <h1>VIKTURE PICTURE <br><small>Get started and upload your pictures now !</small></h1>
        <div class="row text-center center-block block-center">
            <ul class="nav nav-pills center-block" style="display: inline-block">
                <li role="presentation"><a href="/codeigniter/home">Home</a></li>
                <li role="presentation"><a href="/codeigniter/login">Login</a></li>
                <li role="presentation"><a href="/codeigniter/register">Register</a></li>
                <li role="presentation"><a href="/codeigniter/images">Gallery</a></li>
                <li role="presentation"><a href="/codeigniter/image/user">Your gallery</a></li>
            </ul>
        </div>
    </div>
    -->


