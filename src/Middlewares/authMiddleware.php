<?php

namespace App\Middlewares;

use Firebase\JWT\JWT;
use Firebase\JWT\Key;
use Psr\Http\Message\ServerRequestInterface ;
use Psr\Http\Server\RequestHandlerInterface ;
use Slim\Psr7\Response;

//用於檢測 request 是否帶有正確的 token
//用 jwt 進行加解密
//token 生成於 AuthController.php 裡面的 login function

class authMiddleware
{
    public function __invoke(ServerRequestInterface $request, RequestHandlerInterface $handler)
    {
        $response = new Response();
        if(!isset($request->getHeader("Authorization")[0])){
            $response->getBody()->write(json_encode([
                "message" => "No token provided!"
            ]));
            return $response
                ->withHeader('content-type', 'application/json')
                ->withStatus(403);
        }
        $jwtToken = str_replace("Bearer ", "", $request->getHeader("Authorization")[0]);
        try {
            $jwtBody = JWT::decode($jwtToken, new Key($_ENV["JWT_SECRET"], 'HS256'));
            return $handler->handle($request);
        } catch (\Exception $e) {
            $response->getBody()->write(json_encode([
                "message" => "Token is invalid!",
            ]));
            return $response
                ->withHeader('content-type', 'application/json')
                ->withStatus(400);
        }
    }
}