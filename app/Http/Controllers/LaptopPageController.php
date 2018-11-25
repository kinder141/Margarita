<?php

namespace App\Http\Controllers;

use App\Laptop;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Redis;

class LaptopPageController extends Controller
{
    public function __invoke(Request $request)
    {
        $laptops = Laptop::query();

        if (!empty($request->all())) {
            $data = array_filter($request->all(), function ($item) {
                return $item != null;
            });


            if (array_key_exists('from', $data)) {
                $laptops->where('price', '>=', $data['from']);
            }
            if (array_key_exists('to', $data)) {
                $laptops->where('price', '<=', $data['to']);
            }
            if (array_key_exists('checkbox2', $data)) {
                $laptops->where('ram', '>=', $data['checkbox2']);
            }
            if (array_key_exists('checkbox4', $data)) {
                $laptops->where('ram', '>=', $data['checkbox4']);
            }
            if (array_key_exists('checkbox8', $data)) {
                $laptops->where('ram', '>=', $data['checkbox8']);
            }
            if (array_key_exists('checkbox16', $data)) {
                $laptops->where('ram', '>=', $data['checkbox16']);
            }
            if (array_key_exists('video', $data)) {
                $laptops->where('video', '=', $data['video']);
            }
        }

        $stored = [];

        if (!Auth::guest()) {
            $id = Auth::user()->getAuthIdentifier();
            $key = $id . ':laptops';

            if(Redis::get($id) != 'laptops') {
                $keys = Redis::keys($id . ':*');
                if ($keys) {
                    Redis::del(Redis::keys($id . ':*'));
                }

                Redis::set($id, 'laptops');
            }

            if (isset($data)) {
                Redis::del($key);

                if (!empty($data)) {
                    Redis::hmset($key, $data);
                } else {
                    return redirect()->route('laptops');
                }
            }

            $stored = Redis::hgetall($key);

            if (empty($request->all())) {
                if (array_key_exists('from', $stored)) {
                    $laptops->where('price', '>=', $stored['from']);
                }
                if (array_key_exists('to', $stored)) {
                    $laptops->where('price', '<=', $stored['to']);
                }
                if (array_key_exists('checkbox2', $stored)) {
                    $laptops->where('ram', '>=', $stored['checkbox2']);
                }
                if (array_key_exists('checkbox4', $stored)) {
                    $laptops->where('ram', '>=', $stored['checkbox4']);
                }
                if (array_key_exists('checkbox8', $stored)) {
                    $laptops->where('ram', '>=', $stored['checkbox8']);
                }
                if (array_key_exists('checkbox16', $stored)) {
                    $laptops->where('ram', '>=', $stored['checkbox16']);
                }
                if (array_key_exists('video', $stored)) {
                    $laptops->where('video', '=', $stored['video']);
                }
            }
        } else {
            if (isset($data)) {
                $stored = $data;
            }
        }

        $laptops = $laptops->get();

        return view('categories.laptops', ['products' => $laptops, 'data' => $stored]);
    }
}
