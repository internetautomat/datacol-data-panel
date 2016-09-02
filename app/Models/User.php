<?php namespace App\Models;

use Illuminate\Foundation\Auth\User as Authenticatable;
use Session;
use Silber\Bouncer\Database\HasRolesAndAbilities;

/*
 * @property integer $id
 * @property string $name
 * @property string $login
 * @property string $email
 * @property string $phone
 * @property string $department
 * @property string $password
 * @property boolean $active
 * @property string $remember_token
 * @property \Carbon\Carbon $created_at
 * @property \Carbon\Carbon $updated_at
 * @property-read \Illuminate\Database\Eloquent\Collection|\Silber\Bouncer\Database\Role[] $roles
 * @property-read \Illuminate\Database\Eloquent\Collection|\Silber\Bouncer\Database\Ability[] $abilities
 * @method static \Illuminate\Database\Query\Builder|\App\Models\User whereId( $value )
 * @method static \Illuminate\Database\Query\Builder|\App\Models\User whereName( $value )
 * @method static \Illuminate\Database\Query\Builder|\App\Models\User whereLogin( $value )
 * @method static \Illuminate\Database\Query\Builder|\App\Models\User whereEmail( $value )
 * @method static \Illuminate\Database\Query\Builder|\App\Models\User wherePhone( $value )
 * @method static \Illuminate\Database\Query\Builder|\App\Models\User whereDepartment( $value )
 * @method static \Illuminate\Database\Query\Builder|\App\Models\User wherePassword( $value )
 * @method static \Illuminate\Database\Query\Builder|\App\Models\User whereActive( $value )
 * @method static \Illuminate\Database\Query\Builder|\App\Models\User whereRememberToken( $value )
 * @method static \Illuminate\Database\Query\Builder|\App\Models\User whereCreatedAt( $value )
 * @method static \Illuminate\Database\Query\Builder|\App\Models\User whereUpdatedAt( $value )
 * @method static \Illuminate\Database\Query\Builder|\App\Models\User whereIs( $role )
 * @method static \Illuminate\Database\Query\Builder|\App\Models\User whereIsAll( $role )
 * @method static \Illuminate\Database\Query\Builder|\App\Models\User whereCan( $ability, $model = null )
 * @mixin \Eloquent
 */

class User extends Authenticatable
{
    use HasRolesAndAbilities;

    const CREATED_AT = 'created_at';
    const UPDATED_AT = 'updated_at';
    /**
     * Validation rules
     *
     * @var array
     */
    public static $rules = [
        'login' => 'required|min:5',
        'name' => 'required',
        'email' => 'required|email',
        //'password' => 'required|min:5',
    ];
    public $table = 'users';
    public $guarded = [];

    protected $hidden = [
        'password', 'remember_token',
    ];
    /**
     * The attributes that should be casted to native types.
     *
     * @var array
     */
    protected $casts = [
        'id' => 'integer',
        'name' => 'string',
        'login' => 'string',
        'email' => 'string',
        'password' => 'string',
        'remember_token' => 'string',
    ];


    public function setImpersonating( $id )
    {
        Session::put( 'impersonate', $id );
    }

    public function stopImpersonating()
    {
        Session::forget( 'impersonate' );
    }

    public function isImpersonating()
    {
        return Session::has( 'impersonate' );
    }


    public function gravatar( $s = '200' )
    {
        return 'http://www.gravatar.com/avatar/' . md5( $this->email ) . '?s=' . $s;
    }
}
