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


//for add product form
document.addEventListener("DOMContentLoaded", function () {
    const productIdInput = document.querySelector('input[name="product_id"]');
    const submitButton = document.querySelector('input[type="submit"]');
    const messageContainer = document.createElement("p");
    productIdInput.parentNode.appendChild(messageContainer);

    productIdInput.addEventListener("input", function () {
        const productId = productIdInput.value.trim();

        if (productId.length === 0) {
            messageContainer.textContent = "";
            submitButton.disabled = false;
            return;
        }

        fetch("check_product_id.php", {  // Correct URL for ID checking
            method: "POST",
            headers: {
                "Content-Type": "application/x-www-form-urlencoded",
            },
            body: "product_id=" + encodeURIComponent(productId),
        })
        .then(response => response.json())
        .then(data => {
            if (data.exists) {
                messageContainer.textContent = "❌ Product ID already exists!";
                messageContainer.style.color = "red";
                submitButton.disabled = true;
            } else {
                messageContainer.textContent = "✅ Product ID is available!";
                messageContainer.style.color = "green";
                submitButton.disabled = false;
            }
        })
        .catch(error => {
            messageContainer.textContent = "⚠️ Error checking product ID!";
            messageContainer.style.color = "orange";
        });
    });
});
