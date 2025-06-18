<?

include "../common.php";

$adminid=$_REQUEST["adminid"];
$adminpw=$_REQUEST["adminpw"];


//$sql = "select id from admin where admin_id='$admin_id' and admin_pw='$admin_pw'";
//$result = mysqli_query($db,$sql);


if($adminid == $admin_id && $adminpw == $admin_pw){
    setcookie("cookie_admin","yes");
    echo("<script>location.href='member.php'</script>");
}else{
	setcookie("cookie_admin","");
    echo("<script>location.href='index.html'</script>");
}
    

?>