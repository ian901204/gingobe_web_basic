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
					"description" => $data["size"],
					"detail" => $data["seller"],
					"salesperson_id" => 1,
				]);
			$order -> save();
			$response -> getBody() -> write(json_encode(["Status"=> "Success"]));
			return $response -> withStatus(200);
		}
	}
?>
