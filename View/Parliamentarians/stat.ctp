<?php

$data = array(
    'name' => 'query',
    'children' => array(),
);
foreach ($items AS $item) {
    $color = '';
    switch ($item['Parliamentarian']['Party_id']) {
        case '1':
            $color = '#009900';
            break;
        case '2':
        case '4':
            $color = '#0099FF';
            break;
        default:
            $color = '#777777';
            break;
    }
    $data['children'][] = array(
        'id' => $item['Parliamentarian']['id'],
        'className' => $item['Parliamentarian']['name'],
        'linkTitle' => implode("\n", array(
            '提案： ' . $item['Parliamentarian']['count_submits'],
            '連署： ' . $item['Parliamentarian']['count_petitions'],
        )),
        'value' => $item['Parliamentarian']['count_submits'] + $item['Parliamentarian']['count_petitions'],
        'color' => $color,
    );
}
echo json_encode($data);
