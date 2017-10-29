#!/usr/bin/env python
# encoding: utf-8

from scipy.misc import imread, imsave, imresize

img = imread('./20151115_1.png')

#print(img)
print(img.dtype, img.shape)

#调节rpg
img_tinted = img * [2, 0.95, 0.9]

#调节图片像素
img_tinted = imresize(img_tinted, (300, 900))

imsave('20151115_2.png', img_tinted)
