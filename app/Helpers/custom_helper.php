<?php 
function userLogin() {
    $db = \Config\Database::connect();
    return $db->table('users')->where('id_user', session('id')->id_user)->get()->getRow();
}
?>