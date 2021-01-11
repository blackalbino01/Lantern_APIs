<?php

namespace App\Http\Controllers;

use App\Models\Advertisement;
use Illuminate\Http\Request;
use App\Http\Resources\AdvertisementResource;

class AdvertisementController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $advert = Advertisement::paginate(20);
        return AdvertisementResource::collection($advert);

    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        // Validating User input

        $validatedData = $request->validate([
            'imageUrl' => 'nullable',
            'videoUrl' => 'required',
            'advertDescription' => 'required'
        ]);
            // Creating new Book
        $advert = Advertisement::create($validatedData);
        return response([
            'data' => new AdvertisementResource($advert)
        ], 201);
    }
    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Advertisement  $advertisement
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $advert = Advertisement::find($id);
        return new AdvertisementResource($advert);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Advertisement  $advertisement
     * @return \Illuminate\Http\Response
     */


    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Advertisement  $advertisement
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        $updateAd = Advertisement::find($id);
        $updateAd->update($request->all());
        return response([
            'data' => new AdvertisementResource($updateAd)
        ], 201);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Advertisement  $advertisement
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {

        $advert = Advertisement::find($id);
        $advert->delete();
        return response([
            'message' => 'Deleted successfully',
            'data' => null
        ]);
    }
}
