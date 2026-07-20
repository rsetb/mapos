<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Migration_add_acessorios_checklist_to_os_table extends CI_Migration
{
    public function up()
    {
        $this->dbforge->add_column('os', [
            'acessorios' => [
                'type' => 'VARCHAR',
                'constraint' => '100',
                'null' => true,
            ],
        ]);

        $this->dbforge->add_column('os', [
            'checklist' => [
                'type' => 'VARCHAR',
                'constraint' => '255',
                'null' => true,
            ],
        ]);
    }

    public function down()
    {
        $this->dbforge->drop_column('os', 'acessorios');
        $this->dbforge->drop_column('os', 'checklist');
    }
}
