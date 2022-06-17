<?php
namespace App\Model\Entity;

use Cake\ORM\Entity;

/**
 * Video Entity.
 *
 * @property int $id
 * @property int $time_casa
 * @property int $time_visitante
 * @property string $cidade
 * @property string $estado
 * @property \Cake\I18n\Time $data
 * @property int $placar_casa
 * @property int $placar_visitante
 * @property string $youtube
 * @property \App\Model\Entity\Videosnap[] $videosnap
 */
class Video extends Entity
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
