<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Global_controller extends CI_Controller {

    public $user_id;
    public $firstname;
    public $lastname;
    public $username;
    public $position;
    public $email;
    public $phone;
    public $address;
    public $role;
    public $company;
    public $salary;
    public $gender;
    public $avatar;

    public function __construct()
    {
        parent::__construct();
        $this->load->database();
        session_start();

        // $this->load->model('global_model');
        if(isset($_SESSION['user_id']) && isset($_SESSION['email'])){
            self::initialize_user();
        }        
    }

    public function initialize_user()
    {
        $user_id = $_SESSION['user_id'];
        
        $sql = sprintf("SELECT pk_users.id, pk_users.first_name, pk_users.last_name, pk_users.username, pk_users.position, pk_users.gender, pk_users.phone, pk_users.address, pk_users.salary, pk_roles.name as role, pk_users.email, pk_users.created_at, pk_users.is_active, pk_company.name as company, pk_users.avatar from pk_users, pk_company, pk_roles where pk_users.company_id = pk_company.id and pk_roles.id = pk_users.role and pk_users.id = %s", $user_id);
        $res = self::custom_query($sql);
        
        $this->user_id      = $res[0]['id'];
        $this->firstname    = $res[0]['first_name'];
        $this->lastname     = $res[0]['last_name'];
        $this->username     = $res[0]['username'];
        $this->position     = $res[0]['position'];
        $this->email        = $res[0]['email'];
        $this->phone        = $res[0]['phone'];
        $this->address      = $res[0]['address'];
        $this->role         = $res[0]['role'];
        $this->company      = $res[0]['company'];
        $this->salary       = $res[0]['salary'];
        $this->gender       = $res[0]['gender'];
        $this->avatar       = $res[0]['avatar'];
    }

    public function isLoggedin()
    {
        if(isset($_SESSION['user_id']) && isset($_SESSION['email'])){
            return true;
        }else{
            return false;
        }
    }

    public function display_view($content){
        $res = array(
            "content" => $content
        );
        echo json_encode($res);
    }

    public function random_password($length = 10)
    {
        $characters = '0123456789abcdefghijklmnopqrstuvwxyzABCDEFGHIJKLMNOPQRSTUVWXYZ';
        $charactersLength = strlen($characters);
        $rand_password = '';
        for ($i = 0; $i < $length; $i++) {
            $rand_password .= $characters[rand(0, $charactersLength - 1)];
        }
        return $rand_password;
    }

    public function custom_query($query)
    {
        $res = $this->db->query($query);
        return $res->result_array();
    }

    public function get_single($table, $col, $where)
    {
        $this->db->select($col);
        $this->db->where($where);        
        $query = $this->db->get($table);
        if($query){
            return $query->result_array();
        }else{
            return false;
        }
    }
}
?>