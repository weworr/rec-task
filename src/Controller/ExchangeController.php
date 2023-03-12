<?php

namespace App\Controller;

use App\Form\ExchangeValuesType;
use App\Service\ErrorService;
use App\Service\HistoryService;
use App\Service\SwapService;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

#[Route('/exchange/values')]
class ExchangeController extends AbstractController
{
    #[Route('/', methods: ['POST'])]
    public function index(
        Request $request,
        HistoryService $historyService,
        SwapService $swapService,
        ErrorService $errorService
    ): JsonResponse
    {
        $response = new JsonResponse();

        $form = $this->createForm(ExchangeValuesType::class);
        $form->submit($request->request->all());

        if ($form->isValid()) {
            $first = $request->request->get('first');
            $second = $request->request->get('second');

            $history = $historyService->add($first, $second);

            $swapService->swap($first, $second);
            $history
                ->setFirstOut($first)
                ->setSecondOut($second);

            $historyService->update($history);

            $response
                ->setData(['Status' => 'OK']);
        } else {
            $errors = $errorService->getFormErrors($form);

            $response
                ->setData(['Errors' => $errors])
                ->setStatusCode(Response::HTTP_BAD_REQUEST);
        }

        return $response;
    }

    #[Route('/get', methods: ['POST', 'GET'])]
    public function list(HistoryService $historyService): JsonResponse
    {
        $data = $historyService->getAll();
        return new JsonResponse($data);
    }
}