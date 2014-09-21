@extends('layouts/default')

{{-- Page title --}}
@section('title')
@parent
:: {{{ trans("kitbs/echineselearning::general.ical") }}}
@stop

{{-- Queue assets --}}
{{ Asset::queue('bootstrap.tabs', 'bootstrap/js/tab.js', 'jquery') }}

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

	<h1>{{{ trans("kitbs/echineselearning::general.ical") }}}</h1>

</div>

	{{-- Tabs --}}
	<ul class="nav nav-tabs">
		<li class="active"><a href="#general" data-toggle="tab">{{{ trans('kitbs/echineselearning::general.tabs.general') }}}</a></li>
	</ul>

	{{-- Tabs content --}}
	<div class="tab-content tab-bordered">

		{{-- General tab --}}
		<div class="tab-pane active" id="general">

			<iframe src="/echineselearning.ics" class="well well-sm" style="width:100%;height:400px;"></iframe>

		</div>

	</div>

	{{-- Form actions --}}
	<div class="row">

		<div class="col-lg-7">
			<a class="btn btn-link" href="{{ URL::to('echineselearning.ics') }}">{{ URL::to('echineselearning.ics') }}</a>
		</div>
		<div class="col-lg-5 text-right">

			{{-- Form actions --}}
			<div class="form-group">

				<a class="btn btn-success" href="{{{ URL::toAdmin('echineselearning/preview/refresh') }}}">{{{ trans('kitbs/echineselearning::general.button.refresh') }}}</a>

				<a class="btn btn-default" href="{{{ URL::toAdmin('echineselearning/preview') }}}">{{{ trans('kitbs/echineselearning::general.button.back') }}}</a>


			</div>

		</div>

	</div>

</form>

@stop
