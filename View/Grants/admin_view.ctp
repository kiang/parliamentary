<div id="GrantsAdminView">
    <h3><?php echo __('View Grants', true); ?></h3><hr />
    <div class="col-sm-12">

        <div class="col-sm-2">Sequence</div>
        <div class="col-sm-9">&nbsp;<?php
            if ($this->data['Grant']['sequence']) {

                echo $this->data['Grant']['sequence'];
            }
?>&nbsp;
        </div>
        <div class="col-sm-2">Type</div>
        <div class="col-sm-9">&nbsp;<?php
            if ($this->data['Grant']['type']) {

                echo $this->data['Grant']['type'];
            }
?>&nbsp;
        </div>
        <div class="col-sm-2">Group Type</div>
        <div class="col-sm-9">&nbsp;<?php
            if ($this->data['Grant']['group_type']) {

                echo $this->data['Grant']['group_type'];
            }
?>&nbsp;
        </div>
        <div class="col-sm-2">Number</div>
        <div class="col-sm-9">&nbsp;<?php
            if ($this->data['Grant']['number']) {

                echo $this->data['Grant']['number'];
            }
?>&nbsp;
        </div>
        <div class="col-sm-2">Source</div>
        <div class="col-sm-9">&nbsp;<?php
            if ($this->data['Grant']['source']) {

                echo $this->data['Grant']['source'];
            }
?>&nbsp;
        </div>
        <div class="col-sm-2">Requested Date</div>
        <div class="col-sm-9">&nbsp;<?php
            if ($this->data['Grant']['requested_date']) {

                echo $this->data['Grant']['requested_date'];
            }
?>&nbsp;
        </div>
        <div class="col-sm-2">Requested Number</div>
        <div class="col-sm-9">&nbsp;<?php
            if ($this->data['Grant']['requested_number']) {

                echo $this->data['Grant']['requested_number'];
            }
?>&nbsp;
        </div>
        <div class="col-sm-2">Requester</div>
        <div class="col-sm-9">&nbsp;<?php
            if ($this->data['Grant']['requester']) {

                echo $this->data['Grant']['requester'];
            }
?>&nbsp;
        </div>
        <div class="col-sm-2">Petition People</div>
        <div class="col-sm-9">&nbsp;<?php
            if ($this->data['Grant']['petition_people']) {

                echo $this->data['Grant']['petition_people'];
            }
?>&nbsp;
        </div>
        <div class="col-sm-2">Summary</div>
        <div class="col-sm-9">&nbsp;<?php
            if ($this->data['Grant']['summary']) {

                echo $this->data['Grant']['summary'];
            }
?>&nbsp;
        </div>
        <div class="col-sm-2">Description</div>
        <div class="col-sm-9">&nbsp;<?php
            if ($this->data['Grant']['description']) {

                echo $this->data['Grant']['description'];
            }
?>&nbsp;
        </div>
        <div class="col-sm-2">Rules</div>
        <div class="col-sm-9">&nbsp;<?php
            if ($this->data['Grant']['rules']) {

                echo $this->data['Grant']['rules'];
            }
?>&nbsp;
        </div>
        <div class="col-sm-2">Comments</div>
        <div class="col-sm-9">&nbsp;<?php
            if ($this->data['Grant']['comments']) {

                echo $this->data['Grant']['comments'];
            }
?>&nbsp;
        </div>
        <div class="col-sm-2">Result</div>
        <div class="col-sm-9">&nbsp;<?php
            if ($this->data['Grant']['result']) {

                echo $this->data['Grant']['result'];
            }
?>&nbsp;
        </div>
        <div class="col-sm-2">Status</div>
        <div class="col-sm-9">&nbsp;<?php
            if ($this->data['Grant']['status']) {

                echo $this->data['Grant']['status'];
            }
?>&nbsp;
        </div>
        <div class="col-sm-2">Result Date</div>
        <div class="col-sm-9">&nbsp;<?php
            if ($this->data['Grant']['result_date']) {

                echo $this->data['Grant']['result_date'];
            }
?>&nbsp;
        </div>
        <div class="col-sm-2">Posting Date</div>
        <div class="col-sm-9">&nbsp;<?php
            if ($this->data['Grant']['posting_date']) {

                echo $this->data['Grant']['posting_date'];
            }
?>&nbsp;
        </div>
        <div class="col-sm-2">Posting Number</div>
        <div class="col-sm-9">&nbsp;<?php
            if ($this->data['Grant']['posting_number']) {

                echo $this->data['Grant']['posting_number'];
            }
?>&nbsp;
        </div>
        <div class="col-sm-2">Attachments</div>
        <div class="col-sm-9">&nbsp;<?php
            if ($this->data['Grant']['attachments']) {

                echo $this->data['Grant']['attachments'];
            }
?>&nbsp;
        </div>
    </div>
    <hr />
    <div class="actions">
        <ul>
            <li><?php echo $this->Html->link(__('Delete', true), array('action' => 'delete', $this->Form->value('Grant.id')), null, __('Delete the item, sure?', true)); ?></li>
            <li><?php echo $this->Html->link(__('Grants List', true), array('action' => 'index')); ?> </li>
            <li><?php echo $this->Html->link(__('View Related Parliamentarians', true), array('controller' => 'parliamentarians', 'action' => 'index', 'Grant', $this->data['Grant']['id']), array('class' => 'GrantsAdminViewControl')); ?></li>
            <li><?php echo $this->Html->link(__('Set Related Parliamentarians', true), array('controller' => 'parliamentarians', 'action' => 'index', 'Grant', $this->data['Grant']['id'], 'set'), array('class' => 'GrantsAdminViewControl')); ?></li>
        </ul>
    </div>
    <div id="GrantsAdminViewPanel"></div>
<?php
echo $this->Html->scriptBlock('

');
?>
    <script type="text/javascript">
        //<![CDATA[
        $(function() {
            $('a.GrantsAdminViewControl').click(function() {
                $('#GrantsAdminViewPanel').parent().load(this.href);
                return false;
            });
        });
        //]]>
    </script>
</div>