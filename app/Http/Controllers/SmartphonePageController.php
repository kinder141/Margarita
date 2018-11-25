<?php

namespace App\Http\Controllers;

use App\Smartphone;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Redis;

class SmartphonePageController extends Controller
{
    public function __invoke(Request $request)
    {
        $smartphones = Smartphone::query();

        if (!empty($request->all())) {
            $data = array_filter($request->all(), function ($item) {
                return $item != null;
            });

            if (array_key_exists('from', $data)) {
                $smartphones->where('price', '>=', $data['from']);
            }
            if (array_key_exists('to', $data)) {
                $smartphones->where('price', '<=', $data['to']);
            }
            if (array_key_exists('checkbox16', $data)) {
                $smartphones->where('capacity', '>=', $data['checkbox16']);
            }
            if (array_key_exists('checkbox32', $data)) {
                $smartphones->where('capacity', '>=', $data['checkbox32']);
            }
            if (array_key_exists('checkbox64', $data)) {
                $smartphones->where('capacity', '>=', $data['checkbox64']);
            }
            if (array_key_exists('checkbox128', $data)) {
                $smartphones->where('capacity', '>=', $data['checkbox128']);
            }
            if (array_key_exists('checkbox256', $data)) {
                $smartphones->where('capacity', '>=', $data['checkbox256']);
            }
            if (array_key_exists('name', $data)) {
                $smartphones->where('name', 'like', '%' . $data['name'] . '%');
            }
        }

        $stored = [];

        if (!Auth::guest()) {
            $id = Auth::user()->getAuthIdentifier();
            $key = $id . ':smartphones';

            if(Redis::get($id) != 'smartphones') {
                $keys = Redis::keys($id . ':*');
                if ($keys) {
                    Redis::del(Redis::keys($id . ':*'));
                }
                Redis::set($id, 'smartphones');
            }

            if (isset($data)) {
                Redis::del($key);

                if (!empty($data)) {
                    Redis::hmset($key, $data);
                } else {
                    return redirect()->route('smartphones');
                }
            }

            $stored = Redis::hgetall($key);

            if (empty($request->all())) {
                if (array_key_exists('from', $stored)) {
                    $smartphones->where('price', '>=', $stored['from']);
                }
                if (array_key_exists('to', $stored)) {
                    $smartphones->where('price', '<=', $stored['to']);
                }
                if (array_key_exists('checkbox16', $stored)) {
                    $smartphones->where('capacity', '>=', $stored['checkbox16']);
                }
                if (array_key_exists('checkbox32', $stored)) {
                    $smartphones->where('capacity', '>=', $stored['checkbox32']);
                }
                if (array_key_exists('checkbox64', $stored)) {
                    $smartphones->where('capacity', '>=', $stored['checkbox64']);
                }
                if (array_key_exists('checkbox128', $stored)) {
                    $smartphones->where('capacity', '>=', $stored['checkbox128']);
                }
                if (array_key_exists('checkbox256', $stored)) {
                    $smartphones->where('capacity', '>=', $stored['checkbox256']);
                }
                if (array_key_exists('name', $stored)) {
                    $smartphones->where('name', 'like', '%' . $stored['name'] . '%');
                }
            }
        } else {
            if (isset($data)) {
                $stored = $data;
            }
        }

        $smartphones = $smartphones->get();

        return view('categories.smartphones', ['products' => $smartphones, 'data' => $stored]);
    }
}
