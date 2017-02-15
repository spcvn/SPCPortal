<?php

namespace SPCVN\Http\Controllers;

use Artisan;
use DB;
use Dotenv\Dotenv;
use Illuminate\Http\Request;

use Input;
use Session;
use Settings;
use SPCVN\Http\Requests;

class TestController extends Controller
{
    private $temp = [
        0 => ['localhost', 'root', 'sql2016'],
        1 => ['localhost', 'root', 'sql2017'],
        2 => ['localhost', 'root', 'sql2018'],
        3 => ['localhost', 'root', 'sql2019'],
        4 => ['localhost', 'root', 'sql2016'],
    ];
    public function index($i = 0)
    {


        if($i < 5){
            try {
                $conn = new \mysqli($this->temp[$i][0], $this->temp[$i][1], $this->temp[$i][2], '');
                echo 'Connection '.$i .'ok' . '</br>';
                $this->index($i+1);
            } catch (\Exception $e) {
                $rules['mysql_connection'] = 'required';
                if ($e->getMessage() != '') {
                    $messages = ['mysql_connection.required' => 'The :attribute field is required. - ERROR: <strong>' . $e->getMessage() . '</strong>'];
                    echo 'Connection '.$i .'not ok' . '</br>';
                    $this->index($i+1);
                }
            }

        }
    }
}
