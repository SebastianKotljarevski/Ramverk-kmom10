<?php

namespace Anax\Profile;

use Anax\Commons\ContainerInjectableInterface;
use Anax\Commons\ContainerInjectableTrait;
use Anax\User\HTMLForm\UserLoginForm;
use Anax\User\HTMLForm\CreateUserForm;
use Anax\Controller\HTMLForm\CreatePostForm;



/**
 * A sample controller to show how a controller class can be implemented.
 */
class ProfileController implements ContainerInjectableInterface
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
            $gravImg = new GravatarModel();
            $img = $gravImg->getPicture($_SESSION['user_email']);
            $page->add("anax/profile/index", [
                "title" => "A standard page",
                "image" => $img,
            ]);

            return $page->render([
                "title" => "A standard page",
                "image" => $img,
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
