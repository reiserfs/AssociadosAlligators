<?php
namespace App\Model\Entity;

use Cake\ORM\Entity;

/**
 * SquadAssociado Entity
 *
 * @property int $id
 * @property int $squad_id
 * @property int $posicao_id
 * @property int $associados_id
 *
 * @property \App\Model\Entity\Squad $squad
 * @property \App\Model\Entity\Posicao $posicao
 * @property \App\Model\Entity\Associado $associado
 */
class SquadAssociado extends Entity
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
        'id' => false
    ];
}
