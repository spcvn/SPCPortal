@extends('ace.index')
@section('content')
	<div class="row">
		<div class="col-xs-12">
			<div class="page-header">
				<h1>
					Custom table
					<small>
						<i class="ace-icon fa fa-angle-double-right"></i>
						Ajax filter for table
					</small>
				</h1>
			</div>
		</div>
	</div>

	<div class="row">
		<div class="col-xs-12">
			<form class="form-inline text-right">
				<div class="form-group" style="margin-bottom:15px">
					<select id="value-filter" class="form-control">
						<option value="">Select</option>
						<option value="diamond">Diamond</option>
						<option value="vip">Vip</option>
						<option value="gold">Gold</option>
						<option value="normal">Normal</option>
					</select>
					<div class="input-group">
						<input type="text" class="form-control search-query" placeholder="Type your query">
						<span class="input-group-btn">
							<button type="button" class="btn btn-success btn-sm">
								<span class="ace-icon fa fa-search icon-on-right bigger-110"></span> Search
							</button>
						</span>
					</div>
				</div>
			</form>
		</div>
	</div>

	<div class="row">
		<div class="col-xs-12">
			<table id="simple-table" class="table  table-bordered table-hover">
				<thead>
					<tr>
						<th>Domain</th>
						<th>Price</th>
						<th class="hidden-480">Clicks</th>
						<th><i class="ace-icon fa fa-clock-o bigger-110 hidden-480"></i>Update</th>
						<th class="hidden-480">Status</th>
					</tr>
				</thead>

				<tbody>
					<tr>
						<td><a href="#">ace.com</a></td>
						<td>$45</td>
						<td class="hidden-480">Normal</td>
						<td>Feb 12</td>
						<td class="hidden-480">
							<span class="label label-sm label-warning">Vip</span>
						</td>
						<td>
							<div class="hidden-sm hidden-xs btn-group">
								<button class="btn btn-xs btn-success">
									<i class="ace-icon fa fa-check bigger-120"></i>
								</button>
								<button class="btn btn-xs btn-info">
									<i class="ace-icon fa fa-pencil bigger-120"></i>
								</button>
								<button class="btn btn-xs btn-danger">
									<i class="ace-icon fa fa-trash-o bigger-120"></i>
								</button>
								<button class="btn btn-xs btn-warning">
									<i class="ace-icon fa fa-flag bigger-120"></i>
								</button>
							</div>

							<div class="hidden-md hidden-lg">
								<div class="inline pos-rel">
									<button class="btn btn-minier btn-primary dropdown-toggle" data-toggle="dropdown" data-position="auto">
										<i class="ace-icon fa fa-cog icon-only bigger-110"></i>
									</button>

									<ul class="dropdown-menu dropdown-only-icon dropdown-yellow dropdown-menu-right dropdown-caret dropdown-close">
										<li>
											<a href="#" class="tooltip-info" data-rel="tooltip" title="View">
												<span class="blue"><i class="ace-icon fa fa-search-plus bigger-120"></i></span>
											</a>
										</li>

										<li>
											<a href="#" class="tooltip-success" data-rel="tooltip" title="Edit">
												<span class="green"><i class="ace-icon fa fa-pencil-square-o bigger-120"></i></span>
											</a>
										</li>

										<li>
											<a href="#" class="tooltip-error" data-rel="tooltip" title="Delete">
												<span class="red"><i class="ace-icon fa fa-trash-o bigger-120"></i></span>
											</a>
										</li>
									</ul>
								</div>
							</div>
						</td>
					</tr>
				</tbody>
			</table>
		</div>
	</div>


	<script>
		var data_sample = [
			{col1: 'a', col2: 'data-col2', col3: 'data-col3', col4: 'data-col4', status: 'diamond'},
			{col1: 'b', col2: 'data-col2', col3: 'data-col3', col4: 'data-col4', status: 'gold'},
			{col1: 'c', col2: 'data-col2', col3: 'data-col3', col4: 'data-col4', status: 'vip'},
			{col1: 'd', col2: 'data-col2', col3: 'data-col3', col4: 'data-col4', status: 'normal'},
			{col1: 'e', col2: 'data-col2', col3: 'data-col3', col4: 'data-col4', status: 'gold'},
			{col1: 'f', col2: 'data-col2', col3: 'data-col3', col4: 'data-col4', status: 'normal'}
		];

		function drawTable(data, __filter = null){
			var table = $('#simple-table tbody');
			$(table).find('tr').remove();
			for (var i = 0; i < data.length; i++) {
				var trTmp = '<tr></tr>';
				$(trTmp).appendTo(table);
				var __cell = '<td>' + data[i]['col1'] + '</td>';
				__cell += '<td>' + data[i]['col2'] + '</td>';
				__cell += '<td>' + data[i]['col3'] + '</td>';
				__cell += '<td>' + data[i]['col4'] + '</td>';
				__cell += '<td>' + data[i]['status'] + '</td>';

				if(__filter && (data[i]['status'] == __filter))
					$(__cell).appendTo(table.find('tr').last());
				else if(!__filter)
					$(__cell).appendTo(table.find('tr').last());
			}
		}
		drawTable(data_sample);

		$('select#value-filter').change(function(event) {
			drawTable(data_sample, $(this).val());
		});
	</script>

	{{-- I can't create paging with jquery if don't load all of data / You can use 'php' to create paging --}}
	{{-- Because the data don't load all, Search proccess can't use jquery --}}
@stop