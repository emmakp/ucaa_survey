<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\AuditTrail;
use App\Titles;
use App\User;
use App\UserRoles;
use App\ControllerModel;
use App\Functionary;
use App\Notifications;
use Route;
use DB;

class NotificationsController extends Controller
{
    public function __construct() {

        // Only AJAX requests allowed for this function
        define('AJAX_REQUEST', isset($_SERVER['HTTP_X_REQUESTED_WITH']) && strtolower($_SERVER['HTTP_X_REQUESTED_WITH']) == 'xmlhttprequest');
        if(!AJAX_REQUEST) {die();}

    }
    //
    public function patients()
    {
        $patients = Patients::whereday('Age', date('d'))->whereMonth('Age', date('m'))->count('id');

        $check = Notifications::where('Type', 'Patients');
        if(count($check->get()) > 0){
            $check->delete();
        }
        $store = new Notifications;
        $store->Type = 'Patients';
        $store->Nombre = $patients;
        $store->save();


        // print_r($patients);exit;

        if($patients > 0){
            return $patients;
        }else{
            return false;
        }
    }

    public function drugs()
    {
        $drugs = DrugQuantities::orderby('id', 'desc')->where('Latest', 1)->where('TotalStock', '<=', 0)->count();

        $check = Notifications::where('Type', 'Drugs');
        if(count($check->get()) > 0){
            $check->delete();
        }
        $store = new Notifications;
        $store->Type = 'Drugs';
        $store->Nombre = $drugs;
        $store->save();


        // print_r($patients);exit;

        if($drugs > 0){
            return $drugs;
        }else{
            return false;
        }
    }

    public function items()
    {
        $items = ItemQuantities::where('Latest', 1)->where('TotalStock', '<=', 0)->count();

        $check = Notifications::where('Type', 'Items');
        if(count($check->get()) > 0){
            $check->delete();
        }
        $store = new Notifications;
        $store->Type = 'Items';
        $store->Nombre = $items;
        $store->save();


        // print_r($patients);exit;

        if($items > 0){
            return $items;
        }else{
            return false;
        }
    }

    public function all()
    {

        $patients = $this->patients();
        $show = date('H:m');
        $notification = $show;

        $drugs = $this->drugs();
        $items = $this->items();

        $none = true;
        if($patients || $drugs || $items){
            $none = false;
        }

        // echo(date('H:m'));exit;

        $returnHTML = view('inc.notifications',['patients' => $patients, 'notification' => $notification, 'drugs' => $drugs, 'items' => $items, 'none' => $none])->render();

        echo $returnHTML;
        // return $returnHTML;


        // return view('inc.notifications')->with(['patients' => $patients, 'notification' => $notification]);
    }

    public function notification_count()
    {
        // echo 'Hello';exit;
        $patients = $this->patients();
        $drugs = $this->drugs();
        $items = $this->items();

        $none = true;
        if($patients || $drugs || $items){
            $none = false;
        }

        $msg = array('alert' => $none);

        return $msg;
    }

}
