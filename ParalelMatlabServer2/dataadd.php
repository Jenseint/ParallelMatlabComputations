<?php
include "head_all.php";
?>
<title>�������� ������ ������ �� ������</title>
</head>
<body>
<h1> �������� ������ ������ �� ������ </h1>
<?php
include "header.php";
if ($auth==0)
{
//header('Location: userlist.php');
echo "�� �� ������ ����� ��������� ������, �� ������ �����������. <p>\n����������,  <a href=login.php>�������</a> � ������� ��� <a href=userreg.php>����������������</a>.<p>";
include "footer.php";
exit;
}

?>

<form enctype="multipart/form-data" action=dataadd1.php method=post>
�������� <input type=text name='descr' value='Unnamed001'><p>
<!-- ����� <input type=text name='folder'><p> --!>
�������
<select name=userid>
<?
include "settings.php";
//define("DBName","matlab2");
//define("HostName","localhost");
//define("UserName","root");
//define("Password","");
if(!mysql_connect(HostName,UserName,Password))
{ echo "�� ���� ����������� � �����".DBName."!<br>";
echo mysql_error();
exit;
}
mysql_select_db(DBName);
//mysql_query("use tasks");
$r=mysql_query("select * from users");
$num_res=mysql_num_rows($r);
for ($i=0;$i<$num_res;$i++)
{$f=mysql_fetch_array($r);
 if ($uid_cookie==$f['id']) $selected=" selected "; else 
  $selected="";
// echo "<option $selected value=$f['id']> $f['login'] </option>\n";
 echo "<option $selected value=$f[id]> $f[login] </option>\n";
}
?>
</select><p>
����� ������:<input type=file name='filetool'><p><p>
<input type=submit value="��������">


</form>
<?php
include "footer.php";
?>
