<?php namespace App;

use Illuminate\Database\Eloquent\Model;

class Notice extends Model {

	/**
	 * The database table used by the model.
	 *
	 * @var string
	 */
	protected $table = 'notices';

	/**
	 * The attributes that are mass assignable.
	 *
	 * @var array
	 */
	protected $fillable = ['text', 'status', 'sort', 'canvas_box', 'bmc'];
	
	/**
	 * The One To Many relationship CanvasBox - Notice.
	 * @return \Illuminate\Database\Eloquent\Relations\HasMany
	 */
	public function canvasBox()
	{
		return $this->hasMany('App\CanvasBox');
	}
	
	/**
	 * The One To Many relationship BMC - Notice.
	 * @return \Illuminate\Database\Eloquent\Relations\HasMany
	 */
	public function bmc()
	{
		return $this->hasMany('App\BMC');
	}
}
