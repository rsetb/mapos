<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Migration_add_equipamento_permissions extends CI_Migration
{
    public function up()
    {
        $rows = $this->db->get('permissoes')->result();

        foreach ($rows as $row) {
            $permissoes = json_decode_legacy($row->permissoes);
            if (! is_array($permissoes)) {
                continue;
            }

            $permissoes['aEquipamento'] = '1';
            $permissoes['eEquipamento'] = '1';
            $permissoes['dEquipamento'] = '1';
            $permissoes['vEquipamento'] = '1';

            $this->db->where('idPermissao', $row->idPermissao);
            $this->db->update('permissoes', ['permissoes' => json_encode($permissoes)]);
        }
    }

    public function down()
    {
        $rows = $this->db->get('permissoes')->result();

        foreach ($rows as $row) {
            $permissoes = json_decode_legacy($row->permissoes);
            if (! is_array($permissoes)) {
                continue;
            }

            unset($permissoes['aEquipamento'], $permissoes['eEquipamento'], $permissoes['dEquipamento'], $permissoes['vEquipamento']);

            $this->db->where('idPermissao', $row->idPermissao);
            $this->db->update('permissoes', ['permissoes' => json_encode($permissoes)]);
        }
    }
}
