<?php namespace Kitbs\EChineseLearning\Repositories;

use Cartalyst\Interpret\Interpreter;
use Illuminate\Events\Dispatcher;
use Illuminate\Filesystem\Filesystem;
use Kitbs\EChineseLearning\Models\Suspension;
use Symfony\Component\Finder\Finder;
use Validator;

class DbSuspensionRepository implements SuspensionRepositoryInterface {

	/**
	 * The Eloquent echineselearning model.
	 *
	 * @var string
	 */
	protected $model;

	/**
	 * The event dispatcher instance.
	 *
	 * @var \Illuminate\Events\Dispatcher
	 */
	protected $dispatcher;

	/**
	 * Holds the form validation rules.
	 *
	 * @var array
	 */
	protected $rules = [
		'start_at' => 'date|required',
		'end_at' => 'date|required',
	];

	/**
	 * Constructor.
	 *
	 * @param  string  $model
	 * @param  \Illuminate\Events\Dispatcher  $dispatcher
	 * @return void
	 */
	public function __construct($model, Dispatcher $dispatcher)
	{
		$this->model = $model;

		$this->dispatcher = $dispatcher;
	}

	/**
	 * {@inheritDoc}
	 */
	public function grid()
	{
		return $this
			->createModel();
	}

	/**
	 * {@inheritDoc}
	 */
	public function findAll()
	{
		return $this
			->createModel()
			->newQuery()
			->get();
	}

	/**
	 * {@inheritDoc}
	 */
	public function find($id)
	{
		return $this
			->createModel()
			->where('id', (int) $id)
			->first();
	}

	/**
	 * {@inheritDoc}
	 */
	public function validForCreation(array $data)
	{
		return $this->validateSuspension($data);
	}

	/**
	 * {@inheritDoc}
	 */
	public function validForUpdate($id, array $data)
	{
		return $this->validateSuspension($data);
	}

	/**
	 * {@inheritDoc}
	 */
	public function create(array $data)
	{
		with($suspension = $this->createModel())->fill($data)->save();

		$this->dispatcher->fire('kitbs.echineselearning.suspension.created', $suspension);

		return $suspension;
	}

	/**
	 * {@inheritDoc}
	 */
	public function update($id, array $data)
	{
		$suspension = $this->find($id);

		$suspension->fill($data)->save();

		$this->dispatcher->fire('kitbs.echineselearning.suspension.updated', $suspension);

		return $suspension;
	}

	/**
	 * {@inheritDoc}
	 */
	public function createOrUpdate(array $data)
	{

		$suspension = $this->createModel()->firstOrCreate($data);
		$suspension->touch();

		$this->dispatcher->fire('kitbs.echineselearning.suspension.updated', $suspension);

		return $suspension;
	}

	/**
	 * {@inheritDoc}
	 */
	public function delete($id)
	{
		if ($suspension = $this->find($id))
		{
			$this->dispatcher->fire('kitbs.echineselearning.suspension.deleted', $suspension);

			$suspension->delete();

			return true;
		}

		return false;
	}

	/**
	 * Enable a record
	 *
	 * @param  integer  $id
	 * @return boolean
	 */
	public function enable($id)
	{
		if ($suspension = $this->find($id))
		{
			$this->dispatcher->fire('kitbs.echineselearning.suspension.updated', $suspension);
			$suspension->enabled = true;
			$suspension->save();

			return true;
		}

		return false;
	}

	/**
	 * Disable a record
	 *
	 * @param  integer  $id
	 * @return boolean
	 */
	public function disable($id)
	{
		if ($suspension = $this->find($id))
		{
			$this->dispatcher->fire('kitbs.echineselearning.suspension.updated', $suspension);
			$suspension->enabled = false;
			$suspension->save();

			return true;
		}

		return false;
	}

	/**
	 * Create a new instance of the model.
	 *
	 * @param  array  $data
	 * @return \Illuminate\Database\Eloquent\Model
	 */
	public function createModel(array $data = [])
	{
		$class = '\\'.ltrim($this->model, '\\');

		return new $class($data);
	}

	/**
	 * Validates a echineselearning entry.
	 *
	 * @param  array  $data
	 * @return \Illuminate\Support\MessageBag
	 */
	protected function validateSuspension($data)
	{
		$validator = Validator::make($data, $this->rules);

		$validator->passes();

		return $validator->errors();
	}

}
