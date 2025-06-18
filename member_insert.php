<?
    include "common.php";               // DB 연결


   $uid=$_REQUEST["uid"];
 
   $pwd=$_REQUEST["pwd"];
   
   $email=$_REQUEST["email"];
   
   $gubun=$_REQUEST["gubun"];
   
   $name=$_REQUEST["name"];
   
   $sm=$_REQUEST["sm"];
   
   $juso=$_REQUEST["juso"];
   
   $zip=$_REQUEST["zip"];
   
   $tel1=$_REQUEST["tel1"];
   $tel2=$_REQUEST["tel2"];
   $tel3=$_REQUEST["tel3"];
   
   $birthday1=$_REQUEST["birthday1"];
   $birthday2=$_REQUEST["birthday2"];
   $birthday3=$_REQUEST["birthday3"];
	
	
	$tel = sprintf("%-3s%-4s%-4s", $tel1, $tel2, $tel3);
	$birthday = sprintf("%04d-%02d-%02d", $birthday1, $birthday2, $birthday3);
	
	
	
    $sql="insert  into  member  (name, tel, sm, birthday, juso, zip, uid, pwd, email, gubun)
                     values ( '$name', '$tel',  $sm, '$birthday', '$juso', '$zip' ,'$uid', '$pwd', '$email', 0) "; 
					  
    $result=mysqli_query($db, $sql); 
	
	 
    if (!$result) exit("에러: $sql");

    echo("<script>location.href='member_joinend.php'</script>");
?>
