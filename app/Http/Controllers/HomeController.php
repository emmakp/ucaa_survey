<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Survey;
use App\User;
use App\Questionaire;
use App\AuditTrail;
use App\ControllerModel;
use App\Functionary;
use App\Response;

use Route;
use DB;

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
    // public function index()
    // {
    //     $audit_action = 'View List of Audit Trail';
    //     $audit_user_id = auth()->user()->id;

    //     // Audit this action
    //     $audit_trail = new AuditTrail();

    //     $audit_trail->action = $audit_action;
    //     $audit_trail->user_id = $audit_user_id;

    //     $audit_trail->save();

    //     $survey_count = Survey::count();
    //     $user_count = User::count();
    //     $responses = Response::count();
    //     $questionaire_count = Questionaire::count();
    //     $audit_trail = AuditTrail::orderBy('created_at', 'DESC')->with('user')->get();
    //     return view('home')->with([
    //         'survey_count' => $survey_count,
    //         'staff_count' => $user_count,
    //         'questionaire_count' => $questionaire_count,
    //         'audit_trail' => $audit_trail,
    //         'responses' => $responses,
    //     ]);
    // }
    public function index()
    {
        $audit_user_id = auth()->user()->id;
    
        // Audit this action
        AuditTrail::create([
            'user_id' => $audit_user_id,
            'controller' => 'HomeController', // Add this to satisfy the NOT NULL constraint
            'function' => 'index',
            'action' => 'View List of Audit Trail',
        ]);
    
        $survey_count = Survey::count();
        $user_count = User::count();
        $responses = Response::count();
        $questionaire_count = Questionaire::count();
        $audit_trail = AuditTrail::orderBy('created_at', 'DESC')->with('user')->get();
        return view('home')->with([
            'survey_count' => $survey_count,
            'staff_count' => $user_count,
            'questionaire_count' => $questionaire_count,
            'audit_trail' => $audit_trail,
            'responses' => $responses,
        ]);
    }
   
    public function home()
    {
        $audit_action = 'View List of Audit Trail';
        $audit_user_id = auth()->user()->id;

        // Audit this action
        $audit_trail = new AuditTrail();

        $audit_trail->action = $audit_action;
        $audit_trail->user_id = $audit_user_id;

        $audit_trail->save();

        $survey_count = Survey::count();
        $user_count = User::count();
        $responses = Response::count();
        $questionaire_count = Questionaire::count();
        $audit_trail = AuditTrail::orderBy('created_at', 'DESC')->with('user')->get();
        return view('home')->with([
            'survey_count' => $survey_count,
            'staff_count' => $user_count,
            'questionaire_count' => $questionaire_count,
            'audit_trail' => $audit_trail,
            'responses' => $responses,
        ]);
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
        // print_r($controllers);
        // unset($controllers[0]);
        // echo '<br><br>';
        // print_r($controllers);//exit;
        for ($i=0; $i < count($controllers); $i++) {
            // echo explode('\\',$controllers[$i])[0].'<br>';
            if(explode('\\',$controllers[$i])[0] != "App" ) { unset($controllers[$i]); }
        }
        // echo '<br><br>';
        // print_r($controllers);
        // exit;
        foreach ($controllers as $controller) {
            $controller = explode('App\Http\Controllers\\',$controller);
            // print_r($controller);exit;
            $controller = $controller[1];
            $controller = explode('@',$controller);
            $method = $controller[1];
            // print_r($method);exit;
            $controller = $controller[0];
            // print_r($controller);exit;

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
        echo 'Added successfully';exit;
        // print_r($controllers);
        // echo '<h1><font color= "red">What are looking for?</font></h1>';
        exit;

    }
}
