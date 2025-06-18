<!---------------------------------------------------------------------------------------------
	제목 : 내 손으로 만드는 PHP 쇼핑몰 (실습용 디자인 HTML)

	소속 : 인덕대학교 컴퓨터소프트웨어학과
	이름 : 교수 윤형태 (2024.02)
---------------------------------------------------------------------------------------------->
<?
    include "../common.php";
    $id=$_REQUEST["id"];
    $sql = "select * from jumun where id='$id'";
    $result=mysqli_query($db,$sql); 
    if (!$result) exit("에러:$sql");
	$row=mysqli_fetch_array($result);

	if($row["id"] != 0)
		$cus_re = "회원";
	else
		$cus_re = "비회원";

	
	if($row["card_kind"] == 0 )
		$card_ki = "해당없음";
	else{
		$card_ki = $card[$row["card_kind"]];
	}
	
			
	if($row["card halbu"] != 0){
		$card_halnu = $row["card halbu"] . "개월";
	}else{
		$card_halnu = "일시불";
	}

	if($row["pay_kind"] == 1){
		$pay_kind = "계좌 정보 표시";
	}else{
		$pay_kind = "";
	}


    $state = $row["state"];
	$state = $a_state[$state];

   $tel1=trim(substr($row["o_tel"],0,3));        // 0번 위치에서 3자리 문자열 추출
   $tel2=trim(substr($row["o_tel"],3,4));        // 3번 위치에서 4자리
   $tel3=trim(substr($row["o_tel"],7,4));

   $r_tel1=trim(substr($row["r_tel"],0,3));        // 0번 위치에서 3자리 문자열 추출
   $r_tel2=trim(substr($row["r_tel"],3,4));        // 3번 위치에서 4자리
   $r_tel3=trim(substr($row["r_tel"],7,4));




//    $sql_join = "SELECT product.name, jumuns.num, jumuns.price, product.discount, opts1.name AS opts1_name, opts2.name AS opts2_name, jumuns.prices, jumun.totalprice
//              FROM jumuns
//              JOIN product ON jumuns.product_id = product.id
//              JOIN opts AS opts1 ON jumuns.opts_id1 = opts1.id
//              JOIN opts AS opts2 ON jumuns.opts_id2 = opts2.id
//              JOIN jumun ON jumuns.jumun_id = jumun.id
//              WHERE jumuns.jumun_id = '$id'";

$sql_join = "SELECT 
				jumuns.product_id, 
				jumuns.num, 
				(SELECT name FROM opts WHERE id = jumuns.opts_id1) AS opts1_name, 
				(SELECT name FROM opts WHERE id = jumuns.opts_id2) AS opts2_name 
				FROM 
				jumuns, 
				product 
				WHERE 
				jumuns.product_id = product.id 
				AND jumuns.jumun_id = '$id'";


	$result1 = mysqli_query($db, $sql_join);
	if (!$result1) exit("에러:$sql_join");
	$row_join = mysqli_fetch_array($result1);

	// 결과가 있는지 확인




?>
<!doctype html>
<html lang="kr">
<head>
	<meta charset="utf-8">
	<meta name="viewport" content="width=device-width, initial-scale=1">
	<title>INDUK Mall</title>
	<link  href="../css/bootstrap.min.css" rel="stylesheet">
	<link  href="../css/my.css" rel="stylesheet">
	<script src="..js/jquery-3.7.1.min.js"></script>
	<script src="../js/bootstrap.bundle.min.js"></script>
	<script src="../js/my.js"></script>
</head>
<body>

<div class="container">
<!-------------------------------------------------------------------------------------------->	
<script> document.write(admin_menu());</script>
<!-------------------------------------------------------------------------------------------->	

