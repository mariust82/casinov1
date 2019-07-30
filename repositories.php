<?php
require_once("hlis/repositories/src/Executor.php");
$sender = new \Hlis\Repositories\Executor("sG1MIIpMJwHKYVIuFQP8XUZeixTypXVSTH0YT6lH", dirname(dirname(__DIR__)));
header("Content-Type: application/json");
echo json_encode($sender->getResponse());
