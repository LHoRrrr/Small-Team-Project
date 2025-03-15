document.addEventListener("DOMContentLoaded", () => {
    const uploadButton = document.getElementById("upload-button");
    const choosenImage = document.getElementById("choosen-image");
    const fileName = document.getElementById("file-name");
  
    if (!uploadButton) {
      console.error("uploadButton not found!");
      return;
    }
    if (!choosenImage) {
      console.error("choosenImage not found!");
      return;
    }
    if (!fileName) {
      console.error("fileName not found!");
      return;
    }
  
    console.log("All elements found!"); // Debugging line
  
    uploadButton.addEventListener("change", () => {
      console.log("File input changed!"); // Debugging line
  
      let file = uploadButton.files[0];
  
      if (file) {
        let reader = new FileReader();
        reader.readAsDataURL(file);
  
        reader.onload = () => {
          console.log("File successfully loaded!"); // Debugging line
          choosenImage.src = reader.result; // Display selected image
          fileName.textContent = file.name; // Show file name
        };
  
        reader.onerror = (error) => {
          console.error("Error reading file:", error);
        };
      } else {
        console.warn("No file selected!"); // Debugging line
      }
    });
  });
  
  


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
