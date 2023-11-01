<?php

declare (strict_types=1);
namespace App\Admin\Model;

/**
 * @property int $id 
 * @property int $role_id 
 * @property int $res_id 
 * @property string $match_rule 
 */
class RbacAccess extends Model
{
    /**
     * The table associated with the model.
     *
     * @var string
     */
    protected $table = 'admin_rbac_access';
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
    protected $casts = ['id' => 'integer', 'role_id' => 'integer', 'res_id' => 'integer'];
}