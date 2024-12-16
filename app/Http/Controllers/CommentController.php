<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Comment;
use Illuminate\Support\Facades\Auth; 


class CommentController extends Controller
{
    
    public function product($product_id){
        $dsBL = Comment::where('products_id', $product_id)->join('users', 'users_id', '=', 'user_id')->select('comments.*', 'users.fullname AS fullname')->get();
        $kq = [
            'status'=>true,
            'message'=>'Lấy dữ liệu thành công',
            'data'=>$dsBL
        ];
        return response()->json($kq, 200);
    }
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        //
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $comment = new Comment();
        $comment->user_id = Auth::user()->users_id;
        $comment->products_id = $request->products_id;
        $comment->content = $request->content;
        $comment->save();
        $kq = [
            'status'=>true,
            'message'=>'Đã thêm bình luận thành công!',
        ];
        return response()->json($kq, 200);

        //   // Lưu thông báo thành công vào session flash
        //   session()->flash('alert', [
        //     'type' => 'success',
        //     'title' => 'Thành công!',
        //     'message' => 'Cập nhật trạng thái thành công!'
        // ]);

        // // Trả về thông báo flash trong response JSON
        // return response()->json([
        //     'alert' => session('alert'),
        //     'message' => 'Cập nhật trạng thái thành công!'
        // ]);
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        //
    }
}
