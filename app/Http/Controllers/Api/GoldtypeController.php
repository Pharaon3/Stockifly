<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\ApiBaseController;
use App\Models\Order;
use App\Models\ProductVariant;
use App\Models\Goldtype;
use Examyou\RestAPI\Exceptions\ApiException;
use App\Http\Requests\Api\Goldtype\IndexRequest;
use App\Http\Requests\Api\Goldtype\StoreRequest;
use App\Http\Requests\Api\Goldtype\UpdateRequest;
use App\Http\Requests\Api\Goldtype\DeleteRequest;

class GoldtypeController extends ApiBaseController
{
	protected $model = Goldtype::class;

	protected $indexRequest = IndexRequest::class;
	protected $storeRequest = StoreRequest::class;
	protected $updateRequest = UpdateRequest::class;
	protected $deleteRequest = DeleteRequest::class;

    public function stored(Goldtype $goldtype)
    {
    //     $this->insertOrUpdateGoldtype($goldtype);

        return $goldtype;
    }

    public function updated($goldtype)
    {
    //     $this->insertOrUpdateGoldtype($goldtype);

        return $goldtype;
    }

    // public function insertOrUpdateGoldtype($goldtype){

    //     $request = request();
    //     $removedVariations = $request->removed_variations;
    //     foreach ($removedVariations as $removedVariation){
    //         $id = $this->getIdFromHash($removedVariation);
    //         Variation::destroy($id);
    //     }

    //     $formFields = $request->value;
    //     foreach ($formFields as $formField) {

    //         if ($formField['id'] == '') {
    //             $exVariation = new Variation();
    //         } else {
    //             $id = $this->getIdFromHash($formField['id']);
    //             $exVariation = Variation::find($id);
    //         }
    //         $exVariation->name = $formField['name'];
    //         $exVariation->parent_id = $variation->id;
    //         $exVariation->save();

    //     }
    // }

    public function destroying(Goldtype $goldtype)
	{
	// 	// Can not delete variation if it is assigned to some product
	// 	$childCategoryCount = ProductVariant::where('variant_id', $goldtype->id)->count();

	// 	if ($childCategoryCount > 0) {
	// 		throw new ApiException('Goldtype assigned to some product is not deletable.');
	// 	}

		return $goldtype;
	}
}

