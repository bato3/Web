
<?php


 $servername = "localhost";
$username = "root";
$password = "";
$dbname = "******";
$conn = mysqli_connect($servername, $username, $password, $dbname) or die("Connection failed: " . mysqli_connect_error());
if (mysqli_connect_errno()) {
    printf("Connect failed: %s\n", mysqli_connect_error());
    exit();
};
if(isset($_POST['post'])){
  $uploaded_images = array();
 $text = mysqli_real_escape_string($conn , $_POST['text'] );

       $title = mysqli_real_escape_string($conn ,  $_POST['title'] ) ;



//$maintext = htmlspecialchars_decode($text , ENT_QUOTES);
  //$lastmain = preg_replace('/INSERT/' , 'ok' , $maintext);
 for($i =0 ; $i<count($_FILES['upload_images']['name']); $i++){  
   
                                                        
 
  $null = NULL;
        $upload_dir = "blogUploads/";
        $upload_file = $upload_dir.$_FILES['upload_images']['name'][$i];
		$filename =  implode('@@@', $_FILES['upload_images']['name'])  ;
        if(move_uploaded_file($_FILES['upload_images']['tmp_name'][$i],$upload_file)){
            $uploaded_images[] = $upload_file;
        
			$insert_sql = "INSERT INTO `blog_post` (`id`, `images`, `captions` , `title`  ) VALUES (? , ? , ? , ?)";
			$stmt = mysqli_stmt_init($conn);
      if(!mysqli_stmt_prepare($stmt , $insert_sql)){
        echo "SQL error!! Contact Support";
      }else{
        mysqli_stmt_bind_param($stmt , "ssss" , $null  ,$filename , $text , $title);
        mysqli_stmt_execute($stmt);
      }
    }else{
      $insert_sql = "INSERT INTO `blog_post` (`id`, `images`, `captions` , `title`) VALUES (?, ? , ? , ?)";
      $stmt = mysqli_stmt_init($conn);
      if(!mysqli_stmt_prepare($stmt , $insert_sql)){
        echo "SQL error!! Contact Support";
      }else{
        mysqli_stmt_bind_param($stmt , "ssss" , $null  ,$null , $text , $title);
        mysqli_stmt_execute($stmt);
      }
    }
 }
  

?>
<div class="row">
<h3 class="title">Upload Status: </h3>
	<div class="gallery">
     Post was successfully uploaded
		<?php } ?>
	</div>
</div>


