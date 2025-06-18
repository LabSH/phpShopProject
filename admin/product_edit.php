<!---------------------------------------------------------------------------------------------
	제목 : 내 손으로 만드는 PHP 쇼핑몰 (실습용 디자인 HTML)

	소속 : 인덕대학교 컴퓨터소프트웨어학과
	이름 : 교수 윤형태 (2024.02)
---------------------------------------------------------------------------------------------->
<?
    include "../common.php";
    $id=$_REQUEST["id"];
    
    
    $sql="select * from  product where id=$id";     // id번째 자료 읽기
	$sql1="select * from  opt order by name";
    $result=mysqli_query($db,$sql);
	$result1=mysqli_query($db,$sql1);
    if (!$result) exit("쿼리에러");
    
    $row=mysqli_fetch_array($result);    // 1레코드 읽기  
	$row1=mysqli_fetch_array($result1);
	if (!$result) exit("쿼리에러");

    $a_me = $row["menu"];
	$name = stripslashes($row["name"]);
	$contents = stripslashes($row["contents"]);

	$fname1 = $row["image1"];
	$fname2 = $row["image2"];
	$fname3 = $row["image3"];
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
	function imageView(strImage)
	{
		this.document.images["big"].src = strImage;
	}
</script>

<form name="form1" method="post" action="product_update.php" enctype="multipart/form-data">

