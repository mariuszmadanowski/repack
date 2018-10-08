<?php

namespace App\Domain\Service;

use App\Domain\Model\Truck;
use App\Domain\Model\Box;
use App\Domain\Model\BigTruck;
use App\Domain\Model\AgriculturalMachine;
use App\Domain\Model\WeightSpecification;
use App\Domain\ValueObject\Weight;
use App\Domain\Model\CapacitySpecification;
use App\Domain\ValueObject\Capacity;

/**
 * @author Mariusz Madanowski
 */
class DelivererService
{
    private $truckSpecification;
    private $boxSpecification;
    private $bigTruckSpecification;
    private $agriculturalMachineSpecification;

    private $truck;
    private $bigTruck;

    /**
     * @author Mariusz Madanowski
     */
    public function __construct()
    {
        $this->createBoxSpecification();
        $this->createTruckSpecification();
        $this->createBigTruckSpecification();
        $this->createAgriculturalMachineSpecification();
    }

    private function createBoxSpecification(): void
    {
        $this->boxSpecification = new WeightSpecification(new Weight(10, 'kg'), 'min');
        $this->boxSpecification->andSatisfiedBy(new WeightSpecification(new Weight(20, 'kg'), 'max'));
    }

    private function createTruckSpecification(): void
    {
        $this->truckSpecification = new CapacitySpecification(new Capacity(5), 'min');
        $this->truckSpecification->andSatisfiedBy(new CapacitySpecification(new Capacity(40), 'max'));
    }

    private function createBigTruckSpecification(): void
    {
        $this->bigTruckSpecification = new CapacitySpecification(new Capacity(1), 'min');
        $this->bigTruckSpecification->andSatisfiedBy(new CapacitySpecification(new Capacity(2), 'max'));
    }

    private function createAgriculturalMachineSpecification(): void
    {
        $this->agriculturalMachineSpecification = new WeightSpecification(new Weight(1.5, 't'), 'min');
        $this->agriculturalMachineSpecification->andSatisfiedBy(new WeightSpecification(new Weight(2, 't'), 'max'));
    }

    private function loadTruck(Truck $truck): Truck
    {
        dump("DelivererService loadTruck()");
        $i = 0;
        while (true) {
            $box = new Box(new Weight(rand(5, 25), 'kg'));
            if ($this->boxSpecification->isSatisfiedBy($box)) {
                $i++;
                $truck->packCargo($box);
                if ($i == $truck->getCapacity()->getQuantity()) {
                    break;
                }
            }
        }

        dump($truck);
        return $truck;
    }

    private function createTruck(): Truck
    {
        dump("DelivererService createTruck()");
        while (true) {
            $truck = new Truck(rand(35, 45));

            if ($this->truckSpecification->isSatisfiedBy($truck)) {
                break;
            }
        }
        dump($truck);
        return $truck;
    }

    private function createBigTruck(): BigTruck
    {
        dump("DelivererService createBigTruck()");
        while (true) {
            $bigTruck = new BigTruck(rand(1, 2));

            if ($this->bigTruckSpecification->isSatisfiedBy($bigTruck)) {
                break;
            }
        }
        dump($bigTruck);
        return $bigTruck;
    }

    private function loadBigTruck(BigTruck $bigTruck): BigTruck
    {
        dump("DelivererService loadBigTruck()");
        $i = 0;
        while (true) {
            $agriculturalMachine = new AgriculturalMachine(new Weight(rand(2, 6) / 2, 't'));
            if ($this->agriculturalMachineSpecification->isSatisfiedBy($agriculturalMachine)) {
                $i++;
                $bigTruck->packCargo($agriculturalMachine);
                if ($i == $bigTruck->getCapacity()->getQuantity()) {
                    break;
                }
            }
        }
        dump($bigTruck);
        return $bigTruck;
    }

    public function prepareDelivery(): void
    {
        dump("DelivererService prepareDelivery()");
        $truck = $this->createTruck();
        $this->truck = $this->loadTruck($truck);

        $bigTruck = $this->createBigTruck();
        $this->bigTruck = $this->loadBigTruck($bigTruck);
    }

    public function getTruck(): Truck
    {
        return $this->truck;
    }

    public function getBigTruck(): BigTruck
    {
        return $this->bigTruck;
    }
}
