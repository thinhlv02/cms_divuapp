<html>
<head>
    <title> Send Email Codeigniter </title>
</head>
<body>
<?php
echo $this->session->flashdata('email_sent');
echo form_open('/Email/send_mail');
?>
<input type = "email" name = "email" required />
<input type = "submit" value = "SEND MAILxxxxxxx">
<?php
echo form_close();
?>
</body>
</html>