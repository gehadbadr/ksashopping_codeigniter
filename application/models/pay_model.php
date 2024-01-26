<?php

class pay_model extends CI_Model {

    function __construct() {
        parent::__construct();
    }

    function insert_message_pay($name, $mobile, $email, $bank, $date, $named, $payment,$note) {
        if (!$name || !$mobile || !$email ) {
            $res = 'Please fill in your Data';
            return $res;
        } elseif (!(preg_match("/^[\.A-z0-9_\-\+]+[@][A-z0-9_\-]+([.][A-z0-9_\-]+)+[A-z]{1,4}$/", $email))) {
            $res = "You haven't provided a valid email";
            return $res;
        } else {
            $query = $this->db->insert("pay_confirm", array('name' => $name, 'mobile' => $mobile, 'email' => $email, 'bank' => $bank, 'date' => $date, 'named' => $named, 'payment' => $payment, 'note' => $note, 'date1' => 'NOW()'),1);
            $res = 'Your message sent';
            return $res;
        }
    }

}

?>
