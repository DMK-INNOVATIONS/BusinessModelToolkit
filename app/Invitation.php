<?php namespace App;

use Illuminate\Database\Eloquent\Model;

class Invitation extends Model {

	/**
	 * The database table used by the model.
	 *
	 * @var string
	 */
	protected $table = 'invitations';

	/**
	 * The attributes that are mass assignable.
	 *
	 * @var array
	 */
	protected $fillable = ['inviter_id', 'project_id', 'invitee_email'];
	
	/**
	 * The One To Many relationship 
	 * @return \Illuminate\Database\Eloquent\Relations\HasMany
	 */
	
	
	/**
	 * The One To Many relationship 
	 * @return \Illuminate\Database\Eloquent\Relations\HasMany
	 */
	
}
