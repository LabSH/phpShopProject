<?
	include "main_top.php";



	$query="SELECT * FROM product WHERE icon_new=1 AND status=1 ORDER BY RAND() limit 16";
	$result = mysqli_query($db ,$query);
	$row=mysqli_fetch_array($result);
	
?>

<!-------------------------------------------------------------------------------------------->	
<!-- 시작 : 다른 웹페이지 삽입할 부분 -->
<!-------------------------------------------------------------------------------------------->	

<head>
    <!-- Animate.css 라이브러리 추가 -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/animate.css/4.1.1/animate.min.css"/>
    <!-- 부트스트랩 CSS 추가 -->
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/css/bootstrap.min.css">
    <!-- Custom CSS -->
    <style>
        .card {
            transition: transform 0.3s ease;
        }
        .card:hover {
            transform: scale(1.05);
        }
        .card-title a {
            text-decoration: none;
            color: #000;
        }
        .card-title a:hover {
            color: #007bff;
        }
    </style>
	
</head>

<!--  제목  -->
<div class="row mt-5 mb-1">
    <div class="col" align="center">
        <h2 class="animate__animated animate__fadeInDown">New Arrival</h2>
    </div>
</div>

<!--  상품 진열  -->
<div class="row">
    <?php foreach ($result as $row) {
        $id = $row["id"];
        
        $icon_n  = "";
        $icon_h  = "";
        $icon_s  = "";    

        if ($row["icon_new"] == 1) $icon_n  = "images/i_new.gif";
        if ($row["icon_hit"] == 1) $icon_h  = "images/i_hit.gif";
        if ($row["icon_sale"] == 1 && $row["discount"] > 0) $icon_s  = "images/i_sale.gif";

        $disc = ($row["discount"] != null && $row["discount"] > 0) ? $row["discount"] : 0;

        $price = number_format(round($row["price"] * (100 - $row["discount"]) / 100, -1));
        $real_price = number_format($row["price"]);
    ?>
    <!--  상품1  -->
    <div class="col-sm-3 mb-3">
        <div class="card h-100 animate__animated animate__fadeInUp">
            <div class="zoom_image" align="center">
                <a href="product.php?id=<?= $id; ?>"><img src="product/<?= $row["image1"] ?>"
                    height="360" class="card-img-top img-fluid"></a>
            </div>
            <div class="card-body bg-light" align="center" style="font-size:15px;">
                <div class="card-title">
                    <a href="product.php?id=<?= $id; ?>"><?= $row["name"] ?></a><br>
                    <img src="<?= $icon_n; ?>">&nbsp;<img src="<?= $icon_h; ?>">&nbsp;<img src="<?= $icon_s; ?>">&nbsp;
                    <?php if ($disc > 0 && $row["icon_sale"] == 1): ?>
                        <font size="2" color="red"><?= $disc; ?>%</font>
                    <?php endif; ?>
                </div>
                <?php if ($row["discount"] != null && $row["discount"] > 0 && $row["icon_sale"] == 1): ?>
                    <p class="card-text"><small><strike><?= $real_price; ?></strike></small>&nbsp;&nbsp;<b><?= $price; ?></b></p>
                <?php else: ?>
                    <p class="card-text">&nbsp;&nbsp;<b><?= $price; ?></b></p>
                <?php endif; ?>
            </div>
        </div>
    </div>
    <?php } ?>
</div>


<!-------------------------------------------------------------------------------------------->	
<!-- 끝 : 다른 웹페이지 삽입할 부분 -->
<!-------------------------------------------------------------------------------------------->	
<?
	include "main_bottom.php";
?>
