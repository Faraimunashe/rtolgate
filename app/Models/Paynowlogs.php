<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

/**
 * @property string $reference
 * @property string $paynow_reference
 * @property string $status
 * @property string $poll_url
 * @property string $hash
 * @property string $reference
 * @property string $paynow_reference
 * @property string $status
 * @property string $poll_url
 * @property string $hash
 * @property string $reference
 * @property string $paynow_reference
 * @property string $status
 * @property string $poll_url
 * @property string $hash
 * @property string $reference
 * @property string $paynow_reference
 * @property string $status
 * @property string $poll_url
 * @property string $hash
 * @property int    $created_at
 * @property int    $updated_at
 * @property int    $created_at
 * @property int    $updated_at
 * @property int    $created_at
 * @property int    $updated_at
 * @property int    $created_at
 * @property int    $updated_at
 */
class Paynowlogs extends Model
{
    /**
     * The database table used by the model.
     *
     * @var string
     */
    protected $table = 'paynowlogs';

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
        'reference', 'paynow_reference', 'status', 'amount', 'poll_url', 'hash', 'created_at', 'updated_at', 'reference', 'paynow_reference', 'status', 'amount', 'poll_url', 'hash', 'created_at', 'updated_at', 'reference', 'paynow_reference', 'status', 'amount', 'poll_url', 'hash', 'created_at', 'updated_at', 'reference', 'paynow_reference', 'status', 'amount', 'poll_url', 'hash', 'created_at', 'updated_at'
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
        'reference' => 'string', 'paynow_reference' => 'string', 'status' => 'string', 'poll_url' => 'string', 'hash' => 'string', 'created_at' => 'timestamp', 'updated_at' => 'timestamp', 'reference' => 'string', 'paynow_reference' => 'string', 'status' => 'string', 'poll_url' => 'string', 'hash' => 'string', 'created_at' => 'timestamp', 'updated_at' => 'timestamp', 'reference' => 'string', 'paynow_reference' => 'string', 'status' => 'string', 'poll_url' => 'string', 'hash' => 'string', 'created_at' => 'timestamp', 'updated_at' => 'timestamp', 'reference' => 'string', 'paynow_reference' => 'string', 'status' => 'string', 'poll_url' => 'string', 'hash' => 'string', 'created_at' => 'timestamp', 'updated_at' => 'timestamp'
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
