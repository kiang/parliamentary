<div id="TermsAdminAdd">
    <?php echo $this->Form->create('Term', array('type' => 'file')); ?>
    <h3>Add Term</h3>
    <?php
    echo $this->Form->input('Term.id');
    echo $this->Form->input('Term.name', array(
        'label' => 'Name',
        'div' => 'control-group',
        'class' => 'controls',
    ));
    echo $this->Form->input('Term.is_active', array(
        'label' => 'Active?',
        'div' => 'control-group',
        'class' => 'controls',
    ));
    echo $this->Form->end(__('Submit', true));
    ?>
</div>