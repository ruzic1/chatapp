<?php
    // require_once 'router.php';
    // require_once 'controller/UserController.php';
    // require_once 'models/UserModel.php';
    require_once 'config.php';

    use controller\UserController;

    // header('X-App-Route-Handler: app.php is running');

    // var_dump($_SERVER['REQUEST_URI']);
    $abc=routingHandlingFunction();
    //echo 'Rezultat funkcije je:'.var_dump($abc);
    /*
        1. Ispituje se da li je ruta default, kao sto je login, index i dr.
        2. Ispituje se da li postoje parametri u url-u
        3. Definisanje ruta
        4. Pozivanje instance adekvatnog kontrolera za odgovarajucu rutu 
    */



    function routingHandlingFunction(){
        $dataFromFrontend=json_decode(file_get_contents('php://input'),true);
        $routes=[
            '/index'=>['HomeController','index'],
            '/login'=>['LoginController','login'],
            '/login-processing'=>['LoginController','loginprocessing'],
            '/products'=>['ProductsController','products'],
            '/user-connections'=>['UserController','userChats'],
            '/message-retrieval'=>['ChatsController','messageRetrieval'],
            '/get-user'=>['UserController','returnUserId']
        ];
        $segmentedUrl=array_filter(explode('/',$_SERVER['REQUEST_URI']));

        if($_SERVER['REQUEST_URI']=='/favicon.ico'){
            http_response_code(204);
            return;
        }

        if(in_array($_SERVER['REQUEST_URI'],array_keys($routes)))
        {
            //var_dump($_SERVER['REQUEST_URI']);
            foreach($routes as $key=>$value)
            {
                if($key==$_SERVER['REQUEST_URI']){
                    $controller=$value[0];
                    $method=$value[1];
                    $controllerName="controller\\".$controller;
                    $controllerInstance=new $controllerName;
                    if(($dataFromFrontend)){
                        return call_user_func_array([$controllerInstance,$method],[$dataFromFrontend]);
                    }else{
                        return call_user_func([$controllerInstance,$method]);
                    }

                }

            }
        }else
        {
            http_response_code(404);
            return ;
        }

    }
?>