<?php

namespace App\Http\Controllers;

use App\Models\Advertisement;
use Illuminate\Http\Request;
use App\Http\Resources\AdvertisementResource;

class AdvertisementController extends Controller
{
    /**
     * @OA\Get(
     * path="api/adverts",
     * summary="Get adverts",
     * description="Get all available adverts",
     * operationId="advert",
     * tags={"Advertisement"},
     *
     * @OA\Response(
     *    response=422,
     *    description="Wrong URL or URL not found",
     *    @OA\JsonContent(
     *       @OA\Property(property="message", type="string", example="You might have made a mistake in your URL")
     *        ),
     *     ),
     *
     * @OA\Response(
     *    response=200,
     *    description="Success",
     *    @OA\JsonContent(
     *         @OA\Property(property="data", type="object", ref="#/components/schemas/Advertisement"),
     *         @OA\Property(property="path", type="string", readOnly="true", example="http://localhost:8000/api/adverts"),
     *         @OA\Property(property="per_page", type="integer", readOnly="true", example="20"),
     *         @OA\Property(property="to", type="integer", readOnly="true", example="20"),
     *         @OA\Property(property="total", type="integer", readOnly="true", example="50"),
     *       ),
     *    ),
     * )
     *
     */


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
     * @OA\Post(
     * path="api/adverts",
     * summary="Create adverts",
     * description="Create a new adverts",
     * operationId="advert",
     * tags={"Advertisement"},
     * @OA\RequestBody(
     *    required=true,
     *    description="Pass data required to set up advert",
     *    @OA\JsonContent(
     *       required={"imageUrl","videoUrl","advertDescription"},
     *       @OA\Property(property="imageUrl", type="string", example="https://picture.com/picture"),
     *       @OA\Property(property="videoUrl", type="string", example="advertisement.mp4"),
     *       @OA\Property(property="advertDescription", type="string",  example="Lorem ipsum dolor sit amet consectetur adipisicing elit. Asperiores, esse hic dolores nam iure cum. Unde, ducimus magni amet repudiandae, veniam asperiores, tenetur quibusdam quasi minus hic doloribus laboriosam inventore."),
     *    ),
     * ),
     *
     * @OA\Response(
     *    response=201,
     *    description="Advert Created",
     *    @OA\JsonContent(
     *         @OA\Property(property="data", type="object", ref="#/components/schemas/Advertisement"),
     *       ),
     *    ),
     * )
     *
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
     * @OA\Get(
     *  path="api/adverts/{id}",
     *  summary="Get an advert by id",
     *  description="Get a particular advert by id",
     *  operationId="advert",
     *  tags={"Advertisement"},
     *
     * @OA\Response(
     *     response=200,
     *     description="Success",
     * @OA\JsonContent(
     *       @OA\Property(property="data", type="object", ref="#/components/schemas/Advertisement"),
     *       ),
     *    ),
     *
     * @OA\Response(
     *    response=404,
     *    description="Returns when resource is not found",
     *    @OA\JsonContent(
     *       @OA\Property(property="message", type="string", example="resource not found"),
     *    ),
     *  ),
     *
     * )
     */


    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Advertisement  $advertisement
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $advert = Advertisement::find($id);
        if(!$advert || $advert = null) {
            return response([
            'message' => 'resource not found'
        ], 204);
        } else {
            return new AdvertisementResource($advert);
        }
    }

    /**
     * @OA\Patch(
     *  path="api/adverts/{id}",
     *  summary="Update an advert by id",
     *  description="Update a particular advert by id",
     *  operationId="advert",
     *  tags={"Advertisement"},
     *
     *  @OA\RequestBody(
     *    required=true,
     *    description="Pass data required to update advert, all input field must not be specified",
     *    @OA\JsonContent(
     *       required={"imageUrl","videoUrl","advertDescription"},
     *       @OA\Property(property="imageUrl", type="string", example="https://picture.com/picture"),
     *       @OA\Property(property="videoUrl", type="string", example="advert.mp4"),
     *       @OA\Property(property="advertDescription", type="string",  example="Lorem ipsum dolor sit amet consectetur adipisicing elit. Asperiores, esse hic dolores nam iure cum. Unde, ducimus magni amet repudiandae, veniam asperiores, tenetur quibusdam quasi minus hic doloribus laboriosam inventore."),
     *    ),
     * ),
     *
     * @OA\Response(
     *     response=200,
     *     description="Success",
     * @OA\JsonContent(
     *      @OA\Property(property="id", type="integer", readOnly="true", example="51"),
     *      @OA\Property(property="imageUrl", type="string", readOnly="true", example="https://picture.com/picture"),
     *      @OA\Property(property="videoUrl", type="string", readOnly="true", example="advert.mp4"),
     *      @OA\Property(property="advertDescription", type="string", example="Lorem ipsum dolor sit amet consectetur adipisicing elit. Dolore, officiis,dolorem laborum repudiandae inventore"),
     *       ),
     *    ),
     *
     * )
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
     * @OA\Delete(
     *  path="api/adverts/{id}",
     *  summary="Delete an advert by id",
     *  description="Delete a particular advert by id",
     *  operationId="advert",
     *  tags={"Advertisement"},
     *
     *
     * @OA\Response(
     *     response=200,
     *     description="Success",
     * @OA\JsonContent(
     *      @OA\Property(property="message", type="string", readOnly="true", example="Delete successfully"),
     *      @OA\Property(property="data", type="null"),
     *       ),
     *    ),
     *
     * )
     */


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
