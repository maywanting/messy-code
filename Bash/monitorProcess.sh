#!/bin/bash

appUrl=/home/may/workspace/shell/
monitorFile="$appUrl"monitored.php
logFile="$appUrl"data/monitor
monitorLogFile="$appUrl"data/monitorShell.log

# 单进程保护
pidFile="$appUrl"data/lockFile.pid
LockFile()
{
    if [ -f "$pidFile" ]; then
        pid=$(cat $pidFile)
        process=$(ps axwu | grep $pid | grep lockFile)
        if [ ! -z "$process" ]; then
            # 暴力干掉上一个
            kill -9 $pid
            echo "[$(date)]kill monitor shell\n" >> $monitorLogFile
        fi
    fi
}

LockFile
echo $$ > $pidFile
redisNum=(0 1 2 3 4)

for num in ${redisNum[@]};
do
    realLog="$logFile$num".log
    data=$(cat "$logFile$num.log")
    pid=$(echo $data | awk '{print $1}')
    redisNum=$(echo $data | awk '{print $2}')
    time=$(echo $data | awk '{print $3}')

    currentTime=$(date +%s)
    cha=`expr $currentTime - $time`
    if [ $(($currentTime - $time)) -gt 180 ]; then
        # 超时3min, 重启
        process=$(ps axwu | grep $pid | grep dataHandleNew\ $redisNum)
        if [ -z "$process" ]; then
            # 进程当机，直接重启
            /usr/bin/php $monitorFile $redisNum > /dev/null &
            echo "[$(date)]process $redisNum has dumped, restart it\n" >> $monitorFile
        else
            # 进程死机，掐掉重启
            kill -9 $pid
            /usr/bin/php $monitorFile $redisNum > /dev/null &
            echo "[$(date)]process $redisNum has dead, kill and restart it\n" >> $monitorFile
        fi
    fi
done
