const uploadButton = document.getElementById('upload-button');
const choosenImage = document.getElementById('choosen-image');
const fileName = document.getElementById('file-name');

uploadButton.onchange = () => {
  let reader = new FileReader();
  let file = uploadButton.files[0]; // Correct way to get the selected file

  if (file) {
    reader.readAsDataURL(file);
    reader.onload = () => {
      choosenImage.setAttribute("src", reader.result); // Display image
      fileName.textContent = file.name; // Show file name
    };
  }
};