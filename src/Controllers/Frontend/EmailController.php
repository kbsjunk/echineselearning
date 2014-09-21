<?php namespace Kitbs\EChineseLearning\Controllers\Frontend;

use Platform\Foundation\Controllers\BaseController;
use Kitbs\EChineseLearning\Repositories\LessonRepositoryInterface;
use Kitbs\EChineseLearning\Repositories\SuspensionRepositoryInterface;
use View;
use Input;
use Response;
use Redirect;
use Carbon\Carbon;

class EmailController extends BaseController {

	private $datefinder;
	private $action;

	/**
	 * {@inheritDoc}
	 */
	protected $csrfWhitelist = [
		'index',
	];

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
	 * Process incoming email messages from Mailgun.
	 *
	 * @return void
	 */
	public function index()
	{

		$subject = Input::get('subject');


		$subject = trim(str_replace(array('Fwd:','Re:'), '', $subject));

		switch ($subject) {
			case 'Reservation':
				$this->datefinder = '|(?<date>20[0-9]{2}-[0-9]{2}-[0-9]{2})\s*(?<starttime>[0-9]{2}:[0-9]{2})-(?<endtime>[0-9]{2}:[0-9]{2})\(GMT(?<timezone>\+[0-9]{2}:[0-9]{2})\)|s';
				$this->action = 'reserve';
			break;

			case 'Lesson Cancellation at eChineseLearning':
				$this->datefinder = '|(?<month>[A-Z][a-z]{2})\s+(?<day>[0-9]{1,2})\s*(?<starttime>[0-9]{2}:[0-9]{2}):[0-9]{2}\s(?<year>[0-9]{4})\s\(\(GMT(?<timezone>\+[0-9]{2}:[0-9]{2})\)|s';
				$this->action = 'cancel';
			break;

			case 'Notification: Your Scheduled Lessons':
			case 'Reminder: Your Scheduled Lessons':
			case 'Notification: Your substitute teacher(s) for your scheduled lesson(s)':
				$this->datefinder = '|(?<date>20[0-9]{2}-[0-9]{1,2}-[0-9]{1,2})\s*(?<starttime>[0-9]{2}:[0-9]{2}):00\s*\(GMT(?<timezone>\+[0-9]{2}:[0-9]{2})\).+?Skype ID:\s+(?<teacher>[a-z]+[\.a-z]*[a-z]*)[\._]echineselearning|s';
				$this->action = 'update';
			break;

			case 'Confirmation: temporarily suspension at eChineseLearning':
				$this->datefinder = '|(?<month>[A-Za-z]+) (?<day>[0-9]{1,2}), (?<year>20[0-9]{2}) to (?<monthend>[A-Za-z]+) (?<dayend>[0-9]{1,2}), (?<yearend>20[0-9]{2})|is';
				$this->action = 'suspend';
			break;

			default:
				return Response::make('error', 404);
		}

		$body = Input::get('body-plain');

		if ( preg_match_all($this->datefinder, $body, $matches, PREG_SET_ORDER) ) {

			foreach ($matches as &$date) {

				$record = [];

				if (isset($date['teacher'])) {
					$record['teacher'] = ucwords(str_replace(['.', '_'], ' ', $date['teacher']));
				}

				switch ($this->action) {
					case 'reserve':
					case 'update':
						$record['lesson_at'] = new Carbon($date['date'] . ' ' . $date['starttime'] . $date['timezone']);
					break;
					
					case 'cancel':
						$record['lesson_at'] = new Carbon($date['year'].'-'.$date['month'].'-'.$date['day'] . ' ' . $date['starttime'] . $date['timezone']);
					break;

					case 'suspend':
						$record['start_at'] = new Carbon($date['day'] . ' ' . $date['month'] . ' ' . $date['year']);
						$record['end_at']   = new Carbon($date['dayend'] . ' ' . $date['monthend'] . ' ' . $date['yearend']);
					break;

					default:
						return Response::make('error', 404);
				}

				switch ($this->action) {
					case 'cancel':
						$record['enabled'] = false;
					case 'reserve':
					case 'update':
						$messages = $this->lesson->validForCreation(array_only($record, ['lesson_at']));
					break;

					case 'suspend':
						$messages = $this->suspension->validForCreation($record);
					break;
				}

				// 		$id = $this->lesson->createModel()->where(array_only($record, ['lesson_at']))->first()->id;
				// 		$messages = $this->lesson->validForUpdate($id, array_only($record, ['lesson_at']));

				if ($messages->isEmpty())
				{

					if ($this->action == 'suspend') {
						$record = $this->suspension->createOrUpdate($record);
					}
					else {
						$record = $this->lesson->createOrUpdate($record);
					}
					
				}
				else {

					return Response::make('Error: The record format was invalid.', 404);
					
				}
				
			}

		}
		else {
			return Response::make('Error: No dates found in the email.', 404);
		}

			// Check if the data is valid
			// $messages = $this->lesson->validForCreation($data);

			// Do we have any errors?
			// if ($messages->isEmpty())
			// {
				// Create the lesson
		// 		$lesson = $this->lesson->create($data);
		// 	}
		// }

		// Do we have any errors?
		// if ($messages->isEmpty())
		// {
		// 	// Prepare the success message
		// 	$message = Lang::get("kitbs/echineselearning::lessons/message.success.{$mode}");

		// 	return Redirect::toAdmin("echineselearning/lessons/{$lesson->id}/edit")->withSuccess($message);
		// }

	}

// http://bin.mailgun.net/4fd4f8b9
}
