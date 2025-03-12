<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
// Models
use App\OTCReciepts;
use App\Patients;
// Excel Imports
use App\Imports\DrugCategoriesImport;
use App\Imports\DrugsImport;
use App\Imports\DrugUnitsImport;
use App\Imports\MedicalServiceImport;
use App\PatientServiceRecords;
use App\TreatmentRecords;

use PDF;
use Excel;

class FileDownloadController extends Controller
{
    // excel upload for drug units
    public function upload_drug_units(Request $request)
    {
        $request->validate([
            'file' => 'required|mimes:xls,xlsx,csv'
        ]);
        

        // $path = $request->file('file')->getRealPath();
        
        $path1 = $request->file('file')->store('temp'); 
        $path=storage_path('app').'/'.$path1;
        Excel::import(new DrugUnitsImport, $path);
        

        return redirect()->back()->with('success', 'Records have been successfully uploaded.');
    }

    // excel upload for drug categories
    public function upload_drug_categories(Request $request)
    {
        $request->validate([
            'file' => 'required|mimes:xls,xlsx,csv'
        ]);
        

        // $path = $request->file('file')->getRealPath();
        $path1 = $request->file('file')->store('temp'); 
        $path=storage_path('app').'/'.$path1;
        Excel::import(new DrugCategoriesImport, $path);
        

        return redirect()->back()->with('success', 'Records have been successfully uploaded.');
    }
    
    // excel upload for drug categories
    public function upload_service_records(Request $request)
    {
        $request->validate([
            'file' => 'required|mimes:xls,xlsx,csv'
        ]);
        

        // $path = $request->file('file')->getRealPath();

        $path1 = $request->file('file')->store('temp'); 
        $path=storage_path('app').'/'.$path1;
        Excel::import(new MedicalServiceImport, $path);
        

        return redirect()->back()->with('success', 'Records have been successfully uploaded.');
    }

    // excel upload for drugs
    public function upload_drugs(Request $request)
    {
        $request->validate([
            'file' => 'required|mimes:xls,xlsx,csv'
        ]);
        

        // $path = $request->file('file')->getRealPath();
        $path1 = $request->file('file')->store('temp'); 
        $path=storage_path('app').'/'.$path1;

        Excel::import(new DrugsImport, $path);
        
        return redirect()->back()->with('success', 'Drugs List has been successfully uploaded.');
    }

    public function otc_reciept_download($recieptyID)
    {
        // reciept name
        $receipt_name = 'Over The Counter Receipt';
        $otcs_rpt = OTCReciepts::with(['otc_pays'])->findOrFail($recieptyID);

        // print_r($otcs_rpt);exit;

        // return view('reports.otc_reciepts')->with(['otcs_rpt' => $otcs_rpt, 'receipt_name' => $receipt_name]);
        // exit;

        $data = ['title' => 'OTC Reciept', 'otcs_rpt' => $otcs_rpt, 'receipt_name' => $receipt_name];
        $pdf = PDF::loadView('reports.otc_reciepts', $data);
  
        return $pdf->download('Reciept No.'.$recieptyID.'.pdf');

    }

    // Download Patient Card function
    public function patient_card_download($patientID)
    {
        // reciept name
        $receipt_name = 'Patient Card';
        $patient = Patients::with(['treatments', 'referral', 'medical_service_records', 'sales_debts', 'coporate_patient', 'sales', 'sales_show', 'sales_paid_show', 'sales_treat_show', 'sales_service_show'])->findOrFail($patientID);

        // 'Patient Card: MFC-'.$patientID

        $receipt_no = $patient->id;
        // print_r($patient);exit;

        // return view('reports.patient_card')->with(['title' => $receipt_name, 'patient' => $patient, 'receipt_name' => $receipt_name, 'receipt_no' => $receipt_no]);
        // exit;


        $data = ['title' => $receipt_name, 'patient' => $patient, 'receipt_name' => $receipt_name, 'receipt_no' => $receipt_no];
        // $pdf = PDF::loadView('reports.patient_card', $data);
        $pdf = PDF::loadView('reports.patient_card', $data)->setPaper('a4', 'landscape');

        return $pdf->download($patient->FirstName.' '.$patient->SurName.'\'s Card(MFC-'.$patient->id.').pdf');
    }

