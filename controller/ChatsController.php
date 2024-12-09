<?php

namespace controller;

use models\ChatModel;

class ChatsController{

    public function messageRetrieval($data){
        //echo 'Ulazi u funkciju messagee retrieval';
        // var_dump($data['username']);
        //var_dump($data);
        $model=new ChatModel();

        $messages=$model->messageRetrieval($data['username']);

        if($messages){
            echo json_encode($messages);
            http_response_code(200);
        }else{
            echo json_encode(null);
            http_response_code(500);
        }


    }
}
?>