<?php

namespace Anax\Controller;

use Anax\Commons\ContainerInjectableInterface;
use Anax\Commons\ContainerInjectableTrait;
use Anax\User\HTMLForm\UserLoginForm;
use Anax\User\HTMLForm\CreateUserForm;
use Anax\Controller\HTMLForm\CreatePostForm;
use Anax\Controller\HTMLForm\CreateAnswerForm;
use Anax\User\User;


/**
 * A sample controller to show how a controller class can be implemented.
 */
class HomeController implements ContainerInjectableInterface
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
            $post = new Post();
            $post->setDb($this->di->get("dbqb"));
            $user = new User();
            $user->setDb($this->di->get("dbqb"));
            $page->add("anax/home/index", [
                "title" => "A standard page",
                "items" => $post->findAll(),
                "user" => $user->findAll(),
            ]);

            return $page->render([
                "title" => "A standard page",
                "items" => $post->findAll(),
                "user" => $user->findAll(),
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

    public function getItemDetails($id) : object
    {
        $post = new Post();
        $post->setDb($this->di->get("dbqb"));
        $post->find("postId", $id);
        return $post;
    }

    public function getAnswers($id) : object
    {
        $answer = new Answer();
        $answer->setDb($this->di->get("dbqb"));
        $answer->findWhere("id = ?", $id);
        return $answer;
    }

    public function getAnswersProg($id) : array
    {
        $sql = "SELECT * FROM Answers WHERE id =" . $id . ";";
        $db = $this->di->get("dbqb");
        $db->connect();
        $res = $db->executeFetchAll($sql);
        return $res;
    }

    public function viewpostAction(int $id) : object
    {
        $page = $this->di->get("page");

        if (isset($_SESSION['user_id'])) {
            $form = new CreateAnswerForm($this->di, $id);
            $form->check();
            $user = new User();
            $user->setDb($this->di->get("dbqb"));
            $post = $this->getItemDetails($id);
            $answer = $this->getAnswersProg($id);
            $page->add("anax/home/viewpost", [
                "title" => "A standard page",
                "item" => $post,
                "content" => $form->getHTML(),
                "answer" => $answer,
                "user" => $user->findAll(),
            ]);

            return $page->render([
                "title" => "A standard page",
                "item" => $post,
                "content" => $form->getHTML(),
                "answer" => $answer,
                "user" => $user->findAll(),
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
