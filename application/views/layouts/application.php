<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
    <meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
   <link rel="stylesheet" href="<?php print base_url()?>public/css/style.css" type="text/css" media="screen" />
    <title><?php echo $site_name ?></title>    
    
</head>

<body>
<?php if(!isset($message_class)):
          $message_class='information';
      endif;
?>
<div class="<?php print $message_class;?>">	<?php echo $this->template->message(); ?></div>
    
    <?php echo $this->template->yield(); ?>
    		<br/>
   <div class="menuitem"><a href="<?php print base_url()?>"><h2>Back Home</h2></a> <br /> Developed by <a href="http://geshan.blogspot.com">Geshan Manandhar</a></div>
<script type="text/javascript">

  var _gaq = _gaq || [];
  _gaq.push(['_setAccount', 'UA-28086385-1']);
  _gaq.push(['_trackPageview']);

  (function() {
    var ga = document.createElement('script'); ga.type = 'text/javascript'; ga.async = true;
    ga.src = ('https:' == document.location.protocol ? 'https://ssl' : 'http://www') + '.google-analytics.com/ga.js';
    var s = document.getElementsByTagName('script')[0]; s.parentNode.insertBefore(ga, s);
  })();

</script>
</body>
</html>
