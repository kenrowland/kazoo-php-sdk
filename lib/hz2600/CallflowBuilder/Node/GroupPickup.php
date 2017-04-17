<?php
/**
 * Created by PhpStorm.
 * User: rowla
 * Date: 2/12/2017
 * Time: 7:11 PM
 */

namespace CallflowBuilder\Node;


class GroupPickup extends AbstractNode
{
    public function __construct() {
        parent::__construct();
        $this->module = "group_pickup";
    }

    public function user($id){
        $this->data->user_id = $id;
        return $this;
    }

    public function device($id){
        $this->data->device_id = $id;
        return $this;
    }

    public function group($id){
        $this->data->group_id = $id;
        return $this;
    }

    public function name($name){
        $this->data->name = $name;
        return $this;
    }

}

