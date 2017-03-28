@extends('ace.index')
@section('content')
	<div class="row">
		<div class="col-xs-12">
			<div class="page-header">
				<h1>
					Full Calendar
					<small>
						<i class="ace-icon fa fa-angle-double-right"></i>
						with draggable and editable events
					</small>
				</h1>
			</div>
		</div>
	</div>

	<div class="row">
		<div class="col-xs-12">
			<!-- PAGE CONTENT BEGINS -->
			<div class="row">
				<div class="col-sm-9">
					<div class="space"></div>

					<div id="calendar"></div>
				</div>

				<div class="col-sm-3">
					<div class="widget-box transparent">
						<div class="widget-header">
							<h4>Draggable events</h4>
						</div>

						<div class="widget-body">
							<div class="widget-main no-padding">
								<div id="external-events">
									<div class="external-event label-grey" data-class="label-grey">
										<i class="ace-icon fa fa-arrows"></i>
										My Event 1
									</div>

									<div class="external-event label-success" data-class="label-success">
										<i class="ace-icon fa fa-arrows"></i>
										My Event 2
									</div>

									<div class="external-event label-danger" data-class="label-danger">
										<i class="ace-icon fa fa-arrows"></i>
										My Event 3
									</div>

									<div class="external-event label-purple" data-class="label-purple">
										<i class="ace-icon fa fa-arrows"></i>
										My Event 4
									</div>

									<div class="external-event label-yellow" data-class="label-yellow">
										<i class="ace-icon fa fa-arrows"></i>
										My Event 5
									</div>

									<div class="external-event label-pink" data-class="label-pink">
										<i class="ace-icon fa fa-arrows"></i>
										My Event 6
									</div>

									<div class="external-event label-info" data-class="label-info">
										<i class="ace-icon fa fa-arrows"></i>
										My Event 7
									</div>

									<label>
										<input type="checkbox" class="ace ace-checkbox" id="drop-remove" />
										<span class="lbl"> Remove after drop</span>
									</label>
								</div>
							</div>
						</div>
					</div>
				</div>
			</div>

			<!-- PAGE CONTENT ENDS -->
		</div><!-- /.col -->
	</div><!-- /.row -->

	{{ HTML::script('spcvn/ace/js/jquery-ui.custom.min.js') }}
	{{ HTML::script('spcvn/ace/js/jquery.ui.touch-punch.min.js') }}
	{{ HTML::script('spcvn/ace/js/moment.min.js') }}
	{{ HTML::script('spcvn/ace/js/fullcalendar.min.js') }}
	{{ HTML::script('spcvn/ace/js/bootbox.js') }}

	<script type="text/javascript">
		jQuery(function($) {
			$('#external-events div.external-event').each(function() {
				var eventObject = {
					title: $.trim($(this).text())
				};
				$(this).data('eventObject', eventObject);
				$(this).draggable({
					zIndex: 999,
					revert: true,
					revertDuration: 0
				});
			});
			var date = new Date();
			var d = date.getDate();
			var m = date.getMonth();
			var y = date.getFullYear();

			var calendar = $('#calendar').fullCalendar({
				buttonHtml: {
					prev: '<i class="ace-icon fa fa-chevron-left"></i>',
					next: '<i class="ace-icon fa fa-chevron-right"></i>'
				},
				header: {
					left: 'prev,next today',
					center: 'title',
					right: 'month,agendaWeek,agendaDay'
				},
				events: [
				{
					title: 'All Day Event',
					start: new Date(y, m, 1),
					className: 'label-important'
				},
				{
					title: 'Long Event',
					start: moment().subtract(5, 'days').format('YYYY-MM-DD'),
					end: moment().subtract(1, 'days').format('YYYY-MM-DD'),
					className: 'label-success'
				},
				{
					title: 'Some Event',
					start: new Date(y, m, d-3, 16, 0),
					allDay: false,
					className: 'label-info'
				}
				],
				editable: true,
				droppable: true,
				drop: function(date) {
					var originalEventObject = $(this).data('eventObject');
					var $extraEventClass = $(this).attr('data-class');
					var copiedEventObject = $.extend({}, originalEventObject);
					copiedEventObject.start = date;
					copiedEventObject.allDay = false;
					if($extraEventClass) copiedEventObject['className'] = [$extraEventClass];
					$('#calendar').fullCalendar('renderEvent', copiedEventObject, true);
					if ($('#drop-remove').is(':checked')) {
						$(this).remove();
					}
				},
				selectable: true,
				selectHelper: true,
				select: function(start, end, allDay) {
					bootbox.prompt("New Event Title:", function(title) {
						if (title !== null) {
							calendar.fullCalendar('renderEvent', {
								title: title,
								start: start,
								end: end,
								allDay: allDay,
								className: 'label-info'
							},
							true
							);
						}
					});
					calendar.fullCalendar('unselect');
				},
				eventClick: function(calEvent, jsEvent, view) {
					var modal = '<div class="modal fade">\
									<div class="modal-dialog">\
										<div class="modal-content">\
											<div class="modal-body">\
												<button type="button" class="close" data-dismiss="modal" style="margin-top:-10px;">&times;</button>\
												<form class="no-margin">\
													<label>Change event name &nbsp;</label>\
													<input class="middle" autocomplete="off" type="text" value="' + calEvent.title + '" />\
													<button type="submit" class="btn btn-sm btn-success"><i class="ace-icon fa fa-check"></i> Save</button>\
												</form>\
											</div>\
											<div class="modal-footer">\
												<button type="button" class="btn btn-sm btn-danger" data-action="delete"><i class="ace-icon fa fa-trash-o"></i> Delete Event</button>\
												<button type="button" class="btn btn-sm" data-dismiss="modal"><i class="ace-icon fa fa-times"></i> Cancel</button>\
											</div>\
										</div>\
									</div>\
								</div>';
					var modal = $(modal).appendTo('body');
					modal.find('form').on('submit', function(ev){
						ev.preventDefault();
						calEvent.title = $(this).find("input[type=text]").val();
						calendar.fullCalendar('updateEvent', calEvent);
						modal.modal("hide");
					});
					modal.find('button[data-action=delete]').on('click', function() {
						calendar.fullCalendar('removeEvents' , function(ev){
							return (ev._id == calEvent._id);
						})
						modal.modal("hide");
					});
					modal.modal('show').on('hidden', function(){
						modal.remove();
					});
				}
			});
		})
	</script>
@stop