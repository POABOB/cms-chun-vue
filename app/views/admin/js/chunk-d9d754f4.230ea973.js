(window["webpackJsonp"]=window["webpackJsonp"]||[]).push([["chunk-d9d754f4"],{"02f4":function(e,t,r){var a=r("4588"),i=r("be13");e.exports=function(e){return function(t,r){var n,l,o=String(i(t)),s=a(r),c=o.length;return s<0||s>=c?e?"":void 0:(n=o.charCodeAt(s),n<55296||n>56319||s+1===c||(l=o.charCodeAt(s+1))<56320||l>57343?e?o.charAt(s):n:e?o.slice(s,s+2):l-56320+(n-55296<<10)+65536)}}},"0390":function(e,t,r){"use strict";var a=r("02f4")(!0);e.exports=function(e,t,r){return t+(r?a(e,t).length:1)}},"0bfb":function(e,t,r){"use strict";var a=r("cb7c");e.exports=function(){var e=a(this),t="";return e.global&&(t+="g"),e.ignoreCase&&(t+="i"),e.multiline&&(t+="m"),e.unicode&&(t+="u"),e.sticky&&(t+="y"),t}},"214f":function(e,t,r){"use strict";r("b0c5");var a=r("2aba"),i=r("32e9"),n=r("79e5"),l=r("be13"),o=r("2b4c"),s=r("520a"),c=o("species"),u=!n((function(){var e=/./;return e.exec=function(){var e=[];return e.groups={a:"7"},e},"7"!=="".replace(e,"$<a>")})),d=function(){var e=/(?:)/,t=e.exec;e.exec=function(){return t.apply(this,arguments)};var r="ab".split(e);return 2===r.length&&"a"===r[0]&&"b"===r[1]}();e.exports=function(e,t,r){var f=o(e),m=!n((function(){var t={};return t[f]=function(){return 7},7!=""[e](t)})),p=m?!n((function(){var t=!1,r=/a/;return r.exec=function(){return t=!0,null},"split"===e&&(r.constructor={},r.constructor[c]=function(){return r}),r[f](""),!t})):void 0;if(!m||!p||"replace"===e&&!u||"split"===e&&!d){var h=/./[f],g=r(l,f,""[e],(function(e,t,r,a,i){return t.exec===s?m&&!i?{done:!0,value:h.call(t,r,a)}:{done:!0,value:e.call(r,t,a)}:{done:!1}})),v=g[0],b=g[1];a(String.prototype,e,v),i(RegExp.prototype,f,2==t?function(e,t){return b.call(e,this,t)}:function(e){return b.call(e,this)})}}},4917:function(e,t,r){"use strict";var a=r("cb7c"),i=r("9def"),n=r("0390"),l=r("5f1b");r("214f")("match",1,(function(e,t,r,o){return[function(r){var a=e(this),i=void 0==r?void 0:r[t];return void 0!==i?i.call(r,a):new RegExp(r)[t](String(a))},function(e){var t=o(r,e,this);if(t.done)return t.value;var s=a(e),c=String(this);if(!s.global)return l(s,c);var u=s.unicode;s.lastIndex=0;var d,f=[],m=0;while(null!==(d=l(s,c))){var p=String(d[0]);f[m]=p,""===p&&(s.lastIndex=n(c,i(s.lastIndex),u)),m++}return 0===m?null:f}]}))},"520a":function(e,t,r){"use strict";var a=r("0bfb"),i=RegExp.prototype.exec,n=String.prototype.replace,l=i,o="lastIndex",s=function(){var e=/a/,t=/b*/g;return i.call(e,"a"),i.call(t,"a"),0!==e[o]||0!==t[o]}(),c=void 0!==/()??/.exec("")[1],u=s||c;u&&(l=function(e){var t,r,l,u,d=this;return c&&(r=new RegExp("^"+d.source+"$(?!\\s)",a.call(d))),s&&(t=d[o]),l=i.call(d,e),s&&l&&(d[o]=d.global?l.index+l[0].length:t),c&&l&&l.length>1&&n.call(l[0],r,(function(){for(u=1;u<arguments.length-2;u++)void 0===arguments[u]&&(l[u]=void 0)})),l}),e.exports=l},"5f1b":function(e,t,r){"use strict";var a=r("23c6"),i=RegExp.prototype.exec;e.exports=function(e,t){var r=e.exec;if("function"===typeof r){var n=r.call(e,t);if("object"!==typeof n)throw new TypeError("RegExp exec method returned something other than an Object or null");return n}if("RegExp"!==a(e))throw new TypeError("RegExp#exec called on incompatible receiver");return i.call(e,t)}},b0c5:function(e,t,r){"use strict";var a=r("520a");r("5ca1")({target:"RegExp",proto:!0,forced:a!==/./.exec},{exec:a})},f4e5:function(e,t,r){"use strict";r.r(t);var a=function(){var e=this,t=e.$createElement,r=e._self._c||t;return r("div",{staticClass:"app-container"},[r("el-row",{attrs:{gutter:20}},[r("el-col",[r("el-button",{attrs:{type:"info"},on:{click:e.Add}},[e._v("新增公司")])],1),e._v(" "),r("el-col",[r("el-form",{staticClass:"demo-form-inline",attrs:{inline:!0}},[r("el-form-item",{attrs:{label:"搜尋"}},[r("el-input",{attrs:{placeholder:"公司名稱 統編..."},model:{value:e.searchMap.word,callback:function(t){e.$set(e.searchMap,"word",t)},expression:"searchMap.word"}})],1),e._v(" "),r("el-form-item",[r("el-button",{attrs:{type:"primary",icon:"el-icon-search"},on:{click:e.Search}},[e._v("查詢")])],1)],1)],1)],1),e._v(" "),r("el-table",{directives:[{name:"loading",rawName:"v-loading",value:e.listLoading,expression:"listLoading"}],attrs:{data:e.list.slice((e.currpage-1)*e.pagesize,e.currpage*e.pagesize),"element-loading-text":"Loading",border:"",fit:"","highlight-current-row":""}},[r("el-table-column",{attrs:{align:"center",label:"#",width:"50"},scopedSlots:e._u([{key:"default",fn:function(t){return[e._v("\n        "+e._s(t.$index+(e.currpage-1)*e.pagesize+1)+"\n      ")]}}])}),e._v(" "),r("el-table-column",{attrs:{align:"center",prop:"department",label:"公司"}}),e._v(" "),r("el-table-column",{attrs:{align:"center",prop:"tel",label:"電話"}}),e._v(" "),r("el-table-column",{attrs:{align:"center",prop:"tax",label:"傳真"}}),e._v(" "),r("el-table-column",{attrs:{align:"center",prop:"addr",label:"地址"}}),e._v(" "),r("el-table-column",{attrs:{align:"center",prop:"addr_map",label:"地址連結",width:"200"},scopedSlots:e._u([{key:"default",fn:function(t){return[r("el-link",{attrs:{type:"info",href:t.row.addr_map,target:"_blank"}},[e._v(e._s(t.row.addr_map))])]}}])}),e._v(" "),r("el-table-column",{attrs:{align:"center",prop:"email",label:"email"}}),e._v(" "),r("el-table-column",{attrs:{align:"center",prop:"tax_id",label:"統編"}}),e._v(" "),r("el-table-column",{attrs:{"class-name":"status-col",label:"狀態",width:"110",align:"center"},scopedSlots:e._u([{key:"default",fn:function(t){return[r("el-tag",{attrs:{type:e._f("statusFilter")(t.row.status)}},[e._v(e._s(t.row.status))])]}}])}),e._v(" "),r("el-table-column",{attrs:{align:"center",label:"操作",width:"115"},scopedSlots:e._u([{key:"default",fn:function(t){return[r("el-button",{attrs:{type:"info",icon:"el-icon-edit",circle:""},on:{click:function(r){return e.Edit(t.row.id)}}}),e._v(" "),r("el-button",{attrs:{type:"danger",icon:"el-icon-delete",circle:""},on:{click:function(r){return e.Delete(t.row.id)}}})]}}])})],1),e._v(" "),r("el-pagination",{attrs:{background:"",layout:"prev, pager, next, sizes, total, jumper",align:"center","page-sizes":[5,10,15,20],"page-size":e.pagesize,total:e.list.length},on:{"current-change":e.handleCurrentChange,"size-change":e.handleSizeChange}}),e._v(" "),r("el-dialog",{attrs:{title:"公司管理",visible:e.dialogFormVisible},on:{"update:visible":function(t){e.dialogFormVisible=t}}},[r("el-form",{ref:"form",attrs:{model:e.form,inline:!0,"label-position":"top",rules:e.rules}},[r("el-form-item",{attrs:{label:"公司",prop:"department"}},[r("el-input",{attrs:{autocomplete:"off",placeholder:"公司"},model:{value:e.form.department,callback:function(t){e.$set(e.form,"department",t)},expression:"form.department"}})],1),e._v(" "),r("el-form-item",{attrs:{label:"電話",prop:"tel"}},[r("el-input",{attrs:{autocomplete:"off",placeholder:"電話"},model:{value:e.form.tel,callback:function(t){e.$set(e.form,"tel",t)},expression:"form.tel"}})],1),e._v(" "),r("el-form-item",{attrs:{label:"傳真",prop:"tax"}},[r("el-input",{attrs:{autocomplete:"off",placeholder:"傳真"},model:{value:e.form.tax,callback:function(t){e.$set(e.form,"tax",t)},expression:"form.tax"}})],1),e._v(" "),r("el-form-item",{attrs:{label:"地址",prop:"addr"}},[r("el-input",{attrs:{autocomplete:"off",placeholder:"地址"},model:{value:e.form.addr,callback:function(t){e.$set(e.form,"addr",t)},expression:"form.addr"}})],1),e._v(" "),r("el-form-item",{attrs:{label:"地址連結",prop:"addr_map"}},[r("el-input",{attrs:{autocomplete:"off",placeholder:"地址連結"},model:{value:e.form.addr_map,callback:function(t){e.$set(e.form,"addr_map",t)},expression:"form.addr_map"}})],1),e._v(" "),r("el-form-item",{attrs:{label:"信箱",prop:"email"}},[r("el-input",{attrs:{autocomplete:"off",placeholder:"信箱"},model:{value:e.form.email,callback:function(t){e.$set(e.form,"email",t)},expression:"form.email"}})],1),e._v(" "),r("el-form-item",{attrs:{label:"統編",prop:"tax_id"}},[r("el-input",{attrs:{autocomplete:"off",placeholder:"統編"},model:{value:e.form.tax_id,callback:function(t){e.$set(e.form,"tax_id",t)},expression:"form.tax_id"}})],1),e._v(" "),r("el-form-item",{attrs:{label:"狀態"}},[r("el-select",{attrs:{placeholder:"狀態"},model:{value:e.form.status,callback:function(t){e.$set(e.form,"status",t)},expression:"form.status"}},[r("el-option",{attrs:{label:"發布",value:"published"}}),e._v(" "),r("el-option",{attrs:{label:"草稿",value:"draft"}})],1)],1)],1),e._v(" "),r("div",{staticClass:"dialog-footer",attrs:{slot:"footer"},slot:"footer"},[r("el-button",{on:{click:function(t){e.dialogFormVisible=!1}}},[e._v("\n        取 消\n      ")]),e._v(" "),r("el-button",{directives:[{name:"show",rawName:"v-show",value:"add"===e.mode,expression:"\n          mode === 'add'"}],attrs:{type:"info"},on:{click:e.Insert}},[e._v("\n        確 定\n      ")]),e._v(" "),r("el-button",{directives:[{name:"show",rawName:"v-show",value:"edit"===e.mode,expression:" mode === 'edit'"}],attrs:{type:"info"},on:{click:e.Update}},[e._v("\n        更新\n      ")])],1)],1)],1)},i=[],n=(r("4917"),r("b775"));function l(){return Object(n["a"])({url:"/admin/contactus/list",method:"get"})}function o(e){return Object(n["a"])({url:"/admin/contactus/add",method:"post",data:e})}function s(e){return Object(n["a"])({url:"/admin/contactus/update",method:"patch",data:e})}function c(e){return Object(n["a"])({url:"/admin/contactus/delete",method:"delete",data:e})}var u={filters:{statusFilter:function(e){var t={published:"success",draft:"gray"};return t[e]}},data:function(){return{list:[],fullList:[],listLoading:!0,pagesize:5,currpage:1,searchMap:{word:null},form:{id:"",department:"",tel:"",tax:"",addr:"",addr_map:"",email:"",tax_id:"",orders:0,status:"published"},dialogFormVisible:!1,mode:"add",rules:{department:[{required:!0,message:"請輸入公司!",trigger:"blur"},{max:64,message:"長度不能超過64個字!",trigger:"blur"}],tel:[{required:!0,message:"請輸入公司電話!",trigger:"blur"},{max:15,message:"長度不能超過15個字!",trigger:"blur"}],tax:[{required:!0,message:"請輸入公司傳真!",trigger:"blur"},{max:20,message:"長度不能超過20個字!",trigger:"blur"}],addr:[{required:!0,message:"請輸入公司地址!",trigger:"blur"},{max:256,message:"長度不能超過256個字!",trigger:"blur"}],addr_map:[{max:256,message:"長度不能超過256個字!",trigger:"blur"}],email:[{required:!0,message:"請輸入公司Email!",trigger:"blur"},{max:128,message:"長度不能超過128個字!",trigger:"blur"}],tax_id:[{required:!0,message:"請輸入公司統編!",trigger:"blur"},{max:20,message:"長度不能超過20個字!",trigger:"blur"}]}}},watch:{"searchMap.word":{handler:function(){""!==this.searchMap.word&&null!==this.searchMap.word||this.Search()}}},created:function(){this.fetchData()},methods:{fetchData:function(){var e=this;this.listLoading=!0,l().then((function(t){var r=null===t.data?[]:JSON.parse(JSON.stringify(t.data));e.list=r,e.fullList=r,e.listLoading=!1})).catch((function(t){alert(t),e.listLoading=!1}))},handleCurrentChange:function(e){this.currpage=e},handleSizeChange:function(e){this.pagesize=e},Search:function(){var e=this;this.listLoading=!0,null!==this.searchMap.word?this.list=this.fullList.filter((function(t){return t.department.match(e.searchMap.word)||t.tax_id.match(e.searchMap.word)})):this.list=this.fullList,this.listLoading=!1},Switch:function(){this.dialogFormVisible?this.dialogFormVisible=!1:this.dialogFormVisible=!0},Add:function(){"edit"===this.mode&&(this.mode="add",this.form={id:"",department:"",tel:"",tax:"",addr:"",addr_map:"",email:"",tax_id:"",orders:0,status:"published"}),this.Switch()},Edit:function(e){"add"===this.mode&&(this.mode="edit"),this.form={id:"",department:"",tel:"",tax:"",addr:"",addr_map:"",email:"",tax_id:"",orders:0,status:"published"},this.Switch();var t=this.list.filter((function(t){return t.id===e}))[0];this.form=JSON.parse(JSON.stringify(t))},Insert:function(){var e=this;this.$refs.form.validate((function(t){if(!t)return e.resError("請注意表單格式!"),!1;e.Switch(),o(e.form).then((function(t){200===t.code?(e.resSuccess(t.message),e.form={id:"",department:"",tel:"",tax:"",addr:"",addr_map:"",email:"",tax_id:"",orders:0,status:"published"},e.fetchData()):e.resError(t.message)})).catch((function(e){alert(e)}))}))},Update:function(){var e=this;this.$refs.form.validate((function(t){if(!t)return e.resError("請注意表單格式!"),!1;e.Switch(),s(e.form).then((function(t){200===t.code?(e.resSuccess(t.message),e.form={id:"",department:"",tel:"",tax:"",addr:"",addr_map:"",email:"",tax_id:"",orders:0,status:"published"},e.fetchData()):e.resError(t.message)})).catch((function(e){alert(e)}))}))},Delete:function(e){var t=this;this.$confirm("確定要刪除嗎？").then((function(){t.form=t.list.filter((function(t){return t.id===e}))[0],c(t.form).then((function(e){200===e.code?(t.resSuccess(e.message),t.form={id:"",department:"",tel:"",tax:"",addr:"",addr_map:"",email:"",tax_id:"",orders:0,status:"published"},t.fetchData()):t.resError(e.message)})).catch((function(e){alert(e)}))})).catch((function(){}))},resSuccess:function(e){var t=arguments.length>1&&void 0!==arguments[1]?arguments[1]:"";this.$notify({title:e,message:t,type:"success",duration:1500})},resError:function(e,t){this.$notify({title:e,message:t,type:"error",duration:1500})}}},d=u,f=r("2877"),m=Object(f["a"])(d,a,i,!1,null,null,null);t["default"]=m.exports}}]);