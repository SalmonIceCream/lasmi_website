<?php
$protocol = isset($_SERVER['HTTPS']) && $_SERVER['HTTPS'] === 'on' ? "https" : "http";
$host = $_SERVER['HTTP_HOST'];
$path = rtrim(dirname($_SERVER['SCRIPT_NAME']), '/\\');

// Jika situs di root (misal: http://localhost/), hapus path
if ($path == "/") $path = "";

$base_url = "$protocol://$host$path/";
