<?php

namespace App\Http\Controllers;
use Illuminate\Support\Facades\Validator;
use Illuminate\Validation\Rule;
use Illuminate\Support\Facades\File;
use App\Models\PrefectureRegion;
use App\Models\CityRegion;
use App\Models\Shop;
use App\Models\Shoprole;
use App\Models\Shopimage;
use App\Models\ShopBackpay;
use App\Models\ShopBackpayrole;
use App\Models\ShopDeducte;
use App\Models\ShopDeducterole;
use App\Models\ShopPenalty;
use App\Models\ShopPenaltyrole;
use App\Models\ShopTransport;
use App\Models\ShopTransportrole;
use App\Models\ShopOther;
use App\Models\ShopOtherrole;
use App\Models\Additem;
use App\Models\Shopcategory;
use App\Models\PhoneNumber;
use Illuminate\Http\Request;

class ShopcreateController extends Controller
{
    public function getCity(Request $request)
    {
        $data = CityRegion::where('prefecture_id', $request->pref_id)->get();
        return response()->json($data);
    }

    public function store(Request $request)
    {
        $request->validate([
            'name' => ['required', 'string', 'max:255']
        ]);
        $newShop = new Shop;
        $newShop->name = $request->name;
        $newShop->category_id = $request->category;
        $newShop->prefecture_id = $request->prefecture_id;
        $newShop->area_id = $request->area_id;
        $newShop->address = $request->address;
        $newShop->affiliated_stores = $request->affiliated_stores;
        $newShop->business_time = $request->business_time;
        $newShop->identification = $request->identification;
        $newShop->costume = $request->costume;
        $newShop->main_vip = $request->main_vip;
        $newShop->age_shift_week = $request->age_shift_week;
        $newShop->salary_system = $request->salary_system;
        if ($newShop->save()) {
            $newShop_role = new Shoprole;
            $newShop_role->shop_id = $newShop->id;
            $request->name_role == "on" ? $newShop_role->name_role = "1" : $newShop_role->name_role = "0";
            $request->category_role == "on" ? $newShop_role->category_id_role = "1" : $newShop_role->category_id_role = "0";
            $request->prefecture_id_role == "on" ? $newShop_role->prefecture_id_role = "1" : $newShop_role->prefecture_id_role = "0";
            $request->area_id_role == "on" ? $newShop_role->area_id_role = "1" : $newShop_role->area_id_role = "0";
            $request->address_role == "on" ? $newShop_role->address_role = "1" : $newShop_role->address_role = "0";
            $request->affiliated_stores_role == "on" ? $newShop_role->affiliated_stores_role = "1" : $newShop_role->affiliated_stores_role = "0";
            $request->business_time_role == "on" ? $newShop_role->business_time_role = "1" : $newShop_role->business_time_role = "0";
            $request->identification_role == "on" ? $newShop_role->identification_role = "1" : $newShop_role->identification_role = "0";
            $request->costume_role == "on" ? $newShop_role->costume_role = "1" : $newShop_role->costume_role = "0";
            $request->main_vip_role == "on" ? $newShop_role->main_vip_role = "1" : $newShop_role->main_vip_role = "0";
            $request->age_shift_week_role == "on" ? $newShop_role->age_shift_week_role = "1" : $newShop_role->age_shift_week_role = "0";
            $request->salary_system_role == "on" ? $newShop_role->salary_system_role = "1" : $newShop_role->salary_system_role = "0";
            $newShop_role->save();
        }
        for ($i=1; $i < 6; $i++) {
            $image = $request->file('image_'.$i);
            if ($image) {
                $folderName = $request->name;
                $destinationPath = 'uploads/all/'. $folderName;
                $profileImage = date('YmdHis') . $i . "." . $image->getClientOriginalExtension();
                $image->move($destinationPath, $profileImage);

                $newImage = new Shopimage;
                $newImage->shop_id = $newShop->id;
                $newImage->image = $destinationPath."/".$profileImage;
                $newImage->save();
            }
        }
        $newShopBackpay = new ShopBackpay;
        $newShopBackpay->shop_id = $newShop->id;
        $newShopBackpay->honin_back = $request->honin_back;
        $newShopBackpay->accompanying_customers = $request->accompanying_customers;
        $newShopBackpay->on_site_back = $request->on_site_back;
        $newShopBackpay->drink_back = $request->drink_back;
        $newShopBackpay->bottle_champagene_back = $request->bottle_champagene_back;
        $newShopBackpay->cost_bottle = $request->cost_bottle;
        if ($newShopBackpay->save()) {
            $newShopBackpayrole = new ShopBackpayrole;
            $newShopBackpayrole->shop_back_id = $newShopBackpay->id;
            $request->honin_back_role == "on" ? $newShopBackpayrole->honin_back_role = "1" : $newShopBackpayrole->honin_back_role = "0";
            $request->accompanying_customers_role == "on" ? $newShopBackpayrole->accompanying_customers_role = "1" : $newShopBackpayrole->accompanying_customers_role = "0";
            $request->on_site_back_role == "on" ? $newShopBackpayrole->on_site_back_role = "1" : $newShopBackpayrole->on_site_back_role = "0";
            $request->drink_back_role == "on" ? $newShopBackpayrole->drink_back_role = "1" : $newShopBackpayrole->drink_back_role = "0";
            $request->bottle_champagene_back_role == "on" ? $newShopBackpayrole->bottle_champagene_back_role = "1" : $newShopBackpayrole->bottle_champagene_back_role = "0";
            $request->cost_bottle_role == "on" ? $newShopBackpayrole->cost_bottle_role = "1" : $newShopBackpayrole->cost_bottle_role = "0";
            $newShopBackpayrole->save();
        }
        $newShopDeducte = new ShopDeducte;
        $newShopDeducte->shop_id = $newShop->id;
        $newShopDeducte->income_tax = $request->income_tax;
        $newShopDeducte->welfare_expense = $request->welfare_expense;
        $newShopDeducte->cost_hair = $request->cost_hair;
        $newShopDeducte->costume_rental_fee = $request->costume_rental_fee;
        if ($newShopDeducte->save()) {
            $newShopDeducterole = new ShopDeducterole;
            $newShopDeducterole->shop_deducte_id = $newShopDeducte->id;
            $request->income_tax_role == "on" ? $newShopDeducterole->income_tax_role = "1" : $newShopDeducterole->income_tax_role = "0";
            $request->welfare_expense_role == "on" ? $newShopDeducterole->welfare_expense_role = "1" : $newShopDeducterole->welfare_expense_role = "0";
            $request->cost_hair_role == "on" ? $newShopDeducterole->cost_hair_role = "1" : $newShopDeducterole->cost_hair_role = "0";
            $request->costume_rental_fee_role == "on" ? $newShopDeducterole->costume_rental_fee_role = "1" : $newShopDeducterole->costume_rental_fee_role = "0";
            $newShopDeducterole->save();
        }
        $newShopPenalty = new ShopPenalty;
        $newShopPenalty->shop_id = $newShop->id;
        $newShopPenalty->quota = $request->quota;
        $newShopPenalty->tardiness_penalty = $request->tardiness_penalty;
        $newShopPenalty->begin_n_penalty = $request->begin_n_penalty;
        $newShopPenalty->show_n_penalty = $request->show_n_penalty;
        if ($newShopPenalty->save()) {
            $newShopPenaltyrole = new ShopPenaltyrole;
            $newShopPenaltyrole->shop_penalty_id = $newShopPenalty->id;
            $request->quota_role == "on" ? $newShopPenaltyrole->quota_role = "1" : $newShopPenaltyrole->quota_role = "0";
            $request->tardiness_penalty_role == "on" ? $newShopPenaltyrole->tardiness_penalty_role = "1" : $newShopPenaltyrole->tardiness_penalty_role = "0";
            $request->begin_n_penalty_role == "on" ? $newShopPenaltyrole->begin_n_penalty_role = "1" : $newShopPenaltyrole->begin_n_penalty_role = "0";
            $request->show_n_penalty_role == "on" ? $newShopPenaltyrole->show_n_penalty_role = "1" : $newShopPenaltyrole->show_n_penalty_role = "0";
            $newShopPenaltyrole->save();
        }
        $newShopTransport = new ShopTransport;
        $newShopTransport->shop_id = $newShop->id;
        $newShopTransport->expense = $request->expense;
        $newShopTransport->scope = $request->scope;
        $newShopTransport->time_day = $request->time_day;
        if ($newShopTransport->save()) {
            $newShopTransportrole = new ShopTransportrole;
            $newShopTransportrole->shop_transport_id = $newShopTransport->id;
            $request->expense_role == "on" ? $newShopTransportrole->expense_role = "1" : $newShopTransportrole->expense_role = "0";
            $request->scope_role == "on" ? $newShopTransportrole->scope_role = "1" : $newShopTransportrole->scope_role = "0";
            $request->time_day_role == "on" ? $newShopTransportrole->time_day_role = "1" : $newShopTransportrole->time_day_role = "0";
            $newShopTransportrole->save();
        }
        $newShopOther = new ShopOther;
        $newShopOther->shop_id = $newShop->id;
        $newShopOther->clientele = $request->clientele;
        $newShopOther->dormitory = $request->dormitory;
        $newShopOther->shop_pr = $request->shop_pr;
        if ($newShopOther->save()) {
            $newShopOtherrole = new ShopOtherrole;
            $newShopOtherrole->shop_other_id = $newShopOther->id;
            $request->clientele_role == "on" ? $newShopOtherrole->clientele_role = "1" : $newShopOtherrole->clientele_role = "0";
            $request->dormitory_role == "on" ? $newShopOtherrole->dormitory_role = "1" : $newShopOtherrole->dormitory_role = "0";
            $request->shop_pr_role == "on" ? $newShopOtherrole->shop_pr_role = "1" : $newShopOtherrole->shop_pr_role = "0";
            $newShopOtherrole->save();
        }
        $i = 1;
        do {
            $add_item = new Additem;
            $add_item->shop_id = $newShop->id;
            $add_item->add_item_label = $request["item_label_" . $i];
            $add_item->add_item_content = $request["item_content_" . $i];
            $request["item_role_" . $i] == "on" ? $add_item->add_item_role = "1" : $add_item->add_item_role = "0";
            $add_item->save();
            $i++;
        } while (isset($request["item_label_" . $i]));

        return redirect()->route('dashboard');
    }

