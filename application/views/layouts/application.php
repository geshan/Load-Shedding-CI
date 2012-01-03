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
    <?php print anchor("", 'Home');?>

</body>
</html>
