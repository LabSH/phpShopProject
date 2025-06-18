<?
    $n_cart = $_COOKIE["n_cart"];
	$cart = $_COOKIE["cart"];
    $kind = $_REQUEST["kind"];
    $id = $_REQUEST["id"];
    $num = $_REQUEST["num"];
    $opts1 = $_REQUEST["opts1"];
    $opts2 = $_REQUEST["opts2"];
    $pos = $_REQUEST["pos"];
    
    if (!$n_cart) $n_cart=0;   // 제품개수 0으로 초기화

switch ($kind) {
    case "insert":      // 장바구니 담기
    case "order":      // 바로 구매하기
        $n_cart++; // n_cart의 초기값은 0이에요.
        $cart[$n_cart] = implode("^", array($id, $num, $opts1, $opts2)); // n_cart가 1이면 cart[1] = ^id^num^opts1.....
        setcookie("cart[$n_cart]", $cart[$n_cart]); //n_cart 가 1일경우 cart[1] 이라는 이름으로 위의 코드 배열을 쿠키로 저장
        setcookie("n_cart", $n_cart); //n_cart 이름으로 1을 쿠키로 저장
         break;
    case "delete":      // 제품삭제
        setcookie("cart[$pos]", null); //쿠키 삭제
         break;
    case "update":     // 수량 수정
        // 분해 : num_tmp는 버려지는 값이에요. (자릿수 맞춤)
        //  $cart[$pos]의 값이 "123^45^option1^option2"라고 가정 $id는 "123" $num_tmp는 "45" $opts1는 "option1" $opts2는 "option2"
        list($id, $num_tmp, $opts1, $opts2) = explode("^", $cart[$pos]);
        // 수정 : 다시 들어온 값을 적용해요.
        $cart[$pos] = implode("^", array($id, $num, $opts1, $opts2));
        // 조립 : insert와 같은 방식이에요.
        setcookie("cart[$pos]", $cart[$pos]);  
        //n_cart 가 1일경우 cart[1] 이라는 이름으로 위의 코드 배열을 쿠키로 저장
        break;
    case "deleteall":    // 장바구니 전체 비우기
        for($i=1;$i<=$n_cart;$i++) {
            if ($cart[$i]) {
             // i번째 제품이 있는 경우
             // cookie값 삭제.
             setcookie("cart[$i]", null);
            }
           }
           $n_cart = 0; // 전체비우기니까 제품 개수 0개로 초기화
           setcookie("n_cart", null); // 제품개수의 쿠키값을 삭제
           break;
    }
    if ($kind=="order")
        echo("<script>location.href='order.php'</script>");
    else
        echo("<script>location.href='cart.php'</script>");
?>