#!/bin/bash

#: Database report runner
#:
#: Arguments:
#:		1) The type of reports to run (e.g. daily, tri_weekly, weekly)
#:
#: Author: Fastily

ENWIKI="ruwiki"
COMMONSWIKI="commonswiki"

REPORT_DIR=~/"public_html/r"
SCRIPT_DIR=~/"scripts"

##
# Print usage information and exit
##
usage() {
	printf "Usage: %s [daily|tri_weekly|weekly]\n" "${0##*/}"
	exit
}

##
# Runs a MySQL query against the labs replica database and puts the result in ~/public_html/r.
#
# Arguments:
#	1) The database to use (e.g. 'enwiki', 'commonswiki')
#	2) Path(s) to the sql file(s) to execute
##
do_query() {
	for s in ${@:2}; do
		printf -v report_file "%s/%s.txt" "$REPORT_DIR" "$s"
		mysql --defaults-file=~/"replica.my.cnf" -q -r -B -h "${1}.analytics.db.svc.wikimedia.cloud" "${1}_p" <  "${SCRIPT_DIR}/${s}.sql" > "$report_file"
		sed -i -e "1,3d" "$report_file" # First two lines are junk
	done
}

##
# Get the intersection of two sorted reports and save the result in ~/public_html/r.
#
# Arguments:
#	1) The id of the first file to use.  This should be the smaller file (it will be loaded into memory)
#	2) The id of the second file to use.  This should be the larger file
#	3) The output file id
##
intersection() {
	awk 'NR==FNR { lines[$0]=1; next } $0 in lines' "${REPORT_DIR}/${1}.txt" "${REPORT_DIR}/${2}.txt" > "${REPORT_DIR}/${3}.txt"
}

##
# Generates the tri-weekly reports (currently this is just report1)
##
generate_tri_weekly() {
	do_query $COMMONSWIKI raw2
	do_query $ENWIKI raw5

	intersection raw5 raw2 report1
	sed -i -e 's|\t.*||' "${REPORT_DIR}/report1.txt"
}


if [ $# -lt 1 ]; then
	usage
fi

case "$1" in
	weekly)
		do_query $COMMONSWIKI raw1
		do_query $ENWIKI raw3 raw4
#		do_query $ENWIKI report2 report3 report4 report5 report6 report7 report8 report9 report10 report12 report15 report17

#		generate_tri_weekly

		intersection raw3 raw1 report11
		python3 process_raw_reports.py 13 16
		;;
	tri_weekly)
		generate_tri_weekly
		;;
	daily)
		do_query $ENWIKI report14
		;;
	*)
		printf "Not a known argument: %s\n\n" "$1"
		usage
		;;
esac
