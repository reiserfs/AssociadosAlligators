<?php $this->extend('/Comum/perfil'); ?>
<div class="associados view large-9 medium-8 columns content">
    <h3><?= h($associado->id) ?></h3>
    <table class="horizontal-table">
        <tr>
            <th><?= __('Nome') ?></th>
            <td><?= h($associado->nome) ?></td>
        </tr>
        <tr>
            <th><?= __('Sobrenome') ?></th>
            <td><?= h($associado->sobrenome) ?></td>
        </tr>
        <tr>
            <th><?= __('Email') ?></th>
            <td><?= h($associado->email) ?></td>
        </tr>
        <tr>
            <th><?= __('Pai') ?></th>
            <td><?= h($associado->pai) ?></td>
        </tr>
        <tr>
            <th><?= __('Mae') ?></th>
            <td><?= h($associado->mae) ?></td>
        </tr>
        <tr>
            <th><?= __('Naturalidade') ?></th>
            <td><?= h($associado->naturalidade) ?></td>
        </tr>
        <tr>
            <th><?= __('Nacionalidade') ?></th>
            <td><?= h($associado->nacionalidade) ?></td>
        </tr>
        <tr>
            <th><?= __('Profissao') ?></th>
            <td><?= h($associado->profissao) ?></td>
        </tr>
        <tr>
            <th><?= __('Escolaridade') ?></th>
            <td><?= h($associado->escolaridade) ?></td>
        </tr>
        <tr>
            <th><?= __('Superior') ?></th>
            <td><?= h($associado->superior) ?></td>
        </tr>
        <tr>
            <th><?= __('Endereco') ?></th>
            <td><?= h($associado->endereco) ?></td>
        </tr>
        <tr>
            <th><?= __('Cidade') ?></th>
            <td><?= h($associado->cidade) ?></td>
        </tr>
        <tr>
            <th><?= __('Estado') ?></th>
            <td><?= h($associado->estado) ?></td>
        </tr>
        <tr>
            <th><?= __('Bairro') ?></th>
            <td><?= h($associado->bairro) ?></td>
        </tr>
        <tr>
            <th><?= __('Rg Emissor') ?></th>
            <td><?= h($associado->rg_emissor) ?></td>
        </tr>
        <tr>
            <th><?= __('Cpf') ?></th>
            <td><?= h($associado->cpf) ?></td>
        </tr>
        <tr>
            <th><?= __('Fixo') ?></th>
            <td><?= h($associado->fixo) ?></td>
        </tr>
        <tr>
            <th><?= __('Celular') ?></th>
            <td><?= h($associado->celular) ?></td>
        </tr>
        <tr>
            <th><?= __('Altura') ?></th>
            <td><?= h($associado->altura) ?></td>
        </tr>
        <tr>
            <th><?= __('Peso') ?></th>
            <td><?= h($associado->peso) ?></td>
        </tr>
        <tr>
            <th><?= __('Sangue') ?></th>
            <td><?= h($associado->sangue) ?></td>
        </tr>
        <tr>
            <th><?= __('Apelido') ?></th>
            <td><?= h($associado->apelido) ?></td>
        </tr>
        <tr>
            <th><?= __('Id') ?></th>
            <td><?= $this->Number->format($associado->id) ?></td>
        </tr>
        <tr>
            <th><?= __('Rg') ?></th>
            <td><?= $this->Number->format($associado->rg) ?></td>
        </tr>
        <tr>
            <th><?= __('Cep') ?></th>
            <td><?= $this->Number->format($associado->cep) ?></td>
        </tr>
        <tr>
            <th><?= __('Time') ?></th>
            <td><?= $associado->has('time') ? $this->Html->link($associado->time->nome, ['controller' => 'Time', 'action' => 'view', $associado->time->id]) : '' ?></td>
        </tr>
        <tr>
            <th><?= __('Nascimento') ?></th>
            <td><?= h($associado->nascimento) ?></td>
        </tr>
        <tr>
            <th><?= __('Data Acesso') ?></th>
            <td><?= h($associado->data_acesso) ?></td>
        </tr>
    </table>
</div>
