<?php

namespace SPCVN\Http\Controllers;

use SPCVN\Repositories\Activity\ActivityRepository;
use SPCVN\Repositories\User\UserRepository;
use SPCVN\Support\Enum\UserStatus;

class FilesController extends Controller
{
	public function scan($dir){
		$files = array();
		if(file_exists($dir)){
			foreach(scandir($dir) as $f) {
				if(!$f || $f[0] == '.') {
					continue;
				}
				if(is_dir($dir . '/' . $f)) {
					$files[] = array(
						"name" => $f,
						"type" => "folder",
						"path" => $dir . $f,
						"items" => scan($dir . '/' . $f),
						"exte" => ""
					);
				}
				else {
					$files[] = array(
						"name" => $f,
						"type" => "file",
						"path" => $dir . '/' . $f,
						"size" => filesize($dir . '/' . $f),
						"exte" => array_key_exists('extension', pathinfo($f)) ? pathinfo($f)['extension'] : ""
					);
				}
			}
		}
		return $files;
	}

	public function sortFiles($dir){
		$arrTmp = $this->scan($dir);
		$folderTmp = array();
		$filesTmp = array();
		foreach ($arrTmp as $key => $value) {
			if($value['type'] === 'folder'){
				array_push($folderTmp, $value);
			}
			else{
				array_push($filesTmp, $value);
			}
		}
		$sortArray = array();
		foreach($filesTmp as $file){
		    foreach($file as $key=>$value){ 
		        if(!isset($sortArray[$key])){ 
		            $sortArray[$key] = array(); 
		        } 
		        $sortArray[$key][] = $value; 
		    } 
		}
		$orderby = "exte";
		array_multisort($sortArray[$orderby], SORT_ASC, $filesTmp);
		return array_merge($folderTmp, $filesTmp);
	}

	public function index( $dir = null )
	{
		$files = $this->sortFiles($dir);
        return response()->json($files);
	}
}