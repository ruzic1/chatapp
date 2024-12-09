<?php
    // $request=str_replace("\\","",$_SERVER['REQUEST_URI']);
    // var_dump($_SERVER['REQUEST_URI']);

    // echo json_encode($_SERVER['REQUEST_URI']);
    class Router{
        protected $routes=[];

        public function get($route,$handler){
            $this->addRoute($route,$handler,"GET");
        }
        public function post($route,$handler){
            //$this->
            //var_dump($handler);
            $this->addRoute($route,$handler,"POST");

        }


        public function addRoute($route,$handler,$method){
            $this->routes[]=[
                'route'=>$route,
                'handler'=>$handler,
                'method'=>$method,
            ];
            //var_dump($this->routes);
            // var_dump($this->routes);
        }

        public function dispatch($uri,$method){

            foreach($this->routes as $route){
                if($route['route']==$uri&&$route['method']==$method){
                    if(is_callable($route['handler'])){
                        call_user_func($route['handler']);
                    }elseif(is_array($route['handler'])){
                        [$controller,$method]=$route['handler'];
                        call_user_func([$controller,$method]);
                    }else{
                        throw new Exception("Handler is not callable");
                    }
                    return;
                }
            }
            throw new Exception("Route not found for URI: $uri");
        }
    }
    /*echo json_encode($request);
    if($request==$_SERVER['REQUEST_URI']){
        echo json_encode(555);
    }*/
    //$newString=stripslashes($request);

    // echo json_encode($request);

?>