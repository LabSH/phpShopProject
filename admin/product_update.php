<?
    include "../common.php";               // DB 연결

   $id=$_REQUEST["id"];


   $sel3=$_REQUEST["sel3"];
   $code=$_REQUEST["code"];
   $name=$_REQUEST["name"];
   $coname=$_REQUEST["coname"];

   $price=$_REQUEST["price"];
   $opt1=$_REQUEST["opt1"];
   $opt2=$_REQUEST["opt2"];
   $contents=$_REQUEST["contents"];
   $status=$_REQUEST["status"];

   $name = addslashes($name);
   $content = addslashes($contents);
   

   $regday=$_REQUEST["regday"];
   $discount=$_REQUEST["discount"];

   $icon_new=$_REQUEST["icon_new"];
   $icon_hit=$_REQUEST["icon_hit"];
   $icon_sale=$_REQUEST["icon_sale"];
   $icon_new = ($icon_new == 1) ? 1 : 0;
   $icon_hit = ($icon_hit == 1) ? 1 : 0;
   $icon_sale = ($icon_sale == 1) ? 1 : 0;

   $image1=$_REQUEST["image1"];
   $image2=$_REQUEST["image2"];
   $image3=$_REQUEST["image3"];

   $fname1 = $_FILES["image1"]["name"];
   $fname2 = $_FILES["image2"]["name"];
   $fname3 = $_FILES["image3"]["name"];

   if($fname1 == "") { $fname1 = $_REQUEST["fimage1"]; }
   if($fname2 == "") { $fname2 = $_REQUEST["fimage2"]; }
   if($fname3 == "") { $fname3 = $_REQUEST["fimage3"]; }

   $checkno1 = ($_REQUEST["checkno1"] == 1) ? $_REQUEST["checkno1"] : 0;
   $checkno2 = ($_REQUEST["checkno2"] == 1) ? $_REQUEST["checkno2"] : 0;
   $checkno3 = ($_REQUEST["checkno3"] == 1) ? $_REQUEST["checkno3"] : 0;
  
    if($checkno1 == 1) {$fname1 = "";}
    if($checkno2 == 1) {$fname2 = "";}
    if($checkno3 == 1) {$fname3 = "";}

    if($_FILES["image1"]["error"] == 0 )
    {
        $fname1=$_FILES["image1"]["name"];

        if (!move_uploaded_file($_FILES["image1"]["tmp_name"], "../product/" . $fname1)) exit("업로드 실패");

    }
    if($_FILES["image2"]["error"]==0)      // 선택한 파일이 있는지 조사
    {	
        $fname2=$_FILES["image2"]["name"];

        if (!move_uploaded_file($_FILES["image2"]["tmp_name"], "../product/" . $fname2)) exit("업로드 실패");
       

    }
    if($_FILES["image3"]["error"]==0)      // 선택한 파일이 있는지 조사
    {	
        $fname3=$_FILES["image3"]["name"];

        if (!move_uploaded_file($_FILES["image3"]["tmp_name"], "../product/" . $fname3)) exit("업로드 실패");

    }

    if($discount and $icon_sale == 1){
        $sql = "update product set menu=$sel3, code='$code', name='$name', coname='$coname', price=$price, opt1=$opt1, opt2=$opt2, 
                    contents='$contents', status=$status, icon_new=$icon_new, icon_hit=$icon_hit, icon_sale=$icon_sale, 
                    regday='$regday', discount=$discount, image1='$fname1', image2='$fname2', image3='$fname3' where id='$id'";
    }
   else{
    $sql = "update product set menu=$sel3, code='$code', name='$name', coname='$coname', price=$price, opt1=$opt1, opt2=$opt2, 
                    contents='$contents', status=$status, icon_new=$icon_new, icon_hit=$icon_hit, icon_sale=0, 
                    regday='$regday', discount=0, image1='$fname1', image2='$fname2', image3='$fname3' where id='$id'";
	
   }
					  
    $result=mysqli_query($db, $sql); 
	
	 
    if (!$result) exit("에러: $sql");

    echo("<script>location.href='product.php'</script>");
?>
