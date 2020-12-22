<?php
defined('BASEPATH') OR exit('No direct script access allowed');
include "Global_controller.php";

class Settings extends Global_controller {

    public function __construct()
    {
        parent::__construct();
        $this->load->model('settings_model');
       
        if(!isset($_SESSION['user_id']) || !isset($_SESSION['email'])){
            //logout
            // redirect(site_url()."/login");
            // exit();
        }

    }

    public function loggedin()
    {
        $res = $this->isLoggedin();
        if(!$res){
            echo json_encode(array("status" => "success"));
        }else{
            echo  json_encode(array("status" => "failed"));
        }
    }

    public function index(){
        $content = '<div class="settingsbody">                        
                        <a href="#" id = "settings_company">
                            <div class="countrydiv col-lg-6">
                                <img src="'.base_url().'assets/images/company_building-512.png" class="countryimage">
                                <p class="countrytext">Company</p>
                            </div>
                        </a>
                        <a href="#" id = "settings_category"> 
                            <div class="countrydiv col-lg-6">
                                <img src="'.base_url().'assets/images/inbox-2_-512.png" class="countryimage">
                                <p class="countrytext">Category</p>
                            </div>
                        </a>
                        <a href="#" id = "settings_users"> 
                            <div class="countrydiv col-lg-6">
                                <img src="'.base_url().'assets/images/inbox-2_-512.png" class="countryimage">
                                <p class="countrytext">Users</p>
                            </div>
                        </a>
                    </div>';
        $this->display_view($content);
    }

    public function company_view()
    {
        $company_list = $this->settings_model->get_companies(false);        
        $content = '
            <div class="row">
                <div class = "col-md-12">
                    <h3 class = "settingslabel" id = "settings_company_h">Company Settings</h3>
                </div> 
            </div> 
            <div class = "row">
                <div class = "col-md-12">
                    <div class = "float-right" data-toggle="modal" data-target="#companyModal" data-whatever="@mdo" id = "add-company">
                        <img src="'.base_url().'assets/images/add.png" class="img img-responsive"> Add new
                    </div>
                </div>
            </div>
            <div class="tableset">
                <table class="table table-hover">
                    <thead>
                        <tr>
                            <th scope="col" class="red">Date Created</th>
                            <th scope="col" class="red">Name</th>
                            <th scope="col" class="red">Balance</th>
                            <th scope="col" class="red">Description</th>
                            <th scope="col" class="red">Action</th>
                        </tr>
                    </thead>
                    <tbody>';
            if(isset($company_list) && !empty($company_list)){
                foreach($company_list as $company){
                    $balance = ($company['company_balance'] == '') ? 0 : $company['company_balance'];
                    $content .= '<tr>
                        <th scope="row" class="size">'.date('d/m/Y',strtotime($company['date_created'])).'</th>
                        <td class="size">'.$company['name'].'</td>
                        <td class="size">N'.number_format($balance).'</td>
                        <td class="size">'.$company['description'].'</td>
                        
                        <td class="size">
                            <button type="button" class="btn btn-primary" company_id = "'.$company['id'].'" id = "edit-company" data-toggle="modal" data-target="#companyModal" data-whatever="@mdo">Edit</button>';
                    if($company['is_active'] == 1){
                        $content .= ' <button type="button" class="btn btn-danger" action_type = "disable" company_id = "'.$company['id'].'" id = "delete-company">Disable</button>';
                    }else{
                        $content .= ' <button type="button" class="btn btn-success" action_type = "enable" company_id = "'.$company['id'].'" id = "delete-company">Enable</button>';
                    }
                    $content .= '</td>
                    </tr>';
                }
            }else{
                $content .= '
                    <tr>
                        <td colspan = "4">No records found</td>
                    </tr>
                ';
            }

            $content .= '
                    </tbody>
                </table>
            </div>';

        $this->display_view($content);        
    }

    public function edit_company()
    {
        $company_id = $this->input->post('company_id');
        $company = $this->settings_model->get_company($company_id);
        if(isset($company) && !empty($company)){
            echo json_encode($company[0]);
        }else{
            echo false;
        }
    }

