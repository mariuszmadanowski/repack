<?php

namespace App\Application\Service;

use App\Domain\Model\DeliveryTruck;
use App\Domain\Model\Plane;
use App\Domain\Model\Truck;
use App\Domain\Model\BigTruck;
use App\Application\Specification\WeightSpecification;
use App\Domain\ValueObject\Weight;
use App\Application\Specification\ReceivingCapacitySpecification;
use App\Domain\ValueObject\ReceivingCapacity;

/**
 * @author Mariusz Madanowski
 */
class RepackagerService
{
    private $deliveryTruckSpecification;
    private $planeSpecification;

    private $plane;
    private $deliveryTrucks = [];

    /**
     * @author Mariusz Madanowski
     */
    public function __construct()
    {
        $this->createDeliveryTruckSpecification();
        $this->createPlaneSpecification();
    }

    public function repack(Truck $truck, BigTruck $bigTruck): void
    {
        dump("RepackagerService repack()");
        $plane = $this->createPlane();
        $this->plane = $this->repackBigTruckToPlane($bigTruck, $plane);

        $this->repackTruckToDeliveryTruck($truck);
    }

    public function getDeliveryTrucks(): array
    {
        return $this->deliveryTrucks;
    }

    public function getPlane(): Plane
    {
        return $this->plane;
    }

    private function createDeliveryTruckSpecification(): void
    {
        $this->deliveryTruckSpecification = new ReceivingCapacitySpecification(new ReceivingCapacity(new Weight(200, 'kg')));
    }

    private function createPlaneSpecification(): void
    {
        $this->planeSpecification = new ReceivingCapacitySpecification(new ReceivingCapacity(new Weight(4, 't')));
    }

    private function createDeliveryTruck(): DeliveryTruck
    {
        dump("RepackagerService createDeliveryTruck()");
        while (true) {
            $deliveryTruck = new DeliveryTruck(new Weight(200, 'kg'));

            if ($this->deliveryTruckSpecification->isSatisfiedBy($deliveryTruck)) {
                break;
            }
        }
        dump($deliveryTruck);
        return $deliveryTruck;
    }

    private function createPlane(): Plane
    {
        dump("RepackagerService createPlane()");
        while (true) {
            $plane = new Plane(new Weight(4, 't'));

            if ($this->planeSpecification->isSatisfiedBy($plane)) {
                break;
            }
        }
        dump($plane);
        return $plane;
    }

    private function repackBigTruckToPlane(BigTruck $bigTruck, Plane $plane): Plane
    {
        dump("RepackagerService repackBigTruckToPlane()");
        while ($cargo = $bigTruck->unpackCargo()) {
            if (!$plane->isFull($cargo)) {
                $plane->packCargo($cargo);
            }
        }
        dump($plane);
        return $plane;
    }

    private function repackTruckToDeliveryTruck(Truck $truck): void
    {
        dump("RepackagerService repackTruckToDeliveryTruck()");
        $deliveryTruck = $this->createDeliveryTruck();

        while ($cargo = $truck->unpackCargo()) {
            if (!$deliveryTruck->isFull($cargo)) {
                $deliveryTruck->packCargo($cargo);
            } else {
                $this->deliveryTrucks[] = $deliveryTruck;
                $deliveryTruck = $this->createDeliveryTruck();
                $deliveryTruck->packCargo($cargo);
            }
        }
        dump($this->deliveryTrucks);
    }
}
