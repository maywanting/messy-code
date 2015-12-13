<html>
<head>
	<meta http-equiv="Content-Type" content="text/html;charset=utf-8"/>
	<title>房贷还款计算</title>
</head>
<body>
	<form id="gobalData" name="gobalData" method="post" action="digital.php">
		<input type="hidden" name="token" value="start"/>
		<div>
			<label for="yearPay">年还款（万元）</label>
			<input type="text" name="yearPay" id="yearPay"/>
		</div>
		<div>
			<label for="yearInterest">银行年利率（%）</label>
			<input type="text" name="yearInterest" id="yearInterest"/>
		</div>
		<div>
			<label for="salary">起始工资（万/年）</label>
			<input type="text" name="salary" id="salary" />
		</div>
		<div>
			<label for="salaryInterAdd">工资年增长率增长幅度</label>
			<input type="radio" name="salaryInterAdd" value="1"/>1%
			<input type="radio" name="salaryInterAdd" value="0.5"/>0.5%
		</div>
		<div>
			<label for="year">起始年份</label>
			<input type="text" name="year" id="year"/>
		</div>
		<div>
			<input type="submit" name="submit" value="确定"/>
		</div>
	</form>
</body>
</html>