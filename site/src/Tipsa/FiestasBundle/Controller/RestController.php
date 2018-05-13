<?php

namespace Tipsa\FiestasBundle\Controller;

use Tipsa\FiestasBundle\Entity\Departamento;
use Tipsa\FiestasBundle\Entity\Municipio;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use FOS\RestBundle\Controller\Annotations as Rest;
use Symfony\Component\HttpKernel\Exception\NotFoundHttpException;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\HttpFoundation\JsonResponse;
use Nelmio\ApiDocBundle\Annotation\ApiDoc;
use Symfony\Component\Serializer\Serializer;
use Symfony\Component\Serializer\Encoder\XmlEncoder;
use Symfony\Component\Serializer\Encoder\JsonEncoder;
use Symfony\Component\Serializer\Normalizer\ObjectNormalizer;
use \Statickidz\GoogleTranslate;

class RestController  extends Controller
{
    /**
     * Retorna lista de departamentos
     *
     * @ApiDoc(
     *  section="Departamentos",
     *  resource=true,
     *  description="Retorna la lista de todos los departamentos",
     *  output="Tipsa\FiestasBundle\Entity\Departamento",
     *  statusCodes={
     *         200="Cuando no existe error"
     *  },
     *  tags={
     *   "stable" = "#4A7023",
     *  }
     * )
     */
    public function allAction()
    {
        $em = $this->getDoctrine()->getManager();

        $departamentos = $em->getRepository('FiestasBundle:Departamento')->findBy(
            array(),
            array('Departamento' => 'ASC')
        );

        $serializer = $this->container->get('jms_serializer');

        return new Response($serializer->serialize($departamentos, 'json'));
    }

    /**
     * Retorna un departamento por medio de su {id}
     *
     * @ApiDoc(
     *  section="Departamentos",
     *  description="Obtener departamento",
     *  requirements={
     *      {
     *          "name"="id",
     *          "dataType"="integer",
     *          "requirement"="*",
     *          "description"="departamento id"
     *      }
     *  },
     *  output="Tipsa\FiestasBundle\Entity\Departamento",
     *  statusCodes={
     *         200="Cuando no existe error"
     *  },
     *  tags={
     *   "stable" = "#4A7023",
     *   "necesita parametros" = "#ff0000"
     *  }
     * )
     */
    public function departamentoAction($id)
    {
        $em = $this->getDoctrine()->getManager();

        $departamento = $em->getRepository('FiestasBundle:Departamento')->find($id);

        $serializer = $this->container->get('jms_serializer');

        return new Response($serializer->serialize($departamento, 'json'));
    }

    /**
     * Retorna una lista de municipios por medio del {id} del departamento
     *
     * @ApiDoc(
     *  section="Municipios",
     *  description="Obtener lista de municipios por departamento",
     *  requirements={
     *      {
     *          "name"="id",
     *          "dataType"="integer",
     *          "requirement"="*",
     *          "description"="departamento id"
     *      }
     *  },
     *  output="Tipsa\FiestasBundle\Entity\Municipio",
     *  statusCodes={
     *         200="Cuando no existe error"
     *  },
     *  tags={
     *   "stable" = "#4A7023",
     *   "necesita parametros" = "#ff0000"
     *  }
     * )
     */
    public function municipiosAction($id)
    {    
        $em = $this->getDoctrine()->getManager();

        $municipios = $em->getRepository('FiestasBundle:Municipio')->findBy(array(
            'Departamento_id' => $id
        ));

        $serializer = $this->container->get('jms_serializer');

        return new Response($serializer->serialize($municipios, 'json'));
    }


    /**
     * Retorna un municipio por medio su {id}
     *
     * @ApiDoc(
     *  section="Municipios",
     *  description="Obtener municipio",
     *  requirements={
     *      {
     *          "name"="id",
     *          "dataType"="integer",
     *          "requirement"="*",
     *          "description"="municipio id"
     *      }
     *  },
     *  output="Tipsa\FiestasBundle\Entity\Municipio",
     *  statusCodes={
     *         200="Cuando no existe error"
     *  },
     *  tags={
     *   "stable" = "#4A7023",
     *   "necesita parametros" = "#ff0000"
     *  }
     * )
     */    
    public function municipioAction($id)
    {    
        $em = $this->getDoctrine()->getManager();

        $municipio = $em->getRepository('FiestasBundle:Municipio')->find($id);

        $serializer = $this->container->get('jms_serializer');

        return new Response($serializer->serialize($municipio, 'json'));
    }

    /**
     * Retorna las fiestas patronales del municipio por medio su {id}
     *
     * @ApiDoc(
     *  section="FiestasPatronales", 
     *  description="Obtener fiesta patronal por municipio",
     *  requirements={
     *      {
     *          "name"="id",
     *          "dataType"="integer",
     *          "requirement"="*",
     *          "description"="municipio id"
     *      }
     *  },
     *  output="Tipsa\FiestasBundle\Entity\FiestaPatronal",
     *  statusCodes={
     *         200="Cuando no existe error"
     *  },
     *  tags={
     *   "stable" = "#4A7023",
     *   "necesita parametros" = "#ff0000"
     *  }
     * )
     */    
    public function fiestaPatronalAction(Municipio $municipio, $lang)
    {    
        $em = $this->getDoctrine()->getManager();
 
        $entities = $em->getRepository('FiestasBundle:FiestaPatronal')->findBy(array(
            'Municipio_id' => $municipio->getId()
        ));
        $fiesta = array();
        $source = 'es';
        $target = $lang;
        $trans = new GoogleTranslate();
        
        foreach($entities as $entity)
        {
            $entity->setNombre($trans->translate($source, $target, $entity->getNombre()));
            $entity->setDescripcion($trans->translate($source, $target, $entity->getDescripcion()));
            $fiesta[] = $entity;
        }
        $serializer = $this->container->get('jms_serializer');

        return new Response($serializer->serialize($fiesta, 'json'));
    }

    /**
     * Retorna las fiestas patronales del dia
     *
     * @ApiDoc(
     *  section="FiestasPatronales", 
     *  description="Obtener fiestas patronales del dia",
     *  output="Tipsa\FiestasBundle\Entity\FiestaPatronal",
     *  statusCodes={
     *         200="Cuando no existe error"
     *  },
     *  tags={
     *   "stable" = "#4A7023",
     *  }
     * )
     */    
    public function fiestaPatronalHoyAction($lang)
    {    
        $em = $this->getDoctrine()->getManager();

        $entities = $em->getRepository('FiestasBundle:FiestaPatronal')->findAll();
        $fiesta = array();
        $source = 'es';
        $target = $lang;
        $trans = new GoogleTranslate();
        
        foreach($entities as $entity)
        {
            $entity->setNombre($trans->translate($source, $target, $entity->getNombre()));
            $entity->setDescripcion($trans->translate($source, $target, $entity->getDescripcion()));
            $fiesta[] = $entity;
        }
        $serializer = $this->container->get('jms_serializer');

        return new Response($serializer->serialize($fiesta, 'json'));
    }

    public function fiestasTitulosTraducciones($lang)
    {
        $titulos = array();
        $titulos["principal"] = "Fiestas patronales Guatemala";
        $titulos["departamentos"] = "Departamentos";
        $titulos["municipios"] = "Municipios";
        $titulos["hoy"] = "hoy";
    }
}
