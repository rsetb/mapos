<?php

if (! defined('BASEPATH')) {
    exit('No direct script access allowed');
}

class Equipamentos extends MY_Controller
{
    public function __construct()
    {
        parent::__construct();

        $this->load->model('equipamentos_model');
        $this->data['menuEquipamentos'] = 'equipamentos';
    }

    public function index()
    {
        $this->gerenciar();
    }

    public function gerenciar()
    {
        if (! $this->permission->checkPermission($this->session->userdata('permissao'), 'vEquipamento')) {
            $this->session->set_flashdata('error', 'Você não tem permissão para visualizar equipamentos.');
            redirect(base_url());
        }

        $pesquisa = $this->input->get('pesquisa');

        $this->load->library('pagination');

        $this->data['configuration']['base_url'] = site_url('equipamentos/gerenciar/');
        $this->data['configuration']['total_rows'] = $this->equipamentos_model->count('equipamentos', $pesquisa);
        if ($pesquisa) {
            $this->data['configuration']['suffix'] = "?pesquisa={$pesquisa}";
            $this->data['configuration']['first_url'] = base_url('index.php/equipamentos') . "?pesquisa={$pesquisa}";
        }

        $this->pagination->initialize($this->data['configuration']);

        $this->data['results'] = $this->equipamentos_model->get('equipamentos', 'equipamentos.*, clientes.nomeCliente', $pesquisa, $this->data['configuration']['per_page'], $this->uri->segment(3));

        $this->data['view'] = 'equipamentos/equipamentos';

        return $this->layout();
    }

    public function adicionar()
    {
        if (! $this->permission->checkPermission($this->session->userdata('permissao'), 'aEquipamento')) {
            $this->session->set_flashdata('error', 'Você não tem permissão para adicionar equipamentos.');
            redirect(base_url());
        }

        $this->load->library('form_validation');
        $this->data['custom_error'] = '';

        if ($this->form_validation->run('equipamentos') == false) {
            $this->data['custom_error'] = (validation_errors() ? '<div class="form_error">' . validation_errors() . '</div>' : false);
        } else {
            $data = [
                'clientes_id' => $this->input->post('clientes_id'),
                'equipamento' => $this->input->post('equipamento'),
                'marca' => $this->input->post('marca'),
                'modelo' => $this->input->post('modelo'),
                'serial' => $this->input->post('serial'),
                'acessorios' => $this->input->post('acessorios'),
                'checklist' => $this->input->post('checklist'),
                'dataCadastro' => date('Y-m-d'),
            ];

            if ($this->equipamentos_model->add('equipamentos', $data) !== false) {
                $this->session->set_flashdata('success', 'Equipamento adicionado com sucesso!');
                log_info('Adicionou um equipamento.');
                redirect(site_url('equipamentos/'));
            } else {
                $this->data['custom_error'] = '<div class="form_error"><p>Ocorreu um erro.</p></div>';
            }
        }

        $this->data['view'] = 'equipamentos/adicionarEquipamento';

        return $this->layout();
    }

    public function editar()
    {
        if (! $this->uri->segment(3) || ! is_numeric($this->uri->segment(3)) || ! $this->equipamentos_model->getById($this->uri->segment(3))) {
            $this->session->set_flashdata('error', 'Equipamento não encontrado ou parâmetro inválido.');
            redirect('equipamentos/gerenciar');
        }

        if (! $this->permission->checkPermission($this->session->userdata('permissao'), 'eEquipamento')) {
            $this->session->set_flashdata('error', 'Você não tem permissão para editar equipamentos.');
            redirect(base_url());
        }

        $this->load->library('form_validation');
        $this->data['custom_error'] = '';

        if ($this->form_validation->run('equipamentos') == false) {
            $this->data['custom_error'] = (validation_errors() ? '<div class="form_error">' . validation_errors() . '</div>' : false);
        } else {
            $data = [
                'clientes_id' => $this->input->post('clientes_id'),
                'equipamento' => $this->input->post('equipamento'),
                'marca' => $this->input->post('marca'),
                'modelo' => $this->input->post('modelo'),
                'serial' => $this->input->post('serial'),
                'acessorios' => $this->input->post('acessorios'),
                'checklist' => $this->input->post('checklist'),
            ];

            if ($this->equipamentos_model->edit('equipamentos', $data, 'idEquipamentos', $this->input->post('idEquipamentos')) == true) {
                $this->session->set_flashdata('success', 'Equipamento editado com sucesso!');
                log_info('Alterou um equipamento. ID' . $this->input->post('idEquipamentos'));
                redirect(site_url('equipamentos/editar/') . $this->input->post('idEquipamentos'));
            } else {
                $this->data['custom_error'] = '<div class="form_error"><p>Ocorreu um erro.</p></div>';
            }
        }

        $this->data['result'] = $this->equipamentos_model->getById($this->uri->segment(3));
        $this->data['view'] = 'equipamentos/editarEquipamento';

        return $this->layout();
    }

    public function excluir()
    {
        if (! $this->permission->checkPermission($this->session->userdata('permissao'), 'dEquipamento')) {
            $this->session->set_flashdata('error', 'Você não tem permissão para excluir equipamentos.');
            redirect(base_url());
        }

        $id = $this->input->post('id');
        if ($id == null) {
            $this->session->set_flashdata('error', 'Erro ao tentar excluir equipamento.');
            redirect(site_url('equipamentos/gerenciar/'));
        }

        $this->equipamentos_model->delete('equipamentos', 'idEquipamentos', $id);
        log_info('Removeu um equipamento. ID' . $id);

        $this->session->set_flashdata('success', 'Equipamento excluido com sucesso!');
        redirect(site_url('equipamentos/gerenciar/'));
    }
}
