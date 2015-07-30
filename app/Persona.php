<?php namespace App;

use Illuminate\Database\Eloquent\Model;

class Persona extends Model {

	/**
	 * The database table used by the model.
	 *
	 * @var string
	 */
	protected $table = 'personas';

	/**
	 * The attributes that are mass assignable.
	 *
	 * @var array
	 */
	protected $fillable = ['name', 'avatarImg', 'skills', 'needs'];
	
	/**
	 * The Many To Many relationship BMC - Persona.
	 * @return \Illuminate\Database\Eloquent\Relations\BelongsToMany
	 */
	public function bmcs()
	{
		return $this->belongsToMany('App\BMC', 'bmc_personas');
	}
}
