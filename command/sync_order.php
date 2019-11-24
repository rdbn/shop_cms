<?php

use App\Services\SyncOrder\SyncOrder;
use App\Services\Logger;

require __DIR__ . '/../vendor/autoload.php';

$log = (new Logger('sync_order'))->getLogger();

$log->info("Start sync order");
//try {
    $syncOrder = new SyncOrder();
    $syncOrder->sync();
//} catch (\Exception $e) {
//    $log->error($e->getMessage());
//    exit(1);
//}
$log->info("End sync order");
