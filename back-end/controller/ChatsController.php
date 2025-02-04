<?php

namespace controller;

use models\ChatModel;

class ChatsController{

    public function messageRetrieval($username){
        //echo 'Ulazi u funkciju messagee retrieval';
        // var_dump($data['username']);
        //var_dump($data);
        $model=new ChatModel();

        $messages=$model->messageRetrieval($username);

        if($messages){
            echo json_encode($messages);
            http_response_code(200);
        }else{
            echo json_encode(null);
            http_response_code(500);
        }


    }
    public function messageDeleting($msgId){
        $model=new ChatModel();
        $messages=$model->deleteMessages($msgId);
        if($messages){
            echo json_encode(true);
            http_response_code(200);
        }else{
            echo json_encode(false);
            http_response_code(500);
        }
    }
}
?>