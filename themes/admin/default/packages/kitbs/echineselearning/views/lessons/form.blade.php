@extends('layouts/default')

{{-- Page title --}}
@section('title')
@parent
:: {{{ trans("kitbs/echineselearning::lessons/general.{$mode}") }}} {{{ $lesson->exists ? '- ' . $lesson->name . ( $lesson->cancelled ? ' (Cancelled)' : null ) : null }}}
@stop

{{-- Queue assets --}}
{{ Asset::queue('bootstrap.tabs', 'bootstrap/js/tab.js', 'jquery') }}
{{ Asset::queue('moment', 'moment/js/moment.js', 'jquery') }}
{{ Asset::queue('echineselearning', 'kitbs/echineselearning::js/form.js', 'jquery') }}

{{ Asset::queue('datetimepicker', 'kitbs/echineselearning::css/bootstrap-datetimepicker.min.css', 'bootstrap') }}
{{ Asset::queue('datetimepicker', 'kitbs/echineselearning::js/bootstrap-datetimepicker.min.js', 'moment') }}

{{-- Inline scripts --}}
@section('scripts')
@parent
@stop

{{-- Inline styles --}}
@section('styles')
@parent
@stop

{{-- Page content --}}
@section('content')

{{-- Page header --}}
<div class="page-header">

	<h1>{{{ trans("kitbs/echineselearning::lessons/general.{$mode}") }}} <small>{{{ $lesson->name }}} <span class="label label-danger">{{ $lesson->cancelled ? 'Cancelled' : null }}</span></small></h1>

</div>

