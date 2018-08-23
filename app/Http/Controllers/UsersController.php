<?php
/**
 * Created by PhpStorm.
 * User: Diego
 * Date: 07-11-2015
 * Time: 16:11
 */

namespace App\Http\Controllers;


class UsersController extends  Controller
{
    public function getIndex(){
        $result = \DB::table('users')
            ->select(['name','email'])
            ->get();
        dd($result);
        return $result;
    }
}