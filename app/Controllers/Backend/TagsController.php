<?php

namespace Gulchuk\Controllers\Backend;

use Psr\Http\Message\ResponseInterface;
use Gulchuk\Controllers\BaseController;
use Gulchuk\Repositories\TagsRepository;
use Zend\InputFilter\Factory as InputFilterFactory;
use Zend\InputFilter\InputFilterInterface;

class TagsController extends BaseController
{
    private $repository;

    public function __construct(TagsRepository $repository)
    {
        $this->repository = $repository;
        parent::__construct();
    }

    public function index(): ResponseInterface
    {
        $tags = $this->repository->getWith(['articles']);

        $data = [
            'tags' => $tags
        ];

        return $this->httpResponse($this->view('backend/tags/index', $data));
    }

    public function create(): ResponseInterface
    {
        $data = [
            'redirectUrl' => $this->request->getServerParams()['HTTP_REFERER']
        ];

        return $this->httpResponse($this->view('backend/tags/create', $data));
    }

    public function remove(): ResponseInterface
    {
        $id = $this->argument(func_get_arg(2), 'id');

        $tag = $this->repository->findById($id);

        if (is_null($tag)) {
            return $this->jsonResponse(['message' => 'Record not found.']);
        }

        $this->repository->syncArticles($id, []);
        $this->repository->delete($id);

        return $this->jsonResponse(['success' => 'OK']);
    }

    public function save(): ResponseInterface
    {
        $data = [
            'title' => $this->postArgument('title'),
            'slug' => $this->postArgument('slug'),
            'content' => $this->postArgument('content'),
        ];

        $inputFilter = $this->saveTagInputFilter();
        $inputFilter->setData($data);

        if (!$inputFilter->isValid()) {
            return $this->jsonResponse([
                'message' => $this->formatErrorMessages($inputFilter),
            ]);
        }

        // TODO: Save Tag
        // ...

        return $this->jsonResponse([
            'success' => 'OK'
        ]);
    }

    private function saveTagInputFilter(): InputFilterInterface
    {
        $factory = new InputFilterFactory();
        $inputFilter = $factory->createInputFilter([
            'title' => [
                'required' => true,
                'filters' => [
                    ['name' => 'StringTrim'],
                    ['name' => 'StripTags'],
                ],
            ],
            'slug' => [
                'required' => true,
                'filters' => [
                    ['name' => 'StringTrim'],
                    ['name' => 'StripTags'],
                ],
            ],
            'content' => [
                'required' => false
            ],
        ]);

        return $inputFilter;
    }

    private function formatErrorMessages(InputFilterInterface $inputFilter): string
    {
        $result = '';

        foreach ($inputFilter->getInvalidInput() as $key => $error) {
            $result .= '<li>Field "'. $key .'":<ul><li>' . implode('</li><li>', $error->getMessages()) . '</li></ul></li>';
        }

        $result = '<ul>' . $result . '</ul>';

        return $result;
    }
}
