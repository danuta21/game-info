<?php
include 'server.php';
$result = mysqli_query($db,"SELECT * FROM games WHERE id='" . $_GET['id'] . "'");
$row= mysqli_fetch_array($result);
?>
<html>
<head>
<link rel="stylesheet" type="text/css" href="style.css">
<title>Update</title>
</head>
<body>
  <div class="hello">
    <h2>Description</h2>
  </div>
<form name="frmUser" method="post"  class="description">
<div><?php if(isset($message)) { echo $message; } ?>
</div>

<input type="hidden" name="id" class="txtField" value="<?php echo $row['id']; ?>" hidden>
<input type="text" name="id"  value="<?php echo $row['id']; ?>" hidden>
<br>

<label>Name</label>
<input type="text" name="Name" class="n" value="<?php echo $row['Name']; ?>" readonly>
<br>
<label>Category</label>
<input type="text" name="Category" class="c" value="<?php echo $row['Category']; ?>"readonly>
<br>
<label>Platform</label>
<input type="text" name="Platform" class="p" value="<?php echo $row['Platform'];  ?> " readonly>
<br>

<div style="padding-bottom:5px;">
<p>Return to <a href="index.php">Games List</a></p>
</div>

</form>
</body>
</html>
 ?>
