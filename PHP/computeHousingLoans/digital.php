<?php
	include_once 'calarate.php';
	if ($_POST['token'] == "result") {
		$datas = getResult($_POST);   //获取每年的情况数组
		$minMoney = getRightOrigin($_POST);  //获取最小起始金额
	}
?>
<html>
<head>
	<meta http-equiv="Content-Type" content="text/html;charset=utf-8"/>
	<title>房贷还款计算</title>
</head>
<body>
	<p>当前信息：</p>
	<p>年还款：<?php echo $_POST['yearPay'];?>万元</p>
	<p>银行存款利率：<?php echo $_POST['yearInterest'];?>%</p>
	<p>起始工资：<?php echo $_POST['salary'];?>万每年</p>
	<p>工资年增长率：3%起始，年增加<?php echo $_POST['salaryInterAdd'];?>%</p>
	<p>起始年份：<?php echo $_POST['year'];?>年</p>

<!--以下为输出要求2-->
<?php if($_POST['token'] != 'start'):?>
	<table border="1px">
		<thead>
			<tr>
				<td>序号</td>
				<td>年份</td>
				<td>剩余金额</td>
			</tr>
		</thead>
		<tbody>
			<?php foreach ($datas as $data):?>
				<tr>
					<td><?php echo $data['id'];?></td>
					<td><?php echo $data['year'];?></td>
					<td><?php echo $data['resNum'];?></td>
				</tr>
			<?php endforeach;?>
		</tbody>
	</table>

<!--以下为输出要求1-->
	<p>最少需要：<?php echo $minMoney;?>万元</p>
<?php endif;?>

	<form method="post" action="digital.php" name="originPay">
		<input type="hidden" name="token" value="result"/>
		<input type="hidden" name="yearPay" value="<?php echo $_POST['yearPay'];?>"/>
		<input type="hidden" name="yearInterest" value="<?php echo $_POST['yearInterest'];?>"/>
		<input type="hidden" name="salary" value="<?php echo $_POST['salary'];?>"/>
		<input type="hidden" name="salaryInterAdd" value="<?php echo $_POST['salaryInterAdd'];?>"/>
		<input type="hidden" name="year" value="<?php echo $_POST['year'];?>"/>
		<div>
			<label for="originPay">起始还款金额(万元)</label>
			<input type="text" name="originPay" id="originPay" value="<?php echo (isset($_POST['originPay'])) ? $_POST['originPay'] : null;?>"/>
		</div>
		<div>
			<label for="payYear">还款年数</label>
			<input type="text" name="payYear" id="payYear" value="<?php echo (isset($_POST['payYear'])) ? $_POST['payYear'] : null;?>"/>
		<div>
			<input type="submit" name="submit" value="确定"/>
			<a href="./index.php">返回</a>
		</div>
	</form>

</body>
</html>