    public function detail(Request $request, $id)
    {
        $images = Shopimage::where('shop_id', $id)->get();
        $shop = Shop::find($id);
        $shop_role = Shoprole::where('shop_id', $id)->first();
        $shop_prefecture = PrefectureRegion::find($shop->prefecture_id);
        $shop_area = CityRegion::find($shop->area_id);
        $shop_back_pay = ShopBackpay::where('shop_id', $id)->first();
        $shop_back_pay_role = ShopBackpayrole::where('shop_back_id', $shop_back_pay->id)->first();
        $shop_deducte = ShopDeducte::where('shop_id', $id)->first();
        $shop_deducte_role = ShopDeducterole::where('shop_deducte_id', $shop_deducte->id)->first();
        $shop_penalty = ShopPenalty::where('shop_id', $id)->first();
        $shop_penalty_role = ShopPenaltyrole::where('shop_penalty_id', $shop_penalty->id)->first();
        $shop_transport = ShopTransport::where('shop_id', $id)->first();
        $shop_transport_role = ShopTransportrole::where('shop_transport_id', $shop_transport->id)->first();
        $shop_other = ShopOther::where('shop_id', $id)->first();
        $shop_other_role = ShopOtherrole::where('shop_other_id', $shop_other->id)->first();
        $add_items = Additem::where('shop_id', $id)->get();
        return view('shopDetail', compact('images', 'shop', 'shop_role', 'shop_prefecture', 'shop_area', 'shop_back_pay', 'shop_back_pay_role', 'shop_deducte', 'shop_deducte_role', 'shop_penalty', 'shop_penalty_role','shop_transport','shop_transport_role','shop_other','shop_other_role', 'add_items'));
    }

