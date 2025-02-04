<?php
    //namespace App;
    //namespace App\bin;
    use Ratchet\Server\IoServer;
    use Ratchet\App;
    //use App\src\Chat;
    //use Chat;
    use Ratchet\Http\HttpServer;
    use Ratchet\WebSocket\WsServer;
    use chat\Chat;

    require dirname(__DIR__).'/vendor/autoload.php';
    require __DIR__.'/../src/Chat.php';
    $server=IoServer::factory(
        // new Chat(),
        // 8080
        new HttpServer(
            new WsServer(
                new Chat()
            )
        ),
        8080
    );
    echo "WebSocket server running at ws://127.0.0.1:8080\n"; 
    $server->run();
?>