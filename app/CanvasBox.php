<?php namespace App;

use Illuminate\Database\Eloquent\Model;

class CanvasBox extends Model {

	/**
	 * The database table used by the model.
	 *
	 * @var string
	 */
	protected $table = 'canvas_boxes';

	/**
	 * The attributes that are mass assignable.
	 *
	 * @var array
	 */
	protected $fillable = ['title'];
	
	/**
	 * The One To Many relationship CanvasBox - Notice.
	 * @return \Illuminate\Database\Eloquent\Relations\HasMany
	 */
	public function notices()
	{
		return $this->hasMany('App\Notice');
	}
}
