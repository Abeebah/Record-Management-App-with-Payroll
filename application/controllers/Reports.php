<?php
defined('BASEPATH') OR exit('No direct script access allowed');
include "Global_controller.php";

class Reports extends Global_controller {

    public function __construct()
    {
        parent::__construct();
        $this->load->model('reports_model');
    }

    public function index()
    {
        $reports_list = $this->reports_model->get_reports();
        $report_data = self::records_table($reports_list);
        $content = '
                     <div class = "row">
                        <div class="col-md-8">
                            <h2 class = "settingslabel" id = "payroll_h">All Reports</h2>
                        </div>
                    </div>
                    <div class = "row">
                        <div class="col-md-12">
                            <div class="left color col-md-6">
                                <h3>Profit and Loss</strong></h3>
                                <h2 class="reportentry">N'.number_format($report_data['profit_loss']).'</h2> 
                            </div>
                            <div class="right color col-md-6">
                                <div class="income">
                                    <h3>Income</h3>
                                    <h2 class="incomefee"> N'.number_format($report_data['income_total']).'</h2>
                                </div>
                                <div class="expenses">
                                    <h3>Expenses</h3>
                                    <h2 class="incomefee">N'.number_format($report_data['expense_total']).'</h2>
                                </div>
                            </div>
                        </div>
                    </div>
                

        <div class = "row mt-5">
            <div class="col-md-12">
                <table id="example" class="table table-striped table-bordered" style="width:100%">
                     <thead>
                                <tr>
                                    <th scope="col" class="red">Date</th>
                                    <th scope="col" class="red">Description</th>
                                    <th scope="col" class="red">Category</th>
                                    <th scope="col" class="red">Income</th>
                                    <th scope="col" class="red">Expense</th>
                                    <th scope="col" class="red">Balance</th>
                                </tr>
                            </thead>
                             <tbody id = "records-table">';   
                $content .= $report_data['table'];   
                $content .= '</tbody>
                        </table>
            
                </div>
            </div>';

        echo $this->display_view($content);
    }

    public function records_table($reports_list)
    {
        $table = '';
        $income_total= 0;
        $expense_total = 0;
        
        foreach($reports_list as $reports){
            $income = $reports['income'];
            $expense = $reports['expense'];
            if(!empty($reports['expense'])){
                $expense_total += $reports['expense'];
            }
            if(!empty($reports['income'])){
                $income_total += $reports['income'];
            }
            $profit_loss = $income_total - $expense_total;

            $income_expense = (empty($reports['expense'])) ? '<span style = "color: green">'.$reports['income'].'</span' : '<span style = "color: red">'.$reports['expense'].'</span>';
            $table .= '<tr>
                <th scope="row" class="size">'.date('d/m/Y',strtotime($reports['date_created'])).'</th>
                <td class="size">'.$reports['description'].'</td>
                <td class="size">'.$reports['name'].'</td>
                <td class="size" <span style = "color: green">'.$income.'</td>
                <td class="size" <span style = "color: red">'.$expense.'</td>
                <td class="size">N'.number_format($reports['balance']).'</td>
            </tr>';
        }
        $res = array("income_total" => $income_total, "expense_total" => $expense_total, "profit_loss" => $profit_loss, "table" => $table);
        return $res;
    }

   
}
?>