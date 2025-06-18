<?  
    $name=$_REQUEST["name"];

    setcookie("name",$name);

    echo("<script>location.href='cookie_view.php'</script>");
?>