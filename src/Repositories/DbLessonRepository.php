<?php namespace Kitbs\EChineseLearning\Repositories;

use Cartalyst\Interpret\Interpreter;
use Illuminate\Events\Dispatcher;
use Illuminate\Filesystem\Filesystem;
use Kitbs\EChineseLearning\Models\Lesson;
use Symfony\Component\Finder\Finder;
use Validator;

class DbLessonRepository implements LessonRepositoryInterface {

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
		// 'lesson_date' => 'date|required',
		// 'lesson_time' => 'required',
		// 'lesson_at' => 'date|required',
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
		return $this->validateLesson($data);
	}

	/**
	 * {@inheritDoc}
	 */
	public function validForUpdate($id, array $data)
	{
		return $this->validateLesson($data);
	}

	/**
	 * {@inheritDoc}
	 */
	public function create(array $data)
	{
		with($lesson = $this->createModel())->fill($data)->save();

		$this->dispatcher->fire('kitbs.echineselearning.lesson.created', $lesson);

		return $lesson;
	}

	/**
	 * {@inheritDoc}
	 */
	public function update($id, array $data)
	{
		$lesson = $this->find($id);

		$lesson->fill($data)->save();
		$lesson->touch();

		$this->dispatcher->fire('kitbs.echineselearning.lesson.updated', $lesson);

		return $lesson;
	}

	/**
	 * {@inheritDoc}
	 */
	public function createOrUpdate(array $data)
	{

		$lesson = $this->createModel()->firstOrCreate($data);
		$lesson->touch();

		$this->dispatcher->fire('kitbs.echineselearning.lesson.updated', $lesson);

		return $lesson;
	}

	/**
	 * {@inheritDoc}
	 */
	public function delete($id)
	{
		if ($lesson = $this->find($id))
		{
			$this->dispatcher->fire('kitbs.echineselearning.lesson.deleted', $lesson);

			$lesson->delete();

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
		if ($lesson = $this->find($id))
		{
			$this->dispatcher->fire('kitbs.echineselearning.lesson.updated', $lesson);
			$lesson->enabled = true;
			$lesson->save();

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
		if ($lesson = $this->find($id))
		{
			$this->dispatcher->fire('kitbs.echineselearning.lesson.updated', $lesson);
			$lesson->enabled = false;
			$lesson->save();

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
	protected function validateLesson($data)
	{
		$validator = Validator::make($data, $this->rules);

		$validator->passes();

		return $validator->errors();
	}

	/**
	 * Returns a distinct list of a given field
	 *
	 * @param  string  $field
	 * @return array
	 */
	public function listOf($field)
	{
		return $this->createModel()->select($field)->distinct()->whereNotNull($field)->orderBy($field)->get()->lists($field);
	}

}
