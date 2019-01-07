<?php

namespace Anax\Profile;

use Anax\Commons\ContainerInjectableInterface;
use Anax\Commons\ContainerInjectableTrait;
use Anax\User\HTMLForm\UserLoginForm;
use Anax\User\HTMLForm\CreateUserForm;
use Anax\Profile\HTMLForm\UpdateProfileForm;
use Anax\Controller\HTMLForm\CreatePostForm;
use Anax\User\User;



/**
 * A sample controller to show how a controller class can be implemented.
 */
class ProfileController implements ContainerInjectableInterface
{
    use ContainerInjectableTrait;

    public function getProfile($acronym) : object
    {
        $sql = "SELECT * FROM User WHERE acronym = " . $acronym . ";";
        $db = $this->di->get("dbqb");
        $db->connect();
        $res = $db->executeFetchAll($sql);
        return $res;
    }

    public function getProfileDetails($acronym) : object
    {
        $user = new User();
        $user->setDb($this->di->get("dbqb"));
        $user->find("acronym", $acronym);
        return $user;
    }

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
            $profile = $this->getProfileDetails($_SESSION['user_id']);
            $page->add("anax/profile/index", [
                "title" => "A standard page",
                "image" => $img,
                "profile" => $profile,
            ]);

            return $page->render([
                "title" => "A standard page",
                "image" => $img,
                "profile" => $profile,
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

    public function editAction(int $id) : object
    {
        $page = $this->di->get("page");

        if (isset($_SESSION['user_id'])) {
            $form = new UpdateProfileForm($this->di, $id);
            $form->check();
            $page->add("anax/profile/edit", [
                "title" => "A standard page",
                "content" => $form->getHTML(),
            ]);

            return $page->render([
                "title" => "A standard page",
                "content" => $form->getHTML(),
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