    public function company_process()
    {
        $action_type    = $this->input->post('action_type');
        $company_id     = $this->input->post('company_id');
        $company_desc   = $this->input->post('company_desc');
        $company_name   = $this->input->post('company_name');

        $config['upload_path']      = './uploads/';
        $config['allowed_types']    = 'jpg|jpeg|png';
        $config['max_size']         = 5000;
        $config['max_width']        = 400;
        $config['max_height']       = 400;
        $config['file_name']        = $company_name;

        $this->load->library('upload', $config);

        $message = '';
        if($action_type == 'edit'){
            if(isset($_FILES['company_logo']['tmp_name'])){
                if(!$this->upload->do_upload('company_logo')){
                    $error = $this->upload->display_errors();
                    $response = array( "status" => "failed", "message" => $error);
                }else{
                    $data = $this->upload->data();
                    $res = $this->settings_model->update_company($company_id, $company_name, $company_desc, $data['file_name']);
                    if($res){
                        $response = array( "status" => "success", "message" => 'Company updated Successfully.');                    
                    }else{
                        $response = array("status" => "failed");
                    }
                }                
            }else{
                $res = $this->settings_model->update_company($company_id, $company_name, $company_desc);
                if($res){
                    $response = array( "status" => "success", "message" => 'Company updated Successfully.');                    
                }else{
                    $response = array("status" => "failed");
                }
            }
        }else{
            if(!$this->upload->do_upload('company_logo')){
                $error = $this->upload->display_errors();
                $response = array( "status" => "failed", "message" => $error);
            }else{
                $data = $this->upload->data();
                $res = $this->settings_model->new_company($company_name, $company_desc, $data['file_name'], $this->user_id);
                if($res){
                    $response = array( "status" => "success", "message" => 'Company added Successfully.');                    
                }else{
                    $response = array("status" => "failed");
                }
            }            
        }
       
        echo json_encode($response);

    }

    public function delete_company()
    {
        $company_id     = $this->input->post('company_id');
        $action_type    = $this->input->post('action_type');
        $message        = ($action_type == 'enable') ? 'Company enabled successfully' : 'Company disabled successfully';
        
        $res = $this->settings_model->delete_company($company_id, $action_type, $this->user_id);
        if($res){
            $response = array("status" => "success", "message" => $message);
        }else{
            $response = array("status" => "failed");
        }
        echo json_encode($response);
    }

    public function category_view(){
        $category_list = $this->settings_model->get_categories(false);        
        $content = '
            <div class="row">
                <div class = "col-md-12">
                    <h3 class = "settingslabel" id = "settings_category_h">Category Settings</h3>
                </div> 
            </div> 
            <div class = "row">
                <div class = "col-md-12">
                    <div class = "float-right" data-toggle="modal" data-target="#categoryModal" data-whatever="@mdo" id = "add-category">
                        <img src="'.base_url().'assets/images/add.png" class="img img-responsive"> Add new
                    </div>
                </div>
            </div>
                                   
            <div class="tableset">
                <table class="table table-hover">
                    <thead>
                        <tr>
                            <th scope="col" class="red">Date</th>
                            <th scope="col" class="red">Name</th>
                            <th scope="col" class="red">Description</th>
                            <th scope="col" class="red">Action</th>
                        </tr>
                    </thead>
                    <tbody>';
            if(isset($category_list) && !empty($category_list)){
                foreach($category_list as $category){
                    $content .= '
                        <tr>
                            <th scope="row" class="size">'.date('d/m/Y',strtotime($category['date_created'])).'</th>
                            <td class="size">'.$category['name'].'</td>
                            <td class="size">'.$category['description'].'</td>
                            
                            <td class="size">
                                <button type="button" class="btn btn-primary" category_id = "'.$category['id'].'" id = "edit-category" data-toggle="modal" data-target="#categoryModal" data-whatever="@mdo">Edit</button>';
                        if($category['is_active'] == 1){
                            $content .= ' <button type="button" class="btn btn-danger" action_type = "disable" category_id = "'.$category['id'].'" id = "delete-category">Disable</button>';
                        }else{
                            $content .= ' <button type="button" class="btn btn-success" action_type = "enable" category_id = "'.$category['id'].'" id = "delete-category">Enable</button>';
                        }
                $content .= '</td>                            
                        </tr>';
                }
            }else{
                $content .= '
                    <tr>
                        <td colspan = "4">No records found</td>
                    </tr>
                ';
            }

            $content .= '
                    </tbody>
                </table>
            </div>';

        $this->display_view($content);
    }

