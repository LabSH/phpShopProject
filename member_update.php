<?
    include "common.php";               // DB 연결
	
	$cookie_id=$_COOKIE["cookie_id"];
    $name=$_REQUEST["name"];
    $pwd=$_REQUEST["pwd"];
    $pwd1=$_REQUEST["pwd1"];

    $tel1=$_REQUEST["tel1"];
    $tel2=$_REQUEST["tel2"];
    $tel3=$_REQUEST["tel3"];
   
   
   $birthday1=$_REQUEST["birthday1"];
   $birthday2=$_REQUEST["birthday2"];
   $birthday3=$_REQUEST["birthday3"];
   
   $juso=$_REQUEST["juso"];
   $zip=$_REQUEST["zip"];
   $email=$_REQUEST["email"];
	
	$tel = sprintf("%-3s%-4s%-4s", $tel1, $tel2, $tel3);
	$birthday = sprintf("%04d-%02d-%02d", $birthday1, $birthday2, $birthday3);
	
	
    // $sql="update member set pwd='$pwd' where uid=$cookie_id)";
    //$sql = "select * from member where uid='$cookie_id'";

    if (!$pwd)
            $sql="update  member  set  name='$name',  tel='$tel', birthday='$birthday', 
                    juso='$juso' , zip='$zip',email='$email' where uid='$cookie_id' ";
    elseif($pwd == $pwd1){
            $sql="update  member  set  name='$name',  tel='$tel', birthday='$birthday', 
                    juso='$juso',pwd='$pwd' ,zip='$zip',email='$email' where uid='$cookie_id' ";
    }

    $result=mysqli_query($db,$sql); 
    if (!$result) exit("에러:$sql");

    echo("<script>location.href='member_edit.php'</script>");
?>
