<?php
require_once 'commonUtil.php';
?>
<!doctype html>
<html lang="en">
 <head>
  <meta charset="UTF-8">
  <meta name="Generator" content="EditPlus®">
  <meta name="Author" content="">
  <meta name="Keywords" content="">
  <meta name="Description" content="">
  <title>Document</title>
 </head>
 <body>
  <table>
    <thead>
        <tr>
            <th">File</th>
        </tr>
    </thead>
    <tbody >
    <?php foreach($objects as $object): ?>
    <tr>
        <td>
            <form action="#" method="post">
                <input type="checkbox" name="check[]" value="<?php echo $object['Key']; ?>">
                <?php echo basename($object['Key']); ?>
        </td>
    </tr>
    <?php 
        @$check = $_POST['check'];

        endforeach; 

        if (isset($_POST['delete'])) {

            if(!empty($check)){

                foreach($check as $selected){

                    $s3->deleteObject([ 
                        'Bucket' => $bucket, 
                        'Key' => $selected
                        ]);
                }
            }else{
                echo 'Please select a file to delete';
            }
        }
?>
                <input type="submit" name="delete">
            </form>
    </tbody>
</table>

<?php
	if (isset($_POST['delete'])) {
		$s3->deleteObject([ 
		'Bucket' => $bucket, 
		'Key' => $_POST['keyToDelete']
		]);
	}
?>
 </body>
</html>
