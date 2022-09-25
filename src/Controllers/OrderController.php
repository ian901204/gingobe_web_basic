<?php
	namespace App\Controllers;

	use Psr\Http\Message\ResponseInterface;
	use Psr\Http\Message\ServerRequestInterface;
	use App\Models\DB\Order;

	class OrderController
	{
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

		public function list(ServerRequestInterface $request, ResponseInterface $response){
			$order_data = Order::get(["id", "client_name", "product_size", "product_amount"]);
			$response -> getBody() -> write(include __DIR__."/../../backend/order.php");
			return $response -> withStatus(200);
		}

		public function get(ServerRequestInterface $request, ResponseInterface $response, array $args){
			try{
				$order_data = Order::where("id", "=", $args["id"]) -> get(["id", "client_name", "client_phone", "order_address", "product_size", "product_amount", "seller_id", "description"]);
				$seller_data = sellers::where("id", "=", $args["id"]) -> get(["id", "name"]);
			}catch(\Exception $e){
				$response -> getBody() -> write(json_encode(["Status" => "failed!"]));
				return $response -> withStatus(400);
			}
			$response -> getBody() -> write(include __DIR__."/../../backend/order_detail.php");
			return $response -> withStatus(200);
		}

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
