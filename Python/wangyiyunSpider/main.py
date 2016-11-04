#!/usr/bin/env python
#encoding:utf-8

import urllib2
import urllib
import os
import re
import sys
import xlwt
import time

print sys.getdefaultencoding()

def getNum(accountId):
    baseUrl = "http://music.163.com/user/follows?id="
    url = baseUrl + "{:0>8d}".format(accountId)
    try:
        html = urllib2.urlopen(url).read()
    except urllib2.URLError, e:
        now = time.strftime("%Y-%m-%d %X", time.localtime(time.time()))
        print "%d(%s):error %s" % (accountId, now, e.reason)
        return []

    result = re.findall('<div class="n-for404">', html)
    if result == []:
        value = re.findall('tit f-ff2 s-fc0">(.*?)<.*?u-icn2-lev">(.*?)<', html)[0]
        name = value[0]; level = value[1]
        followNum = re.findall('id="follow_count">(.*?)<', html)[0]
        fanNum = re.findall('id="fan_count">(.*?)<', html)[0]
        now = time.strftime("%Y-%m-%d %X", time.localtime(time.time()))
        print "%d(%s):exist %s %s %s %s" % (accountId, now, name.decode('utf-8'), level, followNum, fanNum)

        return [name.decode('utf-8'), level, followNum, fanNum]
    else:
        now = time.strftime("%Y-%m-%d %X", time.localtime(time.time()))
        print "%d(%s):not exist" % (accountId, now)
        return []

def main():
    numBook = xlwt.Workbook(encoding = 'ascii')
    sheet = numBook.add_sheet('0')
    sheet.write(0, 0, 'id')
    sheet.write(0, 1, 'name')
    sheet.write(0, 2, 'level')
    sheet.write(0, 3, 'follow')
    sheet.write(0, 4, 'fan')

    flag = 1; file = 0

    for k in range(1, 9999):
        for accountId in range(1+10000*k, 9999 + 10000*k):
            result = getNum(accountId)
            if result != []:
                sheet.write(flag, 0, accountId)
                sheet.write(flag, 1, result[0])
                sheet.write(flag, 2, result[1])
                sheet.write(flag, 3, result[2])
                sheet.write(flag, 4, result[3])
                flag += 1

            if (flag >= 1000):
                filename = "file%d.xls" % file
                numBook.save(filename)
                file += 1; flag = 1
                numBook = xlwt.Workbook(encoding='ascii')
                sheet = numBook.add_sheet('0')
                sheet.write(0, 0, 'id')
                sheet.write(0, 1, 'name')
                sheet.write(0, 2, 'level')
                sheet.write(0, 3, 'follow')
                sheet.write(0, 4, 'fan')

    filename = "file%d.xls" % file
    numBook.save(filename)

    print "over!!!!"

if __name__ == "__main__":
    main()
