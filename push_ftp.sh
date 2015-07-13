#!/bin/sh

# Configurations Access FTP
# http://www.dewep.net/Blog/Article-29/Script-shell-pour-synchroniser-vos-fichiers-sur-FTP

ftp_user="$1"
ftp_pass="$2"
ftp_host="$3"


# Configurations Update

path_local="`pwd`/"
path_remote="/www"
exclude=".git/"

# Start Update

lftp "ftp://${ftp_user}:${ftp_pass}@${ftp_host}" -e "mirror --verbose=3 -e -R -x ${exclude} ${path_local} ${path_remote};quit;"
