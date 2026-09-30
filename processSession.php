<?php
session_start();
if (isset($_REQUEST['address']))
    $_SESSION['address'] = $_REQUEST['address'];
?>
<!DOCTYPE html>
<html lang='en-GB'>
<head><title>Processing</title></head>
<body>
<?php
echo $_SESSION['item'];
echo $_SESSION['address'];
session_unset();
session_destroy();
?>
</body>
</html>