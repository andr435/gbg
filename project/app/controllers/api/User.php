<?php

/**
 * User controller
 */
class User extends ApiController
{
    protected $user_model;

    public function __construct(){
        $this->user_model = $this->model('ModelUser');
    }

    public function get(int $id = 0){
        try{
            if($id == 0){
                // get all
                $result = $this->user_model->getAllUsers();
            } else {
                // get by id
                $result = $this->user_model->getUserById($id);
            }
        }catch(\Exception $e){
            echo $this->onError('DB Failure', 500);
            return;
        }

        if($result){
            echo $this->onSuccess($result);
        } else {
            echo $this->onError('DB Failure', 500);
            return;
        }
    }

    public function delete(int $id = 0){
        try{
            $result = $this->user_model->deleteUser($id);
        } catch(\Exception $e) {
            echo $this->onError('DB Failure', 500);
            return;
        }

        if($result){
            echo $this->onSuccess($result);
        } else {
            echo $this->onError('DB Failure', 500);
            return;
        }
    }

    public function addUser(){
        // get data
        $username = $_POST['username'] ?? '';
        $email = $_POST['email'] ?? '';
        $password = $_POST['password'] ?? '';
        $birthday = $_POST['birthday'] ?? '';
        $phone = $_POST['phone'] ?? '';
        $url = $_POST['url'] ?? '';
        
        // validate data
        if(
            !Validator::validate($username, 'alpha')
            || !Validator::validate($email, 'email')
            || !Validator::validate($password, 'password')
            || !Validator::validate($phone, 'phone')
            || !Validator::validate($birthday, 'date')
            || !Validator::validate($url, 'url')
        ){
            echo $this->onError('Incorrect data', 400);
            return;
        }

        try{
            $birthday = $this->dbDateFormat($birthday);
            $result = $this->user_model->addUser($username, $email, $password, $birthday, $phone, $url);
        }catch(\Exception $e){
            echo $this->onError('DB Failure', 500);
            return;
        }

        if($result){
            echo $this->onSuccess('Sucess');
        } else {
            echo $this->onError('DB Failure', 500);
            return;
        }
    }

    private function dbDateFormat(string $date): string{
        $matches = [];
        preg_match_all('!\d+!', $date, $matches);
        $day = (int)$matches[0][0];
        $month =(int) $matches[0][1];
        $year = (int)$matches[0][2];
        if ($year === 0) $year = 2000;

        return "$year-$month-$day";
    }

}