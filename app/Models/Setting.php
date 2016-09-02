<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

/**
 * App\Models\Setting
 *
 * @property integer $id
 * @property string $name
 * @property string $value
 * @property \Carbon\Carbon $created_at
 * @property \Carbon\Carbon $updated_at
 * @method static \Illuminate\Database\Query\Builder|\App\Models\Setting whereId( $value )
 * @method static \Illuminate\Database\Query\Builder|\App\Models\Setting whereName( $value )
 * @method static \Illuminate\Database\Query\Builder|\App\Models\Setting whereValue( $value )
 * @method static \Illuminate\Database\Query\Builder|\App\Models\Setting whereCreatedAt( $value )
 * @method static \Illuminate\Database\Query\Builder|\App\Models\Setting whereUpdatedAt( $value )
 * @mixin \Eloquent
 */
class Setting extends Model
{
    protected $guarded = [];
}