<div class="row mx-1 justify-content-center">
	<div class="col-sm-10" align="center">

	<h4 class="m-0 mb-3">주문 ( </b><?=$row["id"];?><b> )</h4>

	<table class="table table-sm table-bordered mb-3">
		<tr>
			<td width="15%" class="bg-light">상태</td>
			<td width="35%"><?=$state;?></td>
			<td width="15%" class="bg-light">주문일</td>
			<td width="35%"><?=$row["jumunday"];?></td>
		</tr>
	</table>

	<table class="table table-sm table-bordered mb-2">
		<tr>
			<td width="15%" class="bg-light"><b>주문자</b></td>
			<td width="35%"><?=$row["o_name"];?></td>
			<td width="15%" class="bg-light">구분</td>
			<td width="35%"><?=$cus_re;?></td>
		</tr>
		<tr>
			<td class="bg-light">전화</td><td><?=$tel1;?>-<?=$tel2;?>-<?=$tel3;?></td>
			<td class="bg-light">E-Mail</td><td><?=$row["o_email"]?></td>
		</tr>
		<tr>
			<td class="bg-light">주소</td>
			<td align="left" colspan="3">&nbsp;(<?=$row["o_zip"]?>) <?=$row["o_juso"]?></td>
		</tr>
	</table>

	<table class="table table-sm table-bordered mb-3">
		<tr>
			<td width="15%" class="bg-light"><b>수신자</b></td>
			<td width="35%"><?=$row["r_name"];?></td>
			<td width="15%" class="bg-light"></td>
			<td></td>
		</tr>
		<tr>
			<td class="bg-light">전화</td>
			<td><?=$r_tel1;?>-<?=$r_tel2;?>-<?=$r_tel3;?></td>
			<td class="bg-light">E-Mail</td>
			<td><?=$row["r_email"];?></td>
		</tr>
		<tr>
			<td class="bg-light">주소</td>
			<td align="left" colspan="3">&nbsp;(<?=$row["r_zip"]?>) <?=$row["r_juso"]?></td>
		</tr>
		<tr height="50">
			<td class="bg-light">메모</td>
			<td align="left" valign="top" colspan="3">&nbsp; <?=$row["memo"]?></td>
		</tr>
	</table>

	<table class="table table-sm table-bordered mb-3">
		<tr>
			<td width="15%" class="bg-light"><b>카드</b></td>
			<td width="35%"><?=$card_ki?></td>
			<td width="15%" class="bg-light">승인</td>
			<td width="35%"><?=$row["card_okno"];?></td>
		</tr>
		<tr>
			<td class="bg-light">할부</td><td><?=$card_halnu?></td>
			<td class="bg-light"></td><td></td>
		</tr>
		<tr>
			<td class="bg-light"><b>무통장</b></td><td><?=$pay_kind;?></td>
			<td class="bg-light">입금자</td><td><?=$row["bank_sender"];?></td>
		</tr>
	</table>

	<table class="table table-sm table-bordered mb-3">
		<tr class="bg-light">
			<td>제품명</td>
			<td width="10%">수량</td>
			<td width="10%">단가</td>
			<td width="10%">금액</td>
			<td width="10%">할인</td>
			<td width="20%">옵션</td>
		</tr>

		<?foreach($result1 as $row_join){
			
			$sql_to = "SELECT p.*, j.*
   				 FROM product p
    			JOIN jumuns j ON p.id = j.product_id
    			WHERE j.jumun_id = '$id' AND p.id = {$row_join['product_id']}";
			$result_to = mysqli_query($db, $sql_to);
			if (!$result_to) exit("에러:$sql_to");
			$row_to = mysqli_fetch_array($result_to);
			
			
				$sql_baso = "select * from jumuns where jumun_id='$id' and product_id=0";
				$result_baso = mysqli_query($db, $sql_baso);
				if (!$result_baso) exit("에러:$sql_baso");
				$row_ba = mysqli_fetch_array($result_baso);	
			?>
		<tr>
			<td align="left"><?=$row_to["name"];?></td>
			<td><?=$row_to["num"];?></td>
			<td align="right"><?=number_format($row_to["price"]);?></td>
			<td align="right"><?=number_format($row_to["prices"]);?></td>
			<?php
				if ($row_to["discount"] > 0)
					echo "<td>{$row_to['discount']}%</td>";
				else
					echo"<td></td>";

				if(($row_join["opts1_name"] > 0) and ($row_join["opts2_name"] > 0)){
					echo"<td>{$row_join["opts1_name"]} / {$row_join["opts2_name"]}</td>";

				}else if(($row_join["opts1_name"] > 0) or ($row_join["opts2_name"] > 0))
					echo"<td>{$row_join["opts1_name"]}{$row_join["opts2_name"]}</td>";
				else
					echo"<td>옵션 없음</td>";
				?>
		</tr>
		<? 
		}
		if(mysqli_num_rows($result_baso) != 0 ){
			echo '<td align="left">택배비</td>';
			echo '<td>' . $row_ba["num"] . '</td>';
			echo '<td align="right">' . $row_ba["price"] . '</td>';
			echo '<td align="right">' . $row_ba["prices"] . '</td>';
			echo '<td></td>';
			echo '<td>옵션 없음</td>';
			$total = number_format($row["totalprice"] + $baesongbi) ;
		}
		else
			$total = number_format($row["totalprice"]);
		?>
	</table>

	<table class="table table-sm table-bordered mb-3 p-2">
		<tr>
			<td width="15%" class="bg-light">총금액</td>
			<td width="85%" align="right" style="font-size:18px"><b><?=$total;?>원</b>&nbsp;</td>
		</tr>
	</table>

	<a href="javascript:print();"  class="btn btn-sm btn-dark text-white my-2">&nbsp;프린트&nbsp;</a>&nbsp;
	<a href="javascript:history.back();"  class="btn btn-sm btn-outline-dark my-2">&nbsp;돌아가기&nbsp;</a>

	</div>
</div>
<!-------------------------------------------------------------------------------------------->	
</div>

</body>
</html>
