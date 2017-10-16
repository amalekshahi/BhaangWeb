<?php
$email = "tt994613@gmail.com";
						$config = file_get_contents("./gatekeeper/gatekeeper.json");
						$gates = json_decode($config, TRUE); // Load the current gatekeeper config
						
						foreach ($gates as $g) { // Create the array of gates for this user in format gate_name = TRUE or gate_name = FALSE.
							$dave[$g['Code_Nick']] = strpos($g['Who_Can_See'], $email) !== FALSE ? "TRUE" : "FALSE";
              echo $g['Who_Can_See'];
						}	

print_r($dave);

?>