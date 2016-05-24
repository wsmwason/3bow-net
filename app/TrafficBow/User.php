<?php

namespace TrafficBow;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Auth\Authenticatable;
use Illuminate\Contracts\Auth\Authenticatable as AuthenticatableContract;

/**
 * TrafficBow\User
 *
 * @mixin \Eloquent
 * @property integer $id
 * @property string $name
 * @property string $email
 * @property string $password
 * @property string $provider
 * @property string $provider_user_id
 * @property string $remember_token
 * @property boolean $is_admin
 * @property string $deleted_at
 * @property \Carbon\Carbon $created_at
 * @property \Carbon\Carbon $updated_at
 * @method static \Illuminate\Database\Query\Builder|\TrafficBow\User whereId($value)
 * @method static \Illuminate\Database\Query\Builder|\TrafficBow\User whereName($value)
 * @method static \Illuminate\Database\Query\Builder|\TrafficBow\User whereEmail($value)
 * @method static \Illuminate\Database\Query\Builder|\TrafficBow\User wherePassword($value)
 * @method static \Illuminate\Database\Query\Builder|\TrafficBow\User whereProvider($value)
 * @method static \Illuminate\Database\Query\Builder|\TrafficBow\User whereProviderUserId($value)
 * @method static \Illuminate\Database\Query\Builder|\TrafficBow\User whereRememberToken($value)
 * @method static \Illuminate\Database\Query\Builder|\TrafficBow\User whereIsAdmin($value)
 * @method static \Illuminate\Database\Query\Builder|\TrafficBow\User whereDeletedAt($value)
 * @method static \Illuminate\Database\Query\Builder|\TrafficBow\User whereCreatedAt($value)
 * @method static \Illuminate\Database\Query\Builder|\TrafficBow\User whereUpdatedAt($value)
 */
class User extends Model implements AuthenticatableContract
{

    use Authenticatable;

    protected $fillable = ['name', 'email', 'password', 'provider', 'provider_user_id'];

}
