<?php

include "./database/homelogics.php";

switch (true) {
      case isset($_POST['dashboard']):
        $home->dashboardData();
    break;
    default:
        break;
}
