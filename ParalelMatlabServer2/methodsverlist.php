<?php
include "head_all.php";
?>
<title>������ � �������� ������� ���������������</title>
</head>
<body>
<h1> ������ � �������� ������� ���������������</h1>
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
$id=$_REQUEST['id'];
$r=mysql_query("select id,toolboxid,name,descr,folder,userid,platformid,command,version from methods where toolboxid=$id");

$num_res=mysql_num_rows($r);
 $f=mysql_fetch_array($r);
if ($f['userid']!=$id) ($auth=0);
$toolboxid=$f['toolboxid'];
echo "����� ������ : $toolboxid<p>";
$name=rawurldecode($f['name']);
$firstid=$f['id'];
echo "�������� ������: $name<p>";
$descr=rawurldecode($f['descr']);
echo "�������� ��������: <p>$descr<p>";
echo "���������: $f[platformid]<p>";

echo '<table border=2><tr><td>#</td><td>��������</td><td>�����</td><td>�������</td><td>�������</td><td>������</td><td>����. ���.</td><td>�������</td></tr>';
for($i=0; $i<$num_res; $i++)
{$descr=rawurldecode($f['descr']);
$command=rawurldecode($f['command']);
echo "<tr><td>$f[id]</td><td>$descr</td><td>$f[folder]</td><td>$f[userid]</td><td>$command</td><td>$f[version]</td><td><a href=methodget.php?id=$f[id]>���������</a></td>";
if ($auth==1)
echo "<td><a href=methoddelete.php?id=$f[id]>�������</a></td></tr>\n";
else echo "<td>--</td></tr>\n";
 $f=mysql_fetch_array($r);
}
echo '</table>';
//(id int, platformid int, methodid int, dataid int, filename char(50), command char(200), state char(30), done int, outfilename char(50), IP char(20), adduserid int, calcuserid int, processid int, begcalcdate date, begcalctime time , predictminutes int ,  endcalcdate date,  endcalctime time)
if ($auth)
{echo "1) <a href=methodsarchreplace.php?id=$firstid>��������</a><p>";
 echo "2) <a href=methodadd.php>�������� ����� �����</a><p>";
}

include "footer.php";
?>
