<?php
	namespace App\Controllers;

	use Psr\Http\Message\ResponseInterface;
	use Psr\Http\Message\ServerRequestInterface;
	
	//引入資料庫類別
	use App\Models\DB\Order;
	use App\Models\DB\sellers;
	use App\Models\DB\product;
	class OrderController
	{
		//訂單新增 function
		public function add(ServerRequestInterface $request, ResponseInterface $response){
			$data = json_decode($request -> getbody() -> getcontents(),true);
			$order = Order:: create(
				[
					"client_name" => $data["name"],
					"client_phone" => $data["phone"],
					"order_address" => $data["address"],
					"product_size" => $data["size"],
					"product_amount" => $data["amount"],
					"seller_id" => $data["seller"]
				]);
			$order -> save();
			$response -> getBody() -> write(json_encode(["Status"=> "Success", "id" => $order -> id]));
			return $response -> withStatus(200);
		}

		//訂單編輯 function
		public function edit(ServerRequestInterface $request, ResponseInterface $response, array $args){
			try{
				$data = json_decode($request -> getbody() -> getcontents(),true);
				$order = Order::where("id", "=", $args["id"])->first();
				
				foreach($data as $key => $value){
					$order -> $key = $value;
				}
				$order -> save();
			}catch(\Exception $e){
				$response -> getBody() -> write(json_encode(["Status" => "edit order error"]));
				return $response -> withStatus(400);
			}
			$response -> getBody() -> write(json_encode(["Status" => "Success"]));
			return $response -> withStatus(200);
		}

		//後台訂單列表 function
		public function list(ServerRequestInterface $request, ResponseInterface $response){
			$order_data = Order::get(["id", "client_name", "product_size", "product_amount", "client_phone", "order_address", "seller_id"]);
			foreach ($order_data as $data){
				if ($data["seller_id"] != 0){
					$seller_data = sellers::where("id", "=", $data["seller_id"])->first();
					$data["seller_id"] = $seller_data->name;
				}else{
					$data["seller_id"] = "無";
				}
			}
			include __DIR__."/../../backend/order/order.php";
			return $response -> withStatus(200);
		}

		//後台取得訂單資訊 function
		public function get(ServerRequestInterface $request, ResponseInterface $response, array $args){
			try{
				$order_data = Order::where("id", "=", $args["id"]) -> first(["id", "client_name", "client_phone", "order_address", "product_size", "product_amount", "seller_id", "description"]);
				$seller_data = sellers::get(["id", "name"]);
				$product_data = product::get(["size"]);
			}catch(\Exception $e){
				$response -> getBody() -> write(json_encode(["Status" => "failed!"]));
				return $response -> withStatus(400);
			}
			include __DIR__."/../../backend/order/order_detail.php";
			return $response -> withStatus(200);
		}

		//後台刪除訂單 function
		public function delete(ServerRequestInterface $request, ResponseInterface $response, array $args){
			try{
				$order_data = Order::where("id", "=", $args["id"])->delete();
			}catch(\Exception $e){
				$response -> getBody() -> write(json_encode(["Status" => "failed!"]));
				return $response -> withStatus(400);
			}
			$response -> getBody() -> write(json_encode(["Status" => "Success"]));
			return $response -> withStatus(200);
		}
	}
?>
