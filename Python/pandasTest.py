#!/usr/bin/env python
# encoding: utf-8

from pandas import Series, DataFrame
import pandas as pd

pop = {
    'aaa' : {0:1, 1:2, 2:3},
    'bbb' : {0:4, 1:5, 2:6},
    'ccc' : {0:7, 1:8, 2:9},
}

frame3 = DataFrame(pop)
print(frame3)
