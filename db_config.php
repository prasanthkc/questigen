<?php
    /* The PDO object */
$pdo = NULL;

/* The connection string. */
$dsn = 'mysql:host=localhost;dbname=persona';

/* Connection step. */
try
{
  $pdo = new PDO($dsn, 'root',  '');
  $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
}
catch (PDOException $e)
{
  die();
}
?>