    public function patient_card_download_two(Request $request, $patientID)
    {
        $this->validate($request, [
            'printary-medical' => ['nullable', 'array', 'min:1'],
            'printary-treatment' => ['nullable', 'array', 'min:1'],
        ]);
        // print_r($request->input());exit;

        // reciept name
        $receipt_name = 'Patient Card';
        $patient = Patients::with(['treatments', 'referral', 'medical_service_records', 'sales_debts', 'coporate_patient', 'sales', 'sales_show', 'sales_paid_show', 'sales_treat_show', 'sales_service_show'])->findOrFail($patientID);

        // 'Patient Card: MFC-'.$patientID

        $treatments = $request->input('printary-treatment');
        $medical_recs = $request->input('printary-medical');
        $receipt_no = $patient->id;
        $t_arr = isset($treatments) && count($treatments) > 0 ? $treatments : FALSE;
        $m_arr = isset($medical_recs) && count($medical_recs) > 0 ? $medical_recs : FALSE;
        // print_r($m_arr);exit;
        
        $m_recs  = $m_arr ? PatientServiceRecords::whereIn('id', $m_arr)->get() : FALSE;
        $t_recs = $t_arr ? TreatmentRecords::whereIn('id', $t_arr)->with(['prescriptions'])->get(): FALSE;
        // print_r($t_recs);exit;
        
        $m_paid = $m_unpaid  = 0;
        if($m_recs){
            foreach ($m_recs as $med) {
                if(isset($med->sale)){
                    $m_paid += $med->sale->DownPay;
                    $m_unpaid += $med->sale->Debt;
                }else{
                    continue;
                }
            }
        }
        $m_total = $m_paid + $m_unpaid;

        $t_paid = $t_unpaid  = 0;
        if($t_recs){
            foreach ($t_recs as $treat) {
                if (count($treat->prescriptions) > 0) {
                    foreach ($treat->prescriptions as $p) {
                        $t_paid += $p->sale->DownPay;
                        $t_unpaid += $p->sale->Debt;
                    }   
                } else {
                    continue;
                }
            }
        }
        $t_total = $t_unpaid + $t_paid;

        // echo 'Paid:'.$m_paid.'<br>'.$m_unpaid; exit;
        // print_r(count($m_recs));exit;

        // return view('reports.patient_card2')->with(['title' => $receipt_name, 'patient' => $patient, 'receipt_name' => $receipt_name, 'receipt_no' => $receipt_no, 't_recs' => $t_recs, 'm_recs' => $m_recs, 'm_total' => $m_total, 'm_paid' => $m_paid, 'm_unpaid' => $m_unpaid, 't_total' => $t_total, 't_unpaid' => $t_unpaid, 't_paid' => $t_paid]);
        // exit;

        $data = ['title' => $receipt_name, 'patient' => $patient, 'receipt_name' => $receipt_name, 'receipt_no' => $receipt_no, 't_recs' => $t_recs, 'm_recs' => $m_recs, 'm_total' => $m_total, 'm_paid' => $m_paid, 'm_unpaid' => $m_unpaid, 't_total' => $t_total, 't_unpaid' => $t_unpaid, 't_paid' => $t_paid];
        // $pdf = PDF::loadView('reports.patient_card2', $data);
        $pdf = PDF::loadView('reports.patient_card2', $data)->setPaper('a4', 'landscape');

        return $pdf->download($patient->FirstName.' '.$patient->SurName.'\'s Card(MFC-'.$patient->id.').pdf');
    }

}
