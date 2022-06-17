<?php
namespace App\Model\Entity;

use Cake\ORM\Entity;

/**
 * Videosnap Entity.
 *
 * @property int $id
 * @property int $video_id
 * @property \App\Model\Entity\Video $video
 * @property float $inicio
 * @property float $fim
 * @property string $casa
 * @property string $visitante
 * @property string $resultado
 * @property string $descricao
 */
class Videosnap extends Entity
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
