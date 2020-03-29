<?php

if(isset($_POST['uploadBtn'])){
  $file = $_FILES['file'];
  $fileName = $_FILES['file']['name'];
  $fileLocation = $_FILES['file']['tmp_name'];
  $fileSize = $_FILES['file']['size'];
  $fileError = $_FILES['file']['error'];
  $fileType = $_FILES['file']['type'];

  $fileExt = explode('.', $fileName);
  $fileActualExt = strtolower(end($fileExt));

  $allowed = array('jpg', 'jpeg', 'png');

  if(in_array($fileActualExt, $allowed)){
    if($fileError === 0){
      if($fileSize < 500000){
        $uid = 'john';
        $ftp_server = "ftpupload.net";
        $ftp_conn = ftp_connect($ftp_server) or die("Could not connect to $ftp_server");
        $login = ftp_login($ftp_conn, 'epiz_25371887', 'kwVGQtsrOG');

        $serverSource = "htdocs/ProfilePic/".$uid.'.'.$fileActualExt;

        $cdnSource = "https://baacheet.cf/ProfilePic/".$uid.'.'.$fileActualExt;
        echo $cdnSource;
        // upload file
        if (ftp_put($ftp_conn, $serverSource, $fileLocation, FTP_BINARY))
          {
          echo "Successfully uploaded";
          }
        else
          {
          echo "Error uploading";
          }
        // close connection
        ftp_close($ftp_conn);

      }else{
        echo "Your file is too big";
      }
    }else{
      echo "There was an error uploading your file!";
    }
  }else{
    echo "You cannot upload files of this type!";
  }
}
?>