<input type="hidden" name="sel1" value="">
<input type="hidden" name="sel2" value="">
<input type="hidden" name="sel3" value="">
<input type="hidden" name="sel4" value="">
<input type="hidden" name="text1" value="">
<input type="hidden" name="page" value="1">
<input type="hidden" name="id" value="<?=$id;?>">
<input type="hidden" name="fimage1" value="<?=$fname1; ?>">
<input type="hidden" name="fimage2" value="<?=$fname2; ?>">
<input type="hidden" name="fimage3" value="<?=$fname3; ?>">

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
						$tmp = ($i==$a_me) ? "selected" : "";
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
						<input type="text" name="code" size="20" value="<?=$row["code"];?>" class="form-control form-control-sm">
					</div>
				</td>
			</tr>
			<tr>
				<td class="bg-light">상품명</td>
				<td align="left" class="ps-2">
					<div class="d-inline-flex">
						<input type="text" name="name" size="80" value="<?=$name;?>" class="form-control form-control-sm">
					</div>
				</td>
			</tr>
			<tr>
				<td class="bg-light">제조사</td>
				<td align="left" class="ps-2">
					<div class="d-inline-flex">
						<input type="text" name="coname" size="30" value="<?=$row["coname"];?>" class="form-control form-control-sm">
					</div>
				</td>
			</tr>
			<tr>
				<td class="bg-light">판매가</td>
				<td align="left" class="ps-2">
					<div class="d-inline-flex">
						<input type="text" name="price" size="12" value="<?=$row["price"];?>" class="form-control form-control-sm">
					</div> 원
				</td>
			</tr>
			<tr>
				<td class="bg-light">옵션</td>
				<td align="left" class="ps-2">
					<div class="d-inline-flex">
						<select name="opt1" class="form-select form-select-sm bg-light myfs12 me-2" style="width:100px">
						<option value="0" selected>옵션1 선택</option>
							<? foreach($result1 as $row1)
							{
								if($row["opt1"]==$row1["id"])
									echo("<option value='$row1[id]' selected>$row1[name]</option>");
								else
									echo("<option value='$row1[id]'>$row1[name]</option>");
							}
							?>
						</select>
						<select name="opt2" class="form-select form-select-sm bg-light myfs12 me-2" style="width:100px">
						<option value="0" selected>옵션2 선택</option>
						<? foreach($result1 as $row1)
							{
								if($row["opt2"]==$row1["id"])
									echo("<option value='$row1[id]' selected>$row1[name]</option>");
								else
									echo("<option value='$row1[id]'>$row1[name]</option>");
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
						<textarea name="contents" rows="5" cols="80" class="form-control form-control-sm myfs12"><?=$contents;?></textarea>
					</div>
				</td>
			</tr>
			<tr>
				<td class="bg-light">삼품상태</td>
				<td align="left" class="ps-2">
					<div class="form-check form-check-inline pt-2">
						<input class="form-check-input" type="radio" name="status" value="1" <?=$row["status"] == 1 ? "checked" : ""?> >
						<label class="form-check-label me-2">판매중</label>
					</div>
					<div class="form-check form-check-inline">
						<input class="form-check-input" type="radio" name="status" value="2" <?=$row["status"] == 2 ? "checked" : ""?>>
						<label class="form-check-label me-2">판매중지</label>
					</div>
					<div class="form-check form-check-inline">
						<input class="form-check-input" type="radio" name="status" value="3" <?=$row["status"] == 3 ? "checked" : ""?>>
						<label class="form-check-label me-2">품절</label>
					</div>
				</td>
			</tr>
			<tr>
				<td class="bg-light">아이콘</td>
				<td align="left" class="ps-2">
						<div class="form-check form-check-inline">
							<input class="form-check-input" type="checkbox" value="1" name="icon_new" <?=$row["icon_new"] == 1 ? "checked" : ""?>>
							<label class="form-check-label me-2">New</label>
						</div>
						<div class="form-check form-check-inline">
							<input class="form-check-input" type="checkbox" value="1" name="icon_hit" <?=$row["icon_hit"] == 1 ? "checked" : ""?>>
							<label class="form-check-label me-2">Hit</label>
						</div>
						<div class="form-check form-check-inline">
							<input class="form-check-input" type="checkbox" value="1" name="icon_sale" <?=$row["icon_sale"] == 1 ? "checked" : ""?>>
							<label class="form-check-label me-2">sale</label>
						</div>
						할인율: &nbsp;
						<div class="d-inline-flex">
							<input type="text" name="discount" value="<?=$row["discount"];?>" size="2" maxlength="3" class="form-control form-control-sm">
						</div> %
				</td>
			</tr>
			<tr>
				<td class="bg-light">등록일</td>
				<td align="left" class="ps-2">
					<div class="d-inline-flex">
						<input type="date" name="regday" value="<?=$row["regday"];?>" class="form-control form-control-sm">
					</div>
				</td>
			</tr>
			<tr>
				<td class="bg-light">이미지<br>(삭제할 그림 체크)</td>
				<td align="left" class="ps-2">
					<table class="my-1">
					<tr>
						<td>
							<img src="../product/<?=$fname1;?>" width="50" height="50" class="img-thumbnail" style='cursor:pointer' data-bs-toggle="modal" data-bs-target="#zoomModal" 
   onclick="document.getElementById('zoomModalLabel').innerText='<?=$fname1;?>'; picname.src='../product/<?=$fname1;?>'">
						</td>
						<td align="left" class="ps-3">
							<input type="checkbox" name="checkno1" value="1">
							<b>이미지1 : </b>&nbsp;<?=$fname1;?><br>
							<div class="d-inline-flex">
								<input type="file" name="image1" class="form-control form-control-sm myfs12">
							</div>
						</td>
					</tr>
					</table>
					<table class="mb-1">
					<tr>
						<td>
							<img src="../product/<?=$fname2;?>" width="50" height="50" class="img-thumbnail" style='cursor:pointer' data-bs-toggle="modal" data-bs-target="#zoomModal" 
   onclick="document.getElementById('zoomModalLabel').innerText='<?=$fname2;?>'; picname.src='../product/<?=$fname2;?>'">
						</td>
						<td align="left" class="ps-3">
							<input type="checkbox" name="checkno2" value="1">
							<b>이미지2 : </b>&nbsp;<?=$fname2;?><br>
							<div class="d-inline-flex">
								<input type="file" name="image2" class="form-control form-control-sm myfs12">
							</div>
						</td>
					</tr>
					</table>
					<table class="mb-1">
					<tr>
						<td>
							<img src="../product/<?=$fname3;?>" width="50" height="50" class="img-thumbnail" style='cursor:pointer' data-bs-toggle="modal" data-bs-target="#zoomModal" 
   onclick="document.getElementById('zoomModalLabel').innerText='<?=$fname3;?>'; picname.src='../product/<?=$fname3;?>'">
						</td>
						<td align="left" class="ps-3">
							<input type="checkbox" name="checkno3" value="1">
							<b>이미지3 : </b>&nbsp;<?=$fname3;?><br>
							<div class="d-inline-flex">
								<input type="file" name="image3" class="form-control form-control-sm myfs12">
							</div>
						</td>
					</tr>
					</table>
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

<!-- Zoom Modal 이미지 -->
<div class="modal fade" id="zoomModal" tabindex="-1" aria-labelledby="zoomModalLabel" aria-hidden="true">
	<div class="modal-dialog modal-xl">
		<div class="modal-content">
			<div class="modal-header bg-light">
				<h5 class="modal-title" id="zoomModalLabel">상품명1</h5>
				<button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
			</div>
			<div class="modal-body" align="center">
				<img src="#" name="picname" class="img-fluid img-thumbnail" style='cursor:pointer' data-bs-dismiss="modal">
			</div>
		</div>
	</div>
</div>