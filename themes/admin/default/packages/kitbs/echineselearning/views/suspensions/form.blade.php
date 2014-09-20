@extends('layouts/default')

{{-- Page title --}}
@section('title')
@parent
:: {{{ trans("kitbs/echineselearning::suspensions/general.{$mode}") }}} {{{ $suspension->exists ? '- ' . $suspension->name . ( $suspension->cancelled ? ' (Cancelled)' : null ) : null }}}
@stop

{{-- Queue assets --}}
{{ Asset::queue('bootstrap.tabs', 'bootstrap/js/tab.js', 'jquery') }}
{{ Asset::queue('echineselearning', 'kitbs/echineselearning::js/script.js', 'jquery') }}

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

	<h1>{{{ trans("kitbs/echineselearning::suspensions/general.{$mode}") }}} <small>{{{ $suspension->name }}} <span class="label label-danger">{{ $suspension->cancelled ? 'Cancelled' : null }}</span></small></h1>

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

							<div class="form-group{{ $errors->first('start_at', ' has-error') }}">

								<label for="start_at" class="control-label">{{{ trans('kitbs/echineselearning::suspensions/form.start_at') }}} <i class="fa fa-info-circle" data-toggle="popover" data-content="{{{ trans('kitbs/echineselearning::suspensions/form.start_at_help') }}}"></i></label>

								<input type="date" class="form-control" name="start_at" id="start_at" placeholder="{{{ trans('kitbs/echineselearning::suspensions/form.start_at') }}}" value="{{{ Input::old('start_at', $suspension->start_at->format('Y-m-d')) }}}">

								<span class="help-block">{{{ $errors->first('start_at', ':message') }}}</span>

							</div>

						</div>
						<div class="col-md-4">

							<div class="form-group{{ $errors->first('end_at', ' has-error') }}">

								<label for="end_at" class="control-label">{{{ trans('kitbs/echineselearning::suspensions/form.end_at') }}} <i class="fa fa-info-circle" data-toggle="popover" data-content="{{{ trans('kitbs/echineselearning::suspensions/form.end_at_help') }}}"></i></label>

								<input type="date" class="form-control" name="end_at" id="end_at" placeholder="{{{ trans('kitbs/echineselearning::suspensions/form.end_at') }}}" value="{{{ Input::old('end_at', $suspension->end_at->format('Y-m-d')) }}}">

								<span class="help-block">{{{ $errors->first('end_at', ':message') }}}</span>

							</div>

						</div>
						<div class="col-md-4">


							<div class="form-group{{ $errors->first('cancelled', ' has-error') }}">

								<label for="cancelled" class="control-label">{{{ trans('kitbs/echineselearning::suspensions/form.cancelled') }}} <i class="fa fa-info-circle" data-toggle="popover" data-content="{{{ trans('kitbs/echineselearning::suspensions/form.cancelled_help') }}}"></i></label>

								<div class="checkbox">
									<label>
										<input type="hidden" name="cancelled" id="cancelled" value="0" checked>
										<input type="checkbox" name="cancelled" id="cancelled" @if($suspension->cancelled) }}}) checked @endif value="1"> {{ ucfirst('cancelled') }}
									</label>
								</div>

								<span class="help-block">{{{ $errors->first('cancelled', ':message') }}}</span>

							</div>

						</div>

					</div>


					<div class="row">
						<div class="col-md-12">


							<div class="form-group{{ $errors->first('desc', ' has-error') }}">

								<label for="desc" class="control-label">{{{ trans('kitbs/echineselearning::suspensions/form.desc') }}} <i class="fa fa-info-circle" data-toggle="popover" data-content="{{{ trans('kitbs/echineselearning::suspensions/form.desc_help') }}}"></i></label>

								<textarea class="form-control" name="desc" id="desc" placeholder="{{{ trans('kitbs/echineselearning::suspensions/form.desc') }}}">{{{ Input::old('desc', $suspension->desc) }}}</textarea>

								<span class="help-block">{{{ $errors->first('desc', ':message') }}}</span>

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
									<label class="control-label">{{{ trans('kitbs/echineselearning::suspensions/form.created_at') }}}</label>
									<p class="form-control-static">{{ $suspension->last_created }} <br><small class="text-muted">{{ $suspension->last_created_when }}</small></p>
								</div>
							</div>
							<div class="col-md-6">
								<div class="form-group">
									<label class="control-label">{{{ trans('kitbs/echineselearning::suspensions/form.updated_at') }}}</label>
									<p class="form-control-static">{{ $suspension->last_updated }} <br><small class="text-muted">{{ $suspension->last_updated_when }}</small></p>
								</div>
							</div>
						</div>

						<div class="row">
							<div class="col-md-6">
								<div class="form-group">
									<label class="control-label">{{{ trans('kitbs/echineselearning::suspensions/form.suspension_when.'.$suspension->is_past) }}}</label>
									<p class="form-control-static">{{ $suspension->name }} <br>
									<small class="text-muted">
										@if ($suspension->is_past == 'past')
										Ended {{ $suspension->end_when }}
										@elseif ($suspension->is_past == 'future')
										Starts {{ $suspension->start_when }}
										@else
										Started {{ $suspension->start_when }},
										ends {{ $suspension->end_when }}
										@endif
									</small></p>
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

				<a class="btn btn-default" href="{{{ URL::toAdmin('echineselearning/suspensions') }}}">{{{ trans('button.cancel') }}}</a>

				<a class="btn btn-danger" data-toggle="modal" data-target="modal-confirm" href="{{ URL::toAdmin("echineselearning/suspensions/{$suspension->id}/delete") }}">{{{ trans('button.delete') }}}</a>

			</div>

		</div>

	</div>

</form>

@stop
