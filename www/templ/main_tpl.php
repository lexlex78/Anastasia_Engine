<!DOCTYPE HTML>
<!--[if IE 7 ]>
<html class="ie7 ie"><![endif]-->
<!--[if IE 8 ]>
<html class="ie8 ie"><![endif]-->
<!--[if IE 9 ]>
<html class="ie9 ie"><![endif]-->
<!--[if (gt IE 9)|!(IE)]><!-->
<html><!--<![endif]-->
<head>
          <title><?=$GLOBALS['meta_title']?></title>
          <meta http-equiv="content-type" content="text/html; charset=utf-8"/>
          <base href="<?=$GLOBALS['site_url']?>"/>
        <meta name="description" content="<?=$GLOBALS['meta_descr']?>"/>
        <meta name="keywords" content="<?=$GLOBALS['meta_keyw']?>"/>
          <script type="text/javascript" src="js/jquery-1.7.1.min.js"></script>
          <script type="text/javascript" src="js/jquery.bxSlider.min.js"></script>
          <script type="text/javascript" src="js/jquery.plaxmove.js"></script>
          <script type="text/javascript" src="js/js.js"></script>
          <link rel="stylesheet" type="text/css" href="css/all.css" media="all"/>
</head>
<body <?=$GLOBALS['body_cvet']?> >

<div class="layer1"></div>
<div class="layer4"></div>
<div class="layer2"></div>
<div class="layer3"></div>
<script type="text/javascript">
          $(function () {
                    $('.layer1').plaxmove({ratioH:0, ratioV:0})
                    $('.layer2').plaxmove({ratioH:0.2, ratioV:0.05})
                    $('.layer3').plaxmove({ratioH:0.3, ratioV:0.1})
                    $('.layer4').plaxmove({ratioH:0.1, ratioV:0.1})
          });
</script>
<div id="wrapper">
<div id="header">
          <strong class="logo"><a href="#">RDM</a></strong>
          <?=$GLOBALS[topmenu]?>
</div>
<div id="main">
<div id="sidebar">
          <ul class="side-nav cf">
                    <li>
                          <a class="opener-main " href="#">Каталог</a>
                          <?=$GLOBALS['shop_cat']?>    

                    </li>
                    <li class="non-list"><a href="#" class="to-link">Прайс-лист</a></li>
                    <?=$GLOBALS['tex_pot']?>
                    <?=$GLOBALS['partneryy']?>
          </ul>
</div>
<div id="content">
          <div class="cont-box-hold">
                    <div class="cont-box">
                              <div class="contacts">
                                        <span class="co1"><a
                                                href="mailto:<?=$GLOBALS['set']['email']?>">
                                                  <?=$GLOBALS['set']['email']?></a></span>
                                        <span class="co2"><?=$GLOBALS['set']['tel']?></span>
                              </div>
                              <a class="basket" href="#"> <strong class="bask-ord">Ваш список заказов</strong> <strong
                                      class="basket-way empty"> <span>0 товаров</span> <span>&nbsp;</span> </strong>
                              </a>
                    </div>
          </div>
          <div class="main-content"><?=$GLOBALS['center_area']?>
                    
                    
          </div>
</div>
</div>
</div>
<div id="footer">
          <?=$GLOBALS[topmenu1]?>
          <div class="foot-box">
                    <div class="copy">
                              <span>&copy; Copyright 2012</span> <span>Сделано в <a class="foot-logo" href="#"><em>UpSale</em></a></span>
                    </div>
                    <div class="foot-cont">
                              <span class="co1"><a
                                      href="mailto:<?=$GLOBALS['set']['email']?>">
                                        <?=$GLOBALS['set']['email']?></a></span>
                              <span class="co2"><?=$GLOBALS['set']['tel']?></span></div>
          </div>
</div>
<script type="text/javascript">
          jQuery(document).ready(function () {
                    // Declare parallax on layers
                    jQuery('.parallax-layer').parallax({
                              mouseport:jQuery("#port")
                    });
          });
</script>
<div class="popup-under"></div>
<div class="popup">
          <div class="popup-title">СНПЧ RDM-PRIVISION для принтеров <span class="black-del"></span>
          </div>
          <table class="card">
                    <tr>
                              <td><img src="images/img-item.jpg" alt=""></td>
                              <td>СНПЧ RDM-PRIVISION для принтеров Epson S22/BX305F/SX425W/SX420W</td>
                              <td><select name="name">
                                        <option value="1">1</option>
                                        <option value="1">1</option>
                                        <option value="1">1</option>
                                        <option value="1">1</option>
                              </select></td>
                              <td><strong class="blue-text">4000 va</strong></td>
                              <td><a href="#" class="red-del"></a></td>
                    </tr>
                    <tr>
                              <td><img src="images/img-item.jpg" alt=""></td>
                              <td>СНПЧ RDM-PRIVISION для принтеров Epson S22/BX305F/SX425W/SX420W</td>
                              <td><select name="name">
                                        <option value="1">1</option>
                                        <option value="1">1</option>
                                        <option value="1">1</option>
                                        <option value="1">1</option>
                              </select></td>
                              <td><strong class="blue-text">4000 va</strong></td>
                              <td><a href="#" class="red-del"></a></td>
                    </tr>
          </table>
          <div class="card-footer">
                    <a href="#">Продолжить выбор товаров</a> <span class="price">Итого: <strong>12 000
                    va</strong></span> <a href="#" class="buy-button">Оформить заявку</a>
          </div>
</div>
</body>
</html>