    public function edit(Request $request, $id)
    {
        $images = Shopimage::where('shop_id', $id)->get();
        $shop = Shop::find($id);
        $shop_role = Shoprole::where('shop_id', $id)->first();
        // $shop_prefecture = PrefectureRegion::find($shop->prefecture_id);
        $shop_area = CityRegion::where('prefecture_id', $shop->prefecture_id)->get();
        $shop_back_pay = ShopBackpay::where('shop_id', $id)->first();
        $shop_back_pay_role = ShopBackpayrole::where('shop_back_id', $shop_back_pay->id)->first();
        $shop_deducte = ShopDeducte::where('shop_id', $id)->first();
        $shop_deducte_role = ShopDeducterole::where('shop_deducte_id', $shop_deducte->id)->first();
        $shop_penalty = ShopPenalty::where('shop_id', $id)->first();
        $shop_penalty_role = ShopPenaltyrole::where('shop_penalty_id', $shop_penalty->id)->first();
        $shop_transport = ShopTransport::where('shop_id', $id)->first();
        $shop_transport_role = ShopTransportrole::where('shop_transport_id', $shop_transport->id)->first();
        $shop_other = ShopOther::where('shop_id', $id)->first();
        $shop_other_role = ShopOtherrole::where('shop_other_id', $shop_other->id)->first();
        $add_items = Additem::where('shop_id', $id)->get();
        return view('shopEdit', compact('images', 'shop', 'shop_role', 'shop_area', 'shop_back_pay', 'shop_back_pay_role', 'shop_deducte', 'shop_deducte_role', 'shop_penalty', 'shop_penalty_role','shop_transport','shop_transport_role','shop_other','shop_other_role', 'add_items'));
    }

