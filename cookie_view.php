<!---------------------------------------------------------------------------------------------
	제목 : 내 손으로 만드는 PHP 쇼핑몰무 따라하기 (실습용 디자인 HTML)

	소속 : 인덕대학교 컴퓨터소프트웨어학과
	이름 : 교수 윤형태 (2024.02)
---------------------------------------------------------------------------------------------->
<?
    $name=$_COOKIE["name"];
?>


<html>
<head>
	<title>Cookie</title>
	<meta http-equiv="content-type" content="text/html; charset=utf-8">
</head>
<body>

저장된 cookie값은 <font color="blue"><?=$name;?></font>입니다.
&nbsp;&nbsp
<a href="cookie.html">돌아가기</a>

</body>
</html>