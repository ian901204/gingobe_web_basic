<?php
	namespace App\Controllers;

	use Psr\Http\Message\ResponseInterface;
	use Psr\Http\Message\ServerRequestInterface;
	use App\Models\DB\product;
	class ProductController
	{
		public function list(ServerRequestInterface $request, ResponseInterface $response){
            $product_data = product::get(["id", "size", "prize"]);
			include __DIR__."/../../backend/product.php";
			return $response -> withStatus(200);
		}

        public function add(ServerRequestInterface $request, ResponseInterface $response){
            try{
                $data = json_decode($request -> getbody() -> getcontents(),true);
                $product_data = product::create($data);
                $response -> getBody() -> write(json_encode(["Status" => "Success"]));
                return $response -> withStatus(200);
            }catch(\Exception $e){
                $response -> getBody() -> write(json_encode(["Status" => "add failed!"]));
                return $response -> withStatus(400);
            }
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
				$order_data = product::where("id", "=", $args["id"])->delete();
			}catch(\Exception $e){
				$response -> getBody() -> write(json_encode(["Status" => "failed!"]));
				return $response -> withStatus(400);
			}
			$response -> getBody() -> write(json_encode(["Status" => "Success"]));
			return $response -> withStatus(200);
		}
	}
?>
