<?php

class Equipamentos_model extends CI_Model
{
    public function __construct()
    {
        parent::__construct();
    }

    public function get($table, $fields, $where = '', $perpage = 0, $start = 0)
    {
        $this->db->select($fields);
        $this->db->from($table);
        $this->db->join('clientes', 'clientes.idClientes = equipamentos.clientes_id');
        $this->db->order_by('idEquipamentos', 'desc');
        $this->db->limit($perpage, $start);
        if ($where) {
            $this->db->group_start();
            $this->db->like('equipamento', $where);
            $this->db->or_like('marca', $where);
            $this->db->or_like('modelo', $where);
            $this->db->or_like('serial', $where);
            $this->db->or_like('clientes.nomeCliente', $where);
            $this->db->group_end();
        }

        return $this->db->get()->result();
    }

    public function count($table, $where = '')
    {
        $this->db->from($table);
        $this->db->join('clientes', 'clientes.idClientes = equipamentos.clientes_id');
        if ($where) {
            $this->db->group_start();
            $this->db->like('equipamento', $where);
            $this->db->or_like('marca', $where);
            $this->db->or_like('modelo', $where);
            $this->db->or_like('serial', $where);
            $this->db->or_like('clientes.nomeCliente', $where);
            $this->db->group_end();
        }

        return $this->db->count_all_results();
    }

    public function getById($id)
    {
        $this->db->select('equipamentos.*, clientes.nomeCliente');
        $this->db->from('equipamentos');
        $this->db->join('clientes', 'clientes.idClientes = equipamentos.clientes_id');
        $this->db->where('idEquipamentos', $id);
        $this->db->limit(1);

        return $this->db->get()->row();
    }

    public function getByCliente($clientesId)
    {
        $this->db->where('clientes_id', $clientesId);
        $this->db->order_by('idEquipamentos', 'desc');

        return $this->db->get('equipamentos')->result();
    }

    public function findByClienteSerial($clientesId, $serial)
    {
        $this->db->where('clientes_id', $clientesId);
        $this->db->where('serial', $serial);
        $this->db->limit(1);

        return $this->db->get('equipamentos')->row();
    }

    public function add($table, $data)
    {
        $this->db->insert($table, $data);
        if ($this->db->affected_rows() == '1') {
            return $this->db->insert_id($table);
        }

        return false;
    }

    public function edit($table, $data, $fieldID, $ID)
    {
        $this->db->where($fieldID, $ID);
        $this->db->update($table, $data);

        return $this->db->affected_rows() >= 0;
    }

    public function delete($table, $fieldID, $ID)
    {
        $this->db->where($fieldID, $ID);
        $this->db->delete($table);

        return $this->db->affected_rows() >= 0;
    }
}
