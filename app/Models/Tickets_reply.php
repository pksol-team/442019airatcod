<?php
/**
 * Model genrated using LaraAdmin
 * Help: http://laraadmin.com
 */

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Tickets_reply extends Model
{
    use SoftDeletes;
	
	protected $table = 'tickets_replies';
	
	protected $hidden = [
        
    ];

	protected $guarded = [];

	protected $dates = ['deleted_at'];

	public $primaryKey = 'id';
	
	public function tickets(){
	  return $this->belongsTo('App\Models\Ticket', 'ticket_id');
	}
	
	public function users(){
	  return $this->belongsTo('App\Models\Employee', 'user_id');
	}
}
