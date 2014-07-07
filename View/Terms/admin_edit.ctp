<div id="TermsAdminEdit">
    <?php echo $this->Form->create('Term', array('type' => 'file', 'class' => 'form-inline')); ?>
    <h3>Edit Term</h3>
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