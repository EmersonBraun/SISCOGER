--TEST--
swoole_client_coro: sendfile

--SKIPIF--
<?php require  __DIR__ . '/../include/skipif.inc'; ?>
--FILE--
<?php
require __DIR__ . '/../include/bootstrap.php';

$pm = new ProcessManager;
$pm->parentFunc = function ($pid) use ($pm)
{
    go(function ()  use ($pm) {
        $client = new Swoole\Coroutine\Client(SWOOLE_SOCK_TCP);
        $r = $client->connect(TCP_SERVER_HOST, $pm->getFreePort(), 0.5);
        assert($r);
        $client->send(pack('N', filesize(TEST_IMAGE)));
        $ret = $client->sendfile(TEST_IMAGE);
        assert($ret);

        $data = $client->recv();
        $client->send(pack('N', 8) . 'shutdown');
        $client->close();
        assert($data === md5_file(TEST_IMAGE));
    });
    swoole_event::wait();
};

$pm->childFunc = function () use ($pm)
{
    $serv = new \swoole_server(TCP_SERVER_HOST, $pm->getFreePort(), SWOOLE_BASE, SWOOLE_SOCK_TCP);
    $serv->set([
        "worker_num" => 1,
        'log_file' => '/dev/null',
        'open_length_check' => true,
        'dispatch_mode' => 1,
        'package_length_type' => 'N',
        'package_length_offset' => 0,
        'package_body_offset' => 4,
        'package_max_length' => 2000000,
    ]);
    $serv->on("WorkerStart", function (\swoole_server $serv)  use ($pm)
    {
        $pm->wakeup();
    });
    $serv->on("Receive", function (\swoole_server $serv, $fd, $rid, $data)
    {
        if (substr($data, 4, 8) == 'shutdown')
        {
            $serv->shutdown();
            return;
        }
        $serv->send($fd, md5(substr($data, 4)));
    });
    $serv->start();
};

$pm->childFirst();
$pm->run();
?>
--EXPECT--
