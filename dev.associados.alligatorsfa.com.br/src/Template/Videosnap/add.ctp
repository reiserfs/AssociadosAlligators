<nav class="large-3 medium-4 columns" id="actions-sidebar">
    <ul class="side-nav">
        <li class="heading"><?= __('Actions') ?></li>
        <li><?= $this->Html->link(__('List Videosnap'), ['action' => 'index']) ?></li>
        <li><?= $this->Html->link(__('List Video'), ['controller' => 'Video', 'action' => 'index']) ?></li>
        <li><?= $this->Html->link(__('New Video'), ['controller' => 'Video', 'action' => 'add']) ?></li>
    </ul>
</nav>
<div class="videosnap form large-9 medium-8 columns content">
    <?= $this->Form->create($videosnap) ?>
    <fieldset>
        <legend><?= __('Add Videosnap') ?></legend>
        <?php
            echo $this->Form->input('video_id', ['options' => $video]);
            echo $this->Form->input('inicio');
            echo $this->Form->input('fim');
            echo $this->Form->input('casa');
            echo $this->Form->input('visitante');
            echo $this->Form->input('resultado');
            echo $this->Form->input('descricao');
        ?>
    </fieldset>
    <?= $this->Form->button(__('Submit')) ?>
    <?= $this->Form->end() ?>
</div>
