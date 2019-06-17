<?php
/**
 * Model genrated using LaraAdmin
 * Help: http://laraadmin.com
 */

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Expert_Answer extends Model
{
    use SoftDeletes;
	
	protected $table = 'expert_answers';
	
	protected $hidden = [
        
    ];

	protected $guarded = [];

	protected $dates = ['deleted_at'];

	public function question() {
	  return $this->belongsTo('App\Models\Patient_Question', 'question_id');
	}
}
