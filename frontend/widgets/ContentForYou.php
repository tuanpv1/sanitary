<?php
/**
 * Created by PhpStorm.
 * User: TuanPham
 * Date: 11/19/2016
 * Time: 9:09 PM
 */
namespace frontend\widgets;

use common\models\Category;
use common\models\Content;
use DateTime;
use yii\base\Widget;
use Yii;

class ContentForYou extends Widget{

    public $message;

    public  function init()
    {
        parent::init(); // TODO: Change the autogenerated stub
    }

    public  function run()
    {

    }

    public function getContentForYou($id){
        $content = Content::find()
            ->select('content.id,display_name,price,price_promotion,images')
            ->innerJoin('content_category_asm','content_category_asm.content_id = content.id')
            ->andWhere(['content_category_asm.category_id'=>$id])
            ->andWhere(['content.status'=>Content::STATUS_ACTIVE])
            ->andWhere(['content.type'=>Content::TYPE_FORYOU])
            ->orderBy(['content.updated_at' => SORT_ASC])
            ->limit(4)
            ->all();
        return $this->render('content-for-you',[
            'content'=>$content,
        ]);
    }
}