{{-- Content form --}}
<form id="echineselearning-form" action="{{ Request::fullUrl() }}" method="post" accept-char="UTF-8" autocomplete="off">

	{{-- CSRF Token --}}
	<input type="hidden" name="_token" value="{{ csrf_token() }}">

	{{-- Tabs --}}
	<ul class="nav nav-tabs">
		<li class="active"><a href="#general" data-toggle="tab">{{{ trans('kitbs/echineselearning::general.tabs.general') }}}</a></li>
	</ul>

	{{-- Tabs content --}}
	<div class="tab-content tab-bordered">

		{{-- General tab --}}
		<div class="tab-pane active" id="general">

			<div class="row">
				<div class="col-md-6">

					<fieldset>
						<legend>{{ trans('kitbs/echineselearning::general.fieldsets.details') }}</legend>

						<div class="row">

 				<div class="col-md-4">

					<div class="form-group{{ $errors->first('lesson_date', ' has-error') }}">

						<label for="lesson_date" class="control-label">{{{ trans('kitbs/echineselearning::lessons/form.lesson_date') }}} <i class="fa fa-info-circle" data-toggle="popover" data-content="{{{ trans('kitbs/echineselearning::lessons/form.lesson_date_help') }}}"></i></label>

						<input type="date" class="form-control" name="lesson_date" id="lesson_date" placeholder="{{{ trans('kitbs/echineselearning::lessons/form.lesson_at') }}}" value="{{{ Input::old('lesson_date', $lesson->exists ? $lesson->lesson_at->format('Y-m-d') : null) }}}">

						<span class="help-block">{{{ $errors->first('lesson_date', ':message') }}}</span>

					</div>

				</div> 

 				<div class="col-md-4">

					<div class="form-group{{ $errors->first('lesson_time', ' has-error') }}">

						<label for="lesson_time" class="control-label">{{{ trans('kitbs/echineselearning::lessons/form.lesson_time') }}} <i class="fa fa-info-circle" data-toggle="popover" data-content="{{{ trans('kitbs/echineselearning::lessons/form.lesson_time_help') }}}"></i></label>

						<input type="time" class="form-control" name="lesson_time" id="lesson_time" placeholder="{{{ trans('kitbs/echineselearning::lessons/form.lesson_at') }}}" value="{{{ Input::old('lesson_time', $lesson->exists ? $lesson->lesson_at->format('H:i') : null) }}}">

						<span class="help-block">{{{ $errors->first('lesson_time', ':message') }}}</span>

					</div>

				</div> 

							<div class="col-md-4">

								<div class="form-group{{ $errors->first('cancelled', ' has-error') }}">

									<label for="cancelled" class="control-label">{{{ trans('kitbs/echineselearning::lessons/form.cancelled') }}} <i class="fa fa-info-circle" data-toggle="popover" data-content="{{{ trans('kitbs/echineselearning::lessons/form.cancelled_help') }}}"></i></label>

									<div class="checkbox">
										<label>
											<input type="hidden" name="cancelled" id="cancelled" value="0" checked>
											<input type="checkbox" name="cancelled" id="cancelled" @if($lesson->cancelled) }}}) checked @endif value="1"> {{ trans('kitbs/echineselearning::lessons/form.cancelled') }}
										</label>
									</div>

									<span class="help-block">{{{ $errors->first('cancelled', ':message') }}}</span>

								</div>

							</div>
						</div>
						<div class="row">

							<div class="col-md-12">

								<div class="form-group{{ $errors->first('teacher', ' has-error') }}">

									<label for="teacher" class="control-label">{{{ trans('kitbs/echineselearning::lessons/form.teacher') }}} <i class="fa fa-info-circle" data-toggle="popover" data-content="{{{ trans('kitbs/echineselearning::lessons/form.teacher_help') }}}"></i></label>

									<input type="text" class="form-control" name="teacher" id="teacher" placeholder="{{{ trans('kitbs/echineselearning::lessons/form.teacher') }}}" value="{{{ Input::old('teacher', $lesson->teacher) }}}">

									<span class="help-block">{{{ $errors->first('teacher', ':message') }}}</span>

								</div>

							</div>

						</div>
					</fieldset>
				</div>
				<div class="col-md-6">

					<fieldset>
						<legend>{{ trans('kitbs/echineselearning::general.fieldsets.history') }}</legend>

						<div class="row">
							<div class="col-md-6">
								<div class="form-group">
									<label class="control-label">{{{ trans('kitbs/echineselearning::lessons/form.created_at') }}}</label>
									<p class="form-control-static">{{ $lesson->last_created }} <br><small class="text-muted">{{ $lesson->last_created_when }}</small></p>
								</div>
							</div>
							<div class="col-md-6">
								<div class="form-group">
									<label class="control-label">{{{ trans('kitbs/echineselearning::lessons/form.updated_at') }}}</label>
									<p class="form-control-static">{{ $lesson->last_updated }} <br><small class="text-muted">{{ $lesson->last_updated_when }}</small></p>
								</div>
							</div>
						</div>

						<div class="row">
							<div class="col-md-6">
								<div class="form-group">
									<label class="control-label">{{{ trans('kitbs/echineselearning::lessons/form.lesson_when.'.$lesson->is_past ) }}}</label>
									<p class="form-control-static">{{ $lesson->name }} <br><small class="text-muted">{{ $lesson->lesson_when }}</small></p>
								</div>
							</div>
						</div>

					</fieldset>

				</div>
			</div>

		</div>

	</div>

	{{-- Form actions --}}
	<div class="row">

		<div class="col-lg-12 text-right">

			{{-- Form actions --}}
			<div class="form-group">

				<button class="btn btn-success" type="submit">{{{ trans('button.save') }}}</button>

				<a class="btn btn-default" href="{{{ URL::toAdmin('echineselearning/lessons') }}}">{{{ trans('button.cancel') }}}</a>

				<a class="btn btn-danger" data-toggle="modal" data-target="modal-confirm" href="{{ URL::toAdmin("echineselearning/lessons/{$lesson->id}/delete") }}">{{{ trans('button.delete') }}}</a>

			</div>

		</div>

	</div>

</form>

@stop
