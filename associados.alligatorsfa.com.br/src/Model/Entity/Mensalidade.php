<?php
namespace App\Model\Entity;

use Cake\ORM\Entity;

/**
 * Mensalidade Entity.
 *
 * @property int $id
 * @property int $associado_id
 * @property \App\Model\Entity\Associado $associado
 * @property \Cake\I18n\Time $vencimento
 * @property \Cake\I18n\Time $pago
 * @property float $valor_base
 * @property float $desconto
 * @property float $acressimo
 * @property int $pagamento_id
 * @property \App\Model\Entity\Pagamento $pagamento
 * @property string $observacoes
 */
class Mensalidade extends Entity
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
