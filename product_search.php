<?php
   
    include "main_top.php";

	$findtext = $_REQUEST["find_text"];

    $sql = "select * from product where name like '%$findtext%'  and  status=1 order by name";

    $result = mysqli_query($db, $sql);

	$row=mysqli_fetch_array($result);
    

?>

<!-------------------------------------------------------------------------------------------->	
<!-- 시작 : 다른 웹페이지 삽입할 부분 -->
<!-------------------------------------------------------------------------------------------->	
<div class="row m-1 mt-4 mb-0">
	<div class="col" align="center">

		<h4 class="m-3">상품검색</h4>

		<hr class="m-0">
		<table class="table table-sm mb-4">
			<tr height="40" class="bg-light">
				<td width="15%">이미지</td>
				<td width="45%">상품정보</td>
				<td width="20%">판매가</td>
				<td width="20%">금액</td>
			</tr>
			<?php
			foreach($result as $row) {
									
				if($row["icon_new"] == 1)	$icon_n  = "images/i_new.gif";
				if($row["icon_hit"] == 1)	$icon_h  = "images/i_hit.gif";
				if($row["icon_sale"] == 1)	$icon_s  = "images/i_sale.gif";

				if($row["discount"] != null) $disc = $row["discount"];

				$price = number_format(round($row["price"]*(100-$row["discount"])/100, -1));
				$real_price = number_format($row["price"]);


			?>
			<tr height="85" style="font-size:14px;">
				<td>
					<a href="product.php?id=<?=$row["id"]; ?>"><img src="product/<?=$row["image1"]; ?>" width="60" height="70"></a>
				</td>
				<td align="left" valign="middle">
					<a href="product.php?id=<?=$row["id"]; ?>" style="color:#0066CC"><?=$row["name"];?></a><br>
					<? if($row["icon_new"] == 1) { ?><img src="images/i_new.gif"> <? } ?>
					<? if($row["icon_hit"] == 1) { ?><img src="images/i_hit.gif"> <? } ?>
					<? if($row["icon_sale"] == 1) { ?><img src="images/i_sale.gif"> <font size="2" color="red"><?=$row["discount"];?>%</font><? } ?>
				</td>
				<? if($row["icon_sale"] == 1) { ?><td><strike><?=$real_price?> 원</strike></td><? }
				else { ?><td><?=$real_price?> 원</td><? } ?>
				
				<? if($row["icon_sale"] == 1) { ?><td><b> <?=$price?> 원</b></td><? }
				else { ?><td><b><?=$real_price?> 원</b></td><? } ?>
			</tr>
			<?php
			}
			?>

		</table>
	</div>
</div>

	

<!-------------------------------------------------------------------------------------------->	
<!-- 끝 : 다른 웹페이지 삽입할 부분 -->
<!-------------------------------------------------------------------------------------------->	

<?php
    include "main_bottom.php";
?>
