<?php include '../connect.php'; ?>
<?php
session_destroy();
header('Location:'.$SITE_URL);

?>