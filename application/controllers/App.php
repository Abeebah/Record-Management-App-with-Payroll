<?php
defined('BASEPATH') OR exit('No direct script access allowed');
include "Global_controller.php";

class App extends Global_controller {

    public function __construct()
    {
        parent::__construct();
        $this->load->model('app_model');
        // $this->load->model('records_model');
    }

    public function index(){
        $data['title'] = 'Parkers app';
        $data['avatar'] = $this->avatar;
        $data['firstname'] = $this->firstname;
        $data['role'] = $this->role;

        $this->load->view('shared/header', $data);
        $this->load->view('app/index');
        $this->load->view('shared/footer');
    }

    public function login(){
        
        $this->load->library('form_validation');

        $this->form_validation->set_rules('username', 'Username', 'required');
        $this->form_validation->set_rules('password', 'Password', 'required');

        $message = '';
        if($this->form_validation->run()){
            $username = $this->input->post('username');
            $password = $this->input->post('password');

            $res = $this->app_model->authenticate_user($username, $password);
            if($res){
                $message = $res;
            }
            $data['message'] = $message;
            $this->load->helper('form');
		    $this->load->view('app/login', $data);
        }else{
            $data['message'] = $message;
            $this->load->helper('form');
		    $this->load->view('app/login', $data);
        }
    }

    public function signout()
    {
        $_SESSION['user_id']    = '';
        $_SESSION['email']      = '';
        $_SESSION['username']   = '';
        $_SESSION['role']       = '';

        session_destroy();
        echo json_encode(array("status" => "success"));
    }

    public function change_password()
    {
        $current_password = $this->input->post('current_password');
        $new_password = $this->input->post('new_password');

        $password = $this->app_model->current_password($this->user_id);
        if(password_verify($current_password, $password['password'])){
            $res = $this->app_model->change_password(password_hash($new_password, PASSWORD_DEFAULT), $this->user_id);
            if($res){
                echo json_encode(array("status" => "success", "message" => "Password changed successfully."));
            }else{
                echo json_encode(array("status" => "failed", "message" => "Something went wrong. please try again."));
            }
        }else{
            $_SESSION['user_id']    = '';
            $_SESSION['email']      = '';
            $_SESSION['username']   = '';
            $_SESSION['role']       = '';
    
            session_destroy();
            echo json_encode(array("status" => "failed", "message" => ""));
        }
    }

    public function dashboard()
    {
        $company_list   = $this->app_model->get_companies();
        $content = '<div class = "row">
                <div class = "col-12">
                    <div class = "row p-5">';
                    foreach($company_list as $company){
                        $content .= '<div class = "col-3 countrydiv m-3">
                            <a href = "#" id = "dashboard-item" style = "text-decoration: none" company_id = '.$company['id'].'>
                                <div class = "">
                                    <div class = "row">
                                        <div class = "col-12 ">
                                            <img src = "'.base_url().'uploads/'.$company['company_logo'].'" class = "img img-fluid">
                                        </div>
                                    </div>
                                    <div class = "row">
                                        <div class = "col-12">
                                            <h3>'.$company['name'].'<h3>
                                        </div>                            
                                    </div>                            
                                </div>                            
                        </a></div>';
                    }

        $content .= '</div>
                </div>
            </div>';
        echo $this->display_view($content);
    }
}
?>