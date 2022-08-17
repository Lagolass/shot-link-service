<?php

namespace App\Http\Controllers;

use App\Http\Requests\CreateShortLink;
use App\Models\ShortLink;

class ShortLinkController extends Controller
{
    private $modelShortLink;

    public function __construct(ShortLink $modelShortLink)
    {
        $this->modelShortLink = $modelShortLink;
    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        return view('index', [
            'list' => $this->modelShortLink->newQuery()->get()->toJson()
        ]);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(CreateShortLink $request)
    {
        $data = $request->getSanitized();

        $model = $this->modelShortLink->newInstance($data);

        if($model->save()) {
            return response()->json([
                'message' => trans('short_link.created_success'),
                'item' => $model->toArray()
//                'item' => [
//                    'link' => $model->link,
//                    'short_link' => asset($model->token),
//                    'limit' => $model->limit,
//                    'count_entrance' => $model->count_entrance,
//                ],
            ]);
        } else {
            return response()->json(['message' => trans('short_link.create_error')], 400);
        }
    }

    /**
     * Display the specified resource.
     *
     * @param $token
     * @return void
     */
    public function redirect($token)
    {
        /** @var $item ShortLink*/
        $item = $this->modelShortLink->newQuery()->where('token', $token)->first();

        if($item !== null) {
            if($item->checkingOfExpiry()) {
                $item->count_entrance++;
                $item->save();

                return response()->redirectTo($item->link, 301)->header('Cache-Control', 'no-store, no-cache, must-revalidate');
            } else {
                $item->delete();
            }
        }

        return response()->redirectToRoute('not-found');
    }
}
