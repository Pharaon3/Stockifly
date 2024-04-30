<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\ApiBaseController;
use App\Http\Requests\Api\Refund\IndexRequest;
use App\Http\Requests\Api\Refund\StoreRequest;
use App\Http\Requests\Api\Refund\UpdateRequest;
use App\Http\Requests\Api\Refund\DeleteRequest;
use App\Models\Order;
use App\Traits\OrderTraits;

class RefundController extends ApiBaseController
{
	use OrderTraits;

	protected $model = Order::class;

	protected $indexRequest = IndexRequest::class;
	protected $storeRequest = StoreRequest::class;
	protected $updateRequest = UpdateRequest::class;
	protected $deleteRequest = DeleteRequest::class;

	public function __construct()
	{
		parent::__construct();

		$this->orderType = "refund";
	}
}
