<?php
/**
 * Created by PhpStorm.
 * User: Custom.Xu1
 * Date: 2022/2/16
 * Time: 15:51
 */

namespace Jack\Cms\Block\Adminhtml\Page\Edit\Renderer;


use Jack\Cms\Model\Cms;
use Magento\Framework\App\ObjectManager;
use Magento\Framework\View\Element\Template;
use Magento\Framework\App\Config;

class Iframe extends Template
{
    protected $_template = 'edit/renderer/iframe.phtml';

    protected $rmaShipping;

    protected $rmaComments;

    protected $rma;
    public $helper;
    public $customer;
    public $admin;
    public $auth;


    protected function _beforeToHtml()
    {
        $this->assign("page_id", $this->getRequest()->getParam("page_id"));
        $id=$this->getRequest()->getParam("page_id","false");
        $url = $this->getUrl('admin/custom_cms/iframe',['page_id'=>$id]);
        $this->assign('url',$url);
        return $this;
    }

    protected function getCms(){
        $id=$this->getRequest()->getParam("page_id");
        $data= ObjectManager::getInstance()->get(Cms::class)->load($id)->toArray();
        $data['content']=json_decode($data['content'],true);
        $data['content']['h5']=json_decode($data['content']['h5'],true);
        return $data;
    }

    public function getConfig()
    {
        $config = ObjectManager::getInstance()->get(Config::class);
        return $config;
    }


    public function setSetting($data)
    {
        $setting = [
            "display_all_type" => false,
            "disabled" => false,
        ];
        $config = [];
        foreach ($setting as $key => $value) {
            $config[$this->combo($key)] = $value;
        }

        $data = array_merge_recursive($data, ['setting' => $config]);
        $data = $this->doTypeValue($data);
        return $data;
    }

    public function elementStatus($data){
        $elements=[
            "icon_title",
            "image",
            "swiper",
            "hot_map"
        ];
        $data['elements']=$elements;
        return $data;

    }

    public function doTypeValue($arr)
    {
        array_walk_recursive($arr, function (&$value, $key) {
            if (is_numeric($value)) {
                $value = (int)$value;
            } elseif ($value == 'true') {
                $value = true;
            } elseif ($value == 'false') {
                $value = false;
            } elseif (is_null($value)) {
                $value = "";
            } else {
//                dump($value);
            }
        });
        return $arr;


    }

    public function getTagData()
    {
        $config = $this->getConfig()->getValue("Jack_Cms");
        $config['configuration']["group"] = array_values($config['configuration']["group"]);
        $list = [];

        foreach ($config['children'] as $group => $children) {
            foreach ($children as $tag) {
                $list[$group][] = $config['tags'][$tag];
            }
        }
        $config['group'] = $list;
        $config = $this->setSetting($config);
        $config= $this->elementStatus($config);
        $tagData = urlencode(json_encode($config));
        return $tagData;
    }

    function combo($str)
    {
        $arr = explode('_', $str);
        for ($i = 1; $i < count($arr); $i++) {
            $arr[$i] = ucfirst($arr[$i]);
        }
        $str = implode('', $arr);
        return $str;
    }





}