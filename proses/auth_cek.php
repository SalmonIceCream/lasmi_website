<?php
session_start();

if (!isset($_SESSION['user'])) {
  header("Location: ../index.php");
  exit;
}

function is_admin()
{
  return $_SESSION['user']['hak_akses'] === 'admin';
}

function is_user()
{
  return $_SESSION['user']['hak_akses'] === 'user';
}
