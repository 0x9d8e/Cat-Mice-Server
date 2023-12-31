<?php

namespace App\GameEvents;

use App\Definitions\GameEventTypeDefinition;
use App\MapObjectInterface;

/**
 * New positions of objects on the map
 */
class NewObjectPositionsOnMap implements GameEventInterface
{
    /**
     * 
     * @var MapObjectInterface[]
     */
    protected array $objects;
    
    /**
     * 
     * @param MapObjectInterface[] $objects
     */
    public function __construct(array $objects)
    {
        $this->objects = $objects;
    }

    public function getId(): string
    {
        return GameEventTypeDefinition::NEW_OBJECT_POSITION_ON_MAP;
    }

    public function getData(): array
    {
        return array_map(
            function(MapObjectInterface $object) {
                return [
                    'id' => $object->getMapObjectId(),
                    'position' => $object
                        ->getPosition()
                        ->toArray(),
                ];
            }, 
            $this->objects,
        );
    }
}
