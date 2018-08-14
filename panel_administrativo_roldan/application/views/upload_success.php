<?php //header("Content-type: text/xml"); echo $xml['1']['xml']; ?>

<html>
<head>
<title>Upload Form</title>
</head>
<body>

<h3>Your file was successfully uploaded!</h3>

<ul>
<?php 

echo "<pre>";
 print_r($xml);
echo "</pre>"; 

echo "<pre>";
 print_r($upload_data);
echo "</pre>"; 
 foreach ($upload_data as $item => $value):?>
<li><?php echo $item;?>: <?php echo $value;?></li>
<?php endforeach; ?>
</ul>

<p><?php echo anchor('upload', 'Upload Another File!'); ?></p>

</body>
</html>