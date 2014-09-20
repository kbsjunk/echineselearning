<?php namespace Kitbs\EChineseLearning\Repositories;

interface SuspensionRepositoryInterface {

	/**
	 * Returns a dataset compatible with data grid.
	 *
	 * @return \Kitbs\EChineseLearning\Models\Suspension
	 */
	public function grid();

	/**
	 * Returns all the echineselearning entries.
	 *
	 * @return \Kitbs\EChineseLearning\Models\Suspension
	 */
	public function findAll();

	/**
	 * Returns a echineselearning entry by its primary key.
	 *
	 * @param  int  $id
	 * @return \Kitbs\EChineseLearning\Models\Suspension
	 */
	public function find($id);

	/**
	 * Determines if the given echineselearning is valid for creation.
	 *
	 * @param  array  $data
	 * @return \Illuminate\Support\MessageBag
	 */
	public function validForCreation(array $data);

	/**
	 * Determines if the given echineselearning is valid for update.
	 *
	 * @param  int  $id
	 * @param  array  $data
	 * @return \Illuminate\Support\MessageBag
	 */
	public function validForUpdate($id, array $data);

	/**
	 * Creates a echineselearning entry with the given data.
	 *
	 * @param  array  $data
	 * @return \Kitbs\EChineseLearning\Models\Suspension
	 */
	public function create(array $data);

	/**
	 * Updates the echineselearning entry with the given data.
	 *
	 * @param  int  $id
	 * @param  array  $data
	 * @return \Kitbs\EChineseLearning\Models\Suspension
	 */
	public function update($id, array $data);

	/**
	 * Deletes the echineselearning entry.
	 *
	 * @param  int  $id
	 * @return bool
	 */
	public function delete($id);

}
