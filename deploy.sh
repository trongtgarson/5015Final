#!/bin/sh -v

rsync -a . tua20258@cis-linux2:~/public_html/5015/Final/
ssh tua20258@cis-linux2 "chmod -R 755 ~/public_html/5015/Final"
ssh tua20258@cis-linux2 "rm ~/public_html/5015/Final/php/config/core.php"
ssh tua20258@cis-linux2 "mv ~/public_html/5015/Final/php/config/core_prod.php ~/public_html/5015/Final/php/config/core.php"
