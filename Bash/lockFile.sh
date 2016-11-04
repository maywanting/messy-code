#!/usr/bin/bash
pidFile=/home/may/workspace/shell/lockFile.pid
LockFile()
{
    if [ -f "$pidFile" ]; then
        pid=$(cat $pidFile)
        process=$(ps axwu | grep $pid | grep lockFile)
        if [ ! -z "$process" ]; then
            # 暴力干掉
            kill -9 $pid
        fi
    fi
}

LockFile
echo $$ > $pidFile

while true
do
    echo $num
    num=`expr $num + 1`
    sleep 1s
done
