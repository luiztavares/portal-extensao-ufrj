import{g as P,a as C,u as Q,b as O,v as $}from"./QBtn.b586c2ac.js";import{c as L,h as T,b as j}from"./render.754b40d4.js";import{c as m,h as x,r as F,s as A,u as D,g as B,w as V,o as I,O as _}from"./index.c844a102.js";import{u as W,a as M}from"./use-dark.ff06dc21.js";const K=[null,document,document.body,document.scrollingElement,document.documentElement];function X(e,o){let a=P(o);if(a===void 0){if(e==null)return window;a=e.closest(".scroll,.scroll-y,.overflow-auto")}return K.includes(a)?window:a}function Y(e){return e===window?window.pageYOffset||window.scrollY||document.body.scrollTop||0:e.scrollTop}function G(e){return e===window?window.pageXOffset||window.scrollX||document.body.scrollLeft||0:e.scrollLeft}let E;function J(){if(E!==void 0)return E;const e=document.createElement("p"),o=document.createElement("div");C(e,{width:"100%",height:"200px"}),C(o,{position:"absolute",top:"0px",left:"0px",visibility:"hidden",width:"200px",height:"150px",overflow:"hidden"}),o.appendChild(e),document.body.appendChild(o);const a=e.offsetWidth;o.style.overflow="scroll";let i=e.offsetWidth;return a===i&&(i=o.clientWidth),o.remove(),E=a-i,E}function Z(e,o=!0){return!e||e.nodeType!==Node.ELEMENT_NODE?!1:o?e.scrollHeight>e.clientHeight&&(e.classList.contains("scroll")||e.classList.contains("overflow-auto")||["auto","scroll"].includes(window.getComputedStyle(e)["overflow-y"])):e.scrollWidth>e.clientWidth&&(e.classList.contains("scroll")||e.classList.contains("overflow-auto")||["auto","scroll"].includes(window.getComputedStyle(e)["overflow-x"]))}var ee=L({name:"QItemSection",props:{avatar:Boolean,thumbnail:Boolean,side:Boolean,top:Boolean,noWrap:Boolean},setup(e,{slots:o}){const a=m(()=>`q-item__section column q-item__section--${e.avatar===!0||e.side===!0||e.thumbnail===!0?"side":"main"}`+(e.top===!0?" q-item__section--top justify-start":" justify-center")+(e.avatar===!0?" q-item__section--avatar":"")+(e.thumbnail===!0?" q-item__section--thumbnail":"")+(e.noWrap===!0?" q-item__section--nowrap":""));return()=>x("div",{class:a.value},T(o.default))}}),te=L({name:"QItem",props:{...W,...Q,tag:{type:String,default:"div"},active:{type:Boolean,default:null},clickable:Boolean,dense:Boolean,insetLevel:Number,tabindex:[String,Number],focused:Boolean,manualFocus:Boolean},emits:["click","keyup"],setup(e,{slots:o,emit:a}){const{proxy:{$q:i}}=B(),d=M(e,i),{hasLink:h,linkAttrs:w,linkClass:n,linkTag:s,navigateOnClick:p}=O(),u=F(null),f=F(null),v=m(()=>e.clickable===!0||h.value===!0||e.tag==="label"),r=m(()=>e.disable!==!0&&v.value===!0),b=m(()=>"q-item q-item-type row no-wrap"+(e.dense===!0?" q-item--dense":"")+(d.value===!0?" q-item--dark":"")+(h.value===!0&&e.active===null?n.value:e.active===!0?` q-item--active${e.activeClass!==void 0?` ${e.activeClass}`:""}`:"")+(e.disable===!0?" disabled":"")+(r.value===!0?" q-item--clickable q-link cursor-pointer "+(e.manualFocus===!0?"q-manual-focusable":"q-focusable q-hoverable")+(e.focused===!0?" q-manual-focusable--focused":""):"")),q=m(()=>{if(e.insetLevel===void 0)return null;const l=i.lang.rtl===!0?"Right":"Left";return{["padding"+l]:16+e.insetLevel*56+"px"}});function y(l){r.value===!0&&(f.value!==null&&(l.qKeyEvent!==!0&&document.activeElement===u.value?f.value.focus():document.activeElement===f.value&&u.value.focus()),p(l))}function k(l){if(r.value===!0&&A(l,13)===!0){D(l),l.qKeyEvent=!0;const S=new MouseEvent("click",l);S.qKeyEvent=!0,u.value.dispatchEvent(S)}a("keyup",l)}function t(){const l=j(o.default,[]);return r.value===!0&&l.unshift(x("div",{class:"q-focus-helper",tabindex:-1,ref:f})),l}return()=>{const l={ref:u,class:b.value,style:q.value,role:"listitem",onClick:y,onKeyup:k};return r.value===!0?(l.tabindex=e.tabindex||"0",Object.assign(l,w.value)):v.value===!0&&(l["aria-disabled"]="true"),x(s.value,l,t())}}}),le=L({name:"QList",props:{...W,bordered:Boolean,dense:Boolean,separator:Boolean,padding:Boolean,tag:{type:String,default:"div"}},setup(e,{slots:o}){const a=B(),i=M(e,a.proxy.$q),d=m(()=>"q-list"+(e.bordered===!0?" q-list--bordered":"")+(e.dense===!0?" q-list--dense":"")+(e.separator===!0?" q-list--separator":"")+(i.value===!0?" q-list--dark":"")+(e.padding===!0?" q-list--padding":""));return()=>x(e.tag,{class:d.value},T(o.default))}});const oe={modelValue:{type:Boolean,default:null},"onUpdate:modelValue":[Function,Array]},ae=["beforeShow","show","beforeHide","hide"];function ne({showing:e,canShow:o,hideOnRouteChange:a,handleShow:i,handleHide:d,processOnMount:h}){const w=B(),{props:n,emit:s,proxy:p}=w;let u;function f(t){e.value===!0?b(t):v(t)}function v(t){if(n.disable===!0||t!==void 0&&t.qAnchorHandled===!0||o!==void 0&&o(t)!==!0)return;const l=n["onUpdate:modelValue"]!==void 0;l===!0&&(s("update:modelValue",!0),u=t,_(()=>{u===t&&(u=void 0)})),(n.modelValue===null||l===!1)&&r(t)}function r(t){e.value!==!0&&(e.value=!0,s("beforeShow",t),i!==void 0?i(t):s("show",t))}function b(t){if(n.disable===!0)return;const l=n["onUpdate:modelValue"]!==void 0;l===!0&&(s("update:modelValue",!1),u=t,_(()=>{u===t&&(u=void 0)})),(n.modelValue===null||l===!1)&&q(t)}function q(t){e.value!==!1&&(e.value=!1,s("beforeHide",t),d!==void 0?d(t):s("hide",t))}function y(t){n.disable===!0&&t===!0?n["onUpdate:modelValue"]!==void 0&&s("update:modelValue",!1):t===!0!==e.value&&(t===!0?r:q)(u)}V(()=>n.modelValue,y),a!==void 0&&$(w)===!0&&V(()=>p.$route.fullPath,()=>{a.value===!0&&e.value===!0&&b()}),h===!0&&I(()=>{y(n.modelValue)});const k={show:v,hide:b,toggle:f};return Object.assign(p,k),k}let c=[],g=[];function H(e){g=g.filter(o=>o!==e)}function ue(e){H(e),g.push(e)}function ie(e){H(e),g.length===0&&c.length>0&&(c[c.length-1](),c=[])}function se(e){g.length===0?e():c.push(e)}function re(e){c=c.filter(o=>o!==e)}export{le as Q,Y as a,G as b,J as c,ae as d,ne as e,se as f,X as g,te as h,ee as i,ue as j,re as k,Z as l,ie as r,oe as u};