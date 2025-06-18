<?
	include 'main_top.php';
	$n_cart = $_COOKIE["n_cart"];
	$cart = $_COOKIE["cart"];
	$cookie_id = $_COOKIE["cookie_id"];

?>

<!-------------------------------------------------------------------------------------------->	
<!-- 시작 : 다른 웹페이지 삽입할 부분 -->
<!-------------------------------------------------------------------------------------------->	

<script>
			function Check_Value() {
				if (!form2.o_name.value) {
					alert("주문자 이름이 잘못 되었습니다.");	form2.o_name.focus();	return;
				}
				if (!form2.o_tel1.value || !form2.o_tel2.value || !form2.o_tel3.value) {
					alert("핸드폰이 잘못 되었습니다.");	form2.o_tel1.focus();	return;
				}
				if (!form2.o_email.value) {
					alert("이메일이 잘못 되었습니다.");	form2.o_email.focus();	return;
				}
				if (!form2.o_zip.value) {
					alert("우편번호가 잘못 되었습니다.");	form2.o_zip.focus();	return;
				}
				if (!form2.o_juso.value) {
					alert("주소가 잘못 되었습니다.");	form2.o_juso.focus();	return;
				}

				if (!form2.r_name.value) {
					alert("받으실 분의 이름이 잘못 되었습니다.");	form2.r_name.focus();	return;
				}
				if (!form2.r_tel1.value || !form2.r_tel2.value || !form2.r_tel3.value) {
					alert("핸드폰이 잘못 되었습니다.");	form2.r_tel1.focus();	return;
				}
				if (!form2.r_email.value) {
					alert("이메일이 잘못 되었습니다.");	form2.r_email.focus();	return;
				}
				if (!form2.r_zip.value) {
					alert("우편번호가 잘못 되었습니다.");	form2.r_zip.focus();	return;
				}
				if (!form2.r_juso.value) {
					alert("주소가 잘못 되었습니다.");	form2.r_juso.focus();	return;
				}

				form2.submit();
			}

			function FindZip(zip_kind) 
			{
				window.open("zipcode.php?zip_kind="+zip_kind, "", "scrollbars=no,width=490,height=320");
			}

			function SameCopy(str) {
				if (str == "Y") {
					form2.r_name.value = form2.o_name.value;
					form2.r_zip.value = form2.o_zip.value;
					form2.r_juso.value = form2.o_juso.value;
					form2.r_tel1.value = form2.o_tel1.value;
					form2.r_tel2.value = form2.o_tel2.value;
					form2.r_tel3.value = form2.o_tel3.value;
					form2.r_email.value = form2.o_email.value;
				}
				else {
					form2.r_name.value = "";
					form2.r_zip.value = "";
					form2.r_juso.value = "";
					form2.r_tel1.value = "";
					form2.r_tel2.value = "";
					form2.r_tel3.value = "";
					form2.r_email.value = "";
				}
			}
</script>

