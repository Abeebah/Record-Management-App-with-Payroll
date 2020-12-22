<?php
include "Global_model.php";

class Records_model extends Global_model{

    public function create_records($company_id, $category_id, $amount, $description, $type_id, $balance, $user_id)
    {
        if($type_id == 2){
            $data = array(
                "company_id" => $company_id,
                "category" => $category_id,
                "expense_amount" => $amount,
                "balance" => $balance,
                "description" => $description,
                "created_by" => $user_id            
            );
            $res = $this->insert_data('pk_expenses', $data);
        }else{            
            $data = array(
                "company_id" => $company_id,
                "category" => $category_id,
                "income_amount" => $amount,
                "balance" => $balance,
                "description" => $description,
                "created_by" => $user_id            
            );
            $res = $this->insert_data('pk_income', $data);
        }
        return $res;
    }

    public function update_balance($company_id, $type_id, $amount, $user_id)
    {
        $clause = sprintf("id = '%s'", $company_id);
        $company_balance = $this->get_specific('pk_company', 'company_balance', $clause);
        $company_balance = $company_balance[0]['company_balance'];
        
        if($type_id == 1){
            $company_balance = ($company_balance == 0 || $company_balance == '') ? 0 : $company_balance;
            $new_balance = (int)$company_balance + (int)$amount;

            $data = array("company_balance" => $new_balance);
            $update_balance = $this->update_data('pk_company', $data, $clause);
        }else{
            if($company_balance < $amount){
                $new_balance = -1;
            }else{
                $new_balance = (int)$company_balance - (int)$amount;

                $data = array("company_balance" => $new_balance);
                $update_balance = $this->update_data('pk_company', $data, $clause);
            }
        }
        return $new_balance;
    }

    public function get_records($company_id)
    {
        $res = $this->custom_query(sprintf("SELECT '' as income, pk_expenses.id, pk_expenses.expense_amount as expense, pk_expenses.description, pk_categories.name, pk_expenses.balance, pk_expenses.date_created from pk_expenses, pk_categories where pk_categories.id = pk_expenses.category and pk_expenses.company_id = %s and pk_expenses.delete_status != '1' union select pk_income.income_amount as income, pk_income.id, '' as expense, pk_income.description, pk_categories.name, pk_income.balance, pk_income.date_created from pk_income, pk_categories where pk_categories.id = pk_income.category and pk_income.company_id = %s and pk_income.delete_status != '1' order by date_created desc", $company_id, $company_id));
        
        return $res;
    }

    public function records_delete($b_type, $record_id, $user_id)
    {
        $clause = sprintf("id = '%s'", $record_id);
        if($b_type == 'income'){
            $data = array("deleted_by" => $user_id, "delete_status" => 1);
            $update_balance = $this->update_data('pk_income', $data, $clause);
        }else{
            $data = array("deleted_by" => $user_id, "delete_status" => 1);
            $update_balance = $this->update_data('pk_expenses', $data, $clause);
        }

        if($update_balance){
            return true;
        }else{
            return false;
        }
    }
}
?>