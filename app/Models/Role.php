<?php

namespace App\Models;


/**
 * App\Models\Role
 *
 * @SWG\Definition (
 *      definition="Role",
 *      required={},
 *      @SWG\Property(
 *          property="id",
 *          description="id",
 *          type="integer",
 *          format="int32"
 *      ),
 *      @SWG\Property(
 *          property="title",
 *          description="title",
 *          type="string"
 *      ),
 *      @SWG\Property(
 *          property="description",
 *          description="description",
 *          type="string"
 *      ),
 *      @SWG\Property(
 *          property="name",
 *          description="name",
 *          type="string"
 *      )
 * )
 * @property integer $id
 * @property string $title
 * @property string $description
 * @property string $name
 * @property \Carbon\Carbon $created_at
 * @property \Carbon\Carbon $updated_at
 * @property-read \Illuminate\Database\Eloquent\Collection|\Silber\Bouncer\Database\Ability[] $abilities
 * @property-read \Illuminate\Database\Eloquent\Collection|\App\Models\User[] $users
 * @method static \Illuminate\Database\Query\Builder|\App\Models\Role whereId( $value )
 * @method static \Illuminate\Database\Query\Builder|\App\Models\Role whereTitle( $value )
 * @method static \Illuminate\Database\Query\Builder|\App\Models\Role whereDescription( $value )
 * @method static \Illuminate\Database\Query\Builder|\App\Models\Role whereName( $value )
 * @method static \Illuminate\Database\Query\Builder|\App\Models\Role whereCreatedAt( $value )
 * @method static \Illuminate\Database\Query\Builder|\App\Models\Role whereUpdatedAt( $value )
 * @method static \Illuminate\Database\Query\Builder|\Silber\Bouncer\Database\Role whereCan( $ability, $model = null )
 * @mixin \Eloquent
 */
class Role extends \Silber\Bouncer\Database\Role
{

    const CREATED_AT = 'created_at';
    const UPDATED_AT = 'updated_at';
    /**
     * Validation rules
     *
     * @var array
     */
    public static $rules = [
        'title' => 'required',
        'name' => 'required',
        'description' => 'required',
    ];
    public $table = 'roles';
    public $guarded = [];
    /**
     * The attributes that should be casted to native types.
     *
     * @var array
     */
    protected $casts = [
        'id' => 'integer',
        'title' => 'string',
        'description' => 'string',
        'name' => 'string',
    ];
}
