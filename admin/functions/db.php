<?php


$connection = mysqli_connect('localhost', 'root', '', 'namaste');


function confirm($result)
{
 global $connection;
 if (!$result) {

  return die("QUERY FAILED" . mysqli_error($connection));
 }
}

function  query($result)
{
 global $connection;
 return mysqli_query($connection, $result);
}



function escape($result)
{
 global $connection;
 return mysqli_escape_string($connection, $result);
}

function row_count($result)
{
 return mysqli_num_rows($result);
}
