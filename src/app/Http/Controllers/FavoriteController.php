<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Shop;
use App\Models\User;
use Illuminate\Support\Facades\Auth;

class FavoriteController extends Controller
{
    public function toggle(Shop $shop)
    {
        $user = Auth::user();

        if (!$user) {
            return redirect()->back()->with('error', 'ログインしていません。');
        }

        // ユーザーのお気に入りにこのショップが既に存在するか確認
        if ($user->favorites()->where('shop_id', $shop->id)->exists()) {
            // 既にお気に入りに追加されている場合、削除する
            $user->favorites()->detach($shop);
            $message = 'お気に入りから削除されました';
        } else {
            // お気に入りに追加する
            $user->favorites()->attach($shop);
            $message = 'お気に入りに追加されました';
        }

        return redirect()->back()->with('status', $message);
    }
}
