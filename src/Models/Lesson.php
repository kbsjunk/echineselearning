<?php namespace Kitbs\EChineseLearning\Models;

use Platform\Attributes\Models\Entity;
use Carbon\Carbon;
use Cache;

class Lesson extends Entity {

	/**
	 * {@inheritDoc}
	 */
	protected $table = 'ecl_lessons';

	/**
	 * {@inheritDoc}
	 */
	protected $dates = [
		'created_at',
		'updated_at',
		'lesson_at',
	];

	/**
	 * {@inheritDoc}
	 */
	protected $guarded = [
		'id',
	];

	/**
	 * {@inheritDoc}
	 */
	protected $with = [
		'values.attribute',
	];

	/**
	 * {@inheritDoc}
	 */
	protected $appends = [
		'name',
		'lesson_date',
		'lesson_time',
		'cancelled',
		'lesson_when',
		'is_past',
		'last_updated',
		'last_updated_when',
	];

	/**
	 * {@inheritDoc}
	 */
	protected $eavNamespace = 'kitbs/echineselearning.lesson';

	/**
	 * {@inheritDoc}
	 */
	public static function boot()
    {
        parent::boot();

        Lesson::saving(function($lesson) {
        	Cache::forget('zhongwenkebiao');
        });

    }

	public function getNameAttribute()
	{
		if ($this->exists) return $this->lesson_at->format('d M Y g:i A');
	}

	public function getLessonDateAttribute()
	{
		if ($this->exists) return $this->lesson_at->format('d M Y');
	}

	public function getLessonTimeAttribute()
	{
		if ($this->exists) return $this->lesson_at->format('g:i A');
	}

	public function setLessonDateAttribute($value)
	{
		$date = new Carbon($value);
		$this->lesson_at->setDate($date->year, $date->month, $date->day);
	}

	public function setLessonTimeAttribute($value)
	{
		$date = new Carbon($value);
		$this->lesson_at->setTime($date->hour, $date->minute, 0);
	}

	public function getLessonWhenAttribute()
	{
		if ($this->exists) return $this->lesson_at->diffForHumans();
	}

	public function getLastUpdatedAttribute()
	{
		if ($this->exists) return $this->updated_at->format('d M Y g:i A');
	}

	public function getLastCreatedAttribute()
	{
		if ($this->exists) return $this->created_at->format('d M Y g:i A');
	}

	public function getLastCreatedWhenAttribute()
	{
		if ($this->exists) return $this->created_at->diffForHumans();
	}

	public function getLastUpdatedWhenAttribute()
	{
		if ($this->exists) return $this->updated_at->diffForHumans();
	}
	
	public function getCancelledAttribute()
	{
		if ($this->exists) return !$this->enabled;
	}
	
	public function setCancelledAttribute($cancelled)
	{
		$this->enabled = !$cancelled;
	}

	public function getIsPastAttribute()
	{
		if ($this->exists) return $this->lesson_at < new Carbon ? 'past' : 'future';
	}

	public function setTeacherAttribute($value)
	{
		if (empty($value)) { $this->attributes['teacher'] = null; }
		else { $this->attributes['teacher'] = $value; }
	}

	public function getUidAttribute()
	{
		return md5(implode('',$this->attributes)).'@kitbs.com';
	}

	public function getSummaryAttribute()
	{
		return '中文课';
	}

	public function getDescriptionAttribute()
	{
		return '中文课'.PHP_EOL.' 老师：' . ($this->teacher ?: '（待复）');
	}


}
