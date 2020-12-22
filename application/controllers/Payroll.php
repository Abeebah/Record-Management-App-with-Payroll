<?php
defined('BASEPATH') OR exit('No direct script access allowed');
include "Global_controller.php";

class Payroll extends Global_controller {

    public function __construct()
    {
        parent::__construct();
        $this->load->model('payroll_model');
    }

    public function index()
    {
        $payroll_list = $this->payroll_model->get_payroll();
       
        $table = self::payroll_table($payroll_list);

        $content = '<div class = "row">
                    <div class="col-md-8">
                        <h2 class = "settingslabel" id = "payroll_h">Payroll Records</h2>
                    </div>
                </div>
                <div class = "row">
                    <div class = "col-md-12">
                        <div class = "float-right" id = "add-payroll">
                            <img src="'.base_url().'assets/images/add.png" class="img img-responsive"> Add new
                        </div>
                    </div>
                </div>
                
                <div class="row date-range-div">
                    <div class="col-md-6">
                        <input type = "text" class = "form-control form-control-lg" name = "daterange" value="'.date('m/d/Y').' - '.date('m/d/Y').'">
                        <i>***Please select date range</i>
                    </div>
                    <div class="col-md-6">
                        <h1 class = "text-right">Month Total:  N'.number_format($table['total']).'</h1> 
                    </div>
                </div>
    
                <div class = "row m-5">
                    <div class="tableset col-md-12">
                        <table class="table table-hover">
                            <thead>
                                <tr>
                                    <th scope="col" class="red">Staff</th>
                                     <th scope="col" class="red">Position</th>
                                    <th scope="col" class="red">Basic</th>
                                    <th scope="col" class="red">Deduction</th>
                                    <th scope="col" class="red">Tax</th>
                                    <th scope="col" class="red">Netpay</th>
                                </tr>
                            </thead>
                            <tbody id = "payroll-table">';
                $content .= $table['table'];
                $content .= '</tbody>
                        </table>
                    </div>
                </div>';
        $this->display_view($content);
    }

    public function payroll_range()
    {
        $start = $this->input->post('start');
        $end = $this->input->post('end');

        $payroll_list = $this->payroll_model->get_payroll_range($start, $end);
        $content = self::payroll_table($payroll_list);
        echo json_encode($content);
    }

    public function payroll_table($payroll_list)
    {
        $total = 0;
        $list = '';
        $content = '';
         
        if(is_array($payroll_list) && !empty($payroll_list)){
            foreach($payroll_list as $payroll){
                $total += $payroll['basic'];
                $netpay = $payroll['basic'] - ($payroll['deduction'] + $payroll['tax']);
                $list .= '<tr>
                                <th scope="row" class="size">'.$payroll['last_name'].' '.$payroll['first_name'].'</th>
                                <td class="size">'.$payroll['position'].'</td>
                                <td class="size">N'.number_format($payroll['basic']).'</td>
                                <td class="size">N'.number_format($payroll['deduction']).'</td>
                                <td class="size">N'.number_format($payroll['tax']).'</td>
                                <td class="size">N'.number_format($netpay).'</td>
                            </tr>';
            }  
        }else{
            $list .= '<tr><td colspan = "5">No record found.</td></tr>';
        }
        return array("table" => $list, "total" => $total);
    }

    public function add_payroll_view()
    {
        $staff_list = $this->payroll_model->get_all_users(true);
        $content = '<div class = "row">
                <div class="col-md-8">        
                        <h2 class = "settingslabel" id = "payroll_h">New Entry - Payroll</h2>
                </div>
            </div>

            <div class="row date-range-div">
                <div class="col-md-6">
                    <div class="form-group">
                        <label class="">STAFF</label>
                        <select class="form-control form-control-lg" id = "staff-select">
                            <option value = "">Select Staff</option>
                            <option value = ""></option>';
                foreach($staff_list as $staff){
                    $content .= '<option value = "'.$staff['id'].'">'.$staff['last_name'].' '.$staff['first_name'].'</option>';
                }
            $content .='</select>
                    </div>
                </div>
                <div class="col-md-6">
                    <div class="form-group">
                        <label class="">MONTH</label><br/>
                        <select class="form-control form-control-lg" id = "month">
                            <option value = "">Select Month</option>
                            <option value = "1">January</option>
                            <option value = "2">February</option>
                            <option value = "3">March</option>
                            <option value = "4">April</option>
                            <option value = "5">May</option>
                            <option value = "6">June</option>
                            <option value = "7">July</option>
                            <option value = "8">August</option>
                            <option value = "9">September</option>
                            <option value = "10">Octobert</option>
                            <option value = "11">November</option>
                            <option value = "12">December</option>
                        </select>
                    </div>
                </div>
            </div>
            <div class = "row m-5">
                <div class="clear col-md-7">
                    <div id = "payroll-error-div"></div>
                    <form>
                        <div class = "row">
                            <div class="col-md-6">
                                <div class="form-group">
                                    <label class="">BASIC</label><br>  
                                    <input type = "text" class="form-control" id = "basic" disabled>
                                </div>
                            </div>
                            <div class="col-md-6">
                                <div class="form-group">
                                    <label class="">TAX</label><br>  
                                    <input type = "text" class="form-control" id = "tax" disabled>
                                </div>
                            </div>
                        </div>
                        <div class = "row">
                            <div class="col-md-6">
                                <div class = "row">
                                    <div class="col-md-12">
                                        <div class="form-group">
                                            <label class="">POSITION</label><br>  
                                            <input type = "text" class="form-control" id = "position" readonly>
                                        </div>
                                    </div>
                                </div>
                                <div class = "row">
                                    <div class="col-md-12">
                                        <div class="form-group">
                                            <label class="">DEDUCTION</label><br>  
                                            <input type = "text" class="form-control" id = "deduction">
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="col-md-6">
                                <div class="form-group">
                                    <label class="">NOTES</label><span class="optional">(optional)</span><br>  
                                    <textarea class="form-control" id = "note"></textarea>              
                                </div>                 
                            </div>                            
                        </div>              
                        <div class = "row">
                            <div class="col-md-12">
                                <input type="submit" class="btn btn-danger btn-block" id = "payroll-process" value="Submit">
                            </div>
                        </div>
                    </form>
                </div>
            </div>';

        $this->display_view($content);
    }

    public function staff_select()
    {
        $staff_id = $this->input->post('staff_id');
        $res = $this->payroll_model->user_exist($staff_id);
        if($res){
            echo json_encode(array("status" => "success", "position" => $res[0]['position'], "salary" => $res[0]['salary'], "tax" => $res[0]['salary'] * 0.1));
        }else{
            echo json_encode(array("status" => "failed"));
        }
    }

    public function payroll_process(){
        $basic      = $this->input->post('basic');
        $tax        = $this->input->post('tax');
        $position   = $this->input->post('position');
        $deduction  = $this->input->post('deduction');
        $month      = $this->input->post('month');
        $note       = $this->input->post('note');
        $staff_id   = $this->input->post('staff_id');

        $res = $this->payroll_model->create_payroll($staff_id, $basic, $tax, $position, $deduction, $month, $note, $this->user_id);
        if($res){
            echo json_encode(array("status" => "success", "message" => "Payroll record added successfully."));
        }else{
            echo json_encode(array("status" => "failed", "message" => "Something went wrong. please try again shortly."));
        }
    }
}
?>