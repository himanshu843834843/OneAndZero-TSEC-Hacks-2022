<?php

namespace App\Models;

use App\Features\Masters\Constants\UsersConstants;
use App\Features\Masters\Http\v1\Helpers\Utils;
use App\Http\Queries\UsersScopes;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Illuminate\Support\Facades\DB;
use Laravel\Sanctum\HasApiTokens;

class User extends Authenticatable
{
    use HasApiTokens, HasFactory, Notifiable, UsersScopes;

    /**
     * The attributes that are mass assignable.
     *
     * @var array<int, string>
     */
    protected $fillable = [
        'name',
        'email',
        'password',
        'role'
    ];

    public function isAdmin(){
        if($this->role == "admin")
            return true;
        return false;
    }

    public function makeAdmin(){
        return DB::transaction(function () {
            return $this->update(['role' => 'admin']);
        });
    }

    public function revokeAdmin(){
        return DB::transaction(function () {
            return $this->update(['role' => 'member']);
        });
    }

    public function destroyUser(){
        return DB::transaction(function () {
            return $this->forceDelete();
        });
    }

    public static function updateUser(User $user, array $updateData)
    {
        $array = UsersConstants::UPDATE_RULES;
        $array['name'] = 'unique:users,name,'.$user->id;
        Utils::validateOrThrow($array, $updateData);
        DB::transaction(function () use($user, $updateData) {
            $user->update($updateData);
        });
    }

    /**
     * The attributes that should be hidden for serialization.
     *
     * @var array<int, string>
     */
    protected $hidden = [
        'password',
        'remember_token',
    ];

    /**
     * The attributes that should be cast.
     *
     * @var array<string, string>
     */
    protected $casts = [
        'email_verified_at' => 'datetime',
    ];
}
