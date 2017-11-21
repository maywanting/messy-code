#!/usr/bin/env python
# encoding: utf-8

import pandas as pd
import numpy as np
from pandas import HDFStore

a = np.random.standard_normal((9, 4))
#  b = np.ones(a.shape, 3)
#  print(b)
#  exit()

#  for i, x in enumerate(a):
    #  for j, y in enumerate(x):
        #  a[i][j] = z

#  print(a)
#  exit()
b = pd.DataFrame(a)

#  b.columns = [['num1', 'num2', 'num3', 'num4']]
#  b.columns = pd.date_range('2017-01-01 00:01:00', '2017-01-01 03:01:00', freq='H')
#  print(pd.date_range('2051-07-01 00:01:00', '2051-07-31 23:02:00', freq='H'))
#  print(31 * 24)

#  exit()
#  print(a)
#  print(b)

h5 = pd.HDFStore('store.h5', 'w')
h5['data'] = a
h5.close()

print("============")

h5 = pd.HDFStore('store.h5', 'r')
print(h5['data'])
h5.close()

