<?php

  session_start();

  $name = "";
  $address = "";
  $id = 0;
  $edit_state = false;

  $db = mysqli_connect('localhost','root','','test');

  // Jika tombol ditekan
  if (isset($_POST['save'])) {
    $name = $_POST['name']; // yang pakai '$' itu untuk DB yang di dalam [] itu untuk name
    $address = $_POST['address']; // yang pakai '$' itu untuk DB yang di dalam [] itu untuk name

    $query = "INSERT INTO info (name,address) VALUES ('$name' , '$address')";
    mysqli_query($db, $query);
    $_SESSION['message'] = "Data Saved";
    header('location: data.php');
  }

  if (isset($_POST['update'])) {
    $name = mysqli_real_escape_string($_POST['name']);
    $address = mysqli_real_escape_string($_POST['address']);
    $id = mysqli_real_escape_string($_POST['id']);

    mysqli_query($db, "UPDATE info SET name='$name', address='$address' WHERE id=$id");
    $_SESSION['message'] = "Data Updated";
    header('location: data.php');
  }

  if (isset($_GET['del'])) {
    $id = $_GET['del'];
    mysqli_query($db, "DELETE FROM info WHERE id=$id");
    $_SESSION['message'] = "Data Deleted";
    header('location: data.php');
  }

  $results = mysqli_query($db, "SELECT * FROM info");
 ?>
