<?php

namespace App\Http\Queries;

use Illuminate\Database\Eloquent\Builder;

trait UsersScopes
{
    public function scopeSearch(Builder $query, ?string $args): Builder
    {
        if ($args) {
            return $query->where('name', 'like', "%{$args}%")
                ->orWhere('email', 'like', "%{$args}%")
                ->orWhere('id', 'like', "%{$args}%")
                ->orWhere('role', 'like', "%{$args}%");
        }
        return $query;
    }

    public function scopeLimitBy(Builder $query, int $start, int $length): Builder
    {
        if($length != -1)
        {
            return $query->offset($start)->limit($length);
        }
        return $query;
    }

    public function scopeOrder(Builder $query, array $order): Builder
    {
        if ($order) {
            $columns = ['actions', 'id', 'name', 'email', 'role'];
            return $query->orderBy($columns[$order[0]['column']], $order[0]['dir']);
        }
        return $query;
    }
}
