#!/bin/sh
echo `date`
echo ' stock_china_front.sh start'

/usr/local/bin/php /home/wozhad3j/scripts/job.php -bdc -tworkflow -schina_a_finance_news -asave_sh_finance_news >/dev/null 2>&1 
/usr/local/bin/php /home/wozhad3j/scripts/job.php -bdc -tworkflow -schina_a_finance_news -asave_sz_finance_news >/dev/null 2>&1 
/usr/local/bin/php /home/wozhad3j/scripts/job.php -bdc -tworkflow -schina_hk_finance_news -asave_finance_news >/dev/null 2>&1 

echo `date`
echo ' stock_china_front.sh completed'

分钟	小时	天	月份	工作日	命令	操作
1	21	*	*	*	/bin/sh /home/wozhad3j/scripts/stock_us_china_end.sh	编辑   删除
1	10	*	*	*	/bin/sh /home/wozhad3j/scripts/stock_china_end.sh	编辑   删除
1	0	*	*	*	/bin/sh /home/wozhad3j/scripts/stock_china_front.sh	编辑   删除
1	12	*	*	*	/bin/sh /home/wozhad3j/scripts/stock_us_china_front.sh	编辑   删除