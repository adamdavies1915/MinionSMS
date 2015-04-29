<?php
$pageName = basename($_SERVER['PHP_SELF']);
$pageEnd = '</ul>
        </div><!-- end #navbarexample -->';
switch ($pageName) {
    case "rules.php":
        $extraItems=<<<EOS
<div class="col-sm-3 col-md-2 sidebar">
  <ul class="nav nav-sidebar">
    <li><a href="./masscontacts.php">View contacts</a></li>
    <li><a href="./newcontact.php">Add new contact</a></li>
    <li><a href="./newcontactgroup.php">Add new group</a></li>
      <li><a href="#collapseOne" class="collapsed" data-toggle="collapse" data-parent="#accordion" aria-expanded="false" aria-controls="collapseOne"><span class="glyphicon glyphicon-chevron-right"></span> Automation Rules</a></li>
      <li><a href="#collapseTwo" class="collapsed" data-toggle="collapse" data-parent="#accordion"  aria-expanded="false" aria-controls="collapseTwo"><span class="glyphicon glyphicon-chevron-right"></span> Message Formatting Rules</a></li>
      <li><a href="#collapseThree" class="collapsed" data-toggle="collapse" data-parent="#accordion" aria-expanded="false" aria-controls="collapseThree"><span class="glyphicon glyphicon-chevron-right"></span> Notification Rules</a></li>
      <li><a href="./sendmass.php">Send mass message</a></li>
EOS;
        break;
    case "queue.php":
        $extraItems=<<<EOS
        <div class="col-sm-3 col-md-2 sidebar">
          <ul class="nav nav-sidebar">      
            <li><a href="./masscontacts.php">View contacts</a></li>
            <li><a href="./newcontact.php">Add new contact</a></li>
            <li><a href="./newcontactgroup.php">Add new group</a></li>
            <li><a href="./sendmass.php">Send mass message</a></li>
EOS;
        break;
    default:
        $extraItems=<<<EOS
        <div class="col-sm-3 col-md-2 sidebar">
          <ul class="nav nav-sidebar">      
            <li><a href="./masscontacts.php">View contacts</a></li>
            <li><a href="./newcontact.php">Add new contact</a></li>
            <li><a href="./newcontactgroup.php">Add new group</a></li>
            <li><a href="./sendmass.php">Send mass message</a></li>
EOS;
        break;
}
echo $extraItems,$pageEnd;

?>
