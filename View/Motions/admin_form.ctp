<div class="Motions form">
    <fieldset>
         <legend><?php
         if($id > 0) {
             echo __('Edit Motions', true);
         } else {
             echo __('Add Motions', true);
         }
         ?></legend>
    <?php
    if($id > 0) {
        echo $this->Form->input('Motion.id');
    }





    echo $this->Form->input('Motion.sequence', array(
        'label' => 'Sequence',
        'div' => 'control-group',
        'class' => 'controls',
    ));



    echo $this->Form->input('Motion.type', array(
        'label' => 'Type',
        'div' => 'control-group',
        'class' => 'controls',
    ));



    echo $this->Form->input('Motion.group_type', array(
        'label' => 'Group Type',
        'div' => 'control-group',
        'class' => 'controls',
    ));



    echo $this->Form->input('Motion.number', array(
        'label' => 'Number',
        'div' => 'control-group',
        'class' => 'controls',
    ));



    echo $this->Form->input('Motion.source', array(
        'label' => 'Source',
        'div' => 'control-group',
        'class' => 'controls',
    ));



    echo $this->Form->input('Motion.requested_date', array(
        'label' => 'Requested Date',
        'div' => 'control-group',
        'class' => 'controls',
    ));



    echo $this->Form->input('Motion.requested_number', array(
        'label' => 'Requested Number',
        'div' => 'control-group',
        'class' => 'controls',
    ));



    echo $this->Form->input('Motion.requester', array(
        'rows' => '2',
        'cols' => '',
        'label' => 'Requester',
        'div' => 'control-group',
        'class' => 'controls',
    ));



    echo $this->Form->input('Motion.petition_people', array(
        'rows' => '2',
        'cols' => '',
        'label' => 'Petition People',
        'div' => 'control-group',
        'class' => 'controls',
    ));



    echo $this->Form->input('Motion.summary', array(
        'rows' => '2',
        'cols' => '',
        'label' => 'Summary',
        'div' => 'control-group',
        'class' => 'controls',
    ));



    echo $this->Form->input('Motion.description', array(
        'rows' => '5',
        'cols' => '',
        'label' => 'Description',
        'div' => 'control-group',
        'class' => 'controls',
    ));



    echo $this->Form->input('Motion.rules', array(
        'label' => 'Rules',
        'div' => 'control-group',
        'class' => 'controls',
    ));



    echo $this->Form->input('Motion.comments', array(
        'label' => 'Comments',
        'div' => 'control-group',
        'class' => 'controls',
    ));



    echo $this->Form->input('Motion.result', array(
        'rows' => '1',
        'cols' => '',
        'label' => 'Result',
        'div' => 'control-group',
        'class' => 'controls',
    ));



    echo $this->Form->input('Motion.status', array(
        'label' => 'Status',
        'div' => 'control-group',
        'class' => 'controls',
    ));



    echo $this->Form->input('Motion.result_date', array(
        'label' => 'Result Date',
        'div' => 'control-group',
        'class' => 'controls',
    ));



    echo $this->Form->input('Motion.posting_date', array(
        'label' => 'Posting Date',
        'div' => 'control-group',
        'class' => 'controls',
    ));



    echo $this->Form->input('Motion.posting_number', array(
        'label' => 'Posting Number',
        'div' => 'control-group',
        'class' => 'controls',
    ));



    echo $this->Form->input('Motion.attachments', array(
        'label' => 'Attachments',
        'div' => 'control-group',
        'class' => 'controls',
    ));



?>
</fieldset>
</div>