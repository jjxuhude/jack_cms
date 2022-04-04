/**
 * Copyright © Magento, Inc. All rights reserved.
 * See COPYING.txt for license details.
 */

/**
 * @api
 */

define([
    'underscore',
    'uiLayout',
    'mageUtils',
    'Magento_Ui/js/form/components/group',
    'mage/translate',
    'Magento_Ui/js/form/element/abstract',
    'Magento_Ui/js/modal/alert',
    'Magento_Ui/js/modal/confirm',
    'Magento_Ui/js/modal/modal',
    'jquery',
    'uiRegistry',
    'uiCollection'
], function (_, layout, utils, Group, $t, Abstract, Alert, Confirm, Modal, $, Registry,UiCollection) {
    'use strict';

    var jjxuhuade = UiCollection.extend({
        defaults: {
            labelVisible: true,
            template: 'Jack_Cms/form/element/jjxuhuade',
            isRange: true,

            templates: {
                base: {
                    parent: '${ $.$data.group.name }',
                    provider: '${ $.$data.group.provider }',
                    template: 'ui/grid/filters/field'
                },
                date: {
                    component: 'Magento_Ui/js/form/element/date',
                    dateFormat: 'YYYY-MM-dd',
                    shiftedValue: 'filter'
                },
                datetime: {
                    component: 'Magento_Ui/js/form/element/date',
                    dateFormat: 'YYYY-MM-dd',
                    outputDateFormat: 'YYYY-MM-dd',
                    inputDateFormat: 'YYYY-MM-dd',
                    pickerDefaultDateFormat: 'y-MM-dd', // ICU Date Format
                    pickerDefaultTimeFormat: 'H:mm:ss', // ICU Time Format

                    shiftedValue: '2020-11-11 12:01:02',
                    options: {
                        showsTime: true,
                        timeOnly: false,

                    }
                },
                text: {
                    component: 'Magento_Ui/js/form/element/abstract'
                },
                ranges: {
                    // from: {
                    //     label: "开始",
                    //     dataScope: "start",
                    //
                    // },
                    // to: {
                    //     label: "结束",
                    //     dataScope: 'to',
                    //
                    // },
                },
                children: {
                    button: {
                        parent: '${ $.$data.group.name }',
                        provider: '${ $.$data.group.provider }',//数据提供者 $.$data:跟元素，group:extend函数合并加的名称，provider：就是cms_page_form1.xml中的provider
                        config: {
                            component: "Magento_Ui/js/form/components/button",
                            formElement: "container",
                            componentType: "container",
                            actions: [
                                {
                                    targetName: "${ $.$data.group.name }.js_modal.product_list",
                                    actionName: "destroyInserted"
                                },
                                {
                                    targetName: "${ $.$data.group.name }.js_modal",
                                    actionName: "toggleModal"
                                },
                                {
                                    targetName: "${ $.$data.group.name }.js_modal.product_list",
                                    actionName: "render"
                                }
                            ],
                            title: "Add Related Products6",
                        }
                    },
                    js_modal: {
                        parent: '${ $.$data.group.name }',
                        provider: '${ $.$data.group.provider }',//数据提供者 $.$data:跟元素，group:extend函数合并加的名称，provider：就是cms_page_form1.xml中的provider
                        dataScope:"",
                        config: {
                            component: "Magento_Ui/js/modal/modal-component",
                            formElement: "container",
                            componentType: "modal",
                            behaviourType: "simple",
                            options: {
                                type: "slide",
                                title: "请选择商品",
                                buttons: [
                                    {
                                        text: "Cancel",
                                        actions: [
                                            "closeModal"
                                        ]
                                    },
                                    {
                                        text: "添加所选的产品",
                                        class: "action-primary",
                                        actions: [
                                            {
                                                "targetName": "index = product_list",
                                                "actionName": "save"
                                            },
                                            "closeModal"
                                        ]
                                    }
                                ]
                            },
                        },
                        children: {
                            product_list: {  //下标就是注册组件的index：product_list
                                type: "container",
                                provider: '${ $.$data.group.provider }',//数据提供者 $.$data:跟元素，group:extend函数合并加的名称，provider：就是cms_page_form1.xml中的provider
                                dataScope:"product_selected_collection",
                                config: {
                                    ns: "related_product_listing",
                                    component: "Magento_Ui/js/form/components/insert-listing",
                                    componentType: "insertListing",
                                    externalProvider: "related_product_listing.related_product_listing_data_source",
                                    selectionsProvider: "related_product_listing.related_product_listing.product_columns.ids",
                                    externalFilterMode: true,
                                    behaviourType: "simple",
                                    render_url: "http://m2.org/admin/mui/index/render/handle/insert_listing_example/buttons/1/key/123",
                                    update_url: "http://m2.org/admin/mui/index/render/key/123",
                                    toolbarContainer: "${ $.$data.group.parentName }",
                                    autoRender: false,
                                    realTimeLink: false,
                                    dataLinks: {
                                        imports: false,
                                        exports: true,
                                    },
                                    formSubmitType: "ajax",
                                    loading: false,
                                }
                            }
                        },product_list
                    },
                    selected_products: {
                        parent: '${ $.$data.group.name }',  //name：就是根元素的名称:cms_page_form1.cms_page_form1.general.update_time
                        provider: '${ $.$data.group.provider }',//数据提供者 $.$data:跟元素，group:extend函数合并加的名称，provider：就是cms_page_form1.xml中的provider
                        dataScope: "selected_ids",
                        type: "container",
                        children: {
                            record: {
                                type: "container",
                                name: "record",
                                children: {
                                    entity_id: {
                                        type: "form.input",
                                        name: "entity_id",
                                        dataScope: "entity_id",
                                        config: {
                                            component: "Magento_Ui/js/form/element/text",
                                            template: "ui/form/field",
                                            componentType: "field",
                                            formElement: "input",
                                            elementTmpl: "ui/dynamic-rows/cells/text",
                                            dataType: "text",
                                            fit: false,
                                            label: "entity_id",
                                            sortOrder: 0
                                        }
                                    },
                                    thumbnail: {
                                        type: "form.input",
                                        name: "thumbnail",
                                        dataScope: "thumbnail",
                                        config: {
                                            component: "Magento_Ui/js/form/element/abstract",
                                            template: "ui/form/field",
                                            componentType: "field",
                                            formElement: "input",
                                            elementTmpl: "ui/dynamic-rows/cells/thumbnail",
                                            dataType: "text",
                                            fit: true,
                                            label: "缩略图",
                                            sortOrder: 10
                                        }
                                    },
                                    name: {
                                        type: "form.input",
                                        name: "name",
                                        dataScope: "name",
                                        config: {
                                            component: "Magento_Ui/js/form/element/text",
                                            template: "ui/form/field",
                                            componentType: "field",
                                            formElement: "input",
                                            elementTmpl: "ui/dynamic-rows/cells/text",
                                            dataType: "text",
                                            fit: false,
                                            label: "名字",
                                            sortOrder: 20
                                        }
                                    },
                                    status: {
                                        type: "form.input",
                                        name: "status",
                                        dataScope: "status",
                                        config: {
                                            component: "Magento_Ui/js/form/element/text",
                                            template: "ui/form/field",
                                            componentType: "field",
                                            formElement: "input",
                                            elementTmpl: "ui/dynamic-rows/cells/text",
                                            dataType: "text",
                                            fit: true,
                                            label: "状态",
                                            sortOrder: 30
                                        }
                                    },
                                    attribute_set: {
                                        type: "form.input",
                                        name: "attribute_set",
                                        dataScope: "attribute_set",
                                        config: {
                                            component: "Magento_Ui/js/form/element/text",
                                            template: "ui/form/field",
                                            componentType: "field",
                                            formElement: "input",
                                            elementTmpl: "ui/dynamic-rows/cells/text",
                                            dataType: "text",
                                            fit: false,
                                            label: "属性集",
                                            sortOrder: 40
                                        }
                                    },
                                    sku: {
                                        type: "form.input",
                                        name: "sku",
                                        dataScope: "sku",
                                        config: {
                                            component: "Magento_Ui/js/form/element/text",
                                            template: "ui/form/field",
                                            componentType: "field",
                                            formElement: "input",
                                            elementTmpl: "ui/dynamic-rows/cells/text",
                                            dataType: "text",
                                            fit: true,
                                            label: "SKU",
                                            sortOrder: 50
                                        }
                                    },
                                    price: {
                                        type: "form.input",
                                        name: "price",
                                        dataScope: "price",
                                        config: {
                                            component: "Magento_Ui/js/form/element/text",
                                            template: "ui/form/field",
                                            componentType: "field",
                                            formElement: "input",
                                            elementTmpl: "ui/dynamic-rows/cells/text",
                                            dataType: "text",
                                            fit: true,
                                            label: "价格",
                                            sortOrder: 60
                                        }
                                    },
                                    actionDelete: {
                                        type: "actionDelete",
                                        name: "actionDelete",
                                        config: {
                                            component: "Magento_Ui/js/dynamic-rows/action-delete",
                                            template: "ui/dynamic-rows/cells/action-delete",
                                            additionalClasses: "data-grid-actions-cell",
                                            componentType: "actionDelete",
                                            dataType: "text",
                                            label: "操作",
                                            sortOrder: 70,
                                            fit: true
                                        }
                                    },
                                    position: {
                                        type: "form.input",
                                        name: "position",
                                        dataScope: "position",
                                        config: {
                                            component: "Magento_Ui/js/form/element/abstract",
                                            template: "ui/form/field",
                                            dataType: "number",
                                            formElement: "input",
                                            componentType: "field",
                                            sortOrder: 80,
                                            visible: false
                                        }
                                    }
                                },
                                dataScope: "",
                                config: {
                                    component: "Magento_Ui/js/dynamic-rows/record",
                                    componentType: "container",
                                    isTemplate: true,
                                    is_collection: true
                                }
                            }
                        },
                        config: {
                            dataProvider:"selected_ids",
                            identificationProperty:"entity_id",
                            identificationDRProperty:"entity_id",
                            component: "Magento_Ui/js/dynamic-rows/dynamic-rows-grid",
                            template: "ui/dynamic-rows/templates/grid",
                            additionalClasses: "admin__field-wide",
                            componentType: "dynamicRows",
                            label: "关联商品",
                            columnsHeader: false,
                            columnsHeaderAfterRender: true,
                            renderDefaultRecord: false,
                            addButton: false,
                            recordTemplate: "record",
                            deleteButtonLabel: "删除",
                            showSpinner: false,
                            map: {
                                entity_id: "entity_id",
                                name: "name",
                                status: "status_text",
                                attribute_se: "attribute_set_text",
                                sku: "sku",
                                price: "price",
                                thumbnail: "thumbnail_src"
                            },
                            links: {
                                // "insertData": "${ $.provider }:${ $.dataProvider }",
                                insertData: "${ $.$data.group.provider }:selected_ids",//插入商品的id数组
                                recordData: "${ $.$data.group.provider }:data.modal.product_selected_collection", //选中的商品数据列表
                                __disableTmpl: {
                                    insertData: false
                                }
                            },
                        }
                    },
                    // "modal": {
                    //     parent: '${ $.$data.group.name }',
                    //     provider: null,
                    //     config: {
                    //         component: "Magento_Ui/js/modal/modal-component",
                    //         formElement: "container",
                    //         componentType: "modal",
                    //         behaviourType: "simple",
                    //         options: {
                    //             type: "slide",
                    //             title: "添加商品22",
                    //             buttons: [
                    //                 {
                    //                     text: "Cancel",
                    //                     actions: [
                    //                         "closeModal"
                    //                     ]
                    //                 },
                    //                 {
                    //                     text: "添加所选的产品",
                    //                     class: "action-primary",
                    //                     actions: [
                    //                         {
                    //                             "targetName": "index = related_product_listing",
                    //                             "actionName": "save"
                    //                         },
                    //                         "closeModal"
                    //                     ]
                    //                 }
                    //             ]
                    //         },
                    //     },
                    //     children: {
                    //         list: {
                    //             name: "title",
                    //             type: "form.input",
                    //             //dataScope:代表绑定数据的字段名称：如果是子节点后端数据应该体现完整的层级关系
                    //             dataScope: "title",
                    //             config: {
                    //                 //jack组件
                    //                 component: "Jack_Cms/js/form/element/jack",
                    //                 template: "ui/form/field",
                    //                 componentType: "field",
                    //                 formElement: "input",
                    //
                    //             }
                    //         }
                    //     }
                    // },

                },

            }
        },

        hasAddons: function () {
            return false;
        },
        hasService: function () {
            return false;
        },
        /**
         * Initializes range component.
         *
         * @returns {Range} Chainable.
         */
        initialize: function (config) {
            config.rangeType = "datetime";
            if (config.dateFormat) {
                this.constructor.defaults.templates.date.pickerDefaultDateFormat = config.dateFormat;
            }
            this._super();
            this.buildChildren();

            _.extend(this, {
                additionalClasses: {
                    // "admin__control-grouped": true,
                    //   "admin__control-fields": false,
                    required: true,
                },
                uid: utils.uniqueid(),
                error: ""
            });
            //this.observe({"update_at": this.source.data.update_time});
            return this;
        },


        /**
         * Creates configuration for the child components.
         *
         * @returns {Object}
         */
        buildChildren: function () {
            var templates = this.templates,
                typeTmpl = templates['datetime'],
                tmpl = utils.extend({}, templates.base, typeTmpl),
                children = {};

            _.each(templates.ranges, function (range, key) {
                children[key] = utils.extend({}, tmpl, range);
            });

            _.extend(children, this.templates.children)


            var nodes = utils.template(children, {
                group: this
            }, true, true);
            console.log("nodes:", nodes);
            layout(nodes);
            //console.log("registry.get:",Registry.get("index = general"));

            console.log("registry:", Registry.getItems());
        },

        /**
         * Clears childrens data.
         *
         * @returns {Range} Chainable.
         */
        clear: function () {
            this.elems.each('clear');

            return this;
        },

        /**
         * Checks if some children has data.
         *
         * @returns {Boolean}
         */
        hasData: function () {
            return this.elems.some('hasData');
            ``
        },
        alert: function () {
            Alert({"content": "1111111111"});
        },
        confirm: function () {
            Confirm({"content": "您真的要删除吗？"});
        },
        modal: function () {
            var modal = $('<div>Element</div>').modal({
                type: 'slide',
                modalClass: 'adobe-stock-modal',
                "title": "选择销售产品",
                "buttons": [
                    {
                        "text": "Cancel",
                        "actions": [
                            "closeModal"
                        ]
                    },
                    {
                        "text": "添加所选的产品",
                        "class": "action-primary",
                        "actions": [
                            {
                                "targetName": "",
                                "actionName": "save"
                            },
                            "closeModal"
                        ]
                    }
                ]
            }).trigger('openModal');


        }


    });
    return jjxuhuade;

});