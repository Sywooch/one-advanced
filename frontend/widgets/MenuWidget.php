<?php
namespace frontend\widgets;

use common\models\Menu;
use Yii;


class MenuWidget extends \yii\bootstrap\Widget
{
    public $position;


    public function init()
    {
        parent::init();
    }

    public function run()
    {
        if(!empty($this->position)) {
            $where = ['position' => $this->position, 'status' => 'on'];
        } else {
            $where = '';
        }
        $data = Menu::find()->where($where)->orderBy('sort')->asArray()->all();

        $menuView = 'menu-header-bottom';
        if ($this->position=='headerTop') {
            $menuView = 'menu-header-top';
        } else if ($this->position=='headerBottom') {
            $menuView = 'menu-header-bottom';
        }

        $itemsData = $this->getItems($data);
        $items = $this->getSubItems($itemsData);

        return $this->render($menuView,['items' => $items]);
    }

    private function getItems($items) {
        $result = [];
        foreach ($items as $item) {
            $result[$item['id']] = [
                'id'=>$item['id'],
                'parent_id'=>$item['parent_id'],
                'label'=>$item['name'],
                'url'=>$item['url'],
                'active'=>((Yii::$app->request->url==$item['url'])?true:false)
            ];
        }
        return $result;
    }

    private function getSubItems($items) {
        $result = [];
        foreach ($items as $key => &$value) {
            if (!$value['parent_id']){
                $result[$key] = &$value;
            } else {
                $items[$value['parent_id']]['items'][$key] = &$value;
            }
        }
        return $result;
    }
}
