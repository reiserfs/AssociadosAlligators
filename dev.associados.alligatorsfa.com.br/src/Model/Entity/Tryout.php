<?php
namespace App\Model\Entity;

use Cake\ORM\Entity;

/**
 * Tryout Entity.
 *
 * @property int $id
 * @property string $nome
 * @property string $sobrenome
 * @property \Cake\I18n\Time $nascimento
 * @property string $email
 * @property string $pai
 * @property string $mae
 * @property string $naturalidade
 * @property string $nacionalidade
 * @property string $profissao
 * @property string $escolaridade
 * @property string $superior
 * @property string $endereco
 * @property string $cidade
 * @property string $estado
 * @property string $bairro
 * @property int $rg
 * @property string $rg_emissor
 * @property string $cpf
 * @property string $fixo
 * @property string $celular
 * @property string $altura
 * @property string $peso
 * @property string $sangue
 * @property string $apelido
 * @property string $sexo
 * @property int $numero
 * @property int $cep
 * @property int $time_id
 * @property \App\Model\Entity\Time $time
 * @property \Cake\I18n\Time $data_acesso
 * @property string|resource $foto
 * @property int $foto_size
 * @property string $foto_type
 */
class Tryout extends Entity
{

    /**
     * Fields that can be mass assigned using newEntity() or patchEntity().
     *
     * Note that when '*' is set to true, this allows all unspecified fields to
     * be mass assigned. For security purposes, it is advised to set '*' to false
     * (or remove it), and explicitly make individual fields accessible as needed.
     *
     * @var array
     */
    protected $_accessible = [
        '*' => true,
        'id' => false,
    ];
}
