<?php
/**
 * Created by PhpStorm.
 * User: Custom.Xu1
 * Date: 2021/12/8
 * Time: 16:38
 */
namespace Jack\Cms\Helper;

use Magento\Sales\Model\Order;
use Connext\Rma\Model\Rma;

class Data extends \Magento\Framework\App\Helper\AbstractHelper
{

    public function __construct (
            \Magento\Framework\App\Helper\Context $context
    )
    {
        parent::__construct($context);
    }

    //$flat默认取key
    /**
     * 
     * @param unknown $key
     * @param string $flag 默认取key,true取value
     * @return array|unknown|mixed
     */
    function getConfig($key = null, $flag = false)
    {
        if ($key) {
            $value = $this->scopeConfig->getValue('Jack_Cms/variable')[$key];
            $selectArr=explode(',',$value);
    
            $dataConfig=$this->getDataConfig($key);
           
            if(!is_array($dataConfig)){
                $dataConfig= $this->getDataConfig($key,true);
            }
            if(is_array($dataConfig)){
                if(count($selectArr)==1){
                    $selectArr=[$value=>$value];
                    if($flag){
                       return array_intersect($dataConfig, $selectArr);
                    }else{
                        return array_intersect_key($dataConfig, $selectArr);
                    };
                   
                }else{
                    return array_intersect_key($dataConfig, array_flip($selectArr));
                }
            }else{
                return $value;
            }               
        }
        return $this->scopeConfig->getValue('Jack_Cms/variable');
    }


    function parseOptions($string)
    {
      
 
        if(preg_match_all('|(\d+)\:([^,\/]+)|', $string, $match, 1)){
            return array_combine($match[1], $match[2]);
        }else{
            return explode(',',$string);
        }
        
      
    }

    public function  hump($array){
        if(is_array($array)){
            $string=$this->toHump(json_encode($array));
            $array=json_decode($string,true);
        }
        return $array;
    }
    
    private function  toHump($key){
        $key=preg_replace_callback('/(_)([a-z])/', function ($match){
            return strtoupper($match[2]);
        }, $key);
            return $key;
    }

    public function getPageConfig(){
        return [
            ["name"=>"首页","pageKey"=>"home","route"=>"/pages/default/home/home","param"=>""],
            ["name"=>"商品页面","pageKey"=>"product","route"=>"/pages/pdt/pdt-detail/pdt-detail","param"=>""],
            ["name"=>"分类页面","pageKey"=>"category","route"=>"/pages/pdt/pdt-list/pdt-list","param"=>""],
            ["name"=>"活动页面","pageKey"=>"cms","route"=>"/pages/default/landing/landing","param"=>""],
            ["name"=>"付邮试用","pageKey"=>"trial_by_post","route"=>"/pages/default/trial/post","param"=>""],
        ];
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

    public function variable($model,$tagData){
        $var = $this->getConfig();
        $var['apiDomain']=$this->_getUrl('/');
        $var['queryString']=$this->_getRequest()->getParams();
        $var['config']=$this->getPageConfig();
        $var['pageData']=[];
        $var['id']=$model["page_id"];
        $var["title"]=$model["title"];
        $var['identifier']=$model['identifier'];
        $var['tagData']=$tagData;
        $var['ajax']=[];
        $var['nodes']=[
            "h5"=>$model['content']["h5"],
            "pc"=>"",
            "wechat"=>"",
        ];
        $var["menuVisible"]=false;
        $var["cmsContentWidth"]="377px";
        $var["editWindow"]="0";
        $var["tagWindowLeft"]="-15%";
        $var["tagWindow"]="15%";
        $var["screenSize"]="375";

        $var= $this->doTypeValue($var);
        return json_encode($var);
    }







    
    
    
    

}

