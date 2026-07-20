<link rel="stylesheet" href="<?php echo base_url(); ?>assets/js/jquery-ui/css/smoothness/jquery-ui-1.9.2.custom.css" />
<script type="text/javascript" src="<?php echo base_url() ?>assets/js/jquery-ui/js/jquery-ui-1.9.2.custom.js"></script>
<script type="text/javascript" src="<?php echo base_url() ?>assets/js/jquery.validate.js"></script>

<div class="new122">
    <div class="widget-title" style="margin: -20px 0 0">
        <span class="icon">
            <i class="bx bx-devices"></i>
        </span>
        <h5>Editar Equipamento</h5>
    </div>
    <div class="span12" id="divEditarEquipamento">
        <?php if ($custom_error) { ?>
            <div class="span12" style="padding: 1%;"><?php echo $custom_error; ?></div>
        <?php } ?>
        <form action="<?php echo current_url(); ?>" method="post" id="formEquipamento">
            <input type="hidden" name="idEquipamentos" value="<?php echo $result->idEquipamentos ?>" />
            <div class="span12" style="padding: 1%; margin-left: 0">
                <div class="span6">
                    <label for="cliente">Cliente<span class="required">*</span></label>
                    <input id="cliente" class="span12" type="text" name="cliente" value="<?php echo $result->nomeCliente ?>" />
                    <input id="clientes_id" class="span12" type="hidden" name="clientes_id" value="<?php echo $result->clientes_id ?>" />
                </div>
            </div>
            <div class="span6" style="padding: 1%; margin-left: 0">
                <label for="equipamento">Equipamento<span class="required">*</span></label>
                <input class="span12" type="text" name="equipamento" id="equipamento" value="<?php echo $result->equipamento ?>" />
            </div>
            <div class="span6" style="padding: 1%; margin-left: 0">
                <label for="marca">Marca</label>
                <input class="span12" type="text" name="marca" id="marca" value="<?php echo $result->marca ?>" />
            </div>
            <div class="span6" style="padding: 1%; margin-left: 0">
                <label for="modelo">Modelo</label>
                <input class="span12" type="text" name="modelo" id="modelo" value="<?php echo $result->modelo ?>" />
            </div>
            <div class="span6" style="padding: 1%; margin-left: 0">
                <label for="serial">Serial</label>
                <input class="span12" type="text" name="serial" id="serial" value="<?php echo $result->num_serie ?>" />
            </div>
            <div class="span6" style="padding: 1%; margin-left: 0">
                <label for="acessorios">Acessórios</label>
                <input class="span12" type="text" name="acessorios" id="acessorios" value="<?php echo $result->acessorios ?>" />
            </div>
            <div class="span6" style="padding: 1%; margin-left: 0">
                <label for="checklist">Checklist</label>
                <input class="span12" type="text" name="checklist" id="checklist" value="<?php echo $result->checklist ?>" />
            </div>
            <div class="span12" style="padding: 1%; margin-left: 0">
                <div class="span12" style="display:flex; justify-content: center;">
                    <button class="button btn btn-success" id="btnSalvar">
                        <span class="button__icon"><i class='bx bx-save'></i></span><span class="button__text2">Salvar</span></button>
                    <a href="<?php echo base_url() ?>index.php/equipamentos" class="button btn btn-mini btn-warning" style="max-width: 160px">
                        <span class="button__icon"><i class="bx bx-undo"></i></span><span class="button__text2">Voltar</span></a>
                </div>
            </div>
        </form>
    </div>
</div>
<script type="text/javascript">
    $(document).ready(function() {
        $("#cliente").autocomplete({
            source: "<?php echo base_url(); ?>index.php/os/autoCompleteCliente",
            minLength: 1,
            select: function(event, ui) {
                $("#clientes_id").val(ui.item.id);
                $("#cliente").val(ui.item.value);
                return false;
            }
        });

        $("#formEquipamento").validate({
            rules: {
                cliente: {
                    required: true
                },
                equipamento: {
                    required: true
                }
            },
            messages: {
                cliente: {
                    required: 'Campo Requerido.'
                },
                equipamento: {
                    required: 'Campo Requerido.'
                }
            }
        });
    });
</script>
