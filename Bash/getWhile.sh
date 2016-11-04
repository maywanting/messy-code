#!/bin/bash
cat /home/may/workspace/php/while.log | while read LINE
do
    pid=$(echo $LINE | awk '{print $1}')
    time=$(echo $LINE | awk '{print $2}')

    currentTime=$(date +%s)
    if [ $(($currentTime - $time)) -gt 180 ]; then
        # 超时，重启
        process=$(ps axwu | grep $pid | grep php\ whileTouch.php)
        if [ -z "$process" ]; then
            # 进程当机了，直接重启
            php /home/may/workspace/php/whileTouch.php &
        else
            # 进程死机了，掐掉重启
            kill -9 $pid
            php /home/may/workspace/php/whileTouch.php &
        fi
    fi
done
