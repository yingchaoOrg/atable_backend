<?php

namespace App\Admin\Model;

/**
 * @property int $id 
 * @property string $icon 
 * @property string $menu_name 
 * @property string $title 
 * @property string $tags 
 * @property int $pid 
 * @property int $is_menu 
 * @property int $is_race_menu 
 * @property int $type 
 * @property int $status 
 * @property string $condition 
 * @property \Carbon\Carbon $created_at 
 * @property \Carbon\Carbon $updated_at 
 */
class RbacResource extends Model
{
    /**
     * The table associated with the model.
     *
     * @var string
     */
    protected $table = 'admin_rbac_resource';
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
    protected $casts = ['id' => 'integer', 'pid' => 'integer', 'is_menu' => 'integer', 'is_race_menu' => 'integer', 'type' => 'integer', 'status' => 'integer', 'created_at' => 'datetime', 'updated_at' => 'datetime'];
}