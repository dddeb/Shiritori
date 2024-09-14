<?php
# FileName="Connection_php_mysql.htm"
# Type="MYSQL"
# HTTP="true"
$hostname_debdeb = "localhost";
$database_debdeb = "shiritori";
$username_debdeb = "root";
$password_debdeb = "";
$debdeb = mysql_pconnect($hostname_debdeb, $username_debdeb, $password_debdeb) or trigger_error(mysql_error(),E_USER_ERROR); 
?>