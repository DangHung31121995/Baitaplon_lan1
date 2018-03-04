<?php

$connection=mysqli_connect('localhost','root','');
if(!$connection)
{
      die("Connnection fail:". mysqli_connect_error());
}
else
{
 
      mysqli_query($connection,"SET NAMES 'utf8' ");
      mysqli_query($connection,"SET CHARACTER SET 'utf8' "); 

}

$connection->query('USE roombooking');


?>