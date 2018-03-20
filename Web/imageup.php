<!DOCTYPE html>
<html >
<head>
  <meta charset="UTF-8">
  <title>File upload input</title>
  
  
  
      <link rel="stylesheet" href="css/style3.css">

  
</head>

<body>
  <script class="jsbin" src="https://ajax.googleapis.com/ajax/libs/jquery/1/jquery.min.js"></script>
<div class="file-upload">
<form action="imageup_server.php" method="post" enctype="multipart/form-data">
  <div class="image-upload-wrap">
    <input class="file-upload-input" name="photo" type="file" onchange="readURL(this);" accept="image/*" id="fileSelect"/>
    <div class="drag-text">
      <h3>Drag and drop a file or select add Image</h3>
    </div>
  </div>
  <div class="file-upload-content">
    <img class="file-upload-image" src="#" alt="your image" />
    <div class="image-title-wrap">
      <button type="button" onclick="removeUpload()" class="remove-image">Remove <span class="image-title">Uploaded Image</span></button>
    </div>
	
  </div>
  <div>
  <p></p>
  <input class="file-upload-btn" type="submit" name="submit" value="Upload"/>
  </div>
  </form>
</div>
  
    <script  src="js/index.js"></script>

</body>
</html>
