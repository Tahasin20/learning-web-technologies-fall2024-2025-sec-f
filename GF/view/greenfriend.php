<?php
    require_once('../model/userModel.php');
    require('../controller/load_products.php');
    $con = getConnection();
    // if ($con->connect_error) {
    //     die("Connection failed: " . $conn->connect_error);
    // }
?>



<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Green Marketplace</title>
    <style>



    body {
      margin: 0;
      padding: 0;
      justify-content: center;
      align-items: center;
      font-family: Arial, sans-serif;
      background: linear-gradient(to bottom, #f0fff0, #e0ffe0);
      width: 100%;
    }


    .image1 {
      position: relative;
      top: 0;
      left: 0;
      height: 1000px;
    }

    .image2 {
      position: absolute;
      top: 0px;
      left: 0px; 
    }

    .auth-buttons {
      color: white;
      height: 200px;
      top: 80px;
      left: 1650px;
      position: absolute;
    }

    .auth-buttons a {
      text-decoration: none;
      color: white;
      padding: 8px 15px;
      border: 2px solid white;
      border-radius: 20px;
      transition: 0.3s;
    }

    .auth-buttons a:hover {
      background-color: white;
      color: #228b22;
    }

    .product-section {
      background: url('path-to-your-background-image.jpg') no-repeat center center/cover;
      padding: 50px 20px;
    }

    .product-grid {
      display: grid;
      grid-template-columns: repeat(auto-fit, minmax(200px, 1fr));
      gap: 20px;
      margin: 0 auto;
      max-width: 1200px;
    }

    .product-item {
      background: #fff;
      border: 1px solid #ddd;
      border-radius: 8px;
      overflow: hidden;
      text-align: center;
      box-shadow: 0 4px 6px rgba(0, 0, 0, 0.1);
    }

    .product-item img {
      max-width: 100%;
      height: auto;
    }

    .product-info {
      padding: 15px;
    }

    .load-more {
      display: block;
      margin: 20px auto;
      padding: 10px 20px;
      background: #28a745;
      color: #fff;
      border: none;
      border-radius: 5px;
      cursor: pointer;
      font-size: 16px;
    }

    .load-more:hover {
      background: #218838;
    }

    .blog-container {
            width: 90%;
            margin: 20px auto;
            padding: 20px;
            border: 1px solid #ddd;
            border-radius: 5px;
            background-color: #f9f9f9;
        }
        .blog-title {
            font-size: 20px;
            font-weight: bold;
        }
        .blog-author {
            font-size: 14px;
            color: #555;
        }
        .blog-content {
            margin-top: 10px;
            font-size: 16px;
            line-height: 1.6;
        }
        form {
            width: 90%;
            margin: 20px auto;
        }
        textarea {
            width: 100%;
            height: 100px;
            margin-bottom: 10px;
            padding: 10px;
            border: 1px solid #ddd;
            border-radius: 5px;
        }
        button {
            padding: 10px 20px;
            border: none;
            background-color: #28a745;
            color: white;
            font-size: 16px;
            cursor: pointer;
            border-radius: 5px;
        }
        button:hover {
            background-color: #218838;
        }
    </style>
    <script>
        function navigateToCustomURL(event) {
            event.preventDefault();
            const h2Content = event.currentTarget.querySelector('div h6').innerText.trim(); // Get and trim the content of the h2
            const baseURL = 'productInfo.php'; 
            const customizedURL = `${baseURL}/${encodeURIComponent(h2Content)}`; // Create the customized URL
            
            let id = JSON.stringify(h2Content);
            let xhttp = new XMLHttpRequest();
            xhttp.open('post', 'abc.php', true);
            xhttp.setRequestHeader("Content-type", "application/x-www-form-urlencoded");
            xhttp.send('mydata='+id);

            // xhttp.onreadystatechange = function (){
            //     if(this.readyState == 4 && this.status == 200){
            //         //alert(this.responseText);
            //         let std = JSON.parse(this.responseText); 
            //         document.getElementById('head').innerHTML = std.pass;
            //     }
            // }
            ////window.location.href = 'abc.php';
        }
    </script>

    </head>
    <body>

    

        <div>
            <img class="image1" style="width:100%;" src="../Images/dashbackgroud.jpg" >
            <img class="image2" src="../Images/logo200.png" >
            <div class="auth-buttons">
                <a href="signIn.html">Sign In</a>
                <a href="signUp.html">Sign Up</a>
            </div>
        </div>
      

        <Products>

            <div class="product-section">
                <h1 style="display: flex; justify-content: center; align-items: center; ">Our Products</h1>
                <a href="#" style="color: black;" onclick="navigateToCustomURL(event)">
                  <div class="product-grid" id="product-grid">
                    <?php
                    // Fetch initial products from the database
                    $products = fetchProducts($con, 0, 10); // Adjust to fetch first 10 products
                    foreach ($products as $product) {
                        echo "<div class='product-item'>";
                        echo "<img src='../Images/Products/{$product['image_path']}' alt='{$product['product_name']}'>";
                        echo "<h6 id='product_id'>{$product['product_id']}</h6>";
                        echo "<div class='product-info'>";
                        echo "<h3 id='product_name'>{$product['product_name']}</h3>";
                        echo "<p>Price: \${$product['price']}</p>";
                        echo "</div>";
                        echo "</div>";
                    }
                    ?>
                </div>
              </a>
                <button class="load-more" id="load-more">Load More</button>
            </div>
        </Products>

        <Blogs>
            <h1 style="display: flex; justify-content: center; align-items: center; ">Blogs</h1>
            <div id="approvedBlogs">
                </div>
              
        </Blogs>
        


        <footer style="background-color: #2E8B57; color: white; padding: 20px; text-align: center;">
            <div style="max-width: 1200px; margin: auto;">
                <div>
                    <p style="margin: 0;">🌿 Together for a Greener Tomorrow 🌍</p>
                </div>
                <div style="margin: 15px 0;">
                    <a href="/about" style="color: #ecf0f1; text-decoration: none; margin: 0 10px;">About Us</a> |
                    <a href="/contact" style="color: #ecf0f1; text-decoration: none; margin: 0 10px;">Contact</a> |
                    <a href="/privacy-policy" style="color: #ecf0f1; text-decoration: none; margin: 0 10px;">Privacy Policy</a>
                </div>
                <div style="margin-top: 10px; font-size: 12px;">
                    <p style="margin: 0;">© <span id="year"></span> EcoFuture. All Rights Reserved.</p>
                    <p style="margin: 0;">Designed with 💚 for the Planet.</p>
                </div>
            </div>
        </footer>

    
        <script>
            let offset = 10;
            const loadMoreButton = document.getElementById('load-more');
            const productGrid = document.getElementById('product-grid');

            loadMoreButton.addEventListener('click', () => {
                fetch(`../controller/load_products.php?offset=${offset}`)
                .then(response => response.text())
                .then(data => {
                    productGrid.innerHTML += data;
                    offset += 10;
                })
                .catch(error => console.error('Error loading more products:', error));
            });

            document.getElementById('year').textContent = new Date().getFullYear();

            function fetchApprovedBlogs() {
            const xhttp = new XMLHttpRequest();
            xhttp.open('GET', '../controller/getApprovedBlogs.php', true);
            xhttp.onload = function () {
                if (this.status === 200) {
                    document.getElementById('approvedBlogs').innerHTML = this.responseText;
                }
            };
            xhttp.send();
        }
        document.addEventListener('DOMContentLoaded', fetchApprovedBlogs);

            
    </script>
  </body>
</html>


