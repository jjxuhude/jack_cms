/**
 * Copyright © Magento, Inc. All rights reserved.
 * See COPYING.txt for license details.
 */

/**
 * @api
 */

define([
    'Magento_Ui/js/form/element/abstract',
], function (Abstract) {
    'use strict';

   var element=  Abstract.extend({
        defaults: {
            cols: 15,
            rows: 2,
            elementTmpl: 'Jack_Cms/form/element/jack',
            tracks: {
                users: true
            },
            testElems:["ui/test1","ui/test2"],
            template6:"Jack_Cms/test6"

        },
       initialize: function () {
           this._super();
           this.initUsers();
           console.log("jack:",this);
           return this;
       },
       getName:function(value){
            return "初始化的值：" + value ;
       },
       initUsers:function(){

       },
       users:[
           {"name":"user01111"},
           {"name":"user02222"},
           {"name":"user03333"},
           {"name":"user04444"},
           {"name":"user055555"}
       ],

       addUser:function (){
            console.log(1111);
            this.users.push({"name":"user"+(this.users.length + 1).toString()})
            this.value("徐华德")
            console.log(this.users);
       },
       removeUser:function(){
            console.log(2222);
            this.users.pop();
       },
       userRemoveIndex:function(index){
            this.users.splice(2,index);
            console.log(this,index);
       },



    });


    return element;
});