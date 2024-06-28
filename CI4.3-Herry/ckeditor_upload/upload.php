<?php
// Upload script for CKEditor.
// Use at your own risk, no warranty provided. Be careful about who is able to access this file
// The upload folder shouldn't be able to upload any kind of script, just in case.
// If you're not sure, hire a professional that takes care of adjusting the server configuration as well as this script for you.
// (I am not such professional)

// Step 1: change the true for whatever condition you use in your environment to verify that the user
// is logged in and is allowed to use the script

/* 驗證是否可上傳
if ( true ) {
	echo("You're not allowed to upload files");
	die(0);
}
*/

// Step 2: Put here the full absolute path of the folder where you want to save the files:
// You must set the proper permissions on that folder (I think that it's 644, but don't trust me on this one)
// ALWAYS put the final slash (/)
$basePath = "../uploads/";

// Step 3: Put here the Url that should be used for the upload folder (it the URL to access the folder that you have set in $basePath
// you can use a relative url "/images/", or a path including the host "http://example.com/images/"
// ALWAYS put the final slash (/)

//$baseUrl = "./uploads/";
$baseUrl = "/uploads/";

// Done. Now test it!

// No need to modify anything below this line
//----------------------------------------------------

// ------------------------
// Input parameters: optional means that you can ignore it, and required means that you
// must use it to provide the data back to CKEditor.
// ------------------------

// Optional: instance name (might be used to adjust the server folders for example)
$CKEditor = $_GET['CKEditor'] ;


// Required: Function number as indicated by CKEditor.
$funcNum = $_GET['CKEditorFuncNum'] ;

// Optional: To provide localized messages
$langCode = $_GET['langCode'] ;

// ------------------------
// Data processing
// ------------------------

// The returned url of the uploaded file
$url = '' ;

// Optional message to show to the user (file renamed, invalid file, not authenticated...)
$message = '';

// in CKEditor the file is sent as 'upload'
if( isset($_FILES['upload'])){
	// Be careful about all the data that it's sent!!!
	// Check that the user is authenticated, that the file isn't too big,
	// that it matches the kind of allowed resources...
	$name = $_FILES['upload']['name'];
    $original_size = $_FILES['upload']['size'];
    $file_tmp_name = $_FILES['upload']['tmp_name'];
    
    if( $original_size > 1000000 )
    {
        $imgSize = getimagesize( $file_tmp_name );
        $imgWidth = $imgSize[0];
        $imgHeight = $imgSize[1];

        if( $imgWidth > $imgHeight )
        {
            $ratio = ceil( $imgWidth / 1600 );
            $imgNewWidth = ceil( $imgWidth / $ratio );
            $imgNewHeight = ceil( $imgHeight / $ratio );
        }
        else
        {
            $ratio = ceil( $imgHeight / 700 );
            $imgNewHeight = ceil( $imgHeight / $ratio );
            $imgNewWidth = ceil( $imgWidth / $ratio );
        }

        //壓縮檔案
        list($w, $h) = getimagesize($file_tmp_name);
		/* calculate new image size with ratio */
		$ratio = max($imgNewWidth/$w, $imgNewHeight/$h);
		$h = ceil($imgNewHeight / $ratio);
		$x = ($w - $imgNewWidth / $ratio) / 2;
		$w = ceil($imgNewWidth / $ratio);

		/* read binary data from image file */
		$imgString = file_get_contents($file_tmp_name);
		/* create image from string */
		$image = imagecreatefromstring($imgString);
		
		$tmp = imagecreatetruecolor($imgNewWidth, $imgNewHeight);
		imagecopyresampled($tmp, $image,
		0, 0,
		$x, 0,
		$imgNewWidth, $imgNewHeight,
		$w, $h);
		
		if (function_exists('exif_read_data'))
		{
			$exif = exif_read_data($file_tmp_name);
			//var_dump($exif);

			if($exif && isset($exif['Orientation']))
			{
				$orientation = $exif['Orientation'];

				if($orientation != 1)
				{
					$deg = 0;
					switch ($orientation) {
						case 3:
							$deg = 180;
						break;
						case 6:
							$deg = 270;
						break;
						case 8:
							$deg = 90;
						break;
					}

					if ($deg) {
						$tmp = imagerotate($tmp, $deg, 0);        
					}

					imagejpeg($tmp, $file_tmp_name, 95);
				} // if there is some rotation necessary
			} // if have the exif orientation info
		} // if function exists
		
		//imagejpeg($tmp, $file_tmp_name, 80);
		//return $file_tmp_name;
		/* cleanup memory */
		imagedestroy($image);
		imagedestroy($tmp);
        
        //$this->DoImageResize( $file_tmp_name, $imgNewWidth, $imgNewHeight );
    }
    
	$original_type_name = explode('.', $name );
	$original_type_name = $original_type_name[1];
	
	$new_name = mt_rand() . '.' . $original_type_name;
	
	// It doesn't care if the file already exists, it's simply overwritten.
	move_uploaded_file($_FILES["upload"]["tmp_name"], $basePath . $new_name );
	

	// Build the url that should be used for this file   
	$url = $baseUrl . $new_name;
	
	
	// Usually you don't need any message when everything is OK.
    //$message = 'new file uploaded';
}
else
{
	$message = '檔案不可上傳，原因如下：\n1、檔案類型不符合\n2、檔案寬度或高度超過限制';
}

// ------------------------
// Write output
// ------------------------
// We are in an iframe, so we must talk to the object in window.parent
echo "<script type='text/javascript'> window.parent.CKEDITOR.tools.callFunction($funcNum, '$url', '$message')</script>";
