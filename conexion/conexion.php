<?php
  $link = mysqli_connect("localhost", "root", "");

  mysqli_select_db($link, "places");
  $link->set_charset("UTF8");
?>