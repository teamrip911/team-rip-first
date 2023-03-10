<?php

namespace App\Request;

use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\Validator\Validator\ValidatorInterface;

abstract class BaseRequest
{
    private mixed $body = [];

    public function __construct(protected ValidatorInterface $validator)
    {
        $this->populate();
        $this->body = json_decode(Request::createFromGlobals()->getContent(), true);
    }

    public function validate(): void
    {
        $errors = $this->validator->validate($this);

        $messages = ['message' => 'validation_failed', 'errors' => []];

        /* @var \Symfony\Component\Validator\ConstraintViolation */
        foreach ($errors as $message) {
            $messages['errors'][] = [
                'property' => $message->getPropertyPath(),
                'value' => $message->getInvalidValue(),
                'message' => $message->getMessage(),
            ];
        }

        if (count($messages['errors']) > 0) {
            $response = new JsonResponse($messages);
            $response->send();

            exit;
        }
    }

    public function getRequest(): Request
    {
        return Request::createFromGlobals();
    }

    public function getContent(): \stdClass
    {
        return json_decode(Request::createFromGlobals()->getContent());
    }

    protected function populate(): void
    {
        foreach ($this->getRequest()->toArray() as $property => $value) {
            if (property_exists($this, $property)) {
                $this->{$property} = $value;
            }
        }
    }

    /**
     * @return mixed|null
     */
    public function get(string $key, mixed $defaultValue = null): mixed
    {
        if (!array_key_exists($key, $this->body)) {
            return $defaultValue;
        }

        return $defaultValue;
    }
}
