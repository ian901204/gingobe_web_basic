<?php
	namespace App\Controllers;

	use Psr\Http\Message\ResponseInterface;
	use Psr\Http\Message\ServerRequestInterface;
	use App\Models\DB\Order;

	class OrderController
	{
		public function add(ServerRequestInterface $request, ResponseInterface $response){
			//$data = $request -> getParsedBody();
			//$data = var_export($data, true);
			//$order = Order:: create(
			//	[
			//		"client_id" => 0,
			//		"description" => $data["size"],
			//		"detail" => $data["seller"],
			//		"salesperson_id" => 0
			//	]);
			//$order -> save();
			$response -> getBody() -> write("ok");
			return $response -> withStatus(200);
		}
	}
?>
