<?php

declare (strict_types=1);
namespace App\Admin\Model;

/**
 * @property int $id 
 * @property string $username 
 * @property string $password 
 * @property int $groupid 
 * @property int $createtime 
 * @property string $google_secret_key 
 * @property string $mobile 
 * @property string $session_random 
 */
class Admin extends Model
{

    /**
     * The table associated with the model.
     *
     * @var string
     */
    protected $table = 'admin_user';
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
    protected $casts = ['id' => 'integer', 'groupid' => 'integer', 'createtime' => 'integer'];
}