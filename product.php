<!---------------------------------------------------------------------------------------------
	제목 : 내 손으로 만드는 PHP 쇼핑몰무 (실습용 디자인 HTML)

	소속 : 인덕대학교 컴퓨터소프트웨어학과
	이름 : 교수 윤형태 (2024.02)
---------------------------------------------------------------------------------------------->
<?php
    include "main_top.php";
   

    $id=$_REQUEST["id"];

    $sql="select * from product where id=$id";
    $result = mypagination($sql, $args, $count, $pagebar);
	$row=mysqli_fetch_array($result);

    $sql1 = "select * from opts where opt_id=$row[opt1]";
    $result1 = mypagination($sql1, $args, $count, $pagebar);
    $row1 = mysqli_fetch_array($result1);

	$sql2 = "select * from opts where opt_id=$row[opt2]";
    $result2 = mypagination($sql2, $args, $count, $pagebar);
    $row2 = mysqli_fetch_array($result2);
    
	$imagename2 = $row["image2"] ? $row["image2"] : "nopic.png";
?>

<!-------------------------------------------------------------------------------------------->	
<!-- 시작 : 다른 웹페이지 삽입할 부분 -->
<!-------------------------------------------------------------------------------------------->	

<!--  현재 페이지 Javascript  -------------------------------------------->
<script >
	function cal_price() 
	{
		form2.prices.value = (form2.num.value * form2.price.value).toLocaleString();
		form2.num.focus();
	}

	function check_form2(str) 
	{
		if (form2.opts1 && form2.opts1.value==0) {
			alert("옵션1을 선택하십시요.");
			form2.opts1.focus();
			return;
		}
		if (form2.opts2 && form2.opts2.value==0) {
			alert("옵션2를 선택하십시요.");
			form2.opts2.focus();
			return;
		}
		if (!form2.num.value) {
			alert("수량을 입력하십시요.");
			form2.num.focus();
			return;
		}
		if (str == "D") {
			form2.action = "cart_edit.php";
			form2.kind.value = "order";
			form2.submit();
		}
		else {
			form2.action = "cart_edit.php";
			form2.submit();
		}
	}
</script>




<!-- form2 시작  -->
<form name="form2" method="post" action="">
<input type="hidden" name="kind" value="insert">
<input type="hidden" name="id" value="<?=$row["id"]; ?>">
<input type="hidden" name="price" value="<?=$row["price"]; ?>">

<!-- Zoom Modal 이미지 -->
<div class="modal fade" id="zoomModal" tabindex="-1" aria-labelledby="zoomModalLabel" 
			aria-hidden="true">
		<div class="modal-dialog modal-lg">
			<div class="modal-content">
				<div class="modal-header bg-light">
					<h5 class="modal-title" id="zoomModalLabel"><?=$row["name"]; ?></h5>
					<button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
				</div>
				<div align="center" class="modal-body">
					<img src="product/<?=$imagename2; ?>" class="img-thumbnail" style="cursor:pointer" 
							class="btn-close" data-bs-dismiss="modal" aria-label="Close">
				</div>
				</div>
				</div>
				</div>

