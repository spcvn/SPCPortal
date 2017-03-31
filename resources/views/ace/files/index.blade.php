@extends('ace.index')
@section('content')
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

	{{-- @php
	echo csrf_token();exit;
	@endphp --}}

	<div class="row">
		<div class="col-xs-12">
			
			<div class="widget-box widget-color-dark ui-sortable-handle" id="widget-box-files">
				<div class="widget-header widget-header">
					<h5 class="widget-title">{{ '../files/' }}</h5>

					<div class="widget-toolbar no-border">
						<label>
							<input type="text" class="ace ace-input-2 form-control files-search" placeholder="Search...">
						</label>
					</div>

					<div class="widget-toolbar no-border">
						<label>
							<select class="form-control files-sort">
								<option value="data-exte">Extension</option>
								<option value="data-type">Type</option>
								<option value="data-name">Name</option>
								<option value="data-size">Size</option>
								<option value="data-time">Last modified</option>
							</select>
						</label>
					</div>

					<div class="widget-toolbar no-border">
						<span class="fa fa-folder fa-fw add-new-f orange"></span>
						<span class="fa fa-file fa-fw add-new-f green"></span>
					</div>

					<div class="widget-toolbar mana-filter no-border">
						<label>
							<input type="checkbox" class="ace ace-checkbox-2 filter-fol" checked="checked">
							<span class="lbl middle padding-4"> Folder</span>
						</label>
						<label>
							<input type="checkbox" class="ace ace-checkbox-2 filter-fil" checked="checked">
							<span class="lbl middle padding-4"> File</span>
						</label>
					</div>

					<div class="widget-toolbar redo-undo-contain">
						<span class="fa fa-angle-double-left data-undo"></span>
						<span class="fa fa-angle-double-right data-redo"></span>
					</div>

				</div>

				<div class="widget-body">
					<div class="contain-mana-files">
						<div class="root-path" style="display:none;"></div>
						<ul class="files-list ace-thumbnails clearfix">
							@foreach ($files as $file)
								<li class="file-item"
									data-name="{{ $file['name'] }}"
									data-type="{{ $file['type'] }}"
									data-exte="{{ $file['exte'] }}"
									data-path="{{ $file['path'] }}"
									data-pare="{{ $file['pare'] }}"
									data-size="{{ $file['size'] }}"
									data-time="{{ $file['time'] }}">
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
	<script type="text/javascript">
		var root_path = $('ul.files-list').find('li').first().attr('data-pare');
		$('.root-path').append(root_path);
	</script>

@stop