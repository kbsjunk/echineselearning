<?php namespace Kitbs\EChineseLearning\Controllers\Admin;

use Platform\Admin\Controllers\Admin\AdminController;
use View;
use Redirect;
use Cache;

class CalendarController extends AdminController {

	/**
	 * Display a preview of the iCal.
	 *
	 * @return \Illuminate\View\View
	 */
	public function index()
	{
		return View::make('kitbs/echineselearning::ical.form');
	}

	/**
	 * Empty the cache and refresh the calendar.
	 *
	 * @return \Illuminate\Routing\RedirectResponse
	 */
	public function refresh()
	{
		Cache::forget('zhongwenkebiao');

		return Redirect::action('Kitbs\EChineseLearning\Controllers\Admin\CalendarController@index');
	}

}
