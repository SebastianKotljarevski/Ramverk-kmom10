<?php

namespace Anax\Controller;

use Anax\Commons\ContainerInjectableInterface;
use Anax\Commons\ContainerInjectableTrait;
use Anax\User\HTMLForm\UserLoginForm;
use Anax\User\HTMLForm\CreateUserForm;
use Anax\Controller\HTMLForm\CreatePostForm;



/**
 * A sample controller to show how a controller class can be implemented.
 */
class PostController implements ContainerInjectableInterface
{
    use ContainerInjectableTrait;



    /**
     * @var $data description
     */
    //private $data;

    /**
     * Description.
     *
     * @param datatype $variable Description
     *
     * @throws Exception
     *
     * @return object as a response object
     */
    public function indexAction() : object
    {
        $page = $this->di->get("page");

        if (isset($_SESSION['user_id'])) {
            $form = new CreatePostForm($this->di);
            $form->check();
            $page->add("anax/postcontroller/index", [
                "content" => $form->getHTML(),
            ]);

            return $page->render([
                "title" => "A standard page",
            ]);
        } else {
            $page = $this->di->get("page");
            $form = new UserLoginForm($this->di);
            $form->check();

            $page->add("anax/user/index", [
                "content" => $form->getHTML(),
            ]);

            return $page->render([
                "title" => "A login page",
            ]);
        }
    }
}
