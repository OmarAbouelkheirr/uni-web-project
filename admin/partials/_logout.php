<?php

session_start();
session_unset();
session_destroy();
header("location: /OnlinePizzaDelivery/index.php");
exit();
?>
