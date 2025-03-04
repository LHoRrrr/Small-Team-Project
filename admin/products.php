<div class="form-container-add-product">
    <h1 class="">ADD PRODUCT FORM</h1>
    <div class="form-body-add-product">
        <form action="products.php">
            <div class="product-general-information-container">
                <h4>General Information</h4>

                <div class="product-name-container">
                    <label for="">Product ID</label> </br>
                    <input type="text" placeholder="Enter product ID" name="product_id"> </br>
                    <label for="">Prodcut Name</label> </br>
                    <input type="text" placeholder="Enter product name" name="product_name"> </br>
                </div>

                <div class="product-specs-container">
                    <div class="product-specs">
                        <label for="">Specs</label> </br>
                        <input type="text" name="product_specs" placeholder="Product specs">
                    </div>

                    <div class="product-description">
                        <label for="">Short description</label> </br>
                        <textarea type="text" name = "product_description" cols= "50" rows="10" > </textarea>
                    </div>
                </div>

                <div class="product-brand-container">
                    <div class="product-brAand">
                        <label for="">Product brand</label> </br>
                        <input type="text" name="product_brand" placeholder="Example: Apple...">
                    </div>
                    <div class="prodcut-mark">
                        <label for="">Product Mark</label> </br>
                        <select name="product_mark" id="">
                            <option value=""></option>
                            <option value="New release">New Releasing</option>
                            <option value="New">New</option>
                            <option value="Second hand">Second Hand</option>
                        </select>
                    </div>

                    <div class="product-price-container">
                        <div class="product-price">
                            <label for="">Price</label> </br>
                            <input type="text" name="product_price" placeholder="Product price">
                        </div>
                        <div class="prodcut-quantity">
                            <label for="">Quantity</label></br>
                            <input type="text" name="prodcut_quantity" placeholder="Product quantity">
                        </div>
                        <div class="product-status">
                            <label for="">Status</label> </br>
                            <select name="product_status" id="">
                                <option value="">Available</option>
                                <option value="">Out of Stock</option>
                            </select>
                        </div>
                        <div class="product-order">
                            <label for="">Order</label></br>
                            <input type="number" name="product_order" placeholder="Product order number">
                        </div>
                    </div>

                </div>


            </div>
            <div class="add-image-product-container">
                <h4>Product Image</h4>
                <div class="prodcut-image-container">
                    
                </div>
                <input type="file" name="product_image">
            </div>

        </form>
    </div>
</div>