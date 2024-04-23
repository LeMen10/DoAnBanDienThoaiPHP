<?php
class jwt
{
    public function decodeToken($token)
    {
        $key = 'VDaZW4QaV6rjAnPlK5RZTO63zLeslqkI2FiEGeCP77I=';
        $segments = explode('.', $token);
        $header = $segments[0];
        $payload = $segments[1];
        $signature = $segments[2];

        $decodedPayload = json_decode(base64_decode($payload), true);
        $newSignature = base64_encode(hash_hmac('sha256', $header . '.' . $payload, $key, true));

        if ($signature == $newSignature) return $decodedPayload;
        else return false;
    }
}