    public function edit_category()
    {
        $category_id = $this->input->post('category_id');
        $category = $this->settings_model->get_category($category_id);
        if(isset($category) && !empty($category)){
            echo json_encode($category[0]);
        }else{
            echo false;
        }
    }

    public function category_process()
    {
        $action_type    = $this->input->post('action_type');
        $category_id     = $this->input->post('category_id');
        $category_desc   = $this->input->post('category_desc');
        $category_name   = $this->input->post('category_name');
        $category_class   = $this->input->post('category_class');

        $message = '';
        if($action_type == 'edit'){
            $res = $this->settings_model->update_category($category_id, $category_name, $category_class, $category_desc);
            $message = 'Category updated Successfully.';
        }else{
            $res = $this->settings_model->new_category($category_name, $category_class, $category_desc, $this->user_id);
            $message = 'Category added Successfully.';
        }

        if($res){
            $response = array("status" => "success", "message" => $message);
        }else{
            $response = array("status" => "failed");
        }
        echo json_encode($response);
    }

    public function delete_category()
    {
        $category_id    = $this->input->post('category_id');
        $action_type    = $this->input->post('action_type');
        $message        = ($action_type == 'enable') ? 'Category enabled successfully' : 'Category disabled successfully';
        
        $res = $this->settings_model->delete_category($category_id, $action_type, $this->user_id);
        if($res){
            $response = array("status" => "success", "message" => $message);
        }else{
            $response = array("status" => "failed");
        }
        echo json_encode($response);
    }

