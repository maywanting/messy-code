#!/usr/bin/python

import urllib
import urllib2
import re
import os

html = urllib.urlopen("https://www.zhihu.com/question/28781550").read()
img_urls = re.findall('img .*?src="(http.*?_b.*?)"', html)

if not os.path.exists('img'):
    os.mkdir('img')

x = 0
for img_url in img_urls:
    print img_url
    img_data = urllib.urlopen(img_url).read()
    file_name = '%d' %x
    x = x + 1
    output = open('img/'+file_name, 'wb')
    output.write(img_data)
    output.close()
    print "end"

