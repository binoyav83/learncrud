<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Fetch API with Laravel</title>
</head>
<body>
    <h1>Products</h1>
    <div id="products"></div>

    <script>
        const apiUrl = 'http://{{env('APP_URL')}}/api/products';

        // Fetch all products
        async function fetchProducts() {
            const response = await fetch(apiUrl);
            const products = await response.json();
            const productsDiv = document.getElementById('products');
            productsDiv.innerHTML = products.map(product => `
                <div>
                    <h2>${product.name}</h2>
                    <p>${product.description}</p>
                    <p>$${product.price}</p>
                </div>
            `).join('');
        }

        // Create a new product
        async function createProduct(product) {
            const response = await fetch(apiUrl, {
                method: 'POST',
                headers: {
                    'Content-Type': 'application/json'
                },
                body: JSON.stringify(product)
            });
            const newProduct = await response.json();
            console.log('Created Product:', newProduct);
        }

        // Update a product
        async function updateProduct(productId, product) {
            const response = await fetch(`${apiUrl}/${productId}`, {
                method: 'PUT',
                headers: {
                    'Content-Type': 'application/json'
                },
                body: JSON.stringify(product)
            });
            const updatedProduct = await response.json();
            console.log('Updated Product:', updatedProduct);
        }

        // Delete a product
        async function deleteProduct(productId) {
            const response = await fetch(`${apiUrl}/${productId}`, {
                method: 'DELETE'
            });
            const result = await response.json();
            console.log(result.message);
        }

        // Example usage:
        fetchProducts();
        createProduct({ name: 'New Product', price: 19.99, description: 'A new product' });
        updateProduct(1, { name: 'Updated Product', price: 24.99, description: 'An updated description' });
        deleteProduct(1);
    </script>
</body>
</html>
