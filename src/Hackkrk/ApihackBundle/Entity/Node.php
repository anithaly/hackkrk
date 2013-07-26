<?php

<<<<<<< HEAD
namespace Exhibite\NodeBundle\Entity;

use Doctrine\ORM\Mapping as ORM;
=======
namespace Hackkrk\ApihackBundle\Entity;

use Doctrine\ORM\Mapping as ORM;
use Symfony\Component\Validator\Constraints as Assert;
>>>>>>> development

/**
 * @ORM\Table(name="nodes")
 * @ORM\Entity()
 */
class Node {

  /**
   * @var integer $id
   *
   * @ORM\Column(name="id", type="integer")
   * @ORM\Id
   * @ORM\GeneratedValue(strategy="AUTO")
   */
  protected $id;

  /**
<<<<<<< HEAD
   * @ORM\Column(name="kind", type="string", length=255)
=======
   * @ORM\Column(name="kind", type="string", length=255, nullable=true)
>>>>>>> development
   */
  protected $kind;

  /**
<<<<<<< HEAD
   * @ORM\Column(name="type", type="string", length=255)
=======
   * @ORM\Column(name="type", type="string", length=255, nullable=true)
>>>>>>> development
   */
  protected $type;

  /**
<<<<<<< HEAD
   * @ORM\Column(name="value", type="integer")
   */
  protected $value;

//  public function __construct(){
////        $this->d = new ArrayCollection();
//    }
=======
   * @ORM\Column(name="arguments", type="text", nullable=true)
   */
  protected $arguments;

  /**
   * @ORM\Column(name="function", type="integer", nullable=true)
   */
  protected $function;

  /**
   * @ORM\Column(name="value", type="integer", nullable=true)
   * Assert\NotBlank(message= "")
   * @Assert\Regex(pattern="/\d+/")
   */
  protected $value;

  public function __construct($params){
    if (isset($params['kind'])) {
      $this->kind = $params['kind'];
    }
    if (isset($params['type'])) {
      $this->type = $params['type'];
    }
    if (isset($params['value'])) {
      $this->value = $params['value'];
    }
    if (isset($params['function'])) {
      $this->function = $params['function'];
    }
    if (isset($params['arguments'])) {
      $this->arguments = serialize($params['arguments']);
    }
  }
>>>>>>> development

  public function getId() {
    return $this->id;
  }

  public function getValue() {
    return $this->value;
  }

  public function setValue($v) {
    $this->value = $v;
  }

  public function getType() {
    return $this->type;
  }

  public function setType($v) {
    $this->type = $v;
  }

  public function getKind() {
    return $this->kind;
  }

  public function setKind($v) {
    $this->kind = $v;
  }

<<<<<<< HEAD
=======
  public function getArguments() {
    return unserialize($this->arguments);
  }

  public function setArguments($v) {
    $this->arguments = $v;
  }

  public function getFunction() {
    return $this->function;
  }

  public function setFunction($v) {
    $this->function = $v;
  }

  public function toArray() {
    return array(
        'kind' => $this->getKind(),
        'type' => $this->getType(),
        'value' => $this->getValue(),
        'arguments' => $this->getArguments(),
        'function' => $this->getFunction(),
        'id' => $this->getId()
    );
  }

>>>>>>> development
}