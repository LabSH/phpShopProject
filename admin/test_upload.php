<?
  if ($_FILES["filename"]["error"]==0)      // 선택한 파일이 있는지 조사
  {	
      $fname=$_FILES["filename"]["name"];
      $fsize=$_FILES["filename"]["size"];
	  
	  $newfilename="새파일이름";
	  
	  if(file_exists("../prodcut/ $newfilename")) exit("동일파일있음");
      if (!move_uploaded_file($_FILES["filename"]["tmp_name"], "../product/" . $newfilename))
         exit("업로드 실패");

      echo("파일이름 : $newfilename <br> 파일크기 : $fsize");
  }
?>
