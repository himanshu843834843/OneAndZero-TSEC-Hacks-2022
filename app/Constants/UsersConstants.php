<?php
namespace App\Features\Masters\Constants;

interface UsersConstants
{
    const UPDATE_RULES = [
        'name'=> 'required|max:255',
        'email'=> [
            'required'
        ],
    ];
}
