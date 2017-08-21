<?php
#require '/var/www/html/vendor/autoload.php';
#require_once 'global.php';
require_once 'commonUtil.php';

function outerHTML($e) {
     $doc = new DOMDocument();
     $doc->appendChild($doc->importNode($e, true));
     return $doc->saveHTML();
}
class ScheduleGenerator 
{
    var $doc;
    
    function __construct()
    {		
        $this->doc = new DOMDocument();
        $this->doc->loadXML("<Schedules></Schedules>");
    }		
    
    function Set($name,$value)
    {
        
    }
    
    function Add($email,$subject,$startDate,$endDate)
    {
        $template = <<<XML
<Schedule DbId="0" Id="1" Status="Scheduled" Type="Fixed" TimeZone="Pacific Standard Time" EmailNotification="{{EMAIL_NOTIFICATION}}" ApprovalRequired="False">
<Subject>{{SUBJECT}}</Subject>
<Body />
<Start DateTime="{{START_DATE}}" />
<End DateTime="{{END_DATE}}" />
</Schedule>
XML;

        $template = str_replace("{{EMAIL_NOTIFICATION}}", "$email", $template);
        $template = str_replace("{{SUBJECT}}", "$subject", $template);
        $template = str_replace("{{START_DATE}}", "$startDate", $template);
        $template = str_replace("{{END_DATE}}", "$endDate", $template);
        
        $doc = new DOMDocument();
        $doc->loadXML($template);
        $xpath = new DOMXpath($doc);
        $node = $xpath->query("//Schedule")->item(0);
        $inode = $this->doc->importNode($node, TRUE);
        $this->doc->documentElement->appendChild($inode);


    }
    
    function AddEmail($subject,$days,$hours,$mins)
    {
        $template = <<<XML
<Schedule DbId="0" Id="1" Status="Scheduled" Type="Offset" ContactScope="Both" ReevaluateTriggerFilter="False">
<Subject>{{SUBJECT}}</Subject>
<Body />
<Start Days="{{DAYS}}" Hours="{{HOURS}}" Mins="{{MINS}}" />
</Schedule>        
XML;

        $template = str_replace("{{SUBJECT}}", "$subject", $template);
        $template = str_replace("{{DAYS}}", "$days", $template);
        $template = str_replace("{{HOURS}}", "$hours", $template);
        $template = str_replace("{{MINS}}", "$mins", $template);
        
        $doc = new DOMDocument();
        $doc->loadXML($template);
        $xpath = new DOMXpath($doc);
        $node = $xpath->query("//Schedule")->item(0);
        $inode = $this->doc->importNode($node, TRUE);
        $this->doc->documentElement->appendChild($inode);

    }
        
/*for($i=0;$i<2;$i++){
    $Schedule = $xmlDoc->createElement("Schedule");
    $Schedules->appendChild($Schedule);
}
$xmlDoc->documentElement->appendChild($Schedules);
    }
*/    
    
}

//$xml=simplexml_load_file("maml/EmailMarketing_w_LandingPage.TMAML-v2.maml") or die("Error: Cannot create object");


//echo "TestXML<br>";
//echo $xml['Name'];

$xmlDoc = new DOMDocument();
$xmlDoc->load("maml/EmailMarketing_w_LandingPage.TMAML-v2.maml");
$xpath = new DOMXpath($xmlDoc);

//Get MicroSite Schedulte
$micriSiteSchedules = $xpath->query("//CampaignElement[@Type='Microsite']/Schedules");
//foreach ($micriSiteSchedules as $element) {
    //print_r($xmlDoc->saveXML($element->parentNode->parentNode));
//}

//Get Email schedule
$emailSchedules = $xpath->query("//CampaignElement[@Type='Email']/Schedules/Schedule");
foreach ($emailSchedules as $element) {
    //print_r($xmlDoc->saveXML($element));
}

$s = new ScheduleGenerator($xmlDoc);
for($i=0;$i<5;$i++){
    $s->Add("email$i","subject$i","start$i","End$i");
}

for($i=0;$i<2;$i++){
$s->AddEmail("subject$i","D$i","H$i","M$i");
}

//print_r($s->doc->saveXML());
$inode = $xmlDoc->importNode($s->doc->documentElement, TRUE);
//print_r($inode);

$micriSiteSchedule = $micriSiteSchedules->item(0);
$micriSiteSchedule->parentNode->replaceChild($inode,$micriSiteSchedule);

//print_r($s->doc->saveXML());
print_r($xmlDoc->saveXML());
?>