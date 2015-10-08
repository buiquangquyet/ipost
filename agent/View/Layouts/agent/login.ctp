<!DOCTYPE html>
<html>
<head>
<meta charset="utf-8">
<meta name="viewport" content="width=device-width,initial-scale=1.0,user-scalable=yes" />
<title><?php echo $title_for_layout; ?></title>

<link rel="stylesheet" type="text/css" href="/css/style.css" />
<link rel="stylesheet" type="text/css" href="/css/sub.css" />

<script src="http://code.jquery.com/jquery-1.11.0.min.js" type="text/javascript" language="javascript"></script>
<script src="/js/analytics.js" type="text/javascript" language="javascript"></script>

</head>

<body>
  <div>
    <?php echo $this->fetch('content'); ?>
    <div class="copy_box">Copyright © <?php echo date('Y');?> HIROPRO, Inc. All Rights Reserved</div>
  </div>
</body>
</html>
