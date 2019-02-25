<?php

namespace App\Repository;

use Doctrine\ORM\EntityRepository;

class RestaurantRepository extends EntityRepository
{
    public function findAll()
    {
        return $this->findBy(array(), array('open' => 'ASC'));
    }

    public function findAllSortedByField(string $field)
    {
        if ($field === "best match") {
            return $this->findBy(array(), array('bestMatch' => 'ASC'));
        }
        if ($field === "newest") {
            return $this->findBy(array(), array('newestScore' => 'ASC'));
        }
        if ($field === "rating average") {
            return $this->findBy(array(), array('ratingAverage' => 'ASC'));
        }
        if ($field === "popularity") {
            return $this->findBy(array(), array('popularity' => 'ASC'));
        }
        if ($field === "average product price") {
            return $this->findBy(array(), array('averageProductPrice' => 'ASC'));
        }
        if ($field === "delivery costs") {
            return $this->findBy(array(), array('deliveryCosts' => 'ASC'));
        }
        if ($field === "minimum order amount costs") {
            return $this->findBy(array(), array('minimumOrderAmount' => 'ASC'));
        }

        return null;
    }
}
