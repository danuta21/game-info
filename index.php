<?php

  session_start();
  include ('server.php');

  if (!isset($_SESSION['username'])) {
  	$_SESSION['msg'] = "You must log in first";
  	header('location: login.php');
  }
  if (isset($_GET['logout'])) {
  	session_destroy();
  	unset($_SESSION['username']);
  	header("location: login.php");
  }

  function retrieveCategoryName($category_id, $db) {
    $user_check_query = "SELECT Name FROM category WHERE id=$category_id ";
    $result = mysqli_query($db, $user_check_query);

    $data = mysqli_fetch_assoc($result);

    return $data["Name"];
  }
?>


<!DOCTYPE html>
<html>
<head>
	<title>Home</title>
	<link rel="stylesheet" type="text/css" href="style.css">
</head>

<body>

  <div class="header">
    <h2>Home Page</h2>
  </div>

<div class="bla">
  	<?php if (isset($_SESSION['success'])) : ?>
      <div class="error success" >
      	<h3>
          <?php
          	echo $_SESSION['success'];
          	unset($_SESSION['success']);
          ?>
      	</h3>
      </div>
  	<?php endif ?>


    <?php  if (isset($_SESSION['username'])) : ?>
    	<p>Welcome <strong><?php echo $_SESSION['username']; ?></strong></p>
    	<p> <a href="index.php?logout='1'" style=" background: white; ">logout</a> </p>
    <?php endif ?>

</div>
    <div>
    <form method="post" action="server.php" class="games">
        <div class="input-group">
          <label>Name:</label>
          <input type="text" name="Name">
        </div>
        <div class="input-group">
          <label for="category">Category:</label>
          <select name="category">

        <?php include('server.php');
        while($data = mysqli_fetch_array($records))
        {
            echo "<option value='". $data['id'] ."'>" .$data['Name'] ."</option>";
        }?>
     </select>
        </div>
        <div class="input-group">
          <label>Platform:</label>
          <input type="text" name="Platform">
        </div>
        <div class="input-group">
          <button type="submit" class="btn" name="add">Add</button>
        </div>
        <div  class="hakuna">
        <table>
            <?php include('server.php') ?>
              <tr>
                    <th>Name</th>
                    <th>Category</th>
                    <th>Platform</th>
                    <th>&#9999;</th>
                    <th>&#128465;</th>

              </tr>
            <?php

            while($row = mysqli_fetch_array($result3))
            {

            ?>

               <tr>

                  <td><a href="description.php?id=<?= $row["id"] ?>"><?php echo $row['Name'];?></td>
                  <td><a href="category.php?category_id=<?=$row["category_id"] ?>"><?php echo retrieveCategoryName($row['category_id'], $db);?></td>
                  <td><?php echo $row['Platform'];?></td>
                  <td><a href="update-process.php?id=<?php echo $row["id"]; ?>">&#9999;</a></td>
                  <td>
                  <form action="server.php" method="post">

                     <input name="id" value="<?php echo $row['id'];?>" hidden />
                     <input type="submit" name="delete" value="&#128465;" />


                 </form> </td>
              </tr>
              <?php
                    }
                 ?>
               </table>
             </div>
    </form>
  </div>

</body>
</html>
