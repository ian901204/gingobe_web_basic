<?php
	namespace App\Controllers;

	use Psr\Http\Message\ResponseInterface;
	use Psr\Http\Message\ServerRequestInterface;
	use App\Models\DB\product;
	class ProductController
	{
		//前台取得產品資訊 
		public function get_select(ServerRequestInterface $request, ResponseInterface $response){
			$product_data = product::get(["id", "size", "price"]);
			$response -> getBody() -> write(json_encode($product_data));
			return $response -> withStatus(200);
		}

		//後台顯示現有產品列表 
		public function list(ServerRequestInterface $request, ResponseInterface $response){
            $product_data = product::get(["id", "size", "price"]);
			include __DIR__."/../../backend/product/product.php";
			return $response -> withStatus(200);
		}

		//後台新增產品 
        public function add(ServerRequestInterface $request, ResponseInterface $response){
            try{
                $data = json_decode($request -> getbody() -> getcontents(),true);
                $product_data = product::create($data);
                $response -> getBody() -> write(json_encode(["Status" => "Success"]));
                return $response -> withStatus(200);
            }catch(\Exception $e){
				echo $e;
                $response -> getBody() -> write(json_encode(["Status" => "add failed!"]));
                return $response -> withStatus(400);
            }
		}

		//後台取得產品詳細資訊
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

		//後台編輯產品資訊
		public function edit(ServerRequestInterface $request, ResponseInterface $response){
			try{
				$body_data = json_decode($request -> getbody() -> getcontents(),true);
				$product_data = product::where("id", "=", $data["id"])->get(["size", "price", "amount"]);
				unset($body_data["id"]);
				foreach($body_data as $key-> $value){
					$product_data -> $key = $value;
				}
				$body_data-> save();
			}catch(\Exception $e){
				$response -> getBody() -> write(json_encode(["Status" => "failed!"]));
				return $response -> withStatus(400);
			}
		}

		//後台刪除產品
		public function delete(ServerRequestInterface $request, ResponseInterface $response, array $args){
			try{
				$order_data = product::where("id", "=", $args["id"])->delete();
			}catch(\Exception $e){
				echo $e;
				$response -> getBody() -> write(json_encode(["Status" => "failed!"]));
				return $response -> withStatus(400);
			}
			$response -> getBody() -> write(json_encode(["Status" => "Success"]));
			return $response -> withStatus(200);
		}

		public function queue_list(ServerRequestInterface $request, ResponseInterface $response){
			$product_data = product::get(["id", "size", "price"]);
			include __DIR__."/../../backend/product/product_queue.php";
			return $response -> withStatus(200);
		}
	}
?>
