<!DOCTYPE html>
<html lang="{snippet:language}">
<head>
<title>{snippet:title}</title>
<meta charset="{snippet:charset}" />
<meta name="keywords" content="{snippet:keywords}" />
<meta name="description" content="{snippet:description}" />
<meta name="viewport" content="width=1024">
<link rel="shortcut icon" href="<?php echo WS_DIR_HTTP_HOME; ?>favicon.ico">
<link rel="stylesheet" href="{snippet:template_path}styles/theme.css" media="all" />
<link rel="stylesheet" href="{snippet:template_path}styles/loader.css" media="all" />
<!--[if IE]><link rel="stylesheet" href="{snippet:template_path}styles/ie.css" /><![endif]-->
<!--[if IE 9]><link rel="stylesheet" href="{snippet:template_path}styles/ie9.css" /><![endif]-->
<!--[if lt IE 9]><link rel="stylesheet" href="{snippet:template_path}styles/ie8.css" /><![endif]-->
<!--[if lt IE 9]><script src="//html5shiv.googlecode.com/svn/trunk/html5.js"></script><![endif]-->
<!--snippet:head_tags-->
<!--snippet:javascript-->
<script>
  if (/iphone|ipod|android|blackberry|opera mini|opera mobi|skyfire|maemo|windows phone|palm|iemobile|symbian|symbianos|fennec/i.test(navigator.userAgent.toLowerCase())) {
    $("meta[name='viewport']").attr("content", "width=640");
  }
</script>
<style>
<?php
  $settings = unserialize(settings::get('store_template_catalog_settings'));
  
  if (!empty($settings['fixed_header'])) {
    echo '#header-wrapper { position: fixed !important; }' . PHP_EOL;
  } else {
    echo '#header-wrapper { position: absolute !important; box-shadow: none !important; background: none; }' . PHP_EOL;
    echo '#page-wrapper { padding-top: 80px; }' . PHP_EOL;
  }
?>
</style>
</head>
<body>


<div id="header-wrapper" class="shadow">
  <div style="padding: 0px 10px;">
    <header id="header" class="nine-eighty">
    
      <div id="logotype-wrapper">
        <a href="<?php echo document::href_link(WS_DIR_HTTP_HOME . 'index.php'); ?>"><img src="<?php echo WS_DIR_IMAGES; ?>logotype.png" height="50" alt="<?php echo settings::get('store_name'); ?>" /></a>
      </div>
      
      <div id="customer-service-wrapper">
        <span class="title"><?php echo $system->language->translate('title_customer_service', 'Customer Service'); ?></span><br />
        <span class="phone"><?php echo $system->settings->get('store_phone'); ?></span>
      </div>
      
    </header>
  </div>
</div>

<div id="page-wrapper">
  <div id="page">
    
    <div id="site-menu-wrapper">
      <?php include (FS_DIR_HTTP_ROOT . WS_DIR_BOXES . 'site_menu.inc.php'); ?>
    </div>
    
    <div id="main-wrapper" class="nine-eighty">
      <div id="main">
        <table style="width: 100%;">
          <tr>
            <td colspan="3" class="top">
              <!--snippet:notices-->
              <!--snippet:top-->
            </td>
          </tr>
          <tr>
            <td class="left" style="vertical-align: top;">
              <!--snippet:column_left-->
            </td>
            <td class="content" style="vertical-align: top;">
              <div id="content-wrapper">
                <div id="content" class="">
                  <!--snippet:content-->
                </div>
              </div>
            </td>
            <td class="right" style="vertical-align: top;">
              <!--snippet:column_right-->
            </td>
          </tr>
          <tr>
            <td colspan="3" class="bottom">
              <!--snippet:bottom-->
            </td>
          </tr>
        </table>
      </div>
    </div>
  </div>
</div>

<a href="#" id="scroll-up">Scroll</a>
<script>
  $(window).scroll(function(){
    if ($(this).scrollTop() > 100) {
      $('#scroll-up').fadeIn();
    } else {
      $('#scroll-up').fadeOut();
    }
  });
  
  $('#scroll-up').click(function(){
    $("html, body").animate({scrollTop: 0}, 1000, 'swing');
    return false;
  });
</script>
  
<!--snippet:foot_tags-->
</body>
</html>