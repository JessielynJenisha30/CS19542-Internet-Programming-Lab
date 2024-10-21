<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Desserts Menu</title>
    <link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Playfair Display">
    <style>
        /* Styling for the menu page */
        body {
            font-family: 'Playfair Display';
            background-color: #f9f9f9;
            margin: 0;
            padding: 20px;
        }

        h1 {
            text-align: center;
            margin-bottom: 20px;
            color: #6b4f4f;
        }

        #menuContainer {
            display: flex;
            flex-wrap: wrap;
            justify-content: center;
        }

        #Seasonal {
            background-color: rgb(255, 221, 169);
        }

        .menuItem {
            background-color: white;
            border: 1px solid #ddd;
            border-radius: 8px;
            margin: 10px;
            padding: 15px;
            width: 200px;
            text-align: center;
            box-shadow: 0 4px 6px rgba(0, 0, 0, 0.1);
        }

        .menuItem img,
        .menuItem_Seasonal img {
            width: 100%;
            height: auto;
            height: 200px;
            object-fit: cover;
            border-radius: 8px;
        }

        .menuItem h3,
        .menuItem_Seasonal h3 {
            margin-top: 10px;
            color: #6b4f4f;
        }

        .menuItem p,
        .menuItem_Seasonal p {
            color: #333;
        }

        .controls {
            display: flex;
            justify-content: space-between;
            align-items: center;
        }

        #searchBar,
        #filterDropdown,
        #sortDropdown {
            font-family: 'Playfair Display';
            padding: 10px;
            width: 100%;
            max-width: 300px;
            border-radius: 5px;
            border: 1px solid #ccc;
            display: block;
            margin-bottom: 20px;
            margin-top: 20px;
        }

        .controls {
            text-align: center;
        }
    </style>
</head>

<body>
    <h1>Desserts Menu</h1>

    <div class="controls">
        <input type="text" id="searchBar" placeholder="Search for a dessert..." onkeyup="filterMenu()">
        <select id="filterDropdown" onchange="filterMenu()">
            <option value="all">All Categories</option>
            <option value="icecream">Ice cream & Frozen Treats </option>
            <option value="cake">Cakes</option>
            <option value="cookie">Cookies & Bakeries</option>
            <option value="standard">Standard</option>
            <option value="seasonal">Seasonal</option>
        </select>
        <select id="sortDropdown" onchange="sortMenu()">
            <option value="name">Sort by Name</option>
            <option value="price">Sort by Price</option>
        </select>
    </div>

    <div id="menuContainer">

        <!--?php
        $conn = new mysqli('localhost', 'root', '', 'cafe_db');
        if ($conn->connect_error) {
            die("Connection failed: " . $conn->connect_error);
        }

        $sql = "SELECT * FROM cafe_menu WHERE category IN ('cookie', 'cake', 'icecream')";
        $result = $conn->query($sql);

        if ($result->num_rows > 0) {
            while ($row = $result->fetch_assoc()) {
                echo '<div class="menuItem" data-category="' . $row['category'] . '" data-price="' . $row['price'] . '" type="' . $row['type'] . '">';
                echo '<img src="' . $row['img_src'] . '" alt="' . $row['alt'] . '">';
                echo '<h3>' . ucfirst($row['alt']) . '</h3>';
                echo '<p>Price: $' . $row['price'] . '</p>';
                echo '</div>';
            }
        } else {
            echo "No dessert items found.";
        }

        $conn->close();
        ?> -->
        
        <!-- Menu items -->
        <div class="menuItem" data-category="icecream" data-price="2.5" type="standard">
            <img src="Mint Chocolate.jpg" alt="Mint Chocolate Icecream">
            <h3>Mint Chocolate Icecream</h3>
            <p>Price: $2.50</p>
        </div>
        <div class="menuItem" data-category="cookie" data-price="2.0" type="standard">
            <img src="Sugar Cookies.jpg" alt="Sugar Cookies">
            <h3>Sugar Cookies (5 pcs)</h3>
            <p>Price: $2.00</p>
        </div>
        <div class="menuItem" data-category="cake" data-price="2.5" type="standard">
            <img src="Walnut Muffins.jpg" alt="Walnut Muffins">
            <h3>Walnut Muffins (4 pcs)</h3>
            <p>Price: $2.50</p>
        </div>
        <div class="menuItem" data-category="cake" data-price="2.5" type="standard">
            <img src="Choco Mouse Cake.jpg" alt="Chocolate Mousse Cake">
            <h3>Chocolate Mousse Cake</h3>
            <p>Price: $2.50</p>
        </div>
        <div class="menuItem" data-category="icecream" data-price="2.5" type="standard">
            <img src="Chocolate Ice cream.jpg" alt="Chocolate Ice cream">
            <h3>Chocolate Ice cream</h3>
            <p>Price: $2.50</p>
        </div>
        <div class="menuItem" data-category="cookie" data-price="2.0" type="standard">
            <img src="Choco Cookies.jpg" alt="Chocolate Chip Cookies">
            <h3>Chocolate Chip Cookies (4 pcs)</h3>
            <p>Price: $2.00</p>
        </div>
        <div class="menuItem" id="Seasonal" data-category="cookie" data-price="2.5" type="seasonal">
            <img src="Cinnamon Buns.jpg" alt="Cinnamon Rolls">
            <h3>Cinnamon Rolls (3 pcs)</h3>
            <p>Price: $2.50</p>
        </div>
        <div class="menuItem" id="Seasonal" data-category="cake" data-price="2.0" type="seasonal">
            <img src="Carrot Doughnut.jpg" alt="Carrot Cake Doughnut">
            <h3>Carrot Cake Doughnut (2 pcs)</h3>
            <p>Price: $2.00</p>
        </div>
        <div class="menuItem" data-category="cookie" data-price="2.0" type="standard">
            <img src="Lemon Tart.jpg" alt="Lemon Tart">
            <h3>Lemon Tart (4 pcs)</h3>
            <p>Price: $2.00</p>
        </div>
    </div>

    <script>
        function filterMenu() {
            const searchInput = document.getElementById('searchBar').value.toLowerCase();
            const filterValue = document.getElementById('filterDropdown').value;
            const menuItems = document.querySelectorAll('.menuItem');

            menuItems.forEach(item => {
                const itemName = item.querySelector('h3').textContent.toLowerCase();
                const itemCategory = item.getAttribute('data-category');
                const itemType = item.getAttribute('type');

                if (
                    (filterValue === 'all' || itemCategory === filterValue || itemType === filterValue) &&
                    itemName.includes(searchInput)
                ) {
                    item.style.display = 'block';
                } else {
                    item.style.display = 'none';
                }
            });
        }

        function sortMenu() {
            const sortValue = document.getElementById('sortDropdown').value;
            const menuContainer = document.getElementById('menuContainer');
            const menuItems = Array.from(menuContainer.getElementsByClassName('menuItem'));

            let sortedItems;

            if (sortValue === 'name') {
                sortedItems = menuItems.sort((a, b) =>
                    a.querySelector('h3').textContent.localeCompare(b.querySelector('h3').textContent)
                );
            } else if (sortValue === 'price') {
                sortedItems = menuItems.sort((a, b) =>
                    parseFloat(a.getAttribute('data-price')) - parseFloat(b.getAttribute('data-price'))
                );
            }

            sortedItems.forEach(item => menuContainer.appendChild(item));
        }
    </script>
</body>

</html>