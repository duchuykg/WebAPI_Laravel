<?php
namespace App\Support\JWT;

use Exception;
class JWTBuilder
{
    private static $instance = null;

    private function __construct()
    {
        // khởi tạo instance của IJWTBuilder
    }

    private $header = [];
    private $payload = [];

    public function setIssuedAt($issuedAt): JWTBuilder {
        $this->payload['iat'] = $issuedAt;
        return $this;
    }

    public function setExpiration($expiration): JWTBuilder {
        $this->payload['exp'] = $expiration;
        return $this;
    }

    public function setUser($user): JWTBuilder {
        $this->payload['name'] = $user->name; 
        $this->payload['email'] = $user->email; 
        $this->payload['type'] = $user->type; 
        return $this;
    }

    public function build($secret): string {
        $this->setHeader();

        $headerEncoded = base64_encode(json_encode($this->header));
        $payloadEncoded = base64_encode(json_encode($this->payload));

        $signature = hash_hmac('sha256', $headerEncoded . '.' . $payloadEncoded, $secret);
        $signatureEncoded = base64_encode($signature);

        return $headerEncoded . '.' . $payloadEncoded . '.' . $signatureEncoded;
    }

    private function setHeader(): void {
        $this->header['alg'] = 'HS256';
        $this->header['typ'] = 'JWT';
    }

    public static function getInstance()
    {
        return empty(static::$instance) ? new JWTBuilder() : static::$instance;
    }

    public function getBuilder()
    {
        return new JWTBuilder();
    }
    
    public function decode(string $token, $secret): array {
        $parts = explode('.', $token);

        list($headerEncoded, $payloadEncoded, $signatureEncoded) = $parts;

        $signature = hash_hmac('sha256', $headerEncoded . '.' . $payloadEncoded, $secret);
        $signatureEncoded = base64_encode($signature);

        if ($signatureEncoded !== $signatureEncoded) {
            throw new Exception();
        }

        $payload = json_decode(base64_decode($payloadEncoded), true);

        return $payload;
    }
    
}