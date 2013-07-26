<?php

namespace Hackkrk\ApihackBundle\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Template;
<<<<<<< HEAD
//use Sensio\Bundle\FrameworkExtraBundle\Configuration\Method;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;

class DefaultController extends Controller {
    /**
     * @Route("/nodes")
     * @Template()
     */
    public function indexAction(Request $request) {
      $array = array();
//      $this->getRequest()->get('q');
      $content = $request->getContent();
      if (!empty($content)) {
        $params = json_decode($content, true);
        if ($params['kind']) {
          $array;
        }
      }else {
        $array;
      }

//      $array;

      $response = new Response(json_encode($array));
      $response->headers->set('Content-Type', 'application/json');
      return $response;
    }
=======
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Method;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Hackkrk\ApihackBundle\Entity\Node;

class DefaultController extends Controller {

  /**
   * @Route("/nodes")
   * @Template()
   * @Method("post")
   */
  public function createAction(Request $request) {
    $array = array();
    $content = $request->getContent();
    if (!empty($content)) {
//        $logger = $this->get('logger');
//        $logger->info($content);

      $params = json_decode($content, true);
      $node = new Node($params);

      $validator = $this->get('validator');
      $errors = $validator->validate($node);

      if (count($errors) > 0) {
        $code = 422;
        $array = array('error' => 'Could not parse integer');
      } else {
        $em = $this->getDoctrine()->getEntityManager();
        $em->persist($node);
        $em->flush();
        $array = $node->toArray();
        $code = 201;
      }
    } else {
      $array = array('error' => 'Incorrect variable');
      $code = 422;
    }

    $response = new Response(json_encode($array));
    $response->setStatusCode($code);
    $response->headers->set('Content-Type', 'application/json');
    return $response;
  }

  /**
   * @Route("/nodes/{id}/{action}",
   * defaults={"action"="0"},
   * requirements={"id"="\d+"}
   * )
   * @Template()
   * @Method("get")
   */
  public function getAction($id, $action) {
    $array = array();

    $node = $this->getDoctrine()->getRepository('HackkrkApihackBundle:Node')->findOneById($id);

    if ($action == 'evaluate') {
      $function = $node->getFunction();
      $arguments = $node->getArguments();
      $arg1 = $this->getDoctrine()->getRepository('HackkrkApihackBundle:Node')->findOneById($arguments[0]);
      $arg2 = $this->getDoctrine()->getRepository('HackkrkApihackBundle:Node')->findOneById($arguments[1]);

      if ($function == 1) {
        $result = $this->add($arg1, $arg2);
      } else if ($function == 2) {
        $result = $this->mult($arg1, $arg2);
      } else if ($function == 3) {
        $result = $this->lt($arg1, $arg2);
      }

      $array = array('result' => $result);
    }else {
      $array = $node->toArray();
    }

    $code = 200;
    $response = new Response(json_encode($array));
    $response->setStatusCode($code);
    $response->headers->set('Content-Type', 'application/json');
    return $response;
  }

  /**
   * @Route("/functions/builtin/{operator}")
   * @Template()
   * @Method("get")
   */
  public function operateAction($operator) {

    if ($operator == 'add') {
      $array = array('id' => 1);
    } else if ($operator == 'mult') {
      $array = array('id' => 2);
    } else if ($operator == 'lt') {
      $array = array('id' => 3);
    }

    $code = 200;
    $response = new Response(json_encode($array));
    $response->setStatusCode($code);
    $response->headers->set('Content-Type', 'application/json');
    return $response;
  }

  private function add($arg1, $arg2) {
//    foreach ($arguments) {
//
//    }
    return $arg1->getValue() + $arg2->getValue();
  }

  private function mult($arg1, $arg2) {
    return $arg1->getValue() * $arg2->getValue();
  }

  private function lt($x, $y) {
    return true;
  }

>>>>>>> development
}
