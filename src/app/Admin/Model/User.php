<?php

declare (strict_types=1);
namespace App\Admin\Model;

/**
 * @property int $id 
 * @property string $username 
 * @property string $password 
 * @property int $parentid 
 * @property string $email 
 * @property string $activate 
 * @property int $status 
 * @property string $login_ip 
 * @property int $last_error_time 
 * @property int $login_error_num 
 * @property int $google_auth 
 * @property string $google_secret_key 
 * @property string $session_random 
 * @property int $last_login_time 
 * @property \Carbon\Carbon $created_at 
 * @property \Carbon\Carbon $updated_at 
 */
class User extends Model
{
    /**
     * The table associated with the model.
     *
     * @var string
     */
    protected $table = 'user';
    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [];
    /**
     * The attributes that should be cast to native types.
     *
     * @var array
     */
    protected $casts = ['id' => 'integer', 'parentid' => 'integer', 'status' => 'integer', 'last_error_time' => 'integer', 'login_error_num' => 'integer', 'google_auth' => 'integer', 'last_login_time' => 'integer', 'created_at' => 'datetime', 'updated_at' => 'datetime'];
}