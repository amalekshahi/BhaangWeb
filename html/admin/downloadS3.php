<?php
require_once 'commonUtil.php';

$dbName = $_GET['initAccID'];     //"17124"; 
$expandFolder = $_GET['initFolder'];     //"Images/ddd/..."; 
//$dbName = "17124"; 

//echo "start<br>"; 

$folderArrs = s3_download_asset($dbName,"/"); 

foreach ($orders as $order) {		
		$hasHeader = false; 
		$header = ""; 
		$TuArr = array(); 

		foreach ($folderArrs as $folderArr) {			
				
				$subfolder = $folderArr["fname"]  ; 			
				$folderpath = $folderArr["fpath"]  ;  //  "/Images/"
				$fullpath = $folderArr["fullpath"]  ; 
				$pos = strpos( $folderpath ,  "/" . $order . "/");
				//echo "order[" . $order . "] = path[" .  $folderpath . "] = pos[" . $pos . "]<br>"; 
				
				if ($pos !== false) { //found

							//echo " Header[" ; 
							//echo $hasHeader ? 'true' : 'false'; 
							//echo "]"; 

							if($hasHeader){  
								//echo "Gen TU arr <br>"; 								
								//has header	
								array_push($TuArr,array(
									'name'=>$subfolder,										
								)); 			
								//var_dump($TuArr); 

							}else{   //noheader			
								$hasHeader = true ; 
								$header = $order; 
								//echo "<br>add Header>>" .$header . "<br>" ; 
							}			
					
				}else{
							if($hasHeader){   		// put section
								$checkExpand = ""; 
								if($header == $expandFolder){
									$checkExpand = "checked"; 
								}
								array_push($sections,array(
									'name'=>$header,
									'checkOpt'=>$checkExpand,	
									"tutorials"=>$TuArr,							
								));
								$hasHeader = false; 
							}	
				}// end if pos


		}//end foreach folderArrs

}//end foreach order

	

echo json_encode(array('success'=>true,'sections'=>$sections));



?>