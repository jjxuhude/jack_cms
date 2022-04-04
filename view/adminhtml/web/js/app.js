var app = new Vue({
    el: '#app',
    data: window.parent.variable,
    methods:{
        switchMedia:function($event,$type){

            if($type=="h5"){
                $(".phone").show();
                this.mediaType="h5";
                this.showWindow="100%";
                $('ul.cms-content').css('width',this.cmsContentWidth);
                $(".edit-wrap").show();
            }
            if($type=="pc"){
                this.showWindow="100%";
                $(".phone").hide();
                $('ul.cms-content').css('width',"100%");
                $(".edit-wrap").hide();
                this.mediaType="pc";
            }
            let screenSize = $("ul.cms-content").width();
            this.screenSize=screenSize;
        },
        tabClick:function(tab, event){
            // console.log(tab.name);
            if(tab.name=='wechat'){
                $(".phone").show();
                $('ul.cms-content').css('width',this.cmsContentWidth);
            }
            this.mediaType=tab.name;
        },
        getData:function () {
            Base.getData();
        },
        showMenu:function() {
            this.tagWindowLeft=0;
            this.showWindow="100%";
        },



    },
    mounted: function () {
        this.$nextTick(function () {
            this.switchMedia(null,this.mediaType);
        })
        let self=this;
    }
});
Base.setVue(app);
Vue.filter('getImage', function ($path) {
    return app.ossDomain + '/cms' + $path;
})
Vue.filter('getBgImage', function ($path) {
    return {
        backgroundImage:'url('+$path+')'
    }
})
Vue.filter('getOssBgImage', function ($path) {
    return {
        backgroundImage:'url('+app.ossDomain + '/cms' +$path+')'
    }
})


$('span.submitFm').on('click',function (e){
    form = document.querySelector("form");
    var formData = new FormData(form);
    $.ajax({
        url: form.action,
        type: "POST",
        dataType:"json",
        data: formData,
        success:function (response){
            console.log(response);
            if(response.status== true){
                alert("保存成功");
                console.log(response);
            }else{
                alert("保存失败");
            }
        },
        processData: false,  // 不处理数据
        contentType: false   // 不设置内容类型
    });
});