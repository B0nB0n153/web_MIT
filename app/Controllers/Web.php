<?php

namespace App\Controllers;

class Web extends BaseController
{
    public function index()
    {
        $data = [
            'title' => 'Home'
        ];
        return view('web/home', $data);
    }

    // public function post()
    // {
    //     $data = [
    //         'title' => 'Post'
    //     ];
    //     return view('admin/post', $data);
    // }

    // // public function order()
    // // {
    // //     echo view('admin/layout/header');
    // //     echo view('admin/order');
    // //     echo view('admin/layout/footer');
    // // }

    // public function user()
    // {
    //     $data = [
    //         'title' => 'User'
    //     ];
    //     return view('admin/user', $data);
    // }
}
