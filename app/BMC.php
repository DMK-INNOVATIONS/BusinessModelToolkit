<?php namespace App;

use Illuminate\Database\Eloquent\Model;

class BMC extends Model {

	/**
	 * The database table used by the model.
	 *
	 * @var string
	 */
	protected $table = 'bmcs';

	/**
	 * The attributes that are mass assignable.
	 *
	 * @var array
	 */
	protected $fillable = ['title', 'status', 'version', 'project'];
	
	/**
	 * The One To Many relationship BMC - Project.
	 * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
	 */
	public function project()
	{
		return $this->belongsTo('App\Project');
	}
	
	/**
	 * The One To Many relationship BMC - Notice.
	 * @return \Illuminate\Database\Eloquent\Relations\HasMany
	 */
	public function notices()
	{
		return $this->hasMany('App\Notice');
	}
	
	/**
	 * The Many To Many relationship BMC - Persona.
	 * @return \Illuminate\Database\Eloquent\Relations\BelongsToMany
	 */
	public function personas()
	{
		return $this->belongsToMany('App\Persona', 'bmc_personas', 'bmc_id', 'persona_id');
	}
}
