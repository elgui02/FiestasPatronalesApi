<?php

/**
 * Auto generated by MySQL Workbench Schema Exporter.
 * Version 3.0.3 (doctrine2-annotation) on 2018-04-03 06:20:43.
 * Goto
 * https://github.com/mysql-workbench-schema-exporter/mysql-workbench-schema-exporter
 * for more information.
 */

namespace Tipsa\FiestasBundle\Entity;

use Doctrine\ORM\Mapping as ORM;
use Doctrine\Common\Collections\ArrayCollection;
use JMS\Serializer\Annotation\ExclusionPolicy;
use JMS\Serializer\Annotation\Expose;

/**
 * Tipsa\FiestasBundle\Entity\Departamento
 *
 * @ORM\Entity()
 * @ORM\Table(name="Departamento")
 * @ExclusionPolicy("all")
 */
class Departamento
{
    /**
     * @ORM\Id
     * @ORM\Column(type="bigint")
     * @ORM\GeneratedValue(strategy="AUTO")
     * @Expose
     */
    protected $id;

    /**
     * @ORM\Column(type="string", length=250)
     * @Expose
     */
    protected $Departamento;

    /**
     * @ORM\OneToMany(targetEntity="Municipio", mappedBy="departamento")
     * @ORM\JoinColumn(name="id", referencedColumnName="departamento_id", nullable=false)
     */
    protected $municipios;

    public function __construct()
    {
        $this->municipios = new ArrayCollection();
    }

    /**
     * Set the value of id.
     *
     * @param integer $id
     * @return \Tipsa\FiestasBundle\Entity\Departamento
     */
    public function setId($id)
    {
        $this->id = $id;

        return $this;
    }

    /**
     * Get the value of id.
     *
     * @return integer
     */
    public function getId()
    {
        return $this->id;
    }

    /**
     * Set the value of Departamento.
     *
     * @param string $Departamento
     * @return \Tipsa\FiestasBundle\Entity\Departamento
     */
    public function setDepartamento($Departamento)
    {
        $this->Departamento = $Departamento;

        return $this;
    }

    /**
     * Get the value of Departamento.
     *
     * @return string
     */
    public function getDepartamento()
    {
        return $this->Departamento;
    }

    /**
     * Add Municipio entity to collection (one to many).
     *
     * @param \Tipsa\FiestasBundle\Entity\Municipio $municipio
     * @return \Tipsa\FiestasBundle\Entity\Departamento
     */
    public function addMunicipio(Municipio $municipio)
    {
        $this->municipios[] = $municipio;

        return $this;
    }

    /**
     * Remove Municipio entity from collection (one to many).
     *
     * @param \Tipsa\FiestasBundle\Entity\Municipio $municipio
     * @return \Tipsa\FiestasBundle\Entity\Departamento
     */
    public function removeMunicipio(Municipio $municipio)
    {
        $this->municipios->removeElement($municipio);

        return $this;
    }

    /**
     * Get Municipio entity collection (one to many).
     *
     * @return \Doctrine\Common\Collections\Collection
     */
    public function getMunicipios()
    {
        return $this->municipios;
    }

    public function __sleep()
    {
        return array('id', 'Departamento');
    }
}