    public function users_view()
    {
        $users = $this->settings_model->get_all_users();
        $companies = $this->settings_model->get_companies();
        $content = '<div class = "row">
            <div class = "col-12">
                <h3 class="registertab" id = "settings_users_h">Users Settings</h3>
            </div>
        </div>
        <div class = "row">
            <div class="clear col-md-8">
                <div id = "user-error-div"></div>
                <form>     
                    <div class = "row">                 
                        <div class="col-md-6">
                            <div class = "form-group">
                                <input type="text" class="form-control" id = "firstname" placeholder="First Name">
                            </div>
                        </div>
                        <div class="col-md-6">
                            <div class="form-group">
                                <input type="text" class="form-control" id = "lastname" placeholder="Last Name">
                            </div>
                        </div>
                    </div>
                    <div class = "row">
                        <div class="col-md-6">
                            <div class="form-group">                    
                                <input type="text" class="form-control" id = "address" placeholder="Home address">
                            </div>               
                        </div>
                                                    
                        <div class="col-md-6">                        
                            <div class="form-group">
                                <input type="email" class="form-control" id = "email" placeholder="Email address">
                            </div> 
                        </div>
                    </div>
                    <div class = "row">
                        <div class="col-md-4">
                            <div class="form-group">                    
                                <input type="text" class="form-control" id = "username" placeholder="Username">
                            </div>
                        </div>  
                         
                        <div class="col-md-4">                        
                            <div class="form-group">                    
                                <input type="text" class="form-control" id = "phone" placeholder="Phone number">
                            </div>
                        </div> 
                        <div class="col-md-4">
                            <div class="form-group">
                                <select class="form-control" id = "gender">
                                    <option value = "">Gender</option>
                                    <option value = "1">Male</option>
                                    <option value = "2">Female</option>
                                </select>
                            </div>
                        </div>
                    </div>
                    <div class = "row"> 
                        <div class="col-md-4">           
                            <div class="form-group">
                                <select class="form-control" id = "company">
                                    <option value = "">Select Company</option>';
                    foreach ($companies as $company) {                                                    
                        $content .= '<option value = "'.$company['id'].'">'.$company['name'].'</option>';
                    }
                    $content .= '</select>
                            </div>
                        </div>     
                        <div class="col-md-4">           
                            <div class="form-group">
                                <select class="form-control" id = "role">
                                    <option value = "">User Role</option>
                                    <option value = "1">Admin</option>
                                    <option value = "2">User</option>
                                </select>
                            </div>
                        </div>
                        <div class = "col-md-4">
                            <div class="form-group">
                                <input type="text" class="form-control" id = "salary" placeholder="Salary">
                            </div> 
                        </div>              
                    </div>
                    <div class = "row">

                    <div class = "col-md-4">
                            <div class="form-group">
                                <input type="text" class="form-control" id = "position" placeholder="Position">
                            </div> 
                        </div>              
                    
                        <div class="col-md-8">           
                            <div class="custom-file">
                                <input type="file" class="custom-file-input" id="profile-pic" name = "profile_pic" onchange = "profile_pic_upload()">
                                <label class="custom-file-label" for="customFile" id = "profile-pic-label">Upload Picture</label>
                            </div>       
                        </div>
                        </div>
                        <div class ="row">
                            <div class="col-md-6">           
                            <div class="">
                                <input type="submit" class="btn btn-danger btn-block" id = "users-process" value="Submit">
                            </div> 
                         </div>
                    </div>
                </form>
            </div>
        </div>
        <br>
        <div class="tableset">
            <table class="table table-hover">
                <thead>
                    <tr>
                        <th scope="col" class="red">Date</th>
                        <th scope="col" class="red">Name</th>
                        <th scope="col" class="red">Position</th>
                        <th scope="col" class="red">Email</th>

                        <th scope="col" class="red">Company</th>
                        <th scope="col" class="red">Action</th>
                    </tr>
                </thead>
                <tbody>';
        if(is_array($users) && !empty($users)){
            foreach($users as $user){
                $content .= '
                    <tr>
                        <td class="size">'.date('d/m/Y',strtotime($user['created_at'])).'</td>
                        <td class="size">'.$user['last_name'].' '.$user['first_name'].'</td>
                        <td class="size">'.$user['position'].'</td>
                        <td class="size">'.$user['email'].'</td>
                        <td class="size">'.$user['name'].'</td>
                        <td class="size">
                            <button class = "btn btn-primary btn-sm" id = "user-edit" user_id = "'.$user['id'].'" data-toggle="modal" data-target="#userModal">Edit</button>
                            <button class = "btn btn-warning btn-sm" id = "user-reset-pass" action_type = "reset_pass" user_id = "'.$user['id'].'">Reset Password</button>';
                        if($user['is_active'] == 1){
                            $content .= ' <button class = "btn btn-danger btn-sm" id = "user-suspend" action_type = "suspend" user_id = "'.$user['id'].'">Suspend</button>';
                        }else{
                            $content .= ' <button class = "btn btn-success btn-sm" id = "user-suspend" action_type = "activate" user_id = "'.$user['id'].'">Activate</button>';
                        }
                $content .= '</td>
                    </tr>';
            }
        }else{
            $content .= ' <tr>
                <td class="size" colspan = "6">No users available.</td>
            </tr>';
        }
        $content .= '</tbody>
                </table>
            </div>';
        

        $this->display_view($content);
    }

    public function users_process()
    {
        $firstname      = $this->input->post('firstname');
        $lastname       = $this->input->post('lastname');
        $address        = $this->input->post('address');
        $username       = $this->input->post('username');
        $position       = $this->input->post('position');
        $role           = $this->input->post('role');
        $company        = $this->input->post('company');
        $salary         = $this->input->post('salary');
        $gender         = $this->input->post('gender');
        $email          = $this->input->post('email');
        $phone          = $this->input->post('phone');
        $profile_pic    = $this->input->post('profile_pic');
        $password       = $this->random_password();
        
        $config['upload_path']      = './uploads/';
        $config['allowed_types']    = 'jpg|jpeg|png';
        $config['max_size']         = 5000;
        $config['max_width']        = 400;
        $config['max_height']       = 400;
        $config['file_name']        = $lastname;

        $this->load->library('upload', $config);

        if(!$this->settings_model->account_exist($email, $username)){
            if(!$this->upload->do_upload('profile_pic')){
                $error = $this->upload->display_errors();
                echo json_encode(array( "status" => "failed", "message" => $error));
            }else{
                $data = $this->upload->data();
                $result = $this->settings_model->create_users($firstname, $lastname, $address, $username, $position, $role, $company, $salary, $gender, $email, $phone, $data['file_name'], password_hash($password, PASSWORD_DEFAULT));

                if($result){
                    $response = array("status" => "success", "message" => "User created successfully");
                    echo json_encode($response);
                }else{
                    $response = array("status" => "failed", "message" => "Something went wrong. Please try again shortly");
                    echo json_encode($response);
                }
            }
        }else{
            $response = array("status" => "failed", "message" => "User already exist.");
            echo json_encode($response);
        }
    }

