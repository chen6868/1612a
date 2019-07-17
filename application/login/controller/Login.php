<?php
namespace app\login\controller;

use think\Controller;

class Login extends Controller
{
    public function index() {
        return view();
    }

    public function user() {
        $user = input('post.username');
        $pass = input('post.pass');

        return 'found';
    }


}
