<?php namespace Kitbs\EChineseLearning\Controllers\Admin;

use DataGrid;
use Input;
use Lang;
use Platform\Admin\Controllers\Admin\AdminController;
use Redirect;
use Response;
use View;
use Kitbs\EChineseLearning\Repositories\SuspensionRepositoryInterface;

class SuspensionsController extends AdminController {

	/**
	 * {@inheritDoc}
	 */
	protected $csrfWhitelist = [
		'executeAction',
	];

	/**
	 * The Echineselearning repository.
	 *
	 * @var \Kitbs\EChineseLearning\Repositories\SuspensionRepositoryInterface
	 */
	protected $suspension;

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
	 * @param  \Kitbs\EChineseLearning\Repositories\SuspensionRepositoryInterface  $suspension
	 * @return void
	 */
	public function __construct(SuspensionRepositoryInterface $suspension)
	{
		parent::__construct();

		$this->suspension = $suspension;
	}

	/**
	 * Display a listing of suspension.
	 *
	 * @return \Illuminate\View\View
	 */
	public function index()
	{
		return View::make('kitbs/echineselearning::suspensions.index');
	}

	/**
	 * Datasource for the suspension Data Grid.
	 *
	 * @return \Cartalyst\DataGrid\DataGrid
	 */
	public function grid()
	{
		$data = $this->suspension->grid();

		$columns = [
			'id',
			'start_at',
			'end_at',
			'enabled',
			'desc',
			'created_at',
			'updated_at',
		];

		$settings = [
			'sort'      => 'start_at',
			'direction' => 'desc',
		];

		return DataGrid::make($data, $columns, $settings);
	}

	/**
	 * Show the form for creating new suspension.
	 *
	 * @return \Illuminate\View\View
	 */
	public function create()
	{
		return $this->showForm('create');
	}

	/**
	 * Handle posting of the form for creating new suspension.
	 *
	 * @return \Illuminate\Http\RedirectResponse
	 */
	public function store()
	{
		return $this->processForm('create');
	}

	/**
	 * Show the form for updating suspension.
	 *
	 * @param  int  $id
	 * @return mixed
	 */
	public function edit($id)
	{
		return $this->showForm('update', $id);
	}

	/**
	 * Handle posting of the form for updating suspension.
	 *
	 * @param  int  $id
	 * @return \Illuminate\Http\RedirectResponse
	 */
	public function update($id)
	{
		return $this->processForm('update', $id);
	}

	/**
	 * Remove the specified suspension.
	 *
	 * @param  int  $id
	 * @return \Illuminate\Http\RedirectResponse
	 */
	public function delete($id)
	{
		if ($this->suspension->delete($id))
		{
			$message = Lang::get('kitbs/echineselearning::suspensions/message.success.delete');

			return Redirect::toAdmin('echineselearning/suspensions')->withSuccess($message);
		}

		$message = Lang::get('kitbs/echineselearning::suspensions/message.error.delete');

		return Redirect::toAdmin('echineselearning/suspensions')->withErrors($message);
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
				$this->suspension->{$action}($entry);
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
		// Do we have a suspension identifier?
		if (isset($id))
		{
			if ( ! $suspension = $this->suspension->find($id))
			{
				$message = Lang::get('kitbs/echineselearning::suspensions/message.not_found', compact('id'));

				return Redirect::toAdmin('echineselearning/suspensions')->withErrors($message);
			}
		}
		else
		{
			$suspension = $this->suspension->createModel();
		}

		// Show the page
		return View::make('kitbs/echineselearning::suspensions.form', compact('mode', 'suspension'));
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

		// Do we have a suspension identifier?
		if ($id)
		{
			// Check if the data is valid
			$messages = $this->suspension->validForUpdate($id, $data);

			// Do we have any errors?
			if ($messages->isEmpty())
			{
				// Update the suspension
				$suspension = $this->suspension->update($id, $data);
			}
		}
		else
		{
			// Check if the data is valid
			$messages = $this->suspension->validForCreation($data);

			// Do we have any errors?
			if ($messages->isEmpty())
			{
				// Create the suspension
				$suspension = $this->suspension->create($data);
			}
		}

		// Do we have any errors?
		if ($messages->isEmpty())
		{
			// Prepare the success message
			$message = Lang::get("kitbs/echineselearning::suspensions/message.success.{$mode}");

			return Redirect::toAdmin("echineselearning/suspensions/{$suspension->id}/edit")->withSuccess($message);
		}

		return Redirect::back()->withInput()->withErrors($messages);
	}

}
