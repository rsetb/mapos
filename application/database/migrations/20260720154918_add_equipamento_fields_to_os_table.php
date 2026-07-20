<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Migration_add_equipamento_fields_to_os_table extends CI_Migration
{
    public function up()
    {
        $this->dbforge->add_column('os', [
            'equipamento' => [
                'type' => 'VARCHAR',
                'constraint' => '100',
                'null' => true,
            ],
        ]);

        $this->dbforge->add_column('os', [
            'marca' => [
                'type' => 'VARCHAR',
                'constraint' => '100',
                'null' => true,
            ],
        ]);

        $this->dbforge->add_column('os', [
            'modelo' => [
                'type' => 'VARCHAR',
                'constraint' => '100',
                'null' => true,
            ],
        ]);

        $this->dbforge->add_column('os', [
            'serial' => [
                'type' => 'VARCHAR',
                'constraint' => '100',
                'null' => true,
            ],
        ]);
    }

    public function down()
    {
        $this->dbforge->drop_column('os', 'equipamento');
        $this->dbforge->drop_column('os', 'marca');
        $this->dbforge->drop_column('os', 'modelo');
        $this->dbforge->drop_column('os', 'serial');
    }
}
