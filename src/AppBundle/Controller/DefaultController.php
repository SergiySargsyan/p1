<?php

namespace AppBundle\Controller;

use AppBundle\Entity\Contract;
use AppBundle\Entity\Customer;
use AppBundle\Entity\Service;
use AppBundle\Form\SearchType;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class DefaultController extends Controller
{
    /**
     * @Route("/", name="homepage")
     */
    public function indexAction(Request $request)
    {
        $form = $this->createForm(SearchType::class);
        $form->handleRequest($request);

        return $this->render('@App/default_layout.html.twig', [
            'form'=>$form->createView() ,
        ]);
    }

    /**
     * @param Request $request
     * @Route("/get_contract_ids", name="get_contracts_ids")
     * @return JsonResponse
     */
    public function getContractIds(Request $request)
    {
        $data = 'Not found';
        $code = 400;
        if ($customerId = $request->get('customer_id')){
            $em = $this->getDoctrine()->getManager();
            $customer = $em->getRepository('AppBundle:Customer')->createQueryBuilder('customer')
                ->andWhere('customer.id = :id')
                ->orWhere('customer.name = :name')
                ->setParameters(['id'=>$customerId, 'name'=>$customerId])
                ->getQuery()
                ->getResult()
            ;
            dump($customer);
            if ($customer && count($customer)==1){//найдено 1 совпадение
                /** @var Customer $customer */
                $customer = $customer[0];
                $contracts = $customer->getContracts();
                $data = [];
                /** @var Contract $contract */
                foreach ($contracts as $contract){
                    $data[] = $contract->getId();
                }

                $data = json_encode($data);
                $code = 200;
            }
        }


        return new JsonResponse($data, $code);
    }

    /**
     * @param Request $request
     * @Route("/get_template", name="get_template")
     * @return Response
     */
    public function getTemplate(Request $request)
    {
        $data = 'Not found';
        $code = 400;

        $formData = $request->get('search');
        $serviceStatuses = Service::$serviceStatuses;
        if (array_key_exists('serviceStatus',$formData)){
            $serviceStatuses = $formData['serviceStatus'];
        }
        $em = $this->getDoctrine()->getManager();
        $contract = $em->getRepository('AppBundle:Contract')->find($formData['contractId']);

        if ($contract){
            $services = $em->getRepository('AppBundle:Service')->createQueryBuilder('service')
                ->andWhere('service.contract = :contract')
                ->andWhere('service.status IN (:statuses)')
                ->setParameters(['contract'=>$contract,'statuses'=>$serviceStatuses])->getQuery()->getResult();
            $body = $this->render('@App/response_template.html.twig',['contract'=>$contract,'services'=>$services]);
            $data = $body->getContent();
            $code = 200;
        }

        return new Response($data,$code);
    }
}
