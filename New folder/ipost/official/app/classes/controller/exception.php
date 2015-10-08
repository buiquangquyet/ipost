<?php
/**
 * The Exception Controller.
 *
 * @package  app
 * @extends  Controller
 */
class Controller_Exception extends Basecontroller
{

  /**
   * The 404 action for the application.
   *
   * @access  public
   * @return  Response
   */
  public function action_404()
  {
    return View::forge('exception/404.tpl');
  }

  /**
   * The 404 action for the application.
   *
   * @access  public
   * @return  Response
   */
  public function action_409()
  {
    return View::forge('exception/409.tpl');
  }

  /**
   * The 410 action for the application.
   *
   * @access  public
   * @return  Response
   */
  public function action_410()
  {
    return View::forge('exception/410.tpl');
  }

  /**
   * The 411 action for the application.
   *
   * @access  public
   * @return  Response
   */
  public function action_411()
  {
    return View::forge('exception/411.tpl');
  }

  /**
   * The 404 action for the application.
   *
   * @access  public
   * @return  Response
   */
  public function action_503()
  {
    return View::forge('exception/503.tpl');
  }
}
