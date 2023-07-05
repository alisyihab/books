<?php

namespace App\Http\Controllers\API;

use App\Http\Controllers\Controller;
use App\Models\Novel;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;

class NovelController extends Controller
{
    public function store(Request $request)
    {
        try {

            $validator = Validator::make($request->all(),[
                'title' => 'required|string',
                'description' => 'required|string',
                'price' => 'required|number'
            ], [
                "title.required" => "title harus diisi"
            ]);

            if ($validator->fails()){
                return response()->json($validator->errors())->setStatusCode(422);
            }

            Novel::create([
                "title" => $request->title,
                "description" => $request->description,
                "price" => $request->price,
                "status" => $request->status
            ]);

            return response()->json([
                "status" => 200,
                "message" => "Novel $request->title berhasil dibuat"
            ], 200);
        } catch (\Exception $e) {
            return response()->json($e->getMessage())->setStatusCode(500);
        }
    }

    public function index(Request $request)
    {
        $data = Novel::select("*");

        if (!empty($request->q)) {
            $data = $data->where('title', 'LIKE', '%' . $request->q . '%');
        }

        if (!empty($request->from) && !empty($request->to)) {
            $from = $request->from;
            $to = $request->to;

            $data = $data->whereBetween('price', [$from, $to]);
        }

        if (!empty($request->status) && in_array($request->status, [0, 1])) {
            $data = $data->where('status', $request->status);
        }

        if (!empty($request->fromDate) && !empty($request->toDate)) {
            $fromDate = $request->fromDate . ' 00:00:01';
            $toDate = $request->toDate. ' 23:59:00';

            $data = $data->whereBetween('created_at', [$fromDate, $toDate]);
        }

        $data = $data->orderBy('created_at', 'DESC')->paginate($request->perPage);

        return response()->json(["content" => $data, "status" => 200], 200);
    }

    public function edit($id)
    {
        $novel = Novel::find($id);

        return response()->json($novel);
    }

    public function update(Request $request, $id)
    {
        $novel = Novel::find($id);

        $novel->update([
            "title" => $request->title,
            "description" => $request->description,
            "price" => $request->price,
            "status" => $request->status
        ]);

        return response()->json([
            "status" => 200,
            "message" => "data berhasil diubah"
        ]);
    }

    public function destroy($id)
    {
        $novel = Novel::find($id);

        $novel->delete();

        return response()->json("data berhasil dihapus");
    }
}
