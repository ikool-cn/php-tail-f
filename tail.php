<?php
$file = isset($argv[1]) ? $argv[1] : './test.log';
$last_fsize = $fsize = 0;
$handle = fopen($file, 'r');
while (true) {
    clearstatcache();
    $fsize = filesize($file);
    $diff = ($fsize - $last_fsize);
    if ($diff > 0) {
        fseek($handle, -$diff, SEEK_END);
        while (($buffer = fgets($handle, 4096)) !== false) {
            echo $buffer;
        }
        $last_fsize = $fsize;
    }
    sleep(1);
}
