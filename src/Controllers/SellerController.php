<?php
	namespace App\Controllers;

	use Psr\Http\Message\ResponseInterface;
	use Psr\Http\Message\ServerRequestInterface;
	use App\Models\DB\sellers;
	class OrderController
	{
		public function add(ServerRequestInterface $request, ResponseInterface $response){
			$data = json_decode($request -> getbody() -> getcontents(),true);
			$seller = sellers:: create(
				[
                    "name" => $data["name"],
                    "phone" => $data["phone"]
				]);
			$seller -> save();
			$response -> getBody() -> write(json_encode(["Status"=> "Success", "id" => $seller -> id]));
			return $response -> withStatus(200);
		}

		public function list(ServerRequestInterface $request, ResponseInterface $response){
			$seller_data = seller::get(["id", "name", "phone"]);
			include __DIR__."/../../backend/seller.php";
			return $response -> withStatus(200);
		}

		public function get(ServerRequestInterface $request, ResponseInterface $response, array $args){
			try{
				$order_data = Order::where("id", "=", $args["id"]) -> first(["id", "client_name", "client_phone", "order_address", "product_size", "product_amount", "seller_id", "description"]);
				$seller_data = sellers::get(["id", "name"]);
			}catch(\Exception $e){
				$response -> getBody() -> write(json_encode(["Status" => "failed!"]));
				return $response -> withStatus(400);
			}
			include __DIR__."/../../backend/order_detail.php";
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
