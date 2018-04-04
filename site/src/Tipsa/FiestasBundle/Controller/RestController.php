<?php

namespace Tipsa\FiestasBundle\Controller;

use Tipsa\FiestasBundle\Entity\Departamento;
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

class RestController  extends Controller
{
    /**
     * Response departament list
     *
     * @ApiDoc(
     *  section="Departamentos",
     *  resource=true,
     *  description="Response deparament list",
     *  statusCodes={
     *         200="Returned when successful"
     *  },
     *  tags={
     *   "stable" = "#4A7023",
     *  }
     * )
     */
    public function allAction()
    {
        $em = $this->getDoctrine()->getManager();

        $departamentos = $em->getRepository('FiestasBundle:Departamento')->findAll();

        $serializer = $this->container->get('jms_serializer');

        return new Response($serializer->serialize($departamentos, 'json'));
    }

    /**
     * Response with the departament that has {departament} for id
     *
     * @ApiDoc(
     *  section="Departamentos",
     *  description="Get a departament",
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
     *         200="Returned when successful"
     *  },
     *  tags={
     *   "stable" = "#4A7023",
     *   "need validations" = "#ff0000"
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

    public function municipiosAction($id)
    {    
        $em = $this->getDoctrine()->getManager();

        $municipios = $em->getRepository('FiestasBundle:Municipio')->findBy(array(
            'Departamento_id' => $id
        ));

        $serializer = $this->container->get('jms_serializer');

        return new Response($serializer->serialize($municipios, 'json'));
    }

    public function municipioAction($id)
    {    
        $em = $this->getDoctrine()->getManager();

        $municipio = $em->getRepository('FiestasBundle:Municipio')->find($id);

        $serializer = $this->container->get('jms_serializer');

        return new Response($serializer->serialize($municipio, 'json'));
    }

}
