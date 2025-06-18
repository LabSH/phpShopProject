<!---------------------------------------------------------------------------------------------
	제목 : 내 손으로 만드는 PHP 쇼핑몰무 (실습용 디자인 HTML)

	소속 : 인덕대학교 컴퓨터소프트웨어학과
	이름 : 교수 윤형태 (2024.02)
---------------------------------------------------------------------------------------------->

<?php include "common.php"; ?>

<!doctype html>
<html lang="kr">
<head>
	<meta charset="utf-8">
	<meta name="viewport" content="width=device-width, initial-scale=1">
	<title>INDUK Mall</title>
	<link  href="css/bootstrap.min.css" rel="stylesheet">
	<link  href="css/my.css" rel="stylesheet">
	<script src="js/jquery-3.7.1.min.js"></script>
	<script src="js/bootstrap.bundle.min.js"></script>
</head>
<body>

<div class="container">
<!-------------------------------------------------------------------------------------------->	



<!--  Title과  메뉴(로그인/회원가입/장바구니/주문조회/게시판/Q&A) -->
<div class="row">
	<div class="col fs-3" align="left">
		&nbsp;<a href="index.html"><font color="#777777">INDUK POKET Mall</font></a>
	</div>
	<div class="col mt-3" align="right" style="font-size:12px;">
		<a href="index.html">Home</a>&nbsp;|&nbsp;

		<?
			$cookie_id = $_COOKIE["cookie_id"];
			if(!$cookie_id){
					echo'<a href="member_login.php">Login</a>&nbsp;|&nbsp;';
					echo'<a href="member_join.php">회원가입</a>&nbsp;|&nbsp;';
			}
			else{
				echo'<a href="member_logout.php">로그아웃</a>&nbsp;|&nbsp;';
					echo'<a href="member_edit.php">회원정보수정</a>&nbsp;|&nbsp;';
			
			}

		?>
	
		<a href="cart.php">장바구니</a>&nbsp;|&nbsp; 
		<a href="jumun_login.html">주문조회</a>&nbsp;|&nbsp;
		<a href="qa.html">Q & A</a>&nbsp;|&nbsp;
		<a href="faq.html">FAQ</a>&nbsp;&nbsp;
	</div>
</div>

<!-- Slide Images -->
<div id="carouselExampleIndicators" class="carousel slide" data-bs-ride="carousel"  data-bs-interval="4000">
	<div class="carousel-indicators">
		<button type="button" data-bs-target="#carouselExampleIndicators" data-bs-slide-to="0" aria-label="Slide 1"	class="active" aria-current="true" ></button>
		<button type="button" data-bs-target="#carouselExampleIndicators" data-bs-slide-to="1" aria-label="Slide 2"></button>
		<button type="button" data-bs-target="#carouselExampleIndicators" data-bs-slide-to="2" aria-label="Slide 3"></button>
		<button type="button" data-bs-target="#carouselExampleIndicators" data-bs-slide-to="3" aria-label="Slide 4"></button>
	</div>
	<div class="carousel-inner">
		<div class="carousel-item active">
			<img src="product/이벤트1.jpeg" class="d-block w-100" alt="..." style="height: 450px; object-fit: cover;">
			<div class="carousel-caption d-none d-md-block">
				<h1>Hit game 1</h1>
				<p><h6>당신을 위한 게임 제안 1</h6></p>
			</div>
		</div>
		<div class="carousel-item">
			<img src="product/이벤트2.jpeg" class="d-block w-100"alt="..." style="height: 450px; object-fit: cover;">
			<div class="carousel-caption d-none d-md-block">
				<h1>Hit game 2</h1>
				<p><h6>당신을 위한 게임 제안 2</h6></p>
			</div>
		</div>
		<div class="carousel-item">
			<img src="product/이벤트5.jpeg" class="d-block w-100" alt="..." style="height: 450px; object-fit: cover;">
			<div class="carousel-caption d-none d-md-block">
				<h1>Hit game 3</h1>
				<p><h6>당신을 위한 게임 제안 3</h6></p>
			</div>
		</div>
		<div class="carousel-item">
			<img src="product/이벤트4.jpeg" class="d-block w-100" alt="..." style="height: 450px; object-fit: cover;">
			<div class="carousel-caption d-none d-md-block">
				<h1>NEW Hit game 4</h1>
				<p><h6>당신을 위한 게임 제안 4</h6></p>
			</div>
		</div>
	</div>
	<button class="carousel-control-prev" type="button" data-bs-target="#carouselExampleIndicators" data-bs-slide="prev">
		<span class="carousel-control-prev-icon" aria-hidden="true"></span>
		<span class="visually-hidden">Previous</span>
	</button>
	<button class="carousel-control-next" type="button" data-bs-target="#carouselExampleIndicators" data-bs-slide="next">
		<span class="carousel-control-next-icon" aria-hidden="true"></span>
		<span class="visually-hidden">Next</span>
	</button>
</div>

<!--  상품 Category 메뉴/ 상품검색 -->
<div class="row bg-light m-0 p-1 fs-6 border">
	<div class="col">
		<div class="d-flex">
			<ul class="nav me-auto">
			
			<? 
				$gitar = 3; // 기타 드롭다운의 개수 지금은 3개
				$lim = $n_menu - $gitar ; // n_menu가 10 이라면 기타 드롭다운 전까지가 7번나옴
				for($ime=1; $ime < $n_menu; $ime++){
				if($ime < $lim){
					echo '<li class="nav-item zoom_a"><a class="nav-link" href="menu.php?menu=' . $ime . '&sort='. 1 .'">' . $a_menu[$ime] . '</a></li>';
				}elseif($ime >= 10)
					break;
				else
					break;
			?>
			
			<?php
			}
			?>	
			<li class="nav-item dropdown">
			<a class="nav-link dropdown-toggle" data-bs-toggle="dropdown" href="" role="button" aria-expanded="false"> 기타 </a>
			<ul class="dropdown-menu">
					<?
				for($ime ; $ime < $n_menu; $ime++){
					echo'<li class="nav-item zoom_a"><a class="dropdown-item" href="menu.php?menu=' . $ime . '&sort='. 1 .'">' . $a_menu[$ime] . '</a></li>';
				}
				?>
			</ul>
			</ul>
			</li>

				

				
					
					
			<script>
				function check_findproduct() {
					if (!form1.find_text.value)  {
						alert('검색어를 입력하세요');
						return;
					}
					form1.submit();
				}
			</script>
			

		
			<form name="form1" method="post" action="product_search.php" align="right">
				<div class="input-group input-group-sm pt-1" >
					<span  class="input-group-text" style="font-size:13px;">상품검색</span>
					<input type="text" name="find_text" value="" size="10" class="form-control form-control-sm">
					<button type="button" class="btn btn-sm btn-outline-secondary" style="font-size:13px;" 
						onClick="check_findproduct();">Search</button>
				</div>
			</form>
			
			
			
		</div>
	</div>
</div>

<!-------------------------------------------------------------------------------------------->	
<!-- 시작 : 다른 웹페이지 삽입할 부분 -->
<!-------------------------------------------------------------------------------------------->	

