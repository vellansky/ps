"use strict";(self.webpackChunk=self.webpackChunk||[]).push([[160],{1160:(t,e,i)=>{i.r(e),i.d(e,{default:()=>E});var n=i(5548),r={class:"space-y-8"},l=(0,n._)("div",{class:"w-full"},[(0,n._)("h5",{class:"text-gray-500 uppercase"},"Настройки слайдера на главной")],-1),s=(0,n._)("div",{class:"text-sm"},[(0,n._)("button",{class:"bg-green-500 text-white rounded-full py-1 px-10"},"Добавить в слайдер")],-1),a=(0,n._)("h6",{class:"text-gray-500 uppercase text-sm"},"Элементы:",-1),u={class:"relative my-8 text-sm"};var d={class:"flex flex-nowrap items-center gap-x-2"},c={class:"text-xs uppercase text-gray-500"},o={class:"flex flex-col gap-4 my-5"},p=["src"],f={class:"flex flex-nowrap items-center gap-x-4"},b=(0,n._)("p",null,"Ссылка:",-1),g=["value"],m={class:"border rounded py-2 px-5 flex flex-nowrap justify-between"},h={class:"flex flex-nowrap gap-x-3 text-sm text-gray-800 space-x-5"},x=(0,n._)("div",null,[(0,n._)("button",{type:""},"Удалить")],-1);var y=i(3907);function S(t,e){var i=Object.keys(t);if(Object.getOwnPropertySymbols){var n=Object.getOwnPropertySymbols(t);e&&(n=n.filter((function(e){return Object.getOwnPropertyDescriptor(t,e).enumerable}))),i.push.apply(i,n)}return i}function w(t){for(var e=1;e<arguments.length;e++){var i=null!=arguments[e]?arguments[e]:{};e%2?S(Object(i),!0).forEach((function(e){v(t,e,i[e])})):Object.getOwnPropertyDescriptors?Object.defineProperties(t,Object.getOwnPropertyDescriptors(i)):S(Object(i)).forEach((function(e){Object.defineProperty(t,e,Object.getOwnPropertyDescriptor(i,e))}))}return t}function v(t,e,i){return e in t?Object.defineProperty(t,e,{value:i,enumerable:!0,configurable:!0,writable:!0}):t[e]=i,t}const O={props:["id","index","name","path","link","statusSlider"],emits:["update:statusSlider","update:link"],data:function(){return{buttonImgSliderText:null,imgSlider:null,edit:!1}},methods:w(w({},(0,y.nv)(["adminEditInfSlider","adminSliderEditStatus"])),{},{clickImgSlider:function(){document.getElementById("file").click()},updateSlider:function(){var t={inf:{id:this.id,name:this.name,path:this.path,link:this.link},file:this.imgSlider};this.adminEditInfSlider({data:t}),this.imgSlider=null,this.edit=!1,console.log(this.edit)},handleFileUpload:function(){this.imgSlider=this.$refs.file.files[0]},status:function(){return this.statusSlider?"Активен":"Не активен"},editStatus:function(t){var e={id:this.id,status:t};this.adminSliderEditStatus(e)},textEditStatus:function(){return this.statusSlider?"Выключить":"Включить"},statusText:function(){return this.statusSlider?"Этот элемент виден пользователям":"Этот элемент не виден пользователям"}}),updated:function(){this.edit=!0},computed:{buttonImgText:function(){return this.imgSlider?"Изменить изображение":"Выбрать изображение"}}};var k=i(3744);function _(t,e){var i=Object.keys(t);if(Object.getOwnPropertySymbols){var n=Object.getOwnPropertySymbols(t);e&&(n=n.filter((function(e){return Object.getOwnPropertyDescriptor(t,e).enumerable}))),i.push.apply(i,n)}return i}function j(t){for(var e=1;e<arguments.length;e++){var i=null!=arguments[e]?arguments[e]:{};e%2?_(Object(i),!0).forEach((function(e){P(t,e,i[e])})):Object.getOwnPropertyDescriptors?Object.defineProperties(t,Object.getOwnPropertyDescriptors(i)):_(Object(i)).forEach((function(e){Object.defineProperty(t,e,Object.getOwnPropertyDescriptor(i,e))}))}return t}function P(t,e,i){return e in t?Object.defineProperty(t,e,{value:i,enumerable:!0,configurable:!0,writable:!0}):t[e]=i,t}const D={components:{adminSettingsItemSlider:(0,k.Z)(O,[["render",function(t,e,i,r,l,s){return(0,n.wg)(),(0,n.iD)("div",{class:(0,n.C_)(["relative rounded bg-gray-50 mt-10 p-10 border",{"border-yellow-300":l.edit}])},[l.edit?((0,n.wg)(),(0,n.iD)("button",{key:0,onClick:e[0]||(e[0]=function(t){return s.updateSlider()}),class:"absolute top-5 right-5 bg-black text-white px-6 py-1 rounded-full"},"Сохранить")):(0,n.kq)("",!0),(0,n._)("div",d,[(0,n._)("div",{class:(0,n.C_)([{"bg-red-400":!i.statusSlider},"w-2 h-2 bg-green-400 rounded-full"])},null,2),(0,n._)("p",c,(0,n.zw)(s.statusText()),1)]),(0,n._)("div",o,[(0,n._)("div",null,[(0,n._)("img",{src:i.path,class:"w-40"},null,8,p),(0,n._)("input",{class:"hidden",type:"file",id:"file",ref:"file",onChange:e[1]||(e[1]=function(t){return s.handleFileUpload()})},null,544),(0,n._)("button",{onClick:e[2]||(e[2]=function(t){return s.clickImgSlider()}),class:(0,n.C_)([{"bg-white text-black":l.imgSlider,"bg-black text-white":!l.imgSlider},"my-3 border rounded py-1 px-3 text-xs"])},(0,n.zw)(s.buttonImgText),3)]),(0,n._)("div",f,[b,(0,n._)("input",{type:"text",value:i.link,onInput:e[3]||(e[3]=function(e){return t.$emit("update:link",e.target.value)}),class:"border-0 bg-white/0 border-b w-full text-gray-800 font-extralight"},null,40,g)])]),(0,n._)("div",m,[(0,n._)("div",h,[(0,n._)("button",{onClick:e[4]||(e[4]=function(t){return s.editStatus(i.statusSlider=!i.statusSlider)}),class:(0,n.C_)([{"bg-green-400":!i.statusSlider},"px-3 bg-black text-white rounded"])},(0,n.zw)(s.textEditStatus()),3)]),x])],2)}]])},mounted:function(){this.adminUpdateSlider},computed:j(j(j({},(0,y.nv)(["adminUpdateSlider"])),(0,y.Se)(["adminGetSlider"])),{},{sliders:function(){return this.adminGetSlider}})},E=(0,k.Z)(D,[["render",function(t,e,i,d,c,o){var p=(0,n.up)("adminSettingsItemSlider");return(0,n.wg)(),(0,n.iD)("div",r,[l,s,(0,n._)("div",null,[a,(0,n._)("div",u,[((0,n.wg)(!0),(0,n.iD)(n.HY,null,(0,n.Ko)(o.sliders,(function(t,e){return(0,n.wg)(),(0,n.j4)(p,{key:e,id:t.id,index:e,name:t.name,path:t.img.path,link:t.link,"onUpdate:link":function(e){return t.link=e},statusSlider:t.status},null,8,["id","index","name","path","link","onUpdate:link","statusSlider"])})),128))])])])}]])}}]);