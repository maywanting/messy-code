import numpy as np

a = np.array([[1, 2], [3, 4], [5, 6]])

print(a)

bool_idx = (a > 2)

print(bool_idx)

print(a[bool_idx])

print(a[a > 2])

x = np.array([[1, 2], [3, 4]])
y = np.array([[5, 6], [7, 8]])

print(x.dot(y))


