<?php
namespace App\Model\Table;

use App\Model\Entity\Video;
use Cake\ORM\Query;
use Cake\ORM\RulesChecker;
use Cake\ORM\Table;
use Cake\Validation\Validator;

/**
 * Video Model
 *
 * @property \Cake\ORM\Association\HasMany $Videosnap
 */
class VideoTable extends Table
{

    /**
     * Initialize method
     *
     * @param array $config The configuration for the Table.
     * @return void
     */
    public function initialize(array $config)
    {
        parent::initialize($config);

        $this->table('video');
        $this->displayField('id');
        $this->primaryKey('id');


	$this->belongsTo('OutrotimeCasa', [
		'foreignKey' => 'time_casa',
		'className' => 'Outrotime'
	]);

	$this->belongsTo('OutrotimeVisitante', [
		'foreignKey' => 'time_visitante',
		'className' => 'Outrotime'
	]);

        $this->hasMany('Videosnap', [
            'foreignKey' => 'video_id'
        ]);
    }

    /**
     * Default validation rules.
     *
     * @param \Cake\Validation\Validator $validator Validator instance.
     * @return \Cake\Validation\Validator
     */
    public function validationDefault(Validator $validator)
    {
        $validator
            ->integer('id')
            ->allowEmpty('id', 'create');

        $validator
            ->integer('time_casa')
            ->requirePresence('time_casa', 'create')
            ->notEmpty('time_casa');

        $validator
            ->integer('time_visitante')
            ->requirePresence('time_visitante', 'create')
            ->notEmpty('time_visitante');

        $validator
            ->requirePresence('cidade', 'create')
            ->notEmpty('cidade');

        $validator
            ->requirePresence('estado', 'create')
            ->notEmpty('estado');

        $validator
            ->date('data')
            ->requirePresence('data', 'create')
            ->notEmpty('data');

        $validator
            ->integer('placar_casa')
            ->requirePresence('placar_casa', 'create')
            ->notEmpty('placar_casa');

        $validator
            ->integer('placar_visitante')
            ->requirePresence('placar_visitante', 'create')
            ->notEmpty('placar_visitante');

        $validator
            ->requirePresence('youtube', 'create')
            ->notEmpty('youtube');

        return $validator;
    }
}
