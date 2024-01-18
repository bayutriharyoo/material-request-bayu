<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Warehouse extends CI_Controller
{
    public function __construct()
    {
        parent::__construct();
        $this->load->model("Models");
    }

    public function index()
    {
        if ($this->session->userdata('role') != 'Warehouse') {
            redirect(base_url('login/index'));
        } else {
            $data["title"] = "Dashboard | Material Request";
            $this->load->view('templates/head', $data);
            $this->load->view('dashboard', $data);
        }
    }

    public function list()
    {
        if ($this->session->userdata('role') != 'Warehouse') {
            redirect(base_url('login/index'));
        } else {
            $data['title'] = 'List | Material Request';
            $data['data_master'] = $this->Models->getMaterialListWarehouse();
            $this->load->view('templates/head', $data);
            $this->load->view('pages/list', $data);
        }
    }

    public function editMaterial($id_material)
    {
        $data = array(
            "material_name" => $this->input->post('material_name'),
            "req_qty" => $this->input->post('req_qty'),
            "desc" => $this->input->post('desc'),
        );
        $this->Models->updateMaterial($data);
        $this->session->set_flashdata('message', '<div class="alert alert-success alert-dismissible fade show" role="alert">
            Update Material Successfully. 
             <button type="button" class="close" data-dismiss="alert" aria-label="Close">
             <span aria-hidden="true">&times;</span>
           </button></div>');
        redirect("Warehouse/list");
    }

    public function item($id_material)
    {
        if ($this->session->userdata('role') != 'Warehouse') {
            redirect(base_url('login/index'));
        } else {
            $data['id_material'] = $id_material;
            $data['data_master'] = $this->Models->getMaterial($id_material);
            $data['data_item'] = $this->Models->getMaterialItem($id_material);
            if ($data['data_item'] != null) {
                foreach ($data['data_item'] as $row) {
                    $data['title'] = 'Item ' . $row->material_name . ' | Material Request';
                }
            } else {
                $data['title'] = 'Item | Material Request';
            }
            $this->load->view('templates/head', $data);
            $this->load->view('pages/item', $data);
        }
    }

    public function editItem($id_Item, $id_material)
    {
        $data = array(
            "item_name" => $this->input->post('item_name'),
            "qty_item" => $this->input->post('qty_item'),
        );
        $this->Models->updateItem($data);
        $this->session->set_flashdata('message', '<div class="alert alert-success alert-dismissible fade show" role="alert">
            Update Item Successfully. 
             <button type="button" class="close" data-dismiss="alert" aria-label="Close">
             <span aria-hidden="true">&times;</span>
           </button></div>');
        redirect("Warehouse/item/" . $id_material);
    }

    public function approve($id_material)
    {
        $sql = "UPDATE material SET status = 'Approved' WHERE id_material=$id_material";
        $this->db->query($sql);
        redirect(base_url('Warehouse/list'));
    }

    // public function reject($id_material){
    //     $sql="UPDATE material SET status = 'Rejected' WHERE id_material=$id_material";
    //     $this->db->query($sql);
    //     redirect(base_url('Warehouse/list'));
    // }

    public function reject($id_material)
    {
        $data = array(
            "reason" => $this->input->post('reason'),
            "status" => 'Rejected'
        );
        $this->Models->updateMaterial($data);
        $this->session->set_flashdata('message', '<div class="alert alert-success alert-dismissible fade show" role="alert">
            Reject Successfully. 
             <button type="button" class="close" data-dismiss="alert" aria-label="Close">
             <span aria-hidden="true">&times;</span>
           </button></div>');
        redirect("Warehouse/list/");
    }

    public function history()
    {
        if ($this->session->userdata('role') != 'Warehouse') {
            redirect(base_url('login/index'));
        } else {
            $data['title'] = 'History | Material Request';
            $data['data_history'] = $this->Models->getHistory();
            $this->load->view('templates/head', $data);
            $this->load->view('pages/history', $data);
        }
    }
}