    public function update(Request $request)
    {
        $updateshop = Shop::find($request->shop_id);
        $updateshop->name = $request->name;
        $updateshop->category_id = $request->category;
        $updateshop->prefecture_id = $request->prefecture_id;
        $updateshop->area_id = $request->area_id;
        $updateshop->address = $request->address;
        $updateshop->affiliated_stores = $request->affiliated_stores;
        $updateshop->business_time = $request->business_time;
        $updateshop->identification = $request->identification;
        $updateshop->costume = $request->costume;
        $updateshop->main_vip = $request->main_vip;
        $updateshop->age_shift_week = $request->age_shift_week;
        $updateshop->salary_system = $request->salary_system;
        if ($updateshop->save()) {
            $updateShop_role = Shoprole::find($request->role_id);
            $request->name_role == "on" ? $updateShop_role->name_role = "1" : $updateShop_role->name_role = "0";
            $request->category_role == "on" ? $updateShop_role->category_id_role = "1" : $updateShop_role->category_id_role = "0";
            $request->prefecture_id_role == "on" ? $updateShop_role->prefecture_id_role = "1" : $updateShop_role->prefecture_id_role = "0";
            $request->area_id_role == "on" ? $updateShop_role->area_id_role = "1" : $updateShop_role->area_id_role = "0";
            $request->address_role == "on" ? $updateShop_role->address_role = "1" : $updateShop_role->address_role = "0";
            $request->affiliated_stores_role == "on" ? $updateShop_role->affiliated_stores_role = "1" : $updateShop_role->affiliated_stores_role = "0";
            $request->business_time_role == "on" ? $updateShop_role->business_time_role = "1" : $updateShop_role->business_time_role = "0";
            $request->identification_role == "on" ? $updateShop_role->identification_role = "1" : $updateShop_role->identification_role = "0";
            $request->costume_role == "on" ? $updateShop_role->costume_role = "1" : $updateShop_role->costume_role = "0";
            $request->main_vip_role == "on" ? $updateShop_role->main_vip_role = "1" : $updateShop_role->main_vip_role = "0";
            $request->age_shift_week_role == "on" ? $updateShop_role->age_shift_week_role = "1" : $updateShop_role->age_shift_week_role = "0";
            $request->salary_system_role == "on" ? $updateShop_role->salary_system_role = "1" : $updateShop_role->salary_system_role = "0";
            $updateShop_role->save();
        }
        for ($i=1; $i < 6; $i++) {
            $newImage = $request->file('new_image_'.$i);
            $image = $request->file('image_'.$i);
            $image_id = $request->image_id_."$i";
            if ($newImage) {
                $folderName = $request->name;
                $destinationPath = 'uploads/all/'. $folderName;
                $profileImage = date('YmdHis') . $i . "." . $newImage->getClientOriginalExtension();
                $newImage->move($destinationPath, $profileImage);

                $newImage = new Shopimage;
                $newImage->shop_id = $updateshop->id;
                $newImage->image = $destinationPath."/".$profileImage;
                $newImage->save();
            }
            if ($image) {
                $folderName = $request->name;
                $destinationPath = 'uploads/all/'. $folderName;
                $profileImage = date('YmdHis') . $i . "." . $image->getClientOriginalExtension();
                $image->move($destinationPath, $profileImage);

                $updateImage = Shopimage::find($image_id);
                $updateImage->shop_id = $updateshop->id;
                $updateImage->image = $destinationPath."/".$profileImage;
                $updateImage->save();
            }
        }
        $updateShopBackpay = ShopBackpay::find($request->shop_id);
        $updateShopBackpay->honin_back = $request->honin_back;
        $updateShopBackpay->accompanying_customers = $request->accompanying_customers;
        $updateShopBackpay->on_site_back = $request->on_site_back;
        $updateShopBackpay->drink_back = $request->drink_back;
        $updateShopBackpay->bottle_champagene_back = $request->bottle_champagene_back;
        $updateShopBackpay->cost_bottle = $request->cost_bottle;
        if ($updateShopBackpay->save()) {
            $updateShopBackpayrole = ShopBackpayrole::find($updateShopBackpay->id);
            $updateShopBackpayrole->shop_back_id = $updateShopBackpay->id;
            $request->honin_back_role == "on" ? $updateShopBackpayrole->honin_back_role = "1" : $updateShopBackpayrole->honin_back_role = "0";
            $request->accompanying_customers_role == "on" ? $updateShopBackpayrole->accompanying_customers_role = "1" : $updateShopBackpayrole->accompanying_customers_role = "0";
            $request->on_site_back_role == "on" ? $updateShopBackpayrole->on_site_back_role = "1" : $updateShopBackpayrole->on_site_back_role = "0";
            $request->drink_back_role == "on" ? $updateShopBackpayrole->drink_back_role = "1" : $updateShopBackpayrole->drink_back_role = "0";
            $request->bottle_champagene_back_role == "on" ? $updateShopBackpayrole->bottle_champagene_back_role = "1" : $updateShopBackpayrole->bottle_champagene_back_role = "0";
            $request->cost_bottle_role == "on" ? $updateShopBackpayrole->cost_bottle_role = "1" : $updateShopBackpayrole->cost_bottle_role = "0";
            $updateShopBackpayrole->save();
        }
        $updateShopDeducte = ShopDeducte::find($request->shop_id);
        $updateShopDeducte->income_tax = $request->income_tax;
        $updateShopDeducte->welfare_expense = $request->welfare_expense;
        $updateShopDeducte->cost_hair = $request->cost_hair;
        $updateShopDeducte->costume_rental_fee = $request->costume_rental_fee;
        if ($updateShopDeducte->save()) {
            $updateShopDeducterole = ShopDeducterole::find($updateShopDeducte->id);
            $request->income_tax_role == "on" ? $updateShopDeducterole->income_tax_role = "1" : $updateShopDeducterole->income_tax_role = "0";
            $request->welfare_expense_role == "on" ? $updateShopDeducterole->welfare_expense_role = "1" : $updateShopDeducterole->welfare_expense_role = "0";
            $request->cost_hair_role == "on" ? $updateShopDeducterole->cost_hair_role = "1" : $updateShopDeducterole->cost_hair_role = "0";
            $request->costume_rental_fee_role == "on" ? $updateShopDeducterole->costume_rental_fee_role = "1" : $updateShopDeducterole->costume_rental_fee_role = "0";
            $updateShopDeducterole->save();
        }
        $updateShopPenalty = ShopPenalty::find($request->shop_id);
        $updateShopPenalty->quota = $request->quota;
        $updateShopPenalty->tardiness_penalty = $request->tardiness_penalty;
        $updateShopPenalty->begin_n_penalty = $request->begin_n_penalty;
        $updateShopPenalty->show_n_penalty = $request->show_n_penalty;
        if ($updateShopPenalty->save()) {
            $updateShopPenaltyrole = ShopPenaltyrole::find($updateShopPenalty->id);
            $request->quota_role == "on" ? $updateShopPenaltyrole->quota_role = "1" : $updateShopPenaltyrole->quota_role = "0";
            $request->tardiness_penalty_role == "on" ? $updateShopPenaltyrole->tardiness_penalty_role = "1" : $updateShopPenaltyrole->tardiness_penalty_role = "0";
            $request->begin_n_penalty_role == "on" ? $updateShopPenaltyrole->begin_n_penalty_role = "1" : $updateShopPenaltyrole->begin_n_penalty_role = "0";
            $request->show_n_penalty_role == "on" ? $updateShopPenaltyrole->show_n_penalty_role = "1" : $updateShopPenaltyrole->show_n_penalty_role = "0";
            $updateShopPenaltyrole->save();
        }
        $updateShopTransport = ShopTransport::find($request->shop_id);
        $updateShopTransport->expense = $request->expense;
        $updateShopTransport->scope = $request->scope;
        $updateShopTransport->time_day = $request->time_day;
        if ($updateShopTransport->save()) {
            $updateShopTransportrole = ShopTransportrole::find($updateShopTransport->id);
            $request->expense_role == "on" ? $updateShopTransportrole->expense_role = "1" : $updateShopTransportrole->expense_role = "0";
            $request->scope_role == "on" ? $updateShopTransportrole->scope_role = "1" : $updateShopTransportrole->scope_role = "0";
            $request->time_day_role == "on" ? $updateShopTransportrole->time_day_role = "1" : $updateShopTransportrole->time_day_role = "0";
            $updateShopTransportrole->save();
        }
        $updateShopOther = ShopOther::find($request->shop_id);
        $updateShopOther->clientele = $request->clientele;
        $updateShopOther->dormitory = $request->dormitory;
        $updateShopOther->shop_pr = $request->shop_pr;
        if ($updateShopOther->save()) {
            $updateShopOtherrole = ShopOtherrole::find($updateShopOther->id);
            $request->clientele_role == "on" ? $updateShopOtherrole->clientele_role = "1" : $updateShopOtherrole->clientele_role = "0";
            $request->dormitory_role == "on" ? $updateShopOtherrole->dormitory_role = "1" : $updateShopOtherrole->dormitory_role = "0";
            $request->shop_pr_role == "on" ? $updateShopOtherrole->shop_pr_role = "1" : $updateShopOtherrole->shop_pr_role = "0";
            $updateShopOtherrole->save();
        }
        $i = 1;
        do {
            if (isset($request["item_id_" . $i])) {
                $add_item = Additem::find($request["item_id_" . $i]);
                $add_item->shop_id = $updateshop->id;
                $add_item->add_item_label = $request["item_label_" . $i];
                $add_item->add_item_content = $request["item_content_" . $i];
                $request["item_role_" . $i] == "on" ? $add_item->add_item_role = "1" : $add_item->add_item_role = "0";
                $add_item->save();
            } else {
                $add_item = new Additem;
                $add_item->shop_id = $updateshop->id;
                $add_item->add_item_label = $request["item_label_" . $i];
                $add_item->add_item_content = $request["item_content_" . $i];
                $request["item_role_" . $i] == "on" ? $add_item->add_item_role = "1" : $add_item->add_item_role = "0";
                $add_item->save();
            }
            $i++;
        } while (isset($request["item_label_" . $i]));
        return redirect()->route('shop.detail', $request->shop_id);
        // return back();
    }

