<?php
require_once 'commonUtil.php';

    /*
        Apache will use /tmp/systemtmp-xxxx as /tmp
        So, php in apache can not access real /tmp
    */
    //print_r($_FILES);
	if(!empty($_FILES['file']['name'])){
        $uploadFilename = $_FILES['file']['name'];
        $ext = pathinfo($uploadFilename, PATHINFO_EXTENSION);
        $meta = $_POST;
        $imgSrc = "";
        $sourceFile = $_FILES['file']['tmp_name'];
        $filename = basename($sourceFile) . ".$ext";
        if(!empty($meta['fileName'])){
            $providedFileName = $meta['fileName'];
            $filename = $providedFileName . ".$ext";
            //check if provide acctID and progID
            if(empty($meta['acctID']) or empty($meta['progID'])){
            }else{
                // render file name according to acctID and progID
                $filename = RenderFileName($meta['acctID'],$meta['progID'],$filename);
            }
        }
        //echo "$sourceFile";
        //echo "$filename";
        if(!empty($meta['s3'])){
            if($meta['s3']=='true'){
                $value = file_get_contents($sourceFile);
                $imgSrc = s3_put_contents($filename ,$value);
            }
        }
        if($imgSrc == ""){
            $value = file_get_contents($sourceFile);
            $imgSrc = local_put_contents($filename,$value);
        }
        //phpinfo();
        echo json_encode( 
            array(
                'success'=>true,
                'fileName'=>$filename,
                'imgSrc' => $imgSrc,
                'meta' => $meta,
            )
        );
	}else{
        echo json_encode( array('success'=>false));
    }
?>

