<?php
$dsn = "mysql:host=localhost;dbname=mmlf6971_portfolio;charset=utf8mb4";
try {
$connect = new PDO($dsn, 'mmlf6971_henriquegamborgi', 'lY3u9u*Sig]N');
} catch (Exception $e) {
  error_log($e->getMessage());
  exit('unable to connect');
}
?>