<div class="row m-1 mb-0">
	<div class="col" align="center">

		<h4 class="m-3">주문(배송정보)</h4>
		<hr class="m-0">
		
		<table class="table table-sm mb-5">
			<tr height="40" class="bg-light">
				<td width="15%">이미지</td>
				<td width="35%">상품정보</td>
				<td width="15%">판매가</td>
				<td width="20%">수량</td>
				<td width="15%">금액</td>
			</tr>
			
			<? 
				$product_prices = 0;
				$total=0;
				$temp_basong = 0;
				for ($i=1;  $i<=$n_cart;  $i++)
				{
				
				
					if ($cart[$i])
					{
						
						list($id, $num, $opts_id1, $opts_id2)=explode("^", $cart[$i]);
						
						$id = intval($id);
						$num = intval($num);
						$opts_id1 = intval($opts_id1);
						$opts_id2 = intval($opts_id2);
						
						  $sql = "select * from product where id=$id";
						  $result = mysqli_query($db ,$sql);
						  $row = mysqli_fetch_array($result);
						  if (!$result) exit("에러:$sql");
						
						  $sql1 = "select * from opts where id=$opts_id1";
						  $result1 = mysqli_query($db ,$sql1);
						  $row1 = mysqli_fetch_array($result1);
						  if (!$result1) exit("에러:$sql1");
						  
						  $sql2 = "select * from opts where id=$opts_id2"; 
						  $result2 = mysqli_query($db ,$sql2);
						  $row2 = mysqli_fetch_array($result2);
						  if (!$result2) exit("에러:$sql2");
						  
					
						  	$price =  round($row["price"] * (100-$row["discount"])/100, -1) ;
					
						  $price = $price * $num;
						  
						  $total = $total + $price;
  
						  
						  $product_prices = $product_prices + $price;
				
					
			?>
			
			<tr height="85" style="font-size:14px;">
				<td>
					<a href="product.php?id=<?=$row['id'];?>"><img src="product/<?=$row['image1'];?>" width="60" height="70"></a>
				</td>
				<td align="left" valign="middle">
					<a href="product.php?id=<?=$row['id'];?>" style="color:#0066CC"><?=$row['name'];?></a><br>
					<small><b>[옵션]</b> <?=$row1["name"];?> &nbsp; <?=$row2["name"];?></small>
				</td>

				<td><?=number_format(round($row["price"]*(100-$row["discount"])/100, -1));?></td>
				<td><?=$num;?></td>
				<td><?=number_format(round($row["price"]*(100-$row["discount"])/100, -1) * $num);?></td>
			</tr>
				<?
					}
				}
				if ($total < $max_baesongbi)
				{
					$total = $total + $baesongbi;
					$temp_basong = $baesongbi;
				}
				
				if($temp_basong > 0)
					$temp_basong = number_format($temp_basong);
				
				if($product_prices > 0)
					$product_prices = number_format($product_prices);

				$total = number_format($total);
			?>
			
			
			<tr height="40" align="right" class="bg-light" style="font-size:14px;">
				<td width="10%" align="center"><img src="images/cart_image1.gif" border="0"></td>
				<td width="90%" colspan="5" class="pe-4">
				<font color="#0066CC">총금액</font> : 상품( <?=$product_prices;?> ) + 배송비( <?=$temp_basong;?> ) = <font style="font-size:16px"><b><?=$total;?></b></font>
				</td>
			</tr>
		</table>
	</div>
</div>

<!-- form2 시작 -->
<form name="form2" method="post" action="order_pay.php">

<div class="row mx-1 my-0">
	<div class="col" align="center">

		<font size="4" color="#B90319">주문정보</font>
		<hr class="m-0 my-2">
		
		<?
			$o_name = "";
			
			$o_tel1 = "";
			$o_tel2 = "";
			$o_tel3 = "";
			
			$o_email = "";
			$o_zip = "";
			$o_juso = "";
			
			if($cookie_id)
			{
			 $sql_mem = "select * from member where uid = '$cookie_id'";
			 $result_mem = mysqli_query($db ,$sql_mem);
			 $row_mem  = mysqli_fetch_array($result_mem);
			 
			  
			 
			 $o_name = $row_mem["name"];
			 $o_email = $row_mem["email"];
			 $o_zip = $row_mem["zip"];
			 $o_juso = $row_mem["juso"];
			 
			  $o_tel1=trim(substr($row_mem["tel"],0,3));        // 0번 위치에서 3자리 문자열 추출
			  $o_tel2=trim(substr($row_mem["tel"],3,4));        // 3번 위치에서 4자리
			  $o_tel3=trim(substr($row_mem["tel"],7,4)); 
			}
		?>
		
		
		<table  style="font-size:13px;">
			<tr height="40">
				<td align="left" width="100">이름 <font color="red">*</font></td>
				<td align="left">
					<div class="d-inline-flex">
						<input type="text" name="o_name" size="20" value="<?=$o_name;?>" 
							class="form-control form-control-sm">
					</div>
				</td>
			</tr>
			<tr height="40">
				<td align="left" width="20%">휴대폰 <font color="red">*</font></td>
				<td align="left">
					<div class="d-inline-flex">
						<input type="text" name="o_tel1" size="3" maxlength="3" value="<?=$o_tel1;?>" 
							class="form-control form-control-sm">-
						<input type="text" name="o_tel2" size="4" maxlength="4" value="<?=$o_tel2;?>"		
							class="form-control form-control-sm">-
						<input type="text" name="o_tel3" size="4" maxlength="4" value="<?=$o_tel3;?>"		
							class="form-control form-control-sm">
					</div>
				</td>
			</tr>
			<tr height="40">
				<td align="left">이메일 <font color="red">*</font></td>
				<td align="left">
					<div class="d-inline-flex">
						<input type="text" name="o_email" size="50" value="<?=$o_email?>" 
							class="form-control form-control-sm">
					</div>
				</td>
			</tr>
			<tr height="80">
				<td align="left">주소 <font color="red">*</font></td>
				<td align="left">
					<div class="d-inline-flex mb-1">
						<input type="text" name="o_zip" size="5" maxlength="5" value="<?=$o_zip?>" 
							class="form-control form-control-sm">&nbsp;
					</div>
					<a href="javascript:FindZip(1)"  class="btn btn-sm btn-secondary text-white mb-1"  
						style="font-size:12px">우편번호 찾기</a><br>
					<div class="d-inline-flex">
						<input type="text" name="o_juso" size="50" value="<?=$o_juso?>" 
							class="form-control form-control-sm">
					</div>
				</td>
			</tr>
		</table>
		
	</div>
