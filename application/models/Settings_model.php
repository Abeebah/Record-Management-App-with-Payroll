<?php
include "Global_model.php";

class Settings_model extends Global_model{

    public function get_settings()
    {
        
    }

    public function get_company($company_id)
    {
        $clause = sprintf('id = %s', $company_id);
        $res = $this->get_single('pk_company', 'id, name, description', $clause);
        return $res;   
    }

    public function new_company($name, $description, $company_logo, $user_id)
    {
        $data = array(
            "name" => $name,
            "description" => $description,
            "company_logo" => $company_logo,
            "created_by" => $user_id
        );

        $res = $this->insert_data('pk_company', $data);
        return $res;
    }

    public function update_company($company_id, $name, $description, $company_logo = false)
    {
        if($company_logo){
            $data = array(
                "name" => $name,
                "description" => $description,
                "company_logo" => $company_logo
            );
        }else{
            $data = array(
                "name" => $name,
                "description" => $description
            );
        }
        
        $clause = sprintf('id = %s', $company_id);
        $res = $this->update_data('pk_company', $data, $clause);
        return $res;        
    }

    public function delete_company($company_id, $action_type, $user_id)
    {
        if($action_type == 'enable'){
            $data = array("is_active" => 1,
                "deleted_by" => $user_id
            );
        }else{
            $data = array("is_active" => 0,
                "deleted_by" => $user_id
            );
        }
       
        $clause = sprintf('id = %s', $company_id);
        $res = $this->update_data('pk_company', $data, $clause);
        return $res;
    }

    public function get_category($category_id)
    {
        $clause = sprintf('id = %s', $category_id);
        $res = $this->get_single('pk_categories', 'id, name, class, description', $clause);
        return $res;   
    }

    public function new_category($name, $class, $description, $user_id)
    {
        $data = array(
            "name" => $name,
            "class" => $class,
            "description" => $description,
            "created_by" => $user_id
        );

        $res = $this->insert_data('pk_categories', $data);
        return $res;
    }

    public function update_category($category_id, $name, $class, $description){
        $data = array(
            "name" => $name,
            "class" => $class,
            "description" => $description
        );
        
        $clause = sprintf('id = %s', $category_id);
        $res = $this->update_data('pk_categories', $data, $clause);
        return $res;
    }

    public function delete_category($category_id, $action_type, $user_id)
    {
        if($action_type == 'enable'){
            $data = array("is_active" => 1,
                "deleted_by" => $user_id
            );
        }else{
            $data = array("is_active" => 0,
                "deleted_by" => $user_id
            );
        }
        $clause = sprintf('id = %s', $category_id);
        $res = $this->update_data('pk_categories', $data, $clause);
        return $res;
    }

    public function create_users($firstname, $lastname, $address, $username, $position, $role, $company, $salary, $gender, $email, $phone, $profile_pic, $password)
    {
        $data = array(
            "first_name"    => $firstname,
            "last_name"     => $lastname,
            "email"         => $email,
            "username"      => $username,
            "position"      => $position,
            "password"      => $password,
            "company_id"    => $company,
            "phone"         => $phone,
            "address"       => $address,
            "salary"        => $salary,
            "gender"        => $gender,
            "role"          => $role,
            "avatar"        => $profile_pic
        );
        
        $res = $this->insert_data('pk_users', $data);
        return $res;
    }

    public function update_users($user_id, $firstname, $lastname, $address, $position, $role, $company, $salary, $gender, $phone, $profile_pic = false)
    {
        if($profile_pic){
            $data = array(
                "first_name"    => $firstname,
                "last_name"     => $lastname,
                "company_id"    => $company,
                "phone"         => $phone,
                "address"       => $address,
                "position"       => $position,
                "salary"        => $salary,
                "gender"        => $gender,
                "role"          => $role,
                "avatar"        => $profile_pic
            );            
        }else{
            $data = array(
                "first_name"    => $firstname,
                "last_name"     => $lastname,
                "company_id"    => $company,
                "phone"         => $phone,
                "address"       => $address,
                "position"       => $position,
                "salary"        => $salary,
                "gender"        => $gender,
                "role"          => $role
            );            
        }

        $clause = sprintf('id = %s', $user_id);
        $res = $this->update_data('pk_users', $data, $clause);
        return $res;
    }

    public function reset_password($password, $user_id){
        $data = array( "password" => $password );
        $clause = sprintf('id = %s', $user_id);
        $res = $this->update_data('pk_users', $data, $clause);
        return $res;
    }

    public function suspend_user($user_id)
    {
        $data = array( "is_active" => 0 );
        $clause = sprintf('id = %s', $user_id);
        $res = $this->update_data('pk_users', $data, $clause);
        return $res;
    }

    public function activate_user($user_id)
    {
        $data = array( "is_active" => 1 );
        $clause = sprintf('id = %s', $user_id);
        $res = $this->update_data('pk_users', $data, $clause);
        return $res;
    }
}
?>