<?php
/**
 * Created by PhpStorm.
 * User: Luis
 * Date: 16/08/2017
 * Time: 05:04 PM
 */

namespace App\GraphQL\Query;

use GraphQL;
use GraphQL\Type\Definition\Type;
use Rebing\GraphQL\Support\Query;
use App\models\User;

class UsersQuery extends Query {

    protected $attributes = [
        'name' => 'Users query'
    ];

    public function type()
    {
        return Type::listOf(GraphQL::type('user'));
    }

    public function args()
    {
        return [
            'id' => ['name' => 'id', 'type' => Type::INT()],
            'email' => ['name' => 'email', 'type' => Type::string()]
        ];
    }

    public function resolve($root, $args)
    {
        if(isset($args['id']))
        {
            return User::where('id' , $args['id'])->get();
        }
        else if(isset($args['email']))
        {
            return User::where('email', $args['email'])->get();
        }
        else
        {
            return User::all();
        }
    }

}