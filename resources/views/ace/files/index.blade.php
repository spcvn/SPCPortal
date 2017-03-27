@extends('ace.index')
@section('content')
	<?php
		$file_dir = public_path() . '/spcvn/ace/files/files/';

		function scan($dir){
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
							"items" => scan($dir . '/' . $f), // Recursively get the contents of the folder
							"exte" => ""
						);
					}
					else {
						$files[] = array(
							"name" => $f,
							"type" => "file",
							"path" => $dir . '/' . $f,
							"size" => filesize($dir . '/' . $f), // Gets the size of this file
							"exte" => array_key_exists('extension', pathinfo($f)) ? pathinfo($f)['extension'] : ""
						);
					}
				}
			}
			return $files;
		}
		function sortFiles($dir){
			$arrTmp = scan($dir);
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
	?>
	<div class="row">
		<div class="col-xs-12">
			<div class="page-header">
				<h1>
					File manager
					<small>
						<i class="ace-icon fa fa-angle-double-right"></i>
						Common form elements and layouts
					</small>
				</h1>
			</div>
		</div>
	</div>

	<div class="row">
		<div class="col-xs-12">
			
			<div class="widget-box widget-color-dark ui-sortable-handle" id="widget-box-files">
				<div class="widget-header widget-header">
					<div class="col-xs-4">
						<select class="option-dir form-control">
							<option value="{{ $file_dir }}">{{ '../files/' }}</option>
							@foreach (sortFiles($file_dir) as $file)
								<?php if($file['type'] === 'folder') : ?>
									<option value="{{ $file['path'] }}">{{ '../' . @explode('/files/', $file['path'])['1'] }}</option>
								<?php endif; ?>
							@endforeach
						</select>
					</div>

					<div class="widget-toolbar no-border">
						<label>
							<input type="text" class="ace ace-input-2 form-control files-search" placeholder="Search...">
						</label>
					</div>

					<div class="widget-toolbar no-border">
						<span class="fa fa-folder fa-fw add-new-f orange"></span>
						<span class="fa fa-file fa-fw add-new-f green"></span>
					</div>

					<div class="widget-toolbar mana-filter">
						<label>
							<input type="checkbox" class="ace ace-checkbox-2 filter-fol" checked="checked">
							<span class="lbl middle padding-4"> Folder</span>
						</label>
						<label>
							<input type="checkbox" class="ace ace-checkbox-2 filter-fil" checked="checked">
							<span class="lbl middle padding-4"> File</span>
						</label>
					</div>

				</div>

				<div class="widget-body">
					<div class="contain-mana-files">
						<ul class="files-list ace-thumbnails clearfix">
							@foreach (sortFiles($file_dir) as $file)
								<li class="file-item"
									data-name="{{ $file['name'] }}"
									data-type="{{ $file['type'] }}"
									data-exte="{{ $file['exte'] }}"
									data-path="{{ $file['path'] }}">
									<div class="file-icon"></div>
									<div class="file-info">{{ $file['name'] }}</div>
								</li>
							@endforeach
						</ul>
					</div>
				</div>
			</div>

		</div>
	</div>
	{{ HTML::style('spcvn/ace/files/css/files.css') }}
	{{ HTML::script('spcvn/ace/files/js/files.js') }}
@stop