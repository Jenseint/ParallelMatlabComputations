<?php
include "head_all.php";
?>
<title>�������������� ������</title>
</head>
<body>
<h1> �������������� ������ </h1>
<?php
include "header.php";
$id=$_REQUEST['id'];
$r=mysql_query("select userid from methods  where id=$id");
$f=mysql_fetch_array($r);
$userid=$f['userid'];

if (!(($adminauth==1)||(($auth==1)&&($uid_cookie==$userid))))
{
//header('Location: userlist.php');
//echo "������ ����!!! $uid_cookie ";
echo "�� �� ������ ����� ������������� ��������� ����� ������. <p>\n����������,  <a href=login.php>�������</a> � ������� ��� ������ �������.<p>";
//include "footer.php";
exit;
}
?>

<form enctype="multipart/form-data" action=methodedit1.php method=post>
<?php
$id=$_REQUEST['id'];
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
$r=mysql_query("select * from methods where id=$id");
$f=mysql_fetch_array($r);
$name=rawurldecode($f['name']);
$descr=rawurldecode($f['descr']);
$folder=$f['folder'];
$userid=$f['userid'];
$platformid=$f['platformid'];
$command=rawurldecode($f['command']);
echo "<input type=hidden name='id' value=$id>\n";
echo "�������� ������ <input type=text name='name' value=$name><p>\n";
echo "������� �������� <p><textarea name='descr'>$descr</textarea><p>\n";
echo "����� <input type=text name='folder' value=$folder><p>\n";
echo "�������\n <select name=userid>\n";
$r=mysql_query("select * from users");
$num_res=mysql_num_rows($r);
for ($i=0;$i<$num_res;$i++)
{$f=mysql_fetch_array($r);
 if ($userid==$f['id']) $selected=" selected "; else $selected="";
// echo "<option $selected value=$f['id']> $f['login'] </option>\n";
 echo "<option $selected value=$f[id]> $f[login] </option>\n";
}
echo"</select><p>\n";
echo "���������\n<select name=platformid>\n";
$r=mysql_query("select * from platforms");
$num_res=mysql_num_rows($r);
for ($i=0;$i<$num_res;$i++)
{$f=mysql_fetch_array($r);
  $selected="";
if ($f['id']==$platformid) $selected="selected"; else $selected="";;
// echo "<option $selected value=$f['id']> $f['login'] </option>\n";
 echo "<option $selected value=$f[id]> $f[name] </option>\n";
}
echo "</select><p>\n";
//$f['userid'];
echo "������� (����������� ����� #infilename, #outfilename ��� ����������� ����� �������� � ��������� ����� ��������������).<p>\n";
echo '<input type=text name=command value="';
echo $command;
echo '"><p>';
echo "\n";
?>
<!-- //����� �������:<input type=file name='filetool'><p>-->
<p> 
<a href=methodsarchreplace.php>�������� ����� ���������</a><p>
<input type=submit value="���������">
</form>

<?php
include "footer.php";
?>
