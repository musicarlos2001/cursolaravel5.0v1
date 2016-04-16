<?php
/**
 * Created by PhpStorm.
 * User: Carlos
 * Date: 02/04/2016
 * Time: 12:22
 */

//$faker->addProvider(new Faker\Provider\pt_BR\Person($faker));

    $factory->define('CodeCommerce\User', function($faker){

        return [
            'name'=>$faker->name,
            'email'=>$faker->email,
            'password'=> str_random(10),
            'remember_token'=> str_random(10),

        ];


    });