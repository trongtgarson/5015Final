#!/bin/sh -v

rsync -a client/ tua20258@cis-linux2:~/public_html/5015/Final/
ssh tua20258@cis-linux2 "chmod -R 755 ~/public_html/5015/Final"
