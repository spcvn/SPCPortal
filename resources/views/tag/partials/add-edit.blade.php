<!-- Modal (Pop up when detail button clicked) -->
  <div class="modal fade" id="tagModel" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
      <div class="modal-dialog">
          <div class="modal-content">

              <div class="modal-header">
                  <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">×</span></button>
                  <h4 class="modal-title" id="myModalLabel">@lang('app.title_create_tag')</h4>
              </div>
              <div class="modal-body">
              <form id="frmTag" name="frmTag" class="form-horizontal" data-toggle="validator">
                  {!! Form::hidden('user_id', Auth::user()->present()->id) !!}
                      <label class="control-label" for="title">@lang('app.name')</label>
                      <input type="text" name="name" class="form-control required" id="tag_name" placeholder="@lang('app.tag_name')" maxlength="100" value=""/>
                      <p class="error"></p>
                  </form>
              </div>
              <div class="modal-footer">
                  <button type="submit" id="btn-save-tag" class="btn crud-submit btn-success">
                      <i class="fa fa-save"></i>
                      @lang('app.create_tag')
                  </button>
                  <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
                  <input type="hidden" id="tag_id" name="tag_id" value="0">
              </div>

          </div>
      </div>
  </div>
