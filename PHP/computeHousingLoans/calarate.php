<?php
function getResult($data) {
	$resData = array();
	for ($i = 0; $data['originPay'] >= 0 && $i <= $_POST['payYear']; $i++) {
		$res = array();
		$res['id'] = $i;   //序号
		$res['year'] = $_POST['year'] + $i;   //年份
		
		$data['salary'] = getYearSalary($data['salary'], $i);   //本年的工资
		$temp = $data['originPay'] - $_POST['yearPay'];
		$res['resNum'] = $temp * ($_POST['yearInterest'] * 0.01 + 1) + $data['salary'];  //本年交完房贷的余额
		$data['originPay'] = $res['resNum'];     //储存
		$resData[] = $res;
	}

	return $resData;
}

function getYearSalary($salary, $i) {
	$interest = 3 + $_POST['salaryInterAdd'] * $i;
	$interest = ($interest >= 10) ? 10 : $interest;  //增长率为10%封顶
	return $salary * ($interest * 0.01 + 1);
}

function getRightOrigin($data) {
	for ($money = 20; $money <= 30; $money++) {
		$data['originPay'] = $money;
		$res = getResult($data); //以此获取每个还款金额的每年变化情况
		$length = count($res);
		if ($res[$length-1]['resNum'] >= 0) {  //若最后一个期限年的由余额，则表明该金额为最小起始还款金额
			return $money;
		}
	}
	return 31; //表明女方家庭已承受不起起始还款金额
}
?>