<?php
include "head_all.php";
?>
<title>������ � �������� ���������������</title>
</head>
<body>
<h1> ������ �  �������� ���������������</h1>
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
$r=mysql_query("select id,toolboxid,name,descr,folder,userid,platformid,command,version as maxver from methods group by toolboxid");
$num_res=mysql_num_rows($r);
echo '<table border=2><tr><td>#</td><td>�����</td><td>��������</td><td>�����</td><td>�������</td><td>���������</td><td>�������</td><td>������</td><td>�������������</td><td>����. ���.</td><td>���. ���.</td><td>�������</td></tr>';
for($i=0; $i<$num_res; $i++)
{ $f=mysql_fetch_array($r);
 $name=rawurldecode($f[name]);
 $descr=rawurldecode($f[descr]);
 $command=rawurldecode($f[command]);
  echo "<tr><td>$f[toolboxid]</td><td>$name</td><td>$descr</td><td>$f[folder]</td><td>$f[userid]</td><td>$f[platformid]</td><td>$command</td><td><a href=methodsverlist.php?id=$f[toolboxid]>��������</a></td>";
if (($uid_cookie>0)&&(($adminauth==1)||($f[userid]==$uid_cookie)))
  echo "<td><a href=methodedit.php?id=$f[id]>�������������</a></td><td><a href=methodget.php?id=$f[id]>���������</a><td><a href=methodsarchreplace.php?id=$f[id]>��������</a></td></td><td><a href=methoddelete.php?id=$f[id]>�������</a></td></tr>\n";
else if ($uid_cookie>0)
  echo "<td><a href=methodcopymy.php?id=$f[id]>������� ������ �����</a></td><td><a href=methodget.php?id=$f[id]>���������</a><td>--</td></td><td>--</td></tr>\n";
  else echo "<td>--</td><td><a href=methodget.php?id=$f[id]>���������</a><td>--</td></td><td>--</td></tr>\n";
}
echo '</table>';
//(id int, platformid int, methodid int, dataid int, filename char(50), command char(200), state char(30), done int, outfilename char(50), IP char(20), adduserid int, calcuserid int, processid int, begcalcdate date, begcalctime time , predictminutes int ,  endcalcdate date,  endcalctime time)
?>
�������� �������� �� ������� "������". ����� ����������� ������ ������� ������, ��������� ����������� � ���� ������� � ��������������� ������ ������.<p>

<?php
if ($auth==1)
echo "1) <a href=methodadd.php>�������� ����� �����</a><p>";
include "footer.php";
?>
