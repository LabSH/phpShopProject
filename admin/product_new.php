<!---------------------------------------------------------------------------------------------
	제목 : 내 손으로 만드는 PHP 쇼핑몰 (실습용 디자인 HTML)

	소속 : 인덕대학교 컴퓨터소프트웨어학과
	이름 : 교수 윤형태 (2024.02)
---------------------------------------------------------------------------------------------->
<?
	$today = date("Y-m-d");            // 결과 : 2008-01-01
		
	include "../common.php";
	
	$sql = "Select  *  from opt";
	
	$result = mysqli_query($db,$sql);
	$row=mysqli_fetch_array($result);
	
	
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

<form name="form1" method="post" action="product_insert.php" enctype="multipart/form-data">

<div class="row mx-1  justify-content-center">
	<div class="col" align="center">

		<h4 class="m-0 mb-3">제품</h4>

		<table class="table table-sm table-bordered myfs12 m-0 p-0">
			<tr>
				<td width="15%" class="bg-light">상품분류</td>
				<td align="left" class="ps-2">
					<div class="d-inline-flex">
						<?
					echo("<select name='sel3'>");
					for($i=0;$i<$n_menu;$i++)
					{
						$tmp = ($i==$sel3) ? "selected" : "";
						echo("<option value='$i' $tmp>$a_menu[$i]</option>");
					}
					echo("</select>");
					?>
					</div>
				</td>
			</tr>
			<tr>
				<td class="bg-light">상품코드</td>
				<td align="left" class="ps-2">
					<div class="d-inline-flex">
						<input type="text" name="code" size="20" value="" class="form-control form-control-sm">
					</div>
				</td>
			</tr>
			<tr>
				<td class="bg-light">상품명</td>
				<td align="left" class="ps-2">
					<div class="d-inline-flex">
						<input type="text" name="name" size="80" value="" class="form-control form-control-sm">
					</div>
				</td>
			</tr>
			<tr>
				<td class="bg-light">제조사</td>
				<td align="left" class="ps-2">
					<div class="d-inline-flex">
						<input type="text" name="coname" size="30" value="" class="form-control form-control-sm">
					</div>
				</td>
			</tr>
			<tr>
				<td class="bg-light">판매가</td>
				<td align="left" class="ps-2">
					<div class="d-inline-flex">
						<input type="text" name="price" size="12" value="" class="form-control form-control-sm">
					</div> 원
				</td>
			</tr>
			<tr>
				<td class="bg-light">옵션</td>
				<td align="left" class="ps-2">
					<div class="d-inline-flex">
						<select name="opt1" class="form-select form-select-sm bg-light myfs12 me-2" style="width:100px">
							<option value="0" selected>옵션1 선택</option>
							<?
								 foreach ($result as $row){
									echo("<option value='" . $row['id'] . "'>" . $row['name'] . "</option>");
								 }
							?>
						</select>
						
						
						<select name="opt2" class="form-select form-select-sm bg-light myfs12 me-2" style="width:100px">
							<option value="0" selected>옵션2 선택</option>
							<?
								mysqli_data_seek($result,0);
								foreach ($result as $row){
									echo("<option value='" . $row['id'] . "'>" . $row['name'] . "</option>");
								 }
							?>
						
						</select>&nbsp;
					</div>
				</td>
			</tr>
			<tr>
				<td class="bg-light">제품설명</td>
				<td align="left" class="ps-2">
					<div class="d-inline-flex">
						<textarea name="contents" rows="5" cols="80" class="form-control form-control-sm myfs12"></textarea>
					</div>
				</td>
			</tr>
			<tr>
				<td class="bg-light">삼품상태</td>
				<td align="left" class="ps-2">
					<div class="form-check form-check-inline pt-2">
						<input class="form-check-input" type="radio" name="status" value="1" checked>
						<label class="form-check-label me-2">판매중</label>
					</div>
					<div class="form-check form-check-inline">
						<input class="form-check-input" type="radio" name="status" value="2">
						<label class="form-check-labe me-2">판매중지</label>
					</div>
					<div class="form-check form-check-inline">
						<input class="form-check-input" type="radio" name="status" value="3">
						<label class="form-check-label me-2">품절</label>
					</div>
				</td>
			</tr>
			<tr>
				<td class="bg-light">아이콘</td>
				<td align="left" class="ps-2">
						<div class="form-check form-check-inline">
							<input class="form-check-input" type="checkbox" value="1" name="icon_new">
							<label class="form-check-label me-2">New</label>
						</div>
						<div class="form-check form-check-inline">
							<input class="form-check-input" type="checkbox" value="1" name="icon_hit">
							<label class="form-check-label me-2">Hit</label>
						</div>
						<div class="form-check form-check-inline">
							<input class="form-check-input" type="checkbox" value="1" name="icon_sale">
							<label class="form-check-label me-2">sale</label>
						</div>
						할인율: &nbsp;
						<div class="d-inline-flex">
							<input type="text" name="discount" value="" size="2" maxlength="3" class="form-control form-control-sm">
						</div> %
				</td>
			</tr>
			<tr>
				<td class="bg-light">등록일</td>
				<td align="left" class="ps-2">
					<div class="d-inline-flex">
						<input type="date" name="regday" value="<?=$today?>" class="form-control form-control-sm">
					</div>
				</td>
			</tr>
			<tr>
				<td class="bg-light">이미지</td>
				<td align="left" class="ps-2">
					<b>이미지1 : </b>&nbsp;
					<div class="d-inline-flex mb-1">
						<input type="file" name="image1" class="form-control form-control-sm myfs12">
					</div>
					<br>
					<b>이미지2 : </b>&nbsp;
					<div class="d-inline-flex mb-1">
						<input type="file" name="image2" class="form-control form-control-sm myfs12">
					</div>
					<br>
					<b>이미지3 : </b>&nbsp;
					<div class="d-inline-flex">
						<input type="file" name="image3" class="form-control form-control-sm myfs12">
					</div>
				</td>
			</tr>
		</table>

		<a href="javascript:form1.submit();"  class="btn btn-sm btn-dark text-white my-2">&nbsp;저 장&nbsp;</a>&nbsp;
		<a href="javascript:history.back();"  class="btn btn-sm btn-outline-dark my-2">&nbsp;돌아가기&nbsp;</a>

	</div>
</div>
<br>
<!-------------------------------------------------------------------------------------------->	
</div>

</body>
</html>
