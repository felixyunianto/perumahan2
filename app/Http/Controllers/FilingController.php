<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Customer;
use App\Filing;
use Storage;
use App\DetailHouse;
use App\House;

class FilingController extends Controller
{
    public function __construct(){
        $this->middleware('auth');
    }

    public function index(){
        $this->authorize('pemberkasan');
        $customers = Customer::with('detail_house')->get();
    
        return view('pages.filing.index', compact('customers'));
    }

    public function filling($id){
        $this->authorize('pemberkasan');
        $customers = Customer::find($id);
        $detail_house = DetailHouse::where('customer_id', $id)->get();
        $filings = Filing::where('customer_id', $id)->firstOrFail();

        return view('pages.filing.create', compact('customers','filings'));
    }

    public function store(Request $request){
        $this->authorize('pemberkasan');
        $filings = Filing::where('customer_id', $request->customer_id)->firstOrFail();
        
        $photos = $filings->photos;
        if($request->photos){
            $photos = $request->file('photos')->store('file_customer/photos');
            $photo_path = $filings->photos;
            if(Storage::exists($photo_path)) {
                Storage::delete($photo_path);
            }
        }

        $fc_id_card = $filings->fc_id_card;
        if($request->fc_id_card){
            $fc_id_card = $request->file('fc_id_card')->store('file_customer/fc_id_card');
            $fc_id_card_path = $filings->fc_id_card;
            if(Storage::exists($fc_id_card_path)) {
                Storage::delete($fc_id_card_path);
            }
        }

        $fc_family_card = $filings->fc_family_card;
        if($request->fc_family_card){
            $fc_family_card = $request->file('fc_family_card')->store('file_customer/fc_family_card');
            $fc_family_card_path = $filings->fc_family_card;
            if(Storage::exists($fc_family_card_path)) {
                Storage::delete($fc_family_card_path);
            }
        }

        $fc_marriage_certificate = $filings->fc_marriage_certificate;
        if($request->fc_marriage_certificate){
            $fc_marriage_certificate = $request->file('fc_marriage_certificate')->store('file_customer/fc_marriage_certificate');
            $fc_marriage_certificate_path = $filings->fc_marriage_certificate;
            if(Storage::exists($fc_marriage_certificate_path)) {
                Storage::delete($fc_marriage_certificate_path);
            }
        }

        $fc_taxpayer_identification = $filings->fc_taxpayer_identification;
        if($request->fc_taxpayer_identification){
            $fc_taxpayer_identification = $request->file('fc_taxpayer_identification')->store('file_customer/fc_taxpayer_identification');
            $fc_taxpayer_identification_path = $filings->fc_taxpayer_identification;
            if(Storage::exists($fc_taxpayer_identification_path)) {
                Storage::delete($fc_taxpayer_identification_path);
            }
        }

        $tax_status = $filings->tax_status;
        if($request->tax_status){
            $tax_status = $request->file('tax_status')->store('file_customer/tax_status');
            $tax_status_path = $filings->tax_status;
            if(Storage::exists($tax_status_path)) {
                Storage::delete($tax_status_path);
            }
        }

        $income = $filings->income;
        if($request->income){
            $income = $request->file('income')->store('file_customer/income');
            $income_path = $filings->income;
            if(Storage::exists($income_path)) {
                Storage::delete($income_path);
            }
        }

        $current_account = $filings->current_account;
        if($request->current_account){
          $current_account = $request->file('current_account')->store('file_customer/current_account');
          $current_account_path = $filings->current_account;
          if(Storage::exists($current_account_path)) {
            Storage::delete($current_account_path);
          }
        }

        $saving = $filings->saving;
        if($request->saving){
          $saving = $request->file('saving')->store('file_customer/saving');
          $saving_path = $filings->saving;
          if(Storage::exists($saving_path)){
            Storage::delete($saving_path);
          }
        }

        $ls_havent_house = $filings->ls_havent_house;
        if($request->ls_havent_house){
          $ls_havent_house = $request->file('ls_havent_house')->store('file_customer/ls_havent_house');
          $ls_havent_house_path = $filings->ls_havent_house;
          if(Storage::exists($ls_havent_house_path)){
            Storage::delete($ls_havent_house_path);
          }
        }

        $filings->update([
          'photos' => $photos,
          'fc_id_card' => $fc_id_card,
          'fc_family_card' => $fc_family_card,
          'fc_marriage_certificate' => $fc_marriage_certificate,
          'fc_taxpayer_identification' => $fc_taxpayer_identification,
          'tax_status' => $tax_status,
          'income' => $income,
          'current_account' => $current_account,
          'saving' => $saving,
          'ls_havent_house' => $ls_havent_house,
        ]);

        if($filings->photos !== NULL && $filings->fc_id_card !== NULL && $filings->fc_family_card !== NULL
          && $filings->fc_taxpayer_identification !== NULL
          && $filings->tax_status !== NULL && $filings->income !== NULL
          && $filings->current_account !== NULL && $filings->saving !== NULL && $filings->ls_havent_house !== NULL){
          $customer = Customer::where('id', $request->customer_id)->firstOrFail();
          $customer->update([
            'file_status' => 1
          ]);
        }


        return redirect()->route('pemberkasan.index');
    }

    public function show($id){
        $this->authorize('pemberkasan');
        $detail_house = DetailHouse::with(['house', 'house.block'])->where('customer_id', $id)->get();
        
        $customers = Customer::find($id);
        
        $filings = Filing::where('customer_id', $id)->get();
        
        return view('pages.filing.show', compact('customers','filings','detail_house'));
    }

    

    
}
