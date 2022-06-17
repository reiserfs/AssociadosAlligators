<?php
namespace App\Model\Entity;

use Cake\ORM\Entity;

/**
 * Equipatemp Entity.
 *
 * @property int $id
 * @property string $tipo
 * @property string $marca
 * @property string $modelo
 * @property string $descricao
 * @property string $cor
 * @property string|resource $foto
 * @property int $foto_size
 * @property string $foto_type
 */
class Equipatemp extends Entity
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