    public function users_edit()
    {
        $user_id = $this->input->post('user_id');
        $res = $this->settings_model->user_exist($user_id);

        $companies = $this->settings_model->get_companies();
        $company_option = "";
        foreach ($companies as $company) {                                                    
            $company_option .= '<option value = "'.$company['id'].'">'.$company['name'].'</option>';
        }

        if($res){
            $response = array("status" => "success", "data" => $res[0], "companies" => $company_option);
            echo json_encode($response);
            // $res = $this->settings_model->user_edit($user_id);
        }else{
            $response = array("status" => "failed", "message" => "Something went wrong. please try again.");
            echo json_encode($response);
        }
    }

    public function edit_user_process()
    {
        $user_id        = $this->input->post('user_id');
        $firstname      = $this->input->post('firstname');
        $lastname       = $this->input->post('lastname');
        $address        = $this->input->post('address');
        $username       = $this->input->post('company');
        $position       = $this->input->post('position');
        $role           = $this->input->post('role');
        $company        = $this->input->post('company');
        $salary         = $this->input->post('salary');
        $gender         = $this->input->post('gender');
        $email          = $this->input->post('email');
        $phone          = $this->input->post('phone');
        $profile_pic    = $this->input->post('profile_pic');
        
        if($this->settings_model->account_exist($email, $username) && $this->settings_model->user_exist($user_id)){
            if(isset($_FILES['profile_pic']['tmp_name'])){
                $config['upload_path']      = './uploads/';
                $config['allowed_types']    = 'jpg|jpeg|png';
                $config['max_size']         = 5000;
                $config['max_width']        = 400;
                $config['max_height']       = 400;
                $config['file_name']        = $lastname;
    
                $this->load->library('upload', $config);
                if(!$this->upload->do_upload('profile_pic')){
                    $error = $this->upload->display_errors();
                    echo json_encode(array( "status" => "failed", "message" => $error));
                }else{
                    $data = $this->upload->data();
                    $result = $this->settings_model->update_users($user_id, $firstname, $lastname, $address, $position, $role, $company, $salary, $gender, $phone, $data['file_name']);
                }
            }else{
                $result = $this->settings_model->update_users($user_id, $firstname, $lastname, $address, $position, $role, $company, $salary, $gender, $phone);
            }

            if($result){
                $response = array("status" => "success", "message" => "User updated successfully");
                echo json_encode($response);
            }else{
                $response = array("status" => "failed", "message" => "Something went wrong. Please try again shortly");
                echo json_encode($response);
            }            
        }else{
            $response = array("status" => "failed", "message" => "Something went wrong. Please try again shortly.");
            echo json_encode($response);
        }
    }

    public function reset_suspend_user()
    {
        $action_type    = $this->input->post('action_type');
        $user_id        = $this->input->post('user_id');
        $password       = $this->random_password();
        $password_hash  = password_hash($password, PASSWORD_DEFAULT);
        
        if($this->settings_model->user_exist($user_id)){
            if($action_type == 'reset_pass'){

                $res = $this->settings_model->reset_password($password_hash, $user_id);
                if($res){
                    $response = array("status" => "success", "message" => "Password reset successful. ".$password);
                }else{
                    $response = array("status" => "failed", "message" => "1Something went wrong. Please try again.");
                }
            }elseif($action_type == 'suspend'){
                $res = $this->settings_model->suspend_user($user_id);
                if($res){
                    $response = array("status" => "success", "message" => "User suspended successfully.");
                }else{
                    $response = array("status" => "failed", "message" => "Something went wrong. Please try again.");
                }
            }elseif ($action_type == 'activate') {
                $res = $this->settings_model->activate_user($user_id);
                if($res){
                    $response = array("status" => "success", "message" => "User activated successfully.");
                }else{
                    $response = array("status" => "failed", "message" => "Something went wrong. Please try again.");
                }
            }else{
                $response = array("status" => "failed", "message" => "2Something went wrong. Please try again.");
            }
        }else{
            $response = array("status" => "failed", "message" => "3Something went wrong. Please try again.");
        }
        echo json_encode($response);
    }
}
?>