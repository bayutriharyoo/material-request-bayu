<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Production extends CI_Controller
{
    public function __construct()
    {
        parent::__construct();
        $this->load->model("Models");
    }

    public function index()
    {
        if ($this->session->userdata('role') != 'Production') {
            redirect(base_url('login/index'));
        } else {
            $data["title"] = "Dashboard | Material Request";
            $this->load->view('templates/head', $data);
            $this->load->view('dashboard', $data);
        }
    }

    public function list()
    {
        if ($this->session->userdata('role') != 'Production') {
            redirect(base_url('login/index'));
        } else {
            $filter = $this->input->post('filter');
            $dateFrom  = $this->input->post('dateFrom');
            $dateTo  = $this->input->post('dateTo');

            if (isset($filter)) {
                $data['data_master'] = $this->Models->getMaterialListFilter($dateFrom, $dateTo);
            } else {
                $data['data_master'] = $this->Models->getMaterialList();
            }

            $data['title'] = 'List | Material Request';
            $this->load->view('templates/head', $data);
            $this->load->view('pages/list', $data);
        }
    }

    public function addMaterial()
    {
        $data = array(
            "material_name" => $this->input->post('material_name'),
            "req_qty" => $this->input->post('req_qty'),
            "date" => $this->input->post('date'),
            "desc" => $this->input->post('desc'),
            "status" => 'Entry'
        );
        $this->Models->saveMaterial($data);
        $this->session->set_flashdata('message', '<div class="alert alert-success alert-dismissible fade show" role="alert">
            Create Material Successfully. 
             <button type="button" class="close" data-dismiss="alert" aria-label="Close">
             <span aria-hidden="true">&times;</span>
           </button></div>');
        redirect("Production/list");
    }

    public function editMaterial($id_material)
    {
        $data = array(
            "material_name" => $this->input->post('material_name'),
            "req_qty" => $this->input->post('req_qty'),
            "date" => $this->input->post('date'),
            "desc" => $this->input->post('desc'),
        );
        $this->Models->updateMaterial($data);
        $this->session->set_flashdata('message', '<div class="alert alert-success alert-dismissible fade show" role="alert">
            Update Material Successfully. 
             <button type="button" class="close" data-dismiss="alert" aria-label="Close">
             <span aria-hidden="true">&times;</span>
           </button></div>');
        redirect("Production/list");
    }

    public function deleteMaterial($id_material)
    {
        $this->Models->deleteMaterial($id_material);
        $this->session->set_flashdata('message', '<div class="alert alert-success alert-dismissible fade show" role="alert">
            Data User berhasil dihapus. 
        <button type="button" class="close" data-dismiss="alert" aria-label="Close">
            <span aria-hidden="true">&times;</span>
          </button></div>');
        redirect("Production/list");
    }

    public function item($id_material)
    {
        if ($this->session->userdata('role') != 'Production') {
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

    public function addItem($id_material)
    {
        $data = array(
            "item_name" => $this->input->post('item_name'),
            "qty_item" => $this->input->post('qty_item'),
            "id_material" => $id_material
        );
        $this->Models->saveItem($data);
        $this->session->set_flashdata('message', '<div class="alert alert-success alert-dismissible fade show" role="alert">
            Create Item Successfully. 
             <button type="button" class="close" data-dismiss="alert" aria-label="Close">
             <span aria-hidden="true">&times;</span>
           </button></div>');
        redirect("Production/item/" . $id_material);
    }

    public function editItem($id_item, $id_material)
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
        redirect("Production/item/" . $id_material);
    }

    public function deleteItem($id_item, $id_material)
    {
        $this->Models->deleteItem($id_item);
        $this->session->set_flashdata('message', '<div class="alert alert-success alert-dismissible fade show" role="alert">
            Item has been deleted. 
        <button type="button" class="close" data-dismiss="alert" aria-label="Close">
            <span aria-hidden="true">&times;</span>
          </button></div>');
        redirect("Production/item/" . $id_material);
    }

    public function submit($id_material)
    {
        $sql = "UPDATE material SET status = 'Waiting' WHERE id_material=$id_material";
        $this->db->query($sql);
        redirect(base_url('Production/list'));
    }

    public function history()
    {
        if ($this->session->userdata('role') != 'Production') {
            redirect(base_url('login/index'));
        } else {
            $filter = $this->input->post('filter');
            $dateFrom  = $this->input->post('dateFrom');
            $dateTo  = $this->input->post('dateTo');

            if (isset($filter)) {
                $data['data_history'] = $this->Models->getHistoryFilter($dateFrom, $dateTo);
            } else {
                $data['data_history'] = $this->Models->getHistory();
            }
            $data['title'] = 'History | Material Request';
            $this->load->view('templates/head', $data);
            $this->load->view('pages/history', $data);
        }
    }
}
