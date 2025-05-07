<?php

namespace Lime\CustomLink\Plugin;

use Magento\Framework\Data\Tree\NodeFactory;
use Magento\Framework\UrlInterface;

class AddCustomLink
{
    protected $nodeFactory;
    protected $urlBuilder;

    public function __construct(NodeFactory $nodeFactory, UrlInterface $urlBuilder)
    {
        $this->nodeFactory = $nodeFactory;
        $this->urlBuilder = $urlBuilder;
    }

    public function beforeGetHtml(
        \Magento\Theme\Block\Html\Topmenu $subject,
        $outermostClass = '',
        $childrenWrapClass = '',
        $limit = 0
    ) {
        $menu = $subject->getMenu();

        
        $homeNode = $this->nodeFactory->create(
            [
                'data' => [
                    'name' => __('Home'),
                    'id' => 'custom-home-link',
                    'url' => $this->urlBuilder->getUrl('/'),
                    'has_active' => false,
                    'is_active' => false
                ],
                'idField' => 'id',
                'tree' => $menu->getTree()
            ]
        );
        $menu->addChild($homeNode);

      
        $helloNode = $this->nodeFactory->create(
            [
                'data' => [
                    'name' => __('Hello!'),
                    'id' => 'custom-hello-link',
                    'url' => $this->urlBuilder->getUrl('sample/index/hello'),
                    'has_active' => false,
                    'is_active' => false
                ],
                'idField' => 'id',
                'tree' => $menu->getTree()
            ]
        );
        $menu->addChild($helloNode);
    }
}
