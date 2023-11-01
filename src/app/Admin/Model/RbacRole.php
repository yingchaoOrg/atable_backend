<?php

declare (strict_types=1);
namespace App\Admin\Model;

/**
 * @property int $id 
 * @property string $name 
 * @property string $title 
 * @property int $status 
 * @property int $is_manager 
 * @property string $rules 
 */
class RbacRole extends Model
{
    /**
     * The table associated with the model.
     *
     * @var string
     */
    protected $table = 'admin_rbac_role';
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
    protected $casts = ['id' => 'integer', 'status' => 'integer', 'is_manager' => 'integer'];
}