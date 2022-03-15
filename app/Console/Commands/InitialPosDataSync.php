<?php

namespace App\Console\Commands;

use App\Models\Offer;
use App\Models\Product;
use App\Models\ProductClass;
use App\Models\Size;
use App\Models\Store;
use App\Models\System;
use App\Models\Variation;
use App\Utils\ProductUtil;
use App\Utils\Util;
use Carbon\Carbon;
use Illuminate\Console\Command;
use Illuminate\Support\Facades\Http;
use Illuminate\Support\Facades\Session;

class InitialPosDataSync extends Command
{
    /**
     * All Utils instance.
     *
     */
    protected $commonUtil;
    protected $productUtil;

    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'restaurant:initialPosDataSync';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Initial Pos Data Sync';

    /**
     * Create a new command instance.
     *
     * @return void
     */
    public function __construct(Util $commonUtil, ProductUtil $productUtil)
    {
        $this->commonUtil = $commonUtil;
        $this->productUtil = $productUtil;
        parent::__construct();
    }

    /**
     * Execute the console command.
     *
     * @return int
     */
    public function handle()
    {
        $ENABLE_POS_SYNC = env('ENABLE_POS_SYNC', false);
        $POS_SYSTEM_URL = env('POS_SYSTEM_URL', null);
        $POS_ACCESS_TOKEN = env('POS_ACCESS_TOKEN', null);


        if ($ENABLE_POS_SYNC == true && !empty($POS_SYSTEM_URL) && !empty($POS_ACCESS_TOKEN)) {


            //get stores
            $response_stores = Http::withHeaders([
                'Authorization' => 'Bearer ' . $POS_ACCESS_TOKEN,
            ])->get($POS_SYSTEM_URL . '/api/store')->json();

            if ($response_stores['success']) {
                $stores = $response_stores['data'];
                $keep_stores = [];
                foreach ($stores as $store) {
                    $keep_stores[] = $store['id'];
                    $store_exist = Store::where('pos_model_id', $store['id'])->first();
                    if (empty($store_exist)) {
                        $store_data = [
                            'name' => $store['name'],
                            'location' => $store['location'],
                            'phone_number' => $store['phone_number'],
                            'email' => $store['email'],
                            'manager_name' => $store['manager_name'],
                            'manager_mobile_number' => $store['manager_mobile_number'],
                            'details' => $store['details'],
                            'created_by' => null,
                            'pos_model_id' => $store['id'],
                            'created_at' => !empty($store['created_at']) ? $store['created_at'] : Carbon::now(),
                            'updated_at' => !empty($store['updated_at']) ? $store['updated_at'] : Carbon::now(),
                        ];
                        Store::create($store_data);
                    } else {
                        $store_data = [
                            'name' => $store['name'],
                            'location' => $store['location'],
                            'phone_number' => $store['phone_number'],
                            'email' => $store['email'],
                            'manager_name' => $store['manager_name'],
                            'manager_mobile_number' => $store['manager_mobile_number'],
                            'details' => $store['details'],
                            'pos_model_id' => $store['id'],
                            'updated_at' => empty($store['updated_at']) ? $store['updated_at'] : Carbon::now(),
                        ];
                        $store_exist->update($store_data);
                    }
                }
                Store::whereNotIn('pos_model_id', $keep_stores)->delete();
            }

            // get sizes
            $response_size = Http::withHeaders([
                'Authorization' => 'Bearer ' . $POS_ACCESS_TOKEN,
            ])->get($POS_SYSTEM_URL . '/api/size')->json();


            if ($response_size['success']) {
                $sizes = $response_size['data'];
                $keep_sizes = [];
                foreach ($sizes as $size) {
                    $keep_sizes[] = $size['id'];
                    $size_exist = Size::where('pos_model_id', $size['id'])->first();
                    if (empty($size_exist)) {
                        $size_data = [
                            'name' => $size['name'],
                            'size_code' => $size['size_code'],
                            'pos_model_id' => $size['id'],
                            'created_at' => !empty($size['created_at']) ? $size['created_at'] : Carbon::now(),
                            'updated_at' => !empty($size['updated_at']) ? $size['updated_at'] : Carbon::now(),
                        ];
                        Size::create($size_data);
                    } else {
                        $size_data = [
                            'name' => $size['name'],
                            'size_code' => $size['size_code'],
                            'pos_model_id' => $size['id'],
                            'updated_at' => empty($size['updated_at']) ? $size['updated_at'] : Carbon::now(),
                        ];
                        $size_exist->update($size_data);
                    }
                }
                Size::whereNotIn('pos_model_id', $keep_sizes)->delete();
            }


            // get product classes
            $response_pc = Http::withHeaders([
                'Authorization' => 'Bearer ' . $POS_ACCESS_TOKEN,
            ])->get($POS_SYSTEM_URL . '/api/product-class')->json();


            if ($response_pc['success']) {
                $i = 1;
                $product_classes = $response_pc['data'];
                $keep_product_classes = [];
                foreach ($product_classes as $product_class) {
                    $keep_product_classes[] = $product_class['id'];
                    $pc_exist = ProductClass::where('pos_model_id', $product_class['id'])->exists();
                    if (empty($pc_exist)) {
                        $pc_data = [
                            'name' => $product_class['name'],
                            'description' => $product_class['description'],
                            'status' => 1,
                            'sort' => $i,
                            'pos_model_id' => $product_class['id'],
                            'created_at' => !empty($product_class['created_at']) ? $product_class['created_at'] : Carbon::now(),
                            'updated_at' => empty($product_class['updated_at']) ? $product_class['updated_at'] : Carbon::now(),
                        ];
                        $pc = ProductClass::create($pc_data);
                        if (!empty($product_class['image'])) {
                            $pc->addMediaFromUrl($product_class['image'])->toMediaCollection('product_class');
                        }
                    } else {
                        $pc_data = [
                            'name' => $product_class['name'],
                            'description' => $product_class['description'],
                            'status' => 1,
                            'pos_model_id' => $product_class['id'],
                            'updated_at' => empty($product_class['updated_at']) ? $product_class['updated_at'] : Carbon::now(),
                        ];
                        $pc = ProductClass::where('pos_model_id', $product_class['id'])->first();
                        $pc->update($pc_data);
                        if (!empty($product_class['image'])) {
                            $pc->clearMediaCollection('product_class');
                            $pc->addMediaFromUrl($product_class['image'])->toMediaCollection('product_class');
                        }
                    }

                    $i++;
                }

                ProductClass::whereNotIn('pos_model_id', $keep_product_classes)->delete();
            }


            //get products
            $response_p = Http::withHeaders([
                'Authorization' => 'Bearer ' . $POS_ACCESS_TOKEN,
            ])->get($POS_SYSTEM_URL . '/api/product')->json();


            if ($response_p['success']) {
                $products = $response_p['data'];
                $keep_products = [];
                foreach ($products as $product) {
                    $p_exist = Product::where('pos_model_id', $product['id'])->exists();
                    if (empty($p_exist)) {
                        $product_class = ProductClass::where('pos_model_id', $product['product_class_id'])->first();

                        $p_data = [
                            'name' => $product['name'],
                            'product_class_id' => $product_class->id ?? null,
                            'sku' => $product['sku'],
                            'multiple_sizes' => $product['multiple_sizes'],
                            'is_service' => $product['is_service'],
                            'product_details' => $product['product_details'],
                            'purchase_price' => $product['purchase_price'],
                            'sell_price' => $product['sell_price'],
                            'discount_type' => $product['discount_type'],
                            'discount' => $product['discount'],
                            'discount_start_date' => $product['discount_start_date'],
                            'discount_end_date' => $product['discount_end_date'],
                            'type' => $product['type'],
                            'active' => $product['active'],
                            'pos_model_id' => $product['id'],
                            'created_by' => 1,
                            'created_at' => !empty($product['created_at']) ? $product['created_at'] : Carbon::now(),
                            'updated_at' => empty($product['updated_at']) ? $product['updated_at'] : Carbon::now(),
                        ];
                        $p = Product::create($p_data);
                        $keep_products[] = $p->id;
                        $variation_formated = [];
                        $variations = $product['variations'];
                        foreach ($variations as $v) {
                            $v['product_id'] = $p->id;
                            if (!empty($v['size_id'])) {
                                $size = Size::where('pos_model_id', $v['size_id'])->first();
                                $v['size_id'] = $size->id ?? null;
                            }
                            $v['pos_model_id'] = $v['id'];
                            unset($v['id']);
                            $variation_formated[] = $v;
                        }

                        $this->productUtil->createOrUpdateVariations($p, $variation_formated);

                        if (!empty($product['image'])) {
                            $p->addMediaFromUrl($product['image'])->toMediaCollection('product');
                        }
                    } else {
                        $product_class = ProductClass::where('pos_model_id', $product['product_class_id'])->first();
                        $p_data = [
                            'name' => $product['name'],
                            'product_class_id' => $product_class->id ?? null,
                            'sku' => $product['sku'],
                            'multiple_sizes' => $product['multiple_sizes'],
                            'is_service' => $product['is_service'],
                            'product_details' => $product['product_details'],
                            'purchase_price' => $product['purchase_price'],
                            'sell_price' => $product['sell_price'],
                            'discount_type' => $product['discount_type'],
                            'discount' => $product['discount'],
                            'discount_start_date' => $product['discount_start_date'],
                            'discount_end_date' => $product['discount_end_date'],
                            'type' => $product['type'],
                            'active' => $product['active'],
                            'pos_model_id' => $product['id'],
                            'created_by' => 1,
                            'updated_at' => empty($product['updated_at']) ? $product['updated_at'] : Carbon::now(),
                        ];
                        $p = Product::where('pos_model_id', $product['id'])->first();
                        $keep_products[] = $p->id;
                        $p->update($p_data);

                        $variation_formated = [];
                        $variations = $product['variations'];
                        foreach ($variations as $v) {
                            $v['product_id'] = $p->id;
                            if (!empty($v['size_id'])) {
                                $size = Size::where('pos_model_id', $v['size_id'])->first();
                                $v['size_id'] = $size->id ?? null;
                            }
                            $v['pos_model_id'] = $v['id'];
                            unset($v['id']);
                            $variation_formated[] = $v;
                        }

                        $this->productUtil->createOrUpdateVariations($p, $variation_formated);

                        if (!empty($product['image'])) {
                            $p->clearMediaCollection('product');
                            $p->addMediaFromUrl($product['image'])->toMediaCollection('product');
                        }
                    }
                }
                Product::whereNotIn('id', $keep_products)->delete();
                Variation::whereNotIn('product_id', $keep_products)->delete();
            }



            //get settings
            $response_setting = Http::withHeaders([
                'Authorization' => 'Bearer ' . $POS_ACCESS_TOKEN,
            ])->get($POS_SYSTEM_URL . '/api/setting')->json();

            if ($response_setting['success']) {
                $settings = $response_setting['data'];

                $logo_url = $POS_SYSTEM_URL . '/uploads/' . rawurlencode($settings['logo']);
                $logo_image = file_get_contents($logo_url);
                file_put_contents(public_path('uploads/' . $settings['logo']), $logo_image);
                System::updateOrCreate(['key' => 'logo'], ['value' => $settings['logo'], 'date_and_time' => Carbon::now(), 'created_by' => 1]);
                System::updateOrCreate(['key' => 'system_email'], ['value' => $settings['sender_email'], 'date_and_time' => Carbon::now(), 'created_by' => 1]);
            }

            //get offers
            $response_offers = Http::withHeaders([
                'Authorization' => 'Bearer ' . $POS_ACCESS_TOKEN,
            ])->get($POS_SYSTEM_URL . '/api/sales-promotion')->json();

            if ($response_offers['success']) {
                $offers = $response_offers['data'];
                $keep_offers = [];
                foreach ($offers as $offer) {
                    $keep_offers[] = $offer['id'];
                    $offer_exist = Offer::where('pos_model_id', $offer['id'])->first();
                    $product_ids = $this->productUtil->getCorrespondingProductIds($offer['product_ids']);
                    if (empty($offer_exist)) {
                        $offer_data = [
                            'name' => $offer['name'],
                            'type' => $offer['type'],
                            'code' => $offer['code'],
                            'product_ids' => $product_ids,
                            'description' => !empty($offer['description']) ? $offer['description'] : null,
                            'discount_type' => $offer['discount_type'],
                            'discount_value' => $offer['discount_value'],
                            'start_date' => $offer['start_date'],
                            'end_date' => $offer['end_date'],
                            'created_by' => null,
                            'pos_model_id' => $offer['id'],
                            'created_at' => !empty($offer['created_at']) ? $offer['created_at'] : Carbon::now(),
                            'updated_at' => !empty($offer['updated_at']) ? $offer['updated_at'] : Carbon::now(),
                        ];
                        Offer::create($offer_data);
                    } else {
                        $offer_data = [
                            'name' => $offer['name'],
                            'type' => $offer['type'],
                            'code' => $offer['code'],
                            'product_ids' => $product_ids,
                            'description' => !empty($offer['description']) ? $offer['description'] : null,
                            'discount_type' => $offer['discount_type'],
                            'discount_value' => $offer['discount_value'],
                            'start_date' => $offer['start_date'],
                            'end_date' => $offer['end_date'],
                            'pos_model_id' => $offer['id'],
                            'updated_at' => empty($offer['updated_at']) ? $offer['updated_at'] : Carbon::now(),
                        ];
                        $offer_exist->update($offer_data);
                    }
                }
                Offer::whereNotIn('pos_model_id', $keep_offers)->delete();
            }
        }
    }
}
