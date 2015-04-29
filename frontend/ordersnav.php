<?php
$pageName = basename($_SERVER['PHP_SELF']);
$pageEnd = '</ul>
        </div><!-- end #navbarexample -->';
switch ($pageName) {
    case "rules.php":
        $extraItems='<div class="col-sm-3 col-md-2 sidebar">
          <ul class="nav nav-sidebar">
            <li><a href="./orders.php">Orders Hub</a></li>
            <li><a href="./rules.php">Rules</a></li>
              <li><a href="./queue.php">Order Queue</a></li>';
        break;
    case "queue.php":
        $extraItems='<div class="col-sm-3 col-md-2 sidebar">
          <ul class="nav nav-sidebar">
            <li><a href="./orders.php">Orders Hub</a></li>
            <li><a href="./rules.php">Rules</a></li>
            <li><a href="./queue.php">Order Queue</a></li>';
        break;
    default:
        $extraItems='<div class="col-sm-3 col-md-2 sidebar">
          <ul class="nav nav-sidebar">
            <li><a href="./orders.php">Orders Hub</a></li>
            <li><a href="./rules.php">Rules</a></li>
            <li><a href="./queue.php">Order Queue</a></li>';
        break;
}
echo $extraItems,$pageEnd;

?>