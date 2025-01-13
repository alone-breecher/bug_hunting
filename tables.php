<?php
$con = mysql_connect("localhost", "multimat_final", "multimat_final");
mysql_select_db("multimat_multimat");
$result = mysql_query("SHOW TABLES");
while ($row = mysql_fetch_row($result)) {
    echo $row[0] . "<br>";
}
?>
