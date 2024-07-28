<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class HomeController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('auth');
    }

    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Contracts\Support\Renderable
     */
    public function index()
    {
        return view('home');
    }

    public function drugqty()
    {
        // $select_query = "SELECT id FROM drug_quantities
        // WHERE Latest = 1 && DATE(created_at) <> DATE(NOW())
        // ORDER BY DrugCode";

        // $drug_quantites = DB::select($select_query);

        // print_r($drug_quantites);exit;
        // $qt_with_2 = array();

        // $qty = DrugQuantities::whereDate('created_at', '!=', date('Y-m-d'))->where('Latest', 1)
        // ->get();
        // ->update(['Latest' => 0]);
        // print_r(count($qty));exit;

        // $sales = Sales::where([['Debt', '=', 0], ['Paid', '=', 0], ['Latest', '=',1]])->whereRaw('DownPay = TotalPay')
        // ->update(['Paid' => 1]);
        // // ->get();

        // $sales = Sales::where([['Debt', '=', 0], ['Latest', '=',0]])
        // ->update(['Latest' => 1]);
        // // ->get();

        // echo 'done';

        // print_r(count($sales));

        // $controllers = require_once base_path('vendor/composer/autoload_classmap.php');
        // $controllers = array_keys($controllers);
        // $controllers = array_filter($controllers, function ($controller) {
        //     return strpos($controller, 'App\Http\Controllers') !== false;
        // });

        // $controllers = array_map(function ($controller) {

        //     return str_replace('App\Http\Controllers\\', '', $controller);
        // }, $controllers);

        // print_r($controllers);
        // // dd($controllers);

        // $namespace = "App\Http\Controllers";
        // $controller = "HomeController";
        // $controller_class = new \ReflectionClass($namespace.'\\'.$controller);
        // $controller_methods = $controller_class->getMethods(\ReflectionMethod::IS_PUBLIC);

        // echo '<br><br><br>';

        // print_r($controller_methods);
        // dd($controller_methods);

        // Stat here for controllers
        $controllers = [];

        foreach (Route::getRoutes()->getRoutes() as $route)
        {
            $action = $route->getAction();

            if (array_key_exists('controller', $action))
            {
                // You can also use explode('@', $action['controller']); here
                // to separate the class name from the method
                $controllers[] = $action['controller'];
            }
        }

        foreach ($controllers as $controller) {
            $controller = explode('App\Http\Controllers\\',$controller);
            $controller = $controller[1];
            $controller = explode('@',$controller);
            $method = $controller[1];
            $controller = $controller[0];
            // if ($method === 'update' || $method === 'store') {
            //     continue;
            // }
            $check_controller = ControllerModel::where('Name', $controller)->get();
            if(count($check_controller) > 0){
                // echo 'cotiue';
                continue;
            }
            $addController = new ControllerModel;
            $addController->Name = $controller;
            $addController->save();

            // echo $controller.':'.$method.'<br><br>';
        }

        // start here for functions
        foreach ($controllers as $controller) {
            $controller = explode('App\Http\Controllers\\',$controller);
            $controller = $controller[1];
            $controller = explode('@',$controller);
            $method = $controller[1];
            $controller = $controller[0];
            // if ($method === 'update' || $method === 'store') {
            //     continue;
            // }
            $check_controller = ControllerModel::where('Name', $controller)->first();
            if(isset($check_controller)){
                $function = Functionary::where('Name', $method)->where('ControllerID', $check_controller->id)->first();
                if (isset($function)) {
                    continue;
                }
                $functions = new Functionary;
                $functions->Name = $method;
                $functions->ControllerID = $check_controller->id;
                $functions->save();
                continue;
            }

            // echo $controller.':'.$method.'<br><br>';
        }
        // print_r($controllers);
        // echo '<h1><font color= "red">What are looking for?</font></h1>';
        exit;

    }
}
