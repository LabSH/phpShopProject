<?
	include 'common.php';

	$n_cart = $_COOKIE["n_cart"];
	$cart = $_COOKIE["cart"];
	$cookie_id = $_COOKIE["cookie_id"];

	$o_name = $_REQUEST["o_name"];
	
	$o_tel = $_REQUEST["r_tel"];
	
	$o_email = $_REQUEST["o_email"];
	$o_zip = $_REQUEST["o_zip"];
	$o_juso = $_REQUEST["o_juso"];
	
	
	$r_name = $_REQUEST["r_name"];
	
	
	$r_tel = $_REQUEST["r_tel"];
	
	$r_email = $_REQUEST["r_email"];
	$r_zip = $_REQUEST["r_zip"];
	$r_juso = $_REQUEST["r_juso"];
	
	$memo = $_REQUEST["memo"];
	
	
	$pay_kind = $_REQUEST["pay_kind"];
	$card_kind = $_REQUEST["card_kind"];
	$bank_kind = $_REQUEST["bank_kind"];
	$bank_sender = $_REQUEST["bank_sender"] ?? null;
	$card_okno = $_REQUEST["card_okno"];
	$card_halbu = $_REQUEST["card_halbu"];
	
	

	$sql1  = 'select * from jumun  where jumunday = curdate() order by id desc limit 1';
	// curdate => mysql에서 현재 날짜를 구하는 함수
	$result = mysqli_query($db ,$sql1);
	$row=mysqli_fetch_array($result);
	$count = mysqli_num_rows($result);
	// mysql의 행의 개수를 찾는 함수. 
	
	$tmp_day = $row["id"]; // 아래 부분 다하고 다시 해야함
	$tmp_day = substr($tmp_day,-4); 
	
	if ($count>0){      // 주문번호가 있으면
   		$jumun_id =  date("ymd") . $tmp_day; // 수정
		$jumun_id = $jumun_id  + 1;
	}
	else
		$jumun_id = date("ymd") . "0001";
			
		$total_price = 0;
		$product_nums = 0;
		$product_names = "";
		for ($i=1;  $i<=$n_cart;  $i++)
		{
		   if ($cart[$i]) // 제품정보가 있는 경우만
		   {
			   list($id, $num, $opts_id1, $opts_id2)=explode("^", $cart[$i]);
			   $product_sql = "select * from product where id = $id";
			   $result1 = mysqli_query($db ,$product_sql);
			   $product_row = mysqli_fetch_array($result1);

			   if($opts_id1){
			   $opt1_sql = "select * from opts where id=$opts_id1";
			   $result2 = mysqli_query($db ,$opt1_sql);
			   $opt1_row = mysqli_fetch_array($result2);
			   }else
					$opts_id1 = 0;
				   
			   
			   if($opts_id2){
			   $opt2_sql = "select * from opts where id=$opts_id2";
			   $result3 = mysqli_query($db ,$opt2_sql);
			   $opt2_row = mysqli_fetch_array($result3);
			   }else
				   $opts_id2 = 0;
			
			  

			   $price =  round($product_row["price"] * (100-$product_row["discount"])/100, -1) ;

			   $prices = $price * $num;

			   $discount = $product_row["discount"];

			 

			   $sql = "INSERT INTO jumuns (jumun_id, product_id, num, price, prices, discount, opts_id1, opts_id2)
			   VALUES ('$jumun_id', $id, $num, $price, $prices, $discount,  $opts_id1, $opts_id2)";
  				$total_info_jumuns=mysqli_query($db, $sql); 

				setcookie("cart[$i]", "");

				$total_price = $total_price + $prices;
			    $product_nums = $product_nums + 1;
				if ($product_nums==1) $product_names = $product_row["name"];
			}
		}

		
		if ($product_nums > 1) $product_names = $product_names . " 외 " . $product_nums-1 . " 개 ";


		if($total_price < $max_baesongbi){
			$dili = "INSERT INTO jumuns (jumun_id, product_id, num, price, prices, discount, opts_id1, opts_id2)
			VALUES ('$jumun_id', 0,1,$baesongbi,$baesongbi,0,0,0)";
			$total_info_dili=mysqli_query($db, $dili); 
			//$total_price = $total_price + $baesongbi; // 총합에 배송비 추가하는코드.
		}

		if($cookie_id){
			$id_sql = "select * from member where uid = '$cookie_id'";
			$id_sql_result = mysqli_query($db ,$id_sql);
			$id_row = mysqli_fetch_array($id_sql_result);
			$customer_id = $id_row["id"]; // 정수형 
		}
		else
			$customer_id = 0;
		

		$jumunday = date("ymd");
		$card_okno = "승인";
		

		$sql_info = "INSERT INTO jumun (id, member_id, jumunday, product_names, product_nums, 
			o_name, o_tel, o_email, o_zip, o_juso, 
			r_name, r_tel, r_email, r_zip, r_juso, 
			memo,
			pay_kind, card_okno, card_halbu, card_kind, bank_kind, bank_sender, totalprice, state)
			VALUES ('$jumun_id', $customer_id, '$jumunday', '$product_names', $product_nums, 
			'$o_name', '$o_tel', '$o_email', '$o_zip', '$o_juso',
			'$r_name', '$r_tel', '$r_email', '$r_zip', '$r_juso', 
			'$memo', 
			$pay_kind, '$card_okno', $card_halbu, $card_kind, $bank_kind, '$bank_sender', $total_price, 1)";
			$total_info_jumun=mysqli_query($db, $sql_info); 
			if (!$total_info_jumun) exit("에러: $sql_info");

	
		echo("<script>location.href='order_ok.php'</script>");
?>