<!--  상품 사진/정보(제품명,가격,옵션)  -->
<div class="row mx-1 my-4">
	<div class="col" align="center">
		<table class="table table-sm table-borderless">
			<tr>
				<td valign="top" align="left" width="50%">
					<img src="product/<?=$imagename2; ?>" width="100%" 
						class="img-thumbnail img-fluid mt-2"  style="cursor:zoom-in" 
						data-bs-toggle="modal" data-bs-target="#zoomModal">
				</td>
				<td  width="50%" align="center" valign="top" class="px-0">
					<hr size="5px" width="100%" class="my-2">

					<table width="100%" style="font-size:12px;" class="table table-sm table-borderless p-0 m-0">
						<tr height="50">
							<td colspan="2"  align="center" style="font-size:20px; color: #222222;">
								<?=$row["name"]; ?>
							</td>
						</tr>
						<tr height="35">
							<td colspan="2" align="center">
                                <?php

                                    $icon_n  = "";
                                    $icon_h  = "";
                                    $icon_s  = "";	

                                    if($row["icon_new"] == 1)	$icon_n  = "images/i_new.gif";
                                    if($row["icon_hit"] == 1)	$icon_h  = "images/i_hit.gif";
                                    if($row["icon_sale"] == 1 and $row["discount"] > 0 )	$icon_s  = "images/i_sale.gif";

                                    if($row["discount"] != null) $disc = $row["discount"];

                                    $price = number_format(round($row["price"]*(100-$row["discount"])/100, -3));
                                    $real_price = number_format($row["price"]);
                                ?>  

								<img src="<?=$icon_n; ?>"> <img src="<?=$icon_h; ?>"> <img src="<?=$icon_s; ?>">&nbsp;
                                
                                <?  if($disc > 0 and $row["icon_sale"] == 1)
								            echo '<font size="3" color="red">' . $disc . '%</font>';
								            else "";
							    ?>
                               
							</td>
						</tr>
						<tr><td colspan="2"><hr class="my-2"></td></tr>
						<tr height="35">
							<td width="30%" align="center">판매가</td>
							<?php
								if($row["discount"] != null and $row["discount"] > 0 and $row["icon_sale"] == 1)
								echo '<td width="70%" align="left" style="font-size:15px;"><strike>' . $real_price . '</strike></td>';
								else
								echo '<td style="font-size:15px;" align="left">'.$real_price.'</td>';
							?>
							
						</tr>
						<tr height="35">
							<td  align="center">할인가</td>
							<?php
								if($row["discount"] != null and $row["discount"] > 0 and $row["icon_sale"] == 1)
								echo '<td width="70%" align="left" style="font-size:15px;">' . $price . '</td>';
								else
								echo '<td style="font-size:15px;" align="left">'.$real_price.'</td>';
							?>
						
						</tr>
						<tr><td colspan="2"><hr class="my-2"></td></tr>
						<tr>
							<td align="center">옵션1</td>
							<td  align="left">
								<?php
									if($row["opt1"]){
								?>
								
									<select name="opts1" class="form-select form-select-sm mb-2" style="width:90%;font-size:12px;">
									<option value="0" selected>옵션을 선택하세요.</option>
									<?php
									foreach($result1 as $row1){
										echo("<option value='" . $row1['id'] . "'>" . $row1['name'] . "</option>");
									}

									?>
								</select>
								<?php
									}
									else
									echo ("사용불가");
								?>
							</td>
						</tr>
						<tr>
							<td align="center">옵션2</td>
							<td  align="left">
							<?php
									if($row["opt2"]){
								?>
								
									<select name="opts2" class="form-select form-select-sm mb-2" style="width:90%;font-size:12px;">
									<option value="0" selected>옵션을 선택하세요.</option>
									<?php
									foreach($result2 as $row2){
										echo("<option value='" . $row2['id'] . "'>" . $row2['name'] . "</option>");
									}

									?>
								</select>
								<?php
									}
									else
									echo ("사용불가");
								?>
							</td>
						</tr>
						<tr><td colspan="2"><hr class="my-2"></td></tr>
						<tr>
							<td align="center">수량</td>
							<td  align="left">
								<div class="d-inline-flex">
									<input type="text" name="num" size="5" value="1" 
										class="form-control form-control-sm" style="text-align:center;"
										onChange="javascript:cal_price()">
								</div>
							</td>
						</tr>
						<tr>
							<td align="center">금액</td>
							<td align="left">
								<div class="d-inline-flex">
									<input type="text" name="prices" value="<?=$price; ?>" size="10" 
										class="form-control form-control-sm"
										style="border:0;background-color:white;text-align:left;font-size:18px;font-weight:bold;" readonly>
								</div>
							</td>
						</tr>
						<tr>
							<td colspan="2" height="100" align="center">
								<a href="javascript:check_form2('D')" class="btn btn-sm btn-secondary text-light">바로 구매</a>&nbsp;&nbsp;&nbsp;&nbsp;
								<a href="javascript:check_form2('C')" class="btn btn-sm btn-outline-secondary">장바구니</a>
							</td>
						</tr>
					</table>

				</td>
			</tr>
		</table>

	</div>
</div>

</form>
<!-- form2 끝 -->

<hr class="my-0 mx-3">

<div align="center">
	본 제품의 상세설명은 다음과 같습니다....
	<br><br>
	<?
			if($row["image3"])
			echo "<img src='product/$row[image3]'>";
			
	?>
</div>	

<br><br>

<!-- Zoom Modal 이미지 -->
<!-------------------------------------------------------------------------------------------->	
<!-- 끝 : 다른 웹페이지 삽입할 부분 -->
<!-------------------------------------------------------------------------------------------->	

<?php
    include "main_botton.php";

?>