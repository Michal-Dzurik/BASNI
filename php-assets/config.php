<?php

//localhost root
define("ROOT", "http://localhost/");

// Turn off all error reporting
error_reporting(0);

if( !session_id() ) @session_start();

$database = new PDO("mysql:host=127.0.0.1;port=3306;dbname=basni.;charset=utf8", "root", "root");


function add_followed_id($id, $id_string){

    $ids = explode('#',$id_string);

    if ($id_string == null || strlen($id_string) == 0){
        return $id . "#";
    }
    if (!is_set_id($id,$ids)){
        return $id_string . $id. "#";
    }
    else return filter_ids($id_string);
}

function remove_followed_id($id,$id_string){
    $ids = explode('#',$id_string);

    if (count($ids) == 0){
        return "";
    }

    $id_string = "";
    for ($i = 0; $i < count($ids);$i++){
        if ($ids[$i] != $id){
            $id_string .= $i == 0 ? $ids[$i] : ($ids[$i] . "#");
        }
    }

    return filter_ids($id_string);
}

function is_set_id($id,$ids){
    if (gettype($ids) === "string"){
        $ids = explode("#",$ids);
    }

    for ($i = 0; $i < count($ids);$i++){
        if ($ids[$i] == $id){
            return true;
        }
    }

    return false;
}

function filter_ids($ids_string){
    $ids = str_split($ids_string);
    $ids_string = "";

    for ($i = $ids[0] == "#" ? 1: 0; $i < count($ids);$i++){
        if ($i == count($ids) - 1 && $ids[$i] == "#" ){continue;}
        $ids_string .= $ids[$i];
    }

    return $ids_string;
}

function create_id_for_sql($array){
    $string = "(";

    for ($i = 0; $i < count($array);$i++){
        if ($i != count($array) - 1){
            $string .= $array[$i] . ",";
        }else{
            $string .= $array[$i] . ")";
        }

    }

    return $string;
}
