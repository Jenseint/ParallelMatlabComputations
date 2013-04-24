function [taskid,taskgroupid]=add_task(command,methodid,dataid,adduserid,predictminutes,taskgroupdata,server)
% �������, ����������� ����� ������� �� ������.
% ���������:
% command - ����� �������...
% methodid - �� ������ ���������������
% dataid - �� �������� ������ ������
% adduserid - �� ������������, ������������ �������
% predictminutes - �������������� ����� �������� � �������
% taskgroupdata - �� ������ �������, ��������� ������� ����� �������
% ������� ��� ������ �������
% server - ������, ���� ����������� �������. �� ��������� http://127.0.0.1:80/
%
% �������������� � ���� �������, ������ � �.�. ������ ���� ����������
% ������������� ��������������, ��������� ���-���� ���������� ��������.
if (nargin<1)
    fprintf(1,'Command unspecified. Unable to continue.');
else
    if (nargin<2)
        methodid=1; % �� ��������� - ��� ������
    end
    if (nargin<3)
        dataid=1; % �� ��������� - ��� ������ ������
    end
    if (nargin<4)
        adduserid=1; % �� ��������� - �����
    end
    if (nargin<5)
        predictminutes=60; % �� ��������� - ��� �� �������
    end
    if (nargin<5)
        taskgroupdata=0; % �� ��������� - ��� ��������� ������ �������
    end
    if (nargin<6)
        server='http://127.0.0.1:80/'; % �� ��������� - ��������� ������
    end
end

url=strcat(server,['/ParalelMatlabServer2/taskaddmany2.php']);
%$tasks=$_REQUEST['tasks'];
%$userid=$_REQUEST['userid'];
%$platformid=$_REQUEST['platformid'];
%$dataid=$_REQUEST['archiveid'];
%$methodid=$_REQUEST['methodid'];
%$processid=$_REQUEST['processid'];
%$curgroupname=$_REQUEST['curgroupname'];
%$taskgroupdata=$_REQUEST['taskgroupdata'];
%$filename=$_REQUEST['infile'];
%$predictminutes=$_REQUEST['predictminutes'];
params = {'tasks',command, 'userid',num2str(adduserid),'platformid','1',...
    'archiveid',num2str(dataid),'methodid',num2str(methodid),'taskgroupdata',...
    num2str(taskgroupdata),'filename','dj.txt','predictminutes',num2str(predictminutes)}; % 20130116 ������ ��� ��������
data=urlread(url,'POST',params);
[taskid,COUNT,ERRMSG,NEXTINDEX]=sscanf(data,'%d',1);
data=data(NEXTINDEX:length(data));
[taskgroupid,COUNT,ERRMSG,NEXTINDEX]=sscanf(data,'%d',1);
data=data(NEXTINDEX:length(data));