</div>

<br>

<div class="row mx-1 my-3">
	<div class="col" align="center">
	
		<font size="4" color="#B90319">배송정보</font>
		<hr class="m-0 my-2">
	
		<table style="font-size:13px;">
			<tr height="40">
				<td align="left" width="20%">위 복사</td>
				<td align="left">
					<div class="d-inline-flex">
						<div class="form-check">
							<input class="form-check-input" type="radio" name="same" 
								onclick="javascript:SameCopy('Y')">
							<label class="form-check-label me-2">예</label>
						</div>
						<div class="form-check">
							<input class="form-check-input" type="radio" name="same" 
								onclick="javascript:SameCopy('N')">
							<label class="form-check-label">아니오</label>
						</div>
					</div>
				</td>
			</tr>
			<tr height="40">
				<td align="left">이름 <font color="red">*</font></td>
				<td align="left">
					<div class="d-inline-flex">
						<input type="text" name="r_name" size="20" value="" class="form-control form-control-sm">
					</div>
				</td>
			</tr>
			<tr height="40">
				<td align="left">휴대폰 <font color="red">*</font></td>
				<td align="left">
					<div class="d-inline-flex">
						<input type="text" name="r_tel1" size="3" maxlength="3" value="010" 
							class="form-control form-control-sm">-
						<input type="text" name="r_tel2" size="4" maxlength="4" value=""
							class="form-control form-control-sm">-
						<input type="text" name="r_tel3" size="4" maxlength="4" value=""
							class="form-control form-control-sm">
					</div>
				</td>
			</tr>
			<tr height="40">
				<td align="left">이메일 <font color="red">*</font></td>
				<td align="left">
					<div class="d-inline-flex">
						<input type="text" name="r_email" size="50" value="" 
							class="form-control form-control-sm">
					</div>
				</td>
			</tr>
			<tr height="80">
				<td align="left">주소 <font color="red">*</font></td>
				<td align="left">
					<div class="d-inline-flex mb-1">
						<input type="text" name="r_zip" size="5" maxlength="5" value="" 
							class="form-control form-control-sm">&nbsp;
					</div>
					<a href="javascript:FindZip(2)"  class="btn btn-sm btn-secondary text-white mb-1"  
						style="font-size:12px">우편번호 찾기</a><br>
					<div class="d-inline-flex">
						<input type="text" name="r_juso" size="50" value="" 
							class="form-control form-control-sm">
					</div>
				</td>
			</tr>
			<tr height="90">
				<td align="left">요구사항</td>
				<td align="left">
					<div class="d-inline-flex">
						<textarea name="memo" cols="50" rows="3" 
							class="form-control form-control-sm"></textarea>
					</div>
				</td>
			</tr>
		</table>
	</div>
</div>

<div class="row mx-5">
	<div class="col" align="center">
		<a href="javascript:Check_Value()" class="btn btn-sm btn-dark text-white">
			&nbsp;다 &nbsp;&nbsp; 음&nbsp;</a>
	</div>
</div>

</form>

<br><br><br>
<?
	include 'main_bottom.php';
	

?>
