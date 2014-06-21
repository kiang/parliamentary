<div class="Parties form">
    <fieldset>
         <legend><?php
         if($id > 0) {
             echo __('Edit Parties', true);
         } else {
             echo __('Add Parties', true);
         }
         ?></legend>
    <?php
    if($id > 0) {
        echo $this->Form->input('Party.id');
    }





    echo $this->Form->input('Party.name', array(
        'label' => 'Name',
        'div' => 'control-group',
        'class' => 'controls',
    ));



?>
</fieldset>
</div>