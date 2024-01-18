<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Models extends CI_Model
{
    public function getMaterialList()
    {
        $this->db->select('*');
        $this->db->from('material');
        $this->db->where_in('status', ['Entry','Waiting']);
        $query = $this->db->get();
        return $query->result();
    }

    public function getMaterialListFilter($dateFrom, $dateTo)
    {
        $this->db->select('*');
        $this->db->from('material');
        $this->db->where_in('status', ['Entry','Waiting']);
        $this->db->where('date >=', $dateFrom);
        $this->db->where('date <=', $dateTo);
        $query = $this->db->get();
        return $query->result();
    }

    public function getMaterialListWarehouse()
    {
        $this->db->select('*');
        $this->db->from('material');
        $this->db->where('status', 'Waiting');
        $query = $this->db->get();
        return $query->result();
    }

    public function getHistory()
    {
        $this->db->select('*');
        $this->db->from('material');
        $this->db->where_in('status', ['Approved','Rejected']);
        $query = $this->db->get();
        return $query->result();
    }

    public function getHistoryFilter($dateFrom, $dateTo)
    {
        $this->db->select('*');
        $this->db->from('material');
        $this->db->where_in('status', ['Approved','Rejected']);
        $this->db->where('date >=', $dateFrom);
        $this->db->where('date <=', $dateTo);
        $query = $this->db->get();
        return $query->result();
    }

    public function saveMaterial($data)
    {
        $this->db->insert('material', $data);
        return TRUE;
    }

    public function updateMaterial($data)
    {
        return $this->db->update('material', $data, array('id_material' => $this->input->post('id_material')));
    }

    public function deleteMaterial($id)
    {
        return $this->db->delete('material', array("id_material" => $id));
    }

    public function getMaterial($id_material)
    {
        $this->db->select('*');
        $this->db->from('material');
        $this->db->where('id_material', $id_material);
        $query = $this->db->get();
        return $query->result();
    }
    
    public function getMaterialItem($id_material)
    {
        $this->db->select('*');
        $this->db->from('item');
        $this->db->join('material', 'material.id_material = item.id_material');
        $this->db->where('item.id_material', $id_material);
        $query = $this->db->get();
        return $query->result();
    }

    public function saveItem($data)
    {
        $this->db->insert('item', $data);
        return TRUE;
    }

    public function updateItem($data)
    {
        return $this->db->update('item', $data, array('id_item' => $this->input->post('id_item')));
    }

    public function deleteItem($id)
    {
        return $this->db->delete('item', array("id_item" => $id));
    }
}