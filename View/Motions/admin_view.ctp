<div id="MotionsAdminView">
    <h3><?php echo __('View Motions', true); ?></h3><hr />
    <div class="span12">

        <div class="span2">Sequence</div>
        <div class="span9">&nbsp;<?php
            if ($this->data['Motion']['sequence']) {

                echo $this->data['Motion']['sequence'];
            }
?>&nbsp;
        </div>
        <div class="span2">Type</div>
        <div class="span9">&nbsp;<?php
            if ($this->data['Motion']['type']) {

                echo $this->data['Motion']['type'];
            }
?>&nbsp;
        </div>
        <div class="span2">Group Type</div>
        <div class="span9">&nbsp;<?php
            if ($this->data['Motion']['group_type']) {

                echo $this->data['Motion']['group_type'];
            }
?>&nbsp;
        </div>
        <div class="span2">Number</div>
        <div class="span9">&nbsp;<?php
            if ($this->data['Motion']['number']) {

                echo $this->data['Motion']['number'];
            }
?>&nbsp;
        </div>
        <div class="span2">Source</div>
        <div class="span9">&nbsp;<?php
            if ($this->data['Motion']['source']) {

                echo $this->data['Motion']['source'];
            }
?>&nbsp;
        </div>
        <div class="span2">Requested Date</div>
        <div class="span9">&nbsp;<?php
            if ($this->data['Motion']['requested_date']) {

                echo $this->data['Motion']['requested_date'];
            }
?>&nbsp;
        </div>
        <div class="span2">Requested Number</div>
        <div class="span9">&nbsp;<?php
            if ($this->data['Motion']['requested_number']) {

                echo $this->data['Motion']['requested_number'];
            }
?>&nbsp;
        </div>
        <div class="span2">Requester</div>
        <div class="span9">&nbsp;<?php
            if ($this->data['Motion']['requester']) {

                echo $this->data['Motion']['requester'];
            }
?>&nbsp;
        </div>
        <div class="span2">Petition People</div>
        <div class="span9">&nbsp;<?php
            if ($this->data['Motion']['petition_people']) {

                echo $this->data['Motion']['petition_people'];
            }
?>&nbsp;
        </div>
        <div class="span2">Summary</div>
        <div class="span9">&nbsp;<?php
            if ($this->data['Motion']['summary']) {

                echo $this->data['Motion']['summary'];
            }
?>&nbsp;
        </div>
        <div class="span2">Description</div>
        <div class="span9">&nbsp;<?php
            if ($this->data['Motion']['description']) {

                echo $this->data['Motion']['description'];
            }
?>&nbsp;
        </div>
        <div class="span2">Rules</div>
        <div class="span9">&nbsp;<?php
            if ($this->data['Motion']['rules']) {

                echo $this->data['Motion']['rules'];
            }
?>&nbsp;
        </div>
        <div class="span2">Comments</div>
        <div class="span9">&nbsp;<?php
            if ($this->data['Motion']['comments']) {

                echo $this->data['Motion']['comments'];
            }
?>&nbsp;
        </div>
        <div class="span2">Result</div>
        <div class="span9">&nbsp;<?php
            if ($this->data['Motion']['result']) {

                echo $this->data['Motion']['result'];
            }
?>&nbsp;
        </div>
        <div class="span2">Status</div>
        <div class="span9">&nbsp;<?php
            if ($this->data['Motion']['status']) {

                echo $this->data['Motion']['status'];
            }
?>&nbsp;
        </div>
        <div class="span2">Result Date</div>
        <div class="span9">&nbsp;<?php
            if ($this->data['Motion']['result_date']) {

                echo $this->data['Motion']['result_date'];
            }
?>&nbsp;
        </div>
        <div class="span2">Posting Date</div>
        <div class="span9">&nbsp;<?php
            if ($this->data['Motion']['posting_date']) {

                echo $this->data['Motion']['posting_date'];
            }
?>&nbsp;
        </div>
        <div class="span2">Posting Number</div>
        <div class="span9">&nbsp;<?php
            if ($this->data['Motion']['posting_number']) {

                echo $this->data['Motion']['posting_number'];
            }
?>&nbsp;
        </div>
        <div class="span2">Attachments</div>
        <div class="span9">&nbsp;<?php
            if ($this->data['Motion']['attachments']) {

                echo $this->data['Motion']['attachments'];
            }
?>&nbsp;
        </div>
    </div>
    <hr />
    <div class="actions">
        <ul>
            <li><?php echo $this->Html->link(__('Delete', true), array('action' => 'delete', $this->Form->value('Motion.id')), null, __('Delete the item, sure?', true)); ?></li>
            <li><?php echo $this->Html->link(__('Motions List', true), array('action' => 'index')); ?> </li>
            <li><?php echo $this->Html->link(__('View Related Parliamentarians', true), array('controller' => 'parliamentarians', 'action' => 'index', 'Motion', $this->data['Motion']['id']), array('class' => 'MotionsAdminViewControl')); ?></li>
            <li><?php echo $this->Html->link(__('Set Related Parliamentarians', true), array('controller' => 'parliamentarians', 'action' => 'index', 'Motion', $this->data['Motion']['id'], 'set'), array('class' => 'MotionsAdminViewControl')); ?></li>
        </ul>
    </div>
    <div id="MotionsAdminViewPanel"></div>
<?php
echo $this->Html->scriptBlock('

');
?>
    <script type="text/javascript">
        //<![CDATA[
        $(function() {
            $('a.MotionsAdminViewControl').click(function() {
                $('#MotionsAdminViewPanel').parent().load(this.href);
                return false;
            });
        });
        //]]>
    </script>
</div>