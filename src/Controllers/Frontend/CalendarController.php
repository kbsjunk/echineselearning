<?php namespace Kitbs\EChineseLearning\Controllers\Frontend;

use Platform\Foundation\Controllers\BaseController;
use Kitbs\EChineseLearning\Repositories\LessonRepositoryInterface;
use Kitbs\EChineseLearning\Repositories\SuspensionRepositoryInterface;
use View;
use Response;
use DB;
use Cache;
use Carbon\Carbon;

class CalendarController extends BaseController {

	private $cached = true;

	/**
	 * Constructor.
	 *
	 * @param  \Kitbs\EChineseLearning\Repositories\LessonRepositoryInterface  $lesson
	 * @return void
	 */
	public function __construct(LessonRepositoryInterface $lesson, SuspensionRepositoryInterface $suspension)
	{
		parent::__construct();

		$this->lesson = $lesson;
		$this->suspension = $suspension;
	}

	/**
	 * Return the iCal view
	 *
	 * @return \Illuminate\View\View
	 */
	public function index()
	{

		$zhongwenkebiao = Cache::remember('zhongwenkebiao', Carbon::now()->addHours(2), function() {

			$lessons = $this->lesson->createModel()
			->where('lesson_at', '>=', Carbon::now()->subWeek())
			->where('enabled', true)->get();

			$suspensions = $this->suspension->createModel()
			->where('end_at', '>=', Carbon::now()->subWeek())
			->where('enabled', true)->get();

			$lastLesson = $this->lesson->createModel()
			->where('lesson_at', '>=', Carbon::now())
			->where('enabled', true)
			->orderBy('lesson_at', 'DESC')
			->pluck('lesson_at');

			$lastSuspension = $this->suspension->createModel()
			->where('end_at', '>=', Carbon::now())
			->where('enabled', true)
			->orderBy('end_at', 'DESC')
			->pluck('end_at');

			$lastDate = Carbon::now()->setTime(0,0,0)->addDays(24);

			$reminder = Carbon::now()->max($lastSuspension)->max($lastLesson)->diff($lastDate)->days;

			if ($reminder >= 7) {
				$reminder = Carbon::now()->setTime(9,0,0);
				if ($reminder < Carbon::now()) {
					$reminder->addDay();
				}
			}
			else {
				$reminder = false;
			}

			$this->cached = false;

			return (string) View::make('kitbs/echineselearning::ical.vcalendar',
				compact('lessons', 'suspensions', 'lastDate', 'lastLesson', 'reminder'));

		});

		// echo $this->cached ? 304 : 200;

		return Response::make($zhongwenkebiao)->header('Content-Type', 'text/plain; charset=utf-8');
		// ->header('Content-Disposition', 'attachment; filename="chinese.ics"');

	}

}
