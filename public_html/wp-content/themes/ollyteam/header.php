<?
	#Работа с партнерскими ссылками
	
	if(isset($_GET['pp'])) {
		setcookie('partner',$_GET['pp'] , time()+31536000, COOKIEPATH, COOKIE_DOMAIN, false);
	}

?>
<!doctype html>
<html lang="ru">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, user-scalable=no, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0">
  <meta http-equiv="X-UA-Compatible" content="ie=edge">
  <meta name="facebook-domain-verification" content="j9gbw2rfav1gjexi04k25bd1adyasg" />
  
  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/zabuto_calendar/1.6.4/zabuto_calendar.min.css" />
  <link rel="stylesheet" href="<?= bloginfo('template_directory'); ?>/css/fonts.css">
  <link rel="preload" as="style" href="<?= bloginfo('template_directory'); ?>/css/main.css?<?=time()?>">
  <link href="<?= bloginfo('template_directory'); ?>/css/main.css?<?=time()?>" rel="stylesheet">
  <link rel="stylesheet" href="https://cdn.jsdelivr.net/gh/fancyapps/fancybox@3.5.7/dist/jquery.fancybox.min.css" />
  <link rel="stylesheet" href="https://unpkg.com/simplebar@latest/dist/simplebar.css" />
 
 <script src="https://cdn.jsdelivr.net/npm/vue/dist/vue.js"></script>

  <title><?echo wp_get_document_title();?></title>
  <?php wp_head() ?>
<!-- Yandex.Metrika counter -->
<script type="text/javascript" >
   (function(m,e,t,r,i,k,a){m[i]=m[i]||function(){(m[i].a=m[i].a||[]).push(arguments)};
   m[i].l=1*new Date();
   for (var j = 0; j < document.scripts.length; j++) {if (document.scripts[j].src === r) { return; }}
   k=e.createElement(t),a=e.getElementsByTagName(t)[0],k.async=1,k.src=r,a.parentNode.insertBefore(k,a)})
   (window, document, "script", "https://mc.yandex.ru/metrika/tag.js", "ym");

   ym(92262557, "init", {
        clickmap:true,
        trackLinks:true,
        accurateTrackBounce:true,
        webvisor:true,
        ecommerce:"dataLayer"
   });
</script>
<noscript><div><img src="https://mc.yandex.ru/watch/92262557" style="position:absolute; left:-9999px;" alt="" /></div></noscript>
<!-- /Yandex.Metrika counter -->


<script type="text/javascript">!function(){var t=document.createElement("script");t.type="text/javascript",t.async=!0,t.src='https://vk.com/js/api/openapi.js?169',t.onload=function(){VK.Retargeting.Init("VK-RTRG-1697926-1PE9h"),VK.Retargeting.Hit()},document.head.appendChild(t)}();</script><noscript><img src="https://vk.com/rtrg?p=VK-RTRG-1697926-1PE9h" style="position:fixed; left:-999px;" alt=""/></noscript>
</head>
<body <?php body_class() ?>>