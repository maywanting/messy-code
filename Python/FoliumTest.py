#!/usr/bin/env python
# encoding: utf-8

import folium

m = folium.Map(location=[34.0000, 135.0000], zoom_start=5, )

m.save("test.html")
