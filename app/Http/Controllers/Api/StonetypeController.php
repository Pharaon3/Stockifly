<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\ApiBaseController;
use App\Models\Order;
use App\Models\ProductVariant;
use App\Models\Stonetype;
use Examyou\RestAPI\Exceptions\ApiException;
use App\Http\Requests\Api\Stonetype\IndexRequest;
use App\Http\Requests\Api\Stonetype\StoreRequest;
use App\Http\Requests\Api\Stonetype\UpdateRequest;
use App\Http\Requests\Api\Stonetype\DeleteRequest;

class StonetypeController extends ApiBaseController
{
	protected $model = Stonetype::class;

	protected $indexRequest = IndexRequest::class;
	protected $storeRequest = StoreRequest::class;
	protected $updateRequest = UpdateRequest::class;
	protected $deleteRequest = DeleteRequest::class;

    public function stored(Stonetype $stonetype)
    {
    //     $this->insertOrUpdateStonetype($stonetype);

        return $stonetype;
    }

    public function updated($stonetype)
    {
    //     $this->insertOrUpdateStonetype($stonetype);

        return $stonetype;
    }

    // public function insertOrUpdateStonetype($stonetype){

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

    public function destroying(Stonetype $stonetype)
	{
	// 	// Can not delete variation if it is assigned to some product
	// 	$childCategoryCount = ProductVariant::where('variant_id', $stonetype->id)->count();

	// 	if ($childCategoryCount > 0) {
	// 		throw new ApiException('Stonetype assigned to some product is not deletable.');
	// 	}

		return $stonetype;
	}
}

