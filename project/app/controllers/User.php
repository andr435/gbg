<?php

/**
 * User controller
 */
class User extends Controller
{
    protected $user_model;

    public function __construct(){
        $this->user_model = $this->model('ModelUser');
    }

    public function index(){
        $this->view('user/add_user');
    }

    public function showAllUsers(){
        $data = $this->user_model->getAllUsers();
        $this->view('user/all_user',$data);
    }

}