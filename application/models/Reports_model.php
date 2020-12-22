<?php
include "Global_model.php";

class Reports_model extends Global_model{
    public function get_reports()
    {
        $res = $this->custom_query(sprintf("SELECT '' as income, pk_expenses.expense_amount as expense, pk_expenses.description, pk_categories.name, pk_expenses.balance, pk_expenses.date_created from pk_expenses, pk_categories where pk_categories.id = pk_expenses.category  and pk_expenses.delete_status != '1' union select pk_income.income_amount as income, '' as expense, pk_income.description, pk_categories.name, pk_income.balance, pk_income.date_created from pk_income, pk_categories where pk_categories.id = pk_income.category  and pk_income.delete_status != '1' order by date_created desc"));
        
        return $res;
    }
}
?>