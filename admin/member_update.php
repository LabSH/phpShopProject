<?
    include "../common.php";               // DB 연결
	
	$id=$_REQUEST["id"];
    $uid=$_REQUEST["uid"];

    $pwd=$_REQUEST["pwd"];

    $name=$_REQUEST["name"];

    $tel1=$_REQUEST["tel1"];
    $tel2=$_REQUEST["tel2"];
    $tel3=$_REQUEST["tel3"];
   

    $zip=$_REQUEST["zip"];
    $juso=$_REQUEST["juso"];

    $birthday1=$_REQUEST["birthday1"];
    $birthday2=$_REQUEST["birthday2"];
    $birthday3=$_REQUEST["birthday3"];
   
    $email=$_REQUEST["email"];
    $gubun=$_REQUEST["gubun"];

	$tel = sprintf("%-3s%-4s%-4s", $tel1, $tel2, $tel3);
	$birthday = sprintf("%04d-%02d-%02d", $birthday1, $birthday2, $birthday3);
	
    
    if (!$pwd){
	
    $sql="update  member  set  name='$name',  tel='$tel', birthday='$birthday', 
                 zip='$zip', juso='$juso', gubun=$gubun, email='$email' where id='$id' ";
    }else{
        $sql="update  member  set  pwd='$pwd', name='$name',  tel='$tel', birthday='$birthday', 
        zip='$zip', juso='$juso', gubun=$gubun, email='$email' where id='$id' ";

        }

    $result=mysqli_query($db,$sql); 
    if (!$result) exit("에러:$sql");
	
	 

    echo("<script>location.href='member.php'</script>");
?>
