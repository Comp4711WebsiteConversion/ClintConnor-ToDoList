<?php
//require_once '../application/core/CSV_Model.php';
if(!class_exists('PHPUnit_Framework_TestCase')) {
  class_alias('PHPUnit\Framework\TestCase', 'PHPUnit_Framework_TestCase');
}
require_once '../application/models/Task.php';
 class TaskTest extends PHPUnit_Framework_TestCase
  {
    private $CI;
    private $task;
    public function setUp()
    {
      // Load CI instance normally
      $this->CI = &get_instance();
      $this->task = new Task;
    }

    public function testSetTask()
    {
      //var_dump($this->task-> Task = "Passing");
      //$this->task-> Task = 'Passing';
      //$this -> assertEquals('Pass',  ($this->task-> Task = 'Pass'));
    //  $this -> assertEquals('This string should fail as its over the limit of charsasdfasdfasdfasdfasdf',  ($this->task-> Task = 'This string should fail as its over the limit of charsasdfasdfasdfasdfasdf'));

      $this->assertEquals(true, $this->task->__set('Task',"This should pass"));
      $this->assertEquals(false, $this->task->__set('Task', "This should definitely not pass because the string length is fucking massive.............................."));

    }

    // public function testSetPriority()
    // {
    //   $this->assertEquals(true, $this->task->priority = 3);
    //   $this->assertEquals(false, $this->task->priority = 65);
    //
    // }


  }
