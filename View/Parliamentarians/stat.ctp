<?php

function cmp_submits($a, $b) {
    if ($a['Parliamentarian']['count_submits'] == $b['Parliamentarian']['count_submits']) {
        return 0;
    }
    return ($a['Parliamentarian']['count_submits'] < $b['Parliamentarian']['count_submits']) ? -1 : 1;
}
function cmp_petitions($a, $b) {
    if ($a['Parliamentarian']['count_petitions'] == $b['Parliamentarian']['count_petitions']) {
        return 0;
    }
    return ($a['Parliamentarian']['count_petitions'] < $b['Parliamentarian']['count_petitions']) ? -1 : 1;
}
function cmp_sum1($a, $b) {
    if ($a['Parliamentarian']['count_sum'] == $b['Parliamentarian']['count_sum']) {
        return 0;
    }
    return ($a['Parliamentarian']['count_sum'] > $b['Parliamentarian']['count_sum']) ? -1 : 1;
}
function cmp_sum2($a, $b) {
    if ($a['Parliamentarian']['count_sum'] == $b['Parliamentarian']['count_sum']) {
        return 0;
    }
    return ($a['Parliamentarian']['count_sum'] < $b['Parliamentarian']['count_sum']) ? -1 : 1;
}

$items3 = array();
foreach($items1 AS $key => $item) {
    $item['Parliamentarian']['count_sum'] = $item['Parliamentarian']['count_submits'] + $item['Parliamentarian']['count_petitions'];
    $items3[$key] = $item;
}


usort($items3, 'cmp_sum1');
?>
<div class="container">
    <div class="row">
        <div class="col-lg-6 col-md-6">
            多 -> 少<hr />
            <div class="col-lg-4 col-md-4">
                提案：
                <ul>
                    <?php foreach ($items1 AS $item) {
                        ?><li><?php echo $this->Html->link($item['Parliamentarian']['name'], '/parliamentarians/view/' . $item['Parliamentarian']['id']); ?> (<?php echo $item['Parliamentarian']['count_submits']; ?>)</li><?php
                    }
                    ?>
                </ul>
            </div>
            <div class="col-lg-4 col-md-4">
                連署：
                <ul>
                    <?php foreach ($items2 AS $item) {
                        ?><li><?php echo $this->Html->link($item['Parliamentarian']['name'], '/parliamentarians/view/' . $item['Parliamentarian']['id']); ?> (<?php echo $item['Parliamentarian']['count_petitions']; ?>)</li><?php
                    }
                    ?>
                </ul>
            </div>
            <div class="col-lg-4 col-md-4">
                總和：
                <ul>
                    <?php foreach ($items3 AS $item) {
                        ?><li><?php echo $this->Html->link($item['Parliamentarian']['name'], '/parliamentarians/view/' . $item['Parliamentarian']['id']); ?> (<?php echo $item['Parliamentarian']['count_sum']; ?>)</li><?php
                    }
                    ?>
                </ul>
            </div>
        </div>
        <?php
        usort($items1, 'cmp_submits');
        usort($items2, 'cmp_petitions');
        usort($items3, 'cmp_sum2');
        ?>
        <div class="col-lg-6 col-md-6">
            少 -> 多<hr />
            <div class="col-lg-4 col-md-4">
                提案：
                <ul>
                    <?php foreach ($items1 AS $item) {
                        ?><li><?php echo $this->Html->link($item['Parliamentarian']['name'], '/parliamentarians/view/' . $item['Parliamentarian']['id']); ?> (<?php echo $item['Parliamentarian']['count_submits']; ?>)</li><?php
                    }
                    ?>
                </ul>
            </div>
            <div class="col-lg-4 col-md-4">
                連署：
                <ul>
                    <?php foreach ($items2 AS $item) {
                        ?><li><?php echo $this->Html->link($item['Parliamentarian']['name'], '/parliamentarians/view/' . $item['Parliamentarian']['id']); ?> (<?php echo $item['Parliamentarian']['count_petitions']; ?>)</li><?php
                    }
                    ?>
                </ul>
            </div>
            <div class="col-lg-4 col-md-4">
                總和：
                <ul>
                    <?php foreach ($items3 AS $item) {
                        ?><li><?php echo $this->Html->link($item['Parliamentarian']['name'], '/parliamentarians/view/' . $item['Parliamentarian']['id']); ?> (<?php echo $item['Parliamentarian']['count_sum']; ?>)</li><?php
                    }
                    ?>
                </ul>
            </div>
        </div>
    </div>
</div>