<?php namespace App;

use Illuminate\Database\Eloquent\Model;

class Project extends Model {

	/**
	 * The database table used by the model.
	 *
	 * @var string
	 */
	protected $table = 'projects';

	/**
	 * The attributes that are mass assignable.
	 *
	 * @var array
	 */
	protected $fillable = ['title', 'assignee'];
	
	/**
	 * The One To Many relationship BMC - Project.
	 * @return \Illuminate\Database\Eloquent\Relations\HasMany
	 */
	public function bmcs()
	{
		return $this->hasMany('App\BMC');
	}
	
	/**
	 * The One To Many relationship Project - User.
	 * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
	 */
	public function assignee()
	{
		return $this->belongsTo('App\User');
	}
	
	/**
	 * The Many To Many relationship Project - User.
	 * @return \Illuminate\Database\Eloquent\Relations\BelongsToMany
	 */
	public function members()
	{
		return $this->belongsToMany('App\User', 'project_members', 'project_id', 'user_id');
	}

	/**
	 * The "booting" method of the model.
	 *
	 * @return void
	 */
	protected static function boot() {
		parent::boot();
	
		// this is called before deleting the project
		static::deleting(function($project) {
			$project->bmcs()->delete();
		});
	}
}
