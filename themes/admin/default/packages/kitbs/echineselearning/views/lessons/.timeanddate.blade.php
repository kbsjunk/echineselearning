 				<div class="col-md-2">

					<div class="form-group{{ $errors->first('lesson_date', ' has-error') }}">

						<label for="lesson_date" class="control-label">{{{ trans('kitbs/echineselearning::lessons/form.lesson_date') }}} <i class="fa fa-info-circle" data-toggle="popover" data-content="{{{ trans('kitbs/echineselearning::lessons/form.lesson_date_help') }}}"></i></label>

						<input type="date" class="form-control" name="lesson_date" id="lesson_date" data-datetimepicker data-date-format="DD MMM YYYY" data-date-picktime="false" placeholder="{{{ trans('kitbs/echineselearning::lessons/form.lesson_at') }}}" value="{{{ Input::old('lesson_date', $lesson->lesson_date) }}}">

						<span class="help-block">{{{ $errors->first('lesson_date', ':message') }}}</span>

					</div>

				</div> 

 				<div class="col-md-2">

					<div class="form-group{{ $errors->first('lesson_time', ' has-error') }}">

						<label for="lesson_time" class="control-label">{{{ trans('kitbs/echineselearning::lessons/form.lesson_time') }}} <i class="fa fa-info-circle" data-toggle="popover" data-content="{{{ trans('kitbs/echineselearning::lessons/form.lesson_time_help') }}}"></i></label>

						<input type="time" class="form-control" name="lesson_time" id="lesson_time" data-datetimepicker data-date-format="h:mm A" data-date-pickdate="false" placeholder="{{{ trans('kitbs/echineselearning::lessons/form.lesson_at') }}}" value="{{{ Input::old('lesson_time', $lesson->lesson_time) }}}">

						<span class="help-block">{{{ $errors->first('lesson_time', ':message') }}}</span>

					</div>

				</div> 