<?php
// src/AppBundle/Repository/ProductRepository.php
namespace Tipsa\FiestasBundle\Entity;

use Doctrine\ORM\EntityRepository;

class FiestaPatronalRepository extends EntityRepository
{
    public function findHoy()
    {
        return $this->getEntityManager()
            ->createQuery(
                'SELECT f FROM FiestasBundle:FiestaPatronal f
                 WHERE MONTH(f.Fecha) = MONTH(NOW()) AND DAY(f.Fecha) = DAY(NOW()) ORDER BY f.Nombre ASC'
            )
            ->getResult();
    }
    
    public function findMonth($mes)
    {
        return $this->getEntityManager()
            ->createQuery(
                'SELECT f FROM FiestasBundle:FiestaPatronal f
                 WHERE MONTH(f.Fecha) = :mes ORDER BY f.Nombre ASC'
            )
            ->setParameter("mes", $mes)
            ->getResult();
    }
}