    public function delete(Request $request)
    {
        $shopId = $request->shop_id;
        $shop = Shop::find($shopId);
        if($shop->delete()){
            $image = Shopimage::where('shop_id', $shopId)->get();
            foreach ($image as $value) {
                $path = public_path() . "uploads/all/" . $shop->name;
                $folderpath = dirname($path);
                File::deleteDirectory($folderpath);
                $value->delete();
            }
    
            $shop_role = Shoprole::where('shop_id', $shopId)->first();
            if($shop_role->delete()){
                $shop_add_item = Additem::where('shop_id', $shopId)->get();
                foreach ($shop_add_item as $value) {
                    $value->delete();
                }
            }
        }
        $shop_back_pay = ShopBackpay::where('shop_id', $shopId)->first();
        $shop_back_pay_role = ShopBackpayrole::where('shop_back_id', $shop_back_pay->id)->first();
        if ($shop_back_pay_role->delete()) {
            $shop_back_pay->delete();
        }
        $shop_deducte = ShopDeducte::where('shop_id', $shopId)->first();
        $shop_deducte_role = ShopDeducterole::where('shop_deducte_id', $shop_deducte->id)->first();
        if ($shop_deducte_role->delete()) {
            $shop_deducte->delete();
        }
        $shop_penalty = ShopPenalty::where('shop_id', $shopId)->first();
        $shop_penalty_role = ShopPenaltyrole::where('shop_penalty_id', $shop_penalty->id)->first();
        if ($shop_penalty_role->delete()) {
            $shop_penalty->delete();
        }
        $shop_transport = ShopTransport::where('shop_id', $shopId)->first();
        $shop_transport_role = ShopTransportrole::where('shop_transport_id', $shop_transport->id)->first();
        if ($shop_transport_role->delete()) {
            $shop_transport->delete();
        }
        $shop_other = ShopOther::where('shop_id', $shopId)->first();
        $shop_other_role = ShopOtherrole::where('shop_other_id', $shop_other->id)->first();
        if ($shop_other_role->delete()) {
            $shop_other->delete();
        }
        return redirect()->route('dashboard');
    }

