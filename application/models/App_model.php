<?php
include "Global_model.php";

class App_model extends Global_model{
    public function authenticate_user($username, $password)
    {
        $clause = sprintf("username = '%s'",$username);
        $res = $this->get_single('pk_users', 'id, email, username, password, role, is_active', $clause);

        if(isset($res[0]) && !empty($res[0]) && is_array($res[0])){
            if($res[0]['is_active'] == 1){
                if(password_verify($password, $res[0]['password'])){
                    session_start();
                    $_SESSION['user_id']    = $res[0]['id'];
                    $_SESSION['email']      = $res[0]['email'];
                    $_SESSION['username']   = $res[0]['username'];
                    $_SESSION['role']       = $res[0]['role'];
                    
                    redirect(site_url());
                }else{
                    return 'Username/ Password incorrect.';
                }
            }else{
                return 'Account disabled. Please contact admin.';
            }
        }else{
            return 'Username/ Password incorrect.';
        }
    }

    public function current_password($user_id)
    {
        $clause = sprintf('id = %s', $user_id);
        $res = $this->get_single('pk_users', 'password', $clause);
        
        if($res){
            return $res[0];
        }
        else{
            return false;
        }
    }

    public function change_password($password, $user_id)
    {
        $clause = sprintf('id = %s', $user_id);
        $data = array('password' => $password);
        $res = $this->update_data('pk_users', $data, $clause);

        if($res){
            return $res;
        }
        else{
            return false;
        }
    }
}
?>