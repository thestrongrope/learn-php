<?php

class DefaultPage {
    function Index() {
        return [ 
            'title' => 'Users', 
            'users' => (load_model('Users'))->GetAll() 
        ];
    }

    function Edit() {        
        $id = $_GET['id'] ?? 0;
        return [ 
            'title' => 'Edit User', 
            'layout' => 'layout_blank',
            'user' => (load_model('Users'))->Get($id) 
        ];
    }
}

