<?php
require_once('Zend/File/Transfer/Exception.php');
require_once('Zend/Filter/File/Rename.php');
require_once('Zend/File/Transfer/Adapter/Http.php');

class Uploader {
     
    private $upload;
     
    public function __construct($path = 'mailFiles') {             
        $this->upload = new Zend_File_Transfer_Adapter_Http();
        //$this->upload->addValidator('Extension', false, 'csv,txt')
		$this->upload->addValidator('ExcludeExtension', false, 'php,exe')
                     ->addValidator('Size', false, array('min' => 1, 'max' => 5120000000)) //max of 2mb = 2097152
                     ->addValidator('Count', false, array('min' => 1, 'max' => 2));
                       
        $renameFilter = new Zend_Filter_File_Rename( $path );
 
        $files = $this->upload->getFileInfo();
        foreach($files as $fileID => $fileInfo) {
            if(!$fileInfo['name']=='') {
				$t = date("mdY-His",time());
                $renameFilter->addFile(array(
                    'source' => $fileInfo['tmp_name'],
                    'target' => $path.'/'.$t.'_'.$fileInfo['name'],  //Set timeindex on file name for uniqueness
                    'overwrite' => true )
                );
            }
        }
        // add filters to Zend_File_Transfer_Adapter_Http
        $this->upload->addFilter($renameFilter);
         
        return $this;
    }
     
    public function isValid() {
        return $this->upload->isValid();
    }
     
    public function getMessages() {
        return $this->upload->getMessages();
    }
     
    public function upload() {
        try {
            $this->upload->receive();
        }
        catch (Zend_File_Transfer_Exception $e) {
            //This is a tad dirty
            throw new Exception('Bad file data: '.$e->getMessage());
        }
        return $this;
    }
     
    public function getUpload() {
        return $this->upload;
    }
}