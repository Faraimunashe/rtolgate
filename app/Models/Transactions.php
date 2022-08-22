<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

/**
 * @property string $reference
 * @property string $method
 * @property string $purpose
 * @property string $status
 * @property string $reference
 * @property string $method
 * @property string $purpose
 * @property string $status
 * @property string $action
 * @property string $status
 * @property string $reference
 * @property string $reference
 * @property string $action
 * @property string $status
 * @property int    $created_at
 * @property int    $updated_at
 * @property int    $created_at
 * @property int    $updated_at
 * @property int    $created_at
 * @property int    $updated_at
 * @property int    $created_at
 * @property int    $updated_at
 * @property float  $balance
 */
class Transactions extends Model
{
    /**
     * The database table used by the model.
     *
     * @var string
     */
    protected $table = 'transactions';

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
        'user_id', 'reference', 'method', 'purpose', 'amount', 'status', 'created_at', 'updated_at', 'user_id', 'reference', 'method', 'purpose', 'amount', 'status', 'created_at', 'updated_at', 'action', 'user_id', 'receiver_user_id', 'sender_user_id', 'status', 'begin_balance', 'amount', 'end_balance', 'reference', 'created_at', 'updated_at', 'user_id', 'reference', 'action', 'amount', 'status', 'balance', 'created_at', 'updated_at'
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
        'reference' => 'string', 'method' => 'string', 'purpose' => 'string', 'status' => 'string', 'created_at' => 'timestamp', 'updated_at' => 'timestamp', 'reference' => 'string', 'method' => 'string', 'purpose' => 'string', 'status' => 'string', 'created_at' => 'timestamp', 'updated_at' => 'timestamp', 'action' => 'string', 'status' => 'string', 'reference' => 'string', 'created_at' => 'timestamp', 'updated_at' => 'timestamp', 'reference' => 'string', 'action' => 'string', 'status' => 'string', 'balance' => 'double', 'created_at' => 'timestamp', 'updated_at' => 'timestamp'
    ];

    /**
     * The attributes that should be mutated to dates.
     *
     * @var array
     */
    protected $dates = [
        'created_at', 'updated_at', 'created_at', 'updated_at', 'created_at', 'updated_at', 'created_at', 'updated_at'
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
