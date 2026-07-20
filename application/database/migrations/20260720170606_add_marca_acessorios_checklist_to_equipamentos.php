<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Migration_add_marca_acessorios_checklist_to_equipamentos extends CI_Migration
{
    public function up()
    {
        $fields = $this->db->field_data('equipamentos');
        $existing = array_column($fields, 'name');

        if (! in_array('marca', $existing, true)) {
            $this->dbforge->add_column('equipamentos', [
                'marca' => [
                    'type' => 'VARCHAR',
                    'constraint' => 100,
                    'null' => true,
                ],
            ]);
        }

        if (! in_array('acessorios', $existing, true)) {
            $this->dbforge->add_column('equipamentos', [
                'acessorios' => [
                    'type' => 'VARCHAR',
                    'constraint' => 100,
                    'null' => true,
                ],
            ]);
        }

        if (! in_array('checklist', $existing, true)) {
            $this->dbforge->add_column('equipamentos', [
                'checklist' => [
                    'type' => 'VARCHAR',
                    'constraint' => 255,
                    'null' => true,
                ],
            ]);
        }

        if (! in_array('dataCadastro', $existing, true)) {
            $this->dbforge->add_column('equipamentos', [
                'dataCadastro' => [
                    'type' => 'DATE',
                    'null' => true,
                ],
            ]);
        }
    }

    public function down()
    {
        $fields = $this->db->field_data('equipamentos');
        $existing = array_column($fields, 'name');

        foreach (['marca', 'acessorios', 'checklist', 'dataCadastro'] as $column) {
            if (in_array($column, $existing, true)) {
                $this->dbforge->drop_column('equipamentos', $column);
            }
        }
    }
}
