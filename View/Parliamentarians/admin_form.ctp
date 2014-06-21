<div class="Parliamentarians form">
    <fieldset>
         <legend><?php
         if($id > 0) {
             echo __('Edit Parliamentarians', true);
         } else {
             echo __('Add Parliamentarians', true);
         }
         ?></legend>
    <?php
    if($id > 0) {
        echo $this->Form->input('Parliamentarian.id');
    }
    foreach($belongsToModels AS $key => $model) {
        echo $this->Form->input('Parliamentarian.' . $model['foreignKey'], array(
        	'type' => 'select',
        	'label' => $model['label'],
            'options' => $$key,
        	'div' => 'control-group',
        	'class' => 'controls',
        ));
    }





    echo $this->Form->input('Parliamentarian.name', array(
        'label' => 'Name',
        'div' => 'control-group',
        'class' => 'controls',
    ));



    echo $this->Form->input('Parliamentarian.district', array(
        'label' => 'District',
        'div' => 'control-group',
        'class' => 'controls',
    ));



    echo $this->Form->input('Parliamentarian.contacts_phone', array(
        'label' => 'Phone',
        'div' => 'control-group',
        'class' => 'controls',
    ));



    echo $this->Form->input('Parliamentarian.contacts_fax', array(
        'label' => 'Fax',
        'div' => 'control-group',
        'class' => 'controls',
    ));



    echo $this->Form->input('Parliamentarian.contacts_email', array(
        'label' => 'Email',
        'div' => 'control-group',
        'class' => 'controls',
    ));



    echo $this->Form->input('Parliamentarian.contacts_address', array(
        'label' => 'Address',
        'div' => 'control-group',
        'class' => 'controls',
    ));



    echo $this->Form->input('Parliamentarian.links_council', array(
        'label' => 'Council Link',
        'div' => 'control-group',
        'class' => 'controls',
    ));



    echo $this->Form->input('Parliamentarian.gender', array(
        'label' => 'Gender',
        'div' => 'control-group',
        'class' => 'controls',
    ));



    echo $this->Form->input('Parliamentarian.image_url', array(
        'label' => 'Image Url',
        'div' => 'control-group',
        'class' => 'controls',
    ));



    echo $this->Form->input('Parliamentarian.experience', array(
        'rows' => '5',
        'cols' => '',
        'label' => 'Experience',
        'div' => 'control-group',
        'class' => 'controls',
    ));



    echo $this->Form->input('Parliamentarian.platform', array(
        'rows' => '5',
        'cols' => '',
        'label' => 'Platform',
        'div' => 'control-group',
        'class' => 'controls',
    ));



    echo $this->Form->input('Parliamentarian.birth', array(
        'label' => 'Birthday',
        'div' => 'control-group',
        'class' => 'controls',
    ));



    echo $this->Form->input('Parliamentarian.party', array(
        'label' => 'Party',
        'div' => 'control-group',
        'class' => 'controls',
    ));



    echo $this->Form->input('Parliamentarian.constituency', array(
        'label' => 'Constituency',
        'div' => 'control-group',
        'class' => 'controls',
    ));



    echo $this->Form->input('Parliamentarian.education', array(
        'rows' => '5',
        'cols' => '',
        'label' => 'Education',
        'div' => 'control-group',
        'class' => 'controls',
    ));



    echo $this->Form->input('Parliamentarian.group', array(
        'label' => 'Group',
        'div' => 'control-group',
        'class' => 'controls',
    ));



    echo $this->Form->input('Parliamentarian.ad', array(
        'label' => 'Ad',
        'div' => 'control-group',
        'class' => 'controls',
    ));



?>
</fieldset>
</div>