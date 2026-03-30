<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Shipment extends CI_Controller {

    public function __construct() {
        parent::__construct();
        require_once FCPATH . 'vendor/autoload.php';
        $this->load->model('Shipment_model');
        $this->load->library('form_validation');
        $this->load->helper('image'); // untuk img_to_base64 jika diperlukan, tapi di view kita pakai base_url()
    }

    public function index() {
        $search = $this->input->get('search');
        $data['shipments'] = $this->Shipment_model->get_shipments($search);
        $data['search'] = $search;
        $this->load->view('templates/header');
        $this->load->view('shipments/index', $data);
        $this->load->view('templates/footer');
    }

    public function create() {
        $this->load->view('templates/header');
        $this->load->view('shipments/create');
        $this->load->view('templates/footer');
    }

    public function store() {
        $this->form_validation->set_rules('sender_name', 'Nama Pengirim', 'required');
        $this->form_validation->set_rules('sender_contact', 'Kontak Pengirim', 'required');
        $this->form_validation->set_rules('sender_address', 'Alamat Pengirim', 'required');
        $this->form_validation->set_rules('receiver_name', 'Nama Penerima', 'required');
        $this->form_validation->set_rules('receiver_contact', 'Kontak Penerima', 'required');
        $this->form_validation->set_rules('receiver_address', 'Alamat Penerima', 'required');
        $this->form_validation->set_rules('receiver_city', 'Kota Penerima', 'required');
        $this->form_validation->set_rules('package_count', 'Jumlah Paket', 'required|numeric|greater_than[0]');
        $this->form_validation->set_rules('item_description', 'Keterangan Barang', 'trim|max_length[500]');

        if ($this->form_validation->run() == FALSE) {
            $this->create();
        } else {
            $data = [
                'sender_name'    => $this->input->post('sender_name'),
                'sender_contact' => $this->input->post('sender_contact'),
                'sender_address' => $this->input->post('sender_address'),
                'receiver_name'  => $this->input->post('receiver_name'),
                'receiver_contact'=> $this->input->post('receiver_contact'),
                'receiver_address'=> $this->input->post('receiver_address'),
                'receiver_city'  => $this->input->post('receiver_city'),
                'package_count'  => $this->input->post('package_count'),
                'item_description' => $this->input->post('item_description')
            ];
            $this->Shipment_model->insert_shipment($data);
            $this->session->set_flashdata('success', 'Data pengiriman berhasil ditambahkan.');
            redirect('shipment');
        }
    }

    public function edit($id) {
        $data['shipment'] = $this->Shipment_model->get_shipment($id);
        if (empty($data['shipment'])) show_404();
        $this->load->view('templates/header');
        $this->load->view('shipments/edit', $data);
        $this->load->view('templates/footer');
    }

    public function update($id) {
        $this->form_validation->set_rules('sender_name', 'Nama Pengirim', 'required');
        $this->form_validation->set_rules('sender_contact', 'Kontak Pengirim', 'required');
        $this->form_validation->set_rules('sender_address', 'Alamat Pengirim', 'required');
        $this->form_validation->set_rules('receiver_name', 'Nama Penerima', 'required');
        $this->form_validation->set_rules('receiver_contact', 'Kontak Penerima', 'required');
        $this->form_validation->set_rules('receiver_address', 'Alamat Penerima', 'required');
        $this->form_validation->set_rules('receiver_city', 'Kota Penerima', 'required');
        $this->form_validation->set_rules('package_count', 'Jumlah Paket', 'required|numeric|greater_than[0]');
        $this->form_validation->set_rules('item_description', 'Keterangan Barang', 'trim|max_length[500]');

        if ($this->form_validation->run() == FALSE) {
            $this->edit($id);
        } else {
            $data = [
                'sender_name'    => $this->input->post('sender_name'),
                'sender_contact' => $this->input->post('sender_contact'),
                'sender_address' => $this->input->post('sender_address'),
                'receiver_name'  => $this->input->post('receiver_name'),
                'receiver_contact'=> $this->input->post('receiver_contact'),
                'receiver_address'=> $this->input->post('receiver_address'),
                'receiver_city'  => $this->input->post('receiver_city'),
                'package_count'  => $this->input->post('package_count'),
                'item_description' => $this->input->post('item_description')
            ];
            $this->Shipment_model->update_shipment($id, $data);
            $this->session->set_flashdata('success', 'Data pengiriman berhasil diupdate.');
            redirect('shipment');
        }
    }

    public function delete($id) {
        $shipment = $this->Shipment_model->get_shipment($id);
        if (!empty($shipment['resi_photo'])) {
            $photo_path = FCPATH . 'uploads/resi_photos/' . $shipment['resi_photo'];
            if (file_exists($photo_path)) unlink($photo_path);
        }
        $this->Shipment_model->delete_shipment($id);
        $this->session->set_flashdata('success', 'Data pengiriman dihapus.');
        redirect('shipment');
    }

    public function show($id) {
        $data['shipment'] = $this->Shipment_model->get_shipment($id);
        if (empty($data['shipment'])) show_404();
        $this->load->view('templates/header');
        $this->load->view('shipments/show', $data);
        $this->load->view('templates/footer');
    }

    public function print_label($id, $paper = 'A5') {
        $shipment = $this->Shipment_model->get_shipment($id);
        if (empty($shipment)) show_404();

        $package_count = $shipment['package_count'];
        $data['shipment'] = $shipment;
        $data['paper'] = $paper;
        $data['print_date'] = date('d-m-Y H:i:s');

        $html = '';
        for ($i = 1; $i <= $package_count; $i++) {
            $data['package_number'] = $i;
            $data['total_packages'] = $package_count;
            $html .= $this->load->view('shipments/label_pdf', $data, TRUE);
        }

        $this->load->library('pdf');
        $filename = 'label_' . $shipment['id'] . '_' . date('Ymd_His');
        $this->pdf->generate($html, $filename, $paper, 'portrait');
    }

    public function update_resi($id) {
        if (!$this->input->is_ajax_request()) show_404();

        $this->form_validation->set_rules('resi_number', 'Nomor Resi', 'required');
        $this->form_validation->set_rules('expedition', 'Ekspedisi', 'required');

        if ($this->form_validation->run() == FALSE) {
            echo json_encode(['status' => 'error', 'message' => validation_errors()]);
            return;
        }

        $resi_number = $this->input->post('resi_number');
        $expedition  = $this->input->post('expedition');
        $photo_path = null;

        if (!empty($_FILES['resi_photo']['name'])) {
            $config['upload_path']   = './uploads/resi_photos/';
            $config['allowed_types'] = 'jpg|jpeg|png|gif|pdf';
            $config['max_size']      = 2048;
            $config['encrypt_name']  = TRUE;
            $this->load->library('upload', $config);
            if ($this->upload->do_upload('resi_photo')) {
                $upload_data = $this->upload->data();
                $photo_path = $upload_data['file_name'];
            } else {
                echo json_encode(['status' => 'error', 'message' => $this->upload->display_errors()]);
                return;
            }
        }

        $update = $this->Shipment_model->update_resi($id, $resi_number, $expedition, $photo_path);
        if ($update) {
            echo json_encode(['status' => 'success', 'message' => 'Data resi berhasil disimpan.']);
        } else {
            echo json_encode(['status' => 'error', 'message' => 'Gagal menyimpan data resi.']);
        }
    }

    public function get_resi_form($id) {
        $shipment = $this->Shipment_model->get_shipment($id);
        if (empty($shipment)) show_404();
        $data['id'] = $id;
        $data['resi_number'] = $shipment['resi_number'];
        $data['expedition'] = $shipment['expedition'];
        $this->load->view('shipments/resi_form', $data);
    }
}