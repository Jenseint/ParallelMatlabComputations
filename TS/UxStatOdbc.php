<?php
$conn = odbc_connect("DRIVER={Microsoft Access Driver (*.mdb)};Dbq=C:\Users\������\ux_trades_db\db2.mdb",   "username", "password");
//$neededInstr="UX-3.13 [FOUX: ��������]"
//$sql = "SELECT Date, ����� as Time, first(����) as open, min(����) as Low, max(����) as High, last(����) as Close, sum(�����) as Volume FROM ���������20120513 where ������='UX-3.13 [FOUX: ��������]' group by Date, ����� order by Date asc, ����� asc";
//$sql = "SELECT  ������, (Hour(�����)+Minute(�����)*60) as Time FROM ���������20120513 where ������='UX-3.13 [FOUX: ��������]'";
$sql = "SELECT �����, Date, (60*Hour(�����)+Minute(�����)+24*60*Day(Date) +31*24*60*Month(Date)+365*24*60*Year(Date)) as CurTime , ����, �����, ��������  FROM ���������20120513 where ������='UX-3.13 [FOUX: ��������]'";
echo $sql;
$rs = odbc_exec($conn,$sql);
while (odbc_fetch_row($rs))
{
echo odbc_result($rs,"CurTime");
echo " ";
//echo odbc_result($rs,"�����");
//echo " ";
//echo odbc_result($rs,"Date");
//echo " ";
echo odbc_result($rs,"����");

echo "<p>\n";
}
//echo "\nTest\n� . odbc_result($rs,"test") . "\n";
?>
