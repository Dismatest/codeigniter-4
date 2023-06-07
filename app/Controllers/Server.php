<?php

namespace App\Controllers;
use App\Libraries\Socket;
use Ratchet\Server\IoServer;
use Ratchet\Http\HttpServer;
use Ratchet\WebSocket\WsServer;

class Server extends BaseController
{
    public function index()
    {

        if(!is_cli()){
            die('You can only access this controller from a CLI interface');
        }
        $server = IoServer::factory(
            new HttpServer(
                new WsServer(
                    new Socket()
                )
            ),
            8000
        );

        $server->run();
    }
}


