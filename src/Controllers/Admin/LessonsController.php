<?php namespace Kitbs\EChineseLearning\Controllers\Admin;

use DataGrid;
use Input;
use Lang;
use Platform\Admin\Controllers\Admin\AdminController;
use Redirect;
use Response;
use View;
use Kitbs\EChineseLearning\Repositories\LessonRepositoryInterface;

class LessonsController extends AdminController {

	/**
	 * {@inheritDoc}
	 */
	protected $csrfWhitelist = [
		'executeAction',
	];

	/**
	 * The EChineseLearning repository.
	 *
	 * @var \Kitbs\EChineseLearning\Repositories\LessonRepositoryInterface
	 */
	protected $lesson;

	/**
	 * Holds all the mass actions we can execute.
	 *
	 * @var array
	 */
	protected $actions = [
		'delete',
		'enable',
		'disable',
	];

	/**
	 * Constructor.
	 *
	 * @param  \Kitbs\EChineseLearning\Repositories\LessonRepositoryInterface  $lesson
	 * @return void
	 */
	public function __construct(LessonRepositoryInterface $lesson)
	{
		parent::__construct();

		$this->lesson = $lesson;
	}

	/**
	 * Display a listing of lesson.
	 *
	 * @return \Illuminate\View\View
	 */
	public function index()
	{
		$teachers = $this->lesson->listOf('teacher');

		return View::make('kitbs/echineselearning::lessons.index', compact('teachers'));
	}

	/**
	 * Datasource for the lesson Data Grid.
	 *
	 * @return \Cartalyst\DataGrid\DataGrid
	 */
	public function grid()
	{
		$data = $this->lesson->grid();

		$columns = [
			'id',
			'lesson_at',
			'enabled',
			'teacher',
			'created_at',
			'updated_at',
		];

		$settings = [
			'sort'      => 'lesson_at',
			'direction' => 'desc',
		];

		return DataGrid::make($data, $columns, $settings);
	}

	/**
	 * Show the form for creating new lesson.
	 *
	 * @return \Illuminate\View\View
	 */
	public function create()
	{
		return $this->showForm('create');
	}

	/**
	 * Handle posting of the form for creating new lesson.
	 *
	 * @return \Illuminate\Http\RedirectResponse
	 */
	public function store()
	{
		return $this->processForm('create');
	}

	/**
	 * Show the form for updating lesson.
	 *
	 * @param  int  $id
	 * @return mixed
	 */
	public function edit($id)
	{
		return $this->showForm('update', $id);
	}

	/**
	 * Handle posting of the form for updating lesson.
	 *
	 * @param  int  $id
	 * @return \Illuminate\Http\RedirectResponse
	 */
	public function update($id)
	{
		return $this->processForm('update', $id);
	}

	/**
	 * Remove the specified lesson.
	 *
	 * @param  int  $id
	 * @return \Illuminate\Http\RedirectResponse
	 */
	public function delete($id)
	{
		if ($this->lesson->delete($id))
		{
			$message = Lang::get('kitbs/echineselearning::lessons/message.success.delete');

			return Redirect::toAdmin('echineselearning/lessons')->withSuccess($message);
		}

		$message = Lang::get('kitbs/echineselearning::lessons/message.error.delete');

		return Redirect::toAdmin('echineselearning/lessons')->withErrors($message);
	}

	/**
	 * Executes the mass action.
	 *
	 * @return \Illuminate\Http\Response
	 */
	public function executeAction()
	{
		$action = Input::get('action');

		if (in_array($action, $this->actions))
		{
			foreach (Input::get('entries', []) as $entry)
			{
				$this->lesson->{$action}($entry);
			}

			return Response::json('Success');
		}

		return Response::json('Failed', 500);
	}

	/**
	 * Shows the form.
	 *
	 * @param  string  $mode
	 * @param  int  $id
	 * @return mixed
	 */
	protected function showForm($mode, $id = null)
	{
		// Do we have a lesson identifier?
		if (isset($id))
		{
			if ( ! $lesson = $this->lesson->find($id))
			{
				$message = Lang::get('kitbs/echineselearning::lessons/message.not_found', compact('id'));

				return Redirect::toAdmin('echineselearning/lessons')->withErrors($message);
			}
		}
		else
		{
			$lesson = $this->lesson->createModel();
		}

		// Show the page
		return View::make('kitbs/echineselearning::lessons.form', compact('mode', 'lesson'));
	}

	/**
	 * Processes the form.
	 *
	 * @param  string  $mode
	 * @param  int  $id
	 * @return \Illuminate\Http\RedirectResponse
	 */
	protected function processForm($mode, $id = null)
	{
		// Get the input data
		$data = Input::all();

		// Do we have a lesson identifier?
		if ($id)
		{
			// Check if the data is valid
			$messages = $this->lesson->validForUpdate($id, $data);

			// Do we have any errors?
			if ($messages->isEmpty())
			{
				// Update the lesson
				$lesson = $this->lesson->update($id, $data);
			}
		}
		else
		{
			// Check if the data is valid
			$messages = $this->lesson->validForCreation($data);

			// Do we have any errors?
			if ($messages->isEmpty())
			{
				// Create the lesson
				$lesson = $this->lesson->create($data);
			}
		}

		// Do we have any errors?
		if ($messages->isEmpty())
		{
			// Prepare the success message
			$message = Lang::get("kitbs/echineselearning::lessons/message.success.{$mode}");

			return Redirect::toAdmin("echineselearning/lessons/{$lesson->id}/edit")->withSuccess($message);
		}

		return Redirect::back()->withInput()->withErrors($messages);
	}

}
