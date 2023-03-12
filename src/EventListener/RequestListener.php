<?php

namespace App\EventListener;

use App\Exception\InvalidContentType;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpKernel\Event\RequestEvent;

class RequestListener
{
    private array $supportedContentType = ['json', null];

    public function onKernelRequest(RequestEvent $event): void
    {
        if (!$event->isMainRequest()) {
            return;
        }

        $request = $event->getRequest();

        if (!in_array($request->getContentType(), $this->supportedContentType)) {
            throw new InvalidContentType('Invalid request content type');
        }

        if ($request->getMethod() === Request::METHOD_GET) {
            $request->request->replace($request->query->all());
        } else if (!empty($request->getContent())) {
            $data = json_decode($request->getContent(), true);
            if (json_last_error() !== JSON_ERROR_NONE) {
                throw new \JsonException('Invalid JSON data');
            }

            $request->request->replace($data);
        }
    }
}