    public function shopCategory(Request $request)
    {
        $categories = Shopcategory::all();
        return view('shopCategory', compact('categories'));
    }

    public function getCategory(Request $request)
    {
        $category = Shopcategory::find($request->category_id);
        return response()->json($category);
    }

    public function categoryCreate(Request $request)
    {
        if ($request->category_id == 0) {
            $category = new ShopCategory;
        } else {
            $category = ShopCategory::find($request->category_id);
        }
        $category->name = $request->category_name;
        $category->save();
        return redirect()->route('shop.category');
    }

    public function categoryDelete(Request $request) 
    {
        $category = ShopCategory::find($request->category_id);
        $category->delete();
    }
    
    public function areaCreate(Request $request)
    {
        $prefecture = PrefectureRegion::all();
        $area = CityRegion::all();
        return view('shopArea', compact('area', 'prefecture'));
    }

    public function areaStore(Request $request)
    {
        if($request->area_id == 0) {
            $area = new CityRegion;
        } else {
            $area = CityRegion::find($request->area_id);
        }
        $area->prefecture_id = $request->prefecture_name;
        $area->name = $request->area_name;
        $area->save();
        return redirect()->route('shop.area');
    }

    public function getArea(Request $request)
    {
        $prefecture = PrefectureRegion::all();
        $area = CityRegion::where('id', $request->area_id)->get();
        return response()->json(['area' => $area, 'prefecture' => $prefecture]);
    }

