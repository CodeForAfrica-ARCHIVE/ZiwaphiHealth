#!/bin/bash

echo "Show files that are being accessed the most on the domain specified $2"
/home/$1/logs/$2/http# awk '{print
$7}' access.log|cut -d? -f1|sort|uniq -c|sort -nk1|tail -n10

exit
