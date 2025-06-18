<!---------------------------------------------------------------------------------------------
	제목 : 내 손으로 만드는 PHP 쇼핑몰 (실습용 디자인 HTML)

	소속 : 인덕대학교 컴퓨터소프트웨어학과
	이름 : 교수 윤형태 (2024.02)
---------------------------------------------------------------------------------------------->
<?
    include "../common.php";

    $sel1=$_REQUEST["sel1"];
    $sel2=$_REQUEST["sel2"];
    $sel3=$_REQUEST["sel3"];
	$sel4=$_REQUEST["sel4"];
    $text1=$_REQUEST["text1"];

    if (!$sel1)   $sel1=0;
    if (!$sel2)   $sel2=0;
    if (!$sel3)   $sel3=0;
    if (!$sel4)   $sel4=0;
    if (!$text1) $text1=""; 
          
    $k=0;
    if ($sel1 != 0)        { $s[$k] = "status=" . $sel1;  $k++; }
    if ($sel2 == 1)       { $s[$k] = "icon_new=1";      $k++; }
    elseif ($sel2==2)   { $s[$k] = "icon_hit=1";         $k++; }
    elseif ($sel2==3)   { $s[$k] = "icon_sale=1";       $k++; }
    if ($sel3 != 0)        { $s[$k] = "menu=" . $sel3;   $k++; }
    
    if ($text1)
    {
        if ($sel4==0)       { $s[$k] = "name like '%" . $text1 . "%'"; $k++; }
        elseif ($sel4==1) { $s[$k] = "code like '%" . $text1 . "%'"; $k++; }
    }    
	
    if ($k> 0)
    {
        $tmp=implode(" and ", $s); 
        $tmp = " where " . $tmp;
    }
	
    $sql="select * from product " . $tmp . " order by name";
	$co = "select * from product ";
	$args="sel1=$sel1&sel2=$sel2&sel3=$sel3&sel4=$sel4&text1=$text1";
	
	$result1 = mysqli_query($db ,$co);
	$count=mysqli_num_rows($result1);  


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

<div class="row mx-1  justify-content-center">
	<div class="col" align="center">

	<h4 class="m-0 mb-3">제품</h4>
	
	<form name="form1" method="post" action="product.php">
	
	<table class="table table-sm table-borderless m-0 p-0">
		<tr>
			<td width="20%" align="left" style="padding-top:8px">
				제품수 : <font color="red"><?=$count?></font>
			</td>
			<td align="right">
				<div class="d-inline-flex">

					<?
					echo("<select name='sel1'>");
					for($i=0;$i<$n_status;$i++)
					{
						$tmp = ($i==$sel1) ? "selected" : "";
						echo("<option value='$i' $tmp>$a_status[$i]</option>");
					}
					echo("</select>");
					?>

					<?
					echo("<select name='sel2'>");
					for($i=0;$i<$n_icon;$i++)
					{
						$tmp = ($i==$sel2) ? "selected" : "";
						echo("<option value='$i' $tmp>$a_icon[$i]</option>");
					}
					echo("</select>");
					?>
					
				</div>


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
					
				
					
						<?
							echo("<select name='sel4'>");
							for($i=0;$i<$n_text1;$i++)
							{
								$tmp = ($i==$sel4) ? "selected" : "";
								echo("<option value='$i' $tmp>$a_text1[$i]</option>");
							}
							echo("</select>");
							
							?>	
						
					
					
				</div>


				<div class="d-inline-flex">
					<div class="input-group input-group-sm">
						<input type="text" name="text1" value="<?=$text1?>" size="10" 
							class="form-control myfs12" 
							onKeydown="if (event.keyCode == 13) { form1.submit(); }"> 
						<button class="btn mycolor1 myfs12" type="button" 
							onClick="form1.submit();">검색</button>&nbsp;&nbsp;
					</div>
				</div>

				<div class="d-inline-flex">
					<a href="product_new.php" class="btn btn-sm mycolor1 myfs12">추가</a>&nbsp;
				</div>
				

			</td>
		</tr>
	</table>
	
	</form>

	<table class="table table-sm table-bordered table-hover mb-1">
		<tr class="bg-light">
			<td width="10%">제품분류</td>
			<td width="10%">제품코드</td>
			<td width="35%">제품명</td>
			<td width="10%">판매가</td>
			<td width="10%">상태</td>
			<td width="15%">이벤트</td>
			<td width="10%">수정/삭제</td>
		</tr>


	
	<?
				   foreach ($result as $row)
				   {
					   $pro=$row["id"]; 
					   $price_price = number_format($row["price"]);
					   $a_me = $row["menu"];
					   $a_st = $row["status"];
					   
					  
					  

						$n_ic = $row["icon_new"];  // 1 or 0
						if($n_ic == 1){$n_ic = $a_icon[1];}
						else {$n_ic = null;}

						$h_ic = $row["icon_hit"];	
						if($h_ic == 1){$h_ic = $a_icon[2];}
						else {$h_ic = null;}

						$s_ic = $row["icon_sale"];   
						if($row["discount"] > 0 and $row["icon_sale"]==1){$s_ic = $a_icon[3];} 
						else {$s_ic = null;}
						
					    if($row["discount"] > 0 and $row["icon_sale"]==1){
							$discount = $row["discount"];
							$disper = "($discount%)";
						   }
						else{
							$disper = "";
						}
				?>
			<tr>
			<td><?=$a_menu["$a_me"];?></td>
			
			<td><?=$row["code"];?></td>
			<td align="left"><?=$row["name"];?></td>
			<td align="right" class="px-2"><?=$price_price;?>원</td>
			<td><?=$a_status["$a_st"]?></td>
			<td><?=$n_ic;?>  <?=$h_ic;?>  <?=$s_ic;?> <?=$disper;?></td>
			<td>
				<a href="product_edit.php?id=<?=$pro;?>&sel1=&sel2=&sel3=&sel4=&text1=&page=1" class="btn btn-sm btn-outline-info mybutton-blue">수정</a>
				<a href="product_delete.php?id=<?=$pro;?>&sel1=&sel2=&sel3=&sel4=&text1&page=1" class="btn btn-sm btn-outline-danger mybutton-red" onclick="javascript:return confirm('삭제할까요 ?');">삭제</a>				
			</td>
				   </tr>
	<?
	
			}
		
	?>

        
	</table>

	<?
    echo  $pagebar;            // pagination bar 표시
	?>

	</div>
</div>
<!-------------------------------------------------------------------------------------------->	
</div>

</body>
</html>
