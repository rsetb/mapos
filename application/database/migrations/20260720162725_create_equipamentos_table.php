<?php

class Migration_create_equipamentos_table extends CI_Migration
{
    public function up()
    {
        $this->dbforge->add_field([
            'idEquipamentos' => [
                'type' => 'INT',
                'constraint' => 11,
                'null' => false,
                'auto_increment' => true,
            ],
            'clientes_id' => [
                'type' => 'INT',
                'constraint' => 11,
                'null' => false,
            ],
            'equipamento' => [
                'type' => 'VARCHAR',
                'constraint' => 100,
                'null' => true,
            ],
            'marca' => [
                'type' => 'VARCHAR',
                'constraint' => 100,
                'null' => true,
            ],
            'modelo' => [
                'type' => 'VARCHAR',
                'constraint' => 100,
                'null' => true,
            ],
            'serial' => [
                'type' => 'VARCHAR',
                'constraint' => 100,
                'null' => true,
            ],
            'acessorios' => [
                'type' => 'VARCHAR',
                'constraint' => 100,
                'null' => true,
            ],
            'checklist' => [
                'type' => 'VARCHAR',
                'constraint' => 255,
                'null' => true,
            ],
            'dataCadastro' => [
                'type' => 'DATE',
                'null' => true,
            ],
        ]);
        $this->dbforge->add_key('idEquipamentos', true);
        $this->dbforge->create_table('equipamentos', true);

        $this->db->query('ALTER TABLE `equipamentos` ADD INDEX `fk_equipamentos_clientes1` (`clientes_id` ASC)');
        $this->db->query('ALTER TABLE `equipamentos` ADD CONSTRAINT `fk_equipamentos_clientes1`
            FOREIGN KEY (`clientes_id`)
            REFERENCES `clientes` (`idClientes`)
            ON DELETE CASCADE
            ON UPDATE NO ACTION
        ');
        $this->db->query('ALTER TABLE `equipamentos` ENGINE = InnoDB');

        $this->dbforge->add_column('os', [
            'equipamentos_id' => [
                'type' => 'INT',
                'constraint' => 11,
                'null' => true,
            ],
        ]);
    }

    public function down()
    {
        $this->dbforge->drop_column('os', 'equipamentos_id');
        $this->dbforge->drop_table('equipamentos');
    }
}
