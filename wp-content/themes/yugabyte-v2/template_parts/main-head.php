<meta charset="utf-8">
<meta http-equiv="x-ua-compatible" content="ie=edge">
<title><?php wp_title(''); echo ' | ';  bloginfo( 'name' ); ?></title>
<meta name="description" content="">
<meta name="viewport" content="width=device-width, initial-scale=1, user-scalable=no">
<link rel="shortcut icon" href="<?php echo get_stylesheet_directory_uri(); ?>/images/favicon.png" />

<!--    
___       ___  __   __     __   ___  __  
|  |__| |__  /__` |__) | |  \ |__  |__) 
|  |  | |___ .__/ |    | |__/ |___ |  \ 
Site By TheSpider.com | Custom web design + development

-->

<link href="https://fonts.googleapis.com/css?family=Lato:300,300i,400,400i,700,700i" rel="stylesheet">
<link href="https://fonts.googleapis.com/css?family=Open+Sans:300,300i,400,400i,700,700i,900,900i" rel="stylesheet">
<link href="https://fonts.googleapis.com/css?family=Montserrat:100,100i,200,200i,300,300i,400,400i,500,500i,600,600i,800,800i" rel="stylesheet">
<link href="https://fonts.googleapis.com/css?family=Rubik:300,500,700&display=swap" rel="stylesheet">
<link href="https://rsms.me/inter/inter.css" rel="stylesheet">
<link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.7.1/css/brands.css" integrity="sha384-BKw0P+CQz9xmby+uplDwp82Py8x1xtYPK3ORn/ZSoe6Dk3ETP59WCDnX+fI1XCKK" crossorigin="anonymous">
<link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.7.1/css/fontawesome.css" integrity="sha384-4aon80D8rXCGx9ayDt85LbyUHeMWd3UiBaWliBlJ53yzm9hqN21A+o1pqoyK04h+" crossorigin="anonymous">

<!-- animate on scroll -->
<link rel="stylesheet" href="https://unpkg.com/aos@next/dist/aos.css" />

<?php wp_head(); ?>

<?php if(is_front_page()) {?>
	
<?php } ?>

<link rel="stylesheet" href="<?php echo get_template_directory_uri(); ?>/css/bootstrap.min.css" type="text/css" />
<link rel="stylesheet" href="<?php echo get_template_directory_uri(); ?>/css/main.css" type="text/css" />
<link rel="stylesheet" href="<?php echo get_template_directory_uri(); ?>/style.css?ver=1.0.48" type="text/css" />
<link rel="stylesheet" href="<?php echo get_template_directory_uri(); ?>/css/responsive.css?ver=1.0.20" type="text/css" />

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
