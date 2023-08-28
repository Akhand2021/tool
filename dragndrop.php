<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
  <style>
    #drop-area {
      border: 2px dashed #ccc;
      padding: 20px;
      text-align: center;
      cursor: pointer;
    }

    .drop-message {
      font-size: 16px;
      margin-bottom: 10px;
    }

    #preview-container {
      display: flex;
      flex-wrap: wrap;
      gap: 10px;
    }

    .preview-image {
      max-width: 100px;
      max-height: 100px;
    }
  </style>
  <title>Multiple Image Upload</title>
</head>
<body>
  <div id="drop-area">
    <div class="drop-message">Drag & drop images here or click to select</div>
    <input type="file" id="fileInput" accept="image/*" multiple>
    <div id="preview-container"></div>
  </div>

  <script>
    const dropArea = document.getElementById("drop-area");
    const previewContainer = document.getElementById("preview-container");

    dropArea.addEventListener("dragover", (e) => {
      e.preventDefault();
      dropArea.classList.add("dragover");
    });

    dropArea.addEventListener("dragleave", (e) => {
      e.preventDefault();
      dropArea.classList.remove("dragover");
    });

    dropArea.addEventListener("drop", (e) => {
      e.preventDefault();
      dropArea.classList.remove("dragover");

      const files = e.dataTransfer.files;
      Array.from(files).forEach((file) => {
        if (file.type.match("image.*")) {
          const reader = new FileReader();

          reader.onload = function (event) {
            const previewImage = document.createElement("img");
            previewImage.classList.add("preview-image");
            previewImage.src = event.target.result;
            previewContainer.appendChild(previewImage);
          };

          reader.readAsDataURL(file);
          uploadImageToServer(file);
        }
      });
    });

    document.getElementById("fileInput").addEventListener("change", (e) => {
      const files = e.target.files;
      Array.from(files).forEach((file) => {
        if (file.type.match("image.*")) {
          const reader = new FileReader();

          reader.onload = function (event) {
            const previewImage = document.createElement("img");
            previewImage.classList.add("preview-image");
            previewImage.src = event.target.result;
            previewContainer.appendChild(previewImage);
          };

          reader.readAsDataURL(file);
        }
      });
    });

$("#fileInput").on("change", function (e) {
      const files = e.target.files;
      Array.from(files).forEach((file) => {
        if (file.type.match("image.*")) {
          const reader = new FileReader();

          reader.onload = function (event) {
            const previewImage = document.createElement("img");
            previewImage.classList.add("preview-image");
            previewImage.src = event.target.result;
            previewContainer.appendChild(previewImage);
            
            // Send the image to the server using jQuery AJAX
            uploadImageToServer(file);
          };

          reader.readAsDataURL(file);
        }
      });
    });
    function uploadImageToServer(imageFile) {
      const formData = new FormData();
      formData.append("image", imageFile);

      $.ajax({
        url: "upload.php", // Replace with your server upload endpoint
        method: "POST",
        data: formData,
        contentType: false,
        processData: false,
        success: function (response) {
          console.log("Image uploaded successfully:", response);
        },
        error: function (error) {
          console.error("Image upload failed:", error);
        }
      });
    }


  </script>
</body>
</html>
