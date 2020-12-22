<?php
defined('BASEPATH') OR exit('No direct script access allowed');
include "Global_controller.php";

class Records extends Global_controller {

    public function __construct()
    {
        parent::__construct();
        $this->load->model('records_model');
    }

    public function index()
    {
        $post_company_id = $this->input->post('company_id');
        $company_list   = $this->records_model->get_companies();

        $company_id = (!empty($post_company_id) && isset($post_company_id)) ? $post_company_id : $company_list[0]['id'];
        $records_list   = $this->records_model->get_records($company_id);
        $table          = self::records_table($records_list);
        $content = '<div class = "row mt-5">
                <div class="col-md-8">
                    <select class="form-control form-control-lg" id = "record-company-select">';
                    foreach($company_list as $company){
                        if($company['id'] == $company_id){
                            $content .= '<option value = "'.$company['id'].'" selected>'.$company['name'].'</option>';
                        }else{
                            $content .= '<option value = "'.$company['id'].'">'.$company['name'].'</option>';
                        }
                    }
                    $content .= '</select>
                </div>            
                <div class = "col-md-4">
                    <div class = "float-right" id = "add-records">
                        <img src="'.base_url().'assets/images/add.png" class="img img-responsive"> Add new
                    </div>
                </div>
            </div>                
            <div class = "row mb-5">
                <div class = "col-md-12"> 
                    <div class="tableset">
                        <table class="table table-hover">
                            <thead>
                                <tr>
                                    <th scope="col" class="red">Date</th>
                                    <th scope="col" class="red">Description</th>
                                    <th scope="col" class="red">Category</th>
                                    <th scope="col" class="red">Income</th>
                                    <th scope="col" class="red">Expense</th>
                                    <th scope="col" class="red">Balance</th>
                                    <th scope="col" class="red">Action</th>
                                </tr>
                            </thead>
                            <tbody id = "records-table">';
                           
                $content .= $table;
                                
                $content .= '</tbody>
                        </table>
                    </div>
                </div>
            </div>';

        echo $this->display_view($content);
    }

    public function company_select()
    {
        $company_id = $this->input->post('company_id');
        $records_list = $this->records_model->get_records($company_id);
        $table = self::records_table($records_list);
        echo $table;
    }

    public function records_table($records_list)
    {
        $table = '';
        foreach($records_list as $records){
            $income = $records['income'] ; 

            $expense = $records['expense'];

            $income_expense = (empty($records['expense'])) ? '<span style = "color: green">'.$records['income'].'</span' : '<span style = "color: red">'.$records['expense'].'</span>';
            $table .= '<tr>
            <th scope="row" class="size">'.date('d/m/Y',strtotime($records['date_created'])).'</th>
            <td class="size">'.$records['description'].'</td>
            <td class="size">'.$records['name'].'</td>
            <td class="size" <span style = "color: green">'.$income.'</td>
            <td class="size" <span style = "color: red">'.$expense.'</td>
            <td class="size">N'.number_format($records['balance']).'</td>';
            if(isset($records['income']) && !empty($records['income'])){
                $table .= '<td class = "size"><button id = "records_delete" class = "btn btn-danger btn-sm" record_id = "'.$records['id'].'" b_type = "income">Delete</button></td>';
            }else{
                $table .= '<td class = "size"><button id = "records_delete" class = "btn btn-danger btn-sm" record_id = "'.$records['id'].'" b_type = "expense">Delete</button></td>';
            }
            $table .= '</tr>';
        }
        return $table;
    }

    public function add_records()
    {
        $category_list = $this->records_model->get_categories();
        $company_list  = $this->records_model->get_companies();

        $content = '<div class = "row">
            <div class="col-md-7">
                <h2 class = "settingslabel" id = "payroll_h">New Entry - Record</h2>
            </div>
        </div>        

        <div class = "row mt-5 mb-5">
            <div class="col-md-8">
                <div id = "record-error-div"></div>
                <form>
                    <div class = "row">
                        <div class="col-md-6">
                            <div class = "form-group">
                                <label class="">Company</label>
                                <select class="form-control" id = "rec-company-id">';
                        foreach($company_list as $company){
                            $content .= '<option value = "'.$company['id'].'">'.$company['name'].'</option>';
                        }
                                    
                        $content .= '</select>
                            </div>
                        </div>
                        <div class="col-md-6">
                            <div class = "form-group">
                                <label class="">Type</label>
                                <select class="form-control" id = "rec-type-id">
                                    <option value = "1">Income</option>
                                    <option value = "2">Expense</option>
                                </select>
                            </div>
                        </div>
                    </div>
                    <div class = "row">
                        <div class="col-md-6">
                            <div class = "row">
                                <div class="col-md-12">
                                    <div class = "form-group">
                                        <label class="">Amount</label>
                                        <input type="text" class="form-control" id = "rec-amount" placeholder="amount">
                                    </div>
                                    <div class = "form-group">
                                        <label class="">Category</label>
                                        <select class="form-control" id = "rec-category-id">';
                                    foreach($category_list as $category){
                                        $content .= '<option value = "'.$category['id'].'">'.$category['name'].'</option>';
                                    }                                        
                                $content .= '</select>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="col-md-6">
                            <div class = "form-group">
                                <label class="">Description</label>
                                <textarea class="form-control" placeholder="Decribe transaction here" id = "rec-description" row = "5"></textarea>
                            </div>
                        </div>
                    </div>                               
                    <div class="">
                        <input type="submit" class="btn btn-danger btn-block" id = "records-process" value="Submit">
                    </div> 
                </form>
            </div>
        </div>';

      echo $this->display_view($content);
    }

    public function records_process()
    {
        $company_id     = $this->input->post('company_id');
        $category_id    = $this->input->post('category_id');
        $amount         = $this->input->post('amount');
        $description    = $this->input->post('description');
        $type_id        = $this->input->post('type_id');

        $update_res = $this->records_model->update_balance($company_id, $type_id, $amount, $this->user_id);
        
        if($update_res >= 0){
            $res = $this->records_model->create_records($company_id, $category_id, $amount, $description, $type_id, $update_res, $this->user_id);
            if($res){
                echo json_encode(array("status" => "success", "message" => "Record entry added successfully."));
            }else{
                echo json_encode(array("status" => "failed", "message" => "Something went wrong. Please try again shortly."));
            }
        }else{
            echo json_encode(array("status" => "failed", "message" => "Insufficient balance."));
        }
    }

    public function records_delete()
    {
        $b_type = $this->input->post('b_type');
        $records_id = $this->input->post('records_id');

        $delete_res = $this->records_model->records_delete($b_type, $records_id, $this->user_id);
        if($delete_res){
            echo "Records deleted successfully";
        }else{
            echo "Something went wrong. please try again.";
        }
    }
}