<?php

namespace App\UserInterface\Web;

use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpFoundation\Session\SessionInterface;
use App\Application\Service\DelivererService;
use App\Application\Service\RepackagerService;

/**
 * Main controller.
 */
class MainController extends Controller
{
    /**
     * @var DelivererService
     */
    private $delivererService;

    /**
     * @var RepackagerService
     */
    private $repackagerService;

    private $truck;
    private $bigTruck;
    private $deliveryTrucks;
    private $plane;

    /**
     * MainController constructor.
     * @param DelivererService $delivererService
     * @param RepackagerService $repackagerService
     */
    public function __construct(
        DelivererService $delivererService,
        RepackagerService $repackagerService
    )
    {
        $this->delivererService = $delivererService;
        $this->repackagerService = $repackagerService;
    }

    /**
     * @Route("/deliver/cargo", name="deliver_cargo")
     */
    public function deliverCargo(SessionInterface $session)
    {
        dump("MainController deliverCargo()");
        $this->delivererService->prepareDelivery();
        $this->truck = $this->delivererService->getTruck();
        $this->bigTruck = $this->delivererService->getBigTruck();
        $session->set('truck', $this->truck);
        $session->set('bigTruck', $this->bigTruck);
        dump($this->truck, $this->bigTruck);
        die();
    }

    /**
     * @Route("/repack/cargo", name="repack_cargo")
     */
    public function repackCargo(SessionInterface $session)
    {
        dump("MainController repackCargo()");
        $this->truck = $session->get('truck');
        $this->bigTruck = $session->get('bigTruck');
        $session->clear();
        if ($this->truck && $this->bigTruck) {
            $this->repackagerService->repack($this->truck, $this->bigTruck);
            $this->deliveryTrucks = $this->repackagerService->getDeliveryTrucks();
            $this->plane = $this->repackagerService->getPlane();
            dump($this->deliveryTrucks, $this->plane);
        } else {
            dump("The cargo was not delivered.");
        }
        die();
    }
}
