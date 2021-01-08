<meta charset="utf-8">
<meta http-equiv="x-ua-compatible" content="ie=edge">
<title><?php single_post_title(); echo ' | ';  bloginfo( 'name' ); ?></title>
<meta name="viewport" content="width=device-width, initial-scale=1">
<link rel="shortcut icon" href="<?php echo get_stylesheet_directory_uri(); ?>/images/favicon.png" />

<!--    
___       ___  __   __     __   ___  __  
|  |__| |__  /__` |__) | |  \ |__  |__) 
|  |  | |___ .__/ |    | |__/ |___ |  \ 
Site By TheSpider.com | Custom web design + development

-->

<link href="https://fonts.googleapis.com/css?family=Open+Sans:300,300i,400,400i,700,700i,900,900i" rel="stylesheet">
<link href="https://fonts.googleapis.com/css?family=Rubik:300,400,500&display=swap" rel="stylesheet">
<link href="https://rsms.me/inter/inter.css" rel="stylesheet">
<link href="https://fonts.googleapis.com/css2?family=Source+Sans+Pro:ital,wght@0,300;0,400;0,600;0,700;0,900;1,300;1,400;1,600;1,700&display=swap" rel="stylesheet">
<link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.7.1/css/brands.css" integrity="sha384-BKw0P+CQz9xmby+uplDwp82Py8x1xtYPK3ORn/ZSoe6Dk3ETP59WCDnX+fI1XCKK" crossorigin="anonymous">
<link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.7.1/css/fontawesome.css" integrity="sha384-4aon80D8rXCGx9ayDt85LbyUHeMWd3UiBaWliBlJ53yzm9hqN21A+o1pqoyK04h+" crossorigin="anonymous">

<!-- animate on scroll -->
<link rel="stylesheet" href="https://unpkg.com/aos@next/dist/aos.css" />

<?php wp_head(); ?>

<?php if(is_front_page()) {?>
	
<?php } ?>

<link rel="stylesheet" href="<?php echo get_template_directory_uri(); ?>/css/bootstrap.min.css" type="text/css" />
<link rel="stylesheet" href="<?php echo get_template_directory_uri(); ?>/css/main.css" type="text/css" />
<link rel="stylesheet" href="<?php echo get_template_directory_uri(); ?>/style.css?ver=1.0.119" type="text/css" />
<link rel="stylesheet" href="<?php echo get_template_directory_uri(); ?>/css/responsive.css?ver=1.0.48" type="text/css" />

<!-- Global site tag (gtag.js) - Google Analytics -->
<script async src="https://www.googletagmanager.com/gtag/js?id=UA-104956980-1"></script>
<script>
window.dataLayer = window.dataLayer || [];
function gtag(){dataLayer.push(arguments);}
gtag('js', new Date());
gtag('config', 'UA-104956980-1');
</script>
<!-- End Google Analytics -->
<!-- Big Picture --><script> !function(e,t,i){var r=e.bigPicture=e.bigPicture||[];if(!r.initialized)if(r.invoked)e.console&&console.error&&console.error("BigPicture.io snippet included twice.");else{r.invoked=!0,r.SNIPPET_VERSION=1.5,r.handler=function(e){if(void 0!==r.callback)try{return r.callback(e)}catch(e){}},r.eventList=["mousedown","mouseup","click","submit"],r.methods=["track","identify","page","group","alias","integration","ready","intelReady","consentReady","on","off"],r.factory=function(e){return function(){var t=Array.prototype.slice.call(arguments);return t.unshift(e),r.push(t),r}};for(var n=0;n<r.methods.length;n++){var o=r.methods[n];r[o]=r.factory(o)}r.getCookie=function(e){var i=("; "+t.cookie).split("; "+e+"=");return 2==i.length&&i.pop().split(";").shift()};var c=r.isEditor=function(){try{return e.self!==e.top&&(new RegExp("app"+i,"ig").test(t.referrer)||"edit"==r.getCookie("_bpr_edit"))}catch(e){return!1}}();r.init=function(n,o){if(r.projectId=n,r._config=o,!c)for(var a=0;a<r.eventList.length;a++)e.addEventListener(r.eventList[a],r.handler,!0);var s=t.createElement("script");s.async=!0;var d=c?"/editor/editor":"/public-"+n;s.src="//cdn"+i+d+".js",t.getElementsByTagName("head")[0].appendChild(s)}}}(window,document,".bigpicture.io"); bigPicture.init("1020");</script>

<!-- Iubenda Cookie Solution -->
<style >
#iubenda-cs-banner {
  font-size: 15px !important;
  background: none !important;
  line-height: 1.8 !important;
  position: fixed !important;
  z-index: 99999998 !important;
  top: 0 !important;
  left: 0 !important;
  width: 100% !important;
  height: 100% !important;
  border: 0 !important;
  margin: 0 !important;
  padding: 0 !important;
  overflow: hidden !important;
  display: -webkit-box !important;
  display: -ms-flexbox !important;
  display: flex !important;
  opacity: 0 !important;
  visibility: hidden !important;
  pointer-events: none !important;
  -webkit-transition: opacity 0.4s ease, visibility 0.4s ease !important;
  -o-transition: opacity 0.4s ease, visibility 0.4s ease !important;
  transition: opacity 0.4s ease, visibility 0.4s ease !important;
  /* default */
}

#iubenda-cs-banner * {
  font-size: 100% !important;
  width: auto !important;
  -webkit-appearance: none !important;
  -moz-appearance: none !important;
  appearance: none !important;
  background: none !important;
  -webkit-box-sizing: border-box !important;
  box-sizing: border-box !important;
  -webkit-tap-highlight-color: rgba(0, 0, 0, 0) !important;
  -webkit-backface-visibility: hidden !important;
  backface-visibility: hidden !important;
  font-family: -apple-system, sans-serif !important;
  text-decoration: none !important;
  color: currentColor !important;
  background-attachment: scroll !important;
  background-color: transparent !important;
  background-image: none !important;
  background-position: 0 0 !important;
  background-repeat: repeat !important;
  border: 0 !important;
  border-color: #000 !important;
  border-color: currentColor !important;
  border-radius: 0 !important;
  border-style: none !important;
  border-width: medium !important;
  bottom: auto !important;
  clear: none !important;
  clip: auto !important;
  counter-increment: none !important;
  counter-reset: none !important;
  cursor: auto !important;
  direction: inherit !important;
  float: none !important;
  font-style: inherit !important;
  font-variant: normal !important;
  font-weight: inherit !important;
  height: auto !important;
  left: auto !important;
  letter-spacing: normal !important;
  line-height: inherit !important;
  list-style-type: inherit !important;
  list-style-position: outside !important;
  list-style-image: none !important;
  margin: 0 !important;
  max-height: none !important;
  max-width: none !important;
  min-height: 0 !important;
  min-width: 0 !important;
  opacity: 1;
  outline: 0 !important;
  overflow: visible !important;
  padding: 0 !important;
  position: static !important;
  quotes: "" "" !important;
  right: auto !important;
  table-layout: auto !important;
  text-align: inherit !important;
  text-indent: 0 !important;
  text-transform: none !important;
  top: auto !important;
  unicode-bidi: normal !important;
  vertical-align: baseline !important;
  visibility: inherit !important;
  white-space: normal !important;
  width: auto !important;
  word-spacing: normal !important;
  z-index: auto !important;
  background-origin: padding-box !important;
  background-origin: padding-box !important;
  background-clip: border-box !important;
  background-size: auto !important;
  -webkit-border-image: none !important;
  -o-border-image: none !important;
  border-image: none !important;
  border-radius: 0 !important;
  border-radius: 0 !important;
  -webkit-box-shadow: none !important;
  box-shadow: none !important;
  -webkit-column-count: auto !important;
  column-count: auto !important;
  -webkit-column-gap: normal !important;
  column-gap: normal !important;
  -webkit-column-rule: medium none #000 !important;
  column-rule: medium none #000 !important;
  -webkit-column-span: none !important;
  column-span: none !important;
  -webkit-column-width: auto !important;
  column-width: auto !important;
  -webkit-font-feature-settings: normal !important;
  font-feature-settings: normal !important;
  overflow-x: visible !important;
  overflow-y: visible !important;
  -webkit-hyphens: manual !important;
  -ms-hyphens: manual !important;
  hyphens: manual !important;
  -webkit-perspective: none !important;
  perspective: none !important;
  -webkit-perspective-origin: 50% 50% !important;
  perspective-origin: 50% 50% !important;
  text-shadow: none !important;
  -webkit-transition: all 0s ease 0s !important;
  -o-transition: all 0s ease 0s !important;
  transition: all 0s ease 0s !important;
  -webkit-transform: none !important;
  -ms-transform: none !important;
  transform: none !important;
  -webkit-transform-origin: 50% 50% !important;
  -ms-transform-origin: 50% 50% !important;
  transform-origin: 50% 50% !important;
  -webkit-transform-style: flat !important;
  transform-style: flat !important;
  word-break: normal !important;
  -ms-text-size-adjust: 100%;
  -webkit-text-size-adjust: 100%;
}

#iubenda-cs-banner.iubenda-cs-overlay:before {
  content: "" !important;
  position: fixed !important;
  top: 0 !important;
  left: 0 !important;
  width: 100% !important;
  height: 100% !important;
  background-color: rgba(0, 0, 0, 0.5) !important;
  z-index: 1 !important;
}

#iubenda-cs-banner.iubenda-cs-center {
  -webkit-box-align: center !important;
  -ms-flex-align: center !important;
  align-items: center !important;
  -webkit-box-pack: center !important;
  -ms-flex-pack: center !important;
  justify-content: center !important;
}

#iubenda-cs-banner.iubenda-cs-top {
  -webkit-box-align: start !important;
  -ms-flex-align: start !important;
  align-items: flex-start !important;
}

#iubenda-cs-banner.iubenda-cs-bottom {
  -webkit-box-align: end !important;
  -ms-flex-align: end !important;
  align-items: flex-end !important;
}

#iubenda-cs-banner.iubenda-cs-left {
  -webkit-box-pack: start !important;
  -ms-flex-pack: start !important;
  justify-content: flex-start !important;
}

#iubenda-cs-banner.iubenda-cs-right {
  -webkit-box-pack: end !important;
  -ms-flex-pack: end !important;
  justify-content: flex-end !important;
}

#iubenda-cs-banner.iubenda-cs-visible {
  opacity: 1 !important;
  visibility: visible !important;
}

#iubenda-cs-banner.iubenda-cs-visible .iubenda-cs-container {
  pointer-events: auto !important;
}

#iubenda-cs-banner.iubenda-cs-slidein .iubenda-cs-container {
  -webkit-transition: -webkit-transform 0.4s ease !important;
  transition: -webkit-transform 0.4s ease !important;
  -o-transition: transform 0.4s ease !important;
  transition: transform 0.4s ease !important;
  transition: transform 0.4s ease, -webkit-transform 0.4s ease !important;
}

#iubenda-cs-banner.iubenda-cs-slidein.iubenda-cs-top .iubenda-cs-container {
  -webkit-transform: translateY(-48px) !important;
  -ms-transform: translateY(-48px) !important;
  transform: translateY(-48px) !important;
}

#iubenda-cs-banner.iubenda-cs-slidein.iubenda-cs-bottom .iubenda-cs-container {
  -webkit-transform: translateY(48px) !important;
  -ms-transform: translateY(48px) !important;
  transform: translateY(48px) !important;
}

#iubenda-cs-banner.iubenda-cs-slidein.iubenda-cs-visible .iubenda-cs-container {
  -webkit-transform: translateY(0) !important;
  -ms-transform: translateY(0) !important;
  transform: translateY(0) !important;
}

#iubenda-cs-banner .iubenda-cs-container {
  position: relative !important;
  z-index: 2 !important;
}

#iubenda-cs-banner .iubenda-cs-content {
  position: relative !important;
  z-index: 1 !important;
  overflow: hidden !important;
  -webkit-transition: -webkit-transform 0.4s ease !important;
  transition: -webkit-transform 0.4s ease !important;
  -o-transition: transform 0.4s ease !important;
  transition: transform 0.4s ease !important;
  transition: transform 0.4s ease, -webkit-transform 0.4s ease !important;
}

#iubenda-cs-banner .iubenda-cs-rationale {
  position: relative !important;
}

#iubenda-cs-banner .iubenda-cs-close-btn {
  position: absolute !important;
  top: -16px !important;
  padding: 16px !important;
  right: 0 !important;
  width: 48px !important;
  height: 48px !important;
  font-size: 24px !important;
  line-height: 0 !important;
  font-weight: lighter !important;
  cursor: pointer !important;
  text-align: center !important;
}

#iubenda-cs-banner .iubenda-cs-close-btn:hover {
  opacity: 0.5 !important;
}

#iubenda-cs-banner .iubenda-banner-content {
  font-weight: 300 !important;
  margin: 16px !important;
}

#iubenda-cs-banner .iubenda-banner-content a {
  cursor: pointer !important;
  color: currentColor !important;
  opacity: 0.7 !important;
  text-decoration: underline !important;
}

#iubenda-cs-banner .iubenda-banner-content a:hover {
  opacity: 1 !important;
}

#iubenda-cs-banner #iubenda-cs-title {
  font-weight: bold !important;
  margin-bottom: 16px !important;
}

#iubenda-cs-banner .iubenda-cs-opt-group {
  margin: 16px !important;
  z-index: 1 !important;
}

#iubenda-cs-banner .iubenda-cs-opt-group button {
  -webkit-appearance: none !important;
  -moz-appearance: none !important;
  appearance: none !important;
  padding: 8px 16px !important;
  border-radius: 4px !important;
  cursor: pointer !important;
  font-weight: bold !important;
  font-size: 100% !important;
  margin-top: 4px !important;
  margin-bottom: 4px !important;
}

#iubenda-cs-banner .iubenda-cs-opt-group button:focus {
  opacity: 0.8 !important;
}

#iubenda-cs-banner .iubenda-cs-opt-group button:hover {
  opacity: 0.5 !important;
}

@media (min-width: 480px) {
  #iubenda-cs-banner .iubenda-cs-opt-group button:not(:last-of-type) {
    margin-right: 4px !important;
  }
}

@media (max-width: 479px) {
  #iubenda-cs-banner .iubenda-cs-opt-group button {
    width: 100% !important;
    display: block;
    text-align: center !important;
  }
  #iubenda-cs-banner .iubenda-cs-opt-group button:not(:last-of-type) {
    margin-bottom: 8px !important;
  }
}

@media (max-width: 991px) and (max-height: 352px) {
  #iubenda-cs-banner .iubenda-cs-opt-group {
    -webkit-box-shadow: 0 -16px 24px currentColor !important;
    box-shadow: 0 -16px 24px currentColor !important;
    margin-top: 0 !important;
  }
  #iubenda-cs-banner .iubenda-cs-content {
    padding: 0 !important;
  }
  #iubenda-cs-banner .iubenda-cs-close-btn {
    top: 0 !important;
  }
  #iubenda-cs-banner .iubenda-banner-content {
    overflow-y: scroll !important;
    padding-right: 16px !important;
    padding-bottom: 16px !important;
    margin-bottom: 4px !important;
    -webkit-box-flex: 1px !important;
    -ms-flex: 1px !important;
    flex: 1px !important;
  }
  #iubenda-cs-banner .iubenda-cs-rationale {
    display: -webkit-box !important;
    display: -ms-flexbox !important;
    display: flex !important;
    -webkit-box-orient: vertical !important;
    -webkit-box-direction: normal !important;
    -ms-flex-direction: column !important;
    flex-direction: column !important;
  }
}

#iubenda-cs-banner.iubenda-cs-default .iubenda-cs-container {
  width: 100% !important;
}

@media (min-width: 992px) {
  #iubenda-cs-banner.iubenda-cs-default .iubenda-cs-rationale {
    width: 992px !important;
    margin: 32px auto !important;
  }
}

@media (max-width: 991px) {
  #iubenda-cs-banner.iubenda-cs-default .iubenda-cs-content {
    padding: 8px !important;
  }
}

@media (max-width: 991px) and (max-height: 352px) {
  #iubenda-cs-banner.iubenda-cs-default .iubenda-cs-container,
  #iubenda-cs-banner.iubenda-cs-default .iubenda-cs-content,
  #iubenda-cs-banner.iubenda-cs-default .iubenda-cs-rationale {
    height: 100% !important;
  }
}

@media (min-width: 992px) {
  #iubenda-cs-banner.iubenda-cs-default-floating .iubenda-cs-container {
    width: 992px !important;
  }
}

@media (min-width: 480px) {
  #iubenda-cs-banner.iubenda-cs-default-floating:not(.iubenda-cs-top):not(.iubenda-cs-center) .iubenda-cs-container, #iubenda-cs-banner.iubenda-cs-default-floating:not(.iubenda-cs-bottom):not(.iubenda-cs-center) .iubenda-cs-container, #iubenda-cs-banner.iubenda-cs-default-floating.iubenda-cs-center:not(.iubenda-cs-top):not(.iubenda-cs-bottom) .iubenda-cs-container {
    width: 480px !important;
  }
}

#iubenda-cs-banner.iubenda-cs-default-floating:not(.iubenda-cs-top):not(.iubenda-cs-center) .iubenda-cs-opt-group button, #iubenda-cs-banner.iubenda-cs-default-floating:not(.iubenda-cs-bottom):not(.iubenda-cs-center) .iubenda-cs-opt-group button, #iubenda-cs-banner.iubenda-cs-default-floating.iubenda-cs-center:not(.iubenda-cs-top):not(.iubenda-cs-bottom) .iubenda-cs-opt-group button {
  display: block !important;
}

#iubenda-cs-banner.iubenda-cs-default-floating .iubenda-cs-content {
  box-shadow: 0 15px 35px rgba(50,50,93,.1), 0 5px 15px rgba(0,0,0,.07)!important;
  -webkit-box-shadow: 0 15px 35px rgba(50,50,93,.1), 0 5px 15px rgba(0,0,0,.07)!important;
  border-radius: 4px !important;
  margin: 16px !important;
  padding: 8px !important;
}

@media (max-width: 991px) and (max-height: 352px) {
  #iubenda-cs-banner.iubenda-cs-default-floating .iubenda-cs-content {
    height: calc(100% - 32px) !important;
  }
  #iubenda-cs-banner.iubenda-cs-default-floating .iubenda-cs-container,
  #iubenda-cs-banner.iubenda-cs-default-floating .iubenda-cs-rationale {
    height: 100% !important;
  }
}

#iubenda-cs-banner .iubenda-cs-content {
  color: #000000 !important;
  background: #FFFFFF !important;
}

#iubenda-cs-banner .iubenda-cs-opt-group {
  color: #000000 !important;
}

#iubenda-cs-banner .iubenda-cs-opt-group button {
  background-color: rgba(255, 255, 255, 0.1) !important;
  color: #FFFFFF !important;
}

#iubenda-cs-banner .iubenda-cs-opt-group button.iubenda-cs-btn-primary {
  background-color: #0073CE !important;
  color: #FFFFFF !important;
}
</style>
