<?php

if (!defined('BASEPATH'))
    exit('No direct script access allowed');

class Send_notif {

    function __construct() {
        $this->ci = & get_instance();
        $this->ci->load->model('users/users_model');
        $this->ci->load->model('service_entry/service_entry_model');
        $this->ci->load->library('email');
    }

    public function send_mail($data = array()) {
        $from_mail = 'demo@f2fsolutions.co.in';
        $to_mail = 'demo@f2fsolutions.co.in';

        $this->ci->email->from($from_mail, 'Zimson');
        $this->ci->email->to($to_mail);
        $this->ci->email->subject('Notification');
        $this->ci->email->message('Hello World!');
        $this->ci->email->send();
    }

    public function new_service_entry($id) {
        $this->ci->load->library('zend');
        $this->ci->zend->load('Zend/Barcode');
        $filter = $this->ci->session_view->get_session('service_entry');
        $data['report_title'] = 'Service Acknowledgment';
        $data['service_entry'] = $this->ci->service_entry_model->get_service_entry_details_by_id($id);
        $data['customer'] = $this->ci->service_entry_model->get_customer_details_by_id($data['service_entry'][0]['customer_id']);

        $barcode = $data['service_entry'][0]['sr_number'];
        $barcodeOptions = array('text' => $barcode);
        $bc = Zend_Barcode::factory('code39', 'image', $barcodeOptions, array());

        $img = imagepng($bc->draw(), base_url() . "attachments/barcode/{$barcode
                }

.png");
        $data['barcode'] = $img;
        $html = $this->ci->load->view('service_entry/service_entry_header', $data, TRUE);
        $body = $this->ci->load->view('service_entry/pdf/service_entry_pdf', $data, TRUE);
        $mpdf = new mPDF('', 'A4', '0', '"Roboto", "Noto", sans-serif', '15', '15', '28', '10', '5', '3', 'L');
        $mpdf->setTitle('Service Acknowledgment');
        $mpdf->SetHTMLHeader($html);
        $mpdf->setFooter('{PAGENO} / {
                        nb
                    }');
        $mpdf->WriteHTML($body);
        $filename = 'service_entry-' . date('d-M-Y-H-i-s') . '.pdf';
        $newFile = FCPATH . 'attachments/email_pdf/' . $filename;
        $mpdf->Output($newFile, 'F');
        $this->ci->email->attach(FCPATH . 'attachments/email_pdf/' . $filename);
        $this->ci->email->message('Dear sir,<br>Kindly find the attachment for Service Entry Acknowledgement <b>' . $data['service_entry'][0]['sr_number'] . '</b><br><br><br>Thanks<br>');
        $this->ci->email->from('demo@f2fsolutions.co.in', 'Zimson');
        $this->ci->email->to('demo@f2fsolutions.co.in');
        $this->ci->email->send();
    }

}
