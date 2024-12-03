<?php
namespace App\Core;
use App\Core\Interfaces\ControllerInterface;
use Laminas\Diactoros\ServerRequest;

class CoreController implements ControllerInterface
{
    public $Article;
	public $View;
    public function __construct()
    {
        $this->View = new CoreView('');
        $this->Article = new CoreModel();
    }

    public function index()
    {
        // TODO: Implement index() method.
        echo $this->View->renderIndexPage();
    }

    public function create()
    {
        // TODO: Implement create() method.
        echo $this->View->showArticleAddPage();
    }

    public function store(ServerRequest $request)
    {
        // TODO: Implement store() method.
        $article = $request->getParsedBody();
        $filtered = \GUMP::filter_input($article, $this->Article->filter);
        unset($filtered['id']);
        $is_valid=\GUMP::is_valid($filtered, $this->Article->rules);
        if ($is_valid === true)
        {
            if($this->Article->add($filtered) == null)
            {
                echo "Статья добавлена";
                Helper::goUrl('/admin/articles');
            }
        }
        else
        {
            echo $is_valid;
            Helper::goUrl('/admin/article/add');
        }
    }

    public function show()
    {
        // TODO: Implement show() method.
        $articles = $this->Article->getAll();
        echo $this->View->showArticlesTable($articles);
    }

    public function edit($id)
    {
        // TODO: Implement edit() method.
        $article = $this->Article->find($id);
        echo $this->View->showArticleEditPage($article);
    }

    public function update(ServerRequest $request)
    {
        // TODO: Implement update() method.
        $article = $request->getParsedBody();
        $this->Article->update($article);
        Helper::goUrl('/admin/articles');
    }

    public function destroy($id)
    {
        // TODO: Implement destroy() method.
        $this->Article->delete($id);
        Helper::goUrl('/admin/articles');
    }
}