    public function areaDelete(Request $request)
    {
        $area = CityRegion::find($request->area_id);
        $area->delete();
    }

    public function phoneCreate(Request $request) {
        $newPhone = new PhoneNumber;
        $newPhone->prefecture_id = $request->prefecture_id;
        $newPhone->shop_name = $request->shop_name;
        $newPhone->representative = $request->representative;
        $newPhone->phonenumber = $request->phone_number;
        $newPhone->save();
        return redirect()->route('dashboard');
    }
    public function phoneUpdate(Request $request) {
        $updatePhone = PhoneNumber::find($request->phone_id);
        $updatePhone->prefecture_id = $request->prefecture_id;
        $updatePhone->shop_name = $request->shop_name;
        $updatePhone->representative = $request->representative;
        $updatePhone->phonenumber = $request->phone_number;
        $updatePhone->save();
        return redirect()->route('phone.edit');
    }

    public function phonelist(Request $request) {
        $phonenumbers = PhoneNumber::all();
        return view('phoneList', compact('phonenumbers'));
    }

    public function phoneGet(Request $request) {
        $prefecture = PrefectureRegion::all();
        $getphone = PhoneNumber::find($request->phone_id);
        return response()->json([
            'getphone' => $getphone,
            'prefectures' => $prefecture
        ]);
    }

    public function phoneDelete(Request $request) {
        $phone = PhoneNumber::find($request->phone_id);
        $phone->delete();
    }

    public function imageDelete(Request $request) {
        $image = Shopimage::find($request->id);
        $image->delete();
    }
}
