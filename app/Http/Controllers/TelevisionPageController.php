<?php

namespace App\Http\Controllers;

use App\Television;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Redis;

class TelevisionPageController extends Controller
{
    public function __invoke(Request $request)
    {
        $tvs = Television::query();

        if (!empty($request->all())) {
            $data = array_filter($request->all(), function ($item) {
                return $item != null;
            });

            if (array_key_exists('from', $data)) {
                $tvs->where('price', '>=', $data['from']);
            }
            if (array_key_exists('to', $data)) {
                $tvs->where('price', '<=', $data['to']);
            }
            if (array_key_exists('displays', $data)) {
                $tvs->whereIn('display', $data['displays']);

                $displays = $data['displays'];
                unset($data['displays']);

                foreach ($displays as $number => $display) {
                    $data['displays-' . $number] = $display;
                }
            }
            if (array_key_exists('manufacture', $data)) {
                $tvs->where('manufacture', '=', $data['manufacture']);
            }
        }

        $stored = [];

        if (!Auth::guest()) {
            $id = Auth::user()->getAuthIdentifier();
            $key = $id . ':televisions';

            if(Redis::get($id) != 'televisions') {
                $keys = Redis::keys($id . ':*');
                if ($keys) {
                    Redis::del(Redis::keys($id . ':*'));
                }

                Redis::set($id, 'televisions');
            }

            if (isset($data)) {
                Redis::del($key);

                if (!empty($data)) {
                    Redis::hmset($key, $data);
                } else {
                    return redirect()->route('televisions');
                }
            }

            $stored = Redis::hgetall($key);

            if (empty($request->all())) {
                if (array_key_exists('from', $stored)) {
                    $tvs->where('price', '>=', $stored['from']);
                }
                if (array_key_exists('to', $stored)) {
                    $tvs->where('price', '<=', $stored['to']);
                }
                foreach (array_keys($stored) as $key) {
                    if (preg_match_all('/^displays-\d+$/', $key, $matches)) {
                        $data[] = $stored[$key];
                    }
                }

                if (isset($data)) {
                    $tvs->whereIn('display', $data);
                }
                if (array_key_exists('manufacture', $stored)) {
                    $tvs->where('manufacture', '=', $stored['manufacture']);
                }
            }
        } else {
            if (isset($data)) {
                $stored = $data;
            }
        }

        $tvs = $tvs->get();

        $displays = preg_grep('/^displays-/i', array_keys($stored));
        if (!empty($stored)) {
            $stored['displays'] = [];
        }

        foreach ($displays as $display) {
            array_push($stored['displays'], $stored[$display]);
            unset($stored[$display]);
        }

        return view('categories.televisions', ['products' => $tvs, 'data' => $stored]);
    }
}
