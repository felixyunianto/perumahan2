<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Customer;
use App\Filing;

class DownloadController extends Controller
{
    public function downloadImage($customer_id){
        $customer = Customer::where('id', $customer_id)->first();
        $file = Filing::where('customer_id', $customer_id)->first();
        $file_path = pathinfo($file->photos);
        $file_download = $file->photos;
        $name_download = 'Foto 3x4 '. $customer->name .'.'.$file_path['extension'];

        $path = public_path(). $file->photos;

        return response()->download($file_download, $name_download, ['Content-Type' => $file->mime]);
    }

    public function downloadIDCard($customer_id){
        $customer = Customer::where('id', $customer_id)->first();
        $file = Filing::where('customer_id', $customer_id)->first();
        $file_path = pathinfo($file->fc_id_card);
        $file_download = $file->fc_id_card;
        $name_download = 'Fotocopy KTP '. $customer->name .'.'.$file_path['extension'];

        $path = public_path(). $file->fc_id_card;

        return response()->download($file_download, $name_download, ['Content-Type' => $file->mime]);
    }

    public function downloadFamilyCard($customer_id){
        $customer = Customer::where('id', $customer_id)->first();
        $file = Filing::where('customer_id', $customer_id)->first();
        $file_path = pathinfo($file->fc_family_card);
        $file_download = $file->fc_family_card;
        $name_download = 'Fotocopy KK '. $customer->name .'.'.$file_path['extension'];

        $path = public_path(). $file->fc_family_card;

        return response()->download($file_download, $name_download, ['Content-Type' => $file->mime]);
    }

    public function downloadMarriage($customer_id){
        $customer = Customer::where('id', $customer_id)->first();
        $file = Filing::where('customer_id', $customer_id)->first();
        $file_path = pathinfo($file->fc_marriage_certificate);
        $file_download = $file->fc_marriage_certificate;
        $name_download = 'Fotocopy Surat Nikah '. $customer->name .'.'.$file_path['extension'];

        $path = public_path(). $file->fc_marriage_certificate;

        return response()->download($file_download, $name_download, ['Content-Type' => $file->mime]);
    }

    public function downloadTaxpayer($customer_id){
        $customer = Customer::where('id', $customer_id)->first();
        $file = Filing::where('customer_id', $customer_id)->first();
        $file_path = pathinfo($file->fc_taxpayer_identification);
        $file_download = $file->fc_taxpayer_identification;
        $name_download = 'Fotocopy NPWP '. $customer->name .'.'.$file_path['extension'];

        $path = public_path(). $file->fc_taxpayer_identification;

        return response()->download($file_download, $name_download, ['Content-Type' => $file->mime]);
    }

    public function downloadTaxStatus($customer_id){
        $customer = Customer::where('id', $customer_id)->first();
        $file = Filing::where('customer_id', $customer_id)->first();
        $file_path = pathinfo($file->tax_status);
        $file_download = $file->tax_status;
        $name_download = 'Surat Keteragan Kerja atau SIUP '. $customer->name .'.'.$file_path['extension'];

        $path = public_path(). $file->tax_status;

        return response()->download($file_download, $name_download, ['Content-Type' => $file->mime]);
    }

    public function downloadIncome($customer_id){
        $customer = Customer::where('id', $customer_id)->first();
        $file = Filing::where('customer_id', $customer_id)->first();
        $file_path = pathinfo($file->income);
        $file_download = $file->income;
        $name_download = 'Slip Gaji atau Pemasukan '. $customer->name .'.'.$file_path['extension'];

        $path = public_path(). $file->income;

        return response()->download($file_download, $name_download, ['Content-Type' => $file->mime]);
    }
    
    public function downloadCurrentAccount($customer_id){
        $customer = Customer::where('id', $customer_id)->first();
        $file = Filing::where('customer_id', $customer_id)->first();
        $file_path = pathinfo($file->current_account);
        $file_download = $file->current_account;
        $name_download = 'Rekening Koran '. $customer->name .'.'.$file_path['extension'];

        $path = public_path(). $file->current_account;

        return response()->download($file_download, $name_download, ['Content-Type' => $file->mime]);
    }

    public function downloadSaving($customer_id){
        $customer = Customer::where('id', $customer_id)->first();
        $file = Filing::where('customer_id', $customer_id)->first();
        $file_path = pathinfo($file->saving);
        $file_download = $file->saving;
        $name_download = 'Tabungan BTN '. $customer->name .'.'.$file_path['extension'];

        $path = public_path(). $file->saving;

        return response()->download($file_download, $name_download, ['Content-Type' => $file->mime]);
    }

    public function downloadHaventHouse($customer_id){
        $customer = Customer::where('id', $customer_id)->first();
        $file = Filing::where('customer_id', $customer_id)->first();
        $file_path = pathinfo($file->ls_havent_house);
        $file_download = $file->ls_havent_house;
        $name_download = 'Surat Keterangan Tidak Punya Rumah '. $customer->name .'.'.$file_path['extension'];

        $path = public_path(). $file->ls_havent_house;

        return response()->download($file_download, $name_download, ['Content-Type' => $file->mime]);
    }
    
}
