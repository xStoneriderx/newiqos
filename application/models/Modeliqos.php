<?php
class modeliqos extends CI_Model {

    public function __construct()
    {
        $this->load->database();
    }
    /*LOGINS START*/
    public function create_login($data){
        $res = $this->db->get_where('logins', array('username =' => $data['username']))->result_array();
        if ($res) {
            $myresult = array('error'=>'Username '.$data['username'].' already exist!', 'code'=>400);
            return $myresult;
        } else {
            $password = md5($data['password'] . $data['salt']);
            $data['password'] = $password;
            $result = $this->db->insert('logins', $data);
            if ($result) {
                return (['OK'=>'OK', 'id'=>$this->db->insert_id()]);
            } else return(array('error'=>'Something goes wrong:(', 'code'=>500));
        }

    }


    /*LOGINS END*/
    public function new_client($data){
        $result = $this->db->insert('clients', $data);
        $data['id'] = $this->db->insert_id();
        return $data;
    }

    public function record_new_task($id, $apiary_id, $del_date, $del_time, $address, $guided_trial = false, $latitude = null, $longitude = null, $confirmed = 'n') {
        $delivery_date = date('Y-m-d', strtotime($del_date));
        $task_data = array(
            'iqos_id' => $id,
            'apiary_id' => $apiary_id,
            'status' => 'F',
            'delivery_date' => $delivery_date,
            'delivery_time' => $del_time,
            'address' => $address,
            'latitude' => $latitude,
            'longitude' => $longitude,
            'confirmed' => $confirmed,
            'guided_trial' => $guided_trial
        );
        $this->db->insert('iqos_tasks', $task_data);

        $insert_id = $this->db->insert_id();
        return $insert_id;
    }

    public function change_task($date, $time, $task_id) {

        $data = array(
            'delivery_time' => $time,
            'delivery_date' => $date,
            'edited_last' => 'manager'
        );
        $this->db->where('task_id', $task_id);
        $this->db->update('iqos_confirmed_tasks', $data);
    }

    public function get_all_tasks() {
        $query = $this->db->order_by("delivery_date asc", "delivery_time desc")
            ->get('iqos_tasks');

        return $query->result_array();
    }

    public function get_all_tasks_logs() {
        $query = $this->db->select('*')->from('iqos_logs')
            ->join('iqos_tasks', 'iqos_logs.task_id = iqos_tasks.iqos_id')
            ->get();

        return $query->result_array();
    }


    public function get_tasks_logs($date) {
        $query = $this->db->select('*')->from('iqos_logs')
            ->join('iqos_tasks', 'iqos_logs.task_id = iqos_tasks.iqos_id')
            ->where('delivery_date =', $date)
            ->get();

        return $query->result_array();
    }


}