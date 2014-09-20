<?php namespace Kitbs\EChineseLearning\Models;

use Platform\Attributes\Models\Entity;
use Carbon\Carbon;
use Cache;

class Suspension extends Entity {

	/**
	 * {@inheritDoc}
	 */
	protected $table = 'ecl_suspensions';

	/**
	 * {@inheritDoc}
	 */
	protected $dates = [
		'created_at',
		'updated_at',
		'start_at',
		'end_at',
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
		'cancelled',
		'duration',
		'start_date',
		'end_date',
		'start_when',
		'end_when',
		'is_past',
		'last_updated',
		'last_updated_when',
	];

	/**
	 * {@inheritDoc}
	 */
	protected $eavNamespace = 'kitbs/echineselearning.suspension';

	/**
	 * {@inheritDoc}
	 */
	public static function boot()
    {
        parent::boot();

        Suspension::saving(function($suspension) {
        	Cache::forget('zhongwenkebiao');
        });

    }

	public function getNameAttribute()
	{
		if ($this->exists) return $this->start_at->format('d M Y') . ' &ndash; ' . $this->end_at->format('d M Y');
	}

	public function getStartDateAttribute($value)
	{
		if ($this->exists) return $this->start_at->format('d M Y');
	}

	public function getEndDateAttribute()
	{
		if ($this->exists) return $this->end_at->format('d M Y');
	}

	public function getStartWhenAttribute()
	{
		if ($this->exists) return $this->start_at->diffForHumans();
	}

	public function getEndWhenAttribute()
	{
		if ($this->exists) return $this->end_at->diffForHumans();
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
		if ($this->exists) return $this->start_at < new Carbon ? ( $this->end_at < new Carbon ? 'past' : 'current') : 'future';
	}

	public function getDurationAttribute()
	{
		if ($this->exists) {
			$days = $this->start_at->diffInDays($this->end_at);
			return $days . ' day'. ($days == 1 ? '' : 's');
		}
	}

	public function getUidAttribute()
	{
		return md5(implode('',$this->attributes)).'@kitbs.com';
	}

	public function getSummaryAttribute()
	{
		return '中文课休学' . ($this->desc ? '：' . $this->desc : '');
	}

	public function getDescriptionAttribute()
	{
		return $this->summary;
	}

}
