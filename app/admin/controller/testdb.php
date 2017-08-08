<?php
/**
 * Created by PhpStorm.
 * User: kky
 * Date: 2017/6/28
 * Time: 14:44
 */
namespace app\admin\controller;

use think\Db;

class testdb extends Common
{
    public function testdb(){
        $dbtables = $this->db->query("SHOW TABLE STATUS LIKE '".config('prefix')."%'");
        dump($dbtables);exit;
    }
}