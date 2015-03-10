<?php

class GrantShell extends AppShell {

    public $uses = array('Grant');

    public function main() {
        $parliamentarians = $this->Grant->Parliamentarian->find('list', array(
            'fields' => array('name', 'id'),
        ));
        $areas = $this->Grant->Area->find('list', array(
            'fields' => array('name', 'id'),
        ));
        foreach (glob(__DIR__ . '/data/grant/*.csv') AS $csvFile) {
            $fh = fopen($csvFile, 'r');
            while ($line = fgetcsv($fh, 2048)) {
                foreach ($line AS $k => $v) {
                    $line[$k] = str_replace(array('　'), array(''), trim($v));
                }
                if (!empty($line[0]) && !empty($line[1]) && !empty($line[5])) {
                    $line[0] = explode("\n", $line[0]);
                    $line[8] = explode("\n", $line[8]);
                    $line[2] = explode("\n", $line[2]);
                    foreach ($line[0] AS $k => $v) {
                        $v = trim($v);
                        switch ($v) {
                            case '頼惠員':
                                $v = '賴惠員';
                                break;
                            case '谷暮.哈就':
                                $v = '谷暮．哈就';
                                break;
                            case '林慶鎭':
                                $v = '林慶鎮';
                                break;
                        }
                        $line[0][$k] = $v;
                    }
                    foreach ($line[2] AS $k => $v) {
                        $v = trim($v);
                        switch ($v) {
                            case '南區區':
                                $v = '南區';
                                break;
                            case '曾文區':
                                $v = '麻豆區';
                                break;
                        }
                        $line[2][$k] = $v;
                    }
                    foreach ($line[8] AS $k => $v) {
                        $line[8][$k] = trim($v);
                        if (!empty($v)) {
                            $companyCache = TMP . 'grant/company';
                            if (!file_exists($companyCache)) {
                                mkdir($companyCache, 0777, true);
                            }
                            $companyCache .= '/' . $v;
                            if (!file_exists($companyCache)) {
                                file_put_contents($companyCache, file_get_contents('http://gcis.nat.g0v.tw/api/search?q=' . urlencode($v)));
                            }
                            //$company = json_decode(file_get_contents($companyCache), true);
                        }
                    }
                    $line[3] = preg_replace('/[^0-9]/', '', $line[3]);
                    $line[4] = preg_replace('/[^0-9]/', '', $line[4]);
                    $this->Grant->create();
                    if ($this->Grant->save(array('Grant' => array(
                                    'title' => $line[1],
                                    'area' => implode(',', $line[2]),
                                    'amount_suggested' => $line[3],
                                    'amount_approved' => $line[4],
                                    'account' => $line[5],
                                    'department' => $line[6],
                                    'type' => $line[7],
                                    'parliamentarians' => implode(',', $line[0]),
                                    'vendors' => implode(',', $line[8]),
                        )))) {
                        $grantId = $this->Grant->getInsertID();
                        foreach ($line[0] AS $p) {
                            if (isset($parliamentarians[$p])) {
                                $this->Grant->GrantsParliamentarian->create();
                                $this->Grant->GrantsParliamentarian->save(array('GrantsParliamentarian' => array(
                                        'Grant_id' => $grantId,
                                        'Parliamentarian_id' => $parliamentarians[$p],
                                )));
                            }
                        }
                        foreach ($line[2] AS $p) {
                            if (isset($areas[$p])) {
                                $this->Grant->AreasGrant->create();
                                $this->Grant->AreasGrant->save(array('AreasGrant' => array(
                                        'Grant_id' => $grantId,
                                        'Area_id' => $areas[$p],
                                )));
                            }
                        }
                    }
                }
            }
            fclose($fh);
        }
    }

}
