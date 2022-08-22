<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

/**
 * @property string $accnum
 * @property string $firstname
 * @property string $lastname
 * @property string $natid
 * @property string $gender
 * @property string $address
 * @property Date   $dob
 * @property int    $type
 * @property int    $created_at
 * @property int    $updated_at
 * @property int    $created_at
 * @property int    $updated_at
 * @property float  $balance
 */
class Accounts extends Model
{
    /**
     * The database table used by the model.
     *
     * @var string
     */
    protected $table = 'accounts';

    /**
     * The primary key for the model.
     *
     * @var string
     */
    protected $primaryKey = 'id';

    /**
     * Attributes that should be mass-assignable.
     *
     * @var array
     */
    protected $fillable = [
        'user_id', 'accnum', 'firstname', 'lastname', 'natid', 'gender', 'dob', 'address', 'type', 'balance', 'created_at', 'updated_at', 'user_id', 'balance', 'created_at', 'updated_at'
    ];

    /**
     * The attributes excluded from the model's JSON form.
     *
     * @var array
     */
    protected $hidden = [
        
    ];

    /**
     * The attributes that should be casted to native types.
     *
     * @var array
     */
    protected $casts = [
        'accnum' => 'string', 'firstname' => 'string', 'lastname' => 'string', 'natid' => 'string', 'gender' => 'string', 'dob' => 'date', 'address' => 'string', 'type' => 'int', 'created_at' => 'timestamp', 'updated_at' => 'timestamp', 'balance' => 'double', 'created_at' => 'timestamp', 'updated_at' => 'timestamp'
    ];

    /**
     * The attributes that should be mutated to dates.
     *
     * @var array
     */
    protected $dates = [
        'dob', 'created_at', 'updated_at', 'created_at', 'updated_at'
    ];

    /**
     * Indicates if the model should be timestamped.
     *
     * @var boolean
     */
    public $timestamps = true;

    // Scopes...

    // Functions ...

    // Relations ...
}
