<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\ApiBaseController;
use App\Models\Order;
use App\Models\ProductVariant;
use App\Models\Jewerlygroup;
use Examyou\RestAPI\Exceptions\ApiException;
use App\Http\Requests\Api\Jewerlygroup\IndexRequest;
use App\Http\Requests\Api\Jewerlygroup\StoreRequest;
use App\Http\Requests\Api\Jewerlygroup\UpdateRequest;
use App\Http\Requests\Api\Jewerlygroup\DeleteRequest;

class JewerlygroupController extends ApiBaseController
{
	protected $model = Jewerlygroup::class;

	protected $indexRequest = IndexRequest::class;
	protected $storeRequest = StoreRequest::class;
	protected $updateRequest = UpdateRequest::class;
	protected $deleteRequest = DeleteRequest::class;

    public function stored(Jewerlygroup $jewerlygroup)
    {
    //     $this->insertOrUpdateJewerlygroup($jewerlygroup);

        return $jewerlygroup;
    }

    public function updated($jewerlygroup)
    {
    //     $this->insertOrUpdateJewerlygroup($jewerlygroup);

        return $jewerlygroup;
    }

    // public function insertOrUpdateJewerlygroup($jewerlygroup){

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

    public function destroying(Jewerlygroup $jewerlygroup)
	{
	// 	// Can not delete variation if it is assigned to some product
	// 	$childCategoryCount = ProductVariant::where('variant_id', $jewerlygroup->id)->count();

	// 	if ($childCategoryCount > 0) {
	// 		throw new ApiException('Jewerlygroup assigned to some product is not deletable.');
	// 	}

		return $jewerlygroup;
	}
}

