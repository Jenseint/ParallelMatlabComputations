function dataid=sendnewfiles_data(serverweb,archfilename,userid,descr);
% ������� ��� �������� ����������� ��������� �� ������.
% ������������ �������������� �������� 1) ������ ���� (��� ���������
% ������) 2) ��������� �������� � �������, ������� ��� ������� ���������. 
% 3) �� �������� �� ����� ����������� ���. 
%serverweb=
%data = urlread(strcat(serverweb,['/ParalelMatlabServer2/datagetfilesize.php?pid=' num2str(pid) '&dataid=' num2str(curdataid) '&taskid='  num2str(num_task) '&taskgroupid=' num2str()]));
data = urlread(strcat(serverweb,['/ParalelMatlabServer2/datagetnewdataid.php?uid=' num2str(userid)])); %20130116 ������ ����� �������
[dataid,COUNT,ERRMSG,NEXTINDEX] = sscanf(data,'%d',1);
filelen=0; % debugging
blocksize=100000;
fp=fopen(archfilename,'rb');
if (fp)
    % fseek(fp,0,1); % ����������� � �����
    % offs=ftell(fp);
    fseek(fp,filelen,0);
    while ~feof(fp)
        block=fread(fp,blocksize,'uint8=>uint8');
        req=wwwput_my_data(serverweb,block,filelen,userid,descr,dataid,archfilename);
        filelen=filelen+blocksize;
    end
    fclose(fp);
end
%dataid=req;
