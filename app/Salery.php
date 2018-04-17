<?php
namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

/**
 * Class Salery
 *
 * @package App
 * @property string $user
 * @property string $base_salery
 * @property string $month
 * @property string $due
 * @property string $bonus
*/
class Salery extends Model
{
    use SoftDeletes;

    protected $fillable = ['base_salery', 'month', 'due', 'bonus', 'user_id'];
    protected $hidden = [];
    
    

    /**
     * Set to null if empty
     * @param $input
     */
    public function setUserIdAttribute($input)
    {
        $this->attributes['user_id'] = $input ? $input : null;
    }
    
    public function user()
    {
        return $this->belongsTo(User::class, 'user_id');
    }
    
}
