							<div class="col-md-8">

								<div class="form-group{{ $errors->first('lesson_at', ' has-error') }}">

									<label for="lesson_at" class="control-label">{{{ trans('kitbs/echineselearning::lessons/form.lesson_at') }}} <i class="fa fa-info-circle" data-toggle="popover" data-content="{{{ trans('kitbs/echineselearning::lessons/form.lesson_at_help') }}}"></i></label>

									<input type="datetime-local" class="form-control" name="lesson_at" id="lesson_at" {{--data-datetimepicker data-date-format="YYYY-MM-DD hh:mm:ss"--}} placeholder="{{{ trans('kitbs/echineselearning::lessons/form.lesson_at') }}}" value="{{{ Input::old('lesson_at', $lesson->lesson_at) }}}">

									<span class="help-block">{{{ $errors->first('lesson_at', ':message') }}}</span>

								</div>

							</div>