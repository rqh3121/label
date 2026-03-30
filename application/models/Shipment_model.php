<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Shipment_model extends CI_Model {

    public function __construct() {
        parent::__construct();
    }

    public function get_shipments($search = '') {
        if (!empty($search)) {
            $this->db->group_start()
                     ->like('sender_name', $search)
                     ->or_like('receiver_name', $search)
                     ->or_like('receiver_city', $search)
                     ->group_end();
        }
        $this->db->order_by('id', 'DESC');
        return $this->db->get('shipments')->result_array();
    }

    public function get_shipment($id) {
        return $this->db->get_where('shipments', ['id' => $id])->row_array();
    }

    public function insert_shipment($data) {
        $this->db->insert('shipments', $data);
        return $this->db->insert_id();
    }

    public function update_shipment($id, $data) {
        $this->db->where('id', $id);
        return $this->db->update('shipments', $data);
    }

    public function delete_shipment($id) {
        $this->db->where('id', $id);
        return $this->db->delete('shipments');
    }

    public function update_resi($id, $resi_number, $expedition, $photo_path = null) {
        $data = [
            'resi_number' => $resi_number,
            'expedition'  => $expedition
        ];
        if ($photo_path) $data['resi_photo'] = $photo_path;
        $this->db->where('id', $id);
        return $this->db->update('shipments', $data);
    }
}