<?php
include "Global_model.php";

class Payroll_model extends Global_model{
    public function get_payroll()
    {
        $res = $this->custom_query('SELECT pk_payroll.basic, pk_payroll.deduction, pk_payroll.tax, pk_users.last_name, pk_users.first_name, pk_users.position from pk_users, pk_payroll where pk_payroll.staff_id = pk_users.id order by pk_payroll.date_created desc limit 20');
        return $res;
    }

    public function get_payroll_range($start, $end)
    {
        $res = $this->custom_query(sprintf("SELECT pk_payroll.basic, pk_payroll.deduction, pk_payroll.tax, pk_users.last_name, pk_users.first_name, pk_users.position from pk_users, pk_payroll where pk_payroll.staff_id = pk_users.id and pk_payroll.date_created >= '%s' and pk_payroll.date_created <= '%s' order by pk_payroll.date_created desc limit 20", $start, $end));
        return $res;
    }

    public function create_payroll($staff_id, $basic, $tax, $deduction, $month, $note, $user_id)
    {
        $data = array(
            "staff_id" => $staff_id,
            "basic" => $basic,
            "tax" => $tax,
            "deduction" => $deduction,
            "month" => $month,
            "note" => $note,
            "created_by" => $user_id
        );
        $res = $this->insert_data('pk_payroll', $data);
        return $res;
    }
}

?>