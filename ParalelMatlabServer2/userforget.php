<?php
include "settings.php";

$email=$_REQUEST['email'];
$id=$_REQUEST['id'];
if ($email=="") $id=1;



if(!mysql_connect(HostName,UserName,Password))
{ echo "�� ���� ����������� � �����".DBName."!<br>";
echo mysql_error();
exit;
}
mysql_select_db(DBName);
$errorflag=0;
//define("DBName","matlab2");
//define("HostName","localhost");
//define("UserName","root");
//define("Password","");
$email_err="";

if (array_key_exists('email',$_REQUEST))// the validation condition expected. This is the test 
{
//mysql_query("use tasks");


if (preg_match('|([a-z0-9_\.\-]{1,20})@([a-z0-9\.\-]{1,20})\.([a-z]{2,4})|is', $email)==0)
 {$email_err="Email is not correct!";$errorflag=1; }
if (!$errorflag){
$r=mysql_query("select * from users where email = '$email'");
$num_res=mysql_num_rows($r);
// redirect to users table
include "head_all.php";
echo "<title>�������������� �������� ������</title>";
echo "</head>";
echo "<body>";
echo "<h1> �������������� �������� ������ </h1>";

$message="��������� ������������! ��� ����� ������ �� �������������� �������� ������ � ������� http://prognoz.ck.ua. <p> ���� �� �� �������� ������, ������ ����������� ��� ������. <p>";
for($i=0; $i<$num_res; $i++)            
{ $f=mysql_fetch_array($r);
$message=$message."��� �������������� ������� ������  $f[login], �������� �� ";
$random_number=rand(1,32765);
$id=$f['id'];
$r=mysql_query("update users set rndnum = $random_number where id  = $id");
$message=$message."<a href='http://prognoz.ck.ua/ParalelMatlabServer2/userforget1.php?id=$id&rnd=$random_number'> ���� ������</a><p>";
}
echo "�� ��� �������� ���� ���������� ������ � ����������� �� �������������� �������� ������. <p>";
//echo "����� ������ ��� �������: <p> $message";
echo "<a href='userlist.php'>��������� �� �������</a>";
mail($email, "�������������� ������ prognoz.ck.ua", $message,
     "From: webmaster@ prognoz.ck.ua \r\n"
    ."X-Mailer: PHP/" . phpversion());
exit;
}
}
else
{
$email="";

$errorflag=1;
// and then the form is displaying:
}
?>

<?php
include "head_all.php";
?>
<title>�������������� �������� ������</title>
</head>
<body>
<h1> �������������� �������� ������ </h1>
<?php
include "header.php";
?>
<h1> ������� ����� ����� ����������� �����: </h1>

<form method=get action=userforget.php>
e-mail: <input type=text name='email' 
<?php 
echo "value='$email'>"; 
echo "$email_err";
?>
<p>
<input type=submit value='������������'> <input type=reset value='��������'></form><p><p>
<?php
include "footer.php";
?>
