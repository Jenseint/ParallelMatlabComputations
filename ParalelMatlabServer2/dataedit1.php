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
//$name=$_REQUEST['name'];
$descr=rawurlencode($_REQUEST['descr']);
$folder=$_REQUEST['folder'];
$userid=$_REQUEST['userid'];
$id=$_REQUEST['id'];
//print_r($_FILES);
$tmpFile=$_FILES['filetool']['tmp_name'];
//echo "<p>tmpname=$tmpFile<p>";
//$uploaddirroot = '/home/localhost/www/uploads/';


if (isset($_COOKIE['uid']))
{

$r=mysql_query("select * from datafolder where id=$id");
$f=mysql_fetch_array($r);
$userid_old=$f[userid];

$r=mysql_query("select name,pass from users where id=$userid_old");
$f=mysql_fetch_array($r);
$username=$f[name];
$userpass=$f[pass];

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
//if (($adminauth==0)&&($auth==1)&&($uid_cookie!=$id))
if (!(($adminauth==1)||(($auth==1)&&($uid_cookie==$userid_old))))
{
//header('Location: userlist.php');
//echo "������ ����!!! adminauth=$adminauth";
echo "�� �� ������ ����� ������������� ��������� ����� ������ ������. <p>\n����������,  <a href=login.php>�������</a> � ������� ��� ������ �������.<p>";
//include "footer.php";
exit;
}



//mysql_query("insert into datafolder(id,name, descr, folder, userid) 
//     values('$num_res','$name', '$descr', '$folder', '$userid')");
mysql_query("update datafolder set descr='$descr' where id=$id");
mysql_query("update datafolder set folder='$folder' where id=$id");
mysql_query("update datafolder set userid='$userid' where id=$id");

//echo "Done.";
header('Location: datalist.php');
exit;

?>  
