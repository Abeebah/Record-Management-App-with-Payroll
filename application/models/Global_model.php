<?php

class Global_model extends CI_Model{

    public function __construct()
    {
        $this->load->database();
    }

    public function get_all($table, $order = false)
    {
        $this->db->select('*');
        if($order){
            $this->db->order_by();
        }
        $query = $this->db->get($table);
        if($query){
            return $query->result_array();
        }else{
            return false;
        }
    }

    public function get_specific($table, $col, $where, $order = false)
    {
        $this->db->select($col);
        $this->db->where($where);
        if($order){
            $this->db->order_by();
        }
        $query = $this->db->get($table);
        if($query){
            return $query->result_array();
        }else{
            return false;
        }
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

    public function insert_data($table, $data)
    {
        $ins_rs = $this->db->insert($table, $data);
        if($ins_rs){
            return $this->db->insert_id();
        }else{
            return false;
        }
    }

    public function update_data($table, $data, $where = false)
    {
        if(!$where){
            $res = $this->db->update($table, $data);
        }else{
            $res = $this->db->update($table, $data, $where);
        }

        if($res){
            return $res;
        }else{
            return false;
        }
    }

    public function custom_query($query)
    {
        $res = $this->db->query($query);
        return $res->result_array();
    }

    public function account_exist($email, $username = false)
    {
        if($username){
            $clause = sprintf("email = '%s' or username = '%s'", $email, $username);
        }else{
            $clause = sprintf('email = %s', $email);
        }
        $res = $this->get_single('pk_users','id', $clause);
        if($res){
            return true;
        }else{
            return false;
        }
    }

    public function user_exist($user_id)
    {
        $clause = sprintf('id = %s', $user_id);
        $res = $this->get_single('pk_users','id, first_name, last_name, phone, email, username, company_id, gender, address, salary, role, position, avatar', $clause);
        if($res){
            return $res;
        }else{
            return false;
        }
    }

    public function get_all_users($is_active = false)
    {
        if($is_active){
            $res = $this->custom_query("SELECT pk_users.id, pk_users.first_name, pk_users.last_name, pk_roles.name as role, pk_users.email, pk_users.created_at, pk_users.position, pk_users.is_active, pk_company.name from pk_users, pk_company, pk_roles where pk_users.company_id = pk_company.id and pk_roles.id = pk_users.role and pk_users.is_active = 1 order by pk_users.last_name");
        }else{
            $res = $this->custom_query("SELECT pk_users.id, pk_users.first_name, pk_users.last_name, pk_roles.name as role, pk_users.email, pk_users.created_at, pk_users.position, pk_users.is_active, pk_company.name from pk_users, pk_company, pk_roles where pk_users.company_id = pk_company.id and pk_roles.id = pk_users.role order by pk_users.last_name");
        }
        return $res;
    }
    
    public function get_categories($is_active = true)
    {
        if($is_active){
            $res = $this->get_specific('pk_categories', 'id, name, description, class, date_created', 'is_active = 1');
        }else{
            $res = $this->get_all('pk_categories');
        }
        return $res;
    }
    
    public function get_companies($is_active = true)
    {       
        if($is_active){
            $res = $this->get_specific('pk_company', 'id, name, description, company_logo, date_created', 'is_active = 1');
        }else{
            $res = $this->get_all('pk_company');
        }
        return $res;
    }

}


?>