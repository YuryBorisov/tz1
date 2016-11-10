<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Log;

class HomeController extends Controller
{

    protected $response = ['response' => ['status' => 'error']];

    protected $operatorMethod = ['+' => 'sum', '-' => 'sub', '*' => 'multi', '/' => 'div'];

    public function index(){
        return view('index');
    }

    /*
     * Можно и нужно использовать isset and is_numeric в одном if, но я написал так, что бы можно было отследить глубину ошибки
     */

    public function calc(Request $request){
        $data = $request->all();
        if(isset($data['one'])){
            if(is_numeric($data['one'])){
                if(isset($data['two'])){
                    if(is_numeric($data['two'])){
                        if(isset($data['operation'])){
                            if(isset($this->operatorMethod[$data['operation']])){
                                $this->response['response']['status'] = 'success';
                                $this->response['response']['data']['result'] =
                                    $this->{$this->operatorMethod[$data['operation']]}($data['one'], $data['two']);
                            }else{
                                $this->response['response']['message'] = 'Операция ' . $data['operation'] . ' не найдена';
                            }
                        }else{
                            $this->response['response']['message'] = 'Операция отсутствует в запросе';
                        }
                    }else{
                        $this->response['response']['message'] = 'Второе значение не является числом';
                    }
                }else{
                    $this->response['response']['message'] = 'В запросе отсутствует второе значения';
                }
            }else{
                $this->response['response']['message'] = 'Первое значение не является числом';
            }
        }else{
            $this->response['response']['message'] = 'В запросе отсутствует первое значения';
        }
        return $this->response;
    }

    public function sum($a, $b) {
        return $a + $b;
    }

    public function multi($a, $b){
        return $a * $b;
    }

    public function div($a, $b){
        return $b == 0 ? 'Делить на 0 нельзя' : $a / $b;
    }

    public function sub($a, $b){
        return $a - $b;
    }

}
