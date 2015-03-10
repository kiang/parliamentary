<div class="Grants form">
    <fieldset>
         <legend><?php
         if($id > 0) {
             echo __('Edit Grants', true);
         } else {
             echo __('Add Grants', true);
         }
         ?></legend>
    <?php
    if($id > 0) {
        echo $this->Form->input('Grant.id');
    }





    echo $this->Form->input('Grant.sequence', array(
        'label' => 'Sequence',
        'div' => 'control-group',
        'class' => 'controls',
    ));



    echo $this->Form->input('Grant.type', array(
        'label' => 'Type',
        'div' => 'control-group',
        'class' => 'controls',
    ));



    echo $this->Form->input('Grant.group_type', array(
        'label' => 'Group Type',
        'div' => 'control-group',
        'class' => 'controls',
    ));



    echo $this->Form->input('Grant.number', array(
        'label' => 'Number',
        'div' => 'control-group',
        'class' => 'controls',
    ));



    echo $this->Form->input('Grant.source', array(
        'label' => 'Source',
        'div' => 'control-group',
        'class' => 'controls',
    ));



    echo $this->Form->input('Grant.requested_date', array(
        'label' => 'Requested Date',
        'div' => 'control-group',
        'class' => 'controls',
    ));



    echo $this->Form->input('Grant.requested_number', array(
        'label' => 'Requested Number',
        'div' => 'control-group',
        'class' => 'controls',
    ));



    echo $this->Form->input('Grant.requester', array(
        'rows' => '2',
        'cols' => '',
        'label' => 'Requester',
        'div' => 'control-group',
        'class' => 'controls',
    ));



    echo $this->Form->input('Grant.petition_people', array(
        'rows' => '2',
        'cols' => '',
        'label' => 'Petition People',
        'div' => 'control-group',
        'class' => 'controls',
    ));



    echo $this->Form->input('Grant.summary', array(
        'rows' => '2',
        'cols' => '',
        'label' => 'Summary',
        'div' => 'control-group',
        'class' => 'controls',
    ));



    echo $this->Form->input('Grant.description', array(
        'rows' => '5',
        'cols' => '',
        'label' => 'Description',
        'div' => 'control-group',
        'class' => 'controls',
    ));



    echo $this->Form->input('Grant.rules', array(
        'label' => 'Rules',
        'div' => 'control-group',
        'class' => 'controls',
    ));



    echo $this->Form->input('Grant.comments', array(
        'label' => 'Comments',
        'div' => 'control-group',
        'class' => 'controls',
    ));



    echo $this->Form->input('Grant.result', array(
        'rows' => '1',
        'cols' => '',
        'label' => 'Result',
        'div' => 'control-group',
        'class' => 'controls',
    ));



    echo $this->Form->input('Grant.status', array(
        'label' => 'Status',
        'div' => 'control-group',
        'class' => 'controls',
    ));



    echo $this->Form->input('Grant.result_date', array(
        'label' => 'Result Date',
        'div' => 'control-group',
        'class' => 'controls',
    ));



    echo $this->Form->input('Grant.posting_date', array(
        'label' => 'Posting Date',
        'div' => 'control-group',
        'class' => 'controls',
    ));



    echo $this->Form->input('Grant.posting_number', array(
        'label' => 'Posting Number',
        'div' => 'control-group',
        'class' => 'controls',
    ));



    echo $this->Form->input('Grant.attachments', array(
        'label' => 'Attachments',
        'div' => 'control-group',
        'class' => 'controls',
    ));



?>
</fieldset>
</div>