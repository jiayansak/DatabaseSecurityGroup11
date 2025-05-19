<?php
require('inc/essentials.php');
require('inc/db_config.php');
adminLogin();
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Admin Panel - Bookings </title>
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css">
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
    <?php require('inc/links.php'); ?>
  <style>
    .denied-page {
      display: flex;
      flex-direction: column;
      justify-content: center;
      align-items: center;
      height: 100vh;
      text-align: center;
      background-color: #f8f9fa;
      padding: 20px;
    }
    .denied-page img {
      width: 250px;
      max-width: 100%;
      margin-bottom: 20px;
    }
    .denied-page h1 {
      font-size: 3rem;
      color: #dc3545;
    }
    .denied-page p {
      font-size: 1.2rem;
      margin-bottom: 20px;
    }
    .denied-page a {
      padding: 10px 20px;
      background-color: #343a40;
      color: #fff;
      border-radius: 5px;
      text-decoration: none;
    }
    .denied-page a:hover {
      background-color: #212529;
    }
  </style>
</head>
<body>
    <?php require('inc/header.php'); ?>
<div class="denied-page">
  <img src="warning.jpg" alt="Access Denied">
  <h1>🚫 Access Denied</h1>
  <p>You do not have permission to access this page.</p>
  <a href="setting.php">Back to Dashboard</a>
</div>

</body>
</html>
