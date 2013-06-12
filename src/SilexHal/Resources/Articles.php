<?php
namespace SilexHal\Resources;
use Nocarrier\Hal;

class Articles extends Resource {
    private $data = array(
        1 => array('id' => 1, 'title' => 'foo', 'author' => 'bar', 'votes' => 121),
        2 => array('id' => 2, 'title' => 'qux', 'author' => 'baz', 'votes' => 423),
        3 => array('id' => 3, 'title' => 'bar', 'author' => 'qux', 'votes' => 23),
    );

    public function __construct()
    {
        $this->setURI('articles');
        $this->setName('articles');
        $this->setDescription('Lorem ipsum dolor sit amet, consectetur adipisicing elit, sed do eiusmod tempor incididunt ut');
    }

    public function getOne($id)
    {
        if ( !isset($this->data[$id]) ) return false;

        $hal = new Hal('/articles/' . $id, $this->data[$id]);
        return $hal;
    }

    public function get()
    {
        $hal = new Hal('/articles');
        $hal->addLink('search', '/articles/{order_id}');

        foreach($this->data as $id => $data) {
            $hal->addResource('article', $this->getOne($id));
        }
        
        return $hal;
    }

    public function post($id, $data)
    {
        if ( !$this->getOne($id) ) return;
        $this->data[$id] = array_merge($this->data[$id], $data);
        return true;
    }

    public function put($data)
    {
        if ( !isset($data['title']) || !isset($data['author']) ) return false;

        $this->data[] = $data;
        return count($this->data);
    }

    public function delete($id)
    {
        if ( !$this->getOne($id) ) return;
        return true;
    }
}