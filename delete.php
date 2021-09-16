<?php
include('server.php') ;
$select="delete from games where Name='".$_GET['Name']."'";
$query=mysql_query($select) or die($select);
?>
