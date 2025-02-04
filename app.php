<?php

    header("Access-Control-Allow-Origin: *"); // Allow any origin
    header("Access-Control-Allow-Methods: POST, GET, OPTIONS, DELETE, PUT"); // Allow specific HTTP methods
    header("Access-Control-Allow-Headers: Content-Type"); // Allow Content-Type header
    //echo json_encode('RADIII');
    // echo 'app.php is triggered';
    // error_log('app.php is triggered');
    //echo json_encode(123);
    //require_once 'router.php';
    // require_once 'back-end/controller/Controller.php';
    // require_once 'back-end/controller/UserController.php';
    // require_once 'back-end/models/Model.php';
    // require_once 'back-end/models/UserModel.php';
    // require_once 'back-end/controller/LoginController.php';
    require_once 'back-end/config.php';
    // header("Access-Control-Allow-Origin: *");
    // header("Access-Control-Allow-Methods: POST, GET, PUT, DELETE, OPTIONS");
    // header("Access-Control-Allow-Headers: Content-Type, Authorization");
    // if ($requestUri === '/registration-processing') {
    //     // Handle registration-processing
    //     header('Content-Type: application/json');
    //     echo json_encode(['message' => 'Registration processing successful!']);
    //     exit;
    // }

    // require_once 'config.php';


    use controller\UserController;


    // echo json_encode($_SERVER['REQUEST_URI']);
    // $abc=trim($_SERVER['REQUEST_URI'],'\\');
    // echo json_encode($abc);
    
    $base="/blogPage";

    $corrected=str_replace('/blogPage','',$_SERVER['REQUEST_URI']);

    // if($corrected=="/registration-processing"){
    //     echo json_encode('AAAA RADII JEBOTE');
    // }
    $abc=routingHandlingFunction($corrected);



    function routingHandlingFunction($requestUri){
        $dataFromFrontend=json_decode(file_get_contents('php://input'),true);
        $routes=[
            '/index'=>['HomeController','index'],
            '/login'=>['LoginController','login'],
            '/registration-processing'=>['LoginController','registeruser'],
            '/login-processing'=>['LoginController','loginprocessing'],
            '/logout'=>['LoginController','logout'],
            '/check-session'=>['LoginController','checksession'],
            '/products'=>['ProductsController','products'],
            '/contacts'=>['UserController','contacts'],
            '/user-connections'=>['UserController','userChats'],
            '/message-retrieval'=>['ChatsController','messageRetrieval'],
            '/message-deleting'=>['ChatsController','messageDeleting'],
            '/add-contact'=>['UserController','addContact'],
            '/get-user'=>['UserController','returnUserId']
        ];
        $segmentedUrl=array_filter(explode('/',$requestUri));

        if($requestUri=='/favicon.ico'){
            http_response_code(204);
            return;
        }

        if(in_array($requestUri,array_keys($routes)))
        {
            foreach($routes as $key=>$value)
            {
                if($key==$requestUri){
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