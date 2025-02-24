import{f as S}from"./links.C7Z9vJvv.js";import{C as v}from"./Blur.DNVDismY.js";import{C as A}from"./SettingsRow.DQldd-1Z.js";import{C as M}from"./Index.DOl5dkAv.js";import{x as e,o as r,c as g,C as o,m as n,a as w,t as l,D as d,l as _,d as m}from"./vue.esm-bundler.CWQFYt9y.js";import{_ as h}from"./_plugin-vue_export-helper.BN1snXvA.js";import{R as k}from"./RequiredPlans.5f41kq6X.js";import{C as x}from"./Card.CGaKNDqF.js";import{C as P}from"./ProBadge.WwPkDor4.js";import{C as B}from"./Index.XNbBlAFo.js";import{C as K}from"./Cta.D6J4LRxa.js";import{A as U}from"./AddonConditions.DbcWzjSi.js";import"./default-i18n.Bd0Z306Z.js";import"./helpers.DkJd815A.js";import"./Row.CzuhYwfs.js";import"./Tooltip.Jp05nfCy.js";import"./CheckSolid.ChbVSAiM.js";import"./index.B8uZtLiV.js";import"./Caret.iRBf3wcH.js";import"./Slide.CRIn0kdn.js";import"./addons.CFmx_7nM.js";import"./upperFirst.DnE5bcuK.js";import"./_stringToArray.DnK4tKcY.js";import"./toString.24fN1xMd.js";import"./license.QkKrD28L.js";import"./constants.DpuIWwJ9.js";const L={components:{CoreBlur:v,CoreSettingsRow:A,CoreUiElementSlider:M},data(){return{strings:{description:this.$t.__("Integrating with Google Maps will allow your users to find exactly where your business is located. Our interactive maps let them see your Google Reviews and get directions directly from your site. Create multiple maps for use with multiple locations.",this.$td),apiKey:this.$t.__("API Key",this.$td),mapPreview:this.$t.__("Map Preview",this.$td)},displayInfo:{block:{copy:"",desc:""}}}}},G={class:"aioseo-maps-blur"},R={class:"aioseo-settings-row"};function D(s,f,$,p,t,y){const a=e("base-input"),i=e("core-settings-row"),c=e("core-ui-element-slider"),u=e("core-blur");return r(),g("div",G,[o(u,null,{default:n(()=>[w("div",R,l(t.strings.description),1),o(i,{name:t.strings.apiKey,align:""},{content:n(()=>[o(a,{size:"medium"})]),_:1},8,["name"]),o(c,{options:t.displayInfo},null,8,["options"]),o(i,{name:t.strings.mapPreview,align:""},{content:n(()=>[d(l(t.strings.description),1)]),_:1},8,["name"])]),_:1})])}const I=h(L,[["render",D]]),E={setup(){return{licenseStore:S()}},components:{Blur:I,RequiredPlans:k,CoreCard:x,CoreProBadge:P,Cta:B},data(){return{features:[this.$t.__("Google Places Support",this.$td),this.$t.__("Google Reviews",this.$td),this.$t.__("Driving Directions",this.$td),this.$t.__("Multiple Locations",this.$td)],strings:{googleMapsApiKey:this.$t.__("Google Maps API Key",this.$td),ctaButtonText:this.$t.__("Unlock Local SEO",this.$td),ctaHeader:this.$t.sprintf(this.$t.__("Local SEO is a %1$s Feature",this.$td),"PRO"),ctaDescription:this.$t.__("Show your location to your visitors using an interactive Google Map. Create multiple maps for use with multiple locations.",this.$td)}}}},N={class:"aioseo-local-maps"};function O(s,f,$,p,t,y){const a=e("core-pro-badge"),i=e("blur"),c=e("required-plans"),u=e("cta"),b=e("core-card");return r(),g("div",N,[o(b,{slug:"localBusinessMapsApiKey",noSlide:!0},{header:n(()=>[w("span",null,l(t.strings.googleMapsApiKey),1),o(a)]),default:n(()=>[o(i),o(u,{"cta-link":s.$links.getPricingUrl("local-seo","local-seo-upsell","maps"),"button-text":t.strings.ctaButtonText,"learn-more-link":s.$links.getUpsellUrl("local-seo",null,s.$isPro?"pricing":"liteUpgrade"),"feature-list":t.features,"hide-bonus":!p.licenseStore.isUnlicensed},{"header-text":n(()=>[d(l(t.strings.ctaHeader),1)]),description:n(()=>[o(c,{addon:"aioseo-local-business"}),d(" "+l(t.strings.ctaDescription),1)]),_:1},8,["cta-link","button-text","learn-more-link","feature-list","hide-bonus"])]),_:1})])}const C=h(E,[["render",O]]),V={mixins:[U],components:{Maps:C,Cta:K,Lite:C},data(){return{addonSlug:"aioseo-local-business",strings:{googleMapsApiKey:this.$t.__("Google Maps API Key",this.$td)}}}},q={class:"aioseo-maps"};function T(s,f,$,p,t,y){const a=e("maps",!0),i=e("cta"),c=e("lite");return r(),g("div",q,[s.shouldShowMain?(r(),_(a,{key:0})):m("",!0),s.shouldShowUpdate||s.shouldShowActivate?(r(),_(i,{key:1,"card-slug":"localBusinessMapsApiKey","header-text":t.strings.googleMapsApiKey},null,8,["header-text"])):m("",!0),s.shouldShowLite?(r(),_(c,{key:2})):m("",!0)])}const ht=h(V,[["render",T]]);export{ht as default};
