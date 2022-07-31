date=$(date +%d%m%y)
filename=$(echo $date".sqldump")
filepath="$HOME/qset/inventory/backups"
mkdir -p $filepath
mysqldump -u qset -pspace120 inventory > $filepath/$filename