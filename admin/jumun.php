<!---------------------------------------------------------------------------------------------
	제목 : 내 손으로 만드는 PHP 쇼핑몰 (실습용 디자인 HTML)

	소속 : 인덕대학교 컴퓨터소프트웨어학과
	이름 : 교수 윤형태 (2024.02)
---------------------------------------------------------------------------------------------->
<?php
    include "../common.php";

     $sel1=$_REQUEST["sel1"] ? $_REQUEST["sel1"] : 0;
     $sel2=$_REQUEST["sel2"] ? $_REQUEST["sel2"] : 1;
     $day1=$_REQUEST["day1"] ? $_REQUEST["day1"] : date("Y-m-d", strtotime("-1 month"));
     $day2=$_REQUEST["day2"] ? $_REQUEST["day2"] : date("Y-m-d");
     $text1=$_REQUEST["text1"] ? $_REQUEST["text1"] : "";
	 $page1=$_REQUEST["page"] ? $_REQUEST["page"] : 1;

	

	 
	 $o_day = " WHERE jumunday BETWEEN '$day1' AND '$day2' ";

	 // 상태 조건
	 $s = ($sel1 != 0) ? " AND state=$sel1 " : "";
	 
	 // 검색 조건
	 switch($sel2) {
		 case 1:
			 $o = "id LIKE '%$text1%' ";
			 break;
		 case 2:
			 $o = "o_name LIKE '%$text1%' ";
			 break;
		 case 3:
			 $o = "product_names LIKE '%$text1%' ";
			 break;
	 }
	 
	 // 최종 SQL 쿼리
	 $sql = "SELECT * FROM jumun $o_day $s AND $o order by id desc";
	 
	

	$co = "select * from jumun "; // 주문개수 찾는 sql 
	$result1 = mysqli_query($db ,$co);
	$counts = mysqli_num_rows($result1);  

	$args="day1=$day1&day2=$day2&sel1=$sel1&sel2=$sel2&text1=$text1";
	$result = mypagination($sql, $args, $count, $pagebar);
	$row=mysqli_fetch_array($result);
    if (!$result) exit("에러:$sql");
    


    

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

<script>
	function go_update(id,pos)
	{
		state=form1.state[pos].value;
		location.href="jumun_update.php?id="+id+"&state="+state+"&page="+form1.page.value+
			"&sel1="+form1.sel1.value+"&sel2="+form1.sel2.value+"&text1="+form1.text1.value+
			"&day1="+form1.day1.value+"&day2="+form1.day2.value;
	}
</script>



<div class="row mx-1 justify-content-center">
	<div class="col" align="center">

		<h4 class="m-0 mb-3">주문</h4>

		<form name="form1" method="post" action="jumun.php">
		
		<input type="hidden" name="page" value="<?= $page1 ?>">
		<input type="hidden" name="sel1" value="<?= $sel1 ?>">
		<input type="hidden" name="sel2" value="<?= $sel2 ?>">
		<input type="hidden" name="text1" value="<?= $text1 ?>">
		<input type="hidden" name="day1" value="<?= $day1 ?>">
		<input type="hidden" name="day2" value="<?= $day2 ?>">

		<table class="table table-sm table-borderless m-0 p-0">
			<tr>
				<td width="20%" align="left" style="padding-top:8px">
					주문수 : <font color="red"><?=$counts;?></font>
				</td>
				<td align="right">
				
					기간:
					<div class="d-inline-flex">
						<input type="date" name="day1" value="<?= $day1?>" 
							class="form-control form-control-sm"  style="width:120px" >~
						<input type="date" name="day2" value="<?= $day2?>" 
							class="form-control form-control-sm" style="width:120px" >
					</div>
					<div class="d-inline-flex">
                                <?
                                echo('<select name="sel1" class="form-select bg-light myfs12" style="width:105px">');
                                for($i=0;$i<$n_state;$i++)
                                {
                                    $tmp = ($i==$sel1) ? "selected" : "";
                                    echo("<option value='$i' $tmp>$a_state[$i]</option>");
                                }
                                echo("</select>");
                                ?>
						<select name="sel2" class="form-select bg-light myfs12" style="width:105px">
							<option value="1" <?=$sel2 == 1 ? "selected" : ""?>>주문번호</option>
							<option value="2" <?=$sel2 == 2 ? "selected" : ""?>>고객명</option>
							<option value="3" <?=$sel2 == 3 ? "selected" : ""?>>상품명</option>
						</select>
					</div>
					<div class="d-inline-flex">
						<div class="input-group input-group-sm">
							<input type="text" name="text1" value="<?=$text1;?>" 
								class="form-control myfs12" style="width:100px" 
								onKeydown="if (event.keyCode == 13) { form1.submit(); }"> 
							<button class="btn mycolor1 myfs12" type="button" 
								onClick="form1.submit();">검색</button>
						</div>
					</div>
					
				</td>
			</tr>
		</table>
		



		<table class="table table-sm table-bordered table-hover my-1">
			<tr class="bg-light">
				<td >주문번호</td>
				<td >주문일</td>
				<td >제품명</td>
				<td width="5%">제품수</td>
				<td>금액</td>
				<td>주문자</td>
				<td width="5%">결제</td>
				<td width="25%">주문상태</td>
				<td width="5%">삭제</td>
			</tr>
			<? 
					$temp_state = 0;
					foreach($result as $row){

					$state=$row["state"];
					
					$color="black";
					if ($state==5)  $color="blue";  // 주문완료 
					if ($state==6)  $color="red";   // 주문취소
					


					$jumun_id = $row["id"]; 
					$name = $row["product_names"];
					$num = $row["product_nums"];

					$total_price = $row["totalprice"];
					$total_price = number_format($total_price);

					$jumunday = $row["jumunday"];
					$o_name = $row["o_name"];

					$card_kind = $row["card_kind"];
					$card_kind = ($row["card_kind"] == 1) ? "무통장" : "카드";

				?>
			<tr>
				
				<td class="mywordwrap">
					<a href="jumun_info.php?id=<?=$jumun_id?>" style="color:#0085dd"><?=$jumun_id;?></a>
				</td>
				<td><?=$jumunday;?></td>
				<td align="left" class="mywordwrap"><?=$name;?></td>	
				<td><?=$num;?></td>	
				<td align="right" class="mywordwrap"><?=$total_price;?></td>	
				<td><?=$o_name;?></td>	
				<td><?=$card_kind;?></td>	
				<td>
					<div class="d-sm-inline-flex">
					

						<?
                               echo '<select name="state" class="form-select form-select-sm myfs12 me-1" style="color:' . $color . '">';
                                for($col=1;$col<$n_state;$col++)
                                {
                                    $tmp = ($col==$state) ? "selected" : "";
                                    echo("<option value='$col' $tmp>$a_state[$col]</option>");
                                }
                                echo("</select>");
                                ?>

						<a href="javascript:go_update('<?=$jumun_id;?>',<?=$temp_state;?>);" 
							class="btn btn-sm mybutton-blue" style="width:50px;">수정</a>
					</div>
				</td>
				<td>
					<a href="jumun_delete.php?id=<?=$jumun_id;?>" 
						class="btn btn-sm mybutton-red" 
						onclick="javascript:return confirm('삭제할까요 ?');">삭제</a>				
				</td>
			</tr>
		
			<?
				$temp_state++;
				}
				
			?>
		</table>
		</form>
		
		<input type="hidden" name="state">	
		
		

		<?
    echo  $pagebar;            // pagination bar 표시
	?>

	</div>
</div>
<!-------------------------------------------------------------------------------------------->	
</div>

</body>
</html>
