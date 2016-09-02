<?php

namespace App\Models;

/**
 * App\Models\Ability
 *
 * @property integer $id
 * @property string $name
 * @property string $title
 * @property string $description
 * @property integer $entity_id
 * @property string $entity_type
 * @property \Carbon\Carbon $created_at
 * @property \Carbon\Carbon $updated_at
 * @property-read \Illuminate\Database\Eloquent\Collection|\Silber\Bouncer\Database\Role[] $roles
 * @property-read \Illuminate\Database\Eloquent\Collection|\App\Models\User[] $users
 * @property-read mixed $identifier
 * @property-read mixed $slug
 * @method static \Illuminate\Database\Query\Builder|\App\Models\Ability whereId( $value )
 * @method static \Illuminate\Database\Query\Builder|\App\Models\Ability whereName( $value )
 * @method static \Illuminate\Database\Query\Builder|\App\Models\Ability whereTitle( $value )
 * @method static \Illuminate\Database\Query\Builder|\App\Models\Ability whereDescription( $value )
 * @method static \Illuminate\Database\Query\Builder|\App\Models\Ability whereEntityId( $value )
 * @method static \Illuminate\Database\Query\Builder|\App\Models\Ability whereEntityType( $value )
 * @method static \Illuminate\Database\Query\Builder|\App\Models\Ability whereCreatedAt( $value )
 * @method static \Illuminate\Database\Query\Builder|\App\Models\Ability whereUpdatedAt( $value )
 * @method static \Illuminate\Database\Query\Builder|\Silber\Bouncer\Database\Ability simpleAbility()
 * @method static \Illuminate\Database\Query\Builder|\Silber\Bouncer\Database\Ability forModel( $model, $strict = false )
 * @mixin \Eloquent
 */
class Ability extends \Silber\Bouncer\Database\Ability
{
    protected $guarded = [];
}
