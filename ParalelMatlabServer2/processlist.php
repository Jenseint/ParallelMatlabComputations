<?php
include "head_all.php";
?>
<title>������ � �������� ���������</title>
</head>
<body>
<h1> ������ � �������� ���������</h1>
<?php
include "header.php";
?>

<?php
include "settings.php";
//define("DBName","matlab2");
//define("HostName","localhost");
//define("UserName","root");
//define("Password","");
//echo DBName;
if(!mysql_connect(HostName,UserName,Password))
{ echo "�� ���� ����������� � �����".DBName."!<br>";
echo mysql_error();
exit;
}

mysql_select_db(DBName);
$r=mysql_query("select * from processes");
$num_res=mysql_num_rows($r);
echo '<table border=2><tr><td>#</td><td>���� �����������</td><td>����� �����������</td><td>������������</td><td>��. ��������</td><td>���������</td></tr>';
for($i=0; $i<$num_res; $i++)
{ $f=mysql_fetch_array($r);
 $command=rawurldecode($f[command]);
 $email=rawurldecode($f[email]);
echo "<tr><td>$f[id]</td><td>$f[regdate]</td><td>$f[regtime]</td><td>$f[userid]</td><td>$f[processid]</td><td>$f[platformid]</td></tr>\n";
}
echo '</table>';
?>


<?php
include "footer.php";
?>

