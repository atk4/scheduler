<?php
session_start();
if (isset($_SESSION['admin_access'])) {
  unset($_SESSION['admin_access']);
}
header('Location: index.php');
