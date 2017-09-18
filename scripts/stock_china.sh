#!/bin/sh
/usr/local/bin/php php_job.php -bdc -tscript -sSpider_china_sh_code_list -aget
/usr/local/bin/php php_job.php -bdc -tworkflow -schina_sh -asave_price

/usr/local/bin/php php_job.php -bdc -tscript -sSpider_china_sz_code_list -aget
/usr/local/bin/php php_job.php -bdc -tworkflow -schina_sz -asave_price

/usr/local/bin/php php_job.php -bdc -tscript -sSpider_china_hk_code_list -aget
/usr/local/bin/php php_job.php -bdc -tworkflow -schina_hk -asave_price