<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class FollowersController extends Controller
{
    /**
     * 用户是否登录
     * FollowersController constructor.
     */
    public function __construct()
    {
        $this->middleware('auth');
    }

    /**
     * 关注
     * @param User $user
     * @return \Illuminate\Http\RedirectResponse
     * @throws \Illuminate\Auth\Access\AuthorizationException
     */
    public function store(User $user)
    {
        // 对用户身份进行授权判断
        $this->authorize('follow', $user);

        // 是否已关注此用户，未关注才可关注
        if (!Auth::user()->isFollowing($user->id)) {
            Auth::user()->follow($user->id);
        }

        return redirect()->route('users.show', $user->id);
    }

    /**
     * 取消关注
     * @param User $user
     * @return \Illuminate\Http\RedirectResponse
     * @throws \Illuminate\Auth\Access\AuthorizationException
     */
    public function destroy(User $user)
    {
        // 对用户身份进行授权判断
        $this->authorize('follow', $user);

        // 是否关注此用户，关注了才可以取消关注
        if (Auth::user()->isFollowing($user->id)) {
            Auth::user()->unfollow($user->id);
        }

        return redirect()->route('users.show', $user->id);
    }
}
