(window["webpackJsonp"]=window["webpackJsonp"]||[]).push([["chunk-a617c074"],{"02f4":function(t,e,n){var i=n("4588"),r=n("be13");t.exports=function(t){return function(e,n){var a,l,o=String(r(e)),s=i(n),c=o.length;return s<0||s>=c?t?"":void 0:(a=o.charCodeAt(s),a<55296||a>56319||s+1===c||(l=o.charCodeAt(s+1))<56320||l>57343?t?o.charAt(s):a:t?o.slice(s,s+2):l-56320+(a-55296<<10)+65536)}}},"0390":function(t,e,n){"use strict";var i=n("02f4")(!0);t.exports=function(t,e,n){return e+(n?i(t,e).length:1)}},"0bfb":function(t,e,n){"use strict";var i=n("cb7c");t.exports=function(){var t=i(this),e="";return t.global&&(e+="g"),t.ignoreCase&&(e+="i"),t.multiline&&(e+="m"),t.unicode&&(e+="u"),t.sticky&&(e+="y"),e}},"214f":function(t,e,n){"use strict";n("b0c5");var i=n("2aba"),r=n("32e9"),a=n("79e5"),l=n("be13"),o=n("2b4c"),s=n("520a"),c=o("species"),u=!a((function(){var t=/./;return t.exec=function(){var t=[];return t.groups={a:"7"},t},"7"!=="".replace(t,"$<a>")})),f=function(){var t=/(?:)/,e=t.exec;t.exec=function(){return e.apply(this,arguments)};var n="ab".split(t);return 2===n.length&&"a"===n[0]&&"b"===n[1]}();t.exports=function(t,e,n){var d=o(t),p=!a((function(){var e={};return e[d]=function(){return 7},7!=""[t](e)})),h=p?!a((function(){var e=!1,n=/a/;return n.exec=function(){return e=!0,null},"split"===t&&(n.constructor={},n.constructor[c]=function(){return n}),n[d](""),!e})):void 0;if(!p||!h||"replace"===t&&!u||"split"===t&&!f){var v=/./[d],m=n(l,d,""[t],(function(t,e,n,i,r){return e.exec===s?p&&!r?{done:!0,value:v.call(e,n,i)}:{done:!0,value:t.call(n,e,i)}:{done:!1}})),g=m[0],b=m[1];i(String.prototype,t,g),r(RegExp.prototype,d,2==e?function(t,e){return b.call(t,this,e)}:function(t){return b.call(t,this)})}}},"386b":function(t,e,n){var i=n("5ca1"),r=n("79e5"),a=n("be13"),l=/"/g,o=function(t,e,n,i){var r=String(a(t)),o="<"+e;return""!==n&&(o+=" "+n+'="'+String(i).replace(l,"&quot;")+'"'),o+">"+r+"</"+e+">"};t.exports=function(t,e){var n={};n[t]=e(o),i(i.P+i.F*r((function(){var e=""[t]('"');return e!==e.toLowerCase()||e.split('"').length>3})),"String",n)}},4917:function(t,e,n){"use strict";var i=n("cb7c"),r=n("9def"),a=n("0390"),l=n("5f1b");n("214f")("match",1,(function(t,e,n,o){return[function(n){var i=t(this),r=void 0==n?void 0:n[e];return void 0!==r?r.call(n,i):new RegExp(n)[e](String(i))},function(t){var e=o(n,t,this);if(e.done)return e.value;var s=i(t),c=String(this);if(!s.global)return l(s,c);var u=s.unicode;s.lastIndex=0;var f,d=[],p=0;while(null!==(f=l(s,c))){var h=String(f[0]);d[p]=h,""===h&&(s.lastIndex=a(c,r(s.lastIndex),u)),p++}return 0===p?null:d}]}))},"520a":function(t,e,n){"use strict";var i=n("0bfb"),r=RegExp.prototype.exec,a=String.prototype.replace,l=r,o="lastIndex",s=function(){var t=/a/,e=/b*/g;return r.call(t,"a"),r.call(e,"a"),0!==t[o]||0!==e[o]}(),c=void 0!==/()??/.exec("")[1],u=s||c;u&&(l=function(t){var e,n,l,u,f=this;return c&&(n=new RegExp("^"+f.source+"$(?!\\s)",i.call(f))),s&&(e=f[o]),l=r.call(f,t),s&&l&&(f[o]=f.global?l.index+l[0].length:e),c&&l&&l.length>1&&a.call(l[0],n,(function(){for(u=1;u<arguments.length-2;u++)void 0===arguments[u]&&(l[u]=void 0)})),l}),t.exports=l},"5f1b":function(t,e,n){"use strict";var i=n("23c6"),r=RegExp.prototype.exec;t.exports=function(t,e){var n=t.exec;if("function"===typeof n){var a=n.call(t,e);if("object"!==typeof a)throw new TypeError("RegExp exec method returned something other than an Object or null");return a}if("RegExp"!==i(t))throw new TypeError("RegExp#exec called on incompatible receiver");return r.call(t,e)}},7273:function(t,e,n){"use strict";n.d(e,"b",(function(){return r})),n.d(e,"c",(function(){return a})),n.d(e,"e",(function(){return l})),n.d(e,"a",(function(){return o})),n.d(e,"d",(function(){return s}));var i=n("b775");function r(t){return Object(i["a"])({url:"/class/list?type="+t,method:"get"})}function a(t,e){return Object(i["a"])({url:"/class/insert?type="+t,method:"post",data:e})}function l(t,e){return Object(i["a"])({url:"/class/update?type="+t,method:"post",data:e})}function o(t,e){return Object(i["a"])({url:"/class/delete?type="+t,method:"post",data:e})}function s(t,e){return Object(i["a"])({url:"/class/file/remove?type="+t,method:"post",data:e})}},b0c5:function(t,e,n){"use strict";var i=n("520a");n("5ca1")({target:"RegExp",proto:!0,forced:i!==/./.exec},{exec:i})},b54a:function(t,e,n){"use strict";n("386b")("link",(function(t){return function(e){return t(this,"a","href",e)}}))},ead3:function(t,e,n){"use strict";n.r(e);var i=function(){var t=this,e=t.$createElement,n=t._self._c||e;return n("div",{staticClass:"app-container"},[n("el-row",{attrs:{gutter:20}},[n("el-col",[n("el-button",{attrs:{type:"info"},on:{click:t.Add}},[t._v("新增專題競賽")])],1),t._v(" "),n("el-col",[n("el-form",{staticClass:"demo-form-inline",attrs:{inline:!0}},[n("el-form-item",{attrs:{label:"標題"}},[n("el-input",{attrs:{placeholder:"標題"},model:{value:t.searchMap.title,callback:function(e){t.$set(t.searchMap,"title",e)},expression:"searchMap.title"}})],1),t._v(" "),n("el-form-item",{attrs:{label:"從"}},[n("el-date-picker",{attrs:{type:"date",placeholder:"請選擇日期"},model:{value:t.searchMap.date_start,callback:function(e){t.$set(t.searchMap,"date_start",e)},expression:"searchMap.date_start"}})],1),t._v(" "),n("el-form-item",{attrs:{label:"到"}},[n("el-date-picker",{attrs:{type:"date",placeholder:"請選擇日期"},model:{value:t.searchMap.date_end,callback:function(e){t.$set(t.searchMap,"date_end",e)},expression:"searchMap.date_end"}})],1),t._v(" "),n("el-form-item",[n("el-button",{attrs:{type:"primary",icon:"el-icon-search"},on:{click:t.Search}},[t._v("查詢")])],1)],1)],1)],1),t._v(" "),n("el-table",{directives:[{name:"loading",rawName:"v-loading",value:t.listLoading,expression:"listLoading"}],attrs:{data:t.list.slice((t.currpage-1)*t.pagesize,t.currpage*t.pagesize),"element-loading-text":"Loading",border:"",fit:"","highlight-current-row":""}},[n("el-table-column",{attrs:{align:"center",label:"#",width:"50"},scopedSlots:t._u([{key:"default",fn:function(e){return[t._v("\n        "+t._s(e.$index+(t.currpage-1)*t.pagesize+1)+"\n      ")]}}])}),t._v(" "),n("el-table-column",{attrs:{align:"center",prop:"title",label:"標題"}}),t._v(" "),n("el-table-column",{attrs:{prop:"link",label:"連結",align:"center"}}),t._v(" "),n("el-table-column",{attrs:{"class-name":"status-col",label:"狀態",width:"110",align:"center"},scopedSlots:t._u([{key:"default",fn:function(e){return[n("el-tag",{attrs:{type:t._f("statusFilter")(e.row.status)}},[t._v(t._s(e.row.status))])]}}])}),t._v(" "),n("el-table-column",{attrs:{align:"center",prop:"published_at",label:"日期",width:"200"},scopedSlots:t._u([{key:"default",fn:function(e){return[n("i",{staticClass:"el-icon-time"}),t._v(" "),n("span",[t._v(t._s(e.row.published_at))])]}}])}),t._v(" "),n("el-table-column",{attrs:{align:"center",label:"操作",width:"115"},scopedSlots:t._u([{key:"default",fn:function(e){return[n("el-button",{attrs:{type:"info",icon:"el-icon-edit",circle:""},on:{click:function(n){return t.Edit(e.row.id)}}}),t._v(" "),n("el-button",{attrs:{type:"danger",icon:"el-icon-delete",circle:""},on:{click:function(n){return t.Delete(e.row.id)}}})]}}])})],1),t._v(" "),n("el-pagination",{attrs:{background:"",layout:"prev, pager, next, sizes, total, jumper",align:"center","page-sizes":[5,10,15,20],"page-size":t.pagesize,total:t.list.length},on:{"current-change":t.handleCurrentChange,"size-change":t.handleSizeChange}}),t._v(" "),n("el-dialog",{attrs:{title:"專題競賽管理",visible:t.dialogFormVisible},on:{"update:visible":function(e){t.dialogFormVisible=e}}},[n("el-form",{attrs:{model:t.form}},[n("el-form-item",{attrs:{label:"標題"}},[n("el-input",{attrs:{autocomplete:"off",placeholder:"標題"},model:{value:t.form.title,callback:function(e){t.$set(t.form,"title",e)},expression:"form.title"}})],1),t._v(" "),n("el-form-item",{attrs:{label:"連結"}},[n("el-input",{attrs:{autocomplete:"off",disabled:1===t.fileList.length,placeholder:"連結"},model:{value:t.form.link,callback:function(e){t.$set(t.form,"link",e)},expression:"form.link"}}),t._v(" "),n("el-upload",{staticClass:"upload-demo",attrs:{action:"/a/api/class/file/upload?type=topic",name:"upload","on-success":t.handleSuccess,"on-remove":t.handleRemove,"before-remove":t.beforeRemove,limit:1,"file-list":t.fileList}},[n("el-button",{attrs:{slot:"trigger",size:"small",type:"primary"},slot:"trigger"},[t._v("選取文件")])],1)],1),t._v(" "),n("el-form-item",{attrs:{label:"狀態"}},[n("el-select",{attrs:{placeholder:"狀態"},model:{value:t.form.status,callback:function(e){t.$set(t.form,"status",e)},expression:"form.status"}},[n("el-option",{attrs:{label:"發布",value:"published"}}),t._v(" "),n("el-option",{attrs:{label:"草稿",value:"draft"}})],1)],1)],1),t._v(" "),n("div",{staticClass:"dialog-footer",attrs:{slot:"footer"},slot:"footer"},[n("el-button",{on:{click:function(e){t.dialogFormVisible=!1}}},[t._v("\n        取 消\n      ")]),t._v(" "),n("el-button",{directives:[{name:"show",rawName:"v-show",value:"add"===t.mode,expression:"\n          mode === 'add'"}],attrs:{type:"info"},on:{click:t.Insert}},[t._v("\n        確 定\n      ")]),t._v(" "),n("el-button",{directives:[{name:"show",rawName:"v-show",value:"edit"===t.mode,expression:" mode === 'edit'"}],attrs:{type:"info"},on:{click:t.Update}},[t._v("\n        更新\n      ")])],1)],1)],1)},r=[],a=(n("7f7f"),n("b54a"),n("4917"),n("7273")),l={filters:{statusFilter:function(t){var e={published:"success",draft:"gray",deleted:"danger"};return e[t]}},data:function(){return{list:[],fullList:[],localFile:[],listLoading:!0,pagesize:10,currpage:1,searchMap:{date_start:null,date_end:null,title:null},form:{id:"",title:"",link:"",status:"published"},dialogFormVisible:!1,mode:"add",fileList:[],news_type:"topic"}},created:function(){this.fetchData()},methods:{fetchData:function(){var t=this,e=arguments.length>0&&void 0!==arguments[0]?arguments[0]:this.news_type;this.listLoading=!0,Object(a["b"])(e).then((function(e){t.list=e.data.items,t.fullList=e.data.items,t.localFile=e.data.file,t.listLoading=!1}))},handleCurrentChange:function(t){this.currpage=t},handleSizeChange:function(t){this.pagesize=t},Search:function(){var t=this;this.listLoading=!0,null!==this.searchMap.title?this.list=this.fullList.filter((function(e){return e.title.match(t.searchMap.title)})):this.list=this.fullList,null!==this.searchMap.date_start&&(this.list=this.list.filter((function(e){return new Date(Date.parse(e.published_at))>=new Date(Date.parse(t.searchMap.date_start))}))),null!==this.searchMap.date_end&&(this.list=this.list.filter((function(e){return new Date(Date.parse(e.published_at))<=new Date(Date.parse(t.searchMap.date_end))}))),this.listLoading=!1},handleSuccess:function(t,e,n){this.form.link=t.data.path,this.fileList=n},handleRemove:function(t,e){var n=this;Object(a["d"])(this.news_type,this.form).then((function(t){if(!0===t.flag){if("edit"===n.mode)for(var e=n.localFile.length,i=0;i<e;i++)n.localFile[i].path===n.form.link&&n.localFile.splice(i,1);n.form.link="",n.fileList=[]}}))},beforeRemove:function(t,e){return this.$confirm("do you really want to delete ".concat(t.name,"？"))},Switch:function(){this.dialogFormVisible?this.dialogFormVisible=!1:this.dialogFormVisible=!0},Clear:function(){this.form={id:"",title:"",link:"",status:"published"},this.fileList=[]},Add:function(){"edit"===this.mode&&(this.mode="add",this.Clear()),this.Switch()},Edit:function(t){"add"===this.mode&&(this.mode="edit"),this.Clear(),this.Switch(),this.form=this.list.filter((function(e){return e.id===t}))[0];var e=this.localFile.filter((function(e){return e.foreign_id===t}))[0];e&&this.fileList.push(e)},Insert:function(){var t=this;this.Switch(),Object(a["c"])(this.news_type,this.form).then((function(e){!0===e.flag?(t.resSuccess("新增成功"),t.Clear(),t.fetchData()):t.resError("新增失敗")}))},Update:function(){var t=this;this.Switch(),Object(a["e"])(this.news_type,this.form).then((function(e){!0===e.flag?(t.resSuccess("更新成功"),t.Clear(),t.fetchData()):t.resError("更新失敗")}))},Delete:function(t){var e=this;this.$confirm("確定要刪除嗎？").then((function(){e.form=e.list.filter((function(e){return e.id===t}))[0],Object(a["a"])(e.news_type,e.form).then((function(t){!0===t.flag?(e.resSuccess("刪除成功"),e.Clear(),e.fetchData()):e.resError("刪除失敗")}))})).catch((function(){}))},resSuccess:function(t){var e=arguments.length>1&&void 0!==arguments[1]?arguments[1]:"";this.$notify({title:t,message:e,type:"success",duration:1500})},resError:function(t,e){this.$notify({title:t,message:e,type:"error",duration:1500})}}},o=l,s=n("2877"),c=Object(s["a"])(o,i,r,!1,null,null,null);e["default"]=c.exports}}]);