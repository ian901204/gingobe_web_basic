<?php
	namespace App\Controllers;

	use Psr\Http\Message\ResponseInterface;
	use Psr\Http\Message\ServerRequestInterface;
	use App\Models\DB\product;
	class ProductController
	{
		public function get_select(ServerRequestInterface $request, ResponseInterface $response){
			$product_data = product::get(["id", "size", "prize"]);
			$response -> getBody() -> write(json_encode($product_data));
			return $response -> withStatus(200);
		}

		public function list(ServerRequestInterface $request, ResponseInterface $response){
            $product_data = product::get(["id", "size", "prize"]);
			include __DIR__."/../../backend/product/product.php";
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
				$product_data = product::where("size", "=", $args["size"]) -> first(["id","size","price"]);
			}catch(\Exception $e){
				echo $e;
				$response -> getBody() -> write(json_encode(["Status" => "failed!"]));
				return $response -> withStatus(400);
			}
			include __DIR__."/../../backend/product/product_detail.php";
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
