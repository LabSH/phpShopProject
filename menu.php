<?
	
    include "main_top.php";
    
	$menu=$_REQUEST["menu"];
	$sort = $_REQUEST["sort"];

	if ($sort==1)	$sql="and icon_new=1 order by id desc";	// 신상품
	elseif ($sort==2)	$sql="and icon_hit=1 order by id desc"; 	// 인기상품
	elseif ($sort==3)	$sql="order by name";            // 이름순
	elseif ($sort==4)  $sql="order by price";    // 낮은 가격순
	else   	               $sql="order by price desc";	    // 높은 가격순
   
	$sql = "select  *  from product where menu=$menu and status=1 " . $sql;
   
   
    $page_line = 12;
    $args="menu=$menu&sort=$sort";
    $result = mypagination($sql, $args, $count, $pagebar);
?>

<!-------------------------------------------------------------------------------------------->	
<!-- 시작 : 다른 웹페이지 삽입할 부분 -->
<!-------------------------------------------------------------------------------------------->	

<!--  Category 제목 -->
<div class="row mt-5">
	<div class="col" align="center">
		<h2><?=$a_menu[$menu];?></h2>
	</div>	
</div>	

<!--  상품개수 & 정렬 -->
<div class="row m-0">
	<div class="col-2" align="left" style="font-size:15px">
		Total <b><?=$count?></b> items
	</div>	
	<div class="col" align="right" style="font-size:12px">
		<?php
		
		for ($i = 1; $i < $n_sort; $i++) 
		{
			if ($i == $sort)
				echo "<a href='menu.php?menu={$menu}&sort={$i}'><b><font color='steelblue'>{$a_sort[$i]}</font></b></a> &nbsp;|&nbsp;";
			else
				echo "<a href='menu.php?menu={$menu}&sort={$i}'>{$a_sort[$i]}</a> &nbsp;|&nbsp;";
		}
		?>


</div>	
<hr class="mt-0 mb-4">

<!--  상품 진열  -->
<div class="row">
	<? foreach($result as $row){
		$id = $row["id"];
		

		$icon_n  = "";
		$icon_h  = "";
		$icon_s  = "";	

		if($row["icon_new"] == 1)	$icon_n  = "images/i_new.gif";
		if($row["icon_hit"] == 1)	$icon_h  = "images/i_hit.gif";
		if($row["icon_sale"] == 1 and $row["discount"] > 0 )	$icon_s  = "images/i_sale.gif";

		if($row["discount"] != null) $disc = $row["discount"];

		$price = number_format(round($row["price"]*(100-$row["discount"])/100, -1));
		$real_price = number_format($row["price"]);

	
	?>
	<!--  상품1  -->
			<div class="col-sm-3 mb-3">
				<div class="card h-100">
					<div class="zoom_image" align="center">
						<a href="product.php?id=<?=$id?>"><img src="product/<?=$row["image1"]?>"
							height="360" class="card-img-top img-fluid"></a>
					</div>
					<div class="card-body bg-light" align="center" style="font-size:15px;">
						<div class="card-title">
							<a href="product.php?id=<?=$id?>"><?=$row["name"]?></a><br>
							<img src="<?=$icon_n?>">&nbsp;<img src="<?=$icon_h?>">&nbsp;<img src="<?=$icon_s?>">&nbsp;
							<?  if($disc > 0 and $row["icon_sale"] == 1)
								echo '<font size="2" color="red">' . $disc . '%</font>';
								else "";
							?>
						</div>
						<?
							if($row["discount"] != null and $row["discount"] > 0 and $row["icon_sale"] == 1)
							echo '<p class="card-text"><small><strike>' . $real_price . '</strike></small>&nbsp;&nbsp;<b>' . $price . '</b></p>';
							else
							echo '<p class="card-text">&nbsp;&nbsp;<b>' . $real_price . '</b></p>';
						?>
					</div>
				</div>
			</div>
<?
	}
	echo $pagebar;
?>


<!-------------------------------------------------------------------------------------------->	
<!-- 끝 : 다른 웹페이지 삽입할 부분 -->
<!-------------------------------------------------------------------------------------------->	

<?php
    include "main_bottom.php";
    
?>