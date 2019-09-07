<?php include 'server.php';

  if (isset($_GET['edit'])) {
    $id = $_GET['edit'];
    $edit_state = true;
    $rec = mysqli_query($db, "SELECT * FROM info WHERE id=$id");
    $record = mysqli_fetch_array($rec);
    $name = $record['name'];
    $address = $record['address'];
    $id = $record['id'];
  }

?>

<!DOCTYPE html>
<html lang="en" dir="ltr">
  <head>
    <meta charset="utf-8">
    <title>Data</title>
    <link rel="stylesheet" href="css/style.css">
  </head>
  <body>

  <?php if (isset($_SESSION['message'])): ?>
    <div class="message">
      <?php
       echo $_SESSION['message'];
       unset($_SESSION['message']);
      ?>
    </div>
  <?php endif ?>

    <table>
      <thead>
        <tr>
        <th>Nama</th>
        <th>Alamat</th>
        <th colspan="2">Action</th>
        </tr>
      </thead>

      <tbody>
      <?php while ($row = mysqli_fetch_array($results)) { ?>
        <tr>
          <td><?php echo $row['name']; ?></td>
          <td><?php echo $row['address']; ?></td>
          <td>
            <a href="data.php?edit=<?php echo $row['id']; ?>" class="edit">Edit</a>
          </td>
          <td>
            <a href="server.php?del=<?php echo $row['id']; ?>" class="delete">Delete</a>
          </td>
        </tr>
      <?php } ?>
      </tbody>
    </table>

  <form action="server.php" method="post">
     <input type="hidden" name="id" value="<?php echo $id; ?>">
    <div class="input-group">
      <label>Nama</label>
      <input type="text" name="name" value="<?php echo $name; ?>">
    </div>
    <div class="input-group">
      <label>Alamat</label>
      <input type="text" name="address" value="<?php echo $address; ?>">
    </div>
    <div class="input-group">
      <?php if ($edit_state == false): ?>
        <button type="submit" name="save" class="btn">Save</button>
      <?php else: ?>
        <button type="submit" name="update" class="btn">Update</button>
      <?php endif ?>

    </div>
  </form>

  </body>
</html>
