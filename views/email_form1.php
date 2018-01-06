<!DOCTYPE html>
<html>
<head>
    <meta http-equiv="Content-Type" content="text/html; charset=utf-8">
    <title>PHPMailer Contact Form</title>
</head>
<body>
<h1>Contact us</h1>
<?php if (empty($msg)) { ?>
    <form method="post">
        <label for="to">Send to:</label>
        <select name="to" id="to">
            <option value="support" selected="selected">Support</option>
            <option value="accounts">Accounts</option>
        </select><br>
        <label for="subject">Subject: <input type="text" name="subject" id="subject" maxlength="255"></label><br>
        <label for="name">Your name: <input type="text" name="name" id="name" maxlength="255"></label><br>
        <label for="email">Your email address: <input type="email" name="email" id="email" maxlength="255"></label><br>
        <label for="query">Your question:</label><br>
        <textarea cols="30" rows="8" name="query" id="query" placeholder="Your question"></textarea><br>
        <input type="submit" value="Submit">
    </form>
<?php } else {
    echo $msg;
} ?>
</body>
</html>