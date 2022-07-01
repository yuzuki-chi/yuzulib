#/bin/bash

cd `dirname $0`
CWD=$(pwd)

DATE=`TZ='Asia/Tokyo' date`
echo $DATE >> "$CWD/git-cron.log"

git fetch

# Remote branch log
GITREMOTE=$(git log main origin/main --pretty=format:"%H" | head -n 1)

# Local branch log
GITLOCAL=$(git log -n 1 --pretty=format:"%H")

if [ "$GITREMOTE" = "$GITLOCAL" ] ; then
    echo 'no changed' >> "$CWD/git-cron.log"
else
    echo 'Remote branch is changed' >> "$CWD/git-cron.log"
    git pull origin main

    curl -X POST -H 'Content-type: application/json' --data '{"text":"Hello, World!"}' $(cat .webhookurl)
fi