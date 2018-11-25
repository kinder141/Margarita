<?php

namespace App\Http\Controllers;

use App\Category;
use App\Laptop;
use App\MongoProduct;
use App\Products;
use App\Smartphone;
use App\Television;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class ProductController extends Controller
{
    public function __invoke($category, $id)
    {
        switch ($category) {
            case 'laptops':
                $product = Laptop::find($id);
                break;
            case 'smartphones':
                $product = Smartphone::find($id);
                break;
            case 'televisions':
                $product = Television::find($id);
                break;
            default:
                $product = null;
                break;
        }

        if (empty($product)) {
            return redirect()->route('laptops');
        }

        $characteristics = $product->getCharacteristics();

        $category = Category::where('name', '=', $category)->first();
        $mongoProduct = MongoProduct::where('product_id', '=', intval($id))->where('category_id', '=', intval($category->id))->first();

        if (!Auth::guest()) {
            $rated = Products::whereIn('order_id', Auth::user()->orders()->get(['id']))->where('product_id', '=', $id)->where('category_id', '=', $category->id)->count();
        } else {
            $rated = false;
        }

        return view('pages.product', compact('product', 'characteristics', 'mongoProduct', 'rated'));
    }

    public function comment(Request $request, $category, $id)
    {
        $category = Category::where('name', '=', $category)->first();
        $mongoProduct = MongoProduct::where('product_id', '=', intval($id))->where('category_id', '=', intval($category->id))->first();
        $comments = $mongoProduct->comments;
        $userId = Auth::id();
        $mark = $request->get('mark');
        if ($userId) {
            $comments = array_map(function ($comment) use ($userId, $mark) {
                if ($comment['user_id'] == $userId) {
                    $comment['mark'] = $mark;
                }

                return $comment;
            }, $comments);

            $marks = [];
            foreach($comments as $comment)
            {
                if(!in_array($comment['user_id'], $marks))
                $marks[] = $comment['mark'];
            }
        }

        array_push($comments, [
            'user_id' => $userId,
            'nickname' => $request->get('nickname'),
            'mark' => $request->get('mark'),
            'text' => $request->get('text')
        ]);
        $mongoProduct->comments = $comments;
        if ($request->has('mark') && $request->get('mark') != 0 && isset($marks)) {
            $average = $this->updateAvaregeMark($marks, $request->get('mark'));

            $mongoProduct->mark = $average;
            $mongoProduct->count += 1;
        }
        $mongoProduct->save();

        return redirect()->back();
    }

    private function updateAvaregeMark($marks, $mark)
    {
        return doubleval((array_sum($marks) + $mark) / (count($marks) + 1));
    }
}
