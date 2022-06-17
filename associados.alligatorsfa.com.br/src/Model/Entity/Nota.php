<?php
namespace App\Model\Entity;

use Cake\ORM\Entity;

/**
 * Nota Entity
 *
 * @property int $id
 * @property int $associado_id
 * @property \Cake\I18n\Time $data
 * @property int $login_id
 * @property string $tipo
 * @property string $nota
 *
 * @property \App\Model\Entity\Associado $associado
 * @property \App\Model\Entity\Login $login
 */
class Nota extends Entity
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
