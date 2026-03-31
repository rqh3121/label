<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Shipment extends CI_Controller {

    public function __construct() {
        parent::__construct();
        require_once FCPATH . 'vendor/autoload.php';
        $this->load->model('Shipment_model');
        $this->load->library('form_validation');
        $this->load->helper('image'); // helper untuk base64 gambar (opsional)
    }

    // Daftar semua pengiriman
    public function index() {
        $search = $this->input->get('search');
        $data['shipments'] = $this->Shipment_model->get_shipments($search);
        $data['search'] = $search;
        $this->load->view('templates/header');
        $this->load->view('shipments/index', $data);
        $this->load->view('templates/footer');
    }

    // Form tambah
    public function create() {
        $data['city_options'] = $this->get_city_list();
        $data['address_options'] = $this->get_address_list();
        $this->load->view('templates/header');
        $this->load->view('shipments/create', $data);
        $this->load->view('templates/footer');
    }

    // Simpan data baru
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
            // Proses manual input untuk kota dan alamat
            $receiver_city = $this->input->post('receiver_city');
            if ($receiver_city == 'other') {
                $receiver_city = $this->input->post('receiver_city_manual');
            }

            $receiver_address = $this->input->post('receiver_address');
            if ($receiver_address == 'other') {
                $receiver_address = $this->input->post('receiver_address_manual');
            }

            $data = [
                'sender_name'     => $this->input->post('sender_name'),
                'sender_contact'  => $this->input->post('sender_contact'),
                'sender_address'  => $this->input->post('sender_address'),
                'receiver_name'   => $this->input->post('receiver_name'),
                'receiver_contact'=> $this->input->post('receiver_contact'),
                'receiver_address'=> $receiver_address,
                'receiver_city'   => $receiver_city,
                'package_count'   => $this->input->post('package_count'),
                'item_description'=> $this->input->post('item_description')
            ];
            $this->Shipment_model->insert_shipment($data);
            $this->session->set_flashdata('success', 'Data pengiriman berhasil ditambahkan.');
            redirect('shipment');
        }
    }

    // Form edit
    public function edit($id) {
        $data['shipment'] = $this->Shipment_model->get_shipment($id);
        if (empty($data['shipment'])) show_404();
        $data['city_options'] = $this->get_city_list();
        $data['address_options'] = $this->get_address_list();
        $this->load->view('templates/header');
        $this->load->view('shipments/edit', $data);
        $this->load->view('templates/footer');
    }

    // Update data
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
            // Proses manual input untuk kota dan alamat
            $receiver_city = $this->input->post('receiver_city');
            if ($receiver_city == 'other') {
                $receiver_city = $this->input->post('receiver_city_manual');
            }

            $receiver_address = $this->input->post('receiver_address');
            if ($receiver_address == 'other') {
                $receiver_address = $this->input->post('receiver_address_manual');
            }

            $data = [
                'sender_name'     => $this->input->post('sender_name'),
                'sender_contact'  => $this->input->post('sender_contact'),
                'sender_address'  => $this->input->post('sender_address'),
                'receiver_name'   => $this->input->post('receiver_name'),
                'receiver_contact'=> $this->input->post('receiver_contact'),
                'receiver_address'=> $receiver_address,
                'receiver_city'   => $receiver_city,
                'package_count'   => $this->input->post('package_count'),
                'item_description'=> $this->input->post('item_description')
            ];
            $this->Shipment_model->update_shipment($id, $data);
            $this->session->set_flashdata('success', 'Data pengiriman berhasil diupdate.');
            redirect('shipment');
        }
    }

    // Hapus data
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

    // Detail pengiriman
    public function show($id) {
        $data['shipment'] = $this->Shipment_model->get_shipment($id);
        if (empty($data['shipment'])) show_404();
        $this->load->view('templates/header');
        $this->load->view('shipments/show', $data);
        $this->load->view('templates/footer');
    }

    // Cetak label PDF (default A5)
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

    // AJAX update resi
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

    // Data pilihan kota (bisa diedit sesuai kebutuhan)
    private function get_city_list() {
        return [
            "PT PELNI CAB SEMARANG",
            "PT PELNI CAB SURABAYA",
            "PT PELNI CAB MAKASSAR",
            "PT PELNI CAB AMBON",
            "PT PELNI CAB MEDAN",
            "PT PELNI CAB BATAM",
            "PT PELNI CAB TANJUNG PINANG",
            "PT PELNI CAB BALI",
            "PT PELNI CAB KUMAI",
            "PT PELNI CAB SAMPIT",
            "PT PELNI CAB BATULICIN",
            "PT PELNI CAB BALIKPAPAN",
            "PT PELNI CAB TIMIKA",
            "PT PELNI CAB TARAKAN",
            "PT PELNI CAB JAYAPURA",
            "PT PELNI CAB PAREPARE",
            "PT PELNI CAB BAUBAU",
            "PT PELNI CAB KENDARI",
            "PT PELNI CAB LARANTUKA",
            "PT PELNI CAB PALU",
            "PT PELNI CAB MAUMERE",
            "PT PELNI CAB KUPANG",
            "PT PELNI CAB LABUAN BAJO",
            "PT PELNI CAB KAIMANA",
            "PT PELNI CAB SORONG",
            "PT PELNI CAB MANOKWARI",
            "PT PELNI CAB LUWUK",
            "PT PELNI CAB BITUNG",
            "PT PELNI CAB PONTIANAK",
            "PT PELNI CAB BIMA",
            "PT PELNI CAB TERNATE",
            "PT PELNI CAB MERAUKE",
            "PT PELNI CAB WAINGAPU",
            "PT PELNI CAB ENDE",
            "PT PELNI CAB NABIRE",
            "PT PELNI CAB NUNUKAN",
            "PT PELNI CAB FAKFAK",
            "PT PELNI CAB SERUI",
            "PT PELNI CAB DOBO",
            "PT PELNI CAB TUAL",
            "PT PELNI CAB NAMLEA",
            "PT PELNI CAB BIAK"

        ];
    }

    // Data pilihan alamat (bisa diedit sesuai kebutuhan)
    private function get_address_list() {
        return [
            "JL. EMPU TANTULAR NO.25, BANDARHARJO, SEMARANG UTARA, SEMARANG, JAWA TENGAH",
            "JL. PAHLAWAN NO.112, KREMBANGAN, SURABAYA, JAWA TIMUR",
            "JL. JENDERAL SUDIRMAN NO.14, SAWERIGADING, UJUNG PANDANG, MAKASSAR, SULAWESI SELATAN",
            "JL. D.I. PANJAITAN NO.19, URITETU, SIRIMAU, AMBON, MALUKU",
            "JL. GUNUNG KRAKATAU NO.17A, MEDAN, SUMATERA UTARA",
            "JL. DR. CIPTO MANGUNKUSUMO NO.4 TANJUNG PINGGIR, SEKUPANG, BATAM",
            "JL. JEND. AHMAD YANI NO. 06 (KM. 5 ATAS) KEL. SEI JENG KEC. BUKIT BESTARI, TANJUNG PINANG, KEPULAUAN RIAU",
            "JL. RAYA KUTA NO. 299, TUBAN, BADUNG, BALI.",
            "Jl. SUDIRMAN SH No. 16, KEL. SIDOREJO PANGKALAN BUN, KEC. ARUT SELATAN, KAB. KOTAWARINGIN BARAT, KALIMANTAN TENGAH",
            "JL. A. YANI NO. 70, KEL. MENTAWA BARU HULU, KEC. MENTAWA BARU KETAPANG, KAB KOTAWARINGIN TIMUR, KALIMANTAN TENGAH, 74322 PT. PELNI CAB. BATULICIN JALAN RAYA BATULICIN, KAMPUNG BARU, KEC. SIMPANG EMPAT, KAB. TANAH BUMBU, KALIMANTAN SELATAN, 72212",
            "JL. YOS SUDARSO NO.1 KEL. PRAPATAN, KEC. BALIKPAPAN, KOTA BALIKPAPAB, KALIMANTAN TIMUR 76111",
            "JL. KARTINI NO. 5, KEL. INAUGA, DISTRIK MIMIKA BARU, KAB. TIMIKA, PROV. PAPUA TENGAH 99971",
            "JL. KUSUMA BANGSA RT/RW 07/03 NO. 100, KEL. GUNUNG LINGKAS, KEC. TARAKAN TIMUR, KAB. TARAKAN, PROV. KALIMANTAN UTARA 77126",
            "JL. ARGAPURA NO.15, ARGAPURA, DISTRIK JAYAPURA SELATAN, KOTA JAYAPURA, PAPUA",
            "JL. LASIMING NO.44, UJUNG, PARE-PARE, SULAWESI SELATAN",
            "JL. PAHLAWAN NO.1 BAU-BAU, BUTON, SULAWESI TENGGARA",
            "JL. LAKIDENDE KOTA LAMA NO.10, KANDAI, KENDARI, SULAWESI TENGGARA",
            "JL. DON LORENZO DVG, LOHAYONG, LARANTUKA, FLORES TIMUR, NUSA TENGGARA TIMUR",
            "JL. RA KARTINI NO.96, PALU TIMUR, PALU, SULAWESI TENGAH",
            "JL. DON JUAN NO.6, ALOK, SIKKA, FLORES, NUSA TENGGARA TIMUR",
            "JL. PAHLAWAN NO.7, FATUFETO, ALAK, KUPANG, NUSA TENGGARA TIMUR",
            "JL. TRANS FLORES, PASAR BARU, MANGGARAI BARAT, NUSA TENGGARA TIMUR",
            "JL. DIPONEGORO, KAIMANA, PAPUA BARAT",
            "JL. JEND. A. YANI KOMP. PELABUHAN SORONG - PAPUA BARAT",
            "JL. SILIWANGI NO. 24, MANOKWARI BARAT, MANOKWARI, PAPUA BARAT",
            "JL. SUNGAI LIMBOTO NO. 74, BUNGIN, LUWUK, BANGGAI, SULAWESI TENGAH",
            "JL. SAM RATULANGI NO. 7, BITUNG, SULAWESI UTARA",
            "JL. SULTAN ABDURAHMAN NO.12, SUNGAI BANGKONG, PONTIANAK, KALIMANTAN BARAT",
            "JL. KESATRIA NO.2, PENATOI, MPUNDA, BIMA, NUSA TENGGARA BARAT",
            "JL. JEND. A. YANI KOMP. PELABUHAN TERNATE, MALUKU UTARA",
            "JL. SABANG NO. 318, MERAUKE, PAPUA SELATAN",
            "JL. HASANUDIN NO.1 WAINGAPU SUMBA TIMUR, NUSA TENGGARA TIMUR",
            "JL. KATEDRAL NO.2, MBONGAWANI, ENDE SELATAN, NUSA TENGGARA TIMUR",
            "JL. FRANS KAISEPO NO. 14, NABIRE, PAPUA",
            "JL. AHMAD YANI NO. 15, NUNUKAN, KALIMANTAN UTARA",
            "JL. D.I. PANJAITAN FAK FAK, PAPUA BARAT",
            "JL. DR. WAHIDIN SUDIROHUSODO, KEP. YAPEN, SERUI, PAPUA",
            "JL. YOS SUDARSO NO.22, GALAI DUBU, KEP. ARU, DOBO, MALUKU",
            "JL. AHMAD YANI NO.2, LODAR EL, TUAL, MALUKU",
            "JL. BTN TATANGGO, NAMLEA, BURU, MALUKU",
            "JL. JEND. SUDIRMAN NO. 37, BUROKUB, BIAK KOTA, BIAK NUMFOR, PAPUA",
        ];
    }
}