<!---------------------------------------------------------------------------------------------
	제목 : 내 손으로 만드는 PHP 쇼핑몰 (실습용 디자인 HTML)

	소속 : 인덕대학교 컴퓨터소프트웨어학과
	이름 : 교수 윤형태 (2024.02)
---------------------------------------------------------------------------------------------->
<?
   include "../common.php";
	
	$id=$_REQUEST["id"];
	$name=$_REQUEST["name"];
	
	$sql1 = "Select  *  from opt where id=$id";
	$sql2 = "Select  *  from opts where opt_id=$id order by name";
    $result1 = mypagination($sql1, $args, $count, $pagebar);
	$result2 = mysqli_query($db,$sql2);
	$row1=mysqli_fetch_array($result1);
	$row2=mysqli_fetch_array($result2);
 
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

<div class="row mx-1  justify-content-center">
	<div class="col-sm-10" align="center">

	<h4 class="m-0">소옵션</h4>

	<div class="row myfs13">
		<div class="col" align="left" style="padding-top:8px"">
			&nbsp;옵션명 : <font color="red"><?=$row1["name"]; ?></font>
		</div>
		<div class="col" align="right">
			<div class="d-inline-flex">
				<a href="opts_new.php?id=<?=$id;?>" class="btn btn-sm mycolor1 myfs12">소옵션 추가</a>&nbsp;
			</div>
		</div>
	</div>
	</form>

	<table class="table table-sm table-bordered table-hover my-1">
		<tr class="bg-light">
			<td width="25%">소옵션 번호</td>
			<td>소옵션명</td>
			<td width="25%">수정 / 삭제</td>
		</tr>
		
		
		<?
				   foreach ($result2 as $row2)
				   {
					   $opt_id=$row2["id"];  
				?>
					<tr>
				   <td><?=$opt_id; ?></td>
				   <td><?=$row2["name"]; ?></td>
				    
				   
							<td>
							<a href="opts_edit.php?id=<?=$id;?>&id1=<?=$opt_id;?>" class="btn btn-sm mybutton-blue">수정</a>
							<a href="opts_delete.php?id=<?=$id;?>&id1=<?=$opt_id;?>" class="btn btn-sm mybutton-red" onclick="javascript:return confirm('삭제할까요 ?');">삭제</a>		
						</td>
						
						
				</tr>
				
			<?
			   }
			?>
		
	</table>

	<a href="opt.php"  class="btn btn-sm btn-outline-dark my-2">&nbsp;돌아가기&nbsp;</a>

	</div>
</div>
<!-------------------------------------------------------------------------------------------->	
</div>

</body>
</html>
