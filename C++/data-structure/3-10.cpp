#include <iostream>
#include <math.h>
#include <iomanip>

using namespace std;

double math1()
{
	double sum = 0, temp = 0;
	for (int i = 1; i <= 100; i++)
	{
		temp = 6.0 / (i*i);
		sum += temp;
	}
	return sqrt(sum);
}

double math2()
{
	double temp_plus, temp_minus;
	double sum_plus = 0, sum_minus = 0;

	for (int i = 1; i <= 19997; i = i+4)
	{
		temp_plus = 4.0 / i;
		temp_minus = 4.0 / (i+2);
		sum_plus += temp_plus;
		sum_minus += temp_minus;
	}

	return sum_plus - sum_minus;
}

double math3()
{
	double res = 2;

	for (int i = 2; i <=19998; i = i+2)
	{
		res *= i * i;
		res /= (i-1) * (i+1);
	}

	return res;
}

void math4(int n)
{
	int res = 1;

	for (int i = 1; i <= n; i++)
	{
		res = (res * 2) % 1000;
	}

	cout << "第四题结果" << setfill('0') << setw(3) << res;
}

int main ()
{
	int temp;
	cout << "第一题结果：" << math1 () << endl;
	cout << "第二题结果：" << math2 () << endl;
	cout << "第三题结果：" << math3 () << endl;
	math4 (10);

	return 0;
}
