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
$id=$_REQUEST['id'];
$r=mysql_query("select * from methods where id=$id");
$f=mysql_fetch_array($r);
$userid_old=$f['userid'];
$num_res=mysql_num_rows($r);
$name=rawurlencode($_REQUEST['name']);
$descr=rawurlencode($_REQUEST['descr']);
$folder=$_REQUEST['folder'];
$userid=$_REQUEST['userid'];

$platformid=$_REQUEST['platformid'];
$command=rawurlencode($_REQUEST['command']);
//echo "userid=$userid<p>\n";
$r=mysql_query("select login,pass,type from users where id=$userid");// 20130115 ���� where id=$userid_old. ��������, �.�. ����� ���� �����, � �������������� ����� ������, � �� ���� �����, ��� ������ � 
$f=mysql_fetch_array($r);
$username=$f[login];
$userpass=$f[pass];
//echo "username=$username <p>";

if (isset($_COOKIE['uid']))
{
$uid_cookie=$_COOKIE['uid'];
$uhash_cookie=$_COOKIE['uhash'];

include "bcrypt.php";
$bcrypt = new Bcrypt(15);

//$hash = $bcrypt->hash('password');
$auth = $bcrypt->verify($username.$userpass, $uhash_cookie);
//echo "auth result - $auth";
if ($f['type']==1)$adminauth=1;else $adminauth=0;
}
else {$auth=0;$uid_cookie=0;}

//echo "uid_cookie = $uid_cookie userid_old = $userid_old";
//if (($adminauth==0)&&($auth==1)&&($uid_cookie!=$id)) $userid_old
if (!(($adminauth==1)||(($auth==1)&&($uid_cookie==$userid_old))))
{
//header('Location: userlist.php');
//echo "������ ����!!! adminauth=$adminauth";
echo "�� �� ������ ����� ������������� ��������� ����� ������. <p>\n����������,  <a href=login.php>�������</a> � ������� ��� ������ �������.<p>";
//include "footer.php";
exit;
}


//echo 'Script rabotaet!!!';
//print_r($_FILES);
//mysql_query("insert into methods(id,name, descr, folder, userid, platformid,command) 
//               values('$num_res','$name', '$descr', '$folder', '$userid', '$platformid','$command')");
mysql_query("update methods set name='$name' where id=$id");
mysql_query("update methods set descr='$descr' where id=$id");
mysql_query("update methods set folder='$folder' where id=$id");
mysql_query("update methods set userid='$userid' where id=$id");
mysql_query("update methods set platformid='$platformid' where id=$id");
mysql_query("update methods set command='$command' where id=$id");
header('Location: methodslist.php');
exit;
//echo "Done.";
?>  
