<?php
	namespace App\Controllers;

	use Psr\Http\Message\ResponseInterface;
	use Psr\Http\Message\ServerRequestInterface;
	use App\Models\DB\sellers;
	use App\Models\DB\Order;
	use App\Models\DB\product;
	class SellerController
	{
		//前台取得所有業務的資料
		public function select(ServerRequestInterface $request, ResponseInterface $response){
			$seller_data = sellers::get(["id", "name"]);
			$response -> getBody() -> write(json_encode($seller_data));
			return $response -> withStatus(200);
		}

		//後台新增業務
		public function add(ServerRequestInterface $request, ResponseInterface $response){
			$data = json_decode($request -> getbody() -> getcontents(),true);
			$seller = sellers::create(
				[
                    "name" => $data["name"],
                    "phone" => $data["phone"]
				]);
			$seller -> save();
			$response -> getBody() -> write(json_encode(["Status"=> "Success", "id" => $seller -> id]));
			return $response -> withStatus(200);
		}

		//後台業務列表
		public function list(ServerRequestInterface $request, ResponseInterface $response){
			$seller_data = sellers::get(["id", "name", "phone"]);
			foreach($seller_data as $data){
				$order_data = Order::where("seller_id", "=", $data["id"]) -> get(["amount"]);
				$data["order_data"] = $order_data;
			}
			include __DIR__."/../../backend/seller/seller.php";
			return $response -> withStatus(200);
		}

		//後台取得業務員經手的所有訂單
		public function order_list(ServerRequestInterface $request, ResponseInterface $response, array $args){
			$order_data = Order::where("seller_id", "=", $args["id"]) -> get(["id", "name","amount", "phone", "seller_id", "order_time"]);
			foreach ($order_data as $data){
				if ($data["seller_id"] != 0){
					$seller_data = sellers::where("id", "=", $data["seller_id"])->first();
					$data["seller_id"] = $seller_data->name;
				}
			}
			include __DIR__."/../../backend/order/order.php";
			return $response -> withStatus(200);
		}

		//後台取得業務員經手的訂單資訊
		public function order_detail(ServerRequestInterface $request, ResponseInterface $response, array $args){
			try{
				$order_data = Order::where("id", "=", $args["id"]) -> first(["id", "name", "phone", "address", "amount", "seller_id", "note"]);
				$seller_data = sellers::get(["id", "name"]);
				$product_data = product::get(["size"]);
			}catch(\Exception $e){
				$response -> getBody() -> write(json_encode(["Status" => "failed!"]));
				return $response -> withStatus(400);
			}
			include __DIR__."/../../backend/order/order_detail.php";
			return $response -> withStatus(200);
		}

		//後台取得業務資訊
		public function get(ServerRequestInterface $request, ResponseInterface $response, array $args){
			try{
				$seller_data = sellers::where("id", "=", $args["id"])->first(["id", "name", "phone"]);
			}catch(\Exception $e){
				$response -> getBody() -> write(json_encode(["Status" => "failed!"]));
				return $response -> withStatus(400);
			}
			include __DIR__."/../../backend/seller/seller_detail.php";
			return $response -> withStatus(200);
		}

		//後台編輯業務資訊
        public function edit(ServerRequestInterface $request, ResponseInterface $response, array $args){
			try{
                $data = json_decode($request -> getbody() -> getcontents(),true);
				$seller_data = sellers::where("id", "=", $args["id"])->first(["id", "name", "phone"]);
                $seller_data -> name = $data["name"];
                $seller_data -> phone = $data["phone"];
                $seller_data -> save();
			}catch(\Exception $e){
                echo $e;
				$response -> getBody() -> write(json_encode(["Status" => "failed!"]));
				return $response -> withStatus(400);
			}
            $response -> getBody() -> write(json_encode(["Status" => "failed!"]));
			return $response -> withStatus(200);
		}

		//後台刪除業務
		public function delete(ServerRequestInterface $request, ResponseInterface $response, array $args){
			try{
				$order_data = sellers::where("id", "=", $args["id"])->delete();
			}catch(\Exception $e){
				$response -> getBody() -> write(json_encode(["Status" => "failed!"]));
				return $response -> withStatus(400);
			}
			$response -> getBody() -> write(json_encode(["Status" => "Success"]));
			return $response -> withStatus(200);
		}
	}
?>
