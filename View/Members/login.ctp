<div class="container">
    <div class="row"><?php
        echo $this->Form->create('Member', array('action' => 'login'));
        echo $this->Form->input('username', array(
            'type' => 'text',
            'div' => 'form-group',
            'class' => 'form-control',
        ));
        echo $this->Form->input('password', array(
            'type' => 'password',
            'div' => 'form-group',
            'class' => 'form-control',  
        ));
        echo $this->Form->submit(__('Login', true), array('class' => 'btn btn-primary'));
        echo $this->Form->end();
        ?></div>
</div>
